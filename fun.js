const links = document.querySelectorAll('.nav-link');
const menuList = document.querySelector('.menu_list')
links.forEach(function (link) {

    links.addEventListener('click', function () {
        menuList.classList.remove();
    })
});