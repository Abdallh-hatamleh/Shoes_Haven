<?php
include_once("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == 'add_tag') {
        $tag_name = $_POST['tag_name'];
        $sale_amount = $_POST['sale_amount'];
        $featured = $_POST['featured'];

        // Check if the tag already exists
        $stmt = $conn->prepare("SELECT * FROM Tags WHERE tag_name = ?");
        $stmt->bind_param("s", $tag_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message = "Error: Tag already exists.";
        } else {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO Tags (tag_name, sale_amount, featured) VALUES (?, ?, ?)");
            $stmt->bind_param("sdi", $tag_name, $sale_amount, $featured);

            if ($stmt->execute()) {
                $message = "New tag added successfully";
            } else {
                $message = "Error: " . $stmt->error;
            }
        }

        $stmt->close();

        // Redirect to the same page to avoid form resubmission
        header("Location: " . $_SERVER['PHP_SELF'] . "?message=" . urlencode($message));
        exit();
    }

    if (isset($_POST['action']) && $_POST['action'] == 'edit_tag') {
        $tag_id = $_POST['tag_id'];
        $tag_name = $_POST['tag_name'];
        $sale_amount = $_POST['sale_amount'];
        $featured = $_POST['featured'];

        $stmt = $conn->prepare("UPDATE Tags SET tag_name=?, sale_amount=?, featured=? WHERE tag_id=?");
        $stmt->bind_param("sdii", $tag_name, $sale_amount, $featured, $tag_id);

        if ($stmt->execute()) {
            $message = "Tag updated successfully";
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();

        // Redirect to the same page to avoid form resubmission
        header("Location: " . $_SERVER['PHP_SELF'] . "?message=" . urlencode($message));
        exit();
    }
}
?>
?>
