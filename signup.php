
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Slab:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/Signupz.css">
    <link rel="stylesheet" href="css/nav.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="css/cart-products-section.css">
    <?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // var_dump($_POST);
}
include_once("Includes/nav.php");
?>
<div class="Login-Overlay">
    
    <div class="Form-container ">
        <form method="post" action="" class="signup-form <?php if(!isset($_GET['active']) || $_GET['active'] != 'sign') echo 'inactive'?>" id="signup-form">
            <h2>Sign Up</h2>
            <div class="inputRow">
                <div class="inputlabel">
                    <label for="Fname">First Name</label>
            <input class="form-ins" type="text" name="Fname" id="firstName-input-sign-up" required>
            <p id="fname-error" class="error"></p>
            </div>
            <div class="inputlabel">
                <label for="Lname">Last Name</label>
                <input class="form-ins" type="text" name="Lname" id="lastName-input-sign-up" required>
                <p id="lname-error" class="error"></p>
            </div>
            </div>
            <div class="inputlabel">
            <label for="Email">Email</label>
            <input class="form-ins" type="text" name="Email" id="email-input-sign-up" required>
            <p id="email-error" class="error"></p>
        </div>
        <div class="inputlabel">
                <label for="Pass">Password</label>
                <input class="form-ins" type="password" name="Pass" id="password-input-sign-up" required>
                <p id="password-error" class="error"></p>
            </div>
            <div class="inputlabel">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-ins" name="Number" required>
            </div>
            <div class="inputlabel">
                <label for="Address">Address</label>
                <input type="text" class="form-ins" name="Address" required>
            </div>
            <input type="hidden" name="signup" value="1">
            <div class="inputlabel">
                <input type="submit" class="confirm-form" value="Sign Up" >
            </div>
            <div class="switch-section">
                <!-- <div class="or-section">
                    <span class="or-seperator"></span>
                    <span>OR</span>
                    <span class="or-seperator"></span>  
                </div> -->
                <span class="alt-text">Already have an account?<a class="switch-forms" onclick="swapfocus"> Log in</a></span>
            </div>
</form>
<form method="post" action="" class="login-form <?php if(isset($_GET['active']) && $_GET['active'] == 'sign') echo 'inactive' ?>" id="login-form">
    <h2>Log in</h2>
    <div class="inputlabel">
        <label for="Email">Email</label>
        <input class="form-ins" type="text" name="Email" required>
    </div>
    <div class="inputlabel">
        <label for="Pass">Password</label>
        <input class="form-ins" type="password" name="Pass" required>
    </div>
    <input type="submit" class="confirm-form" value="Log in" name="login">
    <div class="switch-section">
        <div class="or-section">
            <span class="or-seperator"></span>
            <span>OR</span>
            <span class="or-seperator"></span>  
        </div>
        <span class="alt-text">Don't have an account?<a class="switch-forms"> Sign up</a></span>
    </div>
</form>

<div class="form-visual">
<img src="assets/nike-air-force.webp" alt="">
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="JS/login.js">
</script>
<?php
include_once("Includes/foot.php");
?>
</body>
</html>

<!-- <link rel="stylesheet" href="css/sstyleess.css"> -->


<!-- login&signup -->

<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "Shoes_Haven"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["signup"])) {
    
    // echo "<script>alert('hi')</script>";
    $first_name = $_POST['Fname'];
    $last_name = $_POST['Lname'];
    $email = $_POST['Email'];
    $phone = $_POST['Number'];
    $address = $_POST['Address'];
    $password = password_hash($_POST['Pass'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (first_name, last_name, user_email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        $sql = "select user_id from users order by user_id desc";
        $query = $conn->query($sql);
        $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
        $idk = $results[0]["user_id"];
        $sql = "insert into customers (user_id,cust_mobile, cust_adress) values ($idk,$phone,'$address')";
        $conn->query($sql);
        echo "<script>alert('$sql')</script>";        

        $conn->close();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    // echo "<script>alert('hi')</script>";
}
?>

<?php

$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "Shoes_Haven"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
            if ($row['admin'] == 1) {
                // User is an admin
                setcookie('user', 'admin', time() + 86400, '/');
                setcookie('userid', "$id", time() + 86400, '/');
                header('Location: admin/Admin.php');
            } else {
                // User is a customer
                setcookie('user', 'customer', time() + 86400, '/');
                setcookie('userid', "$id", time() + 86400, '/');
                header('Location: index.php');
            }
            exit(); // Always call exit after header redirect
        } else {
            echo "<script>alert('Wrong Email or Password');</script>";
        }
    } else {
        echo "<script>alert('Wrong Email or Password');</script>";
    }
}
    $conn->close();

?>

