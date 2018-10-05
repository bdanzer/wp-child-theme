document.addEventListener("DOMContentLoaded", function(event) {
    var search = document.querySelector('.danzerpress-search');
    var icon = document.querySelector('header .fa-search');
    var menuItems = document.querySelectorAll('header .menu-item');

    icon.addEventListener('click', (e) => {
        e.preventDefault();
        menuItems.forEach((menu) => {
            menu.classList.toggle('danzerpress-not-visible');
        });
        
        icon.classList.toggle('fa-search');
        icon.classList.toggle('fa-times');
        icon.classList.toggle('active');

        var form = document.querySelector('header form');
        if (form) {
            removeForm(form);
        } else {
            addForm(search);
        }
    });

    function addForm(obj) {
        obj.parentNode.insertAdjacentHTML('beforeend', '<form action="https://dev1.danzerpress.com/" role="search" method="get"><input class="search-field" type="text" name="s" placeholder="Start Searching" /></form>');
    }
    function removeForm(obj) {
        obj.parentNode.removeChild(obj);
    }
});