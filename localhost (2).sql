-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generato il: Lug 23, 2013 alle 14:14
-- Versione del server: 5.1.49
-- Versione PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `conti`
--
CREATE DATABASE `conti` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `conti`;

-- --------------------------------------------------------

--
-- Struttura della tabella `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cat_it` varchar(150) NOT NULL,
  `nome_cat_en` varchar(150) DEFAULT NULL,
  `nome_cat_de` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `foto`
--

CREATE TABLE IF NOT EXISTS `foto` (
  `id_foto` int(11) NOT NULL AUTO_INCREMENT,
  `nome_foto` varchar(60) NOT NULL,
  `titolo_foto_it` tinytext NOT NULL,
  `titolo_foto_en` tinytext,
  `titolo_foto_de` tinytext,
  `descrizione_foto_it` text NOT NULL,
  `descrizione_foto_en` text,
  `id_gallerie` int(11) NOT NULL,
  `descrizione_foto_de` text,
  `tipo_foto` enum('fotografia','pittura') NOT NULL,
  `evidenza` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_foto`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dump dei dati per la tabella `foto`
--

INSERT INTO `foto` (`id_foto`, `nome_foto`, `titolo_foto_it`, `titolo_foto_en`, `titolo_foto_de`, `descrizione_foto_it`, `descrizione_foto_en`, `id_gallerie`, `descrizione_foto_de`, `tipo_foto`, `evidenza`) VALUES
(1, 'foto01.gif', 'Titolo di prova', NULL, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in diam mauris, vel euismod mi. Phasellus dui risus, gravida et placerat sit amet, blandit quis diam. Nunc ut arcu nec massa aliquam blandit. Praesent facilisis ornare ornare. Nam vel venenatis erat. Praesent ultrices pellentesque dolor non malesuada. Duis eu odio ut arcu convallis malesuada non quis mauris.', NULL, 6, NULL, 'fotografia', 0),
(2, 'foto02.jpg', 'titolo prova 2', NULL, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in diam mauris, vel euismod mi. Phasellus dui risus, gravida et placerat sit amet, blandit quis diam. Nunc ut arcu nec massa aliquam blandit. Praesent facilisis ornare ornare. Nam vel venenatis erat. Praesent ultrices pellentesque dolor non malesuada. Duis eu odio ut arcu convallis malesuada non quis mauris.', NULL, 6, NULL, 'fotografia', 0),
(3, 'foto03.jpg', 'foto di prova', NULL, NULL, 'vediamos e tutto va bene vediamos e tutto va bene vediamos e tutto va bene vediamos e tutto va bene vediamos e tutto va bene vediamos e tutto va bene vediamos e tutto va bene vediamos e tutto va bene', NULL, 6, NULL, 'fotografia', 0),
(4, 'foto04.jpg', 'ffff', NULL, NULL, 'sdfsdfsdf', NULL, 6, NULL, 'fotografia', 0),
(5, 'foto05.jpg', 'Prova galleria fotografica', NULL, NULL, 'Descrizione di prova', NULL, 4, NULL, 'fotografia', 0),
(6, 'foto06.jpg', 'pppippo', NULL, NULL, 'dfsdfsafasfasfa', NULL, 6, NULL, 'fotografia', 0),
(7, 'foto07.jpg', 'prova immagine pittura', NULL, NULL, 'testo descrizione immagine pittura', NULL, 8, NULL, 'fotografia', 0),
(8, 'foto08.jpg', 'prova committenze', NULL, NULL, 'testo descrizione committenze', NULL, 5, NULL, 'fotografia', 0),
(9, 'foto09.jpg', 'sss', NULL, NULL, 'adfsadsa', NULL, 6, NULL, 'fotografia', 0),
(10, 'foto010.gif', 'Prova', NULL, NULL, 'prova', NULL, 5, NULL, 'fotografia', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `gallerie`
--

CREATE TABLE IF NOT EXISTS `gallerie` (
  `id_gallerie` int(11) NOT NULL AUTO_INCREMENT,
  `nome_galleria_it` varchar(150) NOT NULL,
  `nome_galleria_en` varchar(150) DEFAULT NULL,
  `nome_galleria_de` varchar(150) DEFAULT NULL,
  `nome_galleria` varchar(80) NOT NULL,
  `tipo_galleria` enum('fotografia','pittura') NOT NULL,
  `home` tinyint(4) NOT NULL DEFAULT '0',
  `pubblicata` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_gallerie`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dump dei dati per la tabella `gallerie`
--

INSERT INTO `gallerie` (`id_gallerie`, `nome_galleria_it`, `nome_galleria_en`, `nome_galleria_de`, `nome_galleria`, `tipo_galleria`, `home`, `pubblicata`) VALUES
(6, 'informale', NULL, NULL, '', 'pittura', 1, 1),
(4, 'ritratti', NULL, NULL, '', 'fotografia', 0, 1),
(5, 'committenze', NULL, NULL, '', 'fotografia', 0, 1),
(8, 'Prova pittura 2', NULL, NULL, '', 'pittura', 0, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id_news` int(11) NOT NULL AUTO_INCREMENT,
  `titolo_news_it` tinytext NOT NULL,
  `titolo_news_en` tinytext,
  `titolo_news_de` tinytext,
  `testo_news_it` text NOT NULL,
  `testo_news_en` text,
  `testo_news_de` text,
  `tipo_news` enum('fotografia','pittura') NOT NULL DEFAULT 'pittura',
  `nome_foto` varchar(80) DEFAULT NULL,
  `data_news` date DEFAULT NULL,
  `pubblicata` tinyint(4) DEFAULT NULL,
  `home` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_news`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `news`
--

INSERT INTO `news` (`id_news`, `titolo_news_it`, `titolo_news_en`, `titolo_news_de`, `testo_news_it`, `testo_news_en`, `testo_news_de`, `tipo_news`, `nome_foto`, `data_news`, `pubblicata`, `home`) VALUES
(1, 'Titolo news di prova dinamico pe vedere se tutto va bene', NULL, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vel arcu nulla, ut facilisis risus. Sed molestie sem et justo suscipit in laoreet dui iaculis. Sed velit turpis, facilisis in dignissim a, faucibus in urna. Maecenas non sapien sem, et gravida ligula. Donec sagittis arcu non tortor commodo lobortis. Praesent vel nisl sit amet elit cursus suscipit. Vestibulum non leo enim. Mauris at neque enim. Curabitur eu tellus a magna sagittis facilisis. Aenean ultrices est a eros posuere varius. Nullam aliquam dictum nulla vitae lobortis. Sed sagittis, risus porta luctus fermentum, lacus lectus faucibus lacus, at fringilla quam augue a nisi. Nullam bibendum cursus neque, non egestas erat tincidunt id. Aliquam erat volutpat.', NULL, NULL, 'fotografia', 'news01.jpg', '2011-05-06', 1, 1),
(3, 'Prova inserimento news', NULL, NULL, 'orem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vel arcu nulla, ut facilisis risus. Sed molestie sem et justo suscipit in laoreet dui iaculis. Sed velit turpis, facilisis in dignissim a, faucibus in urna. Maecenas non sapien sem, et gravida ligula. Donec sagittis arcu non tortor commodo lobortis. Praesent vel nisl sit amet elit cursus suscipit. Vestibulum non leo enim. Mauris at neque e', NULL, NULL, 'fotografia', 'news03.jpg', '2011-12-15', 1, 1),
(4, 'Titolo prova', NULL, NULL, 'Descrizione prova', NULL, NULL, 'fotografia', 'news04.jpg', '2011-05-06', 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE IF NOT EXISTS `utenti` (
  `id_utenti` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `passwd` varchar(80) NOT NULL,
  PRIMARY KEY (`id_utenti`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id_utenti`, `nome`, `username`, `passwd`) VALUES
(1, 'Giorgio', 'conti', '5f236bb20a15a073dcffe63e0f6f657f');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
