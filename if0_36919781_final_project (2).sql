-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql107.infinityfree.com
-- Generation Time: Mar 16, 2025 at 12:57 PM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_36919781_final_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `akashkhurd1702`
--

CREATE TABLE `akashkhurd1702` (
  `id` int(50) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` int(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `akashkhurd1702`
--

INSERT INTO `akashkhurd1702` (`id`, `image`, `brand`, `description`, `price`, `email`) VALUES
(1, '6783a0d92942d.jpeg', 'CottonWorld', 'CottonWorld offers premium-grade cotton fabric that is soft, breathable', 40, 'akashkhurd1702'),
(4, '6783a3d20148c.jpeg', 'SilkElegance', ' SilkElegance offers luxurious silk fabrics with a shimmering finish and unmatched softness', 50, 'akashkhurd1702'),
(3, '6783a15e4a067.jpeg', 'DenimHub', 'DenimHub provides high-quality denim fabric for making jeans, jackets, and casual wear', 34, 'akashkhurd1702'),
(5, '6783a41c0f9e5.jpeg', 'LinenCozy', 'LinenCozy fabric is a breathable and lightweight choice for summer outfits, curtains', 50, 'akashkhurd1702'),
(6, '6783a4623b083.jpeg', 'VelvetLux', 'VelvetLux offers premium velvet fabrics with a rich, textured appearance', 50, 'akashkhurd1702'),
(7, '6783a4e567147.jpeg', 'WoolCraft', 'WoolCraft specializes in high-quality wool fabric thatâ€™s soft, breathable', 30, 'akashkhurd1702'),
(8, '6783a50e14582.jpeg', 'RayonStyle', 'RayonStyle offers smooth, silky fabrics ideal for casual and semi-formal clothing', 30, 'akashkhurd1702'),
(11, '6783a677767cf.jpeg', 'TweedTrend', 'CanvasKing provides thick, durable fabric ideal for tote bags, upholstery, and outdoor use', 70, 'akashkhurd1702');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(50) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` varchar(50) NOT NULL,
  `product` varchar(50) NOT NULL,
  `value1` varchar(255) NOT NULL,
  `value2` varchar(255) NOT NULL,
  `value3` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `onkarmaheshan`
--

CREATE TABLE `onkarmaheshan` (
  `id` int(50) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` int(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `onkarmaheshan`
--

INSERT INTO `onkarmaheshan` (`id`, `image`, `brand`, `description`, `price`, `email`) VALUES
(1, '678e84fc55b3e.jpeg', 'Denim', 'Denim is a sturdy, woven cotton fabric thatâ€™s synonymous with casual and edgy styles.', 50, 'onkarmaheshan'),
(2, '678e8529980be.jpeg', 'Denim is a sturdy, woven cotton fabric thatâ€™s sy', 'Chiffon is a sheer, lightweight fabric known for its flowy and airy feel.', 40, 'onkarmaheshan'),
(3, '678e8560b5242.jpeg', 'Satin', 'Satin is a glossy, smooth fabric that exudes luxury. Perfect for pencil or midi skirts.', 60, 'onkarmaheshan'),
(4, '678e858f59a5c.jpeg', 'Tulle', 'Tulle is a net-like fabric that creates a voluminous and whimsical effect.', 70, 'onkarmaheshan');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` int(50) NOT NULL,
  `shop_email` varchar(500) DEFAULT 'null',
  `brand` varchar(50) DEFAULT 'null',
  `description` varchar(500) DEFAULT 'null',
  `quantity` varchar(50) DEFAULT 'null',
  `measurement1` int(50) DEFAULT NULL,
  `measurement2` int(50) DEFAULT NULL,
  `measurement3` int(50) DEFAULT NULL,
  `measurement4` int(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `addresss` varchar(500) DEFAULT NULL,
  `image` varchar(100) DEFAULT 'null',
  `status` varchar(50) NOT NULL DEFAULT 'Processing',
  `gender` varchar(50) DEFAULT 'null',
  `clothing_type` varchar(50) DEFAULT 'null'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `shop_email`, `brand`, `description`, `quantity`, `measurement1`, `measurement2`, `measurement3`, `measurement4`, `phone`, `addresss`, `image`, `status`, `gender`, `clothing_type`) VALUES
(144, 'onkarmaheshan@gmail.com', 'Lacoste', 'Lacosteâ€™s Signature Polo Shirt redefines casual luxury with its breathable cotton', '1', NULL, NULL, NULL, NULL, '7020214496', 'Namdev Chowk', 'null', 'Processing', 'null', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `ready_made_product`
--

CREATE TABLE `ready_made_product` (
  `id` int(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` int(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `size` varchar(500) NOT NULL,
  `sname` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ready_made_product`
--

INSERT INTO `ready_made_product` (`id`, `image`, `brand`, `description`, `price`, `email`, `size`, `sname`) VALUES
(44, '678d513310e3e.jpeg', 'Zara', 'Spanish brand offering trendy shirts in a variety of styles for all occasions.', 599, 'akashkhurd1702', 'For this size, the chest measurement typically ranges from 50 to 52 inches, and the waist measurement falls between 44 and 46 inches. The sleeve length for XXL shirts usually spans from 36 to 37 inches, providing adequate length for most individuals in this size category. Shirts in this size are designed to ensure a relaxed, loose fit.', 'Ak Tailors'),
(53, '678e836199d35.jpeg', 'Zara', 'Zaraâ€™s Pleated Midi Skirt combines elegance with contemporary style', 799, 'akashkhurd1702', 'For this size, the chest measurement typically ranges from 50 to 52 inches, and the waist measurement falls between 44 and 46 inches. The sleeve length for XXL shirts usually spans from 36 to 37 inches, providing adequate length for most individuals in this size category. Shirts in this size are designed to ensure a relaxed, loose fit.', 'Ak Tailors'),
(52, '678e82f7ca00f.jpeg', 'Classic Threads', 'Elevate your everyday style with the Premium Cotton Casual Shirt from Classic Threads.', 799, 'akashkhurd1702', 'For this size, the chest measurement typically ranges from 50 to 52 inches, and the waist measurement falls between 44 and 46 inches. The sleeve length for XXL shirts usually spans from 36 to 37 inches, providing adequate length for most individuals in this size category. Shirts in this size are designed to ensure a relaxed, loose fit.', 'Ak Tailors'),
(51, '678e820fdb012.jpeg', 'Classic Threads', 'Elevate your everyday style with the Premium Cotton Casual Shirt from Classic Threads.', 799, 'akashkhurd1702', 'For this size, the chest measurement typically ranges from 50 to 52 inches, and the waist measurement falls between 44 and 46 inches. The sleeve length for XXL shirts usually spans from 36 to 37 inches, providing adequate length for most individuals in this size category. Shirts in this size are designed to ensure a relaxed, loose fit.', 'Ak Tailors'),
(54, '678e83c28d817.jpeg', 'H&M', 'H&Mâ€™s A-Line Denim Skirt is a versatile wardrobe staple. Made from sturdy cotton denim.', 688, 'akashkhurd1702', 'For this size, the chest measurement typically ranges from 50 to 52 inches, and the waist measurement falls between 44 and 46 inches. The sleeve length for XXL shirts usually spans from 36 to 37 inches, providing adequate length for most individuals in this size category. Shirts in this size are designed to ensure a relaxed, loose fit.', 'Ak Tailos'),
(55, '678e840cbf750.jpeg', 'Uniqlo', 'The Uniqlo Chiffon Pant offers effortless style with its airy, layered fabric and elastic waistband', 799, 'akashkhurd1702', 'For this size, the chest measurement typically ranges from 50 to 52 inches, and the waist measurement falls between 44 and 46 inches. The sleeve length for XXL shirts usually spans from 36 to 37 inches, providing adequate length for most individuals in this size category. Shirts in this size are designed to ensure a relaxed, loose fit.', 'Ak Tailors'),
(56, '678e85e9c6c8b.jpeg', 'Lacoste', ' Lacosteâ€™s Signature Polo Shirt redefines casual luxury with its breathable cotton.', 679, 'onkarmaheshan', 'For this size, the chest measurement typically ranges from 50 to 52 inches, and the waist measurement falls between 44 and 46 inches. The sleeve length for XXL shirts usually spans from 36 to 37 inches, providing adequate length for most individuals in this size category. Shirts in this size are designed to ensure a relaxed, loose fit.', 'Ok Tailors'),
(57, '678e865c14b87.jpeg', 'Ralph Lauren', 'Ralph Laurenâ€™s Wrap Maxi Skirt is a sophisticated piece made from soft crepe fabric.', 599, 'onkarmaheshan', 'For this size, the chest measurement typically ranges from 50 to 52 inches, and the waist measurement falls between 44 and 46 inches. The sleeve length for XXL shirts usually spans from 36 to 37 inches, providing adequate length for most individuals in this size category. Shirts in this size are designed to ensure a relaxed, loose fit.', 'Ok Tailors'),
(58, '678e86a3a89aa.jpeg', 'Gap', 'Gapâ€™s Corduroy Mini Pant brings a retro vibe to modern wardrobes.', 569, 'onkarmaheshan', 'For this size, the chest measurement typically ranges from 50 to 52 inches, and the waist measurement falls between 44 and 46 inches. The sleeve length for XXL shirts usually spans from 36 to 37 inches, providing adequate length for most individuals in this size category. Shirts in this size are designed to ensure a relaxed, loose fit.', 'Ok Tailors'),
(59, '678e86d1c836b.jpeg', 'Abercrombie & Fitch', ' Abercrombie & Fitchâ€™s Tiered Ruffle Skirt is flirty and fun, featuring layered ruffles.', 799, 'onkarmaheshan', 'For this size, the chest measurement typically ranges from 50 to 52 inches, and the waist measurement falls between 44 and 46 inches. The sleeve length for XXL shirts usually spans from 36 to 37 inches, providing adequate length for most individuals in this size category. Shirts in this size are designed to ensure a relaxed, loose fit.', 'Ok Tailors'),
(60, '678e8746926ed.jpeg', 'Tommy Hilfiger', 'Known for its preppy style, the Tommy Hilfiger Classic Button-Up Shirt features.', 688, 'onkarmaheshan', 'For this size, the chest measurement typically ranges from 50 to 52 inches, and the waist measurement falls between 44 and 46 inches. The sleeve length for XXL shirts usually spans from 36 to 37 inches, providing adequate length for most individuals in this size category. Shirts in this size are designed to ensure a relaxed, loose fit.', 'Ok Tailors'),
(61, '678e87749072d.jpeg', 'Leviâ€™s', ' Leviâ€™s Denim Shirt delivers a rugged charm with its faded wash.', 799, 'onkarmaheshan', 'For this size, the chest measurement typically ranges from 50 to 52 inches, and the waist measurement falls between 44 and 46 inches. The sleeve length for XXL shirts usually spans from 36 to 37 inches, providing adequate length for most individuals in this size category. Shirts in this size are designed to ensure a relaxed, loose fit.', 'Ok Tailors'),
(62, '678e87a97522f.jpeg', 'Lacoste', 'Lacosteâ€™s Signature Polo Shirt redefines casual luxury with its breathable cotton', 699, 'onkarmaheshan', 'For this size, the chest measurement typically ranges from 50 to 52 inches, and the waist measurement falls between 44 and 46 inches. The sleeve length for XXL shirts usually spans from 36 to 37 inches, providing adequate length for most individuals in this size category. Shirts in this size are designed to ensure a relaxed, loose fit.', 'Ok Tailors'),
(63, '678e87f112e1c.jpeg', 'Abercrombie & Fitch', 'Abercrombie & Fitchâ€™s Flannel Shirt features cozy, brushed cotton in timeless plaid patterns.', 689, 'onkarmaheshan', 'For this size, the chest measurement typically ranges from 50 to 52 inches, and the waist measurement falls between 44 and 46 inches. The sleeve length for XXL shirts usually spans from 36 to 37 inches, providing adequate length for most individuals in this size category. Shirts in this size are designed to ensure a relaxed, loose fit.', 'Ok Tailors');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` int(50) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `addresss` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `amount` int(50) NOT NULL,
  `transaction` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `sname`, `country`, `addresss`, `phone`, `email`, `password`, `amount`, `transaction`) VALUES
(50, 'Ak Tailors', 'india', 'namdev chowk, pipeline road, savedi, ahmednagar.', '7020214496', 'akashkhurd1702@gmail.com', '12345678', 3500, 'akash12345678'),
(55, 'Ok Tailors', 'india', 'Shramik nagar, savedi, ahmednagar.', '8010480463', 'onkarmaheshan@gmail.com', '12345678', 1000, 'ok1234');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `phone`, `email`, `password`) VALUES
(18, 'onkar', 'maheshan', '8010480463', 'onkarmaheshan@gmail.com', '12345678'),
(14, 'akash', 'khurd', '7020214496', 'akashkhurd1702@gmail.com', '12345678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akashkhurd1702`
--
ALTER TABLE `akashkhurd1702`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onkarmaheshan`
--
ALTER TABLE `onkarmaheshan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ready_made_product`
--
ALTER TABLE `ready_made_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akashkhurd1702`
--
ALTER TABLE `akashkhurd1702`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `onkarmaheshan`
--
ALTER TABLE `onkarmaheshan`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `ready_made_product`
--
ALTER TABLE `ready_made_product`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
