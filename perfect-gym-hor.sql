-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 04-03-2021 a las 18:35:02
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `perfect-gym-hor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
CREATE TABLE IF NOT EXISTS `asistencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_membresia` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `hora_ingreso` time NOT NULL,
  `sesiones_restante` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_membresia` (`id_membresia`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id`, `id_membresia`, `fecha_ingreso`, `hora_ingreso`, `sesiones_restante`) VALUES
(1, 11, '2021-02-17', '00:09:03', 14),
(2, 15, '2021-02-17', '05:11:42', 14),
(3, 11, '2021-02-21', '01:54:40', 13),
(4, 24, '2021-02-21', '04:43:04', 14),
(5, 25, '2021-02-21', '04:48:40', 14),
(6, 25, '2021-02-21', '04:55:41', 13),
(7, 25, '2021-02-21', '15:00:03', 12),
(8, 25, '2021-02-21', '15:00:43', 11),
(9, 25, '2021-02-21', '15:07:03', 10),
(10, 25, '2021-02-21', '15:07:09', 9),
(11, 25, '2021-02-21', '15:07:10', 8),
(12, 25, '2021-02-21', '15:07:11', 7),
(13, 25, '2021-02-21', '15:07:12', 6),
(14, 25, '2021-02-21', '15:07:13', 5),
(15, 25, '2021-02-21', '15:07:15', 4),
(16, 25, '2021-02-21', '15:07:16', 3),
(17, 25, '2021-02-21', '15:07:22', 2),
(18, 25, '2021-02-21', '15:07:23', 1),
(19, 25, '2021-02-21', '15:07:27', 0),
(20, 24, '2021-02-21', '15:29:30', 13),
(21, 24, '2021-02-21', '15:30:03', 12),
(22, 24, '2021-02-21', '15:30:30', 11),
(23, 11, '2021-02-21', '15:30:31', 12),
(24, 24, '2021-02-21', '15:30:41', 10),
(25, 24, '2021-02-21', '15:30:56', 9),
(26, 24, '2021-02-21', '15:31:04', 8),
(27, 24, '2021-02-21', '15:31:13', 7),
(28, 26, '2021-02-21', '22:13:05', 14),
(29, 30, '2021-02-22', '13:49:42', 14),
(30, 31, '2021-02-22', '13:51:01', 14),
(31, 31, '2021-03-04', '13:16:17', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

DROP TABLE IF EXISTS `clase`;
CREATE TABLE IF NOT EXISTS `clase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clase` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `id_instructor` int(15) NOT NULL,
  `precio` int(15) NOT NULL,
  `id_sala` int(11) NOT NULL,
  `sesiones` int(15) NOT NULL,
  `descripcion` varchar(350) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_instructor` (`id_instructor`),
  KEY `id_sala` (`id_sala`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`id`, `clase`, `id_instructor`, `precio`, `id_sala`, `sesiones`, `descripcion`) VALUES
(1, 'Aparatos', 1, 150, 1, 15, 'Disciplina con el objetivo de desarrollar masa muscular\n'),
(2, 'Aerobicos', 1, 200, 1, 15, 'Puro ejercicio cardio vascular ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `carnet_identidad` int(25) NOT NULL,
  `sexo` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` int(50) NOT NULL,
  `correo` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `foto` text COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `apellido`, `carnet_identidad`, `sexo`, `telefono`, `correo`, `fecha_nacimiento`, `foto`) VALUES
(12, 'pietro', 'Torrico Escobar', 234234234, 'Masculino', 69531998, 'torricopietro@gmail.com', '2021-02-10', ''),
(13, 'Manuel', 'Gonzales', 979489, 'Masculino', 69531998, 'torricopietro@gmail.com', '2021-02-03', ''),
(14, 'Juan', 'Merodio', 789451, 'Masculino', 79841446, 'jolie41x_w323a@vcbox.pro', '1999-09-09', ''),
(15, 'Mirtha', 'Escobar', 24234234, 'Masculino', 79779798, 'jolie41x_w323a@vcbox.pro', '2021-02-16', ''),
(16, 'Bernardo', 'Flores', 8949124, 'Masculino', 7945474, 'jolie41x_w323a@vcbox.pro', '1999-10-10', ''),
(17, 'Goyo', 'Gomez', 49849849, 'Masculino', 79779796, 'torricopietro1@gmail.com', '2021-02-17', ''),
(18, 'Carlos', 'Gamboa', 7984561, 'Masculino', 69531997, 'torricopietr1o@gmail.com', '1999-09-03', ''),
(19, 'Mirtha', 'Escobar', 324234234, 'Masculino', 79779798, 'sdafsadf@gmail.com', '2021-02-20', ''),
(20, 'Mirtha', 'Escobar', 21332432, 'Masculino', 79779796, 'arc.es654@gmal.com', '2021-02-20', ''),
(21, 'Mirtha', 'Escobar', 324324234, 'Masculino', 79779796, 'arc.es654@gmal.com', '2021-02-20', ''),
(22, 'Gabo', 'Vollanoski', 9511521, 'Masculino', 69531998, 'arc.es654@gmal.com', '2021-02-20', ''),
(23, 'Rodrigo', 'Rodriguz', 581152, 'Masculino', 69531998, 'arc.es654@gmal.com', '2021-02-20', ''),
(24, 'Alejandro', 'Carballo', 539800, 'Masculino', 69531998, 'arc.es654@gmal.com', '2021-02-20', 'imagenes/539800.png'),
(25, 'Hans', 'Gonzales', 5216444, 'Masculino', 765491, 'arc.es654@gmal.com', '1985-05-03', 'imagenes/5216444.jpg'),
(26, 'Sebastian', 'Bartolome', 647894567, 'Masculino', 7654223, 'arc.es654@gmal.com', '1975-10-10', 'imagenes/647894567.jpg'),
(27, 'Alex', 'Villaroel', 8978461, 'Masculino', 794941, 'arc.es654@gmal.com', '1995-05-02', 'imagenes/8978461.jpg'),
(28, 'Juan', 'Perez', 324234, 'Masculino', 9822014, 'arcqasdjfkl@gmail.com', '2021-02-18', 'imagenes/324234.jpg'),
(29, 'Robert', 'Delin', 901827, 'Masculino', 72738, '89dasjfkasdjl@gmail.com', '1987-07-09', 'imagenes/901827.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

DROP TABLE IF EXISTS `horario`;
CREATE TABLE IF NOT EXISTS `horario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `id_clase` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_clase` (`id_clase`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id`, `hora_inicio`, `hora_fin`, `id_clase`) VALUES
(1, '08:30:00', '09:30:00', 1),
(2, '09:30:00', '07:34:00', 1),
(3, '09:30:00', '09:30:00', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructor`
--

DROP TABLE IF EXISTS `instructor`;
CREATE TABLE IF NOT EXISTS `instructor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `carnet_identidad` int(25) NOT NULL,
  `telefono` int(25) NOT NULL,
  `profesion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `sexo` varchar(35) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `instructor`
--

INSERT INTO `instructor` (`id`, `nombre`, `apellido`, `carnet_identidad`, `telefono`, `profesion`, `sexo`) VALUES
(1, 'Victor', 'Malatesta', 9564778, 79845476, 'Nutriologo', 'Masculino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresia`
--

DROP TABLE IF EXISTS `membresia`;
CREATE TABLE IF NOT EXISTS `membresia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(15) NOT NULL,
  `fecha_membresia` date NOT NULL,
  `fecha_end_membresia` date NOT NULL,
  `id_clase` int(15) NOT NULL,
  `num_clases` int(15) NOT NULL,
  `num_clases_inicial` int(15) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_clase` (`id_clase`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `membresia`
--

INSERT INTO `membresia` (`id`, `id_cliente`, `fecha_membresia`, `fecha_end_membresia`, `id_clase`, `num_clases`, `num_clases_inicial`, `estado`) VALUES
(1, 2, '2021-02-16', '2021-03-16', 1, 15, 15, 1),
(2, 9, '2021-02-16', '2021-03-16', 1, 15, 15, 1),
(3, 9, '2021-02-16', '2021-03-16', 1, 15, 15, 1),
(4, 9, '2021-02-16', '2021-03-16', 1, 15, 15, 1),
(5, 9, '2021-02-16', '2021-03-16', 1, 15, 15, 1),
(6, 9, '2021-02-16', '2021-03-16', 1, 15, 15, 1),
(7, 9, '2021-02-16', '2021-03-16', 1, 15, 15, 1),
(8, 9, '2021-02-16', '2021-03-16', 1, 15, 15, 1),
(9, 10, '2021-02-16', '2021-03-16', 1, 15, 15, 1),
(10, 11, '2021-02-16', '2021-03-16', 1, 15, 15, 1),
(11, 12, '2021-02-16', '2021-03-16', 1, 12, 15, 1),
(12, 13, '2021-02-16', '2021-03-16', 1, 15, 15, 1),
(13, 14, '2021-02-16', '2021-03-16', 1, 15, 15, 1),
(14, 15, '2021-02-16', '2021-03-16', 2, 15, 15, 1),
(15, 16, '2021-02-17', '2021-03-17', 1, 14, 15, 1),
(16, 17, '2021-02-18', '2021-03-18', 1, 15, 15, 1),
(17, 18, '2021-02-21', '2021-03-21', 1, 15, 15, 1),
(18, 20, '2021-02-21', '2021-03-21', 1, 15, 15, 1),
(19, 21, '2021-02-21', '2021-03-21', 1, 15, 15, 1),
(20, 21, '2021-02-21', '2021-03-21', 1, 15, 15, 1),
(21, 21, '2021-02-21', '2021-03-21', 1, 15, 15, 1),
(22, 22, '2021-02-21', '2021-03-21', 2, 15, 15, 1),
(23, 23, '2021-02-21', '2021-03-21', 1, 15, 15, 1),
(24, 24, '2021-02-21', '2021-03-21', 1, 7, 15, 1),
(25, 25, '2021-02-21', '2021-03-21', 2, 0, 15, 0),
(26, 26, '2021-02-21', '2021-03-21', 1, 14, 15, 1),
(27, 27, '2021-02-22', '2021-03-22', 2, 15, 15, 1),
(28, 27, '2021-02-22', '2021-03-22', 1, 15, 15, 1),
(29, 27, '2021-02-22', '2021-03-22', 2, 15, 15, 1),
(30, 28, '2021-02-22', '2021-03-22', 1, 14, 15, 1),
(31, 29, '2021-02-22', '2021-03-22', 1, 13, 15, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresia_pago`
--

DROP TABLE IF EXISTS `membresia_pago`;
CREATE TABLE IF NOT EXISTS `membresia_pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_pago` date NOT NULL,
  `id_membresia` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_membresia` (`id_membresia`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `membresia_pago`
--

INSERT INTO `membresia_pago` (`id`, `fecha_pago`, `id_membresia`, `id_usuario`) VALUES
(1, '2021-02-16', 1, 1),
(2, '2021-02-16', 1, 1),
(3, '2021-02-16', 2, 1),
(4, '2021-02-16', 3, 1),
(5, '2021-02-16', 4, 1),
(6, '2021-02-16', 5, 1),
(7, '2021-02-16', 6, 1),
(8, '2021-02-16', 7, 1),
(9, '2021-02-16', 7, 1),
(10, '2021-02-16', 8, 1),
(11, '2021-02-16', 9, 1),
(12, '2021-02-16', 10, 1),
(13, '2021-02-16', 10, 1),
(14, '2021-02-16', 10, 1),
(15, '2021-02-16', 10, 1),
(16, '2021-02-16', 11, 1),
(17, '2021-02-16', 12, 1),
(18, '2021-02-16', 13, 1),
(19, '2021-02-16', 14, 1),
(20, '2021-02-17', 15, 1),
(21, '2021-02-18', 16, 1),
(22, '2021-02-21', 17, 1),
(23, '2021-02-21', 18, 1),
(24, '2021-02-21', 19, 1),
(25, '2021-02-21', 20, 1),
(26, '2021-02-21', 21, 1),
(27, '2021-02-21', 22, 1),
(28, '2021-02-21', 23, 1),
(29, '2021-02-21', 24, 1),
(30, '2021-02-21', 25, 1),
(31, '2021-02-21', 26, 1),
(32, '2021-02-22', 27, 1),
(33, '2021-02-22', 28, 1),
(34, '2021-02-22', 29, 1),
(35, '2021-02-22', 30, 1),
(36, '2021-02-22', 31, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sala`
--

DROP TABLE IF EXISTS `sala`;
CREATE TABLE IF NOT EXISTS `sala` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sala` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `sala`
--

INSERT INTO `sala` (`id`, `sala`) VALUES
(1, 'Aparatos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `carnet_identidad` int(25) NOT NULL,
  `telefono` int(40) NOT NULL,
  `usuario` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `id_rol` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_rol` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `carnet_identidad`, `telefono`, `usuario`, `password`, `id_rol`) VALUES
(1, 'Pietro', 'Torrico Escobar', 9511528, 69531998, 'master', 'master123', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clase`
--
ALTER TABLE `clase`
  ADD CONSTRAINT `clase_ibfk_1` FOREIGN KEY (`id_instructor`) REFERENCES `instructor` (`id`),
  ADD CONSTRAINT `clase_ibfk_2` FOREIGN KEY (`id_sala`) REFERENCES `sala` (`id`);

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`id_clase`) REFERENCES `clase` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
