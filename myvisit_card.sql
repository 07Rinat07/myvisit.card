-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Авг 01 2024 г., 15:40
-- Версия сервера: 8.0.39-0ubuntu0.22.04.1
-- Версия PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `myvisit.card`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `content` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `cover` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `cover_small` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `timestamp` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `cover`, `cover_small`, `timestamp`) VALUES
(7, 'проверка', 'загрузка картинки', '326526097305.jpg', '290-326526097305.jpg', NULL),
(10, 'лес', 'фото в лесу', '485184928932.jpg', '290-485184928932.jpg', NULL),
(14, 'работа с датой и временем', 'проверка тест с датой и временем', NULL, NULL, 1722508270),
(15, 'sea', 'test again ', '889458563133.jpg', '290-889458563133.jpg', 1722508768);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `recovery_code` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `surname` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `avatar_small` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `role`, `password`, `recovery_code`, `name`, `surname`, `city`, `country`, `avatar`, `avatar_small`) VALUES
(4, 'mytest3004@mail.com', 'user', '$2y$10$bYcaKTa1wriOIc6/xd2cVeeCG98qZ7DvCthDSQoDvVn/.Pcw5/WOG', NULL, 'Bob', 'Pakerson', 'Texas', 'USA', '950558040700.jpg', '48-950558040700.jpg'),
(5, 'user1@mail.ru', 'admin', '$2y$10$BJbubhX2SE4SjGL86qaIeObzZsacGW.dRM9oyB56zUmE2kgVn3Ppu', NULL, 'Михаил ', 'Тарасов admin', 'Рязань', 'Россия', '885036486953.jpg', '48-885036486953.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
