-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 07, 2013 at 08:26 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kip`
--

-- --------------------------------------------------------

--
-- Table structure for table `dinamic_comments`
--

CREATE TABLE IF NOT EXISTS `dinamic_comments` (
  `comment_id` bigint(20) NOT NULL,
  `comment_postid` bigint(20) DEFAULT NULL,
  `comment_parent` bigint(20) DEFAULT NULL,
  `comment_userid` bigint(20) DEFAULT NULL,
  `comment_remoteip` varchar(100) DEFAULT NULL,
  `comment_date` datetime DEFAULT NULL,
  `comment_content` text,
  `comment_approved` varchar(20) DEFAULT NULL,
  `comment_status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dinamic_comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `dinamic_complains`
--

CREATE TABLE IF NOT EXISTS `dinamic_complains` (
  `complain_id` bigint(20) NOT NULL,
  `complain_requestid` bigint(20) DEFAULT NULL,
  `complain_reason` text,
  `complain_case` text,
  `complain_date` datetime DEFAULT NULL,
  `complain_datetime` datetime DEFAULT NULL,
  `complain_remoteip` varchar(100) DEFAULT NULL,
  `complain_status` varchar(20) DEFAULT NULL,
  `complain_status_reason` text,
  PRIMARY KEY (`complain_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dinamic_complains`
--

INSERT INTO `dinamic_complains` (`complain_id`, `complain_requestid`, `complain_reason`, `complain_case`, `complain_date`, `complain_datetime`, `complain_remoteip`, `complain_status`, `complain_status_reason`) VALUES
(1, 5, '["2","3","5","7"]', 'sfds', '2013-10-05 01:04:04', '2013-10-05 00:41:41', NULL, 'Belum Terselesaikan', 'susah'),
(2, 5, '["1","2","5"]', '', '2013-10-05 00:55:49', '2013-10-05 00:55:25', NULL, 'Terselesaikan', NULL),
(3, 5, '["4","5"]', '', '2013-10-06 17:19:55', '2013-10-06 17:19:31', NULL, 'Terselesaikan', 'hore'),
(4, 5, '["4","5"]', '', '2013-10-06 17:20:11', '2013-10-06 17:19:47', NULL, 'Baru', NULL),
(5, 5, '["1"]', '', '2013-10-06 17:33:02', '2013-10-06 17:32:38', NULL, 'Baru', NULL),
(6, 5, '["1","2"]', '', '2013-10-07 08:17:56', '2013-10-07 08:17:32', NULL, 'Baru', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dinamic_media`
--

CREATE TABLE IF NOT EXISTS `dinamic_media` (
  `media_id` bigint(20) NOT NULL,
  `media_key` varchar(500) DEFAULT NULL,
  `media_link` text,
  `media_realname` text,
  `media_category` bigint(20) DEFAULT NULL,
  `media_status` varchar(100) DEFAULT NULL,
  `media_userid` bigint(20) DEFAULT NULL,
  `media_datetime` datetime DEFAULT NULL,
  `media_viewed` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`media_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dinamic_media`
--


-- --------------------------------------------------------

--
-- Table structure for table `dinamic_menus`
--

CREATE TABLE IF NOT EXISTS `dinamic_menus` (
  `menu_id` bigint(20) NOT NULL,
  `menu_title` varchar(100) DEFAULT NULL,
  `menu_link` varchar(250) DEFAULT NULL,
  `menu_parent` bigint(20) DEFAULT NULL,
  `menu_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dinamic_menus`
--


-- --------------------------------------------------------

--
-- Table structure for table `dinamic_messages`
--

CREATE TABLE IF NOT EXISTS `dinamic_messages` (
  `message_id` bigint(20) NOT NULL,
  `message_from` bigint(20) DEFAULT NULL,
  `message_to` bigint(20) DEFAULT NULL,
  `message_created` datetime DEFAULT NULL,
  `message_title` text,
  `message_content` text,
  `message_parent` bigint(20) DEFAULT NULL,
  `message_status` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dinamic_messages`
--


-- --------------------------------------------------------

--
-- Table structure for table `dinamic_modules`
--

CREATE TABLE IF NOT EXISTS `dinamic_modules` (
  `modul_id` int(11) NOT NULL,
  `modul_name` varchar(200) DEFAULT NULL,
  `modul_location` varchar(200) DEFAULT NULL,
  `modul_active` int(11) DEFAULT NULL,
  `modul_userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`modul_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dinamic_modules`
--


-- --------------------------------------------------------

--
-- Table structure for table `dinamic_permissions`
--

CREATE TABLE IF NOT EXISTS `dinamic_permissions` (
  `permission_id` int(11) NOT NULL,
  `permission_groupid` bigint(20) DEFAULT NULL,
  `permission_modulid` bigint(20) DEFAULT NULL,
  `permission_value` varchar(200) DEFAULT NULL,
  `permission_status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dinamic_permissions`
--


-- --------------------------------------------------------

--
-- Table structure for table `dinamic_pollings`
--

CREATE TABLE IF NOT EXISTS `dinamic_pollings` (
  `polling_id` bigint(20) NOT NULL,
  `polling_key` varchar(100) DEFAULT NULL,
  `polling_name` text,
  `polling_value` bigint(20) DEFAULT NULL,
  `polling_status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`polling_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dinamic_pollings`
--


-- --------------------------------------------------------

--
-- Table structure for table `dinamic_posts`
--

CREATE TABLE IF NOT EXISTS `dinamic_posts` (
  `post_id` bigint(20) DEFAULT NULL,
  `post_userid` bigint(20) DEFAULT NULL,
  `post_created` datetime DEFAULT NULL,
  `post_updated` datetime DEFAULT NULL,
  `post_title` text,
  `post_content` text,
  `post_short` text,
  `post_status` varchar(20) DEFAULT NULL,
  `post_commentstatus` varchar(20) DEFAULT NULL,
  `post_commentcount` int(11) DEFAULT NULL,
  `post_mimetype` varchar(100) DEFAULT NULL,
  `post_expired` datetime DEFAULT NULL,
  `post_marquee` varchar(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dinamic_posts`
--

INSERT INTO `dinamic_posts` (`post_id`, `post_userid`, `post_created`, `post_updated`, `post_title`, `post_content`, `post_short`, `post_status`, `post_commentstatus`, `post_commentcount`, `post_mimetype`, `post_expired`, `post_marquee`) VALUES
(6, 1, '2013-10-02 08:24:57', '2013-10-07 08:24:33', 'degan ini', 'kami meangatajd<br>', NULL, '1', '1', NULL, NULL, '0000-00-00 00:00:00', 'none'),
(5, 1, '2013-10-17 17:04:13', '2013-10-02 17:03:49', '', '<br>', NULL, '1', '1', NULL, NULL, '0000-00-00 00:00:00', 'on'),
(3, 1, '2013-10-02 08:25:06', '2013-10-07 08:24:42', 'Informasi Bau', 'orusanuf hyaaaay<br>', NULL, '1', '1', NULL, NULL, '0000-00-00 00:00:00', 'on'),
(4, 1, '2013-10-02 16:57:14', NULL, 'nah!', 'Berita baru lain<br>', NULL, '1', '1', NULL, NULL, '0000-00-00 00:00:00', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `dinamic_requests`
--

CREATE TABLE IF NOT EXISTS `dinamic_requests` (
  `request_id` bigint(20) NOT NULL,
  `request_userid` bigint(20) DEFAULT NULL,
  `request_information` text,
  `request_reason` text,
  `request_user` varchar(100) DEFAULT NULL,
  `request_ktp` varchar(100) DEFAULT NULL,
  `request_address` varchar(250) DEFAULT NULL,
  `request_phone` varchar(100) DEFAULT NULL,
  `request_email` varchar(50) DEFAULT NULL,
  `request_usage` text,
  `request_authname` varchar(100) DEFAULT NULL,
  `request_authaddress` varchar(250) DEFAULT NULL,
  `request_authphone` varchar(100) DEFAULT NULL,
  `request_authfile` varchar(200) DEFAULT NULL,
  `request_how` varchar(100) DEFAULT NULL,
  `request_format` varchar(100) DEFAULT NULL,
  `request_delivery` varchar(100) DEFAULT NULL,
  `request_datetime` datetime DEFAULT NULL,
  `request_remoteip` varchar(50) DEFAULT NULL,
  `request_status` varchar(50) DEFAULT NULL,
  `request_status_reason` text,
  `request_nomor` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dinamic_requests`
--

INSERT INTO `dinamic_requests` (`request_id`, `request_userid`, `request_information`, `request_reason`, `request_user`, `request_ktp`, `request_address`, `request_phone`, `request_email`, `request_usage`, `request_authname`, `request_authaddress`, `request_authphone`, `request_authfile`, `request_how`, `request_format`, `request_delivery`, `request_datetime`, `request_remoteip`, `request_status`, `request_status_reason`, `request_nomor`) VALUES
(2, 14, 'yan gkanan menandasd', 'benda tu', '', '', '', '', '', '" yan oentng ksdf', 'Pemohonnnya', '', '', '', 'langsung', 'tercetak', 'pos', '2013-09-04 16:53:37', NULL, 'Diproses', NULL, NULL),
(1, 14, 'yan gkanan menandasd', 'benda tu', '', '', '', '', '', '" yan oentng ksdf', 'Pemohonnnya', '', '', '', 'langsung', 'tercetak', 'pos', '2013-09-04 16:51:06', NULL, 'Diproses', NULL, NULL),
(3, 14, '', '', 'dadasfdaff', 'asd', 'asd', '', '', 'Kala ndogso', 'asds', 'asdsad', 'asdsad', '', 'langsung', 'tercetak', 'langsung', '2013-10-04 16:57:31', NULL, 'Terbit', 'bag', 'Nah'),
(4, 14, '', '', 'dadasfdaff', 'asd', 'asd', '', '', 'Kala ndogso', 'asds', 'asdsad', 'asdsad', '', 'email', 'terekam', 'email', '2013-10-04 16:58:03', NULL, 'Terbit', '', NULL),
(5, 14, '', '', '', '', '', '', '', 'lagi', '', '', '', 'kuasa_14(5).jpg', 'langsung', 'terekam', 'langsung', '2013-10-04 18:04:10', NULL, 'Ditolak', 'nah', NULL),
(6, 14, '', '', '', '', '', '', '', '', '', '', '', '', 'langsung', 'tercetak', 'langsung', '2013-10-06 09:20:54', NULL, 'Batal', NULL, NULL),
(7, 14, '', '', '', '', '', '', '', '', 'bwuer', '', '', '', 'langsung', 'tercetak', 'langsung', '2013-10-06 11:06:08', NULL, 'Ditolak', 'Bagus', NULL),
(8, 14, '', '', 'nanoa', '', '', '', '', '', '', '', '', '', 'langsung', 'terekam', 'langsung', '2013-10-07 08:09:15', NULL, 'Baru', NULL, NULL),
(9, 14, '', '', 'nanoa', '', '', '', '', '', '', '', '', '', 'langsung', 'terekam', 'langsung', '2013-10-07 08:12:27', NULL, 'Baru', NULL, NULL),
(10, 14, '', '', 'nanoa', '', '', '', '', '', '', '', '', '', 'langsung', 'terekam', 'langsung', '2013-10-07 08:13:15', NULL, 'Baru', NULL, NULL),
(11, 14, '', '', 'nanoa', '', '', '', '', '', '', '', '', '', 'langsung', 'terekam', 'langsung', '2013-10-07 08:15:43', NULL, 'Baru', NULL, NULL),
(12, 14, '', '', '', '', '', '', '', '', '', '', 'permogh', '', 'langsung', 'tercetak', 'langsung', '2013-10-07 08:16:57', NULL, 'Baru', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dinamic_settings`
--

CREATE TABLE IF NOT EXISTS `dinamic_settings` (
  `setting_id` int(11) NOT NULL,
  `setting_key` varchar(100) DEFAULT NULL,
  `setting_value` text,
  `setting_vars` text,
  `setting_status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dinamic_settings`
--

INSERT INTO `dinamic_settings` (`setting_id`, `setting_key`, `setting_value`, `setting_vars`, `setting_status`) VALUES
(1, 'alasan_pengaduan', 'Permohonan Informasi Ditolak', '1', NULL),
(2, 'alasan_pengaduan', 'Informasi berkala tidak disediakan', '2', NULL),
(3, 'alasan_pengaduan', 'Permintaan Informasi tidak ditanggapi', '3', NULL),
(4, 'alasan_pengaduan', 'Permintaan Informasi ditanggapi tidak sebagaimana yang diminta', '4', NULL),
(5, 'alasan_pengaduan', 'Permintaan Informasi tidak dipenuhi', '5', NULL),
(6, 'alasan_pengaduan', 'Biaya yang dikenakan tidak wajar', '6', NULL),
(7, 'alasan_pengaduan', 'Informasi disampaikan melebihi jangka waktu yang ditentukan', '7', NULL),
(9, 'status_permohonan', 'Diproses', 'diproses', NULL),
(10, 'status_permohonan', 'Ditolak', 'ditolak', NULL),
(12, 'status_permohonan', 'Terbit', 'terbit', NULL),
(13, 'status_permohonan', 'Diambil', 'diambil', NULL),
(14, 'status_permohonan', 'Batal', 'batal', NULL),
(15, 'status_pengaduan', 'Baru', 'baru', 'default'),
(8, 'status_permohonan', 'Baru', 'baru', 'default'),
(16, 'status_pengaduan', 'Belum Terselesaikan', 'belum_terselesaikan', NULL),
(18, 'site', 'http://localhost/airputih', NULL, NULL),
(17, 'status_pengaduan', 'Terselesaikan', 'Terselesaikan', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dinamic_users`
--

CREATE TABLE IF NOT EXISTS `dinamic_users` (
  `user_id` bigint(20) NOT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_pass` varchar(64) DEFAULT NULL,
  `user_fullname` varchar(250) DEFAULT NULL,
  `user_address` varchar(100) DEFAULT NULL,
  `user_work` varchar(250) DEFAULT NULL,
  `user_phone` varchar(100) DEFAULT NULL,
  `user_ktp` varchar(100) DEFAULT NULL,
  `user_scanktp` varchar(200) DEFAULT NULL,
  `user_url` varchar(100) DEFAULT NULL,
  `user_registered` datetime DEFAULT NULL,
  `user_activationkey` varchar(60) DEFAULT NULL,
  `user_status` int(11) DEFAULT NULL,
  `user_lastlogin` datetime DEFAULT NULL,
  `user_expired_key` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dinamic_users`
--

INSERT INTO `dinamic_users` (`user_id`, `user_email`, `user_pass`, `user_fullname`, `user_address`, `user_work`, `user_phone`, `user_ktp`, `user_scanktp`, `user_url`, `user_registered`, `user_activationkey`, `user_status`, `user_lastlogin`, `user_expired_key`) VALUES
(1, 'k', '8ce4b16b22b58894aa86c421e8759df3', 'hari', 'haria', NULL, 'harb', 'a', 'ktp.jpg', NULL, '2013-10-03 19:54:13', 'jlYHd2LUrs5', 0, NULL, NULL),
(2, 'k', '8ce4b16b22b58894aa86c421e8759df3', 'hari', 'haria', NULL, 'harb', 'a', 'ktp.jpg', NULL, '2013-10-03 19:54:46', 'Hbmlsa9J1AchIVy4nNrgGUP7ek3q562DE', 0, NULL, NULL),
(3, 'hspinter@yahoo.com', 'f970e2767d0cfe75876ea857f92e319b', 'as', 'sa', NULL, 'a', 'as', 'ktp.jpg', NULL, '2013-10-03 20:33:01', '9bLVwS8uYqG07QvA6nzRsyU21rxoWgfDJ', 1, NULL, '2013-10-04 21:16:06'),
(4, 'a', '0cc175b9c0f1b6a831c399e269772661', 'a', 'a', NULL, 'a', 'a', 'a.jpg', NULL, '2013-10-03 22:04:37', 'gRw6LWUBQJ5EdP2vF0Vnmp41rhIC7Xsao', 0, NULL, '2013-10-04 22:04:37'),
(5, 'q', '7694f4a66316e53c8cdd9d9954bd611d', 'q', 'q', NULL, 'q', 'q', 'q.jpg', NULL, '2013-10-03 22:07:42', 'NSoKf1Di5cP3VEgtyHbTksRCjzpLMOJGv', 0, NULL, '2013-10-04 22:07:42'),
(6, 'r', '4b43b0aee35624cd95b910189b3dc231', 'r', 'r', NULL, 'r', 'r', 'r.jpg', NULL, '2013-10-03 22:10:51', 'aot7Ie2JETPQpzD5W4MVvcbSqKFsLy839', 0, NULL, '2013-10-04 22:10:51'),
(7, 'w', 'f1290186a5d0b1ceab27f4e77c0c5d68', 'w', 'w', NULL, 'w', 'w', 'w.jpg', NULL, '2013-10-03 22:13:17', '9YAIX4fZVWbed0BKRScsvJ721FOL3tQaE', 0, NULL, '2013-10-04 22:13:17'),
(8, 'i', '865c0c0b4ab0e063e5caa3387c1a8741', 'i', 'i', NULL, 'i', 'i', 'i.jpg', NULL, '2013-10-03 22:17:29', '3cwnx6XePEj9RL1FrVB87yUldzqiIDHk4', 0, NULL, '2013-10-04 22:17:29'),
(9, 'e', 'e1671797c52e15f763380b45e841ec32', 'e', 'e', NULL, 'e', 'e', 'e.jpg', NULL, '2013-10-03 22:18:49', 'ByCnKvewLbgidTRAVF1kaG3oxc0rMHY6J', 0, NULL, '2013-10-04 22:18:49'),
(10, 'f', '8fa14cdd754f91cc6554c9e71929cce7', 'f', 'f', NULL, 'f', 'e', 'e(1).jpg', NULL, '2013-10-03 22:19:27', 'lJC4AkUQK2swroEOMtHW06xyVFBgciNv3', 0, NULL, '2013-10-04 22:19:27'),
(11, 'g', 'b2f5ff47436671b6e533d8dc3614845d', 'g', 'g', NULL, 'g', 'e', 'e.jpg', NULL, '2013-10-03 22:19:55', 'tPp7uikvwSxjGWgFJRXTehoKHA9ZCdzV8', 0, NULL, '2013-10-04 22:19:55'),
(12, 'h', '2510c39011c5be704182423e3a695e91', 'h', 'hariah', NULL, 'h', 'e', 'e(2).jpg', NULL, '2013-10-03 22:21:35', 'qeLGfFWZIxw7AVlQ8P5EvmsXYNhzBUTdM', 0, NULL, '2013-10-04 22:21:35'),
(13, 'b', '92eb5ffee6ae2fec3ad71c777531578f', 'b', 'b', NULL, 'b', 'a', 'a(1).jpg', NULL, '2013-10-03 22:22:32', 'Led6HFGyJnhPfXWNUD3Abx8wml9KM4gvt', 0, NULL, '2013-10-04 22:22:32'),
(14, 'c', '4a8a08f09d37b73795649038408b5f33', 'Myname is C', 'My ADdess is C', NULL, 'myphone is c', 'a', 'a(2).jpg', NULL, '2013-10-03 22:22:57', 'XNvTyuFgQti840RDwY72Lm3aW5GjkopSO', 1, NULL, '2013-10-04 22:22:57');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
