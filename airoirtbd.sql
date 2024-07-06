-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июл 06 2024 г., 13:10
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `airoirtbd`
--
CREATE DATABASE IF NOT EXISTS `airoirtbd` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `airoirtbd`;

-- --------------------------------------------------------

--
-- Структура таблицы `airports`
--

CREATE TABLE `airports` (
  `air_id` int(11) NOT NULL,
  `air_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `airports`
--

INSERT INTO `airports` (`air_id`, `air_name`) VALUES
(1, 'Москва'),
(2, 'Санкт-Петербург'),
(3, 'Новосибирск'),
(4, 'Екатеринбург'),
(5, 'Нижний Новгород'),
(6, 'Казань'),
(7, 'Челябинск'),
(8, 'Омск'),
(9, 'Самара'),
(10, 'Ростов-на-Дону'),
(11, 'Уфа'),
(12, 'Красноярск'),
(13, 'Пермь'),
(14, 'Воронеж'),
(15, 'Волгоград'),
(16, 'Краснодар'),
(17, 'Саратов'),
(18, 'Тюмень'),
(19, 'Тольятти'),
(20, 'Ижевск');

-- --------------------------------------------------------

--
-- Структура таблицы `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`) VALUES
(1, 'Economy'),
(2, 'Business'),
(3, 'First Class');

-- --------------------------------------------------------

--
-- Структура таблицы `departures`
--

CREATE TABLE `departures` (
  `dep_id` int(11) NOT NULL,
  `dep_flight` int(11) NOT NULL,
  `dep_plane` int(11) NOT NULL,
  `dep_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `departures`
--

INSERT INTO `departures` (`dep_id`, `dep_flight`, `dep_plane`, `dep_time`) VALUES
(1, 1, 1, '2024-07-06 05:00:00'),
(2, 2, 2, '2024-07-06 06:00:00'),
(3, 3, 3, '2024-07-06 07:00:00'),
(4, 4, 4, '2024-07-06 08:00:00'),
(5, 5, 5, '2024-07-06 09:00:00'),
(6, 6, 6, '2024-07-06 10:00:00'),
(7, 7, 7, '2024-07-06 11:00:00'),
(8, 8, 8, '2024-07-06 12:00:00'),
(9, 9, 9, '2024-07-06 13:00:00'),
(10, 10, 10, '2024-07-06 14:00:00'),
(11, 11, 11, '2024-07-06 15:00:00'),
(12, 12, 12, '2024-07-06 16:00:00'),
(13, 13, 13, '2024-07-06 17:00:00'),
(14, 14, 14, '2024-07-06 18:00:00'),
(15, 15, 15, '2024-07-06 19:00:00'),
(16, 16, 16, '2024-07-06 20:00:00'),
(17, 17, 17, '2024-07-06 21:00:00'),
(18, 18, 18, '2024-07-06 22:00:00'),
(19, 19, 19, '2024-07-06 23:00:00'),
(20, 20, 20, '2024-07-07 00:00:00'),
(21, 21, 1, '2024-07-07 01:00:00'),
(22, 22, 2, '2024-07-07 02:00:00'),
(23, 23, 3, '2024-07-07 03:00:00'),
(24, 24, 4, '2024-07-07 04:00:00'),
(25, 25, 5, '2024-07-07 05:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `flights`
--

CREATE TABLE `flights` (
  `f_id` int(11) NOT NULL,
  `f_airin` int(11) NOT NULL,
  `f_airout` int(11) NOT NULL,
  `f_duration` time NOT NULL,
  `f_cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `flights`
--

INSERT INTO `flights` (`f_id`, `f_airin`, `f_airout`, `f_duration`, `f_cost`) VALUES
(1, 2, 1, '04:30:00', 250.00),
(2, 1, 2, '04:30:00', 260.00),
(3, 4, 3, '03:00:00', 200.00),
(4, 3, 4, '03:00:00', 210.00),
(5, 6, 5, '05:00:00', 300.00),
(6, 5, 6, '05:00:00', 310.00),
(7, 8, 7, '02:30:00', 180.00),
(8, 7, 8, '02:30:00', 190.00),
(9, 10, 9, '04:00:00', 230.00),
(10, 9, 10, '04:00:00', 240.00),
(11, 11, 12, '03:30:00', 220.00),
(12, 12, 11, '03:30:00', 230.00),
(13, 13, 14, '02:45:00', 200.00),
(14, 14, 13, '02:45:00', 210.00),
(15, 15, 16, '03:15:00', 250.00),
(16, 16, 15, '03:15:00', 260.00),
(17, 17, 18, '04:45:00', 280.00),
(18, 18, 17, '04:45:00', 290.00),
(19, 19, 20, '05:30:00', 320.00),
(20, 20, 19, '05:30:00', 330.00),
(21, 1, 3, '03:50:00', 270.00),
(22, 3, 1, '03:50:00', 280.00),
(23, 2, 4, '04:10:00', 260.00),
(24, 4, 2, '04:10:00', 270.00),
(25, 5, 7, '02:20:00', 190.00),
(26, 7, 5, '02:20:00', 200.00),
(27, 6, 8, '03:40:00', 220.00),
(28, 8, 6, '03:40:00', 230.00),
(29, 9, 11, '04:50:00', 250.00),
(30, 11, 9, '04:50:00', 260.00);

-- --------------------------------------------------------

--
-- Структура таблицы `passengers`
--

CREATE TABLE `passengers` (
  `pas_id` int(11) NOT NULL,
  `pas_uid` int(11) NOT NULL,
  `pas_dep` int(11) NOT NULL,
  `pas_seatnum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `passengers`
--

INSERT INTO `passengers` (`pas_id`, `pas_uid`, `pas_dep`, `pas_seatnum`) VALUES
(1, 6, 3, 18),
(2, 6, 1, 32),
(3, 19, 1, 34),
(4, 20, 1, 18),
(5, 20, 22, 56);

-- --------------------------------------------------------

--
-- Структура таблицы `pictures`
--

CREATE TABLE `pictures` (
  `pic_id` int(11) NOT NULL,
  `pic_path` varchar(40) NOT NULL,
  `pic_about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `pictures`
--

INSERT INTO `pictures` (`pic_id`, `pic_path`, `pic_about`) VALUES
(1, 'stockimagesyaas.jpg', '[value-3]'),
(8, 'profile_images/profile_19.jpg', ''),
(9, 'profile_images/profile_20.jpg', ''),
(10, 'profile_images/profile_21.jpg', '');

-- --------------------------------------------------------

--
-- Структура таблицы `plane`
--

CREATE TABLE `plane` (
  `p_id` int(11) NOT NULL,
  `p_class` int(11) NOT NULL,
  `p_amountofseats` int(11) NOT NULL,
  `p_miles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `plane`
--

INSERT INTO `plane` (`p_id`, `p_class`, `p_amountofseats`, `p_miles`) VALUES
(1, 1, 150, 10000),
(2, 2, 200, 8000),
(3, 3, 100, 6000),
(4, 1, 180, 12000),
(5, 2, 220, 9000),
(6, 3, 120, 6500),
(7, 1, 160, 11000),
(8, 2, 210, 8500),
(9, 3, 110, 6200),
(10, 1, 170, 11500),
(11, 2, 230, 9500),
(12, 3, 130, 6700),
(13, 1, 140, 10500),
(14, 2, 190, 8200),
(15, 3, 90, 5800),
(16, 1, 200, 13000),
(17, 2, 240, 9800),
(18, 3, 110, 6300),
(19, 1, 160, 11000),
(20, 2, 220, 9000);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `u_mail` text NOT NULL,
  `u_password` text NOT NULL,
  `u_image` int(11) NOT NULL,
  `u_fname` varchar(20) NOT NULL,
  `u_name` varchar(20) NOT NULL,
  `u_sname` varchar(20) NOT NULL,
  `u_passport` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`u_id`, `u_mail`, `u_password`, `u_image`, `u_fname`, `u_name`, `u_sname`, `u_passport`) VALUES
(19, 'slaysoska@rambler.ru', '123', 8, 'Алина', '', '', ''),
(20, '', '1234', 9, 'Арсений', '', '', ''),
(21, '', '1234', 10, 'sks.21', '', '', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `airports`
--
ALTER TABLE `airports`
  ADD PRIMARY KEY (`air_id`);

--
-- Индексы таблицы `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Индексы таблицы `departures`
--
ALTER TABLE `departures`
  ADD PRIMARY KEY (`dep_id`),
  ADD KEY `fk_flight` (`dep_flight`),
  ADD KEY `fk_plane` (`dep_plane`);

--
-- Индексы таблицы `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `fk_air` (`f_airin`),
  ADD KEY `fk_airout` (`f_airout`);

--
-- Индексы таблицы `passengers`
--
ALTER TABLE `passengers`
  ADD PRIMARY KEY (`pas_id`),
  ADD KEY `fk_pasdep` (`pas_dep`);

--
-- Индексы таблицы `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`pic_id`);

--
-- Индексы таблицы `plane`
--
ALTER TABLE `plane`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `fk_class` (`p_class`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `fk_image` (`u_image`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `airports`
--
ALTER TABLE `airports`
  MODIFY `air_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `departures`
--
ALTER TABLE `departures`
  MODIFY `dep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `flights`
--
ALTER TABLE `flights`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `passengers`
--
ALTER TABLE `passengers`
  MODIFY `pas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `pictures`
--
ALTER TABLE `pictures`
  MODIFY `pic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `plane`
--
ALTER TABLE `plane`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `departures`
--
ALTER TABLE `departures`
  ADD CONSTRAINT `fk_flight` FOREIGN KEY (`dep_flight`) REFERENCES `flights` (`f_id`),
  ADD CONSTRAINT `fk_plane` FOREIGN KEY (`dep_plane`) REFERENCES `plane` (`p_id`);

--
-- Ограничения внешнего ключа таблицы `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `fk_air` FOREIGN KEY (`f_airin`) REFERENCES `airports` (`air_id`),
  ADD CONSTRAINT `fk_airout` FOREIGN KEY (`f_airout`) REFERENCES `airports` (`air_id`);

--
-- Ограничения внешнего ключа таблицы `passengers`
--
ALTER TABLE `passengers`
  ADD CONSTRAINT `fk_pasdep` FOREIGN KEY (`pas_dep`) REFERENCES `departures` (`dep_id`);

--
-- Ограничения внешнего ключа таблицы `plane`
--
ALTER TABLE `plane`
  ADD CONSTRAINT `fk_class` FOREIGN KEY (`p_class`) REFERENCES `classes` (`class_id`);

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_image` FOREIGN KEY (`u_image`) REFERENCES `pictures` (`pic_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
