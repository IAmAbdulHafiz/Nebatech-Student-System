<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "student_system";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Database connection failed. Import database/schema.sql in phpMyAdmin, or open setup.php once.");
}

mysqli_set_charset($conn, "utf8mb4");
