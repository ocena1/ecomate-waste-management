<?php
// Simple database connection for traditional web hosting
// Replace these values with your hosting database details

$host = 'localhost'; // Usually 'localhost' for shared hosting
$db   = 'your_database_name'; // Replace with your actual database name
$user = 'your_database_user'; // Replace with your database username
$pass = 'your_database_password'; // Replace with your database password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    // Connection successful
} catch (\PDOException $e) {
    // Show error for debugging (remove in production)
    die("Database connection failed: " . $e->getMessage());
}

// Instructions:
// 1. Replace the database credentials above with your hosting details
// 2. Rename this file to 'db_connect.php' (replace the existing one)
// 3. Upload to your hosting along with other files