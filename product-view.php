<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shoe Haven</title>
  <!-- Linking SwiperJS CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <link rel="stylesheet" href="css/slider.css">
    <link rel="stylesheet" href="css/product-view.css">
  <link rel="stylesheet" href="css/testimonials.css">
</head>

<body>
    
    <!-- product section -->
    <section class="product-container">
        <!-- left side -->
        <div class="img-card">
            <img src="img/image-1.png" alt="" id="featured-image">
            <!-- small img -->
        </div>
        <!-- Right side -->
        <div class="product-info">
            <h3>LEVI'S® WOMEN'S XL TRUCKER JACKET</h3>
            <h5>Price: $140 <del>$170</del></h5>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsa accusantium, aspernatur provident beatae
                corporis veniam atque facilis, consequuntur assumenda, vitae dignissimos iste exercitationem dolor
                eveniet alias eos ullam nesciunt voluptatum.</p>

            <div class="small-Card">
                <img src="img/image-1.png" alt="" class="small-Img">
                <img src="img/small-img-2.png" alt="" class="small-Img">
                <img src="img/small-img-3.png" alt="" class="small-Img">
            </div>
            <div class="sizes">
                <p>Size:</p>
                <select name="Size" id="size" class="size-option">
                    <option value="xxl">XXL</option>
                    <option value="xl">XL</option>
                    <option value="medium">Medium</option>
                    <option value="small">Small</option>
                </select>
            </div>

            <div class="quantity">
                <input type="number" value="1" min="1">
                <button>Add to Cart</button>
            </div>
        </div>
    </section>

    <h2>More like this:</h2>

  <div class="category">
        <h2>formal</h2>
        <?php include("Includes\slidertop.php")  ?>
        <div class="card-item swiper-slide">
            <img src="assets/images/img-1.jpg" alt="User Image" class="user-image">
            <div class="name-price-container">
              <div class="message-button">Name Lorem ipsum jksdf ;lkas kjdsf asdf alkjjf iosd asido </div>
              <div class="price-color">Price</div>
            </div>
          </div>

          <div class="card-item swiper-slide">
            <img src="assets/images/img-2.jpg" alt="User Image" class="user-image">
            <div class="name-price-container">
              <div class="message-button">Name</div>
              <div class="price-color">Price</div>
            </div>
          </div>

          <div class="card-item swiper-slide">
            <img src="assets/images/img-3.jpg" alt="User Image" class="user-image">
            <div class="name-price-container">
              <div class="message-button">Name</div>
              <div class="price-color">Price</div>
            </div>
          </div>

          <div class="card-item swiper-slide">
            <img src="assets/images/img-4.jpg" alt="User Image" class="user-image">
            <div class="name-price-container">
              <div class="message-button">Name</div>
              <div class="price-color">Price</div>
            </div>
          </div>

          <div class="card-item swiper-slide">
            <img src="assets/images/img-5.jpg" alt="User Image" class="user-image">
            <div class="name-price-container">
              <div class="message-button">Name</div>
              <div class="price-color">Price</div>
            </div>
          </div>

          <div class="card-item swiper-slide">
            <img src="assets/images/img-6.jpg" alt="User Image" class="user-image">
            <div class="name-price-container">
              <div class="message-button">Name</div>
              <div class="price-color">Price</div>
            </div>
          </div>
          <?php include("Includes/sliderbot.php") ?>
    </div>
    <div class="category">
        <h2>Sneakers</h2>
        <?php include("Includes\slidertop.php") ?>
        <div class="card-item swiper-slide">
            <img src="assets/images/img-1.jpg" alt="User Image" class="user-image">
            <div class="name-price-container">
              <div class="message-button">Name Lorem ipsum jksdf ;lkas kjdsf asdf alkjjf iosd asido </div>
              <div class="price-color">Price</div>
            </div>
          </div>

          <div class="card-item swiper-slide">
            <img src="assets/images/img-2.jpg" alt="User Image" class="user-image">
            <div class="name-price-container">
              <div class="message-button">Name</div>
              <div class="price-color">Price</div>
            </div>
          </div>

          <div class="card-item swiper-slide">
            <img src="assets/images/img-3.jpg" alt="User Image" class="user-image">
            <div class="name-price-container">
              <div class="message-button">Name</div>
              <div class="price-color">Price</div>
            </div>
          </div>

          <div class="card-item swiper-slide">
            <img src="assets/images/img-4.jpg" alt="User Image" class="user-image">
            <div class="name-price-container">
              <div class="message-button">Name</div>
              <div class="price-color">Price</div>
            </div>
          </div>

          <div class="card-item swiper-slide">
            <img src="assets/images/img-5.jpg" alt="User Image" class="user-image">
            <div class="name-price-container">
              <div class="message-button">Name</div>
              <div class="price-color">Price</div>
            </div>
          </div>

          <div class="card-item swiper-slide">
            <img src="assets/images/img-6.jpg" alt="User Image" class="user-image">
            <div class="name-price-container">
              <div class="message-button">Name</div>
              <div class="price-color">Price</div>
            </div>
          </div>

          <?php include("Includes/sliderbot.php") ?>
          
    </div>
    
<!-- Linking SwiperJS script -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Linking custom script -->
<script src="JS/slider.js"></script>
<script src="JS/testimonials.js"></script>
    <script src="js/product-view.js"></script>
    </body>