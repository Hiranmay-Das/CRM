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
    if ($flag and $password1 !== $password2) {
        alert("Passwords Dont Match");
        $flag = FALSE;
    }
    return $flag;
}
function check_if_duplicate_email($flag, $conn, $email)
{
    if ($flag) {
        $query = "select email from `data` where email = '" . $email . "'";
        $result = mysqli_query($conn, $query);
        if (mysqli_fetch_object($result)->email == $email) {
            alert("Your Email Address is already linked to another account. Please Sign in Instead");
            $flag = FALSE;
        }
    }
    return $flag;
}
function insert_into_database($conn, $data)
{
    $query = "insert into data set name='" . $data['name'] . "', email='" . $data['email'] . "', password='" . $data['password'] . "', contact_no='" . $data['contact_no'] . "';";
    $test = mysqli_query($conn, $query);
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
        if (mysqli_fetch_object($result)->password !== $given_password) {
            alert("Wrong Password.");
            $flag = FALSE;
        }
    }
    return $flag;
}