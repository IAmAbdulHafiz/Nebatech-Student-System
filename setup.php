<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "student_system";

$conn = mysqli_connect($host, $user, $password);

if (!$conn) {
    die("Could not connect to MySQL. Make sure XAMPP MySQL is running.");
}

mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `$database`");
mysqli_select_db($conn, $database);

$tableExists = mysqli_query($conn, "SHOW TABLES LIKE 'users'");
$hasUsersTable = $tableExists && mysqli_num_rows($tableExists) > 0;

if ($hasUsersTable) {
    $columns = mysqli_query($conn, "SHOW COLUMNS FROM users LIKE 'full_name'");
    $hasFullName = $columns && mysqli_num_rows($columns) > 0;

    if (!$hasFullName) {
        // Legacy schema detected — recreate for admin/student/facilitator auth.
        mysqli_query($conn, "DROP TABLE users");
        $hasUsersTable = false;
    }
}

if (!$hasUsersTable) {
    $sql = "CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(100) NOT NULL,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('admin', 'student', 'facilitator') NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if (!mysqli_query($conn, $sql)) {
        die("Could not create users table: " . mysqli_error($conn));
    }
}

echo "Database and users table are ready. You can now <a href='register.php'>register</a> or <a href='login.php'>login</a>.";
mysqli_close($conn);
