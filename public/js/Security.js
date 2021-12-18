var curWidth = document.documentElement.clientWidth;
var curHeight = document.documentElement.clientHeight;

function consoleCheck() {
    var temp_curHeight = document.documentElement.clientHeight;
    var temp_curWidth = document.documentElement.clientWidth;

    if (curHeight != temp_curHeight || curWidth != temp_curWidth) {
        var devtools = function () {};
        devtools.toString = function () {
            if (!this.opened) {
                // $('body').remove();
                document.body.parentNode.removeChild(document.body);
            }
            this.opened = true;
        }
        console.log('YOU CANNOT HACK THIS SITE');
        console.log('%c', devtools);
    } else {
        location.reload();
    }
}

window.addEventListener("resize", () => consoleCheck());
window.addEventListener("orientationchange", () => consoleCheck())

window.eval = function () {};
