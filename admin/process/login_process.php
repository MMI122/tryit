<?php
session_start();
include '../../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_logged_in'] = true;

        if ($remember) {
            setcookie('admin_remember', 'secure_remember_token_123', time() + (86400 * 30), "/", "", false, true);
        }

        header("Location: ../dashboard.php");
        exit;
    } else {
        header("Location: ../login.php?error=Invalid credentials");
        exit;
    }
}
