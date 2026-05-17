<?php
// Railway-optimized database connection
$host = $_ENV['MYSQLHOST'] ?? $_ENV['DB_HOST'] ?? getenv('MYSQLHOST') ?: 'localhost';
$port = $_ENV['MYSQLPORT'] ?? $_ENV['DB_PORT'] ?? getenv('MYSQLPORT') ?: '3306';
$db   = $_ENV['MYSQLDATABASE'] ?? $_ENV['DB_NAME'] ?? getenv('MYSQLDATABASE') ?: 'eco_waste';
$user = $_ENV['MYSQLUSER'] ?? $_ENV['DB_USER'] ?? getenv('MYSQLUSER') ?: 'root';
$pass = $_ENV['MYSQLPASSWORD'] ?? $_ENV['DB_PASS'] ?? getenv('MYSQLPASSWORD') ?: 'root';
$charset = 'utf8mb4';

// Railway MySQL connection string format
$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::ATTR_TIMEOUT            => 30,
    PDO::MYSQL_ATTR_SSL_CA       => false,
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    // Connection successful
} catch (\PDOException $e) {
    // Log error for debugging
    error_log("Database connection failed: " . $e->getMessage());
    
    // Show user-friendly error
    if (getenv('RAILWAY_ENVIRONMENT') === 'production') {
        die("Database connection failed. Please try again later.");
    } else {
        die("Database connection failed: " . $e->getMessage());
    }
}