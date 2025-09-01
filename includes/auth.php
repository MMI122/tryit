<?php
session_start();

function isAdminLoggedIn()
{
    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
        return true;
    }
    if (isset($_COOKIE['admin_remember']) && !isset($_SESSION['admin_logged_in'])) {
        $token = $_COOKIE['admin_remember'];
        // Validate token against DB (optional: store token hashes in DB)
        // For simplicity: just re-login if session expired but cookie exists
        // In production: use secure token system
        if ($token === 'secure_remember_token_123') { // demo only
            $_SESSION['admin_logged_in'] = true;
            return true;
        }
    }
    return false;
}

function requireAdmin()
{
    if (!isAdminLoggedIn()) {
        header("Location: login.php?error=Please login first");
        exit;
    }
}
