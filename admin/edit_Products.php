<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'edit_product') {
	$product_name = $_POST['product_name'];
	$product_description = $_POST['product_description'];
	$user_password = $_POST['price'];

	$stmt = $conn->prepare("UPDATE users SET product_name=?, product_description=?, price=? WHERE product_name=?");
	$stmt->bind_param("ssssi", $product_name, $product_description, $user_password);

	if ($stmt->execute()) {
		echo "success";
	} else {
		echo "error";
	}

	$stmt->close();
}
?>
