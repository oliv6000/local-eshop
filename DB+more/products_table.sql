
CREATE TABLE products (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `name` varchar(255) NOT NULL,
    price double,
    `description` varchar(255),
    archived BOOLEAN NOT NULL DEFAULT 0
);