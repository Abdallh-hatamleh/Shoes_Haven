<?php
include_once("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'add_tag') {
    $tag_name = $_POST['tag_name'];
    $sale_amount = $_POST['sale_amount'];
    $featured = $_POST['featured'];

    // Check if the tag already exists
    $stmt = $conn->prepare("SELECT * FROM tags WHERE tag_name = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("s", $tag_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $message = "Error: Tag already exists.";
    } else {
        $stmt = $conn->prepare("INSERT INTO tags (tag_name, sale_amount, featured) VALUES (?, ?, ?)");
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("sdi", $tag_name, $sale_amount, $featured);

        if ($stmt->execute()) {
            $message = "New tag added successfully";
        } else {
            $message = "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}
?>
	

	