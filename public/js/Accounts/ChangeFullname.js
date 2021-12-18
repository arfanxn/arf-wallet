class ChangeFullname {
    static async processChangeName() {
        try {
            let response = await fetch("/fe-api/account/setting/process-change-fullname", {
                method: "put",
                credentials: "same-origin",
                headers: {
                    'Content-Type': 'application/json',
                    "Accept": 'application/json',
                    "X-CSRF-Token": Laravel.CSRF()
                },
                body: JSON.stringify({
                    "fullname": inputFullname.value
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

let inputFullname = document.getElementsByName("fullname")[0];
inputFullname.addEventListener("input", event => {
    event.target.value = event.target.value.replace(/(^\w|\s\w)/ig, str => str.toUpperCase())
        .replace(/[0-9]/ig, "");

    if (event.target.value.length > 30) {
        event.target.value = event.target.value.slice(0, -1);
    }
});


document.getElementById("btnSaveChangeFullname").addEventListener("click", event => {
    if (inputFullname.value.length < 2) {
        return ChangeFullname.printInputError("#inputErrorFullnameWrapper", "Masukan Nama Lengkap!");
    }

    PinConfirmationModal.show();

    PinConfirmationModal.whenNextClicked(() => true, () => {
        ChangeFullname.processChangeName();
        PinConfirmationModal.hide();
    });
});
