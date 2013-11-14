-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 14, 2013 at 01:21 PM
-- Server version: 5.6.12
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Mini-Facebook`
--

DROP Database IF EXISTS `Mini-Facebook`;
CREATE DATABASE IF NOT EXISTS `Mini-Facebook` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `Mini-Facebook`;

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE IF NOT EXISTS `Comment` (
  `post_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `sender_id` varchar(25) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data` text NOT NULL,
  PRIMARY KEY (`post_id`,`comment_id`),
  KEY `sender_id` (`sender_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Comment_notification`
--

CREATE TABLE IF NOT EXISTS `Comment_notification` (
  `post_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `receiver_id` varchar(25) NOT NULL,
  `seen` tinyint(1) NOT NULL,
  PRIMARY KEY (`post_id`,`comment_id`,`receiver_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Event`
--

CREATE TABLE IF NOT EXISTS `Event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` varchar(25) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_name` varchar(50) NOT NULL,
  `event_date_time` datetime NOT NULL,
  `description` text NOT NULL,
  `house_no` varchar(50) NOT NULL,
  `street` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `pin` varchar(15) NOT NULL,
  `country` varchar(30) NOT NULL,
  PRIMARY KEY (`event_id`),
  UNIQUE KEY `event_id_2` (`event_id`),
  KEY `event_id` (`event_id`),
  KEY `sender_id` (`sender_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Table structure for table `Event_Notification`
--

CREATE TABLE IF NOT EXISTS `Event_Notification` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `receiver_id` varchar(25) NOT NULL,
  `seen` tinyint(1) NOT NULL,
  PRIMARY KEY (`event_id`,`receiver_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Table structure for table `Follow`
--

CREATE TABLE IF NOT EXISTS `Follow` (
  `followed_user_id` varchar(25) NOT NULL,
  `followedby_user_id` varchar(25) NOT NULL,
  PRIMARY KEY (`followed_user_id`,`followedby_user_id`),
  KEY `followedby_user_id` (`followedby_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Friends_with`
--

CREATE TABLE IF NOT EXISTS `Friends_with` (
  `user_id1` varchar(25) NOT NULL,
  `user_id2` varchar(25) NOT NULL,
  PRIMARY KEY (`user_id1`,`user_id2`),
  KEY `user_id2` (`user_id2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Likes`
--

CREATE TABLE IF NOT EXISTS `Likes` (
  `user_id` varchar(25) NOT NULL,
  `likes_post_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`likes_post_id`),
  KEY `likes_post_id` (`likes_post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Message`
--

CREATE TABLE IF NOT EXISTS `Message` (
  `sender_id` varchar(25) NOT NULL,
  `receiver_id` varchar(25) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data` text,
  PRIMARY KEY (`sender_id`,`receiver_id`,`date_time`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Post`
--

CREATE TABLE IF NOT EXISTS `Post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `likes` int(11) NOT NULL DEFAULT '0',
  `data` text,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Table structure for table `Posts`
--

CREATE TABLE IF NOT EXISTS `Posts` (
  `user_id` varchar(25) NOT NULL,
  `posts_post_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`posts_post_id`),
  KEY `posts_post_id` (`posts_post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Post_notification`
--

CREATE TABLE IF NOT EXISTS `Post_notification` (
  `post_id` int(11) NOT NULL,
  `receiver_id` varchar(25) NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`post_id`,`receiver_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Profile`
--

CREATE TABLE IF NOT EXISTS `Profile` (
  `user_id` varchar(25) NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `middle_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('MALE','FEMALE') NOT NULL,
  `house_no` varchar(50) NOT NULL,
  `street` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `pin` varchar(15) NOT NULL,
  `country` varchar(30) NOT NULL,
  `image` longblob NOT NULL,
  `relationship_status` tinyint(1) NOT NULL,
  `graduation_school` varchar(25) NOT NULL,
  `high_school` varchar(50) NOT NULL,
  `primary_school` varchar(50) NOT NULL,
  `phone_no` bigint(15) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `quote` varchar(1000) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Relationship_with`
--

CREATE TABLE IF NOT EXISTS `Relationship_with` (
  `user_id1` varchar(25) NOT NULL,
  `user_id2` varchar(25) NOT NULL,
  PRIMARY KEY (`user_id1`,`user_id2`),
  KEY `user_id2` (`user_id2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Request`
--

CREATE TABLE IF NOT EXISTS `Request` (
  `sender_id` varchar(25) NOT NULL,
  `receiver_id` varchar(25) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sender_id`,`receiver_id`,`date_time`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `user_id` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `online` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Writes`
--

CREATE TABLE IF NOT EXISTS `Writes` (
  `user_id` varchar(25) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`post_id`,`comment_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `Comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `Post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Comment_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Comment_notification`
--
ALTER TABLE `Comment_notification`
  ADD CONSTRAINT `Comment_notification_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `Post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Comment_notification_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Event`
--
ALTER TABLE `Event`
  ADD CONSTRAINT `Event_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Event_Notification`
--
ALTER TABLE `Event_Notification`
  ADD CONSTRAINT `Event_Notification_ibfk_1` FOREIGN KEY (`receiver_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Event_Notification_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `Event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Follow`
--
ALTER TABLE `Follow`
  ADD CONSTRAINT `Follow_ibfk_1` FOREIGN KEY (`followed_user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Follow_ibfk_2` FOREIGN KEY (`followedby_user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Friends_with`
--
ALTER TABLE `Friends_with`
  ADD CONSTRAINT `Friends_with_ibfk_1` FOREIGN KEY (`user_id1`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Friends_with_ibfk_2` FOREIGN KEY (`user_id2`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Likes`
--
ALTER TABLE `Likes`
  ADD CONSTRAINT `Likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Likes_ibfk_2` FOREIGN KEY (`likes_post_id`) REFERENCES `Post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Message`
--
ALTER TABLE `Message`
  ADD CONSTRAINT `Message_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Message_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Posts`
--
ALTER TABLE `Posts`
  ADD CONSTRAINT `Posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Posts_ibfk_2` FOREIGN KEY (`posts_post_id`) REFERENCES `Post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Post_notification`
--
ALTER TABLE `Post_notification`
  ADD CONSTRAINT `Post_notification_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `Post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Post_notification_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Profile`
--
ALTER TABLE `Profile`
  ADD CONSTRAINT `Profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Relationship_with`
--
ALTER TABLE `Relationship_with`
  ADD CONSTRAINT `Relationship_with_ibfk_1` FOREIGN KEY (`user_id1`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Relationship_with_ibfk_2` FOREIGN KEY (`user_id2`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Request`
--
ALTER TABLE `Request`
  ADD CONSTRAINT `Request_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Request_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Writes`
--
ALTER TABLE `Writes`
  ADD CONSTRAINT `Writes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Writes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `Post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
