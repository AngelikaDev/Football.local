-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:8888
-- Время создания: Окт 03 2025 г., 19:36
-- Версия сервера: 5.7.39-log
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `football.local`
--

-- --------------------------------------------------------

--
-- Структура таблицы `commands`
--

CREATE TABLE `commands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coach` bigint(20) NOT NULL,
  `stadium` int(11) NOT NULL,
  `composition` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `commands`
--

INSERT INTO `commands` (`id`, `name`, `image`, `city`, `coach`, `stadium`, `composition`, `created_at`, `updated_at`) VALUES
(1, 'Ливерпуль', 'teams/liverpool.png', 'Ливерпуль', 1, 1, NULL, '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(2, 'Манчестер Сити', 'teams/mancity.png', 'Манчестер', 2, 5, NULL, '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(3, 'Арсенал', 'teams/arsenal.png', 'Лондон', 3, 4, NULL, '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(4, 'Манчестер Юнайтед', 'teams/manutd.png', 'Манчестер', 4, 2, NULL, '2025-10-02 08:53:44', '2025-10-02 08:53:44');

-- --------------------------------------------------------

--
-- Структура таблицы `commands_table_without_composition`
--

CREATE TABLE `commands_table_without_composition` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `goals`
--

CREATE TABLE `goals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `match` int(11) NOT NULL,
  `player` bigint(20) NOT NULL,
  `minutes` int(11) NOT NULL,
  `seconds` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `goals`
--

INSERT INTO `goals` (`id`, `match`, `player`, `minutes`, `seconds`, `created_at`, `updated_at`) VALUES
(1, 3, 5, 23, 0, '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(2, 3, 5, 67, 0, '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(3, 3, 6, 45, 2, '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(4, 3, 11, 89, 0, '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(5, 4, 8, 15, 0, '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(6, 4, 8, 78, 0, '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(7, 4, 14, 34, 0, '2025-10-02 08:53:44', '2025-10-02 08:53:44');

-- --------------------------------------------------------

--
-- Структура таблицы `matches`
--

CREATE TABLE `matches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hosts` bigint(20) NOT NULL,
  `guests` bigint(20) NOT NULL,
  `stadium` int(11) NOT NULL,
  `date` date NOT NULL,
  `hosts_goals` int(11) NOT NULL,
  `guests_goals` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `matches`
--

INSERT INTO `matches` (`id`, `hosts`, `guests`, `stadium`, `date`, `hosts_goals`, `guests_goals`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '2025-10-05', 0, 0, '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(2, 3, 4, 4, '2025-10-07', 0, 0, '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(3, 1, 3, 1, '2025-09-22', 3, 1, '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(4, 2, 4, 5, '2025-09-25', 2, 1, '2025-10-02 08:53:44', '2025-10-02 08:53:44');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_09_26_145657_create_players', 1),
(6, '2025_09_26_145901_create_commands', 1),
(7, '2025_09_26_145920_create_stadiums', 1),
(8, '2025_09_26_145933_create_matches', 1),
(9, '2025_09_26_145944_create_goals', 1),
(10, '2025_09_26_150000_create_yellow_cards', 1),
(11, '2025_09_26_150014_create_red_cards', 1),
(12, '2025_10_01_134551_create_news_table', 1),
(13, '2025_10_02_114508_fix_commands_table_composition_field', 1),
(14, '2025_10_02_114852_remove_composition_from_commands_table', 1),
(15, '2025_10_02_115139_create_commands_table_without_composition', 1),
(16, '2025_10_02_150150_add_composition_to_commands_table', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_date` date NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `image`, `publish_date`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'Ливерпуль обыграл Арсенал в захватывающем матче', '<p>В напряженном матче Премьер-лиги Ливерпуль одержал победу над Арсеналом со счетом 3:1. Дубль Салаха и гол Ван Дейка принесли победу хозяевам поля.</p>', 'news/liverpool-arsenal.jpg', '2025-10-01', 1, '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(2, 'Манчестер Сити продолжает победную серию', '<p>Манчестер Сити одержал важную победу над Манчестер Юнайтед. Дубль Холанна стал решающим в этом дерби.</p>', 'news/manchester-derby.jpg', '2025-09-30', 1, '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(3, 'Трансферные слухи: новые приобретения клубов', '<p>В преддверии зимнего трансферного окна клубы Премьер-лиги активно ведут переговоры о новых игроках.</p>', 'news/transfers.jpg', '2025-09-29', 1, '2025-10-02 08:53:44', '2025-10-02 08:53:44');

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `players`
--

CREATE TABLE `players` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `players`
--

INSERT INTO `players` (`id`, `name`, `position`, `country`, `Photo`, `created_at`, `updated_at`) VALUES
(1, 'Юрген Клопп', 'Тренер', 'Германия', 'coaches/klop.jpg', '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(2, 'Пеп Гвардиола', 'Тренер', 'Испания', 'coaches/pep.jpg', '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(3, 'Микель Артета', 'Тренер', 'Испания', 'coaches/arteta.jpg', '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(4, 'Эрик тен Хаг', 'Тренер', 'Нидерланды', 'coaches/tenhag.jpg', '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(5, 'Мохаммед Салах', 'Нападающий', 'Египет', 'players/salah.jpg', '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(6, 'Вирджил ван Дейк', 'Защитник', 'Нидерланды', 'players/vandijk.jpg', '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(7, 'Алиссон Беккер', 'Вратарь', 'Бразилия', 'players/alisson.jpg', '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(8, 'Эрлинг Холанн', 'Нападающий', 'Норвегия', 'players/haaland.jpg', '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(9, 'Кевин Де Брёйне', 'Полузащитник', 'Бельгия', 'players/debruyne.jpg', '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(10, 'Эдерсон', 'Вратарь', 'Бразилия', 'players/ederson.jpg', '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(11, 'Букайо Сака', 'Нападающий', 'Англия', 'players/saka.jpg', '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(12, 'Мартин Эдегор', 'Полузащитник', 'Норвегия', 'players/odegaard.jpg', '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(13, 'Аарон Рамсдейл', 'Вратарь', 'Англия', 'players/ramsdale.jpg', '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(14, 'Маркус Рэшфорд', 'Нападающий', 'Англия', 'players/rashford.jpg', '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(15, 'Бруну Фернандеш', 'Полузащитник', 'Португалия', 'players/fernandes.jpg', '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(16, 'Давид де Хеа', 'Вратарь', 'Испания', 'players/degea.jpg', '2025-10-02 08:53:44', '2025-10-02 08:53:44');

-- --------------------------------------------------------

--
-- Структура таблицы `red_cards`
--

CREATE TABLE `red_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `match` int(11) NOT NULL,
  `player` bigint(20) NOT NULL,
  `minutes` int(11) NOT NULL,
  `seconds` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `red_cards`
--

INSERT INTO `red_cards` (`id`, `match`, `player`, `minutes`, `seconds`, `created_at`, `updated_at`) VALUES
(1, 3, 13, 85, 0, '2025-10-02 08:53:44', '2025-10-02 08:53:44');

-- --------------------------------------------------------

--
-- Структура таблицы `stadiums`
--

CREATE TABLE `stadiums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `stadiums`
--

INSERT INTO `stadiums` (`id`, `name`, `city`, `created_at`, `updated_at`) VALUES
(1, 'Энфилд', 'Ливерпуль', '2025-10-02 08:53:43', '2025-10-02 08:53:43'),
(2, 'Олд Траффорд', 'Манчестер', '2025-10-02 08:53:43', '2025-10-02 08:53:43'),
(3, 'Стэмфорд Бридж', 'Лондон', '2025-10-02 08:53:43', '2025-10-02 08:53:43'),
(4, 'Эмирейтс', 'Лондон', '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(5, 'Этихад', 'Манчестер', '2025-10-02 08:53:44', '2025-10-02 08:53:44');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Angelika', 'anzelikavalieva511@gmail.com', NULL, '$2y$12$muom6gnwJM2Hm/pnABT6JefAUXFw4MOZRVwFEQm6.evnI7DrBRNii', NULL, '2025-10-02 09:07:22', '2025-10-02 09:07:22');

-- --------------------------------------------------------

--
-- Структура таблицы `yellow_cards`
--

CREATE TABLE `yellow_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `match` int(11) NOT NULL,
  `player` bigint(20) NOT NULL,
  `minutes` int(11) NOT NULL,
  `seconds` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `yellow_cards`
--

INSERT INTO `yellow_cards` (`id`, `match`, `player`, `minutes`, `seconds`, `created_at`, `updated_at`) VALUES
(1, 3, 12, 56, 0, '2025-10-02 08:53:44', '2025-10-02 08:53:44'),
(2, 4, 15, 72, 0, '2025-10-02 08:53:44', '2025-10-02 08:53:44');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `commands`
--
ALTER TABLE `commands`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `commands_table_without_composition`
--
ALTER TABLE `commands_table_without_composition`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `red_cards`
--
ALTER TABLE `red_cards`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `stadiums`
--
ALTER TABLE `stadiums`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Индексы таблицы `yellow_cards`
--
ALTER TABLE `yellow_cards`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `commands`
--
ALTER TABLE `commands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `commands_table_without_composition`
--
ALTER TABLE `commands_table_without_composition`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `goals`
--
ALTER TABLE `goals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `matches`
--
ALTER TABLE `matches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `players`
--
ALTER TABLE `players`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `red_cards`
--
ALTER TABLE `red_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `stadiums`
--
ALTER TABLE `stadiums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `yellow_cards`
--
ALTER TABLE `yellow_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
