-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 01 avr. 2019 à 12:48
-- Version du serveur :  5.7.17
-- Version de PHP :  7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bet`
--

-- --------------------------------------------------------

--
-- Structure de la table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `userId` int(11) NOT NULL,
  `balance` int(11) NOT NULL DEFAULT '10000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `bank_accounts`
--

INSERT INTO `bank_accounts` (`userId`, `balance`) VALUES
(1, 10000),
(3, 10000),
(24, 10000);

-- --------------------------------------------------------

--
-- Structure de la table `bets`
--

CREATE TABLE `bets` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `eventDate` date NOT NULL,
  `winOpt1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `winOpt2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `participationPrice` int(11) NOT NULL DEFAULT '0',
  `winningOption` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `bets`
--

INSERT INTO `bets` (`id`, `title`, `description`, `eventDate`, `winOpt1`, `winOpt2`, `participationPrice`, `winningOption`) VALUES
(1, 'test event', 'fake-event', '2019-10-10', 'team 1', 'team 2', 0, 'team 1'),
(2, 'Foot', 'Xamax vs Cortaillod', '2002-05-20', 'Xamax', 'Cortaillod', 10, 'Xamax'),
(3, 'asda', 'afsda', '2019-03-11', 'a', 'b', 0, 'b'),
(5, 'lallalal', 'cortagora', '2019-03-17', 'tr', 'trop', 50, 'tr'),
(6, 'Tennis', 'rogerfeder', '2019-03-05', 'Roger', 'Federer', 10, 'Roger'),
(7, 'Avec espace', 'roger vs nadal', '2019-03-05', 'roger', 'nadal', 8, 'nadal'),
(8, 'Ski de fond', 'evenement de ski de font dimanche', '2019-03-16', 'Martin', 'Paul', 0, 'Paul'),
(9, 'appweb', 'pari', '2019-03-13', 'gagne', 'perdu', 10, NULL),
(10, 'roger', 'Football', '2019-03-24', 'Francis', 'Lolo', 10000, 'Francis'),
(11, 'cors', 'corse', '2019-03-27', 'c', 'o', 10, 'o'),
(12, 'ski', 'descente', '2019-03-28', 'cuche', 'didier', 10, 'cuche');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'devtest', 'test@test.com', '$2y$10$piVIUle/gbI5G41E9YN0yu6mmWpjRPpKMqADU5s6TaGmaPbdnJxPW'),
(2, 'jonas', 'jonas.freiburghaus@he-arc.ch', '$2y$10$lu2/MCaF9IEZS4Z2t6Vk8.4XVaZhd2wHpEOBihCNDHE0rSEmYKCEu'),
(3, 'jo', 'jonas.freiburghaus@he-arc.ch', '$2y$10$g//ZgQTofmKkeurnaVuasOsGDWPbjwiqz4yqPKzBpYTCL.PtIpWGO'),
(10, 'jon', 'jonas.freiburghaus@he-arc.ch', '$2y$10$FAH5InNRKafMEscFK/ApZu8FxroB8dGjZ8kFALWOAhuNMk4Zyc7LS'),
(24, 'test', 'test@test.ch', '$2y$10$W/FFjwZWcWDi6N/jDsrs7OdkuRjwcW5y1LuWvpNVw51u9WKDxMEXO');

--
-- Déclencheurs `users`
--
DELIMITER $$
CREATE TRIGGER `create_bank_account` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO bank_accounts VALUES (NEW.id, DEFAULT)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `users_bets`
--

CREATE TABLE `users_bets` (
  `userId` int(11) NOT NULL,
  `betId` int(11) NOT NULL,
  `betOpt` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `users_bets`
--

INSERT INTO `users_bets` (`userId`, `betId`, `betOpt`) VALUES
(1, 1, 0),
(1, 2, 0),
(1, 3, 0),
(1, 5, 1),
(1, 6, 0),
(1, 7, 1),
(1, 8, 0),
(1, 9, 0),
(1, 10, 0),
(1, 11, 1),
(3, 10, 1),
(3, 11, 1),
(3, 12, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD UNIQUE KEY `userId` (`userId`);

--
-- Index pour la table `bets`
--
ALTER TABLE `bets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `users_bets`
--
ALTER TABLE `users_bets`
  ADD UNIQUE KEY `user_id` (`userId`,`betId`),
  ADD KEY `users_bets_ibfk_2` (`betId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bets`
--
ALTER TABLE `bets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD CONSTRAINT `bank_accounts_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users_bets`
--
ALTER TABLE `users_bets`
  ADD CONSTRAINT `users_bets_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_bets_ibfk_2` FOREIGN KEY (`betId`) REFERENCES `bets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
