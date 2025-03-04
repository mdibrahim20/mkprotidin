-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2025 at 09:03 PM
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

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `title`, `image`, `position`, `url`, `created_at`, `updated_at`) VALUES
(1, 'asdasd', 'ads/GpeKgSAU6d35na1UTvnGFq3p5AzaMjSyrDGE1NH8.png', 'header', 'https://www.google.com/', '2025-03-02 11:22:33', '2025-03-02 11:22:33');

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
(8, 'গ্রামবাংলার জীবনধারা: আধুনিকতার ছোঁয়া', 'rural-life-modernization', 'গ্রামবাংলার মানুষ তাদের ঐতিহ্য ধরে রেখেও আধুনিকতার সাথে তাল মিলিয়ে চলার চেষ্টা করছে...', 20, 1, 'rural-life.jpg', 'গ্রামবাংলার আধুনিক পরিবর্তন', 'বাংলাদেশের গ্রামীণ জনজীবনে আধুনিকতার প্রভাব', 600, 'published', '2025-02-20 21:45:29', '2025-02-20 21:45:29', '2025-02-20 21:45:29'),
(9, 'শান্তিরক্ষা মিশন এলাকা সেন্ট্রাল আফ্রিকান রিপাবলিক পরিদর্শনে গেলেন সেনাবাহিনী প্রধান', 'santirksha-misn-elaka-sentral-afrikan-ripablik-pridrsne-gelen-senabahinee-prdhan', 'নিউজ ডেস্ক: ০৩ মার্চ ২০২৫ (সোমবার): সেনাবাহিনী প্রধান জেনারেল ওয়াকার-উজ-জামান, এসবিপি, ওএসপি, এসজিপি, পিএসসি আজ তিন দিনের সরকারি সফরে সেন্ট্রাল আফ্রিকান রিপাবলিক এর উদ্দেশ্যে ঢাকা ত্যাগ করেন। সফরকালে তিনি সেন্ট্রাল আফ্রিকান রিপাবলিক এ নিয়োজিত বাংলাদেশী কন্টিনজেন্টসমূহ ও সেখানে অবস্থানরত বাংলাদেশী শান্তিরক্ষীদের বিভিন্ন কার্যক্রম পরিদর্শন করবেন বলে জানা যায়। এছাড়াও, সেখানকার জনসাধারণের সেবার উদ্দেশ্যে বাংলাদেশ সেনাবাহিনী শান্তিরক্ষী কর্তৃক নির্মিত একটি কমিউনিটি ক্লিনিক সেনাবাহিনী প্রধান এর শুভ উদ্বোধন করার পরিকল্পনা রয়েছে।\r\nউল্লেখ্য, সেন্ট্রাল আফ্রিকান রিপাবলিক এ বর্তমানে বাংলাদেশ সেনাবাহিনীর ০৫ টি কন্টিনজেন্ট শান্তিরক্ষা মিশনে নিয়োজিত রয়েছে। এছাড়াও, ২০১৪ সাল হতে অদ্যাবধি ৯৯৬১ জন সেনাসদস্য শান্তিরক্ষী হিসেবে দায়িত্ব পালন এবং আফ্রিকার সংঘাতপূর্ণ এই দেশে শান্তিরক্ষা কার্যক্রমে নিয়োজিত অবস্থায় ১১ জন সেনাসদস্য জীবন উৎসর্গ করেছেন।', 1, 1, 'articles/AjU5XIH4WmAeIVtbPnzagIpsbNEPLXo1LCXufbk2.png', NULL, NULL, 0, 'draft', NULL, '2025-03-03 11:16:27', '2025-03-03 11:16:27'),
(11, 'মহানগরীর বিভিন্ন এলাকার চিহ্নিত সন্ত্রাসী বাহিনীর বিরুদ্ধে ‘অলআউট অ্যাকশনে’ যাচ্ছে ডিবি', 'mhangreer-bivinn-elakar-cihnit-sntrasee-bahineer-biruddhe-olaut-ozakshne-zacche-dibi', 'ঢাকা মেট্রোপলিটন পুলিশের অতিরিক্ত পুলিশ কমিশনার (ডিবি) রেজাউল করিম মল্লিক বলেছেন, মহানগরীর বিভিন্ন এলাকার চিহ্নিত সন্ত্রাসী বাহিনীর বিরুদ্ধে ‘অলআউট অ্যাকশনে’ যাচ্ছে ডিবি। তাছাড়া ছোট-বড় যেকোনো অপরাধ ও অপরাধীর ক্ষেত্রে ‘জিরো টলারেন্স’ নীতি অবলম্বন করেছে ডিবি।\r\nআজ শনিবার (১ মার্চ ২০২৫ খ্রি.) বেলা ১১:৩০ ঘটিকায় ডিএমপি মিডিয়া সেন্টারে পবিত্র মাহে রমজান উপলক্ষে আইনশৃঙ্খলা পরিস্থিতি স্থিতিশীল রাখার উদ্দেশে ডিবি কর্তৃক পরিকল্পিত কার্যক্রম সংক্রান্তে প্রেস ব্রিফিংয়ে তিনি এসব কথা বলেন।\r\nব্রিফিংয়ের শুরুতে অতিরিক্ত পুলিশ কমিশনার (ডিবি) বলেন, অগ্নিঝরা মার্চের প্রথম দিনে আমি গভীর শ্রদ্ধাভরে স্মরণ করছি এদেশের সূর্য সন্তান বীর মুক্তিযোদ্ধাদের, যাদের সীমাহীন ত্যাগ ও দেশপ্রেমের বদৌলতে আমরা পেয়েছি একটি স্বাধীন ও সার্বভৌম মাতৃভূমি। একইসাথে গভীর শ্রদ্ধাভরে স্মরণ করছি জুলাই-আগস্ট ছাত্র-জনতার বিপ্লবের বীর শহিদ ও আহতদের যারা বুকের রক্ত দিয়ে আমাদেরকে একটি সম্ভাবনাময় নতুন বাংলাদেশ গড়ার বীজ বুনে দিয়েছেন। সে লক্ষ্যে তেজোদ্দীপ্ত হয়ে আমরা নতুন বাংলাদেশের স্বপ্ন দেখছি।\r\nতিনি বলেন, সিয়াম সাধনার মাস পবিত্র মাহে রমজান সমাগত। এই পবিত্র মাসে নগরবাসীর নিরাপত্তা বিধানের জন্য ক্লান্তিহীন কাজ করে যাচ্ছে ডিএমপির গোয়েন্দা বিভাগ। ডিবি বর্তমানে আইনশৃঙ্খলা রক্ষায় গুরুত্বপূর্ণ ভূমিকা রাখছে। আজ থেকে আমরা ডিবির চলমান কার্যক্রমের পাশাপাশি রমজানকে সামনে রেখে বিশেষ অভিযান শুরু করতে যাচ্ছি। এটা হচ্ছে এক ধরনের বিশেষ গোয়েন্দা অভিযান। যেটাতে ছদ্মবেশে আমাদের সদস্যরা মানুষের মধ্যে থেকে অপরাধীদের সনাক্ত করবে।\r\nতিনি আরো বলেন, রোজার সময় মানুষের কর্মযজ্ঞ বৃদ্ধি পায়। বিশেষ করে আর্থিক লেনদেন বেশি হয়। শপিংমল, ব্যাংক, বীমাগুলোতে মানুষের ভিড় বাড়ে। রেল স্টেশন, বাস টার্মিনাল ও সদরঘাটসহ অন্যান্য জায়গাতে মানুষের উপস্থিতি বাড়ে। এসব জায়গায় কেউ যাতে নাশকতা করতে না পারে, সেজন্য আমাদের গোয়েন্দা নজরদারি বাড়ানো হচ্ছে। পাশাপাশি দূরের যাত্রা পথ বিশেষ করে বাসে কোন দুর্ঘটনা যাতে না ঘটে, সে লক্ষে গোয়েন্দা তৎপরতার মাধ্যমে আমরা আগে থেকেই ডিবির তথ্যপ্রযুক্তির ব্যবহার বাড়াচ্ছি।\r\nঅতিরিক্ত পুলিশ কমিশনার (ডিবি) বলেন, আমাদের গোয়েন্দা প্রতিবেদন বলছে চুরি ছিনতাই ডাকাতির সাথে যারা যুক্ত হচ্ছে তাদের বেশির ভাগের বয়স ১৫ থেকে ৩০ এর মধ্যে। এদের অনেকেই কিশোর গ্যাং। তারা বিভিন্ন অপরাধে জড়িয়ে পড়ছে। আবার কিছু ফ্যাসিস্ট পতিত রাজনৈতিক শক্তি তাদের ইন্ধন দিয়ে অপরাধ কার্যক্রমে জড়িয়ে দিচ্ছে।\r\nতিনি বলেন, আইনশৃঙ্খলা রক্ষায় যৌথ বাহিনী সারাদেশে তৎপরতা বাড়িয়েছে। অন্যান্য নিরাপত্তা বাহিনীও মাঠে আছে। সেখানে গুরুত্বপূর্ণ ভূমিকা রাখছে বাংলাদেশ সেনাবাহিনী। আমরা বিভিন্ন গোয়েন্দা তথ্য দিয়ে তাদের সহায়তা করছি। যা ভবিষ্যতে আরো বৃদ্ধি পাবে।\r\nতিনি আরো বলেন, মহানগরীতে আইন-শৃঙ্খলা পরিস্থিতির ধীরে ধীরে উন্নতি হচ্ছে। আমাদের কাজ হচ্ছে গোয়েন্দা নজরদারি শক্তিশালী করা। আমরা সে বিষয়টিতে গুরুত্ব দিচ্ছি। আশা করি কিছুদিনের মধ্যে আপনারা আরো ভালো অবস্থা দেখতে পাবেন। জনসাধারণের প্রতি আমাদের আহ্বান এখন ডিবি পরিচয়ে কেউ গোপনে তুলে নেয়া বা সিভিল পোশাকে তল্লাশি এই ধরনের কাজ কেউ করলে আমাদেরকে জানান। পাশাপাশি নাশকতা করতে পারে এমন কোন তথ্য থাকলে ডিবিকে তথ্য দিয়ে সহায়তা করুন। আপনাদের পরিচয় গোপন রেখে প্রয়োজনীয় ব্যবস্থা গ্রহণ করা হবে।\r\nঅতিরিক্ত পুলিশ কমিশনার (ডিবি) বলেন, গুরুত্বপূর্ণ মামলা তদন্ত থেকে আরম্ভ করে চিহ্নিত অপরাধীদের গ্রেফতারপূর্বক আইনের আওতায় নিয়ে আসতে ডিবি বদ্ধপরিকর। তারই অংশ হিসেবে ইতোমধ্যে ডিবি কর্তৃক উল্লেখযোগ্য সংখ্যক ছিনতাইকারী, ডাকাত ও অভ্যাসগত অপরাধীকে আমরা গ্রেফতার করতে সক্ষম হয়েছি। গুণগত মান বজায় রেখে এবং অপরাধের গুরুত্ব বিবেচনায় ডিবি কাজ করে থাকে। আমাদের কাজে যেমন স্বকীয়তা রয়েছে, তেমনি নিশ্চিত করা হয়েছে স্বচ্ছতা ও জবাবদিহিতা। আমরা যেমন সাধারণ মানুষের ভরসার আশ্রয়স্থল হতে চাই, তেমনি অপরাধীদের জন্য হতে চাই আতঙ্ক। সে মূলনীতি নিয়েই আমরা কাজ করে যাচ্ছি।\r\nতিনি বলেন, ছোট অপরাধ বড় অপরাধের জন্ম দেয়। তাই যে কোন অপরাধ ও অপরাধীর ক্ষেত্রে আমরা নিয়েছি জিরো টলারেন্স নীতি। চুরি, ছিনতাই ও ডাকাতি রোধে ডিবির নিয়মিত অভিযান অব্যহত রয়েছে। সমাজকে মাদকের থাবা থেকে রক্ষা করতে প্রতিনিয়ত পরিচালনা করা হচ্ছে মাদক বিরোধী অভিযান। চিহ্নিত সন্ত্রাসী হোক বা যেকোনো অপরাধীই হোক ডিবির জালে তাদের ধরা পরতেই হবে। সমাজে বিশৃঙ্খলা সৃষ্টিকারী সাধারণ মানুষের নিরাপত্তা ঝুঁকি তৈরি করে এদেরকে আমরা বিন্দুমাত্র ছাড় দিবো না।\r\nতিনি আরো বলেন, পবিত্র মাহে রমজানে নগরবাসী যেন নিরাপদে ইবাদত বন্দেগী করতে পারেন সেজন্য ডিবির কার্যক্রম আরো বেগবান করা হয়েছে। আমি আত্মবিশ্বাসের সাথে বলতে পারি নগরবাসী এসময় অধিকতর নিরাপদ ও স্বস্তির পরিবেশে থাকবেন। যেকোনো প্রয়োজনে ডিবি আপনাদের পাশে রয়েছে। বর্তমান অন্তবর্তীকালীন সরকার এবং ঊর্ধ্বতন কর্মকর্তার নির্দেশ মোতাবেক নগরবাসীর শান্তি শৃংখলা রক্ষায় আত্মনিয়োগ করবো। এ দেশ আপনার আমার সকলের। দেশে শান্তি থাকলে শান্তি থাকবে জনমনে। দেশকে নিরাপদ রাখতে আইনশৃঙ্খলা বাহিনীর পাশাপাশি জনসাধারণকেও এগিয়ে আসার আহ্বান জানাচ্ছি।\r\nএ সময় যুগ্ম পুলিশ কমিশনার (এ্যাডমিন অ্যান্ড গোয়েন্দা-দক্ষিণ) মোহাম্মদ নাসিরুল ইসলাম, বিপিএম-সেবা; যুগ্ম পুলিশ কমিশনার (গোয়েন্দা-উত্তর) মোহাম্মদ রবিউল হোসেন ভূঁইয়া; যুগ্ম পুলিশ কমিশনার, (সাইবার সিকিউরিটি অ্যান্ড সাপোর্ট সেন্টার-দক্ষিণ) সৈয়দ হারুন অর রশীদ বিপিএম ও উপ-পুলিশ কমিশনার (মিডিয়া অ্যান্ড পাবলিক রিলেশনস্ বিভাগ) মুহাম্মদ তালেবুর রহমান, পিপিএম-সেবাসহ ইলেকট্রনিক ও প্রিন্ট মিডিয়ার সাংবাদিকবৃন্দ উপস্থিত ছিলেন।', 1, 1, 'articles/JeuQDDNoZeMG2LBxdfRbqwm685lfonIVe1APBFOd.png', NULL, NULL, 0, 'draft', NULL, '2025-03-03 11:22:22', '2025-03-03 11:22:22'),
(12, 'ঢাকা মহানগর এলাকায় জননিরাপত্তা বিধানে পুলিশি কার্যক্রম জোরদার', 'dhaka-mhangr-elakay-jnniraptta-bidhane-pulisi-karzkrm-jordar', 'জননিরাপত্তা বিধান ও আইন-শৃঙ্খলা পরিস্থিতি স্থিতিশীল রাখতে ঢাকা মহানগর এলাকায় পুলিশি কার্যক্রম জোরদার করা হয়েছে। এরই অংশ হিসেবে ডিএমপিসহ অন্যান্য আইন-শৃঙ্খলা বাহিনীর সমন্বয়ে সমন্বিত চেকপোস্ট ও টহল কার্যক্রম বৃদ্ধি করা হয়েছে।\r\nডিএমপির ক্রাইম কমান্ড অ্যান্ড কন্ট্রোল সেন্টার সূত্রে জানা যায়, সোমবার (২৪ ফেব্রুয়ারি ২০২৫ খ্রি.) রাত ১২:০০ ঘটিকা হতে রাত ১১:৫৯ ঘটিকা পর্যন্ত ২৪ ঘন্টায় ঢাকা মেট্রোপলিটন পুলিশের ৫০টি থানা এলাকায় জননিরাপত্তা বিধানে ডিএমপির ৫০০টি টহল টিম দায়িত্ব পালন করে। এছাড়া মহানগর এলাকার নিরাপত্তা বৃদ্ধির লক্ষ্যে বিভিন্ন গুরুত্বপূর্ণ ও কৌশলগত স্থানে ডিএমপি কর্তৃক ৫৪টি পুলিশি চেকপোস্ট পরিচালনা করা হয়। জননিরাপত্তা ও আইন-শৃঙ্খলা রক্ষায় ডিএমপির টহল টিমের পাশাপাশি মহানগরীর বিভিন্ন অপরাধপ্রবণ স্থানে সিটিটিসির সাতটি, অ্যান্টি টেরোরিজম ইউনিট (এটিইউ) এর চারটি এবং র‍্যাবের ১০টি টহল টিম দায়িত্ব পালন করে। এছাড়াও ডিএমপির চেকপোস্টের পাশাপাশি পুলিশের বিশেষায়িত ইউনিট এপিবিএন কর্তৃক ৩১টি চেকপোস্ট পরিচালনা করা হয়।\r\nগত ২৪ ঘন্টায় মহানগরীর বিভিন্ন স্থানে সাঁড়াশি অভিযান পরিচালনা করে বিভিন্ন অপরাধে জড়িত মোট ২৪৮ জনকে গ্রেফতার করা হয়। গ্রেফতারকৃতদের মধ্যে রয়েছে ১৪ জন ডাকাত, ১৬ জন পেশাদার সক্রিয় ছিনতাইকারী, সাতজন চাঁদাবাজ, ১১ জন চোর, ২২ জন চিহ্নিত মাদক কারবারি, ৪৪ জন পরোয়ানাভূক্ত আসামিসহ অন্যান্য অপরাধে জড়িত অপরাধী। অভিযানে গ্রেফতারকৃতদের হেফাজত হতে বিভিন্ন অপরাধে ব্যবহৃত তিনটি ছুরি, চারটি চাকু, একটি প্লায়ার্স, একটি স্ক্রু ড্রাইভার, একটি লোহার শাবল, একটি চাপাতি, একটি দা ও দুটি লোহার রড উদ্ধার করা হয়। এছাড়া অভিযানে উদ্ধারকৃত মাদকের মধ্যে রয়েছে ৪৯ কেজি ৮৭০ গ্রাম গাঁজা ও ৭০৪ পিস ইয়াবা। গত ২৪ ঘন্টায় ডিএমপির বিভিন্ন থানায় ৫৯টি মামলা রুজু করা হয়। গ্রেফতারকৃতদের বিরুদ্ধে যথাযথ আইনানুগ ব্যবস্থা গ্রহণ করা হয়েছে।\r\nঢাকা মহানগরবাসীর সার্বিক নিরাপত্তা ও নির্বিঘ্নে চলাচল নিশ্চিত করতে ঢাকা মেট্রোপলিটন পুলিশ দৃঢ় প্রতিশ্রুতিবদ্ধ।', 1, 1, 'articles/dTsqIdxalJv7OMHevzM8VgsRwfnlAYDUr4J8NRvL.png', NULL, NULL, 0, 'draft', NULL, '2025-03-03 11:32:09', '2025-03-03 11:39:59'),
(19, 'রাঙ্গামাটির সাজেকে স্থানীয়ভাবে শিক্ষার মান উন্নয়ন এবং দুর্গম এলাকার বিভিন্ন উন্নয়ন কাজ পরিদর্শন করেন পার্বত্য উপদেষ্টা', 'rangoamatir-sajeke-sthaneezvabe-sikshar-man-unnzn-ebng-durgm-elakar-bivinn-unnzn-kaj-pridrsn-kren-parwtz-updeshta', 'আলী আহসান রবি।। পার্বত্য চট্টগ্রাম বিষয়ক উপদেষ্টা রাষ্ট্রদূত (অব.) সুপ্রদীপ চাকমা আজ রাঙ্গামাটি জেলার সাজেক দুর্গম এলাকার উন্নয়ন কাজ এবং স্থানীয়ভাবে শিক্ষার মান উন্নয়ন ও প্রসারে করণীয় বিষয়গুলো সরেজমিন নিরীক্ষা করার জন্য সীমান্ত সড়ক সংলগ্ন দুর্গম এলাকা পরিদর্শন করেন। সেখানে সাজেক থানার অন্তর্গত মাচালং উচ্চ বিদ্যালয় পরিদর্শন, সাজেক রুইলুই পাড়ার শিব চতুর্দর্শী ব্রত ও অষ্টপ্রহরব্যাপী মহানামযজ্ঞ মহোৎসব পূজা মন্ডপ পরিদর্শন, বাংলাদেশ-মিজোরাম সীমান্ত সড়ক বর্ডার সংলগ্ন নবনির্মিত সাজেক উদয়পুর বেসরকারি প্রাথমিক বিদ্যালয়, ঢেবাছড়ি বেসরকারি প্রাথমিক বিদ্যালয় ও সাজেক আবাসিক মাধ্যমিক বিদ্যালয় পরিদর্শন করেন।\r\n\r\nউপদেষ্টা সুপ্রদীপ চাকমা দুর্গম এলাকায বিদ্যালয় সংখ্যার অপ্রতুলতা এবং ছাত্র-ছাত্রীদের বিদ্যালয়মুখী করার বিষয়ে সঠিক ও প্রয়োজনীয় দিকনির্দেশনা সংশ্লিষ্টদের প্রদান করেন। উপদেষ্টা সুপ্রদীপ চাকমা এ প্রসঙ্গে আরও বলেন, আমাদের পার্বত্য চট্টগ্রামবাসী সকলের এবারের আন্দোলন হোক কোয়ালিটি এডুকেশন নিশ্চিত করা। শিক্ষার হার বাড়াতে আগে দরকার আমাদের দুর্গম এলাকায় শতভাগ ছেলেমেয়েকে স্কুলে পাঠানো। এজন্য প্রত্যেক পাড়ায় বিদ্যালয় গড়ে তোলা হবে। বিদ্যালয়গুলোতে মিড ডে মিলস্ এর ব্যবস্থা করা হবে। দুর্গম এলাকার পানির সমস্যা নিরসনে ওয়াটার রিজার্ভেশন করে রাখার পরামর্শ দেন উপদেষ্টা।\r\n\r\n\r\nউপদেষ্টা বলেন, আমাদের লাইভলিহুড ডেভেলপমেন্ট করতে হবে। কফি ও কাজু বাদাম চাষ, গবাদি পশু পালন, নারীদের হস্তশিল্প কাজে বেশি বেশি মনোনিবেশ করতে হবে।\r\n\r\n\r\nএসময় অন্যান্যের মধ্যে পার্বত্য চট্টগ্রাম টাস্কফোর্স চেয়ারম্যান (সিনিয়র সচিব পদমর্যাদা) সুদত্ত চাকমা, পার্বত্য জেলা পরিষদের চেয়ারম্যান কৃষিবিদ কাজল তালুকদার, খাগড়াছড়ি পার্বত্য জেলা পরিষদের চেয়ারম্যান জিরুনা ত্রিপুরা, পার্বত্য চট্টগ্রাম বিষয়ক মন্ত্রণালয়ের যুগ্ম সচিব কংকন চাকমা, পার্বত্য চট্টগ্রাম বিষয়ক মন্ত্রণালয়ের উপ সচিব (উপদেষ্টার একান্ত সচিব) খন্দকার মুশফিকুর রহমান, সিনিয়র সহকারী সচিব (উপদেষ্টার সহকারী একান্ত সচিব শুভাশিস চাকমা, রাঙ্গামাটি জেলা পরিষদের সদস্য প্রতুল দেওয়ান ও মাঠ প্রশাসনের অন্যান্য কর্মকর্তারা উপস্থিত ছিলেন।', 1, 1, 'articles/ipZreLKxwdPttVDQRlXCHtn5IOA65BK7Tt2eJnCP.png', NULL, NULL, 0, 'draft', NULL, '2025-03-03 11:42:14', '2025-03-03 11:42:14'),
(20, 'বিশেষ অভিযানে ছিনতাইকারীসহ বিভিন্ন অপরাধে জড়িত ১৯ জনকে গ্রেফতার', 'bisesh-ovizane-chintaikareesh-bivinn-opradhe-jrit-19-jnke-greftar', 'রাজধানীর মোহাম্মদপুর থানাধীন বিভিন্ন এলাকায় বিশেষ অভিযান পরিচালনা করে ছিনতাইকারী, ডাকাত, মাদক ব্যবসায়ী ও চাঁদাবাজসহ বিভিন্ন অপরাধে জড়িত ১৯ জনকে গ্রেফতার করেছে ডিএমপির মোহাম্মদপুর থানা পুলিশ।\r\nগ্রেফতারকৃতরা হলো- ১। সজিব (২৬), ২। আল আমিন (২৪), ৩। সজিব (২৮), ৪। হীরা (১৯), ৫। শান্ত (২২), ৬। রায়হান (২১), ৭। মেহেদী হাসান (২২), ৮। রাসেল (২১), ৯। রানা (২৪), ১০। হোসেন (১৯), ১১। রাব্বি (১৯), ১২। সিয়াম (২০), ১৩। সুজন (২৮,) ১৪। ফারহান (২০), ১৫। ফজলে রাব্বি (২০), ১৬। ইমন (১৯), ১৭। আল আমিন (১৯), ১৮। সাব্বির (১৯) ও ১৯। শাবনুর (২৭)।\r\nমোহাম্মদপুর থানা সূত্রে জানা যায়, রবিবার (০২ মার্চ ২০২৫ খ্রি.) মোহাম্মদপুর থানাধীন বিভিন্ন অপরাধপ্রবণ এলাকায় বিশেষ অভিযান পরিচালনা করে বিভিন্ন অপরাধে জড়িত ১৯ জনকে গ্রেফতার করা হয়। গ্রেফতারকৃতদের মধ্যে রয়েছে চিহ্নিত মাদক কারবারি, সক্রিয় ছিনতাইকারী, ডাকাত, চাঁদাবাজ, পরোয়ানাভুক্ত আসামি ও বিভিন্ন অপরাধে জড়িত অপরাধী। গ্রেফতারকৃতদের হেফাজত থেকে বিভিন্ন দেশীয় অস্ত্র ও মাদকদ্রব্য উদ্ধার করা হয়।\r\nগ্রেফতারকৃতদের বিজ্ঞ আদালতে প্রেরণ করা হয়েছে।', 1, 1, 'articles/06RfovjgFBjOiDb2i6n5gxg1lD87pOGGe2DYXOzt.png', NULL, NULL, 0, 'draft', NULL, '2025-03-03 11:48:36', '2025-03-03 11:48:36');

-- --------------------------------------------------------

--
-- Table structure for table `article_tag`
--

CREATE TABLE `article_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tag_id` bigint(20) UNSIGNED DEFAULT NULL
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

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('fcc1ceab2d6d14d03bc08bbeb0267c85', 'i:1;', 1741021474),
('fcc1ceab2d6d14d03bc08bbeb0267c85:timer', 'i:1741021474;', 1741021474);

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
('3j2C3r7EhelHIBhOQn55XTHH2PlhFmmGYxtdbX6L', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 Edg/133.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ05PZThYb3RWeXE2aDRXMW5aQlBhTWtLeldvM2ltRjJqd1ZRRTRuQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yeS8zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1741021424),
('avcmv11nQQDeHS98vWH7r8OtkLc1Xal7uFRG8rAx', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 Edg/133.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiVk5tbmQ0eng4VzVkbUwxRkdLNGswRHM4NGM5cFlGaFZ2WEhwNEZISCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJHpuMlRJRmxERUtNUlRSeVhsZlNPYS5tNUY4ZGwuTDkxUDV4L3J4UzJjWkF4ek85Ny9kakJPIjt9', 1741026909);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
