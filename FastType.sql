-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 21 Juillet 2016 à 16:15
-- Version du serveur :  10.1.13-MariaDB
-- Version de PHP :  5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `FastType`
--

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

CREATE TABLE `game` (
  `id` int(11) UNSIGNED NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci,
  `status` int(11) UNSIGNED DEFAULT NULL,
  `difficulty` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `game`
--

INSERT INTO `game` (`id`, `label`, `text`, `status`, `difficulty`) VALUES
(8, 'Test', 'Test', 0, 1),
(9, 'Jeu', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ultrices nibh velit, vitae semper turpis faucibus ut. Phasellus in risus aliquet, vehicula massa ac, vulputate sapien. In at luctus magna. Nullam lacinia mauris nec lacus fringilla vulputate. Curabitur elit enim, lacinia at augue eu, convallis pulvinar dolor. Quisque volutpat finibus libero quis ullamcorper. Nullam ut turpis tincidunt, fermentum tellus at, dignissim massa. Aliquam fermentum orci a metus lacinia, quis placerat orci consectetur. Fusce tincidunt, tellus ut pharetra gravida, augue nunc lobortis risus, non dignissim lectus sapien vel nulla. Vestibulum ornare magna nisi, vitae rutrum velit pharetra nec. Sed malesuada mi ac dignissim ornare. Integer sit amet risus felis. Donec quis arcu ac quam mattis egestas. Cras vestibulum maximus rhoncus. Integer euismod eleifend orci, id imperdiet nisi volutpat in.', 0, 3);

-- --------------------------------------------------------

--
-- Structure de la table `match`
--

CREATE TABLE `match` (
  `id` int(11) UNSIGNED NOT NULL,
  `nb_try` int(11) UNSIGNED DEFAULT NULL,
  `id_user` int(11) UNSIGNED DEFAULT NULL,
  `id_game` int(11) UNSIGNED DEFAULT NULL,
  `time_start` datetime DEFAULT NULL,
  `score` double DEFAULT NULL,
  `time_played` int(11) UNSIGNED DEFAULT NULL,
  `time_end` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `match`
--

INSERT INTO `match` (`id`, `nb_try`, `id_user`, `id_game`, `time_start`, `score`, `time_played`, `time_end`) VALUES
(2, 2, 16, 8, '2016-07-20 11:27:00', 100, 7, '2016-07-20 11:27:09'),
(3, 1, 16, 9, '2016-07-20 11:27:19', 36, 3, '2016-07-20 11:27:22'),
(13, 2, 16, 8, '2016-07-20 11:41:12', 100, 5, '2016-07-20 11:41:18'),
(14, 1, 3, 8, '2016-07-20 11:42:01', 99.5, 3, '2016-07-20 11:42:05'),
(15, 2, 3, 8, '2016-07-20 11:42:11', 99.5, 4, '2016-07-20 11:42:15'),
(16, 1, 3, 9, '2016-07-20 11:42:24', 36.5, 4, '2016-07-20 11:42:28'),
(17, 1, 14, 8, '2016-07-20 11:42:40', 99, 2, '2016-07-20 11:42:43'),
(26, 1, 17, 8, '2016-07-20 17:39:57', 100, 15, '2016-07-20 17:40:14'),
(50, 3, 3, 8, '2016-07-21 07:44:41', 99.5, 14, '2016-07-21 10:44:55'),
(51, 2, 3, 9, '2016-07-21 07:45:04', 36, 20, '2016-07-21 10:45:25');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `element_uuid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `element_uuid`, `login`, `password`, `nom`, `prenom`, `mail`, `admin`) VALUES
(3, '576cf68814fb1', 'user', '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', 'user', 'name', 'user@user.com', '0'),
(6, '576d08ce8d15f', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin', 'admin', 'admin@admin.com', '1'),
(14, '5784a803f243e', 'user2', '6025d18fe48abd45168528f18a82e265dd98d421a7084aa09f61b341703901a3', '2', 'user', 'user2@user.com', '0'),
(15, '5784a88f9c8ee', 'user3', '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', '3', 'user', 'user3@user.com', '0'),
(16, '578c9e7d4642f', 'malek', '4c0fa120902a9707d2d3419b5d097236a363695d41340a1e37ae681a0520fc13', 'Marrakchi', 'Malek', 'malek@gmail.com', '0'),
(17, '578f9b356f3af', 'salma', '25d4824df60545545311648b993309da936607a8fe537f5dc10b3fb38da31aab', 'Asswad', 'Salma', 's@a.com', '0');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `match`
--
ALTER TABLE `match`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `game`
--
ALTER TABLE `game`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `match`
--
ALTER TABLE `match`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
