<?php
include_once("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'edit_tag') {
    $tag_id = $_POST['tag_id'];
    $tag_name = $_POST['tag_name'];
    $sale_amount = $_POST['sale_amount'];
    $featured = $_POST['featured'];

    $stmt = $conn->prepare("UPDATE tags SET tag_name = ?, sale_amount = ?, featured = ? WHERE tag_id = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("sdii", $tag_name, $sale_amount, $featured, $tag_id);

    if ($stmt->execute()) {
        $message = "Tag updated successfully";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();

}
?>
