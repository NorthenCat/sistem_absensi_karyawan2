-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306
-- Generation Time: Oct 05, 2023 at 06:01 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `username` char(6) NOT NULL,
  `employee_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `department_id` char(3) NOT NULL,
  `shift_id` int(1) NOT NULL,
  `location_id` int(1) NOT NULL,
  `in_time` int(11) NOT NULL,
  `notes` varchar(120) NOT NULL,
  `image` varchar(50) NOT NULL,
  `lack_of` varchar(11) NOT NULL,
  `in_status` varchar(15) NOT NULL,
  `out_time` int(11) NOT NULL,
  `out_status` varchar(15) NOT NULL,
  `status_absen` enum('ALPHA','HADIR') NOT NULL DEFAULT 'ALPHA',
  `latitude` decimal(11,7) NOT NULL,
  `longtitude` decimal(11,7) NOT NULL,
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `username`, `employee_id`, `department_id`, `shift_id`, `location_id`, `in_time`, `notes`, `image`, `lack_of`, `in_status`, `out_time`, `out_status`, `status_absen`, `latitude`, `longtitude`, `created_date`) VALUES
(45, 'ADM011', 011, 'ADM', 1, 1, 1589178316, 'sdf', 'item-200511-8f5d7be1a1.jpg', 'None', 'Late', 1589178477, 'Early', 'ALPHA', 0.0000000, 0.0000000, NULL),
(48, 'ADM011', 011, 'ADM', 1, 1, 1589381121, '', 'item-200513-ad6953a07e.jpg', 'Notes', 'Late', 1589381127, 'Over Time', 'ALPHA', 0.0000000, 0.0000000, NULL),
(49, 'PCD010', 010, 'PCD', 2, 1, 1589384432, 'asdasd', '', 'None,image', 'Late', 1589384514, 'Over Time', 'ALPHA', 0.0000000, 0.0000000, NULL),
(50, 'ADM011', 011, 'ADM', 1, 1, 1589391038, '', '', 'Notes,image', 'On Time', 1589391056, 'Early', 'ALPHA', 0.0000000, 0.0000000, NULL),
(51, 'PCD010', 010, 'PCD', 3, 1, 1622553388, 'testing', 'item-210601-3946bb00df.png', 'None', 'Late', 1622553470, 'Over Time', 'ALPHA', 0.0000000, 0.0000000, NULL),
(52, 'PCD010', 010, 'PCD', 3, 2, 1631893356, 'none', '', 'None,image', 'Late', 1631893413, 'Over Time', 'ALPHA', 0.0000000, 0.0000000, NULL),
(53, 'STD026', 026, 'STD', 1, 1, 1631894335, 'none', '', 'None,image', 'Late', 1631894403, 'Over Time', 'ALPHA', 0.0000000, 0.0000000, NULL),
(54, 'ADM011', 011, 'ADM', 1, 2, 1631894692, 'demo', '', 'None,image', 'Late', 1631894696, 'Over Time', 'ALPHA', 0.0000000, 0.0000000, NULL),
(55, 'QCD027', 027, 'QCD', 6, 2, 1631499386, 'none..', '', 'None,image', 'Late', 1631529057, 'Early', 'ALPHA', 0.0000000, 0.0000000, NULL),
(56, 'QCD027', 027, 'QCD', 6, 2, 1631583036, 'none', '', 'None,image', 'Late', 1631611849, 'Early', 'ALPHA', 0.0000000, 0.0000000, NULL),
(58, 'QCD027', 027, 'QCD', 6, 1, 1631733350, 'none', '', 'None,image', 'Late', 1631797356, 'Early', 'ALPHA', 0.0000000, 0.0000000, NULL),
(59, 'QCD027', 027, 'QCD', 6, 4, 1631863331, 'none', '', 'None,image', 'Late', 1631896539, 'Early', 'ALPHA', 0.0000000, 0.0000000, NULL),
(60, 'QCD027', 027, 'QCD', 6, 1, 1631214919, 'none', '', 'None,image', 'Late', 1631250936, 'Over Time', 'ALPHA', 0.0000000, 0.0000000, NULL),
(61, 'STD026', 026, 'STD', 1, 2, 1631493955, 'none', '', 'None,image', 'On Time', 1631523613, 'Over Time', 'ALPHA', 0.0000000, 0.0000000, NULL),
(62, 'ADM011', 011, 'ADM', 1, 1, 1631584873, 'none', '', 'None,image', 'Late', 1631621603, 'Over Time', 'ALPHA', 0.0000000, 0.0000000, NULL),
(63, 'QCD027', 027, 'QCD', 6, 2, 1632109417, 'this is a demo note!', '', 'None,image', 'Late', 1632109437, 'Early', 'ALPHA', 0.0000000, 0.0000000, NULL),
(64, 'ACD002', 002, 'ACD', 2, 3, 1632109840, 'demo demo', '', 'None,image', 'On Time', 1632109845, 'Early', 'ALPHA', 0.0000000, 0.0000000, NULL),
(65, 'STD026', 026, 'STD', 1, 2, 1632109903, 'test', '', 'None,image', 'Late', 1632109905, 'Early', 'ALPHA', 0.0000000, 0.0000000, NULL),
(66, 'ITD028', 028, 'ITD', 7, 7, 1654738570, 'Sample Time-In', 'item-220609-6dc7d7e8fe.png', 'None', 'On Time', 1654738629, 'Early', 'ALPHA', 0.0000000, 0.0000000, NULL),
(71, 'HRD030', 030, 'HRD', 7, 7, 1654756719, 'Sample Note only', 'item-220609-496d1ceffe.png', 'None', 'Late', 0, '', 'ALPHA', 0.0000000, 0.0000000, NULL),
(72, 'ACD031', 031, 'ACD', 1, 2, 1678851932, '', 'item-230315-3c5a1f5108.png', 'Notes', 'Late', 1678864494, 'Early', 'ALPHA', 0.0000000, 0.0000000, NULL),
(73, 'ACD031', 031, 'ACD', 1, 1, 1678957574, 'hadir di kalbe', 'item-230316-5fcf1412db.jpg', 'None', 'Late', 1678957587, 'Over Time', 'ALPHA', 0.0000000, 0.0000000, NULL),
(74, 'HRD032', 032, 'HRD', 1, 1, 1678959549, 'datang', 'item-230316-8079c1f8a2.jpg', 'None', 'Late', 1678959553, 'Over Time', 'ALPHA', 0.0000000, 0.0000000, NULL),
(75, 'HRD033', 033, 'HRD', 1, 1, 1678959963, 'hadir', 'item-230316-77ee43a096.jpg', 'None', 'Late', 1678959967, 'Over Time', 'ALPHA', 0.0000000, 0.0000000, NULL),
(76, 'HRD033', 033, 'HRD', 1, 1, 1679554094, 'DATANG', 'item-230323-e9e3e2eae0.jpeg', 'None', 'Late', 0, '', 'ALPHA', 0.0000000, 0.0000000, NULL),
(77, 'HRD037', 037, 'HRD', 2, 1, 1691967173, '', '', 'Notes,image', 'On Time', 1691989377, 'Early', 'ALPHA', 0.0000000, 0.0000000, NULL),
(78, 'HRD032', 032, 'GBS', 1, 2, 1691967969, '', '', 'Notes,image', 'On Time', 0, '', 'ALPHA', 0.0000000, 0.0000000, NULL),
(79, 'HRD033', 033, 'HRD', 1, 1, 1691973530, '', '', 'Notes,image', 'Late', 0, '', 'ALPHA', 0.0000000, 0.0000000, NULL),
(80, 'HRD037', 037, 'HRD', 2, 1, 1692068584, '', '', 'Notes,image', 'On Time', 1692114980, 'Over Time', 'ALPHA', 0.0000000, 0.0000000, NULL),
(81, 'HRD037', 037, 'HRD', 2, 1, 1692155113, '', '', 'Notes,image', 'On Time', 1692183990, 'Early', 'ALPHA', 0.0000000, 0.0000000, NULL),
(82, 'HRD037', 037, 'HRD', 2, 2, 1693407707, '\nhadir', '', 'None,image', 'Late', 1693407712, 'Over Time', 'ALPHA', 0.0000000, 0.0000000, NULL),
(83, 'HRD037', 037, 'HRD', 2, 2, 1693582889, 'hadir', 'item-230901-46556c6c81.png', 'None', 'Late', 1693582912, 'Over Time', 'ALPHA', 0.0000000, 0.0000000, NULL),
(84, 'HRD037', 037, 'GRU', 2, 1, 1693885793, '', '', 'Notes,image', 'On Time', 1693914189, 'Early', 'ALPHA', 0.0000000, 0.0000000, NULL),
(85, 'HRD037', 037, 'GRU', 2, 0, 1695355933, '123', '', 'None,image', 'On Time', 1695355951, 'Early', 'ALPHA', -6.8976640, 107.6101120, NULL),
(86, 'HRD032', 032, 'GRU', 1, 0, 1695355984, '2', '', 'None,image', 'Late', 1695357624, 'Early', 'ALPHA', -6.9996124, 107.6595721, NULL),
(120, '', 025, '', 0, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-09-22'),
(121, '', 001, '', 1, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-09-22'),
(122, 'ACD031', 031, 'GRU', 1, 0, 1695365455, '', '', 'Notes,image', 'Late', 1695365476, 'Early', 'HADIR', -6.8976640, 107.6101120, '2023-09-22'),
(123, '', 032, '', 1, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-09-22'),
(124, '', 033, '', 1, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-09-22'),
(125, '', 035, '', 1, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-09-22'),
(126, '', 037, '', 2, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-09-22'),
(127, '', 036, '', 7, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-09-22'),
(137, '', 025, '', 0, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-01'),
(138, '', 001, '', 1, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-01'),
(139, '', 031, '', 1, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-01'),
(140, '', 032, '', 1, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-01'),
(141, '', 033, '', 1, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-01'),
(142, '', 035, '', 1, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-01'),
(143, '', 037, '', 2, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-01'),
(144, '', 036, '', 7, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-01'),
(152, 'HRD037', 037, 'GRU', 2, 1, 1696302315, '', '', 'Notes,image', 'On Time', 0, '', 'ALPHA', 0.0000000, 0.0000000, NULL),
(153, '', 025, '', 0, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-03'),
(154, '', 001, '', 1, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-03'),
(155, '', 031, '', 1, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-03'),
(156, '', 032, '', 1, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-03'),
(157, '', 033, '', 1, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-03'),
(158, '', 035, '', 1, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-03'),
(159, '', 037, '', 2, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-03'),
(160, '', 036, '', 7, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-03'),
(161, '', 025, '', 0, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-05'),
(162, '', 001, '', 1, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-05'),
(163, '', 031, '', 1, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-05'),
(164, 'HRD032', 032, 'GRU', 1, 2, 1696465552, 'testing', '', 'None,image', 'On Time', 1696465584, 'Early', 'HADIR', -6.9995905, 107.6596683, '2023-10-05'),
(165, '', 033, '', 1, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-05'),
(166, '', 035, '', 1, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-05'),
(167, '', 038, '', 1, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-05'),
(168, 'HRD037', 037, 'GRU', 2, 0, 1696467896, 'testing\r\n', 'item-231005-7f6f037155.jpg', 'None', 'On Time', 1696468450, 'Early', 'HADIR', -6.9995946, 107.6596669, '2023-10-05'),
(169, '', 036, '', 7, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-05'),
(170, '', 039, '', 0, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-05'),
(171, '', 040, '', 0, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-05'),
(172, '', 042, '', 1, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-05'),
(173, '', 041, '', 2, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-05'),
(174, '', 043, '', 2, 0, 0, '', '', '', '', 0, '', 'ALPHA', 0.0000000, 0.0000000, '2023-10-05');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` char(3) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
('ADM', 'Admin Department'),
('GRU', 'Guru');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(128) NOT NULL,
  `gender` char(1) NOT NULL,
  `image` varchar(128) NOT NULL,
  `birth_date` date NOT NULL,
  `hire_date` date NOT NULL,
  `shift_id` int(1) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `gender`, `image`, `birth_date`, `hire_date`, `shift_id`, `no_hp`) VALUES
(001, 'riki', 'riki@gmail.com', 'M', 'default.png', '1981-01-01', '2010-10-09', 1, ''),
(025, 'Admin ', 'admin@admin.com', 'M', 'default.png', '0000-00-00', '0000-00-00', 0, ''),
(031, 'muhamad', 'muhaamd@gmail.com', 'M', 'item-230316-fd4dccf90f.png', '1999-10-03', '2009-10-04', 1, ''),
(032, 'davit', 'davit@gmail.com', 'M', 'item-230316-b928ee1bf6.jpg', '2002-01-01', '2010-10-12', 1, ''),
(033, 'andin', 'andin@gmail.com', 'F', 'default.png', '2002-01-01', '2023-03-09', 1, ''),
(035, 'Rizal Faisal', 'rizal@gmail.com', 'M', 'item-230812-87dfb45d24.jpg', '2001-12-04', '2023-07-01', 1, ''),
(036, 'Ahmad Nur', 'ahnur@gmail.com', 'M', 'item-230812-1a676e8060.png', '2001-12-02', '2023-06-01', 7, ''),
(037, 'Yuanto', 'yuanto@gmail.com', 'M', 'item-230813-67f05fcdff.jpg', '1998-01-14', '2023-06-01', 2, ''),
(038, 'kesya', 'kesss@gmail.com', 'M', 'item-231004-e19d3b70aa.jpg', '2023-10-10', '2023-10-04', 1, '0862736351'),
(039, 'fahmoy', 'moy@gmail.com', 'M', 'item-231005-4e8ce9f606.jpeg', '2015-02-12', '2023-10-05', 0, '07292719273'),
(040, 'gempi', 'pi@gmail.com', 'F', 'default.png', '2023-08-10', '2023-10-05', 0, '019823'),
(041, 'mail', 'mail@gmail.com', 'M', 'item-231005-eb0c28711d.jpg', '2023-06-01', '2023-10-05', 2, '081111111111'),
(042, 'gopal', 'gogogo@gmail.com', 'M', 'default.png', '2023-10-03', '2023-10-05', 1, '9012910283'),
(043, 'Fahmi', 'fahmi@gmail.com', 'M', 'item-231005-61a7a2d540.jpg', '2004-08-08', '2023-10-01', 2, '085156950595');

-- --------------------------------------------------------

--
-- Table structure for table `employee_department`
--

CREATE TABLE `employee_department` (
  `id` int(3) NOT NULL,
  `employee_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `department_id` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee_department`
--

INSERT INTO `employee_department` (`id`, `employee_id`, `department_id`) VALUES
(1, 001, 'GRU'),
(2, 038, 'GRU'),
(3, 031, 'GRU'),
(4, 032, 'GRU'),
(5, 033, 'GRU'),
(6, 035, 'ADM'),
(7, 036, 'GRU'),
(8, 037, 'GRU'),
(9, 042, 'GRU'),
(10, 043, 'GRU'),
(11, 044, 'GRU');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(1) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`) VALUES
(1, 'Home'),
(2, 'Office'),
(7, 'Kantin');

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `id` int(1) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`id`, `start`, `end`) VALUES
(1, '08:00:00', '16:00:00'),
(2, '13:00:00', '21:00:00'),
(3, '18:00:00', '02:00:00'),
(4, '03:15:02', '02:05:05'),
(5, '07:00:00', '18:25:00'),
(6, '01:00:00', '12:00:00'),
(7, '09:30:00', '18:30:00'),
(8, '23:23:23', '23:23:23');

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` int(11) NOT NULL,
  `nip` varchar(15) NOT NULL,
  `nama_guru` varchar(120) NOT NULL,
  `email` varchar(65) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nip`, `nama_guru`, `email`, `password`, `foto`, `status`) VALUES
(5, '001', 'Fatmawati S.Pd', 'fatmawati@gmail.com', 'e193a01ecf8d30ad0affefd332ce934e32ffce72', 'guru.png', 'Y'),
(6, '002', 'Rahayu S.Pd', 'rahayu@gmail.com', '6fc978af728d43c59faa400d5f6e0471ac850d4c', '17603.png', 'Y'),
(7, '003', 'Jaka Subadri S.Pd', 'jakasubadri@gmail.com', '221407c03ae5c73109cce71d27e24637824f3333', '355-3553881_stockvader-predicted-adig-user-profile-icon-png-clipart.jpg', 'Y'),
(8, '004', 'Tiwi Sukmawati S.Pd', 'tiwisukmawati@gmail.com', 'c63528a52274a35d1c07bd9e55a83c6eb073de81', '17603.png', 'Y'),
(5, '001', 'Fatmawati S.Pd', 'fatmawati@gmail.com', 'e193a01ecf8d30ad0affefd332ce934e32ffce72', 'guru.png', 'Y'),
(6, '002', 'Rahayu S.Pd', 'rahayu@gmail.com', '6fc978af728d43c59faa400d5f6e0471ac850d4c', '17603.png', 'Y'),
(7, '003', 'Jaka Subadri S.Pd', 'jakasubadri@gmail.com', '221407c03ae5c73109cce71d27e24637824f3333', '355-3553881_stockvader-predicted-adig-user-profile-icon-png-clipart.jpg', 'Y'),
(8, '004', 'Tiwi Sukmawati S.Pd', 'tiwisukmawati@gmail.com', 'c63528a52274a35d1c07bd9e55a83c6eb073de81', '17603.png', 'Y'),
(5, '001', 'Fatmawati S.Pd', 'fatmawati@gmail.com', 'e193a01ecf8d30ad0affefd332ce934e32ffce72', 'guru.png', 'Y'),
(6, '002', 'Rahayu S.Pd', 'rahayu@gmail.com', '6fc978af728d43c59faa400d5f6e0471ac850d4c', '17603.png', 'Y'),
(7, '003', 'Jaka Subadri S.Pd', 'jakasubadri@gmail.com', '221407c03ae5c73109cce71d27e24637824f3333', '355-3553881_stockvader-predicted-adig-user-profile-icon-png-clipart.jpg', 'Y'),
(8, '004', 'Tiwi Sukmawati S.Pd', 'tiwisukmawati@gmail.com', 'c63528a52274a35d1c07bd9e55a83c6eb073de81', '17603.png', 'Y'),
(5, '001', 'Fatmawati S.Pd', 'fatmawati@gmail.com', 'e193a01ecf8d30ad0affefd332ce934e32ffce72', 'guru.png', 'Y'),
(6, '002', 'Rahayu S.Pd', 'rahayu@gmail.com', '6fc978af728d43c59faa400d5f6e0471ac850d4c', '17603.png', 'Y'),
(7, '003', 'Jaka Subadri S.Pd', 'jakasubadri@gmail.com', '221407c03ae5c73109cce71d27e24637824f3333', '355-3553881_stockvader-predicted-adig-user-profile-icon-png-clipart.jpg', 'Y'),
(8, '004', 'Tiwi Sukmawati S.Pd', 'tiwisukmawati@gmail.com', 'c63528a52274a35d1c07bd9e55a83c6eb073de81', '17603.png', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_master_mapel`
--

CREATE TABLE `tb_master_mapel` (
  `id_mapel` int(11) NOT NULL,
  `kode_mapel` varchar(40) NOT NULL,
  `mapel` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_master_mapel`
--

INSERT INTO `tb_master_mapel` (`id_mapel`, `kode_mapel`, `mapel`) VALUES
(2, 'MP-1561560129', 'Matematika'),
(3, 'MP-1561871991', 'Biologi'),
(4, 'MP-1561872004', 'Sejarah'),
(5, 'MP-1561872013', 'Teknologi Informasi'),
(6, 'MP-1561872026', 'Seni Budaya'),
(7, 'MP-1561872043', 'Bahasa Inggris'),
(8, 'MP-1615002340', 'Ilmu Pengetahuan Alam'),
(9, 'MP-1693850833', 'Ekonomi'),
(11, 'MP-1693851237', 'Bahasa Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mengajar`
--

CREATE TABLE `tb_mengajar` (
  `id_mengajar` int(11) NOT NULL,
  `kode_pelajaran` varchar(30) NOT NULL,
  `hari` varchar(40) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_akhir` time NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_mkelas` int(11) NOT NULL,
  `id_semester` int(11) NOT NULL,
  `id_thajaran` int(11) NOT NULL,
  `id_employee` int(3) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_mengajar`
--

INSERT INTO `tb_mengajar` (`id_mengajar`, `kode_pelajaran`, `hari`, `jam_mulai`, `jam_akhir`, `id_guru`, `id_mapel`, `id_mkelas`, `id_semester`, `id_thajaran`, `id_employee`) VALUES
(2, 'MPL-1614674537', 'Senin', '22:00:00', '10:00:00', 5, 2, 5, 4, 8, 037),
(4, 'MPL-1615004563', 'Senin', '15:00:00', '16:00:00', 6, 2, 6, 4, 8, 037),
(20, 'MPL-1696477222', 'Rabu', '07:00:00', '11:00:00', 0, 2, 5, 4, 0, 043);

-- --------------------------------------------------------

--
-- Table structure for table `tb_mkelas`
--

CREATE TABLE `tb_mkelas` (
  `id_mkelas` int(11) NOT NULL,
  `kd_kelas` varchar(40) NOT NULL,
  `kelas` enum('X','XI','XII','') NOT NULL,
  `nama_kelas` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_mkelas`
--

INSERT INTO `tb_mkelas` (`id_mkelas`, `kd_kelas`, `kelas`, `nama_kelas`) VALUES
(5, 'KL-1616673105', 'XI', 'A'),
(6, 'KL-1616673114', 'X', 'B'),
(7, 'KL-1616673120', 'X', 'D'),
(12, 'KL-1694136416', 'XI', 'D');

-- --------------------------------------------------------

--
-- Table structure for table `tb_semester`
--

CREATE TABLE `tb_semester` (
  `id_semester` int(11) NOT NULL,
  `semester` varchar(45) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_semester`
--

INSERT INTO `tb_semester` (`id_semester`, `semester`, `status`) VALUES
(4, 'Ganjil', 1),
(5, 'Genap', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(60) NOT NULL,
  `nama_siswa` varchar(120) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL,
  `th_angkatan` year(4) NOT NULL,
  `id_mkelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `nis`, `nama_siswa`, `tempat_lahir`, `tgl_lahir`, `jk`, `alamat`, `password`, `foto`, `status`, `th_angkatan`, `id_mkelas`) VALUES
(1, '001', 'Imam Hambali', 'jakarta', '2020-03-01', 'L', 'Jl. Mawar', 'e193a01ecf8d30ad0affefd332ce934e32ffce72', 'male.png', '1', '2020', 5),
(2, '002', 'agis sagita', 'bogor', '2012-06-02', 'P', 'jl. batok tenjo-bogor', '6fc978af728d43c59faa400d5f6e0471ac850d4c', 'female.png', '1', '2020', 5),
(3, '004', 'indah nuraeni', 'bogor', '2009-07-01', 'L', 'bogor', 'c63528a52274a35d1c07bd9e55a83c6eb073de81', 'female.png', '1', '2019', 12),
(4, '12345', 'Suci', 'tangerang', '2002-09-21', 'P', 'Kademangan', '8cb2237d0679ca88db6464eac60da96345513964', 'female.png', '1', '2019', 6),
(17, 'NIS-1694021203', 'dadang', 'tangerang', '2004-08-08', 'L', 'cluster belle fleur cikupa', '', 'male.png', '', '0000', 7),
(18, 'NIS-1694134928', 'herlina', 'bandung', '2002-04-06', 'L', 'bandung', '', 'male.png', '', '0000', 6),
(19, 'NIS-1694134954', 'dudu', 'jakarta', '2002-03-20', 'P', 'jakarta', '', 'female.png', '', '0000', 6),
(120, '123123', 'megaman', 'ngawi', '2002-12-01', 'P', 'jl anggrek', '', 'item-231004-9c90f07742.png', '', '0000', 5),
(121, '312312', 'sri', 'bandung', '2003-02-02', 'L', 'jl bunga', '', 'item-231005-86c0265694.jpeg', '', '0000', 12),
(122, '55432', 'enggar', 'tagung', '1996-11-19', 'l', 'boyolangu', '', 'item-231005-214ce88534.jpeg', '', '0000', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_thajaran`
--

CREATE TABLE `tb_thajaran` (
  `id_thajaran` int(11) NOT NULL,
  `tahun_ajaran` varchar(30) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_thajaran`
--

INSERT INTO `tb_thajaran` (`id_thajaran`, `tahun_ajaran`, `status`) VALUES
(7, '2019/2020', 0),
(8, '2020/2021', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` char(6) NOT NULL,
  `password` varchar(128) NOT NULL,
  `employee_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `role_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `employee_id`, `role_id`) VALUES
('ACD002', '$2y$10$5nv5ehyMVdljfKJ6izsOqOimsbv.cbzU.XLB9ji9zbA.eICdSrNvO', 002, 2),
('ACD031', '$2y$10$f5.A1YI845WT/mVnlsej/erGKN63R8UnG6oqOzPXpJhZjG/zL5Q7a', 031, 2),
('ADM011', '$2y$10$BKpQcs4XKavCcYdFWujzx.Xqb7r9eNkDrOYss2VNXrMJUUpm1agUC', 011, 2),
('ADM035', '$2y$10$O5b8ad1qUjFDkd17m8Jkb.ELuLjjJLoGper67AAlqns59YpDg6vqm', 035, 1),
('admin', '$2y$10$tG8hnh7w.yiJL7fjlRCmkuHBwi0QI6DHFXmc1s6X3cAFuw5pRfO/O', 025, 1),
('GRU001', '$2y$10$/4GzcoJ0Qr47WaqdDeGE/Oxcj7xKJar3AxVM2AEpdfgm68q7sDXXq', 001, 2),
('GRU038', '$2y$10$OxzBh6YcTypo37WuxBHCp.RIvS.SUytNlYT48/OI9NlfoBc8qosti', 038, 2),
('GRU043', '$2y$10$.yaDiiS4BCdQCowt4S3sfuZv3l42bzN8m37/YkIlocYGFTLO0gh56', 043, 2),
('HRD032', '$2y$10$.kkZEEyYCag8PPRrHUvJEuRugrbQA5TABVMfo03TzQKn5jsWjJGte', 032, 2),
('HRD033', '$2y$10$Wdz9lF8szogRobz476xgl.1NOu2zIX..CsQ5ZNMbksNkUGSyoo.4C', 033, 2),
('HRD034', '$2y$10$8WvtMhOhvt07r1x4GQSAXOkxx/8tOu.9BPmrVF4/QvIezE/DEi4QK', 034, 2),
('HRD037', '$2y$10$oYF89TPEtfY5PT4t7pBCGuAabR7ErOE/R9XNCW/7ihF/Y3Xo/NsNu', 037, 2),
('lgs036', '$2y$10$HXYtKbA/waFaMqdIECPrZeeYgUcEyXD1k26WWi3oawGa1W9nhPFS6', 036, 2),
('PCD010', '$2y$10$BKpQcs4XKavCcYdFWujzx.Xqb7r9eNkDrOYss2VNXrMJUUpm1agUC', 010, 2),
('QCD027', '$2y$10$peALJo.JKZyD6uMBd41UfuHGQSJe7ExOfDhPITvDbSRRXeWUGY9xy', 027, 2),
('STD005', '$2y$10$hr35h1fIySFYCSRVL2jRD.RuYa9WtJCEJkkqvQfPboYK7VwURpLim', 005, 2),
('STD008', '$2y$10$8PGnFaiZPYtcIGrwzMmVZuNKbUb/A88f0NZOA9QVgHaUIJ6ddg.Si', 008, 2),
('STD026', '$2y$10$8WNMvEEgNPWyRuSeeLDE1uXwnBkYNJE/heLT1zWbsUfYb/wKFyYIy', 026, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE `user_access` (
  `id` int(2) NOT NULL,
  `role_id` int(1) NOT NULL,
  `menu_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_access`
--

INSERT INTO `user_access` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 2, 4),
(5, 1, 6),
(6, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(2) NOT NULL,
  `menu` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Master'),
(3, 'Attendance'),
(4, 'Profile'),
(5, 'Learning'),
(6, 'Report');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(1) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `user_submenu`
--

CREATE TABLE `user_submenu` (
  `id` int(2) NOT NULL,
  `menu_id` int(2) NOT NULL,
  `title` varchar(20) NOT NULL,
  `url` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_submenu`
--

INSERT INTO `user_submenu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'Department', 'master', 'fas fa-fw fa-building', 1),
(3, 2, 'Shift', 'master/shift', 'fas fa-fw fa-exchange-alt', 1),
(4, 2, 'Employee', 'master/employee', 'fas fa-fw fa-id-badge', 1),
(5, 2, 'Location', 'master/location', 'fas fa-fw fa-map', 1),
(6, 3, 'Attendance Form', 'attendance', 'fas fa-fw fa-clipboard-list', 1),
(7, 3, 'Lesson Attandance', 'attendance/stats', 'fas fa-fw fa-user-check', 1),
(8, 4, 'My Profile', 'profile', 'fas fa-fw fa-id-card', 1),
(9, 2, 'Users', 'master/users', 'fas fa-fw fa-users', 1),
(11, 6, 'Employee Report', 'report', 'fas fa-fw fa-paste', 1),
(12, 3, 'History', 'attendance/history', 'fas fa-fw fa-th-list', 1),
(13, 5, 'Schedule', 'learning/schedule', 'fas fa-fw fa-clipboard-list', 1),
(14, 5, 'Class', 'learning/class', 'fa-regular fa-user', 1),
(15, 5, 'Subjects', 'learning/subject', 'fas fa-fw fa-book', 1),
(16, 5, 'Students', 'learning/students', 'fas fa-fw fa-users', 1),
(17, 6, 'Student Report', 'report/student_report', 'fas fa-fw fa-paste', 1);

-- --------------------------------------------------------

--
-- Table structure for table `_logabsensi`
--

CREATE TABLE `_logabsensi` (
  `id_presensi` int(11) NOT NULL,
  `id_mengajar` int(11) NOT NULL,
  `id_mkelas` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `tgl_absen` date NOT NULL,
  `jam_absen` time NOT NULL,
  `ket_absen` varchar(255) NOT NULL,
  `ket` enum('H','I','S','T','A','C') DEFAULT 'A',
  `pertemuan_ke` varchar(30) NOT NULL,
  `latitude` decimal(11,7) DEFAULT NULL,
  `longitude` decimal(11,7) DEFAULT NULL,
  `status_notif` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `_logabsensi`
--

INSERT INTO `_logabsensi` (`id_presensi`, `id_mengajar`, `id_mkelas`, `id_siswa`, `tgl_absen`, `jam_absen`, `ket_absen`, `ket`, `pertemuan_ke`, `latitude`, `longitude`, `status_notif`) VALUES
(1, 2, 0, 1, '2021-03-02', '00:00:00', '', '', '1', 0.0000000, 0.0000000, 0),
(2, 4, 0, 2, '2021-03-06', '00:00:00', '', 'I', '1', 0.0000000, 0.0000000, 0),
(3, 2, 0, 1, '2021-03-21', '00:00:00', '', 'H', '2', 0.0000000, 0.0000000, 0),
(4, 2, 0, 3, '2021-03-21', '00:00:00', '', 'H', '3', 0.0000000, 0.0000000, 0),
(5, 5, 0, 1, '2021-03-21', '00:00:00', '', 'H', '1', 0.0000000, 0.0000000, 0),
(6, 5, 0, 3, '2021-03-21', '00:00:00', '', 'H', '1', 0.0000000, 0.0000000, 0),
(7, 2, 0, 1, '2021-03-23', '00:00:00', '', 'H', '4', 0.0000000, 0.0000000, 0),
(8, 2, 0, 3, '2021-03-23', '00:00:00', '', 'I', '4', 0.0000000, 0.0000000, 0),
(9, 6, 0, 1, '2021-03-23', '00:00:00', '', 'H', '1', 0.0000000, 0.0000000, 0),
(10, 6, 0, 3, '2021-03-23', '00:00:00', '', 'H', '1', 0.0000000, 0.0000000, 0),
(11, 6, 0, 4, '2021-03-23', '00:00:00', '', 'H', '1', 0.0000000, 0.0000000, 0),
(12, 6, 0, 1, '2021-03-25', '00:00:00', '', 'I', '2', 0.0000000, 0.0000000, 0),
(13, 6, 0, 3, '2021-03-25', '00:00:00', '', 'I', '2', 0.0000000, 0.0000000, 0),
(14, 6, 0, 4, '2021-03-25', '00:00:00', '', 'I', '2', 0.0000000, 0.0000000, 0),
(285, 4, 6, 3, '2023-08-29', '00:00:00', '', 'A', '1', 0.0000000, 0.0000000, 0),
(286, 4, 6, 4, '2023-08-29', '00:00:00', '', 'A', '1', 0.0000000, 0.0000000, 0),
(287, 2, 5, 1, '2023-08-29', '00:00:00', '', 'S', '1', 0.0000000, 0.0000000, 0),
(288, 2, 5, 2, '2023-08-29', '00:00:00', '', 'I', '1', 0.0000000, 0.0000000, 0),
(293, 2, 5, 1, '2023-08-30', '00:00:00', '', 'H', '1', 0.0000000, 0.0000000, 0),
(294, 2, 5, 2, '2023-08-30', '00:00:00', '', 'I', '1', 0.0000000, 0.0000000, 0),
(295, 4, 6, 3, '2023-08-30', '00:00:00', '', 'H', '1', 0.0000000, 0.0000000, 0),
(296, 4, 6, 4, '2023-08-30', '00:00:00', '', 'H', '1', 0.0000000, 0.0000000, 0),
(303, 2, 5, 1, '2023-08-31', '00:00:00', '', 'H', '2', 0.0000000, 0.0000000, 0),
(304, 2, 5, 2, '2023-08-31', '00:00:00', '', 'S', '2', 0.0000000, 0.0000000, 0),
(305, 2, 5, 1, '2023-09-01', '00:00:00', '', 'H', '2', 0.0000000, 0.0000000, 0),
(333, 4, 6, 4, '2023-09-08', '15:25:40', 'Tepat Waktu', 'H', '2', 0.0000000, 0.0000000, 0),
(334, 4, 6, 18, '2023-09-08', '15:31:52', 'Telat 2 Menit', 'S', '2', 0.0000000, 0.0000000, 0),
(335, 4, 6, 19, '2023-09-08', '15:25:40', 'Tepat Waktu', 'H', '2', 0.0000000, 0.0000000, 0),
(336, 2, 5, 1, '2023-09-08', '15:30:51', 'Telat 8 Jam 1 Menit', 'H', '2', 0.0000000, 0.0000000, 0),
(337, 2, 5, 2, '2023-09-08', '15:30:51', 'Telat 8 Jam 1 Menit', 'I', '2', 0.0000000, 0.0000000, 0),
(338, 4, 6, 4, '2023-09-09', '22:35:51', 'Telat 7 Jam 21 Menit', 'S', '2', 0.0000000, 0.0000000, 0),
(339, 4, 6, 18, '2023-09-09', '22:35:51', 'Telat 7 Jam 21 Menit', 'I', '2', 0.0000000, 0.0000000, 0),
(340, 4, 6, 19, '2023-09-09', '22:35:51', 'Telat 7 Jam 21 Menit', 'S', '2', 0.0000000, 0.0000000, 0),
(341, 2, 5, 1, '2023-09-09', '22:54:30', 'Telat 40 Menit', 'H', '2', 0.0000000, 0.0000000, 0),
(342, 2, 5, 2, '2023-09-09', '22:42:33', 'Telat 28 Menit', 'H', '2', 0.0000000, 0.0000000, 0),
(343, 2, 5, 1, '2023-09-10', '00:00:00', '', 'A', '2', 0.0000000, 0.0000000, 0),
(344, 2, 5, 2, '2023-09-10', '00:00:00', '', 'A', '2', 0.0000000, 0.0000000, 0),
(345, 2, 5, 1, '2023-09-18', '00:00:00', '', 'A', '2', 0.0000000, 0.0000000, 0),
(346, 2, 5, 2, '2023-09-18', '00:00:00', '', 'A', '2', 0.0000000, 0.0000000, 0),
(347, 4, 6, 4, '2023-09-19', '20:04:55', 'Telat 4 Jam 50 Menit', 'S', '2', -7.0909952, 107.6953088, 0),
(348, 4, 6, 18, '2023-09-19', '20:04:55', 'Telat 4 Jam 50 Menit', 'I', '2', -7.0909952, 107.6953088, 0),
(349, 4, 6, 19, '2023-09-19', '20:04:55', 'Telat 4 Jam 50 Menit', 'H', '2', -7.0909952, 107.6953088, 0),
(350, 4, 6, 4, '2023-09-20', '11:58:13', 'Terlalu Cepat', 'H', '2', -6.9727036, 107.6295720, 0),
(351, 4, 6, 18, '2023-09-20', '11:58:13', 'Terlalu Cepat', 'S', '2', -6.9727036, 107.6295720, 0),
(352, 4, 6, 19, '2023-09-20', '11:58:13', 'Terlalu Cepat', 'I', '2', -6.9727036, 107.6295720, 0),
(353, 4, 6, 4, '2023-09-22', '10:21:05', 'Terlalu Cepat', 'H', '2', -6.8976640, 107.6101120, 0),
(354, 4, 6, 18, '2023-09-22', '10:21:05', 'Terlalu Cepat', 'H', '2', -6.8976640, 107.6101120, 0),
(355, 4, 6, 19, '2023-09-22', '10:21:05', 'Terlalu Cepat', 'H', '2', -6.8976640, 107.6101120, 0),
(356, 2, 5, 1, '2023-09-22', '10:31:28', 'Terlalu Cepat', 'H', '2', -6.8976640, 107.6101120, 0),
(357, 2, 5, 2, '2023-09-22', '10:31:28', 'Terlalu Cepat', 'A', '2', -6.8976640, 107.6101120, 0),
(358, 4, 6, 4, '2023-10-01', '00:00:00', '', 'A', '2', 0.0000000, 0.0000000, 0),
(359, 4, 6, 18, '2023-10-01', '00:00:00', '', 'A', '2', 0.0000000, 0.0000000, 0),
(360, 4, 6, 19, '2023-10-01', '00:00:00', '', 'A', '2', 0.0000000, 0.0000000, 0),
(361, 2, 5, 1, '2023-10-03', '10:07:28', 'Terlalu Cepat', 'S', '2', 0.0000000, 0.0000000, 0),
(362, 2, 5, 2, '2023-10-03', '10:12:37', 'Terlalu Cepat', 'I', '2', -8.0827577, 111.9481372, 0),
(363, 4, 6, 4, '2023-10-04', '01:47:54', 'Terlalu Cepat', 'H', '2', -8.0827581, 111.9481374, 0),
(364, 4, 6, 18, '2023-10-04', '01:47:54', 'Terlalu Cepat', 'H', '2', -8.0827581, 111.9481374, 0),
(365, 4, 6, 19, '2023-10-04', '01:47:54', 'Terlalu Cepat', 'H', '2', -8.0827581, 111.9481374, 0),
(366, 2, 5, 1, '2023-10-05', '10:56:34', 'Telat 3 Jam 42 Menit', 'H', '2', -6.8943872, 107.5838976, 1),
(367, 2, 5, 2, '2023-10-05', '10:56:34', 'Telat 3 Jam 42 Menit', 'S', '2', -6.8943872, 107.5838976, 1),
(368, 2, 5, 120, '2023-10-05', '10:56:34', 'Telat 3 Jam 42 Menit', 'H', '2', -6.8943872, 107.5838976, 1),
(369, 2, 5, 122, '2023-10-05', '10:59:57', 'Telat 3 Jam 45 Menit', 'I', '2', -6.8943872, 107.5838976, 1),
(370, 4, 6, 4, '2023-10-05', '09:46:35', 'Terlalu Cepat', 'H', '2', -6.8943872, 107.5838976, 1),
(371, 4, 6, 18, '2023-10-05', '09:46:35', 'Terlalu Cepat', 'I', '2', -6.8943872, 107.5838976, 1),
(372, 4, 6, 19, '2023-10-05', '09:46:35', 'Terlalu Cepat', 'H', '2', -6.8943872, 107.5838976, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `shift_id` (`shift_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shift_id_fk_e` (`shift_id`);

--
-- Indexes for table `employee_department`
--
ALTER TABLE `employee_department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_department_ibfk_1` (`employee_id`),
  ADD KEY `employee_department_ibfk_2` (`department_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_master_mapel`
--
ALTER TABLE `tb_master_mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `tb_mengajar`
--
ALTER TABLE `tb_mengajar`
  ADD PRIMARY KEY (`id_mengajar`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indexes for table `tb_mkelas`
--
ALTER TABLE `tb_mkelas`
  ADD PRIMARY KEY (`id_mkelas`);

--
-- Indexes for table `tb_semester`
--
ALTER TABLE `tb_semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `tb_thajaran`
--
ALTER TABLE `tb_thajaran`
  ADD PRIMARY KEY (`id_thajaran`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_submenu`
--
ALTER TABLE `user_submenu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `_logabsensi`
--
ALTER TABLE `_logabsensi`
  ADD PRIMARY KEY (`id_presensi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `employee_department`
--
ALTER TABLE `employee_department`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_master_mapel`
--
ALTER TABLE `tb_master_mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_mengajar`
--
ALTER TABLE `tb_mengajar`
  MODIFY `id_mengajar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_mkelas`
--
ALTER TABLE `tb_mkelas`
  MODIFY `id_mkelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_semester`
--
ALTER TABLE `tb_semester`
  MODIFY `id_semester` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `tb_thajaran`
--
ALTER TABLE `tb_thajaran`
  MODIFY `id_thajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_access`
--
ALTER TABLE `user_access`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_submenu`
--
ALTER TABLE `user_submenu`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `_logabsensi`
--
ALTER TABLE `_logabsensi`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=373;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_access`
--
ALTER TABLE `user_access`
  ADD CONSTRAINT `user_access_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_access_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_submenu`
--
ALTER TABLE `user_submenu`
  ADD CONSTRAINT `user_submenu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
