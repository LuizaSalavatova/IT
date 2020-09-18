-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Сен 18 2020 г., 21:53
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
-- База данных: `schema`
--

-- --------------------------------------------------------

--
-- Структура таблицы `пользователь`
--

CREATE TABLE `пользователь` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Имя` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Дата регистрации` date NOT NULL,
  `Пароль` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `пользователь`
--

INSERT INTO `пользователь` (`ID`, `Email`, `Имя`, `Дата регистрации`, `Пароль`) VALUES
(1, 'luiza@mail.ru', 'Luiza', '2020-09-18', '123');

-- --------------------------------------------------------

--
-- Структура таблицы `проект`
--

CREATE TABLE `проект` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Название` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Автор` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `проект`
--

INSERT INTO `проект` (`ID`, `Название`, `Автор`) VALUES
(5, 'Авто', 1),
(1, 'Входящие', 1),
(4, 'Домашние дела', 1),
(3, 'Работа', 1),
(2, 'Учеба', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `задача`
--

CREATE TABLE `задача` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Дата создания` date NOT NULL,
  `Выполнен` tinyint(1) NOT NULL,
  `Задача` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Файл` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Дата выполнения` date DEFAULT NULL,
  `Автор` int(10) UNSIGNED NOT NULL,
  `Категория` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `задача`
--

INSERT INTO `задача` (`ID`, `Дата создания`, `Выполнен`, `Задача`, `Файл`, `Дата выполнения`, `Автор`, `Категория`) VALUES
(1, '2019-12-01', 0, 'Собеседование в IT компании', NULL, '2019-12-01', 1, 3),
(2, '2019-12-25', 0, 'Выполнить тестовое задание', NULL, '2019-12-25', 1, 3),
(3, '2019-12-21', 1, 'Сделать задание первого раздела', NULL, '2019-12-21', 1, 2),
(4, '2019-12-22', 0, 'Встреча с другом', NULL, '2019-12-22', 1, 1),
(5, '2020-09-17', 0, 'Купить корм для кота', NULL, NULL, 1, 4),
(6, '2020-09-01', 0, 'Заказать пиццу', NULL, NULL, 1, 4);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `пользователь`
--
ALTER TABLE `пользователь`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Индексы таблицы `проект`
--
ALTER TABLE `проект`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Уникальное название и автор` (`Название`,`Автор`) USING BTREE,
  ADD KEY `проект_ibfk_1` (`Автор`);

--
-- Индексы таблицы `задача`
--
ALTER TABLE `задача`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Автор` (`Автор`),
  ADD KEY `Проект` (`Категория`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `пользователь`
--
ALTER TABLE `пользователь`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `проект`
--
ALTER TABLE `проект`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `задача`
--
ALTER TABLE `задача`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `проект`
--
ALTER TABLE `проект`
  ADD CONSTRAINT `проект_ibfk_1` FOREIGN KEY (`Автор`) REFERENCES `пользователь` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `задача`
--
ALTER TABLE `задача`
  ADD CONSTRAINT `задача_ibfk_1` FOREIGN KEY (`Автор`) REFERENCES `пользователь` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `задача_ibfk_2` FOREIGN KEY (`Категория`) REFERENCES `проект` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
