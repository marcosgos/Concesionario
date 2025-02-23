-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 23-02-2025 a las 23:14:11
-- Versión del servidor: 8.0.17
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `concesionario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquileres`
--

CREATE TABLE `alquileres` (
  `id_alquiler` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED DEFAULT NULL,
  `id_coche` int(10) UNSIGNED DEFAULT NULL,
  `prestado` datetime DEFAULT NULL,
  `devuelto` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alquileres`
--

INSERT INTO `alquileres` (`id_alquiler`, `id_usuario`, `id_coche`, `prestado`, `devuelto`) VALUES
(4, 1, 19, '2025-02-23 00:00:00', '2025-02-27 00:00:00'),
(5, 1, 20, '2025-02-23 00:00:00', '2025-02-27 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coches`
--

CREATE TABLE `coches` (
  `id_coche` int(10) UNSIGNED NOT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `alquilado` tinyint(1) DEFAULT NULL,
  `foto` varchar(300) DEFAULT NULL,
  `vendedor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `coches`
--

INSERT INTO `coches` (`id_coche`, `modelo`, `marca`, `color`, `precio`, `alquilado`, `foto`, `vendedor`) VALUES
(14, 'Clase A', 'Mercedes-Benz', 'Azul', 40000, 0, 'img/mercedes-benz-a-250-e-2024.jpg', 'Juan'),
(15, 'Panamera', 'Porsche', 'Negro', 140000, 0, 'img/porsche-panamera-2021-04-1606328051.avif', 'Juan'),
(16, '3005', 'Peugeot', 'Azul', 80000, 0, 'img/full-original.jpg', 'Juan'),
(17, 'M2', 'BMW', 'Azul', 90000, 0, 'img/w.jpg', 'Juan'),
(18, 'Astra', 'Opel', 'Rojo', 40000, 0, 'img/35245.jpg', 'Juan'),
(19, 'C4', 'Citroen', 'Naranja', 30000, 1, 'img/citroen-c4-2020-back.jpg', 'Juan'),
(20, 'Sandero', 'Dacia', 'Verde', 20000, 1, 'img/dac.webp', 'Marcos'),
(21, ' Golf', 'Volkswagen', 'Rojo', 30000, 0, 'img/Vol.webp', 'Marcos'),
(25, 'Focus', 'Ford', 'Verde', 30000, 0, 'img/ford.jpg', 'Juan');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `saldo` float DEFAULT NULL,
  `tipo_usuario` enum('admin','cliente','vendedor') NOT NULL DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `password`, `nombre`, `apellidos`, `email`, `saldo`, `tipo_usuario`) VALUES
(1, '$2y$10$jOHftg2mleNRigfBX25jieqrQcqkUlMHcyg61BEiLE6em3fBWkMwO', 'Alvaro', 'toledo', 'alvaro@gmail.com', 470000, 'cliente'),
(2, '$2y$10$C8eSs0zB7Y2kIBlXlyRjKeT.qd62RDiCIxdbqKYCJPYWjA9xFtE8e', 'Marcos', 'gonzalez', 'marcos@gmail.com', 20100, 'admin'),
(3, '$2y$10$yhSvOkyjyPwWGzsbg78LA.qQc23ZaSN8QKoi7.kqgVOXpAOSNJya.', 'Juan', 'illojuan', 'juan@gmail.com', 200100, 'vendedor');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD PRIMARY KEY (`id_alquiler`);

--
-- Indices de la tabla `coches`
--
ALTER TABLE `coches`
  ADD PRIMARY KEY (`id_coche`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  MODIFY `id_alquiler` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `coches`
--
ALTER TABLE `coches`
  MODIFY `id_coche` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
