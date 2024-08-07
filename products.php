<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List View</title> 
    <link rel="stylesheet" href="styleproduct.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <link rel="stylesheet" href="css/ssllideerr.css">
  <link rel="stylesheet" href="css/testimonials.css">
  <link rel="stylesheet" href="css/nav.css">
  <link rel="stylesheet" href="css/sstyleess.css">
  <link href="https://fonts.googleapis.com/css2?family=Jockey+One&family=Jomhuria&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="css/cart-products-section.css">
  <style>
    footer {
      position: absolute;
    }
  </style>
</head>
<?php
$search = "";
if (isset($_GET['search']))
{
  $search = $_GET['search'];
}
// if ($search == "") $search = "All Products";
 ?>
<body>
    <?php include_once("includes/nav.php") ?>
    <!-- <aside class="sidebar">
        <button class="sidebar-toggle" onclick="toggleSidebar()">☰</button>
        <h2>Tags</h2>
        <ul>
          <?php 
          // $conn = new PDO("mysql:host=localhost;dbname=shoes_haven","root","");
          // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          // $query = $conn->query("select tag_name from tags");
          // while ($row = $query->fetch(PDO::FETCH_ASSOC))  
          // {
          //   echo '<li>'. $row['tag_name'] .'<div><img src="assets\images\check-mark-1292787_1280.png" alt=""><img src="assets\images\x_icon_150997.png" alt=""></div></li>';
          // }
          ?>
            
        </ul>
    </aside> -->
    <h2 class="cur-search"><?php 
    if ($search == "") echo "All Products";
    else echo($search);
     ?></h2>
    <div class="main-content">
        <div class="content">
            <main class="card-list">
              <?php
              $include_tags = [];
              $exclude_tags = [];
              
              // Check if $search is empty
              if (!empty(trim($search))) {
                  // Split the search string into individual tags
                  $tags = explode(' ', $search);
              
                  // Iterate over each tag to determine if it's to be included or excluded
                  foreach ($tags as $tag) {
                      if (strpos($tag, '-') === 0) {
                          // Tag starts with '-', so it's an exclusion
                          $exclude_tags[] = substr($tag, 1); // Remove the '-' character
                      } else {
                          // Tag is an inclusion
                          $include_tags[] = $tag;
                      }
                  }
              }
              
              // Start constructing the SQL query
              $sql = "SELECT products.product_name , poduct_media.Pme_name, products.product_id,products.price
                      FROM products
                      JOIN product_tags USING (product_id)
                      JOIN tags USING (tag_id)
                      JOIN poduct_media USING (product_id)
                      GROUP BY products.product_id, products.product_name";
              
              // Check if there are any tags to include or exclude
              $having_clauses = [];
              $parameters = []; // Array to hold parameters for the prepared statement
              
              if (!empty($include_tags)) {
                  foreach ($include_tags as $tag) {
                      $having_clauses[] = "FIND_IN_SET(:include_tag_$tag, GROUP_CONCAT(tags.tag_name)) > 0";
                      $parameters[":include_tag_$tag"] = $tag;
                  }
              }
              
              if (!empty($exclude_tags)) {
                  foreach ($exclude_tags as $tag) {
                      $having_clauses[] = "FIND_IN_SET(:exclude_tag_$tag, GROUP_CONCAT(tags.tag_name)) = 0";
                      $parameters[":exclude_tag_$tag"] = $tag;
                  }
              }
              
              // Add HAVING clause if there are any conditions
              if (!empty($having_clauses)) {
                  $sql .= " HAVING " . implode(' AND ', $having_clauses);
              }
              
              // Print to check
              // echo $sql;
              
              // Execute the query using PDO prepared statements
              $stmt = $conn->prepare($sql);
              $stmt->execute($parameters);
              // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
  $img = $row['Pme_name'];
  $name = $row['product_name'];
  $price = $row['price'];
 $pid= $row['product_id'];
  echo '<div class="card-item swiper-slide" id='. $pid .'>';
  echo  '<img src="assets/Products/' . $img .'" alt="User Image" class="user-image">';
  echo  '<div class="name-price-container">';
  echo  '<div class="message-button">'. $name .' </div>';
  echo  '  <div class="price-color">$'.$price .'</div>
    </div>
</div>';
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
        const cards = document.querySelectorAll(".card-item");
cards.forEach(element => {
  element.addEventListener("click", () => {
    window.location.href = `product-view.php?pid=${element.id}`;
  })
});
    </script>
    <script src="JS/nav.js"></script>
    <script src="JS/nav-cart.js"></script>
</body>
</html>
