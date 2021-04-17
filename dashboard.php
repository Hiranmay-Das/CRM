<?php
$title = "Dashboard - CRM";
session_start();
include("meta.php");
?>

<body class="home-grid">
    <header>
        <div class="header-grid">
            <nav class="header-menu" id="header-nav-menu">
                <a class="header-link" href="dashboard.php">Home</a>
                <a class="header-link" href="products.php">Products</a>
                <a class="header-link" href="sales.php">Sales</a>
                <a class="header-link" href="clients.php">Clients</a>
            </nav>
            <nav class="user-menu">
                <?php echo isset($_SESSION["username"]) ? htmlspecialchars($_SESSION["username"]) : "Hiranmay Das" ?>
                <span class="dropdown-bttn">
                    &#9660;
                    <div class="dropmenu">
                        <a class="dropdown-link" href="#">My Profile</a>
                        <a class="dropdown-link" href="#">--PlaceHolder--</a>
                        <a class="dropdown-link" href="#">Logout</a>
                    </div>
                </span>
            </nav>
        </div>
    </header>
    <?php include("home.php") ?>
    <footer>
        <div class="footer">
            <div class="creator-name">
                CRM Website created by Hiranmay Das, Gaurav Haldar and Imon --Surname--.
            </div>
            <nav class="footer-menu">
                <a class="footer-link" href="#" onclick="alert('Just For Show')">Home</a>
                <a class="footer-link" href="#" onclick="alert('Just For Show')">About Us</a>
                <a class="footer-link" href="#" onclick="alert('Just For Show')">Contact</a>
            </nav>
        </div>
    </footer>
</body>

</html>