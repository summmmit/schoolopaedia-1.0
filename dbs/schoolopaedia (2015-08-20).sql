-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2015 at 09:31 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `schoolopaedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(11) NOT NULL,
  `class` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `streams_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `deleted_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class`, `streams_id`, `school_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Class - 1', 3, 3, '0000-00-00 00:00:00', '2015-04-29 15:00:00', '2015-05-09 20:19:36'),
(2, 'Class - 2', 3, 3, '0000-00-00 00:00:00', '2015-04-29 15:00:00', '2015-05-12 21:35:09'),
(3, 'Class - 3', 1, 3, '0000-00-00 00:00:00', '2015-05-09 06:16:32', '2015-05-09 06:16:32'),
(4, 'Class - 4', 2, 3, '0000-00-00 00:00:00', '2015-05-09 20:19:18', '2015-05-09 20:19:18'),
(5, 'Class - 5', 5, 3, '2015-05-10 05:20:01', '2015-05-09 20:19:56', '2015-05-09 20:20:01'),
(6, 'Class - 5', 1, 3, '0000-00-00 00:00:00', '2015-05-12 18:02:47', '2015-05-12 18:02:47'),
(7, 'Class - 6', 1, 3, '0000-00-00 00:00:00', '2015-05-12 21:19:08', '2015-05-12 21:19:08');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `category` int(11) NOT NULL,
  `allday` tinyint(1) NOT NULL,
  `content` text NOT NULL,
  `event_details` text,
  `cover_pic` varchar(100) DEFAULT NULL,
  `school_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf16;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `start`, `end`, `category`, `allday`, `content`, `event_details`, `cover_pic`, `school_id`, `created_at`, `updated_at`) VALUES
(7, 'asgdasdg', '2015-05-06 05:27:00', '2015-05-07 05:27:00', 1, 0, 'asgasg', NULL, NULL, 3, '2015-05-06 08:27:35', '2015-05-06 08:27:35'),
(11, 'Republic Day', '2015-05-08 18:05:00', '2015-05-09 18:05:00', 1, 0, 'Republic Day', NULL, NULL, 3, '2015-05-06 09:01:55', '2015-05-06 09:01:55'),
(12, 'Ghandhi Jayanti', '2015-05-09 00:05:00', '2015-05-09 23:05:00', 1, 0, 'Ghandhi Jayanti', NULL, NULL, 3, '2015-05-06 09:03:07', '2015-05-06 09:03:07'),
(14, 'sdfgsd', '2015-05-06 18:05:00', '2015-05-07 18:05:00', 1, 0, 'sdfsdhf', NULL, NULL, 3, '2015-05-06 09:05:28', '2015-05-06 09:05:28'),
(15, 'asdgasasdgasdg', '2015-05-06 18:05:00', '2015-05-07 18:05:00', 1, 1, 'asdgasdgasdgasdgasdg', NULL, NULL, 3, '2015-05-06 09:07:28', '2015-05-06 09:07:28'),
(16, 'Hello Sumit ', '2015-04-27 09:04:00', '2015-04-27 10:04:00', 1, 1, 'Hello Sumit&nbsp;', NULL, NULL, 3, '2015-05-06 09:20:11', '2015-05-06 09:20:11'),
(19, 'new one', '2015-05-11 09:05:00', '2015-05-11 10:05:00', 1, 1, 'new one', NULL, NULL, 3, '2015-05-06 10:04:33', '2015-05-06 10:04:33'),
(20, 'djdfj', '2015-06-25 12:06:00', '2015-06-26 12:06:00', 1, 0, 'fghkfgkhfgkh', NULL, NULL, 3, '2015-06-25 03:44:39', '2015-06-25 03:44:39'),
(22, 'ggg', '2015-06-26 11:06:00', '2015-06-27 11:06:00', 1, 0, 'asdgasdg', NULL, NULL, 3, '2015-06-26 02:33:42', '2015-06-26 02:33:42'),
(23, 'Hello', '2015-07-06 12:07:00', '2015-07-07 12:07:00', 11, 0, 'asdgasdgasdgasg', NULL, NULL, 3, '2015-07-06 03:45:19', '2015-07-06 03:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `event_types`
--

CREATE TABLE IF NOT EXISTS `event_types` (
  `id` int(11) NOT NULL,
  `event_type_name` varchar(50) NOT NULL,
  `school_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf16;

--
-- Dumping data for table `event_types`
--

INSERT INTO `event_types` (`id`, `event_type_name`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 'Holiday', 3, '2015-05-06 00:00:00', '2015-05-06 00:00:00'),
(8, 'Clears', 3, '2015-06-26 10:26:03', '2015-06-26 01:26:03'),
(11, 'hello sir', 3, '2015-07-06 11:00:32', '2015-07-06 02:00:32');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'administrator', NULL, '2015-04-25 15:00:00', '2015-04-25 15:00:00'),
(2, 'students', NULL, '2015-04-25 15:00:00', '2015-04-25 15:00:00'),
(3, 'teacher', 'NULL', '2015-05-11 06:08:46', '2015-05-11 06:08:46');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2012_12_06_225921_migration_cartalyst_sentry_install_users', 1),
('2012_12_06_225929_migration_cartalyst_sentry_install_groups', 1),
('2012_12_06_225945_migration_cartalyst_sentry_install_users_groups_pivot', 1),
('2012_12_06_225988_migration_cartalyst_sentry_install_throttle', 1);

-- --------------------------------------------------------

--
-- Table structure for table `periods`
--

CREATE TABLE IF NOT EXISTS `periods` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `period_name` varchar(20) NOT NULL,
  `start_time` time NOT NULL COMMENT 'Start Time for the period',
  `end_time` time NOT NULL COMMENT 'End Time for the period',
  `created_at` datetime NOT NULL COMMENT 'timestamp',
  `updated_at` datetime NOT NULL COMMENT 'timestamp'
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `periods`
--

INSERT INTO `periods` (`id`, `period_name`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(46, 'Period - 1', '10:00:00', '11:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'Period - 2', '11:00:00', '12:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Period - 3', '12:00:00', '13:00:00', '2015-05-18 06:23:47', '2015-05-18 06:23:47'),
(49, 'Period - 3', '12:00:00', '13:00:00', '2015-05-18 06:31:05', '2015-05-18 06:31:05'),
(50, 'Period - 3', '12:00:00', '13:00:00', '2015-05-18 06:41:48', '2015-05-18 06:41:48'),
(51, 'asdgasg', '01:00:00', '02:00:00', '2015-05-18 06:46:32', '2015-05-18 06:46:32'),
(52, 'awetat', '02:00:00', '02:00:00', '2015-05-18 08:01:04', '2015-05-18 08:01:04'),
(53, 'Period - 1', '07:00:00', '08:00:00', '2015-05-25 06:59:28', '2015-05-25 06:59:28'),
(54, 'Period - 2', '08:00:00', '09:00:00', '2015-05-25 06:59:43', '2015-05-25 06:59:43'),
(55, 'Period - 3', '09:00:00', '10:00:00', '2015-05-25 07:00:02', '2015-05-25 07:00:02'),
(56, 'Period - 4', '10:00:00', '11:00:00', '2015-05-25 07:00:12', '2015-05-25 07:00:12'),
(57, 'Period - 5', '12:00:00', '13:00:00', '2015-05-25 07:00:28', '2015-05-25 07:00:28'),
(58, 'Period - 6', '13:00:00', '14:00:00', '2015-05-25 07:00:41', '2015-05-25 07:00:41'),
(59, 'Period - 7', '14:00:00', '15:00:00', '2015-05-25 07:00:57', '2015-05-25 07:00:57');

-- --------------------------------------------------------

--
-- Table structure for table `period_profile`
--

CREATE TABLE IF NOT EXISTS `period_profile` (
  `id` int(11) NOT NULL COMMENT 'primary key',
  `profile_name` varchar(50) NOT NULL COMMENT 'name of the set of periods ',
  `school_id` int(11) NOT NULL,
  `current_profile` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `period_profile`
--

INSERT INTO `period_profile` (`id`, `profile_name`, `school_id`, `current_profile`, `created_at`, `updated_at`) VALUES
(9, 'Profile - 1', 3, 0, '2015-05-18 03:35:28', '2015-05-25 06:59:01'),
(10, 'Profile - 2', 3, 1, '2015-05-18 03:36:56', '2015-05-25 06:59:01'),
(11, 'Profile - 3', 3, 0, '2015-05-18 03:51:33', '2015-05-18 03:51:33');

-- --------------------------------------------------------

--
-- Table structure for table `period_to_period_profile`
--

CREATE TABLE IF NOT EXISTS `period_to_period_profile` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `profile_id` int(11) NOT NULL COMMENT 'Period Profile Id',
  `period_id` int(11) NOT NULL COMMENT 'Period id',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `period_to_period_profile`
--

INSERT INTO `period_to_period_profile` (`id`, `profile_id`, `period_id`, `created_at`, `updated_at`) VALUES
(1, 9, 46, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 9, 47, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 9, 51, '2015-05-18 06:46:32', '2015-05-18 06:46:32'),
(4, 10, 53, '2015-05-25 06:59:28', '2015-05-25 06:59:28'),
(5, 10, 54, '2015-05-25 06:59:43', '2015-05-25 06:59:43'),
(6, 10, 55, '2015-05-25 07:00:02', '2015-05-25 07:00:02'),
(7, 10, 56, '2015-05-25 07:00:12', '2015-05-25 07:00:12'),
(8, 10, 57, '2015-05-25 07:00:28', '2015-05-25 07:00:28'),
(9, 10, 58, '2015-05-25 07:00:41', '2015-05-25 07:00:41'),
(10, 10, 59, '2015-05-25 07:00:57', '2015-05-25 07:00:57');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE IF NOT EXISTS `schools` (
  `id` int(11) NOT NULL,
  `school_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `manager_full_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `add_1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `add_2` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pin_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `time_zone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `registration_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code_for_admin` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code_for_moderators` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code_for_teachers` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code_for_parents` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code_for_students` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `registration_date` datetime NOT NULL,
  `logo` text COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `deleted_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `school_name`, `manager_full_name`, `phone_number`, `email`, `add_1`, `add_2`, `city`, `state`, `country`, `pin_code`, `time_zone`, `registration_code`, `code_for_admin`, `code_for_moderators`, `code_for_teachers`, `code_for_parents`, `code_for_students`, `registration_date`, `logo`, `active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'DPS Public School', 'Sumit Singh', '', 'summmmit44@gmail.com', '259/68', 'New Defence Colony, Muradnagar', 'Ghaziabad', 'UP', 'India', '', '', '2rZe0GHdTY2vmkbVRzZfnUSPkSBzMmsqofBfGgr9EVhmHAg6HG', 'SJANo0hxRce5HlBbhwienb2gjixsKjM7BxCz3Quc90JdNTccrhmPPvlz84pUZPcYnrCspVBGQJxTjeAL', 'SJANo0hxRce5HlBbhwienb2gjixsKjM7BxCz3Quc90JdNTccrhmPPvlz84pUZPcYnrCspVBGQJxTjeAL', 'Sx0z0xUhjKrrtye4s4HHGRwLkD2PFbKhiTHrPTqkn8khNNaOJUgW1yiSpSxS', 'SJANo0hxRce5HlBbhwienb2gjixsKjM7BxCz3Quc90JdNTccrhmPPvlz84pUZPcYnrCspVBGQJxTjeAL', 'h7RuEFNE7IAYJwScImSSNeO5n4ALXAMGlfBlHOM9stviHsD3tQDe2sBeMPxDxlR1R6kgkW', '2015-03-06 00:00:00', '', 1, '0000-00-00 00:00:00', '2015-03-04 21:00:00', '2015-03-04 21:00:00'),
(2, 'Aum Sun Public School', 'Sumit Singh', '05168222541', 'nitinbarotra@gmail.com', 'beverly homes 3-12-11', 'muradnagar', 'toshima-ku', 'Tokyo', 'Japan', '171-0021', '', '2rZe0GHdTY2vmkbVRzZfnUSPkSBzMmsqofBfGgr9EVhmHAg6HG', 'SJANo0hxRce5HlBbhwienb2gjixsKjM7BxCz3Quc90JdNTccrhmPPvlz84pUZPcYnrCspVBGQJxTjeAL', 'SJANo0hxRce5HlBbhwienb2gjixsKjM7BxCz3Quc90JdNTccrhmPPvlz84pUZPcYnrCspVBGQJxTjeAL', 'Sx0z0xUhjKrrtye4s4HHGRwLkD2PFbKhiTHrPTqkn8khNNaOJUgW1yiSpSxS', 'SJANo0hxRce5HlBbhwienb2gjixsKjM7BxCz3Quc90JdNTccrhmPPvlz84pUZPcYnrCspVBGQJxTjeAL', 'h7RuEFNE7IAYJwScImSSNeO5n4ALXAMGlfBlHOM9stviHsD3tQDe2sBeMPxDxlR1R6kgkW', '2015-04-01 07:16:51', '', 1, '0000-00-00 00:00:00', '2015-03-31 04:16:51', '2015-03-31 04:20:00'),
(3, 'Aum Sun Public School', 'Sumit Singh', '05168222541', 'nitin@gmail.com', 'beverly homes 3-12-11', 'muradnagar', 'toshima-ku', 'Tokyo', 'Japan', '171-0021', '', '12345', '12345', '12345', '12345', '12345', '12345', '2015-04-01 07:31:27', '', 1, '0000-00-00 00:00:00', '2015-03-31 04:31:27', '2015-03-31 04:31:27'),
(6, 'Kanya Inter College', 'Sumit Singh', '05168222541', 'summieesngh@gmail.com', 'New Defence Colony', 'Muradnagar', 'Toshima-ku Nishi Ikebukuro', 'Tokyo', 'Japan', '201206', '', 'ZxfwJT4jCVNAN50XE26u0DgSLaonNTCyU4bVYjXyuDOX3jEW9f', 'NazOnxm1WHVPEpkFtxQTmyoYofH6otCmL7RaJeuOn8hR5Duib2KtUlPQ9L8dYlsJy1P2989zDBs5Zx9K', 'OFT3t0HXw6ReKJMZ8wDrOFp7yXRRjWUjdvdsSeyAKRbb4XVvbqHgjPibJTxNB4rU8hI7jmHJUkEH3iAnT2IEUkBZL1', '7v2M90HajMDGTaYWR1AuhYZOkrAjrV9nb7VaRmARjQn5xl6gHcI0gkbs94Oy', 'cyj49SNNUITXicTfKiJVuVAcbNytrawFEYPyckDRV1IA0lbFtB7jMLqObolWiY4ySJyWGpNvbgj3zyKWhD4br28kINSJW2F', 'SoQttpTHMoKrcBQumlYsrxJXMF20VqXkss2LjJb3qbbdirXrrutxDBmcN2bcejGwcKw6gD', '2015-04-01 07:40:21', '', 1, '0000-00-00 00:00:00', '2015-03-31 04:40:21', '2015-03-31 04:40:21'),
(7, 'Delhi Public School', 'Sumit Singh', '05168222541', 'shiivisingh475@gmail.com', 'Beverly Homes 3-12-11', '301', 'Toshima-ku Nishi Ikebukuro', 'Tokyo', 'Japan', '171-0021', '', 'R6MRTu30hFbqo6lHQx13NJpxlvoxxANCEQoCzKfjRt3IpZ3kC7', 'jUOplIQh7h0TN0viFxR0mpcuwmentmiZjbxwHlbl7ZhAqZGEuVcwe4UKpsdNivTi8pwzJw2oLBiMf92k', 'N4B60UM0U3mo9tLgaYYXyWbl3YcYizOlUM2BP3RISiab3QTWvZj5aI6Y09R0kI9LqoalRQEYyWuNgipfnSfSfIi7ES', 'nqFj4H29EavMyo22gEPeJw5522huifjkaFRt1AXGIDdm6PSA3Dohvjvk5P9S', 'jAxmpxPwrLNdAfZqnzgfCjobhAGCzVbUy5BzWQNHXCo0nyviaCcO6b39ZXGOQC4QlIqzNPDZ93UvFDTthK0LRhX2l0dc1J8', 'aCXWCiIW3cO29aE38Mh0ta3n8FQ5RdYsvf4K400AAlTBp0migiux51awdR96KP73rrDtCH', '2015-04-14 01:55:15', '', 1, '0000-00-00 00:00:00', '2015-04-12 22:55:15', '2015-04-12 22:58:29');

-- --------------------------------------------------------

--
-- Table structure for table `school_schedule`
--

CREATE TABLE IF NOT EXISTS `school_schedule` (
  `id` int(11) NOT NULL,
  `start_from` date NOT NULL,
  `close_untill` date NOT NULL,
  `opening_time` time NOT NULL,
  `lunch_time` time NOT NULL,
  `closing_time` time NOT NULL,
  `school_id` int(11) NOT NULL,
  `school_session_id` int(11) NOT NULL,
  `current_schedule` tinyint(1) NOT NULL,
  `deleted_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `school_schedule`
--

INSERT INTO `school_schedule` (`id`, `start_from`, `close_untill`, `opening_time`, `lunch_time`, `closing_time`, `school_id`, `school_session_id`, `current_schedule`, `deleted_at`, `created_at`, `updated_at`) VALUES
(24, '2015-05-02', '2016-05-05', '03:00:00', '03:00:00', '03:00:00', 3, 3, 1, '0000-00-00 00:00:00', '2015-05-01 18:04:08', '2015-05-01 18:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `school_session`
--

CREATE TABLE IF NOT EXISTS `school_session` (
  `id` int(11) NOT NULL,
  `session_start` date NOT NULL,
  `session_end` date NOT NULL,
  `school_id` int(11) NOT NULL,
  `current_session` tinyint(1) NOT NULL COMMENT 'This is the current session of the school',
  `deleted_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `school_session`
--

INSERT INTO `school_session` (`id`, `session_start`, `session_end`, `school_id`, `current_session`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, '2015-04-28', '2016-04-28', 3, 1, '0000-00-00 00:00:00', '2015-04-27 15:00:00', '2015-04-27 15:00:00'),
(15, '2015-05-02', '2016-05-02', 3, 0, '0000-00-00 00:00:00', '2015-05-01 07:31:10', '2015-05-01 07:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(11) NOT NULL,
  `section_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  `deleted_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section_name`, `class_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Section - A', 1, '0000-00-00 00:00:00', '2015-04-29 15:00:00', '2015-04-29 15:00:00'),
(2, 'Section - B', 1, '0000-00-00 00:00:00', '2015-05-09 20:28:35', '2015-05-09 20:28:35'),
(3, 'Section - A', 2, '0000-00-00 00:00:00', '2015-05-09 20:28:49', '2015-05-09 20:28:49'),
(4, 'Section - A', 3, '0000-00-00 00:00:00', '2015-05-09 20:29:10', '2015-05-09 20:29:10'),
(5, 'Section - A', 4, '0000-00-00 00:00:00', '2015-05-09 20:29:20', '2015-05-09 20:29:41'),
(6, 'Section - C', 1, '0000-00-00 00:00:00', '2015-05-12 21:20:51', '2015-05-12 21:20:51'),
(7, 'Section - B', 2, '0000-00-00 00:00:00', '2015-05-12 21:25:00', '2015-05-12 21:25:00'),
(8, 'Section - B', 3, '0000-00-00 00:00:00', '2015-05-12 21:25:20', '2015-05-12 21:26:15'),
(9, 'Section - C', 3, '0000-00-00 00:00:00', '2015-05-12 21:26:07', '2015-05-12 21:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `streams`
--

CREATE TABLE IF NOT EXISTS `streams` (
  `id` int(11) NOT NULL,
  `stream_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `school_id` int(11) NOT NULL,
  `deleted_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `streams`
--

INSERT INTO `streams` (`id`, `stream_name`, `school_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Science', 3, '0000-00-00 00:00:00', '2015-04-28 15:00:00', '2015-04-28 15:00:00'),
(2, 'Arts', 3, '0000-00-00 00:00:00', '2015-04-28 15:00:00', '2015-04-28 15:00:00'),
(3, 'None', 3, '0000-00-00 00:00:00', '2015-04-28 15:00:00', '2015-04-28 15:00:00'),
(4, 'Information Technology', 3, '2015-05-09 15:09:57', '2015-05-09 05:59:30', '2015-05-09 06:09:57'),
(5, 'Informatics', 3, '0000-00-00 00:00:00', '2015-05-09 19:27:33', '2015-05-09 19:27:33'),
(6, 'Computer Science', 3, '0000-00-00 00:00:00', '2015-05-12 00:30:31', '2015-05-12 17:59:27');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `subject_code` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `deleted_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `subject_code`, `class_id`, `section_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(11, 'Hindi', 'CS010A01', 1, 1, '0000-00-00 00:00:00', '2015-05-09 20:34:01', '2015-05-09 20:34:01'),
(12, 'English', 'CS010A02', 1, 1, '0000-00-00 00:00:00', '2015-05-09 20:34:20', '2015-05-09 20:34:20'),
(13, 'Hindi', 'CS01020A01', 2, 3, '0000-00-00 00:00:00', '2015-05-09 20:39:37', '2015-05-12 21:36:37'),
(14, 'Mathematics', 'CS010A03', 1, 1, '0000-00-00 00:00:00', '2015-05-12 21:26:52', '2015-05-12 21:26:52'),
(15, 'Social Science', 'CS010A04', 1, 1, '2015-05-13 06:31:06', '2015-05-12 21:27:10', '2015-05-12 21:31:06'),
(16, 'Science', 'CS010A05', 1, 1, '2015-05-13 06:31:10', '2015-05-12 21:27:28', '2015-05-12 21:31:10'),
(17, 'Sports', 'CS010A06', 1, 1, '0000-00-00 00:00:00', '2015-05-12 21:27:41', '2015-05-12 21:27:41'),
(18, 'Hindi', 'CS01010B01', 1, 2, '0000-00-00 00:00:00', '2015-05-12 21:31:58', '2015-05-12 21:31:58'),
(19, 'English', 'CS01010B02', 1, 2, '0000-00-00 00:00:00', '2015-05-12 21:32:10', '2015-05-12 21:32:10'),
(20, 'Mathematics', 'CS01010B03', 1, 2, '0000-00-00 00:00:00', '2015-05-12 21:32:19', '2015-05-12 21:32:19'),
(21, 'Sports', 'CS01010B04', 1, 2, '0000-00-00 00:00:00', '2015-05-12 21:32:29', '2015-05-12 21:32:29'),
(22, 'Hindi', 'CS01010C01', 1, 6, '0000-00-00 00:00:00', '2015-05-12 21:33:29', '2015-05-12 21:33:29'),
(23, 'English', 'CS01010C02', 1, 6, '0000-00-00 00:00:00', '2015-05-12 21:33:45', '2015-05-12 21:33:45'),
(24, 'Mathematics', 'CS01010C03', 1, 6, '0000-00-00 00:00:00', '2015-05-12 21:33:56', '2015-05-12 21:33:56'),
(25, 'Sports', 'CS01010C04', 1, 6, '0000-00-00 00:00:00', '2015-05-12 21:34:36', '2015-05-12 21:34:36'),
(26, 'English', 'CS01020A02', 2, 3, '0000-00-00 00:00:00', '2015-05-12 21:36:46', '2015-05-12 21:36:55'),
(27, 'Mathematics', 'CS01020A03', 2, 3, '0000-00-00 00:00:00', '2015-05-12 21:37:07', '2015-05-12 21:37:07'),
(28, 'Sports', 'CS01020A04', 2, 3, '0000-00-00 00:00:00', '2015-05-12 21:37:16', '2015-05-12 21:37:16'),
(29, 'Hindi', 'CS01020B01', 2, 7, '0000-00-00 00:00:00', '2015-05-12 21:38:20', '2015-05-12 21:38:20'),
(30, 'English', 'CS01020B02', 2, 7, '0000-00-00 00:00:00', '2015-05-12 21:38:32', '2015-05-12 21:38:32'),
(31, 'Mathematics', 'CS01020B03', 2, 7, '0000-00-00 00:00:00', '2015-05-12 21:38:42', '2015-05-12 21:38:42'),
(32, 'Sports', 'CS01020B04', 2, 7, '0000-00-00 00:00:00', '2015-05-12 21:38:51', '2015-05-12 21:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `throttle`
--

CREATE TABLE IF NOT EXISTS `throttle` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`) VALUES
(2, 38, NULL, 0, 0, 0, NULL, NULL, NULL),
(3, 39, NULL, 0, 0, 0, '2015-06-23 17:50:20', NULL, NULL),
(4, 40, NULL, 0, 0, 0, NULL, NULL, NULL),
(5, 41, NULL, 0, 0, 0, NULL, NULL, NULL),
(6, 44, NULL, 0, 0, 0, NULL, NULL, NULL),
(7, 45, NULL, 1, 0, 0, '2015-08-02 21:03:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE IF NOT EXISTS `timetable` (
  `id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `day_id` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `period_id`, `class_id`, `subject_id`, `section_id`, `users_id`, `day_id`, `created_at`, `updated_at`) VALUES
(4, 53, 1, 17, 1, 14, 1, '2015-05-24 23:02:23', '2015-05-24 23:06:17'),
(5, 54, 1, 12, 1, 14, 1, '2015-05-24 23:02:35', '2015-05-24 23:02:35'),
(6, 55, 1, 14, 1, 14, 1, '2015-05-24 23:02:45', '2015-05-24 23:02:45'),
(7, 53, 1, 11, 1, 14, 2, '2015-05-24 23:10:26', '2015-05-24 23:10:26'),
(8, 54, 1, 12, 1, 14, 2, '2015-05-24 23:10:34', '2015-05-24 23:10:34'),
(9, 55, 1, 14, 1, 14, 2, '2015-05-24 23:10:44', '2015-05-24 23:10:44'),
(10, 56, 1, 17, 1, 14, 2, '2015-05-24 23:10:52', '2015-05-24 23:10:52'),
(11, 57, 1, 11, 1, 14, 2, '2015-05-24 23:11:01', '2015-05-24 23:11:01'),
(12, 58, 1, 12, 1, 14, 2, '2015-05-24 23:11:12', '2015-05-24 23:11:12'),
(13, 59, 1, 17, 1, 14, 2, '2015-05-24 23:11:21', '2015-05-24 23:11:21'),
(14, 56, 1, 14, 1, 14, 1, '2015-06-04 22:06:26', '2015-06-04 22:06:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_updated_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_updated_at` timestamp NULL DEFAULT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `email_updated_at`, `password`, `password_updated_at`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `school_id`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(38, 'summmmit44@gmail.com', '2015-04-28 02:28:41', '$2y$10$JTkhrWJwICTsCWdhwBoE/uWN/jrOu7EfucC5rG2Afi0p.gnzQZvHy', '2015-04-28 02:28:41', NULL, 1, NULL, '2015-04-28 02:29:26', '2015-08-05 16:18:06', '$2y$10$S85t5eY7tLTuxiUnyF4jXuJqcnZDIMwO3f1wgXDFBNT9cAs15vlHC', NULL, '3', '0Bss2eydgheCUoae3v8SALWDMdXHyaPYzjazC0yT62d2neBUsIktjGKQLmpI', NULL, '2015-04-28 02:28:41', '2015-08-19 21:26:15'),
(39, 'shiivisingh@gmail.com', '2015-04-30 16:00:07', '$2y$10$f4VJaBjKH5BLykgcGWCS/.N34F5VASNwlFfqOteN04omJIePk629G', '2015-04-30 16:00:07', NULL, 1, NULL, '2015-04-30 16:34:19', '2015-07-12 16:20:47', '$2y$10$8HpnKto.e4Wtl.GjxtHOnudQ.oNUWZYmqb.gbNykK.Dxw3VFeLy/a', NULL, '3', '', NULL, '2015-04-30 16:00:08', '2015-07-12 16:20:47'),
(40, 'summieesngh@gmail.com', '2015-05-02 19:10:32', '$2y$10$lz29joYAeqNXzhfPZKgme.Bj7ooIDC9g1Mbf.D19.65rCqjEtxcSq', '2015-05-02 19:10:32', NULL, 1, NULL, '2015-05-03 07:11:12', '2015-05-11 23:03:55', '$2y$10$ghyfolbJ9cLXggPV5oDRJuVAReW5umOdbLeG0Rx0oF4q2XQwfrsYa', NULL, '3', '', NULL, '2015-05-03 07:10:32', '2015-05-11 23:03:55'),
(41, 'negideepa1990@gmail.com', '2015-05-10 18:08:43', '$2y$10$wJPlKWgJaoQp66lFCqr8Fe2nC7CrUFHcqALpPZ145del77Avp.tBi', '2015-05-10 18:08:43', NULL, 1, NULL, '2015-05-11 06:09:41', '2015-05-11 17:18:09', '$2y$10$WWALan/kxVBS0PrZHaGZEOz.DOWK/ppbcTWFuZKEopFZ8tk5oACwa', NULL, '3', '', NULL, '2015-05-11 06:08:45', '2015-05-11 17:18:09'),
(42, 'test1@test.xx', '2015-07-28 21:49:59', '$2y$10$ep0pyeIiK2ZbkWInRU.7X.2dJL5Q.3tejImVVOAQTWC9cBPue9pzq', '2015-07-28 21:49:59', NULL, 0, 'gZKdl54llgm5s56nKCUMKrI1HiWcc3nTR6IrOP9qh3', NULL, NULL, NULL, NULL, NULL, '', NULL, '2015-07-28 21:49:59', '2015-07-28 21:49:59'),
(43, 'sss@dd.cc', '2015-07-29 18:46:35', '$2y$10$kJsBHl8c91rxQ5KunuBKze6VomEQlrbixS1A74XITPTHFw.GOQxl6', '2015-07-29 18:46:35', NULL, 0, '9M4PhC6hY6Iv0lO8xA4HrzbpOHos3CxuNSgrVYQ76s', NULL, NULL, NULL, NULL, NULL, '', NULL, '2015-07-29 18:46:36', '2015-07-29 18:46:36'),
(44, 'wwww@gggg.bb', '2015-07-29 20:22:51', '$2y$10$34nPVIueVzoVzqGj1z9geea7UkSqkuuCZcobm27aD1LbrK.pXBjI6', '2015-07-29 20:22:51', NULL, 1, NULL, '2015-07-29 20:28:27', '2015-08-04 17:52:55', '$2y$10$WO4DqjZvRBLppPt9A6phjejKekqGq2N35GsJsK.4iDitGQnZ5qhzC', NULL, '3', '', NULL, '2015-07-29 20:22:52', '2015-08-04 17:55:02'),
(45, 'dddd@gg.bb', '2015-07-30 18:55:57', '$2y$10$PbdcL1VBnz6Rq5a3O68saOwu0T3UCj3znNyZ4dAVlhJoC0xPSqahy', '2015-07-30 18:55:57', NULL, 1, NULL, '2015-07-30 18:59:59', '2015-07-30 19:00:04', '$2y$10$1bLQYwnGrcP/.jCZ4SJUUO0JP.O8m0qt4.vYekaVYtscOGc6kg0HG', NULL, NULL, '', NULL, '2015-07-30 18:55:57', '2015-07-30 19:00:04'),
(54, 'test2@test.xx', '2015-08-10 17:10:06', '$2y$10$L86rHXamwSZNFXi1BaiWC.DVy2GYUFVpAdFhEU4mWJia7FTi3Sfc.', '2015-08-10 17:10:06', NULL, 0, 'KrFijiY6tgFgmh8E', NULL, NULL, NULL, NULL, NULL, '', NULL, '2015-08-10 17:10:06', '2015-08-10 17:10:06'),
(55, 'test3@test.xx', '2015-08-10 17:11:49', '$2y$10$9IhHKeD3Ass3tT47JavOXeQuuY431HVy2z0jMBFTKScYmFObYTwMy', '2015-08-10 17:11:49', NULL, 0, 'h8zhhFVampnKBtSXG3RoRGDIWU7Vg04liQFtUJ5LUOhz4qnjizNOiTn7OgEAAP8T', NULL, NULL, NULL, NULL, NULL, '', NULL, '2015-08-10 17:11:49', '2015-08-10 17:11:49'),
(57, 'test555@test.xx', '2015-08-19 17:44:52', '$2y$10$MB0IbpGQqdhP9i56h9N5heEKLuIThgXQdPtky09Kmm0YZYSZqgUQK', '2015-08-19 17:44:52', NULL, 0, 'rG8b1GokqnhcNQmoh5uxwDjb6v7QgHIXxgUc4fMRteceaHaompZrQUqG7r4zEMQA', NULL, NULL, NULL, NULL, NULL, '', NULL, '2015-08-19 17:44:52', '2015-08-19 17:44:52'),
(58, 'test441@test.xx', '2015-08-19 17:51:19', '$2y$10$KMJVWkl5FQo6gqZVrV6eLe59qdHJoycbVsskql.D5GTwut7rHEVFe', '2015-08-19 17:51:19', NULL, 0, 'c5wyffR11ufk8xvrNmJPsPfI7RXzRYpiL2yhnY4NxdyxJV9klcmezUkRwNlLPEzV', NULL, NULL, NULL, NULL, NULL, '', NULL, '2015-08-19 17:51:19', '2015-08-19 17:51:19'),
(59, 'test51@test.xx', '2015-08-19 17:58:12', '$2y$10$tUz9kBcRS47TuBbo46EruuHsqT4wol5DVdspVsysuBgp7.Hciw.r.', '2015-08-19 17:58:12', NULL, 0, 'fjMzT1VL3JrobmosoRZjOhcciBoGVN1cBO5ntlDBAcmFACsCMOxKHm4nlpkLPEWC', NULL, NULL, NULL, NULL, NULL, '', NULL, '2015-08-19 17:58:12', '2015-08-19 17:58:12');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `user_id` int(11) NOT NULL,
  `groups_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`user_id`, `groups_id`) VALUES
(38, 2),
(39, 1),
(40, 2),
(41, 3),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(54, 2),
(55, 2),
(57, 2),
(58, 2),
(59, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users_login_info`
--

CREATE TABLE IF NOT EXISTS `users_login_info` (
  `id` int(11) NOT NULL COMMENT 'Primary key of the Table',
  `user_id` int(11) NOT NULL COMMENT 'Foriegn key to the users table.',
  `school_id` int(11) NOT NULL COMMENT 'Foreign key to the schools table.',
  `ip` varchar(30) NOT NULL,
  `latitude` varchar(10) NOT NULL,
  `longitude` varchar(10) NOT NULL,
  `area_code` varchar(10) NOT NULL,
  `time_zone` varchar(50) NOT NULL,
  `country` varchar(30) NOT NULL,
  `isp` varchar(30) NOT NULL,
  `session_length` time NOT NULL,
  `deleted_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_login_info`
--

INSERT INTO `users_login_info` (`id`, `user_id`, `school_id`, `ip`, `latitude`, `longitude`, `area_code`, `time_zone`, `country`, `isp`, `session_length`, `deleted_at`, `created_at`, `updated_at`) VALUES
(13, 38, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-04-29 14:35:39', '2015-04-29 14:35:39'),
(14, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-01 02:13:08', '2015-05-01 02:13:08'),
(15, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-01 02:16:43', '2015-05-01 02:16:43'),
(16, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-01 16:26:40', '2015-05-01 16:26:40'),
(17, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-02 03:21:42', '2015-05-02 03:21:42'),
(18, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-03 15:00:07', '2015-05-03 15:00:07'),
(19, 40, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-03 16:15:13', '2015-05-03 16:15:13'),
(20, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-05 05:07:27', '2015-05-05 05:07:27'),
(21, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-05 11:35:15', '2015-05-05 11:35:15'),
(22, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-05 16:22:53', '2015-05-05 16:22:53'),
(23, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-06 05:29:12', '2015-05-06 05:29:12'),
(24, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-06 10:39:22', '2015-05-06 10:39:22'),
(25, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-09 07:06:03', '2015-05-09 07:06:03'),
(26, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-09 13:55:58', '2015-05-09 13:55:58'),
(27, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-10 03:49:14', '2015-05-10 03:49:14'),
(28, 41, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-11 15:10:38', '2015-05-11 15:10:38'),
(29, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-11 15:12:20', '2015-05-11 15:12:20'),
(30, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-12 02:16:09', '2015-05-12 02:16:09'),
(31, 41, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-12 02:18:09', '2015-05-12 02:18:09'),
(32, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-12 09:11:37', '2015-05-12 09:11:37'),
(33, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-12 09:26:54', '2015-05-12 09:26:54'),
(34, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-13 02:34:49', '2015-05-13 02:34:49'),
(35, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-13 06:13:44', '2015-05-13 06:13:44'),
(36, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-14 00:48:52', '2015-05-14 00:48:52'),
(37, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-14 01:24:43', '2015-05-14 01:24:43'),
(38, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-15 00:28:58', '2015-05-15 00:28:58'),
(39, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-15 00:28:58', '2015-05-15 00:28:58'),
(40, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-15 00:42:03', '2015-05-15 00:42:03'),
(41, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-18 01:37:15', '2015-05-18 01:37:15'),
(42, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-18 08:03:34', '2015-05-18 08:03:34'),
(43, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-18 08:12:05', '2015-05-18 08:12:05'),
(44, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-05-25 05:52:34', '2015-05-25 05:52:34'),
(45, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-06-05 07:05:54', '2015-06-05 07:05:54'),
(46, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-06-23 03:39:31', '2015-06-23 03:39:31'),
(47, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-06-23 06:06:29', '2015-06-23 06:06:29'),
(48, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-06-23 06:16:09', '2015-06-23 06:16:09'),
(49, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-06-25 03:29:19', '2015-06-25 03:29:19'),
(50, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-06-25 03:42:39', '2015-06-25 03:42:39'),
(51, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-06-25 06:03:25', '2015-06-25 06:03:25'),
(52, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-06-26 01:25:21', '2015-06-26 01:25:21'),
(53, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-06-26 05:03:03', '2015-06-26 05:03:03'),
(54, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-07-06 01:33:04', '2015-07-06 01:33:04'),
(55, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-07-07 01:36:08', '2015-07-07 01:36:08'),
(56, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-07-08 01:01:29', '2015-07-08 01:01:29'),
(57, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-07-10 00:21:08', '2015-07-10 00:21:08'),
(58, 39, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-07-13 01:20:47', '2015-07-13 01:20:47'),
(59, 44, 3, '', '', '', '', '', '', '', '00:00:00', '0000-00-00 00:00:00', '2015-08-05 02:55:02', '2015-08-05 02:55:02');

-- --------------------------------------------------------

--
-- Table structure for table `users_registered_to_section`
--

CREATE TABLE IF NOT EXISTS `users_registered_to_section` (
  `id` int(11) NOT NULL COMMENT 'Primary Key of the Table',
  `session_id` int(11) NOT NULL COMMENT 'Foreign Key to the school_session table',
  `section_id` int(11) NOT NULL COMMENT 'Foreign Key to the sections table',
  `user_id` int(11) NOT NULL COMMENT 'Foreign Key to the users table',
  `deleted_at` datetime NOT NULL COMMENT 'soft deleting the row',
  `created_at` datetime NOT NULL COMMENT 'creation time and date',
  `updated_at` datetime NOT NULL COMMENT 'updation time and date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_registered_to_session`
--

CREATE TABLE IF NOT EXISTS `users_registered_to_session` (
  `id` int(11) NOT NULL COMMENT 'Primary Key of the Table',
  `school_session_id` int(11) NOT NULL COMMENT 'Foreign Key to the school_session table',
  `school_id` int(11) NOT NULL COMMENT 'Foreign Key to the schools table',
  `user_id` int(11) NOT NULL COMMENT 'Foreign Key to the users table',
  `deleted_at` datetime NOT NULL COMMENT 'soft deleting the row',
  `created_at` datetime NOT NULL COMMENT 'creation time and date',
  `updated_at` datetime NOT NULL COMMENT 'updation time and date'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_registered_to_session`
--

INSERT INTO `users_registered_to_session` (`id`, `school_session_id`, `school_id`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 41, '0000-00-00 00:00:00', '2015-05-11 15:11:18', '2015-05-11 15:11:18');

-- --------------------------------------------------------

--
-- Table structure for table `users_to_class`
--

CREATE TABLE IF NOT EXISTS `users_to_class` (
  `id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `stream_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deleted_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_to_class`
--

INSERT INTO `users_to_class` (`id`, `session_id`, `stream_id`, `section_id`, `class_id`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(4, 3, 1, 1, 1, 38, '0000-00-00 00:00:00', '2015-04-29 16:47:42', '2015-04-29 16:47:42'),
(5, 3, 1, 1, 2, 40, '0000-00-00 00:00:00', '2015-05-03 07:21:37', '2015-05-03 07:21:37'),
(6, 3, 1, 4, 3, 39, '0000-00-00 00:00:00', '2015-06-04 22:01:02', '2015-06-04 22:01:02'),
(7, 3, 1, 4, 3, 44, '0000-00-00 00:00:00', '2015-08-04 18:58:33', '2015-08-04 18:58:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `sex` tinyint(1) NOT NULL COMMENT '1 - for Females 0 - For Mails',
  `marriage_status` tinyint(1) NOT NULL,
  `mobile_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_verified` tinyint(1) NOT NULL,
  `mobile_updated_at` datetime NOT NULL,
  `home_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `add_1` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `add_2` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `pin_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `address_updated_at` datetime NOT NULL,
  `pic` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pic_updated_at` datetime NOT NULL,
  `skype` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `google_plus` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `deleted_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `username`, `first_name`, `middle_name`, `last_name`, `dob`, `sex`, `marriage_status`, `mobile_number`, `mobile_verified`, `mobile_updated_at`, `home_number`, `add_1`, `add_2`, `city`, `state`, `country`, `pin_code`, `address_updated_at`, `pic`, `pic_updated_at`, `skype`, `facebook`, `google_plus`, `twitter`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(11, 'CS000101', 'Sumit', '', 'ags', '0000-00-00', 0, 0, '8765374719', 0, '0000-00-00 00:00:00', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '', '', '', 38, '0000-00-00 00:00:00', '2015-04-28 02:28:42', '2015-04-29 05:36:18'),
(12, '', 'Sumit', '', 'Singh', '0000-00-00', 0, 0, '', 0, '0000-00-00 00:00:00', '', '', '', '', '', 'IND', '', '2015-07-06 02:37:00', '12fb3f79ef22bb48af46bc0eaaf4c4d6.png', '2015-07-06 02:37:00', '', '', '', '', 39, '0000-00-00 00:00:00', '2015-04-30 16:00:11', '2015-07-05 17:37:00'),
(13, 'CS000202', 'Deepa', '', 'Negi', '0000-00-00', 1, 0, '', 0, '0000-00-00 00:00:00', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '', '', '', 40, '0000-00-00 00:00:00', '2015-05-03 07:10:32', '2015-05-03 07:15:28'),
(14, '', 'Deepa', '', 'Negi', '0000-00-00', 1, 0, '', 0, '0000-00-00 00:00:00', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '', '', '', 41, '0000-00-00 00:00:00', '2015-05-11 06:08:46', '2015-05-11 06:10:56'),
(15, '', '', '', '', '0000-00-00', 0, 0, '', 0, '0000-00-00 00:00:00', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '', '', '', 42, '0000-00-00 00:00:00', '2015-07-28 21:50:00', '2015-07-28 21:50:00'),
(16, '', '', '', '', '0000-00-00', 0, 0, '', 0, '0000-00-00 00:00:00', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '', '', '', 43, '0000-00-00 00:00:00', '2015-07-29 18:46:37', '2015-07-29 18:46:37'),
(17, '', 'Hello', '', 'How ', '0000-00-00', 0, 0, '', 0, '0000-00-00 00:00:00', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '', '', '', 44, '0000-00-00 00:00:00', '2015-07-29 20:22:52', '2015-08-04 18:58:04'),
(18, '', '', '', '', '0000-00-00', 0, 0, '', 0, '0000-00-00 00:00:00', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '', '', '', 45, '0000-00-00 00:00:00', '2015-07-30 18:55:57', '2015-07-30 18:55:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`), ADD KEY `streams_id` (`streams_id`), ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`), ADD KEY `category` (`category`), ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `event_types`
--
ALTER TABLE `event_types`
  ADD PRIMARY KEY (`id`), ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `groups_name_unique` (`name`);

--
-- Indexes for table `periods`
--
ALTER TABLE `periods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `period_profile`
--
ALTER TABLE `period_profile`
  ADD PRIMARY KEY (`id`), ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `period_to_period_profile`
--
ALTER TABLE `period_to_period_profile`
  ADD PRIMARY KEY (`id`), ADD KEY `profile_id` (`profile_id`), ADD KEY `period_id` (`period_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_schedule`
--
ALTER TABLE `school_schedule`
  ADD PRIMARY KEY (`id`), ADD KEY `school_id` (`school_id`), ADD KEY `school_session_id` (`school_session_id`);

--
-- Indexes for table `school_session`
--
ALTER TABLE `school_session`
  ADD PRIMARY KEY (`id`), ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`), ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `streams`
--
ALTER TABLE `streams`
  ADD PRIMARY KEY (`id`), ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`), ADD KEY `class_id` (`class_id`), ADD KEY `section_id` (`section_id`), ADD KEY `school_id` (`deleted_at`);

--
-- Indexes for table `throttle`
--
ALTER TABLE `throttle`
  ADD PRIMARY KEY (`id`), ADD KEY `throttle_user_id_index` (`user_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`), ADD KEY `classes_id` (`class_id`), ADD KEY `subject_id` (`subject_id`), ADD KEY `section_id` (`section_id`), ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`), ADD KEY `users_activation_code_index` (`activation_code`), ADD KEY `users_reset_password_code_index` (`reset_password_code`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`user_id`,`groups_id`);

--
-- Indexes for table `users_login_info`
--
ALTER TABLE `users_login_info`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `users_registered_to_section`
--
ALTER TABLE `users_registered_to_section`
  ADD PRIMARY KEY (`id`), ADD KEY `school_session_id` (`session_id`), ADD KEY `school_id` (`section_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users_registered_to_session`
--
ALTER TABLE `users_registered_to_session`
  ADD PRIMARY KEY (`id`), ADD KEY `school_session_id` (`school_session_id`), ADD KEY `school_id` (`school_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users_to_class`
--
ALTER TABLE `users_to_class`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `class_id` (`class_id`), ADD KEY `session_id` (`session_id`), ADD KEY `stream_id` (`stream_id`), ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `event_types`
--
ALTER TABLE `event_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `periods`
--
ALTER TABLE `periods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `period_profile`
--
ALTER TABLE `period_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key',AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `period_to_period_profile`
--
ALTER TABLE `period_to_period_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `school_schedule`
--
ALTER TABLE `school_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `school_session`
--
ALTER TABLE `school_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `streams`
--
ALTER TABLE `streams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `throttle`
--
ALTER TABLE `throttle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `users_login_info`
--
ALTER TABLE `users_login_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key of the Table',AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `users_registered_to_section`
--
ALTER TABLE `users_registered_to_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key of the Table';
--
-- AUTO_INCREMENT for table `users_registered_to_session`
--
ALTER TABLE `users_registered_to_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key of the Table',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_to_class`
--
ALTER TABLE `users_to_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`),
ADD CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`streams_id`) REFERENCES `streams` (`id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`category`) REFERENCES `event_types` (`id`),
ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`);

--
-- Constraints for table `event_types`
--
ALTER TABLE `event_types`
ADD CONSTRAINT `event_types_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`);

--
-- Constraints for table `period_profile`
--
ALTER TABLE `period_profile`
ADD CONSTRAINT `period_profile_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`);

--
-- Constraints for table `period_to_period_profile`
--
ALTER TABLE `period_to_period_profile`
ADD CONSTRAINT `period_to_period_profile_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `period_profile` (`id`),
ADD CONSTRAINT `period_to_period_profile_ibfk_2` FOREIGN KEY (`period_id`) REFERENCES `periods` (`id`);

--
-- Constraints for table `school_schedule`
--
ALTER TABLE `school_schedule`
ADD CONSTRAINT `school_schedule_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`),
ADD CONSTRAINT `school_schedule_ibfk_2` FOREIGN KEY (`school_session_id`) REFERENCES `school_session` (`id`);

--
-- Constraints for table `school_session`
--
ALTER TABLE `school_session`
ADD CONSTRAINT `school_session_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`);

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
ADD CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);

--
-- Constraints for table `streams`
--
ALTER TABLE `streams`
ADD CONSTRAINT `streams_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
ADD CONSTRAINT `subjects_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`);

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
ADD CONSTRAINT `timetable_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
ADD CONSTRAINT `timetable_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `user_details` (`id`),
ADD CONSTRAINT `timetable_ibfk_3` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
ADD CONSTRAINT `timetable_ibfk_4` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`);

--
-- Constraints for table `users_login_info`
--
ALTER TABLE `users_login_info`
ADD CONSTRAINT `users_login_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
ADD CONSTRAINT `users_login_info_ibfk_2` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`);

--
-- Constraints for table `users_registered_to_section`
--
ALTER TABLE `users_registered_to_section`
ADD CONSTRAINT `users_registered_to_section_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `school_session` (`id`),
ADD CONSTRAINT `users_registered_to_section_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
ADD CONSTRAINT `users_registered_to_section_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users_registered_to_session`
--
ALTER TABLE `users_registered_to_session`
ADD CONSTRAINT `users_registered_to_session_ibfk_1` FOREIGN KEY (`school_session_id`) REFERENCES `school_session` (`id`),
ADD CONSTRAINT `users_registered_to_session_ibfk_2` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`),
ADD CONSTRAINT `users_registered_to_session_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users_to_class`
--
ALTER TABLE `users_to_class`
ADD CONSTRAINT `users_to_class_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
ADD CONSTRAINT `users_to_class_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
ADD CONSTRAINT `users_to_class_ibfk_3` FOREIGN KEY (`session_id`) REFERENCES `school_session` (`id`),
ADD CONSTRAINT `users_to_class_ibfk_4` FOREIGN KEY (`stream_id`) REFERENCES `streams` (`id`),
ADD CONSTRAINT `users_to_class_ibfk_5` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
