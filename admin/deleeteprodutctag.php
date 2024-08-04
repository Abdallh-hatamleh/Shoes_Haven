<?php
include_once("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_id']) && isset($_POST['tag_id'])) {
        $product_id = $_POST['prod_id'];
        $tag_id = $_POST['tag_id'];

        $stmt = $conn->prepare("DELETE FROM product_tags WHERE product_id = ? AND tag_id = ?");
        $stmt->bind_param("ii", $product_id, $tag_id);
        
        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'failure';
        }
        $stmt->close();
    }
}

?>