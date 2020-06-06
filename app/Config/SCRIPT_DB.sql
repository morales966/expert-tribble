-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 06-06-2020 a las 02:06:31
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
  `nomre_persona` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_persona` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cedula_persona` int(11) NOT NULL,
  `foto_cedula_delantera` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `foto_cedula_trasera` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `telefono_persona` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  `created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `credits`
--

INSERT INTO `credits` (`id`, `user_id`, `valor_credito`, `numero_meses`, `valor_cuota`, `foto_perfil`, `nomre_persona`, `apellido_persona`, `cedula_persona`, `foto_cedula_delantera`, `foto_cedula_trasera`, `telefono_persona`, `state`, `created`) VALUES
(1, 1, 100000, '2', '64493', 'perfil_5ed42ebc769e5jpeg.jpeg', 'ss', 'aaa', 11, 'foto_cedula_delantera_5ed42ebc76f7cjpeg.jpeg', 'foto_cedula_trasera_5ed42ebc77443jpeg.jpeg', '22', 1, '2020-05-31'),
(2, 1, 200000, '4', '67914', 'perfil_5ed430a021fcbjpeg.jpeg', 'dd', 'ss', 111, 'foto_cedula_delantera_5ed430a022661jpeg.jpeg', 'foto_cedula_trasera_5ed430a022ba5jpeg.jpeg', '222', 1, '2020-05-31'),
(3, 1, 100000, '2', '64493', 'perfil_5ed474d52dfbe.png', 'dd', 'ww', 11, 'foto_cedula_delantera_5ed474d510951.png', 'foto_cedula_trasera_5ed474d52291a.png', '11', 1, '2020-06-01'),
(4, 1, 200000, '15', '18803', 'perfil_5ed478e18379f.png', 'aswq', 'qwa', 5555, 'foto_cedula_delantera_5ed478e164e3f.png', 'foto_cedula_trasera_5ed478e1788f4.png', '23422', 1, '2020-06-01'),
(5, 1, 300000, '7', '58858', 'perfil_5ed673e667962.png', 'prueba cristian', 'villa', 1152184587, 'foto_cedula_delantera_5ed673e644568.png', 'foto_cedula_trasera_5ed673e654f85.png', '3207045846', 1, '2020-06-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(200) CHARACTER SET utf8 NOT NULL,
  `hash_change_password` varchar(200) CHARACTER SET utf8 NOT NULL,
  `state` int(11) NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `hash_change_password`, `state`, `role`) VALUES
(1, 'Diego', 'dlmorales096@gmail.com', '6cf4806722799b7e0fa0c79622157939d06287fd', '', 1, 'cliente'),
(2, 'Admin', 'dlmorales096@gmail.com1', '6cf4806722799b7e0fa0c79622157939d06287fd', '', 1, 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
