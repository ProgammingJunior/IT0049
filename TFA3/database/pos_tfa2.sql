CREATE DATABASE IF NOT EXISTS tfa2_pos CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE tfa2_pos;

CREATE TABLE IF NOT EXISTS customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    created_at DATETIME NOT NULL
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    created_at DATETIME NOT NULL
);

INSERT IGNORE INTO customers (id, full_name, email, phone, created_at) VALUES
    (1, 'Alice Johnson', 'alice@example.com', '555-0101', '2026-01-15 09:00:00'),
    (2, 'Bob Smith', 'bob@example.com', '555-0102', '2026-01-16 10:30:00'),
    (3, 'Carol Davis', 'carol@example.com', '555-0103', '2026-01-17 11:15:00'),
    (4, 'David Brown', 'david@example.com', '555-0104', '2026-01-18 13:45:00'),
    (5, 'Eva Wilson', 'eva@example.com', '555-0105', '2026-01-19 15:20:00');

INSERT IGNORE INTO users (id, username, full_name, created_at) VALUES
    (1, 'admin', 'Alice Johnson', '2026-01-15 08:00:00'),
    (2, 'bsmith', 'Bob Smith', '2026-01-16 08:30:00'),
    (3, 'cdavis', 'Carol Davis', '2026-01-17 09:10:00'),
    (4, 'dbrown', 'David Brown', '2026-01-18 09:45:00'),
    (5, 'ewilson', 'Eva Wilson', '2026-01-19 10:20:00');