-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-07-2020 a las 07:19:28
-- Versión del servidor: 10.4.10-MariaDB
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `codigo` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
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
  `adjuntar_cedula_trasera` varchar(200) COLLATE utf8mb4_spanish2_ci NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `user_id`, `codigo`, `nit`, `gremio`, `administrador`, `cedula`, `direccion`, `barrio`, `municipio`, `tel_usuario`, `banco`, `numero_cuenta`, `tipo_cuenta`, `nombre_propietario_cuenta`, `cedula_propietario_cuenta`, `ejecutivo`, `clase`, `como_paga`, `departamento`, `cantidad_comercios`, `cuanto_paga`, `productos_servicios`, `adjuntar_cedula_delantera`, `adjuntar_cedula_trasera`, `adjuntar_camara_comercio`, `adjuntar_rut`, `adjuntar_administrador`, `adjuntar_almacen`, `nombre_completo_r1`, `identificacion_r1`, `celular_r1`, `comercio_r1`, `nombre_completo_r2`, `identificacion_r2`, `celular_r2`, `comercio_r2`) VALUES
(1, 1, '333', '22222', 'Accesorios', 'qqqq', '111', 'qqq', 'www', 'www', '111', 'qqq', '2222', 'Ahorros', 'ddd ddd', '3333', 1, 'Clase B', 'Contado (efectivo-transferencia)', 'www', 2, '2', 'ddddddd', 'adjuntar_cedula_delantera_5f056572e1332.jpeg', 'adjuntar_cedula_trasera_5f056572e1f9b.jpeg', 'adjuntar_camara_comercio_5f056572e24ee.jpeg', 'adjuntar_rut_5f056572e29a6.jpeg', 'adjuntar_administrador_5f056572e2e4f.jpeg', 'adjuntar_almacen_5f056572e32db.jpeg', 'www', '2222', '4444', 'eeee', '2222', '3333', '444', 'dddd'),
(2, 8, '3e3', 'qq', 'Asesorias', 'qq', '222', 'qqq', 'qqq', 'qqq', '222', 'www', '222', 'Corriente', 'wwww', '222', 6, 'Clase A', 'Contado (efectivo-transferencia)', 'qq', 2, '781600', 'qqqq', 'adjuntar_cedula_delantera_5f1928885f758.jpeg', 'adjuntar_cedula_trasera_5f1928885fc7f.jpeg', 'adjuntar_camara_comercio_5f1928886022e.jpeg', 'adjuntar_rut_5f192888606de.jpeg', 'adjuntar_administrador_5f19288860b8a.jpeg', 'adjuntar_almacen_5f19288861025.jpeg', 'qqq', '222', '222', 'qq', 'www', '222', '2222', 'www'),
(3, 9, '2222', '11111111', 'Accesorios Militares', 'wwww', '2222', 'sss', 'www', 'www', '33333', 'eee', '33333', 'Ahorros', 'fff', '333', 6, 'Clase A', 'Contado (efectivo-transferencia)', 'ddd', 2, '781600', 'dddd', 'adjuntar_cedula_delantera_5f1e6845bbc54.jpeg', 'adjuntar_cedula_trasera_5f1e6845bc823.jpeg', 'adjuntar_camara_comercio_5f1e6845bd00c.jpeg', 'adjuntar_rut_5f1e6845bd4d8.jpeg', 'adjuntar_administrador_5f1e6845bd96a.jpeg', 'adjuntar_almacen_5f1e6845bddeb.jpeg', 'ss', 'www', '222', 'www', 'dd', 'eeee', '2222', '3333'),
(4, 10, '111', '111111', 'Asesorias', 'www', '22222222', 'www', 'www', 'qqq', '2222', 'eeee', 'dddd', 'Corriente', '222', '222', 6, 'Clase B', 'Contado (efectivo-transferencia)', 'ddd', 2, '380800', 'dddd', 'adjuntar_cedula_delantera_5f1e6afe8ed9e.jpeg', 'adjuntar_cedula_trasera_5f1e6afe8f54b.jpeg', 'adjuntar_camara_comercio_5f1e6afe8fa40.jpeg', 'adjuntar_rut_5f1e6afe8ff18.jpeg', 'adjuntar_administrador_5f1e6afe903d4.jpeg', 'adjuntar_almacen_5f1e6afe9090a.jpeg', 'qqq', 'qqqq', 'qqq', 'qqq', 'www', 'www', 'www', 'www');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `establishment` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `state` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

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
  `user_asesor` int(11) NOT NULL DEFAULT 0,
  `cupo_aprobado` int(11) NOT NULL DEFAULT 0,
  `state` int(11) NOT NULL DEFAULT 1,
  `created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

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
  `state` int(11) NOT NULL DEFAULT 0,
  `created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `telephone`, `email`, `password`, `hash_change_password`, `role`, `state`, `created`) VALUES
(1, 'Cliente a', '0000000', 'dlmorales096@gmail.com', '6cf4806722799b7e0fa0c79622157939d06287fd', '', 'Comercios', 1, '2020-06-16'),
(2, 'Admina', '11111110', 'dlmorales096@gmail.us', '6cf4806722799b7e0fa0c79622157939d06287fd', '', 'Administrador', 1, '2020-06-16'),
(3, 'Administrador secundario', '1111111', 'Administrador_secundario@gmail.com', '6cf4806722799b7e0fa0c79622157939d06287fd', '', 'Administrador_secundario', 1, '2020-07-03'),
(4, 'Coordinador analista', '1111', 'Coordinador_analista@gmail.com', '6cf4806722799b7e0fa0c79622157939d06287fd', '', 'Coordinador_analista', 1, '2020-07-08'),
(5, 'Finanzas', '3024634301', 'Finanzas6@gmail.com', '6cf4806722799b7e0fa0c79622157939d06287fd', '', 'Finanzas', 1, '2020-07-08'),
(6, 'Ejecutivo', '3024634301', 'Ejecutivo@gmail.com', '6cf4806722799b7e0fa0c79622157939d06287fd', '', 'Ejecutivo', 1, '2020-07-08'),
(7, 'Analista credito', '3024634301', 'Analista_credito@gmail.com', '6cf4806722799b7e0fa0c79622157939d06287fd', '', 'Analista_credito', 1, '2020-07-08'),
(8, 'qqqqq', '222', 'dlmorales096@gmail.com5', '6cf4806722799b7e0fa0c79622157939d06287fd', '', 'Comercios', 1, '2020-07-23'),
(9, '22222222', '22222', 'dlmorales096@gmail.com', 'feef5bd197c162ba946064f7b3095fccf4e23efb', '', 'Comercios', 2, '2020-07-27'),
(10, '22222222', '2222', 'dlmorales096@gmail.com', 'feef5bd197c162ba946064f7b3095fccf4e23efb', '', 'Comercios', 2, '2020-07-27');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
