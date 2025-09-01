CREATE DATABASE IF NOT EXISTS portfolio_db;
USE portfolio_db;

-- Admin Table
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL -- hashed
);
INSERT INTO admin (username, password) VALUES ('admin', '$2y$10$VQKnQJv5u61jY0Kq3Z9ZT.qv8WZ0p7j3Y3X2Y1Z1Y1Z1Y1Z1Y1Z1Y'); -- password: "admin123"
-- Profile Table
CREATE TABLE profile (
    id INT PRIMARY KEY,
    name VARCHAR(100),
    title VARCHAR(100),
    bio TEXT,
    profile_image VARCHAR(255),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Education Table
CREATE TABLE education (
    id INT AUTO_INCREMENT PRIMARY KEY,
    degree VARCHAR(100),
    institution VARCHAR(100),
    year VARCHAR(20),
    details TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Projects Table
CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    category VARCHAR(50),
    image VARCHAR(255),
    description TEXT,
    github_link VARCHAR(255),
    live_link VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Contact Info
CREATE TABLE contact (
    id INT PRIMARY KEY,
    email VARCHAR(100),
    phone VARCHAR(20),
    location VARCHAR(100),
    social_links JSON -- stores LinkedIn, GitHub, etc.
);
