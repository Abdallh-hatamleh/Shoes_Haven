const nav_cart_img = document.querySelector('.ShoppingCart');
const cart_product_list = document.querySelector('.cart-product-list')
nav_cart_img.addEventListener('click', (e) => {
    if (cart_product_list.classList.contains('hidden')) {
        cart_product_list.classList.remove('hidden')
    } else {
        cart_product_list.classList.add('hidden')
    }
})




const remove_product = document.querySelectorAll('.remove-cart-product');

for (let i = 0; i < remove_product.length; i++) {

    remove_product[i].addEventListener('click', () => {
        remove_product[i].parentNode.submit();
        remove_product[i].parentNode.parentNode.style.display = 'none'
    })


}


const checkout_cart = document.querySelectorAll('.cart-checkout-button');


checkout_cart.addEventListener('click', () => {
    checkout_cart.parentNode.submit();

})



