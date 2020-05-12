-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2020 at 12:42 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ramen_chill`
--
CREATE DATABASE IF NOT EXISTS `ramen_chill` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ramen_chill`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`) VALUES
('admin');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `postId` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`postId`, `category`) VALUES
(6, 'Food'),
(7, 'jobs'),
(8, 'healthcare'),
(9, 'academics'),
(10, 'finances'),
(11, 'studentLife'),
(12, 'healthcare'),
(13, 'healthcare'),
(14, 'general');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentId` int(11) NOT NULL,
  `content` varchar(100) NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp(),
  `postId` int(11) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentId`, `content`, `created`, `postId`, `username`) VALUES
(15, 'You can also try Subway and Starbucks if you like franchise food.', '2020-04-09', 6, 'maggie'),
(16, 'I know the student housing front desk is hiring for the summer conferences season', '2020-04-09', 7, 'maggie'),
(17, 'Make sure you start self isolating!', '2020-04-09', 8, 'maggie'),
(18, 'We also have Comma for the best Coffee and Timmies for affordable stuff.', '2020-04-09', 6, 'mo'),
(19, 'You can also apply to be a summer teaching assistant or a summer research assistant.', '2020-04-09', 7, 'mo'),
(20, 'There is a form on their Instagram page that you can fill up.', '2020-04-09', 10, 'mo');

-- --------------------------------------------------------

--
-- Table structure for table `isliked`
--

CREATE TABLE `isliked` (
  `username` varchar(20) NOT NULL,
  `postId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `isliked`
--

INSERT INTO `isliked` (`username`, `postId`) VALUES
('maggie', 6),
('maggie', 8),
('mo', 6),
('mo', 7),
('mo', 10);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `postId` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp(),
  `category` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`postId`, `content`, `created`, `category`, `title`, `username`) VALUES
(6, 'You can eat at Sunshine in the admin building or Picnic in the UNC', '2020-04-09', 'Food', 'Where to eat on campus?', 'muizz'),
(7, 'It is almost summer time and i am in need of a summer job. Any body know what UBC departments are hiring ?', '2020-04-09', 'jobs', 'Any on-campus jobs?', 'muizz'),
(8, 'i have a really high fever and i find it very difficult to breathe. Please what do i do ?', '2020-04-09', 'healthcare', 'Corona virus HELP', 'muizz'),
(9, 'Hello everyone. I need help with final exams. Do we type our answers into a word document and submit or do we write it by hand, scan then submit?', '2020-04-09', 'academics', 'Final exams', 'maggie'),
(10, 'Is it true that the SUO is giving out relief funds? If so, how do i access them?', '2020-04-09', 'finances', 'COVID_19 relief funds', 'maggie'),
(11, 'Does anyone know who the headline act for RECESS is ? Have the released the line up ? what a ticket prices ?', '2020-04-09', 'studentLife', 'RECESS 2019', 'maggie'),
(12, 'Can someone suggest some home workout for me plus anyone know when the gym is gonna be open?', '2020-04-09', 'healthcare', 'Summer body?', 'mo'),
(13, 'Did you guys here about the Indian restaurant? I heard their food gave a lot of students food poisoning. Can anybody confirm this?', '2020-04-09', 'healthcare', 'Food poisoning in the UNC', 'mo'),
(14, 'Has anyone booked the Nonis field for the above time? If not, how can i do it?', '2020-04-09', 'general', 'Soccer at 5pm on Fridays', 'mo');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Bio` varchar(100) NOT NULL,
  `image` longtext NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `email`, `Bio`, `image`, `disabled`) VALUES
('admin', '$2y$10$lmYsXzy3.0dR3OBvgYpJjeOANb7tp4UPWgG.3NMwHBDLa2LZf9rSq', 'abdelmuizz.yusuf@hotmail.com', 'I am the admin', 'user1.jpg', 0),
('maggie', '$2y$10$6Gvz/QjUgalIOWJhct2mge2OcdPZwxXKPIV8QwU4o.1NbwvbmWMgK', 'margreta@gmail.com', 'The coolest girl in the world', 'user2.jpg', 0),
('mo', '$2y$10$SfP3/Thcis0h6//sqS6/ue8eAH3di9CbTe57ZLNrxFEaXkzNRoGKW', 'mohamed@gmail.com', 'I am your professor', 'user 4.png', 0),
('muizz', '$2y$10$pAtEym2mXUokKXEBHm60NuCTbFZZkuUjjvygTtz1EuxnFxQ6kDJLS', 'abdelmuizz.yusuf@hotmail.com', 'I am one of the creators of this app', 'user3.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`postId`,`category`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `username` (`username`),
  ADD KEY `comment_ibfk_1` (`postId`);

--
-- Indexes for table `isliked`
--
ALTER TABLE `isliked`
  ADD PRIMARY KEY (`username`,`postId`),
  ADD KEY `postId` (`postId`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postId`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`postId`) REFERENCES `post` (`postId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`postId`) REFERENCES `post` (`postId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `isliked`
--
ALTER TABLE `isliked`
  ADD CONSTRAINT `isliked_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `isliked_ibfk_2` FOREIGN KEY (`postId`) REFERENCES `post` (`postId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
