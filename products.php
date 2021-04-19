<?php
$title = "Products - CRM";
$active = "products";
include("meta.php");
include("header.php");
include("php_functions.php");
if (isset($_POST['delete-info'])) {
    if (!isset($_POST['p_id']) or $_POST['p_id'] == "new") {
        alert("Please select a Valid Product.");
    } else {
        delete_product($_POST['p_id']);
        unset($_POST['p_id']);
        alert("Sucessfully deleted Product.");
    }
}
if (isset($_POST['save-info'])) {
    if (!isset($_POST['p_id']) or $_POST['p_id'] == "new") {
        add_product($_POST['name'], $_POST['provider'], $_POST['price'], $_POST['warranty'], $_POST['spec']);
        alert("Product added Sucessfully.");
    } else {
        update_product($_POST['name'], $_POST['provider'], $_POST['price'], $_POST['warranty'], $_POST['spec'], $_POST['p_id']);
        alert("Product updated sucessfully");
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
            Select Product
        </button>
        <div class="containers">
            <h2>Product Information</h2>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" id="send-info">
                <label for="prod-name">Name</label>
                <input name="name" id="prod-name" type="text" value="<?php echo get_prod_name($_POST); ?>" required>
                <label for="prod-provider">Company</label>
                <input name="provider" id="prod-provider" type="text" value="<?php echo get_prod_provider($_POST); ?>"
                    required>
                <label for="prod-price">Price</label>
                <input name="price" id="prod-price" type="text" value="<?php echo get_prod_price($_POST); ?>" required>
                <label for="prod-warranty">Warranty</label>
                <input name="warranty" id="prod-warranty" type="text" value="<?php echo get_prod_warranty($_POST); ?>"
                    required>
                <label for="prod-spec">Specifications</label>
                <textarea name="spec" id="prod-spec"><?php echo get_prod_specs($_POST); ?></textarea>
                <input type="hidden" name="p_id" value="<?php echo isset($_POST['p_id']) ? $_POST['p_id'] : "new"; ?>">
            </form>
        </div>
        <button type="submit" name="delete-info" form="send-info" class="home-links right-side" id="delete-prod-info">
            Delete Product
        </button>
        <button type="submit" name="save-info" form="send-info" class="home-links right-side" id="save-prod-info">
            Save Product Info
        </button>
    </div>

</main>

<?php
include("footer.php");
?>