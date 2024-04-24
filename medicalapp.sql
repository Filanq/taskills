-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Апр 24 2024 г., 18:34
-- Версия сервера: 10.8.4-MariaDB
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `medicalapp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `calls`
--

CREATE TABLE `calls` (
  `id` int(11) NOT NULL,
  `call_id` varchar(255) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `answered` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `calls`
--

INSERT INTO `calls` (`id`, `call_id`, `offer_id`, `answer_id`, `answered`) VALUES
(49, 'WtakZRdP2furz8UbOpDu', 18, 4, 0),
(50, 'bq7kFoakrSSvdR2SAIrP', 20, 2, 0),
(51, 'jfLbaM2y44917891YiSK', 21, 20, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `date` date NOT NULL,
  `file` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `medic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `certificates`
--

INSERT INTO `certificates` (`id`, `title`, `date`, `file`, `user_id`, `medic_id`) VALUES
(4, 'Сертификат', '2023-12-18', 'DRroUcyGT7bZZhtc.jpg', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `medic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `logs`
--

INSERT INTO `logs` (`id`, `title`, `date`, `user_id`, `medic_id`) VALUES
(3, 'Диагноз', '2023-12-17', 1, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `sender_id`, `message`, `date`) VALUES
(49, 1, 2, 'Привет', '2023-12-18 20:44:39'),
(50, 10, 2, 'ку', '2023-12-18 21:04:11'),
(51, 2, 10, 'оо', '2023-12-18 21:04:17'),
(52, 10, 2, 'сообщение вылазит?', '2023-12-18 21:04:18'),
(53, 10, 2, 'кайф', '2023-12-18 21:04:21'),
(54, 2, 10, 'крутяк', '2023-12-18 21:04:23'),
(55, 2, 10, 'да', '2023-12-18 21:04:25'),
(56, 2, 10, 'мб свой тг создадим)', '2023-12-18 21:04:42'),
(57, 2, 11, 'Здравствуйте, Илья, хочу обратиться к вам по поводу болезни', '2023-12-19 13:02:58'),
(58, 11, 2, 'Ага', '2023-12-19 13:03:14'),
(59, 11, 2, 'Круто', '2023-12-19 13:03:21'),
(60, 4, 13, 'asdasdas', '2023-12-19 17:38:28'),
(61, 4, 14, 'ehffff', '2023-12-20 16:55:44'),
(62, 2, 14, 'Урааа', '2023-12-26 13:11:07'),
(63, 14, 2, 'дарова', '2023-12-26 13:11:19'),
(64, 14, 2, 'жесть вообще', '2023-12-26 13:11:22'),
(65, 2, 14, 'чзх че тут происходит', '2023-12-26 13:11:37'),
(66, 14, 2, 'вот такие пироги', '2023-12-26 13:11:37'),
(67, 14, 2, 'ладно поцду', '2023-12-26 13:11:37'),
(68, 14, 2, 'делать статистику', '2023-12-26 13:11:40'),
(69, 2, 14, 'давай', '2023-12-26 13:11:42'),
(70, 5, 15, 'Hi!)', '2023-12-27 13:22:48'),
(71, 6, 18, 'Здравствуйте!', '2024-01-14 08:59:50'),
(72, 6, 17, '123', '2024-03-16 11:52:53'),
(73, 21, 20, 'привет', '2024-04-20 12:15:11'),
(74, 21, 20, 'ку', '2024-04-20 12:31:45'),
(75, 21, 20, 'кен', '2024-04-20 12:32:05'),
(76, 21, 20, 'ор', '2024-04-20 12:32:48'),
(77, 21, 20, 'h', '2024-04-20 12:35:37');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(500) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `firstname`, `surname`, `email`, `password`, `status`) VALUES
(1, 'Илья', 'Федосенко', 'fedosenko009@mail.ru', '$2y$12$Jh53638Xx8QUCcURLMxOBeqtrPqSw.anfziYRSqavOCq2qI4Sx6de', 'person'),
(2, 'Илья', 'Утяцкий', 'utyatskiy.ty@yandex.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(3, 'Сергей', 'Головин', '123@mail.ru', '$2y$12$CwQGaxm182d7dmSJ/WA76O1HYU.SW76xbVhFc4P2vUFRedhUSDJ3O', 'medic'),
(4, 'Житов', 'Григорий', '1234@mail.ru', '$2y$12$toxTvbZ//8qCWu.QKF6F7ui2O26vsOzsxh/lQAwozZSTWlQPLIyua', 'medic'),
(5, 'Аннастасия', 'Иванова', '12345678@mail.ru', '$2y$12$1SE1awU.k7YQVGHRxak7lu7ln.NlCNMI7DqlARN16JS9Zjz9/E1dW', 'medic'),
(6, 'Михаил', 'Резнов', '1243@mail.ru', '$2y$12$ZxQcTIeJMYry9snegMBVtuIL40jBNgjq71c1v/jMXXCm7LciFlw22', 'medic'),
(7, 'Жанна', 'Либрова', '141@mail.ru', '$2y$12$cgaH5E63HMf4f8nE7xo4W.ISWwF953lp0YDUjYutyyl8ryxsdxwXy', 'medic'),
(8, 'Илья', 'Федосенко', 'fedosenko0039@mail.ru', '$2y$12$rXaxWumV.E74hAfIWoLEEeX.n9f0rgLFnKPMsh595UdkMltpdFFIm', 'person'),
(9, 'йцу', 'йцу', 'fedosenfko009@mail.ru', '$2y$12$LIeRb5TCpashiC7svpNrqO5i7LM8UjC.FEQw4o3sZAsLZHRyW44SW', 'medic'),
(11, 'Darya', 'Федосенко', 'fedosenkod@mail.ru', '$2y$12$fQNe.9zClJqpjFF33pko2e7nl/KZxmt/I6BpYetUc9GhxdBScT7aC', 'person'),
(14, 'Генг', 'ЙОУ', 'gmail@gmail.com', '$2y$12$.XIEMWYdYYYDmRTJ1f5PRul8uXZVAhYOqPdaTMoUfvl1IvAppYlfi', 'medic'),
(16, 'Александр', 'Булохов', 'ale11855678@yandex.ru', '$2y$12$IicbhlkRlWL14CPfvdtJt.C7snUjXM.9IBPAwuqN1CIx20rRFTmoW', 'person'),
(17, '123', '123', '123@123', '$2y$12$mwj2xthtLhvAW43ZOsjImeqJRfaK7moQA/Ti0YF/JsSJ7aJssSYGe', 'person'),
(18, 'Алексей', 'Пригоркин', 'chugun@chugun.ru', '$2y$12$/fMZHTME0SgOaRpuciRRheFL1DWqFJnSIrIG6vwvEQqKXa4zE/.QC', 'person'),
(19, 'Владислав', 'Черных', 'qas22042007a@gmail.com', '$2y$12$Q.gZWpo0kM5xYx0tNlDt2eax6mhnPMKH7KEW90aLpLK2s5kl/R0m.', 'person'),
(20, 'Илья', 'Федосенко', 'filan333@yandex.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'person'),
(21, 'Андрей', 'Черных', 'qwe@mail.ru', '$2y$12$th0hwGY4ZVXx.yv2CE1JlOViSDf1aaDISsH09TATcdZ8YtebfHARC', 'medic'),
(29, 'Иван', 'Иванов', 'ivanov_iv@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(30, 'Пётр', 'Петров', 'petrov_ppe@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(31, 'Сергей', 'Сидоров', 'sidorov_ss@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(32, 'Алексей', 'Кузнецов', 'kuznetsov_aa@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(33, 'Андрей', 'Васильев', 'vasiliev_av@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(34, 'Михаил', 'Волков', 'volkov_mv@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(35, 'Николай', 'Смирнов', 'smirnov_nn@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(36, 'Алексей', 'Соколов', 'sakolov_aa@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(37, 'Павел', 'Козлов', 'kozlov_pp@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(38, 'Дмитрий', 'Никитин', 'nikitin_dd@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(39, 'Олег', 'Яковлев', 'yakovlev_oo@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(40, 'Александр', 'Фёдоров', 'fedorov_aa@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(41, 'Виктор', 'Новиков', 'novikov_vv@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(42, 'Константин', 'Степанов', 'stepanov_kk@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(43, 'Егор', 'Рыжов', 'ryzhov_ee@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(44, 'Игорь', 'Лебедев', 'lebedev_ii@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(45, 'Владимир', 'Семенов', 'semonov_vv@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(46, 'Алексей', 'Романов', 'romanov_aa@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(47, 'Максим', 'Белов', 'belov_mm@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(48, 'Сергей', 'Соловьёв', 'soloviev_ss@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(49, 'Артем', 'Гордеев', 'gordeev_aa@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(50, 'Даниил', 'Журавлёв', 'zhuravlev_dd@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(51, 'Алексей', 'Лаптев', 'laptyev_aa@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(52, 'Сергей', 'Миронов', 'mironov_ss@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(53, 'Алексей', 'Самойлов', 'samylov_aa@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(54, 'Алексей', 'Морозов', 'morozov_aa@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(55, 'Алексей', 'Уткин', 'utkin_aa@mail.ru', '$2y$12$HvLgJkny4Z9MU4v9SDOF/e89ZJ/NxIiyactfSA3niK97HEf1LaQ7G', 'medic'),
(56, 'Влад', 'Черных', 'qas22042007@gmail.com', '$2y$12$seTL6LrmMXPtXeUqPvMMg.bgg2oyjdRQODItX77E.XcL/aKFG5V0q', 'medic'),
(57, 'Александр', 'Булохов', 'ya@bulohov.ru', '$2y$12$dl.Rqr7e1FzrWE4Y.HGdQ.zxdK9dwzjW3CqerGaQ8j.mVKtabhE1e', 'medic'),
(58, 'Владислав', 'Утяцкий', 'utyatsky.ry@yandex.ru', '$2y$12$nUcPy61AG/1zDA1lLwI0nOnWNEbMmJ6JjKCtHcZHdKYqr1sDeUbLG', 'medic'),
(59, 'Дарья', 'Шилова', 'artemsemenov200257@mail.ru', '$2y$12$7MWW0ykWUQ2GUhJ7OQNb/Ok4DoJ2pfReqFvactsK6b67rjISsmYRy', 'medic');

-- --------------------------------------------------------

--
-- Структура таблицы `users_data`
--

CREATE TABLE `users_data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `avatar` varchar(500) NOT NULL DEFAULT 'avatar.svg',
  `age` int(11) DEFAULT NULL,
  `status` varchar(500) DEFAULT NULL,
  `sex` varchar(15) DEFAULT NULL,
  `location` varchar(250) DEFAULT NULL,
  `education` varchar(250) DEFAULT NULL,
  `graphic` varchar(250) DEFAULT NULL,
  `specialization` varchar(250) DEFAULT NULL,
  `favorites` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users_data`
--

INSERT INTO `users_data` (`id`, `user_id`, `avatar`, `age`, `status`, `sex`, `location`, `education`, `graphic`, `specialization`, `favorites`) VALUES
(1, 1, 'avatar.svg', 14, NULL, NULL, 'Россия, Липецк', NULL, NULL, NULL, '[\"2\"]'),
(2, 2, 'nAtaUmpBdRuDxX1v.jpg', 24, NULL, 'Мужской', 'Россия, Липецк', NULL, 'Ср, Пт', 'Дерматолог', '[]'),
(3, 3, 'U8gya53qYf1srBmx.jpg', NULL, NULL, 'Мужской', NULL, NULL, NULL, 'Хирург', '[]'),
(4, 4, '98ovtpHJzOLiEg6s.jpg', NULL, NULL, 'Мужской', NULL, NULL, NULL, 'Окулист', '[]'),
(5, 5, '6uSXVbQOOVlHUXda.jpg', NULL, NULL, 'Мужской', NULL, NULL, NULL, 'Стоматолог', '[]'),
(6, 6, '1NkAAexP2DCqYZaw.jpg', NULL, NULL, 'Мужской', NULL, NULL, NULL, 'Психолог', '[]'),
(7, 7, 'eVBWbLHOfGrENiyd.jpg', NULL, NULL, 'Мужской', NULL, NULL, NULL, 'Кардиолог', '[]'),
(8, 8, 'avatar.svg', 30, 'Женат/Замужем', 'Мужской', 'Россия, Липецк', NULL, NULL, 'Дерматолог', '[]'),
(9, 9, 'avatar.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]'),
(10, 10, 'avatar.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]'),
(11, 11, 'avatar.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]'),
(12, 12, 'avatar.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]'),
(13, 13, 'avatar.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]'),
(14, 14, 'avatar.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]'),
(15, 15, 'avatar.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]'),
(16, 16, 'avatar.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[\"2\"]'),
(17, 17, 'avatar.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]'),
(18, 18, 'avatar.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]'),
(19, 19, 'avatar.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]'),
(20, 20, 'avatar.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[\"2\"]'),
(21, 21, 'avatar.svg', NULL, NULL, NULL, NULL, NULL, NULL, 'Окулист', '[]'),
(23, 23, 'avatar.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[]'),
(29, 29, 'avatar.svg', 55, 'Женат/Замужем', 'Мужской', 'Россия, Санкт-Петербург', NULL, 'Пн, Ср, Пт', 'Дерматолог', '[]'),
(30, 30, 'avatar.svg', 54, 'Женат/Замужем', 'Мужской', 'Россия, Екатеринбург', NULL, 'Пн, Ср, Пт', 'Окулист', '[]'),
(31, 31, 'avatar.svg', 56, 'Женат/Замужем', 'Женский', 'Россия, Челябинск', NULL, 'Пн, Ср, Пт', 'Окулист', '[]'),
(32, 32, 'avatar.svg', 50, 'Женат/Замужем', 'Мужской', 'Россия, Екатеринбург', NULL, 'Пн, Ср, Пт', 'Окулист', '[]'),
(36, 36, 'avatar.svg', 49, 'Женат/Замужем', 'Мужской', 'Россия, Казань', NULL, 'Пн, Ср, Пт', 'Хирург', '[]'),
(37, 37, 'avatar.svg', 58, 'Женат/Замужем', 'Женский', 'Россия, Новосибирск', NULL, 'Пн, Ср, Пт', 'Хирург', '[]'),
(38, 38, 'avatar.svg', 23, 'Женат/Замужем', 'Мужской', 'Россия, Санкт-Петербург', NULL, 'Пн, Ср, Пт', 'Хирург', '[]'),
(39, 39, 'avatar.svg', 53, 'Женат/Замужем', 'Женский', 'Россия, Екатеринбург', NULL, 'Пн, Ср, Пт', 'Хирург', '[]'),
(40, 40, 'avatar.svg', 21, 'Женат/Замужем', 'Мужской', 'Россия, Екатеринбург', NULL, 'Пн, Ср, Пт', 'Хирург', '[]'),
(41, 41, 'avatar.svg', 50, 'Женат/Замужем', 'Мужской', 'Россия, Новосибирск', NULL, 'Пн, Ср, Пт', 'Окулист', '[]'),
(42, 42, 'avatar.svg', 46, 'Женат/Замужем', 'Женский', 'Россия, Екатеринбург', NULL, 'Пн, Ср, Пт', 'Стоматолог', '[]'),
(43, 43, 'avatar.svg', 51, 'Женат/Замужем', 'Женский', 'Россия, Санкт-Петербург', NULL, 'Пн, Ср, Пт', 'Стоматолог', '[]'),
(44, 44, 'avatar.svg', 40, 'Женат/Замужем', 'Мужской', 'Россия, Челябинск', NULL, 'Пн, Ср, Пт', 'Стоматолог', '[]'),
(45, 45, 'avatar.svg', 51, 'Женат/Замужем', 'Женский', 'Россия, Москва', NULL, 'Пн, Ср, Пт', 'Стоматолог', '[]'),
(46, 46, 'avatar.svg', 18, 'Женат/Замужем', 'Мужской', 'Россия, Москва', NULL, 'Пн, Ср, Пт', 'Стоматолог', '[]'),
(47, 47, 'avatar.svg', 24, 'Женат/Замужем', 'Мужской', 'Россия, Новосибирск', NULL, 'Пн, Ср, Пт', 'Психолог', '[]'),
(48, 48, 'avatar.svg', 28, 'Женат/Замужем', 'Женский', 'Россия, Челябинск', NULL, 'Пн, Ср, Пт', 'Психолог', '[]'),
(49, 49, 'avatar.svg', 56, 'Женат/Замужем', 'Мужской', 'Россия, Казань', NULL, 'Пн, Ср, Пт', 'Психолог', '[]'),
(50, 50, 'avatar.svg', 39, 'Женат/Замужем', 'Мужской', 'Россия, Москва', NULL, 'Пн, Ср, Пт', 'Психолог', '[]'),
(51, 51, 'avatar.svg', 23, 'Женат/Замужем', 'Мужской', 'Россия, Казань', NULL, 'Пн, Ср, Пт', 'Психолог', '[]'),
(52, 52, 'avatar.svg', 29, 'Женат/Замужем', 'Женский', 'Россия, Челябинск', NULL, 'Пн, Ср, Пт', 'Кардиолог', '[]'),
(53, 53, 'avatar.svg', 57, 'Женат/Замужем', 'Мужской', 'Россия, Казань', NULL, 'Пн, Ср, Пт', 'Кардиолог', '[]'),
(54, 54, 'avatar.svg', 30, 'Женат/Замужем', 'Женский', 'Россия, Санкт-Петербург', NULL, 'Пн, Ср, Пт', 'Кардиолог', '[]'),
(55, 55, 'avatar.svg', 60, 'Женат/Замужем', 'Мужской', 'Россия, Москва', NULL, 'Пн, Ср, Пт', 'Кардиолог', '[]'),
(56, 56, 'avatar.svg', 54, 'Женат/Замужем', 'Женский', 'Россия, Новосибирск', NULL, 'Пн, Ср, Пт', 'Кардиолог', '[]'),
(57, 57, 'avatar.svg', 50, 'Женат/Замужем', 'Мужской', 'Россия, Санкт-Петербург', NULL, 'Пн, Ср, Пт', 'Дерматолог', '[]'),
(58, 58, 'avatar.svg', 55, 'Женат/Замужем', 'Мужской', 'Россия, Санкт-Петербург', NULL, 'Пн, Ср, Пт', 'Дерматолог', '[]'),
(59, 59, 'avatar.svg', 54, 'Женат/Замужем', 'Мужской', 'Россия, Екатеринбург', NULL, 'Пн, Ср, Пт', 'Дерматолог', '[]');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `calls`
--
ALTER TABLE `calls`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

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
-- Индексы таблицы `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `calls`
--
ALTER TABLE `calls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT для таблицы `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT для таблицы `users_data`
--
ALTER TABLE `users_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=557;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
