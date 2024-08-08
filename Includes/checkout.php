<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shoe Haven</title>
  <!-- Linking SwiperJS CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="css/nav.css">
  <link rel="stylesheet" href="css/sliderr.css">
  <link rel="stylesheet" href="css/foter.css">
  <link rel="stylesheet" href="css/product-view.css">
  <link rel="stylesheet" href="css/testimonials.css">
  <link rel="stylesheet" href="css/cart-products-section.css">
  <link rel="stylesheet" href="css/checkout_style.css">
</head>
<body>
    <?php
    include_once("nav.php");
    ?>
    <div class="checkout-container">
        <h1>Checkout</h1>
        <div class="cart-items">
            <?php
            include 'fetch_cart.php';
            ?>
        </div>
        <div class="checkout-total">
            <p>Total: <span id="total-price"></span></p>
            <button type="button">Proceed to Payment</button>
        </div>
    </div>

    <?php
    include_once('foot.php');
    ?>
</body>
</html>
