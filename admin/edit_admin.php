<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'edit_product') {
    // Retrieve form data
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $price = $_POST['price'];

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE products SET product_name=?, product_description=?, price=? WHERE product_id=?");
    $stmt->bind_param("ssdi", $product_name, $product_description, $price, $product_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    // Close the statement
    $stmt->close();
}
?>
