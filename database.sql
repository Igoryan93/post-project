-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 31 2020 г., 12:23
-- Версия сервера: 5.6.47
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `database`
--

-- --------------------------------------------------------

--
-- Структура таблицы `information`
--

CREATE TABLE `information` (
  `id` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vkontakte` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telegram` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `information`
--

INSERT INTO `information` (`id`, `address`, `company`, `job`, `image`, `phone`, `vkontakte`, `telegram`, `instagram`, `user_id`) VALUES
(1, '46441 Stiedemann Causeway\nAlvenafort, WY 68081-4141', 'Beer, Hammes and Wyman', 'Counsil', '', '562.695.8645', 'Vkontakte', 'Telegram', 'Instagram', 13),
(2, '18558 Reynolds Grove Apt. 812\nWest Ferneland, WA 64048', 'Gutmann, Osinski and Murazik', 'Clinical Psychologist', '', '(324) 292-0638', 'Vkontakte0', 'Telegram0', 'Instagram0', 9),
(3, '43439 Sonny Harbor Suite 788\nClemenshaven, NM 03376-0332', 'Goyette LLC', 'Precision Instrument Repairer', '', '(526) 619-9561', 'Vkontakte1', 'Telegram1', 'Instagram1', 11),
(4, '72665 Mueller Estate Suite 280\nO\'Konside, NE 34437', 'Sipes-Feeney', 'Screen Printing Machine Operator', '', '759.206.9549', 'Vkontakte2', 'Telegram2', 'Instagram2', 12),
(5, '5008 Ruecker Radial\nNew Revamouth, GA 51281', 'Hartmann, Runte and Wilkinson', 'Emergency Medical Technician and Paramedic', '', '+1-258-651-2423', 'Vkontakte3', 'Telegram3', 'Instagram3', 14),
(6, '17982 Shanahan Flats\nAylastad, IN 75148', 'Zboncak-Ebert', 'Manicurists', '', '507-638-5804 x47236', 'Vkontakte4', 'Telegram4', 'Instagram4', 15),
(7, '9755 Brakus Viaduct\nLake Llewellyn, TN 31272-1414', 'Turcotte, Fay and Collier', 'Medical Assistant', '', '1-415-553-6066 x971', 'Vkontakte5', 'Telegram5', 'Instagram5', 16),
(8, '444 Daugherty Shoal\nKihnport, SD 93010', 'Kertzmann-Hamill', 'Paper Goods Machine Operator', '', '1-234-392-0798', 'Vkontakte6', 'Telegram6', 'Instagram6', 19),
(9, '7048 Marilyne Drive Suite 188\nPort Evanston, KY 20465', 'Abernathy-Wuckert', 'Forming Machine Operator', '', '839-627-3072 x452', 'Vkontakte7', 'Telegram7', 'Instagram7', 20),
(10, '1419 Bessie Common\nGreysonfort, MI 50604', 'Hackett, Corkery and Cremin', 'Rail Yard Engineer', '', '(539) 364-6898', 'Vkontakte8', 'Telegram8', 'Instagram8', 0),
(11, '54884 Witting Motorway Suite 430\nNorth Maurice, GA 22665-1288', 'Lind Inc', 'Ambulance Driver', '', '1-317-314-1524 x015', 'Vkontakte9', 'Telegram9', 'Instagram9', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(249) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vkontakte` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telegram` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `verified` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `resettable` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `roles_mask` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `registered` int(10) UNSIGNED NOT NULL,
  `last_login` int(10) UNSIGNED DEFAULT NULL,
  `force_logout` mediumint(7) UNSIGNED NOT NULL DEFAULT '0',
  `state` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `address`, `company`, `job`, `image`, `phone`, `vkontakte`, `telegram`, `instagram`, `status`, `verified`, `resettable`, `roles_mask`, `registered`, `last_login`, `force_logout`, `state`) VALUES
(9, 'vvv@vvv.com', '$2y$10$JNAdZBw3eYXJiYV..GPsEuhBW.7VlGlizsm.DhLYsTYyy/oSzzOyq', 'John Mariarty', 'Kazakhstan Almaty Dostik 2', 'Almaty Zoopark', 'Clinical Psychologist', '750a89fedae62aa4ac175fdef8f16563.jpg', '(324) 292-0638 2', 'Vkontakte1', 'Telegram1', 'Instagram1', 0, 1, 1, 0, 1609087000, 1609344632, 0, 2),
(33, 'jill_valentine@gmail.com', '$2y$10$lj9In8xq5BFa1/2wvZQhFOnFcCMAeJBKmP//ZcwMjdi93.e6KGWwG', 'jill Valentine', 'Raccon city, st 28 43/b', 'Stars Raccon City', '', '5376f4469f4624f4d6f811ebb938f6b9.jpg', '87775594680', '', '', '', 0, 1, 1, 0, 1609401524, 1609401561, 0, 1),
(14, 'ttt@ttt.com', '$2y$10$LbDJm8hwxo6hFPdXwW3MSumVRjEu5sQYiHTdN41Ay3VZsdNUkG9HS', NULL, '17982 Shanahan Flats Aylastad, IN 75148', 'Zboncak-Ebert', 'Manicurists', '', '507-638-5804 x47236', 'Vkontakte5', 'Telegram5', 'Instagram5', 0, 1, 1, 0, 1609139168, 1609145344, 0, 1),
(15, 'nnn@nnn.com', '$2y$10$kICfLimLfe2AMC2.JL8dQOrr0nbpxJcHPZyhYZzqFLEg3.vEJi4CK', NULL, '9755 Brakus Viaduct Lake Llewellyn, TN 31272-1414', 'Turcotte, Fay and Collier', 'Medical Assistant', '', '1-415-553-6066 x971', 'Vkontakte6', 'Telegram6', 'Instagram6', 0, 1, 1, 0, 1609139329, NULL, 0, 2),
(16, 'ppp@ppp.com', '$2y$10$hxbiik0lvnIcLeDwQ8DnHutP24/HxvcmPx8d.Ekt76RZoQsZ7Gqg6', 'Rebeca Chembers', 'USA Raccon city Police station', 'STARS Raccon City', 'Paper Goods Machine Operator', '', '1-234-392-0798', 'Vkontakte7', 'Telegram7', 'Instagram7', 0, 0, 1, 0, 1609147995, NULL, 0, 0),
(32, 'eee@eee.com', '$2y$10$vTrAaIZLJSDuRS9B/raMYex1kreEeJbS0jD/tudNVx1xeWqXOjjtO', 'testing name', 'testing address', 'testing job', 'testing job', 'dc4cbab56e547ce6f3f22a077b324367.jpg', '87775594680', 'testing social', 'testing social1', 'testing social2', 0, 1, 1, 1, 1609348933, 1609349149, 0, 2),
(20, 'ada_wong@gmail.com', '$2y$10$lIjf8Pxjj8zlVKm6HWnRdOhnNrkZXW95VuV5cGjrSE2O0VfgLQ91K', 'Ada Wong', 'USA Raccon city', 'Umbrella Corporation', 'Rail Yard Engineer', '9857166ebc3ff3cf4b95c95043240090.jpg', '87775594680', 'Vkontakte9', 'Telegram9', 'Instagram9', 0, 1, 1, 1, 1609149256, 1609406458, 10, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `users_confirmations`
--

CREATE TABLE `users_confirmations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(249) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selector` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users_confirmations`
--

INSERT INTO `users_confirmations` (`id`, `user_id`, `email`, `selector`, `token`, `expires`) VALUES
(8, 8, 'ttt@ttt.com', 'ueSZrHfKH9DmeQY5', '$2y$10$C3obV86E1rpokKSSBzo4eOBctBRqUzjnPxo.YqIehF8I4vgtfkE42', 1609172118),
(13, 13, 'mmm@mmm.com', 'FhpUCJzjI8E5Zq3C', '$2y$10$DpaJjM/Jtr2XSRPrFZKjT.mG9Ea.Rnn0GKTJK0mMSUTjjm5ZlJpKW', 1609175511),
(16, 16, 'ppp@ppp.com', 'mkwEebD24hHzLUzW', '$2y$10$SyHB9F7pbyaFPsWkvLvvNeIobKmPUp7WNnzE6/5uH0NhOY3NdSRcm', 1609234395);

-- --------------------------------------------------------

--
-- Структура таблицы `users_remembered`
--

CREATE TABLE `users_remembered` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `selector` varchar(24) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users_remembered`
--

INSERT INTO `users_remembered` (`id`, `user`, `selector`, `token`, `expires`) VALUES
(3, 20, 'IgURKkEfTVJU-EhIEd221F75', '$2y$10$aZET2pvTOG.JXPUU7nkfr.t8SwpALw3NXtra43pYygo7G/ymufKw.', 1640962927);

-- --------------------------------------------------------

--
-- Структура таблицы `users_resets`
--

CREATE TABLE `users_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `selector` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users_throttling`
--

CREATE TABLE `users_throttling` (
  `bucket` varchar(44) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `tokens` float UNSIGNED NOT NULL,
  `replenished_at` int(10) UNSIGNED NOT NULL,
  `expires_at` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users_throttling`
--

INSERT INTO `users_throttling` (`bucket`, `tokens`, `replenished_at`, `expires_at`) VALUES
('wgUuRIBi5vFaJwD3_oaUsmGYcvWF-_svopYdMRRTxzY', 499, 1609401552, 1609574352),
('N3_KwYjgIIakEOiCTQGCBZjT5Kv1nZBFwFFq9gDDVs4', 29, 1609401541, 1609473541),
('2-cIrY_3XOaP4z4ZJMn6PWvzu3kfPIDJgPR9A64Hkzs', 29, 1609401541, 1609473541),
('78ESAWTReb_GWnNlm7vhfHjCADSs97uvjtcBQxo6KTs', 29, 1609343035, 1609415035),
('kqRS2hIlh_fZZ21GP-UY9doGzaY1jdxeMip0dMDBhy4', 29, 1609343035, 1609415035),
('HIJQJPUQ2qyyTt0Q7_AuZA0pXm27czJnqpJsoA5IFec', 49, 1609401541, 1609473541),
('PZ3qJtO_NLbJfRIP-8b4ME4WA3xxc6n9nbCORSffyQ0', 4, 1609401527, 1609833527),
('GsL-Q43tVbUYsdNOLrVckXlpDCSz3SJLDjdebR5OleU', 499, 1609319108, 1609491908),
('8ezH-vPFHMQQFJhnMUKhKxrSe0sXRjMBZDRiZABZkdU', 499, 1609401822, 1609574622),
('OMhkmdh1HUEdNPRi-Pe4279tbL5SQ-WMYf551VVvH8U', 18.3, 1609401822, 1609437822),
('3VrMU354Y_uVX22KD-pensoGyl9P8xi0fs5YhJZGrOk', 11, 1609344660, 1609373459),
('QduM75nGblH2CDKFyk0QeukPOwuEVDAUFE54ITnHM38', 35.2618, 1609406451, 1609946451);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `users_confirmations`
--
ALTER TABLE `users_confirmations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `email_expires` (`email`,`expires`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users_remembered`
--
ALTER TABLE `users_remembered`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `user` (`user`);

--
-- Индексы таблицы `users_resets`
--
ALTER TABLE `users_resets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `user_expires` (`user`,`expires`);

--
-- Индексы таблицы `users_throttling`
--
ALTER TABLE `users_throttling`
  ADD PRIMARY KEY (`bucket`),
  ADD KEY `expires_at` (`expires_at`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `information`
--
ALTER TABLE `information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `users_confirmations`
--
ALTER TABLE `users_confirmations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `users_remembered`
--
ALTER TABLE `users_remembered`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users_resets`
--
ALTER TABLE `users_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
