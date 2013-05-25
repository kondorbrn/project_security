-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 25 2013 г., 23:29
-- Версия сервера: 5.5.31
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
  `passport_country` varchar(255) NOT NULL,
  `passport_seria` varchar(255) NOT NULL,
  `passport_number` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- --------------------------------------------------------

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
  KEY `id_personal` (`id_personal`),
  KEY `id_stsm` (`id_stsm`),
  KEY `id_type_of_offense` (`id_type_of_offense`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Структура таблицы `participants_of_criminal`
--

CREATE TABLE IF NOT EXISTS `participants_of_criminal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_log_of_offenses` int(11) NOT NULL,
  `id_criminal` int(11) NOT NULL,
  `resolution` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_log_of_offenses` (`id_log_of_offenses`),
  KEY `id_criminal` (`id_criminal`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `personal`
--

CREATE TABLE IF NOT EXISTS `personal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fio` varchar(255) NOT NULL,
  `stsm` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `type_of_offense`
--

CREATE TABLE IF NOT EXISTS `type_of_offense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `log_of_offenses`
--
ALTER TABLE `log_of_offenses`
  ADD CONSTRAINT `log_of_offenses_ibfk_1` FOREIGN KEY (`id_personal`) REFERENCES `personal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `log_of_offenses_ibfk_2` FOREIGN KEY (`id_stsm`) REFERENCES `personal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `log_of_offenses_ibfk_3` FOREIGN KEY (`id_type_of_offense`) REFERENCES `type_of_offense` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `participants_of_criminal`
--
ALTER TABLE `participants_of_criminal`
  ADD CONSTRAINT `participants_of_criminal_ibfk_1` FOREIGN KEY (`id_log_of_offenses`) REFERENCES `log_of_offenses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participants_of_criminal_ibfk_2` FOREIGN KEY (`id_criminal`) REFERENCES `criminal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
