-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2020 at 07:30 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodshala`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(10) NOT NULL,
  `name` text NOT NULL,
  `phone` bigint(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` longtext NOT NULL,
  `city` text NOT NULL,
  `Address` varchar(100) NOT NULL,
  `item_id` int(10) NOT NULL,
  `resid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `phone`, `email`, `password`, `city`, `Address`, `item_id`, `resid`) VALUES
(7, 'Siddharth Mourya', 7415274813, 'mouryasiddharth8@gmail.com', '$2y$10$VD27ED6qrAcw2qR27rk0aOHBcmXt2.SRFbedhTD.Izl4lKjiLYAnK', 'Bhopal', 'Hno 101 , Mellon water , Near Paneer Shop, Above kulcha shop , oswald , Bhopal', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` int(10) NOT NULL,
  `description` mediumtext NOT NULL,
  `resid` int(10) NOT NULL,
  `veg` text NOT NULL,
  `file` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `price`, `description`, `resid`, `veg`, `file`) VALUES
(39, 'Mockery Pizza', 120, 'Savory dish of Italian origin consisting of a usually round, flattened base of leavened wheat-based dough topped with tomatoes,', 10, 'Veg', ''),
(40, 'paneer pizza', 78, 'raditional pizza recipe but the toppings is different. the marinated paneer cubes ', 10, 'Veg', ''),
(41, 'sandwich', 80, 'Brown bread, potato, cheddar cheese, cucumber, tomato', 7, 'Veg', ''),
(42, 'Garlic Bread', 100, 'Brown bread, potato, cheddar cheese, cucumber, tomato', 7, 'Veg', ''),
(43, 'rajasthani thali', 120, '2 Off-Beat Roti. With bajra, jowar and makka ', 8, 'Veg', ''),
(44, 'laccha paratha', 130, 'Wheat flour, atta, plain flour, baking soda, sugar', 8, 'Veg', ''),
(45, 'paneer pakode', 50, 'flat bread which is made with just four ingredients, all purpose flour,', 9, 'Veg', ''),
(46, 'pasta', 170, 'flat bread which is made with just four ingredients, all purpose flour,', 9, 'Veg', '');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(10) NOT NULL,
  `resname` text NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` longtext NOT NULL,
  `address` longtext NOT NULL,
  `city` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `resname`, `email`, `password`, `address`, `city`) VALUES
(7, 'Sharma and Vishnu', 'sharma@vishnu.com', '$2y$10$kXgsnfO0bz7vQRx0cVgA9.4214pHUBhg3ygUMZQCKyY/J/Xp3WWXC', 'Bicholi Mardana Behind Hotel President Park, Near, Shreeji Valley Rd, Indore, Madhya Pradesh 452016', 'Indore'),
(8, 'Sagar Gaire', 'sagar@gaire.com', '$2y$10$CoxF1Ngl3KNz3m/bvOC0Uu9SrGLQzRyn6gA5f7Wh3siFAk9Bhz8rq', 'Near, Ground Platinum Plaza 33/34, Mata Mandir Square , Bhopal', 'Bhopal'),
(9, 'Dine Out', 'dine@out.com', '$2y$10$uwawUhzx3dLB4e0zYLZyX.BDdOqPMCVmTQsr8WR/vlPud0r06dJqi', 'Navneet Plaza, UG-8 Old Palasia Near Islamia Karimia College Central Indore 452001.', 'Bhopal'),
(10, 'Sheesha Veesha', 'sheesha@veesha.com', '$2y$10$F0Ue84iyQ2EF0qO3KBwEH.E.BbGc6HObGGNddVG213bzGZ/EaGM2.', 'Aashima Mall, Aashima Mall,, 12, Hoshangabad Rd, Danish Nagar, Bawaria Kalan, Bhopal, Madhya Pradesh 462026', 'Bhopal'),
(11, 'Pizza hut', 'pizza@hut.com', '$2y$10$qKRARMc4fv99pa5TxTFSdOpykgTm1f4LQqoEYMCiWkspIf5um9KBK', 'UG Flr, Vishal Trinity, Sapna Sangeeta Rd, Bhopal', 'Bhopal'),
(12, 'Hotel 4g', 'hotel@4g.com', '$2y$10$m/XF6efcEfLQkmPvhkRtPe569J6rb4wqmpfpHTjzHxD12C5ZR7vjW', 'Anchor No 1, 2nd Floor, Malhar Mega Mall, Bhopal', 'Bhopal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
