<?php
$title = "Home - CRM";
$active = "home";
include("meta.php");
include("header.php");
include("php_functions.php");
?>

<main class="main-container">
    <div class="content-container">
        <h2>
            Dashboard
        </h2>
        <a class="home-links left-side">
            <span class="counts"><?php echo get_product_count(); ?></span> Products
        </a>
        <a class="home-links left-side">
            <span class="counts"><?php echo mysqli_num_rows(get_active_customers()); ?></span> Active Customers
        </a>
        <a class="home-links left-side ">
            <span class="counts"><?php echo get_ongoing_sales_count(); ?></span> Pending Orders
        </a>
        <a class="home-links left-side invoice-card">
            <span class="counts">+</span> Create Invoice
        </a>
        <div class="sales-container">
            <h2>Top 5 Sales</h2>
            <table class="sales-table">
                <tr class="sales-row">
                    <th class="sales-cell">Product</th>
                    <th class="sales-cell">Employee</th>
                    <th class="sales-cell">Sale Amount</th>
                </tr>
                <?php
                $result = get_highest_sales();
                while ($fetch = mysqli_fetch_object($result)) {
                ?>
                <tr class="sales-row">
                    <td class="sales-cell"><?php echo get_emp_name($fetch->seller_id); ?></td>
                    <td class="sales-cell"><?php echo get_product($fetch->product_id); ?></td>
                    <td class="sales-cell"><?php echo $fetch->cost; ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <a class="home-links right-side ticket-card">
            <span class="counts">+</span> File a Ticket
        </a>
    </div>

</main>

<?php
include("footer.php");
?>