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
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/product-vieww.css">
  <link rel="stylesheet" href="css/testimonials.css">
  <link rel="stylesheet" href="css/cart-products-section.css">
  <link rel="stylesheet" href="css/ssllideerr.css">
  <link rel="stylesheet" href="css/sstyless.css">
</head>

<?php
session_start();
$user_id = 2;

$pid = 1;
if (isset($_GET['pid'])) {
  $pid = $_GET['pid'];
}
$conn = new PDO("mysql:host=localhost;dbname=shoes_haven", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {

  $query = $conn->prepare("select products.product_name as title,products.price as price,.products.product_description as descr, poduct_media.Pme_name as img from products JOIN poduct_media USING (product_id) where product_id=:idr");
  $query->execute(["idr" => $pid]);
} catch (PDOException $e) {
  echo "" . $e->getMessage();
}
$images = [];
foreach ($result = $query->fetchAll(PDO::FETCH_ASSOC) as $row) {
  global $images;
  // echo "<script> alert('hi') </script>";
  $images[] = $row['img'];
}
$query = $conn->prepare('select products.product_name as title,products.price as price,.products.product_description as descr from products JOIN poduct_media USING (product_id) where product_id=:idr');
$query->execute(["idr" => $pid]);
$title = $query->fetchColumn();
$price = $query->fetchColumn(1);
$description = $query->fetchColumn(2);
$query = $conn->prepare("select shoe_sizes.shoe_size as size from products JOIN shoe_sizes USING (product_id) where product_id=:idr");
$query->execute(["idr" => $pid]);
$sizes = [];
foreach ($result = $query->fetchAll(PDO::FETCH_ASSOC) as $row) {
  global $sizes;
  // echo "<script> alert('hi') </script>";
  $sizes[] = $row['size'];
}





if (isset($_POST['add_product'])) {
  $size = $_POST['Size'];
  $pid = $_GET['pid'];
  if(isset($_COOKIE['user']))
  {
    $user_id = $_COOKIE['userid'];
    $add_sql = "INSERT INTO `cart`(`product_id`, `product_size`, `user_id`) VALUES ( $pid ,$size,$user_id)";
    $conn->query($add_sql);
    // $link = "add-to-cart.php?pid=" . $_GET['pid'];
    // header("Location: $link");
  }
  else{
    // unset($_SESSION['cart']);
    $sql = "SELECT products.product_name,products.price, poduct_media.Pme_name FROM products join poduct_media USING (product_id) GROUP BY products.product_id having products.product_id=$pid";
    $res = $conn->query($sql);
    $result = $res->fetchAll(PDO::FETCH_ASSOC);
    $img = $result[0]["Pme_name"];
    $name = $result[0]["product_name"];
    $price = $result[0]["price"];
    if(!isset($_SESSION['cart']))
    {
      $_SESSION['cart'] = [];
      $_SESSION['cart'][] = ['id' => $pid, 'size' => $size,'img'=> $img,'name'=> $name,'price'=> $price];
      
    }
    else {
      $_SESSION['cart'][] = ['id' => $pid, 'size' => $size,'img'=> $img,'name'=> $name,'price'=> $price];
      // unset( $_SESSION['cart'][0] );
    }
  }
}




?>

<body>
  <?php include ("includes/nav.php");
  // var_dump($sizes);
  ?>
  <div class="main-pvcontainer">
    <div class="second-pvcontainer">
      <!-- product section -->
      <section class="product-container">
        <!-- left side -->
        <div class="img-card">
          <img src="assets/Products/<?php echo $images[0] ?>" alt="" id="featured-image">
        </div>
        <!-- Right side -->
        <form class="product-info" action='' method="POST" name="add_form">
          <h3><?php echo $title ?></h3>
          <h5>Price: $<?php echo $price ?></h5>
          <p><?php echo $description ?></p>

          <div class="small-Card">
            <!-- small img -->
            <img src="assets/Products/<?php echo $images[0] ?>" alt="" class="small-Img">
            <img src="assets/Products/<?php echo $images[1] ?>" alt="" class="small-Img">
            <img src="assets/Products/<?php echo $images[2] ?>" alt="" class="small-Img">
          </div>
          <div class="sizes">
            <p>Size:</p>
            <select name="Size" id="size" class="size-option">
              <?php
              for ($i = 36; $i < 45; $i++) {
                echo "<option value='$i'>$i</option>";
              }
              ?>
            </select>
          </div>

          <div>
            <input type='submit' class='add_cart_submit' value='Add to Cart' name="add_product">
          </div>
        </form>
      </section>

      <h2>More like this:</h2>
      
    </div>
  </div>
    <?php
      $conn = new PDO("mysql:host=localhost;dbname=shoes_haven", "root", "");
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query = $conn->query("SELECT tags.tag_id,tags.tag_name, COUNT(product_tags.product_id) as Items_in_tag FROM tags left JOIN product_tags USING (tag_id) WHERE featured=1 GROUP BY tags.tag_id HAVING Items_in_tag > 3");
      $results = $query->fetchAll(PDO::FETCH_ASSOC);
      foreach ($results as $row) {
        $tagid = $row['tag_id'];
        include ("includes/slider.php");
      }
      // var_dump($_SESSION['cart']);
      ?>
  
<script src="JS/product-view.js"></script>
  <?php include ("includes/foot.php") ?>
  <!-- Linking SwiperJS script -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <!-- Linking custom script -->
  <script src="JS/slider.js"></script>
  <!-- <script src="JS/testimonials.js"></script> -->
  <script src="JS/nav.js"></script>
  <script src="JS/nav-cart.js"></script>
</body>