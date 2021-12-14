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

function getCheckedRadioBtnValue(elementsName_or_elementObjects, callback = null) {
    if (typeof elementsName_or_elementObjects == "string") {
        elementsName_or_elementObjects =
            document.getElementsByName(elementsName_or_elementObjects);
    }
    let elements = elementsName_or_elementObjects;

    if (typeof callback == "function") {
        return callback(elements);
    }

    let checkedValue = "";
    elements.forEach(elem => {
        if (elem.checked) checkedValue = elem.value;
    });

    return checkedValue;
}

function clickRadioBtnWhereValueEqualTo(elementsName_or_elementObjects, valueShouldCheck) {
    if (typeof elementsName_or_elementObjects == "string") {
        elementsName_or_elementObjects =
            document.getElementsByName(elementsName_or_elementObjects);
    }
    let elements = elementsName_or_elementObjects;

    elements.forEach(elem => {
        if (elem.value == valueShouldCheck) {
            elem.click();
            elem.checked = true;
        } else {
            elem.checked = false;
        }
    });
}

function submitForm(querySelect = null) {
    let form = typeof querySelect == "string" ? document.querySelector(querySelect) :
        document.querySelector("form");
    if (form) form.submit()
    else throw
    new Error(`Form "${querySelect}" not found`);
}
