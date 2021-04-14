<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'users';
$conn = mysqli_connect("$hostname", "$username", "$password");

if (!$conn) {
	die("Unable to Connect to server '" . $hostname . "'.");
}

$create_db = "CREATE DATABASE IF NOT EXISTS users COLLATE=utf8mb4_general_ci;";

$flag = mysqli_select_db($conn, "$database");

$sql = "CREATE TABLE IF NOT EXISTS `data` (
	`u_id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(20) NOT NULL,
	`email` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`password` VARCHAR(21) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`contact_no` VARCHAR(13) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`reg_date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`last_updated` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`u_id`)
	) ENGINE=InnoDB;";

mysqli_query($conn, $sql);