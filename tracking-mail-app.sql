-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2021 at 07:21 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tracking-mail-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(500) NOT NULL,
  `file_id` int(11) NOT NULL,
  `is_read` int(11) NOT NULL,
  `deleted_in_from` int(11) NOT NULL,
  `deleted_in_to` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `is_active` int(1) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `is_active`, `gambar`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', '$2y$10$L.m0xhcsoTf3UJrbk6HL/OypryEB0VesZ1h9KTMqLkwmEob82XHXi', 1, 'undraw_profile.svg', 'Admin', '2021-09-27 15:47:59', '2021-09-27 15:47:59'),
(7, 'Pranata', 'pranata', '$2y$10$odJcCUpS4kL316rkIrHJlO0pgzrKf3BH2.PA1MBGNbLsabPGMVY8G', 1, 'undraw_profile.svg', 'Pranata', '2021-09-28 18:28:08', '2021-09-29 11:14:32'),
(8, 'Konseptor', 'konseptor', '$2y$10$xceQ7FmIdbtQUyTXd.Jefe2iegoVaru948/eQnhExtwLBm4kqXGqe', 1, 'undraw_profile.svg', 'Konseptor', '2021-09-28 18:28:31', '2021-09-28 18:28:31'),
(9, 'Eselon 3', 'eselon3', '$2y$10$UvfoHGXR5iRmpQR9fMAIqed20EvWVH82VZ5TEm5K7IVNH9U.FI4ZG', 1, 'undraw_profile.svg', 'Eselon 3', '2021-09-29 11:14:21', '2021-09-29 11:14:21'),
(10, 'Eselon 4', 'eselon4', '$2y$10$TX4QIGESWZZj5KRFz2vXR.STMYfVn4cAvERP2/JJeLyZstamzLCGy', 1, 'undraw_profile.svg', 'Eselon 4', '2021-09-29 11:14:46', '2021-09-29 11:14:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
