<?php
// Connect to the database
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "Shoes_Haven"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Signup
if (isset($_POST["signup"])) {
    $first_name = $_POST['Fname'];
    $last_name = $_POST['Lname'];
    $email = $_POST['Email'];
    $phone = $_POST['Number'];
    $address = $_POST['Address'];
    $password = password_hash($_POST['Pass'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (first_name, last_name, user_email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        $sql = "SELECT user_id FROM users ORDER BY user_id DESC LIMIT 1";
        $query = $conn->query($sql);
        $results = mysqli_fetch_assoc($query);
        $idk = $results["user_id"];
        $sql = "INSERT INTO customers (user_id, cust_mobile, cust_adress) VALUES ($idk, '$phone', '$address')";
        $conn->query($sql);
        echo "<script>alert('Signup successful!');</script>";        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle Login
if (isset($_POST["login"])) {
    $email = $_POST['Email'];
    $password = $_POST['Pass'];
    
    // Secure the query by using prepared statements
    $stmt = $conn->prepare("SELECT user_id, password, admin FROM users WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row["user_id"];
        
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Set cookies and redirect based on user type
            if ($row['admin'] == 1) {
                setcookie('user', 'admin', time() + 86400, '/');
                setcookie('userid', "$id", time() + 86400, '/');
                header('Location: admin/Admin.php');
            } else {
                setcookie('user', 'customer', time() + 86400, '/');
                setcookie('userid', "$id", time() + 86400, '/');
                header('Location: index.php');
            }
            exit(); // Always call exit after header redirect
        } else {
            $errorMessage = "Wrong Email or Password";
        }
    } else {
        $errorMessage = "Wrong Email or Password";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/Signupz.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/cart-products-section.css">
</head>
<body>
<?php include_once("Includes/nav.php"); ?>
<div class="Login-Overlay">
    <div class="Form-container">
        <!-- Signup Form -->
        <form method="post" action="" class="signup-form <?php if(!isset($_GET['active']) || $_GET['active'] != 'sign') echo 'inactive'?>" id="signup-form">
            <h2>Sign Up</h2>
            <input type="text" name="Fname" placeholder="First Name" required>
            <input type="text" name="Lname" placeholder="Last Name" required>
            <input type="text" name="Email" placeholder="Email" required>
            <input type="password" name="Pass" placeholder="Password" required>
            <input type="text" name="Number" placeholder="Phone Number" required>
            <input type="text" name="Address" placeholder="Address" required>
            <input type="hidden" name="signup" value="1">
            <input type="submit" value="Sign Up">
            <span>Already have an account? <a href="#" onclick="swapfocus()">Log in</a></span>
        </form>

        <!-- Login Form -->
        <form method="post" action="" class="login-form <?php if(isset($_GET['active']) && $_GET['active'] == 'sign') echo 'inactive' ?>" id="login-form">
            <h2>Log in</h2>
            <input type="text" name="Email" placeholder="Email" required>
            <input type="password" name="Pass" placeholder="Password" required>
            <input type="submit" value="Log in" name="login">
            <span>Don't have an account? <a href="#" onclick="swapfocus()">Sign up</a></span>
        </form>
    </div>
</div>

<script src="JS/login.js"></script>
<?php include_once("Includes/foot.php"); ?>
</body>
</html>
