/*
 Navicat MySQL Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : db2

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 2/17/2020 10:20:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;


DROP TABLE IF EXISTS `enroll`;
DROP TABLE IF EXISTS `enroll2`;
DROP TABLE IF EXISTS `assign`;
DROP TABLE IF EXISTS `mentors`;
DROP TABLE IF EXISTS `mentees`;
DROP TABLE IF EXISTS `material`;
DROP TABLE IF EXISTS `meetings`;
DROP TABLE IF EXISTS `time_slot`;
DROP TABLE IF EXISTS `groups`;
DROP TABLE IF EXISTS `admins`;
DROP TABLE IF EXISTS `students`;
DROP TABLE IF EXISTS `parents`;
DROP TABLE IF EXISTS `users`;

-- ----------------------------
-- Table structure for users
-- ----------------------------

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for parents
-- ----------------------------

CREATE TABLE `parents` (
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`parent_id`),
  CONSTRAINT `parent_user` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for students
-- ----------------------------

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `grade` int(11) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`student_id`),
  KEY `student_parent` (`parent_id`),
  CONSTRAINT `student_user` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `student_parent` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`parent_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for admins
-- ----------------------------

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`),
  CONSTRAINT `admins_user` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for groups
-- ----------------------------

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `mentor_grade_req` int(11) NOT NULL,
  `mentee_grade_req` int(11) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for time_slot
-- ----------------------------

CREATE TABLE `time_slot` (
  `time_slot_id` int(11) NOT NULL AUTO_INCREMENT,
  `day_of_the_week` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  PRIMARY KEY (`time_slot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for meetings
-- ----------------------------

CREATE TABLE `meetings` (
  `meet_id` int(11) NOT NULL AUTO_INCREMENT,
  `meet_name` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `time_slot_id` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `announcement` varchar(255) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`meet_id`),
  KEY `meeting_group` (`group_id`),
  KEY `meeting_time_slot` (`time_slot_id`),
  CONSTRAINT `meeting_group` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE,
  CONSTRAINT `meeting_time_slot` FOREIGN KEY (`time_slot_id`) REFERENCES `time_slot` (`time_slot_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for material
-- ----------------------------

CREATE TABLE `material` (
  `material_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `assigned_date` date NOT NULL,
  `notes` text,
  PRIMARY KEY (`material_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mentees
-- ----------------------------

CREATE TABLE `mentees` (
  `mentee_id` int(11) NOT NULL,
  PRIMARY KEY (`mentee_id`),
  CONSTRAINT `mentee_student` FOREIGN KEY (`mentee_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mentors
-- ----------------------------

CREATE TABLE `mentors` (
  `mentor_id` int(11) NOT NULL,
  PRIMARY KEY (`mentor_id`),
  CONSTRAINT `mentor_student` FOREIGN KEY (`mentor_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for enroll
-- ----------------------------

CREATE TABLE `enroll` (
  `meet_id` int(11) NOT NULL,
  `mentee_id` int(11) NOT NULL,
  PRIMARY KEY (`meet_id`,`mentee_id`),
  KEY `enroll_mentee` (`mentee_id`),
  CONSTRAINT `enroll_mentee` FOREIGN KEY (`mentee_id`) REFERENCES `mentees` (`mentee_id`) ON DELETE CASCADE,
  CONSTRAINT `enroll_meetings` FOREIGN KEY (`meet_id`) REFERENCES `meetings` (`meet_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for enroll2
-- ----------------------------

CREATE TABLE `enroll2` (
  `meet_id` int(11) NOT NULL,
  `mentor_id` int(11) NOT NULL,
  PRIMARY KEY (`meet_id`,`mentor_id`),
  KEY `enroll2_mentor` (`mentor_id`),
  CONSTRAINT `enroll2_mentor` FOREIGN KEY (`mentor_id`) REFERENCES `mentors` (`mentor_id`) ON DELETE CASCADE,
  CONSTRAINT `enroll2_meetings` FOREIGN KEY (`meet_id`) REFERENCES `meetings` (`meet_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for assign
-- ----------------------------

CREATE TABLE `assign` (
  `meet_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  PRIMARY KEY (`meet_id`,`material_id`),
  KEY `assign_material` (`material_id`),
  KEY `assign_meetings` (`meet_id`),
  CONSTRAINT `assign_material` FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`) ON DELETE CASCADE,
  CONSTRAINT `assign_meetings` FOREIGN KEY (`meet_id`) REFERENCES `meetings` (`meet_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;


-- -------------------
-- **  SAMPLE DATA  **
-- -------------------

-- all users
INSERT INTO `users` (`id`, `email`, `password`, `name`, `phone`) VALUES
	(1, 'wilmankala1@gmail.com', 'Universe123', 'Wilman Kala', '712-456-7890'),
	(2, 'markwolski2@gmail.com', 'cat123', 'Mark Wolski', '312-432-6789'),
	(3, 'williamsmith3@outlook.com', 'willy423smit', 'William Smith', '756-920-9901'),
	(4, 'peterpan4@yahoo.com', 'pizza@123', 'Peter Pan', '456-891-6723'),
	(5, 'robertsergio5@hotmail.com', 'pineapplemango721', 'Robert Sergio', '612-573-8920'),
	(6, 'carlosbraithwaite6@yahoo.com', 'carlosb@wicric', 'Carlos Braithwaite', '812-429-9910'),
	(7, 'andrerusell7@gmail.com', 'hittoutofpark7', 'Andre Rusell', '664-4620-2246'),
	(8, 'karenwheeler@hotmail.com', 'mike+nance', 'Karen Wheeler', '219-202-1038'),
	(9, 'joyby@yahoo.com', 'byersboys', 'Joyce Byers', '219-202-1048'),
	(10, 'joel@hammondrealty.com', 'serb', 'Joel Hammond', '661-402-4773'),
	(11, 'mparker@gmail.com', 'theantmay', 'May Parker', '212-200-9916'),
	(12, 'mrambeau@airforce.com', 'photon', 'Maria Rambeau', '504-200-1204'),
	(13, 'tony@stark.com', 'ironman', 'Tony Stark', '212-200-9999'),
	(14, 'barton@avg.gov', 'hawkeye', 'Clint Barton', '206-997-6805'),
	(15, 'stanman@marvel.com', 'excalibur', 'Stan Lee', '201-396-6925'),
	(16, 'mwheeler@hotmail.com', 'eleven', 'Mike Wheeler', '219-202-9186'),
	(17, 'nancyw@hotmail.com', 'wh33l3r', 'Nancy Wheeler', '219-202-3710'),
	(18, 'wbyers@yahoo.com', 'mage62', 'Will Byers', '219-202-4816'),
	(19, 'jbyers@yahoo.com', 'thirtyfive', 'Jonathan Byers', '219-202-0014'),
	(20, 'abhammond@gmail.com', 'zombies', 'Abby Hammond', '661-402-9174'),
	(21, 'pparker@gmail.com', 'ffhome', 'Peter Parker', '212-200-9917'),
	(22, 'mrambeau@yahoo.com', 'cptmarv', 'Monica Rambeau', '504-200-2864'),
	(23, 'mstark@gmail.com', 'endgame', 'Morgan Stark', '212-200-9998'),
	(24, 'lila0406@gmail.com', 'arch', 'Lila Barton', '206-997-3662'),
	(25, 'nleeds@gmail.com', 'gitc', 'Ned Leeds', '212-200-2874'),
	(26, 'theflash@gmail.com', 'spman', 'Flash Thompson', '212-209-0623'),
	(27, 'btybrant@gmail.com', 'ned19', 'Betty Brant', '212-216-3887'),
	(28, 'davisb@gmail.com', 'mj4e', 'Brad Davis', '212-221-0397'),
	(29, 'holwheeler@hotmail.com', 'wheels', 'Holly Wheeler', '219-202-5881'),
	(30, 'nbarton@gmail.com', 'littlehawk', 'Nathaniel Barton', '206-997-1981'),
	(31, 'lukewright31@outlook.com', 'lancashirecric31', 'Luke Wright', '890-234-6758'),
	(32, 'kanewilliamson32@gmail.com', 'nzblackcaps32', 'Kane Williamson', '901-210-0027'),
	(33, 'glennmaxi33@hotmail.com', 'reverseslogg@13', 'Glenn Maxwell', '990-567-4567'),
	(34, 'rohitsharma34@gmail.com', 'doublecenturyhitman', 'Rohit Sharma', '883-127-0928'),
	(35, 'iqbaltamim35@outlook.com', 'banglaopemingbat', 'Tamim Iqbal', '990-456-8880'),
	(36, 'kylejamieson36@gmail.com', 'newiequick14crore', 'Kyle Jamieson', '312-562-1101'),
	(37, 'rickyponting37@hotmail.com', 'auslegendgoat', 'Ricky Ponting', '312-678-9023'),
	(38, 'jhyerichard38@yahoo.com', 'fresherquickaus14cr', 'Jhye Richardson', '345-111-3090'),
	(39, 'viratkohli39@outlook.com', 'runmachinekohli', 'Virat Kohli', '690-634-8950'),
	(40, 'abdevilliers40@gmail.com', 'mr360legend ', 'AB de Villiers', '590-999-0030'),
	(41, 'markboucher41@gmail.com', 'veterankeepersa', 'Mark Boucher', '990-674-3892'),
	(42, 'saaedanwar42@outlook.com', 'pakopener1990', 'Saeed Anwar', '762-190-0458'),
	(43, 'chrisgayle43@yahoo.com', 'universeboss', 'Christopher Gayle', '777-333-1000'),
	(44, 'dalesteyn44@gmail.com', 'fastdalespeedgun', 'Dale Steyn', '901-123-5680'),
	(45, 'evanlewis45@gmail.com', 'hardhitbatsman', 'Evan Lewis', '555-890-4920'),
	(46, 'matthayden46@outlook.com', 'ausbigmanopener', 'Matthew Hayden', '760-009-0024'),
	(47, 'andrewstraus47@hotmail.com', 'slowasturtleengope', 'Andrew Strauss', '903-219-9908'),
	(48, 'stephenfleming48@yahoo.com', 'newzielanderskipper', 'Stephen Fleming', '900-001-1001'),
	(49, 'kumarsanga49@outlook.com', 'classyafcoverdrive', 'Kumar Sangha', '901-694-5680'),
	(50, 'srt50@hotmail.com', 'goat100century', 'Sachin Tendulkar', '501-432-9901'),
	(51, 'kevinpiet51@yahoo.com', 'switchhitspecialist', 'Kevin Pieterson', '900-005-9001'),
	(52, 'hopper@yahoo.com', 'theb0ss', 'Jim Hopper', '219-202-1984'),
	(53, 'srogers19@aol.com', 'peggy', 'Steve Rogers', '212-200-6739'),
	(54, 'bbanner@mit.edu', 'gamma', 'Bruce Banner', '212-235-1352'),
	(55, 'og@gregarious.com', 'kira', 'Ogden Morrow', '567-274-4832');
	
-- parents
INSERT INTO `parents` (`parent_id`) VALUES
	(1),
	(2),
	(3),
	(4),
	(5),
	(6),
	(7),
	(8),
	(9),
	(10),
	(11),
	(12),
	(13),
	(14),
	(15);

-- students
INSERT INTO `students` (`student_id`, `grade`, `parent_id`) VALUES
	(16, 7, 8),
	(17, 11, 8),
	(18, 7, 9),
	(19, 11, 9),
	(20, 10, 10),
	(21, 12, 11),
	(22, 6, 12),
	(23, 6, 13),
	(24, 8, 14),
	(25, 12, 15),
	(26, 10, 15),
	(27, 9, 15),
	(28, 12, 15),
	(29, 8, 8),
	(30, 9, 14),
	(31, 7, 1),
	(32, 9, 1),
	(33, 11, 7),
	(34, 8, 4),
	(35, 10, 3),
	(36, 12, 2),
	(37, 12, 6),
	(38, 8, 5),
	(39, 12, 4),
	(40, 7, 1),
	(41, 9, 5),
	(42, 10, 3),
	(43, 11, 7),
	(44, 9, 6),
	(45, 8, 2);

-- admins
INSERT INTO `admins` (`admin_id`) VALUES
	(46),
	(47),
	(48),
	(49),
	(50),
	(51),
	(52),
	(53),
	(54),
	(55);

-- groups
INSERT INTO `groups` (`group_id`, `name`, `description`, `mentor_grade_req`, `mentee_grade_req`) VALUES
	(6, 'Grade 6', 'grade six', 9, 6),
	(7, 'Grade 7', 'grade seven', 10, 7),
	(8, 'Grade 8', 'grade eight', 11, 8),
	(9, 'Grade 9', 'grade nine', 12, 9),
	(10, 'Grade 10', 'grade ten', 13, 10),
	(11, 'Grade 11', 'grade eleven', 14, 11),
	(12, 'Grade 12', 'grade twelve', 15, 12);

-- time slot
INSERT INTO `time_slot` (`time_slot_id`, `day_of_the_week`, `start_time`, `end_time`) VALUES
	(100, 'Monday', '14:00:00', '15:00:00'),
	(101, 'Wednesday', '11:00:00', '12:00:00'),
	(102, 'Thursday', '17:00:00', '18:00:00'),
	(103, 'Sunday', '21:00:00', '22:00:00'),
	(104, 'Tuesday', '03:00:00', '04:00:00'),
	(105, 'Thursday', '14:00:00', '15:00:00'),
	(106, 'Wednesday', '23:00:00', '00:00:00'),
	(107, 'Monday', '19:00:00', '20:00:00'),
	(108, 'Sunday', '13:00:00', '14:00:00'),
	(109, 'Sunday', '23:00:00', '00:00:00'),
	(110, 'Saturday', '02:00:00', '03:00:00'),
	(111, 'Monday', '05:00:00', '06:00:00'),
	(112, 'Friday', '10:00:00', '11:00:00'),
	(113, 'Sunday', '16:00:00', '17:00:00'),
	(114, 'Saturday', '08:00:00', '09:00:00'),
	(115, 'Sunday', '13:00:00', '14:00:00'),
	(116, 'Friday', '05:00:00', '06:00:00'),
	(117, 'Tuesday', '18:00:00', '19:00:00'),
	(118, 'Monday', '17:00:00', '18:00:00'),
	(119, 'Tuesday', '20:00:00', '21:00:00'),
	(120, 'Tuesday', '18:00:00', '19:00:00'),
	(121, 'Wednesday', '22:00:00', '23:00:00'),
	(122, 'Friday', '12:00:00', '13:00:00');

-- meetings
INSERT INTO `meetings` (`meet_id`, `meet_name`, `date`, `time_slot_id`, `capacity`, `announcement`, `group_id`) VALUES
	(1, 'Mathematics budget', '2010-11-20', 110, 50, 'budget meeting', 10),
	(2, 'Pschology budget', '2020-10-26', 118, 271, 'budget meeting', 7),
	(3, 'Accounting budget', '2020-11-06', 112, 255, 'budget meeting', 9),
	(4, 'Chemistry budget', '2020-10-04', 117, 72, 'budget meeting', 12),
	(5, 'Sociology budget', '2020-07-10', 104, 436, 'budget meeting', 6),
	(6, 'Biology budget', '2020-07-07', 120, 958, 'budget meeting', 9),
	(7, 'Buisness budget', '2020-09-22', 111, 477, 'budget meeting', 8),
	(8, 'Computer Science budget', '2020-02-23', 100, 288, 'budget meeting', 12),
	(9, 'Mathematics seminar', '2020-10-21', 109, 364, 'class seminar', 10),
	(10, 'Music budget', '2020-09-18', 106, 187, 'budget meeting', 11),
	(11, 'Economics budget', '2020-11-27', 113, 240, 'budget meeting', 6),
	(12, 'Nuring budget', '2020-01-10', 121, 933, 'budget meeting', 9),
	(13, 'History budget', '2020-11-09', 102, 752, 'budget meeting', 8),
	(14, 'History seminar', '2020-10-25', 115, 952, 'class seminar', 7),
	(15, 'Music seminar', '2020-08-09', 116, 672, 'class seminar', 11),
	(16, 'Buisness seminar', '2020-06-01', 105, 205, 'class seminar', 6),
	(17, 'Art seminar', '2020-08-14', 107, 568, 'class seminar', 12),
	(18, 'Computer Science seminar', '2020-01-03', 108, 878, 'class seminar', 7),
	(19, 'Mathematics confrence', '2020-10-31', 119, 68, 'teacher confrence', 10),
	(20, 'Accounting seminar', '2020-11-07', 122, 943, 'class seminar', 11),
	(21, 'Sociology seminar', '2020-10-09', 103, 859, 'class seminar', 9),
	(22, 'Economics seminar', '2020-11-16', 114, 589, 'class seminar', 9),
	(23, 'Pschology seminar', '2020-03-29', 101, 993, 'class seminar', 7);

-- materials
INSERT INTO `material` (`material_id`, `title`, `author`, `type`, `url`, `assigned_date`, `notes`) VALUES
	(123, 'Science book', 'W.W.', 'SCIENCE', 'WW.COM', '2020-10-12', 'Difficult'),
	(124, 'Book of Art', 'B. Johnson', 'ARTS', 'abcd.com', '2021-03-16', 'Easy to learn'),
	(225, 'Computer Fundamentals', 'C. Watson', 'Computer Science', 'fundamentalsofc.com', '2021-02-24', 'Intermediate level course'),
	(300, 'World war 2 ', 'H. Babbage', 'History', NULL, '0000-00-00', NULL),
	(320, 'Art of Sketching', 'A. Dexter', 'ARTS', NULL, '2021-03-10', NULL),
	(345, 'U.S. History', 'J. Smith', 'History', 'historybook.com', '2021-03-10', '3000 level'),
	(400, 'Linear Algebra', 'W. Rose', 'MATH', 'linalgebra.com', '2021-02-24', 'A.P. level course'),
	(430, 'Global Warming', 'P. Higgins', 'Environmental Science', NULL, '2021-03-03', NULL),
	(450, 'Programming with Basic', 'B. asic', 'Computer Science', 'basic.com', '2021-02-06', 'Beginner level course'),
	(560, 'Lines and Angles', 'R. Achilles', 'MATH', NULL, '2021-02-05', NULL);
