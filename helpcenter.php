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
    <link rel="stylesheet" href="css/slider.css">
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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FFDAB9;
            color: #333;
            font-size: 18px;
        }

        .unique-box {
            width: 80%;
            margin: 100px auto 0;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 32px;
        }

        .peculiar-faq {
            margin-bottom: 80px;
            padding: 10px;
            background-color: #f5f5f5;
            border-radius: 5px;
            border-left: 5px solid black;
        }

        .peculiar-faq h2 {
            margin: 0;
            color: #FF8C00;
            font-size: 24px;
        }

        .peculiar-faq p {
            margin: 5px 0 0;
            color: #666;
            font-size: 18px;
        }

        .strange-support {
            display: flex; 
            justify-content: space-between;
            align-items: center; 
            margin-top: 30px;
            padding: 50px;
            background-color: #333;
            color: #fff;
            border-radius: 8px;
            
        }

        .strange-support h2 {
            color: #FF8C00;
            font-size: 24px;
        }

        .strange-support p {
            color: #ddd;
            font-size: 18px;
        }

        .strange-support a {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-size: 18px;
        }

        .strange-support a:hover {
            background-color: #0056b3;
        }

        .contact-weird {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            background-color: #333;
            border-radius: 8px;
        }

        .contact-weird h2 {
            color: #FF8C00;
            font-size: 24px;
        }

        .contact-weird p {
            color: #ddd;
            font-size: 18px;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <?php include_once('includes/nav.php') ?>
    
    <div class="unique-box">
        <h1>Help Center</h1>
        <?php
        // Check if there are any results
        if ($result->num_rows > 0) {
            // Output data of each row in a card
            while ($row = $result->fetch_assoc()) {
                echo "<div class='peculiar-faq'>";
                echo "<h2>" . $row["question"] . "</h2>";
                echo "<p>" . $row["answer"] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No questions found.</p>";
        }
        // Close the database connection
        $conn->close();
        ?>
        <!-- <div class="peculiar-faq">
            <h2>How do I reset my password?</h2>
            <p>If you forget your password, you can reset it by clicking on the "Forgot Password" link on the login
                page. Follow the instructions sent to your email to set a new password.</p>
        </div>

        <div class="peculiar-faq">
            <h2>How can I contact customer support?</h2>
            <p>You can contact customer support by sending an email to hepsam22@gmail.com Our team will respond to your
                inquiry as soon as possible.</p>
        </div>

        <div class="peculiar-faq">
            <h2>Where can I find product information?</h2>
            <p>Product information is available on the product pages of our website. You can also find detailed
                descriptions, specifications, and reviews for each product there.</p>
        </div> -->

        <div class="strange-support">
            <div class="contact-weird">
                <h2>Contact Us</h2>
                <p>Phone: +962 797085066 </p>
                <p>Email: hepsam22@gmail.com</p>
            </div>

            <div>
                <h2>Need more help?</h2>
                <p>If you need further assistance, please reach out to our support team.</p>
                <p>Help Center Mobile</p>
            </div>
        </div>

    </div>
    <?php include_once('includes/foot.php') ?>
</body>

</html>
