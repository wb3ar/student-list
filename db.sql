-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Дек 18 2016 г., 04:59
-- Версия сервера: 10.1.19-MariaDB
-- Версия PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `studentlist`
--

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id` smallint(6) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `group_n` varchar(5) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ege` smallint(6) NOT NULL,
  `year_b` year(4) NOT NULL,
  `registration` enum('local','nonresident') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `firstname`, `lastname`, `gender`, `group_n`, `email`, `ege`, `year_b`, `registration`) VALUES
(1, 'Анастасия', 'Соколова', 'female', 'ПЭ116', 'sokolova@yandex.ru', 213, 1998, 'local'),
(2, 'Николай', 'Золотарев', 'male', 'ИВ116', 'zolotar@mail.ru', 196, 1997, 'nonresident'),
(3, 'Георгий', 'Немцов', 'male', 'ВН216', 'nemzov@yandex.ru', 243, 1997, 'local'),
(4, 'Константин', 'Власов', 'male', 'ТБ316', 'vlasov@google.com', 285, 1987, 'nonresident'),
(5, 'Марина', 'Голубева', 'female', 'ОТ216', 'golubeva@yandex.ru', 204, 1996, 'local'),
(6, 'Алена', 'Перлова', 'female', 'Т116', 'perlova@index.ru', 148, 1996, 'nonresident'),
(7, 'Василий', 'Царев', 'male', 'П216', 'carev@bk.ru', 154, 1997, 'local'),
(8, 'Николай', 'Абдулов', 'male', 'Т116', 'abdul@mail.ru', 161, 1996, 'nonresident'),
(9, 'Роман', 'Никонов', 'male', 'О116', 'nikon@list.ru', 138, 1995, 'nonresident'),
(10, 'Томара', 'Фолкина', 'female', 'РО116', 'folkina@bk.ru', 178, 1997, 'local'),
(11, 'Алена', 'Холкина', 'female', 'Т116', 'holkina@list.ru', 188, 1998, 'nonresident'),
(12, 'Виталий', 'Ломаков', 'male', 'Л116', 'lomakov@list.ru', 163, 1997, 'local'),
(13, 'Галина', 'Антонова', 'female', 'Н116', 'antonova@yandex.ru', 163, 1996, 'nonresident'),
(14, 'Екатерина', 'Новикова', 'female', 'Р116', 'novikova@google.ru', 157, 1995, 'nonresident'),
(15, 'Константин', 'Щербаков', 'male', 'Р116', 'sherbak@list.ru', 153, 1991, 'nonresident'),
(16, 'Лариса', 'Храмова', 'female', 'Г116', 'chramova@bk.ru', 183, 1998, 'local'),
(17, 'Татьяна', 'Ларина', 'female', 'Т116', 'larina@list.ru', 145, 1995, 'local');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pass` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `pass`) VALUES
(15, '4Uuj8X19Ycn7fCguEgj5ePqrEJhPen8P'),
(14, 'bbXnx2fxlXXHLf5CPJVbrdB6RCDc3aUt'),
(10, 'CD2BPqG0pPrEeH2eXmMjeZ1hd3m1Rs5T'),
(7, 'EfeqNESXHiUhtuPRUwC5mBhn7sipILgB'),
(4, 'GSxSoabPdx1WdL5SO6RpFUeKsTBSz2T0'),
(1, 'HvsZ2EjiktkMMtn4IZXRNOQqofDKOCsC'),
(3, 'isLgCrytwGaXrbWSnkrNL5xhQ5g9BDfT'),
(12, 'K5oXzRkdBtB3kzWQgLgq8nmEJ9ksocwc'),
(6, 'l0uczg3iFAfvHt5ErPxCe2K236CQQW6o'),
(5, 'q1P51RR87hx1ifCc8fwer5qkHUNyS6oK'),
(16, 'QEMiZ2WDsdDSaIHvsZ2EjiktkMMtn4IZ'),
(9, 'rcaD7OAZyE2d80lrJjBy3d7iGVJKakFM'),
(2, 'WTA2sZ2sqcH62O9wHvRWrjg0K8dSz2rh'),
(17, 'XRNOQqofDKOCsCl0uczg3iFAfvHt5ErP'),
(11, 'XvgTNIopKvjcaqYMVgobcPEzBsvBJWA7'),
(13, 'YLU82XTIG7J9XaS5rKakcZ5tFMaSDfwB'),
(8, 'yoUOSFlflRwJL8rPiWiGabUfIH2pQQhp');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pass` (`pass`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
