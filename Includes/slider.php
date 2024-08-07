<div class="category">

    <?php 
      $conn = new PDO("mysql:host=localhost;dbname=shoes_haven","root","");
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
      $query = $conn->prepare("SELECT tags.tag_name from tags where tags.tag_id = :idr");
      $query->execute(["idr"=> "$tagid"]);
      echo "<h2>" . $query->fetchColumn() ."</h2>";
      include("Includes\slidertop.php"); 
      
      $query = $conn->prepare("SELECT poduct_media.Pme_name, products.product_name, products.price, products.product_id from products join product_tags USING (product_id) JOIN poduct_media USING (product_id) where product_tags.tag_id=:idr GROUP BY products.product_name");
      $query->execute(["idr"=> "$tagid"]);
      $products = [];
      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $products[] = $row;
        }
        foreach ($products as $product) {
            $pid = $product['product_id'];
            echo  "<div class='card-item swiper-slide' id=$pid>";
            // echo "<a href='product-view.php?pid=$pid'>";
            echo   "<img src='assets/Products/" .$product["Pme_name"] ."' alt='product image' class='user-image'>";
            // echo   "</a>";
            echo   '<div class="name-price-container">';
            echo   "<div class='message-button'>".$product["product_name"] ."</div>";
            echo   "<div class='icon-container'>";
            echo     "<i class='fa-solid fa-cart-plus'></i>";
            echo   "</div>";
            echo   "<div class='price-color'>".'$' . $product["price"] ."</div>
            </div>
            </div>";
            // echo "<";
            
           

        } ?>
        <div class="card-item swiper-slide">
            <img src="assets/images/placeholder.jpg" alt="User Image" class="user-image">
            <div class="name-price-container">
                <div class="message-button">Womens black formal shoe for parties</div>
                <div class="price-color">$34.00</div>
            </div>
        </div>
        <?php include("Includes/sliderbot.php"); ?>
        </div>