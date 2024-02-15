-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 15, 2024 at 09:17 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'mreda.elalaoui1@gmail.com', ' Subjeect test Mailer', NULL, '2023-12-17 14:47:04'),
(2, 'mgb.main0@gmail.com', ' Subjeect test Mailer', 'efze', '2023-12-17 14:47:29'),
(3, 'mreda.elalaoui1@gmail.com', ' Subjeect test Mailer', 'zgaroupa la momtra fefe', '2023-12-17 14:51:51'),
(4, 'mreda.elalaoui1@gmail.com', ' Subjeect test Mailer', 'r-yfy', '2023-12-17 17:49:40'),
(5, 'mgb.main0@gmail.com', ' Subjeect test Mailer', 'deqs', '2023-12-17 17:51:40'),
(6, 'mgb.main0@gmail.com', ' Subjeect test Mailer', 'doctrine bus enabeled', '2023-12-19 12:30:03'),
(7, 'mreda.elalaoui1@gmail.com', ' Subjeect test Mailer', 'yfwxrytc', '2023-12-24 15:59:02');

-- --------------------------------------------------------

--
-- Table structure for table `day_info`
--

DROP TABLE IF EXISTS `day_info`;
CREATE TABLE IF NOT EXISTS `day_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tour_id` int DEFAULT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_60E1DC2115ED8D43` (`tour_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `day_info`
--

INSERT INTO `day_info` (`id`, `tour_id`, `title`, `description`) VALUES
(7, 7, 'Day 1 :', 'fe; pz,f feoi,f ezfiefjoiezjfi ojeofijezoi fje fjeiofzoe jfe'),
(8, 7, 'Day 2 :', 'Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée à titre provisoire pour calibrer une mise en page, le texte définitif venant remplacer le faux-texte dès qu\'il est prêt ou qu'),
(9, 9, 'Day 1 :', 'ghtaklou ou ghtmchiw l knkbhjbklnjvj'),
(10, 9, 'Day 2 :', 'utdkyfc;uvi iug luiglib');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20231214143015', '2023-12-14 14:30:35', 225),
('DoctrineMigrations\\Version20231214152217', '2023-12-14 15:22:26', 46),
('DoctrineMigrations\\Version20231214230620', '2023-12-14 23:06:33', 174),
('DoctrineMigrations\\Version20231216145746', '2023-12-16 14:58:23', 80),
('DoctrineMigrations\\Version20231216211350', '2023-12-16 21:14:05', 159),
('DoctrineMigrations\\Version20231216223352', '2023-12-16 22:34:01', 148),
('DoctrineMigrations\\Version20231219122926', '2023-12-19 12:29:33', 151),
('DoctrineMigrations\\Version20240110142804', '2024-01-10 14:28:28', 84);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tour_id` int DEFAULT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_472B783A15ED8D43` (`tour_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `tour_id`, `image`) VALUES
(8, 7, 'destination-1.jpg'),
(9, 7, 'destination-2.jpg'),
(10, 7, 'destination-1.jpg'),
(11, 9, 'destination-2.jpg'),
(12, 7, 'destination-4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour`
--

DROP TABLE IF EXISTS `tour`;
CREATE TABLE IF NOT EXISTS `tour` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `location` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` int DEFAULT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci,
  `online` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `type` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour`
--

INSERT INTO `tour` (`id`, `name`, `price`, `description`, `location`, `day`, `image`, `online`, `created_at`, `type`) VALUES
(7, 'Marrackech', 64, 'Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée à titre provisoire pour calibrer une mise en page, le texte définitif venant remplacer le faux-texte dès qu\'il est prêt ou que l', 'marrackech', 2, 'bg-marrakech-marocco.jpg', 1, '2023-12-22 14:46:08', 1),
(9, 'Merzouga', 55, 'Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée à titre provisoire pour calibrer une mise en page, le t', 'Merzouga', 2, 'merzouga.jpg', 1, '2023-12-24 16:00:12', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tour_request`
--

DROP TABLE IF EXISTS `tour_request`;
CREATE TABLE IF NOT EXISTS `tour_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adult` int NOT NULL,
  `children` int DEFAULT NULL,
  `date` datetime NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `tour_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7B7D0A1E15ED8D43` (`tour_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_request`
--

INSERT INTO `tour_request` (`id`, `first_name`, `last_name`, `email`, `country`, `adult`, `children`, `date`, `message`, `created_at`, `tour_id`) VALUES
(6, 'Mohamed Reda', 'El Alaoui', 'mreda.elalaoui1@gmail.com', 'France', 1, 1, '2023-12-21 16:51:00', 'fe fz dfezfez zceffze', '2023-12-24 15:51:51', 7),
(7, 'Mohamed Reda', 'El Alaoui', 'mreda.elalaoui1@gmail.com', 'France', 1, 1, '2023-12-07 16:58:00', 'yttdxcjyudu;iycu', '2023-12-24 15:58:35', 7);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int DEFAULT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `first_name`, `last_name`, `age`, `image`, `created_at`, `updated_at`) VALUES
(1, 'admin@exemple.com', '[\"ROLE_ADMIN\"]', '$2y$13$8gGDYtaXjNTbv/a2k.DSJeaqTSKvbeFJCEzq8Ay0i5v71B.Dg3yPm', 'Jimmy', '21', NULL, NULL, '2023-12-14 15:26:53', NULL),
(2, 'user@exemple.com', '[]', '$2y$13$jHu8z0PVcD/AfC3r91eBF.DkUIa.0rWZXlsXBWdFMGnQfgNdiU556', NULL, NULL, NULL, NULL, '2023-12-22 14:53:50', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `day_info`
--
ALTER TABLE `day_info`
  ADD CONSTRAINT `FK_60E1DC2115ED8D43` FOREIGN KEY (`tour_id`) REFERENCES `tour` (`id`);

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `FK_472B783A15ED8D43` FOREIGN KEY (`tour_id`) REFERENCES `tour` (`id`);

--
-- Constraints for table `tour_request`
--
ALTER TABLE `tour_request`
  ADD CONSTRAINT `FK_7B7D0A1E15ED8D43` FOREIGN KEY (`tour_id`) REFERENCES `tour` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
