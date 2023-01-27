function openMenuAside() {
    if (document.querySelector("aside").classList.contains("aside-max-width")) {
        document.querySelector("aside").classList.remove("aside-max-width");
        document.querySelector("aside").classList.add("aside-min-width");
        localStorage.setItem('asideWidth', 'aside-min-width');
    } else {
        document.querySelector("aside").classList.remove("aside-min-width");
        document.querySelector("aside").classList.add("aside-max-width");
        localStorage.setItem('asideWidth', 'aside-max-width');
    }
}