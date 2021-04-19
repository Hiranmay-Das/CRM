<?php
$hostname = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'CRM';
$conn = mysqli_connect("$hostname", "$username", "$password");

if (!$conn) {
	die("Unable to Connect to server '" . $hostname . "'.");
}

$create_db = "CREATE DATABASE IF NOT EXISTS CRM COLLATE=utf8mb4_general_ci;";

mysqli_query($conn, $create_db);

$flag = mysqli_select_db($conn, "$database");

$sql = "CREATE TABLE IF NOT EXISTS `users` (
	`u_id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(20) NOT NULL,
	`email` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`contact_no` VARCHAR(13) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`reg_date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`last_updated` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`u_id`)
	) ENGINE=InnoDB;";

mysqli_query($conn, $sql);

$sql = "CREATE TABLE `products` ( 
	`p_id` INT NOT NULL AUTO_INCREMENT, 
	`name` VARCHAR(30) NOT NULL, 
	`provider` VARCHAR(30) NOT NULL, 
	`price` BIGINT NOT NULL,
	`warranty` VARCHAR(3) NOT NULL,
	`added_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
	`last_modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
	`specification` VARCHAR(10000) NULL DEFAULT 'NONE', 
	PRIMARY KEY (`p_id`)
	) ENGINE = InnoDB;";

mysqli_query($conn, $sql);

$sql = "CREATE TABLE `clients` ( 
	`c_id` INT NOT NULL AUTO_INCREMENT, 
	`name` VARCHAR(30) NOT NULL, 
	`address` VARCHAR(50) NOT NULL, 
	`email` VARCHAR(30) NOT NULL, 
	`contact_no` VARCHAR(12) NOT NULL, 
	`status` VARCHAR(10) NOT NULL DEFAULT 'potential', 
	PRIMARY KEY (`c_id`)) ENGINE = InnoDB;";

mysqli_query($conn, $sql);

$sql = "CREATE TABLE `sales` ( 
	`sale_id` INT NOT NULL AUTO_INCREMENT, 
	`product_id` INT NOT NULL, 
	`seller_id` INT NOT NULL, 
	`buyer_id` INT NOT NULL, 
	`sale_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    `cost` BIGINT NOT NULL,
    `status` VARCHAR(15) NOT NULL DEFAULT 'ongoing',
	PRIMARY KEY (`sale_id`)) ENGINE = InnoDB;";

mysqli_query($conn, $sql);