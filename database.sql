-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2022 at 02:51 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `firstname` varchar(10) DEFAULT NULL,
  `Othername` varchar(15) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `emp_id` int(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`firstname`, `Othername`, `title`, `emp_id`, `email`, `password`) VALUES
('Achiaa', 'E. Boateng', 'Asst. HRM', 12345, 'ericaachiaa@gmail.com', '11111'),
('Suugyaa', 'N-Dousila', 'H.R Manager', 74735, 'sugyaa@outlook.com', '11111');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `name` varchar(40) NOT NULL,
  `hod` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`name`, `hod`) VALUES
('Accounts', 'Napoleon Tudji'),
('Administration', 'Wiafe Malledi'),
('H.R', 'Suugyaa N-Dousila'),
('I.G.F', ''),
('Internal Audit', 'Safia Ali'),
('Registry', 'Nuhu Abubakar'),
('Social Welfare and Community Development', 'Rhoda Dwamena Bawuah');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `firstname` varchar(10) NOT NULL,
  `othernames` varchar(15) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `department` varchar(40) NOT NULL,
  `title` varchar(30) NOT NULL,
  `gender` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`firstname`, `othernames`, `emp_id`, `department`, `title`, `gender`) VALUES
('Safia', 'Ali', 56780, 'Internal Audit', 'Internal Auditor', 'Female'),
('Suugyaa', 'N-Dousila', 74735, 'H.R', 'H.R Manager', 'Male'),
('Esther ', 'Donkor', 89076, 'I.G.F', 'Secretary', 'Female'),
('David ', 'Aquah Agyeman', 125677, 'Internal Audit', 'NSS Personnel', 'Male'),
('Richard', 'Adubofour', 143578, 'Internal Audit', 'Asst. Internal Auditor', 'Male'),
('Napoleon', 'Tudji', 234567, 'Accounts', 'Sr. Accountant', 'Male'),
('Wiafe', 'Malledi', 234678, 'Administration', 'Coordinating Director', 'Male'),
('Nuhu', 'Abubakar', 235678, 'Registry', 'Snr. Records Sup.', 'Male'),
('Musah', 'Santa', 236578, 'Internal Audit', 'Assit. Internal Auditor', 'Female'),
('Hannah', 'Ayita', 236789, 'Administration', 'Stenographer ', 'Female'),
('Erica', 'A. Boateng', 236798, 'H.R', 'Assistant H.R.M', 'Female'),
('Daniella', 'Addain', 1456789, 'I.G.F', 'Stenographer ', 'Female'),
('Rhoda', 'Dwamena Bawuah', 2345676, 'Social Welfare and Community Development', 'Snr. Social Officer', 'Female'),
('Hussein', 'A. Gambo', 3245677, 'Social Welfare and Community Development', 'Social Development Officer', 'Male'),
('John', 'Ayimbe', 3466788, 'Social Welfare and Community Development', 'Social Development Officer', 'Male'),
('Faustina', 'Amisah', 16786534, 'Administration', 'Stenographer ', 'Female'),
('Diana', 'Awuku', 23245665, 'Administration', 'Stenographer ', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `filename` varchar(40) NOT NULL,
  `path` varchar(150) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `up_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`filename`, `path`, `emp_id`, `up_date`) VALUES
('Appointment letter', '23245665-Appointment letter-05-06-45.pdf', 23245665, '0000-00-00'),
('Appointment letter', '3245677-Appointment letter-05-06-55.PNG', 3245677, '0000-00-00'),
('C.V', '3245677-C.V-05-06-10.PNG', 3245677, '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `emp_id` (`emp_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `department` (`department`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`path`),
  ADD UNIQUE KEY `path` (`path`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`department`) REFERENCES `departments` (`name`) ON DELETE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
