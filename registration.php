<?php
$title = "Registration - CRM";
include("meta.php");
include("connection.php");
include("php_functions.php");
$flag = TRUE;

if (isset($_POST['submit'])) {
    $_POST = sanitize($_POST);
    $flag = check_email($flag, $_POST['email']);
    $flag = check_password($flag, $_POST['password']);
    $flag = verify_password($flag, $_POST['password'], $_POST['confirm-password']);
    $flag = check_if_duplicate_email($flag, $conn, $_POST['email']);
    if ($flag) {
        insert_into_database($conn, $_POST);
        header("Location: index.php");
    }
}
?>

<body>
    <div class="main-grid">
        <img id="index_img" src="images/24-7 customer care.png" alt="Customer Care">
        <div class="UI-grid">
            <div class="register-heading">
                <h2>Register Account</h2>
            </div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="form-grid">
                    <div class="register-label">
                        <label for="register-name">Name</label>
                    </div>
                    <div class="register-input">
                        <input type="text" name="name" id="register-name" placeholder="Enter Name"
                            value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES) : ''; ?>"
                            required>
                    </div>
                    <div class="register-label">
                        <label for="register-email">Email</label>
                    </div>
                    <div class="register-input">
                        <input type="email" name="email" id="register-email" placeholder="Enter Email"
                            value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : ''; ?>"
                            required>
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
                    <div class="register-label">
                        <label for="register-contact">Contact Number</label>
                    </div>
                    <div class="register-input">
                        <input type="text" name="contact_no" id="register-contact" placeholder="Enter Phone Number"
                            value="<?php echo isset($_POST['contact_no']) ? htmlspecialchars($_POST['contact_no'], ENT_QUOTES) : ''; ?>"
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
<?php
include("footer.php");
?>