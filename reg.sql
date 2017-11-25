-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 25 2017 г., 13:01
-- Версия сервера: 5.6.24
-- Версия PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `reg`
--

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `answer` text,
  `login` varchar(256) NOT NULL,
  `read` int(11) NOT NULL DEFAULT '0',
  `yes_answer` int(11) NOT NULL,
  `hidden_user` varchar(256) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `recipient_id`, `sender_id`, `message`, `answer`, `login`, `read`, `yes_answer`, `hidden_user`) VALUES
(2, 2, 3, 'ПРивет', 'Привет', 'Admin', 1, 2, '3'),
(3, 4, 3, 'Настюха)))', 'Чего?', 'Admin', 1, 2, '3');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `salt` varchar(256) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `banned` int(11) NOT NULL DEFAULT '0',
  `banned_time` timestamp NULL DEFAULT NULL,
  `cookie` varchar(256) NOT NULL,
  `lastname` varchar(256) NOT NULL,
  `age` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `city` varchar(256) NOT NULL,
  `language` varchar(256) NOT NULL,
  `data_reg` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lastVisit` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `salt`, `status`, `banned`, `banned_time`, `cookie`, `lastname`, `age`, `email`, `city`, `language`, `data_reg`, `lastVisit`) VALUES
(5, 'Дима', '208f51493f16dc6e540022025168facd', 'zeabsdg8l', 10, 0, NULL, '6f6ys4d46', 'Кахаров', '23', 'dima@yandex.ru', 'Корткерос', 'Русский', '2017-11-25 11:44:33', '2017-11-25 12:01:07');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
