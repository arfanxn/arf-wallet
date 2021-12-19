document.getElementById("btnCensorUncensor").addEventListener("click", event => {
    let imgSrc = event.target.src;

    document.querySelectorAll(".censor-uncensor").forEach(elem => {
        let valueToSet;
        if (!!imgSrc.split("/").pop().match(/hidden/ig)) {
            valueToSet = elem.getAttribute("data-uncensored");
            elem.innerHTML = valueToSet;
            event.target.src = imgSrc.replace(/hidden.png\s*$/ig, "view.png")

        } else {
            valueToSet = elem.getAttribute("data-censored");
            elem.innerHTML = valueToSet;
            event.target.src = imgSrc.replace(/view.png\s*$/ig, "hidden.png")
        }
    });
    console.log(imgSrc.substr(0, imgSrc.lastIndexOf("/")));
});
