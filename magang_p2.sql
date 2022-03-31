-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2022 at 06:30 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magang_p2`
--

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--

CREATE TABLE `bulan` (
  `id` int(11) NOT NULL,
  `bulan` varchar(128) NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bulan`
--

INSERT INTO `bulan` (`id`, `bulan`, `nominal`) VALUES
(1, 'January', 5000),
(2, 'February', 7000),
(3, 'March', 10000),
(4, 'April', 12000),
(5, 'May', 8000),
(6, 'June', 6000),
(7, 'July', 13000),
(8, 'August', 15000),
(9, 'September', 11000),
(10, 'October', 17000),
(11, 'November', 9000),
(12, 'December', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `data_iuran`
--

CREATE TABLE `data_iuran` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `bulan_id` int(11) NOT NULL,
  `tahun_id` int(11) NOT NULL,
  `metode_id` int(11) NOT NULL,
  `status` varchar(125) NOT NULL,
  `tgl_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_iuran`
--

INSERT INTO `data_iuran` (`id`, `user_id`, `nominal`, `bulan_id`, `tahun_id`, `metode_id`, `status`, `tgl_bayar`) VALUES
(1, 3, 7000, 2, 10, 1, 'Lunas', '2022-02-28'),
(2, 4, 7000, 1, 10, 1, 'Lunas', '2022-03-01'),
(16, 3, 10000, 1, 10, 1, 'Lunas', '2022-03-02'),
(18, 3, 10000, 3, 10, 1, 'Lunas', '2022-03-03'),
(19, 3, 12000, 4, 10, 1, 'Lunas', '2022-03-07'),
(22, 4, 12000, 4, 10, 1, 'Lunas', '2022-03-08'),
(23, 4, 7000, 2, 10, 1, 'Lunas', '2022-03-08'),
(24, 4, 10000, 3, 10, 1, 'Lunas', '2022-03-08'),
(25, 4, 8000, 5, 10, 1, 'Lunas', '2022-03-08'),
(26, 3, 8000, 5, 10, 1, 'Lunas', '2022-03-08'),
(27, 3, 6000, 6, 10, 1, 'Lunas', '2022-03-08'),
(28, 4, 6000, 6, 10, 1, 'Lunas', '2022-03-08'),
(30, 5, 10000, 3, 10, 1, 'Lunas', '2022-03-09'),
(31, 3, 13000, 7, 10, 1, 'Lunas', '2022-03-09'),
(35, 4, 13000, 7, 10, 1, 'Lunas', '2022-03-11'),
(36, 5, 5000, 1, 10, 1, 'Lunas', '2022-03-11'),
(37, 5, 7000, 2, 10, 1, 'Lunas', '2022-03-11'),
(38, 5, 12000, 4, 10, 1, 'Lunas', '2022-03-11'),
(39, 5, 8000, 5, 10, 1, 'Lunas', '2022-03-11'),
(40, 5, 6000, 6, 10, 1, 'Lunas', '2022-03-11'),
(41, 5, 13000, 7, 10, 1, 'Lunas', '2022-03-11'),
(42, 3, 15000, 8, 10, 1, 'Lunas', '2022-03-12'),
(43, 5, 15000, 8, 10, 1, 'Lunas', '2022-03-14'),
(44, 3, 17000, 10, 10, 1, 'Lunas', '2022-03-14'),
(45, 3, 11000, 9, 10, 1, 'Lunas', '2022-03-14'),
(47, 5, 11000, 9, 10, 1, 'Lunas', '2022-03-16'),
(48, 5, 17000, 10, 10, 1, 'Lunas', '2022-03-16'),
(49, 4, 15000, 8, 10, 1, 'Lunas', '2022-03-16'),
(50, 4, 11000, 9, 10, 1, 'Lunas', '2022-03-16'),
(60, 5, 9000, 11, 10, 1, 'Lunas', '2022-03-16'),
(64, 5, 10000, 12, 10, 1, 'Lunas', '2022-03-17'),
(65, 3, 9000, 11, 10, 1, 'Lunas', '2022-03-17'),
(66, 4, 17000, 10, 10, 2, 'Lunas', '2022-03-18'),
(67, 4, 9000, 11, 10, 1, 'Lunas', '2022-03-18'),
(76, 3, 10000, 12, 10, 1, 'Lunas', '2022-03-25'),
(82, 4, 10000, 12, 10, 1, 'Lunas', '2022-03-26');

-- --------------------------------------------------------

--
-- Table structure for table `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id` int(11) NOT NULL,
  `metode_db` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`id`, `metode_db`) VALUES
(1, 'Online'),
(2, 'Offline');

-- --------------------------------------------------------

--
-- Table structure for table `pendapatan_bulan`
--

CREATE TABLE `pendapatan_bulan` (
  `id` int(11) NOT NULL,
  `pendapatan` int(11) NOT NULL,
  `bulan_id` int(11) NOT NULL,
  `tahun_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendapatan_bulan`
--

INSERT INTO `pendapatan_bulan` (`id`, `pendapatan`, `bulan_id`, `tahun_id`) VALUES
(1, 22000, 1, 10),
(2, 21000, 2, 10),
(3, 30000, 3, 10),
(4, 36000, 4, 10),
(5, 24000, 5, 10),
(6, 18000, 6, 10),
(7, 39000, 7, 10),
(8, 45000, 8, 10),
(9, 51000, 10, 10),
(10, 33000, 9, 10),
(11, 27000, 11, 10),
(12, 30000, 12, 10),
(20, 18000, 1, 19);

-- --------------------------------------------------------

--
-- Table structure for table `tahun`
--

CREATE TABLE `tahun` (
  `id` int(11) NOT NULL,
  `tahun_db` year(4) NOT NULL,
  `pendapatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tahun`
--

INSERT INTO `tahun` (`id`, `tahun_db`, `pendapatan`) VALUES
(10, 2022, 376000),
(19, 2023, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Ahmad Dani', 'ahmaddani@gmail.com', 'defauld1.jpg', '$2y$10$vNYARyIGOcKJWU2G5de7RODGoVSsEFoAy9jXmMR/aGPOYKGVvO.bK', 1, 1, 1645670360),
(3, 'Adit', 'adit@gmail.com', 'adit1.png', '$2y$10$L5AV08afhuzMaIiP1Ml1fOM3llzIiNtNN2gDortiH6vbqigeUxZFG', 2, 1, 1646040915),
(4, 'Denis', 'denisgugup@gmail.com', 'denis.jpg', '$2y$10$bzfu3RbQ8o7b6WfhCVGv4OaVNOC4pNqB/nlg1zBcfRj9DuuGqtF8i', 2, 1, 1646102822),
(5, 'Ucup', 'ucup@gmail.com', 'ucup.png', '$2y$10$daryKUOxabK4WeHfsNmCZOgkhovq9H4Z9z4PWK5dEDDEwMrsQKSsK', 2, 1, 1646809908);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3),
(5, 1, 4),
(6, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(4, 'Master'),
(5, 'Iuran');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'Profile Saya', 'user', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'user/editProfile', 'fas fa-fw fa-user-edit', 1),
(4, 2, 'Ubah Sandi', 'user/ubahSandi', 'fas fa-fw fa-key', 1),
(5, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(6, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(7, 4, 'Data User', 'master', 'fas fa-fw fa-users', 1),
(8, 5, 'Pembayaran Iuran', 'iuran', 'fas fa-fw fa-receipt\r\n', 1),
(9, 4, 'Data Iuran', 'master/data_iuran', 'fas fa-fw fa-clipboard-list', 1),
(10, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(16, 4, 'Pengajuan Iuran', 'master/pengajuan', 'fas fa-fw fa-envelope', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_iuran`
--
ALTER TABLE `data_iuran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendapatan_bulan`
--
ALTER TABLE `pendapatan_bulan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tahun`
--
ALTER TABLE `tahun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bulan`
--
ALTER TABLE `bulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `data_iuran`
--
ALTER TABLE `data_iuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pendapatan_bulan`
--
ALTER TABLE `pendapatan_bulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tahun`
--
ALTER TABLE `tahun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
