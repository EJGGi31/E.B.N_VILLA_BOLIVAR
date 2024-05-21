-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2024 a las 23:39:00
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ebn_villabolivar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `ci_escolar` varchar(15) NOT NULL,
  `nombres` varchar(150) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `fecha_nac` date NOT NULL,
  `lugar_nac` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_cortes`
--

CREATE TABLE `alumno_cortes` (
  `ci_escolar2` varchar(15) NOT NULL,
  `cod_corte2` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cortes`
--

CREATE TABLE `cortes` (
  `cod_corte` int(15) NOT NULL,
  `lapso` int(3) NOT NULL,
  `literal` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel`
--

CREATE TABLE `nivel` (
  `cod_nivel` int(15) NOT NULL,
  `grado` varchar(15) NOT NULL,
  `seccion` varchar(1) NOT NULL,
  `matricula` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_alumnos`
--

CREATE TABLE `nivel_alumnos` (
  `cod_nivel2` int(15) NOT NULL,
  `ci_escolar1` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_corte`
--

CREATE TABLE `nivel_corte` (
  `cod_nivel1` int(15) NOT NULL,
  `cod_corte1` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ci` varchar(12) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apelido` varchar(150) NOT NULL,
  `tipo_usuario` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`ci_escolar`);

--
-- Indices de la tabla `alumno_cortes`
--
ALTER TABLE `alumno_cortes`
  ADD KEY `ci_escolar2` (`ci_escolar2`),
  ADD KEY `cod_corte2` (`cod_corte2`);

--
-- Indices de la tabla `cortes`
--
ALTER TABLE `cortes`
  ADD PRIMARY KEY (`cod_corte`);

--
-- Indices de la tabla `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`cod_nivel`);

--
-- Indices de la tabla `nivel_alumnos`
--
ALTER TABLE `nivel_alumnos`
  ADD KEY `ci_escolar1` (`ci_escolar1`),
  ADD KEY `cod_nivel2` (`cod_nivel2`);

--
-- Indices de la tabla `nivel_corte`
--
ALTER TABLE `nivel_corte`
  ADD KEY `cod_corte1` (`cod_corte1`),
  ADD KEY `nivel_corte_ibfk_2` (`cod_nivel1`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ci`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno_cortes`
--
ALTER TABLE `alumno_cortes`
  ADD CONSTRAINT `alumno_cortes_ibfk_1` FOREIGN KEY (`ci_escolar2`) REFERENCES `alumno` (`ci_escolar`) ON UPDATE CASCADE,
  ADD CONSTRAINT `alumno_cortes_ibfk_2` FOREIGN KEY (`cod_corte2`) REFERENCES `cortes` (`cod_corte`);

--
-- Filtros para la tabla `nivel_alumnos`
--
ALTER TABLE `nivel_alumnos`
  ADD CONSTRAINT `nivel_alumnos_ibfk_1` FOREIGN KEY (`ci_escolar1`) REFERENCES `alumno` (`ci_escolar`) ON UPDATE CASCADE,
  ADD CONSTRAINT `nivel_alumnos_ibfk_2` FOREIGN KEY (`cod_nivel2`) REFERENCES `nivel` (`cod_nivel`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `nivel_corte`
--
ALTER TABLE `nivel_corte`
  ADD CONSTRAINT `nivel_corte_ibfk_1` FOREIGN KEY (`cod_corte1`) REFERENCES `cortes` (`cod_corte`) ON UPDATE CASCADE,
  ADD CONSTRAINT `nivel_corte_ibfk_2` FOREIGN KEY (`cod_nivel1`) REFERENCES `nivel` (`cod_nivel`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
