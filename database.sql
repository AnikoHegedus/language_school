-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(50) NOT NULL,
  `no_hours` int(11) NOT NULL,
  `teacher` varchar(127) NOT NULL,
  `level` varchar(2) NOT NULL,
  `status` varchar(127) NOT NULL,
  `id_course` varchar(127) NOT NULL,
  `no_registered_students` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `courses` (`id`, `language`, `no_hours`, `teacher`, `level`, `status`, `id_course`, `no_registered_students`) VALUES
(38,	'German',	60,	'Stahl',	'C1',	'On hold',	'C1DE',	0),
(39,	'German',	180,	'Stahl',	'C1',	'Open for registration',	'C1DE',	0),
(40,	'French',	120,	'Girardot',	'B1',	'Coming soon',	'B1FR',	0),
(41,	'English',	60,	'Parsons',	'B1',	'Cancelled',	'B1EN',	0),
(42,	'French',	60,	'Girardot',	'C1',	'Running',	'C1FR',	0),
(48,	'English',	120,	'Parsons',	'A1',	'Open for registration',	'A1EN',	0),
(49,	'English',	120,	'Parsons',	'A1',	'Open for registration',	'A1EN',	0);

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(127) NOT NULL,
  `last_name` varchar(127) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `language` varchar(127) NOT NULL,
  `nationality` varchar(127) NOT NULL,
  `teaching_experience` varchar(127) NOT NULL,
  `motto` text NOT NULL,
  `salary` int(10) NOT NULL,
  `no_classes` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `teachers` (`id`, `first_name`, `last_name`, `gender`, `language`, `nationality`, `teaching_experience`, `motto`, `salary`, `no_classes`) VALUES
(4,	'Owen',	'Parsons',	'M',	'English',	'UK',	'10+ years',	'I just love teaching.',	100,	0),
(5,	'Jakob',	'Stahl',	'M',	'German',	'German',	'less than 2 years',	'Übung macht den Meister.',	65,	0),
(6,	'Claire',	'Girardot',	'F',	'French',	'Belgian',	'5+ years',	'La vie est belle.',	85,	0);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1,	'Anna',	'anna@anna.org',	'$2y$10$MiuyvfuGx2lkMDOyoe43EejRy2UDThKuBNYVMKQfJkTMSrZfyyCWS'),
(3,	'Admin1',	'admin1@admin.org',	'$2y$10$k5xHT4/Vu0Dl4a8ZZ1ynJuY/yx5QUhGW0gs64K.n1ldhv7gPYbxR6');

-- 2017-02-21 10:00:23
