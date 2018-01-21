-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Янв 22 2018 г., 01:26
-- Версия сервера: 10.1.26-MariaDB-0+deb9u1
-- Версия PHP: 7.0.27-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii2Blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) CHARACTER SET utf8 NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1516511056),
('m180121_043528_create_users_table', 1516511061),
('m180121_043541_create_posts_table', 1516511063),
('m180121_094949_rename_userss_column', 1516528306),
('m180121_165934_add_users_column', 1516554644);

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `body` text CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `body`) VALUES
(1, 2, 'хэй хэй хэй', 'не хочу вставлять дурацкие латинские тексты. не хочу вставлять дурацкие латинские тексты.не хочу вставлять дурацкие латинские тексты.не хочу вставлять дурацкие латинские тексты. не хочу вставлять дурацкие латинские тексты. не хочу вставлять дурацкие латинские тексты.не хочу вставлять дурацкие латинские тексты.не хочу вставлять дурацкие латинские тексты. не хочу вставлять дурацкие латинские тексты. не хочу вставлять дурацкие латинские тексты.не хочу вставлять дурацкие латинские тексты.не хочу вставлять дурацкие латинские тексты. не хочу вставлять дурацкие латинские тексты. не хочу вставлять дурацкие латинские тексты.не хочу вставлять дурацкие латинские тексты.не хочу вставлять дурацкие латинские тексты.'),
(2, 1, 'нет нет нет', 'нет'),
(3, 3, 'пора спать. ', ':)');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `auth_key` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `auth_key`, `email`) VALUES
(1, 'cergiy', '$2y$13$4qc.t13OfZ5gCug1D7Da/uq3NQB7RH3mHJ8R/8Vda.9RqTI/weZ0u', '1', 'cergiy@yandex.ru'),
(2, 'test', '$2y$13$GTsrrACfCi5J0AIGkbM0tOHc0yAxDHF7JEfX5jPKtIhdGuXW7fdwi', '2', 'test@test.net'),
(3, 'thirdOne', '$2y$13$AOPiKn67jaV7w8CLxaSs5eVy9ulUUPrOuZqL2OIuUp42RC8wgIkLy', '?ȡ?C?׷???Ԛ?X??޾#p???h????t(P?Ͻ4???ip?vw??<?M}N?g?0O8w1]?9=?D?˻&?f??#???~?l???N85?????f5??r?Q?1????2?:?d??G??Q?YN-???A?E??$???V??#??[eٙ??!?`?c??L<>|?A7??E???#|?´?ZT??F?O??3--]C?s?s:???R?6?Q??Ii\"?Pը?	?ՠ*????l?B)e??,', 'second@pochta.net');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-posts-user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nickname` (`username`),
  ADD UNIQUE KEY `auth_key` (`auth_key`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk-posts-user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
