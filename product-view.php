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
  <link rel="stylesheet" href="css/ssllideerr.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/product-vieww.css">
  <link rel="stylesheet" href="css/testimonials.css">
  <link rel="stylesheet" href="css/cart-products-section.css">
</head>

<?php 

$user_id = 2;

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
$query->execute(["idr"=>$pid]);
$sizes = [];
foreach ($result = $query->fetchAll(PDO::FETCH_ASSOC) as $row) {
  global $sizes;
  // echo "<script> alert('hi') </script>";
  $sizes[] = $row['size'];
  }





  if(isset($_POST['add_product'])){
    $size = $_POST['Size'];
   $pid = $_GET['pid']; 
   
   $add_sql = "INSERT INTO `cart`(`product_id`, `product_size`, `user_id`) VALUES ( $pid ,$size,$user_id)";
  $conn->query($add_sql);
$link = "add-to-cart.php?pid=".$_GET['pid'];
  header("Location: $link");
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
        <form class="product-info" action='' method="POST" name="add_form">
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
                      for ($i = 36;$i < 45 ; $i++) {
                        echo "<option value='$i'>$i</option>";
                      }
                       ?>
                    </select>
                </div>
                
                <div class="quantity">
                    <input type='submit' class='add_cart_submit' value='Add to Cart' name="add_product">
                </div>
            </form>
        </section>

            <h2>More like this:</h2>
            <?php 
      $conn = new PDO("mysql:host=localhost;dbname=shoes_haven","root","");
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
      $query = $conn->query("SELECT tag_id FROM tags WHERE featured=1");
      $results = $query->fetchAll(PDO::FETCH_ASSOC);
      foreach ($results as $row) {
        $tagid = $row['tag_id'];
        include("includes/slider.php"); 
      }
       ?>
</div>
</div>

<?php include("includes/foot.php") ?>
<!-- Linking SwiperJS script -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Linking custom script -->
<script src="JS/product-view.js"></script>
<script src="JS/slider.js"></script>
<!-- <script src="JS/testimonials.js"></script> -->
<script src="JS/nav.js"></script>
<script src="JS/nav-cart.js"></script>
</body>
