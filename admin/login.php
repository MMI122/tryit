<?php
session_start();
include '../includes/auth.php';

if (isAdminLoggedIn()) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body class="login-body">
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if (isset($_GET['error'])): ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>
        <form action="process/login_process.php" method="POST">
            <input type="text" name="username" placeholder="Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <label>
                <input type="checkbox" name="remember" /> Remember Me
            </label>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>