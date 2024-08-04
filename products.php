<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List View</title> 
    <link rel="stylesheet" href="styleproduct.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <link rel="stylesheet" href="css/slider.css">
  <link rel="stylesheet" href="css/testimonials.css">
  <link rel="stylesheet" href="css/nav.css">
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Jockey+One&family=Jomhuria&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/foter.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="css/cart-products-section.css">
  <style>
    footer {
      position: absolute;
    }
  </style>
</head>
<?php
$search = "All Products";
if (isset($_GET['search']))
{
  $search = $_GET['search'];
}
if ($search == "") $search = "All Products";
 ?>
<body>
    <?php include_once("includes/nav.php") ?>
    <h2 class="cur-search"><?php echo($search); ?></h2>
    <div class="main-content">
        <aside class="sidebar">
            <button class="sidebar-toggle" onclick="toggleSidebar()">☰</button>
            <h2>Tags</h2>
            <ul>
              <?php 
              $conn = new PDO("mysql:host=localhost;dbname=shoes_haven","root","");
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $query = $conn->query("select tad_name from tags");
              while ($row = $query->fetch(PDO::FETCH_ASSOC))  
              {
                echo '<li>'. $row['tad_name'] .'<div><img src="assets\images\check-mark-1292787_1280.png" alt=""><img src="assets\images\x_icon_150997.png" alt=""></div></li>';
              }
              ?>
                
            </ul>
        </aside>
        <div class="content">
            <main class="card-list">
              <?php
              if($search == "All Products") {
                $query = $conn->query('SELECT products.product_name,products.price,poduct_media.Pme_name FROM products JOIN poduct_media USING (product_id) GROUP BY product_id');
                while ($row = $query->fetch(PDO::FETCH_ASSOC))
                {
                  $img = $row['Pme_name'];
                  $name = $row['product_name'];
                  $price = $row['price'];
                  echo '<div class="card-item swiper-slide">';
                  echo  '<img src="assets/Products/' . $img .'" alt="User Image" class="user-image">';
                  echo  '<div class="name-price-container">';
                  echo  '<div class="message-button">'. $name .' </div>';
                  echo  '  <div class="price-color">'.$price .'</div>
                    </div>
                </div>';
                }
              }
              else {
                $tags = explode(" ",$search);
                $negative = [];
                foreach ($tags as $key => $value) {
                  if(mb_substr($value, 0, 1) == '-') {
                    $negative[] = $value;
                    unset($tags[$key]);
                  }
                }
                $find = "";
                foreach ($tags as $key => $value) {
                  $find .= '"'. $value .'"';
                  if(sizeof($tags) != $key + 1) $find .= ",";
                } 
                $avoid = "";
                foreach ($negative as $key => $value) {
                  $avoid .= '"'. $value .'"';
                  if(sizeof($negative) != $key + 1) $avoid .= ",";
                } 
                // echo $find;
                // Sample input
// Sample input
$find_tags = $tags;
$avoid_tags = $negative;

// Number of tags in $find
$tag_count = count($find_tags);

// Prepare placeholders for IN clauses
$find_placeholders = implode(',', array_fill(0, count($find_tags), '?'));
$avoid_placeholders = implode(',', array_fill(0, count($avoid_tags), '?'));

// Prepare the SQL query with placeholders
$sql = "
SELECT p.product_id, p.product_name, p.price, poduct_media.Pme_name
FROM products p JOIN poduct_media USING (product_id)
JOIN product_tags pt ON p.product_id = pt.product_id
JOIN tags t ON pt.tag_id = t.tag_id
WHERE t.tad_name IN ($find_placeholders)
GROUP BY p.product_id
HAVING COUNT(DISTINCT pt.tag_id) = ?
";
if (!empty($avoid_tags)) {
  $avoid_placeholders = implode(',', array_fill(0, count($avoid_tags), '?'));
  $sql .= "
  AND NOT EXISTS (
      SELECT 1
      FROM product_tags pt_exclude
      JOIN tags t_exclude ON pt_exclude.tag_id = t_exclude.tag_id
      WHERE pt_exclude.product_id = p.product_id
      AND t_exclude.tad_name IN ($avoid_placeholders)
  );";
}

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the parameters for $find
$params = array_merge($find_tags, [$tag_count], $avoid_tags);
foreach ($params as $i => $param) {
    $stmt->bindValue($i + 1, $param);
}

// Execute the query
$stmt->execute();
// $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output results
// print_r($results);

// echo $query->queryString;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
  $img = $row['Pme_name'];
  $name = $row['product_name'];
  $price = $row['price'];
  echo '<div class="card-item swiper-slide">';
  echo  '<img src="assets/Products/' . $img .'" alt="User Image" class="user-image">';
  echo  '<div class="name-price-container">';
  echo  '<div class="message-button">'. $name .' </div>';
  echo  '  <div class="price-color">'.$price .'</div>
    </div>
</div>';
}
              }
              ?>
                <!-- <div class="card-item swiper-slide">
                    <img src="assets/images/img-1.jpg" alt="User Image" class="user-image">
                    <div class="name-price-container">
                      <div class="message-button">Name Lorem ipsum jksdf ;lkas kjdsf asdf alkjjf iosd asido </div>
                      <div class="price-color">Price</div>
                    </div>
                </div> -->
            </main>
        </div>
    </div>
    <?php include_once("includes/foot.php") ?>
    <script>
        function toggleSidebar() 
        {
            document.querySelector('.sidebar').classList.toggle('open');
            document.querySelector('.sidebar-toggle').classList.toggle('open');
        }
    </script>
    <script src="JS/nav.js"></script>
    <script src="JS/nav-cart.js"></script>
</body>
</html>
