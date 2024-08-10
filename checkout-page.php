<?php
$conn = new PDO("mysql:host=localhost;dbname=shoes_haven", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$user_id = 2;
if (isset($_COOKIE['user']) && $_COOKIE['user'] == 'customer') {
    $user_id = isset($_COOKIE['userid']) ? $_COOKIE['userid'] : $user_id;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm_order'])) {
        $order_id = intval($_POST['order_id']);
        $update_order = $conn->prepare("UPDATE orders SET status = 'confirmed' WHERE or_id = :order_id");
        $update_order->execute(['order_id' => $order_id]);
        header("Location: order_details.php?order_id=$order_id&status=confirmed");
        exit;
    }

    if (isset($_POST['delete_order'])) {
        $order_id = intval($_POST['order_id']);
        $delete_order = $conn->prepare("DELETE FROM orders WHERE or_id = :order_id");
        $delete_order->execute(['order_id' => $order_id]);
        header("Location: orders_list.php?status=deleted");
        exit;
    }

    if (isset($_POST['delete_product'])) {
        $order_id = intval($_POST['order_id']);
        $product_id = intval($_POST['product_id']);
        $delete_product = $conn->prepare("DELETE FROM order_details WHERE or_id = :order_id AND product_id = :product_id");
        $delete_product->execute(['order_id' => $order_id, 'product_id' => $product_id]);

        header("Location: order_details.php?order_id=$order_id&status=product_deleted");
        exit;
    }
}

$sql = $conn->prepare("SELECT users.*, customers.cust_mobile, customers.cust_adress FROM users 
                       JOIN customers ON users.user_id = customers.user_id 
                       WHERE users.user_id = :idr");
$sql->execute(["idr" => $user_id]);

$result = $sql->fetch();
$first_name = $result['first_name'];
$last_name = $result['last_name'];
$user_pass = $result['password'];
$user_email = $result['user_email'];
$cust_mobile = $result['cust_mobile'];
$cust_address = $result['cust_adress'];

$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="checkout.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/foter.css">
    <link rel="stylesheet" href="css/cart-products-section.css">
    <title>Order Details</title>
    <style>
        .order-action-buttons {
            display: flex;
            gap: 10px;
        }

        .confirm-order-button, .delete-order-button {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .confirm-order-button {
            background-color: #4CAF50;
            color: white;
        }

        .delete-order-button {
            background-color: #f44336;
            color: white;
        }

        .delete-product-button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
     <?php include_once("includes/nav.php") ?>
    <div class="user-info-show-unique">
        <h2 class="section-title-unique">Your Information</h2>
        <p>Name: <?php echo $first_name . ' ' . $last_name; ?></p>
        <p>Email: <?php echo $user_email; ?></p>
        <p>Mobile: <?php echo $cust_mobile; ?></p>
        <p>Address: <?php echo $cust_address; ?></p>
    </div>

    <div class="user-info-show-unique">
        <h1 class="orders_h1-unique">Order Details</h1>

        <div class="user-orders-list-unique">
            <?php
            if ($order_id) {
                $order_card = $conn->prepare("SELECT customers.*, users.*, orders.* FROM customers 
                                              LEFT JOIN users USING (user_id) 
                                              JOIN orders USING (cust_id) 
                                              WHERE users.user_id = :idr AND orders.or_id = :order_id");
                $order_card->execute(["idr" => $user_id, "order_id" => $order_id]);
                $order = $order_card->fetch();

                if ($order) {
                    $order_details_list = $conn->prepare("SELECT orders.*, order_details.*, products.*, poduct_media.*, 
                                                          (products.price) as totalPerProduct 
                                                          FROM orders 
                                                          JOIN order_details USING (or_id) 
                                                          JOIN products USING (product_id) 
                                                          JOIN poduct_media USING (product_id) 
                                                          WHERE orders.or_id = :order_id");
                    $order_details_list->execute(["order_id" => $order_id]);
                    $order_product_count = $order_details_list->fetchAll();

                    $total_card_price = 0;
                    foreach ($order_product_count as $prices) {
                        $total_card_price += $prices['totalPerProduct'];
                    }

                    echo "<div class='user-order-card-unique'>";
                    echo "<a class='order-number-unique'>#" . $order['or_id'] . "</a>";
                    echo "<a class='order-total-unique'>$$total_card_price</a>";
                    echo "<a class='order-date-unique'>" . $order['or_date'] . "</a>";
                    echo "</div>";

                    echo "<div class='order-expanded-list-unique'>";
                    echo "<div class='cart-scroll-div-unique'>";

                    foreach ($order_product_count as $order_list) {
                        echo "<div class='cart-product-unique'>";
                        echo "<img src='assets/Products/" . $order_list['Pme_name'] . "' alt=''>";
                        echo "<div class='cart-product-info-unique'>";
                        echo "<div class='cart-product-name-unique'>" . $order_list['product_name'] . "</div>";
                        echo "<div>" . $order_list['product_description'] . "</div>";
                        echo "<div class='cart-product-price-unique'>PRICE: <a> $" . $order_list['price'] . " </a></div>";
                        echo "</div>";
                        echo "<form method='POST' style='display:inline;'>";
                        echo "<input type='hidden' name='order_id' value='$order_id'>";
                        echo "<input type='hidden' name='product_id' value='" . $order_list['product_id'] . "'>";
                        echo "<button type='submit' name='delete_product' class='delete-product-button'>Delete Product</button>";
                        echo "</form>";
                        echo "</div>";
                    }

                    echo "</div>";
                    echo "</div>";

                    echo "<div class='order-action-buttons'>";
                    echo "<form method='POST'>";
                    echo "<input type='hidden' name='order_id' value='$order_id'>";
                    echo "<button type='submit' name='confirm_order' class='confirm-order-button'>Confirm Order</button>";
                    echo "<button type='submit' name='delete_order' class='delete-order-button'>Delete Order</button>";
                    echo "</form>";
                    echo "</div>";
                } else {
                    echo "<p>No order found.</p>";
                }
            } else {
                echo "<p>No order selected.</p>";
            }
            ?>
        </div>
    </div>
    <?php include_once("includes/foot.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="JS/user-information.js"></script>
</body>
</html>
