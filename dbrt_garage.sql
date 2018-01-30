-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Час створення: Бер 25 2017 р., 00:41
-- Версія сервера: 5.7.17-0ubuntu0.16.04.1
-- Версія PHP: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `dbrt_garage`
--

-- --------------------------------------------------------

--
-- Структура таблиці `bike`
--

CREATE TABLE `bike` (
  `id` int(11) NOT NULL,
  `model` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `mileage` int(11) NOT NULL,
  `mi_km` tinyint(1) NOT NULL,
  `mileage_last` int(11) NOT NULL,
  `mileage_lastchg` date NOT NULL,
  `status` int(11) NOT NULL,
  `vin` varchar(17) NOT NULL,
  `comment` text NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `tel1` varchar(10) NOT NULL,
  `tel2` varchar(10) NOT NULL,
  `comment` text NOT NULL,
  `reg_date` date NOT NULL,
  `work_discount` int(11) NOT NULL DEFAULT '0',
  `shop_discount` int(11) NOT NULL DEFAULT '0',
  `balance` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `name` varchar(3) NOT NULL,
  `value` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `known_issues`
--

CREATE TABLE `known_issues` (
  `id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `symptoms` text NOT NULL,
  `issue` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `mnf`
--

CREATE TABLE `mnf` (
  `id` int(11) NOT NULL,
  `mnf_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `models`
--

CREATE TABLE `models` (
  `id` int(11) NOT NULL,
  `model` text NOT NULL,
  `capacity` int(11) NOT NULL,
  `mnf_id` int(11) NOT NULL,
  `year_begin` int(11) NOT NULL,
  `year_end` int(11) NOT NULL,
  `comment` text NOT NULL,
  `cylinders` int(11) NOT NULL,
  `valves_per_cyl` int(11) NOT NULL,
  `eng_type` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `task` int(11) NOT NULL,
  `sum` double NOT NULL,
  `date_payment` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `prod_buy`
--

CREATE TABLE `prod_buy` (
  `id` int(11) NOT NULL,
  `prod` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `date_buy` datetime NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `prod_category`
--

CREATE TABLE `prod_category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `prod_mnf`
--

CREATE TABLE `prod_mnf` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `prod_prod`
--

CREATE TABLE `prod_prod` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `manufacturer` int(11) NOT NULL,
  `name` text NOT NULL,
  `units` varchar(10) NOT NULL,
  `qty` int(11) NOT NULL,
  `photo` text NOT NULL,
  `price_in` double NOT NULL,
  `price_out` double NOT NULL,
  `currency` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `prod_sale`
--

CREATE TABLE `prod_sale` (
  `id` int(11) NOT NULL,
  `task` varchar(8) NOT NULL,
  `prod` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `date_sale` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `date_create` datetime NOT NULL,
  `comment` text NOT NULL,
  `client` int(11) NOT NULL,
  `bike` int(11) NOT NULL,
  `mileage` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_end` datetime NOT NULL,
  `date_change` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `tasks_status`
--

CREATE TABLE `tasks_status` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `tech_data`
--

CREATE TABLE `tech_data` (
  `id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `valve_in` varchar(10) NOT NULL,
  `valve_ex` varchar(10) NOT NULL,
  `fork_oil_cap` int(11) NOT NULL,
  `fork_oil_level` int(11) NOT NULL,
  `fork_oil_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `passwd` text NOT NULL,
  `permisson` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `users_types`
--

CREATE TABLE `users_types` (
  `id` int(11) NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `valve_clearances`
--

CREATE TABLE `valve_clearances` (
  `task_id` int(11) NOT NULL,
  `valvenum` int(11) NOT NULL,
  `clearance` double NOT NULL,
  `shim_before` int(11) NOT NULL,
  `shim_need` int(11) NOT NULL,
  `shim_installed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `works`
--

CREATE TABLE `works` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `works_groups`
--

CREATE TABLE `works_groups` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `works_types`
--

CREATE TABLE `works_types` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `bike`
--
ALTER TABLE `bike`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`);

--
-- Індекси таблиці `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `known_issues`
--
ALTER TABLE `known_issues`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `mnf`
--
ALTER TABLE `mnf`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `prod_buy`
--
ALTER TABLE `prod_buy`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `prod_category`
--
ALTER TABLE `prod_category`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `prod_mnf`
--
ALTER TABLE `prod_mnf`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `prod_prod`
--
ALTER TABLE `prod_prod`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `prod_sale`
--
ALTER TABLE `prod_sale`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Індекси таблиці `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `tasks_status`
--
ALTER TABLE `tasks_status`
  ADD UNIQUE KEY `id` (`id`);

--
-- Індекси таблиці `tech_data`
--
ALTER TABLE `tech_data`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Індекси таблиці `users_types`
--
ALTER TABLE `users_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Індекси таблиці `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `id_3` (`id`);

--
-- Індекси таблиці `works_groups`
--
ALTER TABLE `works_groups`
  ADD UNIQUE KEY `id` (`id`);

--
-- Індекси таблиці `works_types`
--
ALTER TABLE `works_types`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `bike`
--
ALTER TABLE `bike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблиці `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблиці `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблиці `known_issues`
--
ALTER TABLE `known_issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблиці `mnf`
--
ALTER TABLE `mnf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблиці `models`
--
ALTER TABLE `models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблиці `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблиці `prod_buy`
--
ALTER TABLE `prod_buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблиці `prod_category`
--
ALTER TABLE `prod_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблиці `prod_mnf`
--
ALTER TABLE `prod_mnf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблиці `prod_prod`
--
ALTER TABLE `prod_prod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблиці `prod_sale`
--
ALTER TABLE `prod_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблиці `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблиці `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблиці `tech_data`
--
ALTER TABLE `tech_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблиці `works`
--
ALTER TABLE `works`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT для таблиці `works_groups`
--
ALTER TABLE `works_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблиці `works_types`
--
ALTER TABLE `works_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
