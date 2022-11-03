DROP TABLE IF EXISTS users;

CREATE TABLE users(
id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
name varchar(255) NOT NULL,
email varchar(255) NOT NULL,
`password` varchar(255),
phone INT,
address varchar(255) NOT NULL,
`role` ENUM('customer', 'worker', 'administrator') DEFAULT 'customer',
created_at datetime DEFAULT CURRENT_TIMESTAMP
);
