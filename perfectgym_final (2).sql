-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 02-05-2022 a las 00:40:37
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
-- Base de datos: `perfectgym_final`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso_usuario`
--

DROP TABLE IF EXISTS `acceso_usuario`;
CREATE TABLE IF NOT EXISTS `acceso_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `cliente_reporte_acceso` int(11) NOT NULL,
  `disciplina_acceso` int(11) NOT NULL,
  `disciplina_nuevo_acceso` int(11) NOT NULL,
  `instructor_acceso` int(11) NOT NULL,
  `instructor_nuevo_acceso` int(11) NOT NULL,
  `lista_asistencia_acceso` int(11) NOT NULL,
  `asistencia_acceso` int(11) NOT NULL,
  `pago_acceso` int(11) NOT NULL,
  `pago_reporte_acceso` int(11) NOT NULL,
  `tienda_acceso` int(11) NOT NULL,
  `tienda_nueva_venta_acceso` int(11) NOT NULL,
  `tienda_reporte_acceso` int(11) NOT NULL,
  `tienda_producto_acceso` int(11) NOT NULL,
  `producto_acceso` int(11) NOT NULL,
  `producto_nuevo_acceso` int(11) NOT NULL,
  `producto_editar_acceso` int(11) NOT NULL,
  `producto_eliminar_acceso` int(11) NOT NULL,
  `usuario_nuevo_acceso` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `acceso_usuario`
--

INSERT INTO `acceso_usuario` (`id`, `id_usuario`, `cliente_reporte_acceso`, `disciplina_acceso`, `disciplina_nuevo_acceso`, `instructor_acceso`, `instructor_nuevo_acceso`, `lista_asistencia_acceso`, `asistencia_acceso`, `pago_acceso`, `pago_reporte_acceso`, `tienda_acceso`, `tienda_nueva_venta_acceso`, `tienda_reporte_acceso`, `tienda_producto_acceso`, `producto_acceso`, `producto_nuevo_acceso`, `producto_editar_acceso`, `producto_eliminar_acceso`, `usuario_nuevo_acceso`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 2, 1, 0, 0, 1, 1, 0, 0, 1, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1),
(3, 3, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 0, 1, 1, 0, 0, 0, 0);

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
  `sesiones_restantes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id`, `id_membresia`, `fecha_ingreso`, `hora_ingreso`, `sesiones_restantes`) VALUES
(1, 14, '2021-07-05', '02:44:38', 13),
(2, 10, '2021-07-05', '02:45:18', 4),
(3, 10, '2021-07-05', '02:46:38', 3),
(4, 10, '2021-07-05', '02:46:51', 2),
(5, 10, '2021-07-05', '02:46:57', 1),
(6, 10, '2021-07-05', '02:47:00', 0),
(7, 9, '2021-07-05', '03:43:57', 14),
(8, 9, '2021-07-05', '03:43:59', 13),
(9, 9, '2021-07-05', '03:44:00', 12),
(10, 9, '2021-07-05', '03:44:00', 11),
(11, 9, '2021-07-05', '03:44:01', 10),
(12, 9, '2021-07-05', '03:44:01', 9),
(13, 9, '2021-07-05', '03:44:02', 8),
(14, 9, '2021-07-05', '03:44:03', 7),
(15, 9, '2021-07-05', '03:44:04', 6),
(16, 9, '2021-07-05', '03:44:07', 5),
(17, 9, '2021-07-05', '03:44:09', 4),
(18, 9, '2021-07-05', '03:44:10', 3),
(19, 9, '2021-07-05', '03:44:17', 2),
(20, 9, '2021-07-05', '03:44:19', 1),
(21, 9, '2021-07-05', '03:44:20', 0),
(22, 14, '2021-07-05', '04:45:34', 12),
(23, 14, '2021-07-05', '04:45:41', 11),
(24, 14, '2021-07-05', '04:45:42', 10),
(25, 14, '2021-07-05', '04:45:43', 9),
(26, 14, '2021-07-05', '04:45:44', 8),
(27, 14, '2021-07-05', '04:45:45', 7),
(28, 14, '2021-07-05', '04:45:45', 6),
(29, 14, '2021-07-05', '04:45:46', 5),
(30, 14, '2021-07-05', '04:45:47', 4),
(31, 14, '2021-07-05', '04:45:47', 3),
(32, 14, '2021-07-05', '04:45:49', 2),
(33, 14, '2021-07-05', '04:45:53', 1),
(34, 14, '2021-07-05', '04:45:55', 0),
(35, 8, '2021-07-05', '04:46:20', 14),
(36, 8, '2021-07-05', '04:46:22', 13),
(37, 8, '2021-07-05', '04:46:24', 12),
(38, 8, '2021-07-05', '04:47:46', 0),
(39, 17, '2021-07-05', '04:49:59', 0),
(40, 11, '2021-07-05', '04:53:05', 14),
(41, 11, '2021-07-05', '04:53:07', 13),
(42, 11, '2021-07-05', '04:53:32', 0),
(43, 21, '2021-07-05', '04:59:07', 4),
(44, 21, '2021-07-05', '04:59:08', 3),
(45, 21, '2021-07-05', '04:59:13', 2),
(46, 21, '2021-07-05', '04:59:14', 1),
(47, 21, '2021-07-05', '04:59:16', 0),
(48, 22, '2021-07-05', '05:04:02', 9),
(49, 22, '2021-07-05', '05:04:04', 8),
(50, 22, '2021-07-05', '05:04:05', 7),
(51, 22, '2021-07-05', '05:04:05', 6),
(52, 22, '2021-07-05', '05:04:06', 5),
(53, 22, '2021-07-05', '05:04:07', 4),
(54, 22, '2021-07-05', '05:04:07', 3),
(55, 22, '2021-07-05', '05:04:09', 2),
(56, 22, '2021-07-05', '05:04:12', 1),
(57, 22, '2021-07-05', '05:04:13', 0),
(58, 23, '2021-07-05', '05:06:52', 9),
(59, 23, '2021-07-05', '05:06:54', 8),
(60, 23, '2021-07-05', '05:06:54', 7),
(61, 23, '2021-07-05', '05:06:55', 6),
(62, 23, '2021-07-05', '05:06:56', 5),
(63, 23, '2021-07-05', '05:06:56', 4),
(64, 23, '2021-07-05', '05:06:57', 3),
(65, 23, '2021-07-05', '05:07:01', 2),
(66, 23, '2021-07-05', '05:07:02', 1),
(67, 23, '2021-07-05', '05:07:03', 0),
(68, 13, '2021-07-05', '14:00:18', 14),
(69, 6, '2021-07-05', '18:43:31', 14),
(70, 41, '2022-04-30', '10:31:09', 14),
(71, 41, '2022-04-30', '10:32:13', 13),
(72, 42, '2022-04-30', '10:33:53', 14),
(73, 44, '2022-04-30', '11:07:36', 24),
(74, 44, '2022-04-30', '11:07:43', 23),
(75, 42, '2022-04-30', '11:07:52', 13),
(76, 45, '2022-04-30', '15:42:22', 9),
(77, 46, '2022-04-30', '15:45:09', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

DROP TABLE IF EXISTS `clase`;
CREATE TABLE IF NOT EXISTS `clase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clase` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`id`, `clase`, `descripcion`) VALUES
(1, 'Aerobicos', 'Es una disciplina donde realizaras ejercicios basados en la vascularización de las venas'),
(2, 'Aparatos', 'Realizaras ejercicios de basados en el levantamiento de pesas para poder desarrollar los musculos'),
(3, 'Yoga', 'Clase para poder realajar los musculos y la menta de todos los problemas'),
(4, 'TRX', 'Uso de ligas para el estiramento y levantamiento de pesas'),
(7, 'Zumba', 'Disciplina de intenso movimiento y ejercicio cardio vascular'),
(8, 'Boxeo', 'Disciplina de contacto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `carnet_identidad` int(25) NOT NULL,
  `sexo` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(50) NOT NULL,
  `correo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `apellido`, `carnet_identidad`, `sexo`, `telefono`, `correo`, `fecha_nacimiento`, `foto`) VALUES
(1, 'Victor', 'Malatesta', 9745612, 'Masculino', 7946513, 'torricopietro@gmail.com', '1997-05-10', 'imagenes/9745612.PNG'),
(2, 'Juan', 'Valdez', 795646123, 'Masculino', 498789, 'fassdf64@gmail.com', '1978-05-10', 'imagenes/795646123.PNG'),
(3, 'fasdfasdf', 'sdafsadsdaf', 891898, 'Masculino', 1984948, 'sadfdsaf@gmail.com', '1977-10-10', 'imagenes/891898.png'),
(4, 'Tini', 'Stoesel', 89498489, 'Femenino', 49498984, 'asdfadsf@gmail.com', '1997-11-10', 'imagenes/89498489.png'),
(5, 'asdfsdaf', 'asdfasdsd', 49849889, 'Masculino', 19819898, 'asfsadf@gmail.com', '1998-10-10', 'imagenes/49849889.png'),
(6, 'sdfsadfd', 'sadfsafsdf', 19889, 'Femenino', 1689189189, 'sadsdaf@dasdsag.com', '1998-10-10', 'imagenes/19889.png'),
(7, 'sdadsaf', 'asdfasdfasdf', 1998819, 'Masculino', 198989498, 'sadsdafdsag@gmail.com', '1997-10-01', 'imagenes/1998819.jpg'),
(8, 'asdfsadgg', 'dsafsdafdsag', 1918987, 'Masculino', 189984498, 'sadfsadfdasgsrew@gmail.com', '1987-10-10', 'imagenes/1918987.jpg'),
(9, 'asdfdasfasdf', 'asdfasdasf', 191989, 'Masculino', 498498894, 'sdafsdagsaewqr@gmail.com', '1997-10-10', 'imagenes/191989.png'),
(10, 'asdfasdfs', 'asdfsadsdfggg', 1231657489, 'Masculino', 19489984, 'sdafasdgasdg@gmail.com', '1995-11-10', 'imagenes/1231657489.jpg'),
(11, 'sadfasdfasdf', 'asdfasdf', 165561165, 'Masculino', 19198984, 'sadfasdggwer@gmail.com', '1978-10-10', 'imagenes/165561165.png'),
(12, 'ASFSADF', 'SDAFASDF', 2342141, 'Masculino', 19649898, 'ADSFASGV6546@GMAIL.Com', '1997-10-10', 'imagenes/2342141.PNG'),
(13, 'fsafdsaerqwerwqrq', 'sadfasdfggg', 1656554, 'Masculino', 194898489, 'sadfasdgsag@gmail.com', '1978-10-10', 'imagenes/1656554.jpg'),
(14, 'sadfasdg', 'sadfasdggqwer', 65156165, 'Masculino', 198189498, 'asdgasdga@gmail.com', '1997-10-10', 'imagenes/65156165.PNG'),
(15, 'asdfasdf', 'sdafasdg', 98798111, 'Masculino', 189498984, 'asdgasdg@com.com', '1197-10-10', 'imagenes/98798111.PNG'),
(16, 'asdgdsag', 'asdgasdgsa', 1988499, 'Masculino', 199498, 'sadgdasg@gmail.com', '1197-10-10', 'imagenes/1988499.PNG'),
(17, 'dagdasg', 'asdgasdg', 1919889, 'Masculino', 4891894, 'asdgas@gmail.com', '1159-10-10', 'imagenes/1919889.PNG'),
(18, 'dasgfasdgqwerqwer', 'sdagsadgqwer', 498489489, 'Masculino', 191984988, 'adsgqwerqwe@gmail.com', '1996-12-10', 'imagenes/498489489.PNG'),
(19, 'gwqerqwetwqet', 'sdagwqerqwetwqet', 19819898, 'Masculino', 198189894, 'asdgetrqwet@gmail.com', '1997-11-11', 'imagenes/19819898.png'),
(20, 'dsagwqeqwer', 'asdgbxzbzxcb', 324324, 'Masculino', 498489489, 'sadgqwerq@gmail.com', '1996-11-10', 'imagenes/324324.png'),
(21, 'qwerwegsadg', 'weqtrewqt', 106165, 'Masculino', 199889198, 'asgasdwqert@gmail.com', '1896-10-10', 'imagenes/106165.jpg'),
(22, 'gaaewqrqwet', 'sdghhqhw', 412341235, 'Masculino', 18998894, 'agewrqwe@gmail.com', '1997-02-25', 'imagenes/412341235.png'),
(23, 'gasdgasd', 'wqerwqesdag', 189489489, 'Masculino', 166546489, 'dsgadsgasd@gmail.com', '1999-03-10', 'imagenes/189489489.jpg'),
(24, 'dgasdgdsa', 'dgdsdsag', 1651, 'Masculino', 19489489, '4561654165sad@gmial.com', '1978-10-10', 'imagenes/1651.png'),
(25, 'Gualbert', 'Villaroel', 4889498, 'Masculino', 16549889, '98489489@gmail.com', '1997-10-10', 'imagenes/4889498.PNG'),
(26, 'Duki', 'Valverde', 74923165, 'Masculino', 79456126, 'torricopietro@gmail.com', '2001-07-10', 'imagenes/74923165.png'),
(27, 'Juan', 'Perez', 9879856, 'Masculino', 165165, 'torricopietro@gmail.com', '1996-05-10', 'imagenes/9879856.png'),
(28, 'Rawl', 'Humerez', 7994651, 'Masculino', 9848998, 'sdagasdg@gmail.com', '1956-03-10', 'imagenes/7994651.png'),
(29, 'Javier', 'Milei', 79848646, 'Masculino', 1561658, 'torricopietro@gmail.com', '1196-01-10', 'imagenes/79848646.jpg'),
(30, 'gabo', 'jpasdjfoiasd', 498489498, 'Masculino', 16519897, 'sadgsdaqwer@gmail.com', '1986-05-10', 'imagenes/498489498.PNG'),
(31, 'Nicky', 'Nicole', 4989159, 'Femenino', 6985174, 'torricopietro@gmail.com', '1982-02-10', 'imagenes/4989159.png'),
(32, 'Camilo', 'Benabidez', 8965465, 'Masculino', 89498126, 'minigadgets17@gmail.com', '1993-03-10', 'imagenes/8965465.PNG'),
(33, 'Nefex', 'Smith', 59894948, 'Masculino', 59198498, 'asdgasdg@gmail.com', '1993-05-10', 'imagenes/59894948.jpg'),
(34, 'bad', 'Bunny', 989156, 'Masculino', 95988915, 'minigadgets17@gmail.com', '1999-06-05', 'imagenes/989156.png'),
(35, 'Marama', 'Boquita', 899784, 'Masculino', 1898949498, 'tosadjfoisdaf@gmail.com', '1999-06-05', 'imagenes/899784.jpg'),
(36, 'Sebastian', 'Dybala', 98998489, 'Masculino', 897498489, 'torricopietro@gmail.com', '1990-07-05', 'imagenes/98998489.PNG'),
(37, 'Dante', 'Orlando', 7989465, 'Masculino', 988998489, 'sadgqwerqw@gmail.com', '1196-05-10', 'imagenes/7989465.png'),
(38, 'Sherko', 'Nuñez', 98498489, 'Masculino', 894986556, 'shearko@gmail.com', '1997-05-10', 'imagenes/98498489.jpg'),
(39, 'Alberto', 'Gonzalez', 4561321, 'Masculino', 67421357, 'torricopietro@gmail.com', '1978-05-10', 'imagenes/4561321.png'),
(40, 'Oso', 'Trava', 165165156, 'Masculino', 49815632, 'sadfsad@gmail.com', '1976-05-10', 'imagenes/165165156.png'),
(42, 'perro', 'sadfsadf', 1919849444, 'Masculino', 498489, 'minigadgets17@gmail.com', '1997-05-06', 'imagenes/1919849444.png'),
(43, 'Javier', 'Mata', 984698951, 'Masculino', 8991165, 'minigadgets17@gmail.com', '1996-05-10', 'imagenes/984698951.jpg'),
(44, 'vxzcvxz', 'zcxbb', 234123423, 'Masculino', 79779796, '3214213423@gmail.com', '1997-06-10', 'imagenes/234123423.jfif'),
(46, 'wtfsadfsdag', 'wqerqwer', 234212, 'Femenino', 79779798, 'asdsgasa@gmail.com', '2021-08-28', 'imagenes/234212.jfif'),
(47, 'Gualberto', 'Rodal', 9511599, 'Masculino', 69548876, 'torricopietro@gmail.com', '1994-05-10', 'imagenes/9511599.jfif'),
(48, 'Camila', 'Cabello', 754651, 'Femenino', 6894123, 'minigadgest17@gmail.com', '1997-03-10', 'imagenes/754651.png'),
(49, 'Alfred', 'Rojas', 5213487, 'Masculino', 69531978, 'torricopietro@gmail.com', '2022-04-21', 'imagenes/5213487.jpg'),
(50, 'Jaime', 'Escalante', 7894103, 'Masculino', 65487120, 'torricopietro@gmail.com', '1992-06-09', 'imagenes/7894103.jpg'),
(51, 'Juan', 'Gonzales', 9654123, 'Masculino', 765459712, 'torricopietro@gmail.com', '2022-03-28', 'imagenes/9654123.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_empresa`
--

DROP TABLE IF EXISTS `datos_empresa`;
CREATE TABLE IF NOT EXISTS `datos_empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(1500) COLLATE utf8_spanish_ci NOT NULL,
  `correo_electronico` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `password_correo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `sitio_web` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `ciudad` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `pais` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nit` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `datos_empresa`
--

INSERT INTO `datos_empresa` (`id`, `razon_social`, `direccion`, `correo_electronico`, `password_correo`, `sitio_web`, `ciudad`, `pais`, `nit`) VALUES
(1, 'Gimnasio Grande', 'Av. America esquina Salamanca edificio Gutierrez, N° 123', 'rokibalton99@gmail.com', 'pietrogato', 'www.fitco.com', 'Cochabamba', 'Bolivia', '2583753017');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

DROP TABLE IF EXISTS `detalle_venta`;
CREATE TABLE IF NOT EXISTS `detalle_venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` double(10,2) NOT NULL,
  `total` double(10,2) NOT NULL,
  `id_producto` int(15) NOT NULL,
  `id_venta` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id`, `cantidad`, `precio_unitario`, `total`, `id_producto`, `id_venta`) VALUES
(1, 1, 150.00, 150.00, 1, 1),
(2, 3, 150.00, 450.00, 1, 2),
(4, 1, 7.00, 7.00, 5, 3),
(5, 3, 150.00, 450.00, 1, 3),
(7, 3, 9.00, 27.00, 14, 4),
(8, 3, 35.00, 105.00, 7, 5),
(9, 1, 15.00, 15.00, 8, 5),
(10, 2, 10.00, 20.00, 6, 5),
(11, 1, 150.00, 150.00, 11, 6),
(12, 3, 125.00, 375.00, 12, 7),
(13, 5, 250.00, 1250.00, 13, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE IF NOT EXISTS `grupo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `denominacion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `precio` int(11) NOT NULL,
  `sesiones` int(11) NOT NULL,
  `tiempo_limite` int(15) NOT NULL,
  `id_clase` int(11) NOT NULL,
  `id_instructor` int(11) NOT NULL,
  `id_sala` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id`, `denominacion`, `hora_inicio`, `hora_fin`, `precio`, `sesiones`, `tiempo_limite`, `id_clase`, `id_instructor`, `id_sala`) VALUES
(1, 'Grupo A', '18:00:00', '19:00:00', 150, 250, 250, 1, 2, 1),
(2, 'Oro', '09:30:00', '12:00:00', 225, 15, 30, 1, 1, 1),
(3, 'Grupo B', '07:00:00', '08:30:00', 100, 5, 5, 1, 1, 1),
(4, 'Grupo Z', '15:30:00', '16:30:00', 150, 10, 30, 3, 1, 1),
(5, 'Grupo A', '10:00:00', '10:50:00', 200, 15, 30, 2, 1, 1),
(6, 'Grupo B', '14:00:00', '15:30:00', 1, 15, 15, 3, 1, 1),
(7, 'Membresia Oro', '07:00:00', '08:30:00', 99, 7, 30, 4, 1, 1),
(8, 'Grupo C', '00:00:00', '10:00:00', 15, 1, 1, 1, 2, 1),
(9, 'Grupo BB', '18:00:00', '20:00:00', 150, 10, 10, 1, 2, 1),
(10, 'Membresía Plata', '18:00:00', '19:20:00', 50, 5, 5, 4, 1, 1),
(12, 'Grupo Mañana', '07:30:00', '09:00:00', 150, 25, 30, 7, 2, 2),
(13, 'Grupo Tarde', '12:00:00', '13:00:00', 99, 10, 14, 7, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructor`
--

DROP TABLE IF EXISTS `instructor`;
CREATE TABLE IF NOT EXISTS `instructor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `carnet_identidad` int(25) NOT NULL,
  `telefono` int(25) NOT NULL,
  `profesion` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `sexo` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `instructor`
--

INSERT INTO `instructor` (`id`, `nombre`, `apellido`, `carnet_identidad`, `telefono`, `profesion`, `sexo`) VALUES
(1, 'Ricardo', 'Moreno', 794611, 69531778, 'Nutriologo', 'Masculino'),
(2, 'Mario', 'Beneddeti', 6548233, 79746531, 'Bioquiimco', 'Masculino'),
(3, 'Camilo', 'Perez', 75641238, 69514357, 'Entrenador Personal', 'Masculino');

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
  `id_grupo` int(15) NOT NULL,
  `num_clases` int(15) NOT NULL,
  `num_clases_inicial` int(15) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `membresia`
--

INSERT INTO `membresia` (`id`, `id_cliente`, `fecha_membresia`, `fecha_end_membresia`, `id_grupo`, `num_clases`, `num_clases_inicial`, `estado`) VALUES
(1, 1, '2021-07-01', '2021-08-01', 1, 15, 15, 0),
(2, 25, '2021-07-04', '2021-07-19', 6, 15, 15, 0),
(3, 26, '2021-07-28', '2021-08-27', 5, 15, 15, 0),
(4, 27, '2021-07-04', '2021-08-03', 5, 15, 15, 0),
(5, 28, '2021-07-04', '2021-08-03', 4, 10, 10, 0),
(6, 29, '2021-07-04', '2021-07-19', 6, 14, 15, 0),
(7, 30, '2021-07-04', '2021-08-03', 5, 15, 15, 0),
(8, 31, '2021-07-04', '2021-07-19', 6, 0, 15, 0),
(9, 32, '2021-07-30', '2021-08-29', 5, 0, 15, 0),
(10, 33, '2021-07-29', '2021-08-28', 3, 0, 5, 0),
(11, 34, '2021-07-04', '2021-08-03', 5, 0, 15, 0),
(12, 35, '2021-07-04', '2021-07-19', 6, 14, 15, 0),
(13, 35, '2021-07-04', '2021-08-03', 2, 14, 15, 0),
(14, 36, '2021-07-04', '2021-08-03', 5, 0, 15, 0),
(15, 33, '2021-07-22', '2021-08-21', 5, 15, 15, 0),
(16, 32, '2021-07-06', '2021-08-05', 4, 10, 10, 0),
(17, 31, '2021-07-07', '2021-08-06', 2, 0, 15, 0),
(18, 31, '2021-07-04', '2021-08-03', 3, 5, 5, 0),
(19, 34, '2021-07-04', '2021-07-19', 6, 15, 15, 0),
(20, 36, '2021-07-04', '2021-08-03', 2, 15, 15, 0),
(21, 37, '2021-07-30', '2021-08-29', 3, 0, 5, 0),
(22, 37, '2021-07-31', '2021-08-30', 4, 0, 10, 0),
(23, 37, '2021-08-04', '2021-09-03', 4, 0, 10, 0),
(24, 37, '2021-08-07', '2021-09-06', 5, 15, 15, 0),
(25, 38, '2021-07-22', '2021-08-21', 7, 7, 7, 0),
(26, 39, '2021-08-31', '2021-09-30', 4, 10, 10, 0),
(27, 40, '2021-08-03', '2021-09-02', 2, 15, 15, 0),
(28, 40, '2021-08-03', '2021-08-18', 6, 15, 15, 0),
(29, 41, '2021-08-03', '2021-09-02', 4, 10, 10, 0),
(30, 40, '2021-08-04', '2021-09-03', 5, 15, 15, 0),
(31, 42, '2021-08-04', '2021-09-03', 5, 15, 15, 0),
(32, 42, '2021-08-05', '2021-09-04', 5, 15, 15, 0),
(33, 29, '2021-08-05', '2021-09-04', 2, 15, 15, 0),
(34, 43, '2021-08-05', '2021-08-20', 6, 15, 15, 0),
(35, 44, '2021-08-05', '2021-09-04', 7, 7, 7, 0),
(36, 45, '2021-08-05', '2021-09-04', 5, 15, 15, 0),
(37, 44, '2021-08-27', '2021-09-26', 2, 15, 15, 0),
(38, 46, '2021-08-07', '2021-08-08', 8, 1, 1, 0),
(39, 47, '2021-08-07', '2021-08-12', 10, 6, 5, 0),
(40, 48, '2021-08-07', '2021-08-22', 6, 13, 15, 0),
(41, 48, '2022-04-28', '2022-05-28', 5, 13, 15, 1),
(42, 49, '2022-04-30', '2022-05-30', 5, 13, 15, 1),
(43, 38, '2022-04-30', '2022-05-05', 10, 5, 5, 1),
(44, 50, '2022-05-05', '2022-06-04', 12, 23, 25, 1),
(45, 51, '2022-05-07', '2022-06-06', 4, 9, 10, 1),
(46, 47, '2022-04-30', '2022-05-30', 7, 6, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresia_pago`
--

DROP TABLE IF EXISTS `membresia_pago`;
CREATE TABLE IF NOT EXISTS `membresia_pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_pago` date NOT NULL,
  `monto` int(15) NOT NULL,
  `id_membresia` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `membresia_pago`
--

INSERT INTO `membresia_pago` (`id`, `fecha_pago`, `monto`, `id_membresia`, `id_usuario`) VALUES
(1, '2021-07-04', 0, 2, 1),
(2, '2021-07-04', 0, 2, 1),
(3, '2021-07-05', 0, 2, 1),
(4, '2021-07-05', 0, 3, 1),
(5, '2021-07-05', 0, 3, 1),
(6, '2021-07-05', 30, 4, 1),
(7, '2021-07-05', 150, 5, 1),
(8, '2021-07-05', 1, 6, 1),
(9, '2021-07-05', 200, 7, 1),
(10, '2021-07-05', 1, 8, 1),
(11, '2021-07-05', 200, 9, 1),
(12, '2021-07-05', 100, 10, 1),
(13, '2021-07-05', 200, 11, 1),
(14, '2021-07-05', 1, 12, 1),
(15, '2021-07-05', 225, 13, 1),
(16, '2021-07-05', 200, 14, 1),
(17, '2021-07-05', 150, 14, 1),
(18, '2021-07-05', 200, 14, 1),
(19, '2021-07-05', 150, 14, 1),
(20, '2021-07-05', 150, 14, 1),
(21, '2021-07-05', 150, 14, 1),
(22, '2021-07-05', 1, 14, 1),
(23, '2021-07-05', 200, 15, 1),
(24, '2021-07-05', 150, 16, 1),
(25, '2021-07-05', 225, 17, 1),
(26, '2021-07-05', 100, 18, 1),
(27, '2021-07-05', 1, 19, 1),
(28, '2021-07-05', 225, 20, 1),
(29, '2021-07-05', 100, 21, 1),
(30, '2021-07-05', 150, 22, 1),
(31, '2021-07-05', 150, 23, 1),
(32, '2021-07-05', 200, 24, 1),
(33, '2021-07-06', 99, 25, 1),
(34, '2021-08-03', 150, 26, 1),
(35, '2021-08-03', 225, 27, 1),
(36, '2021-08-03', 1, 28, 1),
(37, '2021-08-03', 150, 29, 1),
(38, '2021-08-05', 200, 30, 1),
(39, '2021-08-05', 200, 31, 1),
(40, '2021-08-06', 200, 32, 1),
(41, '2021-08-06', 225, 33, 1),
(42, '2021-08-06', 1, 34, 1),
(43, '2021-08-06', 99, 35, 1),
(44, '2021-08-06', 200, 36, 1),
(45, '2021-08-07', 225, 37, 1),
(46, '2021-08-07', 15, 38, 1),
(47, '2021-08-07', 50, 39, 1),
(48, '2021-08-07', 1, 40, 1),
(49, '2022-04-28', 200, 41, 1),
(50, '2022-04-30', 200, 42, 1),
(51, '2022-04-30', 50, 43, 1),
(52, '2022-04-30', 150, 44, 1),
(53, '2022-04-30', 150, 45, 1),
(54, '2022-04-30', 99, 46, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `precio` double(10,2) NOT NULL,
  `stock` int(10) NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `producto`, `categoria`, `descripcion`, `precio`, `stock`, `foto`) VALUES
(1, 'Agua Vital 3 Litros', 'Refresco', 'Agua natural de la marca vital', 150.00, 13, 'imagenes-productos/Agua_Vital_3_LitrosRefresco.jpg'),
(2, 'Agua vital 2 litros', 'refresco', 'osajdfoijsdaoifsadpjiof', 15.00, 7, 'imagenes-productos/Agua_vital_3_litrorefresco.png'),
(4, 'Guantes', 'equipo', 'Guantes de diferentes colores', 10.00, 22, 'imagenes-productos/Guantesequipo.png'),
(5, 'Coca colas', 'refresco', 'sadfasdsdgdss gasd gsadg', 7.00, 23, 'imagenes-productos/Coca_colasrefresco.png'),
(6, 'Agua 3l Vital', 'Refresco', '', 10.00, 3, 'imagenes-productos/Agua_3l_VitalRefresco.jpg'),
(7, 'Guantes - M', 'Gimnasio', '', 35.00, 5, 'imagenes-productos/Guantes_-_MGimnasio.jpg'),
(8, 'Jugo de Frutas', 'Jugos', '', 15.00, 99, 'imagenes-productos/Jugo_de_FrutasJugos.jpg'),
(9, 'Proteina - Ultra Tech', 'Proteinas', '', 350.00, 5, 'imagenes-productos/Proteina_-_Ultra_TechProteinas.jpg'),
(10, 'Proteina - Wey', 'Proteinas', '', 450.00, 8, 'imagenes-productos/Proteina_-_WeyProteinas.jpg'),
(11, 'Equipo de Yoga', 'Yoga', '', 150.00, 11, 'imagenes-productos/Equipo_de_YogaYoga.jpg'),
(12, 'Creatina - Growth', 'Suplementos', '', 125.00, 1, 'imagenes-productos/Creatina_-_GrowthSuplementos.jpg'),
(13, 'L-Carnitine - BioTech', 'Suplementos', '', 250.00, 15, 'imagenes-productos/L-Carnitine_-_BioTechSuplementos.jpg'),
(14, 'Batido de Proteina', 'Proteinas', '', 9.00, 97, 'imagenes-productos/Batido_de_ProteinaProteinas.jpg'),
(15, 'Mini', 'Refresco', '', 2.00, 36, 'imagenes-productos/MiniRefresco.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `rol`) VALUES
(1, 'administrador'),
(2, 'vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sala`
--

DROP TABLE IF EXISTS `sala`;
CREATE TABLE IF NOT EXISTS `sala` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sala` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sala`
--

INSERT INTO `sala` (`id`, `sala`) VALUES
(1, 'Aparatos'),
(2, 'Zumba'),
(4, 'Piscina'),
(7, 'Boxeo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `carnet_identidad` int(25) NOT NULL,
  `telefono` int(40) NOT NULL,
  `usuario` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `id_rol` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `carnet_identidad`, `telefono`, `usuario`, `password`, `id_rol`, `estado`) VALUES
(1, 'Pietro', 'Torrico', 9511528, 69531998, 'master', 'master123', 1, 1),
(2, 'Juan', 'Rallo', 87465123, 989456465, 'ramon', '123', 2, 1),
(3, 'Juanito', 'GOmez', 78456156, 74856123, 'juanito', 'juanito123', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

DROP TABLE IF EXISTS `venta`;
CREATE TABLE IF NOT EXISTS `venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_venta` date NOT NULL,
  `total_venta` double(10,2) NOT NULL,
  `id_usuario` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id`, `fecha_venta`, `total_venta`, `id_usuario`) VALUES
(1, '2021-07-06', 150.00, 1),
(2, '2021-08-06', 450.00, 1),
(3, '2022-02-08', 457.00, 1),
(4, '2022-04-30', 27.00, 1),
(5, '2022-04-30', 140.00, 1),
(6, '2022-04-30', 150.00, 1),
(7, '2022-04-30', 375.00, 1),
(8, '2022-04-30', 1250.00, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
