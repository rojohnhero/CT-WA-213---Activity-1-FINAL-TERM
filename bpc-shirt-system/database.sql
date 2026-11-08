CREATE DATABASE IF NOT EXISTS bpc_shirt_system
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE bpc_shirt_system;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    student_no VARCHAR(50) NOT NULL UNIQUE,
    department VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'student') NOT NULL DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create an admin account using setup_admin.php, then delete that setup file.
