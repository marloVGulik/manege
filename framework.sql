-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 14 jun 2020 om 17:29
-- Serverversie: 10.4.11-MariaDB
-- PHP-versie: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `framework`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `horses`
--

CREATE TABLE `horses` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `race` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `used-for-jump` tinyint(1) NOT NULL,
  `height` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `horses`
--

INSERT INTO `horses` (`id`, `name`, `race`, `age`, `used-for-jump`, `height`) VALUES
(2, 'Frikandel #1 V2', 4, 9, 0, 140),
(3, 'Frikandel #1', 4, 18, 0, 69),
(4, 'Frikandel #2', 2, 14, 0, 62);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `planning`
--

CREATE TABLE `planning` (
  `id` int(11) NOT NULL,
  `rider-id` int(11) NOT NULL,
  `horse-id` int(11) NOT NULL,
  `planned-date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `planning`
--

INSERT INTO `planning` (`id`, `rider-id`, `horse-id`, `planned-date`) VALUES
(1, 1, 2, '2020-06-17 00:00:00'),
(2, 1, 2, '2020-06-17 00:00:00'),
(7, 1, 4, '2020-06-19 12:00:00'),
(8, 2, 3, '2020-06-16 11:11:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `races`
--

CREATE TABLE `races` (
  `id` int(11) NOT NULL,
  `racename` varchar(30) NOT NULL,
  `witherheight-min` int(11) NOT NULL,
  `witherheight-max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `races`
--

INSERT INTO `races` (`id`, `racename`, `witherheight-min`, `witherheight-max`) VALUES
(1, 'Friesian', 152, 173),
(2, 'Arabian horse', 145, 155),
(4, 'Halflinger', 135, 155);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `riders`
--

CREATE TABLE `riders` (
  `id` int(11) NOT NULL,
  `admin` int(1) NOT NULL DEFAULT 0,
  `login-name` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `phonenumber` int(11) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `riders`
--

INSERT INTO `riders` (`id`, `admin`, `login-name`, `name`, `address`, `phonenumber`, `password`) VALUES
(1, 1, 'MJvG2', 'Marlo van Gulik', 'Nederland', 2147483647, 'a1af0bfcb4baadd0a489d91d62c99310dee9201498084d4f350a4a25b7ee9ae747c87e9304d2bad969078de63062f77ddfe84c30f9bf9a7d66eaa5cb9d5e6486'),
(2, 0, 'Henk', 'Henk De Bakteen', 'Friesland', 2147483647, 'a1af0bfcb4baadd0a489d91d62c99310dee9201498084d4f350a4a25b7ee9ae747c87e9304d2bad969078de63062f77ddfe84c30f9bf9a7d66eaa5cb9d5e6486'),
(3, 0, 'Oeter', 'Oeter de Fries', 'Afghanistan', 42070, '9452d2966c7eca579b140c62a21c8536d670da9a0facd21ac5c001ba9e22ddce9c58dc0f7eb8073af1e76d5eb9d1f31d005c14bfecb33cc20c6d25a15a4693b2'),
(5, 1, 'admin', 'Root', 'The database', 127001, '4a3e7b9dc5ade9f94867d21e152595c50319970ccf874f616d78c8ce5456aea0f0b7fe09a13b6334deb05b0899251e19e2b1f022be19509d755343a09cb7072a');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `student`
--

INSERT INTO `student` (`student_id`, `student_name`) VALUES
(99041392, 'Johan ter Wolde'),
(99041393, 'Johan Vlemminx'),
(99041394, 'Ben Vreemdeling');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `horses`
--
ALTER TABLE `horses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexen voor tabel `planning`
--
ALTER TABLE `planning`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `races`
--
ALTER TABLE `races`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `riders`
--
ALTER TABLE `riders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login-name` (`login-name`);

--
-- Indexen voor tabel `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `horses`
--
ALTER TABLE `horses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `planning`
--
ALTER TABLE `planning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT voor een tabel `races`
--
ALTER TABLE `races`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `riders`
--
ALTER TABLE `riders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99041395;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
