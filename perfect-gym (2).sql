-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 08-01-2021 a las 11:46:14
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
-- Base de datos: `perfect-gym`
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id`, `id_membresia`, `fecha_ingreso`, `hora_ingreso`, `sesiones_restante`) VALUES
(1, 21, '2020-12-10', '06:00:00', 0),
(2, 20, '2020-12-10', '06:00:00', 0),
(3, 20, '2020-12-10', '06:00:00', 0),
(4, 20, '2020-12-10', '23:14:32', 1),
(5, 19, '2020-12-11', '00:08:48', 10),
(6, 19, '2020-12-11', '00:09:09', 9),
(7, 22, '2020-12-11', '00:14:57', 54),
(8, 22, '2020-12-20', '13:38:55', 53),
(9, 31, '2020-12-20', '22:32:24', 211),
(10, 34, '2020-12-21', '04:38:55', 18),
(11, 20, '2020-12-26', '23:20:14', 0),
(12, 41, '2021-01-05', '02:35:30', 9),
(13, 42, '2021-01-08', '01:04:58', 0);

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
  PRIMARY KEY (`id`),
  KEY `id_instructor` (`id_instructor`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`id`, `clase`, `id_instructor`, `precio`) VALUES
(1, 'Zumba', 4, 150),
(2, 'Karate', 2, 99),
(3, 'Aparatos', 1, 145);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `apellido`, `carnet_identidad`, `sexo`, `telefono`, `correo`) VALUES
(1, 'Janson', 'Med', 9511528, 'Masculino', 69531998, 'torricopietro@gmail.com'),
(3, 'Mirtha', 'Escobar', 231547, 'Masculino', 797797961, 'torricopietro@gmail.com'),
(7, 'Mirtha', 'Escobar', 494556, 'Femenino', 79779798, 'jolie41x_w323a@vcbox.pro'),
(8, 'Dani', 'Zabaleta', 45678941, 'Masculino', 3729173, 'dani.zb@gmail.com'),
(10, 'Instagram', 'Renzo', 2165487, 'Masculino', 894514, 'insta@gmail.com'),
(11, 'Mariano', 'Hermosa', 1247857, 'Masculino', 1647894, 'MAR@gmail.com'),
(12, 'Nando', 'zuares', 2029123, 'Femenino', 4578981, 'nando@gmail.com'),
(13, 'Andres', 'Jamex', 1548794, 'Masculino', 4897154, 'andy@gmail.com'),
(15, 'Bernarda', 'FLores', 5478946, 'Femenino', 7979548, 'ber.fl@gmail.com'),
(16, 'Gabrois', 'Kichner', 6456, 'Femenino', 654654, 'asdfasd@gmail.com'),
(17, 'javi', 'perich', 213454, 'Masculino', 979794, '4646@gmail.com'),
(18, 'TATI', 'GONZALES', 46546546, 'ASDFSDAF', 165489, '6465@GMAIL.COM'),
(19, 'JAJA', 'JII', 324324, 'MAS', 234324, '6465@GMAIL.COM'),
(20, 'Gabrois', 'Kichner', 342341, 'Masculino', 61612273, '6465@GMAIL.COM'),
(21, 'Gabrois', 'Kichner', 342341, 'Femenino', 61612273, 'asdfasd@gmail.com'),
(22, 'Gabrois', 'GONZALES', 324231, 'Femenino', 61612273, '4646@gmail.com'),
(23, 'TATI', 'GONZALES', 3242313, 'Masculino', 61612273, '4646@gmail.com'),
(24, 'asdfasdf', 'perich', 312321, 'Masculino', 61612273, '6465@GMAIL.COM'),
(25, 'javi', 'GONZALES', 3242341, 'Masculino', 2342341, '6465@GMAIL.COM'),
(26, 'Gabrois', 'GONZALES', 342341423, 'Femenino', 61612273, '6465@GMAIL.COM'),
(27, 'asdfasdf', 'Kichner', 3242341, 'Femenino', 61612273, '6465@GMAIL.COM'),
(28, 'JAJA', 'JII', 3242341, 'Masculino', 61612273, '6465@GMAIL.COM'),
(29, 'Gabrois', 'GONZALES', 3242341, 'Femenino', 61612273, '6465@GMAIL.COM'),
(30, 'Gabrois', 'Kichner', 324124132, 'Femenino', 61612273, '6465@GMAIL.COM'),
(31, 'Gabrois', 'GONZALES', 5345345, 'Masculino', 34231, '4646@gmail.com'),
(32, 'HUGOs', 'Kichner', 32423423, 'Femenino', 61612273, '6465@GMAIL.COM'),
(33, 'Pietro', 'Gonchi', 15165, '', 61612273, '4646@gmail.com'),
(34, 'Valentinas', 'Gonza', 4578796, 'Femenino', 79541645, 'Val.gon@gmail.com'),
(36, 'Brava', 'Netflix', 5441678, 'Masculino', 79779798, 'jolie41x_w323a@vcbox.pro'),
(37, 'Grand', 'Dota', 125487, 'Femenino', 69531998, 'torricopietro@gmail.com'),
(38, 'Grand', 'Escobar', 23432432, 'Femenino', 79779796, 'torricopietro@gmail.com'),
(39, 'Cali', 'Dande', 51627987, 'Otro', 69531998, 'torricopietro@gmail.com'),
(40, 'Belinda', 'Paola', 254897, 'Femenino', 69531998, 'torricopietro@gmail.com'),
(41, 'Lunay', 'Gon', 976487, 'Femenino', 69531998, 'torricopietro@gmail.com'),
(42, 'Cali', 'Dande', 9645123, 'Masculino', 7975468, 'dani.zb@gmail.com'),
(43, 'Bruno', 'Sanders', 9515654, 'Masculino', 546798798, 'bruno.ecom@gmail.com'),
(44, 'Mirtha', 'Escobar', 3423423, 'Masculino', 79779796, 'torricopietro@gmail.com'),
(45, 'Luc', 'Escobar', 564879, 'Femenino', 79779796, 'arc.es654@gmal.com'),
(46, 'Vanndert', 'Damn', 4498489, 'Femenino', 465561, 'dsafasdf@gmail.com'),
(47, 'Cuba', 'Slender', 655487, 'Masculino', 1397456, 'cuba.sle@gmail.com'),
(48, 'Humber', 'Zuares', 61235689, 'Masculino', 197987, '4654@gmail.com'),
(49, 'Diso', 'Nancia', 254897, 'Masculino', 4568789, '456465@gmail.com'),
(50, 'Mirtha', 'Escobar', 4234234, 'Masculino', 79779796, 'torricopietro@gmail.com'),
(51, 'Mirtha', 'Escobar', 1234211, 'Masculino', 79779796, 'torricopietro@gmail.com'),
(52, 'Mirtha', 'Escobar', 32432, 'Masculino', 79779796, 'torricopietro@gmail.com'),
(53, 'pietro', 'Torrico Escobar', 234324234, 'Masculino', 69531998, 'torricopietro@gmail.com'),
(54, 'Gigi', 'Bufon', 8989774, 'Masculino', 34234234, 'asdfasdsadf@gmail.com'),
(55, 'Paulo', 'Landro', 5587799, 'Masculino', 546687, 'asdfadsf@gmail.com'),
(56, 'Arnadl', 'Colon', 4477789, 'Masculino', 1546465, 'torricopietro@gmail.com'),
(57, 'Tanta', 'Ctangana', 558979, 'Masculino', 156465, '645646@gmail.com'),
(58, 'Gustavito', 'River', 56879798, 'Masculino', 156468, 'renetor3008@gmail.com'),
(59, 'Porta', 'kevin', 55789798, 'Masculino', 156465489, 'asdfsadf@gmail.com'),
(60, 'Gary', 'Vee', 5548798, 'Masculino', 7966547, 'gary.vee@gmail.com'),
(61, 'CURRY', 'JIMENEZ', 9559564, 'Masculino', 69531998, 'minigadgets17@gmail.com'),
(62, 'Andres', 'Benitez', 51222244, 'Masculino', 9879798, 'sdfasadf@gmaill.com'),
(63, 'SIN', 'TI', 89798798, 'Masculino', 15646, '4654@gmail.com'),
(64, 'JOSE', 'Torrico Escobar', 234233223, 'Masculino', 69531998, 'torricopietro@gmail.com'),
(65, 'mUJER', 'OPRESION', 32423423, 'Masculino', 69531998, 'torricopietro@gmail.com'),
(66, 'te que', 'jas', 55565, 'Masculino', 69531998, 'torricopietro@gmail.com'),
(67, 'Karen', 'Gonchi', 321112, 'Femenino', 69531998, 'torricopietro@gmail.com'),
(68, 'pietro', 'Torrico Escobar', 1222333, 'Masculino', 69531998, 'torricopietro@gmail.com'),
(69, 'Salos', 'Mundo', 5661523, 'Masculino', 795446, 'asdfasd@gmail.com'),
(70, 'Daniela', 'Arian', 55468977, 'Masculino', 7955879, 'dsfasdf@gmail.com'),
(71, 'ALBA', 'Gym', 3248101, 'Masculino', 289398, 'asdfasdsadf@gmail.com'),
(72, 'pietro', 'Torrico Escobar', 232131211, 'Masculino', 69531998, 'torricopietro@gmail.com'),
(73, 'Mirtha', 'Escobar', 1231231111, 'Masculino', 79779796, 'torricopietro@gmail.com'),
(74, 'Mirtha', 'Escobar', 123232221, 'Masculino', 79779798, 'jolie41x_w323a@vcbox.pro'),
(75, 'Mirtha', 'Escobar', 9787778, 'Masculino', 79779796, 'torricopietro@gmail.com'),
(76, 'Mirtha', 'Escobar', 312323233, 'Masculino', 79779796, 'torricopietro@gmail.com'),
(77, 'Pietro', 'GONZALES', 1231112213, 'Masculino', 61612273, '4646@gmail.com'),
(78, 'Ete', 'GONZALES', 67568658, 'Masculino', 12334234, 'torricopietro@gmail.com'),
(79, 'Pietro', 'Kichner', 123123213, 'Masculino', 61612273, '4646@gmail.com'),
(80, 'javi', 'GONZALES', 2132144, 'Masculino', 61612273, 'asdfasd@gmail.com'),
(81, 'javi', 'Kichner', 1211344324, 'Masculino', 61612273, 'torricopietro@gmail.com'),
(82, 'TATI', 'Torrico', 321432432, 'Masculino', 61612273, 'torricopietro@gmail.com'),
(83, 'Javier', 'Sanchez', 3103882, 'Masculino', 8901922, 'asdfasd@gmail.com'),
(84, 'Bernardo', 'Vildozo', 5468797, 'Masculino', 68564812, 'Bernar.Vild.13@gmail.com'),
(85, 'Yulay', 'Fernadez', 546879, 'Masculino', 79856842, 'yulay_fer_nan@hotmail.com'),
(86, 'Jhon', 'Ce', 55645689, 'Masculino', 7985156, 'torricopietro@gmail.com'),
(87, 'Valetina', 'Carballo', 9879798, 'Femenino', 549879898, 'Val.gon@gmail.com'),
(88, 'pietro', 'Torrico Escobar', 342342134, 'Masculino', 69531998, 'torricopietro@gmail.com'),
(89, 'Nicky', 'Nicole', 4456798, 'Femenino', 75468975, 'nicky.nicole@gmail.com'),
(90, 'Mirtha', 'Escobar', 12342341, 'Masculino', 79779796, 'torricopietro@gmail.com'),
(91, 'Alejandro', 'Torrenegro', 58797421, 'Masculino', 54658798, 'Ale.torre@gmail.com'),
(92, 'Maria', 'Becerra', 85674897, 'Femenino', 16567898, 'Mari.bec@gmail.com'),
(93, 'Enzo', 'Roja', 13421421, 'Masculino', 89798454, '5as4df65sasdaf@gmail.com');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `instructor`
--

INSERT INTO `instructor` (`id`, `nombre`, `apellido`, `carnet_identidad`, `telefono`, `profesion`, `sexo`) VALUES
(1, 'Jeff', 'Zeid', 9511528, 79546871, 'Nutricionista', 'Masculino'),
(2, 'Khea', 'Trueno', 4568749, 7977979, 'Fisiculturista', 'Masculino'),
(4, 'Cali', 'Dande', 951248, 457891, 'Cantante', 'Masculino');

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
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_clase` (`id_clase`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `membresia`
--

INSERT INTO `membresia` (`id`, `id_cliente`, `fecha_membresia`, `fecha_end_membresia`, `id_clase`, `num_clases`, `estado`) VALUES
(1, 1, '2020-11-05', '2020-12-05', 1, 20, 1),
(2, 1, '2020-11-06', '2020-11-06', 1, 21, 1),
(3, 1, '2020-11-06', '2020-11-26', 1, 21, 1),
(4, 1, '2020-11-06', '2020-11-28', 1, 32, 1),
(5, 32, '2020-11-06', '2020-12-04', 1, 32, 1),
(6, 33, '2020-11-06', '2020-11-06', 1, 15, 1),
(7, 34, '2020-11-08', '2020-11-08', 2, 1525489, 1),
(8, 42, '2020-11-08', '2020-12-12', 2, 25, 1),
(9, 44, '2020-11-08', '2020-12-08', 1, 19, 1),
(10, 45, '2020-11-13', '2020-12-13', 2, 50, 1),
(11, 46, '2020-11-13', '2020-12-13', 1, 54, 1),
(12, 47, '2020-11-18', '2020-12-18', 1, 15, 1),
(13, 48, '2020-11-18', '2020-12-18', 2, 25, 1),
(14, 48, '2020-11-18', '2020-12-18', 2, 25, 1),
(15, 53, '2020-11-19', '2020-12-19', 2, 201, 1),
(16, 54, '2020-12-08', '2021-01-08', 1, 55, 1),
(17, 55, '2020-12-08', '2021-01-08', 1, 55, 1),
(18, 56, '2020-12-08', '2021-01-08', 1, 55, 1),
(19, 57, '2020-12-08', '2021-01-08', 1, 9, 1),
(20, 58, '2020-12-08', '2021-01-08', 1, 0, 0),
(21, 59, '2020-12-09', '2021-01-09', 2, 0, 0),
(22, 60, '2020-12-11', '2021-01-11', 2, 53, 1),
(23, 61, '2020-12-11', '2021-01-11', 2, 25, 1),
(24, 62, '2020-12-11', '2021-01-11', 2, 23, 1),
(25, 63, '2020-12-11', '2021-01-11', 1, 11, 1),
(26, 64, '2020-12-11', '2021-01-11', 1, 11, 1),
(27, 65, '2020-12-11', '2021-01-11', 1, 11122, 1),
(28, 66, '2020-12-11', '2021-01-11', 1, 23, 1),
(29, 67, '2020-12-11', '2021-01-11', 1, 232, 1),
(30, 68, '2020-12-11', '2021-01-11', 1, 211, 1),
(31, 68, '2020-12-20', '2021-01-20', 1, 211, 1),
(32, 69, '2020-12-20', '2021-01-20', 1, 32, 1),
(33, 82, '2020-12-21', '2021-01-21', 3, 18, 1),
(34, 82, '2020-12-21', '2021-01-21', 2, 18, 1),
(35, 83, '2020-12-21', '2021-01-21', 2, 150, 1),
(36, 84, '2020-12-27', '2021-01-27', 2, 22, 1),
(37, 85, '2020-12-27', '2021-01-27', 3, 22, 1),
(38, 86, '2020-12-27', '2021-01-27', 2, 12, 1),
(39, 87, '2020-12-27', '2021-01-27', 3, 12, 1),
(40, 88, '2020-12-27', '2021-01-27', 2, 12, 1),
(41, 89, '2021-01-05', '2021-02-05', 1, 9, 1),
(42, 91, '2021-01-08', '2021-02-08', 2, 0, 0),
(43, 92, '2021-01-08', '2021-02-08', 2, 12, 1),
(44, 93, '2021-01-08', '2021-02-08', 3, 12, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresia_pago`
--

DROP TABLE IF EXISTS `membresia_pago`;
CREATE TABLE IF NOT EXISTS `membresia_pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_pago` date NOT NULL,
  `id_membresia` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_membresia` (`id_membresia`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `membresia_pago`
--

INSERT INTO `membresia_pago` (`id`, `fecha_pago`, `id_membresia`) VALUES
(1, '2020-12-21', 34),
(2, '2020-12-21', 35),
(3, '2020-12-27', 36),
(4, '2020-12-27', 37),
(5, '2020-12-27', 38),
(6, '2020-12-27', 39),
(7, '2020-12-27', 40),
(8, '2021-01-05', 41),
(9, '2021-01-08', 42),
(10, '2021-01-08', 43),
(11, '2021-01-08', 44);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `carnet_identidad`, `telefono`, `usuario`, `password`) VALUES
(1, 'Pietro', 'Torrico', 9511528, 69531998, 'master', 'master123');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`id_membresia`) REFERENCES `membresia` (`id`);

--
-- Filtros para la tabla `clase`
--
ALTER TABLE `clase`
  ADD CONSTRAINT `clase_ibfk_1` FOREIGN KEY (`id_instructor`) REFERENCES `instructor` (`id`);

--
-- Filtros para la tabla `membresia`
--
ALTER TABLE `membresia`
  ADD CONSTRAINT `membresia_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `membresia_ibfk_2` FOREIGN KEY (`id_clase`) REFERENCES `clase` (`id`);

--
-- Filtros para la tabla `membresia_pago`
--
ALTER TABLE `membresia_pago`
  ADD CONSTRAINT `membresia_pago_ibfk_1` FOREIGN KEY (`id_membresia`) REFERENCES `membresia` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
