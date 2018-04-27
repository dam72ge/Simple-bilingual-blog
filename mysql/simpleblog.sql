-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Creato il: Gen 27, 2018 alle 10:52
-- Versione del server: 5.7.21-0ubuntu0.16.04.1
-- Versione PHP: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpleblog`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `album`
--

CREATE TABLE `album` (
  `idAlbum` int(11) NOT NULL,
  `osc` varchar(1) NOT NULL DEFAULT 'n',
  `data` datetime NOT NULL COMMENT 'AAAA-MM-GG HH:MM:SS',
  `idFoto` int(11) NOT NULL COMMENT 'copertina album',
  `titleIT` varchar(255) NOT NULL,
  `titleEN` varchar(255) NOT NULL,
  `testoIT` text NOT NULL,
  `testoEN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `album`
--

INSERT INTO `album` (`idAlbum`, `osc`, `data`, `idFoto`, `titleIT`, `titleEN`, `testoIT`, `testoEN`) VALUES
(1, 'n', '2018-01-27 10:39:49', 3, 'Lorem ipsum', 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.');

-- --------------------------------------------------------

--
-- Struttura della tabella `articoli`
--

CREATE TABLE `articoli` (
  `idArt` int(11) NOT NULL,
  `osc` varchar(1) NOT NULL DEFAULT 'n',
  `datetime` datetime NOT NULL COMMENT 'AAAA-MM-GG HH:MM:SS',
  `dateday` varchar(3) NOT NULL COMMENT 'Mon-Sun',
  `titleIT` varchar(255) NOT NULL,
  `titleEN` varchar(255) NOT NULL,
  `testoIT` text NOT NULL,
  `testoEN` text NOT NULL,
  `tagIT` varchar(255) NOT NULL,
  `tagEN` varchar(255) NOT NULL,
  `idFoto` int(11) NOT NULL,
  `idAlbum` int(11) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `articoli`
--

INSERT INTO `articoli` (`idArt`, `osc`, `datetime`, `dateday`, `titleIT`, `titleEN`, `testoIT`, `testoEN`, `tagIT`, `tagEN`, `idFoto`, `idAlbum`, `file`) VALUES
(1, 'n', '2018-01-27 10:39:03', 'Sat', 'Lorem ipsum', 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.', 'Lorem, ipsum, dolor', 'Lorem, ipsum, dolor', 1, 0, '');

-- --------------------------------------------------------

--
-- Struttura della tabella `commenti`
--

CREATE TABLE `commenti` (
  `idComm` int(11) NOT NULL,
  `osc` varchar(1) NOT NULL DEFAULT 'a',
  `idArt` int(11) NOT NULL COMMENT 'articolo collegato',
  `testo` text NOT NULL,
  `autore` varchar(255) NOT NULL,
  `data` datetime NOT NULL COMMENT 'AAAA-MM-GG HH:MM:SS',
  `email` varchar(255) NOT NULL COMMENT 'facoltativa',
  `streppa` varchar(1) NOT NULL DEFAULT 'n' COMMENT 'risposta admin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `foto`
--

CREATE TABLE `foto` (
  `idFoto` int(11) NOT NULL,
  `idAlbum` int(11) NOT NULL,
  `osc` varchar(1) NOT NULL DEFAULT 'n',
  `data` datetime NOT NULL COMMENT 'AAAA-MM-GG HH:MM:SS',
  `titleIT` varchar(255) NOT NULL,
  `titleEN` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `foto`
--

INSERT INTO `foto` (`idFoto`, `idAlbum`, `osc`, `data`, `titleIT`, `titleEN`, `file`) VALUES
(1, 1, 'n', '2018-01-27 10:42:48', 'Immagine uno', 'First image', 'senzarotelle.jpg'),
(2, 1, 'n', '2018-01-27 10:44:17', 'Immagine due', 'Second image', 'take-risks.jpg'),
(3, 1, 'n', '2018-01-27 10:44:38', 'Immagine tre', 'Third image', 'stupidity.jpg');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`idAlbum`);

--
-- Indici per le tabelle `articoli`
--
ALTER TABLE `articoli`
  ADD PRIMARY KEY (`idArt`);

--
-- Indici per le tabelle `commenti`
--
ALTER TABLE `commenti`
  ADD PRIMARY KEY (`idComm`);

--
-- Indici per le tabelle `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`idFoto`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `album`
--
ALTER TABLE `album`
  MODIFY `idAlbum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT per la tabella `articoli`
--
ALTER TABLE `articoli`
  MODIFY `idArt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT per la tabella `commenti`
--
ALTER TABLE `commenti`
  MODIFY `idComm` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `foto`
--
ALTER TABLE `foto`
  MODIFY `idFoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
