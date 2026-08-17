-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 09, 2022 at 02:16 PM
-- Server version: 10.3.36-MariaDB-log-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mswomptl_gamersgram`
--

-- --------------------------------------------------------

--
-- Table structure for table `admindetails`
--

CREATE TABLE `admindetails` (
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `lastlogin` timestamp NOT NULL DEFAULT current_timestamp(),
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admindetails`
--

INSERT INTO `admindetails` (`username`, `password`, `lastlogin`, `id`) VALUES
('GamersGram', 'ludo2021', '2021-08-07 18:36:45', 1),
('special', '123456', '2021-08-24 08:37:05', 2);

-- --------------------------------------------------------

--
-- Table structure for table `bankdetails`
--

CREATE TABLE `bankdetails` (
  `userId` int(11) NOT NULL,
  `holderName` text COLLATE utf8_unicode_ci NOT NULL,
  `accountNumber` text COLLATE utf8_unicode_ci NOT NULL,
  `ifsc` text COLLATE utf8_unicode_ci NOT NULL,
  `SN` int(11) NOT NULL,
  `bankName` text COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bankdetails`
--

INSERT INTO `bankdetails` (`userId`, `holderName`, `accountNumber`, `ifsc`, `SN`, `bankName`, `updated_at`) VALUES
(2, 'tojo', '25526', 'sggs', 1, 'yy', '2022-11-11 05:28:39');

-- --------------------------------------------------------

--
-- Table structure for table `blockeds`
--

CREATE TABLE `blockeds` (
  `id` bigint(20) NOT NULL,
  `activity` text COLLATE utf8_unicode_ci NOT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  `S/N` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bots`
--

CREATE TABLE `bots` (
  `id` int(11) NOT NULL,
  `userName` text COLLATE utf8_unicode_ci NOT NULL,
  `profilePic` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bots`
--

INSERT INTO `bots` (`id`, `userName`, `profilePic`, `status`) VALUES
(1, 'vashi', 'https://zenludo.msworksconsulting.com/profilePictures/vashi.png?171239818', 0),
(2, 'Jake', 'https://zenludo.msworksconsulting.com/profilePictures/Jake.png?106984520', 0),
(3, 'shruti', 'https://zenludo.msworksconsulting.com/profilePictures/shruti.png?706968789', 0),
(4, 'pepe', 'https://zenludo.msworksconsulting.com/profilePictures/pepe.png?832190608', 0),
(5, 'drake', 'https://zenludo.msworksconsulting.com/profilePictures/drake.png?800592402', 0),
(6, 'ryr', 'https://zenludo.msworksconsulting.com/profilePictures/ryr.png?466569063', 0),
(7, 'ryan', 'https://zenludo.msworksconsulting.com/profilePictures/ryan.png?262430939', 0),
(8, 'faruk', 'https://zenludo.msworksconsulting.com/profilePictures/faruk.png?493731756', 0);

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `SN` int(11) NOT NULL,
  `roomId` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `matchId` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `players` text COLLATE utf8_unicode_ci NOT NULL,
  `playerCount` int(11) NOT NULL DEFAULT 1,
  `stat` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'running',
  `updated_at` timestamp NULL DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`SN`, `roomId`, `matchId`, `amount`, `players`, `playerCount`, `stat`, `updated_at`, `createdAt`) VALUES
(1, '52ac8324-f6d9-4b86-a0e4-ed28bf4f4d05', '3eJpHnE6we', 10, 'dev008', 1, 'running', NULL, '2022-11-08 08:33:04'),
(2, 'd65ed241-6b1f-4948-905f-e2f53d0efe71', 'iSxZb3LBkZ', 10, 'Santu', 1, 'running', NULL, '2022-11-08 18:46:22'),
(3, '1fd6c72e-1cb9-4e4e-b314-7facba7ca9bf', 'uL04t1HQEB', 10, 'Santu', 1, 'running', NULL, '2022-11-08 18:55:43');

-- --------------------------------------------------------

--
-- Table structure for table `paymentrequests`
--

CREATE TABLE `paymentrequests` (
  `SN` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `SN` int(11) NOT NULL,
  `userName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` text COLLATE utf8_unicode_ci NOT NULL,
  `status` text COLLATE utf8_unicode_ci NOT NULL,
  `amount` text COLLATE utf8_unicode_ci NOT NULL,
  `orderId` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `SN` int(11) NOT NULL,
  `matchId` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `roomCode` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `winner` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`SN`, `matchId`, `amount`, `roomCode`, `winner`) VALUES
(1, 'iSxZb3LBkZ', 10, 'd65ed241-6b1f-4948-905f-e2f53d0efe71', 'Santu');

-- --------------------------------------------------------

--
-- Table structure for table `seseme`
--

CREATE TABLE `seseme` (
  `id` int(11) NOT NULL,
  `iska` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spins`
--

CREATE TABLE `spins` (
  `zero` int(11) NOT NULL,
  `one` int(11) NOT NULL,
  `two` int(11) NOT NULL,
  `three` int(11) NOT NULL,
  `four` int(11) NOT NULL,
  `five` int(11) NOT NULL,
  `SN` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `spins`
--

INSERT INTO `spins` (`zero`, `one`, `two`, `three`, `four`, `five`, `SN`, `updated_at`) VALUES
(44, 5, 3, 2, 1, 1, 1, '2022-11-08 13:32:17');

-- --------------------------------------------------------

--
-- Table structure for table `temppayments`
--

CREATE TABLE `temppayments` (
  `SN` int(11) NOT NULL,
  `orderId` text COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `userId` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `temppayments`
--

INSERT INTO `temppayments` (`SN`, `orderId`, `amount`, `userId`, `createdAt`) VALUES
(1, '4074058', 55, '1', '2022-11-08 12:54:24'),
(2, '89174776', 88, '1', '2022-12-02 14:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `SN` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`SN`, `name`, `value`, `status`, `updated_at`) VALUES
(1, 'Two', 2, 0, '2022-11-08 13:19:35'),
(2, 'Three', 3, 0, '2022-11-08 13:19:37'),
(3, 'Four', 4, 0, '2022-11-08 13:19:44');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `SN` bigint(20) NOT NULL,
  `id` int(11) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `type` text COLLATE utf8_unicode_ci NOT NULL,
  `bountyRemain` bigint(20) NOT NULL,
  `winBountyRemain` int(11) NOT NULL DEFAULT 0,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`SN`, `id`, `amount`, `type`, `bountyRemain`, `winBountyRemain`, `createdAt`) VALUES
(1, 1, 10, 'Wallet Addition', 10, 0, '2022-11-08 08:26:15'),
(2, 1, 10, 'Match join deduction', 0, 0, '2022-11-08 08:33:04'),
(3, 2, 10, 'Wallet Addition', 10, 0, '2022-11-08 18:45:23'),
(4, 2, 10, 'Match join deduction', 0, 0, '2022-11-08 18:46:22'),
(5, 2, 16, 'Match win', 0, 16, '2022-11-08 18:55:16'),
(6, 2, 10, 'Match join deduction', 0, 6, '2022-11-08 18:55:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `userName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` text COLLATE utf8_unicode_ci NOT NULL,
  `id` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `lastLogin` timestamp NOT NULL DEFAULT current_timestamp(),
  `bounty` bigint(20) NOT NULL,
  `winBounty` int(11) NOT NULL DEFAULT 0,
  `referal` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `refferdBy` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `profilePhotoPath` text COLLATE utf8_unicode_ci NOT NULL,
  `isOnline` tinyint(1) NOT NULL DEFAULT 0,
  `isBlocked` tinyint(1) NOT NULL DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT NULL,
  `totalMatch` int(11) NOT NULL DEFAULT 0,
  `totalWon` int(11) NOT NULL DEFAULT 0,
  `deviceId` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refferd` int(11) NOT NULL DEFAULT 0,
  `isInfluencer` int(11) NOT NULL DEFAULT 0,
  `spin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `userName`, `email`, `phone`, `id`, `createdAt`, `lastLogin`, `bounty`, `winBounty`, `referal`, `refferdBy`, `profilePhotoPath`, `isOnline`, `isBlocked`, `updated_at`, `totalMatch`, `totalWon`, `deviceId`, `refferd`, `isInfluencer`, `spin`) VALUES
('dev', 'dev008', 'dfxdev@icloud.com', '8420489525', 1, '2022-11-08 08:26:15', '2022-12-09 12:24:20', 0, 0, 'ctTDxn6k0G', 'tyu8io', 'https://zenludo.msworksconsulting.com/profilePictures/dev008.png?431034208', 0, 0, '2022-12-09 12:24:20', 1, 0, '2932bc16cd030b2fe35d3a2034fbf8568de573f6', 0, 0, 0),
('Koushik Ghosh', 'Santu', 'hikghsh195@gmail.com', '7980223231', 2, '2022-11-08 18:45:23', '2022-11-12 06:25:42', 0, 6, 'LhB05wW22X', 'special', 'https://zenludo.msworksconsulting.com/profilePictures/default.png', 0, 0, '2022-11-12 06:25:42', 2, 1, '8d929bbeba48af33d0a44c81d258a71f', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `versions`
--

CREATE TABLE `versions` (
  `currentVersion` text COLLATE utf8_unicode_ci NOT NULL,
  `SN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `versions`
--

INSERT INTO `versions` (`currentVersion`, `SN`) VALUES
('1.1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vpas`
--

CREATE TABLE `vpas` (
  `SN` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `upi` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `benId` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admindetails`
--
ALTER TABLE `admindetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bankdetails`
--
ALTER TABLE `bankdetails`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `blockeds`
--
ALTER TABLE `blockeds`
  ADD PRIMARY KEY (`S/N`);

--
-- Indexes for table `bots`
--
ALTER TABLE `bots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `paymentrequests`
--
ALTER TABLE `paymentrequests`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `seseme`
--
ALTER TABLE `seseme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spins`
--
ALTER TABLE `spins`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `temppayments`
--
ALTER TABLE `temppayments`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`(100));

--
-- Indexes for table `versions`
--
ALTER TABLE `versions`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `vpas`
--
ALTER TABLE `vpas`
  ADD PRIMARY KEY (`SN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admindetails`
--
ALTER TABLE `admindetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bankdetails`
--
ALTER TABLE `bankdetails`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blockeds`
--
ALTER TABLE `blockeds`
  MODIFY `S/N` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bots`
--
ALTER TABLE `bots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paymentrequests`
--
ALTER TABLE `paymentrequests`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seseme`
--
ALTER TABLE `seseme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spins`
--
ALTER TABLE `spins`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `temppayments`
--
ALTER TABLE `temppayments`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `SN` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `versions`
--
ALTER TABLE `versions`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vpas`
--
ALTER TABLE `vpas`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
