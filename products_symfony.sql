-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 11, 2024 at 11:02 AM
-- Server version: 8.0.37-0ubuntu0.22.04.3
-- PHP Version: 8.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `products_symfony`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240710123404', '2024-07-10 17:34:57', 133),
('DoctrineMigrations\\Version20240711063506', '2024-07-11 11:35:50', 150);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`) VALUES
(1, 'Latest Product 2024', 'This is an example product.', 89.99),
(2, 'Upated Products 2024', 'This is a updated product.', 189.99),
(9, 'Latest Product 2024', 'This is an example product.', 89.99),
(11, 'Latest Product 2024', 'This is an example product.', 89.99),
(12, 'Latest Product 2024', 'This is an example product.', 89.99),
(13, 'Latest Product 2024', 'This is an example product.', 89.99),
(14, 'Latest Product 2024', 'This is an example product.', 89.99),
(15, 'Latest Product 2024', 'This is an example product.', 89.99),
(16, 'Latest Product 2024', 'This is an example product.', 89.99),
(17, 'Latest Product 2024', 'This is an example product.', 89.99),
(18, 'Latest Product 2024', 'This is an example product.', 89.99),
(19, 'Latest Product 2024', 'This is an example product.', 89.99),
(20, 'Latest Product 2024', 'This is an example product.', 89.99),
(21, 'Latest Product 2024', 'This is an example product.', 8.9),
(22, 'Latest Product 2024', 'This is an example product.', 8.9),
(23, 'Latest Product 2024', 'This is an example product.', 8.9),
(24, 'Latest Product 2024', 'This is an example product.', 12.56),
(25, 'Latest Product 2024', 'This is an example product.', 12),
(26, 'Latest Product 2024', 'This is an example product.', 34.89),
(27, 'Latest Product 2024', 'This is an example product.', 89.8),
(28, 'Latest Product 2024', 'This is an example product.', 89.8),
(29, 'Latest Product 2024', 'This is an example product.', 90.89),
(30, 'Latest Product 2024', 'This is an example product.', 90.89),
(31, 'Latest Product 2024', 'This is an example product.', 90.89),
(32, 'Latest Product 2024', 'This is an example product.', 90.89),
(33, 'Latest Product 2024', 'This is an example product.', 90.89);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, 'amjad@gmail.com', '[]', '$2y$13$txIjlpfR6ybf.aVgIjTfZO0Dh0IHQ4wZM37MFrgGX2wd4oRgXbPrK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
