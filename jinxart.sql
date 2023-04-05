-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: vallelonga.iad1-mysql-e2-1a.dreamhost.com
-- Generation Time: Jul 03, 2022 at 04:08 PM
-- Server version: 8.0.28-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jinxart`
--

-- --------------------------------------------------------

--
-- Table structure for table `bought_nft`
--

CREATE TABLE `bought_nft` (
  `id_user` int NOT NULL,
  `id_nft` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name_cat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name_cat`) VALUES
(1, 'art'),
(2, 'photo'),
(3, 'music'),
(4, 'sport');

-- --------------------------------------------------------

--
-- Table structure for table `chain`
--

CREATE TABLE `chain` (
  `id` int NOT NULL,
  `name_chain` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chain`
--

INSERT INTO `chain` (`id`, `name_chain`) VALUES
(1, 'ethereum'),
(2, 'bitcoin');

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `id` int NOT NULL,
  `id_order` varchar(255) NOT NULL,
  `id_user` int NOT NULL,
  `id_nft` int NOT NULL,
  `amount` float NOT NULL,
  `payed_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `liked_nft`
--

CREATE TABLE `liked_nft` (
  `id_user` int NOT NULL,
  `id_nft` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nft`
--

CREATE TABLE `nft` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `quantity` int NOT NULL,
  `likes` int NOT NULL,
  `id_user` int NOT NULL,
  `id_category` int NOT NULL,
  `id_chain` int NOT NULL,
  `dir_nft` varchar(255) NOT NULL,
  `ipfs` varchar(255) NOT NULL,
  `minted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nft`
--

INSERT INTO `nft` (`id`, `name`, `description`, `price`, `quantity`, `likes`, `id_user`, `id_category`, `id_chain`, `dir_nft`, `ipfs`, `minted_at`) VALUES
(22, 'stylish', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 3, 2, 0, 6, 1, 2, '62923b4768a35-1653750599.jpg', 'bafkreibzyp7tonqd3cyoslq64zjhjj4bapaz363ksjjn5zegy5unwxnzdu', NULL),
(23, 'miamm', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 0.15, 3, 0, 6, 2, 1, '629242657b773-1653752421.jpeg', 'bafkreiczxelxscrd3ow5g3lyxeb23wftveyvka5ii7xdhp65te7izhu5am', NULL),
(24, 'LOGO', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor si', 0.17, 2, 0, 6, 4, 1, '62926836dbf1e-1653762102.jpg', 'bafkreiatwcmaxn3rgt2x273epauqtrhlik6owf7hrcpn74j5jhtambv4ci', NULL),
(26, 'MyPC', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 0.09, 5, 0, 6, 2, 2, '629c04851d69f-1654391941.jpg', 'bafybeignxb76bqtf32ndixtihfj2zpzfnepd2lxgnkwq6sfq4aoooruzee', '2022-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `nft_pending`
--

CREATE TABLE `nft_pending` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `quantity` int NOT NULL,
  `likes` int NOT NULL,
  `id_user` int NOT NULL,
  `id_category` int NOT NULL,
  `id_chain` int NOT NULL,
  `dir_nft` varchar(255) NOT NULL,
  `status` enum('review','denied','approved') NOT NULL DEFAULT 'review',
  `message` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nft_pending`
--

INSERT INTO `nft_pending` (`id`, `name`, `description`, `price`, `quantity`, `likes`, `id_user`, `id_category`, `id_chain`, `dir_nft`, `status`, `message`) VALUES
(9, 'miam', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 0.15, 3, 0, 6, 2, 1, '629242657b773-1653752421.jpeg', 'approved', ''),
(10, 'LOGO', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor si', 0.17, 2, 0, 6, 4, 1, '62926836dbf1e-1653762102.jpg', 'approved', NULL),
(11, 'GREAT4.0', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English', 0.2, 5, 0, 6, 3, 1, '629a335530eb6-1654272853.jpg', 'approved', NULL),
(12, 'MyPC', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 0.09, 5, 0, 6, 2, 2, '629c04851d69f-1654391941.jpg', 'approved', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_dir` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `profile_dir`, `isAdmin`) VALUES
(1, 'anis', 'anishachi60@gmail.com', 'anis', 'default.jpg', 0),
(2, 'hachi', 'newwayanishachi@gmail.com', 'hachi', 'default.jpg', 0),
(3, 'kan_akka', 'anis_hachi@outlook.com', '34d8dabe68db6b2ba1d511086b599af0', 'default.jpg', 0),
(6, 'an_is', 'abridamaynutanishachi@gmail.com', '45863477d69c878b90b21bb52d4542f1', '629beae2789de-1654385378.png', 0),
(7, 'ha_chi', 'hachianis@gmail.com', '8d0e0547409de475121087a6544f1019', 'default.jpg', 0),
(8, 'admin', 'admin_jinx@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '62c21efff0865-1656889087.png', 1),
(9, 'abdou', 'abdouben@gmail.com', '94fc29f07032172379ed6d29109f5b6a', 'default.jpg', 0),
(10, 'Hanine ', 'hanine@gmail.com', '07f66c619ee3c36dc74201e0210b078b', 'default.jpg', 0),
(11, 'Salem_h', 'hammadisayem@gmail.com', '4e48818bbfbe1c4342732e975ec7eba4', 'default.jpg', 0),
(12, 'hanine', 'haninehanine@gmail.com', '07f66c619ee3c36dc74201e0210b078b', 'default.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bought_nft`
--
ALTER TABLE `bought_nft`
  ADD PRIMARY KEY (`id_user`,`id_nft`),
  ADD KEY `id_nft` (`id_nft`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chain`
--
ALTER TABLE `chain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nft` (`id_nft`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `liked_nft`
--
ALTER TABLE `liked_nft`
  ADD PRIMARY KEY (`id_user`,`id_nft`),
  ADD KEY `id_nft` (`id_nft`);

--
-- Indexes for table `nft`
--
ALTER TABLE `nft`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_chain` (`id_chain`);

--
-- Indexes for table `nft_pending`
--
ALTER TABLE `nft_pending`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_chain` (`id_chain`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chain`
--
ALTER TABLE `chain`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nft`
--
ALTER TABLE `nft`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `nft_pending`
--
ALTER TABLE `nft_pending`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bought_nft`
--
ALTER TABLE `bought_nft`
  ADD CONSTRAINT `bought_nft_ibfk_1` FOREIGN KEY (`id_nft`) REFERENCES `nft` (`id`),
  ADD CONSTRAINT `bought_nft_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_nft`) REFERENCES `nft` (`id`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `liked_nft`
--
ALTER TABLE `liked_nft`
  ADD CONSTRAINT `liked_nft_ibfk_1` FOREIGN KEY (`id_nft`) REFERENCES `nft` (`id`),
  ADD CONSTRAINT `liked_nft_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `nft`
--
ALTER TABLE `nft`
  ADD CONSTRAINT `nft_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `nft_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `nft_ibfk_3` FOREIGN KEY (`id_chain`) REFERENCES `chain` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
