-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2024 a las 00:05:35
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
-- Base de datos: `tp_tienda_de_electronica`
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
  `generacion` varchar(100) NOT NULL,
  `imagen` varchar(2048) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `consolas`
--

INSERT INTO `consolas` (`ID`, `nombre`, `marca`, `color`, `generacion`, `imagen`) VALUES
(1, 'PS2', 'Sony', 'negro', 'sexta generacion', ''),
(2, 'PS3', 'Sony', 'negro', 'septima generacion', ''),
(3, 'Xbox 360', 'Microsoft', 'negro', 'septima generacion', ''),
(4, 'Dreamcast', 'SEGA', 'blanco', 'Sexta generacion', ''),
(5, 'Mega Drive', 'SEGA', 'negro', 'Cuarta generacion', ''),
(6, 'Super Nintendo', 'Nintendo', 'blanco', 'Cuarta generacion', ''),
(7, 'Nintendo 64', 'Nintendo', 'negro', 'quinta generacion', ''),
(8, 'PS4', 'Sony', 'negro', 'octava generacion', ''),
(9, 'Nintendo Switch', 'Nintendo', 'negro', 'octava generacion', ''),
(10, 'GameCube', 'Nintendo', 'violeta y blanca', 'sexta generacion', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `ID` int(11) NOT NULL,
  `ID_consola` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `fecha_lanzamiento` date NOT NULL,
  `jugadores` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`ID`, `ID_consola`, `nombre`, `fecha_lanzamiento`, `jugadores`, `imagen`) VALUES
(1, 1, 'God Of War', '2005-03-22', 1, ''),
(2, 1, 'Street Fighter EX3', '2000-03-10', 2, ''),
(3, 1, 'Tekken Tag Tournament', '2000-03-09', 2, ''),
(4, 6, 'Star Fox', '1993-09-01', 1, ''),
(5, 5, 'Tiny Toon Adventures', '1993-09-15', 2, ''),
(6, 2, 'Gran Turismo 5', '2010-11-24', 2, ''),
(8, 3, 'fable 2', '2008-10-21', 1, ''),
(13, 3, 'fable 2', '2024-10-07', 1, ''),
(14, 8, 'God of war: Ragnarok', '2022-11-08', 1, ''),
(29, 10, 'Kirby Air Ride', '2003-07-11', 8, './img/juego/6713e634d6d23.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `password`) VALUES
(1, 'webadmin@gmail.com', '$2a$12$QsNHmaj92oXE5.yDT2JzKOla2A2zTEx1fgOpARMgYM9FEZbedQdJ6'),
(2, 'nombre@gmail.com', '$2a$12$1L7cE3fEv/v4/llDPW8PiuoOX96rrWtl3OVYQ8X8UiON8p8hNqvWy');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consolas`
--
ALTER TABLE `consolas`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `nombre` (`nombre`);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `consolas`
--
ALTER TABLE `consolas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
