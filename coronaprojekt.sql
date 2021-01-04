-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 11. Jul 2020 um 18:54
-- Server-Version: 10.4.13-MariaDB
-- PHP-Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `coronaprojekt`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `id` int(11) NOT NULL,
  `vname` text NOT NULL,
  `nname` text NOT NULL,
  `username` varchar(25) NOT NULL,
  `passwort` varchar(1000) NOT NULL,
  `behinderung` varchar(1000) NOT NULL,
  `age` int(11) NOT NULL,
  `hobbys` varchar(1000) NOT NULL,
  `inserted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`id`, `vname`, `nname`, `username`, `passwort`, `behinderung`, `age`, `hobbys`, `inserted_at`) VALUES
(1, 'Dennis2', 'test2', 'Dennis96', '$2y$10$K6mt5gfdo.WKvJ1q0/RIDuQjP2rLJ6RDWUHK/75l.6XsHkM4/1uQW', 'löl', 25, 'solala8589', '2020-07-09 13:15:07'),
(3, 'aslo', 'losa', 'aslo123', '$2y$10$K6mt5gfdo.WKvJ1q0/RIDuQjP2rLJ6RDWUHK/75l.6XsHkM4/1uQW', 'opa', 25, 'loal8989', '2020-07-09 13:47:14');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bilder`
--

CREATE TABLE `bilder` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `uploaded_on` datetime NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `bilder`
--

INSERT INTO `bilder` (`id`, `file_name`, `uploaded_on`, `username`) VALUES
(5, 'me.jpg', '2020-07-09 18:05:28', 'Dennis96'),
(7, '2asxl.png', '2020-07-10 14:10:18', 'aslo123'),
(8, 'me.png', '2020-07-10 14:53:21', 'Dennis96'),
(9, 'me.png', '2020-07-10 14:53:34', 'Dennis96'),
(10, 'me.png', '2020-07-10 15:01:24', 'Dennis96'),
(11, 'me.jpg', '2020-07-10 15:04:39', 'aslo123'),
(12, 'backgr.jpg', '2020-07-10 15:05:59', 'aslo123'),
(13, 'me.jpg', '2020-07-10 15:08:41', 'aslo123');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `eintraege`
--

CREATE TABLE `eintraege` (
  `id` int(11) NOT NULL,
  `ueberschrift` text NOT NULL,
  `text` text NOT NULL,
  `inserted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `eintraege`
--

INSERT INTO `eintraege` (`id`, `ueberschrift`, `text`, `inserted_at`, `username`) VALUES
(1, 'asdf', ' asdcv', '2020-07-09 11:24:10', 'Dennis96'),
(2, 'Test am 08.07.2020', 'Hallo ', '2020-07-09 11:26:08', 'also123'),
(3, 'tes', 'tes', '2020-07-09 11:28:02', 'Dennis96'),
(4, 'Das wird nix', 'oder doch?', '2020-07-09 13:19:35', 'aslo123'),
(5, 'gfds', 'asdc', '2020-07-10 07:58:11', 'Dennis96');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `bilder`
--
ALTER TABLE `bilder`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `eintraege`
--
ALTER TABLE `eintraege`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT für Tabelle `bilder`
--
ALTER TABLE `bilder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `eintraege`
--
ALTER TABLE `eintraege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
