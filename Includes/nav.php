<?php 
$conn = new PDO("mysql:host=localhost;dbname=shoes_haven", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['checkout_btn'])) {
    // echo '<script>alert("hi")</script>';
    $user_id = $_COOKIE['userid'];
    $checkout_cart_sql = "select cart.*,customers.* from cart JOIN customers using (user_id) where cart.user_id =$user_id";
    $checkout_cart = $conn->query($checkout_cart_sql);
    // $checkout_details = $conn->query($checkout_cart);
    // print_r($conn ->query($checkout_cart));
    
    // $query = $conn->prepare("SELECT tags.tad_name from tags where tags.tag_id = :idr");
    // $query->execute(["idr"=> "$tagid"]);

    // $checkout_details = $checkout_cart->fetch();
    $checkout_details = $checkout_cart->fetchAll();
    // var_dump($checkout_details);
    // $cust_id = $checkout_details[0]['cust_id'];
    if (isset($checkout_details[0]['cust_id'])) {
        // echo '<script>alert("hi")</script>';
        $cust_id = $checkout_details[0]['cust_id'];
        $new_or_id = "INSERT INTO `orders`(`cust_id`) VALUES ($cust_id)";
        $conn->exec($new_or_id);

        $order_id = $conn->lastInsertId();

        foreach ($checkout_details as $co_detail) {

            $product_id = $co_detail['product_id'];
            $product_size = $co_detail['product_size'];

            $insert_order_detail = "INSERT INTO `order_details`( `product_id`, `or_id`, `shoe_size`) VALUES ($product_id, $order_id, $product_size)";
            $conn->query($insert_order_detail);
        }

        $delete_cart_sql = "DELETE FROM `cart` WHERE user_id = $user_id";
        $conn->query($delete_cart_sql);
        
    }


}


?>
<header>

    <nav>
        <a href="index.php">
            <img src="./images/Black_and_Beige_Modern_Illustration_Logo__3_-removebg-preview-removebg-preview.png" alt=""
                class="logo">
        </a>

        <div class="menu" id="menu">
            <a href="index.php" class="puttons">Home</a>
            <a href="products.php" class="puttons">products</a>
            <a href="index.php#about" class="puttons">About Us</a>
            <!-- <a href="index.php#contact" class="puttons">Contact Us</a> -->
            <a href="helpcenter.php" class="puttons">help center</a>
        </div>

            <div class="search-cart" id="search-cart">
                <div class="search">
                    <input id="searchbar" type="text" class="text" placeholder="<?php 
                        $placeholders = ['formal', 'heels', 'formal -heels', 'heels -fromal','Search'] ;
                        shuffle($placeholders);
                        echo $placeholders[0];
                    ?>">
                    <img src="./images/Vector.png" alt="" class="Vector" id="searchsubmit">
                </div>
                <div class="cart">
                    <img src="./images/Shopping Cart.png" alt="" class="ShoppingCart">
                    
                    <div class="cart-product-list hidden">
                        
                        <h2>YOUR CART</h2>
                        <?php

$cart_total_price = 0;
$user_id = 2;
if(isset($_COOKIE['user']))
        {
            $user_id = $_COOKIE['userid'];
            $conn = new PDO("mysql:host=localhost;dbname=shoes_haven", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            /////////// add to cat
            



            $show_cart = "select a.product_id, a.product_size,a.cart_id, b.product_name, b.product_description, b.price, c.Pme_name from cart a join products b using (product_id) JOIN poduct_media c using (product_id)  where a.user_id = $user_id group by a.cart_id";
            $cart_products = $conn->query($show_cart);


            echo '<div class="cart-scroll-div">';
            
            foreach ($cart_products as $products) {
                
                $cart_total_price += $products['price'];
                
                
                echo "<div class='cart-product' id='cart-product-id' price='" . $products['price'] . "'>
                <img src='assets/Products/" . $products['Pme_name'] . "' alt=''>
                <div class='cart-product-info'>
                <div class='cart-product-name'>" . $products['product_name'] . " </div>
                <div>Size: " . $products['product_size'] . "</div>
                <div class='cart-product-price'>PRICE: <a> $" . $products['price'] . "</a></div>
                </div>
                <form action='' method='POST'>
                <input type='hidden' name='prod_id' value='" . $products['cart_id'] . "'>
                <div class='remove-cart-product'>&#10005;</div>
                </form>
                </div>";
            }
            
        }
        else{
            echo '<div class="cart-scroll-div">';
            foreach ($_SESSION['cart'] as $key => $products) {
                $cart_total_price += $products['price'];

                
        echo "<div class='cart-product' id='cart-product-id' price='" . $products['price'] . "'>
<img src='assets/Products/" . $products['img'] . "' alt=''>
<div class='cart-product-info'>
<div class='cart-product-name'>" . $products['name'] . " </div>
<div>Size: " . $products['size'] . "</div>
<div class='cart-product-price'>PRICE: <a> $" . $products['price'] . "</a></div>
</div>
<form action='' method='POST'>
<input type='hidden' name='prod_id' value='" . $key . "'>
<div class='remove-cart-session'>&#10005;</div>
</form>
</div>";

    }
}

                   
                    echo " </div>

<section class='checkout-total-section'>

    <div class='cart-checkout-button'>total: <span id='cart-total'>$$cart_total_price</span></div>

<form action='' method='POST'>
    <input type='hidden' name='checkout_btn' value='checkout'>
    <div class='cart-checkout-button' id='checkout-butn'>CHECKOUT</div>
</form>

</section>
";

                    echo '</div>';


                    if (isset($_POST['prod_id'])) {

                        $remove_sql = "delete FROM `cart` WHERE cart_id =" . $_POST['prod_id'];
                        $conn->query($remove_sql);
                        $page = $_SERVER['PHP_SELF'];
                        $page .= "?pid=" . $_GET['pid'];
                        header("Refresh: 1; url=$page");

                    }




                    ?>


                </div>
            </div>

            
            <?php 
        // $logged_in = false;
        if(isset($_COOKIE['user']))
        {
            $userid = $_COOKIE['userid'];
            $conn = new PDO("mysql:host=localhost;dbname=shoes_haven","root","");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
            $sql = $conn->query("SELECT first_name FROM `users` WHERE user_id=$userid");
            $user_name = $sql->fetchColumn();
            echo '<div class="UserInfo"><a href="user-information.php" class="userName">Welcome '. $user_name .'</a>
                    <div class="LogOut"><a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a></div>';
            
        }
        else {
            echo '<div class="login_signup"><a href="signup.php?active=log" class="login">login</a>
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


// try{
// } catch(Exception $e) {
//     echo 'Message: ' .$e->getMessage();
//   }

?>