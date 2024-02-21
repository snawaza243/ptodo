<?php
// Database configuration
$dbHost = 'localhost'; // Change this to your database host
$dbName = 'todophp'; // Change this to your database name
$dbUser = 'root'; // Change this to your database username
$dbPass = 'mysql1234'; // Change this to your database password

// PDO connection string
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4";

// PDO options (optional)
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Enable error reporting
    PDO::ATTR_EMULATE_PREPARES => false, // Disable emulation of prepared statements
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Set default fetch mode to associative array
];

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $dbUser, $dbPass, $options);
} catch (PDOException $e) {
    // If connection fails, display an error message and exit
    die("Connection failed: " . $e->getMessage());
}
?>
