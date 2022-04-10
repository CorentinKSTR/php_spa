-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 07 fév. 2022 à 20:47
-- Version du serveur : 5.7.33
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `php-oo`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `type`) VALUES
(1, 'Cat'),
(2, 'Dog'),
(3, 'Horse'),
(4, 'Turtle'),
(5, 'Fish');

-- --------------------------------------------------------

--
-- Structure de la table `pet`
--

CREATE TABLE `pet` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pet`
--

INSERT INTO `pet` (`id`, `name`, `category_id`, `user_id`) VALUES
(52, 'Ninja', 4, 49),
(53, 'Scooby doo', 2, 49),
(73, 'freya', 1, 48),
(74, 'paf le chien ', 2, 48),
(75, 'plouf', 5, 48),
(78, 'Freya', 1, 50),
(81, 'Nyan', 1, 49);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `roles` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `first_name`, `last_name`, `password`, `roles`) VALUES
(48, 'corentin@kstr.com', 'Corentin', 'KISTLER', '$argon2i$v=19$m=65536,t=4,p=1$WGp5VGlsVEtxNkpZM1ZLaQ$jlUjyK9AInwRafG4+k6yTnY0T2ejIIYJ7Ncb7M0lj7k', 0),
(49, 'corentin@kstr.com2', 'Pierre', 'Rodriguez', '$argon2i$v=19$m=65536,t=4,p=1$MTVsNzJHU1ZJMkNacGpnUA$WBPRiIiPgOxIRhxD1DXKJKjI11qBNPea2I8ezMlwwTI', 0),
(50, 'admin@pierre.com', 'Admin', 'Pierre', '$argon2i$v=19$m=65536,t=4,p=1$ckc5NVFPb1k3ZG1DT2FFMg$/zM+i/elA6PT0N6OtzCzNZx0DqL6EISiDliOlqYbxXs', 1),
(51, 'corentin@kstr.com3', 'corentinkstr', '33333', '$argon2i$v=19$m=65536,t=4,p=1$b3BoQWFsc05CV1hpN0dWVQ$AH5oE7Vpev0SsBqmGo03oXE8otfrAEM0OLgkI3k6YBk', 0),
(52, 'corentin@kstr.com4', 'blabla', 'blabla', '$argon2i$v=19$m=65536,t=4,p=1$cU9lVHhQOGdvVXh5UEtxQg$983s7EaSAhzchIHXoWS9bGPtqP2gVf/heuuwuYqUut8', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `pet`
--
ALTER TABLE `pet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `pet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `pet_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
