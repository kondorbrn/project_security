-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 04 2013 г., 18:48
-- Версия сервера: 5.5.29
-- Версия PHP: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `project_security`
--

-- --------------------------------------------------------

--
-- Структура таблицы `criminal`
--

CREATE TABLE IF NOT EXISTS `criminal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fio` varchar(255) NOT NULL,
  `fof` int(11) NOT NULL,
  `snp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `offense`
--

CREATE TABLE IF NOT EXISTS `type_of_offense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `personal`
--

CREATE TABLE IF NOT EXISTS `personal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fio` varchar(255) NOT NULL,
  `stsm` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
--
-- Структура таблицы `log_of_offenses`
--

CREATE TABLE IF NOT EXISTS `log_of_offenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `id_stsm` int(11) NOT NULL,
  `id_personal` int(11) NOT NULL,
  `id_type_of_offense` int(11) NOT NULL,
  `text` text NOT NULL,
  `scan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT FOREIGN KEY ( `id_personal` ) REFERENCES personal( id ) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY ( `id_stsm` ) REFERENCES personal( id ) ON DELETE CASCADE ON UPDATE CASCADE, 
  CONSTRAINT FOREIGN KEY ( `id_type_of_offense` ) REFERENCES type_of_offense( id ) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `m2m`
--

CREATE TABLE IF NOT EXISTS `participants_of_criminal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_log_of_offenses` int(11) NOT NULL,
  `id_criminal` int(11) NOT NULL,
  `resolution` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT FOREIGN KEY ( `id_log_of_offenses` ) REFERENCES log_of_offenses( id ) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY ( `id_criminal` ) REFERENCES criminal( id ) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- --------------------------------------------------------

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
