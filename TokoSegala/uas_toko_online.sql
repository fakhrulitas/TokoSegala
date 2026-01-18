-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2026 at 06:43 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas_toko_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_cart`, `id_user`, `id_product`, `qty`) VALUES
(13, 3, 1, 10),
(20, 5, 1, 3),
(21, 5, 11, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `nama_produk`, `kategori`, `harga`, `stok`, `gambar`) VALUES
(1, 'Gaming Mouse', 'Elektronik', 99000, 99, '3ff7d8238c852e8888d987f4634bc7dc.jpeg'),
(2, 'Office Keyboard', 'Elektronik', 100000, 9, 'Robot-RK20.png'),
(3, 'Office Mouse', 'Elektronik', 50000, 100, 'SP00206.jpg'),
(4, 'Gaming Keyboard', 'Elektronik', 500000, 20, 'cb492436-0ef3-4e80-ba1e-b8cd2766b5a5.jpg'),
(5, 'Monitor 24 inch', 'Elektronik', 1599000, 50, 'lenovo_lenovo-24-l24i-30-monitor-eye-comfort-fhd-ultra-slim_full01.png'),
(6, 'TV LED 43 inch', 'Elektronik', 3528000, 15, 'images.png'),
(7, 'Speaker', 'Elektronik', 205000, 88, 'Kanto-YU2-Powered-Desktop-Speakers-Pair-Matte-White_13d6763a-7b2e-4fe9-b5fd-b41be27bbc8f_1.9f18c3af610c2f9f94a8d3546b490dec.png'),
(8, 'In Ear Monitor', 'Elektronik', 382000, 5, 'Headphone-Zone-Moondrop-CHU-II-New-HERO.png'),
(9, 'TWS Earphone Bluetooth', 'Elektronik', 200000, 99, 'Oraimo-MDL-OTW-330-Black-2.png'),
(10, 'Microphone', 'Elektronik', 1250000, 90, 'images.jfif'),
(11, 'Hoodie', 'Pakaian', 100000, 2000, 'Hoodie-A.webp'),
(12, 'Cardigan', 'Pakaian', 200000, 1000, 'images (1).jfif'),
(13, 'Bomber Jacket', 'Pakaian', 200000, 998, '208112415hj_1.webp'),
(15, 'Kaos Wanita', 'Pakaian', 35000, 1000, 'rwzv3knvo7-255-0-1--l.jpg'),
(16, 'Sneakers', 'Pakaian', 120000, 100, '2-1.jpg'),
(17, 'High Heels', 'Pakaian', 200000, 97, '561a6ac3e66bce90620484332370f1c6.png'),
(18, 'Cincin Berlian', 'Perhiasan', 20000000, 10, 'images (3).jfif'),
(19, 'Cincin Perak', 'Perhiasan', 310000, 15, 'images (4).jfif'),
(20, 'Kalung Titanium', 'Perhiasan', 85000, 80, 'hamlin-1669-7660444-1.webp'),
(21, 'Gelang Emas', 'Perhiasan', 3100000, 12, '24.jpg'),
(22, 'Cincin Emas', 'Perhiasan', 3000000, 35, '4-1-e1676440956991.jpg'),
(23, 'Jam Emas', 'Perhiasan', 1050000, 999, 'f8df9515b3a35107ef1278067f45134a.jfif'),
(24, 'Kaos Pria', 'Pakaian', 35000, 99, '1768654783_ginee_20220823162810716_8269475986_800x.webp');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`) VALUES
(2, 'user', '$2y$10$ASDFGH0987654321HASHEDPASSWORD', 'user'),
(3, 'andi', '$2y$10$Z8/HqzThFb2bcT.v46t3aut4YZa8ySTOow/X4bJ2Wm7KoXBRLlUVW', 'user'),
(4, 'admin', '$2y$10$MhECW6Bzzxmgz/qZMEPYoO53uqVB1.Pc1Yetv4BJYzUeqfp42AQ1G', 'admin'),
(5, 'Budi', '$2y$10$f/psBDV6PVnYQ4NNW0aG5O0ACJq0.IGJchIwmLrV126u5x1BpYBZe', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
