<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoes_haven";


$conn = new mysqli($servername, $username, $password, $dbname);

// if (isset($_COOKIE['tagid'])) {
//     $tag_id = $_COOKIE['tagid'];
//     echo "Tag ID from cookie: " . htmlspecialchars($tag_id);
// } else {
//     echo "Tag ID cookie is not set.";
// }

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_tag_prod') {
    $product_id = $_POST['product_id'];
    $tag_id = $_GET['tagid']; 


    if ($product_id && $tag_id) {
        $sql = "INSERT INTO product_tags (product_id, tag_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $product_id, $tag_id);

        if ($stmt->execute()) {
            $message = "Product successfully added to tag!";
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "Invalid input. Please check the fields.";
    }
}


$conn->close();
?>


