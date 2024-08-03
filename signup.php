<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Slab:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/Signup.css">
<div class="Login-Overlay">
<?php 
$conn = new PDO("mysql:host=localhost;dbname=shoes_haven","root","");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(isset($_POST["signup"])) {
    $em = $_POST['Email'];
    $query = $conn->prepare("select user_email from users where user_email=:emr");
    $query->execute(["emr"=> $em]);
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    if(count($result) > 0) {
        echo "<script>alert('Email in use')</script>";
    }
    else {

    }
}
$active = "log";
if(isset($_GET['active']))
{
    $active = $_GET['active'];
}

?>
    <div class="Form-container ">
        <form method="post" action="" class="signup-form <?php if($active != "sign") echo "inactive" ?>" id="signup-form">
            <h2>Sign Up</h2>
            <div class="inputRow">
            <div class="inputlabel">
            <label for="Fname">First Name</label>
            <input class="form-ins" type="text" name="Fname">
            </div>
            <div class="inputlabel">
            <label for="Lname">Last Name</label>
            <input class="form-ins" type="text" name="Lname">
            </div>
            </div>
            <div class="inputlabel">
            <label for="Email">Email</label>
            <input class="form-ins" type="email" name="Email">
            </div>
            <div class="inputlabel">
            <label for="Pass">Password</label>
            <input class="form-ins" type="password" name="Pass">
            </div>
            <div class="inputlabel">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-ins" name="Number">
            </div>
            <div class="inputlabel">
                <label for="Address">Address</label>
                <input type="text" class="form-ins" name="Address">
            </div>
            <input type="submit" class="confirm-form" value="Sign Up" name="signup">
            <div class="switch-section">
                <div class="or-section">
                    <span class="or-seperator"></span>
                    <span>OR</span>
                    <span class="or-seperator"></span>  
                </div>
                <span class="alt-text">Already have an account?<a class="switch-forms" onclick="swapfocus"> Log in</a></span>
            </div>
</form>
<form method="post" action="" class="login-form <?php if($active != "log") echo "inactive" ?>" id="login-form">
    <h2>Log in</h2>
    <div class="inputlabel">
        <label for="Email">Email</label>
        <input class="form-ins" type="text" name="Email">
    </div>
    <div class="inputlabel">
        <label for="Pass">Password</label>
        <input class="form-ins" type="password" name="Pass">
    </div>
    <input type="submit" class="confirm-form" value="Log in" name="log-in">
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
<script src="JS/login.js">
    </script>


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
    $password = password_hash($_POST['Pass'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (first_name, last_name, user_email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    // echo "<script>alert('hi')</script>";
    $sql = "select user_id from users order by user_id desc";
    $query = $conn->query($sql);
    $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
    $idk = $results[0]["user_id"];
    echo "<script>alert('$idk')</script>";
    $conn->close();
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

if (isset($_POST["log-in"])) {
    $email = $_POST['Email'];
    $password = $_POST['Pass'];

    $sql = "SELECT user_id, password FROM users WHERE user_email='$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row["user_id"];
        if (password_verify($password, $row['password'])) {
            $sql = "SELECT admin_id FROM `admin` WHERE user_id= $id";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0){
                $row = $result->fetch_assoc();    
            header('Location: admin/Admin.php');
            }else{
                $sql = "SELECT cust_id FROM `Customers` WHERE user_id= $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0){
                $row = $result->fetch_assoc();
                echo "<script>alert('customers".$row["cust_id"] . "')</script>";
        
            }else{
                $sql = "SELECT sel_id FROM `Sellers ` WHERE user_id= $id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0){
                $row = $result->fetch_assoc();
                echo "<script>alert(' sellers".$row["sel_id"] . "')</script>";
        
            }
            }
        }

        } else {
            echo "<script>alert('Wrong Email or Password')</script>";
        }
    } else {
        echo "No user found with this email";
    }

    $conn->close();
}
?>

