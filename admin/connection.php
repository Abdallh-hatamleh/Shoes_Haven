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

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['action']) && $_POST['action'] == 'add_admin') {
		$first_name = $_POST['firstName'];
		$last_name = $_POST['lastName'];
		$user_email = $_POST['username'];
		$user_password = $_POST['user_password'];

		// Check if the email already exists
		$stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ?");
		$stmt->bind_param("s", $user_email);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			$message = "Error: Email already exists.";
		} else {
			// Prepare and bind
			$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, user_email, password) VALUES (?, ?, ?, ?)");
			$stmt->bind_param("ssss", $first_name, $last_name, $user_email, $user_password);

			if ($stmt->execute()) {
				$user_id = $stmt->insert_id; // Get the last inserted ID

				// Insert into admin table
				$stmt_admin = $conn->prepare("INSERT INTO admin (user_id) VALUES (?)");
				$stmt_admin->bind_param("i", $user_id);
				$stmt_admin->execute();
				$message = "New admin added successfully";
			} else {
				$message = "Error: " . $stmt->error;
			}
		}

		$stmt->close();

		// Redirect to the same page to avoid form resubmission
		header("Location: " . $_SERVER['PHP_SELF'] . "?message=" . urlencode($message));
		exit();
	}
	

	if (isset($_POST['action']) && $_POST['action'] == 'edit_admin') {
		$admin_id = $_POST['admin_id'];
		$first_name = $_POST['firstName'];
		$last_name = $_POST['lastName'];
		$user_email = $_POST['username'];
		$user_password = $_POST['user_password'];

		$stmt = $conn->prepare("UPDATE users SET first_name=?, last_name=?, user_email=?, password=? WHERE user_id=?");
		$stmt->bind_param("ssssi", $first_name, $last_name, $user_email, $user_password, $admin_id);

		if ($stmt->execute()) {
			echo "success";
		} else {
			echo "error";
		}

		$stmt->close();
	}
}
?>
