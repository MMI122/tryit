<?php
$host = 'localhost';
$port = '4308';  // 👈 Custom port
$dbname = 'portfolio_db';
$username = 'root';  // Default XAMPP username
$password = '';      // Default XAMPP password (usually empty)

try {
    $pdo = new PDO("mysql:host=$host:$port;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
