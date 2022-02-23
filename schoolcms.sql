-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2022 at 10:52 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolcms`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `answer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` text DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`answer_id`, `user_id`, `test_id`, `question_id`, `answer`, `date`) VALUES
(27, 28, 8, 15, 'asd', '2022-02-11 16:08:17');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class`, `user_id`, `school_id`, `date`) VALUES
(12, 'Mathematics', 5, 3, '2022-02-04 13:17:17'),
(13, 'Law 1', 17, 4, '2022-02-04 13:19:54'),
(14, 'Flying1', 14, 3, '2022-02-04 13:25:25'),
(24, 'Biology', 27, 3, '2022-02-06 07:17:16'),
(26, 'English 1', 15, 3, '2022-02-06 08:50:24'),
(28, 'Country', 5, 4, '2022-02-08 10:18:42');

-- --------------------------------------------------------

--
-- Table structure for table `class_lecturers`
--

CREATE TABLE `class_lecturers` (
  `class_lecturers_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_lecturers`
--

INSERT INTO `class_lecturers` (`class_lecturers_id`, `user_id`, `class_id`, `school_id`, `date`, `disabled`) VALUES
(14, 18, 13, 4, '2022-02-04 13:24:08', 0),
(15, 15, 14, 3, '2022-02-04 13:25:32', 0),
(17, 27, 14, 3, '2022-02-04 14:23:17', 0),
(18, 15, 12, 3, '2022-02-05 06:30:32', 0),
(20, 15, 26, 3, '2022-02-06 08:54:44', 0),
(21, 27, 26, 3, '2022-02-07 06:51:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `class_students`
--

CREATE TABLE `class_students` (
  `class_students_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `disabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_students`
--

INSERT INTO `class_students` (`class_students_id`, `user_id`, `class_id`, `school_id`, `date`, `disabled`) VALUES
(4, 21, 14, 3, '2022-02-05 07:27:46', 0),
(5, 20, 14, 3, '2022-02-05 07:30:05', 0),
(6, 25, 12, 3, '2022-02-05 07:37:51', 0),
(7, 20, 12, 3, '2022-02-05 09:46:23', 0),
(11, 25, 26, 3, '2022-02-06 08:50:39', 0),
(12, 21, 26, 3, '2022-02-06 08:50:43', 0),
(13, 20, 26, 3, '2022-02-07 12:11:53', 1),
(17, 23, 13, 4, '2022-02-10 11:52:03', 0),
(18, 28, 13, 4, '2022-02-10 14:17:35', 0);

-- --------------------------------------------------------

--
-- Table structure for table `class_tests`
--

CREATE TABLE `class_tests` (
  `test_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `test` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `disabled` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_tests`
--

INSERT INTO `class_tests` (`test_id`, `user_id`, `class_id`, `school_id`, `date`, `test`, `description`, `disabled`) VALUES
(8, 18, 13, 4, '2022-02-08 10:05:07', 'Funny test', 'All of us will have such a good time with this test :)', 0),
(9, 5, 28, 4, '2022-02-08 15:45:17', 'Roman law', 'lalala', 0),
(11, 5, 13, 4, '2022-02-09 06:36:19', 'Kolokvijum 1', 'This is our firts test.Good luck!!!!!', 0),
(13, 18, 13, 4, '2022-02-10 13:03:09', 'Law2', 'This is new test', 0);

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `school_id` int(11) NOT NULL,
  `school` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`school_id`, `school`, `user_id`, `date`) VALUES
(3, 'Hogwarts', 5, '2022-02-02 13:00:02'),
(4, 'Law', 5, '2022-02-02 10:21:07'),
(10, 'MIT', 5, '2022-02-06 10:04:02');

-- --------------------------------------------------------

--
-- Table structure for table `test_questions`
--

CREATE TABLE `test_questions` (
  `test_questions_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `comment` varchar(1024) NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `question_type` varchar(12) NOT NULL,
  `correct_answer` text DEFAULT NULL,
  `choices` text DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test_questions`
--

INSERT INTO `test_questions` (`test_questions_id`, `test_id`, `user_id`, `question`, `comment`, `image`, `question_type`, `correct_answer`, `choices`, `date`) VALUES
(15, 8, 18, 'What is your favouriote professor?', '', '', 'objective', 'No one', NULL, '2022-02-11 16:05:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `image` varchar(255) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `gender` varchar(7) NOT NULL,
  `school_id` int(11) NOT NULL,
  `rank` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `image`, `email`, `password`, `date`, `gender`, `school_id`, `rank`) VALUES
(5, 'Mihailo', 'Stanojevic', '', 'mihailo@gmail.com', '$2y$10$HxIWNXbOfwDaK4HYd.gWsuIh/pbTwp4.D1mPw3JV1CwF0qsB3OteK', '2022-02-01 11:29:05', 'male', 4, 'super_admin'),
(14, 'Nena', 'Jovanovic', '', 'nena@gmail.com', '$2y$10$hNRybbXPf20ma7xGBiPIV.4K/u/UMKSSpB3cPp9MrBqgue30JHUse', '2022-02-02 13:10:15', 'female', 3, 'admin'),
(15, 'Nina', 'Jovanovic', '', 'nina@gmail.com', '$2y$10$R2WQTso0cXKx59LFKSpwJepDtU2FdvPE/RuihEmY2eX6aA4LK.f8e', '2022-02-02 13:10:37', 'female', 3, 'lecturer'),
(16, 'Darko', 'Jovanovic', '', 'darko@gmail.com', '$2y$10$801ESWV2yCoRjODto1P86.Fh7KxzWgWbA1YhGHdKM7lSpyv/fLZxS', '2022-02-02 13:10:59', 'male', 3, 'reception'),
(17, 'Milica', 'Jovanovic', '', 'milica@gmail.com', '$2y$10$CB/0/DWg9WH28DF82FpADOsEquMPK4JxODyn1rgDScTVNO9RILNM.', '2022-02-02 13:11:29', 'female', 4, 'admin'),
(18, 'Ana', 'Jovanovic', '', 'ana@gmail.com', '$2y$10$L.cAbahynn3jtPohgTt7P.dICsv.JzxFsu4CIy97urm2J1jBolqTG', '2022-02-02 13:11:59', 'female', 4, 'lecturer'),
(19, 'Aleksandra', 'Jovanovic', '', 'aleksandra@gmail.com', '$2y$10$qnj.FL/M9oFiondh23YgWOZMrUSY0IAJGCM3sAfFmoTXc3ICvAkP.', '2022-02-02 13:16:49', 'female', 4, 'reception'),
(20, 'Veljko', 'Jovanovic', '', 'veljko@gmail.com', '$2y$10$486.Dl/jVh4FdPDgnea0zuBipITfuO6skb4iGkmozVn3KFZr9PuJC', '2022-02-03 06:21:56', 'male', 3, 'student'),
(21, 'Marija', 'Jovanovic', '', 'marija@gmail.com', '$2y$10$nOndQmC6m23IKEWzXZ3WlOkuid9AQcydJBwA78NNe4G8CrOOetNva', '2022-02-03 06:22:18', 'female', 3, 'student'),
(22, 'Dusan', 'Jovanovic', '', 'dusan@gmail.com', '$2y$10$yrNuuNP5Hiyb6Ek6P7rj/OQQ.EIYBLJK81g6Kx4AFuKxWMuHLwjOS', '2022-02-03 06:22:57', 'male', 4, 'student'),
(23, 'Andrea', 'Jovanovic', '', 'andrea@gmail.com', '$2y$10$sp0SrTZXuHtyRvG.zdRlXOixeTxo2kwUvtsBBo4nmMO9q/LPqqAn6', '2022-02-03 06:23:16', 'female', 4, 'student'),
(25, 'Lara', 'Jovanovic', '', 'lara@gmail.com', '$2y$10$KR1pEbmVjHVgN5C.v7x.l.Hz5.e8OTHzRF6pPOHS2EHHaV7WkCeaC', '2022-02-03 07:13:23', 'female', 3, 'student'),
(26, 'Andriana', 'Jovanovic', '', 'andriana@gmail.com', '$2y$10$5ev9HGvgOy75qIZ8YQHWD.b0zS96f2krinda3uZiFp0oG/Q08iiKy', '2022-02-03 07:19:33', 'female', 4, 'student'),
(27, 'Dragana', 'Jovanovic', '', 'dragana@gmail.com', '$2y$10$4ecSoMGV2MqwV77XQX9DsuxOdYxPue.7Tje5Ek.FE.vIlcknmwNvy', '2022-02-04 10:06:00', 'female', 3, 'lecturer'),
(28, 'Aleksandar', 'Jovanovic', '', 'aleksandar@gmail.com', '$2y$10$LodNm0UUwn7V1.exqd1uTeRDbZTkU8jA8W4B0eNzvudZa8sGs8GCa', '2022-02-06 09:13:55', 'male', 4, 'student'),
(29, 'Luka', 'Jovanovic', '', 'luka@gmail.com', '$2y$10$zAKciblq6Sh4eEPI0Sb6bu4ayXEhtxYZU/qQxpdD7K1FLrQOlXXgy', '2022-02-06 10:44:16', 'male', 3, 'student'),
(30, 'Neva', 'Jovanovic', '', 'neva@gmail.com', '$2y$10$NGuyNNxgmPmxCXtrkb5YReqqKFWCa5NHb2aigTGLgoa/iPBkAzwFC', '2022-02-06 10:45:43', 'female', 3, 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `answer_id` (`answer_id`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `class` (`class`),
  ADD KEY `date` (`date`),
  ADD KEY `classes_ibfk_2` (`user_id`),
  ADD KEY `classes_ibfk_3` (`school_id`);

--
-- Indexes for table `class_lecturers`
--
ALTER TABLE `class_lecturers`
  ADD PRIMARY KEY (`class_lecturers_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `date` (`date`),
  ADD KEY `disabled` (`disabled`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `class_students`
--
ALTER TABLE `class_students`
  ADD PRIMARY KEY (`class_students_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `date` (`date`),
  ADD KEY `disabled` (`disabled`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `class_tests`
--
ALTER TABLE `class_tests`
  ADD PRIMARY KEY (`test_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `date` (`date`),
  ADD KEY `test` (`test`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`school_id`),
  ADD KEY `school` (`school`),
  ADD KEY `date` (`date`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `test_questions`
--
ALTER TABLE `test_questions`
  ADD PRIMARY KEY (`test_questions_id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `test_type` (`question_type`),
  ADD KEY `date` (`date`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `firstname` (`firstname`),
  ADD KEY `lastname` (`lastname`),
  ADD KEY `date` (`date`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `gender` (`gender`),
  ADD KEY `rank` (`rank`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `class_lecturers`
--
ALTER TABLE `class_lecturers`
  MODIFY `class_lecturers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `class_students`
--
ALTER TABLE `class_students`
  MODIFY `class_students_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `class_tests`
--
ALTER TABLE `class_tests`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `school_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `test_questions`
--
ALTER TABLE `test_questions`
  MODIFY `test_questions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `class_tests` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `answers_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `test_questions` (`test_questions_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classes_ibfk_3` FOREIGN KEY (`school_id`) REFERENCES `schools` (`school_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class_lecturers`
--
ALTER TABLE `class_lecturers`
  ADD CONSTRAINT `class_lecturers_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_lecturers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_lecturers_ibfk_3` FOREIGN KEY (`school_id`) REFERENCES `schools` (`school_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class_students`
--
ALTER TABLE `class_students`
  ADD CONSTRAINT `class_students_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_students_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_students_ibfk_3` FOREIGN KEY (`school_id`) REFERENCES `schools` (`school_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class_tests`
--
ALTER TABLE `class_tests`
  ADD CONSTRAINT `class_tests_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_tests_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_tests_ibfk_3` FOREIGN KEY (`school_id`) REFERENCES `schools` (`school_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schools`
--
ALTER TABLE `schools`
  ADD CONSTRAINT `schools_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test_questions`
--
ALTER TABLE `test_questions`
  ADD CONSTRAINT `test_questions_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `class_tests` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `test_questions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`school_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
