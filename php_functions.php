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
function get_product_count()
{
    $conn = get_sql_conn();
    $sql = "select * from products";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result);
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
    return (!isset($_POST['cust_id']) or $_POST['cust_id'] == "new") ? "" : get_cust_info($data['cust_id'])->name;
}
function get_cust_email($data)
{
    return (!isset($_POST['cust_id']) or $_POST['cust_id'] == "new") ? "" : get_cust_info($data['cust_id'])->email;
}
function get_cust_contact($data)
{
    return (!isset($_POST['cust_id']) or $_POST['cust_id'] == "new") ? "" : get_cust_info($data['cust_id'])->contact_no;
}
function get_cust_address($data)
{
    return (!isset($_POST['cust_id']) or $_POST['cust_id'] == "new") ? "" : get_cust_info($data['cust_id'])->address;
}
function get_cust_status($data)
{
    return (!isset($_POST['cust_id']) or $_POST['cust_id'] == "new") ? "potential" : get_cust_info($data['cust_id'])->status;
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

function get_product($p_id)
{
    $conn = get_sql_conn();
    $sql = "select name from products where p_id='$p_id'";
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