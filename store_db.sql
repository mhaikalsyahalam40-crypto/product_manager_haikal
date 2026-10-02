-- =====================================================
-- Database: product_manager_haikal
-- Project: Product Manager
-- =====================================================

CREATE DATABASE IF NOT EXISTS product_manager_haikal;

USE product_manager_haikal;


-- =====================================================
-- Table: products
-- =====================================================

CREATE TABLE IF NOT EXISTS products (

    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100) NOT NULL UNIQUE,

    category VARCHAR(100) NOT NULL,

    price DECIMAL(12,2) NOT NULL,

    stock INT NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP

);


-- =====================================================
-- Contoh data
-- =====================================================

INSERT INTO products
    (name, category, price, stock)
VALUES
    ('Laptop ASUS', 'Elektronik', 7500000, 10),
    ('Mouse Logitech', 'Aksesoris', 150000, 20);