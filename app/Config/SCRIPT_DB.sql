-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 14-07-2020 a las 22:09:02
-- Versión del servidor: 5.7.26
-- Versión de PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectoapp`
--
CREATE DATABASE IF NOT EXISTS `proyectoapp` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci;
USE `proyectoapp`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accessories`
--

DROP TABLE IF EXISTS `accessories`;
CREATE TABLE IF NOT EXISTS `accessories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cuenta_con` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `accessories`
--

INSERT INTO `accessories` (`id`, `user_id`, `cuenta_con`) VALUES
(1, 1, 1),
(2, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nit` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `gremio` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `administrador` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cedula` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `direccion` varchar(120) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `barrio` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `municipio` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `tel_usuario` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `banco` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `numero_cuenta` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `tipo_cuenta` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre_propietario_cuenta` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cedula_propietario_cuenta` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `ejecutivo` int(11) NOT NULL,
  `clase` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `como_paga` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `departamento` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cantidad_comercios` int(11) NOT NULL,
  `cuanto_paga` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `productos_servicios` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `adjuntar_cedula_delantera` varchar(200) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `adjuntar_cedula_trasra` varchar(200) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `adjuntar_camara_comercio` varchar(200) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `adjuntar_rut` varchar(200) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `adjuntar_administrador` varchar(200) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `adjuntar_almacen` varchar(200) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre_completo_r1` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `identificacion_r1` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `celular_r1` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `comercio_r1` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre_completo_r2` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `identificacion_r2` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `celular_r2` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `comercio_r2` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `user_id`, `nit`, `gremio`, `administrador`, `cedula`, `direccion`, `barrio`, `municipio`, `tel_usuario`, `banco`, `numero_cuenta`, `tipo_cuenta`, `nombre_propietario_cuenta`, `cedula_propietario_cuenta`, `ejecutivo`, `clase`, `como_paga`, `departamento`, `cantidad_comercios`, `cuanto_paga`, `productos_servicios`, `adjuntar_cedula_delantera`, `adjuntar_cedula_trasra`, `adjuntar_camara_comercio`, `adjuntar_rut`, `adjuntar_administrador`, `adjuntar_almacen`, `nombre_completo_r1`, `identificacion_r1`, `celular_r1`, `comercio_r1`, `nombre_completo_r2`, `identificacion_r2`, `celular_r2`, `comercio_r2`) VALUES
(1, 1, '22222', 'Accesorios', 'qqqq', '111', 'qqq', 'www', 'www', '111', 'qqq', '2222', 'Ahorros', 'ddd ddd', '3333', 6, 'Clase B', 'Contado (efectivo-transferencia)', 'www', 2, '2', 'ddddddd', 'adjuntar_cedula_delantera_5f056572e1332.jpeg', 'adjuntar_cedula_trasera_5f056572e1f9b.jpeg', 'adjuntar_camara_comercio_5f056572e24ee.jpeg', 'adjuntar_rut_5f056572e29a6.jpeg', 'adjuntar_administrador_5f056572e2e4f.jpeg', 'adjuntar_almacen_5f056572e32db.jpeg', 'www', '2222', '4444', 'eeee', '2222', '3333', '444', 'dddd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credits`
--

DROP TABLE IF EXISTS `credits`;
CREATE TABLE IF NOT EXISTS `credits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `valor_credito` int(11) NOT NULL,
  `numero_meses` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `valor_cuota` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `foto_perfil` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_persona` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_persona` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cedula_persona` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `foto_cedula_delantera` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `foto_cedula_trasera` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `telefono_persona` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `user_asesor` int(11) NOT NULL DEFAULT '0',
  `cupo_aprobado` int(11) NOT NULL DEFAULT '0',
  `state` int(11) NOT NULL DEFAULT '1',
  `created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `credits`
--

INSERT INTO `credits` (`id`, `user_id`, `valor_credito`, `numero_meses`, `valor_cuota`, `foto_perfil`, `nombre_persona`, `apellido_persona`, `cedula_persona`, `foto_cedula_delantera`, `foto_cedula_trasera`, `telefono_persona`, `user_asesor`, `cupo_aprobado`, `state`, `created`) VALUES
(1, 1, 450000, '8', '79538', 'perfil_5f0e28ab987fc.png', 'wwww', 'qqq', '222', 'foto_cedula_delantera_5f0e289c2ec98.png', 'foto_cedula_trasera_5f0e28a4e6ae1.png', '33333', 0, 0, 1, '2020-07-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `description` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `url` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `state` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `description`, `url`, `state`, `created`) VALUES
(1, 2, 'Han registrado un nuevo crédito', '/proyectoApp/Credits/index', 0, '2020-07-14 16:50:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stages`
--

DROP TABLE IF EXISTS `stages`;
CREATE TABLE IF NOT EXISTS `stages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `credit_id` int(11) NOT NULL,
  `state_credit` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cupo_aprobado` int(11) NOT NULL,
  `description_denied` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `stages`
--

INSERT INTO `stages` (`id`, `user_id`, `credit_id`, `state_credit`, `cupo_aprobado`, `description_denied`, `description`, `created`) VALUES
(1, 1, 1, 'Solicitud', 0, '', '', '2020-07-14 16:50:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(200) CHARACTER SET utf8 NOT NULL,
  `hash_change_password` varchar(200) CHARACTER SET utf8 NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `state` int(11) NOT NULL DEFAULT '0',
  `created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `telephone`, `email`, `password`, `hash_change_password`, `role`, `state`, `created`) VALUES
(1, 'Cliente a', '0000000', 'dlmorales096@gmail.com', '6cf4806722799b7e0fa0c79622157939d06287fd', '', 'Comercios', 1, '2020-06-16'),
(2, 'Admin', '11111110', 'dlmorales096@gmail.us', '6cf4806722799b7e0fa0c79622157939d06287fd', '', 'Administrador', 1, '2020-06-16'),
(3, 'Administrador secundario', '1111111', 'Administrador_secundario@gmail.com', '6cf4806722799b7e0fa0c79622157939d06287fd', '', 'Administrador_secundario', 1, '2020-07-03'),
(4, 'Coordinador analista', '1111', 'Coordinador_analista@gmail.com', '6cf4806722799b7e0fa0c79622157939d06287fd', '', 'Coordinador_analista', 1, '2020-07-08'),
(5, 'Finanzas', '3024634301', 'Finanzas6@gmail.com', '6cf4806722799b7e0fa0c79622157939d06287fd', '', 'Finanzas', 1, '2020-07-08'),
(6, 'Ejecutivo', '3024634301', 'Ejecutivo@gmail.com', '6cf4806722799b7e0fa0c79622157939d06287fd', '', 'Ejecutivo', 1, '2020-07-08'),
(7, 'Analista credito', '3024634301', 'Analista_credito@gmail.com', '6cf4806722799b7e0fa0c79622157939d06287fd', '', 'Analista_credito', 1, '2020-07-08');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
