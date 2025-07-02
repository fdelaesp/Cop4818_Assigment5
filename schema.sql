-- Create database and user table
CREATE DATABASE IF NOT EXISTS login_system;
USE login_system;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL
);

-- Insert a default user: username “admin”, password “password123”
INSERT INTO users (username, password_hash) VALUES (
  'admin',
  -- generate with PHP: echo password_hash('password123', PASSWORD_DEFAULT);
  '$2y$10$e0NRhM8YeB1Mx1K7e4NBjO39n0c.fMfR0fCwe49cSzTaCgw0Am2dG'
);
