DROP TABLE IF EXISTS products;

CREATE TABLE products (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `name` varchar(255) NOT NULL,
    price double,
    `description` varchar(255),
    `discount_percentage` INT,
    archived BOOLEAN NOT NULL DEFAULT 0
);