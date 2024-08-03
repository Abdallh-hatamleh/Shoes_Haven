<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shoe Haven</title>
  <!-- Linking SwiperJS CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <link rel="stylesheet" href="css/slider.css">
  <link rel="stylesheet" href="css/testimonials.css">
  <link rel="stylesheet" href="css/nav.css">
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Jockey+One&family=Jomhuria&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/foter.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="css/cart-products-section.css">
  <link rel="stylesheet" href="css/user-information-style.css">
  
</head>

<body style="position:relative">
  <?php include_once("includes/nav.php") ?>

<div class="user-information-section">


<div class="aside-bar-user-info">

  <div class="aside-informations">User Info</div>
  <div class="aside-pass">Password</div>
  <div class="aside-orders">Orders</div>

</div>

<!-- /////////////////////////// -->

<div class="user-info-show ">

<form class="user-info-form" id="info_form" action="" method="">
<h1>User Info</h1>
  
<label>First Name:</label>    
<input class="new-changes-input" type="text" value="Sami" name="first_name">  

  <label>Second Name:</label>    
  <input class="new-changes-input" type="text" value="Sawalqa" name="second_name">  

    <label>Email:</label>    
    <input class="new-changes-input" type="email" value="sawalqa.sami@gmail.com" name="email">  
  
    <label>Phone Number:</label>    
    <input class="new-changes-input" type="text" value="0791189767" name="mobile_number">  

<input class="info-submit-btn" type="submit" value="Save Changes" name="save_info">
</form>

</div>

<!-- /////////////////////////// -->

<div class="user-info-show hidden ">

<form class="user-info-form " id="pass_form" action="" method="">
<h1>Password</h1>
  
<label>Old password:</label>    
<input class="new-changes-input" type="text" placeholder="   ......." name="old_pass">  

  <label>Confirm old password:</label>    
  <input class="new-changes-input" type="text" placeholder="   ......." name="conf_old_pass">  

    <label>New password:</label>    
    <input class="new-changes-input" type="email" placeholder="   ......." name="new_pass">  
  
<input class="info-submit-btn" type="submit" value="Save Changes" name="save_new_pass">
</form>
</div>

<!-- ////////////////////////////////// -->

<div class="user-info-show hidden">

<div class="user-orders-list">
  <h1>Orders</h1>
<div class="user-order-card" id="0">
<a class="order-number">#1</a>
<a class="order-total">TOTAL</a>
<a class="order-date">date</a>
<a class="order-shrink-pointer hidden ">&#9650;</a>
<a class="order-expand-pointer ">&#9660;</a>
</div>
<div class="order-expanded-list " id="0">
<div class="cart-scroll-div">  
<div class="cart-product">
    <img src="img/images.jpg" alt="">
    <div class="cart-product-info">
        <div class="cart-product-name">product nameproduct nameproduct </div>
        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae adipisci </div>
        <div class="cart-product-price">PRICE: <a> 22$ </a></div>
    </div>
</div>
<div class="cart-product">
    <img src="img/images.jpg" alt="">
    <div class="cart-product-info">
        <div class="cart-product-name">product nameproduct nameproduct </div>
        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae adipisci </div>
        <div class="cart-product-price">PRICE: <a> 22$ </a></div>
    </div>
</div>
<div class="cart-product">
    <img src="img/images.jpg" alt="">
    <div class="cart-product-info">
        <div class="cart-product-name">product nameproduct nameproduct </div>
        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae adipisci </div>
        <div class="cart-product-price">PRICE: <a> 22$ </a></div>
    </div>
</div>
</div>
</div>
  
<!-- //////////////// -->

<div class="user-order-card" id="1">
<a class="order-number">#1</a>
<a class="order-total">TOTAL</a>
<a class="order-date">date</a>
<a class="order-shrink-pointer hidden ">&#9650;</a>
<a class="order-expand-pointer ">&#9660;</a>
</div>
<div class="order-expanded-list " id="1">
<div class="cart-scroll-div">  
<div class="cart-product">
    <img src="img/images.jpg" alt="">
    <div class="cart-product-info">
        <div class="cart-product-name">product nameproduct nameproduct </div>
        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae adipisci </div>
        <div class="cart-product-price">PRICE: <a> 22$ </a></div>
    </div>
</div>
<div class="cart-product">
    <img src="img/images.jpg" alt="">
    <div class="cart-product-info">
        <div class="cart-product-name">product nameproduct nameproduct </div>
        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae adipisci </div>
        <div class="cart-product-price">PRICE: <a> 22$ </a></div>
    </div>
</div>
<div class="cart-product">
    <img src="img/images.jpg" alt="">
    <div class="cart-product-info">
        <div class="cart-product-name">product nameproduct nameproduct </div>
        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae adipisci </div>
        <div class="cart-product-price">PRICE: <a> 22$ </a></div>
    </div>
</div>
</div>
</div>
</div> 
</div>
</div>
</div>








    <?php include_once("includes/foot.php") ?>
<!-- Linking SwiperJS script -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Linking custom script -->
<script src="JS/user-information.js"></script>
<script src="JS/slider.js"></script>
<!-- <script src="JS/testimonials.js"></script> -->
<script src="JS/nav.js"></script>
<script src="JS/nav-cart.js"></script>
</body>