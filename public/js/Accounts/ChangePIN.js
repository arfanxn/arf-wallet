class ChangePIN {
    static validateInput() {
        let inputChangePinNumber = document.getElementsByName("change_pin_number")[0];
        let changePinNumberConfirmation = document.getElementsByName("change_pin_number_confirmation")[0];

        if (inputChangePinNumber.value.length < 6 || inputChangePinNumber.value.length > 8) {
            ChangePIN.printInputError("#inputErrorChangePinNumberWrapper",
                "Masukan PIN minimal 6 dan maksimal 8 karakter!");
            return false;
        }
        if (changePinNumberConfirmation.value != inputChangePinNumber.value &&
            changePinNumberConfirmation.value.length == inputChangePinNumber.value.length) {
            ChangePIN.printInputError("#inputErrorChangePinNumberConfWrapper", "PIN konfirmasi harus sama!");
            return false;
        }

        if (changePinNumberConfirmation.value == inputChangePinNumber.value) return true;
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

    static async processChangePIN() {
        try {
            let inputChangePinNumber = document.getElementsByName("change_pin_number")[0];

            let response = await fetch("/account/setting/process-change-pin", {
                method: "put",
                credentials: "same-origin",
                headers: {
                    'Content-Type': 'application/json',
                    "Accept": 'application/json',
                    "X-CSRF-Token": Laravel.CSRF()
                },
                body: JSON.stringify({
                    "pin_number": inputChangePinNumber.value
                })
            });

            if (!response.ok) throw new Error(`HTTP error -> status: ${response.status}`);

            let jsonObj = await response.json();

            if (jsonObj.hasOwnProperty("status") && jsonObj.status) {
                document.getElementById("main").innerHTML = `<div class="alert alert-success alert-dismissible fade show px-3 mt-2 d-flex justify-content-between ">
                    <h6 class="my-auto fw-bold">${jsonObj.message}</h6>
                    <a href="/account/settings" class="btn btn-outline-success m-0 py-1 text-">Kembali</a>
                </div>`;
            } else {
                `<div class="alert alert-danger alert-dismissible fade show px-3 mt-2 d-flex justify-content-between ">
                    <h6 class="my-auto fw-bold">${jsonObj.error_message}</h6>
                    <a href="/account/settings" class="btn btn-outline-danger m-0 py-1 text-">Kembali</a>
                </div>`;
            }
        } catch (err) {
            console.log(err);
        }
    }
}

let inputChangePinNumber = document.getElementsByName("change_pin_number")[0]
inputChangePinNumber.addEventListener("input", event => {
    if (event.target.value.length > 8) event.target.value = event.target.value.slice(0, -1);

    event.target.value = event.target.value.replace(/[^\d]/ig, "");
})
document.getElementsByName("change_pin_number_confirmation")[0].addEventListener("input", (event) => {
    if (event.target.value.length > inputChangePinNumber.value.length)
        event.target.value = event.target.value.slice(0, -1);
    event.target.value = event.target.value.replace(/[^\d]/ig, "");
});





document.getElementById("btnSaveChangePIN").addEventListener("click", event => {
    PinConfirmationModal.show(() => ChangePIN.validateInput());
});

PinConfirmationModal.whenNextClicked(() => ChangePIN.validateInput(), () => {
    ChangePIN.processChangePIN().then(() => PinConfirmationModal.hide());
});
