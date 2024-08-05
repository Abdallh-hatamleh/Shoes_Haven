<header>
    
        <nav>
            <img src="./images/Black_and_Beige_Modern_Illustration_Logo__3_-removebg-preview-removebg-preview.png" alt=""
                class="logo" id="logologo">

            <div class="menu" id="menu">
                <a href="index.php" class="puttons">Home</a>
                <a href="products.php" class="puttons">products</a>
                <a href="index.php#about" class="puttons">About Us</a>
                <!-- <a href="index.php#contact" class="puttons">Contact Us</a> -->
                <a href="helpcenter.php" class="puttons">help center</a>

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
                        
<?php

$user_id = 2;



$conn = new PDO("mysql:host=localhost;dbname=shoes_haven","root","");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/////////// add to cat




$show_cart = "select a.product_id, a.product_size,a.cart_id, b.product_name, b.product_description, b.price, c.Pme_name from cart a join products b using (product_id) JOIN poduct_media c using (product_id)  where a.user_id = $user_id group by a.cart_id"; 
$cart_products = $conn ->query($show_cart);

   
   echo '<div class="cart-scroll-div">';      

$cart_total_price = 0;
foreach ($cart_products as $products){

$cart_total_price += $products['price'];

    
echo "<div class='cart-product'>
    <img src='assets/Products/".$products['Pme_name']."' alt=''>
    <div class='cart-product-info'>
    <div class='cart-product-name'>".$products['product_name']." </div>
    <div>Size: ".$products['product_size']."</div>
       <div class='cart-product-price'>PRICE: <a> $".$products['price']."</a></div>
</div>
<form action='' method='POST'>
<input type='hidden' name='prod_id' value='".$products['cart_id']."'>
<div class='remove-cart-product'>&#10005;</div>
</form>
</div>";
}

echo " </div>

<section class='checkout-total-section'>

    <button class='cart-checkout-button'>total: $$cart_total_price</button>

<form action='' method='POST'>
    <input type='hidden' name='checkout_btn' value='checkout'>
    <button class='cart-checkout-button'>CHECKOUT</button>
</form>

</section>
";

echo '</div>';


if (isset($_POST['prod_id'])){
    
$remove_sql = "delete FROM `cart` WHERE cart_id =".$_POST['prod_id']; 
$conn ->query($remove_sql);
header("Refresh:0");
}




?>
                        

                </div>
            </div>

            <div class="login_signup">
            <?php 
        // $logged_in = false;
        if(isset($_COOKIE['user']))
        {
            $userid = $_COOKIE['userid'];
            $conn = new PDO("mysql:host=localhost;dbname=shoes_haven","root","");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
            $sql = $conn->query("SELECT first_name FROM `users` WHERE user_id=$user_id");
            $user_name = $sql->fetchColumn();
            echo '<a href="user-information.php" class="login">'. $user_name .'</a>
                    <a href="logout.php" class="signup">LogOut</a>';
        }
        else {
            echo '<a href="signup.php?active=log" class="login">login</a>
                <a href="signup.php?active=sign" class="signup">signup</a>';
        }
    ?>
                
            </div>

                <div class="burger-menu" id="burger-menu">
                    <i class="fa fa-bars"></i>

                </div>
        </nav>
    </header>

<?php


try{

    if (isset($_POST['checkout_btn'])){
        
    

$conn = new PDO("mysql:host=localhost;dbname=shoes_haven","root","");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $checkout_cart_sql = "select cart.*,customers.* from cart JOIN customers using (user_id) where cart.user_id =$user_id"; 
        $checkout_cart = $conn -> query($checkout_cart_sql);
        // $checkout_details = $conn->query($checkout_cart);
        // print_r($conn ->query($checkout_cart));
        
        // $query = $conn->prepare("SELECT tags.tad_name from tags where tags.tag_id = :idr");
        // $query->execute(["idr"=> "$tagid"]);

        $checkout_details = $checkout_cart->fetchAll();
        $cust_id = $checkout_details[1]['cust_id'];
 
        $new_or_id = "INSERT INTO `orders`(`cust_id`) VALUES ($cust_id)" ; 
        $conn ->exec($new_or_id);

        print_r($checkout_details);
        
        $or_id_sql = "select or_id from orders order by or_id DESC limit 1" ; 
        $or_id = $conn ->query($or_id_sql);
        $or_id = $or_id->fetchColumn();
        foreach($checkout_details as $co_detail){
        
        $product_id = $co_detail['product_id'];
        $product_size = $co_detail['product_size'];
    
            $insert_order_detail = "INSERT INTO `order_details`( `product_id`, `or_id`, `shoe_size`) VALUES ($product_id, $or_id, $product_size)";
            $conn ->query($insert_order_detail);
        
        }
        
        $delete_cart_sql = "DELETE FROM `cart` WHERE user_id = $user_id";
        $conn->query($delete_cart_sql);
    header( 'Location: D:\XAMPP\htdocs\group-project-2\add-to-cart.php' );

        }
    } catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
      }
        
    ?>    
