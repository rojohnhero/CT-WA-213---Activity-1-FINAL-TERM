<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BPC Department Shirt System</title>
    <link rel="stylesheet" href="/bpc-shirt-system/assets/style.css">
</head>
<body>
<header class="topbar">
    <a class="brand" href="/bpc-shirt-system/index.php">BPC <span>Department Shirt System</span></a>
    <nav>
        <?php if (isset($_SESSION["user_id"])): ?>
            <a href="/bpc-shirt-system/dashboard.php">Dashboard</a>
            <a href="/bpc-shirt-system/logout.php">Logout</a>
        <?php else: ?>
            <a href="/bpc-shirt-system/login.php">Login</a>
            <a href="/bpc-shirt-system/register.php">Register</a>
        <?php endif; ?>
    </nav>
</header>
<main class="container">
