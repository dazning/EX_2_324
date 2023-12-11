-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-12-2023 a las 08:49:06
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `workflow2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `flujo`
--

CREATE TABLE `flujo` (
  `flujo` varchar(10) NOT NULL,
  `proceso` varchar(10) NOT NULL,
  `proceso_siguiente` varchar(10) NOT NULL,
  `tipo` varchar(2) NOT NULL,
  `rol` varchar(20) NOT NULL,
  `pantalla` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `flujo`
--

INSERT INTO `flujo` (`flujo`, `proceso`, `proceso_siguiente`, `tipo`, `rol`, `pantalla`) VALUES
('F1', 'P1', 'P2', 'D', 'estudiante', 'prepararD'),
('F1', 'P2', 'P6', 'D', 'estudiante', 'enviarD'),
('F1', 'P3', 'P4', 'R', 'comision', 'recepcionD'),
('F1', 'P4', 'P5', 'E', 'comision', 'evaluarD'),
('F1', 'P5', 'P7', 'V', 'comision', 'nomina'),
('F1', 'P6', '', 'V', 'comision', 'verificacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento`
--

CREATE TABLE `seguimiento` (
  `secuencia` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `fecha_de_inicio` datetime NOT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `flujo` varchar(20) NOT NULL,
  `proceso` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  ADD PRIMARY KEY (`secuencia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  MODIFY `secuencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
