-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Май 07 2022 г., 18:08
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
  `price` double DEFAULT NULL,
  `number` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `session_id`, `goods_id`, `price`, `number`) VALUES
(503, '6rta9l3h8g7mtf4hhmgga6smap5nt42h', 1, 25, 1),
(504, 't21llifho7kkdb6qusgudqtonfib2pev', 1, 25, 1),
(505, 'q5eileaers7ha75d29qn1fii31aau9ga', 1, 35, 2),
(506, 'q5eileaers7ha75d29qn1fii31aau9ga', 2, 1, 3),
(507, 'hl1p5f9kjc9d7fmkfkpfe87a2ffcl9h3', 2, 1, 1),
(508, '39fog4jg7llmlqou5ao4j9guijg7sebn', 6, 12, 1),
(509, '39fog4jg7llmlqou5ao4j9guijg7sebn', 43, 456, 5),
(510, '5detm4ntorto56k2rmq5v4qa5p7nq8l2', 1, 35, 1),
(511, '5detm4ntorto56k2rmq5v4qa5p7nq8l2', 2, 1, 5),
(512, '5detm4ntorto56k2rmq5v4qa5p7nq8l2', 6, 12, 3);

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
(6, 'Test_OD', '22315'),
(47, 'Тест', 'Тестовый отзыв снова отредактирован'),
(57, 'Алексей', 'Мой исправленный отзыв'),
(68, 'Исправлено имя', 'Исправлен текст'),
(69, 'Проверка исправления', 'Отзыв исправлен'),
(70, 'Новый отзыв', 'Добавлен и изменён'),
(75, 'Tester', 'New feedback'),
(79, 'admin', 'Скорректированный отзыв админа'),
(102, '11', '223'),
(104, 'ewre', 'qwere1'),
(105, 'asdf1', 'hgjhgj'),
(106, '12', '32'),
(107, 'A', '3'),
(109, '1232', '2'),
(110, '134', '2');

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
(1, 'Пицца', 'pizza.jpg', 'Вкусная домашняя пицца', '35.00'),
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
  `phone_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `total_price` float NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'оформлен'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `cart_session`, `login`, `customer_name`, `phone_number`, `email`, `total_price`, `status`) VALUES
(50, 'q5eileaers7ha75d29qn1fii31aau9ga', 'test', ' Алексей', '806', 'ag0580@gmail.com', 73, 'в работе'),
(51, 'hl1p5f9kjc9d7fmkfkpfe87a2ffcl9h3', 'test', 'SADFASD', 'F31246453', '123126576', 1, 'обработан'),
(52, '39fog4jg7llmlqou5ao4j9guijg7sebn', 'user5', 'wre', '1322165', '412dfsg456', 2292, 'оформлен'),
(53, '5detm4ntorto56k2rmq5v4qa5p7nq8l2', 'admin', 'weqrhy', '1456437578', '1234fgj695', 76, 'доставка');

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
(17, 'test', '$2y$10$ob20o7HXjiND6TdeK25AQ.XOjeN1owsySymdXRbEf8Ix6uBW2BHYe', '8921800762752b59609c32.82712399'),
(18, 'admin', '$2y$10$kQ1uE/RuyHOL78PqpK9biuy13xbk9WndPyCbFEd9VL9me.ec1V4S.', '30602803762750b7ada7682.97570734'),
(49, 'user5', '$2a$12$9HGsaKZ/UwlSB.xVbT7yXuYBsCkLWG7vLXboJPMuEtXrIdpOJQfeO', '!@#$%$#%$@#$@');

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
  ADD KEY `cart_session_2` (`cart_session`),
  ADD KEY `login` (`login`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=513;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

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
