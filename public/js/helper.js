const btnModal = document.querySelectorAll('.btnModal');
btnModal.forEach((elem, index) => {
    elem.addEventListener('click', () => {
        let modalName = btnModal[index].getAttribute('data-modal-name');
        modalName = pascalCase(modalName);
        document.getElementById(`triggerModal` + modalName).click();
    })
});

function pascalCase(string) {
    let aa = string.replace(/-([a-z])/ig, function (all, letter) {
        return letter.toUpperCase();
    });
    return aa.replace(aa.charAt(0), aa[0].toUpperCase());
};
