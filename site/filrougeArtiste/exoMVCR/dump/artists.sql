-- phpMyAdmin SQL Dump
-- version 5.0.4deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql.info.unicaen.fr:3306
-- Généré le : lun. 28 nov. 2022 à 10:36
-- Version du serveur :  10.5.11-MariaDB-1
-- Version de PHP : 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `22012235_1`
--

-- --------------------------------------------------------

--
-- Structure de la table `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `nomDeNaissance` varchar(255) NOT NULL,
  `prenomDeNaissance` varchar(255) NOT NULL,
  `genreArtist` varchar(255) NOT NULL,
  `anneeDeNaissance` datetime NOT NULL,
  `villeDeNaissance` varchar(255) NOT NULL,
  `paysDeNaissance` varchar(255) NOT NULL,
  `genreMusic` varchar(255) NOT NULL,
  `year` datetime NOT NULL,
  `album` varchar(255) NOT NULL,
  `styleDeMusique` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `artists`
--

INSERT INTO `artists` (`id`, `artist`, `nomDeNaissance`, `prenomDeNaissance`, `genreArtist`, `anneeDeNaissance`, `villeDeNaissance`, `paysDeNaissance`, `genreMusic`, `year`, `album`, `styleDeMusique`, `image`) VALUES
(1, 'Dadju', 'Nsungula', 'Dadju Djuna', 'chanteur', '1991-05-02 00:00:00', 'Bobigny', 'Seine-Saint-Denis', 'hip-pop', '2012-01-01 00:00:00', 'Gentleman 2.0', 'RnB Français', 'dadju.jpg'),
(2, 'Rihanna', 'Robyn Rihanna', 'Fenty', 'chanteuse', '1988-02-20 00:00:00', 'Saint Michael', 'Barbade', 'pop', '2005-01-01 00:00:00', 'Music of the Sun', 'RnB', 'rihanna.jpg'),
(3, 'Céline Dion', 'Dion', 'Céline', 'chanteuse', '1968-03-30 00:00:00', 'Charlemagne', 'Québec', 'pop', '1981-01-01 00:00:00', 'Unison', 'Pop', 'celine.jpeg'),
(4, 'Ronisia', 'Morges', 'Ronisia Mendes', 'chanteuse', '1999-11-13 00:00:00', 'Tarrafal', 'Cap-Vert', 'rap et zouk', '2018-01-01 00:00:00', 'Ronisia', 'RnB', 'ronisia.jpeg'),
(5, 'Maître Gims', 'Nsungula', 'Ghandi Djuna', 'chanteur', '1986-05-06 00:00:00', 'Kinshasa', 'Zaïre', 'rap', '2009-01-01 00:00:00', 'Subliminal', 'Rap', 'gims.jpeg'),
(6, 'Aya Nakamura', 'Nakamura', 'Aya', 'chanteuse', '1993-04-07 00:00:00', 'Paris', 'France', 'Rap', '2017-01-01 00:00:00', 'Nakamura', 'Rap', 'aya.jpeg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
