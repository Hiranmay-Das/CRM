<div class="header">
    <div class="header-grid">
        <nav class="header-menu" id="header-nav-menu">
            <a class="header-link" href="dashboard.php">Home</a>
            <a class="header-link active" href="products.php">Products</a>
            <a class="header-link" href="sales.php">Sales</a>
            <a class="header-link" href="clients.php">Clients</a>
        </nav>
        <nav class="user-menu">
            <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : "Hiranmay Das" ?>
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

</div>