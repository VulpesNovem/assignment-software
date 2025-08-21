/*
 Navicat Premium Dump SQL

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 90100 (9.1.0)
 Source Host           : localhost:3306
 Source Schema         : assignmentsoftware

 Target Server Type    : MySQL
 Target Server Version : 90100 (9.1.0)
 File Encoding         : 65001

 Date: 21/08/2025 17:47:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for announcements
-- ----------------------------
DROP TABLE IF EXISTS `announcements`;
CREATE TABLE `announcements`  (
  `AnnouncementID` int NOT NULL,
  `AnnouncementTitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `AnnouncementDescription` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `EntryDate` datetime NULL DEFAULT NULL,
  `ShowStartDate` datetime NULL DEFAULT NULL,
  `ShowEndDate` datetime NULL DEFAULT NULL,
  `AuthorUserID` int NOT NULL,
  PRIMARY KEY (`AnnouncementID`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of announcements
-- ----------------------------

-- ----------------------------
-- Table structure for archive_disciplines
-- ----------------------------
DROP TABLE IF EXISTS `archive_disciplines`;
CREATE TABLE `archive_disciplines`  (
  `DisciplineID` int NOT NULL AUTO_INCREMENT,
  `DisciplineName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `DisciplineCode` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`DisciplineID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 153 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of archive_disciplines
-- ----------------------------
INSERT INTO `archive_disciplines` VALUES (1, 'AEROSPACE STUDIES (AERO)', 'AERO');
INSERT INTO `archive_disciplines` VALUES (2, 'AFRICAN, AFRICAN-AMERICAN, DIASPORA STUDIES (AAAD)', 'AAAD');
INSERT INTO `archive_disciplines` VALUES (3, 'AMERICAN STUDIES (AMST)', 'AMST');
INSERT INTO `archive_disciplines` VALUES (4, 'ANTHROPOLOGY (ANTH)', 'ANTH');
INSERT INTO `archive_disciplines` VALUES (5, 'APPLIED SCIENCES (APPL)', 'APPL');
INSERT INTO `archive_disciplines` VALUES (6, 'ARABIC (ARAB)', 'ARAB');
INSERT INTO `archive_disciplines` VALUES (7, 'ARCHAEOLOGY (ARCH)', 'ARCH');
INSERT INTO `archive_disciplines` VALUES (8, 'ARMY (ARMY)', 'ARMY');
INSERT INTO `archive_disciplines` VALUES (9, 'ART HISTORY (ARTH)', 'ARTH');
INSERT INTO `archive_disciplines` VALUES (10, 'ASIAN STUDIES (ASIA)', 'ASIA');
INSERT INTO `archive_disciplines` VALUES (11, 'ASTRONOMY (ASTR)', 'ASTR');
INSERT INTO `archive_disciplines` VALUES (12, 'BIOCHEMISTRY (BIOC)', 'BIOC');
INSERT INTO `archive_disciplines` VALUES (13, 'BIOINFORMATICS AND COMPUTATIONAL BIOLOGY (BCB)', 'BCB');
INSERT INTO `archive_disciplines` VALUES (14, 'BIOLOGICAL AND BIOMEDICAL SCIENCES (BBSP)', 'BBSP');
INSERT INTO `archive_disciplines` VALUES (15, 'BIOLOGY (BIOL)', 'BIOL');
INSERT INTO `archive_disciplines` VALUES (16, 'BIOMEDICAL ENGINEERING (BMME)', 'BMME');
INSERT INTO `archive_disciplines` VALUES (17, 'BIOSTATISTICS (BIOS)\r\n', 'BIOS');
INSERT INTO `archive_disciplines` VALUES (18, 'BOSNIAN-CROATIAN-SERBIAN (BCS)', 'BCS');
INSERT INTO `archive_disciplines` VALUES (19, 'BUSINESS ADMINISTRATION (BUSI)', 'BUSI');
INSERT INTO `archive_disciplines` VALUES (20, 'CAROLINA HEALTH INFORMATICS PROGRAM (CHIP)', 'CHIP');
INSERT INTO `archive_disciplines` VALUES (21, 'CATALAN (CATA)', 'CATA');
INSERT INTO `archive_disciplines` VALUES (22, 'CELL BIOLOGY AND PHYSIOLOGY (CBPH)', 'CBPH');
INSERT INTO `archive_disciplines` VALUES (23, 'CHEMICAL BIOLOGY AND MEDICINAL CHEMISTRY (CBMC)', 'CBMC');
INSERT INTO `archive_disciplines` VALUES (24, 'CHEMISTRY (CHEM)', 'CHEM');
INSERT INTO `archive_disciplines` VALUES (25, 'CHEROKEE (CHER)', 'CHER');
INSERT INTO `archive_disciplines` VALUES (26, 'CHICHEWA (CHWA)', 'CHWA');
INSERT INTO `archive_disciplines` VALUES (27, 'CHINESE (CHIN)', 'CHIN');
INSERT INTO `archive_disciplines` VALUES (28, 'CITY AND REGIONAL PLANNING (PLAN)', 'PLAN');
INSERT INTO `archive_disciplines` VALUES (29, 'CLASSICAL ARCHAEOLOGY (CLAR)', 'CLAR');
INSERT INTO `archive_disciplines` VALUES (30, 'CLASSICS (CLAS)', 'CLAS');
INSERT INTO `archive_disciplines` VALUES (31, 'CLINICAL LABORATORY SCIENCE (CLSC)', 'CLSC');
INSERT INTO `archive_disciplines` VALUES (32, 'CLINICAL REHABILITATION AND MENTAL HEALTH COUNSELING (CRMH)', 'CRMH');
INSERT INTO `archive_disciplines` VALUES (33, 'COMMUNICATION STUDIES (COMM)', 'COMM');
INSERT INTO `archive_disciplines` VALUES (34, 'COMPARATIVE LITERATURE (CMPL)', 'CMPL');
INSERT INTO `archive_disciplines` VALUES (35, 'COMPUTER SCIENCE (COMP)', 'COMP');
INSERT INTO `archive_disciplines` VALUES (36, 'CONTEMPORARY EUROPEAN STUDIES (EURO)', 'EURO');
INSERT INTO `archive_disciplines` VALUES (37, 'CZECH (CZCH)', 'CZCH');
INSERT INTO `archive_disciplines` VALUES (38, 'DATA SCIENCE AND SOCIETY (DATA)', 'DATA');
INSERT INTO `archive_disciplines` VALUES (39, 'DENTAL GRADUATE COURSE (DENG)', 'DENG');
INSERT INTO `archive_disciplines` VALUES (40, 'DENTAL HYGIENE (DHYG)', 'DHYG');
INSERT INTO `archive_disciplines` VALUES (41, 'DENTAL HYGIENE EDUCATION (DHED)', 'DHED');
INSERT INTO `archive_disciplines` VALUES (42, 'DRAMATIC ART (DRAM)', 'DRAM');
INSERT INTO `archive_disciplines` VALUES (43, 'DUTCH (DTCH)', 'DTCH');
INSERT INTO `archive_disciplines` VALUES (44, 'EARTH, MARINE, AND ENVIRONMENTAL SCIENCES (EMES)', 'EMES');
INSERT INTO `archive_disciplines` VALUES (45, 'ECONOMICS (ECON)', 'ECON');
INSERT INTO `archive_disciplines` VALUES (46, 'EDUCATION (EDUC)', 'EDUC');
INSERT INTO `archive_disciplines` VALUES (47, 'ENDODONTICS (ENDO)', 'ENDO');
INSERT INTO `archive_disciplines` VALUES (48, 'ENGLISH (ENGL)', 'ENGL');
INSERT INTO `archive_disciplines` VALUES (49, 'ENVIRONMENTAL SCIENCES AND ENGINEERING (ENVR)', 'ENVR');
INSERT INTO `archive_disciplines` VALUES (50, 'ENVIRONMENT AND ECOLOGY (ENEC)', 'ENEC');
INSERT INTO `archive_disciplines` VALUES (51, 'EPIDEMIOLOGY (EPID)', 'EPID');
INSERT INTO `archive_disciplines` VALUES (52, '\r\nEXERCISE AND SPORT SCIENCE (EXSS)', 'EXSS');
INSERT INTO `archive_disciplines` VALUES (53, 'EXPERIENCED TEACHER EDUCATION (EDMX)', 'EDMX');
INSERT INTO `archive_disciplines` VALUES (54, 'EXPERIENTIAL AND SPECIAL STUDIES (SPCL)', 'SPCL');
INSERT INTO `archive_disciplines` VALUES (55, 'EXPERIMENTAL THERAPEUTICS (DPET)', 'DPET');
INSERT INTO `archive_disciplines` VALUES (56, 'FOLKLORE (FOLK)', 'FOLK');
INSERT INTO `archive_disciplines` VALUES (57, 'FRENCH (FREN)', 'FREN');
INSERT INTO `archive_disciplines` VALUES (58, 'GENETICS AND MOLECULAR BIOLOGY (GNET)', 'GNET');
INSERT INTO `archive_disciplines` VALUES (59, 'GEOGRAPHY (GEOG)', 'GEOG');
INSERT INTO `archive_disciplines` VALUES (60, 'GEOLOGICAL SCIENCES (GEOL)', 'GEOL');
INSERT INTO `archive_disciplines` VALUES (61, 'GERMAN (GERM)', 'GERM');
INSERT INTO `archive_disciplines` VALUES (62, 'GERMANIC AND SLAVIC LANGUAGES AND LITERATURES (GSLL)', 'GSLL');
INSERT INTO `archive_disciplines` VALUES (63, 'GLOBAL STUDIES (GLBL)', 'GLBL');
INSERT INTO `archive_disciplines` VALUES (64, 'GOVERNMENT (GOVT)', 'GOVT');
INSERT INTO `archive_disciplines` VALUES (65, 'GRADUATE STUDIES (GRAD)', 'GRAD');
INSERT INTO `archive_disciplines` VALUES (66, 'GREEK (GREK)', 'GREK');
INSERT INTO `archive_disciplines` VALUES (67, 'HEALTH BEHAVIOR (HBEH)', 'HBEH');
INSERT INTO `archive_disciplines` VALUES (68, 'HEALTH POLICY AND MANAGEMENT (HPM)', 'HPM');
INSERT INTO `archive_disciplines` VALUES (69, 'HEBREW (HEBR)', 'HEBR');
INSERT INTO `archive_disciplines` VALUES (70, 'HINDI-URDU (HNUR)', 'HNUR');
INSERT INTO `archive_disciplines` VALUES (71, 'HISTORY (HIST)', 'HIST');
INSERT INTO `archive_disciplines` VALUES (72, 'HUNGARIAN (HUNG)', 'HUNG');
INSERT INTO `archive_disciplines` VALUES (73, 'INFORMATION AND LIBRARY SCIENCE (INLS)', 'INLS');
INSERT INTO `archive_disciplines` VALUES (74, 'INTERDISCIPLINARY STUDIES (IDST)', 'IDST');
INSERT INTO `archive_disciplines` VALUES (75, 'INTRODUCTION TO CLINICAL MEDICINE UNDERGRADUATE (ICMU)', 'ICMU');
INSERT INTO `archive_disciplines` VALUES (76, 'ITALIAN (ITAL)', 'ITAL');
INSERT INTO `archive_disciplines` VALUES (77, 'JAPANESE (JAPN)', 'JAPN');
INSERT INTO `archive_disciplines` VALUES (78, 'JEWISH STUDIES (JWST)', 'JWST');
INSERT INTO `archive_disciplines` VALUES (79, 'KISWAHILI (SWAH)', 'SWAH');
INSERT INTO `archive_disciplines` VALUES (80, 'KOREAN (KOR)', 'KOR');
INSERT INTO `archive_disciplines` VALUES (81, 'LATIN AMERICAN STUDIES (LTAM)', 'LTAM');
INSERT INTO `archive_disciplines` VALUES (82, 'LATIN (LATN)', 'LATN');
INSERT INTO `archive_disciplines` VALUES (83, 'LAW (LAW)', 'LAW');
INSERT INTO `archive_disciplines` VALUES (84, 'LIFETIME FITNESS (LFIT)', 'LFIT');
INSERT INTO `archive_disciplines` VALUES (85, 'LINGALA LANGUAGE (LGLA)', 'LGLA');
INSERT INTO `archive_disciplines` VALUES (86, 'LINGUISTICS (LING)', 'LING');
INSERT INTO `archive_disciplines` VALUES (87, 'MACEDONIAN (MACD)', 'MACD');
INSERT INTO `archive_disciplines` VALUES (88, 'MANAGEMENT AND SOCIETY (MNGT)', 'MNGT');
INSERT INTO `archive_disciplines` VALUES (89, 'MARINE SCIENCE (MASC)', 'MASC');
INSERT INTO `archive_disciplines` VALUES (90, 'MATERIAL SCIENCE (MTSC)', 'MTSC');
INSERT INTO `archive_disciplines` VALUES (91, 'MATERNAL AND CHILD HEALTH (MHCH)', 'MHCH');
INSERT INTO `archive_disciplines` VALUES (92, 'MATHEMATICS (MATH)', 'MATH');
INSERT INTO `archive_disciplines` VALUES (93, 'MEDIA AND JOURNALISM (MEJO)', 'MEJO');
INSERT INTO `archive_disciplines` VALUES (94, 'MICROBIOLOGY (MCRO)', 'MCRO');
INSERT INTO `archive_disciplines` VALUES (95, 'MUSIC (MUSC)', 'MUSC');
INSERT INTO `archive_disciplines` VALUES (96, 'NAVAL SCIENCE (NAVS)', 'NAVS');
INSERT INTO `archive_disciplines` VALUES (97, 'NEURODIAGNOSTICS AND SLEEP SCIENCE (NDSS)', 'NDSS');
INSERT INTO `archive_disciplines` VALUES (98, 'NEUROSCIENCE (NBIO)', 'NBIO');
INSERT INTO `archive_disciplines` VALUES (99, 'NEUROSCIENCE (NSCI)', 'NSCI');
INSERT INTO `archive_disciplines` VALUES (100, 'NURSING (NURS)', 'NURS');
INSERT INTO `archive_disciplines` VALUES (101, 'NUTRITION (NUTR)', 'NUTR');
INSERT INTO `archive_disciplines` VALUES (102, 'OCCUPATIONAL SCIENCE (OCSC)', 'OCSC');
INSERT INTO `archive_disciplines` VALUES (103, 'OCCUPATIONAL THERAPY (OCCT)', 'OCCT');
INSERT INTO `archive_disciplines` VALUES (104, 'OPERATIVE DENTISTRY (OPER)', 'OPER');
INSERT INTO `archive_disciplines` VALUES (105, 'ORAL PATHOLOGY (ORPA)', 'OPRA');
INSERT INTO `archive_disciplines` VALUES (106, 'ORAL RADIOLOGY (ORAD)', 'ORAD');
INSERT INTO `archive_disciplines` VALUES (107, 'ORTHODONTICS (ORTH)', 'ORTH');
INSERT INTO `archive_disciplines` VALUES (108, 'PATHOLOGY (PATH)', 'PATH');
INSERT INTO `archive_disciplines` VALUES (109, 'PEACE, WAR, AND DEFENSE (PWAD)', 'PWAD');
INSERT INTO `archive_disciplines` VALUES (110, 'PEDIATRIC DENTISTRY (PEDO)', 'PEDO');
INSERT INTO `archive_disciplines` VALUES (111, 'PERIODONTOLOGY (PERI)', 'PERI');
INSERT INTO `archive_disciplines` VALUES (112, 'PERSIAN (PRSN)', 'PRSN');
INSERT INTO `archive_disciplines` VALUES (113, 'PHARMACEUTICAL SCIENCES (PHRS)', 'PHRS');
INSERT INTO `archive_disciplines` VALUES (114, 'PHARMACOENGINEERING AND MOLECULAR PHARMACEUTICS (DPMP)', 'DPMP');
INSERT INTO `archive_disciplines` VALUES (115, 'PHARMACOLOGY (PHCO)', 'PHCO');
INSERT INTO `archive_disciplines` VALUES (116, 'PHARMACY (NON-DEPARTMENTAL) (PHCY)', 'PHCY');
INSERT INTO `archive_disciplines` VALUES (117, 'PHARMACY OUTCOMES AND POLICY (DPOP)', 'DPOP');
INSERT INTO `archive_disciplines` VALUES (118, 'PHILOSOPHY (PHIL)', 'PHIL');
INSERT INTO `archive_disciplines` VALUES (119, 'PHYSICAL ACTIVITIES (PHYA)', 'PHYA');
INSERT INTO `archive_disciplines` VALUES (120, 'PHYSICIAN ASSISTANT STUDIES (PASC)', 'PASC');
INSERT INTO `archive_disciplines` VALUES (121, 'PHYSICS (PHYS)', 'PHYS');
INSERT INTO `archive_disciplines` VALUES (122, 'POLISH (PLSH)', 'PLSH');
INSERT INTO `archive_disciplines` VALUES (123, 'POLITICAL SCIENCE (POLI)', 'POLI');
INSERT INTO `archive_disciplines` VALUES (124, 'PORTUGUESE (PORT)', 'PORT');
INSERT INTO `archive_disciplines` VALUES (125, 'PRACTICE ADVANCEMENT AND CLINICAL EDUCATION (PACE)', 'PACE');
INSERT INTO `archive_disciplines` VALUES (126, 'PROSTHODONTICS (PROS)', 'PROS');
INSERT INTO `archive_disciplines` VALUES (127, 'PSYCHOLOGY (PSYC)', 'PSYC');
INSERT INTO `archive_disciplines` VALUES (128, 'PUBLIC ADMINISTRATION (PUBA)', 'PUBA');
INSERT INTO `archive_disciplines` VALUES (129, 'PUBLIC HEALTH (PUBH)', 'PUBH');
INSERT INTO `archive_disciplines` VALUES (130, 'PUBLIC POLICY (PLCY)', 'PLCY');
INSERT INTO `archive_disciplines` VALUES (131, 'RADIOLOGIC SCIENCE (RADI)', 'RADI');
INSERT INTO `archive_disciplines` VALUES (132, 'RECREATION AND LEISURE STUDIES (RECR)', 'RECR');
INSERT INTO `archive_disciplines` VALUES (133, 'RELIGIOUS STUDIES (RELI)', 'RELI');
INSERT INTO `archive_disciplines` VALUES (134, 'ROMANCE LANGUAGES (ROML)', 'POML');
INSERT INTO `archive_disciplines` VALUES (135, 'RUSSIAN (RUSS)', 'RUSS');
INSERT INTO `archive_disciplines` VALUES (136, 'SCHOOL OF CIVIC LIFE AND LEADERSHIP (SCLL)', 'SCLL');
INSERT INTO `archive_disciplines` VALUES (137, 'SCHOOL OF PUBLIC HEALTH GENERAL (SPHG)', 'SPHG');
INSERT INTO `archive_disciplines` VALUES (138, 'SLAVIC LANGUAGES (SLAV)', 'SLAV');
INSERT INTO `archive_disciplines` VALUES (139, 'SOCIAL WORK (SOWO)', 'SOWO');
INSERT INTO `archive_disciplines` VALUES (140, 'SOCIOLOGY (SOCI)', 'SOCI');
INSERT INTO `archive_disciplines` VALUES (141, 'SPANISH (SPAN)', 'SPAN');
INSERT INTO `archive_disciplines` VALUES (142, 'SPEECH AND HEARING SCIENCES (SPHS)', 'SPHS');
INSERT INTO `archive_disciplines` VALUES (143, 'STATISTICS AND OPERATIONS RESEARCH (STOR)', 'STOR');
INSERT INTO `archive_disciplines` VALUES (144, 'STUDIO ART (ARTS)', 'ARTS');
INSERT INTO `archive_disciplines` VALUES (145, 'TOXICOLOGY (TOXC)', 'TOXC');
INSERT INTO `archive_disciplines` VALUES (146, 'TURKISH (TURK)', 'TURK');
INSERT INTO `archive_disciplines` VALUES (147, 'UKRAINIAN (UKRN)', 'UKRN');
INSERT INTO `archive_disciplines` VALUES (148, 'UNDERGRADUATE RESEARCH (URES)', 'URES');
INSERT INTO `archive_disciplines` VALUES (149, 'VIETNAMESE (VIET)', 'VIET');
INSERT INTO `archive_disciplines` VALUES (150, 'WOLOF LANGUAGE (WOLO)', 'WOLO');
INSERT INTO `archive_disciplines` VALUES (151, 'WOMEN\'S AND GENDER STUDIES (WGST)', 'WGST');
INSERT INTO `archive_disciplines` VALUES (152, 'YORUBA LANGUAGE (YORU)', 'YORU');

-- ----------------------------
-- Table structure for assignment_types
-- ----------------------------
DROP TABLE IF EXISTS `assignment_types`;
CREATE TABLE `assignment_types`  (
  `AssignmentTypeID` int NOT NULL AUTO_INCREMENT,
  `AssignmentType` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Icon` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`AssignmentTypeID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of assignment_types
-- ----------------------------
INSERT INTO `assignment_types` VALUES (1, 'Assignment', 'bi-file-earmark-fill');
INSERT INTO `assignment_types` VALUES (2, 'Paper', 'bi-card-heading');
INSERT INTO `assignment_types` VALUES (3, 'Quiz', 'bi-pencil-fill');
INSERT INTO `assignment_types` VALUES (4, 'Exam', 'bi-vector-pen');
INSERT INTO `assignment_types` VALUES (5, 'Other', 'bi-archive-fill');

-- ----------------------------
-- Table structure for assignments
-- ----------------------------
DROP TABLE IF EXISTS `assignments`;
CREATE TABLE `assignments`  (
  `AssignmentID` int NOT NULL AUTO_INCREMENT,
  `AssignmentTypeID` int NOT NULL,
  `AssignmentName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `AssignmentDescription` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `CourseID` int NOT NULL,
  `SourceLink` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `DueDate` datetime NULL DEFAULT NULL,
  `EntryDate` datetime NULL DEFAULT NULL,
  `Complete` tinyint NULL DEFAULT NULL,
  PRIMARY KEY (`AssignmentID`) USING BTREE,
  INDEX `CourseID`(`CourseID` ASC) USING BTREE,
  INDEX `AssignmentTypeID`(`AssignmentTypeID` ASC) USING BTREE,
  CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `assignments_ibfk_2` FOREIGN KEY (`AssignmentTypeID`) REFERENCES `assignment_types` (`AssignmentTypeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of assignments
-- ----------------------------
INSERT INTO `assignments` VALUES (1, 1, 'Test Assignment', 'This is just a test', 36, 'youtube.com', '2025-07-15 19:22:08', '2025-07-13 19:22:19', 1);
INSERT INTO `assignments` VALUES (4, 2, 'Quiz IV', 'Quiz Example', 16, '', '2025-07-23 19:24:32', '2025-07-13 19:24:43', 1);
INSERT INTO `assignments` VALUES (5, 3, 'Quiz I', 'Example Quiz', 36, NULL, '2025-07-30 19:30:00', '2025-07-13 19:30:10', 0);
INSERT INTO `assignments` VALUES (6, 4, 'Project Example', 'Example of a project', 36, NULL, '2025-07-15 19:32:33', '2025-07-13 19:32:37', 0);
INSERT INTO `assignments` VALUES (8, 5, 'Project II', 'New Porject', 36, NULL, '2025-07-01 19:52:14', '2025-07-13 19:52:20', 0);
INSERT INTO `assignments` VALUES (18, 3, 'New Assignment Test', '', 36, '', '2025-07-23 23:59:00', '2025-07-19 15:56:26', 0);
INSERT INTO `assignments` VALUES (19, 2, 'New Assignment Test', 'ssdvsdvds', 36, 'https://www.youtube.com/', '2025-07-22 23:59:00', '2025-07-19 15:56:47', 0);
INSERT INTO `assignments` VALUES (20, 4, 'New Assignment Test II', 'svfsdvsvdsdvsv', 36, 'https://www.youtube.com/', '2025-07-26 23:59:00', '2025-07-19 15:57:50', 0);
INSERT INTO `assignments` VALUES (21, 2, 'New Assignment Test III', '', 36, '', '2025-07-30 01:15:00', '2025-07-19 17:11:35', 1);
INSERT INTO `assignments` VALUES (22, 4, 'New Assignment Exam IV', 'rdthk', 36, 'https://www.youtube.com/', '2025-08-09 18:19:00', '2025-07-19 17:14:05', 1);
INSERT INTO `assignments` VALUES (23, 2, 'Source No Link', 'ferferferferferferferferferferferferferferfr', 39, '', '2025-07-31 14:00:00', '2025-07-19 18:58:29', 0);
INSERT INTO `assignments` VALUES (24, 1, 'Source No Name', 'dvdfvdfgbfdvcsd', 40, 'https://www.youtube.com/', '2025-08-09 14:00:00', '2025-07-19 18:59:45', 1);

-- ----------------------------
-- Table structure for connection_requests
-- ----------------------------
DROP TABLE IF EXISTS `connection_requests`;
CREATE TABLE `connection_requests`  (
  `ConnectionRequestID` int NOT NULL AUTO_INCREMENT,
  `SenderUserID` int NOT NULL,
  `RecipientUserID` int NOT NULL,
  `EntryDate` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`ConnectionRequestID`) USING BTREE,
  INDEX `SenderUserID`(`SenderUserID` ASC) USING BTREE,
  INDEX `RecipientUserID`(`RecipientUserID` ASC) USING BTREE,
  CONSTRAINT `connection_requests_ibfk_1` FOREIGN KEY (`SenderUserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `connection_requests_ibfk_2` FOREIGN KEY (`RecipientUserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of connection_requests
-- ----------------------------

-- ----------------------------
-- Table structure for courses
-- ----------------------------
DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses`  (
  `CourseID` int NOT NULL AUTO_INCREMENT,
  `UserID` int NOT NULL,
  `CourseName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `CourseNumber` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `SemesterID` int NULL DEFAULT NULL,
  `EntryDate` timestamp NULL DEFAULT NULL,
  `CardColor` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`CourseID`) USING BTREE,
  INDEX `SemesterID`(`SemesterID` ASC) USING BTREE,
  INDEX `UserID`(`UserID` ASC) USING BTREE,
  CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`SemesterID`) REFERENCES `semesters` (`SemesterID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `courses_ibfk_3` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 54 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of courses
-- ----------------------------
INSERT INTO `courses` VALUES (1, 1, 'Data Structures and Analysis', '210', 2, '2025-06-22 21:50:51', 'e8383b');
INSERT INTO `courses` VALUES (2, 1, 'Calculus of Functions of One Variable II', '232', 2, '2025-06-24 19:14:16', '38e844');
INSERT INTO `courses` VALUES (3, 1, 'Countering Hate', '129I', 1, '2025-06-24 19:15:38', 'e838d9');
INSERT INTO `courses` VALUES (4, 1, 'Introduction to Programming', '110', 1, '2025-06-24 19:24:00', 'e8383b');
INSERT INTO `courses` VALUES (5, 1, 'Ancient Mediterranean, Egyptian, and Near Eastern Archaeology', '120', 1, '2025-06-25 18:56:41', 'e89a38');
INSERT INTO `courses` VALUES (6, 1, 'Discrete Structures', '283', 2, '2025-06-25 18:58:00', 'e8383b');
INSERT INTO `courses` VALUES (7, 1, 'English Composition and Rhetoric', '105', 1, '2025-06-25 18:59:07', 'e8de38');
INSERT INTO `courses` VALUES (8, 1, 'French for High Beginners', '105', 2, '2025-06-25 18:59:51', 'cc38e8');
INSERT INTO `courses` VALUES (9, 1, 'Data Literacy Lab', '129L', 1, '2025-06-25 19:01:54', 'e838d9');
INSERT INTO `courses` VALUES (10, 1, 'First-Year Seminar: Handcrafting in the Nanoworld: Building Models and Manipulating Molecules', '53', 1, '2025-06-25 19:03:36', '38c7e8');
INSERT INTO `courses` VALUES (11, 1, 'College Thriving', '101', 1, '2025-06-28 16:08:41', 'e838d9');
INSERT INTO `courses` VALUES (12, 1, 'Intermediate French Idbggcnbbgf', '203b', 5, '2025-06-28 16:11:53', 'ff0000');
INSERT INTO `courses` VALUES (13, 1, 'Foundations of Programming', '301', 5, '2025-06-28 16:12:35', 'e8383b');
INSERT INTO `courses` VALUES (14, 1, 'Systems Fundamentals', '211', 5, '2025-06-28 16:13:13', 'e8383b');
INSERT INTO `courses` VALUES (15, 1, 'AI and the Future of Humanity: Philosophical Issues about Technology and Human Survival', '143', 5, '2025-06-28 16:14:06', 'e8b338');
INSERT INTO `courses` VALUES (16, 1, 'Asian Religions', '183', 5, '2025-06-28 16:15:06', 'e8b338');
INSERT INTO `courses` VALUES (36, 1, 'Test Course Edit II', '124', 4, '2025-07-06 00:00:00', '00ccff');
INSERT INTO `courses` VALUES (37, 2, 'Test Course', '101', 6, '2025-07-12 00:00:00', '000000');
INSERT INTO `courses` VALUES (39, 1, 'Test Course II', '201', 4, '2025-07-13 00:00:00', '44ff00');
INSERT INTO `courses` VALUES (40, 1, 'Test Course III', '301', 4, '2025-07-13 00:00:00', '0091ff');
INSERT INTO `courses` VALUES (44, 1, 'Test Course IV', '401', 4, '2025-07-13 00:00:00', '000000');
INSERT INTO `courses` VALUES (45, 1, 'Test Course V', '501', 4, '2025-07-13 00:00:00', '000000');
INSERT INTO `courses` VALUES (46, 1, 'Test Course VI', '601', 4, '2025-07-13 00:00:00', '000000');
INSERT INTO `courses` VALUES (47, 1, 'Test Course VI', '601', 4, '2025-07-13 00:00:00', '000000');
INSERT INTO `courses` VALUES (48, 1, 'Test Course VII', '701', 4, '2025-07-13 00:00:00', '000000');
INSERT INTO `courses` VALUES (49, 1, 'Test Course IX', '901', 4, '2025-07-19 15:23:01', '000000');
INSERT INTO `courses` VALUES (52, 1, 'Test Course X', '101L', 4, '2025-07-19 15:42:22', '000000');
INSERT INTO `courses` VALUES (53, 1, 'vdfdvdfvdfv', 'vdfvdfvfdvdfvfdv', 5, '2025-08-20 21:46:09', '000000');

-- ----------------------------
-- Table structure for logs
-- ----------------------------
DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs`  (
  `LogID` int NOT NULL AUTO_INCREMENT,
  `LogType` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `LogDetails` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `UserID` int NOT NULL,
  `EntryDate` datetime NOT NULL,
  `IPAddress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`LogID`) USING BTREE,
  INDEX `FromUserID`(`UserID` ASC) USING BTREE,
  CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 283 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of logs
-- ----------------------------
INSERT INTO `logs` VALUES (4, 'Insert', 'Inserted new item in courses with data: {\"CourseName\":\"Test Course VII\",\"DisciplineID\":\"63\",\"CourseNumber\":\"701\",\"SectionNumber\":\"456\",\"SemesterID\":\"4\",\"UserID\":1,\"EntryDate\":\"2025-07-13\",\"CardColor\":\"000000\"}', 1, '2025-07-13 19:55:15', '::1');
INSERT INTO `logs` VALUES (5, 'Update', 'Updated item 36 in courses with data: {\"CardColor\":\"ff0000\"}', 1, '2025-07-13 19:55:58', '::1');
INSERT INTO `logs` VALUES (6, 'Update', 'Updated item 1 in users with data: {\"ThemeID\":\"2\"}', 1, '2025-07-13 19:56:15', '::1');
INSERT INTO `logs` VALUES (7, 'Update', 'Updated item 36 in courses with data: {\"CardColor\":\"00ccff\"}', 1, '2025-07-13 21:06:29', '::1');
INSERT INTO `logs` VALUES (8, 'Update', 'Updated item 1 in users with data: {\"ThemeID\":\"7\"}', 1, '2025-07-14 00:01:19', '::1');
INSERT INTO `logs` VALUES (9, 'Login', 'Login to account 1 with data: {\"UserID\":1,\"FirstName\":\"Elijah\",\"LastName\":\"Jones\",\"Email\":\"elijahcjives@gmail.com\",\"ThemeID\":7}', 1, '2025-07-16 12:40:00', '::1');
INSERT INTO `logs` VALUES (10, 'Update', 'Updated item 1 in users with data: {\"ThemeID\":\"1\"}', 1, '2025-07-16 12:40:08', '::1');
INSERT INTO `logs` VALUES (11, 'Login', 'Login to account 1 with data: {\"UserID\":1,\"FirstName\":\"Elijah\",\"LastName\":\"Jones\",\"Email\":\"elijahcjives@gmail.com\",\"ThemeID\":1}', 1, '2025-07-19 13:51:37', '::1');
INSERT INTO `logs` VALUES (12, 'Insert', 'Inserted new item in courses with data: {\"CourseName\":\"Test Course IX\",\"DisciplineID\":\"83\",\"CourseNumber\":\"901\",\"SectionNumber\":\"982\",\"SemesterID\":\"4\",\"UserID\":1,\"EntryDate\":\"2025-07-19 15:23:01\",\"CardColor\":\"000000\"}', 1, '2025-07-19 15:23:01', '::1');
INSERT INTO `logs` VALUES (13, 'Update', 'Updated item 36 in courses with data: []', 1, '2025-07-19 15:38:49', '::1');
INSERT INTO `logs` VALUES (14, 'Insert', 'Inserted new item in courses with data: {\"UserID\":1,\"EntryDate\":\"2025-07-19 15:38:57\",\"CardColor\":\"000000\"}', 1, '2025-07-19 15:38:57', '::1');
INSERT INTO `logs` VALUES (15, 'Insert', 'Inserted new item in courses with data: {\"UserID\":1,\"EntryDate\":\"2025-07-19 15:39:01\",\"CardColor\":\"000000\"}', 1, '2025-07-19 15:39:01', '::1');
INSERT INTO `logs` VALUES (16, 'Insert', 'Inserted new item in assignments with data: {\"EntryDate\":\"2025-07-19 15:40:29\",\"Complete\":\"0\"}', 1, '2025-07-19 15:40:29', '::1');
INSERT INTO `logs` VALUES (17, 'Insert', 'Inserted new item in assignments with data: {\"EntryDate\":\"2025-07-19 15:41:07\",\"Complete\":\"0\"}', 1, '2025-07-19 15:41:07', '::1');
INSERT INTO `logs` VALUES (18, 'Insert', 'Inserted new item in assignments with data: {\"EntryDate\":\"2025-07-19 15:41:13\",\"Complete\":\"0\"}', 1, '2025-07-19 15:41:13', '::1');
INSERT INTO `logs` VALUES (19, 'Insert', 'Inserted new item in courses with data: {\"CourseName\":\"Test Course X\",\"DisciplineID\":\"15\",\"CourseNumber\":\"101L\",\"SectionNumber\":\"456\",\"SemesterID\":\"4\",\"UserID\":1,\"EntryDate\":\"2025-07-19 15:42:22\",\"CardColor\":\"000000\"}', 1, '2025-07-19 15:42:22', '::1');
INSERT INTO `logs` VALUES (20, 'Insert', 'Inserted new item in assignments with data: {\"EntryDate\":\"2025-07-19 15:46:52\",\"Complete\":\"0\"}', 1, '2025-07-19 15:46:52', '::1');
INSERT INTO `logs` VALUES (21, 'Insert', 'Inserted new item in assignments with data: {\"EntryDate\":\"2025-07-19 15:46:57\",\"Complete\":\"0\"}', 1, '2025-07-19 15:46:57', '::1');
INSERT INTO `logs` VALUES (22, 'Insert', 'Inserted new item in assignments with data: {\"EntryDate\":\"2025-07-19 15:53:45\",\"Complete\":\"0\"}', 1, '2025-07-19 15:53:45', '::1');
INSERT INTO `logs` VALUES (23, 'Insert', 'Inserted new item in assignments with data: {\"EntryDate\":\"2025-07-19 15:53:50\",\"Complete\":\"0\"}', 1, '2025-07-19 15:53:50', '::1');
INSERT INTO `logs` VALUES (24, 'Insert', 'Inserted new item in assignments with data: {\"EntryDate\":\"2025-07-19 15:55:40\",\"Complete\":\"0\"}', 1, '2025-07-19 15:55:40', '::1');
INSERT INTO `logs` VALUES (25, 'Insert', 'Inserted new item in assignments with data: {\"EntryDate\":\"2025-07-19 15:56:02\",\"Complete\":\"0\"}', 1, '2025-07-19 15:56:02', '::1');
INSERT INTO `logs` VALUES (26, 'Insert', 'Inserted new item in assignments with data: {\"AssignmentTypeID\":\"3\",\"AssignmentName\":\"New Assignment Test\",\"AssignmentDescription\":\"\",\"CourseID\":\"36\",\"SourceName\":\"\",\"SourceLink\":\"\",\"DueDate\":\"2025-07-23 23:59:00\",\"EntryDate\":\"2025-07-19 15:56:26\",\"Complete\":\"0\"}', 1, '2025-07-19 15:56:26', '::1');
INSERT INTO `logs` VALUES (27, 'Insert', 'Inserted new item in assignments with data: {\"AssignmentTypeID\":\"2\",\"AssignmentName\":\"New Assignment Test\",\"AssignmentDescription\":\"ssdvsdvds\",\"CourseID\":\"36\",\"SourceName\":\"Youtube\",\"SourceLink\":\"https:\\/\\/www.youtube.com\\/\",\"DueDate\":\"2025-07-22 23:59:00\",\"EntryDate\":\"2025-07-19 15:56:47\",\"Complete\":\"0\"}', 1, '2025-07-19 15:56:47', '::1');
INSERT INTO `logs` VALUES (28, 'Insert', 'Inserted new item in assignments with data: {\"AssignmentTypeID\":\"4\",\"AssignmentName\":\"New Assignment Test II\",\"AssignmentDescription\":\"svfsdvsvdsdvsv\",\"CourseID\":\"36\",\"SourceName\":\"Youtube\",\"SourceLink\":\"https:\\/\\/www.youtube.com\\/\",\"DueDate\":\"2025-07-26 23:59:00\",\"EntryDate\":\"2025-07-19 15:57:50\",\"Complete\":\"0\"}', 1, '2025-07-19 15:57:50', '::1');
INSERT INTO `logs` VALUES (29, 'Insert', 'Inserted new item in assignments with data: {\"AssignmentTypeID\":\"2\",\"AssignmentName\":\"New Assignment Test III\",\"AssignmentDescription\":\"\",\"CourseID\":\"36\",\"SourceName\":\"\",\"SourceLink\":\"\",\"DueDate\":\"2025-07-30 01:15:00\",\"EntryDate\":\"2025-07-19 17:11:35\",\"Complete\":\"0\"}', 1, '2025-07-19 17:11:35', '::1');
INSERT INTO `logs` VALUES (30, 'Insert', 'Inserted new item in assignments with data: {\"AssignmentTypeID\":\"2\",\"AssignmentName\":\"New Assignment Test IV\",\"AssignmentDescription\":\"eveferferf\",\"CourseID\":\"36\",\"SourceName\":\"Youtube\",\"SourceLink\":\"https:\\/\\/www.youtube.com\\/\",\"DueDate\":\"2025-07-22 13:14:00\",\"EntryDate\":\"2025-07-19 17:14:05\",\"Complete\":\"0\"}', 1, '2025-07-19 17:14:05', '::1');
INSERT INTO `logs` VALUES (31, 'Update', 'Updated item 4 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:24:20', '::1');
INSERT INTO `logs` VALUES (32, 'Update', 'Updated item 4 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:24:21', '::1');
INSERT INTO `logs` VALUES (33, 'Update', 'Updated item 4 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:24:23', '::1');
INSERT INTO `logs` VALUES (34, 'Update', 'Updated item 18 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:28:31', '::1');
INSERT INTO `logs` VALUES (35, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:30:19', '::1');
INSERT INTO `logs` VALUES (36, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:30:19', '::1');
INSERT INTO `logs` VALUES (37, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:30:21', '::1');
INSERT INTO `logs` VALUES (38, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:30:22', '::1');
INSERT INTO `logs` VALUES (39, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:30:27', '::1');
INSERT INTO `logs` VALUES (40, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:30:28', '::1');
INSERT INTO `logs` VALUES (41, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:30:31', '::1');
INSERT INTO `logs` VALUES (42, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:30:31', '::1');
INSERT INTO `logs` VALUES (43, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:30:33', '::1');
INSERT INTO `logs` VALUES (44, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:30:34', '::1');
INSERT INTO `logs` VALUES (45, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:37:39', '::1');
INSERT INTO `logs` VALUES (46, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:37:39', '::1');
INSERT INTO `logs` VALUES (47, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:37:40', '::1');
INSERT INTO `logs` VALUES (48, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:37:41', '::1');
INSERT INTO `logs` VALUES (49, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:38:49', '::1');
INSERT INTO `logs` VALUES (50, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:38:50', '::1');
INSERT INTO `logs` VALUES (51, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:39:52', '::1');
INSERT INTO `logs` VALUES (52, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:39:53', '::1');
INSERT INTO `logs` VALUES (53, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:39:54', '::1');
INSERT INTO `logs` VALUES (54, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:39:54', '::1');
INSERT INTO `logs` VALUES (55, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:39:55', '::1');
INSERT INTO `logs` VALUES (56, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:41:24', '::1');
INSERT INTO `logs` VALUES (57, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:41:25', '::1');
INSERT INTO `logs` VALUES (58, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:42:05', '::1');
INSERT INTO `logs` VALUES (59, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:42:06', '::1');
INSERT INTO `logs` VALUES (60, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:42:06', '::1');
INSERT INTO `logs` VALUES (61, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:42:07', '::1');
INSERT INTO `logs` VALUES (62, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:42:15', '::1');
INSERT INTO `logs` VALUES (63, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:42:16', '::1');
INSERT INTO `logs` VALUES (64, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:42:17', '::1');
INSERT INTO `logs` VALUES (65, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:42:22', '::1');
INSERT INTO `logs` VALUES (66, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:42:23', '::1');
INSERT INTO `logs` VALUES (67, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:42:23', '::1');
INSERT INTO `logs` VALUES (68, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:43:04', '::1');
INSERT INTO `logs` VALUES (69, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:43:05', '::1');
INSERT INTO `logs` VALUES (70, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:43:05', '::1');
INSERT INTO `logs` VALUES (71, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:43:26', '::1');
INSERT INTO `logs` VALUES (72, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:43:27', '::1');
INSERT INTO `logs` VALUES (73, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:43:28', '::1');
INSERT INTO `logs` VALUES (74, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:43:28', '::1');
INSERT INTO `logs` VALUES (75, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:43:29', '::1');
INSERT INTO `logs` VALUES (76, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:43:30', '::1');
INSERT INTO `logs` VALUES (77, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:43:39', '::1');
INSERT INTO `logs` VALUES (78, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:43:57', '::1');
INSERT INTO `logs` VALUES (79, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:43:58', '::1');
INSERT INTO `logs` VALUES (80, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:44:41', '::1');
INSERT INTO `logs` VALUES (81, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:44:42', '::1');
INSERT INTO `logs` VALUES (82, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:44:43', '::1');
INSERT INTO `logs` VALUES (83, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:44:45', '::1');
INSERT INTO `logs` VALUES (84, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:48:12', '::1');
INSERT INTO `logs` VALUES (85, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:48:13', '::1');
INSERT INTO `logs` VALUES (86, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:48:14', '::1');
INSERT INTO `logs` VALUES (87, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:48:14', '::1');
INSERT INTO `logs` VALUES (88, 'Update', 'Updated item 18 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:48:22', '::1');
INSERT INTO `logs` VALUES (89, 'Update', 'Updated item 18 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:48:23', '::1');
INSERT INTO `logs` VALUES (90, 'Update', 'Updated item 21 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:52:15', '::1');
INSERT INTO `logs` VALUES (91, 'Update', 'Updated item 21 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:52:33', '::1');
INSERT INTO `logs` VALUES (92, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:52:34', '::1');
INSERT INTO `logs` VALUES (93, 'Update', 'Updated item 19 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:52:34', '::1');
INSERT INTO `logs` VALUES (94, 'Update', 'Updated item 18 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 17:52:35', '::1');
INSERT INTO `logs` VALUES (95, 'Update', 'Updated item 4 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 17:52:35', '::1');
INSERT INTO `logs` VALUES (96, 'Update', 'Updated item 18 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 18:07:22', '::1');
INSERT INTO `logs` VALUES (97, 'Update', 'Updated item 18 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 18:07:23', '::1');
INSERT INTO `logs` VALUES (98, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 18:13:32', '::1');
INSERT INTO `logs` VALUES (99, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 18:13:33', '::1');
INSERT INTO `logs` VALUES (100, 'Update', 'Updated item 1 in users with data: {\"ThemeID\":\"7\"}', 1, '2025-07-19 18:13:42', '::1');
INSERT INTO `logs` VALUES (101, 'Update', 'Updated item 1 in users with data: {\"ThemeID\":\"2\"}', 1, '2025-07-19 18:15:50', '::1');
INSERT INTO `logs` VALUES (102, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 18:22:43', '::1');
INSERT INTO `logs` VALUES (103, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 18:22:43', '::1');
INSERT INTO `logs` VALUES (104, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 18:25:21', '::1');
INSERT INTO `logs` VALUES (105, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 18:25:21', '::1');
INSERT INTO `logs` VALUES (106, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 18:25:22', '::1');
INSERT INTO `logs` VALUES (107, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 18:26:41', '::1');
INSERT INTO `logs` VALUES (108, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 18:26:42', '::1');
INSERT INTO `logs` VALUES (109, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 18:40:40', '::1');
INSERT INTO `logs` VALUES (110, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 18:40:41', '::1');
INSERT INTO `logs` VALUES (111, 'Insert', 'Inserted new item in assignments with data: {\"AssignmentTypeID\":\"2\",\"AssignmentName\":\"Source No Link\",\"AssignmentDescription\":\"ferferferferferferferferferferferferferferfr\",\"CourseID\":\"39\",\"SourceName\":\"Canvas\",\"SourceLink\":\"\",\"DueDate\":\"2025-07-31 14:00:00\",\"EntryDate\":\"2025-07-19 18:58:29\",\"Complete\":\"0\"}', 1, '2025-07-19 18:58:29', '::1');
INSERT INTO `logs` VALUES (112, 'Insert', 'Inserted new item in assignments with data: {\"AssignmentTypeID\":\"1\",\"AssignmentName\":\"Source No Name\",\"AssignmentDescription\":\"dvdfvdfgbfdvcsd\",\"CourseID\":\"40\",\"SourceName\":\"\",\"SourceLink\":\"https:\\/\\/www.youtube.com\\/\",\"DueDate\":\"2025-08-09 14:00:00\",\"EntryDate\":\"2025-07-19 18:59:45\",\"Complete\":\"0\"}', 1, '2025-07-19 18:59:45', '::1');
INSERT INTO `logs` VALUES (113, 'Update', 'Updated item 8 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 19:31:13', '::1');
INSERT INTO `logs` VALUES (114, 'Update', 'Updated item 1 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 19:31:13', '::1');
INSERT INTO `logs` VALUES (115, 'Update', 'Updated item 8 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 19:31:25', '::1');
INSERT INTO `logs` VALUES (116, 'Update', 'Updated item 1 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 19:31:26', '::1');
INSERT INTO `logs` VALUES (117, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 19:31:30', '::1');
INSERT INTO `logs` VALUES (118, 'Update', 'Updated item 4 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 19:31:38', '::1');
INSERT INTO `logs` VALUES (119, 'Update', 'Updated item 1 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 19:31:45', '::1');
INSERT INTO `logs` VALUES (120, 'Update', 'Updated item 1 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 19:31:46', '::1');
INSERT INTO `logs` VALUES (121, 'Update', 'Updated item 1 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 19:31:47', '::1');
INSERT INTO `logs` VALUES (122, 'Update', 'Updated item 6 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 19:31:47', '::1');
INSERT INTO `logs` VALUES (123, 'Update', 'Updated item 1 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 19:31:54', '::1');
INSERT INTO `logs` VALUES (124, 'Update', 'Updated item 8 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 19:31:54', '::1');
INSERT INTO `logs` VALUES (125, 'Update', 'Updated item 1 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 19:32:04', '::1');
INSERT INTO `logs` VALUES (126, 'Update', 'Updated item 1 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 19:32:07', '::1');
INSERT INTO `logs` VALUES (127, 'Update', 'Updated item 6 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 19:32:07', '::1');
INSERT INTO `logs` VALUES (128, 'Update', 'Updated item 8 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 19:32:08', '::1');
INSERT INTO `logs` VALUES (129, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 19:32:20', '::1');
INSERT INTO `logs` VALUES (130, 'Update', 'Updated item 19 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 19:32:20', '::1');
INSERT INTO `logs` VALUES (131, 'Update', 'Updated item 1 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 19:32:25', '::1');
INSERT INTO `logs` VALUES (132, 'Update', 'Updated item 6 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 19:32:25', '::1');
INSERT INTO `logs` VALUES (133, 'Update', 'Updated item 8 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 19:32:26', '::1');
INSERT INTO `logs` VALUES (134, 'Update', 'Updated item 8 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 19:32:29', '::1');
INSERT INTO `logs` VALUES (135, 'Update', 'Updated item 1 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 19:32:30', '::1');
INSERT INTO `logs` VALUES (136, 'Update', 'Updated item 8 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 19:34:16', '::1');
INSERT INTO `logs` VALUES (137, 'Update', 'Updated item 1 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 19:34:19', '::1');
INSERT INTO `logs` VALUES (138, 'Update', 'Updated item 6 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 19:34:20', '::1');
INSERT INTO `logs` VALUES (139, 'Update', 'Updated item 8 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 19:34:22', '::1');
INSERT INTO `logs` VALUES (140, 'Update', 'Updated item 1 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 19:34:23', '::1');
INSERT INTO `logs` VALUES (141, 'Update', 'Updated item 6 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 19:34:26', '::1');
INSERT INTO `logs` VALUES (142, 'Update', 'Updated item 1 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 19:34:26', '::1');
INSERT INTO `logs` VALUES (143, 'Update', 'Updated item 22 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 19:34:31', '::1');
INSERT INTO `logs` VALUES (144, 'Update', 'Updated item 19 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 19:34:32', '::1');
INSERT INTO `logs` VALUES (145, 'Update', 'Updated item 8 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 19:34:36', '::1');
INSERT INTO `logs` VALUES (146, 'Update', 'Updated item 22 in assignments with data: {\"AssignmentTypeID\":\"4\",\"AssignmentName\":\"New Assignment Test IV\",\"AssignmentDescription\":\"rdthk\",\"SourceLink\":\"https:\\/\\/www.youtube.com\\/\",\"DueDate\":\"2025-08-09 18:19:00\"}', 1, '2025-07-19 20:24:55', '::1');
INSERT INTO `logs` VALUES (147, 'Update', 'Updated item 22 in assignments with data: {\"AssignmentTypeID\":\"4\",\"AssignmentName\":\"New Assignment Exam IV\",\"AssignmentDescription\":\"rdthk\",\"SourceLink\":\"https:\\/\\/www.youtube.com\\/\",\"DueDate\":\"2025-08-09 18:19:00\"}', 1, '2025-07-19 20:25:14', '::1');
INSERT INTO `logs` VALUES (148, 'Update', 'Updated item 6 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 20:26:19', '::1');
INSERT INTO `logs` VALUES (149, 'Update', 'Updated item 6 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 20:26:23', '::1');
INSERT INTO `logs` VALUES (150, 'Update', 'Updated item 1 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 20:26:23', '::1');
INSERT INTO `logs` VALUES (151, 'Update', 'Updated item 8 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 20:26:23', '::1');
INSERT INTO `logs` VALUES (152, 'Update', 'Updated item 1 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 20:26:30', '::1');
INSERT INTO `logs` VALUES (153, 'Update', 'Updated item 1 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 20:26:31', '::1');
INSERT INTO `logs` VALUES (154, 'Update', 'Updated item 8 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 20:28:32', '::1');
INSERT INTO `logs` VALUES (155, 'Update', 'Updated item 36 in courses with data: {\"CourseName\":\"Test Course Edit\",\"DisciplineID\":\"12\",\"CourseNumber\":\"123\",\"SectionNumber\":\"234\",\"SemesterID\":\"3\"}', 1, '2025-07-19 22:58:32', '::1');
INSERT INTO `logs` VALUES (156, 'Update', 'Updated item 36 in courses with data: {\"CourseName\":\"Test Course Edit\",\"DisciplineID\":\"12\",\"CourseNumber\":\"123\",\"SectionNumber\":\"234\",\"SemesterID\":\"4\"}', 1, '2025-07-19 22:59:06', '::1');
INSERT INTO `logs` VALUES (157, 'Update', 'Updated item 36 in courses with data: {\"CourseName\":\"Test Course Edit\",\"DisciplineID\":\"12\",\"CourseNumber\":\"123\",\"SectionNumber\":\"234\",\"SemesterID\":\"4\"}', 1, '2025-07-19 23:28:20', '::1');
INSERT INTO `logs` VALUES (158, 'Update', 'Updated item 36 in courses with data: {\"CourseName\":\"Test Course Edit\",\"DisciplineID\":\"12\",\"CourseNumber\":\"124\",\"SectionNumber\":\"234\",\"SemesterID\":\"4\"}', 1, '2025-07-19 23:28:30', '::1');
INSERT INTO `logs` VALUES (159, 'Update', 'Updated item 36 in courses with data: {\"CourseName\":\"Test Course Edit II\",\"DisciplineID\":\"12\",\"CourseNumber\":\"124\",\"SectionNumber\":\"234\",\"SemesterID\":\"4\"}', 1, '2025-07-19 23:28:42', '::1');
INSERT INTO `logs` VALUES (160, 'Update', 'Updated item 1 in users with data: {\"ThemeID\":\"7\"}', 1, '2025-07-19 23:30:24', '::1');
INSERT INTO `logs` VALUES (161, 'Update', 'Updated item 19 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-19 23:32:34', '::1');
INSERT INTO `logs` VALUES (162, 'Update', 'Updated item 19 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-19 23:32:35', '::1');
INSERT INTO `logs` VALUES (163, 'Login', 'Login to account 1 with data: {\"UserID\":1,\"FirstName\":\"Elijah\",\"LastName\":\"Jones\",\"Email\":\"elijahcjives@gmail.com\",\"ThemeID\":7}', 1, '2025-07-20 13:33:06', '::1');
INSERT INTO `logs` VALUES (164, 'Update', 'Updated item 19 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-20 13:33:16', '::1');
INSERT INTO `logs` VALUES (165, 'Update', 'Updated item 19 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-20 13:33:17', '::1');
INSERT INTO `logs` VALUES (166, 'Update', 'Updated item 1 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-20 13:33:37', '::1');
INSERT INTO `logs` VALUES (167, 'Update', 'Updated item 19 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-20 13:35:33', '::1');
INSERT INTO `logs` VALUES (168, 'Update', 'Updated item 1 in users with data: {\"ThemeID\":\"8\"}', 1, '2025-07-20 13:35:44', '::1');
INSERT INTO `logs` VALUES (169, 'Update', 'Updated item 1 in users with data: {\"ThemeID\":\"8\"}', 1, '2025-07-20 13:35:45', '::1');
INSERT INTO `logs` VALUES (170, 'Update', 'Updated item 1 in users with data: {\"ThemeID\":\"4\"}', 1, '2025-07-20 13:35:48', '::1');
INSERT INTO `logs` VALUES (171, 'Update', 'Updated item 19 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-20 13:38:55', '::1');
INSERT INTO `logs` VALUES (172, 'Update', 'Updated item 19 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-20 13:38:57', '::1');
INSERT INTO `logs` VALUES (173, 'Update', 'Updated item 19 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-20 13:39:02', '::1');
INSERT INTO `logs` VALUES (174, 'Update', 'Updated item 19 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-20 13:39:02', '::1');
INSERT INTO `logs` VALUES (175, 'Update', 'Updated item 19 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-20 13:39:05', '::1');
INSERT INTO `logs` VALUES (176, 'Update', 'Updated item 19 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-20 13:39:06', '::1');
INSERT INTO `logs` VALUES (177, 'Update', 'Updated item 19 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-20 13:39:08', '::1');
INSERT INTO `logs` VALUES (178, 'Update', 'Updated item 19 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-20 13:39:09', '::1');
INSERT INTO `logs` VALUES (179, 'Update', 'Updated item 19 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-20 13:39:09', '::1');
INSERT INTO `logs` VALUES (180, 'Update', 'Updated item 19 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-20 13:39:10', '::1');
INSERT INTO `logs` VALUES (181, 'Update', 'Updated item 12 in courses with data: {\"CardColor\":\"4e2556\"}', 1, '2025-07-20 13:46:25', '::1');
INSERT INTO `logs` VALUES (182, 'Update', 'Updated item 1 in users with data: {\"ThemeID\":\"1\"}', 1, '2025-07-20 13:52:36', '::1');
INSERT INTO `logs` VALUES (183, 'Update', 'Updated item 1 in users with data: {\"ThemeID\":\"6\"}', 1, '2025-07-20 13:52:40', '::1');
INSERT INTO `logs` VALUES (184, 'Login', 'Login to account 2 with data: {\"UserID\":2,\"FirstName\":\"Test\",\"LastName\":\"Account\",\"Email\":\"test@assignment.com\",\"ThemeID\":3}', 2, '2025-07-20 13:53:34', '::1');
INSERT INTO `logs` VALUES (185, 'Login', 'Login to account 1 with data: {\"UserID\":1,\"FirstName\":\"Elijah\",\"LastName\":\"Jones\",\"Email\":\"elijahcjives@gmail.com\",\"ThemeID\":6}', 1, '2025-07-20 13:58:27', '::1');
INSERT INTO `logs` VALUES (186, 'Update', 'Updated item 1 in users with data: {\"ThemeID\":\"3\"}', 1, '2025-07-20 14:01:12', '::1');
INSERT INTO `logs` VALUES (187, 'Update', 'Updated item 1 in users with data: {\"ThemeID\":\"1\"}', 1, '2025-07-20 14:01:15', '::1');
INSERT INTO `logs` VALUES (188, 'Login', 'Login to account 2 with data: {\"UserID\":2,\"FirstName\":\"Test\",\"LastName\":\"Account\",\"Email\":\"test@assignment.com\",\"ThemeID\":3}', 2, '2025-07-20 16:51:00', '::1');
INSERT INTO `logs` VALUES (189, 'Update', 'Updated item 2 in users with data: {\"ThemeID\":\"7\"}', 2, '2025-07-20 16:54:33', '::1');
INSERT INTO `logs` VALUES (190, 'Login', 'Login to account 1 with data: {\"UserID\":1,\"FirstName\":\"Elijah\",\"LastName\":\"Jones\",\"Email\":\"elijahcjives@gmail.com\",\"ThemeID\":1}', 1, '2025-07-20 17:04:18', '::1');
INSERT INTO `logs` VALUES (191, 'Update', 'Updated item 19 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-20 17:04:49', '::1');
INSERT INTO `logs` VALUES (192, 'Update', 'Updated item 19 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-20 17:04:50', '::1');
INSERT INTO `logs` VALUES (193, 'Update', 'Updated item 24 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-21 00:52:01', '::1');
INSERT INTO `logs` VALUES (194, 'Login', 'Login to account 1 with data: {\"UserID\":1,\"FirstName\":\"Elijah\",\"LastName\":\"Jones\",\"Email\":\"elijahcjives@gmail.com\",\"ThemeID\":1}', 1, '2025-07-21 20:18:13', '::1');
INSERT INTO `logs` VALUES (195, 'Login', 'Login to account 1 with data: {\"UserID\":1,\"FirstName\":\"Elijah\",\"LastName\":\"Jones\",\"Email\":\"elijahcjives@gmail.com\",\"ThemeID\":1}', 1, '2025-07-31 18:12:45', '::1');
INSERT INTO `logs` VALUES (196, 'Update', 'Updated item 6 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-31 18:13:38', '::1');
INSERT INTO `logs` VALUES (197, 'Update', 'Updated item 6 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-31 18:13:38', '::1');
INSERT INTO `logs` VALUES (198, 'Update', 'Updated item 24 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-07-31 18:13:43', '::1');
INSERT INTO `logs` VALUES (199, 'Update', 'Updated item 24 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-07-31 18:13:44', '::1');
INSERT INTO `logs` VALUES (200, 'Login', 'Login to account 1 with data: {\"UserID\":1,\"FirstName\":\"Elijah\",\"LastName\":\"Jones\",\"Email\":\"elijahcjives@gmail.com\",\"ThemeID\":1}', 1, '2025-08-01 01:02:33', '::1');
INSERT INTO `logs` VALUES (201, 'Login', 'Login to account 1 with data: {\"UserID\":1,\"FirstName\":\"Elijah\",\"LastName\":\"Jones\",\"Email\":\"elijahcjives@gmail.com\",\"ThemeID\":1}', 1, '2025-08-01 01:02:33', '::1');
INSERT INTO `logs` VALUES (202, 'Login', 'Login to account 1 with data: {\"UserID\":1,\"FirstName\":\"Elijah\",\"LastName\":\"Jones\",\"Email\":\"elijahcjives@gmail.com\",\"ThemeID\":1}', 1, '2025-08-01 01:02:33', '::1');
INSERT INTO `logs` VALUES (203, 'Login', 'Login to account 1 with data: {\"UserID\":1,\"FirstName\":\"Elijah\",\"LastName\":\"Jones\",\"Email\":\"elijahcjives@gmail.com\",\"ThemeID\":1}', 1, '2025-08-01 01:02:33', '::1');
INSERT INTO `logs` VALUES (204, 'Login', 'Login to account 1 with data: {\"UserID\":1,\"FirstName\":\"Elijah\",\"LastName\":\"Jones\",\"Email\":\"elijahcjives@gmail.com\",\"ThemeID\":1}', 1, '2025-08-01 01:02:33', '::1');
INSERT INTO `logs` VALUES (205, 'Login', 'Login to account 1 with data: {\"UserID\":1,\"FirstName\":\"Elijah\",\"LastName\":\"Jones\",\"Email\":\"elijahcjives@gmail.com\",\"ThemeID\":1}', 1, '2025-08-01 01:02:33', '::1');
INSERT INTO `logs` VALUES (206, 'Login', 'Login to account 1 with data: {\"UserID\":1,\"FirstName\":\"Elijah\",\"LastName\":\"Jones\",\"Email\":\"elijahcjives@gmail.com\",\"ThemeID\":1}', 1, '2025-08-01 22:32:43', '::1');
INSERT INTO `logs` VALUES (207, 'Login', 'Login to account 1 with data: {\"UserID\":1,\"FirstName\":\"Elijah\",\"LastName\":\"Jones\",\"Email\":\"elijahcjives@gmail.com\",\"ThemeID\":1}', 1, '2025-08-09 20:44:56', '::1');
INSERT INTO `logs` VALUES (208, 'Login', 'Login to account 1 with data: {\"UserID\":1,\"FirstName\":\"Elijah\",\"LastName\":\"Jones\",\"Email\":\"elijahcjives@gmail.com\",\"ThemeID\":1}', 1, '2025-08-18 14:10:51', '::1');
INSERT INTO `logs` VALUES (209, 'Login', 'Login to account 1 with data: {\"UserID\":1,\"FirstName\":\"Elijah\",\"LastName\":\"Jones\",\"Email\":\"elijahcjives@gmail.com\",\"ThemeID\":1}', 1, '2025-08-19 12:25:21', '::1');
INSERT INTO `logs` VALUES (210, 'Login', 'Login to account 1 with data: {\"UserID\":1,\"FirstName\":\"Elijah\",\"LastName\":\"Jones\",\"Email\":\"elijahcjives@gmail.com\",\"ThemeID\":1}', 1, '2025-08-20 21:32:34', '::1');
INSERT INTO `logs` VALUES (211, 'Update', 'Updated item 12 in courses with data: {\"CardColor\":\"424242\"}', 1, '2025-08-20 21:45:40', '::1');
INSERT INTO `logs` VALUES (212, 'Update', 'Updated item 12 in courses with data: {\"CourseName\":\"Intermediate French Idbggcnbbgf\",\"CourseNumber\":\"203b\",\"SemesterID\":\"5\"}', 1, '2025-08-20 21:45:49', '::1');
INSERT INTO `logs` VALUES (213, 'Insert', 'Inserted new item in courses with data: {\"CourseName\":\"vdfdvdfvdfv\",\"CourseNumber\":\"vdfvdfvfdvdfvfdv\",\"SemesterID\":\"5\",\"UserID\":1,\"EntryDate\":\"2025-08-20 21:46:09\",\"CardColor\":\"000000\"}', 1, '2025-08-20 21:46:09', '::1');
INSERT INTO `logs` VALUES (214, 'Update', 'Updated item 1 in users with data: {\"ThemeID\":\"3\"}', 1, '2025-08-20 23:22:04', '::1');
INSERT INTO `logs` VALUES (215, 'Update', 'Updated item 1 in users with data: {\"ThemeID\":\"1\"}', 1, '2025-08-20 23:23:52', '::1');
INSERT INTO `logs` VALUES (216, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:41:42\",\"Complete\":0,\"ListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:41:42', '::1');
INSERT INTO `logs` VALUES (217, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:41:42\",\"Complete\":0,\"ListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:41:42', '::1');
INSERT INTO `logs` VALUES (218, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:41:42\",\"Complete\":0,\"ListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:41:42', '::1');
INSERT INTO `logs` VALUES (219, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:41:56\",\"Complete\":0,\"ListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:41:56', '::1');
INSERT INTO `logs` VALUES (220, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:42:27\",\"Complete\":0,\"ListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:42:27', '::1');
INSERT INTO `logs` VALUES (221, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:42:27\",\"Complete\":0,\"ListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:42:27', '::1');
INSERT INTO `logs` VALUES (222, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:42:27\",\"Complete\":0,\"ListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:42:27', '::1');
INSERT INTO `logs` VALUES (223, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:42:36\",\"Complete\":0,\"ListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:42:36', '::1');
INSERT INTO `logs` VALUES (224, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:28\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:28', '::1');
INSERT INTO `logs` VALUES (225, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:35\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:35', '::1');
INSERT INTO `logs` VALUES (226, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:36\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:36', '::1');
INSERT INTO `logs` VALUES (227, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:36\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:36', '::1');
INSERT INTO `logs` VALUES (228, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:48\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:48', '::1');
INSERT INTO `logs` VALUES (229, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:48\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:48', '::1');
INSERT INTO `logs` VALUES (230, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:48\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:48', '::1');
INSERT INTO `logs` VALUES (231, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:48\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:48', '::1');
INSERT INTO `logs` VALUES (232, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:49\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:49', '::1');
INSERT INTO `logs` VALUES (233, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:49\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:49', '::1');
INSERT INTO `logs` VALUES (234, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:49\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:49', '::1');
INSERT INTO `logs` VALUES (235, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:49\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:49', '::1');
INSERT INTO `logs` VALUES (236, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:49\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:49', '::1');
INSERT INTO `logs` VALUES (237, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:50\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:50', '::1');
INSERT INTO `logs` VALUES (238, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:50\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:50', '::1');
INSERT INTO `logs` VALUES (239, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:50\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:50', '::1');
INSERT INTO `logs` VALUES (240, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:51\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:51', '::1');
INSERT INTO `logs` VALUES (241, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:51\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:51', '::1');
INSERT INTO `logs` VALUES (242, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:51\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:51', '::1');
INSERT INTO `logs` VALUES (243, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:52\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:52', '::1');
INSERT INTO `logs` VALUES (244, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:52\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:52', '::1');
INSERT INTO `logs` VALUES (245, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:52\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:52', '::1');
INSERT INTO `logs` VALUES (246, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:52\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:52', '::1');
INSERT INTO `logs` VALUES (247, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:52\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:52', '::1');
INSERT INTO `logs` VALUES (248, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:52\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:52', '::1');
INSERT INTO `logs` VALUES (249, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:43:52\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:43:52', '::1');
INSERT INTO `logs` VALUES (250, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:44:16\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:44:16', '::1');
INSERT INTO `logs` VALUES (251, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:44:16\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:44:16', '::1');
INSERT INTO `logs` VALUES (252, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:44:16\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:44:16', '::1');
INSERT INTO `logs` VALUES (253, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:45:43\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:45:43', '::1');
INSERT INTO `logs` VALUES (254, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:45:43\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:45:43', '::1');
INSERT INTO `logs` VALUES (255, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:45:43\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:45:43', '::1');
INSERT INTO `logs` VALUES (256, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:46:30\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:46:30', '::1');
INSERT INTO `logs` VALUES (257, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:46:30\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:46:30', '::1');
INSERT INTO `logs` VALUES (258, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:46:30\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:46:30', '::1');
INSERT INTO `logs` VALUES (259, 'Update', 'Updated item 6 in tasks with data: {\"CourseNumber\":\"\",\"TaskListID\":\"6\"}', 1, '2025-08-20 23:53:25', '::1');
INSERT INTO `logs` VALUES (260, 'Update', 'Updated item 8 in tasks with data: {\"CourseNumber\":\"\",\"TaskListID\":\"6\"}', 1, '2025-08-20 23:53:25', '::1');
INSERT INTO `logs` VALUES (261, 'Update', 'Updated item 1 in tasks with data: {\"CourseNumber\":\"\",\"TaskListID\":\"6\"}', 1, '2025-08-20 23:53:25', '::1');
INSERT INTO `logs` VALUES (262, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:53:34\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:53:34', '::1');
INSERT INTO `logs` VALUES (263, 'Insert', 'Inserted new item in tasks with data: {\"UserID\":1,\"EntryDate\":\"2025-08-20 23:53:48\",\"Complete\":0,\"TaskListOrdering\":1,\"TaskListID\":0}', 1, '2025-08-20 23:53:48', '::1');
INSERT INTO `logs` VALUES (264, 'Update', 'Updated item 6 in tasks with data: {\"CourseNumber\":\"\",\"TaskListID\":\"6\"}', 1, '2025-08-20 23:53:55', '::1');
INSERT INTO `logs` VALUES (265, 'Update', 'Updated item 8 in tasks with data: {\"CourseNumber\":\"\",\"TaskListID\":\"6\"}', 1, '2025-08-20 23:53:56', '::1');
INSERT INTO `logs` VALUES (266, 'Update', 'Updated item 4 in tasks with data: {\"CourseNumber\":\"\",\"TaskListID\":\"6\"}', 1, '2025-08-20 23:53:56', '::1');
INSERT INTO `logs` VALUES (267, 'Update', 'Updated item 12 in courses with data: {\"CardColor\":\"ff0000\"}', 1, '2025-08-21 16:10:06', '::1');
INSERT INTO `logs` VALUES (268, 'Update', 'Updated item 6 in assignments with data: {\"Complete\":\"1\"}', 1, '2025-08-21 16:10:45', '::1');
INSERT INTO `logs` VALUES (269, 'Update', 'Updated item 6 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-08-21 16:10:46', '::1');
INSERT INTO `logs` VALUES (270, 'Update', 'Updated item 6 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-08-21 16:10:49', '::1');
INSERT INTO `logs` VALUES (271, 'Update', 'Updated item 8 in assignments with data: {\"Complete\":\"0\"}', 1, '2025-08-21 16:11:25', '::1');
INSERT INTO `logs` VALUES (272, 'Update', 'Updated item 1 in users with data: []', 1, '2025-08-21 17:17:35', '::1');
INSERT INTO `logs` VALUES (273, 'Update', 'Updated item 1 in users with data: []', 1, '2025-08-21 17:17:46', '::1');
INSERT INTO `logs` VALUES (274, 'Update', 'Updated item 1 in users with data: []', 1, '2025-08-21 17:17:58', '::1');
INSERT INTO `logs` VALUES (275, 'Insert', 'Inserted new item in users with data: {\"EntryDate\":\"2025-08-21 17:18:08\",\"ThemeID\":\"1\",\"Active\":\"1\",\"Admin\":\"0\"}', 1, '2025-08-21 17:18:08', '::1');
INSERT INTO `logs` VALUES (276, 'Update', 'Updated item 1 in users with data: {\"ThemeID\":\"6\"}', 1, '2025-08-21 17:21:09', '::1');
INSERT INTO `logs` VALUES (277, 'Update', 'Updated item 1 in users with data: {\"DisplayName\":\"VulpesNovem123\",\"FirstName\":\"Elijah\",\"LastName\":\"Jones\",\"Email\":\"elijahcjives@gmail.com\"}', 1, '2025-08-21 21:35:40', '::1');
INSERT INTO `logs` VALUES (278, 'Update', 'Updated item 1 in users with data: {\"DisplayName\":\"VulpesNovem123\",\"FirstName\":\"Elijah\",\"LastName\":\"Jones\",\"Email\":\"elijahcjives@gmail.com\"}', 1, '2025-08-21 21:35:42', '::1');
INSERT INTO `logs` VALUES (279, 'Insert', 'Inserted new item in users with data: {\"EntryDate\":\"2025-08-21 21:35:54\",\"ThemeID\":\"1\",\"Active\":\"1\",\"Admin\":\"0\"}', 1, '2025-08-21 21:35:54', '::1');
INSERT INTO `logs` VALUES (280, 'Update', 'Updated item 1 in users with data: {\"DisplayName\":\"VulpesNovem1234\",\"FirstName\":\"Elijah\",\"LastName\":\"Jones\",\"Email\":\"elijahcjives@gmail.com\"}', 1, '2025-08-21 21:36:22', '::1');
INSERT INTO `logs` VALUES (281, 'Update', 'Updated item 1 in users with data: {\"DisplayName\":\"VulpesNovem1234\",\"FirstName\":\"Elijah\",\"LastName\":\"Jones\",\"Email\":\"ecjives@gmail.com\"}', 1, '2025-08-21 21:36:31', '::1');
INSERT INTO `logs` VALUES (282, 'Update', 'Updated item 1 in users with data: {\"DisplayName\":\"VulpesNovem1234\",\"FirstName\":\"Li\",\"LastName\":\"Jo\",\"Email\":\"ecjives@gmail.com\"}', 1, '2025-08-21 21:36:40', '::1');

-- ----------------------------
-- Table structure for semesters
-- ----------------------------
DROP TABLE IF EXISTS `semesters`;
CREATE TABLE `semesters`  (
  `SemesterID` int NOT NULL AUTO_INCREMENT,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `SemesterName` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`SemesterID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of semesters
-- ----------------------------
INSERT INTO `semesters` VALUES (1, '2024-08-01 00:00:00', '2024-12-31 23:59:59', 'Fall 2024');
INSERT INTO `semesters` VALUES (2, '2025-01-01 00:00:00', '2025-05-31 23:59:59', 'Spring 2025');
INSERT INTO `semesters` VALUES (3, '2025-06-01 00:00:00', '2025-06-30 23:59:59', 'Summer I 2025');
INSERT INTO `semesters` VALUES (4, '2025-07-01 00:00:00', '2025-07-31 23:59:59', 'Summer II 2025');
INSERT INTO `semesters` VALUES (5, '2025-08-01 00:00:00', '2025-12-31 23:59:59', 'Fall 2025');
INSERT INTO `semesters` VALUES (6, '2026-01-01 00:00:00', '2026-05-31 23:59:59', 'Spring 2026');

-- ----------------------------
-- Table structure for task_lists
-- ----------------------------
DROP TABLE IF EXISTS `task_lists`;
CREATE TABLE `task_lists`  (
  `TaskListID` int NOT NULL AUTO_INCREMENT,
  `TaskListTitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `EntryDate` datetime NULL DEFAULT NULL,
  `UserID` int NULL DEFAULT NULL,
  PRIMARY KEY (`TaskListID`) USING BTREE,
  INDEX `UserID`(`UserID` ASC) USING BTREE,
  CONSTRAINT `task_lists_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of task_lists
-- ----------------------------
INSERT INTO `task_lists` VALUES (0, 'General', NULL, NULL);
INSERT INTO `task_lists` VALUES (6, 'Test List 1', NULL, 1);
INSERT INTO `task_lists` VALUES (7, 'Test List 2', NULL, 1);

-- ----------------------------
-- Table structure for tasks
-- ----------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks`  (
  `TaskID` int NOT NULL AUTO_INCREMENT,
  `TaskTitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `TaskDescription` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `Complete` tinyint NULL DEFAULT NULL,
  `EntryDate` datetime NULL DEFAULT NULL,
  `UserID` int NOT NULL,
  `TaskListOrdering` int NULL DEFAULT NULL,
  `TaskListID` int NULL DEFAULT NULL,
  PRIMARY KEY (`TaskID`) USING BTREE,
  INDEX `UserID`(`UserID` ASC) USING BTREE,
  INDEX `TaskListID`(`TaskListID` ASC) USING BTREE,
  CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`TaskListID`) REFERENCES `task_lists` (`TaskListID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 46 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tasks
-- ----------------------------
INSERT INTO `tasks` VALUES (1, 'Test Unlisted', NULL, 0, NULL, 1, 0, 0);
INSERT INTO `tasks` VALUES (4, 'Test Unlisted Check', NULL, 1, NULL, 1, 0, 0);
INSERT INTO `tasks` VALUES (5, 'Test Listed 2', NULL, 0, NULL, 1, 0, 7);
INSERT INTO `tasks` VALUES (6, 'Test List 2', NULL, 0, NULL, 1, 0, 6);
INSERT INTO `tasks` VALUES (7, 'Test', NULL, 1, NULL, 1, 0, 7);
INSERT INTO `tasks` VALUES (8, 'Test II', NULL, 1, NULL, 1, 0, 6);
INSERT INTO `tasks` VALUES (44, '', NULL, 0, '2025-08-20 23:53:34', 1, 1, 0);
INSERT INTO `tasks` VALUES (45, '', NULL, 0, '2025-08-20 23:53:48', 1, 1, 0);

-- ----------------------------
-- Table structure for themes
-- ----------------------------
DROP TABLE IF EXISTS `themes`;
CREATE TABLE `themes`  (
  `ThemeID` int NOT NULL AUTO_INCREMENT,
  `ThemeName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ThemeSheet` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `PrimaryColor` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `SecondaryColor` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `PrimaryTextColor` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ThemeID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of themes
-- ----------------------------
INSERT INTO `themes` VALUES (1, 'Void Heart', 'void.heart', '1B1B1B', '8F277A', 'FFFFFF');
INSERT INTO `themes` VALUES (2, 'Skulk Scars', 'skulk.scars', '1B1B1B', '2E467A', 'FFFFFF');
INSERT INTO `themes` VALUES (3, 'Faey\'s Rage', 'faeys.rage', '1B1B1B', '35682B', 'FFFFFF');
INSERT INTO `themes` VALUES (4, 'Imp\'s Blood', 'imps.blood', '1B1B1B', '913636', 'FFFFFF');
INSERT INTO `themes` VALUES (5, 'Royal Guard', 'royal.guard', 'FFFFFF', '8F277A', '000000');
INSERT INTO `themes` VALUES (6, 'Cleared Skies', 'cleared.skies', 'FFFFFF', '2E467A', '000000');
INSERT INTO `themes` VALUES (7, 'Emerald Shine', 'emerald.shine', 'FFFFFF', '35682B', '000000');
INSERT INTO `themes` VALUES (8, 'Stained Snow', 'stained.snow', 'FFFFFF', '913636', '000000');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `DisplayName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `FirstName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `LastName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `Email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Active` tinyint NOT NULL,
  `ThemeID` int NOT NULL,
  `EntryDate` datetime NULL DEFAULT NULL,
  `Admin` tinyint NULL DEFAULT NULL,
  `Connections` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  PRIMARY KEY (`UserID`) USING BTREE,
  INDEX `ThemeID`(`ThemeID` ASC) USING BTREE,
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`ThemeID`) REFERENCES `themes` (`ThemeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'VulpesNovem1234', 'Li', 'Jo', 'ecjives@gmail.com', '832a4c18fc9c6caef9f8cc11ed1afb6e', 1, 6, NULL, NULL, NULL);
INSERT INTO `users` VALUES (2, 'TestAccount', 'Test', 'Account', 'test@assignment.com', '098f6bcd4621d373cade4e832627b4f6', 1, 7, NULL, NULL, NULL);
INSERT INTO `users` VALUES (4, '', NULL, NULL, '', '', 1, 1, '2025-08-21 17:18:08', 0, NULL);
INSERT INTO `users` VALUES (5, '', NULL, NULL, '', '', 1, 1, '2025-08-21 21:35:54', 0, NULL);

-- ----------------------------
-- View structure for assignments_full
-- ----------------------------
DROP VIEW IF EXISTS `assignments_full`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `assignments_full` AS select `assignments`.`AssignmentID` AS `AssignmentID`,`assignments`.`AssignmentTypeID` AS `AssignmentTypeID`,`assignment_types`.`AssignmentType` AS `AssignmentType`,`assignments`.`AssignmentName` AS `AssignmentName`,`assignments`.`AssignmentDescription` AS `AssignmentDescription`,`assignments`.`CourseID` AS `CourseID`,`assignments`.`SourceLink` AS `SourceLink`,`assignments`.`DueDate` AS `DueDate`,`assignments`.`Complete` AS `Complete`,`courses`.`UserID` AS `UserID`,`courses`.`CardColor` AS `CardColor`,`disciplines`.`DisciplineCode` AS `DisciplineCode`,`courses`.`CourseNumber` AS `CourseNumber`,`assignment_types`.`Icon` AS `Icon` from (((`assignments` join `courses` on((`assignments`.`CourseID` = `courses`.`CourseID`))) join `assignment_types` on((`assignments`.`AssignmentTypeID` = `assignment_types`.`AssignmentTypeID`))) join `disciplines` on((`courses`.`DisciplineID` = `disciplines`.`DisciplineID`)));

-- ----------------------------
-- View structure for assignments_past
-- ----------------------------
DROP VIEW IF EXISTS `assignments_past`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `assignments_past` AS select `assignments`.`AssignmentID` AS `AssignmentID`,`assignment_types`.`AssignmentType` AS `AssignmentType`,`assignments`.`AssignmentName` AS `AssignmentName`,`assignments`.`AssignmentDescription` AS `AssignmentDescription`,`assignments`.`CourseID` AS `CourseID`,`assignments`.`SourceLink` AS `SourceLink`,`assignments`.`DueDate` AS `DueDate`,`assignments`.`Complete` AS `Complete`,`courses`.`UserID` AS `UserID`,`courses`.`CardColor` AS `CardColor`,`assignment_types`.`Icon` AS `Icon` from ((`assignments` join `courses` on((`assignments`.`CourseID` = `courses`.`CourseID`))) join `assignment_types` on((`assignments`.`AssignmentTypeID` = `assignment_types`.`AssignmentTypeID`))) where (`assignments`.`DueDate` < now());

-- ----------------------------
-- View structure for assignments_upcoming
-- ----------------------------
DROP VIEW IF EXISTS `assignments_upcoming`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `assignments_upcoming` AS select `assignments`.`AssignmentID` AS `AssignmentID`,`assignment_types`.`AssignmentType` AS `AssignmentType`,`assignments`.`AssignmentName` AS `AssignmentName`,`assignments`.`AssignmentDescription` AS `AssignmentDescription`,`assignments`.`CourseID` AS `CourseID`,`assignments`.`SourceLink` AS `SourceLink`,`assignments`.`DueDate` AS `DueDate`,`assignments`.`Complete` AS `Complete`,`courses`.`UserID` AS `UserID`,`courses`.`CardColor` AS `CardColor`,`assignment_types`.`Icon` AS `Icon` from ((`assignments` join `courses` on((`assignments`.`CourseID` = `courses`.`CourseID`))) join `assignment_types` on((`assignments`.`AssignmentTypeID` = `assignment_types`.`AssignmentTypeID`))) where (`assignments`.`DueDate` > now());

-- ----------------------------
-- View structure for tasks_unlisted
-- ----------------------------
DROP VIEW IF EXISTS `tasks_unlisted`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `tasks_unlisted` AS select `tasks`.`TaskID` AS `TaskID`,`tasks`.`TaskTitle` AS `TaskTitle`,`tasks`.`TaskDescription` AS `TaskDescription`,`tasks`.`Complete` AS `Complete`,`tasks`.`UserID` AS `UserID`,`tasks`.`TaskListOrdering` AS `TaskListOrdering` from `tasks` where (`tasks`.`TaskListID` = 0);

SET FOREIGN_KEY_CHECKS = 1;
