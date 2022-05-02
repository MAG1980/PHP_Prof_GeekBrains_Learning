-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Апр 26 2022 г., 17:55
-- Версия сервера: 8.0.24
-- Версия PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `goods_id` int NOT NULL,
  `number` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `session_id`, `goods_id`, `number`) VALUES
(122, 'knoe4o69jvhqqgfsc39aaeokklrm33fh', 1, 1),
(123, 'knoe4o69jvhqqgfsc39aaeokklrm33fh', 1, 1),
(124, 'knoe4o69jvhqqgfsc39aaeokklrm33fh', 2, 1),
(125, 'knoe4o69jvhqqgfsc39aaeokklrm33fh', 6, 1),
(126, 'knoe4o69jvhqqgfsc39aaeokklrm33fh', 6, 1),
(127, 'knoe4o69jvhqqgfsc39aaeokklrm33fh', 6, 1),
(128, '7fkh5s44hfnlf886thevu4i5brat9e92', 1, 1),
(129, '7fkh5s44hfnlf886thevu4i5brat9e92', 2, 1),
(130, '7fkh5s44hfnlf886thevu4i5brat9e92', 6, 1),
(131, '7fkh5s44hfnlf886thevu4i5brat9e92', 2, 1),
(132, '5u3e0epo7ud6m7lueheh5bojsbaa8sti', 1, 1),
(133, '5u3e0epo7ud6m7lueheh5bojsbaa8sti', 1, 1),
(134, '5u3e0epo7ud6m7lueheh5bojsbaa8sti', 2, 1),
(135, '5u3e0epo7ud6m7lueheh5bojsbaa8sti', 2, 1),
(136, '5u3e0epo7ud6m7lueheh5bojsbaa8sti', 2, 1),
(137, 'u7l02rgmcr348rk9nq1il3ccamam1tj4', 6, 1),
(138, 'u7l02rgmcr348rk9nq1il3ccamam1tj4', 6, 1),
(139, 'u7l02rgmcr348rk9nq1il3ccamam1tj4', 6, 1),
(140, 'g2bl3gjjnq9as1g36s7pan5a6gmms04j', 1, 1),
(141, 'g2bl3gjjnq9as1g36s7pan5a6gmms04j', 1, 1),
(142, 'g2bl3gjjnq9as1g36s7pan5a6gmms04j', 6, 1),
(161, '0cmd77levs255g3mdj82kiq1aj42oigs', 1, 1),
(162, '0cmd77levs255g3mdj82kiq1aj42oigs', 1, 1),
(163, '0cmd77levs255g3mdj82kiq1aj42oigs', 1, 1),
(164, '0cmd77levs255g3mdj82kiq1aj42oigs', 1, 1),
(165, '0cmd77levs255g3mdj82kiq1aj42oigs', 2, 1),
(166, '5hqdlv9uo75mlv557jeaml6je4494fak', 1, 1),
(167, '5hqdlv9uo75mlv557jeaml6je4494fak', 1, 1),
(168, '5hqdlv9uo75mlv557jeaml6je4494fak', 6, 1),
(169, '5hqdlv9uo75mlv557jeaml6je4494fak', 6, 1),
(170, '5hqdlv9uo75mlv557jeaml6je4494fak', 6, 1),
(171, 'snorv6sfrmifrisn6v4cugpdgdeae8im', 1, 1),
(172, '0mvkj7kqsd7f1oetqg2kpb1jppsptcuj', 1, 1),
(173, '0mvkj7kqsd7f1oetqg2kpb1jppsptcuj', 1, 1),
(174, '0mvkj7kqsd7f1oetqg2kpb1jppsptcuj', 2, 1),
(175, '84hitp0hka5ael98k0n377e6436sqr3f', 2, 1),
(176, '84hitp0hka5ael98k0n377e6436sqr3f', 2, 1),
(177, '84hitp0hka5ael98k0n377e6436sqr3f', 6, 1),
(178, '84hitp0hka5ael98k0n377e6436sqr3f', 2, 1),
(179, '84hitp0hka5ael98k0n377e6436sqr3f', 6, 1),
(180, 's2l8c13aci03b0jh1k8fi7i2sit758e9', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `text`) VALUES
(6, 'Test_OD', '2231'),
(16, 'Имя изменено', 'text снова изменён'),
(47, 'Тест', 'Тестовый отзыв снова отредактирован'),
(56, 'Алексей', 'Мой отзыв'),
(57, 'Алексей', 'Мой исправленный отзыв'),
(59, 'Алексей', 'Мой отзыв'),
(62, 'test11', 'text'),
(65, '12', '335'),
(68, 'Исправлено имя', 'Исправлен текст'),
(69, 'Проверка исправления', 'Отзыв исправлен'),
(70, 'Новый отзыв', 'Добавлен'),
(75, 'Tester', 'New feedback'),
(76, '123', 'dsaf'),
(78, 'Имя', 'Отзыв');

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `image`, `description`, `price`) VALUES
(1, 'Пицца', 'pizza.jpg', 'Вкусная домашняя пицца', '24.00'),
(2, 'Чай', 'tea.jpg', 'Крупнолистовой высокогорный чёрный', '1.00'),
(6, 'Яблоко', 'apple.jpg', 'Спелое сочное', '12.00'),
(43, 'Новое имя товара', 'cake.jgp', 'Новое описание товара', '456.00'),
(63, 'Cake7', 'cake.jgp', 'Описание', '325.00'),
(65, 'Cake8', 'cake.jgp', 'Описание', '325.00'),
(69, 'Cake10', 'cake.jgp', 'Описание', '325.00'),
(70, 'Cake10', 'cake.jgp', 'Описание', '325.00');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int NOT NULL,
  `filename` varchar(255) NOT NULL,
  `likes` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `filename`, `likes`) VALUES
(10, '01.jpg', 4),
(11, '02.jpg', 13),
(12, '03.jpg', 1),
(13, '04.jpg', 1),
(14, '05.jpg', 1),
(15, '06.jpg', 22),
(16, '07.jpg', 1),
(17, '08.jpg', 7),
(18, '09.jpg', 1),
(19, '10.jpg', 0),
(20, '11.jpg', 2),
(21, '12.jpg', 1),
(22, '13.jpg', 2),
(23, '14.jpg', 3),
(24, '15.jpg', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `text`) VALUES
(1, 'Си Цзиньпин указал Байдену, что от санкций страдают простые люди', 'ПЕКИН, 18 мар – РИА Новости. От санкций страдают простые люди, заявил в пятницу председатель КНР Си Цзиньпин в разговоре с президентом США Джо Байденом.\r\nОн также призвал поддерживать диалог и переговоры России и Украины,.\r\n\"Все стороны должны совместно поддерживать диалог и переговоры России и Украины\", - заявил Си Цзиньпин, слова которого приводит МИД КНР.\r\nСи Цзиньпин также отметил, Китай всегда выступал за соблюдение международного права и общепризнанных норм международных отношений, необходимости придерживаться Устава ООН, а также за всеобщую, совместную и устойчивую концепцию безопасности.\r\n\"В настоящее время отношения Китая и США еще не вышли из тупика, созданного предыдущей американской администрацией, и, наоборот, сталкиваются с еще большими вызовами. В особенности опасно то, что некоторые люди в США направляют ложные сигналы силам, выступающим за независимость Тайваня\", -добавил он.'),
(2, 'В России могут скоро заблокировать YouTube, сообщил источник', 'МОСКВА, 18 мар — РИА Новости. Роскомнадзор может заблокировать YouTube в ближайшие дни, сообщил РИА Новости источник, близкий к Роскомнадзору.\r\n\"Скорее всего, до конца следующей недели YouTube уже заблокируют. <...> Я предполагаю это с высокой степенью вероятности. Мне известно, что его должны были заблокировать еще на той неделе, но случилась Meta (блокировка Instagram), и я уверен, что блокировку просто отложили, чтобы было не все сразу\", — заявил собеседник агентства.\r\nПри этом он предположил, что ограничения могут ввести уже сегодня.\r\nРИА Новости направило запрос в Роскомнадзор по данному вопросу.\r\nВедомство 11 марта ограничило доступ к Instagram на территории страны из-за разрешения пользователям сети призывать к насилию в отношении россиян. С 14 марта доступ был запрещен полностью. В начале марта Роскомнадзор в ответ на ограничение доступа к российским СМИ заблокировал Facebook.'),
(3, '1', 'new'),
(5, '213', '34');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `cart_session` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `customer_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `cart_session`, `login`, `customer_name`, `phone_number`) VALUES
(14, 'knoe4o69jvhqqgfsc39aaeokklrm33fh', '', 'test Алексей', '12-123-23'),
(15, '7fkh5s44hfnlf886thevu4i5brat9e92', '', 'user Никита', '55-55-55'),
(16, '5u3e0epo7ud6m7lueheh5bojsbaa8sti', '', 'test', '11-11-11'),
(17, 'u7l02rgmcr348rk9nq1il3ccamam1tj4', '', 'test', '22-22-33'),
(18, 'g2bl3gjjnq9as1g36s7pan5a6gmms04j', '', 'admin', '45445455'),
(19, '0cmd77levs255g3mdj82kiq1aj42oigs', 'test', 'test Алексей', '11-22-33'),
(20, '5hqdlv9uo75mlv557jeaml6je4494fak', 'test', 'test Алексей', '12-123-23'),
(21, 'snorv6sfrmifrisn6v4cugpdgdeae8im', 'test', 'test Алексей', '12-123-23'),
(22, '0mvkj7kqsd7f1oetqg2kpb1jppsptcuj', 'user', 'user', '45445455'),
(23, '84hitp0hka5ael98k0n377e6436sqr3f', 'user', 'user', '45445455'),
(24, 's2l8c13aci03b0jh1k8fi7i2sit758e9', 'admin', 'admin', '123123');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `hash`) VALUES
(17, 'test', '$2y$10$ob20o7HXjiND6TdeK25AQ.XOjeN1owsySymdXRbEf8Ix6uBW2BHYe', '1356634696624bd4100a5e34.00279342'),
(18, 'admin', '$2y$10$kQ1uE/RuyHOL78PqpK9biuy13xbk9WndPyCbFEd9VL9me.ec1V4S.', '1758567421624bf366e43460.78362641'),
(19, 'user', '$2y$10$CQoRfURtXEnXsFXNms6hwOFIM14Ge.Tl3HpDVJbOz44a3h768t5.m', NULL),
(47, 'admin5', '12345', NULL),
(48, 'admin5', '12345', NULL),
(49, 'user5', '12345', '!@#$%$#%$@#$@'),
(51, 'admin55', 'asdfdsafasdf', '!@#$%$#%$@#$@'),
(52, 'admin55', 'asdfdsafasdf', '!@#$%$#%$@#$@'),
(53, 'admin55', 'asdfdsafasdf', '!@#$%$#%$@#$@'),
(54, 'admin55', 'asdfdsafasdf', '!@#$%$#%$@#$@');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goods_id` (`goods_id`) USING BTREE,
  ADD KEY `session_id` (`session_id`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_session` (`cart_session`),
  ADD KEY `cart_session_2` (`cart_session`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
