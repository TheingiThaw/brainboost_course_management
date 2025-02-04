-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2025 at 09:37 AM
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
-- Database: `brainboost`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `user_id`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 8, 2, '2024-12-23 01:27:57', '2024-12-23 01:27:57'),
(2, 8, 4, '2024-12-23 01:36:31', '2024-12-23 01:36:31'),
(3, 11, 6, '2025-02-04 01:06:35', '2025-02-04 01:06:35');

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
('superadmin@gmail.com|127.0.0.1', 'i:1;', 1738642198),
('superadmin@gmail.com|127.0.0.1:timer', 'i:1738642198;', 1738642198);

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
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `parent_category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `role`, `parent_category_id`, `created_at`, `updated_at`) VALUES
(1, 'Information Technology', 'Information Technology', 'parent', NULL, '2024-12-16 07:16:52', '2024-12-16 07:16:52'),
(2, 'Business', 'Business', 'parent', NULL, '2024-12-16 07:17:05', '2024-12-16 07:17:05'),
(3, 'Creative Arts', 'can include a variety of artistic disciplines, such as music, visual arts, drama, dance, design, and media', 'parent', NULL, '2024-12-16 07:17:36', '2024-12-16 07:17:36'),
(4, 'Language Learning', 'often include information about the course\'s goals, the skills students will develop,', 'parent', NULL, '2024-12-16 07:18:09', '2024-12-16 07:18:09'),
(5, 'Science', 'include activities that illustrate the nature of science and how scientific knowledge evolves, such as laboratory, classroom, and technology activities', 'parent', NULL, '2024-12-16 07:18:38', '2024-12-16 07:18:38'),
(6, 'Web Development', 'teach students how to create and manage websites and web applications', 'sub', 1, '2024-12-16 07:19:11', '2024-12-16 07:19:11'),
(7, 'Programming Languages', 'typically covers the design and implementation of programming languages, including their syntax, semantics, and type systems', 'sub', 1, '2024-12-16 07:19:51', '2024-12-16 07:19:51'),
(8, 'Marketing', 'teach students how to understand consumer needs and communicate how a business can meet those needs', 'sub', 2, '2024-12-16 07:20:36', '2024-12-16 07:20:36'),
(9, 'Test Preparation', 'test preparation', 'parent', NULL, '2024-12-16 07:21:30', '2024-12-16 07:21:30'),
(10, 'IELTS', 'prepares students for the IELTS exam by teaching them English language skills for reading, writing, listening, and speaking', 'sub', 9, '2024-12-16 07:24:08', '2024-12-16 07:24:08'),
(11, 'JLPT Preparation', 'cover a variety of topics to help students prepare for the Japanese-Language Proficiency Test', 'sub', 9, '2024-12-16 07:24:43', '2024-12-16 07:24:43');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `cv_file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `duration` varchar(255) NOT NULL,
  `resource` varchar(255) DEFAULT NULL,
  `prerequisite` varchar(255) DEFAULT NULL,
  `certificate` tinyint(1) NOT NULL DEFAULT 1,
  `image` varchar(255) DEFAULT NULL,
  `FOC` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `title`, `description`, `price`, `level`, `instructor_id`, `category_id`, `sub_category_id`, `duration`, `resource`, `prerequisite`, `certificate`, `image`, `FOC`, `created_at`, `updated_at`) VALUES
(1, 'CS50\'s Introduction to Computer Science', 'CS50\'s Introduction to Computer Science', 'CS50x teaches students how to think algorithmically and solve problems efficiently. Topics include abstraction, algorithms, data structures, encapsulation, resource management, security, software engineering, and web development', '0', 'beginner', 3, 1, 7, '20', 'Harvardx', 'No basic knowledge in computer science', 1, '6760442e49fafHarvard-web-programming-2.jpeg', 0, '2024-12-16 08:45:58', '2024-12-17 01:09:40'),
(2, 'CS50\'s Web Programming with Python and JavaScript', 'CS50\'s Web Programming with Python and JavaScript', 'Topics include database design, scalability, security, and user experience. Through hands-on projects, you\'ll learn to write and use APIs, create interactive UIs, and leverage cloud services like GitHub and Heroku', '1000000', 'beginner', 4, 1, 6, '20', 'Harvardx', 'No basic knowledge', 1, '6760453627a72ib4NNsp2qW4.jpg', 0, '2024-12-16 08:50:22', '2024-12-16 08:50:22'),
(3, 'JLPT Preparation', 'JLPT Preparation', 'You can study vocabulary, grammar, listening, reading comprehension that corresponds to the JLPT level', '500000', 'intermediate', 7, 9, 11, '180', 'JLPT', 'Japanese level N5 or above', 1, '676128036e06eJapaneseJLPT-800-800-p-C-97.png', 0, '2024-12-17 00:58:03', '2024-12-17 00:58:03'),
(4, 'IELTS Preparation', 'IELTS Preparation', 'The exam tests all forms of English. This includes reading, writing, listening and speaking. A high score on the exam is required by most universities, colleges, employers, and immigration authorities', '1000000', 'intermediate', 5, 9, 10, '30', 'IELTS Advantage', 'Intermediate Level (B1 or B2) and above', 0, '67612a945fa80images (2).jpg', 0, '2024-12-17 01:09:00', '2024-12-17 01:09:00'),
(5, 'Learn PHP the Right Way', 'Learn PHP the Right Way', 'Lorem ipsum odor amet, consectetuer adipiscing elit. Facilisi sollicitudin pretium ullamcorper a mi id.', '1000000', 'beginner', 7, 1, 6, '20', 'Youtube', 'Lorem ipsum odor amet, consectetuer adipiscing elit. Facilisi sollicitudin pretium ullamcorper a mi id.', 1, '67a1bfb6d0c9530649.png', 0, '2025-02-04 00:50:22', '2025-02-04 00:50:22'),
(6, 'Graphic Design Course', 'Graphic Design Course', 'Lorem ipsum odor amet, consectetuer adipiscing elit.', '1000000', 'beginner', 4, 1, 6, '34', 'Youtube', 'Lorem ipsum odor amet, consectetuer adipiscing elit.', 0, '67a1c186149daGraphicDesign1.jpg', 0, '2025-02-04 00:58:06', '2025-02-04 00:58:06');

-- --------------------------------------------------------

--
-- Table structure for table `enrolments`
--

CREATE TABLE `enrolments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `enrol_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrolments`
--

INSERT INTO `enrolments` (`id`, `user_id`, `course_id`, `status`, `enrol_code`, `created_at`, `updated_at`) VALUES
(1, 8, 4, '1', 'EC-871019', '2024-12-17 02:33:57', '2024-12-23 01:39:16'),
(2, 8, 3, '1', 'EC-871019', '2024-12-17 02:33:57', '2024-12-23 01:39:16'),
(3, 11, 5, '1', 'EC-796081', '2025-02-04 01:03:22', '2025-02-04 02:04:36'),
(4, 11, 6, '1', 'EC-205280', '2025-02-04 01:07:21', '2025-02-04 02:04:40'),
(5, 11, 1, '1', 'EC-568058', '2025-02-04 02:03:00', '2025-02-04 02:04:47');

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
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `goal` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`id`, `course_id`, `goal`, `created_at`, `updated_at`) VALUES
(4, 2, 'HTML, CSS', NULL, NULL),
(5, 2, 'Python', NULL, NULL),
(6, 2, 'Django', NULL, NULL),
(7, 2, 'Git', NULL, NULL),
(8, 2, 'SQL, Models, and Migrations', NULL, NULL),
(9, 2, 'JavaScript', NULL, NULL),
(10, 2, 'User Interfaces', NULL, NULL),
(11, 2, 'Scalability and Security', NULL, NULL),
(12, 2, 'Testing, CI/CD', NULL, NULL),
(13, 3, 'Master vocabulary, grammar and kanji required for passing the JLPT.', NULL, NULL),
(14, 3, 'Acquire the listening skills necessary to comprehend short conversations.', NULL, NULL),
(15, 3, 'Test-taking strategies and other helpful tips to improve your overall score.', NULL, NULL),
(16, 4, 'Understand the IELTS test format and requirements', NULL, NULL),
(17, 4, 'Develop the essential skills needed to excel in each section', NULL, NULL),
(18, 4, 'Gain the confidence to tackle the test head-on', NULL, NULL),
(19, 4, 'Improve your overall test-taking strategies', NULL, NULL),
(20, 1, 'Familiarity in a number of languages, including C, Python, SQL, and JavaScript plus CSS and HTML', NULL, NULL),
(21, 1, 'Concepts like abstraction, algorithms, data structures, encapsulation, resource management, security, software engineering, and web development', NULL, NULL),
(22, 1, 'A broad and robust understanding of computer science and programming', NULL, NULL),
(23, 5, 'Lorem ipsum odor amet, consectetuer adipiscing elit.', NULL, NULL),
(24, 5, 'Lorem ipsum odor amet, consectetuer adipiscing elit.', NULL, NULL),
(25, 5, 'Lorem ipsum odor amet, consectetuer adipiscing elit.', NULL, NULL),
(26, 6, 'Lorem ipsum odor amet, consectetuer adipiscing elit.', NULL, NULL),
(27, 6, 'Lorem ipsum odor amet, consectetuer adipiscing elit.', NULL, NULL),
(28, 6, 'Lorem ipsum odor amet, consectetuer adipiscing elit.', NULL, NULL);

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
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`id`, `section_id`, `name`, `video`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Loops', 'https://youtu.be/WgX8e_O7eG8?si=jaXfLp_00tSnkDGZ', 'Loops in C', '2024-12-17 01:14:32', '2024-12-17 01:14:32'),
(2, 1, 'Command Line', 'https://youtu.be/BnJ013X02b8?si=7qvmokMdThmAXn0r', 'Command line in linux', '2024-12-17 01:15:03', '2024-12-17 01:15:03'),
(3, 1, 'Functions', 'https://youtu.be/n1glFqt3g38?si=otJeQKz5i3tfZKCR', 'functions in C', '2024-12-17 01:15:28', '2024-12-17 01:15:28'),
(4, 2, 'Linear Search', 'https://youtu.be/TwsgCHYmbbA?si=I-zohZ_4CVf1V4E3', 'Linear Search in C', '2024-12-17 01:15:58', '2024-12-17 01:15:58'),
(5, 2, 'Binary Search', 'https://youtu.be/T98PIp4omUA?si=aRg1jwDZCjolg9wp', 'Binary Search in C', '2024-12-17 01:16:29', '2024-12-17 01:16:29'),
(6, 2, 'Bubble Sort', 'https://youtu.be/RT-hUXUWQ2I?si=ZmwnfSKwqMEnvS-l', 'Bubble sort in C', '2024-12-17 01:16:56', '2024-12-17 01:16:56'),
(7, 2, 'Selection Sort', 'https://youtu.be/3hH8kTHFw2A?si=D4fD_J7PePZw5zIZ', 'selection sort in C', '2024-12-17 01:17:25', '2024-12-17 01:17:25'),
(8, 2, 'Recursion', 'https://youtu.be/mz6tAJMVmfM?si=1xkJFpPa7RZZ9zXu', 'Recursion in C', '2024-12-17 01:17:49', '2024-12-17 01:17:49'),
(9, 2, 'Merge Sort', 'https://youtu.be/Ns7tGNbtvV4?si=TZTpPKISi-7zEiiU', 'Merge sort in C', '2024-12-17 01:18:20', '2024-12-17 01:18:20'),
(10, 3, 'Get Band 9 After Using These Listening Tips', 'https://youtu.be/q7xCHfDRdug?si=nAF4uVFN9Ekx0ZQN', 'Get Band 9 After Using These Listening Tips', '2024-12-17 01:20:20', '2024-12-17 01:20:20'),
(11, 4, '1 Hour Full IELTS Vocabulary Course', 'https://youtu.be/_Bfh5HVh0js?si=6eBeBxD0olGMKzHF', '1 Hour Full IELTS Vocabulary Course', '2024-12-17 01:33:45', '2024-12-17 01:33:45'),
(12, 5, 'Get Band 9 After Using These Reading Tips', 'https://youtu.be/OtmUQwPVLko?si=cd3t-St4o4PyI2-Z', 'Get Band 9 After Using These Reading Tips', '2024-12-17 01:34:40', '2024-12-17 01:34:40'),
(13, 6, 'Ultimate IELTS 3-Hour Speaking Course', 'https://youtu.be/rqmv0LCcPTs?si=Nu5zqGafR12HKcH6', 'Ultimate IELTS 3-Hour Speaking Course', '2024-12-17 01:35:29', '2024-12-17 01:35:29'),
(14, 7, 'IELTS 2025 Complete 11 Hour Course', 'https://youtu.be/xGtKdsVxV8A?si=9AFb4m4vG7ueVqYs', 'IELTS 2025 Complete 11 Hour Course', '2024-12-17 01:36:36', '2024-12-17 01:36:36'),
(15, 8, 'HTML and CSS', 'https://youtu.be/zFZrkCIc2Oc?si=gNMlY0d60K6gOBzz', 'HTML and CSS', '2024-12-17 02:04:22', '2024-12-17 02:04:22'),
(16, 9, 'Git', 'https://youtu.be/NcoBAfJ6l2Q?si=VDTDMRltkkmb0uWP', 'Git', '2024-12-17 02:06:33', '2024-12-17 02:06:33'),
(17, 10, 'Python', 'https://youtu.be/EOLPQdVj5Ac?si=fwBMElK4f8zoW9ON', 'Python', '2024-12-17 02:07:05', '2024-12-17 02:07:05'),
(18, 11, 'PHP Unit', 'https://youtu.be/9-X_b_fxmRM?si=cO3UQbcNcRZEIjXY', 'https://youtu.be/9-X_b_fxmRM?si=cO3UQbcNcRZEIjXY', '2025-02-04 00:51:56', '2025-02-04 00:51:56'),
(19, 11, 'Dependency Injection & DI', 'https://youtu.be/igx3bIl1T_c?si=4IagFnbflnuTNh-e', 'https://youtu.be/igx3bIl1T_c?si=4IagFnbflnuTNh-e', '2025-02-04 00:53:03', '2025-02-04 00:53:03'),
(20, 12, 'PHP Generator', 'https://youtu.be/xH3snMmgDWg?si=IRMseKBOkLtjlRZb', 'Lorem ipsum odor amet, consectetuer adipiscing elit.', '2025-02-04 00:54:06', '2025-02-04 00:54:06'),
(21, 13, 'Covariance & Contravariance in PHP', 'https://youtu.be/AgSrOI7N-fU?si=sh1hkwQNpYmXg4Pr', 'Covariance & Contravariance in PHP', '2025-02-04 00:55:10', '2025-02-04 00:55:10');

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
(4, '2024_12_01_131747_create_categories_table', 1),
(5, '2024_12_01_133231_create_courses_table', 1),
(6, '2024_12_01_143234_create_goals_table', 1),
(7, '2024_12_01_143508_create_reviews_table', 1),
(8, '2024_12_01_143940_create_contacts_table', 1),
(9, '2024_12_01_153713_create_sections_table', 1),
(10, '2024_12_02_013836_create_lectures_table', 1),
(11, '2024_12_02_014218_create_enrolments_table', 1),
(12, '2024_12_02_023003_create_payments_table', 1),
(13, '2024_12_02_023315_create_carts_table', 1),
(14, '2024_12_02_023959_create_questions_table', 1),
(15, '2024_12_02_024722_create_bookmarks_table', 1),
(16, '2024_12_08_142955_create_payment_histories_table', 1);

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `name`, `account_number`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Luna', '09987654321', 'Kpay', '2024-12-16 08:33:35', '2024-12-16 08:33:35'),
(2, 'Ember', '000036452719234', 'CBPay', '2024-12-16 08:34:15', '2024-12-16 08:34:15'),
(3, 'Crystal', '000034567890100', 'KBZPay', '2024-12-16 08:34:43', '2024-12-16 08:34:43'),
(4, 'Jessica', '09123456789', 'AYAPay', '2024-12-16 08:35:06', '2024-12-16 08:35:06'),
(5, 'Free', '0000000', 'Free', '2025-02-04 01:59:44', '2025-02-04 01:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `payment_histories`
--

CREATE TABLE `payment_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `enrol_code` varchar(255) NOT NULL,
  `payslip_image` varchar(255) NOT NULL,
  `total_amt` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_histories`
--

INSERT INTO `payment_histories` (`id`, `user_name`, `phone`, `address`, `payment_method`, `enrol_code`, `payslip_image`, `total_amt`, `created_at`, `updated_at`) VALUES
(1, 'Theingi Thaw', '09123456789', 'New York', '3', 'EC-871019', '67613e7cf3be1images (1).png', '1500000', '2024-12-17 02:33:57', '2024-12-17 02:33:57'),
(2, 'Wonwoo', '09123456789', 'Hendon, London', '2', 'EC-796081', '67a1c2c2394caimages (1).png', '1000000', '2025-02-04 01:03:22', '2025-02-04 01:03:22'),
(3, 'Wonwoo', '09123456789', 'Magway', '2', 'EC-205280', '67a1c3b101f97images (1).png', '1000000', '2025-02-04 01:07:21', '2025-02-04 01:07:21'),
(4, 'Wonwoo', '09123456789', 'Magway', 'free', 'EC-568058', 'freemoney.png', '0', '2025-02-04 02:03:00', '2025-02-04 02:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `question` longtext DEFAULT NULL,
  `answer` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `user_id`, `course_id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 8, 4, 'I love teacher so so much', NULL, '2024-12-17 02:56:48', '2024-12-17 02:56:48'),
(2, 8, 2, 'I don\'t understand about git pull', NULL, '2024-12-23 01:27:08', '2024-12-23 01:27:08');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `commment` longtext DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `course_id`, `user_id`, `commment`, `rating`, `created_at`, `updated_at`) VALUES
(1, 4, 8, 'I like this course', 4, '2024-12-23 01:36:26', '2024-12-23 01:36:26'),
(2, 6, 11, 'Love this course', 4, '2025-02-04 01:06:44', '2025-02-04 01:06:44');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `course_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Functions', 'programming functions in C', '2024-12-17 01:13:32', '2024-12-17 01:13:32'),
(2, 1, 'Algorithms', 'programming algorithms in C', '2024-12-17 01:13:59', '2024-12-17 01:13:59'),
(3, 4, 'Listening', 'IELTS listening', '2024-12-17 01:20:01', '2024-12-17 01:20:01'),
(4, 4, 'Vocabulary', 'IELTS vocabulary', '2024-12-17 01:33:22', '2024-12-17 01:33:22'),
(5, 4, 'Reading', 'IELTS Reading', '2024-12-17 01:34:20', '2024-12-17 01:34:20'),
(6, 4, 'Speaking', 'IELTS speaking', '2024-12-17 01:35:06', '2024-12-17 01:35:06'),
(7, 4, 'IELTS complete course', 'IELTS complete course', '2024-12-17 01:36:11', '2024-12-17 01:36:11'),
(8, 2, 'week 0', 'week 0 in CS50 web', '2024-12-17 02:04:03', '2024-12-17 02:04:03'),
(9, 2, 'week 1', 'week 1 in CS50 web', '2024-12-17 02:06:15', '2024-12-17 02:06:15'),
(10, 2, 'week 2', 'week 2 in CS50 web', '2024-12-17 02:06:46', '2024-12-17 02:06:46'),
(11, 5, 'PHP testing', 'Lorem ipsum odor amet, consectetuer adipiscing elit.', '2025-02-04 00:51:19', '2025-02-04 00:51:19'),
(12, 5, 'PHP Generator', 'Lorem ipsum odor amet, consectetuer adipiscing elit.', '2025-02-04 00:53:41', '2025-02-04 00:53:41'),
(13, 5, 'Covariance & Contravariance in PHP', 'Covariance & Contravariance in PHP', '2025-02-04 00:54:55', '2025-02-04 00:54:55');

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
('ipUsPoHib2cIofB8qbuF9ycFtTqmWUrKWP03KTNz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoienZMT2tuVlp5U2tsNFRrREJCMzk0WGtJM3dybzZ2VjZwUEFTMFJreSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1738658222);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `provider` varchar(255) NOT NULL DEFAULT 'simple',
  `provider_id` varchar(255) DEFAULT NULL,
  `provider_token` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nickname`, `email`, `email_verified_at`, `password`, `profile`, `phone`, `address`, `role`, `provider`, `provider_id`, `provider_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'gi genevieve', NULL, 'gignvv@gmail.com', NULL, '$2y$12$6Xw7qMrKMFb0LMG7viA/H.ioJInjfHYsL551cDazT3KgAHJPCx.o2', NULL, NULL, NULL, 'user', 'google', '110030719820820425385', 'ya29.a0AXeO80SmrYvRJ3EMGPVZdD6nNJMpnqtxkNd5gnr7Au-sbHOZLGRIG53enRc6KdVME-Eeu1zQLdNamDqWC-2YHQYfizIAxotfbNc1Yf0jPwRXUPoBk-E7u4taUFyt8V72qvDZD5tpMx5ZRDPLgV4cnp6cdmLBkip7MaNYHAeKNuYaCgYKATASARASFQHGX2Miv4pK_OxdCXQokF3N2RyPiA0178', NULL, '2024-12-16 06:32:59', '2025-02-03 09:53:23'),
(2, 'superadmin1', 'superadmin1', 'superadmin1@gmail.com', NULL, '$2y$12$.9diBg8m3QqM4TdEMxQxFuax9zCgaBJtGW6I3EFkApBe5gefQwuT6', NULL, '09987654321', 'New York', 'superadmin', 'simple', NULL, NULL, NULL, NULL, '2024-12-16 06:45:22'),
(3, 'Vernon', NULL, 'sirvernon@brainboost.com', NULL, '$2y$12$wYBDwO2px.btEY.nnpYIhO6usEk990ta37FzJqwSQBoC768Om1nnS', '676138a253914team-1.jpg', NULL, NULL, 'instructor', 'simple', NULL, NULL, NULL, '2024-12-16 07:26:07', '2024-12-17 02:08:58'),
(4, 'Joshua', NULL, 'sirjoshua@brainboost.com', NULL, '$2y$12$HEbIGtRn7xhQJpfI3F2.YOsnBhwTdPXeRgw1EujR9LoS8e2DU84Pe', '676138c8d9a04team-3.jpg', NULL, NULL, 'instructor', 'simple', NULL, NULL, NULL, '2024-12-16 07:39:58', '2024-12-17 02:09:36'),
(5, 'Wendy', NULL, 'wendy@brainboost.com', NULL, '$2y$12$QgF9cHsStyGqKfewyXp/a.Od.MTTysI/oBAcFyD9Wh/FNe4JmIf/m', '67613a74a2d71team-2.jpg', NULL, NULL, 'instructor', 'simple', NULL, NULL, NULL, '2024-12-16 07:46:15', '2024-12-17 02:16:44'),
(6, 'Wen Jun Hui', NULL, 'sirwenjunhui@brainboost.com', NULL, '$2y$12$hrPLvs72yYTAOwqGyVB4b.CDmOL1vR4Cs0a4G53Rrpuc9nKTmu/Vm', '676138ee41167testimonial-3.jpg', NULL, NULL, 'instructor', 'simple', NULL, NULL, NULL, '2024-12-16 07:48:04', '2024-12-17 02:10:14'),
(7, 'Xu Ming Hao', NULL, 'sirxuminghao@brainboost.com', NULL, '$2y$12$sd0LaKXILvobg028Ta0Sk.J3GC5lU.InnUDOEw/IpC3NTPAze3ObW', '67613a263a380testimonial-2.jpg', NULL, NULL, 'instructor', 'simple', NULL, NULL, NULL, '2024-12-16 07:51:33', '2024-12-17 02:15:26'),
(8, 'Theingi Thaw', NULL, 'theingithaw03@gmail.com', NULL, '$2y$12$Eb/AYnq1bf5KOITdk8TU4.cfMoW6j/ZtnAMWIQelgWtFHduoD9mf.', NULL, NULL, NULL, 'user', 'google', '114829742826554358176', 'ya29.a0AXeO80RCvsGArJpvrfRq12QudpLviHbn_a_ErkLlbSfSvRsgVLChC8iZi6hGA4COZ2t80SZkhuAVwcbJoV18ckmoRjJH-_17c_sXe9ZqvraLJGyoWYL8AWSIV3fNoIx5wx3myIWCyL2_PZe1W0lnd_JjbTJDDVFwIRM_N9hj04kaCgYKAQMSARESFQHGX2MiffLnE1uyu0J1DOLCAcJQvQ0178', NULL, '2024-12-17 02:20:03', '2025-02-03 22:30:04'),
(9, 'giselle', NULL, 'giselle@gmail.com', NULL, '$2y$12$HiG9wpToInhsPLgF7jRZP.nKt51duyE6VaCjW33yJm189s.0Yzpla', NULL, '09987654321', NULL, 'user', 'simple', NULL, NULL, NULL, '2024-12-17 02:48:06', '2024-12-17 02:48:06'),
(10, 'admin1', NULL, 'admin1@brainboost.com', NULL, '$2y$12$/D4VeUous3OzmglH78O5.OcCXYr3rgjcHRnrJOoFM7E45h4EGjLcG', NULL, NULL, NULL, 'admin', 'simple', NULL, NULL, NULL, '2024-12-22 01:12:22', '2024-12-22 01:12:22'),
(11, 'Wonwoo', NULL, 'wonwoo@gmail.com', NULL, '$2y$12$DfDAVkGe470GzDz/PAQEg.Hg6uZpQEYMk2TM609fITcyx.4Dqidlm', NULL, '09123456789', NULL, 'user', 'simple', NULL, NULL, NULL, '2025-02-04 00:58:47', '2025-02-04 00:58:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrolments`
--
ALTER TABLE `enrolments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_histories`
--
ALTER TABLE `payment_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `enrolments`
--
ALTER TABLE `enrolments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_histories`
--
ALTER TABLE `payment_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
