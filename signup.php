<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Slab:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/Signup.css">
<div class="Login-Overlay">

    <div class="Form-container ">
        <form action="post" class="signup-form inactive" id="signup-form">
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
            <input class="form-ins" type="text" name="Email">
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
            <input type="submit" class="confirm-form" value="Sign Up" name="sign-up">
            <div class="switch-section">
                <div class="or-section">
                    <span class="or-seperator"></span>
                    <span>OR</span>
                    <span class="or-seperator"></span>  
                </div>
                <span class="alt-text">Already have an account?<a class="switch-forms" onclick="swapfocus"> Log in</a></span>
            </div>
</form>
<form action="post" class="login-form" id="login-form">
    <h2>Log in</h2>
    <div class="inputlabel">
        <label for="Email">Email</label>
        <input class="form-ins" type="text" name="Email">
    </div>
    <div class="inputlabel">
        <label for="Pass">Password</label>
        <input class="form-ins" type="password" name="Pass">
    </div>
    <input type="submit" class="confirm-form" value="Log in" name="sign-up">
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