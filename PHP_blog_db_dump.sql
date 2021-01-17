-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jan 17, 2021 at 06:28 PM
-- Server version: 8.0.22
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `complete-blog-php`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `slug`, `body`, `created_at`) VALUES
(1, 10, 'House Plants', 'growing-plants-inside', 'During quarantine, I\'ve had more time to develop more solitary interests, like growing house plants. ', '2021-01-15 23:11:35'),
(2, 10, 'The Korg Minilogue', 'the-korg-minilogue', 'I finally caved and bought an analogue synthesizer. ', '2021-01-15 23:58:10'),
(9, 8, 'String of Pearls Propagation', 'test-post-title6001d1a032896', 'I received some cuttings from a friend\'s string of pearls plant. I\'m currently in the process of letting them grow roots in a small vase, and I\'m excited to plant them!', '2021-01-15 23:41:55'),
(10, 10, 'How I Gained 300 Elo in Chess', 'how-i-gained-300-elo-in-chess-over-1-year6001f00a2fe96', 'I developed a practice regimen', '2021-01-15 23:15:10'),
(12, 10, 'I Might be 70 Years Late, But I Am Really Getting Into Chet Baker', 'i-might-be-70-years-late,-but-i-am-really-getting-into-chet-baker60022298c4df9', '<h2>Chet Baker is incredible</h2>\r\n<p>\r\nI like chet baker\r\n</p>', '2021-01-15 23:17:44'),
(13, 9, '5 Simple Ways to Create a Plant Paradise', '5-simple-ways-to-create-a-plant-paradise600230852cdcc', '<ol>\r\n<li>Water them</li>\r\n<li>Don\'t forget to water them</li>\r\n<li>Give them sun, don\'t keep them in the basement!</li>\r\n<li>Did we mention the watering??</li>\r\n<li>Don\'t feed them to your cat</li>\r\n</ol>', '2021-01-16 00:17:31'),
(14, 9, 'Hades Has Become My New Gaming Addiction', 'hades-has-become-my-new-gaming-addiction600236975a467', 'Hades is impossible to stop playing. ', '2021-01-16 00:43:03');

-- --------------------------------------------------------

--
-- Table structure for table `post_topic`
--

CREATE TABLE `post_topic` (
  `id` int NOT NULL,
  `post_id` int DEFAULT NULL,
  `topic_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_topic`
--

INSERT INTO `post_topic` (`id`, `post_id`, `topic_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(4, 9, 1),
(5, 10, 4),
(7, 12, 2),
(8, 13, 1),
(9, 14, 3);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`, `slug`) VALUES
(1, 'Plants', 'plants'),
(2, 'Music', 'music'),
(3, 'Games', 'games'),
(4, 'Other', 'other');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(4, 'stranger19', 'jake@schlaerth.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(8, 'test_user', '123@gmail', '202cb962ac59075b964b07152d234b70'),
(9, 'lin', 'l@l.com', '098f6bcd4621d373cade4e832627b4f6'),
(10, 'jakeschlaerth', 'jakeschlaerth1999@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post_topic`
--
ALTER TABLE `post_topic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_topic_ibfk_2` (`topic_id`),
  ADD KEY `post_topic_ibfk1` (`post_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `post_topic`
--
ALTER TABLE `post_topic`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `post_topic`
--
ALTER TABLE `post_topic`
  ADD CONSTRAINT `post_topic_ibfk1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_topic_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
