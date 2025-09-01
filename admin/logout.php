<?php
session_start();
session_destroy();
if (isset($_COOKIE['admin_remember'])) {
    setcookie('admin_remember', '', time() - 3600, '/');
}
header("Location: login.php");
exit;
