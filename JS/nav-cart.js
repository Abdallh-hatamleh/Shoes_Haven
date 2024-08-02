const nav_cart_img = document.querySelector('.ShoppingCart');
const cart_product_list = document.querySelector('.cart-product-list')
nav_cart_img.addEventListener('click', (e) => {
    if (cart_product_list.classList.contains('hidden')) {
        cart_product_list.classList.remove('hidden')
    } else {
        cart_product_list.classList.add('hidden')
    }
})


document.addEventListener('click', () => {
    console.log('ok')
})