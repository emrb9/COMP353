-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 19, 2023 at 04:43 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
--
-- Database: `codebusters`
--
CREATE DATABASE IF NOT EXISTS `codebusters` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `codebusters`;

-- Table structure for table `facility_follower`
--

DROP TABLE IF EXISTS `facility_follower`;
CREATE TABLE `facility_follower` (
    `cid` int(11) NOT NULL,
    `uid` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
-- --------------------------------------------------------
--
-- Table structure for table `connection`
--

DROP TABLE IF EXISTS `connection`;
CREATE TABLE `connection` (
    `master` int(11) NOT NULL,
    `slave` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
    `id` int(11) NOT NULL,
    `fname` varchar(25) NOT NULL,
    `lname` varchar(25) NOT NULL,
    `email` varchar(50) NOT NULL,
    `job_title` varchar(50) NOT NULL,
    `location` varchar(50) NOT NULL,
    `skills` varchar(255) NOT NULL,
    `about` varchar(255) NOT NULL,
    `public` int(1) NOT NULL DEFAULT '1'
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
-- --------------------------------------------------------
--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `u_types`;
CREATE TABLE `u_types` (
    `id` int(1) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `type` varchar(50) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
-- Pre-inserts for u_types
INSERT INTO `u_types` (type)
VALUES ('Recruiter');
INSERT INTO `u_types` (type)
VALUES ('Seeker');
INSERT INTO `u_types` (type)
VALUES ('Admin');
-- --------------------------------------------------------
--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
    `id` int(11) NOT NULL,
    `uname` varchar(50) NOT NULL,
    `password_hash` varchar(72) NOT NULL,
    `u_type` int(1) NOT NULL,
    `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
-- --------------------------------------------------------
--
-- Table structure for table `volunteer`
--

-- Table structure for table notification
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
    `id` int(11) NOT NULL,
    `type` varchar(255) NOT NULL,
    `content` varchar(255) NOT NULL,
    `uid` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
--
-- Indexes for table notification
--
ALTER TABLE `notification`
ADD PRIMARY KEY (`id`),
    ADD KEY `NOTIFICATION_UID_FK_TO_USER_UID` (`uid`);
--
-- Indexes for table `application_rule`
--
-- Indexes for table `facility`
--
ALTER TABLE `facility`
ADD PRIMARY KEY (`id`),
    ADD KEY `facility_CREATOR_UID_FK_TO_USER_ID` (`creator_uid`);
--
-- Indexes for table `facility_follower`
--
ALTER TABLE `facility_follower`
ADD PRIMARY KEY (`cid`, `uid`),
    ADD KEY `facility_FOLLOWER_UID_FK_TO_USER` (`uid`);
--
-- Indexes for table `connection`
--
ALTER TABLE `connection`
ADD PRIMARY KEY (`master`, `slave`),
    ADD KEY `CONNECTION_SLAVE_FK_TO_USER_ID` (`slave`);
--

--
ALTER TABLE `profile`
ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `email` (`email`);
--
-- Indexes for table `user`
--
ALTER TABLE `user`
ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `uname` (`uname`),
    ADD KEY `USER_U_TYPE_FK_TO_U_TYPES` (`u_type`);
--
-- Indexes for table `volunteer`
--
ALTER TABLE `facility`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--

--
-- AUTO_INCREMENT for table notification
--
ALTER TABLE `notification`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--

-- Constraints for table notification
--
ALTER TABLE `notification`
ADD CONSTRAINT `NOTIFICATION_UID_FK_TO_USER_UID` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE;

-- Constraints for table `connection`
--
ALTER TABLE `connection`
ADD CONSTRAINT `CONNECTION_MASTER_FK_TO_USER_ID` FOREIGN KEY (`master`) REFERENCES `user` (`id`) ON DELETE CASCADE,
    ADD CONSTRAINT `CONNECTION_SLAVE_FK_TO_USER_ID` FOREIGN KEY (`slave`) REFERENCES `user` (`id`) ON DELETE CASCADE;
-- Constraints for table `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `USER_U_TYPE_FK_TO_U_TYPES` FOREIGN KEY (`u_type`) REFERENCES `u_types` (`id`) ON DELETE CASCADE;
--

-- Constraints for table `profile`
--
ALTER TABLE `profile`
ADD CONSTRAINT `PROFILE_ID_FK_TO_USER_ID` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
--

----------------- EMILIE'S TABLE ---------
------ TABLE ----- 
-- Setting the environment
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
-- Ensure the codebusters database exists
CREATE DATABASE IF NOT EXISTS `codebusters` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `codebusters`;
-- Create Facilities
DROP TABLE IF EXISTS `facility`;
CREATE TABLE `facility` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `address` VARCHAR(100) NOT NULL,
    `postalCode` VARCHAR(10) NOT NULL,
    `city` VARCHAR(50) NOT NULL,
    `province` VARCHAR(50) NOT NULL,
    `type` VARCHAR(20) NOT NULL,
    `phoneNumber` VARCHAR(15) NOT NULL,
    `capacity` INT NOT NULL,
    `webAddress` VARCHAR(100) NOT NULL,
    `managerSSN` INT,
    -- Changed from VARCHAR(10) to INT
    `creator_uid` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `facility_MANAGER_SSN_FK_TO_EMPLOYEES_SSN` FOREIGN KEY (`managerSSN`) REFERENCES `Employees`(`SSN`) ON DELETE
    SET NULL,
        CONSTRAINT `facility_CREATOR_UID_FK_TO_USER_ID` FOREIGN KEY (`creator_uid`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
-- Create Residences
DROP TABLE IF EXISTS `Residences`;
CREATE TABLE Residences (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `address` VARCHAR(100),
    `postalCode` VARCHAR(10),
    `city` VARCHAR(20),
    `province` VARCHAR(20),
    `type` VARCHAR(20),
    `phoneNumber` VARCHAR(15),
    `bedroomNumber` INT,
    `creator_uid` int(11) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
DROP TABLE IF EXISTS `Vaccinations`;
CREATE TABLE Vaccinations (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `SSN` INT(11),
    `doseNumber` INT,
    `type` VARCHAR(50),
    `date` DATE,
    `address` VARCHAR(100),
    `postalCode` VARCHAR(10),
    `creator_uid` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `vaccination_SSN_FK_TO_EMPLOYEES_SSN` FOREIGN KEY (`SSN`) REFERENCES `Persons`(`SSN`) ON DELETE
    SET NULL,
        CONSTRAINT `vaccination_CREATOR_UID_FK_TO_USER_ID` FOREIGN KEY (`creator_uid`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
DROP TABLE IF EXISTS `Infections`;
CREATE TABLE Infections (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `SSN` INT(11),
    `type` VARCHAR(50),
    `date` DATE,
    `creator_uid` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `infection_SSN_FK_TO_EMPLOYEES_SSN` FOREIGN KEY (`SSN`) REFERENCES `Persons`(`SSN`) ON DELETE
    SET NULL,
        CONSTRAINT `infection_CREATOR_UID_FK_TO_USER_ID` FOREIGN KEY (`creator_uid`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
CREATE TABLE Persons (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `SSN` INT(11) NOT NULL,
    `cellNumber` VARCHAR(15),
    `firstName` varchar(50),
    `lastName` varchar(50),
    `citizenship` varchar(20),
    `dateOfBirth` DATE,
    `emailAddress` varchar(50),
    `occupation` VARCHAR(50),
    `creator_uid` int(11) NOT NULL
);