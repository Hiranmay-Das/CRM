<?php
$title = "Log In - CRM";
include("meta.php");
include("connection.php");
include("php_functions.php");
$flag = TRUE;
if (isset($_POST['submit'])) {
    $_POST = sanitize($_POST);
    $query = "select email,password from `data` where email = '" . $_POST['email'] . "'";
    $result = mysqli_query($conn, $query);
    $flag = check_if_email_exists($flag, $result, $_POST['email']);
    $flag = check_if_password_match($flag, $result, $_POST['password']);
    if ($flag) {
        header("Location: dashboard.php");
    }
}
?>

<body>
    <div class="main-grid">
        <img id="index_img" src="images/tech-support.png" alt="Customer Care">
        <div class="UI-grid">
            <div class="login-heading">
                <h2>Log In</h2>
            </div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="form-grid">
                    <div class="login-label">
                        <label for="login-email">Email</label>
                    </div>
                    <div class="login-input">
                        <input type="email" name="email" id="login-email" placeholder="Enter Email"
                            value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : ''; ?>"
                            required>
                    </div>
                    <div class="login-label">
                        <label for="login-password">Password</label>
                    </div>
                    <div class="login-input">
                        <input type="password" name="password" id="login-password" placeholder="Enter Password"
                            minlength="5" maxlength="20" required>
                    </div>
                    <div class="login-pass-vis pass-vis-check">
                        <input id="pass-vis" type="checkbox" onclick="togglePasswordVisibility()">
                    </div>
                    <div class="login-pass-vis">
                        <label for="pass-vis">Show Password</label>
                    </div>
                    <div class="forgot-password">
                        <a href="#">Forgot Password?</a>
                    </div>
                    <div class="login-button">
                        <button type="submit" name="submit">SIGN IN</button>
                    </div>
                    <div class="login-create-acc">
                        Dont have an Account? <a href="registration.php">Create one now.</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

<?php include("footer.php") ?>