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
            Clients
        </h2>
        <a class="home-links left-side">
            <span class="counts"><?php echo mysqli_num_rows(get_active_customers()); ?></span> Active Customers
        </a>
        <a class="home-links left-side">
            <span class="counts"><?php echo mysqli_num_rows(get_potential_customers()); ?></span> Potential Customers
        </a>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" id="request_info">
            <select name="cust_id" class="home-links left-side">
                <option value="new" selected>Add New Customer</option>
                <option disabled>──────────</option>
                <option disabled>--Active Customers--</option>
                <?php
                $result = get_active_customers();
                while ($fetch = mysqli_fetch_object($result)) {
                ?>
                <option value=<?php echo $fetch->c_id ?>><?php echo $fetch->name ?></option>
                <?php } ?>
                <option disabled>──────────</option>
                <option disabled>--Potential Customers--</option>
                <?php
                $result = get_potential_customers();
                while ($fetch = mysqli_fetch_object($result)) {
                ?>
                <option value=<?php echo $fetch->c_id ?>><?php echo $fetch->name ?></option>
                <?php } ?>
                <option disabled>──────────</option>
            </select>
        </form>
        <button type="submit" name="show-info" form="request_info" class="home-links left-side invoice-card"
            id="show-cust-info">
            Show Customer Info
        </button>
        <div class="clients-container">
            <h2>Customer Information</h2>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" id="send-info">
                <label for="cust-name">Name</label>
                <input name="name" id="cust-name" type="text" value="<?php echo get_cust_name($_POST); ?>" required>
                <label for="cust-email">Email</label>
                <input name="email" id="cust-email" type="email" value="<?php echo get_cust_email($_POST); ?>" required>
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
            Delete Account
        </button>
        <button type="submit" name="save-info" form="send-info" class="home-links right-side" id="save-cust-info">
            Save Info
        </button>
    </div>

</main>

<?php
include("footer.php");
?>