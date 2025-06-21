-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2025 at 03:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `pwa_projekt` DEFAULT CHARACTER SET utf8 COLLATE utf8_croatian_ci;
USE `pwa_projekt`;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

DROP TABLE IF EXISTS `kategorija`;
DROP TABLE IF EXISTS `story`;
DROP TABLE IF EXISTS `users`;

-- --------------------------------------------------------
-- Table structure for table `kategorija`
-- --------------------------------------------------------

CREATE TABLE `kategorija` (
  `id` int(11) NOT NULL,
  `naziv` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- Dumping data for table `kategorija`

INSERT INTO `kategorija` (`id`, `naziv`) VALUES
(1, 'News'),
(2, 'Politics'),
(3, 'Sport');

-- --------------------------------------------------------
-- Table structure for table `story`
-- --------------------------------------------------------

CREATE TABLE `story` (
  `ID` int(11) NOT NULL,
  `naslov` varchar(32) NOT NULL,
  `sazetak` text NOT NULL,
  `tekst` text NOT NULL,
  `kategorija_id` int(11) NOT NULL,
  `slika` varchar(64) NOT NULL,
  `arhiva` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- Dumping data for table `story`

INSERT INTO `story` (`ID`, `naslov`, `sazetak`, `tekst`, `kategorija_id`, `slika`, `arhiva`) VALUES
(19, 'dfgdfg', 'dfgdfg', 'fdgdfg', 1, '', 0);

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

-- Dumping data for table `users`

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(4, 'admin', '$2y$10$Pgzs20fMVeXwzYSYg1NKReNasuA/JNg8SHm5p3G54lijf25l7LXvq'),
(6, 'proba', '$2y$10$RM77qODIXjeO.vzYkSM3.OQdhipS7rCPA4u/gfK.bY4eu6K3DLTba'),
(7, 'proba123', '$2y$10$v6jXI27sg2EPXWUVOgvTCeaQdQMjx3sBfEIyTJQ0nSrqx6VPALsgq'),
(8, 'a', '$2y$10$kdv7JSPnp6cIc/2q26z.GufyxMXSckiqze4LyiDNW2KQldMcYdTz6');

-- --------------------------------------------------------
-- Indexes for dumped tables
-- --------------------------------------------------------

ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `story`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_kategorija` (`kategorija_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

-- --------------------------------------------------------
-- AUTO_INCREMENT for dumped tables
-- --------------------------------------------------------

ALTER TABLE `kategorija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `story`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

-- --------------------------------------------------------
-- Constraints for dumped tables
-- --------------------------------------------------------

ALTER TABLE `story`
  ADD CONSTRAINT `fk_kategorija` FOREIGN KEY (`kategorija_id`) REFERENCES `kategorija` (`id`) ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
