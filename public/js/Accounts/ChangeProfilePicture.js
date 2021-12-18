class ChangeProfilePic {
    validateImage() {
        let inputProfilePicture = document.getElementsByName("profile_picture")[0];
        let profilePict = inputProfilePicture.files[0];
        if (!['image/jpeg', 'image/png', 'image/jpg'].includes(profilePict.type)) {
            inputProfilePicture.value = "";
            return this;
        }

        if (profilePict > 2 * 1024 * 1024) {
            inputProfilePicture.value = "";
            return this;
        }

        this.image = profilePict;
        return this;
    }

    uploadImage() {
        if (!this.hasOwnProperty("image")) {
            return this;
        }

        const image = this.image;

        const formData = new FormData();
        formData.append("profile_picture", image);

        for (const key of formData.entries()) {
            console.log(key);
        }

        fetch("/fe-api/account/setting/process-change-profile-pict", {
                method: "put",
                credentials: "same-origin",
                // processData: false,
                headers: {
                    // 'Content-Type': "multipart/form-data",
                    // "Accept": 'application/json',
                    // processData: false,
                    "X-CSRF-Token": Laravel.CSRF()
                },
                body: formData
            }).then(res => res.json())
            .then(json => console.log(json))
            .catch(err => console.log(err));
    }
}

let inputProfilePicture = document.getElementsByName("profile_picture")[0];

document.getElementById("profilePictureWrapper").addEventListener("click", event => {
    inputProfilePicture.click();
});

inputProfilePicture.addEventListener("change", event => {
    // (new ChangeProfilePic).validateImage().uploadImage();
    formProfilePicture.submit();
});







let formProfilePicture = document.getElementById("formProfilePicture");
formProfilePicture.addEventListener("submit", event => {
    event.stopPropagation();
    event.preventDefault();
    event.stopImmediatePropagation();
    // return;
    // (new ChangeProfilePic).validateImage().uploadImage();
})
