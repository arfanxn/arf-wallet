class ChangeEmail {
    static getNewEmail() {
        return document.getElementsByName("email")[0];
    }

    static async sendVerificationCodeToNewEmail() {
        try {
            let email = ChangeEmail.getNewEmail();
            let response = await fetch("/fe-api/send-verification-code-by-email", {
                method: "post",
                credentials: "same-origin",
                headers: {
                    'Content-Type': 'application/json',
                    "Accept": 'application/json',
                    "X-CSRF-Token": Laravel.CSRF()
                },
                body: JSON.stringify({
                    "email": email.value
                })
            })

            // if (!response.ok) throw new Error(`HTTP error -> status: ${response.status}`);

            if (!response.ok) {
                ChangeEmail.printInputError("#inputErrorVerificationCodeWrapper", "Kirim lagi setelah 60 Detik!");
                throw new Error(`HTTP error -> status: ${response.status}`);
                return false;
            }

            let jsonObj = await response.json();

            if (jsonObj.hasOwnProperty("status") && jsonObj.status) {
                ChangeEmail.printInputError("#inputErrorVerificationCodeWrapper",
                    jsonObj.message, "success");
                return true;
            }

        } catch (err) {
            console.log(err);
        }
    }

    static validateVerificationCode() {
        let verificationCode = document.getElementsByName('verification_code')[0];
        if (verificationCode.value.length < 6) {
            ChangeEmail.printInputError("#inputErrorVerificationCodeWrapper", "Masukan Kode Verifikasi yang valid!", );
            return false;
        }
        return true;
    }

    static async validateEmail() {
        try {
            const email = ChangeEmail.getNewEmail();
            let response = await fetch("/fe-api/account/setting/validateEmail", {
                method: "post",
                credentials: "same-origin",
                headers: {
                    'Content-Type': 'application/json',
                    "Accept": 'application/json',
                    "X-CSRF-Token": Laravel.CSRF()
                },
                body: JSON.stringify({
                    "email": email.value
                })
            })

            if (!response.ok) throw new Error(`HTTP error -> status: ${response.status}`);

            let jsonObj = await response.json();

            if (jsonObj.hasOwnProperty("status") && !jsonObj.status) {
                ChangeEmail.printInputError("#inputErrorEmailWrapper", jsonObj.error_message)
                return false;
            }

            return true;
        } catch (err) {
            console.log(err);
        }
    }

    static async verifyVerificationCode() {
        try {
            const verificationCode = document.getElementsByName('verification_code')[0];
            const email = ChangeEmail.getNewEmail();
            let response = await fetch("/fe-api/verify-verification-code-by-email", {
                method: "post",
                credentials: "same-origin",
                headers: {
                    'Content-Type': 'application/json',
                    "Accept": 'application/json',
                    "X-CSRF-Token": Laravel.CSRF()
                },
                body: JSON.stringify({
                    "email": email.value,
                    "verification_code": verificationCode.value
                })
            })

            if (!response.ok) throw new Error(`HTTP error -> status: ${response.status}`);

            let jsonObj = await response.json();

            if (jsonObj.hasOwnProperty("status") && !jsonObj.status) {
                ChangeEmail.printInputError("#inputErrorVerificationCodeWrapper", jsonObj.error_message)
                return false;
            }

            return true;
        } catch (err) {
            console.log(err);
        }
    }


    static async processChangeEmail() {
        try {
            let response = await fetch("/fe-api/account/setting/process-change-email", {
                method: "put",
                credentials: "same-origin",
                headers: {
                    'Content-Type': 'application/json',
                    "Accept": 'application/json',
                    "X-CSRF-Token": Laravel.CSRF()
                },
                body: JSON.stringify({
                    "email": ChangeEmail.getNewEmail().value
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
}

let verificationCode = document.getElementsByName('verification_code')[0];
verificationCode.addEventListener("input", e => {
    if (e.target.value.length > 6) e.target.value = e.target.value.slice(0, -1);
    e.target.value = e.target.value.replace(/[^\d]/ig, "");
});

document.getElementById("btnSendVerificationCode").addEventListener("click", event => {
    let inputNewEmail = ChangeEmail.getNewEmail();
    if (inputNewEmail.value.length < 1) ChangeEmail.printInputError("#inputErrorEmailWrapper", "Masukan Email baru kamu!");
    if (inputNewEmail.value.length > 5) ChangeEmail.validateEmail().then(bool => {
        if (bool) ChangeEmail.sendVerificationCodeToNewEmail();
    });
});

document.getElementById("btnSaveChangeEmail").addEventListener("click", event => {
    ChangeEmail.validateEmail().then(bool => {
        if (bool && ChangeEmail.validateVerificationCode()) {
            ChangeEmail.verifyVerificationCode().then(bool => {
                if (bool) {
                    PinConfirmationModal.show();
                    PinConfirmationModal.whenNextClicked(() => true, () => {
                        ChangeEmail.processChangeEmail();
                        PinConfirmationModal.hide();
                    });
                }
            });
        }
    })
});
