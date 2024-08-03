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
  <link rel="stylesheet" href="css/slider.css">
  <link rel="stylesheet" href="css/foter.css">
  <link rel="stylesheet" href="css/product-view.css">
  <link rel="stylesheet" href="css/testimonials.css">
  <link rel="stylesheet" href="css/cart-products-section.css">
</head>

<?php 
$pid = 1;
if (isset($_GET['pid']))
{
 $pid = $_GET['pid'];
}
$conn = new PDO("mysql:host=localhost;dbname=shoes_haven","root","");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {

$query = $conn->prepare("select products.product_name as title,products.price as price,.products.product_description as descr, poduct_media.Pme_name as img from products JOIN poduct_media USING (product_id) where product_id=:idr");
$query->execute(["idr"=>$pid]);
}
catch (PDOException $e)
{
  echo "". $e->getMessage();
}
$images = [];
foreach ($result = $query->fetchAll(PDO::FETCH_ASSOC) as $row) {
global $images;
// echo "<script> alert('hi') </script>";
$images[] = $row['img'];
}
$query = $conn->prepare('select products.product_name as title,products.price as price,.products.product_description as descr from products JOIN poduct_media USING (product_id) where product_id=:idr');
$query->execute(["idr"=>$pid]);
$title = $query->fetchColumn();
$price = $query->fetchColumn(1);
$description = $query->fetchColumn(2);
$query = $conn->prepare("select shoe_sizes.shoe_size as size from products JOIN shoe_sizes USING (product_id) where product_id=:idr");
$query->execute(["idr"=>1]);
$sizes = [];
foreach ($result = $query->fetchAll(PDO::FETCH_ASSOC) as $row) {
  global $sizes;
  // echo "<script> alert('hi') </script>";
  $sizes[] = $row['size'];
  }
?>

<body>
  <?php include("includes/nav.php");
  // var_dump($sizes);
  ?>
    <div class="main-pvcontainer">
    <div class="second-pvcontainer">
    <!-- product section -->
    <section class="product-container">
        <!-- left side -->
        <div class="img-card">
            <img src="assets/Products/<?php echo $images[0]?>" alt="" id="featured-image">
        </div>
        <!-- Right side -->
        <div class="product-info">
            <h3><?php echo $title ?></h3>
            <h5>Price: $<?php echo $price ?></h5>
            <p><?php echo $description ?></p>
                
                <div class="small-Card">
                    <!-- small img -->
                    <img src="assets/Products/<?php echo $images[0]?>" alt="" class="small-Img">
                    <img src="assets/Products/<?php echo $images[1]?>" alt="" class="small-Img">
                    <img src="assets/Products/<?php echo $images[2]?>" alt="" class="small-Img">
                </div>
                <div class="sizes">
                    <p>Size:</p>
                    <select name="Size" id="size" class="size-option">
                      <?php
                      foreach ($sizes as $key => $value) {
                        echo "<option value='$value'>$value</option>";
                      }
                       ?>
                    </select>
                </div>
                
                <div class="quantity">
                    <input type="number" value="1" min="1" name="qty">
                    <button>Add to Cart</button>
                </div>
            </div>
        </section>

            <h2>More like this:</h2>
            <h2>formal</h2>
        
        <div class="category">
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
</div>
</div>

<?php include("includes/foot.php") ?>
<!-- Linking SwiperJS script -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Linking custom script -->
<script src="JS/slider.js"></script>
<script src="JS/testimonials.js"></script>
<script src="JS/nav.js"></script>
<script src="JS/nav-cart.js"></script>
<script src="JS/product-view.js"></script>
</body>
