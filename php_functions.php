<?php
function alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
function sanitize($input)
{
    if (is_array($input)) {
        foreach ($input as $var => $val) {
            $output[$var] = sanitize($val);
        }
    } else {
        $input = trim($input);
        $input = stripslashes($input);
        $input  = htmlspecialchars($input);
        $output = $input;
        //$output = mysqli_real_escape_string($conn, $input);
    }
    return $output;
}
function check_email($flag, $input)
{
    $pattern = "/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/";
    if ($flag and !preg_match($pattern, $input)) {
        alert("Please Enter a Valid Email.");
        $flag = FALSE;
    }
    return $flag;
}
function check_password($flag, $input)
{
    $pattern = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,20}$/";
    if ($flag and preg_match($pattern, $input) == 0) {
        alert("Password must have an UpperCase Letter, a Lowercase Letter and a Digit. It must be 8 characters long.");
        $flag = FALSE;
    }
    return $flag;
}
function verify_password($flag, $password1, $password2)
{
    if ($flag and $password1 != $password2) {
        alert("Passwords Dont Match");
        $flag = FALSE;
    }
    return $flag;
}
function check_if_duplicate_email($flag, $conn, $email)
{
    if ($flag) {
        $query = "select email from `users` where email = '" . $email . "'";
        $result = mysqli_query($conn, $query);
        if (mysqli_fetch_object($result)->email == $email) {
            alert("Your Email Address is already linked to another account. Please Sign in Instead");
            $flag = FALSE;
        }
    }
    return $flag;
}
function create_user($conn, $data)
{
    $query = "insert into users set name='" . $data['name'] . "', email='" . $data['email'] . "', password='" . password_hash($data['password'], PASSWORD_DEFAULT) . "', contact_no='" . $data['contact_no'] . "';";
    mysqli_query($conn, $query);
}
function check_if_email_exists($flag, $result)
{
    if ($flag) {
        if (mysqli_num_rows($result) == 0) {
            alert("Email is not assosciated with any Account. Please Sign Up Instead.");
            $flag = FALSE;
        }
    }
    return $flag;
}
function check_if_password_match($flag, $result, $given_password)
{
    if ($flag) {
        if (!password_verify($given_password, mysqli_fetch_object($result)->password)) {
            alert("Wrong Password.");
            $flag = FALSE;
        }
    }
    return $flag;
}
function get_sql_conn()
{
    $conn = mysqli_connect("127.0.0.1", "root", "", "CRM");
    return $conn;
}

function get_all_users()
{
    $conn = get_sql_conn();
    $sql = "select * from users";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function get_user_info($u_id)
{
    $conn = get_sql_conn();
    $sql = "select * from users where u_id='$u_id'";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function get_product_count()
{
    $conn = get_sql_conn();
    $sql = "select * from products";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result);
}

function get_product($p_id)
{
    $conn = get_sql_conn();
    $sql = "select name from products where p_id='$p_id'";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_object($result)->name;
}

function get_active_customers()
{
    $conn = get_sql_conn();
    $sql = "select * from clients where status='active'";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function get_potential_customers()
{
    $conn = get_sql_conn();
    $sql = "select * from clients where status='potential'";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function get_cust_info($c_id)
{
    $conn = get_sql_conn();
    $sql = "select * from clients where c_id='$c_id'";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_object($result);
}

function get_cust_name($data)
{
    return (!isset($data['cust_id']) or $data['cust_id'] == "new") ? "" : get_cust_info($data['cust_id'])->name;
}
function get_cust_email($data)
{
    return (!isset($data['cust_id']) or $data['cust_id'] == "new") ? "" : get_cust_info($data['cust_id'])->email;
}
function get_cust_contact($data)
{
    return (!isset($data['cust_id']) or $data['cust_id'] == "new") ? "" : get_cust_info($data['cust_id'])->contact_no;
}
function get_cust_address($data)
{
    return (!isset($data['cust_id']) or $data['cust_id'] == "new") ? "" : get_cust_info($data['cust_id'])->address;
}
function get_cust_status($data)
{
    return (!isset($data['cust_id']) or $data['cust_id'] == "new") ? "potential" : get_cust_info($data['cust_id'])->status;
}

function get_ongoing_sales_count()
{
    $conn = get_sql_conn();
    $sql = "select * from sales where status='ongoing'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result);
}

function get_highest_sales()
{
    $conn = get_sql_conn();
    $sql = "select * from sales where status='closed' order by cost desc limit 5";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function get_emp_name($u_id)
{
    $conn = get_sql_conn();
    $sql = "select name from users where u_id='$u_id'";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_object($result)->name;
}

function get_client_name($c_id)
{
    $conn = get_sql_conn();
    $sql = "select name from clients where c_id='$c_id'";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_object($result)->name;
}

function add_customer($name, $email, $address, $contact_no, $status)
{
    $sql = "insert into clients set name='" . $name . "', email='" . $email . "', address='" . $address . "', contact_no='" . $contact_no . "', status='" . $status . "';";
    $conn = get_sql_conn();
    mysqli_query($conn, $sql);
}

function update_customer($name, $email, $address, $contact_no, $status, $c_id)
{
    $sql = "update clients set name='" . $name . "', email='" . $email . "', address='" . $address . "', contact_no='" . $contact_no . "', status='" . $status . "' where c_id='" . $c_id . "';";
    $conn = get_sql_conn();
    mysqli_query($conn, $sql);
}

function delete_user($c_id)
{
    $sql = "delete from clients where c_id='" . $c_id . "';";
    $conn = get_sql_conn();
    mysqli_query($conn, $sql);
}

function get_all_products()
{
    $conn = get_sql_conn();
    $sql = "select * from products";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function get_companies()
{
    $conn = get_sql_conn();
    $sql = "select distinct(provider) from products";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function get_prod_info($p_id)
{
    $conn = get_sql_conn();
    $sql = "select * from products where p_id='$p_id'";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_object($result);
}

function get_prod_name($data)
{
    return (!isset($data['p_id']) or $data['p_id'] == "new") ? "" : get_prod_info($data['p_id'])->name;
}
function get_prod_provider($data)
{
    return (!isset($data['p_id']) or $data['p_id'] == "new") ? "" : get_prod_info($data['p_id'])->provider;
}
function get_prod_price($data)
{
    return (!isset($data['p_id']) or $data['p_id'] == "new") ? "" : get_prod_info($data['p_id'])->price;
}
function get_prod_warranty($data)
{
    return (!isset($data['p_id']) or $data['p_id'] == "new") ? "" : get_prod_info($data['p_id'])->warranty;
}
function get_prod_specs($data)
{
    return (!isset($data['p_id']) or $data['p_id'] == "new") ? "" : get_prod_info($data['p_id'])->specification;
}

function add_product($name, $provider, $price, $warranty, $specification)
{
    $sql = "insert into products set name='" . $name . "', provider='" . $provider . "', price='" . $price . "', warranty='" . $warranty . "', specification='" . $specification . "';";
    $conn = get_sql_conn();
    mysqli_query($conn, $sql);
}

function update_product($name, $provider, $price, $warranty, $specification, $p_id)
{
    $sql = "update products set name='" . $name . "', provider='" . $provider . "', price='" . $price . "', warranty='" . $warranty . "', specification='" . $specification . "', last_modified=current_timestamp where p_id='" . $p_id . "';";
    $conn = get_sql_conn();
    mysqli_query($conn, $sql);
}

function delete_product($p_id)
{
    $sql = "delete from products where p_id='" . $p_id . "';";
    $conn = get_sql_conn();
    mysqli_query($conn, $sql);
}

function get_ongoing_sales()
{
    $sql = "select * from sales where status='ongoing';";
    $conn = get_sql_conn();
    $result = mysqli_query($conn, $sql);
    return $result;
}

function get_closed_sales()
{
    $sql = "select * from sales where status='closed';";
    $conn = get_sql_conn();
    $result = mysqli_query($conn, $sql);
    return $result;
}

function get_total_sales()
{
    $sql = "select * from sales";
    $conn = get_sql_conn();
    $result = mysqli_query($conn, $sql);
    return $result;
}

function get_sale_info($sale_id)
{
    $conn = get_sql_conn();
    $sql = "select * from sales where sale_id='$sale_id'";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_object($result);
}

function get_latest_sale_id()
{
    $conn = get_sql_conn();
    $sql = "select sale_id from sales order by sale_id desc limit 1;";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_object($result)->sale_id + 1;
}

function get_sale_id($data)
{
    return (!isset($data['sale_id'])) ? get_latest_sale_id() : $data['sale_id'];
}
function get_sale_product($data)
{
    return (!isset($data['sale_id'])) ? "" : get_prod_info(get_sale_info($data['sale_id'])->product_id)->name;
}
function get_sale_buyer($data)
{
    return (!isset($data['sale_id'])) ? "" : get_cust_info(get_sale_info($data['sale_id'])->buyer_id)->name;
}
function get_sale_cost($data)
{
    return (!isset($data['sale_id'])) ? "" : get_sale_info($data['sale_id'])->cost;
}
function get_sale_seller($data)
{
    return (!isset($data['sale_id'])) ? "" : get_emp_name(get_sale_info($data['sale_id'])->product_id);
}
function get_sale_date($data)
{
    return (!isset($data['sale_id'])) ? date('Y-m-d H:i:s') : get_sale_info($data['sale_id'])->sale_date;
}
function log_sale($product_id, $seller_id, $buyer_id, $sale_date, $cost, $status)
{
    $conn = get_sql_conn();
    $sql = "insert into sales set product_id='$product_id', seller_id='$seller_id', buyer_id='$buyer_id', sale_date='$sale_date',cost='$cost', status='$status';";
    mysqli_query($conn, $sql);
}
function update_sale($sale_id, $product_id, $seller_id, $buyer_id, $sale_date, $cost, $status)
{
    $conn = get_sql_conn();
    $sql = "update sales set product_id='$product_id', seller_id='$seller_id', buyer_id='$buyer_id', sale_date='$sale_date',cost='$cost', status='$status' where sale_id='$sale_id';";
    mysqli_query($conn, $sql);
}