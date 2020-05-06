-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-05-2020 a las 03:26:12
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `demo`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregaZombi` (`p_nombre` VARCHAR(50), `p_apellido` VARCHAR(50), `p_idEstado` INT(11))  BEGIN
		INSERT INTO zombis (nombre, apellido) VALUES(p_nombre, p_apellido);
        INSERT INTO zombis_estados (idZombi, idEstado) VALUES (LAST_INSERT_ID(), p_idEstado);
	END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `idEstado` int(11) NOT NULL,
  `nombreEstado` varchar(50) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`idEstado`, `nombreEstado`, `fechaCreacion`) VALUES
(1, 'infeccion', '2020-05-05 17:03:59'),
(2, 'desorientacion', '2020-05-05 17:03:59'),
(3, 'violencia', '2020-05-05 17:03:59'),
(4, 'desmayo', '2020-05-05 17:03:59'),
(5, 'transformacion', '2020-05-05 17:03:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zombis`
--

CREATE TABLE `zombis` (
  `idZombi` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `zombis`
--

INSERT INTO `zombis` (`idZombi`, `nombre`, `apellido`, `fechaCreacion`) VALUES
(32, 'Mauricio', 'Alvarez', '2020-05-05 22:05:03'),
(33, 'Martin', 'Noboa', '2020-05-05 22:05:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zombis_estados`
--

CREATE TABLE `zombis_estados` (
  `idZombi` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `zombis_estados`
--

INSERT INTO `zombis_estados` (`idZombi`, `idEstado`, `fechaCreacion`) VALUES
(32, 1, '2020-05-05 22:05:03'),
(32, 2, '2020-05-05 22:06:24'),
(33, 2, '2020-05-05 22:05:11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indices de la tabla `zombis`
--
ALTER TABLE `zombis`
  ADD PRIMARY KEY (`idZombi`);

--
-- Indices de la tabla `zombis_estados`
--
ALTER TABLE `zombis_estados`
  ADD UNIQUE KEY `idZombi` (`idZombi`,`idEstado`),
  ADD KEY `idEstado` (`idEstado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `idEstado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `zombis`
--
ALTER TABLE `zombis`
  MODIFY `idZombi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `zombis_estados`
--
ALTER TABLE `zombis_estados`
  ADD CONSTRAINT `zombis_estados_ibfk_1` FOREIGN KEY (`idZombi`) REFERENCES `zombis` (`idZombi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `zombis_estados_ibfk_2` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`idEstado`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
