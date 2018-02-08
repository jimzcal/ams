-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2018 at 05:57 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppei_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('superAdmin', '1', 1513601744);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'PPEI backend user', NULL, NULL, 1513596622, 1513682973),
('admin2', 1, 'Admin', NULL, NULL, 1515065426, 1515065426),
('createAttribute', 2, 'User can Create attributes for new web feature', NULL, NULL, 1513682550, 1513682550),
('createContent', 2, 'User can add content to web features', NULL, NULL, 1513677125, 1513677125),
('createDatatype', 2, 'User can create data-type for the attribute', NULL, NULL, 1513682646, 1513682646),
('createFeature', 2, 'This permits the user to create new feature of the website', NULL, NULL, 1513596702, 1513596702),
('createFile', 2, 'User can Upload file to selected folder', NULL, NULL, 1513683734, 1513683734),
('createFolder', 2, 'User can create folder and upload files in it', NULL, NULL, 1513597145, 1513597145),
('createHubcategory', 2, 'User can create Hub Category', NULL, NULL, 1513682270, 1513682270),
('createHubphase', 2, 'User can add Program Phase', NULL, NULL, 1513682114, 1513682114),
('createHubresource', 2, 'User can create Knowledge Hub Resources-type', NULL, NULL, 1513682398, 1513682398),
('createKnowledgeHub', 2, 'User can add resources to Knowledge Hub', NULL, NULL, 1513596869, 1513596869),
('createPhotoGallery', 2, 'User can create album and add photos', NULL, NULL, 1513597047, 1513597047),
('deleteAttribute', 2, 'User can Delete Attribute', NULL, NULL, 1513682607, 1513682607),
('deleteContent', 2, 'User can Delete contents in any web features', NULL, NULL, 1513681910, 1513681910),
('deleteDatatype', 2, 'User can delete Data-type', NULL, NULL, 1513682702, 1513682702),
('deleteFeature', 2, 'This permits the user to delete web feature and all its contents', NULL, NULL, 1513596803, 1513596803),
('deleteFile', 2, 'User delete file from selected folder', NULL, NULL, 1513683773, 1513683773),
('deleteFolder', 2, 'User can delete folder and files in it', NULL, NULL, 1513597210, 1513597210),
('deleteHubcategory', 2, 'User can delete Knowledge Hub Category', NULL, NULL, 1513682353, 1513682353),
('deleteHubphase', 2, 'User can Delete Program Phase', NULL, NULL, 1513682193, 1513682193),
('deleteHubresource', 2, 'User can delete Knowledge Hub Resources-type', NULL, NULL, 1513682510, 1513682510),
('deleteKnowledgeHub', 2, 'User can delete resources from Knowledge Hub', NULL, NULL, 1513596923, 1513596923),
('deletePhotoGallery', 2, 'User can delete album and photos from Photo Gallery', NULL, NULL, 1513597096, 1513597096),
('downloadFile', 2, 'User can download file from selected admin folder', NULL, NULL, 1513683961, 1513683961),
('manageUsers', 2, 'User can manage user accounts', NULL, NULL, 1513680071, 1513680071),
('superAdmin', 1, 'Super Admin is the head of all Admin Users of this website', NULL, NULL, 1513596515, 1513772376),
('updateAttribute', 2, 'User can update name of attribute', NULL, NULL, 1513682581, 1513682581),
('updateContent', 2, 'User can update contents of any web features', NULL, NULL, 1513681951, 1514977193),
('updateDatatype', 2, 'User can update Data-type', NULL, NULL, 1513682679, 1513682679),
('updateFeature', 2, 'This permits the user to edit feature of the website', NULL, NULL, 1513596736, 1513596760),
('updateFolder', 2, 'User can update admin Folders', NULL, NULL, 1513681987, 1514979967),
('updateHubcategory', 2, 'User can Update Knowledge Hub Category name', NULL, NULL, 1513682306, 1513682306),
('updateHubphase', 2, 'User can Update Program Phase', NULL, NULL, 1513682170, 1513682170),
('updateHubresource', 2, 'User can update Knowledge Hub Resources-type', NULL, NULL, 1513682481, 1513682481),
('updateKnowledgehub', 2, 'User can change resources in knowledge hub', NULL, NULL, 1513682040, 1513682040),
('updatePhotoGallery', 2, 'User can update Album Name of Photo Gallery', NULL, NULL, 1513682080, 1513682080);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'createAttribute'),
('admin', 'createContent'),
('admin', 'createDatatype'),
('admin', 'createFeature'),
('admin', 'createFolder'),
('admin', 'createHubcategory'),
('admin', 'createHubphase'),
('admin', 'createHubresource'),
('admin', 'createKnowledgeHub'),
('admin', 'createPhotoGallery'),
('admin', 'deleteAttribute'),
('admin', 'deleteContent'),
('admin', 'deleteDatatype'),
('admin', 'deleteFeature'),
('admin', 'deleteFolder'),
('admin', 'deleteHubcategory'),
('admin', 'deleteHubphase'),
('admin', 'deleteHubresource'),
('admin', 'deleteKnowledgeHub'),
('admin', 'deletePhotoGallery'),
('admin', 'updateAttribute'),
('admin', 'updateContent'),
('admin', 'updateDatatype'),
('admin', 'updateFeature'),
('admin', 'updateFolder'),
('admin', 'updateHubcategory'),
('admin', 'updateHubphase'),
('admin', 'updateHubresource'),
('admin', 'updateKnowledgehub'),
('admin', 'updatePhotoGallery'),
('superAdmin', 'createAttribute'),
('superAdmin', 'createContent'),
('superAdmin', 'createDatatype'),
('superAdmin', 'createFeature'),
('superAdmin', 'createFile'),
('superAdmin', 'createFolder'),
('superAdmin', 'createHubcategory'),
('superAdmin', 'createHubphase'),
('superAdmin', 'createHubresource'),
('superAdmin', 'createKnowledgeHub'),
('superAdmin', 'createPhotoGallery'),
('superAdmin', 'deleteAttribute'),
('superAdmin', 'deleteContent'),
('superAdmin', 'deleteDatatype'),
('superAdmin', 'deleteFeature'),
('superAdmin', 'deleteFile'),
('superAdmin', 'deleteFolder'),
('superAdmin', 'deleteHubcategory'),
('superAdmin', 'deleteHubphase'),
('superAdmin', 'deleteHubresource'),
('superAdmin', 'deleteKnowledgeHub'),
('superAdmin', 'deletePhotoGallery'),
('superAdmin', 'downloadFile'),
('superAdmin', 'manageUsers'),
('superAdmin', 'updateAttribute'),
('superAdmin', 'updateContent'),
('superAdmin', 'updateDatatype'),
('superAdmin', 'updateFeature'),
('superAdmin', 'updateFolder'),
('superAdmin', 'updateHubcategory'),
('superAdmin', 'updateHubphase'),
('superAdmin', 'updateHubresource'),
('superAdmin', 'updateKnowledgehub'),
('superAdmin', 'updatePhotoGallery');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('manageOwnFolder', 0x4f3a32333a226261636b656e645c726261635c52756c65666f6c646572223a333a7b733a343a226e616d65223b733a31353a226d616e6167654f776e466f6c646572223b733a393a22637265617465644174223b693a313531343937383638343b733a393a22757064617465644174223b693a313531343937383638343b7d, 1514978684, 1514978684),
('updateOwnContent', 0x4f3a32343a226261636b656e645c726261635c52756c65636f6e74656e74223a333a7b733a343a226e616d65223b733a31363a227570646174654f776e436f6e74656e74223b733a393a22637265617465644174223b693a313531343937383539313b733a393a22757064617465644174223b693a313531343937383539313b7d, 1514978591, 1514978591);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1511886960),
('m130524_201442_init', 1513272115),
('m140209_132017_init', 1513276237),
('m140403_174025_create_account_table', 1513276239),
('m140504_113157_update_tables', 1513276243),
('m140504_130429_create_token_table', 1513276245),
('m140506_102106_rbac_init', 1513275369),
('m140830_171933_fix_ip_field', 1513276246),
('m140830_172703_change_account_table_name', 1513276246),
('m141222_110026_update_ip_field', 1513276248),
('m141222_135246_alter_username_length', 1513276248),
('m150614_103145_update_social_account_table', 1513276251),
('m150623_212711_fix_username_notnull', 1513276251),
('m151218_234654_add_timezone_to_profile', 1513276251),
('m160929_103127_add_last_login_at_to_user_table', 1513276252),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1513275369),
('m171215_105304_add_new_field_to_user', 1513335837);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`, `timezone`) VALUES
(1, 'PPEI Admin', 'admin@ppei.gov.ph', '', 'd41d8cd98f00b204e9800998ecf8427e', 'DILG-NAPOLCOM Center, EDSA Corner Avenue, West Triangle, Quezon City, Philippines', '', 'Government Institution', NULL),
(2, 'Jimmy Caldoza', 'jimzcal@gmail.com', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', 'Web developer', NULL),
(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `social_account`
--

CREATE TABLE `social_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblalbum`
--

CREATE TABLE `tblalbum` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `event_date` date NOT NULL,
  `posted_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblalbum`
--

INSERT INTO `tblalbum` (`id`, `name`, `event_date`, `posted_date`, `user_id`) VALUES
(1, 'Brgy. Taganito and Claver, Surigao del Norte Field Visit', '0000-00-00', '2017-12-27 11:05:01', 1),
(2, 'CBMS National Conference', '0000-00-00', '2017-12-27 11:06:19', 1),
(3, 'Dissemination Workshop', '0000-00-00', '2017-12-27 11:06:42', 1),
(4, 'Ilocos Norte Field Visit', '0000-00-00', '2017-12-27 11:06:42', 1),
(5, 'Institutional Visit of the Local Government Officials of Bhutan to the Philippines', '0000-00-00', '2017-12-27 11:06:42', 1),
(6, 'Knowledge Sharing and MOA Signing', '0000-00-00', '2017-12-27 11:06:42', 1),
(7, 'Knowledge Sharing and Planning Workshop', '0000-00-00', '2017-12-27 11:06:42', 1),
(8, 'MGB Workshop on Estimation of Volumes and Values of Mineral Products', '0000-00-00', '2017-12-27 11:06:42', 1),
(9, 'National RTD to Harmonize Local Government Code and Indigenous Peoples Rights Act 9-10', '0000-00-00', '2017-12-27 11:06:42', 1),
(10, 'NG-LG Joint Energy Forum Improving Access of Local Communities to Quality, Secured and Sustainable Energy', '0000-00-00', '2017-12-27 11:06:42', 1),
(11, 'Pilot Testing cum Validation Workshop of P-E Mainstreaming Modules and Monitoring Tools', '0000-00-00', '2017-12-27 11:06:42', 1),
(12, 'Stakeholder\'s Consultation and Technical Workshop', '0000-00-00', '2017-12-27 11:06:42', 1),
(13, 'Trainors-Users\' Training on Mining Taxes Information Management System and Mineral Statistics Management System', '0000-00-00', '2017-12-27 11:06:42', 1),
(14, 'Utilization and Development of Natural Wealth Forum', '0000-00-00', '2017-12-27 11:06:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblalbum_image`
--

CREATE TABLE `tblalbum_image` (
  `id` int(11) NOT NULL,
  `image_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `album_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblalbum_image`
--

INSERT INTO `tblalbum_image` (`id`, `image_name`, `album_id`) VALUES
(1, 'image-1.jpg', 1),
(2, 'image-2.jpg', 1),
(4, 'image-4.jpg', 1),
(5, 'image-5.jpg', 1),
(6, 'image-6.jpg', 1),
(7, 'image-7.jpg', 1),
(8, 'image-8.jpg', 1),
(9, 'image-9.jpg', 1),
(10, 'image-10.jpg', 1),
(11, 'image-11.jpg', 1),
(12, 'image-12.jpg', 1),
(13, 'image-13.jpg', 1),
(14, 'image-14.jpg', 1),
(15, 'image-15.jpg', 1),
(16, 'image-16.jpg', 1),
(17, 'image-17.jpg', 1),
(18, 'image-18.jpg', 1),
(19, 'image-19.jpg', 1),
(20, 'image-20.jpg', 1),
(21, 'image-21.jpg', 1),
(22, 'image-22.jpg', 1),
(23, 'image-23.jpg', 1),
(24, 'image-24.jpg', 1),
(25, 'image-25.jpg', 1),
(26, 'image-26.jpg', 1),
(27, 'image-27.jpg', 1),
(28, 'image-28.jpg', 1),
(29, 'image-29.jpg', 1),
(30, 'image-30.jpg', 1),
(31, 'image-31.jpg', 1),
(32, 'image-32.jpg', 1),
(33, 'image-33.jpg', 1),
(34, 'image-34.jpg', 1),
(35, 'image-35.jpg', 1),
(36, 'image-36.jpg', 1),
(37, 'image-1.jpg', 2),
(38, 'image-2.jpg', 2),
(39, 'image-3.jpg', 2),
(40, 'image-4.jpg', 2),
(41, 'image-5.jpg', 2),
(42, 'image-6.jpg', 2),
(43, 'image-7.jpg', 2),
(44, 'image-8.jpg', 2),
(45, 'image-9.jpg', 2),
(46, 'image-10.jpg', 2),
(47, 'image-11.jpg', 2),
(48, 'image-12.jpg', 2),
(49, 'image-13.jpg', 2),
(50, 'image-14.jpg', 2),
(51, 'image-15.jpg', 2),
(52, 'image-16.jpg', 2),
(53, 'image-1.jpg', 3),
(54, 'image-2.jpg', 3),
(55, 'image-3.jpg', 3),
(56, 'image-1.jpg', 4),
(57, 'image-2.jpg', 4),
(58, 'image-3.jpg', 4),
(59, 'image-4.jpg', 4),
(60, 'image-5.jpg', 4),
(61, 'image-6.jpg', 4),
(62, 'image-7.jpg', 4),
(63, 'image-8.jpg', 4),
(64, 'image-9.jpg', 4),
(65, 'image-10.jpg', 4),
(66, 'image-11.jpg', 4),
(67, 'image-12.jpg', 4),
(68, 'image-13.jpg', 4),
(69, 'image-14.jpg', 4),
(70, 'image-15.jpg', 4),
(71, 'image-16.jpg', 4),
(72, 'image-17.jpg', 4),
(73, 'image-1.jpg', 5),
(74, 'image-1.jpg', 6),
(75, 'image-1.jpg', 7),
(76, 'image-2.jpg', 7),
(77, 'image-3.jpg', 7),
(78, 'image-4.jpg', 7),
(79, 'image-5.jpg', 7),
(80, 'image-6.jpg', 7),
(81, 'image-7.jpg', 7),
(82, 'image-8.jpg', 7),
(83, 'image-9.jpg', 7),
(84, 'image-10.jpg', 7),
(85, 'image-11.jpg', 7),
(86, 'image-12.jpg', 7),
(87, 'image-13.jpg', 7),
(88, 'image-14.jpg', 7),
(89, 'image-15.jpg', 7),
(90, 'image-16.jpg', 7),
(91, 'image-17.jpg', 7),
(92, 'image-18.jpg', 7),
(93, 'image-19.jpg', 7),
(94, 'image-20.jpg', 7),
(95, 'image-21.jpg', 7),
(96, 'image-22.jpg', 7),
(97, 'image-23.jpg', 7),
(98, 'image-24.jpg', 7),
(99, 'image-25.jpg', 7),
(100, 'image-26.jpg', 7),
(101, 'image-27.jpg', 7),
(102, 'image-28.jpg', 7),
(103, 'image-29.jpg', 7),
(104, 'image-30.jpg', 7),
(105, 'image-31.jpg', 7),
(106, 'image-32.jpg', 7),
(107, 'image-33.jpg', 7),
(108, 'image-34.jpg', 7),
(109, 'image-35.jpg', 7),
(110, 'image-36.jpg', 7),
(111, 'image-1.jpg', 8),
(112, 'image-2.jpg', 8),
(113, 'image-1.jpg', 9),
(114, 'image-2.jpg', 9),
(115, 'image-3.jpg', 9),
(116, 'image-4.jpg', 9),
(117, 'image-5.jpg', 9),
(118, 'image-6.jpg', 9),
(119, 'image-1.jpg', 10),
(120, 'image-2.jpg', 10),
(121, 'image-3.jpg', 10),
(122, 'image-4.jpg', 10),
(123, 'image-5.jpg', 10),
(124, 'image-6.jpg', 10),
(125, 'image-7.jpg', 10),
(126, 'image-8.jpg', 10),
(127, 'image-9.jpg', 10),
(128, 'image-10.jpg', 10),
(129, 'image-11.jpg', 10),
(130, 'image-12.jpg', 10),
(131, 'image-13.jpg', 10),
(132, 'image-14.jpg', 10),
(133, 'image-15.jpg', 10),
(134, 'image-16.jpg', 10),
(135, 'image-17.jpg', 10),
(136, 'image-18.jpg', 10),
(137, 'image-19.jpg', 10),
(138, 'image-20.jpg', 10),
(139, 'image-21.jpg', 10),
(140, 'image-22.jpg', 10),
(141, 'image-23.jpg', 10),
(142, 'image-24.jpg', 10),
(143, 'image-25.jpg', 10),
(144, 'image-26.jpg', 10),
(145, 'image-27.jpg', 10),
(146, 'image-28.jpg', 10),
(147, 'image-29.jpg', 10),
(148, 'image-30.jpg', 10),
(149, 'image-31.jpg', 10),
(150, 'image-32.jpg', 10),
(151, 'image-33.jpg', 10),
(152, 'image-34.jpg', 10),
(153, 'image-35.jpg', 10),
(154, 'image-36.jpg', 10),
(155, 'image-37.jpg', 10),
(156, 'image-38.jpg', 10),
(157, 'image-39.jpg', 10),
(158, 'image-40.jpg', 10),
(159, 'image-1.jpg', 11),
(160, 'image-2.jpg', 11),
(161, 'image-3.jpg', 11),
(162, 'image-4.jpg', 11),
(163, 'image-5.jpg', 11),
(164, 'image-6.jpg', 11),
(165, 'image-7.jpg', 11),
(166, 'image-8.jpg', 11),
(167, 'image-9.jpg', 11),
(168, 'image-10.jpg', 11),
(169, 'image-11.jpg', 11),
(170, 'image-12.jpg', 11),
(171, 'image-13.jpg', 11),
(172, 'image-14.jpg', 11),
(173, 'image-15.jpg', 11),
(174, 'image-16.jpg', 11),
(175, 'image-1.jpg', 12),
(176, 'image-1.jpg', 13),
(177, 'image-2.jpg', 13),
(178, 'image-3.jpg', 13),
(179, 'image-4.jpg', 13),
(180, 'image-5.jpg', 13),
(181, 'image-6.jpg', 13),
(182, 'image-7.jpg', 13),
(183, 'image-8.jpg', 13),
(184, 'image-9.jpg', 13),
(185, 'image-10.jpg', 13),
(186, 'image-11.jpg', 13),
(187, 'image-12.jpg', 13),
(188, 'image-13.jpg', 13),
(189, 'image-14.jpg', 13),
(190, 'image-15.jpg', 13),
(191, 'image-16.jpg', 13),
(192, 'image-1.jpg', 14),
(193, 'image-2.jpg', 14),
(194, 'image-3.jpg', 14),
(195, 'image-4.jpg', 14),
(196, 'image-5.jpg', 14),
(197, 'image-6.jpg', 14),
(219, '2014-07-16-5-ways-daydreaming-enhances-memory-and-boosts-creativity-ideas.jpg', 2),
(220, '2014-07-16-5-ways-daydreaming-enhances-memory-and-boosts-creativity-memory.jpg', 2),
(228, '4.jpg', 8),
(232, '2014-07-16-5-ways-daydreaming-enhances-memory-and-boosts-creativity-discovery.jpg', 2),
(233, '2014-07-16-5-ways-daydreaming-enhances-memory-and-boosts-creativity-empathy.jpg', 2),
(234, '2014-07-16-5-ways-daydreaming-enhances-memory-and-boosts-creativity-mood.jpg', 2),
(324, '2014-07-16-5-ways-daydreaming-enhances-memory-and-boosts-creativity-mood.jpg', 1),
(325, '2017-02-09-10-40-31-1539667503.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblattribute`
--

CREATE TABLE `tblattribute` (
  `id` int(11) NOT NULL,
  `attribute` varchar(100) NOT NULL,
  `data_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblattribute`
--

INSERT INTO `tblattribute` (`id`, `attribute`, `data_type`) VALUES
(1, 'title', 'string'),
(2, 'contents', 'text'),
(3, 'date', 'date'),
(4, 'images', 'image'),
(5, 'files', 'file'),
(6, 'status', 'string'),
(7, 'user', 'string'),
(8, 'url', 'string'),
(9, 'date_start', 'date'),
(10, 'date_end', 'date');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontent`
--

CREATE TABLE `tblcontent` (
  `id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `attribute` varchar(200) NOT NULL,
  `value` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblcontent`
--

INSERT INTO `tblcontent` (`id`, `feature_id`, `group_id`, `attribute`, `value`) VALUES
(1, 25, 1, 'title', 'Interfacing Indigenous Peoples\' ADSDPP to local development and land use plans for poverty reduction and environmental sustainability'),
(2, 25, 1, 'contents', 'On 9-10 October 2013, the Philippines Poverty-Environment Initiative (PPEI), along with the Department of the Interior and Local Government (DILG) and the National Anti-Poverty Commission (NAPC) organized “National Roundtable Discussion (RTD) to Harmonize Local Government Code of 1991 (LGC) and Indigenous Peoples Rights Act (IPRA)”.\r\n\r\nThe said agencies converged to open possible avenues to address issues and concerns regarding the lack of representation and participation of Indigenous Peoples (IPs) in the political decision making process; conflicting provisions of the laws which prevent the implementation of the Ancestral Domain Sustainable Development and Protection Plan (ADSDPP), and lack of integration of ADSDPP in the formulation of the Comprehensive Land Use Plans (CLUP) and the Comprehensive Development Plans (CDP) of LGUs, among others.\r\n\r\nResults of the National RTD are inputs to the draft Joint Memorandum Circular among DILG, NAPC and National Commission on Indigenous Peoples (NCIP) that will primarily harmonize the conflicting provisions of LGC and IPRA, to integrate the mandate of the local governments and the protection of the rights of the IPs in the sustainable utilization of natural resources and environmental management. \r\n\r\n“Hopefully, this project will lead to more initiatives towards the end of harmonizing important state policies and programs and lead to better governance,” Prof. Edmund Tayao of Local Government Development Foundation said.\r\n\r\nThe National RTD was participated in by representatives from DILG, NAPC, IP Sectoral Council, selected local government units, LGU leagues, selected NGOs and development partners.\r\n'),
(3, 25, 1, 'date', '2013-10-14'),
(4, 25, 1, 'images', 'uploads/images/events/image-6603.jpg'),
(5, 25, 1, 'status', 'Active'),
(6, 25, 1, 'user', '1'),
(15, 25, 4, 'title', 'Improving access of local communities to quality, secured and sustainable energy in the Philippines'),
(16, 25, 4, 'contents', '“LGUs have an overriding role in approving the construction of power plants and energy facilities, as well as facilitating energy investments” said Philippines Energy Secretary Carlos Jericho L. Petilla.\r\n  \r\n The Forum highlighted current state, gaps and opportunities of the energy sector in the Philippines. The benefits to host communities of energy projects, managing downstream industry, improving financing access of LGUs to energy projects and how to promote renewable energy were among the topics deeply discussed.\r\n\r\nOther officials from the DOE also discussed several initiatives, statutes and laws relative to the energy sector such as the Energy Regulation 1-94 otherwise known as the Benefits for Host Communities, and several components of the Renewable Energy Act of 2008 and Oil Deregulation Law of 1998 concerning the LGUs.\r\n\r\nCatalyzing energy investment\r\n\r\nBank of the Philippine Island’s Executive Vice President Alfonso L. Salcedo, Jr. discussed a range of financing options appropriate to fund different types of energy projects and described the major challenges in LGU financing. He pointed out that there are various organizations, programs and facilities that are currently in place to finance energy projects and increase LGU access to financing. The facilities blend public and private finance, loan guarantee mechanism and energy service company financing scheme. Further, he emphasized that LGUs should take a more active role to drive energy efficiency projects. In order to make energy projects bankable, LGUs must ensure project viability (fulfils social and economic needs of the community; good revenue streams); partner with reliable stakeholders; be open to outsourcing and management of the project, and ensure completeness of the regulatory requirements.\r\n\r\nAnother financing option available for LGUs is through a Joint Venture Public-Private Partnerships (PPP). Atty. Sherry Ann Austria of the Philippines PPP Center mentioned that “PPP is one of the key strategies identified by the Aquino administration to fast track infrastructure development and achieve inclusive growth. The Program taps the private sector to help supplement limited public sector capacities in delivering critical infrastructure and development services and facilities”.\r\n\r\nVice President Michael B.C. Hosillos of SN Aboitiz Power Group (SNAP) also shared to the participants how to create a shared value in energy investments. He emphasized that the pillars of private companies’ Corporate Social Responsibility (CSR), as practiced by SNAP, should be its community, environment, market and employees.\r\n\r\nAccelerating green industries in local communities\r\n\r\nWith the Philippines endowed with tremendous renewable energy resources; jobs, wealth and cost-saving renewable energy can bring to the country.\r\n\r\nMr. Jasper Inventor of the Greenpeace Philippines talked about how renewable energy can save money and generate jobs.\r\n##Generate tens of thousands of jobs (For a 10-MW solar power plant, around 1,000 people are hired during construction for 6 months and 100 people are hired full time; For wind, a 33-MW facility created 21 direct jobs, two thirds of which are on site; A representative 8-MW run of river hydro plant employs around 1,000 people during construction; One geothermal company hired around 2,582 employees with an installed capacity of 1,189 MW plant; and Seven proposed biomass projects could generate roughly 78,000 jobs to construct power plants, 3,400-4,000 jobs for plant operation, 7,000 in the feedstock supply chain, and additional employment for the farmers producing agricultural wastes);\r\n##Save the government money in terms of tax revenue and foreign exchange savings;\r\n##Boost economic growth especially in vulnerable areas suffering from energy poverty;\r\n##Lower the cost of renewable energy for the long run by impacting the spot market, and\r\n##Save customers’ money.\r\n\r\nLocal governments as drivers of achieving sustainable energy\r\n\r\nThe Forum also allowed pioneering LGUs to share their experience using energy revenues and resources to reduce poverty and to protect the environment.\r\n  \r\n “The local governments play a more important and critical role on the effective and efficient exploration, development and utilization of the energy resources while protecting the environment within their territorial boundaries. They are empowered by law (Local Government Code of 1991) to take innovative decisions for this purpose” said Regional Director Evelyn A. Trompeta of the Department of Interior and Local Government.\r\n'),
(17, 25, 4, 'date', '2013-9-6'),
(18, 25, 4, 'images', 'uploads/images/events/image-6648.jpg'),
(19, 25, 4, 'status', 'Active'),
(20, 25, 4, 'user', '1'),
(21, 35, 5, 'title', 'Launching of the new PPEI Website '),
(22, 35, 5, 'contents', 'The new developed Philippine Poverty-Environment Initiative Website is set expected to launch on the internet in January 2018.'),
(23, 35, 5, 'date', '2018-1-4'),
(24, 35, 5, 'status', 'Active'),
(25, 35, 5, 'user', '1'),
(26, 35, 5, 'date_start', '2018-1-10'),
(27, 35, 5, 'date_end', '2018-1-10'),
(35, 35, 7, 'title', 'Final checking of PPEI website'),
(36, 35, 7, 'contents', 'The final checking of the newly developed PPEI Website will undergo a comprehensive testing soon.'),
(37, 35, 7, 'date', '2018-1-4'),
(38, 35, 7, 'status', 'Active'),
(39, 35, 7, 'user', '1'),
(40, 35, 7, 'date_start', '2018-1-7'),
(41, 35, 7, 'date_end', '2018-1-7'),
(42, 26, 8, 'contents', '<p><span style=\"font-size:26px\"><strong>Who We Are:</strong></span></p>\r\n\r\n<p><span style=\"font-size:22px\"><strong>About the Poverty-Environment Initiative in the Philippines</strong></span></p>\r\n\r\n<p>Poverty and environmental integrity are closely linked. Poor people that depend on natural resources for their livelihood would have limited opportunities if their resources are degraded. A degraded environment lowers productivity and income, thus, rendering the poor to be poorer. The deterioration of the productive capacity of natural resources is perceived as a risk that can affect poverty alleviation initiatives.</p>\r\n\r\n<p>The Philippine Poverty-Environment Initiative (PPEI) supports the government, civil society and the business sector to utilize revenues and benefits from sustainable ENR management for poverty reduction and environmental protection. It aims at demonstrating that, if managed properly and sustainably, natural resources can propel the country to a path of an inclusive and sustainable development.</p>\r\n\r\n<p>The PPEI operates at national and local levels, providing a better enabling environment for national and local government to ensure that ENR revenues are equitably shared by the communities and re-invested to preserve social and natural capital. It seeks to influence institutions, policies and investments to harness the potential of the country&rsquo;s natural resources to achieve a greener and more inclusive development path.</p>\r\n\r\n<h3>Expected Results:</h3>\r\n\r\n<p>PPEI is critically designed to deliver Outcome 2 of United Nations Development Assistance Framework (UNDAF) which states that &ldquo;<em>More men and women will have decent and productive employment for sustainable, inclusive and greener growth</em>&rdquo;. It also helps to achieve Millennium Development Goals 1 (Eradicate extreme poverty and hunger) and 7 (Ensure environmental sustainability).</p>\r\n\r\n<p>By 2015, the following are the expected results of the project:</p>\r\n\r\n<ol>\r\n	<li>Strengthened capacities of local communities including LGUs to access and manage assets and revenues from ENR for local economic development;</li>\r\n	<li>Increased budget allocation and level of spending for poverty-environment measures in lead agencies, sectoral departments and LGUs;</li>\r\n	<li>Improved capacity of LGUs to integrate pro-poor and environmental concerns into the design and implementation of local development plans and programs;</li>\r\n	<li>More efficient processes on the distribution of National Wealth (NW) between national government and LGUs through policy reforms and systems improvement;</li>\r\n	<li>Full public disclosure of ENR revenues collection and payment, and its utilization by LGUs;</li>\r\n	<li>Increased number of people gaining employment and/or venturing into productive enterprises from sustainable management of ENR, especially from resource extraction activities such as mining, oil and gas, geothermal, etc., and</li>\r\n	<li>More LGUs adopted green growth strategy through shift into renewable energy (RE) sources and clean development mechanisms (all LGUs with RE resources map and energy plans integrated in their Comprehensive Development Plan (CDP), and improved access of local communities to RE resources).</li>\r\n</ol>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3><strong>Rational Environment and Natural Resource Extraction and Utilization</strong></h3>\r\n\r\n<p>Some of the strongest links between poverty and environment are the industries extracting the natural wealth, such as mining, oil and gas, geothermal and hydropower plants. Extractive industries in the country refer to five investment areas: (1) mineral mining, (2) forest and secondary forest products, (3) energy resources, (4) water resources, and (5) coastal and marine resources.</p>\r\n\r\n<p>To optimize the contribution of natural resources to local economic development and greener growth, an extractive industry economics must alleviate poverty by gravitating people into the enterprise with jobs, downstream economic activities, and provision of social services from the proceeds:. Natural resource revenues and benefits may be earmarked for rehabilitation of degraded ecosystem and to increase efficiencies of social services. Some of the revenues maybe used to catalyze green investments thereby generating green jobs for the general population of the community.</p>\r\n\r\n<ul>\r\n	<li>Resource extraction must be a positive economic enterprise bringing out natural wealth for use by the population in general, including the investor.</li>\r\n	<li>Extractive industries pay taxes, fees, and royalties to government. These are technically known as revenues from national wealth and are procedurally defined by laws and implementing policies. On special cases when an indigenous community is engaged because the resource is within their ancestral domain, the payment arrangement is specific.</li>\r\n	<li>Apart from the payments made by the industry, it is obliged to allocate part of their proceeds for social responsibility projects in the community where the resource is extracted. The industry is expected to generate jobs and propel community-level economic enterprises through the influx of hired people and their families engaging into productive undertaking. This magnetizing ability of an extractive industry could address poverty for as long as directed community preparation is equally established.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n'),
(79, 30, 15, 'title', 'Department of Environment and Natural Resources'),
(80, 30, 15, 'images', 'uploads/images/partners/image-0.36690300 1514460310.png'),
(81, 30, 15, 'url', 'www.denr.gov.ph'),
(82, 36, 17, 'title', 'Happy New Year!!'),
(83, 30, 18, 'title', 'Community-Based Management System'),
(84, 30, 18, 'images', 'uploads/images/partners/image-9893.jpg'),
(85, 30, 18, 'url', 'www.napc.gov.ph'),
(86, 30, 19, 'title', 'Chamber of Mines of the Philippiens'),
(87, 30, 19, 'images', 'uploads/images/partners/image-3494.jpg'),
(88, 30, 19, 'url', 'www.chamberofmines.com.ph'),
(89, 30, 20, 'title', 'Department of Budget and Management'),
(90, 30, 20, 'images', 'uploads/images/partners/image-59.jpg'),
(91, 30, 20, 'url', 'www.dbm.gov.ph'),
(92, 30, 21, 'title', 'Department of Energy'),
(93, 30, 21, 'images', 'uploads/images/partners/image-9651.jpg'),
(94, 30, 21, 'url', 'www.doe.gov.ph'),
(95, 30, 22, 'title', 'Department of Finance'),
(96, 30, 22, 'images', 'uploads/images/partners/image-976.jpg'),
(97, 30, 22, 'url', 'www.dof.gov.ph'),
(98, 30, 23, 'title', 'League of Cities of the Philippines'),
(99, 30, 23, 'images', 'uploads/images/partners/image-3547.jpg'),
(100, 30, 23, 'url', 'www.lcp.org.ph'),
(101, 30, 24, 'title', 'League of Municipalities of the Philippines'),
(102, 30, 24, 'images', 'uploads/images/partners/image-1059.jpg'),
(103, 30, 24, 'url', 'www.lmp.org.ph'),
(104, 30, 25, 'title', 'League of Provinces of the Philippines'),
(105, 30, 25, 'images', 'uploads/images/partners/image-5197.jpg'),
(106, 30, 25, 'url', 'www.lpp.gov.ph'),
(107, 30, 26, 'title', 'Mines and Geosciences Bureau'),
(108, 30, 26, 'images', 'uploads/images/partners/image-1620.png'),
(109, 30, 26, 'url', 'www.mgb.gov.ph'),
(110, 30, 27, 'title', 'National Anti-Poverty Commission'),
(111, 30, 27, 'images', 'uploads/images/partners/image-6941.jpg'),
(112, 30, 27, 'url', 'www.napc.gov.ph'),
(113, 30, 28, 'title', 'National Commission on Indigeneous People'),
(114, 30, 28, 'images', 'uploads/images/partners/image-3779.png'),
(115, 30, 28, 'url', 'www.ncip.gov.ph'),
(116, 30, 29, 'title', 'National Economic and Development Authority'),
(117, 30, 29, 'images', 'uploads/images/partners/image-2270.png'),
(118, 30, 29, 'url', 'www.neda.gov.ph'),
(119, 30, 30, 'title', 'Philippine Business for Social Progress'),
(120, 30, 30, 'images', 'uploads/images/partners/image-9900.jpg'),
(121, 30, 30, 'url', 'www.pbsp.org.ph'),
(122, 30, 31, 'title', 'Union of Local Authorities of the Philippines'),
(123, 30, 31, 'images', 'uploads/images/partners/image-2163.jpg'),
(124, 30, 31, 'url', 'www.ulap.net.ph'),
(125, 25, 32, 'title', 'Mainstreaming poverty-environment linkages in local governance for sustainable development'),
(126, 25, 32, 'contents', 'The Department of the Interior and Local Government (DILG) has partnered with the global Poverty-Environment Initiative (PEI) of the United Nations to set up institutional and capacity strengthening programs and has carried out activities to address the particular poverty-environment context. The Philippines PEI aims to promote the poverty-environment (P-E) linkage in local governance through rational utilization of natural resources, environmental protection, social equity measures, and poverty alleviation actions.\r\n\r\nOperationally, the integration of P-E linkages into plans and eventually into development programs, projects and activities, shall pave opportunities for growth, especially for LGUs which rely on natural resources for livelihood and subsistence. However, it is complex to link poverty and environment, even more challenging is when made as the entry point for achieving sustainable development. There seems to be always trade-offs between economic growth and environmental improvement. Fast economic growth could contribute to the reduction of poverty, however, at the cost of environmental degradation, such as the depletion of natural resources, atmospheric pollution, the depletion of biodiversity, the pollution of aquatic and marine ecosystems and the increasing production of wastes.\r\n\r\nWhile trade-offs cannot be avoided, P-E mainstreaming aims at achieving the best balance between environmental protection and poverty reduction for the benefit of the poor and the environment.\r\n\r\nThe reviews and case studies conducted by PPEI in 2012 disclosed that the main entry point for mainstreaming P-E linkages is through the planning and budgeting processes. The Comprehensive Development Plan (CDP) of LGUs provides the scope to attain a dynamic system of addressing poverty and environmental protection. Particularly, the Rationalized Planning System (RPS) suggests schemes for development efforts to progress coherently instead of a fragmented, although continuing approach.\r\n\r\nTherefore, capacitation is needed for the LGUs to proactively evolve their local plans such as the CDP, Comprehensive Land-Use Plan (CLUP), Local Development Investment Program (LDIP) and Annual Investment Program (AIP), especially if the type of development in the locales is resource extractive. The current challenges and stresses that the communities are facing call for urgent action, even while these are positively viewed as economic opportunities.\r\n\r\nThe “Pilot Testing cum Validation Workshop of the Training Modules on Mainstreaming P-E Linkages in Local Planning and Monitoring and Evaluation Tools for P-E Mainstreaming” facilitates a credible launch for a capacity development process in P-E mainstreaming, and enable the development of capacity building interventions for the LGUs in the design of P-E responsive policies, projects and programs for a green and inclusive development. The roll-out of the capacity development program will be conducted in October 2013.\r\n\r\nA total of forty (40) participants composed of Sanggunian Member, Budget, Planning, Accounting and Environment and Natural Resource Officers of LGUs of the Province of Rizal, City of Antipolo, Municipalities of Angono, Baras, Teresa and Rodriguez; and Province of Bulacan, City of San Jose Del Monte and Municipalities of Norzagaray and San Ildefonso joined the DILG Central and Regional Officers in the workshop.\r\n'),
(127, 25, 32, 'date', '2013-8-27'),
(128, 25, 32, 'images', 'uploads/images/events/image-68531.png'),
(129, 25, 32, 'status', 'Active'),
(130, 25, 32, 'user', '1'),
(131, 25, 36, 'title', 'Completion of the systems review of the budgeting and release process of ENR revenues from national level down to LGUs'),
(132, 25, 36, 'contents', 'Some of the strongest links between poverty and environment are the industries extracting the natural resources, such as mining, oil and gas, geothermal and hydropower plants. Although natural resources in the Philippines have been identified nationally as an important growth driver and the country is 5th most mineral-rich in the world, this sector has yet to contribute significantly to economic growth and human development.\r\n\r\nThe Local Government Code of 1991 or the Republic Act 7160 mandates that 40% of the revenues from the National Wealth belong to local government units (LGUs). However, the release of the LGUs’ share from the national government is often delayed and/or not the full amount due to the LGU. This deprives the LGUs with much needed funds for local development.\r\n\r\nThe problems on timing and the uncertainty regarding the amounts to be received adversely affected the delivery of services especially with respect to projects alleviating poverty. Even though the national and local governments are well aware of the requirements and processes in laws and policies attendant to the collection, distribution and utilization of shares from national wealth, the problem is on the full implementation of some provisions of the policies. The clamor of the LGU is clear, to respect their rightful share, with timely and well-informed amounts of fund transfer so that these can be incorporated into their annual budgets and investment plans, and effectively implement development projects.\r\n\r\nThe Philippines Poverty-Environment Initiative (PPEI) led the conduct of a systems review of the entire budgeting and release process from the national level down to the local levels of government. The entire process of estimating government revenues from natural resources to actual receipt of the funds to disbursement and recording to public dissemination of relevant financial statements was analyzed.\r\n\r\nThe main objective of this study is to recommend and encourage reforms in the policy environment for the sharing of revenues from natural resources between the national government (NG) and LGUs and for their utilization to focus on poverty alleviation and environmental protection programs. This involves proposals to amend laws, modify operational policies, and improve regulatory aspects and governance processes of the NG and LGUs to identify pragmatic solutions to the problems of downloading delays and uncertain amounts. This also involves the development of information systems that will facilitate the timely and transparent release of the revenues from ENR to the host LGUs.\r\n\r\nThe following reports and activities were accomplished under this Study. The first four outputs can be classified under Systems Development. The next three outputs are geared towards Effecting Policy Reforms while the last two outputs can be used to advocate for legislative actions.  \r\n\r\nSystems Development\r\n1.Documentation of Implementation of DBM-DOF-DENR-DILG Joint Circulars 2009-1 and 2010-1\r\n2.Proposed Revisions to Joint Circulars 2009-1 and 2010-1 and Strategies to Implement New Circulars including Designation of One Agency to Oversee Implementation\r\n3.Proposed Framework to Further Speed Up Release of LGU Shares in the proceeds from  National Wealth (NW) and Lobbying/Advocacy Strategies\r\n4.Proposed Improvements in the Electronic Statement of Receipts and Expenditures  (eSREs) of LGUs\r\n\r\nEffecting Policy Reforms\r\n5.Assessment of Possible Linkages of PPEI to the Wealth Accounting and Valuation of Ecosystem Services (WAVES) Project and Strategies for their Convergence\r\n6.Linkages of PPEI to the Agenda of the Philippine Council for Sustainable Development (PCSD) and the Mining Industry Coordinating Council (MICC)\r\n7.Review of Laws and Policy Issuances on Small-Scale Mining to improve collection of taxes from small-scale miners\r\n\r\nAdvocating for Legislative Actions\r\n8.Proposed Amendments to the Local Government Code of 1991\r\n9.Proposed Amendments to the Electric Power Industry Reform Act (EPIRA) and Renewable Energy (RE) Act to increase the share of LGUs in the proceeds from NW\r\n\r\nWith the said proposed reforms, local governments and communities would enjoy the full benefits from the utilization and extraction of natural resources for an inclusive, sustained and broad-based local economic development.\r\n'),
(133, 25, 36, 'date', '2018-01-05'),
(134, 25, 36, 'images', 'uploads/images/events/image-28414.jpg'),
(135, 25, 36, 'status', 'Active'),
(136, 25, 36, 'user', '1'),
(137, 25, 37, 'title', 'MTIMS: Promoting transparency in mining revenues and tax collections'),
(138, 25, 37, 'contents', 'The Mineral Economics, Information and Publications Division (MEIPD) of the Mines and Geosciences Bureau (MGB) introduced the Mining Tax Information Management System (MTIMS) to all revenue collectors at the MGB Regional Offices during a three-day Trainor’s/User\'s Training held recently.  \r\n\r\nThe MTIMS is an internet-based system designed to computerize the entire process of data collection, processing, maintenance and report generation in order to ensure an effective monitoring system on the collection of mining taxes, fees and charges.\r\n\r\nFunded by the United Nations Development Programme thru the Philippines Poverty-Environment Initiative (PPEI) Project led by the Department of the Interior and Local Government, the MTIMS was conceptualized because of the need to generate reliable information on mining revenues that will serve as basis in policy formulation and other information needs of government.  \r\n\r\nThe MTIMS has three components, which constitute government revenues from mining, namely: 1) national taxes, including excise and royalties on mineral reservations; 2) local taxes; and 3) fees and charges from services rendered to the public.\r\n\r\nUnder the system, the MGB Central Office (CO) will take charge of the first two components while the last will be handled by regional revenue collectors.  The result of the workshop will be useful in debugging the system, which is targeted to be finalized by end of August.  Once fully operational, the information that will be generated will be accessible to the public thru the MGB website mgb.gov.ph.\r\n\r\nDuring the workshop, a total of 30 regional participants composed of Accountants, Cashiers, Administrative and Planning Officers, and Economists joined the MEIPD staff of the MGB CO in the actual testing of the system.  - By Mineral Economics, Information and Publication Division. Also posted at www.mgb.gov.ph\r\n\r\nThe Philippines Poverty-Environment Initiative (PPEI) helps establishing transparency and accounting systems in place to publicly disclose the revenues and benefits generated from the development and extraction of environment and mineral resources, and their utilization for poverty reduction and environmental protection . The PPEI also supports the national government towards the implementation of Extractive Industries Transparency Initiative (EITI).\r\n'),
(139, 25, 37, 'date', '2013-8-26'),
(140, 25, 37, 'images', 'uploads/images/events/image-1972.png'),
(141, 25, 37, 'status', 'Active'),
(142, 25, 37, 'user', '1'),
(143, 25, 41, 'title', 'LGUs\' advancing good governance for greener, inclusive growth - Forum on the utilization and development of natural wealth'),
(144, 25, 41, 'contents', 'The Department of the Interior and Local Government (DILG) through the Philippines Poverty-Environment Initiative (PPEI) project in partnership with the Union of Local Authorities of the Philippines (ULAP) and LGU Leagues convened all local government units where extractive industries are present.\r\n\r\nThis “Forum on the utilization and development of natural wealth” aims to bring together LGUs and discuss and draw out a unified policy position on mining issues such as: timeliness of the release of LGU share from the natural wealth revenues; transparency in the processes and procedures of accounting and releasing of LGU shares; consistencies between national laws and local ordinances/policies, among others.  \r\n\r\nThe Forum also serves as a venue to update the LGUs with the current reforms in the mining industry that the national government is undertaking; to generate the common positions of LGUs with regards to mining-related issues that the ULAP as a permanent representative of LGUs to the Mining Industry Coordinating Council (MICC) can carry, and to discuss the proposed establishment of network of LGUs hosting extractive industries.\r\n\r\nPPEI also facilitates the creation of network of LGUs hosting extractive industries. The network aims to: serve as a forum where all mining issues from the perspective of LGUs can be raised, discussed and addressed; serve as an advisory group in the development and formulation of LGUs’ position on mining-related issues:  harmonization of the provisions of various mining laws, environmental protection, transparency and accountability in the receipt as well as utilization of mining revenues; and serve as a “quick consensus-gathering mechanism” in cases where an LGU position in the MICC needs to be formed and submitted to the MICC.\r\n\r\nThis was participated in by local chief executives (LCEs) and other LGU officials of 12 provinces, 26 municipalities and 5 cities hosting mining activities.\r\n'),
(145, 25, 41, 'date', '2013-8-23'),
(146, 25, 41, 'images', 'uploads/images/events/image-41797.jpg'),
(147, 25, 41, 'status', 'Active'),
(148, 25, 41, 'user', '1'),
(149, 29, 42, 'title', 'Responsible resource and asset management for sustainable and inclusive development: The Surigao del Norte experience'),
(150, 29, 42, 'contents', 'GOV. SOL MATUGAS OF SURIGAO DEL NORTE EMPHASIZED THE NEED FOR AN ENHANCED IMPLEMENTATION OF LOCAL DEVELOPMENT POLICIES AND PROGRAMS THAT COMBINE ENVIRONMENT SUSTAINABILITY AND POVERTY REDUCTION EFFORTS TOWARDS SUSTAINABLE DEVELOPMENT DURING THE PPEI KNOWLEDGE SHARING AND PLANNING WORKSHOP HELD ON 10 DEC. 2013 AT THE CROWNE PLAZA, ORTIGAS, QUEZON CITY.\r\n\r\n \r\n\r\nSurigao del Norte is the gateway to Mindanao. This second class province is made up of 20 municipalities, 1 city and 335 barangays. It is gifted with abundant natural resources as manifested in its major growth drivers consisting of agri-aquaculture, responsible mining and eco-tourism.\r\n\r\nResponsible Mining is a major industry and an economic growth driver. The province has huge mineral deposits, one of the largest in the Philippines. Mineral reserves register a total of 37,963.40 hectares. At present, there are eight mining companies which are operating and which produce nickel, nickel silicate ore and limestone. Other mineral products include gold, silver, chromite and ceramics. \r\n\r\nCARAGA Region, with Surigao del Norte, is growing faster than the rest of the country in 2012 with an average Gross Regional Domestic Product growth of 9.5%. Business and investments in the province grew rapidly in the last three (3) years with mining and tourism as major economic drivers.\r\n\r\nThe province is also out of the poverty map. Figures from the National Statistics Coordinating Board revealed that from 47.9% in 2009, the province has gone down to 32% in 2013, still below the national average but targeting to further reduce it in the next three years. \r\n\r\n \r\nDEVELOPMENT AGENDA:\r\nH.E.A.L.S. Agenda - Health, Education and Environment, Agriculture and Aquaculture, Livelihood and Tourism and Social Welfare and Spiritual Renewal programs\r\n\r\nF.R.E.S.H. Principles of Governance - Principle of Focus, Responsibility, Efficiency and Effectiveness, Shared Vision and Holistic Development\r\n\r\nFISCAL RESOURCE MANAGEMENT:\r\n Giving attention on strengthening financial management where resource allocation and utilization provided maximum benefits derived from limited resources, through:\r\n •    Implementation of the Electronic Tax Revenue Assessment and Collection System (E-TRACS) in the municipalities. \r\n •    Close monitoring of royalty and excise tax payments of mining companies\r\n •    Implementation of the counter-parting scheme between and among Municipal and Barangay LGUs and the Provincial Government \r\n •    Adherence to the 10% reserve on MOOE as safety nets for possible unrealized income estimates.\r\n •    Strict adherence to RA 9184 or the Procurement of Goods and Services.\r\n •    Establishing constant linkages with national and regional officials and strong collaboration \r\n •    Improved marketing and promotions schemes of economic enterprises.\r\n\r\nAs a result, there was a significant increase in General Fund (comprising of Internal Revenue Allotment, National Wealth share and the local tax and non-tax revenues and other external sources), Real Property Taxes, Special Education Fund collection, and Share from National Wealth which facilitated good resource allocation and utilization.\r\n\r\nGAINS ACHIEVED:\r\nImproved Health Program\r\n •    Establishment of the 50-bed state-of-the-art Surigao del Norte Community Hospital is nearing completion with a P187M grant from the Department of Health. Other hospitals, rural health units and birthing clinics were also improved including the Siargao District Hospital.\r\n •    The Grassroots medical outreach program  has served some 75,000 patients from all of the 20 municipalities of the province, including  city barangays. \r\n •    Decline of the Protein Energy Malnutrition (PEM) in the province from 22.7% in 2007 to 14.2% in 2011\r\n\r\nImproved Education Program\r\n •    Built new school buildings, classrooms, established  library hubs and speech laboratories\r\n •    Employed additional local school board teachers and increased their honoraria\r\n •    Expanded the scholarship program\r\n •    Increased Participation Rate in both elementary and highschool\r\n\r\nGood balance between the sustainable management of ENR and the optimal utilization of its resources\r\n •    Strengthened enforcement of environmental laws through the deployment of  Environmental Enforcers to monitor and apprehend illegal activities\r\n •    Local chief executives have played an active role in the implementation of the Shared Management of Quarry Resources which empowered them in managing resources in their respective areas of jurisdiction\r\n •    Task Force Kinaiyahan was organized and the Provincial Mineral Regulatory Board was also activated  to ensure strict adherence to environmental policies\r\n •    Kalimpyo Kahapsay Surigao Program was implemented as a solid waste management advocacy program of the province\r\n •    Agriculture and Aquaculture Programs were strengthened through trainings and technology transfer that generally improved the economic well-being of farmers and fishermen\r\n •    Implementation of private-public-partnership with the mining companies which aims to provide livelihood, vocational and technical trainings to out-of-school youths and unemployed adults.  \r\n\r\nTHE WAY FORWARD:\r\nBarangay Empowerment - rise of barangay power as each barangay captain will be challenged to initiate barangay projects. Building a New Surigao, is building a strong and resilient Barangayanon. The pillars of progress are the leaders of barangays – where change and transformation begin.  \r\n •    Kapitolyo Sa Barangay Program, with focus on barangay-based program implementation on disaster preparedness, hazard mapping, solid waste management, and\r\n •    Barangay development planning will be strictly required as a basis for program funding and implementation.\r\n'),
(151, 29, 42, 'date', '2014-2-5'),
(152, 29, 42, 'images', 'uploads/images/story/image-96472.jpg'),
(153, 29, 42, 'status', 'Active'),
(154, 29, 42, 'user', '1'),
(155, 29, 43, 'title', 'Municipality of Kananga, Leyte: Ensuring local communities benefit from hosting energy projects'),
(156, 29, 43, 'contents', 'MAYOR ELMER C. CODILLA OF MUNICIPALITY OF KANANGA LEYTE DISCUSSED THE MONETARY AND NON-MONETARY BENEFITS THAT KANANGA RECEIVES FROM HOSTING GEOTHERMAL ENERGY PROJECTS AND LIKEWISE THEIR UTILIZATION FOR LOCAL ECONOMIC DEVELOPMENT DURING THE NG-LG JOINT ENERGY FORUM, HELD LAST 6 SEPTEMBER 2013 AT HERITAGE HOTEL, PASAY CITY.\r\n\r\nKananga, located in the Northwestern part of Leyte, is the host municipality of the 700 MW Leyte Geothermal Production Field (LGPF) with 5 Geothermal Power Plants and 4 Optimization Power Plants.\r\n\r\nAlthough Ormoc shares a part of the LGPF, Kananga hosted majority of the Geothermal Power Plants and Kananga is the 90% source of the geothermal steam that flows in the steam highway of the LGPF that feds the Geothermal Power Plant in the production of electricity.\r\n\r\nAccording to Mayor Elmer C. Codilla, “Kananga receives monetary benefits like the: Royalty Fee, Real Property Fee, and the ER1-94 Fee or the one centavo benefits from the sale of electricity; and non-monetary benefits like the: priority in electricity load dispatch; preference in procurement; preference in hiring; and work direct award to community association, from hosting geothermal power plants”.\r\n\r\nUtilization of proceeds from the National Wealth tax:\r\n\r\nThe utilization of the Royalty Fund was divided into 80% for reducing the cost of electricity and 20% for development programs/projects/activities.\r\n\r\nKananga has a 1995 Municipal Ordinance that created the Direct/Energy Cost Subsidy Program and the Energy First Cost Subsidy Program. The Direct/Energy Cost Subsidy Program is for those who already have electricity in their respective residence. Today the refund is 3.00 per kilowatt with a cap of not more than 150 KW on a monthly basis.\r\n\r\nThe Energy First Cost Subsidy Program is for those who don’t have electricity in their respective residence. Kananga residents are supplied with electrical materials and lightings enough to energize their residence, like service drop line wires, electric meter, 3-4 lightings, 2 outlets, switches and the services of electrician for the installations.\r\n\r\n“During my term of office, we have utilized PHP105,513,202.02 that represent the 80% of the Royalty Fee. Today the locality is serving 5,003 beneficiaries municipal-wide for the Energy/Direct Cost Subsidy or the power consumption refund; and 4,833 beneficiaries municipal-wide for the Energy First Cost Subsidy program or the first cost of energy”, said Codilla.\r\n\r\nThe utilization of the remaining 20% of the Royalty Fee of the municipality forms part of the operational cost of the Kananga EDC Institute of Technology or KEITECH. KEITECH is a school partnership of the LGU of Kananga, the Energy Development Corporation (EDC) group and TESDA committed to produce world class TESDA license skilled workers. To date, KEITECH has produced 508 graduates with minimum of 3 to 5 TESDA license in three sectors of Construction, Metals & Engineering, and Tourism.\r\n\r\nUtilization of Real Property Tax fund:\r\n\r\nAnother benefit that the host community receives and utilize is the Real Property Tax (RPT) from the land, buildings, power plants and equipment of the energy projects.\r\n\r\n“Our RPT SHARE goes to our Special Education Fund (SEF) and used in improving our public education, like computerization, & Capability Building for our Teachers\", said Codilla.\r\n\r\nThree Secondary Annex School were opened in 3 barangays, and 1 national high school was established. There are 28 school buildings constructed and 70 school buildings repaired sourced from SEF. The LGU also hired 110 Locally-Hired Teachers in addressing lack of teachers in public schools.\r\n\r\nUtilization of ER 1-94 funds:\r\n\r\nEnergy Regulations 1-94 Funds or commonly known as the ER 1-94 Fund, a one (1) centavo share of host community per electricity sale is another monetary benefit that Kananga receives and utilize. The ER 1-94 is divided into three programs: Development and Livelihood fund (DLF), Reforestation, Watershed, Health and Environment Enhancement fund (RWHEEF) and Electrification fund (EF).\r\n\r\nTo avail the DLF and RWMHEEF funds, the municipality prepares Project Proposals submitted to the Energy Resource Developer and Energy Producing Facility.\r\n\r\nFor the EF:\r\n\r\nIn 2010, out of the 41 sitios of the Municipality, only 9 remained un-energized. There are 25 new sitios emerged. The electrification of these new sitios have been already approved but was pending as of the present, due to unliquidated electrification projects of Ormoc City.\r\n\r\nFor DLF and RWHEEF:\r\n\r\n“During my term of Office from 2007 until present we received and utilized Development and Livelihood Fund of about Php 9,060,991.61 and about Php 11, 241,943.06 for the Reforestation, Watershed Management, Health and Environment Enhancement Fund”, noted Codilla.\r\n\r\nThe amount was spent in various projects such as:\r\n> About 1.3 kms of Farm to  Market Road with Critical Slopes are concreted in 6 different Barangay Local Government Units;\r\n> One Tourism vehicle procured at the municipal LGU for the tourism livelihood programs;\r\n> Construction of Health Center & Day Care Center in Sitio Anagasi, Barangay Montealegre;\r\n> Construction of Concrete Flood Control for Environment Protection in Barangay Hiloctogan;\r\n> Construction of Municipal MRF, 3 Multi-Purpose Health Building and 20 mts Flood Control structure, and\r\n> Six units vehicles procured for waste management\r\n\r\nMayor Codilla stressed that “Kananga and its local communities truly benefit hosting geothermal projects”. \r\n'),
(157, 29, 43, 'date', '2013-9-6'),
(158, 29, 43, 'images', 'uploads/images/story/image-57124.jpg'),
(159, 29, 43, 'status', 'Active'),
(160, 29, 43, 'user', '1'),
(161, 29, 44, 'title', 'Ilocos Norte: Removing barriers to renewable energy investment at the local level'),
(162, 29, 44, 'contents', 'Ilocos Norte, the northernmost province on the western side of Luzon Island is one of the local administrations determined to shift to a greener development path. \r\n\r\nProvincial Board Member Mariano “Nonong” Marcos II during the NG-LG Joint Energy Forum held last 6 September 2013 said that “Ilocos Norte is open for Renewable Energy Businesses”. With the Province endowed with strong supply of wind, water and sun, the Ilocos Norte is ready to take the lead in renewable energy revolution in the countrysides.\r\n\r\nRenewable energy started in Ilocos Norte as early as 1980s. The province is the home to first and only wind farm in the Philippines – the NorthWind’s 20-unit with 24.75 MW capacity located in Bangui. The wind farm is providing a cheaper source of power, employment and job opportunities for local residents, and generating tourism in the area. Besides, Northwind is one of the biggest real estate tax payers of Ilocos Norte. The host community is getting 40% share from national wealth and 1 centavo per kWh energy produced according to the law.  \r\n\r\nOther RE projects present and are currently being established in the province are the following:\r\n\r\n•    5-MW Agua Grande Mini-Hydropower Plant in Pagudpud powers 17,000 households\r\n •    Mirae Asia Energy Corporation’s $50M 20-MW Solar Farm in Currimao broke ground last November 2012\r\n •    Energy Development Corporation’s $300M 87-MW Wind Farm in Burgos broke ground April 2013\r\n •    Northern Luzon UPC Asia Corporation’s $220M 81-MW Wind Farm broke ground in Pagudpud last September 2013\r\n\r\nThe province is planning to attract more RE business locators through one stop shop permitting process; maintaining endorsements by LGUs of projects; providing tax incentives; identifying priority areas of RE and including in their Comprehensive Land Use Plan (CLUP), among others\r\n'),
(163, 29, 44, 'date', '2013-9-6'),
(164, 29, 44, 'images', 'uploads/images/story/image-50194.jpg'),
(165, 29, 44, 'status', 'Active'),
(166, 29, 44, 'user', '1'),
(167, 29, 45, 'title', 'Ilocos Norte, the northernmost province on the western side of Luzon Island is one of the local administrations determined to shift to a greener development path.  Provincial Board Member Mariano “Nonong” Marcos II during the NG-LG Joint Energy Forum held last 6 September 2013 said that “Ilocos Norte is open for Renewable Energy Businesses”. With the Province endowed with strong supply of wind, water and sun, the Ilocos Norte is ready to take the lead in renewable energy revolution in the countrysides. Renewable energy started in Ilocos Norte as early as 1980s. The province is the home to first and only wind farm in the Philippines – the NorthWind’s 20-unit with 24.75 MW capacity located in Bangui. The wind farm is providing a cheaper source of power, employment and job opportunities for local residents, and generating tourism in the area. Besides, Northwind is one of the biggest real estate tax payers of Ilocos Norte. The host community is getting 40% share from national wealth and 1 centavo per kWh energy produced according to the law.   Other RE projects present and are currently being established in the province are the following: •    5-MW Agua Grande Mini-Hydropower Plant in Pagudpud powers 17,000 households  •    Mirae Asia Energy Corporation’s $50M 20-MW Solar Farm in Currimao broke ground last November 2012  •    Energy Development Corporation’s $300M 87-MW Wind Farm in Burgos broke ground April 2013  •    Northern Luzon UPC Asia Corporation’s $220M 81-MW Wind Farm broke ground in Pagudpud last September 2013 The province is planning to attract more RE business locators through one stop shop permitting process; maintaining endorsements by LGUs of projects; providing tax incentives; identifying priority areas of RE and including in their Comprehensive Land Use Plan (CLUP), among others '),
(168, 29, 45, 'contents', 'SOCIAL EMPOWERMENT THROUGH EDUCATION (SEED) PROGRAM; RURAL ELECTRIFICATION AND ENERGIZATION PROGRAM; REINFORCE FIREBRICKS AND BLOCKS MAKING PROJECT (PHOTO: MUNICIPAL GOVERNMENT OF VILLANUEVA)\r\n\r\nBased on the Department of Energy (DOE) Energy Plan 2002-2011, by the end of 2006, existing power producers in Mindanao were unable to meet the electricity demands in the Island.  As a response, the 210MW (net) Mindanao Coal-fired Power Plant owned by STEAG State Power Inc. (SPI) was set to address the challenge of attaining stability in the supply of power.\r\n\r\nIn 2007, Villanueva became the host municipality of Mindanao`s first and most modern power generating facility in the Island. With its timely start of operation on November 15, 2006, the power plant has helped stabilize electricity supply in the island by increasing the grid’s reserve margin from a critically low level of 13% to a system-compliant reserve level of 24%. \r\n\r\nTwenty per cent of Mindanao’s power is now coming from Villanueva.\r\n\r\n\r\nVILLANUEVA’S SUCCESS STORIES WITH SPI\r\n\r\nDirect benefits\r\n•    Investment Destination\r\n Following the location of Mindanao Coal-fired Power Plant, Villanueva emerges as a preferential investment destination of large multinational corporations, such as Coca-Cola, San Miguel B-Meg, Cargill Villanueva Plant, Yan-Yan Foods International, among others.\r\n\r\n•    Increase in Revenue Collection\r\n With the subsequent influx of large industries in Villanueva, revenue collection has increased dramatically over the years. Villanueva is now a 2nd class municipality from a 4th class status.\r\n\r\n•    Project SKILLS and Job Generation\r\n During construction phase, about 4,000 skilled and non-skilled workers were employed.  About 70% of Project SKILLS graduates are now gainfully employed or engaged as service contractors in various private and public business establishments in Villanueva and in abroad\r\n\r\nIndirect benefits\r\n•    Villanueva Water System Project\r\n  The people of Villanueva now have access to clean and reliable supply of potable water.\r\n\r\n•    School Improvement Projects\r\n SPI helps address the perennial lack of classrooms and school chairs.  Public schools in Villanueva now have achieved a 1:1 chair ratio.\r\n\r\n•    Rural Electrification and Energization Program\r\n 98% of Villanueva’s villages are now energized. \r\n\r\n•    Reinforce firebricks and Blocks Making Project  (Villanueva green Products)    \r\n Villanueva green products are first in the Philippines to utilize industrial by-products as raw materials in manufacture of reinforce firebricks, pavers and hollow blocks. The products are used to build durable and affordable houses at the Relocation Site. The products are also used for curbs & gutters and other applications.\r\n\r\n(Municipal Administrator Norman A. Ricacho of Villanueva shared how they have utilized the additional revenues and benefits generated from hosting energy projects for sustainable development programs and projects that help alleviate poverty and protect the environment during the NG-LG Joint Energy Forum held last 6 September 2013, at Heritage Hotel, Pasay City).\r\n'),
(169, 29, 45, 'date', '2013-9-6'),
(170, 29, 45, 'images', 'uploads/images/story/image-62773.jpg'),
(171, 29, 45, 'status', 'Active'),
(172, 29, 45, 'user', '1'),
(173, 29, 46, 'title', 'Province of Batangas: Ensuring local communities benefit from hosting energy projects');
INSERT INTO `tblcontent` (`id`, `feature_id`, `group_id`, `attribute`, `value`) VALUES
(174, 29, 46, 'contents', 'Province of Batangas is a host to four power generation plants, two petrochemical plants, as well as numerous industries operating at the province\'s industrial parks. Currently the four power generation plants in the province namely, DMCI Coal-Fired Power Plant (4%) in Calaca, Sta. Rita/San Lorenzo Power Plant (22%), Ilijan Power Plant in Batangas City (20%), and Makban Geothermal Plant in Sto. Tomas (4%), supply approximately 50% of Luzon Grid requirement.\r\n\r\n\r\nSUCCESS STORIES AND LESSONS LEARNED ON THE USE OF ENERGY RESOURCES AND REVENUES FOR POVERTY REDUCTION AND ENVIRONMENTAL PROTECTION IN THE PROVINCE OF BATANGAS\r\n\r\nBenefits derived from the Development and Livelihood Funds used in Infrastructure Projects:\r\n##Concreting of Roads (Taysan- Lobo Road at Lobo, Batangas and Balete-Tanauan Road at Balete, Batangas) - Better roadways create easier access for farmers and farm products to different trading places, making them available to consumers at lower price, and facilitating the rapid turnover of products to the much needed cash.\r\n##Rehabilitation/Improvement of Roads (Ibaan-San Jose Provincial Road (Ibaan Section), Ibaan, Batangas and at Brgys. San Juan and Papaya, Tingloy, Batangas - an island municipality) - Improved roadway conditions through road widening and better roadway quality through concreting not only reduce travel time but also reduce traffic inconvenience among motorists and passengers. Improved accessibility for residents from rural areas has also marked significant rural development.\r\n##Rehabilitation/Improvement of Drainage (covered canal), and Construction of Slope Protection at Brgy. Rizal, Tuy, Batangas - Improved drainage system assures protection from flooding coupled with the slope protection that prevents potential landslide.\r\n##Construction of Palanca Bridge at Brgy. Palanca, San Jose, Batangas - Easy access and roadway linkages through bridges create better mobility and lesser travel time thereby saving on fuel, motorist time, and reducing air pollution as well.\r\n##Rehabilitation/Improvement of Box Culvert at Brgy. Zone 2, Taal, Batangas - Improved flood protection creates better living environment to residents and reduce calamity risks brought about by flooding.\r\n\r\nBenefits derived from the Reforestation, Watershed Management, Health &/or Environmental Enhancement Fund used in Equipment and Infrastructure Projects:\r\n##Purchase of Ambulance (9 Units Brand New Ambulance and 1 Unit Refurbished 911 Ambulance) - Availability of ambulances on different district hospitals made a significant difference on the lives of needy patients who could hardly afford hospitalization expenses and paid services.\r\n##Purchase of 11 Units of Heavy Equipment (2 Units Boom Trucks, 2 Units Bulldozers, 5 Units Dump Trucks, 1 Unit Crawler Backhoe and 1 Unit Man-lift Truck) - The demand for the use of heavy equipment by different municipalities of the Province of Batangas during times of calamity and on the implementation of development projects has been addressed increasingly through a scheduled time-sharing utilization process.\r\n##Construction of Sewerage Treatment Plant at Two District Hospitals (Don Manuel Lopez Memorial District Hospital, Balayan, Batangas and San Juan District Hospital, San Juan, Batangas) - Health and sanitation through the use of modern technology to aid our environmental enhancement program benefits not only the present populace but the future generation as well.\r\n##Purchase of Generator Sets (Brand New) for various District Hospitals (2 Units 500kVA and 6 Units 350 kVA) - Provision of uninterrupted power supply through generators equipped with automatic transfer switch to various district hospitals that experience frequent and long power interruptions made it possible to deliver improved hospital services to our constituents.\r\n\r\n(Provincial Engineer Nerio L. Ronquillo of Batangas shared how they have maximized the benefits that they receive from Energy Regulation 1-94 funds to finance several infrastructure projects that have direct link to poverty reduction and environmental protection during the NG-LG Joint Energy Forum held last 6 September 2013 at Heritage Hotel, Pasay City).\r\n'),
(175, 29, 46, 'date', '2013-9-6'),
(176, 29, 46, 'images', 'uploads/images/story/image-76524.jpg'),
(177, 29, 46, 'status', 'Active'),
(178, 29, 46, 'user', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbldatatype`
--

CREATE TABLE `tbldatatype` (
  `id` int(11) NOT NULL,
  `dataType` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbldatatype`
--

INSERT INTO `tbldatatype` (`id`, `dataType`) VALUES
(1, 'string'),
(2, 'text'),
(3, 'boolean'),
(4, 'date'),
(5, 'integer'),
(6, 'file'),
(7, 'image');

-- --------------------------------------------------------

--
-- Table structure for table `tblfeature`
--

CREATE TABLE `tblfeature` (
  `id` int(11) NOT NULL,
  `feature` varchar(100) NOT NULL,
  `attributes` text NOT NULL,
  `isVisible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblfeature`
--

INSERT INTO `tblfeature` (`id`, `feature`, `attributes`, `isVisible`) VALUES
(25, 'News and Events', 'a:6:{s:5:\"title\";s:6:\"string\";s:8:\"contents\";s:4:\"text\";s:4:\"date\";s:4:\"date\";s:6:\"images\";s:5:\"image\";s:6:\"status\";s:6:\"string\";s:4:\"user\";s:6:\"string\";}', 1),
(26, 'About Us', 'a:1:{s:8:\"contents\";s:4:\"text\";}', 1),
(29, 'Stories of Change', 'a:6:{s:5:\"title\";s:6:\"string\";s:8:\"contents\";s:4:\"text\";s:4:\"date\";s:4:\"date\";s:6:\"images\";s:5:\"image\";s:6:\"status\";s:6:\"string\";s:4:\"user\";s:6:\"string\";}', 1),
(30, 'Partners', 'a:3:{s:5:\"title\";s:6:\"string\";s:6:\"images\";s:5:\"image\";s:3:\"url\";s:6:\"string\";}', 1),
(35, 'Calendar of Activities', 'a:7:{s:5:\"title\";s:6:\"string\";s:8:\"contents\";s:4:\"text\";s:4:\"date\";s:4:\"date\";s:6:\"status\";s:6:\"string\";s:4:\"user\";s:6:\"string\";s:10:\"date_start\";s:4:\"date\";s:8:\"date_end\";s:4:\"date\";}', 1),
(36, 'Headline', 'a:1:{s:5:\"title\";s:6:\"string\";}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblfile`
--

CREATE TABLE `tblfile` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `folder_id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblfile`
--

INSERT INTO `tblfile` (`id`, `name`, `folder_id`, `date`) VALUES
(2, 'MultiplyingFractionsParentsGuideV4.pdf', 1, 'Dec 19, 2017');

-- --------------------------------------------------------

--
-- Table structure for table `tblfolder`
--

CREATE TABLE `tblfolder` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblfolder`
--

INSERT INTO `tblfolder` (`id`, `name`, `date`, `user_id`, `status`) VALUES
(1, 'Folder 2 test Dec. 19 - updating', 'Jan. 03, 2018', 1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblgroup`
--

CREATE TABLE `tblgroup` (
  `id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblgroup`
--

INSERT INTO `tblgroup` (`id`, `feature_id`) VALUES
(1, 25),
(2, 25),
(4, 25),
(32, 25),
(33, 25),
(34, 25),
(35, 25),
(36, 25),
(37, 25),
(38, 25),
(39, 25),
(40, 25),
(41, 25),
(8, 26),
(9, 26),
(16, 29),
(42, 29),
(43, 29),
(44, 29),
(45, 29),
(46, 29),
(15, 30),
(18, 30),
(19, 30),
(20, 30),
(21, 30),
(22, 30),
(23, 30),
(24, 30),
(25, 30),
(26, 30),
(27, 30),
(28, 30),
(29, 30),
(30, 30),
(31, 30),
(5, 35),
(6, 35),
(7, 35),
(10, 35),
(11, 35),
(12, 35),
(13, 35),
(14, 35),
(17, 36);

-- --------------------------------------------------------

--
-- Table structure for table `tblhub`
--

CREATE TABLE `tblhub` (
  `id` int(11) NOT NULL,
  `file_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phase_id` int(11) NOT NULL,
  `hcategory_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblhub`
--

INSERT INTO `tblhub` (`id`, `file_name`, `phase_id`, `hcategory_id`, `resource_id`, `status`) VALUES
(10, 'mult-div-of-rational-final-tg.pdf', 1, 1, 1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblhub_category`
--

CREATE TABLE `tblhub_category` (
  `id` int(11) NOT NULL,
  `category` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `id_phase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblhub_category`
--

INSERT INTO `tblhub_category` (`id`, `category`, `id_phase`) VALUES
(1, 'Analytical Studies/ Policy reforms, 3', 1),
(2, 'Analytical Studies/ Policy reforms, 4', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblhub_phase`
--

CREATE TABLE `tblhub_phase` (
  `id` int(11) NOT NULL,
  `phase` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblhub_phase`
--

INSERT INTO `tblhub_phase` (`id`, `phase`, `status`) VALUES
(1, 'Phase I - Program Promotion and Stakeholders Forum', ''),
(2, 'Phase II - Implementation', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblhub_resource`
--

CREATE TABLE `tblhub_resource` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblhub_resource`
--

INSERT INTO `tblhub_resource` (`id`, `name`) VALUES
(1, 'General Publication');

-- --------------------------------------------------------

--
-- Table structure for table `tblmessage`
--

CREATE TABLE `tblmessage` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` longtext NOT NULL,
  `date` date NOT NULL,
  `notification` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblmessage`
--

INSERT INTO `tblmessage` (`id`, `name`, `email`, `subject`, `message`, `date`, `notification`) VALUES
(1, 'Catherene Bernardo', 'bernardo@gmail.com', 'New Year\'s wish for you', 'Dear friend,\r\n\r\n\r\nYears come, and Years go, but our friendship has stood the test of time. Wishing you the best in this upcoming year.\r\n\r\nThank you very much and Happy New Year!\r\n\r\nYour friend,\r\n\r\n\r\njimzcal_007', '2018-01-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`user_id`, `code`, `created_at`, `type`) VALUES
(1, 'aVv8rv6IZE2c5PJRDYlgfm1eJ29yNKbc', 1513331809, 0),
(2, '3vtSfQmqZDLFvEKXiXU5cg6zuyKPWoz7', 1513331897, 0),
(2, 'stiXqF0JSPJe2XDSLd44mphEr6s7SjUo', 1513332152, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `last_login_at` int(11) DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`, `last_login_at`, `fullname`) VALUES
(1, 'admin', 'ppei_admin@gmail.com', '$2y$10$WioO10IwlruFF0bU41aywek/AxsBwI0pIPnDGgQvYxS5Tv3CjCPLS', 'pPcJsEeAm5JR2A2Yie2BI-h3Wxgn5b6B', 1513338029, NULL, NULL, '::1', 1513331809, 1513331809, 0, 1515166526, 'PPEI Admin'),
(2, 'ppei', 'jimzcal123@gmail.com', '$2y$10$rN85qkrhL4UYwc1tyUG7FOd2TVbwOEQM/ONqS7fTnqbkfWc3fyRWW', 'ETTYYM-jMi8_fzn8XXaGSvEnrZ52Azhp', 1513338041, NULL, NULL, '::1', 1513331897, 1514391660, 0, 1514985447, 'Jimmy Caldoza'),
(5, 'delacruz', 'jhon@gmail.com', '$2y$10$s9VLGhJfFoK.QxKrjlbJaeBUQSlcLCSsANDffV1W5gnhNxU2h48Fu', 'xoSyuTx35U0GOctFRCe9eHbPlKlbp-Cn', 1515001149, NULL, NULL, '::1', 1515001149, 1515001149, 0, NULL, 'Jhon Dela Cruz');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `auth_assignment_user_id_idx` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `social_account`
--
ALTER TABLE `social_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_unique` (`provider`,`client_id`),
  ADD UNIQUE KEY `account_unique_code` (`code`),
  ADD KEY `fk_user_account` (`user_id`);

--
-- Indexes for table `tblalbum`
--
ALTER TABLE `tblalbum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblalbum_ibfk_1` (`user_id`);

--
-- Indexes for table `tblalbum_image`
--
ALTER TABLE `tblalbum_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `album_id` (`album_id`);

--
-- Indexes for table `tblattribute`
--
ALTER TABLE `tblattribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontent`
--
ALTER TABLE `tblcontent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblcontent_ibfk_1` (`group_id`),
  ADD KEY `tblcontent_ibfk_2` (`feature_id`);

--
-- Indexes for table `tbldatatype`
--
ALTER TABLE `tbldatatype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblfeature`
--
ALTER TABLE `tblfeature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblfile`
--
ALTER TABLE `tblfile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `folder_id` (`folder_id`);

--
-- Indexes for table `tblfolder`
--
ALTER TABLE `tblfolder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tblgroup`
--
ALTER TABLE `tblgroup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feature_id` (`feature_id`);

--
-- Indexes for table `tblhub`
--
ALTER TABLE `tblhub`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hcategory_id` (`hcategory_id`),
  ADD KEY `resource_id` (`resource_id`),
  ADD KEY `phase_id` (`phase_id`);

--
-- Indexes for table `tblhub_category`
--
ALTER TABLE `tblhub_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_phase` (`id_phase`);

--
-- Indexes for table `tblhub_phase`
--
ALTER TABLE `tblhub_phase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblhub_resource`
--
ALTER TABLE `tblhub_resource`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmessage`
--
ALTER TABLE `tblmessage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD UNIQUE KEY `token_unique` (`user_id`,`code`,`type`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_unique_username` (`username`),
  ADD UNIQUE KEY `user_unique_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `social_account`
--
ALTER TABLE `social_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblalbum`
--
ALTER TABLE `tblalbum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblalbum_image`
--
ALTER TABLE `tblalbum_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=332;

--
-- AUTO_INCREMENT for table `tblattribute`
--
ALTER TABLE `tblattribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblcontent`
--
ALTER TABLE `tblcontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT for table `tbldatatype`
--
ALTER TABLE `tbldatatype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblfeature`
--
ALTER TABLE `tblfeature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tblfile`
--
ALTER TABLE `tblfile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblfolder`
--
ALTER TABLE `tblfolder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblgroup`
--
ALTER TABLE `tblgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tblhub`
--
ALTER TABLE `tblhub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblhub_category`
--
ALTER TABLE `tblhub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblhub_phase`
--
ALTER TABLE `tblhub_phase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblhub_resource`
--
ALTER TABLE `tblhub_resource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblmessage`
--
ALTER TABLE `tblmessage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tblalbum`
--
ALTER TABLE `tblalbum`
  ADD CONSTRAINT `tblalbum_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblalbum_image`
--
ALTER TABLE `tblalbum_image`
  ADD CONSTRAINT `tblalbum_image_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `tblalbum` (`id`);

--
-- Constraints for table `tblcontent`
--
ALTER TABLE `tblcontent`
  ADD CONSTRAINT `tblcontent_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `tblgroup` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tblcontent_ibfk_2` FOREIGN KEY (`feature_id`) REFERENCES `tblfeature` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblfile`
--
ALTER TABLE `tblfile`
  ADD CONSTRAINT `tblfile_ibfk_1` FOREIGN KEY (`folder_id`) REFERENCES `tblfolder` (`id`);

--
-- Constraints for table `tblfolder`
--
ALTER TABLE `tblfolder`
  ADD CONSTRAINT `tblfolder_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblgroup`
--
ALTER TABLE `tblgroup`
  ADD CONSTRAINT `tblgroup_ibfk_1` FOREIGN KEY (`feature_id`) REFERENCES `tblfeature` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblhub`
--
ALTER TABLE `tblhub`
  ADD CONSTRAINT `tblhub_ibfk_1` FOREIGN KEY (`phase_id`) REFERENCES `tblhub_phase` (`id`),
  ADD CONSTRAINT `tblhub_ibfk_2` FOREIGN KEY (`resource_id`) REFERENCES `tblhub_resource` (`id`),
  ADD CONSTRAINT `tblhub_ibfk_3` FOREIGN KEY (`hcategory_id`) REFERENCES `tblhub_category` (`id`);

--
-- Constraints for table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
