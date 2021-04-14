<?php
$title = "Registration - CRM";
include("header.php");
?>

<body>
    <div class="main-grid">
        <img id="index_img" src="images/24-7 customer care.png" alt="Customer Care">
        <div class="UI-grid">
            <div class="register-heading">
                <h2>Register Account</h2>
            </div>
            <form method="post" action="register.php">
                <div class="form-grid">
                    <div class="register-label">
                        <label for="register-name">Name</label>
                    </div>
                    <div class="register-input">
                        <input type="text" name="name" id="register-name" placeholder="Enter Name" required>
                    </div>
                    <div class="register-label">
                        <label for="register-email">Email</label>
                    </div>
                    <div class="register-input">
                        <input type="email" name="email" id="register-email" placeholder="Enter Email" required>
                    </div>
                    <div class="register-label">
                        <label for="register-password">Password</label>
                    </div>
                    <div class="register-input">
                        <input type="password" name="password" id="register-password" placeholder="Enter Password"
                            minlength="5" maxlength="20" required>
                    </div>
                    <div class="register-label">
                        <label for="confirm-password">Confirm Password</label>
                    </div>
                    <div class="register-input">
                        <input type="password" name="confirm-password" id="confirm-password"
                            placeholder="Enter Password" minlength="5" maxlength="20" required>
                    </div>
                    <!-- <div class="register-pass-vis pass-vis-check">
                        <input id="pass-vis" type="checkbox" onclick="togglePasswordVisibility()">
                    </div>
                    <div class="register-pass-vis">
                        <label for="pass-vis">Show Password</label>
                    </div> -->
                    <div class="register-label">
                        <label for="register-contact">Contact Number</label>
                    </div>
                    <div class="register-input">
                        <input type="text" name="contact_no" id="register-contact" placeholder="Enter Phone Number"
                            required>
                    </div>
                    <div class="register-button">
                        <button name="submit" type="submit">SIGN UP</button>
                    </div>
                    <div class="register-have-acc">
                        Already have an Account? <a href="index.php">Sign in here.</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
<?php include("footer.php") ?>