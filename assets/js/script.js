function pageLoad(page) {
    open(page, "_self");
}

let asideWidth = document.querySelector("aside");

function openMenuAside() {
    if (document.querySelector("aside").classList.contains("aside-min-width")) {
        document.querySelector("aside").classList.remove("aside-min-width");
        document.querySelector("aside").classList.add("aside-max-width")
    } else {
        document.querySelector("aside").classList.remove("aside-max-width");
        document.querySelector("aside").classList.add("aside-min-width")
    }
}