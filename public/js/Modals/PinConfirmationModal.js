class PinConfirmationModal {
    static getInputPin() {
        return document.getElementsByName("pin_number")[0];
    }

    static refreshInputPin() {
        PinConfirmationModal.getInputPin().value = "";
        document.getElementById("inputErrorPinNumberWrapper").innerHTML = ""
    }

    static printPinError(errorMessage) {
        let inputErrorPinNumberWrapper = document.getElementById("inputErrorPinNumberWrapper");
        inputErrorPinNumberWrapper.innerHTML = `<div class="alert alert-danger rounded  alert-dismissible fade show py-0 mt-1" role="alert"><strong id="inputErrorPinNumberMsg">${errorMessage}</strong>
        <button type="button" class="btn-close  p-1" data-bs-dismiss="alert" aria-label="Close"></button></div>`
    }

    static pinValidation() {
        let pinInput = PinConfirmationModal.getInputPin();
        let pinValue = pinInput.value;
        if (pinValue.length < 1) {
            PinConfirmationModal.printPinError("Masukan Nomor PIN!");
            return false;
        };
        if (pinValue.length < 6 || pinValue.length > 8) {
            PinConfirmationModal.printPinError("Nomor PIN minimal 6 dan maximal 8 karakter!");
            return false;
        }

        return true;
    }

    static async pinVerify() {
        let pinValue = PinConfirmationModal.getInputPin().value;
        try {
            let response = await fetch("/fe-api/pin-confirmation", {
                method: "post",
                credentials: "same-origin",
                headers: {
                    'Content-Type': 'application/json',
                    "Accept": 'application/json',
                    "X-CSRF-Token": Laravel.CSRF()
                },
                body: JSON.stringify({
                    "pin_number": pinValue
                })
            })

            if (!response.ok) throw new Error(`HTTP error -> status: ${response.status}`);

            let json = await response.json();
            if (!json.status || json.status == false)
                if (json.hasOwnProperty("errors") || json.hasOwnProperty("error")) {
                    const errors = json.hasOwnProperty("errors") ? json.errors :
                        json.error;
                    PinConfirmationModal.printPinError(
                        errors.hasOwnProperty("pin_number") ? errors.pin_number[0] :
                        "PIN Number does not Match our record!"
                    )
                }

            return json.status ? true : false;
        } catch (err) {
            console.log(err);
        }
    }

    static whenNextClicked(validationCallback, pinMatchCallback) {
        document.getElementById("btnNextModalPinConfirmation").addEventListener("click", () => {
            if (validationCallback()) {
                if (PinConfirmationModal.pinValidation()) {
                    PinConfirmationModal.pinVerify().then(bool => {
                        if (bool) pinMatchCallback()
                    });
                }
            } else {
                PinConfirmationModal.hide();
            }
        });
    }

    static show(validationCallback = null) {
        const show = () => {
            let element = document.getElementById("modalPinConfirmation");
            if (element.classList.contains("d-none")) {
                element.classList.remove("d-none");
            }
        };
        if (typeof validationCallback == "function") {
            if (validationCallback()) {
                show();
            }
        } else show();
    }

    static hide() {
        let element = document.getElementById("modalPinConfirmation");
        if (!element.classList.contains("d-none")) {
            element.classList.add("d-none");
            PinConfirmationModal.refreshInputPin();
        }
    }
}

document.getElementById("btnCloseModalPinConfirmation").addEventListener("click", () => {
    PinConfirmationModal.hide()
});

let btnOpenModalPinConfirmation = document.getElementById("btnOpenModalPinConfirmation")
if (btnOpenModalPinConfirmation)
    btnOpenModalPinConfirmation.addEventListener("click", () => PinConfirmationModal.show());


document.getElementsByName("pin_number")[0].addEventListener("change", e => {
    let value = e.target.value;
    e.target.value = value.replace(/[^\d]/ig, "");
});
