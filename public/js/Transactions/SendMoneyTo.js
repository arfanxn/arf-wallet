class SendMoneyTo {
    static getAmount() {
        return document.getElementsByName("amount")[0];
    }

    static getDescription() {
        return document.getElementsByName("description")[0];
    }

    static async validateInput() {
        let inputErrorDescriptionWrapper = document.getElementById("inputErrorDescriptionWrapper"),
            inputErrorAmountWrapper = document.getElementById("inputErrorAmountWrapper");

        return await Laravel.formValidator({
            amount: SendMoneyTo.getAmount().value,
            description: SendMoneyTo.getDescription().value
        }, `/transaction/send-money/verify`).then(r => {
            if (r.hasOwnProperty('errors')) {
                if (r.errors.hasOwnProperty("description"))
                    SendMoneyTo.printInputError(inputErrorDescriptionWrapper, r.errors['description'][0]);
                if (r.errors.hasOwnProperty("amount"))
                    SendMoneyTo.printInputError(inputErrorAmountWrapper, r.errors['amount'][0]);
                return false;
            } else {
                return true
            };
        });
    }

    static printInputError(inputErrorWrapper, errorMessage, alertColor = "warning") {
        if (typeof inputErrorWrapper == "string") {
            inputErrorWrapper = document.querySelector(inputErrorWrapper);
        }
        inputErrorWrapper.innerHTML =
            `<div class="alert alert-${alertColor}  alert-dismissible fade show py-0 mt-2">
                            <span>${errorMessage}</span>
                            <button type="button" class="btn-close p-1" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>`
    }

    static async process() {
        const arrayOfURLpathName = window.location.pathname.split('/');
        let encryptedToWalletAddress = arrayOfURLpathName[arrayOfURLpathName.length - 1];

        const amountValue = SendMoneyTo.getAmount().value,
            descriptionValue = SendMoneyTo.getDescription().value;

        try {
            let response = await fetch("/transaction/send-money/handle", {
                method: "post",
                credentials: "same-origin",
                headers: {
                    'Content-Type': 'application/json',
                    "Accept": 'application/json',
                    "X-CSRF-Token": Laravel.CSRF()
                },
                body: JSON.stringify({
                    "amount": amountValue.toString(),
                    "description": descriptionValue,
                    "encrypted_to_wallet_address": encryptedToWalletAddress
                })
            });
            if (!response.ok) throw new Error(`HTTP error -> status: ${response.status}`);

            const jsonObj = await response.json();

            if (jsonObj.status) {
                if (jsonObj.hasOwnProperty("redirect")) {
                    window.location.replace(jsonObj.redirect);
                }
                return true;
            } else {
                SendMoneyTo.printInputError("#serverErrorWrapper", jsonObj.error_message, "danger")
                PinConfirmationModal.hide();
                return false
            }

        } catch (error) {
            console.log(error);
        }


    }
}



document.getElementsByName("amount")[0].addEventListener("input", (event) => {
    let value = event.target.value;
    event.target.value = value.replace(/[^\d]/ig, "");
});

document.getElementsByName("description")[0].addEventListener("input", event => {
    if (event.target.value.length > 250) SendMoneyTo.validateInput();
});

document.getElementById(`btnProcessTransfer`).addEventListener("click", () => {
    SendMoneyTo.validateInput().then(bool => PinConfirmationModal.show(() => {
        return bool;
    }));
});

PinConfirmationModal.whenNextClicked(async () => await SendMoneyTo.validateInput().then(bool => bool),
    async () => await SendMoneyTo.process());

// var DEBUG = false;
// if (!DEBUG) {
//     if (!window.console) window.console = {};
//     var methods = ["log", "debug", "warn", "info"];
//     for (var i = 0; i < methods.length; i++) {
//         console[methods[i]] = function () {};
//     }
// }
