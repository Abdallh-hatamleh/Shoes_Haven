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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$admin_id = $_POST['admin_id'];

	// First, delete the admin record
	$stmt = $conn->prepare("DELETE FROM admin WHERE admin_id = ?");
	$stmt->bind_param("i", $admin_id);

	if ($stmt->execute()) {
		// Then, delete the associated user record
		$stmt_user = $conn->prepare("DELETE FROM `users` WHERE  user_id = (SELECT user_id FROM admin WHERE admin_id = ?)");
		$stmt_user->bind_param("i", $admin_id);
		if ($stmt_user->execute()) {
			echo "success";
		} else {
			echo "error";
		}
	} else {
		echo "error";
	}

	$stmt->close();
	$stmt_user->close();
}
$conn->close();
?>
