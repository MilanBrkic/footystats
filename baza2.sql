-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2019 at 12:07 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baza2`
--

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `id` int(5) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `stadium` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `league_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`id`, `name`, `stadium`, `league_id`) VALUES
(1, 'FC Barcelona', 'Camp Nou', 1),
(2, 'Juventus', 'Allianz Stadium', 3),
(3, 'Real Madrid', 'Santiago Bernabeu', 1),
(4, 'Atletico Madrid', 'Wanda Metropolitano', 1),
(5, 'Liverpool', 'Anfield', 2),
(6, 'Manchester City', 'Etihad Stadium', 2),
(8, 'Manchester United', 'Old Trafford', 2),
(9, 'Arsenal', 'Emirates Stadium', 2),
(10, 'Chelsea', 'Stamford Bridge', 2),
(11, 'Bayern Munchen', 'Allianz Arena', 4),
(12, 'Borrusia Dortmund', 'Signal Iduna Park', 4),
(13, 'Paris Saint-Germain', 'Parc des Princes', 5),
(14, 'Inter', 'Giuseppe Meazza', 3),
(15, 'Ajax', 'Johan Cruyff Arena', 9),
(16, 'Leicester City', 'King Power Stadium', 2),
(19, 'Villareal', 'El Madrigal', 1),
(20, 'Partizan', 'JNA', 13);

-- --------------------------------------------------------

--
-- Table structure for table `league`
--

CREATE TABLE `league` (
  `id` int(5) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nation_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `league`
--

INSERT INTO `league` (`id`, `name`, `nation_id`) VALUES
(1, 'La Liga', 1),
(2, 'Premier League', 2),
(3, 'Seria A', 3),
(4, 'Bundesliga', 4),
(5, 'League 1', 5),
(7, 'Liga NOS', 6),
(9, 'Eredvisie', 9),
(13, 'Jelen Superliga', 10),
(20, 'First Division A', 17);

-- --------------------------------------------------------

--
-- Table structure for table `nation`
--

CREATE TABLE `nation` (
  `id` int(5) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nation`
--

INSERT INTO `nation` (`id`, `name`) VALUES
(1, 'Spain'),
(2, 'England'),
(3, 'Italy'),
(4, 'Germany'),
(5, 'France'),
(6, 'Portugal'),
(7, 'Argentina'),
(8, 'Egypt'),
(9, 'Netherlands'),
(10, 'Serbia'),
(11, 'Uruguay'),
(12, 'Brazil'),
(13, 'Croatia'),
(14, 'Russia'),
(15, 'Senegal'),
(16, 'Algeria'),
(17, 'Belgium'),
(18, 'Chile'),
(19, 'Colombia'),
(20, 'Danmark'),
(21, 'Poland'),
(22, 'Wales'),
(170, 'Sweden');

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `id` int(5) NOT NULL,
  `firstname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `age` int(3) NOT NULL,
  `position` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `goals` int(5) NOT NULL,
  `nation_id` int(5) NOT NULL,
  `club_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`id`, `firstname`, `lastname`, `age`, `position`, `goals`, `nation_id`, `club_id`) VALUES
(1, 'Lionel', 'Messi', 32, 'attacker', 687, 7, 1),
(2, 'Cristiano', 'Ronaldo', 34, 'attacker', 709, 6, 2),
(3, 'Virgil', 'van Dijk', 28, 'defender', 43, 9, 5),
(4, 'Sergio', 'Aguero', 31, 'attacker', 409, 7, 6),
(5, 'Luka', 'Jovic', 22, 'attacker', 63, 10, 3),
(6, 'Dusan', 'Tadic', 32, 'midfielder', 161, 10, 15),
(7, 'Jamie', 'Vardy', 32, 'attacker', 164, 2, 16),
(8, 'Kevin', 'de Bruyne', 28, 'midfielder', 111, 17, 6),
(9, 'Luis', 'Suarez', 23, 'attacker', 455, 11, 1),
(10, 'Gareth', 'Bale', 30, 'attacker', 200, 22, 3),
(11, 'Neymar', '', 27, 'attacker', 294, 12, 13),
(12, 'Gerard', 'Pique', 32, 'defender', 38, 1, 1),
(13, 'Jao', 'Felix', 20, 'attacker', 30, 6, 4),
(14, 'David', 'de Gea', 29, 'goalkeeper', 0, 1, 8),
(15, 'Antoine', 'Griezmann', 28, 'attacker', 224, 5, 1),
(16, 'Frenkie', 'de Jong', 22, 'midfielder', 4, 9, 1),
(17, 'Marc-Andre', 'ter Stegen', 27, 'goalkeeper', 0, 4, 1),
(18, 'Luka', 'Modric', 34, 'midfielder', 74, 13, 3),
(19, 'Sergio', 'Ramos', 33, 'defender', 113, 1, 3),
(20, 'Marcelo', '', 23, 'defender', 45, 12, 3),
(22, 'Mo', 'Salah', 28, 'attacker', 150, 8, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id`),
  ADD KEY `league_id` (`league_id`);

--
-- Indexes for table `league`
--
ALTER TABLE `league`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nation_id` (`nation_id`);

--
-- Indexes for table `nation`
--
ALTER TABLE `nation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_club` (`club_id`),
  ADD KEY `nation_id` (`nation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `league`
--
ALTER TABLE `league`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `nation`
--
ALTER TABLE `nation`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `club_ibfk_1` FOREIGN KEY (`league_id`) REFERENCES `league` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `league`
--
ALTER TABLE `league`
  ADD CONSTRAINT `league_ibfk_1` FOREIGN KEY (`nation_id`) REFERENCES `nation` (`id`);

--
-- Constraints for table `player`
--
ALTER TABLE `player`
  ADD CONSTRAINT `player_ibfk_1` FOREIGN KEY (`club_id`) REFERENCES `club` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `player_ibfk_2` FOREIGN KEY (`nation_id`) REFERENCES `nation` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
