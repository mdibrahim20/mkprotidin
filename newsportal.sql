-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2025 at 01:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newsportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `status` enum('draft','published') NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `content`, `category_id`, `user_id`, `image`, `meta_title`, `meta_description`, `views`, `status`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'বাংলাদেশের অর্থনীতি: বর্তমান অবস্থা ও ভবিষ্যৎ', 'bangladesh-economy-status', 'বাংলাদেশের অর্থনীতি দ্রুত অগ্রসর হচ্ছে। গত দশকে জিডিপি বৃদ্ধি উল্লেখযোগ্যভাবে বেড়েছে...', 4, 1, 'articles/eKAqvFFncUISFALlyCyeS7pGE5RJR0ykyGH8Nw5Y.jpg', 'বাংলাদেশের অর্থনীতির বর্তমান অবস্থা', 'বাংলাদেশের অর্থনীতি কেমন এগোচ্ছে এবং এর ভবিষ্যৎ সম্ভাবনা কী?', 1200, 'published', '2025-02-20 21:45:29', '2025-02-20 21:45:29', '2025-02-20 15:47:20'),
(2, 'বিশ্ব রাজনীতিতে পরিবর্তনের হাওয়া', 'global-politics-change', 'বর্তমান বিশ্ব রাজনীতিতে নানান পরিবর্তন লক্ষ্য করা যাচ্ছে। মার্কিন যুক্তরাষ্ট্র এবং ইউরোপের ভূ-রাজনৈতিক পরিবর্তন...', 3, 1, 'politics.jpg', 'বিশ্ব রাজনীতি এবং নতুন পরিবর্তন', 'রাজনৈতিক পরিবর্তন কিভাবে বিশ্বকে প্রভাবিত করছে?', 850, 'published', '2025-02-20 21:45:29', '2025-02-20 21:45:29', '2025-02-20 21:45:29'),
(3, 'টি-টোয়েন্টি বিশ্বকাপে বাংলাদেশের সম্ভাবনা', 't20-worldcup-bangladesh', 'বাংলাদেশের ক্রিকেট দল আসন্ন টি-টোয়েন্টি বিশ্বকাপে অংশগ্রহণ করতে যাচ্ছে। দলে নতুন কিছু পরিবর্তন দেখা গেছে...', 5, 1, 'cricket.jpg', 'টি-টোয়েন্টি বিশ্বকাপ: বাংলাদেশ কতদূর যেতে পারবে?', 'বাংলাদেশের টি-টোয়েন্টি বিশ্বকাপ জয়ের সম্ভাবনা ও দলের শক্তি', 2100, 'published', '2025-02-20 21:45:29', '2025-02-20 21:45:29', '2025-02-20 21:45:29'),
(4, 'নতুন স্মার্টফোন বাজারে: কী কী থাকছে নতুন?', 'latest-smartphone-features', 'প্রযুক্তির বাজারে নতুন স্মার্টফোনের আগমন ঘটছে প্রতিনিয়ত। চলুন জেনে নিই নতুন ডিভাইসগুলোর ফিচার...', 8, 1, 'tech.jpg', 'নতুন স্মার্টফোনের ফিচার ও দাম', 'বাজারে আসা নতুন স্মার্টফোনগুলোর ফিচার, দাম ও তুলনামূলক আলোচনা', 950, 'published', '2025-02-20 21:45:29', '2025-02-20 21:45:29', '2025-02-20 21:45:29'),
(5, 'শীতকালে স্বাস্থ্য ভালো রাখতে করণীয়', 'winter-health-tips', 'শীতকাল আমাদের স্বাস্থ্যের ওপর প্রভাব ফেলে। ঠান্ডা থেকে বাঁচতে কী কী করা দরকার...', 9, 1, 'health.jpg', 'শীতকালীন স্বাস্থ্য টিপস', 'শীতকালে সুস্থ থাকার জন্য করণীয় কিছু সহজ টিপস', 500, 'published', '2025-02-20 21:45:29', '2025-02-20 21:45:29', '2025-02-20 21:45:29'),
(6, 'ঢাকার ট্রাফিক জ্যাম: সমাধানের উপায় কী?', 'dhaka-traffic-solutions', 'রাজধানী ঢাকার যানজট দিন দিন বাড়ছে। এটি সাধারণ মানুষের দৈনন্দিন জীবনে প্রভাব ফেলছে...', 19, 1, 'city-life.jpg', 'ঢাকার ট্রাফিক সমস্যা ও সম্ভাব্য সমাধান', 'ঢাকার যানজট কমানোর উপায় নিয়ে বিশদ আলোচনা', 1400, 'published', '2025-02-20 21:45:29', '2025-02-20 21:45:29', '2025-02-20 21:45:29'),
(7, 'বিশ্বের সেরা পর্যটন স্থান ২০২৫', 'top-travel-destinations-2025', 'বিশ্বের বিভিন্ন দেশ পর্যটকদের জন্য আকর্ষণীয় গন্তব্য হয়ে উঠছে। চলুন জেনে নিই...', 12, 1, 'travel.jpg', '২০২৫ সালের সেরা পর্যটন স্থান', '২০২৫ সালে কোথায় ঘুরতে গেলে সবচেয়ে ভালো অভিজ্ঞতা পাওয়া যাবে?', 700, 'published', '2025-02-20 21:45:29', '2025-02-20 21:45:29', '2025-02-20 21:45:29'),
(8, 'গ্রামবাংলার জীবনধারা: আধুনিকতার ছোঁয়া', 'rural-life-modernization', 'গ্রামবাংলার মানুষ তাদের ঐতিহ্য ধরে রেখেও আধুনিকতার সাথে তাল মিলিয়ে চলার চেষ্টা করছে...', 20, 1, 'rural-life.jpg', 'গ্রামবাংলার আধুনিক পরিবর্তন', 'বাংলাদেশের গ্রামীণ জনজীবনে আধুনিকতার প্রভাব', 600, 'published', '2025-02-20 21:45:29', '2025-02-20 21:45:29', '2025-02-20 21:45:29');

-- --------------------------------------------------------

--
-- Table structure for table `article_tag`
--

CREATE TABLE `article_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `parent_id`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'জাতীয়', 'national', 'জাতীয় সংবাদ বিভাগ', NULL, NULL, 1, '2025-02-20 21:40:45', '2025-02-20 21:40:45'),
(2, 'আন্তর্জাতিক', 'international', 'আন্তর্জাতিক সংবাদ বিভাগ', NULL, NULL, 1, '2025-02-20 21:40:45', '2025-02-20 21:40:45'),
(3, 'রাজনীতি', 'politics', 'রাজনীতি সংক্রান্ত খবর', NULL, NULL, 1, '2025-02-20 21:40:45', '2025-02-20 21:40:45'),
(4, 'অর্থনীতি', 'economy', 'অর্থনীতি ও ব্যবসার খবর', NULL, NULL, 1, '2025-02-20 21:40:45', '2025-02-20 21:40:45'),
(5, 'খেলাধুলা', 'sports', 'খেলাধুলার সব খবর', NULL, NULL, 1, '2025-02-20 21:40:45', '2025-02-20 21:40:45'),
(6, 'বিনোদন', 'entertainment', 'বিনোদন সংক্রান্ত খবর', NULL, NULL, 1, '2025-02-20 21:40:45', '2025-02-20 21:40:45'),
(7, 'শিক্ষা', 'education', 'শিক্ষা সংক্রান্ত তথ্য', NULL, NULL, 1, '2025-02-20 21:40:45', '2025-02-20 21:40:45'),
(8, 'প্রযুক্তি', 'technology', 'প্রযুক্তি ও গ্যাজেট সংবাদ', NULL, NULL, 1, '2025-02-20 21:40:45', '2025-02-20 21:40:45'),
(9, 'স্বাস্থ্য', 'health', 'স্বাস্থ্য বিষয়ক সংবাদ', NULL, NULL, 1, '2025-02-20 21:40:45', '2025-02-20 21:40:45'),
(10, 'জীবনযাপন', 'lifestyle', 'জীবনযাত্রা ও ফ্যাশন', NULL, NULL, 1, '2025-02-20 21:40:45', '2025-02-20 21:40:45'),
(11, 'ধর্ম', 'religion', 'ধর্ম ও বিশ্বাস সংক্রান্ত খবর', NULL, NULL, 1, '2025-02-20 21:40:45', '2025-02-20 21:40:45'),
(12, 'পর্যটন', 'travel', 'ভ্রমণ ও পর্যটন বিষয়ক খবর', NULL, NULL, 1, '2025-02-20 21:40:45', '2025-02-20 21:40:45'),
(13, 'আইন ও বিচার', 'law-justice', 'আইন ও ন্যায়বিচার সংক্রান্ত খবর', NULL, NULL, 1, '2025-02-20 21:40:45', '2025-02-20 21:40:45'),
(14, 'কৃষি', 'agriculture', 'কৃষি ও কৃষকের খবর', NULL, NULL, 1, '2025-02-20 21:40:45', '2025-02-20 21:40:45'),
(15, 'বিজ্ঞান', 'science', 'বিজ্ঞান ও গবেষণা সংক্রান্ত খবর', NULL, NULL, 1, '2025-02-20 21:40:45', '2025-02-20 21:40:45'),
(16, 'মতামত', 'opinion', 'বিশেষজ্ঞ ও পাঠকের মতামত', NULL, NULL, 1, '2025-02-20 21:40:45', '2025-02-20 21:40:45'),
(17, 'বিশেষ প্রতিবেদন', 'special-reports', 'গভীর বিশ্লেষণমূলক প্রতিবেদন', NULL, NULL, 1, '2025-02-20 21:40:45', '2025-02-20 21:40:45'),
(18, 'দুর্ঘটনা', 'accident', 'দুর্ঘটনা ও অপরাধ সংক্রান্ত খবর', NULL, NULL, 1, '2025-02-20 21:40:45', '2025-02-20 21:40:45'),
(19, 'নগর জীবন', 'city-life', 'শহর ও নগর সংক্রান্ত খবর', NULL, NULL, 1, '2025-02-20 21:40:45', '2025-02-20 21:40:45'),
(20, 'গ্রামবাংলা', 'rural-life', 'গ্রাম ও কৃষি জীবন সংক্রান্ত খবর', NULL, NULL, 1, '2025-02-20 21:40:45', '2025-02-20 21:40:45');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `guest_name` varchar(255) DEFAULT NULL,
  `guest_email` varchar(255) DEFAULT NULL,
  `comment` text NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `article_id`, `user_id`, `guest_name`, `guest_email`, `comment`, `is_approved`, `created_at`, `updated_at`) VALUES
(2, 2, 1, NULL, NULL, 'asd', 1, '2025-02-20 16:16:22', '2025-02-20 16:16:25'),
(3, 2, 1, NULL, NULL, 'asdasdasdasd', 0, '2025-02-20 16:22:10', '2025-02-20 16:22:10');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_18_162037_add_two_factor_columns_to_users_table', 1),
(5, '2025_02_18_162110_create_personal_access_tokens_table', 1),
(6, '2025_02_18_181547_create_categories_table', 1),
(7, '2025_02_18_181548_create_tags_table', 1),
(8, '2025_02_18_181549_create_articles_table', 1),
(9, '2025_02_19_082533_create_settings_table', 1),
(10, '2025_02_19_083001_create_ads_table', 1),
(13, '2025_02_19_083329_create_comments_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Q1qzLpCY54WYWuUwnoHekEWjwxxbBAn07DLdlvld', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 Edg/133.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibDVOcTdiVVBoOG9Dang2ZlBwY09GaGJDTk5xRFJsNXBURml3aTV1WiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTIkem4yVElGbERFS01SVFJ5WGxmU09hLm01RjhkbC5MOTFQNXgvcnhTMmNaQXh6Tzk3L2RqQk8iO30=', 1740090201);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `canonical_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','author','editor') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `role`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'asd', 'dfhfdjfgt5645@gmail.com', NULL, '$2y$12$zn2TIFlDEKMRTRyXlfSOa.m5F8dl.L91P5x/rxS2cZAxzO97/djBO', NULL, NULL, NULL, 'admin', NULL, NULL, NULL, '2025-02-20 15:44:14', '2025-02-20 15:44:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articles_slug_unique` (`slug`),
  ADD KEY `articles_category_id_foreign` (`category_id`),
  ADD KEY `articles_user_id_foreign` (`user_id`);

--
-- Indexes for table `article_tag`
--
ALTER TABLE `article_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_tag_article_id_foreign` (`article_id`),
  ADD KEY `article_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_article_id_foreign` (`article_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `article_tag`
--
ALTER TABLE `article_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `article_tag`
--
ALTER TABLE `article_tag`
  ADD CONSTRAINT `article_tag_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `article_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
