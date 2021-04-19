<?php
$title = "Sales - CRM";
$active = "sales";
include("meta.php");
include("header.php");
include("php_functions.php");
if (isset($_POST['sale_id']) and $_POST['sale_id'] == "new") {
    unset($_POST['sale_id']);
}
if (isset($_POST['save-info'])) {
    if (!isset($_POST['sale_id'])) {
        log_sale($_POST['product_id'], $_POST['seller_id'], $_POST['buyer_id'], $_POST['sale_date'], $_POST['sale_cost'], $_POST['sale_status']);
        alert("Sale logged sucessfully.");
    } else {
        update_sale($_POST['sale_id'], $_POST['product_id'], $_POST['seller_id'], $_POST['buyer_id'], $_POST['sale_date'], $_POST['sale_cost'], $_POST['sale_status']);
        alert("Sale updated sucessfully");
    }
}
?>

<main class="main-container">
    <div class="content-container">
        <h2>
            Sales
        </h2>
        <a class="home-links left-side">
            <span class="counts"><?php echo mysqli_num_rows(get_ongoing_sales()); ?></span> Ongoing Sales
        </a>
        <a class="home-links left-side">
            <span class="counts"><?php echo mysqli_num_rows(get_total_sales()); ?></span> Total Sales
        </a>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" id="request_info">
            <select name="sale_id" class="home-links left-side">
                <option value="new" selected>Log A Sale</option>
                <option disabled>──────────</option>
                <option disabled>--Ongoing Sales--</option>
                <?php
                $result = get_ongoing_sales();
                while ($fetch = mysqli_fetch_object($result)) {
                ?>
                <option value=<?php echo $fetch->sale_id ?>>
                    <?php echo get_emp_name($fetch->seller_id) . '-' . get_client_name($fetch->buyer_id); ?>
                </option>
                <?php } ?>
                <option disabled>──────────</option>
                <option disabled>--Closed Sales--</option>
                <?php
                $result = get_closed_sales();
                while ($fetch = mysqli_fetch_object($result)) {
                ?>
                <option value=<?php echo $fetch->sale_id ?>>
                    <?php echo get_emp_name($fetch->seller_id) . '-' . get_client_name($fetch->buyer_id); ?></option>
                <?php } ?>
            </select>
        </form>
        <button type="submit" name="show-info" form="request_info" class="home-links left-side invoice-card"
            id="show-prod-info">
            Show Sale Log
        </button>
        <div class="containers">
            <h2>Sales Log</h2>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" id="sales-send-info">
                <label for="sale-id">Sale ID</label>
                <input name="sale_id" id="sale-id" type="text" value="<?php echo get_sale_id($_POST); ?>"
                    <?php echo (!isset($_POST['sale_id']) ? "" : (get_sale_info($_POST['sale_id'])->status == "ongoing" ? "" : "readonly")); ?>>
                <label for="sale-product">Product</label>
                <select name="product_id" id="sale-product"
                    <?php echo (!isset($_POST['sale_id']) ? "" : (get_sale_info($_POST['sale_id'])->status == "ongoing" ? "" : "disabled")); ?>>
                    <option value="" <?php echo !isset($_POST['sale_id']) ? "" : "selected"; ?>>SELECT PRODUCT</option>
                    <?php
                    $result = get_all_products();
                    while ($fetch = mysqli_fetch_object($result)) {
                    ?>
                    <option value=<?php echo $fetch->p_id ?>
                        <?php echo (isset($_POST['sale_id']) and get_sale_info($_POST['sale_id'])->product_id == $fetch->p_id) ? "selected" : ""; ?>>
                        <?php echo get_prod_info($fetch->p_id)->name; ?>
                    </option>
                    <?php } ?>
                </select>
                <label for="sale-buyer">Buyer</label>
                <select name="buyer_id" id="sale-buyer"
                    <?php echo (!isset($_POST['sale_id']) ? "" : (get_sale_info($_POST['sale_id'])->status == "ongoing" ? "" : "disabled")); ?>>
                    <option value="" <?php echo !isset($_POST['sale_id']) ? "" : "selected"; ?>>SELECT BUYER</option>
                    <?php
                    $result = get_active_customers();
                    while ($fetch = mysqli_fetch_object($result)) {
                    ?>
                    <option value=<?php echo $fetch->c_id ?>
                        <?php echo (isset($_POST['sale_id']) and get_sale_info($_POST['sale_id'])->buyer_id == $fetch->c_id) ? "selected" : ""; ?>>
                        <?php echo $fetch->name; ?>
                    </option>
                    <?php } ?>
                    <option disabled>──────────</option>
                    <?php
                    $result = get_potential_customers();
                    while ($fetch = mysqli_fetch_object($result)) {
                    ?>
                    <option value=<?php echo $fetch->c_id ?>
                        <?php echo (isset($_POST['sale_id']) and get_sale_info($_POST['sale_id'])->buyer_id == $fetch->c_id) ? "selected" : ""; ?>>
                        <?php echo $fetch->name; ?>
                    </option>
                    <?php } ?>
                </select>
                <label for="sale-seller">Seller</label>
                <select name="seller_id" id="sale-seller"
                    <?php echo (!isset($_POST['sale_id']) ? "" : (get_sale_info($_POST['sale_id'])->status == "ongoing" ? "" : "disabled")); ?>>
                    <option value="" <?php echo !isset($_POST['sale_id']) ? "" : "selected"; ?>>SELECT SELLER</option>
                    <?php
                    $result = get_all_users();
                    while ($fetch = mysqli_fetch_object($result)) {
                    ?>
                    <option value=<?php echo $fetch->u_id ?>
                        <?php echo (isset($_POST['sale_id']) and get_sale_info($_POST['sale_id'])->seller_id == $fetch->u_id) ? "selected" : ""; ?>>
                        <?php echo $fetch->name; ?>
                    </option>
                    <?php } ?>
                </select>
                <label for="sale-cost">Cost</label>
                <input name="sale_cost" id="sale-cost" type="text" placeholder="Price in Rupees"
                    value="<?php echo get_sale_cost($_POST); ?>"
                    <?php echo (!isset($_POST['sale_id']) ? "" : (get_sale_info($_POST['sale_id'])->status == "ongoing" ? "" : "readonly")); ?>>
                <label for="sale-date">Sale Date</label>
                <input name="sale_date" id="sale-date"
                    type="<?php echo (!isset($_POST['sale_id']) ? "datetime-local" : (get_sale_info($_POST['sale_id'])->status == "ongoing" ? "datetime-local" : "text")); ?>"
                    value="<?php echo get_sale_date($_POST); ?>"
                    <?php echo (!isset($_POST['sale_id']) ? "" : (get_sale_info($_POST['sale_id'])->status == "ongoing" ? "" : "readonly")); ?>>
                <label for="sale-status">Status</label>
                <select name="sale_status" id="sale-status"
                    <?php echo (!isset($_POST['sale_id']) ? "" : (get_sale_info($_POST['sale_id'])->status == "ongoing" ? "" : "disabled")); ?>>
                    <option value="" <?php echo !isset($_POST['sale_id']) ? "selected" : ""; ?>>SELECT STATUS</option>
                    <option value="ongoing"
                        <?php echo (isset($_POST['sale_id']) and get_sale_info($_POST['sale_id'])->status == "ongoing") ? "selected" : ""; ?>>
                        ONGOING</option>
                    <option value="closed"
                        <?php echo (isset($_POST['sale_id']) and get_sale_info($_POST['sale_id'])->status == "closed") ? "selected" : ""; ?>>
                        CLOSED</option>
                    </option>
                </select>
            </form>
        </div>
        <button type="submit" name="save-info" form="sales-send-info" class="home-links right-side" id="save-prod-info">
            Log Sales Info
        </button>
    </div>

</main>

<?php
include("footer.php");
?>