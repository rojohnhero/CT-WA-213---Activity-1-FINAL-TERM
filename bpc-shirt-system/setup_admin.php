<?php
// Run this file ONCE in your browser, then DELETE it for security.
require "config/database.php";

$name = "System Administrator";
$email = "admin@bpc.local";
$studentNo = "ADMIN-001";
$department = "ADMIN";
$plainPassword = "Admin@12345";

$check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$check->execute([$email]);

if ($check->fetch()) {
    echo "Admin account already exists. Delete setup_admin.php now.";
} else {
    $hash = password_hash($plainPassword, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (full_name, email, student_no, department, password, role) VALUES (?, ?, ?, ?, ?, 'admin')");
    $stmt->execute([$name, $email, $studentNo, $department, $hash]);
    echo "Admin created.<br>Email: admin@bpc.local<br>Password: Admin@12345<br><strong>Delete setup_admin.php now.</strong>";
}
