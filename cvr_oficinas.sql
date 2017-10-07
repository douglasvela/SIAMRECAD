-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 06, 2017 at 10:17 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mtps`
--

-- --------------------------------------------------------

--
-- Table structure for table `cvr_oficinas`
--

CREATE TABLE `cvr_oficinas` (
  `id_oficina` int(11) NOT NULL,
  `nombre_oficina` varchar(200) NOT NULL,
  `direccion_oficina` varchar(400) NOT NULL,
  `latitud_oficina` varchar(50) NOT NULL,
  `longitud_oficina` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cvr_oficinas`
--

INSERT INTO `cvr_oficinas` (`id_oficina`, `nombre_oficina`, `direccion_oficina`, `latitud_oficina`, `longitud_oficina`) VALUES
(1, 'Oficina Central', 'primera direccion', '13.705542923582362', ' -89.20029401779175'),
(2, 'Oficina Paracentral', 'segunda direeccion', '13.640398422358578', ' -88.78575325012207');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cvr_oficinas`
--
ALTER TABLE `cvr_oficinas`
  ADD PRIMARY KEY (`id_oficina`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cvr_oficinas`
--
ALTER TABLE `cvr_oficinas`
  MODIFY `id_oficina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
