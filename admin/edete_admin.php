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

	// Prepare and execute the delete statement
	$stmt = $conn->prepare("DELETE FROM admin WHERE admin_id = ?");
	$stmt->bind_param("i", $admin_id);

	if ($stmt->execute()) {
		echo "success";
	} else {
		echo "error";
	}

	$stmt->close();
}
$conn->close();
?>
