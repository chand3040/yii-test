-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 21, 2016 at 12:13 PM
-- Server version: 5.5.47-0+deb8u1
-- PHP Version: 5.6.17-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `businessdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `drg_currency_forex`
--

CREATE TABLE `drg_currency_forex` (
  `currency` char(3) NOT NULL DEFAULT '',
  `rate` float NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drg_currency_forex`
--

INSERT INTO `drg_currency_forex` (`currency`, `rate`) VALUES
('EUR', 1),
('USD', 1.1279),
('JPY', 125.79),
('BGN', 1.9558),
('CZK', 27.035),
('DKK', 7.4542),
('GBP', 0.77855),
('HUF', 310.32),
('PLN', 4.2625),
('RON', 4.4718),
('SEK', 9.2773),
('CHF', 1.0919),
('NOK', 9.4111),
('HRK', 7.5305),
('RUB', 76.0498),
('TRY', 3.2218),
('AUD', 1.4804),
('BRL', 4.0794),
('CAD', 1.4627),
('CNY', 7.3037),
('HKD', 8.7464),
('IDR', 14754.1),
('ILS', 4.3387),
('INR', 74.7625),
('KRW', 1306.11),
('MXN', 19.4683),
('MYR', 4.5716),
('NZD', 1.655),
('PHP', 52.351),
('SGD', 1.5277),
('THB', 39.296),
('ZAR', 17.2024);

-- --------------------------------------------------------

--
-- Table structure for table `user_default_account_balance`
--

CREATE TABLE `user_default_account_balance` (
  `user_default_account_balance_id` int(11) NOT NULL,
  `user_default_account_balance_user_id` int(11) NOT NULL,
  `user_default_account_balance_account_balance` decimal(10,4) NOT NULL,
  `user_default_account_balance_currency_code` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_activity_date`
--

CREATE TABLE `user_default_activity_date` (
  `id` bigint(20) NOT NULL,
  `user_default_id` int(11) NOT NULL,
  `total_minutes` int(11) NOT NULL,
  `total_requests` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_activity_date`
--

INSERT INTO `user_default_activity_date` (`id`, `user_default_id`, `total_minutes`, `total_requests`, `date`) VALUES
(1, 1, 4, 6, '2016-03-21'),
(2, 2, 0, 4, '2016-03-21'),
(3, 3, 0, 4, '2016-03-21'),
(4, 4, 0, 3, '2016-03-21');

-- --------------------------------------------------------

--
-- Table structure for table `user_default_activity_log`
--

CREATE TABLE `user_default_activity_log` (
  `id` bigint(20) NOT NULL,
  `user_default_id` int(11) NOT NULL,
  `log_id` tinyint(4) NOT NULL,
  `description` varchar(255) NOT NULL,
  `counted_minutes` int(11) NOT NULL,
  `idle_minutes` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `user_default_business_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_activity_log`
--

INSERT INTO `user_default_activity_log` (`id`, `user_default_id`, `log_id`, `description`, `counted_minutes`, `idle_minutes`, `datetime`, `user_default_business_id`) VALUES
(1, 0, 13, 'Link visited: /admin/banner/banner/index', 0, 0, '2016-03-20 21:56:19', 2),
(2, 0, 13, 'Link visited: /admin/website', 0, 0, '2016-03-20 21:56:23', 2),
(3, 0, 13, 'Link visited: /admin/faq', 0, 0, '2016-03-20 21:56:26', 2),
(4, 0, 13, 'Link visited: /admin/website', 0, 0, '2016-03-20 21:56:28', 2),
(5, 0, 13, 'Link visited: /admin/website', 0, 0, '2016-03-20 21:56:32', 2),
(6, 0, 13, 'Link visited: /admin/website/sitedefaults', 0, 0, '2016-03-20 21:56:34', 2),
(7, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-20 21:56:36', 2),
(8, 0, 13, 'Link visited: /admin/website', 5, 0, '2016-03-21 05:28:20', 2),
(9, 0, 13, 'Link visited: /admin/website/slider', 1, 0, '2016-03-21 05:29:12', 2),
(10, 0, 13, 'Link visited: /admin/website/slider/create/id/55', 1, 0, '2016-03-21 05:30:24', 2),
(11, 0, 13, 'Link visited: /admin/website/slider', 2, 0, '2016-03-21 05:32:15', 2),
(12, 0, 13, 'Link visited: /admin/website/slider?rows=50', 0, 0, '2016-03-21 05:32:20', 2),
(13, 0, 13, 'Link visited: /admin/website/slider/create/id/24', 1, 0, '2016-03-21 05:32:55', 2),
(14, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=who_are_we.png', 4, 0, '2016-03-21 05:36:57', 2),
(15, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=consumer-visitor.png', 3, 0, '2016-03-21 05:40:20', 2),
(16, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=invention-funding.png', 0, 0, '2016-03-21 05:40:29', 2),
(17, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=video-tutorials.png', 0, 0, '2016-03-21 05:40:35', 2),
(18, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=public-opinion.png', 0, 0, '2016-03-21 05:40:42', 2),
(19, 0, 13, 'Link visited: /admin/website/slider/create/id/24', 5, 0, '2016-03-21 05:48:39', 2),
(20, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 05:48:39', 2),
(21, 0, 13, 'Link visited: /admin/website/slider?rows=50', 4, 0, '2016-03-21 05:52:43', 2),
(22, 0, 13, 'Link visited: /admin/website/slider/create/id/27', 0, 0, '2016-03-21 05:52:58', 2),
(23, 0, 13, 'Link visited: /admin/website/slider', 1, 0, '2016-03-21 05:53:41', 2),
(24, 0, 13, 'Link visited: /admin/website/slider?rows=50', 0, 0, '2016-03-21 05:53:47', 2),
(25, 0, 13, 'Link visited: /admin/website/slider/create/id/24', 1, 0, '2016-03-21 05:54:24', 2),
(26, 0, 13, 'Link visited: /admin/website/slider/create/id/24', 5, 0, '2016-03-21 06:05:59', 2),
(27, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 06:05:59', 2),
(28, 0, 13, 'Link visited: /admin/website/slider?rows=50', 2, 0, '2016-03-21 06:07:59', 2),
(29, 0, 13, 'Link visited: /admin/website/slider/create/id/24', 0, 0, '2016-03-21 06:08:03', 2),
(30, 0, 13, 'Link visited: /admin/website/slider', 1, 0, '2016-03-21 06:08:38', 2),
(31, 0, 13, 'Link visited: /admin/website/slider?rows=50', 0, 0, '2016-03-21 06:09:00', 2),
(32, 0, 13, 'Link visited: /admin/website/slider/create/id/27', 0, 0, '2016-03-21 06:09:14', 2),
(33, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=who_are_we.png', 0, 0, '2016-03-21 06:09:24', 2),
(34, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=consumer-visitor.png', 0, 0, '2016-03-21 06:09:33', 2),
(35, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=invention-funding.png', 0, 0, '2016-03-21 06:09:43', 2),
(36, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=video-tutorials.png', 0, 0, '2016-03-21 06:09:48', 2),
(37, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=public-opinion.png', 0, 0, '2016-03-21 06:09:56', 2),
(38, 0, 13, 'Link visited: /admin/website/slider/create/id/27', 4, 0, '2016-03-21 06:14:13', 2),
(39, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 06:14:14', 2),
(40, 0, 13, 'Link visited: /admin/website/slider?rows=50', 0, 0, '2016-03-21 06:14:18', 2),
(41, 0, 13, 'Link visited: /admin/website/slider/create/id/27', 0, 0, '2016-03-21 06:14:23', 2),
(42, 0, 13, 'Link visited: /admin/website/slider/create/id/27', 5, 0, '2016-03-21 06:29:27', 2),
(43, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 06:29:27', 2),
(44, 0, 13, 'Link visited: /admin/website/slider?rows=50', 1, 0, '2016-03-21 06:30:35', 2),
(45, 0, 13, 'Link visited: /admin/website/slider/create/id/22', 0, 0, '2016-03-21 06:30:55', 2),
(46, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=who_are_we.png', 0, 0, '2016-03-21 06:31:21', 2),
(47, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=consumer-visitor.png', 0, 0, '2016-03-21 06:31:30', 2),
(48, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=invention-funding.png', 0, 0, '2016-03-21 06:31:37', 2),
(49, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=video-tutorials.png', 0, 0, '2016-03-21 06:31:46', 2),
(50, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=public-opinion.png', 0, 0, '2016-03-21 06:31:52', 2),
(51, 0, 13, 'Link visited: /admin/website/slider/create/id/22', 3, 0, '2016-03-21 06:34:53', 2),
(52, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 06:34:53', 2),
(53, 0, 13, 'Link visited: /admin/website/slider/create/id/44', 0, 0, '2016-03-21 06:35:17', 2),
(54, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=who_are_we.png', 0, 0, '2016-03-21 06:35:26', 2),
(55, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=consumer-visitor.png', 0, 0, '2016-03-21 06:35:33', 2),
(56, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=invention-funding.png', 0, 0, '2016-03-21 06:35:47', 2),
(57, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=video-tutorials.png', 0, 0, '2016-03-21 06:35:59', 2),
(58, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=public-opinion.png', 0, 0, '2016-03-21 06:36:04', 2),
(59, 0, 13, 'Link visited: /admin/website/slider/create/id/44', 5, 0, '2016-03-21 06:40:48', 2),
(60, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 06:40:48', 2),
(61, 0, 13, 'Link visited: /admin/website/slider?rows=50', 0, 0, '2016-03-21 06:41:16', 2),
(62, 0, 13, 'Link visited: /admin/website/slider/create/id/29', 0, 0, '2016-03-21 06:41:21', 2),
(63, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=who_are_we.png', 0, 0, '2016-03-21 06:41:36', 2),
(64, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=invention-funding.png', 0, 0, '2016-03-21 06:41:42', 2),
(65, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=consumer-visitor.png', 1, 0, '2016-03-21 06:42:55', 2),
(66, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=invention-funding.png', 1, 0, '2016-03-21 06:44:10', 2),
(67, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=video-tutorials.png', 0, 0, '2016-03-21 06:44:17', 2),
(68, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=s683l9929jqub96i2necfcm7i6&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=public-opinion.png', 0, 0, '2016-03-21 06:44:23', 2),
(69, 0, 13, 'Link visited: /admin/website/slider/create/id/29', 1, 0, '2016-03-21 06:45:45', 2),
(70, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 06:45:46', 2),
(71, 0, 13, 'Link visited: /admin/website/slider?rows=50', 3, 0, '2016-03-21 06:49:07', 2),
(72, 0, 13, 'Link visited: /admin/website/slider/create/id/30', 0, 0, '2016-03-21 06:49:14', 2),
(73, 0, 13, 'Link visited: /admin/website', 5, 0, '2016-03-21 08:19:29', 2),
(74, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 08:19:32', 2),
(75, 0, 13, 'Link visited: /admin/website/slider?rows=50', 0, 0, '2016-03-21 08:19:42', 2),
(76, 0, 13, 'Link visited: /admin/website/slider/create/id/30', 0, 0, '2016-03-21 08:19:49', 2),
(77, 0, 13, 'Link visited: /admin/website/slider/create/id/30', 5, 0, '2016-03-21 08:44:00', 2),
(78, 0, 13, 'Link visited: /admin/website/slider/create/id/30', 1, 0, '2016-03-21 08:45:27', 2),
(79, 0, 13, 'Link visited: /admin/website/slider/create/id/30', 1, 0, '2016-03-21 08:46:01', 2),
(80, 0, 13, 'Link visited: /admin/website/slider/create/id/30', 4, 0, '2016-03-21 08:49:45', 2),
(81, 0, 13, 'Link visited: /admin/website/slider/create/id/30', 5, 0, '2016-03-21 09:01:43', 2),
(82, 0, 13, 'Link visited: /admin/website/slider/create/id/30', 0, 0, '2016-03-21 09:01:53', 2),
(83, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=l4pvt08p2on7b0nmn4cu9arai1&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=who_are_we.png', 0, 0, '2016-03-21 09:02:08', 2),
(84, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=l4pvt08p2on7b0nmn4cu9arai1&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=consumer-visitor.png', 0, 0, '2016-03-21 09:02:14', 2),
(85, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=l4pvt08p2on7b0nmn4cu9arai1&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=invention-funding.png', 0, 0, '2016-03-21 09:02:39', 2),
(86, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=l4pvt08p2on7b0nmn4cu9arai1&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=video-tutorials.png', 0, 0, '2016-03-21 09:02:45', 2),
(87, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=l4pvt08p2on7b0nmn4cu9arai1&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=public-opinion.png', 0, 0, '2016-03-21 09:02:50', 2),
(88, 0, 13, 'Link visited: /admin/website/slider/create/id/30', 2, 0, '2016-03-21 09:04:36', 2),
(89, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:04:36', 2),
(90, 0, 13, 'Link visited: /admin/website/slider?rows=50', 1, 0, '2016-03-21 09:05:35', 2),
(91, 0, 13, 'Link visited: /admin/website/slider/create/id/24', 0, 0, '2016-03-21 09:05:38', 2),
(92, 0, 13, 'Link visited: /admin/website/slider/create/id/24', 0, 0, '2016-03-21 09:05:47', 2),
(93, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:05:47', 2),
(94, 0, 13, 'Link visited: /admin/website/slider?rows=50', 0, 0, '2016-03-21 09:05:51', 2),
(95, 0, 13, 'Link visited: /admin/website/slider/create/id/22', 0, 0, '2016-03-21 09:05:54', 2),
(96, 0, 13, 'Link visited: /admin/website/slider/create/id/22', 0, 0, '2016-03-21 09:06:00', 2),
(97, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:06:00', 2),
(98, 0, 13, 'Link visited: /admin/website/slider?rows=50', 0, 0, '2016-03-21 09:06:04', 2),
(99, 0, 13, 'Link visited: /admin/website/slider/create/id/27', 0, 0, '2016-03-21 09:06:07', 2),
(100, 0, 13, 'Link visited: /admin/website/slider/create/id/27', 0, 0, '2016-03-21 09:06:14', 2),
(101, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:06:14', 2),
(102, 0, 13, 'Link visited: /admin/website/slider?rows=50', 0, 0, '2016-03-21 09:06:19', 2),
(103, 0, 13, 'Link visited: /admin/website/slider/create/id/28', 0, 0, '2016-03-21 09:06:22', 2),
(104, 0, 13, 'Link visited: /admin/website/slider/create/id/28', 0, 0, '2016-03-21 09:06:27', 2),
(105, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:06:28', 2),
(106, 0, 13, 'Link visited: /admin/website/slider?rows=50', 0, 0, '2016-03-21 09:06:31', 2),
(107, 0, 13, 'Link visited: /admin/website/slider/create/id/29', 0, 0, '2016-03-21 09:06:38', 2),
(108, 0, 13, 'Link visited: /admin/website/slider/create/id/29', 1, 0, '2016-03-21 09:07:10', 2),
(109, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:07:10', 2),
(110, 0, 13, 'Link visited: /admin/website/slider/create/id/55', 0, 0, '2016-03-21 09:07:13', 2),
(111, 0, 13, 'Link visited: /admin/website/slider/create/id/55', 0, 0, '2016-03-21 09:07:20', 2),
(112, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:07:20', 2),
(113, 0, 13, 'Link visited: /admin/website/slider/create/id/54', 0, 0, '2016-03-21 09:07:22', 2),
(114, 0, 13, 'Link visited: /admin/website/slider/create/id/54', 0, 0, '2016-03-21 09:07:27', 2),
(115, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:07:27', 2),
(116, 0, 13, 'Link visited: /admin/website/slider/create/id/53', 0, 0, '2016-03-21 09:07:29', 2),
(117, 0, 13, 'Link visited: /admin/website/slider/create/id/53', 0, 0, '2016-03-21 09:07:35', 2),
(118, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:07:35', 2),
(119, 0, 13, 'Link visited: /admin/website/slider/create/id/52', 0, 0, '2016-03-21 09:07:37', 2),
(120, 0, 13, 'Link visited: /admin/website/slider/create/id/52', 0, 0, '2016-03-21 09:07:42', 2),
(121, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:07:42', 2),
(122, 0, 13, 'Link visited: /admin/website/slider/create/id/46', 0, 0, '2016-03-21 09:07:44', 2),
(123, 0, 13, 'Link visited: /admin/website/slider/create/id/46', 0, 0, '2016-03-21 09:07:48', 2),
(124, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:07:48', 2),
(125, 0, 13, 'Link visited: /admin/website/slider/create/id/45', 0, 0, '2016-03-21 09:07:51', 2),
(126, 0, 13, 'Link visited: /admin/website/slider/create/id/45', 0, 0, '2016-03-21 09:07:55', 2),
(127, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:07:55', 2),
(128, 0, 13, 'Link visited: /admin/website/slider/create/id/44', 0, 0, '2016-03-21 09:07:58', 2),
(129, 0, 13, 'Link visited: /admin/website/slider/create/id/44', 0, 0, '2016-03-21 09:08:11', 2),
(130, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:08:11', 2),
(131, 0, 13, 'Link visited: /admin/website/slider/create/id/38', 0, 0, '2016-03-21 09:08:15', 2),
(132, 0, 13, 'Link visited: /admin/website/slider/create/id/38', 0, 0, '2016-03-21 09:08:20', 2),
(133, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:08:20', 2),
(134, 0, 13, 'Link visited: /admin/website/slider/create/id/37', 0, 0, '2016-03-21 09:08:22', 2),
(135, 0, 13, 'Link visited: /admin/website/slider/create/id/37', 0, 0, '2016-03-21 09:08:27', 2),
(136, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:08:27', 2),
(137, 0, 13, 'Link visited: /admin/website/slider?rows=50', 0, 0, '2016-03-21 09:08:39', 2),
(138, 0, 13, 'Link visited: /admin/website/slider/create/id/36', 0, 0, '2016-03-21 09:08:42', 2),
(139, 0, 13, 'Link visited: /admin/website/slider/create/id/36', 0, 0, '2016-03-21 09:08:46', 2),
(140, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:08:46', 2),
(141, 0, 13, 'Link visited: /admin/website/slider/create/id/55', 0, 0, '2016-03-21 09:08:50', 2),
(142, 0, 13, 'Link visited: /admin/website/slider/create/id/55', 0, 0, '2016-03-21 09:08:57', 2),
(143, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:08:57', 2),
(144, 0, 13, 'Link visited: /admin/website/slider/create/id/55', 0, 0, '2016-03-21 09:08:59', 2),
(145, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=l4pvt08p2on7b0nmn4cu9arai1&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=who_are_we.png', 0, 0, '2016-03-21 09:09:15', 2),
(146, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=l4pvt08p2on7b0nmn4cu9arai1&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=consumer-visitor.png', 0, 0, '2016-03-21 09:09:25', 2),
(147, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=l4pvt08p2on7b0nmn4cu9arai1&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=invention-funding.png', 0, 0, '2016-03-21 09:09:31', 2),
(148, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=l4pvt08p2on7b0nmn4cu9arai1&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=video-tutorials.png', 0, 0, '2016-03-21 09:09:36', 2),
(149, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=l4pvt08p2on7b0nmn4cu9arai1&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=public-opinion.png', 0, 0, '2016-03-21 09:09:41', 2),
(150, 0, 13, 'Link visited: /admin/website/slider/create/id/55', 4, 0, '2016-03-21 09:13:15', 2),
(151, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:13:15', 2),
(152, 0, 13, 'Link visited: /admin/website/slider/create/id/55', 0, 0, '2016-03-21 09:13:18', 2),
(153, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:13:45', 2),
(154, 0, 13, 'Link visited: /admin/website/slider?rows=50', 0, 0, '2016-03-21 09:13:49', 2),
(155, 0, 13, 'Link visited: /admin/website/slider/create/id/24', 0, 0, '2016-03-21 09:13:53', 2),
(156, 0, 13, 'Link visited: /admin/website', 5, 0, '2016-03-21 09:56:12', 2),
(157, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:56:15', 2),
(158, 0, 13, 'Link visited: /admin/website/slider?rows=50', 0, 0, '2016-03-21 09:56:20', 2),
(159, 0, 13, 'Link visited: /admin/website/slider/create/id/24', 0, 0, '2016-03-21 09:56:23', 2),
(160, 0, 13, 'Link visited: /admin/website/slider/create/id/24', 1, 0, '2016-03-21 09:57:12', 2),
(161, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:57:12', 2),
(162, 0, 13, 'Link visited: /admin/website/slider?rows=50', 0, 0, '2016-03-21 09:57:18', 2),
(163, 0, 13, 'Link visited: /admin/website/slider/create/id/22', 0, 0, '2016-03-21 09:57:26', 2),
(164, 0, 13, 'Link visited: /admin/website/slider/create/id/22', 1, 0, '2016-03-21 09:58:15', 2),
(165, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:58:15', 2),
(166, 0, 13, 'Link visited: /admin/website/slider?rows=50', 0, 0, '2016-03-21 09:58:19', 2),
(167, 0, 13, 'Link visited: /admin/website/slider/create/id/27', 0, 0, '2016-03-21 09:58:23', 2),
(168, 0, 13, 'Link visited: /admin/website/slider/create/id/27', 1, 0, '2016-03-21 09:59:15', 2),
(169, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 09:59:15', 2),
(170, 0, 13, 'Link visited: /admin/website/slider/create/id/55', 0, 0, '2016-03-21 09:59:18', 2),
(171, 0, 13, 'Link visited: /admin/website/slider/create/id/55', 1, 0, '2016-03-21 10:00:11', 2),
(172, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 10:00:11', 2),
(173, 0, 13, 'Link visited: /admin/website/slider/create/id/54', 0, 0, '2016-03-21 10:00:15', 2),
(174, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=who_are_we.png', 0, 0, '2016-03-21 10:00:22', 2),
(175, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=consumer-visitor.png', 0, 0, '2016-03-21 10:00:31', 2),
(176, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=invention-funding.png', 0, 0, '2016-03-21 10:00:40', 2),
(177, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=video-tutorials.png', 0, 0, '2016-03-21 10:00:47', 2),
(178, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=public-opinion.png', 0, 0, '2016-03-21 10:00:53', 2),
(179, 0, 13, 'Link visited: /admin/website/slider/create/id/54', 1, 0, '2016-03-21 10:02:15', 2),
(180, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 10:02:15', 2),
(181, 0, 13, 'Link visited: /admin/website/slider/create/id/54', 0, 0, '2016-03-21 10:02:22', 2),
(182, 0, 13, 'Link visited: /admin/website/slider/index', 0, 0, '2016-03-21 10:02:26', 2),
(183, 0, 13, 'Link visited: /admin/website/slider/create/id/53', 0, 0, '2016-03-21 10:02:29', 2),
(184, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=who_are_we.png', 0, 0, '2016-03-21 10:02:55', 2),
(185, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=consumer-visitor.png', 0, 0, '2016-03-21 10:03:05', 2),
(186, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=invention-funding.png', 0, 0, '2016-03-21 10:03:14', 2),
(187, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=video-tutorials.png', 0, 0, '2016-03-21 10:03:19', 2),
(188, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=public-opinion.png', 0, 0, '2016-03-21 10:03:24', 2),
(189, 0, 13, 'Link visited: /admin/website/slider/create/id/53', 2, 0, '2016-03-21 10:04:59', 2),
(190, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 10:04:59', 2),
(191, 0, 13, 'Link visited: /admin/website/slider/create/id/52', 0, 0, '2016-03-21 10:05:02', 2),
(192, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=who_are_we.png', 0, 0, '2016-03-21 10:05:08', 2),
(193, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=consumer-visitor.png', 0, 0, '2016-03-21 10:05:15', 2),
(194, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=invention-funding.png', 0, 0, '2016-03-21 10:05:31', 2),
(195, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=video-tutorials.png', 0, 0, '2016-03-21 10:05:37', 2),
(196, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=public-opinion.png', 0, 0, '2016-03-21 10:05:43', 2),
(197, 0, 13, 'Link visited: /admin/website/slider/create/id/52', 2, 0, '2016-03-21 10:07:36', 2),
(198, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 10:07:36', 2),
(199, 0, 13, 'Link visited: /admin/website/slider/create/id/46', 0, 0, '2016-03-21 10:07:39', 2),
(200, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=who_are_we.png', 0, 0, '2016-03-21 10:07:45', 2),
(201, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=consumer-visitor.png', 0, 0, '2016-03-21 10:07:53', 2),
(202, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=invention-funding.png', 0, 0, '2016-03-21 10:07:58', 2),
(203, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=video-tutorials.png', 0, 0, '2016-03-21 10:08:01', 2),
(204, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=public-opinion.png', 0, 0, '2016-03-21 10:08:11', 2),
(205, 0, 13, 'Link visited: /admin/website/slider/create/id/46', 2, 0, '2016-03-21 10:09:46', 2),
(206, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 10:09:46', 2),
(207, 0, 13, 'Link visited: /admin/website/slider/create/id/45', 0, 0, '2016-03-21 10:09:49', 2),
(208, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=who_are_we.png', 0, 0, '2016-03-21 10:10:07', 2),
(209, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=consumer-visitor.png', 0, 0, '2016-03-21 10:10:13', 2),
(210, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=invention-funding.png', 0, 0, '2016-03-21 10:10:24', 2),
(211, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=video-tutorials.png', 0, 0, '2016-03-21 10:10:37', 2),
(212, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=public-opinion.png', 0, 0, '2016-03-21 10:10:51', 2),
(213, 0, 13, 'Link visited: /admin/website/slider/create/id/45', 2, 0, '2016-03-21 10:12:57', 2),
(214, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 10:12:57', 2),
(215, 0, 13, 'Link visited: /admin/website/slider/create/id/45', 0, 0, '2016-03-21 10:13:02', 2),
(216, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 10:13:03', 2),
(217, 0, 13, 'Link visited: /admin/website/slider/create/id/44', 0, 0, '2016-03-21 10:13:06', 2),
(218, 0, 13, 'Link visited: /admin/website/slider/create/id/44', 1, 0, '2016-03-21 10:13:36', 2),
(219, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 10:13:36', 2),
(220, 0, 13, 'Link visited: /admin/website/slider/create/id/46', 0, 0, '2016-03-21 10:13:40', 2),
(221, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 10:13:44', 2),
(222, 0, 13, 'Link visited: /admin/website/slider/create/id/45', 0, 0, '2016-03-21 10:13:46', 2),
(223, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 10:13:53', 2),
(224, 0, 13, 'Link visited: /admin/website/slider/create/id/44', 0, 0, '2016-03-21 10:13:55', 2),
(225, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 10:14:02', 2),
(226, 0, 13, 'Link visited: /admin/website/slider/create/id/42', 0, 0, '2016-03-21 10:14:04', 2),
(227, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=who_are_we.png', 0, 0, '2016-03-21 10:14:12', 2),
(228, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=consumer-visitor.png', 0, 0, '2016-03-21 10:14:16', 2),
(229, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=invention-funding.png', 0, 0, '2016-03-21 10:14:21', 2),
(230, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=video-tutorials.png', 0, 0, '2016-03-21 10:14:25', 2),
(231, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=public-opinion.png', 0, 0, '2016-03-21 10:14:30', 2),
(232, 0, 13, 'Link visited: /admin/website/slider/create/id/42', 1, 0, '2016-03-21 10:15:53', 2),
(233, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 10:15:54', 2),
(234, 0, 13, 'Link visited: /admin/website/slider/create/id/42', 0, 0, '2016-03-21 10:16:01', 2),
(235, 0, 13, 'Link visited: /admin/website/slider/index', 0, 0, '2016-03-21 10:16:06', 2),
(236, 0, 13, 'Link visited: /admin/website/slider/create/id/38', 0, 0, '2016-03-21 10:16:09', 2),
(237, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=who_are_we.png', 0, 0, '2016-03-21 10:16:14', 2),
(238, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=consumer-visitor.png', 0, 0, '2016-03-21 10:16:22', 2),
(239, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=invention-funding.png', 0, 0, '2016-03-21 10:16:32', 2),
(240, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=video-tutorials.png', 0, 0, '2016-03-21 10:16:39', 2),
(241, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=public-opinion.png', 0, 0, '2016-03-21 10:16:44', 2),
(242, 0, 13, 'Link visited: /admin/website/slider/create/id/38', 1, 0, '2016-03-21 10:18:13', 2),
(243, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 10:18:13', 2),
(244, 0, 13, 'Link visited: /admin/website/slider/index/page/2', 1, 0, '2016-03-21 10:19:04', 2),
(245, 0, 13, 'Link visited: /admin/website/slider/create/id/36', 0, 0, '2016-03-21 10:19:07', 2),
(246, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=who_are_we.png', 0, 0, '2016-03-21 10:19:20', 2),
(247, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=consumer-visitor.png', 0, 0, '2016-03-21 10:19:26', 2),
(248, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=invention-funding.png', 0, 0, '2016-03-21 10:19:33', 2),
(249, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=video-tutorials.png', 0, 0, '2016-03-21 10:19:42', 2),
(250, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=public-opinion.png', 0, 0, '2016-03-21 10:19:48', 2),
(251, 0, 13, 'Link visited: /admin/website/slider/create/id/36', 2, 0, '2016-03-21 10:21:27', 2),
(252, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 10:21:27', 2),
(253, 0, 13, 'Link visited: /admin/website/slider/index/page/2', 0, 0, '2016-03-21 10:21:39', 2),
(254, 0, 13, 'Link visited: /admin/website/slider/create/id/35', 0, 0, '2016-03-21 10:21:42', 2),
(255, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=who_are_we.png', 5, 0, '2016-03-21 10:46:00', 2),
(256, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=consumer-visitor.png', 0, 0, '2016-03-21 10:46:07', 2),
(257, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=invention-funding.png', 0, 0, '2016-03-21 10:46:12', 2),
(258, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=video-tutorials.png', 0, 0, '2016-03-21 10:46:15', 2),
(259, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=public-opinion.png', 0, 0, '2016-03-21 10:46:20', 2),
(260, 0, 13, 'Link visited: /admin/website/slider/create/id/35', 1, 0, '2016-03-21 10:47:35', 2),
(261, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 10:47:35', 2),
(262, 0, 13, 'Link visited: /admin/website/slider/index/page/2', 0, 0, '2016-03-21 10:47:39', 2),
(263, 0, 13, 'Link visited: /admin/website/slider/create/id/34', 0, 0, '2016-03-21 10:47:41', 2),
(264, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=who_are_we.png', 0, 0, '2016-03-21 10:47:50', 2),
(265, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=consumer-visitor.png', 0, 0, '2016-03-21 10:47:56', 2),
(266, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=invention-funding.png', 0, 0, '2016-03-21 10:48:02', 2),
(267, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=video-tutorials.png', 0, 0, '2016-03-21 10:48:09', 2),
(268, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=public-opinion.png', 0, 0, '2016-03-21 10:48:21', 2),
(269, 0, 13, 'Link visited: /admin/website/slider/create/id/34', 1, 0, '2016-03-21 10:49:46', 2),
(270, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 10:49:46', 2),
(271, 0, 13, 'Link visited: /admin/website/slider/index/page/2', 0, 0, '2016-03-21 10:49:49', 2),
(272, 0, 13, 'Link visited: /admin/website/slider/create/id/33', 0, 0, '2016-03-21 10:49:51', 2),
(273, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=who_are_we.png', 0, 0, '2016-03-21 10:50:00', 2),
(274, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=consumer-visitor.png', 0, 0, '2016-03-21 10:50:04', 2),
(275, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=invention-funding.png', 0, 0, '2016-03-21 10:50:11', 2),
(276, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=video-tutorials.png', 0, 0, '2016-03-21 10:50:19', 2),
(277, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=public-opinion.png', 0, 0, '2016-03-21 10:50:28', 2),
(278, 0, 13, 'Link visited: /admin/website/slider/create/id/33', 1, 0, '2016-03-21 10:51:54', 2),
(279, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 10:51:54', 2),
(280, 0, 13, 'Link visited: /admin/website/slider/index/page/2', 0, 0, '2016-03-21 10:51:57', 2),
(281, 0, 13, 'Link visited: /admin/website/slider/create/id/32', 0, 0, '2016-03-21 10:51:59', 2),
(282, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=who_are_we.png', 0, 0, '2016-03-21 10:52:05', 2),
(283, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=consumer-visitor.png', 0, 0, '2016-03-21 10:52:10', 2),
(284, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=invention-funding.png', 0, 0, '2016-03-21 10:52:17', 2),
(285, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=video-tutorials.png', 0, 0, '2016-03-21 10:52:27', 2),
(286, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=public-opinion.png', 0, 0, '2016-03-21 10:52:50', 2),
(287, 0, 13, 'Link visited: /admin/website/slider/create/id/32', 1, 0, '2016-03-21 10:53:46', 2),
(288, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 10:53:46', 2),
(289, 0, 13, 'Link visited: /admin/website/slider/index/page/2', 0, 0, '2016-03-21 10:53:52', 2),
(290, 0, 13, 'Link visited: /admin/website/slider/create/id/31', 0, 0, '2016-03-21 10:53:56', 2),
(291, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=who_are_we.png', 0, 0, '2016-03-21 10:54:03', 2),
(292, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=consumer-visitor.png', 0, 0, '2016-03-21 10:54:08', 2),
(293, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=invention-funding.png', 0, 0, '2016-03-21 10:54:14', 2),
(294, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=video-tutorials.png', 0, 0, '2016-03-21 10:54:26', 2),
(295, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=public-opinion.png', 0, 0, '2016-03-21 10:54:35', 2),
(296, 0, 13, 'Link visited: /admin/website/slider/create/id/31', 1, 0, '2016-03-21 10:55:44', 2),
(297, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 10:55:44', 2),
(298, 0, 13, 'Link visited: /admin/website/slider/index/page/2', 0, 0, '2016-03-21 10:55:47', 2),
(299, 0, 13, 'Link visited: /admin/website/slider/create/id/30', 0, 0, '2016-03-21 10:55:50', 2),
(300, 0, 13, 'Link visited: /admin/website/slider/create/id/30', 0, 0, '2016-03-21 10:56:19', 2),
(301, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 10:56:19', 2),
(302, 0, 13, 'Link visited: /admin/website/slider/index/page/2', 0, 0, '2016-03-21 10:56:23', 2),
(303, 0, 13, 'Link visited: /admin/website/slider/create/id/29', 0, 0, '2016-03-21 10:56:27', 2),
(304, 0, 13, 'Link visited: /admin/website/slider/create/id/29', 0, 0, '2016-03-21 10:56:49', 2),
(305, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 10:56:50', 2),
(306, 0, 13, 'Link visited: /admin/website/slider/index/page/2', 0, 0, '2016-03-21 10:56:53', 2),
(307, 0, 13, 'Link visited: /admin/website/slider/create/id/28', 0, 0, '2016-03-21 10:56:57', 2),
(308, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=who_are_we.png', 0, 0, '2016-03-21 10:57:04', 2),
(309, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=consumer-visitor.png', 0, 0, '2016-03-21 10:57:10', 2),
(310, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=invention-funding.png', 0, 0, '2016-03-21 10:57:17', 2),
(311, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=video-tutorials.png', 0, 0, '2016-03-21 10:57:26', 2),
(312, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=v9nc68fn4e85dspgtgks7uin73&YII_CSRF_TOKEN=6aefa80ee37a9c3f7ddc7e4a6c1f49955b3af0e0&qqfile=public-opinion.png', 0, 0, '2016-03-21 10:57:35', 2),
(313, 0, 13, 'Link visited: /admin/website/slider/create/id/28', 1, 0, '2016-03-21 10:58:33', 2),
(314, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 10:58:34', 2),
(315, 0, 13, 'Link visited: /admin/website/slider/index/page/2', 0, 0, '2016-03-21 10:58:40', 2),
(316, 0, 13, 'Link visited: /admin/website/slider/index/page/3', 0, 0, '2016-03-21 10:59:04', 2),
(317, 0, 13, 'Link visited: /admin/website/slider/index/page/2', 0, 0, '2016-03-21 10:59:09', 2),
(318, 0, 13, 'Link visited: /admin/website/slider/create/id/27', 5, 0, '2016-03-21 11:05:39', 2),
(319, 0, 13, 'Link visited: /admin/website/slider/index', 0, 0, '2016-03-21 11:05:45', 2),
(320, 0, 13, 'Link visited: /admin/website/slider/index/page/2', 0, 0, '2016-03-21 11:05:47', 2),
(321, 0, 13, 'Link visited: /admin/website/slider/index/page/3', 0, 0, '2016-03-21 11:05:50', 2),
(322, 0, 13, 'Link visited: /admin/website/slider/create/id/22', 0, 0, '2016-03-21 11:05:53', 2),
(323, 0, 13, 'Link visited: /admin/website/slider/index', 0, 0, '2016-03-21 11:06:04', 2),
(324, 0, 13, 'Link visited: /admin/website/defaultbanners', 5, 0, '2016-03-21 11:13:22', 2),
(325, 0, 13, 'Link visited: /admin/website/defaultBanners/publish', 2, 0, '2016-03-21 11:15:20', 2),
(326, 0, 13, 'Link visited: /admin/website/defaultBanners/uploadAttachement', 0, 0, '2016-03-21 11:15:20', 2),
(327, 0, 13, 'Link visited: /admin/website/defaultbanners', 0, 0, '2016-03-21 11:15:20', 2),
(328, 0, 13, 'Link visited: /admin/website', 5, 0, '2016-03-21 11:35:22', 2),
(329, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 11:35:26', 2),
(330, 0, 13, 'Link visited: /admin/website/slider/create/id/37', 0, 0, '2016-03-21 11:35:30', 2),
(331, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=lkpdspdqrkpejt85054j4v04f2&YII_CSRF_TOKEN=cbf8880c8372b88839066610f8f1ec45c89322df&qqfile=who_are_we.png', 0, 0, '2016-03-21 11:35:59', 2),
(332, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=lkpdspdqrkpejt85054j4v04f2&YII_CSRF_TOKEN=cbf8880c8372b88839066610f8f1ec45c89322df&qqfile=consumer-visitor.png', 0, 0, '2016-03-21 11:36:03', 2),
(333, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=lkpdspdqrkpejt85054j4v04f2&YII_CSRF_TOKEN=cbf8880c8372b88839066610f8f1ec45c89322df&qqfile=invention-funding.png', 0, 0, '2016-03-21 11:36:15', 2),
(334, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=lkpdspdqrkpejt85054j4v04f2&YII_CSRF_TOKEN=cbf8880c8372b88839066610f8f1ec45c89322df&qqfile=video-tutorials.png', 0, 0, '2016-03-21 11:36:24', 2),
(335, 0, 13, 'Link visited: /admin/website/slider/listingimage?PHPSESSID=lkpdspdqrkpejt85054j4v04f2&YII_CSRF_TOKEN=cbf8880c8372b88839066610f8f1ec45c89322df&qqfile=public-opinion.png', 0, 0, '2016-03-21 11:36:29', 2),
(336, 0, 13, 'Link visited: /admin/website/slider/create/id/37', 3, 0, '2016-03-21 11:39:35', 2),
(337, 0, 13, 'Link visited: /admin/website/slider', 0, 0, '2016-03-21 11:39:35', 2),
(338, 1, 13, 'Link visited: /login', 0, 0, '2016-03-21 12:07:02', 0),
(339, 1, 13, 'Link visited: /', 0, 0, '2016-03-21 12:07:02', 0),
(340, 1, 13, 'Link visited: /user/myaccount/update', 0, 0, '2016-03-21 12:07:04', 0),
(341, 1, 12, 'User is Idle!', 4, 4, '2016-03-21 12:11:27', 0),
(342, 1, 13, 'Link visited: /', 0, 4, '2016-03-21 12:11:42', 0),
(343, 1, 13, 'Link visited: /user/myaccount/update', 0, 0, '2016-03-21 12:11:45', 0),
(344, 1, 13, 'Link visited: /user/myaccount/uploadprofileimage?PHPSESSID=ms4qhtm3q814jlii6906472fq2&YII_CSRF_TOKEN=cbf8880c8372b88839066610f8f1ec45c89322df&qqfile=jag_avatar+2.jpg', 0, 0, '2016-03-21 12:12:08', 0),
(345, 1, 14, 'User logged out!', 0, 0, '2016-03-21 12:12:23', 0),
(346, 2, 13, 'Link visited: /login', 0, 0, '2016-03-21 12:29:04', 0),
(347, 2, 13, 'Link visited: /', 0, 0, '2016-03-21 12:29:04', 0),
(348, 2, 13, 'Link visited: /user/myaccount/update', 0, 0, '2016-03-21 12:29:06', 0),
(349, 2, 13, 'Link visited: /user/myaccount/uploadprofileimage?PHPSESSID=gngrvr2n8sduik653jcfno1ql6&YII_CSRF_TOKEN=cbf8880c8372b88839066610f8f1ec45c89322df&qqfile=profile.png', 0, 0, '2016-03-21 12:29:13', 0),
(350, 2, 14, 'User logged out!', 0, 0, '2016-03-21 12:29:21', 0),
(351, 3, 13, 'Link visited: /login', 0, 0, '2016-03-21 12:49:48', 0),
(352, 3, 13, 'Link visited: /', 0, 0, '2016-03-21 12:49:48', 0),
(353, 3, 13, 'Link visited: /user/myaccount/update', 0, 0, '2016-03-21 12:49:51', 0),
(354, 3, 13, 'Link visited: /user/myaccount/uploadprofileimage?PHPSESSID=huiebl77o96klvl1bkungdlj16&YII_CSRF_TOKEN=cbf8880c8372b88839066610f8f1ec45c89322df&qqfile=images.jpg', 0, 0, '2016-03-21 12:49:58', 0),
(355, 3, 14, 'User logged out!', 0, 0, '2016-03-21 12:50:08', 0),
(356, 4, 13, 'Link visited: /login', 0, 0, '2016-03-21 15:09:34', 0),
(357, 4, 13, 'Link visited: /', 0, 0, '2016-03-21 15:09:34', 0),
(358, 4, 13, 'Link visited: /user/myaccount/update', 0, 0, '2016-03-21 15:09:37', 0),
(359, 4, 14, 'User logged out!', 0, 0, '2016-03-21 15:09:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_default_addresses`
--

CREATE TABLE `user_default_addresses` (
  `user_default_address_id` int(11) NOT NULL,
  `user_default_address1` varchar(255) NOT NULL,
  `user_default_address2` varchar(255) NOT NULL,
  `user_default_address3` varchar(255) NOT NULL,
  `user_default_town` varchar(100) NOT NULL,
  `user_default_county` varchar(100) NOT NULL,
  `user_default_country` varchar(100) NOT NULL,
  `user_default_zip` varchar(15) NOT NULL,
  `user_default_profile_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User can have many addresses';

--
-- Dumping data for table `user_default_addresses`
--

INSERT INTO `user_default_addresses` (`user_default_address_id`, `user_default_address1`, `user_default_address2`, `user_default_address3`, `user_default_town`, `user_default_county`, `user_default_country`, `user_default_zip`, `user_default_profile_id`) VALUES
(1, '', '', '', '', '', '232', '', 1),
(2, '', '', '', '', '', '232', '', 2),
(3, '', '', '', '', '', '232', '', 3),
(4, '', '', '', '', '', '232', '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_default_adminuser`
--

CREATE TABLE `user_default_adminuser` (
  `user_id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 = default admin,1 = super admin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_adminuser`
--

INSERT INTO `user_default_adminuser` (`user_id`, `username`, `password`, `email`, `status`) VALUES
(1, 'Superadmin', '7a5cb1db77d2fac3cbb20d1ad266f3c5', 'jag@businessinvention.com', 1),
(2, 'jag', '066c9ce605fb4db52f640dca1f75e67c', 'dsp7@blueyonder.co.uk', 1),
(3, 'guest', '691697c652d418b21a94e57912755edf', 'dsp7@blueyonder.co.uk', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_default_banner_ads`
--

CREATE TABLE `user_default_banner_ads` (
  `user_default_listing_banner_id` int(11) NOT NULL,
  `user_default_id` int(11) NOT NULL,
  `user_default_listing_banner_submission_date` date NOT NULL,
  `user_default_listing_banner_path` varchar(100) NOT NULL,
  `user_default_listing_banner_duration` time NOT NULL,
  `user_default_listing_banner_cost` decimal(10,2) NOT NULL,
  `user_default_listing_banner_status` enum('1','0') NOT NULL DEFAULT '1' COMMENT '0=period expired    1=active',
  `user_default_listing_banner_link` varchar(100) NOT NULL,
  `user_default_listing_banner_clicks` int(11) NOT NULL,
  `user_default_listing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_default_banner_ads`
--

INSERT INTO `user_default_banner_ads` (`user_default_listing_banner_id`, `user_default_id`, `user_default_listing_banner_submission_date`, `user_default_listing_banner_path`, `user_default_listing_banner_duration`, `user_default_listing_banner_cost`, `user_default_listing_banner_status`, `user_default_listing_banner_link`, `user_default_listing_banner_clicks`, `user_default_listing_id`) VALUES
(2, 86, '2015-11-23', 'banner-images/banners_users/jats_86/imageedit_1_6688546441-2015-11-23-10-55-42.png', '336:56:53', 5.60, '0', '', 1, 62);

-- --------------------------------------------------------

--
-- Table structure for table `user_default_business`
--

CREATE TABLE `user_default_business` (
  `user_default_business_id` int(11) NOT NULL,
  `user_default_business_first_name` varchar(50) NOT NULL,
  `user_default_business_surname` varchar(50) NOT NULL,
  `user_default_business_email` varchar(50) NOT NULL,
  `user_default_business_username` varchar(50) NOT NULL,
  `user_default_business_pass` varchar(50) NOT NULL,
  `user_default_business_image` varchar(500) NOT NULL,
  `user_default_business_phone` varchar(30) NOT NULL,
  `user_default_business_gender` varchar(10) NOT NULL,
  `user_default_business_dob` date NOT NULL,
  `user_default_business_question` varchar(500) NOT NULL,
  `user_default_business_answer` varchar(200) NOT NULL,
  `user_default_business_pstatus` varchar(100) NOT NULL,
  `user_default_business_notes` text NOT NULL,
  `user_default_business_rdate` date NOT NULL,
  `user_default_business_ltime` datetime NOT NULL,
  `user_default_business_ip` varchar(100) NOT NULL,
  `user_default_business_status` varchar(2) NOT NULL COMMENT 'Y=Activate , N=Suspend',
  `user_default_business_currency` int(11) NOT NULL,
  `user_default_business_slogon` varchar(100) NOT NULL,
  `user_default_business_title` varchar(100) NOT NULL,
  `user_default_business_fax` varchar(100) NOT NULL,
  `user_default_business_website` varchar(100) NOT NULL,
  `user_default_business_name` varchar(100) NOT NULL,
  `user_default_business_sector` int(11) NOT NULL,
  `user_default_business_user_type` varchar(50) NOT NULL,
  `user_default_business_verifycode` varchar(100) NOT NULL,
  `user_default_business_active_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_business_account_balance`
--

CREATE TABLE `user_default_business_account_balance` (
  `business_user_account_balance_id` int(11) NOT NULL,
  `business_user_account_balance_user_id` int(11) NOT NULL,
  `business_user_account_balance_account_balance` decimal(10,4) NOT NULL,
  `business_user_account_balance_currency_code` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_business_addresses`
--

CREATE TABLE `user_default_business_addresses` (
  `user_default_business_addr_id` int(11) NOT NULL,
  `user_default_business_id` int(11) NOT NULL,
  `user_default_business_addr1` varchar(500) NOT NULL,
  `user_default_business_addr2` varchar(500) NOT NULL,
  `user_default_business_addr3` varchar(500) NOT NULL,
  `user_default_business_town` varchar(100) NOT NULL,
  `user_default_business_county` varchar(200) NOT NULL,
  `user_default_business_zip` varchar(50) NOT NULL,
  `user_default_business_country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_business_favourite_blisting`
--

CREATE TABLE `user_default_business_favourite_blisting` (
  `user_default_business_id` int(11) NOT NULL,
  `blisting_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_business_financial`
--

CREATE TABLE `user_default_business_financial` (
  `business_user_transaction_id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `business_user_transaction_type` tinytext NOT NULL,
  `business_user_transaction_details` text NOT NULL,
  `business_user_transaction_bank` varchar(50) NOT NULL,
  `business_user_transaction_date` date NOT NULL,
  `business_user_transaction_paid_out` decimal(10,2) NOT NULL,
  `business_user_transaction_paid_in` decimal(10,2) NOT NULL,
  `business_user_transaction_paypal_transactionId` varchar(255) NOT NULL,
  `business_user_transaction_balance` decimal(10,2) NOT NULL,
  `business_user_financial_transaction_withdraw_status` tinytext NOT NULL,
  `business_user_financial_transaction_currency_code` varchar(3) NOT NULL,
  `business_user_transaction_profile_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_business_listing`
--

CREATE TABLE `user_default_business_listing` (
  `user_default_business_blid` int(11) NOT NULL,
  `user_default_business_whatwecando` text NOT NULL,
  `user_default_business_id` int(11) NOT NULL,
  `user_default_business_title` varchar(50) NOT NULL,
  `user_default_business_category` varchar(50) NOT NULL,
  `user_default_business_profession` varchar(50) NOT NULL,
  `user_default_business_viewlimit` varchar(50) NOT NULL,
  `user_default_business_slogon` varchar(200) NOT NULL,
  `user_default_business_whoweare` text NOT NULL,
  `user_default_business_offer` varchar(500) NOT NULL,
  `user_default_business_keyword` text NOT NULL,
  `user_default_business_testimonial` text NOT NULL,
  `user_default_business_datetime` datetime NOT NULL,
  `user_default_business_status` varchar(50) NOT NULL,
  `user_default_business_lstatus` varchar(50) NOT NULL,
  `user_default_business_bapprovedate` datetime NOT NULL,
  `approved` tinyint(4) NOT NULL,
  `user_default_business_blistingstatus` int(11) NOT NULL COMMENT '0=pending,1=approve,2=suspend,3=delete,4=restore,5=permanent_delet',
  `user_default_business_bdeletedate` datetime NOT NULL,
  `user_default_business_breject_list` int(11) NOT NULL,
  `user_default_business_page_visit` int(11) NOT NULL,
  `user_default_business_last_page_visit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_business_listing_images`
--

CREATE TABLE `user_default_business_listing_images` (
  `user_default_business_image_id` int(11) NOT NULL,
  `user_default_business_listing_image` varchar(250) NOT NULL,
  `user_default_business_imgdesc` varchar(500) NOT NULL,
  `user_default_business_listing_link1` varchar(250) NOT NULL,
  `user_default_business_listing_link2` varchar(250) NOT NULL,
  `user_default_business_blid` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_business_listing_videos`
--

CREATE TABLE `user_default_business_listing_videos` (
  `user_default_business_video_id` int(11) NOT NULL,
  `user_default_business_videodesc` varchar(250) NOT NULL,
  `user_default_business_listing_video` varchar(500) NOT NULL,
  `user_default_business_listing_video_type` enum('0','1') NOT NULL COMMENT '0 - user introduction video\n1 - business idea video',
  `user_default_business_blid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_business_prize_points`
--

CREATE TABLE `user_default_business_prize_points` (
  `user_default_business_prize_points_id` int(11) NOT NULL,
  `user_default_business_blisting_points_purchased` int(11) NOT NULL,
  `user_default_business_blisting_points_cost` decimal(10,2) NOT NULL,
  `user_default_business_blisting_points_date` date NOT NULL,
  `user_default_business_blisting_points_time` time NOT NULL,
  `user_default_business_blisting_points_required` int(11) DEFAULT NULL,
  `user_default_business_blisting_points_user_id` int(11) NOT NULL,
  `user_default_business_blisting_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_business_profession`
--

CREATE TABLE `user_default_business_profession` (
  `list_profession_id` int(11) NOT NULL,
  `list_profession_name` varchar(100) NOT NULL,
  `list_profession_title` varchar(250) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_business_profession`
--

INSERT INTO `user_default_business_profession` (`list_profession_id`, `list_profession_name`, `list_profession_title`, `sort_order`) VALUES
(1, 'Accountancy', 'Select this if you are an Accountant', 0),
(2, 'Banking', 'Select this if you are offering banking services', 1),
(3, 'Business Angel', 'Select this if you are an investor', 2),
(4, 'Digital Media', 'Select this if you are offering Audio Visual services', 3),
(5, 'Electronics', 'Select this if you offer skills in electronics', 4),
(6, 'Engineering', 'Select this if you are offering engineering services', 5),
(7, 'Financial Services', 'Select this if you offer financial services', 6),
(8, 'Graphic Design', 'Select this if you offer skills in graphic design', 7),
(9, 'Modelling', 'Select this if you offer modelling services', 8),
(10, 'Patent Attorney', 'Select this if you are a patent attorney', 9),
(11, 'Solicitors / Attorneys', 'Select this if you are an attorney', 10),
(12, 'Web Design', 'Select this if you offer website design', 11);

-- --------------------------------------------------------

--
-- Table structure for table `user_default_contents`
--

CREATE TABLE `user_default_contents` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `desc` longtext NOT NULL,
  `parent` int(11) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_desc` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `page_seo` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `display_order` int(11) NOT NULL,
  `google_map` text NOT NULL,
  `display_map` tinyint(4) NOT NULL,
  `display_form` tinyint(1) NOT NULL,
  `editor_type` tinyint(1) NOT NULL COMMENT '0->basic,1->advanced',
  `created_date` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_contents`
--

INSERT INTO `user_default_contents` (`id`, `title`, `desc`, `parent`, `meta_title`, `meta_desc`, `meta_keywords`, `page_seo`, `status`, `display_order`, `google_map`, `display_map`, `display_form`, `editor_type`, `created_date`) VALUES
(1, 'Business Ideas', '<p>\r\n	Business Ideas coming soon.</p>\r\n', 0, 'Business Ideas', '\r\nBusiness Ideas coming soon\r\n', '', 'business-ideas', 1, 0, '', 0, 0, 0, 1406776567),
(2, 'Retail', '<p>\r\n	Retail coming soon</p>\r\n', 0, 'Retail', '\r\nRetail coming soon\r\n', '', 'retail', 1, 0, '', 0, 0, 0, 0),
(3, 'Industrial', '<p>\r\n	Industrial</p>\r\n', 0, 'Industrial', '\r\nIndustrial\r\n', '', 'industrial', 1, 0, '', 0, 0, 0, 0),
(4, 'Science & Technology', '<p>\r\n	Science &amp; Technology coming soon</p>\r\n', 0, 'Science & Tech', '\r\nScience amp Technology coming soon\r\n', '', 'science-technology', 1, 0, '', 0, 0, 0, 0),
(5, 'Terms & Privacy', '<p>\r\n	Terms &amp; Privacy coming soon.</p>\r\n', 0, 'Terms & Privacy', '\r\nTerms amp Privacy coming soon\r\n', '', 'terms-privacy', 1, 0, '', 0, 0, 0, 0),
(6, 'Support', '<p>\r\n	Coming soon.</p>\r\n', 0, 'Support', '\r\nComing soon\r\n', '', 'support', 1, 0, '', 0, 0, 0, 1408192017),
(7, 'F.A.Q.', '<table cellpadding="0" cellspacing="0" class="t0" height="352" style="margin-top: 14px; letter-spacing: normal; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px;" width="724">\r\n	<tbody>\r\n		<tr>\r\n			<td class="tr0 td0" style="padding: 0px; margin: 0px; width: 351px; vertical-align: bottom; height: 12px;">\r\n				<p class="p10 ft9" style="  color: rgb(165, 70, 134);  text-align: left; margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					<a class="heading" href="http://129.121.137.227/~busines2//index.php/site/page/getting-started-with-business-supermarketcom"><span style="font-size:16px;">Getting Started with businessinvention.com</span></a><a name="top"></a></p>\r\n			</td>\r\n			<td class="tr0 td1" style="padding: 0px; margin: 0px; width: 164px; vertical-align: bottom; height: 12px;">\r\n				<p class="p10 ft9" style=" color: rgb(165, 70, 134);  text-align: left; margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					<span style="font-size:16px;">Videos</span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td class="tr1 td0" style="padding: 0px; margin: 0px; width: 351px; vertical-align: bottom; height: 11px;">\r\n				<p class="p11 ft10" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					What is Business Supermarket.com?</p>\r\n			</td>\r\n			<td class="tr1 td1" style="padding: 0px; margin: 0px; width: 164px; vertical-align: bottom; height: 11px;">\r\n				<p class="p11 ft10" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					<a href="javascript:void(0);" onclick="show_video(\'http://youtu.be/GQvhj2-dh-c\');">Navigate the site</a></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td class="tr2 td0" style="padding: 0px; margin: 0px; width: 351px; vertical-align: bottom; height: 9px;">\r\n				<p class="p11 ft10" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					Do I need to register?</p>\r\n			</td>\r\n			<td class="tr2 td1" style="padding: 0px; margin: 0px; width: 164px; vertical-align: bottom; height: 9px;">\r\n				<p class="p11 ft10" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					<a href="javascript:void(0);" onclick="show_video(\'http://youtu.be/GQvhj2-dh-c\');">Submit a listing</a></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td class="tr3 td0" style="padding: 0px; margin: 0px; width: 351px; vertical-align: bottom; height: 10px;">\r\n				<p class="p11 ft11" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					What are the bene?ts of becoming a member?</p>\r\n			</td>\r\n			<td class="tr3 td1" style="padding: 0px; margin: 0px; width: 164px; vertical-align: bottom; height: 10px;">\r\n				<p class="p11 ft11" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					<a href="javascript:void(0);" onclick="show_video(\'http://youtu.be/GQvhj2-dh-c\');">Modify a listing</a></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td class="tr3 td0" style="padding: 0px; margin: 0px; width: 351px; vertical-align: bottom; height: 10px;">\r\n				<p class="p11 ft10" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					<a href="http://129.121.137.227/~busines2//index.php/site/page/getting-started-with-business-supermarketcom#offer-it">What Business Supermarket.com has to offer if:-</a></p>\r\n			</td>\r\n			<td class="tr3 td1" style="padding: 0px; margin: 0px; width: 164px; vertical-align: bottom; height: 10px;">\r\n				<p class="p11 ft10" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					<a href="javascript:void(0);" onclick="show_video(\'http://youtu.be/GQvhj2-dh-c\');">Access my marketing data</a></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td class="tr2 td0" style="padding: 0px; margin: 0px; width: 351px; vertical-align: bottom; height: 9px;">\r\n				<p class="p12 ft10" style="margin-top: 0px; margin-bottom: 0px; white-space: nowrap; text-align: center;">\r\n					<a href="#consumer">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; you ar a visitor.</a></p>\r\n			</td>\r\n			<td class="tr2 td1" style="padding: 0px; margin: 0px; width: 164px; vertical-align: bottom; height: 9px;">\r\n				<p class="p11 ft10" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					<a href="javascript:void(0);" onclick="show_video(\'http://youtu.be/GQvhj2-dh-c\');">Get points for entry to the Prize Draw</a></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td class="tr3 td0" style="padding: 0px; margin: 0px; width: 351px; vertical-align: bottom; height: 10px;">\r\n				<p class="p12 ft10" style="margin-top: 0px; margin-bottom: 0px; white-space: nowrap; text-align: center;">\r\n					<a href="#start business">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; you want to start a business.</a></p>\r\n			</td>\r\n			<td class="tr3 td1" style="padding: 0px; margin: 0px; width: 164px; vertical-align: bottom; height: 10px;">\r\n				<p class="p11 ft11" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					<a href="javascript:void(0);" onclick="show_video(\'http://youtu.be/GQvhj2-dh-c\');">Get help for my business idea</a></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td class="tr3 td0" style="padding: 0px; margin: 0px; width: 351px; vertical-align: bottom; height: 10px;">\r\n				<p class="p12 ft11" style="margin-top: 0px; margin-bottom: 0px; white-space: nowrap; text-align: center;">\r\n					<a href="#earn income">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; you want earn a income.</a></p>\r\n			</td>\r\n			<td class="tr3 td1" style="padding: 0px; margin: 0px; width: 164px; vertical-align: bottom; height: 10px;">\r\n				<p class="p11 ft10" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					<a href="javascript:void(0);" onclick="show_video(\'http://youtu.be/GQvhj2-dh-c\');">The visitor</a></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td class="tr3 td0" style="padding: 0px; margin: 0px; width: 351px; vertical-align: bottom; height: 10px;">\r\n				<p class="p11 ft10" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					Will it cost me anything?</p>\r\n			</td>\r\n			<td class="tr3 td1" style="padding: 0px; margin: 0px; width: 164px; vertical-align: bottom; height: 10px;">\r\n				<p class="p11 ft10" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					<a href="javascript:void(0);" onclick="show_video(\'http://youtu.be/GQvhj2-dh-c\');">The entrepreneur</a></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td class="tr2 td0" style="padding: 0px; margin: 0px; width: 351px; vertical-align: bottom; height: 9px;">\r\n				<p class="p11 ft10" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					How do I create an account?</p>\r\n			</td>\r\n			<td class="tr2 td1" style="padding: 0px; margin: 0px; width: 164px; vertical-align: bottom; height: 9px;">\r\n				<p class="p11 ft10" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					<a href="javascript:void(0);" onclick="show_video(\'http://youtu.be/GQvhj2-dh-c\');">Businesses that can help</a></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td class="tr3 td0" style="padding: 0px; margin: 0px; width: 351px; vertical-align: bottom; height: 10px;">\r\n				<p class="p11 ft11" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					How safe are my details?</p>\r\n			</td>\r\n			<td class="tr3 td1" style="padding: 0px; margin: 0px; width: 164px; vertical-align: bottom; height: 10px;">\r\n				<p class="p10 ft12" style=" text-align: left; margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td class="tr3 td0" style="padding: 0px; margin: 0px; width: 351px; vertical-align: bottom; height: 10px;">\r\n				<p class="p11 ft10" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					How do I get help? (contact Us)</p>\r\n			</td>\r\n			<td class="tr3 td1" style="padding: 0px; margin: 0px; width: 164px; vertical-align: bottom; height: 10px;">\r\n				<p class="p10 ft12" style=" text-align: left; margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td class="tr4 td0" style="padding: 0px; margin: 0px; width: 351px; vertical-align: bottom; height: 37px;">\r\n				<p class="p13 ft13" style=" color: rgb(165, 70, 134);  text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					<span style="font-size:16px;">How<span class="Apple-converted-space">&nbsp;</span></span><nobr><span style="font-size:16px;">businessinvention.com</span></nobr><span style="font-size:16px;"><span class="Apple-converted-space">&nbsp;</span>can help its members</span></p>\r\n			</td>\r\n			<td class="tr4 td1" style="padding: 0px; margin: 0px; width: 164px; vertical-align: bottom; height: 37px;">\r\n				<p class="p10 ft12" style=" text-align: left; margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td class="tr0 td0" style="padding: 0px; margin: 0px; width: 351px; vertical-align: bottom; height: 12px;">\r\n				<p class="p14 ft10" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					Can I enter the Prize Draw?</p>\r\n			</td>\r\n			<td class="tr0 td1" style="padding: 0px; margin: 0px; width: 164px; vertical-align: bottom; height: 12px;">\r\n				<p class="p10 ft12" style=" text-align: left; margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td class="tr3 td0" style="padding: 0px; margin: 0px; width: 351px; vertical-align: bottom; height: 10px;">\r\n				<p class="p14 ft10" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					Will it cost anything?</p>\r\n			</td>\r\n			<td class="tr3 td1" style="padding: 0px; margin: 0px; width: 164px; vertical-align: bottom; height: 10px;">\r\n				<p class="p10 ft12" style=" text-align: left; margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td class="tr2 td0" style="padding: 0px; margin: 0px; width: 351px; vertical-align: bottom; height: 9px;">\r\n				<p class="p14 ft10" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					I do not wish to start my own business, what can you do for me?</p>\r\n			</td>\r\n			<td class="tr2 td1" style="padding: 0px; margin: 0px; width: 164px; vertical-align: bottom; height: 9px;">\r\n				<p class="p10 ft12" style=" text-align: left; margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td class="tr3 td0" style="padding: 0px; margin: 0px; width: 351px; vertical-align: bottom; height: 10px;">\r\n				<p class="p14 ft11" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					I&rsquo;m retired, what can you do for me?</p>\r\n			</td>\r\n			<td class="tr3 td1" style="padding: 0px; margin: 0px; width: 164px; vertical-align: bottom; height: 10px;">\r\n				<p class="p10 ft12" style=" text-align: left; margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td class="tr3 td0" style="padding: 0px; margin: 0px; width: 351px; vertical-align: bottom; height: 10px;">\r\n				<p class="p14 ft10" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					What do you mean &lsquo;become an important part of a business community&rsquo;?</p>\r\n			</td>\r\n			<td class="tr3 td1" style="padding: 0px; margin: 0px; width: 164px; vertical-align: bottom; height: 10px;">\r\n				<p class="p10 ft12" style=" text-align: left; margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td class="tr5 td0" style="padding: 0px; margin: 0px; width: 351px; vertical-align: bottom; height: 13px;">\r\n				<p class="p14 ft14" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					Will you value my opinion?</p>\r\n			</td>\r\n			<td class="tr5 td1" style="padding: 0px; margin: 0px; width: 164px; vertical-align: bottom; height: 13px;">\r\n				<p class="p10 ft12" style=" text-align: left; margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n					&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p class="p15 ft15" style=" color: rgb(165, 70, 134);  text-align: left;  margin-top: 21px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	<span style="font-size:16px;">How<span class="Apple-converted-space">&nbsp;</span></span><nobr><span style="font-size:16px;">business-supermarket</span></nobr><span style="font-size:16px;"><span class="Apple-converted-space">&nbsp;</span>can help the entrepreneur</span></p>\r\n<p class="p16 ft11" style="    text-align: left;  margin-top: 1px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	I have a great idea, what can you do for me?</p>\r\n<p class="p17 ft10" style="    text-align: left;  padding-right: 445px; margin-top: 0px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	What are the steps for listing my idea on<span class="Apple-converted-space">&nbsp;</span><nobr>businessinvention.com?</nobr><span class="Apple-converted-space">&nbsp;</span>How do I protect my business idea?</p>\r\n<p class="p16 ft11" style="    text-align: left;  margin-top: 1px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	What can I do to stop someone from stealing my business idea?</p>\r\n<p class="p18 ft11" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	I do not understand all the red tape involved in starting up a business.</p>\r\n<p class="p19 ft10" style="    text-align: left;  padding-right: 328px; margin-top: 0px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	I am totally new to this but I want to open a business with a idea that I&#39;ve got. How can you help? How do I get the funding needed to make my idea a reality?</p>\r\n<p class="p16 ft11" style="    text-align: left;  margin-top: 1px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	I want to sell my business, what can I do?</p>\r\n<p class="p16 ft14" style="    text-align: left;  margin-top: 1px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	I am lacking in certain skills to make my business idea a reality. What can I do?</p>\r\n<p class="p20 ft15" style=" color: rgb(165, 70, 134);  text-align: left;  margin-top: 21px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	<span style="font-size:16px;">The established Business</span></p>\r\n<p class="p21 ft11" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	If you are a business can you help our members?</p>\r\n<p class="p21 ft11" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	How to pass the due diligence.</p>\r\n<p class="p21 ft11" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	How to get a better star rating</p>\r\n<p class="p21 ft10" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	Carry out market research for a new product line</p>\r\n<p class="p22 ft14" style="    text-align: left;  margin-top: 1px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	Guidelines for advertising or listing on<span class="Apple-converted-space">&nbsp;</span><nobr>businessinvention.com</nobr></p>\r\n<p class="p23 ft15" style=" color: rgb(165, 70, 134);  text-align: left;  margin-top: 24px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	<nobr><span style="font-size:16px;">Business-Supermarket</span></nobr><span style="font-size:16px;"><span class="Apple-converted-space">&nbsp;</span>Prize Draw</span></p>\r\n<p class="p18 ft11" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	How does the prize draw work?</p>\r\n<p class="p18 ft10" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	What is the value of the winnings?</p>\r\n<p class="p18 ft11" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	Do I only win money?</p>\r\n<p class="p18 ft11" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	Who pays for the prize draw?</p>\r\n<p class="p18 ft10" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	How often does the prize draw take place?</p>\r\n<p class="p18 ft11" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	How soon do I receive the winnings?</p>\r\n<p class="p18 ft11" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	Do I have to be a member before I can enter the prize draw?</p>\r\n<p class="p18 ft11" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	What is the points system?</p>\r\n<p class="p18 ft10" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	What does it mean by &lsquo;Points required for FREE entry?</p>\r\n<p class="p18 ft14" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	How do I get FREE entry to the prize draw without requiring any points?</p>\r\n<p class="p24 ft15" style=" color: rgb(165, 70, 134);  text-align: left;  margin-top: 19px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	<span style="font-size:16px;">Miscellaneous</span></p>\r\n<p class="p21 ft11" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	Employees</p>\r\n<p class="p21 ft10" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	About</p>\r\n<p class="p21 ft11" style="    text-align: left;  margin-top: 0px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	Terms of Service</p>\r\n<p class="p22 ft14" style="    text-align: left;  margin-top: 1px; margin-bottom: 0px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">\r\n	<a href="http://www.google.co.uk">Jobs</a></p>\r\n<p class="p22 ft14" style="margin-top: 1px; margin-bottom: 0px; letter-spacing: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; text-align: right;">\r\n	<a href="#top"><span style="color:#808080;">Back to Top &gt;&gt;</span></a></p>\r\n', 0, 'F.A.Q.', '\r\n\r\n\r\n\r\n\r\nGetting Started with business-supermarketcom\r\n\r\n\r\n\r\nVideos\r\n\r\n\r\n\r\n\r\n\r\nWhat is Business Supermarketc', '', 'faq', 1, 0, '', 0, 0, 0, 1407607862),
(16, 'Getting Started with businessinvention.com', '<p class="p10 ft9" style=" color: rgb(165, 70, 134);  text-align: left; margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n	&nbsp;</p>\r\n<p class="p10 ft9" style=" color: rgb(165, 70, 134);  text-align: left; margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n	<span style="font-size:16px;">Getting Started with<span class="Apple-converted-space">&nbsp;</span></span><nobr><span style="font-size:16px;">businessinvention.com123</span></nobr></p>\r\n<p style="text-align: right;">\r\n	<a href="http://129.121.137.227/~busines2/index.php/site/page/faq"><span style="color:#808080;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Back to contents &gt;&gt;</span></a></p>\r\n<hr />\r\n<p class="p10 ft9" style=" color: rgb(165, 70, 134);  text-align: left; margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n	&nbsp;</p>\r\n<p class="p10 ft9" style=" color: rgb(165, 70, 134);  text-align: left; margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n	<span style="font-size:16px;">What is Business Invention.com</span></p>\r\n<p>\r\n	Business Invention is setup as a meeting place for both the business and its consumer. This website allows new business ideas to be market tested BEFORE the business su?ers losses for a product that fails to deliver the expected pro?t margin. It does this by allowing the business to get support and a following from the consumer before the idea goes to market. Getting consumer support for a business prior to its launch allows the business to plan a strategy to bring the product to market and supply the demand. The consumer (the general public and the individual) bene?t by becoming part of the next big thing as well as being rewarded with a free entry to the prize draw. See DragonsNet Free Prize Draw for further details.</p>\r\n<p class="p10 ft9" style=" color: rgb(165, 70, 134);  text-align: left; margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n	<span style="font-size:16px;">Do I need to register?</span></p>\r\n<p>\r\n	In short NO. However you will not be able to take part in our community. You may however navigate the site without restrictions. You will not be able to leave a comment or get free entry to the prize draw.</p>\r\n<p class="p10 ft9" style=" color: rgb(165, 70, 134);  text-align: left; margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n	<span style="font-size:16px;">What are the bene?ts of becoming a member?</span></p>\r\n<p>\r\n	Membership allows you to take part in the business community and be part of the next industrial revolution. You also get free entry to our monthly prize draw. If you inspire to own your own business then follow the steps needed to get funding from DragonsNet.Biz and make your business idea a reality. Contact DragonsNet for further details.</p>\r\n<p class="p10 ft9" style=" color: rgb(165, 70, 134);  text-align: left; margin-top: 0px; margin-bottom: 0px; white-space: nowrap;">\r\n	<span style="font-size:16px;">What Business Supermarket has to offer if:-<a name="offer-it"></a></span></p>\r\n<p style="color:rgb(165, 70, 134)">\r\n	you are a consumer.</p>\r\n<p>\r\n	<a href="http://youtu.be/YlIhWEhFyE4">View a video presentation here &gt;&gt;</a></p>\r\n<p>\r\n	<span style="color:#33cc00;">Help create a business that caters for your needs.</span></p>\r\n<p>\r\n	If you are a consumer that has no desire to start their own business but feel that you want to be part of the next big thing; then you may take part in the forums for products that are of interest to you. Help the businesses listed here to cater for your needs.</p>\r\n<p>\r\n	<span style="color:#33cc00;">Be inspired to come up with your own business idea.</span></p>\r\n<p>\r\n	Who knows you may even be inspired to come up with a business idea of your own that you could sell or license out with little cost or e?ort on your part. Check out &lsquo; for easy step by step instructions to get started. how to list your business idea&rsquo;</p>\r\n<p>\r\n	<span style="color:#339900;">Be a mentor or become a business partner. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>If you have a skill or a trade that may of use to business ideas listed here, then why not o?er advice or become a mentor for an arranged fee. Earn income while you enjoy exploiting your skill.</p>\r\n<p>\r\n	<span style="color:#33cc00;">Get free entry to our monthly prize draw. &nbsp; &nbsp; &nbsp; &nbsp; </span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;</p>\r\n<p>\r\n	By interacting with other members, taking part in the forums and leaving comments, viewing videos of the business idea, voting etc you are acquiring points which give you free entry to our prize draw. We reward your input and value your opinions. Check out for further details.</p>\r\n<p style="color:rgb(165, 70, 134)">\r\n	you want to start your own business.</p>\r\n<p>\r\n	View a video presentation here &gt;&gt;&gt;</p>\r\n<p>\r\n	<span style="color:#33cc00;">Got a great idea but don&rsquo;t know what to do?</span></p>\r\n<p>\r\n	List your business or business idea here for free and get support from the public and thus the consumer.</p>\r\n<p>\r\n	If you get a positive response then DragonsNet may help fund your idea to make it a reality.</p>\r\n<p>\r\n	<span style="color:#33cc00;">Need help to take your business idea to market?</span></p>\r\n<p>\r\n	If you need help and guidance to bring your business idea to market, then check out our Services section to get in contact with businesses that help guide you into making your idea a reality.</p>\r\n<p>\r\n	<span style="color:#33cc00;">How can DragonsNet.Biz help?</span></p>\r\n<p>\r\n	If your business idea quali?es for funding support from DragonsNet then we will provide a professional management team to ensure that your idea successfully gets to market. If your listings achieves75% or more positive votes then for further details. Our management team will draft up a business growth strategy for contact DragonsNet your business for the next 5 years.</p>\r\n<p>\r\n	<span style="color:#33cc00;">Strengthen your weaknesses</span></p>\r\n<p>\r\n	To succeed you need skill sets that you may not have. Use this website to get the skill set your business needs and free you up to do what you do best. Many members are prepared to o?er help, advice and guidance. Use your to ?nd the right candidate.</p>\r\n<p style="color:rgb(165, 70, 134)">\r\n	you want to earn an income.</p>\r\n<p>\r\n	<a href="http://youtu.be/N65U3m00esw">View a video presentation here &gt;&gt;&gt;</a></p>\r\n<p>\r\n	All the services listed below allow you, the individual, to o?er help and advice to business ideas listed on this website for a fee that can be arranged between you and the lister of the business idea.</p>\r\n<p>\r\n	<span style="color:#33cc00;">Be a teacher.&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>\r\n<p>\r\n	We all lack certain skills for which we need advice and guidance. O?er help to businesses that could bene?t from your skill set and advice.</p>\r\n<p>\r\n	<span style="color:#33cc00;">Be a mentor.&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n<p>\r\n	For a fee you could o?er to mentor a business that could bene?t from your skill and experience.</p>\r\n<p>\r\n	<span style="color:#33cc00;">Become a partner.</span></p>\r\n<p>\r\n	Feel that you want to be part of the next bid thing, then o?er to become a partner in a business idea you feel strongly about and enjoy in the rewards o?ered by a successful company.</p>\r\n<p>\r\n	<span style="color:#33cc00;">Enter our Prize Draw.</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n<p>\r\n	Your interaction with this site earns you points and free entry to our monthly prize draw. See for further details.</p>\r\n', 0, 'Getting Started with businessinvention.com', '\r\nnbsp\r\n\r\nGetting Started withnbspbusiness-supermarketcom123\r\n\r\nnbspnbspnbspnbspnbspnbspnbspnbspnbspnbspnbspnbspnbspnbspnbs', '', 'getting-started-with-business-supermarketcom', 1, 0, '', 0, 0, 0, 1407608221),
(8, 'Business Support', '<p>\r\n	Business services coming soon.</p>\r\n', 0, 'Business Support', '\r\nBusiness services coming soon\r\n', '', 'business-support', 1, 0, '', 0, 0, 0, 1408192003),
(9, 'Terms & Conditions', '<p>\r\n	coming soon</p>\r\n', 0, 'Terms & Privacy', '\r\ncoming soon\r\n', '', 'terms-conditions', 1, 0, '', 0, 0, 0, 0),
(10, 'Contact Us', '<p>\r\n	coming soon</p>\r\n', 0, 'Contact Us', '\r\ncoming soon\r\n', '', 'contact-us', 1, 0, '', 0, 0, 0, 0),
(11, 'Trainig Centre', '<p>\r\n	coming soon</p>\r\n', 0, 'Trainig Centre', '\r\ncoming soon\r\n', '', 'trainig-centre', 1, 0, '', 0, 0, 0, 0),
(12, 'Links', '<p>\r\n	cominng soon</p>\r\n', 0, 'Links', '\r\ncominng soon\r\n', '', 'links', 1, 0, '', 0, 0, 0, 0),
(13, 'Useful Information', '<p>\r\n	coming soon</p>\r\n', 0, 'Useful Information', '\r\ncoming soon\r\n', '', 'useful-information', 1, 0, '', 0, 0, 0, 0),
(14, 'Accessibility', '<p>\r\n	coming soon</p>\r\n', 0, 'Accessibility', '\r\ncoming soon\r\n', '', 'accessibility', 1, 0, '', 0, 0, 0, 0),
(15, 'Sitemap', '<p>\r\n	Sitemap</p>\r\n', 0, 'Sitemap', '\r\nSitemap\r\n', '', 'sitemap', 1, 0, '', 0, 0, 0, 0),
(18, 'Rewards', '<p>\r\n	coming soon...</p>\r\n', 0, 'Rewards', '\r\ncoming soon\r\n', '', 'rewards', 1, 0, '', 0, 0, 0, 1407008128),
(17, 'Home', '<p>\r\n	businessinvention.com is under stage 1 Alpha release 1</p>\r\n', 0, 'Home', '\r\nbusiness-supermarketcom is under stage 1 Alpha release 1\r\n', '', 'home', 1, 0, '', 0, 0, 0, 1412003886);

-- --------------------------------------------------------

--
-- Table structure for table `user_default_country`
--

CREATE TABLE `user_default_country` (
  `user_default_country_id` int(11) NOT NULL,
  `user_default_country_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_country`
--

INSERT INTO `user_default_country` (`user_default_country_id`, `user_default_country_name`) VALUES
(1, 'Afganistan'),
(2, 'Albania'),
(3, 'Algeria'),
(4, 'American Samoa'),
(5, 'Andorra'),
(6, 'Angola'),
(7, 'Anguilla'),
(8, 'Antigua & Barbuda'),
(9, 'Argentina'),
(10, 'Armenia'),
(11, 'Aruba'),
(12, 'Australia'),
(13, 'Austria'),
(14, 'Azerbaijan'),
(15, 'Bahamas'),
(16, 'Bahrain'),
(17, 'Bangladesh'),
(18, 'Barbados'),
(19, 'Belarus'),
(20, 'Belgium'),
(21, 'Belize'),
(22, 'Benin'),
(23, 'Bermuda'),
(24, 'Bhutan'),
(25, 'Bolivia'),
(26, 'Bonaire'),
(27, 'Bosnia & Herzegovina'),
(28, 'Botswana'),
(29, 'Brazil'),
(30, 'British Indian Ocean Ter'),
(31, 'Brunei'),
(32, 'Bulgaria'),
(33, 'Burkina Faso'),
(34, 'Burundi'),
(35, 'Cambodia'),
(36, 'Cameroon'),
(37, 'Canada'),
(38, 'Canary Islands'),
(39, 'Cape Verde'),
(40, 'Cayman Islands'),
(41, 'Central African Republic'),
(42, 'Chad'),
(43, 'Channel Islands'),
(44, 'Chile'),
(45, 'China'),
(46, 'Christmas Island'),
(47, 'Cocos Island'),
(48, 'Colombia'),
(49, 'Comoros'),
(50, 'Congo'),
(51, 'Cook Islands'),
(52, 'Costa Rica'),
(53, 'Cote DIvoire'),
(54, 'Croatia'),
(55, 'Cuba'),
(56, 'Curaco'),
(57, 'Cyprus'),
(58, 'Czech Republic'),
(59, 'Denmark'),
(60, 'Djibouti'),
(61, 'Dominica'),
(62, 'Dominican Republic'),
(63, 'East Timor'),
(64, 'Ecuador'),
(65, 'Egypt'),
(66, 'El Salvador'),
(67, 'Equatorial Guinea'),
(68, 'Eritrea'),
(69, 'Estonia'),
(70, 'Ethiopia'),
(71, 'Falkland Islands'),
(72, 'Faroe Islands'),
(73, 'Fiji'),
(74, 'Finland'),
(75, 'France'),
(76, 'French Guiana'),
(77, 'French Polynesia'),
(78, 'French Southern Ter'),
(79, 'Gabon'),
(80, 'Gambia'),
(81, 'Georgia'),
(82, 'Germany'),
(83, 'Ghana'),
(84, 'Gibraltar'),
(85, 'Great Britain'),
(86, 'Greece'),
(87, 'Greenland'),
(88, 'Grenada'),
(89, 'Guadeloupe'),
(90, 'Guam'),
(91, 'Guatemala'),
(92, 'Guinea'),
(93, 'Guyana'),
(94, 'Haiti'),
(95, 'Hawaii'),
(96, 'Honduras'),
(97, 'Hong Kong'),
(98, 'Hungary'),
(99, 'Iceland'),
(100, 'India'),
(101, 'Indonesia'),
(102, 'Iran'),
(103, 'Iraq'),
(104, 'Ireland'),
(105, 'Isle of Man'),
(106, 'Israel'),
(107, 'Italy'),
(108, 'Jamaica'),
(109, 'Japan'),
(110, 'Jordan'),
(111, 'Kazakhstan'),
(112, 'Kenya'),
(113, 'Kiribati'),
(114, 'Korea North'),
(115, 'Korea South'),
(116, 'Kuwait'),
(117, 'Kyrgyzstan'),
(118, 'Laos'),
(119, 'Latvia'),
(120, 'Lebanon'),
(121, 'Lesotho'),
(122, 'Liberia'),
(123, 'Libya'),
(124, 'Liechtenstein'),
(125, 'Lithuania'),
(126, 'Luxembourg'),
(127, 'Macau'),
(128, 'Macedonia'),
(129, 'Madagascar'),
(130, 'Malaysia'),
(131, 'Malawi'),
(132, 'Maldives'),
(133, 'Mali'),
(134, 'Malta'),
(135, 'Marshall Islands'),
(136, 'Martinique'),
(137, 'Mauritania'),
(138, 'Mauritius'),
(139, 'Mayotte'),
(140, 'Mexico'),
(141, 'Midway Islands'),
(142, 'Moldova'),
(143, 'Monaco'),
(144, 'Mongolia'),
(145, 'Montserrat'),
(146, 'Morocco'),
(147, 'Mozambique'),
(148, 'Myanmar'),
(149, 'Nambia'),
(150, 'Nauru'),
(151, 'Nepal'),
(152, 'Netherland Antilles'),
(153, 'Netherlands'),
(154, 'Europe)'),
(155, 'Nevis'),
(156, 'New Caledonia'),
(157, 'New Zealand'),
(158, 'Nicaragua'),
(159, 'Niger'),
(160, 'Nigeria'),
(161, 'Niue'),
(162, 'Norfolk Island'),
(163, 'Norway'),
(164, 'Oman'),
(165, 'Pakistan'),
(166, 'Palau Island'),
(167, 'Palestine'),
(168, 'Panama'),
(169, 'Papua New Guinea'),
(170, 'Paraguay'),
(171, 'Peru'),
(172, 'Phillipines'),
(173, 'Pitcairn Island'),
(174, 'Poland'),
(175, 'Portugal'),
(176, 'Puerto Rico'),
(177, 'Qatar'),
(178, 'Republic of Montenegro'),
(179, 'Republic of Serbia'),
(180, 'Reunion'),
(181, 'Romania'),
(182, 'Russia'),
(183, 'Rwanda'),
(184, 'St Barthelemy'),
(185, 'St Eustatius'),
(186, 'St Helena'),
(187, 'St Kitts-Nevis'),
(188, 'St Lucia'),
(189, 'St Maarten'),
(190, 'St Pierre & Miquelon'),
(191, 'St Vincent & Grenadines'),
(192, 'Saipan'),
(193, 'Samoa'),
(194, 'Samoa American'),
(195, 'San Marino'),
(196, 'Sao Tome & Principe'),
(197, 'Saudi Arabia'),
(198, 'Senegal'),
(199, 'Seychelles'),
(200, 'Sierra Leone'),
(201, 'Singapore'),
(202, 'Slovakia'),
(203, 'Slovenia'),
(204, 'Solomon Islands'),
(205, 'Somalia'),
(206, 'South Africa'),
(207, 'Spain'),
(208, 'Sri Lanka'),
(209, 'Sudan'),
(210, 'Suriname'),
(211, 'Swaziland'),
(212, 'Sweden'),
(213, 'Switzerland'),
(214, 'Syria'),
(215, 'Tahiti'),
(216, 'Taiwan'),
(217, 'Tajikistan'),
(218, 'Tanzania'),
(219, 'Thailand'),
(220, 'Togo'),
(221, 'Tokelau'),
(222, 'Tonga'),
(223, 'Trinidad & Tobago'),
(224, 'Tunisia'),
(225, 'Turkey'),
(226, 'Turkmenistan'),
(227, 'Turks & Caicos Is'),
(228, 'Tuvalu'),
(229, 'Uganda'),
(230, 'Ukraine'),
(231, 'United Arab Erimates'),
(232, 'United Kingdom'),
(233, 'United States of America'),
(234, 'Uraguay'),
(235, 'Uzbekistan'),
(236, 'Vanuatu'),
(237, 'Vatican City State'),
(238, 'Venezuela'),
(239, 'Vietnam'),
(240, 'Virgin Islands (Brit)'),
(241, 'Virgin Islands (USA)'),
(242, 'Wake Island'),
(243, 'Wallis & Futana Is'),
(244, 'Yemen'),
(245, 'Zaire'),
(246, 'Zambia'),
(247, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `user_default_currency`
--

CREATE TABLE `user_default_currency` (
  `currency_id` int(11) NOT NULL,
  `currency_name` varchar(64) NOT NULL,
  `currency_code` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_currency`
--

INSERT INTO `user_default_currency` (`currency_id`, `currency_name`, `currency_code`) VALUES
(1, 'US Dollar', 'USD'),
(2, 'British Pound', 'GBP'),
(3, 'Euro', 'EUR');

-- --------------------------------------------------------

--
-- Table structure for table `user_default_currency_forex`
--

CREATE TABLE `user_default_currency_forex` (
  `currency` char(3) NOT NULL DEFAULT '',
  `rate` float NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_currency_forex`
--

INSERT INTO `user_default_currency_forex` (`currency`, `rate`) VALUES
('EUR', 1),
('USD', 1.0687),
('JPY', 131.6),
('BGN', 1.9558),
('CZK', 27.025),
('DKK', 7.4603),
('GBP', 0.6998),
('HUF', 310.26),
('PLN', 4.25),
('RON', 4.4438),
('SEK', 9.3089),
('CHF', 1.0893),
('NOK', 9.2556),
('HRK', 7.631),
('RUB', 69.4086),
('TRY', 3.0433),
('AUD', 1.4925),
('BRL', 4.0154),
('CAD', 1.4203),
('CNY', 6.8244),
('HKD', 8.2829),
('IDR', 14714.2),
('ILS', 4.1597),
('INR', 70.78),
('KRW', 1241.54),
('MXN', 17.8206),
('MYR', 4.6314),
('NZD', 1.6404),
('PHP', 50.259),
('SGD', 1.5129),
('THB', 38.324),
('ZAR', 15.1806);

-- --------------------------------------------------------

--
-- Table structure for table `user_default_data`
--

CREATE TABLE `user_default_data` (
  `data_id` int(11) NOT NULL,
  `data_type` varchar(200) NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_data`
--

INSERT INTO `user_default_data` (`data_id`, `data_type`, `data`) VALUES
(1, 'amount', '{"1":"United State Doller ($)","2":"GB Pound (&pound;)","3":"Euro (&euro;)"}'),
(2, 'financial_data', '{"1":"Financial data available upon request","2":"The product/business idea is under market research","3":"The product/business idea does not qualify for financial data"}'),
(3, 'report_frequency', 'weekly'),
(4, 'report_recipient', 'dsp7@blueyonder.co.uk'),
(7, 'blacklist_domain', 'itregi.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_default_departments`
--

CREATE TABLE `user_default_departments` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(1024) NOT NULL,
  `dept_email` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_departments`
--

INSERT INTO `user_default_departments` (`dept_id`, `dept_name`, `dept_email`) VALUES
(1, 'accounts', 'accounts@businessinvention.com'),
(2, 'admin', 'admin@businessinvention.com'),
(3, 'sales', 'sales@businessinvention.com'),
(4, 'support', 'support@businessinvention.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_default_financial`
--

CREATE TABLE `user_default_financial` (
  `user_default_transaction_id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `user_default_transaction_type` tinytext NOT NULL,
  `user_default_transaction_details` text NOT NULL,
  `user_default_transaction_bank` varchar(50) NOT NULL,
  `user_default_transaction_date` date NOT NULL,
  `user_default_transaction_paid_out` decimal(10,2) NOT NULL,
  `user_default_transaction_paid_in` decimal(10,2) NOT NULL,
  `user_default_transaction_balance` decimal(10,2) NOT NULL,
  `user_default_transaction_paypal_transactionId` varchar(150) NOT NULL,
  `user_default_financial_transaction_withdraw_status` tinytext NOT NULL,
  `user_default_financial_transaction_currency_code` varchar(3) NOT NULL,
  `user_default_transaction_profile_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_default_financial`
--

INSERT INTO `user_default_financial` (`user_default_transaction_id`, `user_default_transaction_type`, `user_default_transaction_details`, `user_default_transaction_bank`, `user_default_transaction_date`, `user_default_transaction_paid_out`, `user_default_transaction_paid_in`, `user_default_transaction_balance`, `user_default_transaction_paypal_transactionId`, `user_default_financial_transaction_withdraw_status`, `user_default_financial_transaction_currency_code`, `user_default_transaction_profile_id`) VALUES
(0000000001, 'cr', 'Paypal', '', '2015-10-16', 0.00, 1.00, 1.00, '64X86412UP5654454', '0', 'GBP', 88),
(0000000002, 'cr', 'Paypal', '', '2015-10-17', 0.00, 1.00, 2.00, '5PW97406NA345124M', '0', 'GBP', 88),
(0000000003, 'cr', 'Paypal', '', '2015-11-23', 0.00, 23.50, 23.50, '7H129029WJ981164G', '0', 'EUR', 86),
(0000000004, 'cr', 'Paypal', '', '2015-11-23', 0.00, 23.50, 23.50, '7G813185W27159455', '0', 'EUR', 86),
(0000000005, 'cr', 'Paypal', '', '2015-11-23', 0.00, 2.80, 26.30, '22400222UB588590H', '0', 'EUR', 86),
(0000000006, 'cr', 'Paypal', '', '2015-11-23', 0.00, 5.60, 31.90, '2S409640JU779180K', '0', 'EUR', 86);

-- --------------------------------------------------------

--
-- Table structure for table `user_default_interactions`
--

CREATE TABLE `user_default_interactions` (
  `user_default_interaction_id` int(11) NOT NULL,
  `user_default_interaction_message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_default_reputation` int(11) NOT NULL DEFAULT '0',
  `user_default_favourites` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1 - marked as favourite 0 - not marked',
  `user_default_profile_id` int(11) NOT NULL,
  `user_default_listing_id` int(11) NOT NULL,
  `user_default_attachment` varchar(350) DEFAULT NULL,
  `user_default_thumb_attachment` varchar(360) DEFAULT NULL,
  `user_default_interactions_message` text NOT NULL,
  `user_default_likes_total` int(11) NOT NULL DEFAULT '0',
  `user_default_dislikes_total` int(11) NOT NULL DEFAULT '0',
  `user_default_is_spam` enum('0','1') NOT NULL DEFAULT '0',
  `user_default_date_create` datetime NOT NULL,
  `user_default_first_interations` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This table logs the users interaction on the site and contai';

-- --------------------------------------------------------

--
-- Table structure for table `user_default_interactions_messages`
--

CREATE TABLE `user_default_interactions_messages` (
  `user_default_interactions_message_id` int(11) NOT NULL,
  `user_default_interaction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_investor_account_balance`
--

CREATE TABLE `user_default_investor_account_balance` (
  `user_default_investment_account_balance_id` int(11) NOT NULL,
  `user_default_investment_account_balance_user_id` int(11) NOT NULL,
  `user_default_investment_account_balance_account_balance` decimal(10,4) NOT NULL,
  `user_default_investment_account_balance_currency_code` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_investor_admin`
--

CREATE TABLE `user_default_investor_admin` (
  `user_default_investor_admin_id` int(11) NOT NULL,
  `user_default_investor_admin_profiles_id` int(11) NOT NULL,
  `user_default_investor_admin_status` enum('0','1') NOT NULL,
  `user_default_investor_admin_created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_investor_financial`
--

CREATE TABLE `user_default_investor_financial` (
  `user_default_investment_transaction_id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `user_default_investment_transaction_sellequityid` int(11) NOT NULL,
  `user_default_investment_transaction_type` tinytext NOT NULL,
  `user_default_investment_transaction_details` text NOT NULL,
  `user_default_investment_transaction_bank` varchar(50) NOT NULL,
  `user_default_investment_transaction_date` date NOT NULL,
  `user_default_investment_transaction_paid_out` decimal(10,2) NOT NULL,
  `user_default_investment_transaction_paid_in` decimal(10,2) NOT NULL,
  `user_default_investment_transaction_balance` decimal(10,2) NOT NULL,
  `user_default_investment_transaction_paypal_transactionId` varchar(150) NOT NULL,
  `user_default_investment_transaction_withdraw_status` tinytext NOT NULL,
  `user_default_investment_transaction_currency_code` varchar(3) NOT NULL,
  `user_default_investment_transaction_profiles_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_investor_messages`
--

CREATE TABLE `user_default_investor_messages` (
  `id` int(11) NOT NULL,
  `user_default_listing_id` int(11) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `user_default_investor_id` int(11) NOT NULL,
  `user_default_investor_user_type` varchar(9) NOT NULL,
  `attachement` varchar(255) NOT NULL,
  `is_spam` enum('0','1') NOT NULL,
  `first_message` enum('0','1') NOT NULL,
  `notice_flag` enum('0','1') NOT NULL,
  `close_msg_flag` enum('0','1') NOT NULL,
  `created_date` datetime NOT NULL,
  `parent_message_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_investor_messages_sent`
--

CREATE TABLE `user_default_investor_messages_sent` (
  `id` int(11) NOT NULL,
  `msg_id` int(11) NOT NULL,
  `sender_investor_id` int(11) NOT NULL,
  `receiver_investor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_investor_voting`
--

CREATE TABLE `user_default_investor_voting` (
  `user_default_investor_voting_id` int(11) NOT NULL,
  `user_default_investor_voting_question_id` int(11) NOT NULL,
  `user_default_investor_voting_user_answer` enum('1','2','3') NOT NULL,
  `user_default_investor_voting_profiles_id` int(11) NOT NULL,
  `user_default_investor_voting_datetime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_investor_voting_interface`
--

CREATE TABLE `user_default_investor_voting_interface` (
  `user_default_investor_voting_id` int(11) NOT NULL,
  `user_default_investor_voting__question` longtext NOT NULL,
  `user_default_investor_voting_answer1` mediumtext NOT NULL,
  `user_default_investor_voting_answer2` mediumtext NOT NULL,
  `user_default_investor_voting_nodays_open` int(11) NOT NULL,
  `user_default_investor_voting_listing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_like_interaction`
--

CREATE TABLE `user_default_like_interaction` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_default_interaction_id` int(11) UNSIGNED NOT NULL,
  `user_default_profile_id` int(11) UNSIGNED NOT NULL,
  `like_interacton` enum('0','1') COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_like_sample_feedback`
--

CREATE TABLE `user_default_like_sample_feedback` (
  `id` int(11) NOT NULL,
  `user_default_sample_feedback_id` int(11) UNSIGNED NOT NULL,
  `user_default_profile_id` int(11) UNSIGNED NOT NULL,
  `like_interacton` enum('0','1') COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_listing`
--

CREATE TABLE `user_default_listing` (
  `user_default_listing_id` int(11) NOT NULL,
  `user_default_listing_category_id` int(11) NOT NULL,
  `user_default_listing_lookingfor_id` int(11) NOT NULL,
  `user_default_listing_limit_viewing_id` int(11) NOT NULL,
  `user_default_listing_thumbnail` varchar(45) NOT NULL,
  `user_default_listing_title` varchar(100) NOT NULL,
  `user_default_listing_what_is_it` tinytext NOT NULL,
  `user_default_listing_summary` mediumtext NOT NULL,
  `user_default_listing_details` text NOT NULL,
  `user_default_listing_financial_table_status` enum('0','1','2') NOT NULL,
  `user_default_listing_fprojections` mediumtext NOT NULL,
  `user_default_listing_table_currency_code` varchar(3) DEFAULT NULL,
  `user_default_listing_want` varchar(500) DEFAULT NULL,
  `user_default_listing_keywords` varchar(255) DEFAULT NULL,
  `user_default_listing_notification_frequency` mediumint(9) DEFAULT NULL,
  `user_default_listing_submission_status` enum('0','1','2','3') DEFAULT NULL,
  `user_default_listing_days_active` tinyint(4) DEFAULT NULL,
  `user_default_listing_days_inactive` tinyint(4) DEFAULT NULL,
  `user_default_listing_page_hits` int(11) DEFAULT NULL,
  `user_default_profiles_id` int(11) NOT NULL,
  `user_default_listing_likes` int(11) DEFAULT NULL,
  `user_default_listing_dislikes` int(11) DEFAULT NULL,
  `user_default_listing_total_votes` int(11) DEFAULT NULL,
  `user_default_listing_access_period` varchar(45) DEFAULT NULL,
  `user_default_listing_approvedate` varchar(100) NOT NULL,
  `user_default_listing_step` enum('0','1','2','3','4') NOT NULL,
  `user_default_listing_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_listing_addresses`
--

CREATE TABLE `user_default_listing_addresses` (
  `user_default_listing_address_id` int(11) NOT NULL,
  `user_default_listing_company_name` varchar(100) NOT NULL,
  `user_default_listing_address1` varchar(100) NOT NULL,
  `user_default_listing_address2` varchar(100) NOT NULL,
  `user_default_listing_address3` varchar(100) NOT NULL,
  `user_default_listing_town` varchar(100) NOT NULL,
  `user_default_listing_county` varchar(100) NOT NULL,
  `user_default_listing_country` varchar(100) NOT NULL,
  `user_default_listing_zip_code` varchar(15) NOT NULL,
  `user_default_listing_tel` varchar(30) NOT NULL,
  `user_default_listing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_listing_category`
--

CREATE TABLE `user_default_listing_category` (
  `user_default_listing_category_id` int(11) NOT NULL,
  `user_default_listing_category_name` varchar(100) NOT NULL,
  `user_default_listing_category_title` varchar(250) NOT NULL,
  `user_default_listing_category_sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_listing_category`
--

INSERT INTO `user_default_listing_category` (`user_default_listing_category_id`, `user_default_listing_category_name`, `user_default_listing_category_title`, `user_default_listing_category_sort_order`) VALUES
(1, 'Services', 'The service industry', 4),
(2, 'Business Idea', 'List a business idea for market research', 0),
(3, 'Retail', 'Anything that can be sold on the high street outlets', 1),
(4, 'Industrial', 'Business ideas to help the industrial sector', 2),
(5, 'Science & Technology', 'Hi-Tech business ideas', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_default_listing_comments`
--

CREATE TABLE `user_default_listing_comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `user_default_profiles_id` int(11) UNSIGNED DEFAULT NULL,
  `user_default_listing_id` int(11) NOT NULL,
  `likes_total` int(11) NOT NULL DEFAULT '0',
  `dislikes_total` int(11) NOT NULL DEFAULT '0',
  `attachement` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_spam` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `first_comment` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `parent_comment_id` int(11) NOT NULL,
  `date_create` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_listing_comments_likes`
--

CREATE TABLE `user_default_listing_comments_likes` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) UNSIGNED NOT NULL,
  `user_default_profile_id` int(11) UNSIGNED NOT NULL,
  `like_comment` enum('0','1') COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_listing_company_details`
--

CREATE TABLE `user_default_listing_company_details` (
  `user_default_listing_company_id` int(11) NOT NULL,
  `user_default_listing_company_name` varchar(350) NOT NULL,
  `user_default_listing_company_reg_no` int(11) NOT NULL,
  `user_default_listing_company_incorporation_datetime` datetime NOT NULL,
  `user_default_listing_id` int(11) NOT NULL,
  `user_default_listing_company_address1` varchar(255) NOT NULL,
  `user_default_listing_company_address2` varchar(255) NOT NULL,
  `user_default_listing_company_address3` varchar(255) NOT NULL,
  `user_default_listing_company_town` varchar(100) NOT NULL,
  `user_default_listing_company_country_id` int(11) NOT NULL,
  `user_default_listing_company_zip` varchar(15) NOT NULL,
  `user_default_listing_company_tel_no` varchar(30) NOT NULL,
  `user_default_listing_company_fax` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_listing_images`
--

CREATE TABLE `user_default_listing_images` (
  `user_default_listing_image_id` int(11) NOT NULL,
  `user_default_listing_image` blob NOT NULL,
  `user_default_listing_image_text` mediumtext NOT NULL,
  `user_default_listing_image_link1` varchar(100) NOT NULL,
  `user_default_listing_image_link2` varchar(100) DEFAULT NULL,
  `user_default_listing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_listing_lookingfor`
--

CREATE TABLE `user_default_listing_lookingfor` (
  `user_default_listing_lookingfor_id` int(11) NOT NULL,
  `user_default_listing_lookingfor_name` varchar(250) NOT NULL,
  `user_default_listing_lookingfor_title` varchar(250) NOT NULL,
  `user_default_listing_lookingfor_sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_listing_marketing`
--

CREATE TABLE `user_default_listing_marketing` (
  `user_default_listing_marketing_id` int(11) NOT NULL,
  `user_default_listing_id` int(11) NOT NULL,
  `user_default_listing_marketing_question` mediumtext NOT NULL,
  `user_default_listing_marketing_question_business_user_votes` int(11) NOT NULL,
  `user_default_listing_marketing_question_consumer_votes` int(11) NOT NULL,
  `user_default_listing_marketing_question_entrepreneur_votes` int(11) NOT NULL,
  `user_default_listing_marketing_question_investor_votes` int(11) NOT NULL,
  `user_default_listing_marketing_question_submission_date` date NOT NULL,
  `user_default_listing_marketing_question_end_date` date NOT NULL,
  `user_default_listing_marketing_question_access_cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_listing_marketing_connection`
--

CREATE TABLE `user_default_listing_marketing_connection` (
  `user_default_listing_marketing_connection_id` int(11) NOT NULL,
  `user_default_listing_marketing_question_id` int(11) NOT NULL,
  `user_default_listing_marketing_vote_status` enum('1','0') NOT NULL DEFAULT '1' COMMENT '1=not voted  ,     0=voted ie cannot vote again',
  `user_default_listing_marketing_question_vote_value` enum('y','m','n') DEFAULT NULL COMMENT 'y- yes, m- maybe , n - no',
  `user_default_listing_marketing_question_access_days` tinyint(4) NOT NULL,
  `user_default_listing_marketing_question_access_date` date DEFAULT NULL,
  `user_default_listing_marketing_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_default_listing_marketing_connection`
--

INSERT INTO `user_default_listing_marketing_connection` (`user_default_listing_marketing_connection_id`, `user_default_listing_marketing_question_id`, `user_default_listing_marketing_vote_status`, `user_default_listing_marketing_question_vote_value`, `user_default_listing_marketing_question_access_days`, `user_default_listing_marketing_question_access_date`, `user_default_listing_marketing_user_id`) VALUES
(1, 7, '0', 'y', 0, '2015-12-30', 88),
(2, 7, '0', 'n', 0, '2015-12-30', 88),
(3, 7, '0', 'm', 0, '2015-12-30', 88);

-- --------------------------------------------------------

--
-- Table structure for table `user_default_listing_table_values`
--

CREATE TABLE `user_default_listing_table_values` (
  `user_default_listing_table_value_id` int(11) NOT NULL,
  `user_default_listing_table_value` int(11) NOT NULL,
  `user_default_listing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_listing_videos`
--

CREATE TABLE `user_default_listing_videos` (
  `iuser_default_listing_video_id` int(11) NOT NULL,
  `user_default_listing_video_user_uploaded` blob NOT NULL,
  `user_default_listing_video_link` varchar(100) NOT NULL,
  `user_default_listing_video_type` enum('0','1') NOT NULL COMMENT '0 - user introduction video\n1 - business idea video',
  `user_default_listing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_listing_voice_your_opinion`
--

CREATE TABLE `user_default_listing_voice_your_opinion` (
  `user_default_listing_comment_id` int(11) NOT NULL,
  `user_default_listing_comment` text NOT NULL,
  `user_default_listing_comment_attachment` varchar(100) DEFAULT NULL,
  `user_default_listing_comment_date` date NOT NULL,
  `user_default_listing_comment_time` time NOT NULL,
  `user_default_listing_comment_likes` int(11) NOT NULL DEFAULT '0',
  `user_default_listing_comment_dislikes` int(11) NOT NULL DEFAULT '0',
  `user_default_listing_comment_spam` enum('1','0') NOT NULL DEFAULT '1' COMMENT '0 - marked as spam, 1- not marked as spam',
  `user_default_listing_id` int(11) NOT NULL,
  `user_default_listing_comment_user_id` int(11) NOT NULL,
  `user_default_listing_comment_parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_log_transaction`
--

CREATE TABLE `user_default_log_transaction` (
  `transaction_id` int(11) NOT NULL,
  `user_default_id` int(11) NOT NULL,
  `log_id` int(11) NOT NULL,
  `transaction_description` varchar(250) NOT NULL,
  `transaction_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_log_transaction`
--

INSERT INTO `user_default_log_transaction` (`transaction_id`, `user_default_id`, `log_id`, `transaction_description`, `transaction_date`) VALUES
(1, 1, 2, 'Jaginder Singh Mudhar has been login successfully', '2016-03-21 12:07:02'),
(2, 1, 3, 'Jaginder Singh Mudhar has been logout successfully', '2016-03-21 12:12:24'),
(3, 2, 2, 'Jaginder Singh Mudhar has been login successfully', '2016-03-21 12:29:03'),
(4, 2, 3, 'Jaginder Singh Mudhar has been logout successfully', '2016-03-21 12:29:21'),
(5, 3, 2, 'Shameem Mudhar has been login successfully', '2016-03-21 12:49:48'),
(6, 3, 3, 'Shameem Mudhar has been logout successfully', '2016-03-21 12:50:08'),
(7, 4, 2, 'Suniel Singh Mudhar has been login successfully', '2016-03-21 03:09:34'),
(8, 4, 3, 'Suniel Singh Mudhar has been logout successfully', '2016-03-21 03:09:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_default_log_transaction_admin`
--

CREATE TABLE `user_default_log_transaction_admin` (
  `transaction_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `log_id` int(11) NOT NULL,
  `transaction_description` varchar(250) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `ip_address` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_log_transaction_admin`
--

INSERT INTO `user_default_log_transaction_admin` (`transaction_id`, `admin_id`, `log_id`, `transaction_description`, `transaction_date`, `ip_address`) VALUES
(1, 2, 2, 'jag has been login successfully', '2016-03-21 05:28:16', '82.47.62.112'),
(2, 2, 2, 'jag has been login successfully', '2016-03-21 08:19:26', '82.47.62.112'),
(3, 2, 2, 'jag has been login successfully', '2016-03-21 09:56:09', '82.47.62.112'),
(4, 2, 2, 'jag has been login successfully', '2016-03-21 11:35:20', '82.47.62.112');

-- --------------------------------------------------------

--
-- Table structure for table `user_default_log_types`
--

CREATE TABLE `user_default_log_types` (
  `log_id` int(11) NOT NULL,
  `log_type` varchar(80) NOT NULL,
  `log_description` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_log_types`
--

INSERT INTO `user_default_log_types` (`log_id`, `log_type`, `log_description`) VALUES
(1, 'Register', 'User has been registered successfully'),
(2, 'Login', 'User login to the site'),
(3, 'Logout', 'User logout from the site');

-- --------------------------------------------------------

--
-- Table structure for table `user_default_mail_template`
--

CREATE TABLE `user_default_mail_template` (
  `template_id` bigint(20) NOT NULL,
  `template_module` varchar(255) NOT NULL,
  `template_subject` varchar(255) NOT NULL,
  `template_body` text NOT NULL,
  `template_status` enum('0','1') NOT NULL DEFAULT '1',
  `template_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_mail_template`
--

INSERT INTO `user_default_mail_template` (`template_id`, `template_module`, `template_subject`, `template_body`, `template_status`, `template_create`) VALUES
(1, 'User_Activate_Account', 'Activate your account (businessinvention.com)', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Dear {{#USERNAME#}},</p>\r\n<p>We have recieved a request from you to become a member at {{#COMPANY_NAME#}}<br />Please click on the the link below to verify this request. <br /><br />{{#ACCOUNT_ACTIVATION_LINK#}} <br /><br />If clicking the link above does not work, copy (hover over the link, right click and copy the URL) and paste the URL into the browser window.</p>\r\n<p><br />If you have received this email in error, you do not need to take any action. <br />If you do not click on the link, your request for membership will be deleted. <br /><br /><br />Sincerely,<br />Business Supermarket Customer Accounts Team. <br /> <em>Note. This email address cannot accept replies.</em></p>\r\n</body>\r\n</html>', '1', '2014-06-09 22:40:35'),
(2, 'User_Registration_Completed', 'Account Registration Successully Completed', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Dear {{#USERNAME#}},<br /><br />Your account has been successfully activated. Please log in using your username and password.<br /><br />Welcome to your business community.<br /><br /> <br />Sincerely,<br />Business Supermarket Customer Accounts Team. <br /> <em>Note. This email address cannot accept replies.</em></p>\r\n</body>\r\n</html>', '1', '2014-06-10 01:41:48'),
(3, 'Password_Reset_Link', 'Account password reset request', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Dear {{#USERNAME#}}, <br /><br />You have requested a password reset request. Your account password has been reset.<br />Please click on the link below and update your password. <br /><br />{{#LINK#}} <br /><br /></p>\r\n<!-- [if gte mso 9]><xml>\r\n <o:OfficeDocumentSettings>\r\n  <o:AllowPNG/>\r\n </o:OfficeDocumentSettings>\r\n</xml><![endif]-->\r\n<p><span style="font-size: 10.0pt; font-family: \'Arial\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; color: #666666; mso-ansi-language: EN-GB; mso-fareast-language: EN-GB; mso-bidi-language: AR-SA;">If you did not authorize this change then please contact&nbsp;<span style="color: #0000ff;">{{#CSLINK#}}</span>&nbsp; to report a possible security breach of your account. You will be given instructions as to what to do next. You will also be contacted by our accounts security team who will look into this matter and take steps to ensure that this cannot happen again.<br /> <br /> <strong><em><span style="font-family: \'Arial\',sans-serif;">We take our members privacy very seriously, please report any breach of your details to support via the link given above.</span></em></strong></span></p>\r\n<!-- [if gte mso 9]><xml>\r\n <w:WordDocument>\r\n  <w:View>Normal</w:View>\r\n  <w:Zoom>0</w:Zoom>\r\n  <w:TrackMoves/>\r\n  <w:TrackFormatting/>\r\n  <w:PunctuationKerning/>\r\n  <w:ValidateAgainstSchemas/>\r\n  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>\r\n  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>\r\n  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>\r\n  <w:DoNotPromoteQF/>\r\n  <w:LidThemeOther>EN-GB</w:LidThemeOther>\r\n  <w:LidThemeAsian>X-NONE</w:LidThemeAsian>\r\n  <w:LidThemeComplexScript>X-NONE</w:LidThemeComplexScript>\r\n  <w:Compatibility>\r\n   <w:BreakWrappedTables/>\r\n   <w:SnapToGridInCell/>\r\n   <w:WrapTextWithPunct/>\r\n   <w:UseAsianBreakRules/>\r\n   <w:DontGrowAutofit/>\r\n   <w:SplitPgBreakAndParaMark/>\r\n   <w:EnableOpenTypeKerning/>\r\n   <w:DontFlipMirrorIndents/>\r\n   <w:OverrideTableStyleHps/>\r\n  </w:Compatibility>\r\n  <m:mathPr>\r\n   <m:mathFont m:val="Cambria Math"/>\r\n   <m:brkBin m:val="before"/>\r\n   <m:brkBinSub m:val="&#45;-"/>\r\n   <m:smallFrac m:val="off"/>\r\n   <m:dispDef/>\r\n   <m:lMargin m:val="0"/>\r\n   <m:rMargin m:val="0"/>\r\n   <m:defJc m:val="centerGroup"/>\r\n   <m:wrapIndent m:val="1440"/>\r\n   <m:intLim m:val="subSup"/>\r\n   <m:naryLim m:val="undOvr"/>\r\n  </m:mathPr></w:WordDocument>\r\n</xml><![endif]--><!-- [if gte mso 9]><xml>\r\n <w:LatentStyles DefLockedState="false" DefUnhideWhenUsed="false"\r\n  DefSemiHidden="false" DefQFormat="false" DefPriority="99"\r\n  LatentStyleCount="371">\r\n  <w:LsdException Locked="false" Priority="0" QFormat="true" Name="Normal"/>\r\n  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 1"/>\r\n  <w:LsdException Locked="false" Priority="9" SemiHidden="true"\r\n   UnhideWhenUsed="true" QFormat="true" Name="heading 2"/>\r\n  <w:LsdException Locked="false" Priority="9" SemiHidden="true"\r\n   UnhideWhenUsed="true" QFormat="true" Name="heading 3"/>\r\n  <w:LsdException Locked="false" Priority="9" SemiHidden="true"\r\n   UnhideWhenUsed="true" QFormat="true" Name="heading 4"/>\r\n  <w:LsdException Locked="false" Priority="9" SemiHidden="true"\r\n   UnhideWhenUsed="true" QFormat="true" Name="heading 5"/>\r\n  <w:LsdException Locked="false" Priority="9" SemiHidden="true"\r\n   UnhideWhenUsed="true" QFormat="true" Name="heading 6"/>\r\n  <w:LsdException Locked="false" Priority="9" SemiHidden="true"\r\n   UnhideWhenUsed="true" QFormat="true" Name="heading 7"/>\r\n  <w:LsdException Locked="false" Priority="9" SemiHidden="true"\r\n   UnhideWhenUsed="true" QFormat="true" Name="heading 8"/>\r\n  <w:LsdException Locked="false" Priority="9" SemiHidden="true"\r\n   UnhideWhenUsed="true" QFormat="true" Name="heading 9"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="index 1"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="index 2"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="index 3"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="index 4"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="index 5"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="index 6"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="index 7"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="index 8"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="index 9"/>\r\n  <w:LsdException Locked="false" Priority="39" SemiHidden="true"\r\n   UnhideWhenUsed="true" Name="toc 1"/>\r\n  <w:LsdException Locked="false" Priority="39" SemiHidden="true"\r\n   UnhideWhenUsed="true" Name="toc 2"/>\r\n  <w:LsdException Locked="false" Priority="39" SemiHidden="true"\r\n   UnhideWhenUsed="true" Name="toc 3"/>\r\n  <w:LsdException Locked="false" Priority="39" SemiHidden="true"\r\n   UnhideWhenUsed="true" Name="toc 4"/>\r\n  <w:LsdException Locked="false" Priority="39" SemiHidden="true"\r\n   UnhideWhenUsed="true" Name="toc 5"/>\r\n  <w:LsdException Locked="false" Priority="39" SemiHidden="true"\r\n   UnhideWhenUsed="true" Name="toc 6"/>\r\n  <w:LsdException Locked="false" Priority="39" SemiHidden="true"\r\n   UnhideWhenUsed="true" Name="toc 7"/>\r\n  <w:LsdException Locked="false" Priority="39" SemiHidden="true"\r\n   UnhideWhenUsed="true" Name="toc 8"/>\r\n  <w:LsdException Locked="false" Priority="39" SemiHidden="true"\r\n   UnhideWhenUsed="true" Name="toc 9"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Normal Indent"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="footnote text"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="annotation text"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="header"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="footer"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="index heading"/>\r\n  <w:LsdException Locked="false" Priority="35" SemiHidden="true"\r\n   UnhideWhenUsed="true" QFormat="true" Name="caption"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="table of figures"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="envelope address"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="envelope return"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="footnote reference"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="annotation reference"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="line number"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="page number"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="endnote reference"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="endnote text"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="table of authorities"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="macro"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="toa heading"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="List"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="List Bullet"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="List Number"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="List 2"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="List 3"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="List 4"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="List 5"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="List Bullet 2"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="List Bullet 3"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="List Bullet 4"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="List Bullet 5"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="List Number 2"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="List Number 3"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="List Number 4"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="List Number 5"/>\r\n  <w:LsdException Locked="false" Priority="10" QFormat="true" Name="Title"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Closing"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Signature"/>\r\n  <w:LsdException Locked="false" Priority="1" SemiHidden="true"\r\n   UnhideWhenUsed="true" Name="Default Paragraph Font"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Body Text"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Body Text Indent"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="List Continue"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="List Continue 2"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="List Continue 3"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="List Continue 4"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="List Continue 5"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Message Header"/>\r\n  <w:LsdException Locked="false" Priority="11" QFormat="true" Name="Subtitle"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Salutation"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Date"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Body Text First Indent"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Body Text First Indent 2"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Note Heading"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Body Text 2"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Body Text 3"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Body Text Indent 2"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Body Text Indent 3"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Block Text"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Hyperlink"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="FollowedHyperlink"/>\r\n  <w:LsdException Locked="false" Priority="22" QFormat="true" Name="Strong"/>\r\n  <w:LsdException Locked="false" Priority="20" QFormat="true" Name="Emphasis"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Document Map"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Plain Text"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="E-mail Signature"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="HTML Top of Form"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="HTML Bottom of Form"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Normal (Web)"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="HTML Acronym"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="HTML Address"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="HTML Cite"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="HTML Code"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="HTML Definition"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="HTML Keyboard"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="HTML Preformatted"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="HTML Sample"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="HTML Typewriter"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="HTML Variable"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Normal Table"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="annotation subject"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="No List"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Outline List 1"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Outline List 2"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Outline List 3"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Simple 1"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Simple 2"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Simple 3"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Classic 1"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Classic 2"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Classic 3"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Classic 4"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Colorful 1"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Colorful 2"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Colorful 3"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Columns 1"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Columns 2"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Columns 3"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Columns 4"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Columns 5"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Grid 1"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Grid 2"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Grid 3"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Grid 4"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Grid 5"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Grid 6"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Grid 7"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Grid 8"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table List 1"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table List 2"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table List 3"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table List 4"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table List 5"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table List 6"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table List 7"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table List 8"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table 3D effects 1"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table 3D effects 2"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table 3D effects 3"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Contemporary"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Elegant"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Professional"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Subtle 1"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Subtle 2"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Web 1"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Web 2"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Web 3"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Balloon Text"/>\r\n  <w:LsdException Locked="false" Priority="39" Name="Table Grid"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"\r\n   Name="Table Theme"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" Name="Placeholder Text"/>\r\n  <w:LsdException Locked="false" Priority="1" QFormat="true" Name="No Spacing"/>\r\n  <w:LsdException Locked="false" Priority="60" Name="Light Shading"/>\r\n  <w:LsdException Locked="false" Priority="61" Name="Light List"/>\r\n  <w:LsdException Locked="false" Priority="62" Name="Light Grid"/>\r\n  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1"/>\r\n  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2"/>\r\n  <w:LsdException Locked="false" Priority="65" Name="Medium List 1"/>\r\n  <w:LsdException Locked="false" Priority="66" Name="Medium List 2"/>\r\n  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1"/>\r\n  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2"/>\r\n  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3"/>\r\n  <w:LsdException Locked="false" Priority="70" Name="Dark List"/>\r\n  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading"/>\r\n  <w:LsdException Locked="false" Priority="72" Name="Colorful List"/>\r\n  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid"/>\r\n  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 1"/>\r\n  <w:LsdException Locked="false" SemiHidden="true" Name="Revision"/>\r\n  <w:LsdException Locked="false" Priority="34" QFormat="true"\r\n   Name="List Paragraph"/>\r\n  <w:LsdException Locked="false" Priority="29" QFormat="true" Name="Quote"/>\r\n  <w:LsdException Locked="false" Priority="30" QFormat="true"\r\n   Name="Intense Quote"/>\r\n  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="19" QFormat="true"\r\n   Name="Subtle Emphasis"/>\r\n  <w:LsdException Locked="false" Priority="21" QFormat="true"\r\n   Name="Intense Emphasis"/>\r\n  <w:LsdException Locked="false" Priority="31" QFormat="true"\r\n   Name="Subtle Reference"/>\r\n  <w:LsdException Locked="false" Priority="32" QFormat="true"\r\n   Name="Intense Reference"/>\r\n  <w:LsdException Locked="false" Priority="33" QFormat="true" Name="Book Title"/>\r\n  <w:LsdException Locked="false" Priority="37" SemiHidden="true"\r\n   UnhideWhenUsed="true" Name="Bibliography"/>\r\n  <w:LsdException Locked="false" Priority="39" SemiHidden="true"\r\n   UnhideWhenUsed="true" QFormat="true" Name="TOC Heading"/>\r\n  <w:LsdException Locked="false" Priority="41" Name="Plain Table 1"/>\r\n  <w:LsdException Locked="false" Priority="42" Name="Plain Table 2"/>\r\n  <w:LsdException Locked="false" Priority="43" Name="Plain Table 3"/>\r\n  <w:LsdException Locked="false" Priority="44" Name="Plain Table 4"/>\r\n  <w:LsdException Locked="false" Priority="45" Name="Plain Table 5"/>\r\n  <w:LsdException Locked="false" Priority="40" Name="Grid Table Light"/>\r\n  <w:LsdException Locked="false" Priority="46" Name="Grid Table 1 Light"/>\r\n  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2"/>\r\n  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3"/>\r\n  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4"/>\r\n  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark"/>\r\n  <w:LsdException Locked="false" Priority="51" Name="Grid Table 6 Colorful"/>\r\n  <w:LsdException Locked="false" Priority="52" Name="Grid Table 7 Colorful"/>\r\n  <w:LsdException Locked="false" Priority="46"\r\n   Name="Grid Table 1 Light Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="51"\r\n   Name="Grid Table 6 Colorful Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="52"\r\n   Name="Grid Table 7 Colorful Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="46"\r\n   Name="Grid Table 1 Light Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="51"\r\n   Name="Grid Table 6 Colorful Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="52"\r\n   Name="Grid Table 7 Colorful Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="46"\r\n   Name="Grid Table 1 Light Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="51"\r\n   Name="Grid Table 6 Colorful Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="52"\r\n   Name="Grid Table 7 Colorful Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="46"\r\n   Name="Grid Table 1 Light Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="51"\r\n   Name="Grid Table 6 Colorful Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="52"\r\n   Name="Grid Table 7 Colorful Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="46"\r\n   Name="Grid Table 1 Light Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="51"\r\n   Name="Grid Table 6 Colorful Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="52"\r\n   Name="Grid Table 7 Colorful Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="46"\r\n   Name="Grid Table 1 Light Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="51"\r\n   Name="Grid Table 6 Colorful Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="52"\r\n   Name="Grid Table 7 Colorful Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="46" Name="List Table 1 Light"/>\r\n  <w:LsdException Locked="false" Priority="47" Name="List Table 2"/>\r\n  <w:LsdException Locked="false" Priority="48" Name="List Table 3"/>\r\n  <w:LsdException Locked="false" Priority="49" Name="List Table 4"/>\r\n  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark"/>\r\n  <w:LsdException Locked="false" Priority="51" Name="List Table 6 Colorful"/>\r\n  <w:LsdException Locked="false" Priority="52" Name="List Table 7 Colorful"/>\r\n  <w:LsdException Locked="false" Priority="46"\r\n   Name="List Table 1 Light Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="51"\r\n   Name="List Table 6 Colorful Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="52"\r\n   Name="List Table 7 Colorful Accent 1"/>\r\n  <w:LsdException Locked="false" Priority="46"\r\n   Name="List Table 1 Light Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="51"\r\n   Name="List Table 6 Colorful Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="52"\r\n   Name="List Table 7 Colorful Accent 2"/>\r\n  <w:LsdException Locked="false" Priority="46"\r\n   Name="List Table 1 Light Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="51"\r\n   Name="List Table 6 Colorful Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="52"\r\n   Name="List Table 7 Colorful Accent 3"/>\r\n  <w:LsdException Locked="false" Priority="46"\r\n   Name="List Table 1 Light Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="51"\r\n   Name="List Table 6 Colorful Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="52"\r\n   Name="List Table 7 Colorful Accent 4"/>\r\n  <w:LsdException Locked="false" Priority="46"\r\n   Name="List Table 1 Light Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="51"\r\n   Name="List Table 6 Colorful Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="52"\r\n   Name="List Table 7 Colorful Accent 5"/>\r\n  <w:LsdException Locked="false" Priority="46"\r\n   Name="List Table 1 Light Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="51"\r\n   Name="List Table 6 Colorful Accent 6"/>\r\n  <w:LsdException Locked="false" Priority="52"\r\n   Name="List Table 7 Colorful Accent 6"/>\r\n </w:LatentStyles>\r\n</xml><![endif]--><!-- [if gte mso 10]>\r\n<style>\r\n /* Style Definitions */\r\n table.MsoNormalTable\r\n	{mso-style-name:"Table Normal";\r\n	mso-tstyle-rowband-size:0;\r\n	mso-tstyle-colband-size:0;\r\n	mso-style-noshow:yes;\r\n	mso-style-priority:99;\r\n	mso-style-parent:"";\r\n	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;\r\n	mso-para-margin:0cm;\r\n	mso-para-margin-bottom:.0001pt;\r\n	mso-pagination:widow-orphan;\r\n	font-size:11.0pt;\r\n	font-family:"Calibri",sans-serif;\r\n	mso-ascii-font-family:Calibri;\r\n	mso-ascii-theme-font:minor-latin;\r\n	mso-hansi-font-family:Calibri;\r\n	mso-hansi-theme-font:minor-latin;\r\n	mso-fareast-language:EN-US;}\r\n</style>\r\n<![endif]-->\r\n<p><br /><br />Sincerely,<br />Business Supermarket Customer Accounts Team. <br /> <em>Note. This email address cannot accept replies.</em></p>\r\n</body>\r\n</html>', '1', '2014-06-11 02:46:34'),
(4, 'Business_Activate_Account', 'Activate your account (businessinvention.com)', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Dear {{#USERNAME#}}, <br /><br />We have recieved a request from you to become a member at {{#COMPANY_NAME#}} <br />Please click on the the link below to verify this request. <br /><br />{{#ACCOUNT_ACTIVATION_LINK#}} <br /><br />If clicking the link above does not work, copy and paste the URL (hover over the link to get the URL) in a new browser window instead. If you have received this email in error, you do not need to take any action. <br />If you do not click on the link, your request for membership will be deleted. <br /><br /><br />Sincerely,<br />Business Supermarket Customer Accounts Team. <br /> <em>Note. This email address cannot accept replies.</em></p>\r\n</body>\r\n</html>', '1', '2014-06-13 01:03:49'),
(5, 'Business_Registration_Completed', 'Business Account Activated Successfully', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Dear {{#USERNAME#}}, <br /><br />Your account has been successfuly activated. Please log in using your username and password.<br /><br />Welcome to your business community. <br /><br /><br />Sincerely,<br />Business Supermarket Customer Accounts Team. <br /> <em>Note. This email address cannot accept replies.</em></p>\r\n</body>\r\n</html>', '1', '2014-06-16 00:01:03'),
(6, 'Email_Update', 'Your account email updated successfully', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Dear {{#USERNAME#}},</p>\r\n<p>This is a notification that your account email was successfully changed from {{#OLD_EMAIL#}} to {{#NEW_EMAIL#}}<br /><br />If you did not authorize this change then please contact <span style="color: #0000ff;">{{#CSLINK#}}</span>&nbsp;to report a possible security breach of your account. You will be given instructions as to what to do next. You will also be contacted by our accounts security team who will look into this matter and take steps to ensure that this cannot happen again.<br /><br /><strong><em>We take our members privacy very seriously, please report any breach of your details to support via the link given above.</em></strong><br /><br /></p>\r\n<p>Sincerely,<br />Business Supermarket Customer Accounts Team. <br /> <em>Note. This email address cannot accept replies.</em></p>\r\n</body>\r\n</html>', '1', '2014-08-01 06:00:43'),
(7, 'Currency_Update', 'Account Currency Updated Successfully', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Dear {{#USERNAME#}},</p>\r\n<p>This is a notification that your account currency was successfully updated.<br /><br />If you did not authorize this change then please contact&nbsp;<span style="color: #0000ff;">{{#CSLINK#}}</span> to report a possible security breach of your account. You will be given instructions as to what to do next. You will also be contacted by our accounts security team who will look into this matter and take steps to ensure that this cannot happen again.<br /><br /><em><strong>We take our members privacy very seriously, please report any breach of your details to support via the link given above.</strong></em><br /><br /><br />Sincerely,<br />Business Supermarket Customer Accounts Team. <br /> <em>Note. This email address cannot accept replies.</em></p>\r\n</body>\r\n</html>', '1', '2014-08-13 06:26:01'),
(8, 'Password_Reset_Successful', 'Account Password Reset Successfullly', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Dear {{#USERNAME#}},</p>\r\n<p>This is a notification that your account password was successfully updated<br /><br />If you did not authorize this change then please contact&nbsp;<span style="color: #0000ff;">{{#CSLINK#}}</span>&nbsp;to report a possible security breach of your account. You will be given instructions as to what to do next. You will also be contacted by our accounts security team who will look into this matter and take steps to ensure that this cannot happen again.<br /><br /><strong><em>We take our members privacy very seriously, please report any breach of your details to support via the link given above.</em></strong><br /><br /><br />Sincerely,<br />Business Supermarket Customer Accounts Team. <br /> <em>Note. This email address cannot accept replies.</em></p>\r\n</body>\r\n</html>', '1', '2014-08-13 06:27:15'),
(9, 'get_professional_help', 'module subject text to go here', 'Enter the code required to insert the data entered in this module to allow the user to send the email query<br /><br /><br />Sincerely,<br />Business Supermarket Customer Support Team. <br /> <em>Note. This email address cannot accept replies.</em>', '1', '2014-09-05 23:36:46'),
(10, 'Password_Update', 'Password Change Notification', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Dear {{#USERNAME#}},</p>\r\n<p>This is a notification that your account password was successfully changed.<br /><br />If you did not authorize this change then please contact <span style="color: #0000ff;">{{#CSLINK#}}</span>&nbsp;to report a possible security breach of your account. You will be given instructions as to what to do next. You will also be contacted by our accounts security team who will look into this matter and take steps to ensure that this cannot happen again.<br /><br /><strong><em>We take our members privacy very seriously, please report any breach of your details to support via the link given above.</em></strong><br /><br /><br />Sincerely,<br />Business Supermarket Customer Accounts Team. <br /> <em>Note. This email address cannot accept replies.</em></p>\r\n</body>\r\n</html>', '1', '2014-09-21 17:49:41'),
(11, 'forum_report_comment_as_spam', 'Listing No {{#LISTING_NUMBER#}} spam notice', 'Dear admin<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The following comment was reported as spam:<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Username: {{#COMMENT_OWNER#}}<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date: {{#COMMENT_DATE#}}<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Comment:<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{#COMMENT_CONTENT#}}<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{#LISTING_OWNER#}}<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{#LISTING_TITLE#}}<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{#LISTING_LINK#}}<br /><br /><br />Sincerely,<br />Business Supermarket, <br /> <em>Note. This email address cannot accept replies.</em>', '1', '2014-10-12 12:17:11'),
(12, 'Marketing_Email', 'Website update', '<p>Dear {{#USERNAME#}},<br /><br />{{#MESSAGE#}}</p>\r\n<p><br />Sincerely,<br />Business Supermarket Customer Support Team. <br /> <em>Note. This email address cannot accept replies.</em></p>', '1', '2014-10-11 23:50:05'),
(13, 'User_SendEmail', 'Send mail to user from their profile', '<p>Dear {{#USERNAME#}},<br /><br />{{#MESSAGE#}}</p>\r\n<p><br />Sincerely,<br />Business Supermarket Customer Support Team. <br /> <em>Note. This email address cannot accept replies.</em></p>', '1', '2014-10-18 20:39:10'),
(14, 'Suspend_Account', 'Suspend User Account', '<p>Dear {{#USERNAME#}},<br /><br />{{#MESSAGE#}}</p>\r\n<p><br />Sincerely,<br />Business Supermarket Customer Support Team. <br /> <em>Note. This email address cannot accept replies.</em><em><br /></em></p>', '1', '2014-10-18 20:56:59'),
(15, 'Delete_Account', 'Account deletion notification', '<p>Dear {{#USERNAME#}},<br /><br />This is a notification that your account was deleted from our servers due to violation of our terms of use policy.<br /><br /></p>\r\n<p>Sincerely,<br />Business Supermarket Customer Accounts Team. <br /> <em>Note. This email address cannot accept replies.</em></p>', '1', '2014-10-18 21:25:35'),
(16, 'banner_rejection', 'Banner rejection notice', '<br />Your banner submission was rejected for the following reason:- <br /><br />{{#ADMINMESSAGE#}}<br />{{#BANNERIMAGE#}}<br /><br />Banner submission date: {{#SUBMISSIONDATE#}}<br />Banner title: {{#TITLE#}}<br />Banner link: {{#BANNERLINK#}}<br />Banner duration: {{#DURATION#}}<br />Banner cost: {{#COST#}}<br />Banner status: {{#STATUS#}}<br /><br />A copy of the banner is shown below for your records<br /><br />{{#LINK#}}<br /><br /><span style="font-family: Verdana; font-size: 7pt; color: #231f20; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #231f20; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #231f20; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #f37121; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #231f20; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #f37121; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #231f20; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 10pt; color: #231f20; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #231f20; font-style: normal; font-variant: normal;"><br /></span></span></span></span></span></span></span></span></span>Sincerely,<br />Business Supermarket Banner Submissions Team. <br /> <em>Note. This email address cannot accept replies.</em>', '1', '2014-09-29 02:12:49');
INSERT INTO `user_default_mail_template` (`template_id`, `template_module`, `template_subject`, `template_body`, `template_status`, `template_create`) VALUES
(17, 'banner_advertisment_support_team', 'Banner advertisment support team', 'Your banner submission was rejected for the following reason:- {{#ADMINMESSAGE#}} {{#BANNERIMAGE#}} Banner submission date: {{#SUBMISSIONDATE#}} Banner title: {{#TITLE#}} Banner link: {{#LINK#}} Banner duration: {{#DURATION#}} Banner cost: {{#COST#}} Banner status: {{#STATUS#}} A copy of the banner is shown below for your records <br /><br /><br />Sincerely,<br />Business Supermarket Banner Submissions Team. <br /> <em>Note. This email address cannot accept replies.</em>', '1', '2014-09-30 23:25:21'),
(18, 'banner_submission_notice', 'Banner submission notice', '<span style="font-family: Verdana; font-size: 10pt; color: #231f20; font-style: normal; font-variant: normal;">Dear {{#USER_NAME#}}<br /><br />Your banner submission was successful and is waiting admin approval before it is published.<br /><br />Banner submission date: {{#BANNER_SUBMITTED_DATE#}}<br />Banner title: {{#IMAGE_NAME#}}<br />Banner link: {{#BANNER_LINK#}}<br />Banner duration: {{#BANNER_DURATION#}}<br />Banner cost: {{#AMOUNT_PAID#}}<br />Banner status: {{#STATUS#}}<br /><br />A copy of the banner is shown below for your records</span><span style="font-family: Verdana; font-size: 7pt; color: #231f20; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #231f20; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #231f20; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #f37121; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #231f20; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #f37121; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #231f20; font-style: normal; font-variant: normal;"><br /></span></span></span></span></span></span></span><br /><span style="font-family: Verdana; font-size: 7pt; color: #231f20; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #231f20; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #231f20; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #f37121; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #231f20; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #f37121; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #231f20; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 10pt; color: #231f20; font-style: normal; font-variant: normal;">{{#BANNER_IMAGE#}}<br /></span></span></span></span></span></span></span></span><br /><br />Sincerely,<br />Business Supermarket Banner Submissions Team. <br /> <em>Note. This email address cannot accept replies.</em><br /><span style="font-family: Verdana; font-size: 7pt; color: #231f20; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #231f20; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #231f20; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #f37121; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #231f20; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #f37121; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #231f20; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 10pt; color: #231f20; font-style: normal; font-variant: normal;"><span style="font-family: Verdana; font-size: 7pt; color: #231f20; font-style: normal; font-variant: normal;"><br class="Apple-interchange-newline" /></span><br /><br /><br /><br /><br /></span><br class="Apple-interchange-newline" /></span></span></span></span></span></span></span>', '1', '2014-10-15 00:16:52'),
(19, 'banner_submission_notice_admin', 'Banner submission notice', 'Dear Admin<br /><br />You have received a new banner advertisement submision .<br />Please click {{#HERE#}} to review and publish the banner.<br /><br />Sincerely,<br /><em>website admin notice.</em>', '1', '2014-10-15 00:20:25'),
(20, 'report_new_registrations', 'New registrations report', 'Dear admin,<br /><br /><span style="text-decoration: underline;"><strong>Users Registrations :</strong></span><br />Default user registrations: {{#DEFAULT_USER_REGISTRATION_NB#}}<br />Business services registrations: {{#BUSINESS_SERVICES_REGISTRATION_NB#}}<br />Total No of default users todate: {{#DEFAULt_USER_TO_DATE#}}<br />Total No of Business services users todate: {{#BUSINESS_SERVICES_TO_DATE#}}<br /><br /><span style="text-decoration: underline;"><strong>Listing submissions :</strong></span><br />Total No user listings waiting publication: {{#USER_LISTINGS_WAITING_PUBLICATION#}}<br />Total No of business services listing waiting publication: {{#BUSINESS_LISTINGS_WAITING_PUBLICATION#}}<br />Total No of active user listings: {{#ACTIVE_USER_SERVICES_LISTINGS#}}<br />Total No of active Business services listings: {{#ACTIVE_BUSINESS_SERVICES_LISTINGS#}}<br /><br /><span style="text-decoration: underline;"><strong>Banner advert Submissions :</strong></span><br />Total No of User banner advert waiting approval: {{#WAITING_USER_BANNERS#}}<br />Total No of Business Services User banner waiting approval: {{#WAITING_BUSINESS_BANNERS#}}<br />Total No of Active Banners: {{#ACTIVE_BANNERS#}}<br /><br />Sincerely,<br /><em>website admin notice.</em>', '1', '2014-10-23 11:33:06'),
(21, 'Withdraw_Admin_Notice_Transaction', 'Withdraw Admin Notice Transaction', 'Dear Admin,<br /><br />{{#USERNAME#}} has requested a withdrawal from their account of {{#WITHDRAWAMOUNT#}}.<br /><br />Please action this request as soon as possible.<br /><br /><br />Sincerely,<br /><em>website admin notice.</em>', '1', '2014-11-13 00:27:39'),
(22, 'Account_Activation_Notice', 'Account Activation Notice', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Dear {{#USERNAME#}}<br /><br />This is a notification that your account has been re-activated. Please log into your account using your username and password.<br /><br />If you have any problems then please contact&nbsp;<span style="color: #0000ff;">{{#LINK#}}</span> for further assistance.<br /><br /> {{#MESSAGE#}} <br /><br /> Sincerely,<br />Business Supermarket Customer Accounts Team. <br /> <em>Note. This email address cannot accept replies.</em></p>\r\n</body>\r\n</html>', '1', '2014-11-11 23:44:56'),
(23, 'Send_Email', 'Send Email', '<p>Dear {{#USERNAME#}},</p>\r\n<p>{{#MESSAGE#}}<br /><br /></p>\r\nSincerely,<br />Business Supermarket Customer Support Team. <br /> <em>Note. This email address cannot accept replies.</em>', '1', '2014-11-12 00:01:14'),
(24, 'Delete_Account', 'Account deletion notification', '<p>Dear {{#USERNAME#}},<br /><br />This is a notification that your account was deleted from our servers due to violation of our terms of use policy.<br /><br /></p>\r\n<p>Sincerely,<br />Business Supermarket Customer Accounts Team. <br /> <em>Note. This email address cannot accept replies.</em></p>', '1', '2014-11-12 00:07:52'),
(25, 'User_profile_update_notification', 'User profile update notification', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Dear {{#USERNAME#}}<br /><br />Your user profile was updated by admin as explained below:-<br /><br />{{#MESSAGE#}}</p>\r\n<p>If you do not agree with the changes, you may contact&nbsp;<span style="color: #0000ff;">{{#CSLINK#}}</span>&nbsp;to have the changes reversed or changed.<br /><br /></p>\r\n<p>Sincerely,<br />Business Supermarket Customer Accounts Team. <br /> <em>Note. This email address cannot accept replies.</em></p>\r\n</body>\r\n</html>', '1', '2014-11-12 00:24:53'),
(26, 'Account_suspension_notice', 'Account suspension notice', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Dear {{#USERNAME#}}<br /><br /></p>\r\n<p>This is a notification that your account has been removed off Business Supermarket.com because it has not been verified.</p>\r\n<p>If you feel that we may have got it wrong then please click the following link and confirm your details {{#LINK#}}</p>\r\n<p><br /><br />Sincerely,<br />Business Supermarket Accounts Team. <br /> <em>Note: This email address cannot accept replies.<br /></em></p>\r\n</body>\r\n</html>', '1', '2014-11-12 01:16:29'),
(27, 'Marketing_Email', 'Marketing Email', '<p>Dear {{#USERNAME#}},</p>\r\n<p>{{#MESSAGE}}<br /><br /></p>\r\n<p>Sincerely,<br />Business Supermarket Customer Support Team. <br /> <em>Note. This email address cannot accept replies.</em></p>', '1', '2014-11-22 08:23:54'),
(28, 'Add_Fund_Notice_Transaction', 'Funds received', '<p>Accounts department<br /><br />You have received the following funds.<br />Username: <strong>{{#USERNAME#}}</strong></p>\r\n<p>Full name: <strong>{{#FULLNAME#}}</strong></p>\r\n<p>User email: <strong>{{#USEREMAIL#}}</strong></p>\r\n<p>Type of transaction: <strong>{{#TYPEOFTRANSACTION#}}</strong></p>\r\n<p>Transaction ref: <strong>{{#TRANSACTIONREF#}}</strong></p>\r\n<p>Bank: <strong>{{#BANK#}}</strong></p>\r\n<p>Amount received:<strong>{{#AMOUNTRECEIVED#}}</strong></p>\r\n<p><br />Sincerely,<br /><em>Website admin notice.</em></p>', '1', '2014-12-03 13:24:22'),
(29, 'user_listing_report', 'Listing daily / weekly / monthly update report', '<p>Dear {{#USERNAME#}},</p>\r\n<p>This is a {{#STATUS#}} progress report on {{#LISTINGTITLE#}}.&nbsp;</p>\r\n<p><br /><br />Listing title:&nbsp;{{#LISTINGTITLE#}}<br /> Date of submission:&nbsp;{{#LISTINGDATE#}}<br /> Status:&nbsp;{{#LISTINGSTATUS#}}<br /> Number of days active:&nbsp;{{#DA#}}<br /> Number of page visits:&nbsp;&nbsp;{{#PV#}}<br />Number of votes received:&nbsp;{{#VOTES#}}<br /> Number of comments received:&nbsp;{{#COMMENTS#}}<br /> Number of messages received&nbsp;{{#MESSAGES#}}</p>\r\n<p>&nbsp;</p>\r\n<p>You get full details of how your listing is performing {{#LISTINGLINK#}}&nbsp;<br /><br /></p>\r\n<p>Sincerely,<br />Business Supermarket Listing Support Team. <br /> <em>Note. This email address cannot accept replies.</em></p>\r\n<div>&nbsp;</div>', '1', '2015-01-13 12:52:54'),
(30, 'user_listing_submit', 'Listing submission notification', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Dear {{#USERNAME#}},<br /><br /></p>\r\n<p>You have successfully submitted your listing</p>\r\n<p>Listing title:&nbsp;<span style="color: #0000ff;">{{#LISTINGTITLE#}}</span><br />Date of submission:&nbsp;<span style="color: #0000ff;">{{#LISTINGDATE#}}</span><br />Status:&nbsp;<span style="color: #e5a04d;">{{#LISTINGSTATUS#}}</span></p>\r\n<p>You may go back anytime and see a preview of your listing as well as make any</p>\r\n<p>alterations while it is waiting for publication <span style="color: #0000ff;">{{#LLINK#}}</span></p>\r\n<p><br />You will be notified when your listing is published<br /><br /></p>\r\n<p>Sincerely,<br />Business Supermarket Listing Support Team. <br /> <em>Note. This email address cannot accept replies.</em></p>\r\n<div>&nbsp;</div>\r\n</body>\r\n</html>', '1', '2015-01-13 12:53:46'),
(31, 'user_listing_publish', 'Your listing has been successfully published', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div>Dear {{#USERNAME#}},<br /><br /></div>\r\n<div>&nbsp;</div>\r\n<div>\r\n<div>Your listing has now been published.</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Listing title: <strong><span style="color: #0000ff;">{{#LISTINGTITLE#}}</span></strong></div>\r\n<div>Date of submission: <strong><span style="color: #0000ff;">{{#LISTINGDATE#}}</span></strong></div>\r\n<div>Status: <strong><span style="color: #339966;">{{#LISTINGSTATUS#}}</span></strong></div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Please access your account and market your listing using your marketing tools {{#LLINK#}}.</div>\r\n<div>&nbsp;</div>\r\n<div>Not sure how to do this? Then watch a short video {{#SITELINK#}}</div>\r\n<div>&nbsp;</div>\r\n<div>You may view your listing {{#LISTINGLINK#}}</div>\r\n</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<p>Sincerely,<br />Business Supermarket Listing Support Team. <br /> <em>Note. This email address cannot accept replies.</em></p>\r\n<div>&nbsp;</div>\r\n</body>\r\n</html>', '1', '2015-01-16 04:44:45'),
(32, 'Listing_update', 'Listing update notification', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div>Dear {{#USERNAME#}},</div>\r\n<div>&nbsp;</div>\r\n<div>Your listing was modified to conform with our terms and conditions. Details of the modification / changes are give below:-</div>\r\n<div>&nbsp;</div>\r\n<div><span style="color: #0000ff;">{{#MESSAGE#}}</span><br /><br /></div>\r\n<div>You may view your listing {{#LISTINGLINK#}}</div>\r\n<div>&nbsp;</div>\r\n<div>If you do not agree with the changes then please contact the&nbsp;<span style="color: #0000ff;">{{#LSLINK#}}</span>&nbsp;to help resolve this matter</div>\r\n<div>&nbsp;</div>\r\n<p>Sincerely,<br />Business Supermarket Listing Support Team. <br /> <em>Note. This email address cannot accept replies.</em></p>\r\n<div>&nbsp;</div>\r\n</body>\r\n</html>', '1', '2015-01-16 04:59:35'),
(33, 'Listing_save_for_later', '{{#LISTINGTITLE#}} has been successfully saved for later', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Dear {{#USERNAME#}},<br /><br /></p>\r\n<p>You have successfully saved a draft copy your listing to be completed later.</p>\r\n<p>Listing title:&nbsp;<span style="color: #ff6600;"><em>{{#LISTINGTITLE#}}</em></span><br />Date of submission:&nbsp;<span style="color: #ff6600;"><em>{{#LISTINGDATE#}}</em></span><br />Status:&nbsp;<span style="color: #0000ff;"><em>{{#LISTINGSTATUS#}}</em></span><br />&nbsp;</p>\r\n<p>You may access your listing at anytime to complete it and submit it for publication {{#LISTINGLINK#}}&nbsp;<br /><br /></p>\r\n<p>Sincerely,<br />Business Supermarket Listing Support Team. <br /> <em>Note. This email address cannot accept replies.</em></p>\r\n<div>&nbsp;</div>\r\n</body>\r\n</html>', '1', '2015-01-16 05:06:51'),
(34, 'Listing_rejection', 'Listing rejection notification', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div>Dear {{#USERNAME#}},<br />&nbsp;</div>\r\n<div>Your listing has been rejected for the following reason.</div>\r\n<div>&nbsp;&nbsp;</div>\r\n<div><span style="color: #0000ff;">{{#MESSAGE#}}</span><br /><br /></div>\r\n<div>Please access your account {{#SITELINK#}} &nbsp;and make the requested alterations.</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<p>Sincerely,<br />Business Supermarket Listing Support Team. <br /> <em>Note. This email address cannot accept replies.</em></p>\r\n<div>&nbsp;</div>\r\n</body>\r\n</html>', '1', '2015-01-16 05:19:41'),
(35, 'Listing_suspension', 'Listing suspension notice', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div>Dear {{#USERNAME#}},<br /><br /></div>\r\n<div>Your listing has been suspended for the following reason:-</div>\r\n<div>\r\n<div>&nbsp;<br /><span style="color: #0000ff;">{{#MESSAGE#}}</span></div>\r\n<div>&nbsp;</div>\r\n<div>Please access your account and resubmit your listing after making any changes <span style="color: #0000ff;">{{#LISTINGLINK#}}</span></div>\r\n</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<p>Sincerely,<br />Business Supermarket Listing Support Team. <br /> <em>Note. This email address cannot accept replies.</em></p>\r\n<div>&nbsp;</div>\r\n</body>\r\n</html>', '1', '2015-01-16 05:30:14'),
(36, 'Listing_deletion', 'Listing has been deleted ', '<div>Dear {{#USERNAME#}},<br />&nbsp;</div>\r\n<div>\r\n<div>Your listing {{#LISTINGTITLE#}} &nbsp;has been deleted and removed off Business Supermarket website</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n</div>\r\nSincerely,<br />Business Supermarket Listing Support Team. <br /> <em>Note. This email address cannot accept replies.</em>\r\n<div>&nbsp;</div>', '1', '2015-01-16 05:35:10'),
(37, 'listing_via_contact_user', 'Listing {{#LISTINGTITLE#}} requires your input', '<div>Dear {{#USERNAME#}},<br /><br /><br /></div>\r\n<div>An interested party has requested information on&nbsp;{{#LISTINGTITLE#}}.<br />Please log into your account {{#SITELINK#}} &nbsp;to respond to the query</div>\r\n<div>&nbsp;</div>\r\n&nbsp;\r\n<div>Sincerely,<br />Business Supermarket Listing Support Team. <br /> <em>Note. This email address cannot accept replies.</em></div>\r\n<div>&nbsp;</div>', '1', '2015-01-16 05:43:03'),
(38, 'listing_via_contact_user2', 'You have received a message', '<div>Dear {{#USERNAME#}},<br /><br /></div>\r\n<div>User {{#SNAME#}} (username :&nbsp;&nbsp;{{#SUNAME#}}) has sent the following message:</div>\r\n<div>\r\n<div>&nbsp;</div>\r\n<div>{{#MESSAGE#}}</div>\r\n<div>&nbsp;</div>\r\n<div>You may respond to the query {{#SITELINK#}}</div>\r\n</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\nSincerely,<br />Business Supermarket Listing Support Team. <br /> <em>Note. This email address cannot accept replies.</em>', '1', '2015-01-16 05:48:34'),
(39, 'listing_via_contact_user3', 'You have sent a message to', '<div>\r\n<div>Dear {{#USERNAME#}},</div>\r\n<div>&nbsp;</div>\r\n<div>You have sent the following message to {{#LISTINGTITLE#}}</div>\r\n<div>&nbsp;</div>\r\n<div>{{#MESSAGE#}}</div>\r\n<div>&nbsp;</div>\r\n<div>You will be notified when {{#USER#}} &nbsp;has responded to your query&nbsp;</div>\r\n</div>\r\n<div>&nbsp;</div>\r\n&nbsp;\r\n<div>Sincerely,<br />Business Supermarket Listing Support Team. <br /> <em>Note. This email address cannot accept replies.</em></div>\r\n<div>&nbsp;</div>', '1', '2015-01-16 05:54:23'),
(40, 'Listing_mark_delete', 'Listing has been marked for deletion', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div>Dear {{#USERNAME#}},<br /><br /></div>\r\n<div>Your listing {{#LISTINGTITLE#}} has been marked for deletion for the following reason:-</div>\r\n<div>\r\n<div>&nbsp;</div>\r\n<div>{{#MESSAGE#}}<br />You now have 7 days to request a copy of your listing complete with all collected data for your records {{#LISTINGLINK#}}<br /><br />\r\n<div>If you do not wish your listing to be deleted off our servers then please&nbsp;<span style="color: #0000ff;">{{#CSLINK#}}</span>&nbsp;giving reasons why you do not wish this to happen and how you will address any issues that have been given above.<br /><br /></div>\r\n<div>\r\n<div>Please note after 7 days you will not be able to get a copy of your listing and all the data it has collected while it was active.</div>\r\n<div>This action is irreversible. To find out more click&nbsp;&nbsp;{{#SITELINK#}}<br /><br /></div>\r\n</div>\r\n</div>\r\n<div>&nbsp;</div>\r\n</div>\r\n<p>Sincerely,<br />Business Supermarket Listing Support Team. <br /> <em>Note. This email address cannot accept replies.</em></p>\r\n<div>&nbsp;</div>\r\n</body>\r\n</html>', '1', '2015-01-16 06:07:11'),
(122, 'blisting_submission', 'Business listing submission notification', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Dear {{#USERNAME#}},<br /><br /></p>\r\n<p>You have successfully submitted your listing</p>\r\n<p>Listing title:&nbsp;{{#LISTINGTITLE#}}<br />Date of submission:&nbsp;{{#LISTINGDATE#}}<br />Status:&nbsp;{{#LISTINGSTATUS#}}<br /><br />You may access and update / make changes to your listing&nbsp;{{#LINK#}}<br /><br /></p>\r\n<p>Sincerely,<br />Business Supermarket Listing Support Team<br />Note. This email address cannot accept replies</p>\r\n<p><em>Should you wish to contact us, then you may do so via the&nbsp;<a href="../../contact">support@businessinvention.com</a>&nbsp;</em></p>\r\n</body>\r\n</html>', '1', '2015-02-18 10:02:38'),
(123, 'blisting_publish', 'Business listing publication', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Dear {{#USERNAME#}},<br /><br /></p>\r\n<div>Your business listing has now been published.</div>\r\n<div>&nbsp;</div>\r\n<p>Listing title:&nbsp;<span style="color: #ff9900;">{{#LISTINGTITLE#}}</span><br />Date of submission:&nbsp;<span style="color: #ff9900;">{{#LISTINGDATE#}}</span><br />Status:&nbsp;<span style="color: #0000ff;">{{#LISTINGSTATUS#}}</span><br /><br />You may view your listing {{#LINK#}}</p>\r\n<p>Sincerely,<br />Business Supermarket Listing Support Team<br /><br />Note. This email address cannot accept replies.</p>\r\n<div><em>Should you wish to contact us, then you may do so via the&nbsp;<a href="../../contact">support@businessinvention.com</a>&nbsp;</em></div>\r\n</body>\r\n</html>', '1', '2015-02-19 04:16:02'),
(124, 'Nonactivated_Account', 'Your account is dormant', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div>Dear {{#USERNAME#}},<br />&nbsp;</div>\r\n<div>\r\n<div>This is a notification that your account has been dormant for 14 days. If your account status does not change within the next 7 days it will be permanently deleted of our servers</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n</div>\r\n<p>Sincerely,<br />Business Supermarket Accounts Team<br /><em>Note. This email address cannot accept replies.</em></p>\r\n<div>&nbsp;</div>\r\n</body>\r\n</html>', '1', '2015-03-01 19:09:09'),
(125, 'Account_permanent_delete', 'Your account is dormant', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div>Dear {{#USERNAME#}},<br />&nbsp;</div>\r\n<div>\r\n<div>This is a notification that your account has been permanently deleted of our servers.</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n</div>\r\n<p>Sincerely,<br />Business Supermarket Accounts Team<br /><em>Note. This email address cannot accept replies.</em></p>\r\n<div>&nbsp;</div>\r\n</body>\r\n</html>', '1', '2015-03-02 06:23:53'),
(126, 'contact_us_admin', 'New Contact Details', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div>Dear Admin,<br /><br /></div>\r\n<div>&nbsp;</div>\r\n<div>\r\n<div>You have received an enquiry from the following user:-</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><span style="color: #808080;"><em>Username:</em></span> <span style="color: #0000ff;">{{#USERNAME#}}</span></div>\r\n<div><em><span style="color: #808080;">Email:</span></em> <span style="color: #0000ff;">{{#EMAIL#}}</span></div>\r\n<div><em><span style="color: #808080;">Subject:</span></em> <span style="color: #0000ff;">{{#SUBJECT#}}</span></div>\r\n<div><span style="color: #808080;"><em>Message:</em></span> <span style="color: #0000ff;">{{#MSG#}}</span></div>\r\n</div>\r\n<div>&nbsp;</div>\r\n</body>\r\n</html>', '1', '2015-03-05 17:27:38'),
(127, 'contact_us_user', 'Contact Details', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div>Dear {{#USERNAME#}},<br /><br /></div>\r\n<div>&nbsp;</div>\r\n<div>\r\n<div><em>This is&nbsp;a&nbsp;copy of your contact email to business supermarket.</em></div>\r\n<div>&nbsp;</div>\r\n<div><span style="color: #999999;">Username:</span> {{#USERNAME#}}</div>\r\n<div>&nbsp;</div>\r\n<div><span style="color: #999999;">Email:</span> {{#EMAIL#}}</div>\r\n<div>&nbsp;</div>\r\n<div><span style="color: #999999;">Subject:</span> {{#SUBJECT#}}</div>\r\n<div>&nbsp;</div>\r\n<div><span style="color: #999999;">Message:</span> {{#MSG#}}</div>\r\n<div>&nbsp;</div>\r\n</div>\r\n<div>&nbsp;</div>\r\n<div>Sincerely,<br />Business Supermarket&nbsp;Support&nbsp;Team. <br /><em>Note. This email address cannot accept replies.</em></div>\r\n<div>&nbsp;</div>\r\n</body>\r\n</html>', '1', '2015-03-05 17:29:17'),
(128, 'user_identity_user', 'User Profile Identity Details', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div>Dear {{#USERNAME#}},<br /><br /></div>\r\n<div>&nbsp;</div>\r\n<div>\r\n<div>This is the&nbsp;copy of your contact details for your records.</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Username: {{#USERNAME#}}</div>\r\n<div>Email: {{#EMAIL#}}</div>\r\n<div>Subject: {{#SUBJECT#}}</div>\r\n<div>Message: {{#MSG#}}</div>\r\n</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<p>Sincerely,<br />Business Supermarket Registrations&nbsp;Team. <br /><em>Note. This email address cannot accept replies.</em></p>\r\n<div>&nbsp;</div>\r\n</body>\r\n</html>', '1', '2015-03-05 18:47:27'),
(129, 'user_identity_admin', 'User Profile Identity Details', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div>Dear Admin,<br /><br /></div>\r\n<div>&nbsp;</div>\r\n<div>\r\n<div>User Profile Identity Details :</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Username: {{#USERNAME#}}</div>\r\n<div>Email: {{#EMAIL#}}</div>\r\n<div>Subject: {{#SUBJECT#}}</div>\r\n<div>Message: {{#MSG#}}</div>\r\n</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<p>Sincerely,<br />Business Supermarket Registrations&nbsp;Team. <br /><em>Note. This email address cannot accept replies.</em></p>\r\n<div>&nbsp;</div>\r\n</body>\r\n</html>', '1', '2015-03-05 18:48:41'),
(130, 'Add_Fund_Notice_Transaction', 'Funds received', '<p>Accounts department<br /><br />You have received the following funds.<br />Username: <strong>user_default_#USERNAME#</strong></p> <p>Full name: <strong>user_default_#FULLNAME#</strong></p> <p>User email: <strong>user_default_#USEREMAIL#</strong></p> <p>Type of transaction: <strong>user_default_#TYPEOFTRANSACTION#</strong></p> <p>Transaction ref: <strong>user_default_#TRANSACTIONREF#</strong></p> <p>Bank: <strong>user_default_#BANK#</strong></p> <p>Amount received:<strong>user_default_#AMOUNTRECEIVED#</strong></p> <p>Sincerely,<br />Business Supermarket Customer Support Team. <br /> <em>Note. This email address cannot accept replies.</em></p>', '1', '2015-07-16 09:03:40'),
(131, 'Withdraw_Admin_Notice_Transaction', 'Withdraw Admin Notice Transaction', 'Dear Admin<br /><br />WithDraw this Amount user_default_#WITHDRAWAMOUNT# to user_default_#USERNAME# account.<br /><br /><br />Sincerely,<br />website admin notice', '1', '2015-07-16 09:04:05'),
(132, 'Withdraw_Admin_Notice_Transaction', 'Withdraw Admin Notice Transaction', 'Dear Admin<br /><br />WithDraw this Amount user_default_#WITHDRAWAMOUNT# to user_default_#USERNAME# account.<br /><br /><br />Sincerely,<br />website admin notice', '1', '2015-07-16 09:04:45'),
(133, 'Blisting_Save_for_later', 'Business Listing has been successfully saved for later', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Dear {{#USERNAME#}},<br /><br /></p>\r\n<p>You have successfully saved a draft copy your listing to be completed later.</p>\r\n<p>Listing title:&nbsp;{{#LISTINGTITLE#}}<br />Date of submission:&nbsp;{{#LISTINGDATE#}}<br />Status:&nbsp;{{#LISTINGSTATUS#}}<br />&nbsp;</p>\r\n<p>You may access your listing at anytime to complete it and submit it for publication {{#LISTINGLINK#}}&nbsp;<br /><br /></p>\r\n<p>Sincerely,<br />Business Supermarket Listing Support Team. <br /> <em>Note. This email address cannot accept replies.</em></p>\r\n<div>&nbsp;</div>\r\n</body>\r\n</html>', '1', '2015-07-25 06:06:51'),
(134, 'Business_Listing_update', 'Listing update notification', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div>Dear {{#USERNAME#}},</div>\r\n<div>&nbsp;</div>\r\n<div>Your listing was modified to conform with our terms and conditions. Details of the modification / changes are give below:-</div>\r\n<div>&nbsp;</div>\r\n<div>{{#MESSAGE#}}<br /><br /></div>\r\n<div>You may view your listing {{#LISTINGLINK#}}</div>\r\n<div>&nbsp;</div>\r\n<div>If you do not agree with the changes then please contact the&nbsp;<span style="color: #0000ff;">{{#LSLINK#}}</span>&nbsp;to help resolve this matter</div>\r\n<div>&nbsp;</div>\r\n<p>Sincerely,<br />Business Supermarket Listing Support Team. <br /><em>Note. This email address cannot accept replies.</em></p>\r\n<div>&nbsp;</div>\r\n</body>\r\n</html>', '1', '2015-08-14 06:21:44'),
(135, 'Business_Listing_mark_delete', 'Listing has been marked for deletion', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div>Dear {{#USERNAME#}},<br /><br /></div>\r\n<div>Your listing {{#LISTINGTITLE#}} has been marked for deletion for the following reason:-</div>\r\n<div>\r\n<div>&nbsp;</div>\r\n<div>{{#MESSAGE#}}<br />You now have 7 days to request a copy of your listing complete with all collected data for your records {{#LISTINGLINK#}}<br /><br />\r\n<div>If you do not wish your listing to be deleted off our servers then please&nbsp;<span style="color: #0000ff;">{{#CSLINK#}}</span>&nbsp;giving reasons why you do not wish this to happen and how you will address any issues that have been given above.<br /><br /></div>\r\n<div>\r\n<div>Please note after 7 days you will not be able to get a copy of your listing and all the data it has collected while it was active.</div>\r\n<div>This action is irreversible. To find out more click&nbsp;&nbsp;{{#SITELINK#}}<br /><br /></div>\r\n</div>\r\n</div>\r\n<div>&nbsp;</div>\r\n</div>\r\n<p>Sincerely,<br />Business Supermarket Listing Support Team. <br /><em>Note. This email address cannot accept replies.</em></p>\r\n<div>&nbsp;</div>\r\n</body>\r\n</html>', '1', '2015-09-06 17:05:59'),
(136, 'Business_Listing_rejection', 'Listing rejection notification', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div>Dear {{#USERNAME#}},<br />&nbsp;</div>\r\n<div>Your listing has been rejected for the following reason.</div>\r\n<div>&nbsp;&nbsp;</div>\r\n<div>{{#MESSAGE#}}<br /><br /></div>\r\n<div>Please access your account {{#SITELINK#}} &nbsp;and make the requested alterations.</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<p>Sincerely,<br />Business Supermarket Listing Support Team. <br /><em>Note. This email address cannot accept replies.</em></p>\r\n</body>\r\n</html>', '1', '2015-09-07 02:36:52'),
(137, 'Business_Listing_suspension', 'Listing suspension notice', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div>Dear {{#USERNAME#}},<br /><br /></div>\r\n<div>Your listing has been suspended for the following reason:-</div>\r\n<div>\r\n<div>&nbsp;<br /><span style="color: #0000ff;">{{#MESSAGE#}}</span></div>\r\n<div>&nbsp;</div>\r\n<div>Please access your account and resubmit your listing after making any changes <span style="color: #0000ff;">{{#LISTINGLINK#}}</span></div>\r\n</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<p>Sincerely,<br />Business Supermarket Listing Support Team. <br /><em>Note. This email address cannot accept replies.</em></p>\r\n<div>&nbsp;</div>\r\n</body>\r\n</html>', '1', '2015-09-07 02:46:09'),
(138, 'default_user_send_query', 'Default (none - business) user send a query.', 'Dear {{#USERNAME#}}, <br /><br />You have sent the following request to {{#SECTOR#}} {{#LIMITREQUEST#}}<br /><br />{{#MESSAGE#}}<br />You will be emailed when you have received a response.<br />{{#COMPANY_SIGNATURE#}} <br />Note: This email address cannot accept replies.', '1', '2015-09-30 16:50:47'),
(139, 'Email_received_by_Recipients', 'Email received by Recipients', 'Re : {{#SUBJECT#}}<br /><br />Dear {{#BUSINESSCOMPANYNAME#}}, <br /><br />{{#MESSAGE#}} <br /><br />Sincerely<br/>{{#USERNAME#}} <br /><br/>Please log into your account <a href="{{#LINK#}}">here>></a> to respond to the query<br/><br/>Sincerely<br/>{{#COMPANY_SIGNATURE#}}<br/>Note: This email address cannot accept replies.', '1', '2015-09-30 16:50:48'),
(140, 'Register_Vote_Notify', 'Register_Vote_Notify', '<p>Dear <span style="color:#f8851f">{{#USERNAME#}}</span>,<br /><br />So that we may register your vote for <span style="color:#f8851f">{{#LISTING_TITLE#}}</span> please click here <a href="{{#LINK#}}">>></a></p>\r\n<p><br /><br /><p>Why do we do this?</p><br /><p>So that our members receive valid votes for their listing we register all votes against a username. If\r\nyou are not a member then your vote is registered as a none member. We do not store your details\r\non our servers unless of course you decide to become a member.</p>\r\n<br /><p>Should you decline to become a member the details you filled in while registering your vote will be\r\ndeleted off our servers in the next 7 days. You may become a member anytime after the 7 days by\r\ngoing directly to <span style="color:#4537b4">www.businessinvention.com</span> and selecting register for an account.</p><br /><p>May we take this opportunity to thank you for your valued input for <span style="color:#f8851f">{{#LISTING_TITLE#}}</span> </p><br />Sincerely,<br />Business Supermarket Customer Support Team. <br /> <em>Note. This email address cannot accept replies.</em></p>', '1', '2015-09-30 16:50:48'),
(141, 'comment_justified_notification', 'Comment Delete Justification Notice', '<p>Dear {{#USERNAME#}},<br /><br />{{#MESSAGE#}}<br /><br /></p> <p>Sincerely,<br />Business Supermarket Customer Accounts Team. <br /> <em>Note. This email address cannot accept replies.</em></p>', '1', '2015-10-13 07:10:26');

-- --------------------------------------------------------

--
-- Table structure for table `user_default_prize_draw`
--

CREATE TABLE `user_default_prize_draw` (
  `id` int(11) NOT NULL,
  `year` varchar(4) NOT NULL,
  `month` varchar(2) NOT NULL,
  `prize_value` varchar(1024) NOT NULL,
  `points_required` varchar(1024) NOT NULL,
  `created_by` varchar(1024) NOT NULL,
  `created_on` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_default_prize_draw`
--

INSERT INTO `user_default_prize_draw` (`id`, `year`, `month`, `prize_value`, `points_required`, `created_by`, `created_on`) VALUES
(1, '2015', '07', '300', '800', '', ''),
(2, '2015', '08', '250', '1000', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_default_prize_draw_winners`
--

CREATE TABLE `user_default_prize_draw_winners` (
  `id` int(11) NOT NULL,
  `user_default_id` int(11) NOT NULL,
  `date_draw` varchar(1024) NOT NULL,
  `prize_won_amount` varchar(100) NOT NULL,
  `amount_paid_date` varchar(100) NOT NULL,
  `payment_ref` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_prize_points`
--

CREATE TABLE `user_default_prize_points` (
  `user_default_prize_points_id` int(11) NOT NULL,
  `user_default_listing_points_purchased` int(11) NOT NULL,
  `user_default_listing_points_cost` decimal(10,2) NOT NULL,
  `user_default_listing_points_date` date NOT NULL,
  `user_default_listing_points_time` time NOT NULL,
  `user_default_listing_points_required` int(11) DEFAULT NULL,
  `user_default_listing_points_user_id` int(11) NOT NULL,
  `user_default_listing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_default_prize_points`
--

INSERT INTO `user_default_prize_points` (`user_default_prize_points_id`, `user_default_listing_points_purchased`, `user_default_listing_points_cost`, `user_default_listing_points_date`, `user_default_listing_points_time`, `user_default_listing_points_required`, `user_default_listing_points_user_id`, `user_default_listing_id`) VALUES
(1, 25, 25.00, '2015-09-29', '13:35:54', 135, 89, 67),
(2, 25, 25.00, '2015-09-29', '14:15:22', 135, 89, 67),
(3, 25, 23.50, '2015-11-23', '09:56:54', 135, 86, 64);

-- --------------------------------------------------------

--
-- Table structure for table `user_default_profession`
--

CREATE TABLE `user_default_profession` (
  `profession_id` int(11) NOT NULL,
  `profession_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_profession`
--

INSERT INTO `user_default_profession` (`profession_id`, `profession_name`) VALUES
(1, 'Administrative'),
(2, 'Business owner'),
(3, 'Civil servant'),
(4, 'Consultant'),
(5, 'Consumer'),
(6, 'Engineer'),
(7, 'Entrepreneur'),
(8, 'Full time parent'),
(9, 'Investor'),
(10, 'Sales'),
(11, 'Senior management'),
(12, 'Other management'),
(13, 'Student'),
(14, 'Technician'),
(15, 'Unemployed'),
(16, 'Volunteer');

-- --------------------------------------------------------

--
-- Table structure for table `user_default_profiles`
--

CREATE TABLE `user_default_profiles` (
  `user_default_id` int(11) NOT NULL,
  `user_default_ip` varchar(100) NOT NULL,
  `user_default_first_name` varchar(50) NOT NULL,
  `user_default_surname` varchar(50) NOT NULL,
  `user_default_username` varchar(50) NOT NULL,
  `user_default_email` varchar(100) NOT NULL,
  `user_default_password` varchar(50) NOT NULL,
  `user_default_currency` varchar(15) NOT NULL,
  `user_default_profession` varchar(100) NOT NULL,
  `user_default_country` varchar(100) NOT NULL,
  `user_default_gender` enum('f','m') NOT NULL COMMENT 'f - female, m - male',
  `user_default_dob` date NOT NULL,
  `user_default_type` varchar(50) NOT NULL,
  `user_default_tel` varchar(30) DEFAULT NULL,
  `user_default_profile_image` varchar(100) DEFAULT NULL,
  `user_default_registration_date` date NOT NULL,
  `user_default_admin_notes` text NOT NULL,
  `user_default_verifycode` varchar(100) NOT NULL,
  `user_default_activate_link` varchar(150) NOT NULL,
  `user_default_account_status` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '1- active, 0 - not active,2 - suspend'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_default_profiles`
--

INSERT INTO `user_default_profiles` (`user_default_id`, `user_default_ip`, `user_default_first_name`, `user_default_surname`, `user_default_username`, `user_default_email`, `user_default_password`, `user_default_currency`, `user_default_profession`, `user_default_country`, `user_default_gender`, `user_default_dob`, `user_default_type`, `user_default_tel`, `user_default_profile_image`, `user_default_registration_date`, `user_default_admin_notes`, `user_default_verifycode`, `user_default_activate_link`, `user_default_account_status`) VALUES
(1, '82.47.62.112', 'Jaginder Singh', 'Mudhar', 'jag', 'dsp7@blueyonder.co.uk', '385d76421fd67b0c9a8a19d5eafc16f3', '1', '6', '232', 'm', '1961-10-21', 'user', NULL, 'Business_supermarket_1458562328.jpg', '2016-03-21', '', '', '', '1'),
(2, '82.47.62.112', 'Jaginder Singh', 'Mudhar', 'jaguar', 'sm004b6095@blueyonder.co.uk', '385d76421fd67b0c9a8a19d5eafc16f3', '1', '5', '232', 'm', '1961-10-21', 'user', NULL, 'Business_supermarket_1458563353.png', '2016-03-21', '', '', '', '1'),
(3, '82.47.62.112', 'Shameem', 'Mudhar', 'Shameem', 'sham74@hotmail.co.uk', 'a4baa44daef1fc1224aaafaccf038022', '1', '10', '232', 'f', '1974-10-14', 'user', NULL, 'Business_supermarket_1458564598.jpg', '2016-03-21', '', '', '', '1'),
(4, '82.47.62.112', 'Suniel Singh', 'Mudhar', 'Sunny', 'jag@businessinvention.com', '90110165160a181d60462367da964001', '1', '13', '232', 'm', '1997-10-04', 'user', NULL, NULL, '2016-03-21', '', '', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_default_profiles_messages`
--

CREATE TABLE `user_default_profiles_messages` (
  `id` int(11) NOT NULL,
  `user_default_listing_id` int(11) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `user_default_profiles_id` int(11) NOT NULL,
  `user_default_user_type` varchar(9) NOT NULL,
  `likes_total` int(11) NOT NULL,
  `dislikes_total` int(11) NOT NULL,
  `attachement` varchar(255) DEFAULT NULL,
  `is_spam` enum('0','1') NOT NULL DEFAULT '0',
  `first_message` enum('0','1') NOT NULL DEFAULT '0',
  `notice_flag` enum('0','1') NOT NULL,
  `close_msg_flag` enum('0','1') NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `parent_message_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_profiles_messages_rating`
--

CREATE TABLE `user_default_profiles_messages_rating` (
  `id` int(11) NOT NULL,
  `msg_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `parent_msg_id` int(11) NOT NULL,
  `dt_rated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_profiles_messages_rating`
--

INSERT INTO `user_default_profiles_messages_rating` (`id`, `msg_id`, `rate`, `parent_msg_id`, `dt_rated`) VALUES
(1, 3, 4, 2, '2015-10-15 12:23:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_default_profiles_messages_sent`
--

CREATE TABLE `user_default_profiles_messages_sent` (
  `id` int(11) NOT NULL,
  `msg_id` int(11) NOT NULL,
  `sender_user_id` int(11) NOT NULL,
  `receiver_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_sample_listing`
--

CREATE TABLE `user_default_sample_listing` (
  `user_default_sample_listing_id` int(11) NOT NULL,
  `user_default_listing_id` int(11) NOT NULL,
  `user_default_sample_listing_details` text NOT NULL,
  `user_default_sample_listing_feedback` text NOT NULL,
  `user_default_sample_listing_obtain` text NOT NULL,
  `user_default_sample_listing_instructions` text NOT NULL,
  `user_default_sample_listing_company_image` varchar(500) NOT NULL,
  `user_default_sample_listing_company_address1` varchar(100) NOT NULL,
  `user_default_sample_listing_company_address2` varchar(100) NOT NULL,
  `user_default_sample_listing_company_address3` varchar(100) NOT NULL,
  `user_default_sample_listing_company_town` varchar(100) NOT NULL,
  `user_default_sample_listing_company_county` varchar(100) NOT NULL,
  `user_default_sample_listing_company_postal` varchar(100) NOT NULL,
  `user_default_sample_listing_company_tel` varchar(100) NOT NULL,
  `user_default_sample_listing_att_specs` varchar(500) NOT NULL,
  `user_default_sample_listing_att_instruction` varchar(500) NOT NULL,
  `user_default_sample_listing_att_safety` varchar(500) NOT NULL,
  `user_default_sample_listing_image` varchar(500) NOT NULL,
  `user_default_sample_listing_cost` varchar(100) NOT NULL,
  `user_default_sample_listing_packaging` varchar(100) NOT NULL,
  `user_default_sample_listing_currency` varchar(25) NOT NULL,
  `user_default_sample_listing_terms` enum('Yes','No') NOT NULL,
  `user_default_sample_listing_date` date NOT NULL,
  `user_default_sample_listing_status` enum('0','1','2') NOT NULL COMMENT 'COMMENT ''0=deactive 1=active 2=suspend'''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_sample_listing_feedbacks`
--

CREATE TABLE `user_default_sample_listing_feedbacks` (
  `user_default_sample_listing_feedback_id` int(11) NOT NULL,
  `user_default_sample_listing_id` int(11) NOT NULL,
  `user_default_profiles_id` int(11) NOT NULL,
  `user_default_sample_listing_feedback_message` text NOT NULL,
  `user_default_sample_listing_feedback_rating` enum('1','2','3','4','5') NOT NULL,
  `user_default_feedback_likes_total` int(11) NOT NULL,
  `user_default_feedback_dislikes_total` int(11) NOT NULL,
  `user_default_first_feedback` enum('0','1') NOT NULL,
  `user_default_parent_id` int(11) NOT NULL,
  `user_default_sample_listing_feedback_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_sample_listing_orders`
--

CREATE TABLE `user_default_sample_listing_orders` (
  `user_default_sample_listing_order_id` int(11) NOT NULL,
  `user_default_sample_listing_id` int(11) NOT NULL,
  `user_default_profiles_id` int(11) NOT NULL,
  `user_default_sample_listing_order_quantity` varchar(100) NOT NULL,
  `user_default_sample_listing_order_cost` varchar(100) NOT NULL,
  `user_default_sample_listing_order_instruction` text NOT NULL,
  `user_default_sample_listing_order_date` datetime NOT NULL,
  `user_default_sample_listing_order_status` enum('0','1') NOT NULL COMMENT '''0=deactive 1=active'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_sample_listing_sliders`
--

CREATE TABLE `user_default_sample_listing_sliders` (
  `user_default_listing_image_id` int(11) NOT NULL,
  `user_default_listing_image` varchar(500) NOT NULL,
  `user_default_listing_image_text` mediumtext NOT NULL,
  `user_default_listing_image_link1` varchar(100) NOT NULL,
  `user_default_listing_image_link2` varchar(100) DEFAULT NULL,
  `user_default_listing_lid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_sell_equity`
--

CREATE TABLE `user_default_sell_equity` (
  `id` int(11) NOT NULL,
  `starting_bid` decimal(10,2) NOT NULL,
  `duration` int(11) NOT NULL,
  `insertion_fee` decimal(10,2) NOT NULL,
  `final_valuation_fee` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_shareholders`
--

CREATE TABLE `user_default_shareholders` (
  `user_default_shareholder_id` int(11) NOT NULL,
  `user_default_shareholder_company_id` int(11) NOT NULL,
  `user_default_shareholder_user_id` int(11) NOT NULL,
  `user_default_shareholder_amount_invested` decimal(10,2) NOT NULL,
  `user_default_shareholder_join_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_default_site_actions`
--

CREATE TABLE `user_default_site_actions` (
  `id` int(11) NOT NULL,
  `pname` varchar(1024) NOT NULL,
  `pslug` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_site_actions`
--

INSERT INTO `user_default_site_actions` (`id`, `pname`, `pslug`) VALUES
(1, 'User Listing create', 'listing/create'),
(2, 'User Listing Purchase Access', 'listing/purchaseaccess'),
(3, 'User Listing Select listing', 'listing/selectlisting'),
(4, 'User Listing Step2', 'listing/user_listing_step2'),
(5, 'User Listing Step3', 'listing/user_listing_step3'),
(6, 'User Listing Step4', 'listing/user_listing_step4'),
(7, 'Manage Listing', 'listing/index'),
(8, 'My Account', 'myaccount/update'),
(9, 'Home Page', 'site/index'),
(10, 'Registration', 'register/index'),
(11, 'Business ideas', 'listing/business_ideas'),
(12, 'Retail', 'listing/retail'),
(13, 'Industrial', 'listing/industrial'),
(14, 'Science and Technology', 'listing/science_and_technology'),
(15, 'Business Services', 'businesslisting/business_services'),
(16, 'Manage Business listing', 'businesslisting/index'),
(17, 'Business listing Purchase access', 'businesslisting/purchaseaccess'),
(18, 'Business listing Select Listing', 'businesslisting/selectlisting'),
(19, 'Business listing create', 'businesslisting/create'),
(20, 'Business listing step 2', 'businesslisting/business_listing_step2'),
(22, 'Video Tutorials', 'site/video_tutorials'),
(23, 'Account activation', 'register/activation'),
(24, 'Resend Activation', 'register/resendactive'),
(25, 'Confirm Identity', 'site/confirm_identity'),
(26, 'Contact', 'contact/index'),
(28, 'Prize Draw', 'prizedraw/index'),
(30, 'faq', 'page/index'),
(31, 'Resend Activation Code', 'register/resendactive'),
(32, 'Manage Business listing', 'businesslisting/index'),
(33, 'My Marketing Tools', 'banner/index');

-- --------------------------------------------------------

--
-- Table structure for table `user_default_site_bannerads`
--

CREATE TABLE `user_default_site_bannerads` (
  `user_default_banner_id` int(11) NOT NULL,
  `user_default_banner_path` varchar(350) NOT NULL,
  `user_default_banner_link` mediumtext NOT NULL,
  `user_default_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_default_banner_status` enum('1','2') NOT NULL COMMENT '1-Published,2-Un Published'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_site_bannerads`
--

INSERT INTO `user_default_site_bannerads` (`user_default_banner_id`, `user_default_banner_path`, `user_default_banner_link`, `user_default_date_time`, `user_default_banner_status`) VALUES
(1, 'banner-images/banners_index/dragonsnet.png', 'http://youtu.be/ORu_3dSYDV0', '2015-11-19 09:37:30', '1'),
(2, 'banner-images/banners_index/business-help-ad.png', 'http://www.dragonsnet.biz', '2015-11-19 10:43:26', '1'),
(3, 'banner-images/banners_index/skill-mentor-ad.png', '', '2015-11-19 09:44:51', '1'),
(4, 'banner-images/banners_index/business-help-ad.png', '', '2016-03-21 15:15:20', '1'),
(5, '', '', '2015-11-19 09:35:17', '2'),
(6, '', '', '2015-11-19 09:35:37', '2');

-- --------------------------------------------------------

--
-- Table structure for table `user_default_site_defaults`
--

CREATE TABLE `user_default_site_defaults` (
  `user_default_site_default_id` int(11) NOT NULL,
  `user_default_site_default_type` varchar(255) NOT NULL,
  `user_default_site_default_days` tinyint(3) NOT NULL,
  `user_default_site_default_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_default_site_defaults`
--

INSERT INTO `user_default_site_defaults` (`user_default_site_default_id`, `user_default_site_default_type`, `user_default_site_default_days`, `user_default_site_default_updated_on`) VALUES
(1, 'Assets', 10, '2015-12-10 12:53:34'),
(2, 'AdminLogs', 100, '2015-12-11 09:26:34'),
(3, 'Apache2Logs', 10, '2015-12-11 09:26:40'),
(4, 'UserLogs', 10, '2015-12-11 09:26:43'),
(5, 'RuntimeLogs', 10, '2015-12-11 09:26:48'),
(6, 'Logs', 10, '2015-12-11 09:26:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_default_slider_btns`
--

CREATE TABLE `user_default_slider_btns` (
  `btn_id` int(11) NOT NULL,
  `btn_image` varchar(1024) NOT NULL,
  `btn_text` text NOT NULL,
  `btn_sitelink` varchar(1024) NOT NULL,
  `btn_videolink` varchar(1024) NOT NULL,
  `slider_id` bigint(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_slider_btns`
--

INSERT INTO `user_default_slider_btns` (`btn_id`, `btn_image`, `btn_text`, `btn_sitelink`, `btn_videolink`, `slider_id`) VALUES
(610, 'FAQ-button.png', 'Contact us & FAQ\'s', 'http://www.businessinvention.com/page/faq', '', 36),
(580, 'FAQ-button.png', 'Contact us & FAQ\'s', 'http://www.businessinvention.com/page/faq', '', 27),
(578, 'View-videos.png', 'How to list your business idea', '', 'http://youtu.be/ORu_3dSYDV0', 27),
(577, 'FAQ-button.png', 'Contact us & FAQ\'s', 'http://www.businessinvention.com/page/faq', '', 22),
(576, 'View-videos.png', 'How to navigate the site', '', 'http://youtu.be/cG_tTVZZ_Bg', 22),
(575, 'View-videos.png', 'How to list your business idea', '', 'http://youtu.be/ORu_3dSYDV0', 22),
(634, 'FAQ-button.png', 'Contact us & FAQ\'s', 'http://www.businessinvention.com/page/faq', '', 28),
(633, 'View-videos.png', 'How to navigate the site', '', 'http://youtu.be/cG_tTVZZ_Bg', 28),
(632, 'View-videos.png', 'How to list your business idea', '', 'http://youtu.be/ORu_3dSYDV0', 28),
(631, 'FAQ-button.png', 'Contact us & FAQ\'s', 'http://www.businessinvention.com/page/faq', '', 29),
(630, 'View-videos.png', 'How to navigate the site', '', 'http://youtu.be/cG_tTVZZ_Bg', 29),
(629, 'View-videos.png', 'How to list your business idea', '', 'http://youtu.be/ORu_3dSYDV0', 29),
(628, 'FAQ-button.png', 'Contact us & FAQ\'s', 'http://www.businessinvention.com/page/faq', '', 30),
(627, 'View-videos.png', 'How to navigate the site', '', 'http://youtu.be/cG_tTVZZ_Bg', 30),
(626, 'View-videos.png', 'How to list your business', '', 'http://youtu.be/ORu_3dSYDV0', 30),
(625, 'FAQ-button.png', 'Contact us & FAQ\'s', 'http://www.businessinvention.com/page/faq', '', 31),
(624, 'View-videos.png', 'How to navigate the site', '', 'http://youtu.be/cG_tTVZZ_Bg', 31),
(622, 'FAQ-button.png', 'Contact us & FAQ\'s', 'http://www.businessinvention.com/page/faq', '', 32),
(621, 'View-videos.png', 'How to navigate the site', '', 'http://youtu.be/cG_tTVZZ_Bg', 32),
(620, 'View-videos.png', 'How to list your business idea', '', 'http://youtu.be/ORu_3dSYDV0', 32),
(619, 'FAQ-button.png', 'Contact us & FAQ\'s', 'http://www.businessinvention.com/page/faq', '', 33),
(618, 'View-videos.png', 'How to navigate the site', '', 'http://youtu.be/cG_tTVZZ_Bg', 33),
(617, 'View-videos.png', 'How to list your business idea', '', 'http://youtu.be/ORu_3dSYDV0', 33),
(623, 'View-videos.png', 'How to list your business idea', '', 'http://youtu.be/ORu_3dSYDV0', 31),
(613, 'FAQ-button.png', 'Contact us & FAQ\'s', 'http://www.businessinvention.com/page/faq', '', 35),
(612, 'View-videos.png', 'How to navigate the site', '', 'http://youtu.be/cG_tTVZZ_Bg', 35),
(611, 'View-videos.png', 'How to list your business idea', '', 'http://youtu.be/ORu_3dSYDV0', 35),
(609, 'View-videos.png', 'How to navigate the site', '', 'http://youtu.be/cG_tTVZZ_Bg', 36),
(608, 'View-videos.png', 'How to list your business idea', '', 'http://youtu.be/ORu_3dSYDV0', 36),
(579, 'View-videos.png', 'How to navigate the site', '', 'http://youtu.be/cG_tTVZZ_Bg', 27),
(415, 'FAQ-button.png', 'Contact us & FAQ\'s', 'http://www.businessinvention.com/page/faq', '', 41),
(414, 'View-videos.png', 'How to navigate the site', '', 'http://youtu.be/cG_tTVZZ_Bg', 41),
(413, 'View-videos.png', 'How to list your business idea', '', 'http://youtu.be/ORu_3dSYDV0', 41),
(601, 'FAQ-button.png', 'Contact us & FAQ\'s', 'http://www.businessinvention.com/page/faq', '', 44),
(600, 'View-videos.png', 'How to navigate the site', '', 'http://youtu.be/cG_tTVZZ_Bg', 44),
(599, 'View-videos.png', 'How to list your business idea', '', 'http://youtu.be/ORu_3dSYDV0', 44),
(604, 'FAQ-button.png', 'Contact us & FAQ\'s', 'http://www.businessinvention.com/page/faq', '', 42),
(603, 'View-videos.png', 'How to navigate the site', '', 'http://youtu.be/cG_tTVZZ_Bg', 42),
(602, 'View-videos.png', 'How to list your business idea', '', 'http://youtu.be/ORu_3dSYDV0', 42),
(588, 'View-videos.png', 'How to navigate the site', '', 'http://youtu.be/cG_tTVZZ_Bg', 53),
(587, 'View-videos.png', 'How to list your business', '', 'http://youtu.be/ORu_3dSYDV0', 53),
(585, 'View-videos.png', 'How to navigate the site', '', 'http://youtu.be/cG_tTVZZ_Bg', 54),
(584, 'View-videos.png', 'How to list your business', '', 'http://youtu.be/ORu_3dSYDV0', 54),
(590, 'View-videos.png', 'How to list your business idea', '', 'http://youtu.be/ORu_3dSYDV0', 52),
(586, 'FAQ-button.png', 'Contact us & FAQ\'s', 'http://www.businessinvention.com/page/faq', '', 54),
(589, 'FAQ-button.png', 'Contact us & FAQ\'s', 'http://www.businessinvention.com/page/faq', '', 53),
(583, 'FAQ-button.png', 'Contact us & FAQ\'s', 'http://www.businessinvention.com/page/faq', '', 55),
(582, 'View-videos.png', 'How to navigate the site', '', 'http://youtu.be/cG_tTVZZ_Bg', 55),
(581, 'View-videos.png', 'How to list your business idea', '', 'http://youtu.be/ORu_3dSYDV0', 55),
(591, 'View-videos.png', 'How to navigate the site', '', 'http://youtu.be/cG_tTVZZ_Bg', 52),
(592, 'FAQ-button.png', 'Contact us & FAQ\'s', 'http://www.businessinvention.com/page/faq', '', 52),
(593, 'View-videos.png', 'How to list your business idea', '', 'http://youtu.be/ORu_3dSYDV0', 46),
(594, 'View-videos.png', 'How to navigate the site', '', 'http://youtu.be/cG_tTVZZ_Bg', 46),
(595, 'FAQ-button.png', 'Contact us & FAQ\'s', 'http://www.businessinvention.com/page/faq', '', 46),
(596, 'View-videos.png', 'How to list your business idea', '', 'http://youtu.be/ORu_3dSYDV0', 45),
(597, 'View-videos.png', 'How to navigate the site', '', 'http://youtu.be/cG_tTVZZ_Bg', 45),
(598, 'FAQ-button.png', 'Contact us & FAQ\'s', 'http://www.businessinvention.com/page/faq', '', 45),
(605, 'View-videos.png', 'How to list your business idea', '', 'http://youtu.be/ORu_3dSYDV0', 38),
(606, 'View-videos.png', 'How to navigate the site', '', 'http://youtu.be/cG_tTVZZ_Bg', 38),
(607, 'FAQ-button.png', 'Contact us & FAQ\'s', 'http://www.businessinvention.com/page/faq', '', 38),
(614, 'View-videos.png', 'How to list your business idea', '', 'http://youtu.be/ORu_3dSYDV0', 34),
(615, 'View-videos.png', 'How to navigate the site', '', 'http://youtu.be/cG_tTVZZ_Bg', 34),
(616, 'FAQ-button.png', 'Contact us & FAQ\'s', 'http://www.businessinvention.com/page/faq', '', 34),
(635, 'View-videos.png', 'How to list your business idea', '', 'http://youtu.be/ORu_3dSYDV0', 37),
(636, 'View-videos.png', 'How to navigate the site', '', 'http://youtu.be/cG_tTVZZ_Bg', 37),
(637, 'FAQ-button.png', 'Contact us & FAQ\'s', 'http://www.business-supermarket.co', '', 37);

-- --------------------------------------------------------

--
-- Table structure for table `user_default_slider_images`
--

CREATE TABLE `user_default_slider_images` (
  `image_id` int(11) NOT NULL,
  `slider_image` varchar(1024) NOT NULL,
  `slider_imagedesc` text NOT NULL,
  `slider_sitelink` varchar(1024) NOT NULL,
  `slider_videolink` varchar(1024) NOT NULL,
  `slider_id` bigint(200) NOT NULL,
  `order_id` bigint(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_slider_images`
--

INSERT INTO `user_default_slider_images` (`image_id`, `slider_image`, `slider_imagedesc`, `slider_sitelink`, `slider_videolink`, `slider_id`, `order_id`) VALUES
(71, 'Business_supermarket_1458538618.png', 'What do we do? A website designed to help you change your financial future.', '', 'http://youtu.be/TURWdiUPLzE', 24, 0),
(72, 'Business_supermarket_1458538820.png', 'Get free entry to our cash prize draw for your efforts every month.', '', 'http://youtu.be/YlIhWEhFyE4', 24, 0),
(73, 'Business_supermarket_1458538829.png', 'If your idea is good enough; we will get you the funding you need', '', 'http://youtu.be/9NsbbFyXF4A', 24, 0),
(74, 'Business_supermarket_1458538835.png', 'Check out the quick links to our tutorial videos to help you get started', '', 'http://youtu.be/zvSSHQcM4gg', 24, 0),
(75, 'Business_supermarket_1458538842.png', 'Voice your opinion and be part of the next big thing.', '', 'http://youtu.be/pel1IW1kqjo', 24, 0),
(81, 'Business_supermarket_1458540564.png', 'What do we do? A website designed to help you change your financial future.', '', 'http://youtu.be/TURWdiUPLzE', 27, 0),
(82, 'Business_supermarket_1458540573.png', 'Get free entry to our cash prize draw for your efforts every month.', '', 'http://youtu.be/YlIhWEhFyE4', 27, 0),
(83, 'Business_supermarket_1458540583.png', 'If your idea is good enough; we will get you the funding you need', '', 'http://youtu.be/9NsbbFyXF4A', 27, 0),
(84, 'Business_supermarket_1458540589.png', 'Check out the quick links to our tutorial videos to help you get started', '', 'http://youtu.be/zvSSHQcM4gg', 27, 0),
(85, 'Business_supermarket_1458540596.png', 'Voice your opinion and be part of the next big thing.', '', 'http://youtu.be/pel1IW1kqjo', 27, 0),
(76, 'Business_supermarket_1458541881.png', 'What do we do? A website designed to help you change your financial future.', '', 'http://youtu.be/TURWdiUPLzE', 22, 0),
(77, 'Business_supermarket_1458541890.png', 'Get free entry to our cash prize draw for your efforts every month.', '', 'http://youtu.be/YlIhWEhFyE4', 22, 0),
(78, 'Business_supermarket_1458541897.png', 'If your idea is good enough; we will get you the funding you need', '', 'http://youtu.be/9NsbbFyXF4A', 22, 0),
(79, 'Business_supermarket_1458541906.png', 'Check out the quick links to our tutorial videos to help you get started', '', 'http://youtu.be/zvSSHQcM4gg', 22, 0),
(80, 'Business_supermarket_1458541912.png', 'Voice your opinion and be part of the next big thing.', '', 'http://youtu.be/pel1IW1kqjo', 22, 0),
(116, 'Business_supermarket_1458542126.png', 'What do we do? A website designed to help you change your financial future.', '', 'http://youtu.be/TURWdiUPLzE', 44, 0),
(117, 'Business_supermarket_1458542133.png', 'Get free entry to our cash prize draw for your efforts every month.', '', 'http://youtu.be/YlIhWEhFyE4', 44, 0),
(118, 'Business_supermarket_1458542147.png', 'If your idea is good enough; we will get you the funding you need', '', 'http://youtu.be/9NsbbFyXF4A', 44, 0),
(119, 'Business_supermarket_1458542159.png', 'Check out the quick links to our tutorial videos to help you get started', '', 'http://youtu.be/zvSSHQcM4gg', 44, 0),
(120, 'Business_supermarket_1458542164.png', 'Voice your opinion and be part of the next big thing.', '', 'http://youtu.be/pel1IW1kqjo', 44, 0),
(166, 'Business_supermarket_1458542496.png', 'What do we do? A website designed to help you change your financial future.', '', 'http://youtu.be/TURWdiUPLzE', 29, 0),
(167, 'Business_supermarket_1458542575.png', 'Get free entry to our cash prize draw for your efforts every month.', '', 'http://youtu.be/YlIhWEhFyE4', 29, 0),
(168, 'Business_supermarket_1458542650.png', 'If your idea is good enough; we will get you the funding you need', '', 'http://youtu.be/9NsbbFyXF4A', 29, 0),
(169, 'Business_supermarket_1458542657.png', 'Check out the quick links to our tutorial videos to help you get started', '', 'http://youtu.be/zvSSHQcM4gg', 29, 0),
(170, 'Business_supermarket_1458542663.png', 'Voice your opinion and be part of the next big thing.', '', 'http://youtu.be/pel1IW1kqjo', 29, 0),
(161, 'Business_supermarket_1458550928.png', 'What do we do?      A website designed to help you change your ', '', 'http://youtu.be/TURWdiUPLzE', 30, 0),
(162, 'Business_supermarket_1458550934.png', 'Get free entry to our cash prize draw for your efforts every month.', '', 'http://youtu.be/YlIhWEhFyE4', 30, 0),
(163, 'Business_supermarket_1458550959.png', 'If your idea is good enough; we will get you the funding you need', '', 'http://youtu.be/9NsbbFyXF4A', 30, 0),
(164, 'Business_supermarket_1458550965.png', 'Check out the quick links to our tutorial videos to help you get started', '', 'http://youtu.be/zvSSHQcM4gg', 30, 0),
(165, 'Business_supermarket_1458550970.png', 'Voice your opinion and be part of the next big thing.', '', 'http://youtu.be/pel1IW1kqjo', 30, 0),
(86, 'Business_supermarket_1458551355.png', 'What do we do? A website designed to help you change your financial future.', '', 'http://youtu.be/TURWdiUPLzE', 55, 0),
(87, 'Business_supermarket_1458551365.png', 'Get free entry to our cash prize draw for your efforts every month.', '', 'http://youtu.be/YlIhWEhFyE4', 55, 0),
(88, 'Business_supermarket_1458551371.png', 'If your idea is good enough; we will get you the funding you need', '', 'http://youtu.be/9NsbbFyXF4A', 55, 0),
(89, 'Business_supermarket_1458551376.png', 'Check out the quick links to our tutorial videos to help you get started', '', 'http://youtu.be/zvSSHQcM4gg', 55, 0),
(90, 'Business_supermarket_1458551381.png', 'Voice your opinion and be part of the next big thing.', '', 'http://youtu.be/pel1IW1kqjo', 55, 0),
(91, 'Business_supermarket_1458554422.png', 'What do we do? A website designed to help you change your financial future.', '', 'http://youtu.be/TURWdiUPLzE', 54, 0),
(92, 'Business_supermarket_1458554431.png', 'Get free entry to our cash prize draw for your efforts every month.', '', 'http://youtu.be/YlIhWEhFyE4', 54, 0),
(93, 'Business_supermarket_1458554440.png', 'If your idea is good enough; we will get you the funding you need', '', 'http://youtu.be/9NsbbFyXF4A', 54, 0),
(94, 'Business_supermarket_1458554447.png', 'Check out the quick links to our tutorial videos to help you get started', '', 'http://youtu.be/zvSSHQcM4gg', 54, 0),
(95, 'Business_supermarket_1458554453.png', 'Voice your opinion and be part of the next big thing.', '', 'http://youtu.be/pel1IW1kqjo', 54, 0),
(96, 'Business_supermarket_1458554575.png', 'What do we do? A website designed to help you change your financial future.', '', 'http://youtu.be/TURWdiUPLzE', 53, 0),
(97, 'Business_supermarket_1458554585.png', 'Get free entry to our cash prize draw for your efforts every month.', '', 'http://youtu.be/YlIhWEhFyE4', 53, 0),
(98, 'Business_supermarket_1458554594.png', 'If your idea is good enough; we will get you the funding you need', '', 'http://youtu.be/9NsbbFyXF4A', 53, 0),
(99, 'Business_supermarket_1458554599.png', 'Check out the quick links to our tutorial videos to help you get started', '', 'http://youtu.be/zvSSHQcM4gg', 53, 0),
(100, 'Business_supermarket_1458554604.png', 'Voice your opinion and be part of the next big thing.', '', 'http://youtu.be/pel1IW1kqjo', 53, 0),
(101, 'Business_supermarket_1458554708.png', 'What do we do? A website designed to help you change your financial future.', '', 'http://youtu.be/TURWdiUPLzE', 52, 0),
(102, 'Business_supermarket_1458554715.png', 'Get free entry to our cash prize draw for your efforts every month.', '', 'http://youtu.be/YlIhWEhFyE4', 52, 0),
(103, 'Business_supermarket_1458554731.png', 'If your idea is good enough; we will get you the funding you need', '', 'http://youtu.be/9NsbbFyXF4A', 52, 0),
(104, 'Business_supermarket_1458554737.png', 'Check out the quick links to our tutorial videos to help you get started', '', 'http://youtu.be/zvSSHQcM4gg', 52, 0),
(105, 'Business_supermarket_1458554744.png', 'Voice your opinion and be part of the next big thing.', '', 'http://youtu.be/pel1IW1kqjo', 52, 0),
(106, 'Business_supermarket_1458554865.png', 'What do we do? A website designed to help you change your financial future.', '', 'http://youtu.be/TURWdiUPLzE', 46, 0),
(107, 'Business_supermarket_1458554873.png', 'Get free entry to our cash prize draw for your efforts every month.', '', 'http://youtu.be/YlIhWEhFyE4', 46, 0),
(108, 'Business_supermarket_1458554878.png', 'If your idea is good enough; we will get you the funding you need', '', 'http://youtu.be/9NsbbFyXF4A', 46, 0),
(109, 'Business_supermarket_1458554881.png', 'Check out the quick links to our tutorial videos to help you get started', '', 'http://youtu.be/zvSSHQcM4gg', 46, 0),
(110, 'Business_supermarket_1458554891.png', 'Voice your opinion and be part of the next big thing.', '', 'http://youtu.be/pel1IW1kqjo', 46, 0),
(111, 'Business_supermarket_1458555007.png', 'What do we do? A website designed to help you change your financial future.', '', 'http://youtu.be/TURWdiUPLzE', 45, 0),
(112, 'Business_supermarket_1458555013.png', 'Get free entry to our cash prize draw for your efforts every month.', '', 'http://youtu.be/YlIhWEhFyE4', 45, 0),
(113, 'Business_supermarket_1458555024.png', 'If your idea is good enough; we will get you the funding you need', '', 'http://youtu.be/9NsbbFyXF4A', 45, 0),
(114, 'Business_supermarket_1458555037.png', 'Check out the quick links to our tutorial videos to help you get started', '', 'http://youtu.be/zvSSHQcM4gg', 45, 0),
(115, 'Business_supermarket_1458555051.png', 'Voice your opinion and be part of the next big thing.', '', 'http://youtu.be/pel1IW1kqjo', 45, 0),
(121, 'Business_supermarket_1458555252.png', 'What do we do? A website designed to help you change your financial future.', '', 'http://youtu.be/TURWdiUPLzE', 42, 0),
(122, 'Business_supermarket_1458555256.png', 'Get free entry to our cash prize draw for your efforts every month.', '', 'http://youtu.be/YlIhWEhFyE4', 42, 0),
(123, 'Business_supermarket_1458555261.png', 'If your idea is good enough; we will get you the funding you need', '', 'http://youtu.be/9NsbbFyXF4A', 42, 0),
(124, 'Business_supermarket_1458555265.png', 'Check out the quick links to our tutorial videos to help you get started', '', 'http://youtu.be/zvSSHQcM4gg', 42, 0),
(125, 'Business_supermarket_1458555270.png', 'Voice your opinion and be part of the next big thing.', '', 'http://youtu.be/pel1IW1kqjo', 42, 0),
(126, 'Business_supermarket_1458555374.png', 'What do we do? A website designed to help you change your financial future.', '', 'http://youtu.be/TURWdiUPLzE', 38, 0),
(127, 'Business_supermarket_1458555382.png', 'Get free entry to our cash prize draw for your efforts every month.', '', 'http://youtu.be/YlIhWEhFyE4', 38, 0),
(128, 'Business_supermarket_1458555392.png', 'If your idea is good enough; we will get you the funding you need', '', 'http://youtu.be/9NsbbFyXF4A', 38, 0),
(129, 'Business_supermarket_1458555399.png', 'Check out the quick links to our tutorial videos to help you get started', '', 'http://youtu.be/zvSSHQcM4gg', 38, 0),
(130, 'Business_supermarket_1458555404.png', 'Voice your opinion and be part of the next big thing.', '', 'http://youtu.be/pel1IW1kqjo', 38, 0),
(131, 'Business_supermarket_1458555560.png', 'What do we do? A website designed to help you change your financial future.', '', 'http://youtu.be/TURWdiUPLzE', 36, 0),
(132, 'Business_supermarket_1458555566.png', 'Get free entry to our cash prize draw for your efforts every month.', '', 'http://youtu.be/YlIhWEhFyE4', 36, 0),
(133, 'Business_supermarket_1458555573.png', 'If your idea is good enough; we will get you the funding you need', '', 'http://youtu.be/9NsbbFyXF4A', 36, 0),
(134, 'Business_supermarket_1458555582.png', 'Check out the quick links to our tutorial videos to help you get started', '', 'http://youtu.be/zvSSHQcM4gg', 36, 0),
(135, 'Business_supermarket_1458555588.png', 'Voice your opinion and be part of the next big thing.', '', 'http://youtu.be/pel1IW1kqjo', 36, 0),
(136, 'Business_supermarket_1458557160.png', 'What do we do? A website designed to help you change your financial future.', '', 'http://youtu.be/TURWdiUPLzE', 35, 0),
(137, 'Business_supermarket_1458557167.png', 'Get free entry to our cash prize draw for your efforts every month.', '', 'http://youtu.be/YlIhWEhFyE4', 35, 0),
(138, 'Business_supermarket_1458557172.png', 'If your idea is good enough; we will get you the funding you need', '', 'http://youtu.be/9NsbbFyXF4A', 35, 0),
(139, 'Business_supermarket_1458557175.png', 'Check out the quick links to our tutorial videos to help you get started', '', 'http://youtu.be/zvSSHQcM4gg', 35, 0),
(140, 'Business_supermarket_1458557180.png', 'Voice your opinion and be part of the next big thing.', '', 'http://youtu.be/pel1IW1kqjo', 35, 0),
(141, 'Business_supermarket_1458557270.png', 'What do we do? A website designed to help you change your financial future.', '', 'http://youtu.be/TURWdiUPLzE', 34, 0),
(142, 'Business_supermarket_1458557276.png', 'Get free entry to our cash prize draw for your efforts every month.', '', 'http://youtu.be/YlIhWEhFyE4', 34, 0),
(143, 'Business_supermarket_1458557282.png', 'If your idea is good enough; we will get you the funding you need', '', 'http://youtu.be/9NsbbFyXF4A', 34, 0),
(144, 'Business_supermarket_1458557289.png', 'Check out the quick links to our tutorial videos to help you get started', '', 'http://youtu.be/zvSSHQcM4gg', 34, 0),
(145, 'Business_supermarket_1458557301.png', 'Voice your opinion and be part of the next big thing.', '', 'http://youtu.be/pel1IW1kqjo', 34, 0),
(146, 'Business_supermarket_1458557400.png', 'What do we do? A website designed to help you change your financial future.', '', 'http://youtu.be/TURWdiUPLzE', 33, 0),
(147, 'Business_supermarket_1458557404.png', 'Get free entry to our cash prize draw for your efforts every month.', '', 'http://youtu.be/YlIhWEhFyE4', 33, 0),
(148, 'Business_supermarket_1458557411.png', 'If your idea is good enough; we will get you the funding you need', '', 'http://youtu.be/9NsbbFyXF4A', 33, 0),
(149, 'Business_supermarket_1458557419.png', 'Check out the quick links to our tutorial videos to help you get started', '', 'http://youtu.be/zvSSHQcM4gg', 33, 0),
(150, 'Business_supermarket_1458557428.png', 'Voice your opinion and be part of the next big thing.', '', 'http://youtu.be/pel1IW1kqjo', 33, 0),
(151, 'Business_supermarket_1458557525.png', 'What do we do? A website designed to help you change your financial future.', '', 'http://youtu.be/TURWdiUPLzE', 32, 0),
(152, 'Business_supermarket_1458557530.png', 'Get free entry to our cash prize draw for your efforts every month.', '', 'http://youtu.be/YlIhWEhFyE4', 32, 0),
(153, 'Business_supermarket_1458557537.png', 'If your idea is good enough; we will get you the funding you need', '', 'http://youtu.be/9NsbbFyXF4A', 32, 0),
(154, 'Business_supermarket_1458557547.png', 'Check out the quick links to our tutorial videos to help you get started', '', 'http://youtu.be/zvSSHQcM4gg', 32, 0),
(155, 'Business_supermarket_1458557570.png', 'Voice your opinion and be part of the next big thing.', '', 'http://youtu.be/zvSSHQcM4gg', 32, 0),
(156, 'Business_supermarket_1458557643.png', 'What do we do? A website designed to help you change your financial future.', '', 'http://youtu.be/TURWdiUPLzE', 31, 0),
(157, 'Business_supermarket_1458557648.png', 'Get free entry to our cash prize draw for your efforts every month.', '', 'http://youtu.be/YlIhWEhFyE4', 31, 0),
(158, 'Business_supermarket_1458557654.png', 'If your idea is good enough; we will get you the funding you need', '', 'http://youtu.be/9NsbbFyXF4A', 31, 0),
(159, 'Business_supermarket_1458557666.png', 'Check out the quick links to our tutorial videos to help you get started', '', 'http://youtu.be/zvSSHQcM4gg', 31, 0),
(160, 'Business_supermarket_1458557675.png', 'Voice your opinion and be part of the next big thing.', '', 'http://youtu.be/pel1IW1kqjo', 31, 0),
(171, 'Business_supermarket_1458557824.png', 'What do we do? A website designed to help you change your financial future.', '', 'http://youtu.be/TURWdiUPLzE', 28, 0),
(172, 'Business_supermarket_1458557830.png', 'Get free entry to our cash prize draw for your efforts every month.', '', 'http://youtu.be/YlIhWEhFyE4', 28, 0),
(173, 'Business_supermarket_1458557837.png', 'If your idea is good enough; we will get you the funding you need', '', 'http://youtu.be/9NsbbFyXF4A', 28, 0),
(174, 'Business_supermarket_1458557846.png', 'Check out the quick links to our tutorial videos to help you get started', '', 'http://youtu.be/zvSSHQcM4gg', 28, 0),
(175, 'Business_supermarket_1458557855.png', 'Voice your opinion and be part of the next big thing.', '', 'http://youtu.be/pel1IW1kqjo', 28, 0),
(176, 'Business_supermarket_1458560159.png', 'Registration is free and opens up an whole new world of opportunities', '', 'http://youtu.be/TURWdiUPLzE', 37, 0),
(177, 'Business_supermarket_1458560163.png', 'Get FREE access to companies that can help you achieve what you want', '', 'https://youtu.be/bDM1lN2N4lA', 37, 0),
(178, 'Business_supermarket_1458560175.png', 'Get entry to our prize draw which takes place each month for our members', '', 'http://youtu.be/Fn1rbdLG8nM', 37, 0),
(179, 'Business_supermarket_1458560184.png', 'You don\'t need to start a business to improve your financial status', '', 'http://youtu.be/YlIhWEhFyE4', 37, 0),
(180, 'Business_supermarket_1458560189.png', 'Voice your opinion and be part of the next big thing.', '', 'http://youtu.be/pel1IW1kqjo', 37, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_default_slider_listing`
--

CREATE TABLE `user_default_slider_listing` (
  `slider_id` int(11) NOT NULL,
  `slider_title` varchar(1024) NOT NULL,
  `page_id` varchar(1024) NOT NULL,
  `page_name` varchar(1024) NOT NULL,
  `page_slug` varchar(1024) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_slider_listing`
--

INSERT INTO `user_default_slider_listing` (`slider_id`, `slider_title`, `page_id`, `page_name`, `page_slug`) VALUES
(37, 'Account registration Slider', '', 'register/index', 'Account_registration_Slider.php'),
(36, 'Create a user listing step 4', '', 'listing/user_listing_step4', 'Create_a_user_listing_step_4.php'),
(35, 'Create a user listing step 3', '', 'listing/user_listing_step3', 'Create_a_user_listing_step_3.php'),
(34, 'My Account ', '', 'myaccount/update', 'My_Account_.php'),
(33, 'Create a user listing step 2', '', 'listing/user_listing_step2', 'Create_a_user_listing_step_2.php'),
(32, 'Create a user listing process', '', 'listing/create', 'Create_a_user_listing_process.php'),
(31, 'Video Tutorials Page', '', 'site/video_tutorials', 'Video_Tutorials_Page.php'),
(30, 'Business Services', '', 'businesslisting/business_services', 'Business_Services.php'),
(29, 'Science & Technology', '', 'listing/science_and_technology', 'Science_&_Technology.php'),
(24, 'index', '', 'site/index', 'index.php'),
(27, 'Business ideas', '', 'listing/business_ideas', 'Business_ideas.php'),
(22, 'Retail', '', 'listing/retail', 'Retail.php'),
(28, 'Industrial page', '', 'businesslisting/purchaseaccess', 'Industrial_page.php'),
(38, 'account activation', '', 'register/activation', 'account_activation.php'),
(52, 'faq', '', 'page/index', 'faq.php'),
(42, 'Manage listings', '', 'listing/index', 'Manage_listings.php'),
(44, 'Industrial', '', 'listing/industrial', 'Industrial.php'),
(45, 'Contact us', '', 'contact/index', 'Contact_us.php'),
(46, 'Prize Draw', '', 'prizedraw/index', 'Prize_Draw.php'),
(53, 'Create a business listing', '', 'businesslisting/create', 'Create_a_business_listing.php'),
(54, 'Create a business listing step 2', '', 'businesslisting/business_listing_step2', 'Create_a_business_listing_step_2.php'),
(55, 'Manage Business listing', '', 'businesslisting/index', 'Manage_Business_listing.php');

-- --------------------------------------------------------

--
-- Table structure for table `user_default_website_defaults`
--

CREATE TABLE `user_default_website_defaults` (
  `id` int(11) NOT NULL,
  `module` varchar(255) NOT NULL,
  `category` tinyint(1) NOT NULL DEFAULT '1',
  `unit` varchar(50) NOT NULL,
  `uom` varchar(50) NOT NULL COMMENT 'Unit of mature',
  `cost` decimal(10,2) NOT NULL,
  `currency_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_default_website_defaults`
--

INSERT INTO `user_default_website_defaults` (`id`, `module`, `category`, `unit`, `uom`, `cost`, `currency_id`) VALUES
(1, 'Banner cost', 1, '1', '1 week', 2.99, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_prizedraw`
--

CREATE TABLE `user_prizedraw` (
  `user_prizedraw_id` int(11) NOT NULL,
  `user_prizedraw_date` date NOT NULL,
  `user_prizedraw_amount` decimal(10,2) NOT NULL,
  `user_prizedraw_payout_date` date NOT NULL,
  `user_prizedraw_payment_ref` int(11) NOT NULL,
  `user_default_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drg_currency_forex`
--
ALTER TABLE `drg_currency_forex`
  ADD PRIMARY KEY (`currency`);

--
-- Indexes for table `user_default_account_balance`
--
ALTER TABLE `user_default_account_balance`
  ADD PRIMARY KEY (`user_default_account_balance_id`);

--
-- Indexes for table `user_default_activity_date`
--
ALTER TABLE `user_default_activity_date`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_default_activity_log`
--
ALTER TABLE `user_default_activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_default_addresses`
--
ALTER TABLE `user_default_addresses`
  ADD PRIMARY KEY (`user_default_address_id`),
  ADD UNIQUE KEY `user_default_address_id_UNIQUE` (`user_default_address_id`),
  ADD KEY `fk_user_default_address_user_default_profile_idx` (`user_default_profile_id`);

--
-- Indexes for table `user_default_adminuser`
--
ALTER TABLE `user_default_adminuser`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_default_banner_ads`
--
ALTER TABLE `user_default_banner_ads`
  ADD PRIMARY KEY (`user_default_listing_banner_id`),
  ADD UNIQUE KEY `user_default_listing_banner_id_UNIQUE` (`user_default_listing_banner_id`),
  ADD KEY `fk_user_default_banner_ads_user_default_profiles1_idx` (`user_default_id`),
  ADD KEY `fk_user_default_banner_ads_user_default_listing1_idx` (`user_default_listing_id`);

--
-- Indexes for table `user_default_business`
--
ALTER TABLE `user_default_business`
  ADD PRIMARY KEY (`user_default_business_id`),
  ADD UNIQUE KEY `user_default_business_email` (`user_default_business_email`),
  ADD UNIQUE KEY `user_default_business_username` (`user_default_business_username`),
  ADD KEY `fk_user_default_business_user_default_currency1_idx` (`user_default_business_currency`),
  ADD KEY `fk_user_default_business2_idx` (`user_default_business_sector`);

--
-- Indexes for table `user_default_business_account_balance`
--
ALTER TABLE `user_default_business_account_balance`
  ADD PRIMARY KEY (`business_user_account_balance_id`);

--
-- Indexes for table `user_default_business_addresses`
--
ALTER TABLE `user_default_business_addresses`
  ADD PRIMARY KEY (`user_default_business_addr_id`),
  ADD UNIQUE KEY `user_default_business_id` (`user_default_business_id`),
  ADD KEY `fk_user_default_business_address_user_default_business1_idx` (`user_default_business_id`),
  ADD KEY `fk_user_default_business_address_user_default_country1_idx` (`user_default_business_country`);

--
-- Indexes for table `user_default_business_favourite_blisting`
--
ALTER TABLE `user_default_business_favourite_blisting`
  ADD KEY `fk_user_default_business_listing3_idx` (`user_default_business_id`),
  ADD KEY `fk_user_default_business_listing4_idx` (`blisting_id`);

--
-- Indexes for table `user_default_business_financial`
--
ALTER TABLE `user_default_business_financial`
  ADD PRIMARY KEY (`business_user_transaction_id`),
  ADD UNIQUE KEY `business_user_transaction_id_UNIQUE` (`business_user_transaction_id`),
  ADD KEY `fk_business_user_financial_business_user_profiles1_idx` (`business_user_transaction_profile_id`);

--
-- Indexes for table `user_default_business_listing`
--
ALTER TABLE `user_default_business_listing`
  ADD PRIMARY KEY (`user_default_business_blid`),
  ADD KEY `fk_user_default_business_listing5_idx` (`user_default_business_id`);

--
-- Indexes for table `user_default_business_listing_images`
--
ALTER TABLE `user_default_business_listing_images`
  ADD PRIMARY KEY (`user_default_business_image_id`),
  ADD KEY `fk_user_default_business_listing1_idx` (`user_default_business_blid`);

--
-- Indexes for table `user_default_business_listing_videos`
--
ALTER TABLE `user_default_business_listing_videos`
  ADD PRIMARY KEY (`user_default_business_video_id`),
  ADD KEY `fk_user_default_business_listing2_idx` (`user_default_business_blid`);

--
-- Indexes for table `user_default_business_prize_points`
--
ALTER TABLE `user_default_business_prize_points`
  ADD PRIMARY KEY (`user_default_business_prize_points_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`user_default_business_prize_points_id`),
  ADD UNIQUE KEY `user_default_business_blisting_id` (`user_default_business_blisting_id`),
  ADD UNIQUE KEY `user_default_business_blisting_points_user_id` (`user_default_business_blisting_points_user_id`);

--
-- Indexes for table `user_default_business_profession`
--
ALTER TABLE `user_default_business_profession`
  ADD PRIMARY KEY (`list_profession_id`);

--
-- Indexes for table `user_default_contents`
--
ALTER TABLE `user_default_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_default_country`
--
ALTER TABLE `user_default_country`
  ADD PRIMARY KEY (`user_default_country_id`);

--
-- Indexes for table `user_default_currency`
--
ALTER TABLE `user_default_currency`
  ADD PRIMARY KEY (`currency_id`);

--
-- Indexes for table `user_default_currency_forex`
--
ALTER TABLE `user_default_currency_forex`
  ADD PRIMARY KEY (`currency`);

--
-- Indexes for table `user_default_data`
--
ALTER TABLE `user_default_data`
  ADD PRIMARY KEY (`data_id`);

--
-- Indexes for table `user_default_departments`
--
ALTER TABLE `user_default_departments`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `user_default_financial`
--
ALTER TABLE `user_default_financial`
  ADD PRIMARY KEY (`user_default_transaction_id`),
  ADD UNIQUE KEY `user_default_transaction_id_UNIQUE` (`user_default_transaction_id`),
  ADD KEY `fk_user_default_financial_user_default_profiles1_idx` (`user_default_transaction_profile_id`);

--
-- Indexes for table `user_default_interactions`
--
ALTER TABLE `user_default_interactions`
  ADD PRIMARY KEY (`user_default_interaction_id`),
  ADD UNIQUE KEY `user_default_interaction_id_UNIQUE` (`user_default_interaction_id`),
  ADD KEY `fk_user_default_interaction_user_default_profiles1_idx` (`user_default_profile_id`),
  ADD KEY `fk_user_default_interaction_user_default_listing1_idx` (`user_default_listing_id`);

--
-- Indexes for table `user_default_interactions_messages`
--
ALTER TABLE `user_default_interactions_messages`
  ADD PRIMARY KEY (`user_default_interactions_message_id`),
  ADD UNIQUE KEY `user_default_interactions_message_id_UNIQUE` (`user_default_interactions_message_id`),
  ADD KEY `fk_user_default_interactions_messages_user_default_interact_idx` (`user_default_interaction_id`);

--
-- Indexes for table `user_default_investor_account_balance`
--
ALTER TABLE `user_default_investor_account_balance`
  ADD PRIMARY KEY (`user_default_investment_account_balance_id`);

--
-- Indexes for table `user_default_investor_admin`
--
ALTER TABLE `user_default_investor_admin`
  ADD PRIMARY KEY (`user_default_investor_admin_id`);

--
-- Indexes for table `user_default_investor_financial`
--
ALTER TABLE `user_default_investor_financial`
  ADD PRIMARY KEY (`user_default_investment_transaction_id`);

--
-- Indexes for table `user_default_investor_messages`
--
ALTER TABLE `user_default_investor_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_default_investor_messages_sent`
--
ALTER TABLE `user_default_investor_messages_sent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_default_investor_voting`
--
ALTER TABLE `user_default_investor_voting`
  ADD PRIMARY KEY (`user_default_investor_voting_id`);

--
-- Indexes for table `user_default_investor_voting_interface`
--
ALTER TABLE `user_default_investor_voting_interface`
  ADD PRIMARY KEY (`user_default_investor_voting_id`);

--
-- Indexes for table `user_default_like_interaction`
--
ALTER TABLE `user_default_like_interaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_default_like_sample_feedback`
--
ALTER TABLE `user_default_like_sample_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_default_listing`
--
ALTER TABLE `user_default_listing`
  ADD PRIMARY KEY (`user_default_listing_id`),
  ADD UNIQUE KEY `user_default_listing_id_UNIQUE` (`user_default_listing_id`),
  ADD KEY `fk_user_default_listing_user_default_profiles1_idx` (`user_default_profiles_id`),
  ADD KEY `fk_user_default_listing_user_default_category` (`user_default_listing_category_id`),
  ADD KEY `fk_user_default_listing_user_default_lookingfor` (`user_default_listing_lookingfor_id`),
  ADD KEY `fk_user_default_listing_user_default_limit_viewing` (`user_default_listing_limit_viewing_id`);

--
-- Indexes for table `user_default_listing_addresses`
--
ALTER TABLE `user_default_listing_addresses`
  ADD PRIMARY KEY (`user_default_listing_address_id`),
  ADD UNIQUE KEY `user_default_listing_address_id_UNIQUE` (`user_default_listing_address_id`),
  ADD KEY `fk_user_default_listing_address_user_default_profiles1_idx` (`user_default_listing_id`);

--
-- Indexes for table `user_default_listing_category`
--
ALTER TABLE `user_default_listing_category`
  ADD PRIMARY KEY (`user_default_listing_category_id`);

--
-- Indexes for table `user_default_listing_comments`
--
ALTER TABLE `user_default_listing_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comments_user_id` (`user_default_profiles_id`);

--
-- Indexes for table `user_default_listing_comments_likes`
--
ALTER TABLE `user_default_listing_comments_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_default_listing_company_details`
--
ALTER TABLE `user_default_listing_company_details`
  ADD PRIMARY KEY (`user_default_listing_company_id`);

--
-- Indexes for table `user_default_listing_images`
--
ALTER TABLE `user_default_listing_images`
  ADD PRIMARY KEY (`user_default_listing_image_id`),
  ADD UNIQUE KEY `user_default_listing_image_id_UNIQUE` (`user_default_listing_image_id`),
  ADD KEY `fk_user_default_listing_images_user_default_listing1_idx` (`user_default_listing_id`);

--
-- Indexes for table `user_default_listing_lookingfor`
--
ALTER TABLE `user_default_listing_lookingfor`
  ADD PRIMARY KEY (`user_default_listing_lookingfor_id`);

--
-- Indexes for table `user_default_listing_marketing`
--
ALTER TABLE `user_default_listing_marketing`
  ADD PRIMARY KEY (`user_default_listing_marketing_id`),
  ADD UNIQUE KEY `user_default_listing_marketing_id_UNIQUE` (`user_default_listing_marketing_id`);

--
-- Indexes for table `user_default_listing_marketing_connection`
--
ALTER TABLE `user_default_listing_marketing_connection`
  ADD PRIMARY KEY (`user_default_listing_marketing_connection_id`),
  ADD UNIQUE KEY `iduser_default_listing_marketing_connection_id_UNIQUE` (`user_default_listing_marketing_connection_id`),
  ADD KEY `fk_user_default_listing_marketing_connection_user_default_l_idx` (`user_default_listing_marketing_question_id`),
  ADD KEY `fk_user_default_listing_marketing_connection_user_default_p_idx` (`user_default_listing_marketing_user_id`);

--
-- Indexes for table `user_default_listing_table_values`
--
ALTER TABLE `user_default_listing_table_values`
  ADD PRIMARY KEY (`user_default_listing_table_value_id`),
  ADD UNIQUE KEY `user_default_listing_table_value_id_UNIQUE` (`user_default_listing_table_value_id`),
  ADD KEY `fk_user_default_listing_table_values_user_default_listing1_idx` (`user_default_listing_id`);

--
-- Indexes for table `user_default_listing_videos`
--
ALTER TABLE `user_default_listing_videos`
  ADD PRIMARY KEY (`iuser_default_listing_video_id`),
  ADD UNIQUE KEY `iuser_default_listing_video_id_UNIQUE` (`iuser_default_listing_video_id`),
  ADD KEY `fk_user_default_listing_videos_user_default_listing1_idx` (`user_default_listing_id`);

--
-- Indexes for table `user_default_listing_voice_your_opinion`
--
ALTER TABLE `user_default_listing_voice_your_opinion`
  ADD PRIMARY KEY (`user_default_listing_comment_id`),
  ADD UNIQUE KEY `user_default_listing_comment_id_UNIQUE` (`user_default_listing_comment_id`),
  ADD KEY `fk_user_default_listing_voice_your_opinion_user_default_lis_idx` (`user_default_listing_id`),
  ADD KEY `fk_user_default_listing_voice_your_opinion_user_default_pro_idx` (`user_default_listing_comment_user_id`),
  ADD KEY `fk_user_default_listing_voice_your_opinion_user_default_lis_idx1` (`user_default_listing_comment_parent_id`);

--
-- Indexes for table `user_default_log_transaction`
--
ALTER TABLE `user_default_log_transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `user_default_log_transaction_admin`
--
ALTER TABLE `user_default_log_transaction_admin`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `user_default_log_types`
--
ALTER TABLE `user_default_log_types`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `user_default_mail_template`
--
ALTER TABLE `user_default_mail_template`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `user_default_prize_draw`
--
ALTER TABLE `user_default_prize_draw`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_default_prize_draw_winners`
--
ALTER TABLE `user_default_prize_draw_winners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_prize_draw_user_default_profiles1_idx` (`user_default_id`);

--
-- Indexes for table `user_default_prize_points`
--
ALTER TABLE `user_default_prize_points`
  ADD PRIMARY KEY (`user_default_prize_points_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`user_default_prize_points_id`),
  ADD KEY `fk_user_default_prize_points_user_default_profiles1_idx` (`user_default_listing_points_user_id`),
  ADD KEY `fk_user_default_prize_points_user_default_listing1_idx` (`user_default_listing_id`);

--
-- Indexes for table `user_default_profession`
--
ALTER TABLE `user_default_profession`
  ADD PRIMARY KEY (`profession_id`);

--
-- Indexes for table `user_default_profiles`
--
ALTER TABLE `user_default_profiles`
  ADD PRIMARY KEY (`user_default_id`),
  ADD UNIQUE KEY `drg_email` (`user_default_email`),
  ADD UNIQUE KEY `drg_username` (`user_default_username`),
  ADD UNIQUE KEY `user_default_id_UNIQUE` (`user_default_id`);

--
-- Indexes for table `user_default_profiles_messages`
--
ALTER TABLE `user_default_profiles_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_default_profiles_messages_rating`
--
ALTER TABLE `user_default_profiles_messages_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_default_profiles_messages_sent`
--
ALTER TABLE `user_default_profiles_messages_sent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_default_sample_listing`
--
ALTER TABLE `user_default_sample_listing`
  ADD PRIMARY KEY (`user_default_sample_listing_id`),
  ADD UNIQUE KEY `user_default_listing` (`user_default_listing_id`);

--
-- Indexes for table `user_default_sample_listing_feedbacks`
--
ALTER TABLE `user_default_sample_listing_feedbacks`
  ADD PRIMARY KEY (`user_default_sample_listing_feedback_id`);

--
-- Indexes for table `user_default_sample_listing_orders`
--
ALTER TABLE `user_default_sample_listing_orders`
  ADD PRIMARY KEY (`user_default_sample_listing_order_id`);

--
-- Indexes for table `user_default_sample_listing_sliders`
--
ALTER TABLE `user_default_sample_listing_sliders`
  ADD PRIMARY KEY (`user_default_listing_image_id`),
  ADD UNIQUE KEY `user_default_listing_image_ids_UNIQUE` (`user_default_listing_image_id`),
  ADD KEY `fk_user_default_sample_listing_images_user_default_listing1_idx` (`user_default_listing_lid`);

--
-- Indexes for table `user_default_sell_equity`
--
ALTER TABLE `user_default_sell_equity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_default_shareholders`
--
ALTER TABLE `user_default_shareholders`
  ADD PRIMARY KEY (`user_default_shareholder_id`);

--
-- Indexes for table `user_default_site_actions`
--
ALTER TABLE `user_default_site_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_default_site_bannerads`
--
ALTER TABLE `user_default_site_bannerads`
  ADD PRIMARY KEY (`user_default_banner_id`);

--
-- Indexes for table `user_default_site_defaults`
--
ALTER TABLE `user_default_site_defaults`
  ADD PRIMARY KEY (`user_default_site_default_id`);

--
-- Indexes for table `user_default_slider_btns`
--
ALTER TABLE `user_default_slider_btns`
  ADD PRIMARY KEY (`btn_id`);

--
-- Indexes for table `user_default_slider_images`
--
ALTER TABLE `user_default_slider_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `user_default_slider_listing`
--
ALTER TABLE `user_default_slider_listing`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `user_default_website_defaults`
--
ALTER TABLE `user_default_website_defaults`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_currency_id` (`currency_id`);

--
-- Indexes for table `user_prizedraw`
--
ALTER TABLE `user_prizedraw`
  ADD PRIMARY KEY (`user_prizedraw_id`),
  ADD UNIQUE KEY `user_prizedraw_id_UNIQUE` (`user_prizedraw_id`),
  ADD KEY `fk_user_prizedraw_user_default_profiles1_idx` (`user_default_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_default_account_balance`
--
ALTER TABLE `user_default_account_balance`
  MODIFY `user_default_account_balance_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_activity_date`
--
ALTER TABLE `user_default_activity_date`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_default_activity_log`
--
ALTER TABLE `user_default_activity_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=360;
--
-- AUTO_INCREMENT for table `user_default_addresses`
--
ALTER TABLE `user_default_addresses`
  MODIFY `user_default_address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_default_adminuser`
--
ALTER TABLE `user_default_adminuser`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_default_banner_ads`
--
ALTER TABLE `user_default_banner_ads`
  MODIFY `user_default_listing_banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_default_business`
--
ALTER TABLE `user_default_business`
  MODIFY `user_default_business_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_business_account_balance`
--
ALTER TABLE `user_default_business_account_balance`
  MODIFY `business_user_account_balance_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_business_addresses`
--
ALTER TABLE `user_default_business_addresses`
  MODIFY `user_default_business_addr_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_business_financial`
--
ALTER TABLE `user_default_business_financial`
  MODIFY `business_user_transaction_id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_business_listing`
--
ALTER TABLE `user_default_business_listing`
  MODIFY `user_default_business_blid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_business_listing_images`
--
ALTER TABLE `user_default_business_listing_images`
  MODIFY `user_default_business_image_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_business_listing_videos`
--
ALTER TABLE `user_default_business_listing_videos`
  MODIFY `user_default_business_video_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_business_prize_points`
--
ALTER TABLE `user_default_business_prize_points`
  MODIFY `user_default_business_prize_points_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_business_profession`
--
ALTER TABLE `user_default_business_profession`
  MODIFY `list_profession_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `user_default_contents`
--
ALTER TABLE `user_default_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `user_default_country`
--
ALTER TABLE `user_default_country`
  MODIFY `user_default_country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;
--
-- AUTO_INCREMENT for table `user_default_currency`
--
ALTER TABLE `user_default_currency`
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_default_data`
--
ALTER TABLE `user_default_data`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user_default_departments`
--
ALTER TABLE `user_default_departments`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_default_financial`
--
ALTER TABLE `user_default_financial`
  MODIFY `user_default_transaction_id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_default_interactions`
--
ALTER TABLE `user_default_interactions`
  MODIFY `user_default_interaction_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_interactions_messages`
--
ALTER TABLE `user_default_interactions_messages`
  MODIFY `user_default_interactions_message_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_investor_account_balance`
--
ALTER TABLE `user_default_investor_account_balance`
  MODIFY `user_default_investment_account_balance_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_investor_admin`
--
ALTER TABLE `user_default_investor_admin`
  MODIFY `user_default_investor_admin_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_investor_financial`
--
ALTER TABLE `user_default_investor_financial`
  MODIFY `user_default_investment_transaction_id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_investor_messages`
--
ALTER TABLE `user_default_investor_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_investor_messages_sent`
--
ALTER TABLE `user_default_investor_messages_sent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_investor_voting`
--
ALTER TABLE `user_default_investor_voting`
  MODIFY `user_default_investor_voting_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_investor_voting_interface`
--
ALTER TABLE `user_default_investor_voting_interface`
  MODIFY `user_default_investor_voting_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_like_interaction`
--
ALTER TABLE `user_default_like_interaction`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_like_sample_feedback`
--
ALTER TABLE `user_default_like_sample_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_listing`
--
ALTER TABLE `user_default_listing`
  MODIFY `user_default_listing_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_listing_addresses`
--
ALTER TABLE `user_default_listing_addresses`
  MODIFY `user_default_listing_address_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_listing_category`
--
ALTER TABLE `user_default_listing_category`
  MODIFY `user_default_listing_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_default_listing_comments`
--
ALTER TABLE `user_default_listing_comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_listing_comments_likes`
--
ALTER TABLE `user_default_listing_comments_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_listing_company_details`
--
ALTER TABLE `user_default_listing_company_details`
  MODIFY `user_default_listing_company_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_listing_images`
--
ALTER TABLE `user_default_listing_images`
  MODIFY `user_default_listing_image_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_listing_lookingfor`
--
ALTER TABLE `user_default_listing_lookingfor`
  MODIFY `user_default_listing_lookingfor_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_listing_marketing`
--
ALTER TABLE `user_default_listing_marketing`
  MODIFY `user_default_listing_marketing_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_listing_marketing_connection`
--
ALTER TABLE `user_default_listing_marketing_connection`
  MODIFY `user_default_listing_marketing_connection_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_default_listing_table_values`
--
ALTER TABLE `user_default_listing_table_values`
  MODIFY `user_default_listing_table_value_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_listing_videos`
--
ALTER TABLE `user_default_listing_videos`
  MODIFY `iuser_default_listing_video_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_listing_voice_your_opinion`
--
ALTER TABLE `user_default_listing_voice_your_opinion`
  MODIFY `user_default_listing_comment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_log_transaction`
--
ALTER TABLE `user_default_log_transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user_default_log_transaction_admin`
--
ALTER TABLE `user_default_log_transaction_admin`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_default_log_types`
--
ALTER TABLE `user_default_log_types`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_default_mail_template`
--
ALTER TABLE `user_default_mail_template`
  MODIFY `template_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;
--
-- AUTO_INCREMENT for table `user_default_prize_draw`
--
ALTER TABLE `user_default_prize_draw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_default_prize_draw_winners`
--
ALTER TABLE `user_default_prize_draw_winners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_prize_points`
--
ALTER TABLE `user_default_prize_points`
  MODIFY `user_default_prize_points_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_default_profession`
--
ALTER TABLE `user_default_profession`
  MODIFY `profession_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `user_default_profiles`
--
ALTER TABLE `user_default_profiles`
  MODIFY `user_default_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_default_profiles_messages`
--
ALTER TABLE `user_default_profiles_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_profiles_messages_rating`
--
ALTER TABLE `user_default_profiles_messages_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_default_profiles_messages_sent`
--
ALTER TABLE `user_default_profiles_messages_sent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_sample_listing`
--
ALTER TABLE `user_default_sample_listing`
  MODIFY `user_default_sample_listing_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_sample_listing_feedbacks`
--
ALTER TABLE `user_default_sample_listing_feedbacks`
  MODIFY `user_default_sample_listing_feedback_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_sample_listing_orders`
--
ALTER TABLE `user_default_sample_listing_orders`
  MODIFY `user_default_sample_listing_order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_sample_listing_sliders`
--
ALTER TABLE `user_default_sample_listing_sliders`
  MODIFY `user_default_listing_image_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_sell_equity`
--
ALTER TABLE `user_default_sell_equity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_shareholders`
--
ALTER TABLE `user_default_shareholders`
  MODIFY `user_default_shareholder_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_default_site_actions`
--
ALTER TABLE `user_default_site_actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `user_default_site_bannerads`
--
ALTER TABLE `user_default_site_bannerads`
  MODIFY `user_default_banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_default_site_defaults`
--
ALTER TABLE `user_default_site_defaults`
  MODIFY `user_default_site_default_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_default_slider_btns`
--
ALTER TABLE `user_default_slider_btns`
  MODIFY `btn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=638;
--
-- AUTO_INCREMENT for table `user_default_slider_images`
--
ALTER TABLE `user_default_slider_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;
--
-- AUTO_INCREMENT for table `user_default_slider_listing`
--
ALTER TABLE `user_default_slider_listing`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `user_default_website_defaults`
--
ALTER TABLE `user_default_website_defaults`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_prizedraw`
--
ALTER TABLE `user_prizedraw`
  MODIFY `user_prizedraw_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_default_addresses`
--
ALTER TABLE `user_default_addresses`
  ADD CONSTRAINT `fk_user_default_address_user_default_profile` FOREIGN KEY (`user_default_profile_id`) REFERENCES `user_default_profiles` (`user_default_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `user_default_banner_ads`
--
ALTER TABLE `user_default_banner_ads`
  ADD CONSTRAINT `fk_user_default_banner_ads_user_default_listing1` FOREIGN KEY (`user_default_listing_id`) REFERENCES `user_default_listing` (`user_default_listing_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_default_banner_ads_user_default_profiles1` FOREIGN KEY (`user_default_id`) REFERENCES `user_default_profiles` (`user_default_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_default_business`
--
ALTER TABLE `user_default_business`
  ADD CONSTRAINT `fk_user_default_business_user_default_business_profession1` FOREIGN KEY (`user_default_business_sector`) REFERENCES `user_default_business_profession` (`list_profession_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_default_business_user_default_currency1` FOREIGN KEY (`user_default_business_currency`) REFERENCES `user_default_currency` (`currency_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_default_business_addresses`
--
ALTER TABLE `user_default_business_addresses`
  ADD CONSTRAINT `fk_user_default_business_address_user_default_business1` FOREIGN KEY (`user_default_business_id`) REFERENCES `user_default_business` (`user_default_business_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_default_business_favourite_blisting`
--
ALTER TABLE `user_default_business_favourite_blisting`
  ADD CONSTRAINT `fk_user_default_business_listing3` FOREIGN KEY (`user_default_business_id`) REFERENCES `user_default_business` (`user_default_business_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_default_business_listing4` FOREIGN KEY (`blisting_id`) REFERENCES `user_default_business_listing` (`user_default_business_blid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_default_business_listing`
--
ALTER TABLE `user_default_business_listing`
  ADD CONSTRAINT `fk_user_default_business_listing5` FOREIGN KEY (`user_default_business_id`) REFERENCES `user_default_business` (`user_default_business_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_default_business_listing_images`
--
ALTER TABLE `user_default_business_listing_images`
  ADD CONSTRAINT `fk_user_default_business_listing1` FOREIGN KEY (`user_default_business_blid`) REFERENCES `user_default_business_listing` (`user_default_business_blid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_default_business_listing_videos`
--
ALTER TABLE `user_default_business_listing_videos`
  ADD CONSTRAINT `fk_user_default_business_listing2` FOREIGN KEY (`user_default_business_blid`) REFERENCES `user_default_business_listing` (`user_default_business_blid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_default_listing`
--
ALTER TABLE `user_default_listing`
  ADD CONSTRAINT `fk_user_default_listing_user_default_profiles1` FOREIGN KEY (`user_default_profiles_id`) REFERENCES `user_default_profiles` (`user_default_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_default_listing_addresses`
--
ALTER TABLE `user_default_listing_addresses`
  ADD CONSTRAINT `fk_user_default_listing_address_user_default_profiles1` FOREIGN KEY (`user_default_listing_id`) REFERENCES `user_default_listing` (`user_default_listing_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_default_listing_images`
--
ALTER TABLE `user_default_listing_images`
  ADD CONSTRAINT `fk_user_default_listing_images_user_default_listing1` FOREIGN KEY (`user_default_listing_id`) REFERENCES `user_default_listing` (`user_default_listing_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_default_listing_marketing_connection`
--
ALTER TABLE `user_default_listing_marketing_connection`
  ADD CONSTRAINT `fk_user_default_listing_marketing_connection_user_default_lis1` FOREIGN KEY (`user_default_listing_marketing_question_id`) REFERENCES `user_default_listing_marketing` (`user_default_listing_marketing_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_default_listing_marketing_connection_user_default_pro1` FOREIGN KEY (`user_default_listing_marketing_user_id`) REFERENCES `user_default_profiles` (`user_default_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_default_listing_table_values`
--
ALTER TABLE `user_default_listing_table_values`
  ADD CONSTRAINT `fk_user_default_listing_table_values_user_default_listing1` FOREIGN KEY (`user_default_listing_id`) REFERENCES `user_default_listing` (`user_default_listing_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_default_listing_videos`
--
ALTER TABLE `user_default_listing_videos`
  ADD CONSTRAINT `fk_user_default_listing_videos_user_default_listing1` FOREIGN KEY (`user_default_listing_id`) REFERENCES `user_default_listing` (`user_default_listing_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_default_listing_voice_your_opinion`
--
ALTER TABLE `user_default_listing_voice_your_opinion`
  ADD CONSTRAINT `fk_user_default_listing_voice_your_opinion_user_default_listi1` FOREIGN KEY (`user_default_listing_id`) REFERENCES `user_default_listing` (`user_default_listing_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_default_listing_voice_your_opinion_user_default_listi2` FOREIGN KEY (`user_default_listing_comment_parent_id`) REFERENCES `user_default_listing_voice_your_opinion` (`user_default_listing_comment_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_default_listing_voice_your_opinion_user_default_profi1` FOREIGN KEY (`user_default_listing_comment_user_id`) REFERENCES `user_default_profiles` (`user_default_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_default_prize_points`
--
ALTER TABLE `user_default_prize_points`
  ADD CONSTRAINT `fk_user_default_prize_points_user_default_listing1` FOREIGN KEY (`user_default_listing_id`) REFERENCES `user_default_listing` (`user_default_listing_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_default_prize_points_user_default_profiles1` FOREIGN KEY (`user_default_listing_points_user_id`) REFERENCES `user_default_profiles` (`user_default_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_default_website_defaults`
--
ALTER TABLE `user_default_website_defaults`
  ADD CONSTRAINT `fk_currency_id` FOREIGN KEY (`currency_id`) REFERENCES `user_default_currency` (`currency_id`);

--
-- Constraints for table `user_prizedraw`
--
ALTER TABLE `user_prizedraw`
  ADD CONSTRAINT `fk_user_prizedraw_user_default_profiles1` FOREIGN KEY (`user_default_user_id`) REFERENCES `user_default_profiles` (`user_default_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
