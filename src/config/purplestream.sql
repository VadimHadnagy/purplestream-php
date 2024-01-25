-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 07 jan. 2024 à 23:54
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `purplestream`
--

-- --------------------------------------------------------

--
-- Structure de la table `anime`
--

CREATE TABLE `anime` (
  `anime_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `anime_name` varchar(100) DEFAULT NULL,
  `anime_description` text DEFAULT NULL,
  `anime_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `anime`
--

INSERT INTO `anime` (`anime_id`, `language_id`, `anime_name`, `anime_description`, `anime_image`) VALUES
(1, 1, 'Berserk of Gluttony', 'de compétences puissantes et les autres. Fate, modeste garde, s’est toujours retrouvé dans la seconde catégorie. En plus d’être inutile, son seul pouvoir agit comme une malédiction et lui procure une faim insatiable. Un jour, alors qu’il est de service, il tue un voleur qui s’était faufilé dans le château. Sa compétence s’active alors et dévore l’âme du malheureux. Découvrant un nouvel aspect de son pouvoir, celui d’ajouter les statistiques de ses victimes aux siennes, Fate commence son combat pour devenir plus fort et protéger celle qu’il aime. Mais tout pouvoir a un coût et la lutte pour ne pas sombrer dans la folie sera longue…', 'Berserk_Of_Gluttony.jpg'),
(2, 2, 'Dr stone', 'Un jour, une lumière brillante apparaît subitement dans le ciel pétrifiant en une fraction de seconde l’humanité entière. Des millénaires plus tard, Taiju parvient à briser son enveloppe de pierre et découvre un monde où le genre humain a disparu de la surface de la terre. Avec son ami Senku, ils décident de récréer la civilisation à partir de zéro !', 'animeDrstone.jpg'),
(3, 2, 'CyberPunk', 'lorem', 'Cyberpunk-Edgerunners.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `anime_cat`
--

CREATE TABLE `anime_cat` (
  `anime_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `anime_cat`
--

INSERT INTO `anime_cat` (`anime_id`, `category_id`) VALUES
(1, 1),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `anime_episode`
--

CREATE TABLE `anime_episode` (
  `anime_episodeid` int(11) NOT NULL,
  `season_id` int(11) NOT NULL,
  `episode_name` varchar(100) NOT NULL,
  `episode_mp4` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `anime_episode`
--

INSERT INTO `anime_episode` (`anime_episodeid`, `season_id`, `episode_name`, `episode_mp4`) VALUES
(1, 2, 'Episode 1', 'https://fusevideo.io/e/01v7G96KyJWrA6z'),
(2, 2, 'Episode 2', 'https://fusevideo.io/e/ye3A5Wm42WLgj5w'),
(3, 2, 'Episode 3', 'https://fusevideo.io/e/GxJlMbqO6jxRJ5g');

-- --------------------------------------------------------

--
-- Structure de la table `anime_season`
--

CREATE TABLE `anime_season` (
  `season_id` int(11) NOT NULL,
  `anime_id` int(11) NOT NULL,
  `season_name` varchar(30) NOT NULL,
  `season_description` text NOT NULL,
  `season_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `anime_season`
--

INSERT INTO `anime_season` (`season_id`, `anime_id`, `season_name`, `season_description`, `season_image`) VALUES
(2, 2, 'Saison 1', 'dz', 'download20210401190550.png'),
(4, 2, 'Saison 2', 'ezqd', 'qdqzdq.png'),
(6, 3, 'Saison 1', 'dzqdqzd', 'f446d7a2a155c6120742978fb528fb82.jpe');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'ecchi');

-- --------------------------------------------------------

--
-- Structure de la table `languages`
--

CREATE TABLE `languages` (
  `language_id` int(11) NOT NULL,
  `langage_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `languages`
--

INSERT INTO `languages` (`language_id`, `langage_name`) VALUES
(1, 'vostFr'),
(2, 'Vf');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_role` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_name`, `user_password`, `user_role`) VALUES
(1, 'frigo.franck@gmail.com', 'Dragone', '$2y$10$OcX7WVG0x7ysLnjaFy.rSue37JXcqyTQEaSPSG4YU2D8O5Ku50XWS', 0),
(2, 'bricejuli222@gmail.com', 'Dragone', '$2y$10$WyQcrFzHBKXEWqUpTe2yC.tmyOf6XO4Zii5iPguhZuap2qaW0wVKS', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users_profiles`
--

CREATE TABLE `users_profiles` (
  `user_profileid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_profilname` varchar(10) DEFAULT NULL,
  `user_image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `anime`
--
ALTER TABLE `anime`
  ADD PRIMARY KEY (`anime_id`),
  ADD KEY `fk_traduire` (`language_id`);

--
-- Index pour la table `anime_cat`
--
ALTER TABLE `anime_cat`
  ADD PRIMARY KEY (`anime_id`,`category_id`),
  ADD KEY `fk_correspondre2` (`category_id`);

--
-- Index pour la table `anime_episode`
--
ALTER TABLE `anime_episode`
  ADD PRIMARY KEY (`anime_episodeid`),
  ADD KEY `fk_avoir` (`season_id`);

--
-- Index pour la table `anime_season`
--
ALTER TABLE `anime_season`
  ADD PRIMARY KEY (`season_id`),
  ADD KEY `fk_diviser` (`anime_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Index pour la table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`language_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Index pour la table `users_profiles`
--
ALTER TABLE `users_profiles`
  ADD PRIMARY KEY (`user_profileid`),
  ADD KEY `fk_regrouper` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `anime`
--
ALTER TABLE `anime`
  MODIFY `anime_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `anime_episode`
--
ALTER TABLE `anime_episode`
  MODIFY `anime_episodeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `anime_season`
--
ALTER TABLE `anime_season`
  MODIFY `season_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `languages`
--
ALTER TABLE `languages`
  MODIFY `language_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users_profiles`
--
ALTER TABLE `users_profiles`
  MODIFY `user_profileid` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `anime`
--
ALTER TABLE `anime`
  ADD CONSTRAINT `fk_traduire` FOREIGN KEY (`language_id`) REFERENCES `languages` (`language_id`);

--
-- Contraintes pour la table `anime_cat`
--
ALTER TABLE `anime_cat`
  ADD CONSTRAINT `fk_correspondre` FOREIGN KEY (`anime_id`) REFERENCES `anime` (`anime_id`),
  ADD CONSTRAINT `fk_correspondre2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Contraintes pour la table `anime_episode`
--
ALTER TABLE `anime_episode`
  ADD CONSTRAINT `fk_avoir` FOREIGN KEY (`season_id`) REFERENCES `anime_season` (`season_id`);

--
-- Contraintes pour la table `anime_season`
--
ALTER TABLE `anime_season`
  ADD CONSTRAINT `fk_diviser` FOREIGN KEY (`anime_id`) REFERENCES `anime` (`anime_id`);

--
-- Contraintes pour la table `users_profiles`
--
ALTER TABLE `users_profiles`
  ADD CONSTRAINT `fk_regrouper` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
