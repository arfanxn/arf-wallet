class SendVerificationCodeByEmail {
    static async send(email) {
        try {
            let response = await fetch("/fe-api/send-verification-code-by-email", {
                method: "post",
                credentials: "same-origin",
                headers: {
                    'Content-Type': 'application/json',
                    "Accept": 'application/json',
                    "X-CSRF-Token": Laravel.CSRF()
                },
                body: JSON.stringify({
                    "email": email
                })
            });

            if (!response.ok) {
                SendVerificationCodeByEmail.printInputError("#inputErrorVerificationCodeWrapper", "Kirim lagi setelah 60 Detik!");
                throw new Error(`HTTP error -> status: ${response.status}`);
                return false;
            }

            let jsonObj = await response.json();

            if (jsonObj.hasOwnProperty("status") && jsonObj.status) {
                SendVerificationCodeByEmail.printInputError("#inputErrorVerificationCodeWrapper",
                    jsonObj.message, "success");
                return true;
            }

            return await response.json();
        } catch (err) {}
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

document.getElementById("btnSendVerificationCode").addEventListener("click", event => {
    const inputAuthUserEmail = document.getElementsByName("auth-user-email")[0];
    SendVerificationCodeByEmail.send(inputAuthUserEmail.value);
})
