-- --------------------------------------------------------
-- Vært:                         127.0.0.1
-- Server-version:               5.7.33 - MySQL Community Server (GPL)
-- ServerOS:                     Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for local-eshop
CREATE DATABASE IF NOT EXISTS `local-eshop` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `local-eshop`;

-- Dumping structure for tabel local-eshop.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` double DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `discount_percentage` int(11) DEFAULT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table local-eshop.products: ~4 rows (tilnærmelsesvis)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `name`, `price`, `description`, `discount_percentage`, `archived`) VALUES
	(1, 'lan LAPTOP', 25.25, 'This is a cheap gaming laptop', 25, 0),
	(2, 'desktop', 25.48, 'This is a cheap but okay gaming desktop', NULL, 0),
	(3, 'desktop GAMER', 255.95, 'This is an expensive but very good gaming desktop', NULL, 1),
	(13, 'SMI GAMING LAPTOP', 458.95, 'SUPER PREMIUM DELUX GAMING LAPTOP', NULL, 1);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for tabel local-eshop.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `role` enum('customer','worker','administrator') DEFAULT 'customer',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Dumping data for table local-eshop.users: ~4 rows (tilnærmelsesvis)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `role`, `created_at`) VALUES
	(1, 'Oliver Ian Olesen', 'oliver.ian.o@hotmail.com', '$2y$10$.nwDltOaOFy93Iv4OlBaCuztrFVhGOgk4wt5XUNkBY5CsKWQ.UFrC', 28922353, 'Vandborgvej 17, 7620 Lemvig', 'administrator', '2022-11-05 19:17:10'),
	(26, 'troels troelsen', 'olesencool@gmail.com', '$2y$10$ZcNj9JUkZ/qOzYzvNjcuIuvvyv3/Mufg4zTNjx6P66aPwAVJfdMuq', 19485985, 'troelsens vej 17, 7620 Lemvig', 'worker', '2022-11-07 22:04:42'),
	(28, 'test', 'test@notreal.com', '$2y$10$ikp3hXGB8Y4dT4uInsn47.qSOs.MrO7XC0R458PEouE51FGYIi76O', 16485985, 'TestTestAddress 20, 8800Viborg', 'worker', '2022-11-08 22:08:37'),
	(29, 'Oliver Ian Olesen', 'OIOl.skp@edu.mercantec.dk', '$2y$10$XKgiKsyOjotK4D5iOQzvne1tgoKt5QXNc.9fRmmIunkZVxqDbay0m', 28922353, 'Vandborgvej 27, 7620 Lemvig', 'worker', '2022-11-08 22:09:34');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for tabel local-eshop.verify_codes
CREATE TABLE IF NOT EXISTS `verify_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `generated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `verify_codes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table local-eshop.verify_codes: ~2 rows (tilnærmelsesvis)
/*!40000 ALTER TABLE `verify_codes` DISABLE KEYS */;
INSERT INTO `verify_codes` (`id`, `user_id`, `code`, `generated_at`) VALUES
	(8, 26, 56156, '2022-11-08 21:15:39'),
	(9, 26, 47590, '2022-11-08 21:23:56'),
	(10, 26, 58049, '2022-11-08 21:25:03');
/*!40000 ALTER TABLE `verify_codes` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
