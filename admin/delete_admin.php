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
    $admin_id = $_GET['adid'];

    // First, delete from the admin table
    $stmt_admin = $conn->prepare("DELETE FROM admin WHERE admin_id = ?");
    $stmt_admin->bind_param("i", $admin_id);

    if ($stmt_admin->execute()) {
        // Get the user_id related to the deleted admin
        $user_id = $_POST['user_id'];

        // Then, delete from the users table
        $stmt_user = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt_user->bind_param("i", $user_id);

        if ($stmt_user->execute()) {
            header('Location: Admin.php');
            exit();
        } else {
            echo "<script>alert('Error deleting admin.');</script>";
        }
        $stmt_user->close();
    } else {
        echo "error";
    }
    $stmt_admin->close();
    $conn->close();
}
?>
