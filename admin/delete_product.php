<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoes_haven";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $product_id = $_GET['adid'];

    // Delete the product from the products table
    $stmt_product = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt_product->bind_param("i", $product_id);

    if ($stmt_product->execute()) {
        header('Location: Products.php');
        exit();
    } else {
        echo "Error deleting product: " . $stmt_product->error;
    }

    $stmt_product->close();
}

$conn->close();
?>
