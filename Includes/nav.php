<?php

 ?>

<header>
        <nav>
            <img src="./images/Black_and_Beige_Modern_Illustration_Logo__3_-removebg-preview-removebg-preview.png" alt=""
                class="logo" id="logologo">

            <div class="menu" id="menu">
                <a href="index.php" class="puttons">Home</a>
                <a href="products.php" class="puttons">products</a>
                <a href="index.php#about" class="puttons">About Us</a>
                <a href="index.php#contact" class="puttons">Contact Us</a>
            </div>
            <form action="products.php" style="display:inline" id="search-form">

                <div class="search-cart" id="search-cart">
                    <div class="search">
                        <input type="text" class="text" name="search">
                        <img src="./images/Vector.png" alt="" class="Vector" id="search-button">
                    </div>
                </form>
                <script>
                    let ourForm = document.getElementById("search-form");
                    document.getElementById("search-button").addEventListener("click",()=> {
                        ourForm.submit();
                    })
                    document.getElementById("logologo").addEventListener("click",() => {
                        window.location.href = "index.php";
                    } )
                </script>
                <div class="cart">
                    <img src="./images/Shopping Cart.png" alt="" class="ShoppingCart">
                    
                    <div class="cart-product-list hidden">
                        
                        <h2>YOUR CART</h2>
                        
                        <div class="cart-scroll-div">           
<div class="cart-product">
    <img src="img/images.jpg" alt="">
    <div class="cart-product-info">
        <div class="cart-product-name">product nameproduct nameproduct </div>
        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae adipisci </div>
        <div class="cart-product-price">PRICE: <a> 22$ </a></div>
    </div>
    <div class="remove-cart-product">&#10005;</div>
</div>

<div class="cart-product">
    <img src="img/images.jpg" alt="">
    <div class="cart-product-info">
        <div class="cart-product-name">product nameproduct nameproduct </div>
        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae adipisci </div>
        <div class="cart-product-price">PRICE: <a> 22$ </a></div>
    </div>
    <div class="remove-cart-product">&#10005;</div>
</div>

<div class="cart-product">
    <img src="img/images.jpg" alt="">
    <div class="cart-product-info">
        <div class="cart-product-name">product nameproduct nameproduct </div>
        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae adipisci </div>
        <div class="cart-product-price">PRICE: <a> 22$ </a></div>
    </div>
    <div class="remove-cart-product">&#10005;</div>
</div>
</div>

<section class="checkout-total-section">

    <button class="cart-checkout-button">total: $66</button>
    <button class="cart-checkout-button">CHECKOUT</button>

</section>

</div>
                </div>
            </div>

            <div class="login_signup">
                <a href="signup.php?active=log" class="login">login</a>
                <a href="signup.php?active=sign" class="signup">signup</a>
            </div>
                <div>
                    <a href="user-information.php">UserInfo</a>
                </div>
                <div class="burger-menu" id="burger-menu">
                    <i class="fa fa-bars"></i>
                </div>
        </nav>
    </header>