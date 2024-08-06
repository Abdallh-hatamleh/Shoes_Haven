 <?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "shoes_haven";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Get the tag ID from the POST request
//     $tag_id = $_POST['tag_id'];

//     // Prepare and execute the SQL statement to delete the tag
//     $stmt = $conn->prepare("DELETE FROM tags WHERE tag_id = ?");
//     if (!$stmt) {
//         die("Error preparing statement: " . $conn->error);
//     }
//     $stmt->bind_param("i", $tag_id);

//     if ($stmt->execute()) {
//         echo "success";
//     } else {
//         echo "error: " . $stmt->error;
//     }

//     $stmt->close();
// }

// $conn->close();
?> 

