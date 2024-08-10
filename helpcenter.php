<?php
// Database connection settings
$servername = "localhost"; // Replace with your server name
$username = "root";        // Replace with your database username
$password = "";            // Replace with your database password
$dbname = "shoes_haven";   // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select 5 questions
$sql = "SELECT question, answer FROM customer_questions LIMIT 5";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Center</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/ssllider.css">
    <link rel="stylesheet" href="css/testimonials.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/styles.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Jockey+One&family=Jomhuria&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/cart-products-section.css">
    <style>
        .qcard {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 15px;
            padding: 20px;
            width: 80%;
            max-width: 600px;
        }

        .question {
            font-weight: bold;
            color: #007bff;
            /* Blue color for questions */
            margin-bottom: 10px;
        }

        .answer {
            margin-bottom: 10px;
        }

        .heder {
            margin-bottom: 30px;
        }

        .container1 {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <?php include_once ('includes/nav.php') ?>
    <div class="container1">
        <h1 class="heder">Customer Questions and Answers</h1>
        <?php
        // Check if there are any results
        if ($result->num_rows > 0) {
            // Output data of each row in a card
            while ($row = $result->fetch_assoc()) {
                echo "<div class='qcard'>";
                echo "<div class='question'>" . $row["question"] . "</div>";
                echo "<div class='answer'>" . $row["answer"] . "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No questions found.</p>";
        }
        // Close the database connection
        $conn->close();
        ?>
    </div>
    <?php include_once ('includes/foot.php') ?>
</body>

</html>