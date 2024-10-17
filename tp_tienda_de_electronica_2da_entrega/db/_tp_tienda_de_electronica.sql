-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-10-2024 a las 23:12:38
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
-- Base de datos: `_tp_tienda_de_electronica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consolas`
--

CREATE TABLE `consolas` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `generacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `consolas`
--

INSERT INTO `consolas` (`ID`, `nombre`, `marca`, `color`, `generacion`) VALUES
(1, 'PS2', 'Sony', 'negro', 'sexta generacion'),
(2, 'PS3', 'Sony', 'negro', 'septima generacion'),
(3, 'Xbox 360', 'Microsoft', 'negro', 'septima generacion'),
(4, 'Dreamcast', 'SEGA', 'blanco', 'Sexta generacion'),
(5, 'Mega Drive', 'SEGA', 'negro', 'Cuarta generacion'),
(6, 'Super Nintendo', 'Nintendo', 'blanco', 'Cuarta generacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `ID` int(11) NOT NULL,
  `ID_consola` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `fecha_lanzamiento` date NOT NULL,
  `jugadores` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`ID`, `ID_consola`, `nombre`, `fecha_lanzamiento`, `jugadores`) VALUES
(1, 1, 'God Of War', '2005-03-22', 1),
(2, 1, 'Street Fighter EX3', '2000-03-10', 2),
(3, 1, 'Tekken Tag Tournament', '2000-03-09', 2),
(4, 6, 'Star Fox', '1993-09-01', 1),
(5, 5, 'Tiny Toon Adventures', '1993-09-15', 2),
(6, 2, 'Gran Turismo 5', '2010-11-24', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consolas`
--
ALTER TABLE `consolas`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_consola` (`ID_consola`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `consolas`
--
ALTER TABLE `consolas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD CONSTRAINT `juegos_ibfk_1` FOREIGN KEY (`ID_consola`) REFERENCES `consolas` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
