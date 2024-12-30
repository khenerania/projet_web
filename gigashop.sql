-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 27 Décembre 2024 à 18:02
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `gigashop`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(50) DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`, `role`, `created_at`) VALUES
(1, 'rania1', 'rania', 'khene@gmail.com', 'admin', '2024-12-26 00:27:26'),
(2, 'admin2', 'admin2', 'admin2', 'admin', '2024-12-26 17:36:31');

-- --------------------------------------------------------

--
-- Structure de la table `cart_items`
--

CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text,
  `price` varchar(50) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `description`, `price`, `rating`) VALUES
(2, 'Casque1', 'headphones.jpg', 'Un casque audio performant pour le gaming et la productivite.', '2500', 4),
(3, 'Telephone1', 'phone.jpg', 'Un smartphone puissant pour le jeu et la productivite.', '30000Da', 4),
(4, 'Montre1', 'watch.jpg', 'Une montre performante pour un style affirme.', '5000', 4),
(5, 'Telephone2', 'phone1.jpg', 'Un smartphone puissant pour le jeu et la productivite.', '40000Da', 4),
(6, 'Montre2', 'watch1.jpg', 'Une montre performante pour un style affirme.', '3000Da', 4),
(7, 'Casque2', 'headphones2.jpg', 'Un casque audio performant pour le gaming et la productivite.', '5000Da', 4),
(8, 'PC2', 'pc1.jpg', 'Un PC performant ideal pour le gaming et les travaux professionnels.', '53000Da', 4),
(9, 'Casque3', 'headphones2.jpg', 'Un casque audio performant pour le gaming et la productivite.', '4500', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'user1', 'user1', 'user1', '2024-12-26 17:12:39'),
(2, 'user2', 'user2', '$2y$10$pa6DjhWR28sLTe2yqsLJsuEscQPFIJyUeDVQ05cQdV1op584hmZWa', '2024-12-26 17:19:17'),
(6, 'user3', 'user3', '$2y$10$QDKMeUiKhIIbqBMhKnZOW..0Kpfe1c70kJ2ihhCzV9IDso1H/Ni8W', '2024-12-26 17:26:39'),
(7, 'user4', 'user4', '$2y$10$3g2cQxe5tp6x/OBr0NyeMuxsh.zfD/QTsyxjl7kzxTW8gWbgHMx3m', '2024-12-26 17:49:16');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
