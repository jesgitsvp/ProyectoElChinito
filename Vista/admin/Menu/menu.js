const body = document.querySelector('body'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    searchbtn = body.querySelector(".search-box"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");

toggle.addEventListener('click', () => {
    sidebar.classList.toggle("close");
})

searchbtn.addEventListener("click", () => {
    sidebar.classList.remove("close")
})
