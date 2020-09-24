-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Сен 24 2020 г., 22:40
-- Версия сервера: 5.7.29
-- Версия PHP: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `luiza`
--

-- --------------------------------------------------------

--
-- Структура таблицы `project`
--

CREATE TABLE `project` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Autor` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `project`
--

INSERT INTO `project` (`ID`, `Title`, `Autor`) VALUES
(5, 'Авто', 1),
(6, 'Авто', 2),
(1, 'Входящие', 1),
(7, 'Входящие', 2),
(4, 'Домашние дела', 1),
(8, 'Домашние дела', 2),
(3, 'Работа', 1),
(9, 'Работа', 2),
(2, 'Учеба', 1),
(10, 'Учеба', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
  `ID` int(10) UNSIGNED NOT NULL,
  `CreatDate` date NOT NULL,
  `Completed` tinyint(1) NOT NULL,
  `Task` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `File` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CompletionDate` date DEFAULT NULL,
  `Autor` int(10) UNSIGNED NOT NULL,
  `Category` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`ID`, `CreatDate`, `Completed`, `Task`, `File`, `CompletionDate`, `Autor`, `Category`) VALUES
(1, '2019-12-01', 0, 'Собеседование в IT компании', NULL, '2019-12-01', 1, 3),
(2, '2019-12-25', 0, 'Выполнить тестовое задание', NULL, '2019-12-25', 1, 3),
(3, '2019-12-21', 1, 'Сделать задание первого раздела', NULL, '2019-12-21', 1, 2),
(4, '2019-12-22', 0, 'Встреча с другом', NULL, '2019-12-22', 1, 1),
(5, '2020-09-17', 0, 'Купить корм для кота', NULL, NULL, 1, 4),
(6, '2020-09-01', 0, 'Заказать пиццу', NULL, NULL, 1, 4),
(7, '2019-12-01', 0, 'Собеседование в IT компании', NULL, '2019-12-01', 2, 9),
(8, '2019-12-25', 0, 'Выполнить тестовое задание', NULL, '2019-12-25', 2, 9),
(9, '2019-12-21', 1, 'Сделать задание первого раздела', NULL, '2019-12-21', 2, 10),
(10, '2019-12-22', 0, 'Встреча с другом', NULL, '2019-12-22', 2, 7),
(11, '2020-09-17', 0, 'Купить корм для кота', NULL, '2020-09-17', 2, 8),
(12, '2020-09-01', 0, 'Заказать пиццу', NULL, NULL, 2, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RegistrationDate` date NOT NULL,
  `Password` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`ID`, `Email`, `Title`, `RegistrationDate`, `Password`) VALUES
(1, 'luizasalavatova@yandex.ru', 'Luiza', '2020-09-25', '123');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Уникальное название и автор` (`Title`,`Autor`) USING BTREE,
  ADD KEY `проект_ibfk_1` (`Autor`);

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Автор` (`Autor`),
  ADD KEY `Проект` (`Category`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `project`
--
ALTER TABLE `project`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `task`
--
ALTER TABLE `task`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
