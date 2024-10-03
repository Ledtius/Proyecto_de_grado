-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 16-05-2024 a las 05:14:55
-- Versión del servidor: 10.11.7-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u950175237_login_register`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `documento` varchar(20) DEFAULT NULL,
  `direccion` varchar(40) DEFAULT NULL,
  `fecha_creado` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `active` tinyint(1) DEFAULT 1,
  `imagen_perfil` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idusuario`, `nombre`, `telefono`, `correo`, `documento`, `direccion`, `fecha_creado`, `fecha_actualizado`, `active`, `imagen_perfil`) VALUES
(191, 'mary luz martinez', '3122998454', '', '1098691969', 'puerto parra santander', '2024-05-12 01:49:33', '2024-05-12 01:49:33', 1, 0x69636f6e6f2d64656c2d686f6d6272652d6d656469636f2d7665746572696e6172696f2d68793362786d2e6a7067);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
