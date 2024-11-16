-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 06 مايو 2024 الساعة 22:14
-- إصدار الخادم: 10.11.7-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u951740847_platforme`
--

-- --------------------------------------------------------

--
-- بنية الجدول `admine`
--

CREATE TABLE `admine` (
  `id` int(101) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Numéro` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `admine`
--

INSERT INTO `admine` (`id`, `name`, `email`, `password`, `Numéro`, `image`) VALUES
(11, 'Admin', 'admin@gk.com', '7b52009b64fd0a2a49e6d8a939753077792b0554', '064', 'OIG2..jpeg'),
(12, 'kiwi', 'hdh@gmail.com', '356a192b7913b04c54574d18c28d46e6395428ab', '63636', 'IMG_1471.jpeg'),
(13, 'مريم الحراق', 'vkggur@fh.com', '7b52009b64fd0a2a49e6d8a939753077792b0554', '23', 'OIG1..jpeg'),
(14, 'hhh', 'mer77@gmail.com', '356a192b7913b04c54574d18c28d46e6395428ab', '888', 'IMG_1470.png'),
(15, 'kiwi', 'rtrr@et.com', '7b52009b64fd0a2a49e6d8a939753077792b0554', '12156', 'images.jfif'),
(16, 'ilyas', 'blc@gmail.com', '77de68daecd823babbb58edb1c8e14d7106e83bb', '06432043234', 'veolia.png'),
(17, 'so', 'ilalc@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '0645245254', 'تنزيل.jfif'),
(18, 'hajar bounab', 'hajarbounab417@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '0648877003', 'exo1.12.png'),
(19, 'kkkk', 'kkkk@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '0789898989', 'tfcd.PNG');

-- --------------------------------------------------------

--
-- بنية الجدول `annonce`
--

CREATE TABLE `annonce` (
  `id` int(101) NOT NULL,
  `image` varchar(100) NOT NULL,
  `content` varchar(100) NOT NULL,
  `title` varchar(250) NOT NULL,
  `formation_id` int(100) NOT NULL,
  `Enseignants_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `annonce`
--

INSERT INTO `annonce` (`id`, `image`, `content`, `title`, `formation_id`, `Enseignants_id`) VALUES
(5, '', '1234', 'Math', 0, 29),
(6, 'Screenshot_2024-05-06-13-14-09-644_com.android.chrome.jpg', '1234', 'Math', 0, 29),
(7, 'Screenshot_2024-04-13-13-03-05-139_com.google.android.gm.jpg', '1234', 'Analyse', 0, 29),
(8, 'execution.PNG', ',bnkji', 'iughkhg', 0, 29),
(9, 'download.png', 'kjhiuhiugik', 'ghgjgig', 0, 29),
(10, 'Capturer4.PNG', 'iygigiugig', 'iuyigi', 0, 29),
(11, 'Capturer4.PNG', 'ojhjnlknlnlonljnklj', 'kjbkjbnkjbnkjbnkj', 13, 29),
(12, 'SE.jpeg', 'vj,gjkgujgj,gjfhkhfkhfk', 'nvkjg,gj,g', 12, 29),
(13, 'SE.jpeg', 'jlriryilryil', 'ytukydl', 15, 32),
(14, 'execution.PNG', 'kjnhjljkjbkjbk', 'lihohnlnlnlkn', 15, 32),
(15, 'Screenshot_٢٠٢٤٠٥٠٦-١٥٢٧٥٤_Chrome.jpg', 'Zbjzzjz', 'Sjzjzj', 14, 28),
(16, 'math.jpeg', 'trhethwetheth', 'trteget', 18, 32);

-- --------------------------------------------------------

--
-- بنية الجدول `chapitre`
--

CREATE TABLE `chapitre` (
  `id` int(100) NOT NULL,
  `Enseignants_id` int(100) NOT NULL,
  `cours_id` int(100) NOT NULL,
  `partie_id` int(100) NOT NULL,
  `pdf` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `chapitre`
--

INSERT INTO `chapitre` (`id`, `Enseignants_id`, `cours_id`, `partie_id`, `pdf`, `status`, `content`, `date`) VALUES
(6, 28, 62, 33, 'sara,+19984-51552-1-CE.pdf', 'active', 'Hsks su', '2024-05-06'),
(7, 28, 62, 33, 'sara,+19984-51552-1-CE.pdf', 'active', 'Tygg', '2024-05-06'),
(8, 29, 63, 32, 'Énoncé de Projet.pdf', 'active', 'Chapitre ', '2024-05-06');

-- --------------------------------------------------------

--
-- بنية الجدول `contact`
--

CREATE TABLE `contact` (
  `id` int(101) NOT NULL,
  `messa` varchar(100) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `contact`
--

INSERT INTO `contact` (`id`, `messa`, `name`, `email`) VALUES
(1, 'Messa', '', ''),
(2, 'hajarbounab417@gmail.com', '', '');

-- --------------------------------------------------------

--
-- بنية الجدول `cours`
--

CREATE TABLE `cours` (
  `id` int(101) NOT NULL,
  `code` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `cours_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `cours`
--

INSERT INTO `cours` (`id`, `code`, `title`, `cours_id`) VALUES
(6, '1234', 'kknnnn', 63),
(7, '1234', 'Bsbsjs', 62),
(8, '1234', 'jhg', 65),
(9, '123', 'hajar', 67);

-- --------------------------------------------------------

--
-- بنية الجدول `demanders`
--

CREATE TABLE `demanders` (
  `id` int(101) NOT NULL,
  `étudiant_id` varchar(100) NOT NULL,
  `formation_id` varchar(100) NOT NULL,
  `Enseignants_id` varchar(100) NOT NULL,
  `demander` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `demanders`
--

INSERT INTO `demanders` (`id`, `étudiant_id`, `formation_id`, `Enseignants_id`, `demander`, `date`) VALUES
(49, '1', '1', '1', '1', '2024-05-06'),
(50, '11', '13', '25', '1', '2024-05-05'),
(51, '11', '12', '1', '1', '2024-05-05'),
(52, '', '15', '28', '1', '2024-05-06'),
(53, '', '14', '25', '1', '2024-05-06'),
(54, '', '12', '1', '1', '2024-05-06'),
(55, '', '13', '25', '1', '2024-05-06'),
(56, '13', '12', '1', '1', '2024-05-06'),
(57, '13', '13', '25', '1', '2024-05-06'),
(58, '13', '14', '25', '1', '2024-05-06'),
(59, '13', '15', '28', '1', '2024-05-06'),
(60, '13', '16', '29', '1', '2024-05-06'),
(61, '', '16', '29', '1', '2024-05-06'),
(62, '12', '16', '29', '1', '2024-05-06'),
(63, '14', '16', '29', '1', '2024-05-06'),
(64, '15', '13', '25', '1', '2024-05-06'),
(65, '15', '15', '28', '1', '2024-05-06'),
(66, '15', '12', '1', '1', '2024-05-06'),
(67, '15', '14', '25', '1', '2024-05-06'),
(68, '15', '16', '29', '1', '2024-05-06'),
(69, '17', '18', '32', '1', '2024-05-06'),
(70, '', '18', '32', '1', '2024-05-06'),
(71, '', '17', '28', '1', '2024-05-06'),
(72, '18', '14', '25', '1', '2024-05-06'),
(73, '18', '12', '1', '1', '2024-05-06'),
(74, '18', '18', '32', '1', '2024-05-06'),
(75, '18', '15', '28', '1', '2024-05-06'),
(79, '17', '21', '32', '1', '2024-05-06'),
(80, '19', '21', '32', '1', '2024-05-06'),
(81, '18', '22', '33', '1', '2024-05-06');

-- --------------------------------------------------------

--
-- بنية الجدول `Enseignants`
--

CREATE TABLE `Enseignants` (
  `id` int(101) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Numéro` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `Enseignants`
--

INSERT INTO `Enseignants` (`id`, `name`, `email`, `password`, `Numéro`, `image`, `date`) VALUES
(25, 'Khalid cheddadi', 'vkggur@fh.com', '7b52009b64fd0a2a49e6d8a939753077792b0554', '065349494', 'OIG2.dHlXlIf3.s3.jpeg', '2024-05-05'),
(26, 'mohamed tr', 'moihl@jkh.com', '7b52009b64fd0a2a49e6d8a939753077792b0554', '05452', 'kiki.jfif', '2024-05-05'),
(27, 'karat', 'hotmail@gmail.com', '356a192b7913b04c54574d18c28d46e6395428ab', '0684736362', 'IMG_1471.jpeg', '2024-05-06'),
(28, 'Khalid cheddadi', 'vkgyehgur@fh.com', '7b52009b64fd0a2a49e6d8a939753077792b0554', '069464648', 'OIG1 (9).jpeg', '2024-05-06'),
(29, 'Mohamed', 'youness23@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '0613405012', 'IMG_20240418_095955.jpg', '2024-05-06'),
(30, 'محمد', 'aymanmohammed280@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', '0764853921', 'IMG_20240418_114729.jpg', '2024-05-06'),
(31, 'hamza', 'ilalc@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '0642425475', 'تنزيل.jfif', '2024-05-06'),
(32, 'youness2', 'youness2@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '0788888888', 'THL.jpeg', '2024-05-06'),
(33, 'hajar bounab', 'hajarbounab417@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '0648877003', 'WhatsApp Image 2024-03-20 at 12.31.16.jpeg', '2024-05-06');

-- --------------------------------------------------------

--
-- بنية الجدول `formation`
--

CREATE TABLE `formation` (
  `id` int(11) NOT NULL,
  `Enseignants_id` int(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `liés` text DEFAULT NULL,
  `public` varchar(100) DEFAULT NULL,
  `Exigences` text DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `formation`
--

INSERT INTO `formation` (`id`, `Enseignants_id`, `title`, `liés`, `public`, `Exigences`, `video`, `status`, `date`) VALUES
(12, 1, 'trtt', 'yhjyj', 'yjtjyt', 'yjyjyj', NULL, 'active', '2024-05-06'),
(13, 25, 'Math', 'Lok lok lok', 'Lbrahch', '200dh', '431981176_387823694035883_3340637018998222194_n.mp4', 'active', '2024-05-05'),
(14, 25, 'Hy', 'Jsls jdje', 'Lbrahch', '300dh', '431981176_387823694035883_3340637018998222194_n.mp4', 'active', '2024-05-05'),
(15, 28, 'Math', 'Hks jzjzjz skzjzj', '6eme', '300dh', 'An-n2sqFlgOKcja93hnvPu22SxqMp3Xs0avKPui0-GANkqoWRi1vwoTMrkyupMClgstKgNaG1AccRmesZSwuPCw.mp4', 'active', '2024-05-06'),
(16, 29, 'Math', '1234', '1234', 'Analyse', '', 'active', '2024-05-06'),
(17, 28, 'Hsjsjsh', 'Jsjsj', 'Jsjdj', 'Bsbbdb', '431981176_387823694035883_3340637018998222194_n.mp4', 'active', '2024-05-06'),
(21, 32, 'kugkgk', '1234', 'kgkhkhgk', 'rfgfegv', 'Structure de données #8 _ Tri par fusion (Merge sort) _ Darija - YouTube - Google Chrome 2024-02-29 20-05-57.mp4', 'active', '2024-05-06'),
(22, 33, 'hajar', 'hajar', 'gi1', 'math', 'ha.mp4', 'active', '2024-05-06');

-- --------------------------------------------------------

--
-- بنية الجدول `groups`
--

CREATE TABLE `groups` (
  `id` int(101) NOT NULL,
  `étudiant_id` varchar(100) NOT NULL,
  `formation_id` varchar(100) NOT NULL,
  `Enseignants_id` varchar(100) NOT NULL,
  `Acceptation` int(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `groups`
--

INSERT INTO `groups` (`id`, `étudiant_id`, `formation_id`, `Enseignants_id`, `Acceptation`, `date`) VALUES
(9, '1', '1', '1', 1, '2024-05-06 00:13:18'),
(10, '', '15', '28', 1, '2024-05-06 10:25:10'),
(11, '13', '15', '28', 1, '2024-05-06 11:44:33'),
(12, '12', '16', '29', 1, '2024-05-06 11:59:08'),
(13, '14', '16', '29', 1, '2024-05-06 12:23:49'),
(14, '15', '15', '28', 1, '2024-05-06 13:30:57'),
(15, '17', '18', '32', 1, '2024-05-06 14:59:10'),
(17, '17', '21', '32', 1, '2024-05-06 16:11:19'),
(18, '19', '21', '32', 1, '2024-05-06 16:46:02'),
(19, '18', '22', '33', 1, '2024-05-06 16:56:30');

-- --------------------------------------------------------

--
-- بنية الجدول `messages`
--

CREATE TABLE `messages` (
  `id` int(101) NOT NULL,
  `sender_id` int(101) NOT NULL,
  `receiver_id` int(101) NOT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `message_admin_enseig`
--

CREATE TABLE `message_admin_enseig` (
  `id` int(101) NOT NULL,
  `Enseignants_id` varchar(100) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `message_admin_env`
--

CREATE TABLE `message_admin_env` (
  `id` int(101) NOT NULL,
  `étudiant_id` varchar(100) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `message_Enseignants_admin`
--

CREATE TABLE `message_Enseignants_admin` (
  `id` int(101) NOT NULL,
  `Enseignants_id` varchar(100) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `message_Enseignants_admin`
--

INSERT INTO `message_Enseignants_admin` (`id`, `Enseignants_id`, `content`, `date`, `admin_id`) VALUES
(13, '28', 'Hello prof', '2024-05-06 07:42:24', '12'),
(15, '28', 'Hello my student', '2024-05-06 10:21:02', '15');

-- --------------------------------------------------------

--
-- بنية الجدول `message_ense_env`
--

CREATE TABLE `message_ense_env` (
  `id` int(101) NOT NULL,
  `étudiant_id` varchar(100) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Enseignants_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `message_ense_env`
--

INSERT INTO `message_ense_env` (`id`, `étudiant_id`, `content`, `date`, `Enseignants_id`) VALUES
(13, '13', 'Hello dier', '2024-05-06 12:21:10', '28'),
(14, '12', 'u\r\n', '2024-05-06 14:33:58', '29'),
(15, '14', 'ii\r\n', '2024-05-06 14:34:21', '29'),
(16, '19', 'eajhfese', '2024-05-06 16:46:51', '32');

-- --------------------------------------------------------

--
-- بنية الجدول `message_ense_env_groups`
--

CREATE TABLE `message_ense_env_groups` (
  `id` int(101) NOT NULL,
  `Enseignants_id` varchar(100) NOT NULL,
  `title_cours` varchar(100) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `formation_id` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `message_ense_env_groups`
--

INSERT INTO `message_ense_env_groups` (`id`, `Enseignants_id`, `title_cours`, `content`, `formation_id`, `date`) VALUES
(62, '28', 'Bsbsjs', 'Hsjjs', '15', '2024-05-06 12:11:05'),
(63, '29', 'kknnnn', ';k;k;\r\n\r\n', '16', '2024-05-06 12:15:11'),
(64, '29', 'fghj', 'jgufju', '16', '2024-05-06 12:59:15'),
(65, '32', 'jhg', 'hoho', '21', '2024-05-06 16:20:10'),
(66, '32', 'sefohsorh', 'selkfjsekk', '21', '2024-05-06 16:47:15'),
(67, '33', 'hajar', 'hajar\r\n', '22', '2024-05-06 16:57:28'),
(68, '33', 'fgkjh', 'srgdhgn', '22', '2024-05-06 17:13:42');

-- --------------------------------------------------------

--
-- بنية الجدول `message_étudiant_admin`
--

CREATE TABLE `message_étudiant_admin` (
  `id` int(101) NOT NULL,
  `étudiant_id` varchar(100) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `message_étudiant_env`
--

CREATE TABLE `message_étudiant_env` (
  `id` int(101) NOT NULL,
  `étudiant_id` varchar(100) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Enseignants_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `message_étudiant_env`
--

INSERT INTO `message_étudiant_env` (`id`, `étudiant_id`, `content`, `date`, `Enseignants_id`) VALUES
(48, '12', 'Bonjour', '2024-05-06 12:06:48', '29'),
(49, '14', 'bonjour\r\n', '2024-05-06 12:57:38', '29'),
(50, '12', 'hi', '2024-05-06 14:29:12', '29');

-- --------------------------------------------------------

--
-- بنية الجدول `message_étudiant_env_groups`
--

CREATE TABLE `message_étudiant_env_groups` (
  `id` int(101) NOT NULL,
  `étudiant_id` varchar(100) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `formation_id` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `message_étudiant_env_groups`
--

INSERT INTO `message_étudiant_env_groups` (`id`, `étudiant_id`, `content`, `formation_id`, `date`) VALUES
(81, '13', 'Hello', '15', '2024-05-06 15:07:10'),
(82, '18', 'merci prof\r\n', '22', '2024-05-06 16:58:37');

-- --------------------------------------------------------

--
-- بنية الجدول `partie`
--

CREATE TABLE `partie` (
  `id` int(101) NOT NULL,
  `Enseignants_id` varchar(100) NOT NULL,
  `pdf` varchar(100) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `cours_id` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `partie`
--

INSERT INTO `partie` (`id`, `Enseignants_id`, `pdf`, `content`, `cours_id`, `date`, `status`) VALUES
(32, '29', 'Énoncé de Projet.pdf', 'pjpjpl', '63', '2024-05-06', 'active'),
(33, '28', 'sara,+19984-51552-1-CE.pdf', 'Sjjsjz', '62', '2024-05-06', 'deactive'),
(34, '29', 'ACFrOgCyIKGcSMwOm5-V9lWhvtDnbS2RtvIr1uxLO9oDe7oJEY9xLSVq8Nh2Lem1bp5198Uv3s9F2Z7FiNnSIvDRBbx5m_V99rUX', 'Gehehe', '64', '2024-05-06', 'active'),
(35, '29', 'ACFrOgCyIKGcSMwOm5-V9lWhvtDnbS2RtvIr1uxLO9oDe7oJEY9xLSVq8Nh2Lem1bp5198Uv3s9F2Z7FiNnSIvDRBbx5m_V99rUX', 'Gehehe', '64', '2024-05-06', 'active'),
(36, '32', '3_2_TP_Bison 22 04 (1).pdf', 'jpjpjpjpjpj', '65', '2024-05-06', 'deactive'),
(38, '33', 'Énoncé de Projet (2).pdf', 'langage c', '67', '2024-05-06', 'active');

-- --------------------------------------------------------

--
-- بنية الجدول `étudiant`
--

CREATE TABLE `étudiant` (
  `id` int(101) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Numéro` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `étudiant`
--

INSERT INTO `étudiant` (`id`, `name`, `email`, `password`, `Numéro`, `image`, `date`) VALUES
(11, 'Khalid cheddadi', 'vkggur@fh.com', '7b52009b64fd0a2a49e6d8a939753077792b0554', '06', 'inbound1415515565232018871.jpg', '2024-05-05'),
(12, 'Mohamed', 'aymanmohammed280@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '0672139044', 'IMG_20240420_111145.jpg', '2024-05-06'),
(13, 'hhh', 'a@a.com', '356a192b7913b04c54574d18c28d46e6395428ab', '837383833', 'IMG_1471.jpeg', '2024-05-06'),
(14, 'احمد', 'youness23@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0693805460', 'Screenshot_2024-04-13-12-54-47-699_com.google.android.gm.jpg', '2024-05-06'),
(15, 'Kh', 'vkgttg@fh.com', '7b52009b64fd0a2a49e6d8a939753077792b0554', '065', 'OIG2 (23).jpeg', '2024-05-06'),
(16, 'kamal', 'ka@gmail.com', '356a192b7913b04c54574d18c28d46e6395428ab', '061343245', 'login.jpg', '2024-05-06'),
(17, 'youness', 'youness@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '0688888888', 'yy.jpg', '2024-05-06'),
(18, 'hajar bounab', 'hajarbounab417@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '0648877003', 'uy.png', '2024-05-06'),
(19, 'hajar', 'hajar@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '0765656565', 'prgweb.jpeg', '2024-05-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admine`
--
ALTER TABLE `admine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `annonce`
--
ALTER TABLE `annonce`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chapitre`
--
ALTER TABLE `chapitre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demanders`
--
ALTER TABLE `demanders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Enseignants`
--
ALTER TABLE `Enseignants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sender` (`sender_id`),
  ADD KEY `fk_receiver` (`receiver_id`);

--
-- Indexes for table `message_admin_enseig`
--
ALTER TABLE `message_admin_enseig`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_admin_env`
--
ALTER TABLE `message_admin_env`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_Enseignants_admin`
--
ALTER TABLE `message_Enseignants_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_ense_env`
--
ALTER TABLE `message_ense_env`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_ense_env_groups`
--
ALTER TABLE `message_ense_env_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_étudiant_admin`
--
ALTER TABLE `message_étudiant_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_étudiant_env`
--
ALTER TABLE `message_étudiant_env`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_étudiant_env_groups`
--
ALTER TABLE `message_étudiant_env_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partie`
--
ALTER TABLE `partie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `étudiant`
--
ALTER TABLE `étudiant`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admine`
--
ALTER TABLE `admine`
  MODIFY `id` int(101) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `annonce`
--
ALTER TABLE `annonce`
  MODIFY `id` int(101) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `chapitre`
--
ALTER TABLE `chapitre`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(101) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int(101) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `demanders`
--
ALTER TABLE `demanders`
  MODIFY `id` int(101) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `Enseignants`
--
ALTER TABLE `Enseignants`
  MODIFY `id` int(101) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `formation`
--
ALTER TABLE `formation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(101) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `message_admin_enseig`
--
ALTER TABLE `message_admin_enseig`
  MODIFY `id` int(101) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `message_admin_env`
--
ALTER TABLE `message_admin_env`
  MODIFY `id` int(101) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `message_Enseignants_admin`
--
ALTER TABLE `message_Enseignants_admin`
  MODIFY `id` int(101) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `message_ense_env`
--
ALTER TABLE `message_ense_env`
  MODIFY `id` int(101) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `message_ense_env_groups`
--
ALTER TABLE `message_ense_env_groups`
  MODIFY `id` int(101) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `message_étudiant_admin`
--
ALTER TABLE `message_étudiant_admin`
  MODIFY `id` int(101) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `message_étudiant_env`
--
ALTER TABLE `message_étudiant_env`
  MODIFY `id` int(101) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `message_étudiant_env_groups`
--
ALTER TABLE `message_étudiant_env_groups`
  MODIFY `id` int(101) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `partie`
--
ALTER TABLE `partie`
  MODIFY `id` int(101) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `étudiant`
--
ALTER TABLE `étudiant`
  MODIFY `id` int(101) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- قيود الجداول المُلقاة.
--

--
-- قيود الجداول `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_receiver` FOREIGN KEY (`receiver_id`) REFERENCES `étudiant` (`id`),
  ADD CONSTRAINT `fk_sender` FOREIGN KEY (`sender_id`) REFERENCES `Enseignants` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
