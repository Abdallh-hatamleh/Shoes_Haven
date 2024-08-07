<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT product_name, quantity, price FROM cart";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $total_price = 0;
    while($row = $result->fetch_assoc()) {
        $total_price += $row["quantity"] * $row["price"];
        echo "<div class='cart-item'>
                <span>{$row['product_name']}</span>
                <span>{$row['quantity']} x \${$row['price']}</span>
              </div>";
    }
    echo "<script>document.getElementById('total-price').innerText = '$' + $total_price.toFixed(2);</script>";
} else {
    echo "Your cart is empty.";
}

$conn->close();
?>
