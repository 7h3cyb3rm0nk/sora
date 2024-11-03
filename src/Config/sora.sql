-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 03, 2024 at 12:45 PM
-- Server version: 11.5.2-MariaDB
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sora`
--
CREATE DATABASE IF NOT EXISTS `sora` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `sora`;

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `id` int(11) NOT NULL,
  `blocker_id` int(11) NOT NULL,
  `blocked_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conversation_deletions`
--

CREATE TABLE `conversation_deletions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `other_user_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conversation_deletions`
--

INSERT INTO `conversation_deletions` (`id`, `user_id`, `other_user_id`, `deleted_at`) VALUES
(1, 6, 8, '2024-11-03 09:13:43'),
(2, 8, 6, '2024-11-03 09:45:50'),
(5, 8, 8, '2024-11-03 09:02:27');

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `follower_id` int(11) NOT NULL,
  `followed_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`follower_id`, `followed_id`, `created_at`) VALUES
(6, 8, '2024-11-02 15:14:43'),
(8, 6, '2024-11-03 12:40:29');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `created_at`) VALUES
(168, 6, 62, '2024-11-03 09:57:18');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `content`, `created_at`, `is_read`) VALUES
(1, 6, 8, 'hi', '2024-11-03 07:56:06', 1),
(3, 6, 8, 'hi', '2024-11-03 08:02:37', 1),
(5, 6, 8, 'hi there', '2024-11-03 08:03:10', 1),
(7, 6, 8, 'hi', '2024-11-03 08:04:00', 1),
(8, 6, 8, 'hello', '2024-11-03 08:04:22', 1),
(9, 8, 8, 'hello', '2024-11-03 08:20:34', 1),
(10, 8, 6, 'hello', '2024-11-03 08:20:46', 1),
(11, 8, 6, 'hello', '2024-11-03 08:21:01', 1),
(12, 8, 6, 'hello', '2024-11-03 08:22:38', 1),
(13, 8, 8, 'hi therer', '2024-11-03 08:23:00', 1),
(14, 8, 6, 'hello guyss', '2024-11-03 08:23:06', 1),
(15, 6, 8, 'hi', '2024-11-03 08:26:43', 1),
(16, 8, 6, 'hello', '2024-11-03 08:27:06', 1),
(17, 6, 8, 'hi', '2024-11-03 08:27:42', 1),
(18, 8, 8, 'hi', '2024-11-03 08:51:43', 1),
(19, 8, 6, 'hi', '2024-11-03 08:57:21', 1),
(20, 8, 6, 'hi', '2024-11-03 09:02:49', 1),
(21, 6, 8, 'hi', '2024-11-03 09:16:41', 1),
(22, 6, 8, 'hello', '2024-11-03 09:16:58', 1),
(23, 8, 6, 'hi', '2024-11-03 09:19:47', 1),
(24, 8, 6, 'hello', '2024-11-03 09:19:50', 1),
(25, 8, 6, 'hi', '2024-11-03 09:32:04', 1),
(26, 8, 6, 'hi', '2024-11-03 09:36:58', 1),
(27, 8, 6, 'hi', '2024-11-03 09:37:01', 1),
(28, 6, 8, 'hi', '2024-11-03 09:56:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(62, 8, 'hi there', '2024-11-02 12:10:40', '2024-11-02 12:10:40'),
(67, 6, 'hi there', '2024-11-03 09:59:08', '2024-11-03 09:59:08'),
(68, 8, 'hi there', '2024-11-03 09:59:29', '2024-11-03 09:59:29');

-- --------------------------------------------------------

--
-- Table structure for table `spaces`
--

CREATE TABLE `spaces` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `code` varchar(8) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spaces`
--

INSERT INTO `spaces` (`id`, `name`, `admin_id`, `code`, `created_at`) VALUES
(1, 'test', 8, 'Z7HEQXFW', '2024-11-03 07:01:37'),
(2, 'test space 1', 6, '8L2UXV3N', '2024-11-03 08:26:08');

-- --------------------------------------------------------

--
-- Table structure for table `space_members`
--

CREATE TABLE `space_members` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `space_id` int(11) NOT NULL,
  `joined_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `space_members`
--

INSERT INTO `space_members` (`id`, `user_id`, `space_id`, `joined_at`) VALUES
(1, 8, 1, '2024-11-03 07:01:37'),
(3, 6, 2, '2024-11-03 08:26:08'),
(4, 8, 2, '2024-11-03 11:45:35');

-- --------------------------------------------------------

--
-- Table structure for table `space_tweets`
--

CREATE TABLE `space_tweets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `space_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `space_tweets`
--

INSERT INTO `space_tweets` (`id`, `user_id`, `space_id`, `content`, `created_at`) VALUES
(1, 8, 1, 'hi\r\n', '2024-11-03 07:02:38'),
(2, 8, 1, 'hello\r\n', '2024-11-03 07:05:38'),
(3, 6, 1, 'hi ramees\r\n', '2024-11-03 07:07:14'),
(4, 6, 1, 'hi', '2024-11-03 07:12:50'),
(5, 6, 1, 'hi there', '2024-11-03 07:13:27'),
(6, 6, 2, 'hello', '2024-11-03 08:26:11'),
(7, 8, 2, 'hi there', '2024-11-03 11:45:52'),
(8, 8, 2, 'what is happening', '2024-11-03 11:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `profile_picture`, `bio`, `created_at`, `updated_at`, `status`) VALUES
(6, 'Irene', 'J Kooran', 'irene', 'irene@gmail.com', '$2y$10$1z346OHrI8UQqkPyMNWS4e1SkrhvKJDpTtxCJ6Odk1t.CkF0dD6CC', '/images/icons/user-avatar.png', 'Hello guyss', '2024-10-18 09:32:40', '2024-11-03 07:14:46', 'hellooo'),
(8, 'Ramees', 'Mohammed M M', 'ramees', 'rameesmohd2004@gmail.com', '$2y$10$YUoHmD.7bEGe/vqYJoJk1O199bzV1zziBycJooDKvIw.uw8W6QGYy', '/images/pfps/profile_8.png', 'C,C++, Rust Enthusiast, Systems Programmer', '2024-10-22 20:15:34', '2024-11-03 10:14:35', 'hello there');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blocker_id` (`blocker_id`,`blocked_id`),
  ADD KEY `blocked_id` (`blocked_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_comments_post_id` (`post_id`);

--
-- Indexes for table `conversation_deletions`
--
ALTER TABLE `conversation_deletions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`other_user_id`),
  ADD KEY `other_user_id` (`other_user_id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`follower_id`,`followed_id`),
  ADD KEY `idx_follows_follower_id` (`follower_id`),
  ADD KEY `idx_follows_followed_id` (`followed_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`post_id`),
  ADD KEY `idx_likes_post_id` (`post_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_posts_user_id` (`user_id`);

--
-- Indexes for table `spaces`
--
ALTER TABLE `spaces`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `space_members`
--
ALTER TABLE `space_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`space_id`),
  ADD KEY `space_id` (`space_id`);

--
-- Indexes for table `space_tweets`
--
ALTER TABLE `space_tweets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `space_id` (`space_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `firstname` (`firstname`,`lastname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `conversation_deletions`
--
ALTER TABLE `conversation_deletions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `spaces`
--
ALTER TABLE `spaces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `space_members`
--
ALTER TABLE `space_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `space_tweets`
--
ALTER TABLE `space_tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blocks`
--
ALTER TABLE `blocks`
  ADD CONSTRAINT `blocks_ibfk_1` FOREIGN KEY (`blocker_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blocks_ibfk_2` FOREIGN KEY (`blocked_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `conversation_deletions`
--
ALTER TABLE `conversation_deletions`
  ADD CONSTRAINT `conversation_deletions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `conversation_deletions_ibfk_2` FOREIGN KEY (`other_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`followed_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `spaces`
--
ALTER TABLE `spaces`
  ADD CONSTRAINT `spaces_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `space_members`
--
ALTER TABLE `space_members`
  ADD CONSTRAINT `space_members_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `space_members_ibfk_2` FOREIGN KEY (`space_id`) REFERENCES `spaces` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `space_tweets`
--
ALTER TABLE `space_tweets`
  ADD CONSTRAINT `space_tweets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `space_tweets_ibfk_2` FOREIGN KEY (`space_id`) REFERENCES `spaces` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
