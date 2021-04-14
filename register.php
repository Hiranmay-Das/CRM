<?php
include("connection.php");
function alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg'); alert('BITCH');</script>";
}
if (isset($_POST['submit'])) {
    if ($_POST['password'] !== $_POST['confirm-password']) {
        alert("Passwords Dont Match");
    } else {
        $query = "insert into data set name='" . $_POST['name'] . "', email='" . $_POST['email'] . "', password='" . $_POST['password'] . "', contact_no='" . $_POST['contact_no'] . "';";
        $test = mysqli_query($conn, $query);
        header("Location: index.php");
    }
}