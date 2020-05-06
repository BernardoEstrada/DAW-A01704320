-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2020 at 07:09 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ep2`
--

DELIMITER $$
--
-- Procedures
--
CREATE PROCEDURE `agregaIncidente` (IN `p_idLugar` INT(63), IN `p_idTipo` INT(63))  BEGIN
        INSERT INTO incidente (idLugar, idTipoIn) VALUES(p_idLugar, p_idTipo);
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `incidente`
--

CREATE TABLE `incidente` (
  `idLugar` int(63) NOT NULL,
  `idTipoIn` int(63) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lugares`
--

CREATE TABLE `lugares` (
  `idLugar` int(63) NOT NULL,
  `nombreLugar` varchar(127) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lugares`
--

INSERT INTO `lugares` (`idLugar`, `nombreLugar`) VALUES
(1, 'Centro turístico'),
(2, 'Laboratorios'),
(3, 'Restaurante'),
(4, 'Centro operativo'),
(5, 'Triceratops'),
(6, 'Dilofosaurios'),
(7, 'Velociraptors'),
(8, 'TRex'),
(9, 'Planicie de los herbívoros');

-- --------------------------------------------------------

--
-- Table structure for table `tipos_incidentes`
--

CREATE TABLE `tipos_incidentes` (
  `idTipoIn` int(63) NOT NULL,
  `nombreTipoIn` varchar(127) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipos_incidentes`
--

INSERT INTO `tipos_incidentes` (`idTipoIn`, `nombreTipoIn`) VALUES
(1, 'Falla eléctrica'),
(2, 'Fuga de herbívoro'),
(3, 'Fuga de Velociraptors'),
(4, 'Fuga de TRex'),
(5, 'Robo de ADN'),
(6, 'Auto descompuesto'),
(7, 'Visitantes en zona no autorizada');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `incidente`
--
ALTER TABLE `incidente`
  ADD PRIMARY KEY (`idLugar`,`idTipoIn`,`fecha`);

--
-- Indexes for table `lugares`
--
ALTER TABLE `lugares`
  ADD PRIMARY KEY (`idLugar`);

--
-- Indexes for table `tipos_incidentes`
--
ALTER TABLE `tipos_incidentes`
  ADD PRIMARY KEY (`idTipoIn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lugares`
--
ALTER TABLE `lugares`
  MODIFY `idLugar` int(63) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tipos_incidentes`
--
ALTER TABLE `tipos_incidentes`
  MODIFY `idTipoIn` int(63) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incidente`
--
ALTER TABLE `incidente`
  ADD CONSTRAINT `incidente_ibfk_1` FOREIGN KEY (`idLugar`) REFERENCES `lugares` (`idLugar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incidente_ibfk_2` FOREIGN KEY (`idTipoIn`) REFERENCES `tipos_incidentes` (`idTipoIn`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
