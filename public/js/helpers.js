const btnModal = document.querySelectorAll('.btnModal');
btnModal.forEach((elem, index) => {
    elem.addEventListener('click', () => {
        let modalName = btnModal[index].getAttribute('data-modal-name');
        modalName = pascalCase(modalName);
        document.getElementById(`triggerModal` + modalName).click();
    })
});

// const laravelCSRF = document.querySelector(`meta[name="csrf-token"]`).content;


function toIDR(number) {
    return "Rp" + new Intl.NumberFormat(['ban', 'id']).format(number);
}

function pascalCase(string) {
    let aa = string.replace(/-([a-z])/ig, function (all, letter) {
        return letter.toUpperCase();
    });
    return aa.replace(aa.charAt(0), aa[0].toUpperCase());
};

function triggerElements(elementID_or_Class, callback = null) { // return void
    let arrayOfElement = document.querySelectorAll(elementID_or_Class);

    if (typeof callback == "function") {
        arrayOfElement.forEach(elem => {
            callback(elem);
        });
        return;
    }

    arrayOfElement.forEach(element => {
        element.click();
    });
}
