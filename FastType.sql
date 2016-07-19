-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 18 Juillet 2016 à 15:18
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
(1, 1, 3, 8, '2016-07-18 14:24:48', 0, 300, '-1'),
(2, 2, 3, 8, '2016-07-18 14:26:54', 0, 300, '-1'),
(3, 3, 3, 8, '2016-07-18 14:28:23', 0, 300, '-1'),
(4, 1, 3, 9, '2016-07-18 14:34:40', 0, 300, '-1'),
(5, 1, 3, 8, '2016-07-18 14:36:03', 0, 300, '-1'),
(6, 2, 3, 8, '2016-07-18 14:37:21', 0, 300, '-1'),
(7, 3, 3, 8, '2016-07-18 14:37:38', 0, 300, '-1'),
(8, 1, 3, 9, '2016-07-18 14:37:47', 0, 300, '-1'),
(9, 1, 3, 8, '2016-07-18 14:37:53', 0, 300, '-1'),
(10, 2, 3, 8, '2016-07-18 14:40:36', 0, 300, '-1'),
(11, 1, 3, 8, '2016-07-18 17:00:00', 0, 300, '-1'),
(12, 2, 3, 8, '2016-07-18 14:49:41', 0, 300, '-1'),
(13, 1, 3, 8, '2016-07-18 17:51:05', 0, 300, '-1'),
(14, 2, 3, 8, '2016-07-18 14:55:25', 0, 300, '-1'),
(15, 1, 3, 8, '2016-07-18 17:55:34', 0, 300, '-1'),
(16, 2, 3, 8, '2016-07-18 15:02:31', 0, 300, '-1'),
(17, 3, 3, 8, '2016-07-18 15:03:21', 0, 300, '-1'),
(18, 1, 3, 9, '2016-07-18 15:04:26', 0, 300, '-1'),
(19, 2, 3, 9, '2016-07-18 15:04:40', 0, 300, '-1'),
(20, 1, 3, 8, '2016-07-18 15:04:55', 0, 300, '-1'),
(21, 2, 3, 8, '2016-07-18 15:05:07', 0, 300, '-1'),
(22, 3, 3, 8, '2016-07-18 15:05:20', 0, 300, '-1'),
(23, 1, 3, 9, '2016-07-18 15:06:44', 0, 300, '-1'),
(24, 1, 3, 8, '2016-07-18 15:06:59', 0, 300, '-1'),
(25, 2, 3, 8, '2016-07-18 15:07:54', 0, 300, '-1'),
(26, 3, 3, 8, '2016-07-18 15:08:23', 0, 300, '-1'),
(27, 1, 3, 9, '2016-07-18 15:11:50', 0, 300, '-1'),
(28, 1, 3, 8, '2016-07-18 15:13:05', 0, 300, '-1'),
(29, 2, 3, 8, '2016-07-18 15:13:19', 0, 300, '-1'),
(30, 3, 3, 8, '2016-07-18 15:14:08', 0, 300, '-1'),
(31, 1, 3, 9, '2016-07-18 15:14:31', 0, 300, '-1'),
(32, 1, 3, 8, '2016-07-18 15:15:15', 100, 7, '2016-07-18 15:15:21'),
(33, 2, 3, 8, '2016-07-18 15:16:02', 100, 2, '2016-07-18 15:16:05'),
(34, 3, 3, 8, '2016-07-18 15:17:42', 100, 3, '2016-07-18 15:17:45');

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
(16, '578c9e7d4642f', 'malek', '4c0fa120902a9707d2d3419b5d097236a363695d41340a1e37ae681a0520fc13', 'Marrakchi', 'Malek', 'malek@gmail.com', '0');

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
