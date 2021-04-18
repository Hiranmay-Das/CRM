<?php
$title = "Clients - CRM";
$active = "clients";
include("meta.php");
include("header.php");
include("php_functions.php");
if (isset($_POST['delete-info'])) {
    if (!isset($_POST['cust_id']) or $_POST['cust_id'] == "new") {
        alert("Please select a Valid Client.");
    } else {
        delete_user($_POST['cust_id']);
        unset($_POST['cust_id']);
        alert("Sucessfully deleted client.");
    }
}
if (isset($_POST['save-info'])) {
    if (!isset($_POST['cust_id']) or $_POST['cust_id'] == "new") {
        add_customer($_POST['name'], $_POST['email'], $_POST['address'], $_POST['contact_no'], $_POST['status']);
        alert("Client added Sucessfully.");
    } else {
        update_customer($_POST['name'], $_POST['email'], $_POST['address'], $_POST['contact_no'], $_POST['status'], $_POST['cust_id']);
        alert("Client Data updated sucessfully");
    }
}
?>

<main class="main-container">
    <div class="content-container">
        <h2>
            Products
        </h2>
        <a class="home-links left-side">
            <span class="counts"><?php echo mysqli_num_rows(get_all_products()); ?></span> Total Products
        </a>
        <a class="home-links left-side">
            <span class="counts"><?php echo mysqli_num_rows(get_companies()); ?></span> Companies
        </a>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" id="request_info">
            <select name="p_id" class="home-links left-side">
                <option value="new" selected>Add New Product</option>
                <option disabled>──────────</option>
                <?php
                $result = get_all_products();
                while ($fetch = mysqli_fetch_object($result)) {
                ?>
                <option value=<?php echo $fetch->p_id ?>><?php echo $fetch->name ?></option>
                <?php } ?>
            </select>
        </form>
        <button type="submit" name="show-info" form="request_info" class="home-links left-side invoice-card"
            id="show-prod-info">
            Show Product Info
        </button>
        <div class="product-container">
            <h2>Product Information</h2>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" id="send-info">
                <label for="prod-name">Name</label>
                <input name="name" id="prod-name" type="text" value="<?php echo get_cust_name($_POST); ?>" required>
                <label for="prod-provider">Provider</label>
                <input name="provider" id="prod-provider" type="text" value="<?php echo get_cust_email($_POST); ?>"
                    required>
                <label for="cust-contact">Contact Info</label>
                <input name="contact_no" id="cust-contact" type="text" value="<?php echo get_cust_contact($_POST); ?>"
                    required>
                <label for="cust-address">Address</label>
                <input name="address" id="cust-address" type="text" value="<?php echo get_cust_address($_POST); ?>"
                    required>
                <label for="cust-status">Status</label>
                <select name="status" id="cust-status">
                    <option value="active" <?php echo get_cust_status($_POST) == "active" ? "selected" : "" ?>>ACTIVE
                    </option>
                    <option value="potential" <?php echo get_cust_status($_POST) == "potential" ? "selected" : "" ?>>
                        POTENTIAL</option>
                </select>
                <input type="hidden" name="cust_id"
                    value="<?php echo isset($_POST['cust_id']) ? $_POST['cust_id'] : "new"; ?>">
            </form>
        </div>
        <button type="submit" name="delete-info" form="send-info" class="home-links right-side" id="delete-cust-info">
            Delete Product
        </button>
        <button type="submit" name="save-info" form="send-info" class="home-links right-side" id="save-cust-info">
            Save Product Info
        </button>
    </div>

</main>

<?php
include("footer.php");
?>