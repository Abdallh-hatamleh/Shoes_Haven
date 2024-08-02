document.addEventListener('DOMContentLoaded', () => {
    const burgerMenu = document.getElementById('burger-menu');
    const menu = document.getElementById('menu');
    const searchMenu = document.getElementById('search-menu');
    const searchCart = document.getElementById('search-cart');

    burgerMenu.addEventListener('click', () => {
        menu.classList.toggle('active');
    });

    searchMenu.addEventListener('click', () => {
        searchCart.classList.toggle('active');
    });
});
