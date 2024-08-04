-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2024 at 04:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoes_haven`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `user_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `product_id` int(11) NOT NULL,
  `product_size` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cust_id` int(11) NOT NULL,
  `cust_mobile` varchar(20) NOT NULL,
  `cust_adress` varchar(150) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `cust_mobile`, `cust_adress`, `user_id`) VALUES
(1, '0797085792', 'street_salah_aldin', 2),
(2, '0798457931', 'al_quds_street', 3),
(3, '0798457481', 'basman_street', 4),
(4, '0798985421', 'al_sharef shaker ben zayed street', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `or_id` int(11) NOT NULL,
  `or_date` date NOT NULL DEFAULT current_timestamp(),
  `or_status` varchar(150) NOT NULL DEFAULT 'pending',
  `cust_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`or_id`, `or_date`, `or_status`, `cust_id`) VALUES
(1, '2024-08-08', 'pending', 1),
(2, '2024-09-06', 'completed', 1),
(3, '2024-08-04', 'pending', 2),
(4, '2024-08-04', 'pending', 1),
(5, '2024-08-04', 'pending', 1),
(6, '2024-08-04', 'pending', 1),
(7, '2024-08-04', 'pending', 1),
(8, '2024-08-04', 'pending', 1),
(9, '2024-08-04', 'pending', 1),
(10, '2024-08-04', 'pending', 1),
(11, '2024-08-04', 'pending', 1),
(12, '2024-08-04', 'pending', 1),
(13, '2024-08-04', 'pending', 1),
(14, '2024-08-04', 'pending', 1),
(15, '2024-08-04', 'pending', 1),
(16, '2024-08-04', 'pending', 1),
(17, '2024-08-04', 'pending', 1),
(18, '2024-08-04', 'pending', 1),
(19, '2024-08-04', 'pending', 1),
(20, '2024-08-04', 'pending', 1),
(21, '2024-08-04', 'pending', 1),
(28, '2024-08-04', 'pending', 1),
(29, '2024-08-04', 'pending', 1),
(30, '2024-08-04', 'pending', 1),
(31, '2024-08-04', 'pending', 1),
(32, '2024-08-04', 'pending', 1),
(33, '2024-08-04', 'pending', 1),
(34, '2024-08-04', 'pending', 1),
(35, '2024-08-04', 'pending', 1),
(36, '2024-08-04', 'pending', 1),
(37, '2024-08-04', 'pending', 1),
(38, '2024-08-04', 'pending', 1),
(39, '2024-08-04', 'pending', 1),
(40, '2024-08-04', 'pending', 1),
(41, '2024-08-04', 'pending', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `orferdetails_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `or_id` int(11) DEFAULT NULL,
  `shoe_size` int(11) DEFAULT 36
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`orferdetails_id`, `product_id`, `or_id`, `shoe_size`) VALUES
(1, 7, 1, 36),
(2, 6, 1, 36),
(3, 8, 1, 36),
(4, 1, 1, 36),
(5, 10, 1, 36),
(6, 1, 2, 36),
(7, 7, 2, 36),
(8, 1, 2, 36),
(9, 9, 2, 36),
(10, 7, 32, 36),
(11, 7, 32, 43),
(12, 7, 32, 40),
(13, 7, 33, 36),
(14, 7, 33, 43),
(15, 7, 33, 40),
(16, 7, 34, 36),
(17, 7, 34, 43),
(18, 7, 34, 40),
(19, 7, 35, 36),
(20, 7, 35, 43),
(21, 7, 35, 40),
(22, 7, 36, 36),
(23, 7, 36, 43),
(24, 7, 36, 40),
(25, 7, 37, 36),
(26, 7, 37, 43),
(27, 7, 37, 40),
(28, 7, 38, 36),
(29, 7, 38, 43),
(30, 7, 38, 40),
(31, 7, 39, 36),
(32, 7, 39, 43),
(33, 7, 39, 40),
(34, 7, 40, 36),
(35, 7, 40, 36),
(36, 7, 40, 36),
(37, 7, 40, 36),
(38, 7, 41, 36),
(39, 7, 41, 36);

-- --------------------------------------------------------

--
-- Table structure for table `poduct_media`
--

CREATE TABLE `poduct_media` (
  `Pme_id` int(11) NOT NULL,
  `Pme_name` varchar(255) NOT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poduct_media`
--

INSERT INTO `poduct_media` (`Pme_id`, `Pme_name`, `product_id`) VALUES
(2, '1685511177c1bafc7dbb7c9e259ea3ea2c85fe0a86_thumbnail_900x.jpg', 1),
(3, '16855111698e0b383617e1ef68ae24dd1e1aab0760_thumbnail_900x.jpg', 1),
(4, 'Screenshot 2024-07-31 123707.png', 1),
(5, '1705317042fd84060a79ecf2dd4167b418829e9217_thumbnail_900x.jpg', 6),
(6, '170531704269003b0ca64fda70180a7c548068dbba_thumbnail_900x.jpg', 6),
(7, '17053170426c8f225cd74d57e0138b195377e1022c_thumbnail_900x.jpg', 6),
(8, '1713148386ae2fc74d46a7db76f9baabb28c279878.webp', 7),
(9, '1713148386cff62bb8030629d138dba2202b2fef16.webp', 7),
(10, '17131483866237487cea67abf33104ecd65c57b985.jpg', 7),
(11, '1714535950a8142f6a6e7559d6cdf4afca02e77783.jpg', 8),
(12, '1714535950f972de450641717e5c9d42ae93d1b319.jpg', 8),
(13, '1714535949d16fa62164fc547a234caa125b3c83b8.jpg', 8),
(14, '171439322064971eb6a0306bf738d57a25cfdfed3e.jpg', 9),
(15, '1714393234a1cbfb14860e8657145053461348c970.jpg', 9),
(16, '1714393228f3b30645af58437f3c40738ee474f8b0.webp', 9),
(17, '1700042881d7a0a3e1bd9845b95939e1d4684b6fe2.webp', 10),
(18, '1700042866a7a500dcf106581ce87d1f882b617ed2.webp', 10),
(19, '170004287035541299a252c447a3b68bb625fd4361.webp', 10);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sel_id` int(11) DEFAULT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `price`, `sel_id`, `status`) VALUES
(1, 'Women Buckle Decor Square Toe Chunky Heeled Slingback Pumps', 'Color:\r\nBlack\r\nPattern Type:\r\nPlain, Plants\r\nHeel Height:\r\nLow Heel (4cm/1.6inch)\r\nSize Fit:\r\nTrue To Size\r\nUpper Material:\r\nPatent Leather\r\nLining Material:\r\nPU Leather ', 20.00, NULL, b'1'),
(6, 'Fashionable Black Mesh Glossy Formal Shoes ', 'Color:\r\nBlack\r\nPattern Type:\r\nPlain\r\nSize Fit:\r\nOne Size Smaller\r\nUpper Material:\r\nPU Leather\r\nInsole Material:\r\nPU Leather\r\nOutsole Material:\r\nRubber ', 16.58, NULL, b'1'),
(7, 'Casual Shoes Korean Style Trendy Slip-On Slouchy Shoes', 'Color:\r\nBeige\r\nToe:\r\nRound Toe\r\nPattern Type:\r\nPlain\r\nUpper Material:\r\nFabric\r\nInsole Material:\r\nCanvas\r\nOutsole Material:\r\nPU Leather', 11.40, NULL, b'1'),
(8, 'Women\'s Peep Toe Chunky/Low Heel Dress Party Versatile Sandals', 'Details:\r\nColor:\r\nChampagne\r\nPattern Type:\r\nPlain\r\nStrap Type:\r\nAnkle Strap\r\nHeel Height:\r\nFlat (3cm/1.2inch)\r\nComposition:\r\n100% Polyurethane\r\nMaterial:\r\nPU Leather ', 15.10, NULL, b'1'),
(9, 'Silver Shimmering Fashionable Stiletto High Heel Sandals', 'Color:\r\nGold\r\nToe:\r\nOpen Toe\r\nPattern Type:\r\nColorblock, Plain\r\nStrap Type:\r\nAnkle Strap\r\nHeel Height:\r\nHigh Heel (9.5cm/3.7inch)\r\nSize Fit:\r\nTrue To Size\r\nUpper Material:\r\nSuedette\r\nLining Material:\r\nPU Leather', 17.17, NULL, b'1'),
(10, 'Women\'s High Heel Sandals With Waterproof Platform', 'Style:\r\nElegant\r\nColor:\r\nBlack\r\nToe:\r\nOpen Toe\r\nPattern Type:\r\nColorblock, Plain\r\nStrap Type:\r\nAnkle Strap\r\nHeels:\r\nChunky\r\nHeel Height:\r\nHigh Heel (9.5cm/3.7inch)', 16.18, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `product_tags`
--

CREATE TABLE `product_tags` (
  `product_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_tags`
--

INSERT INTO `product_tags` (`product_id`, `tag_id`) VALUES
(1, 1),
(1, 4),
(6, 1),
(7, 1),
(8, 1),
(8, 4),
(9, 4),
(10, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `sel_id` int(11) NOT NULL,
  `sel_mobile` varchar(20) NOT NULL,
  `sel_adress` varchar(150) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`sel_id`, `sel_mobile`, `sel_adress`, `user_id`) VALUES
(1, '0798985421', 'al_sharef shaker ben zayed street', 5);

-- --------------------------------------------------------

--
-- Table structure for table `shoe_sizes`
--

CREATE TABLE `shoe_sizes` (
  `product_id` int(11) NOT NULL,
  `shoe_size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shoe_sizes`
--

INSERT INTO `shoe_sizes` (`product_id`, `shoe_size`) VALUES
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(255) DEFAULT NULL,
  `sale_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `featured` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`, `sale_amount`, `featured`) VALUES
(1, 'Formal', 0.00, b'1'),
(2, 'Old-Money', 0.00, b'0'),
(3, 'Casual', 0.00, b'0'),
(4, 'heels', 0.00, b'1'),
(8, 'men', 0.00, b'0'),
(9, 'women', 0.00, b'0'),
(10, 'baby', 0.00, b'0'),
(11, 'sport', 0.00, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `testimonails`
--

CREATE TABLE `testimonails` (
  `tes_id` int(11) NOT NULL,
  `test_name` varchar(255) DEFAULT NULL,
  `test_comment` varchar(255) DEFAULT NULL,
  `test_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(55) NOT NULL,
  `last_name` varchar(55) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `user_email`, `password`) VALUES
(1, 'ayah', 'hillawi', 'ayahhillawi9@gmail.com', 'ayha11_'),
(2, 'ahmad', 'khallaf', 'ahamadkallahf@gmail.com', 'ahamd12er'),
(3, 'sami', 'sawalqa', 'samiswalqa2@gmail.com', 'sami1w3'),
(4, 'heba', 'samaheen', 'hebasamaheen4@gmail.com', 'heba55'),
(5, 'abdallah', 'hatamleh', 'abdallahhatamleh@gmail.com', 'abd23451');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`or_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`orferdetails_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `or_id` (`or_id`);

--
-- Indexes for table `poduct_media`
--
ALTER TABLE `poduct_media`
  ADD PRIMARY KEY (`Pme_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `sel_id` (`sel_id`);

--
-- Indexes for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD PRIMARY KEY (`product_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`sel_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `shoe_sizes`
--
ALTER TABLE `shoe_sizes`
  ADD PRIMARY KEY (`product_id`,`shoe_size`),
  ADD UNIQUE KEY `shoe_size` (`shoe_size`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `testimonails`
--
ALTER TABLE `testimonails`
  ADD PRIMARY KEY (`tes_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `or_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `orferdetails_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `poduct_media`
--
ALTER TABLE `poduct_media`
  MODIFY `Pme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `sel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `testimonails`
--
ALTER TABLE `testimonails`
  MODIFY `tes_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `customers` (`cust_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`or_id`) REFERENCES `orders` (`or_id`);

--
-- Constraints for table `poduct_media`
--
ALTER TABLE `poduct_media`
  ADD CONSTRAINT `poduct_media_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`sel_id`) REFERENCES `sellers` (`sel_id`);

--
-- Constraints for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD CONSTRAINT `product_tags_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `product_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`);

--
-- Constraints for table `sellers`
--
ALTER TABLE `sellers`
  ADD CONSTRAINT `sellers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `shoe_sizes`
--
ALTER TABLE `shoe_sizes`
  ADD CONSTRAINT `shoe_sizes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
