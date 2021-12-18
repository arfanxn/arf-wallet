let inputProfilePicture = document.getElementsByName("profile_picture")[0];

document.getElementById("profilePictureWrapper").addEventListener("click", event => {
    inputProfilePicture.click();
});

inputProfilePicture.addEventListener("change", event => {
    formProfilePicture.submit();
});