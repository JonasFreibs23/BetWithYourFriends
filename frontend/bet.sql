-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 06 juin 2019 à 11:19
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `bank_accounts`
--

INSERT INTO `bank_accounts` (`userId`, `balance`) VALUES
(1, 10000),
(3, 10000),
(24, 10000),
(25, 2152),
(26, 12000),
(27, 10000),
(28, 37000);

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
  `winningOption` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `altered` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `bets`
--

INSERT INTO `bets` (`id`, `title`, `description`, `eventDate`, `winOpt1`, `winOpt2`, `participationPrice`, `winningOption`, `altered`) VALUES
(1, 'test event', 'fake-event', '2019-10-10', 'team 1', 'team 2', 0, 'team 1', 0),
(2, 'Foot', 'Xamax vs Cortaillod', '2002-05-20', 'Xamax', 'Cortaillod', 10, 'Xamax', 0),
(3, 'asda', 'afsda', '2019-03-11', 'a', 'b', 0, 'b', 0),
(5, 'lallalal', 'cortagora', '2019-03-17', 'tr', 'trop', 50, 'tr', 0),
(6, 'Tennis', 'rogerfeder', '2019-03-05', 'Roger', 'Federer', 10, 'Roger', 0),
(7, 'Avec espace', 'roger vs nadal', '2019-03-05', 'roger', 'nadal', 8, 'nadal', 0),
(8, 'Ski de fond', 'evenement de ski de font dimanche', '2019-03-16', 'Martin', 'Paul', 0, 'Paul', 0),
(9, 'appweb', 'pari', '2019-03-13', 'gagne', 'perdu', 10, NULL, 0),
(10, 'roger', 'Football', '2019-03-24', 'Francis', 'Lolo', 10000, 'Francis', 0),
(11, 'cors', 'corse', '2019-03-27', 'c', 'o', 10, 'o', 0),
(12, 'ski', 'descente', '2019-03-28', 'cuche', 'didier', 10, 'cuche', 0),
(13, 'cors', 'corse', '2019-03-27', 'c', 'o', 10, 'o', 0),
(14, 'cors', 'corse', '2019-03-27', 'c', 'o', 10, 'o', 0),
(15, 'coucou', 'akfjlakdsj', '2019-04-25', '1', '2', 100, '1', 1),
(16, 'deux', 'test', '2019-04-25', '1', '2', 100, '1', 1),
(17, 'sfdlsk', 'ajdls', '2019-04-25', 'skjfdsh', 'skfs', 100, 'skjfdsh', 1),
(18, 'adsdfkjn', 'dkjs', '2019-04-26', 'sdfjsl', 'sdlkfsj', 1000, 'sdlkfsj', 1),
(19, 'yka', 'skfjs', '2019-04-26', 'akda', 'slfk', 100, 'akda', 1),
(20, 'fdkjfgd', 'akdjha', '2019-04-26', 'akjh', 'sldfkjsj', 1000, 'akjh', 1),
(21, 'taa', 'sfdjks', '2019-04-25', 'adkj', 'skfjls', 1000, 'adkj', 1),
(22, 'ajdalk', 'sdfksl', '2019-04-25', 'askdjd', 'slfkdjl', 1000, 'askdjd', 1),
(23, 'ssfkjf', 'skfjs', '2019-04-25', 'lkfsjds', 'ldsfkjj', 1000, 'lkfsjds', 1),
(24, 'adjadlak', 'akdkjal', '2019-04-25', '123', '234', 1000, '234', 1),
(25, 'alkdjla', 'slkdfsjl', '2019-04-26', '1234', '2345', 1000, '2345', 1),
(26, 'sakdalkada', 'sfs', '2019-04-25', '12345', '23456', 1000, '23456', 1),
(27, 'asjdak', 'adja', '2019-04-25', 'asdjl', 'dalsklj', 1000, 'asdjl', 1),
(28, 'slkfslk', 'slfjksl', '2019-04-26', '199', '200', 1000, '199', 1),
(29, 'skjfhskjfslfjkjl', 'lfjdsl', '2019-04-25', '200', '201', 1000, '201', 1),
(30, 's,dfhskj', 'skfjls', '2019-04-26', '201', '202', 1000, '202', 1),
(31, ',fskfdjslkfdjsklf', 'slfjsl', '2019-04-25', '203', '204', 1000, '204', 1),
(32, ',fkdjsldf', 'slkfdjsl', '2019-04-25', '205', '206', 1000, '206', 1),
(33, 'adjlka', 'slkajdla', '2019-04-29', '500', '501', 100, '501', 1),
(34, 'slkflks', 'wlkl', '2019-04-29', '502', '503', 100, '503', 1),
(35, 'jasdkh', 'asjdla', '2019-04-28', '506', '507', 1000, '507', 1),
(36, 'lkwjflkjs', 'kdjslk', '2019-04-29', '508', '509', 1000, '509', 1),
(37, 'sjdfks', 'wkjl', '2019-04-29', '510', '511', 1000, '511', 1),
(38, 'akjdahk', 'sjkdf', '2019-04-29', '512', '513', 2000, '513', 1),
(39, 'ajsdhka', 'aksdla', '2019-04-28', '514', '515', 300, '515', 1),
(40, 'sdfslkfs', 'kdsjls', '2019-04-29', '516', '517', 301, '517', 1),
(41, 'smnf,s', 'wkdwjfls', '2019-04-29', '518', '519', 302, '519', 1),
(42, 'sfs', 'kjdkjsl', '2019-04-29', '1', '2', 100, '1', 1),
(43, 'skjfks', 'sfsk', '2019-04-28', '600', '601', 100, '600', 1),
(44, 'skfl', 'fkjsl', '2019-04-29', '1000', '1001', 10, '1000', 1),
(45, 'smfs', 'sdf.s', '2019-04-29', 'sksdfsf', 'sfs', 10, 'sksdfsf', 1),
(46, 'sfs', 'sdfsf', '2019-04-29', 'a', 'b', 10, 'a', 1),
(47, 'sdfssdfsd', 'sdf', '2019-04-29', 'a', 'b', 10, 'a', 1),
(48, 'xcjvk', 'sfnlk', '2019-04-28', '1', '2', 10, '1', 1),
(49, 'adkskdslkasdsjal', 'skjdf', '2019-04-29', '1', '2', 10, '1', 1),
(50, 'sdfdfss', 'sdfs', '2019-04-29', '1', '2', 10, '1', 1),
(51, 'sdfkls', 'skdjfh', '2019-04-28', 'a', 'b', 10, 'a', 1),
(52, 'skjfhks', 'sdjfls', '2019-04-28', 'ab', 'cd', 10, 'cd', 1),
(53, 'ssdsfs', 'sfdad\n', '2019-04-29', '1', '2', 10, '2', 1),
(54, 'asd', 'asd', '2019-04-29', '1', '2', 10, '2', 1),
(55, 'sdda', 'asd', '2019-04-28', '1', '2', 10, '2', 1),
(56, 'ksjfdhsk', 'kasjfhsk', '2019-04-29', 'oui', 'non', 10, 'non', 1),
(57, 'sfd', 'kfdjsl', '2019-04-27', 'ouioui', 'nonnon', 10, 'nonnon', 1),
(58, 'akdjakjsdadsklaj', 'skajsd', '2019-04-27', 'ouiouioui', 'nonnonnon', 10, 'ouiouioui', 1),
(59, 'kldfjlskjf', 'sdkfls', '2019-04-28', 'v', 'f', 10, 'v', 1),
(60, 'Ca Marche !!!!', 'enfin je crois', '2019-04-28', 'jycrois', 'nonnonnon', 10, 'jycrois', 1),
(61, 'djfks', 'smfns,', '2019-05-28', 'sf', 'sd', 100, NULL, 0),
(62, 'dfgdfgd', 'dgf', '2019-05-27', 'df', 'adsa', 100, NULL, 0),
(63, 'ada', 'ads', '2019-05-26', 'asda', 'sdaa', 234, NULL, 0),
(64, 'sfksjk', 'akjdhaskd', '2019-05-29', '23', '12', 100000, NULL, 0),
(65, 'ouii', 'ouiiii', '2019-06-05', 'oui', 'ouiouioui', 4000, 'oui', 1);

-- --------------------------------------------------------

--
-- Structure de la table `trade`
--

CREATE TABLE `trade` (
  `tradeId` int(11) NOT NULL,
  `userIdAsk` int(11) NOT NULL,
  `userIdAccept` int(11) NOT NULL,
  `isAccepted` tinyint(1) DEFAULT NULL,
  `isPaid` tinyint(1) DEFAULT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `trade`
--

INSERT INTO `trade` (`tradeId`, `userIdAsk`, `userIdAccept`, `isAccepted`, `isPaid`, `value`) VALUES
(36, 25, 28, NULL, NULL, 10000),
(39, 28, 25, 1, 1, 3000),
(40, 25, 2, NULL, NULL, 3000);

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
(24, 'test', 'test@test.ch', '$2y$10$W/FFjwZWcWDi6N/jDsrs7OdkuRjwcW5y1LuWvpNVw51u9WKDxMEXO'),
(25, 'roro', 'roro@roro.ch', '$2y$10$B93qHOHcaH4mJ8Y69XLJC.wvF/lFnrqy1kV4l5gMsIwEuPzmo8TLC'),
(26, 'roxane', 'roxane@arc.ch', '$2y$10$Vv.CKHRYUQ1s567YzWXopesr4G1avFeu5G9MAyYeBoeZMUUToQD3W'),
(27, 'ro', 'ro@arc.ch', '$2y$10$6w0EdN1Y461ohAm0tUn/3ecMoBs89MVjD1laSga/Bp73PNKcm/OGe'),
(28, 'rrrr', 'r@rr.ch', '$2y$10$2Kkn6oz56dFltNzBp1ySUecU3fjXDmURdH5c.RECCMGZR3z7GwAKK');

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
(3, 12, 0),
(25, 11, 0),
(25, 12, 0),
(25, 15, 0),
(25, 16, 0),
(25, 17, 0),
(25, 18, 0),
(25, 19, 0),
(25, 20, 0),
(25, 21, 0),
(25, 22, 0),
(25, 23, 0),
(25, 24, 0),
(25, 25, 0),
(25, 26, 0),
(25, 27, 0),
(25, 28, 0),
(25, 29, 0),
(25, 30, 0),
(25, 31, 0),
(25, 32, 0),
(25, 33, 0),
(25, 34, 0),
(25, 35, 0),
(25, 36, 0),
(25, 37, 0),
(25, 38, 0),
(25, 39, 0),
(25, 40, 0),
(25, 41, 0),
(25, 42, 0),
(25, 43, 0),
(25, 44, 0),
(25, 45, 0),
(25, 46, 0),
(25, 47, 0),
(25, 48, 0),
(25, 49, 0),
(25, 50, 0),
(25, 51, 0),
(25, 52, 0),
(25, 53, 0),
(25, 54, 0),
(25, 55, 0),
(25, 56, 0),
(25, 57, 0),
(25, 58, 0),
(25, 59, 1),
(25, 60, 0),
(25, 65, 0);

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
-- Index pour la table `trade`
--
ALTER TABLE `trade`
  ADD PRIMARY KEY (`tradeId`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT pour la table `trade`
--
ALTER TABLE `trade`
  MODIFY `tradeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
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
