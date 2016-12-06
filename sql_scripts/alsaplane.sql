-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-12-2016 a las 01:40:12
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `alsaplane`
--
CREATE DATABASE IF NOT EXISTS `alsaplane` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `alsaplane`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `user` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`user`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aviones`
--

CREATE TABLE `aviones` (
  `idAvion` int(5) NOT NULL,
  `modelo` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `numAsientos` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `aviones`
--

INSERT INTO `aviones` (`idAvion`, `modelo`, `numAsientos`) VALUES
(1, 'Boeing B737', 300),
(2, 'Airbus A319', 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `dni` varchar(9) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombreCli` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechaNacCli` date NOT NULL,
  `emailCli` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipoCli` enum('premium','standard') NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`dni`, `nombreCli`, `fechaNacCli`, `emailCli`, `tipoCli`, `password`) VALUES
('70707070r', 'Cliente1', '1995-11-05', 'cliente1@email.com', 'standard', 'cliente1'),
('70707071r', 'Cliente1', '1992-12-12', 'cliente2@email.com', 'premium', 'cliente2'),
('70707072r', 'Cliente3', '1990-12-11', 'cliente3@email.com', 'premium', 'cliente3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineaTripulacion`
--

CREATE TABLE `lineaTripulacion` (
  `idTrabajador` int(5) NOT NULL,
  `idVuelo` varchar(7) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lineaTripulacion`
--

INSERT INTO `lineaTripulacion` (`idTrabajador`, `idVuelo`) VALUES
(1, 'IBE2525'),
(2, 'IBE2525'),
(3, 'IBE2525');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `idVuelo` varchar(7) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idCliente` varchar(9) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `precioR` decimal(6,2) NOT NULL,
  `asiento` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`idVuelo`, `idCliente`, `precioR`, `asiento`) VALUES
('IBE2525', '70707070r', '90.00', 150),
('IBE2525', '70707071r', '81.00', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `idTrabajador` int(5) NOT NULL,
  `nombreTra` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellidosTra` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechaNacTra` date NOT NULL,
  `rolTra` enum('piloto','copiloto','auxiliar') CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`idTrabajador`, `nombreTra`, `apellidosTra`, `fechaNacTra`, `rolTra`) VALUES
(1, 'Trabajador1 Piloto', 'Apellidos1', '1989-12-07', 'piloto'),
(2, 'Trabajador2 Copiloto', 'Apellidos2', '1991-11-09', 'copiloto'),
(3, 'Trabajador3 Auxiliar', 'Apellidos3', '1986-09-21', 'auxiliar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelos`
--

CREATE TABLE `vuelos` (
  `idVuelo` varchar(7) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idAvion` int(5) NOT NULL,
  `origen` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `destino` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `precioV` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vuelos`
--

INSERT INTO `vuelos` (`idVuelo`, `idAvion`, `origen`, `destino`, `precioV`) VALUES
('IBE2525', 1, 'Madrid', 'Barcelona', '90.00'),
('RAY4040', 2, 'Londres', 'Valladolid', '120.99');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aviones`
--
ALTER TABLE `aviones`
  ADD PRIMARY KEY (`idAvion`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`dni`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `emailCli` (`emailCli`);

--
-- Indices de la tabla `lineaTripulacion`
--
ALTER TABLE `lineaTripulacion`
  ADD PRIMARY KEY (`idTrabajador`,`idVuelo`),
  ADD KEY `idVuelo` (`idVuelo`),
  ADD KEY `idTrabajador` (`idTrabajador`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`idVuelo`,`idCliente`),
  ADD KEY `idCliente` (`idCliente`),
  ADD KEY `idVuelo` (`idVuelo`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`idTrabajador`);

--
-- Indices de la tabla `vuelos`
--
ALTER TABLE `vuelos`
  ADD PRIMARY KEY (`idVuelo`),
  ADD UNIQUE KEY `idVuelo` (`idVuelo`),
  ADD KEY `idAvion` (`idAvion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aviones`
--
ALTER TABLE `aviones`
  MODIFY `idAvion` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `idTrabajador` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineaTripulacion`
--
ALTER TABLE `lineaTripulacion`
  ADD CONSTRAINT `lineatripulacion_ibfk_1` FOREIGN KEY (`idTrabajador`) REFERENCES `trabajadores` (`idTrabajador`),
  ADD CONSTRAINT `lineatripulacion_ibfk_2` FOREIGN KEY (`idVuelo`) REFERENCES `vuelos` (`idVuelo`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`idVuelo`) REFERENCES `vuelos` (`idVuelo`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`dni`);

--
-- Filtros para la tabla `vuelos`
--
ALTER TABLE `vuelos`
  ADD CONSTRAINT `vuelos_ibfk_1` FOREIGN KEY (`idAvion`) REFERENCES `aviones` (`idAvion`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
