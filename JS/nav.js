document.addEventListener('DOMContentLoaded', () => {
    const burgerMenu = document.getElementById('burger-menu');
    const menu = document.getElementById('menu');
    // const searchMenu = document.getElementById('search-menu');
    const searchCart = document.getElementById('search-cart');

    burgerMenu.addEventListener('click', () => {
        menu.classList.toggle('active');
    });

    // searchMenu.addEventListener('click', () => {
    //     searchCart.classList.toggle('active');
    // });

    document.getElementById("searchbar").addEventListener("keyup",e => {
        if (e.key == 'Enter') {
            let inputval = document.getElementById("searchbar").value.replace(/ /g,"%20");
            window.location.href = `products.php?search=${inputval}`
        }
    })
    document.getElementById("searchsubmit").addEventListener("click",() =>
        {        
            let inputval = document.getElementById("searchbar").value.replace(/ /g,"%20");
            window.location.href = `products.php?search=${inputval}`
    } )
})
