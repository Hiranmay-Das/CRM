<?php
session_start();
include_once("meta.php");
?>

<body class="home-grid">
    <header>
        <div class="header-grid">
            <nav class="header-menu" id="header-nav-menu">
                <a class="header-link <?php echo $active == "home" ? "active" : ""; ?>" href="home.php">Home</a>
                <a class="header-link <?php echo $active == "products" ? "active" : ""; ?>"
                    href="products.php">Products</a>
                <a class="header-link <?php echo $active == "sales" ? "active" : ""; ?>" href="sales.php">Sales</a>
                <a class="header-link <?php echo $active == "clients" ? "active" : ""; ?>"
                    href="clients.php">Clients</a>
            </nav>
            <nav class="user-menu">
                <?php echo isset($_SESSION["username"]) ? htmlspecialchars($_SESSION["username"]) : "Hiranmay Das" ?>
                <span class="dropdown-bttn">
                    &#9660;
                    <div class="dropmenu">
                        <a class="dropdown-link" href="#">My Profile</a>
                        <a class="dropdown-link" href="#">--PlaceHolder--</a>
                        <a class="dropdown-link" href="logout.php">Logout</a>
                    </div>
                </span>
            </nav>
        </div>
    </header>