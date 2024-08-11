const nav_cart_img = document.querySelector('.ShoppingCart');
const cart_product_list = document.querySelector('.cart-product-list')
const remove_product = document.querySelectorAll('.remove-cart-product');

nav_cart_img.addEventListener('click', (e) => {
    if (cart_product_list.classList.contains('hidden')) {
        cart_product_list.classList.remove('hidden')
    } else {
        cart_product_list.classList.add('hidden')
    }
})



for (let i = 0; i < remove_product.length; i++) {

    remove_product[i].addEventListener('click', () => {
        remove_product[i].parentNode.parentNode.style.display = 'none'
        remove_product[i].parentNode.submit();
        // document.getElementById('cart-total').innerText -= remove_product[i].parentNode.parentNode.price
    })


}


const checkout_cart = document.querySelector('#checkout-butn');


checkout_cart.addEventListener('click', () => {
    if(confirm('Add this to your orders?'))
    {
        checkout_cart.parentNode.submit();
        // window.location.href = "index.php";
    }
})



