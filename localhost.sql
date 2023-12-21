-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 02-12-2023 a las 01:31:18
-- Versión del servidor: 10.5.20-MariaDB
-- Versión de PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id21415752_prode`
--
CREATE DATABASE IF NOT EXISTS `prode` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `prode`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones`
--

CREATE TABLE `acciones` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre_jugador` varchar(50) NOT NULL,
  `acciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apuestas`
--

CREATE TABLE `apuestas` (
  `id` int(11) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `id_partida` int(11) NOT NULL,
  `prediccion` varchar(15) NOT NULL,
  `apuesta` varchar(10) NOT NULL,
  `cobra` varchar(10) NOT NULL,
  `resultado` varchar(10) DEFAULT NULL,
  `transaccion_final` varchar(10) DEFAULT NULL,
  `transaccion_finalizada` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `apuestas`
--

INSERT INTO `apuestas` (`id`, `usuario`, `id_partida`, `prediccion`, `apuesta`, `cobra`, `resultado`, `transaccion_final`, `transaccion_finalizada`) VALUES
(64, 'Colo', 261, 'Ganan Negras', '38.10', '10.58', '1 - 0', '-10.58', 'TRUE'),
(65, 'Colo', 262, 'Ganan Negras', '1.00', '1.60', '0 - 1', '+1.00', 'TRUE'),
(66, 'Colo', 263, 'Ganan Blancas', '0.99', '1.60', '1 - 0', '+0.99', 'TRUE'),
(67, 'Colo', 264, 'Ganan Negras', '1.04', '1.60', '0 - 1', '+1.04', 'TRUE'),
(68, 'Colo', 265, 'Ganan Blancas', '1.25', '1.60', '1 - 0', '+1.25', 'TRUE'),
(69, 'gaganeitor', 261, 'Empatan', '3.79', '1.60', '1 - 0', '-1.60', 'TRUE'),
(70, 'Colo', 266, 'Ganan Negras', '1.13', '1.60', '1 - 0', '-1.60', 'TRUE'),
(71, 'Colo', 267, 'Ganan Blancas', '0.85', '1.60', '1 - 0', '+0.85', 'TRUE'),
(72, 'gaganeitor', 262, 'Empatan', '4.38', '1.60', '0 - 1', '-1.60', 'TRUE'),
(73, 'gaganeitor', 263, 'Ganan Blancas', '0.99', '1.60', '1 - 0', '+0.99', 'TRUE'),
(74, 'Colo', 269, 'Ganan Blancas', '1.16', '1.60', '½ - ½', '-1.60', 'TRUE'),
(75, 'gaganeitor', 264, 'Ganan Negras', '1.04', '1.60', '0 - 1', '+1.04', 'TRUE'),
(76, 'gaganeitor', 265, 'Ganan Blancas', '1.25', '1.60', '1 - 0', '+1.25', 'TRUE'),
(77, 'gaganeitor', 266, 'Ganan Negras', '1.13', '1.60', '1 - 0', '-1.60', 'TRUE'),
(78, 'gaganeitor', 267, 'Ganan Blancas', '0.85', '1.60', '1 - 0', '+0.85', 'TRUE'),
(79, 'gaganeitor', 268, 'Ganan Negras', '1.00', '1.60', '0 - 1', '+1.00', 'TRUE'),
(80, 'gaganeitor', 269, 'Ganan Blancas', '1.16', '1.60', '½ - ½', '-1.60', 'TRUE'),
(81, 'gaganeitor', 270, 'Ganan Negras', '0.97', '1.60', '½ - ½', '-1.60', 'TRUE'),
(82, 'gaganeitor', 271, 'Ganan Blancas', '1.47', '1.60', '0 - 1', '-1.60', 'TRUE'),
(83, 'gaganeitor', 272, 'Ganan Negras', '1.12', '1.60', '½ - ½', '-1.60', 'TRUE'),
(84, 'gaganeitor', 273, 'Ganan Negras', '9.28', '2.58', '½ - ½', '-2.58', 'TRUE'),
(85, 'Colo', 270, 'Ganan Negras', '0.97', '1.60', '½ - ½', '-1.60', 'TRUE'),
(86, 'a', 266, 'Ganan Negras', '1.13', '1.60', '1 - 0', '-1.60', 'TRUE'),
(87, 'Colo', 274, 'Ganan Blancas', '4.30', '1.60', '0 - 1', '-1.60', 'TRUE'),
(88, 'Colo', 275, 'Empatan', '2.42', '1.60', '0 - 1', '-1.60', 'TRUE'),
(89, 'Colo', 276, 'Ganan Negras', '1.09', '1.60', '0 - 1', '+1.09', 'TRUE'),
(90, 'Colo', 277, 'Empatan', '2.31', '1.60', '1 - 0', '-1.60', 'TRUE'),
(91, 'Colo', 278, 'Ganan Blancas', '1.39', '1.60', '1 - 0', '+1.39', 'TRUE'),
(92, 'Colo', 279, 'Ganan Negras', '1.34', '1.60', '1 - 0', '-1.60', 'TRUE'),
(93, 'Colo', 280, 'Ganan Blancas', '0.85', '1.60', '1 - 0', '+0.85', 'TRUE'),
(94, 'Colo', 281, 'Ganan Negras', '0.86', '1.60', '0 - 1', '+0.86', 'TRUE'),
(95, 'Colo', 282, 'Ganan Negras', '1.01', '1.60', '0 - 1', '+1.01', 'TRUE'),
(96, 'gaganeitor', 274, 'Empatan', '2.23', '1.60', '0 - 1', '-1.60', 'TRUE'),
(97, 'gaganeitor', 275, 'Ganan Blancas', '1.52', '1.60', '0 - 1', '-1.60', 'TRUE'),
(98, 'gaganeitor', 276, 'Ganan Negras', '1.09', '1.60', '0 - 1', '+1.09', 'TRUE'),
(99, 'gaganeitor', 277, 'Ganan Blancas', '1.61', '1.60', '1 - 0', '+1.61', 'TRUE'),
(100, 'gaganeitor', 278, 'Ganan Blancas', '1.39', '1.60', '1 - 0', '+1.39', 'TRUE'),
(101, 'gaganeitor', 279, 'Ganan Negras', '1.34', '1.60', '1 - 0', '-1.60', 'TRUE'),
(102, 'gaganeitor', 280, 'Ganan Blancas', '0.85', '1.60', '1 - 0', '+0.85', 'TRUE'),
(103, 'gaganeitor', 281, 'Ganan Negras', '0.86', '1.60', '0 - 1', '+0.86', 'TRUE'),
(104, 'a', 300, 'Empatan', '2.34', '1.60', '0 - 1', '-1.60', 'TRUE'),
(105, 'a', 301, 'Ganan Negras', '1.11', '1.60', '1 - 0', '-1.60', 'TRUE'),
(106, 'a', 302, 'Ganan Blancas', '0.88', '1.60', '1 - 0', '+0.88', 'TRUE'),
(107, 'a', 303, 'Ganan Blancas', '1.19', '1.60', '1 - 0', '+1.19', 'TRUE'),
(108, 'a', 304, 'Ganan Blancas', '0.99', '1.60', '1 - 0', '+0.99', 'TRUE'),
(109, 'a', 305, 'Ganan Negras', '0.86', '1.60', '0 - 1', '+0.86', 'TRUE'),
(110, 'a', 307, 'Ganan Negras', '0.86', '1.60', '0 - 1', '+0.86', 'TRUE'),
(111, 'a', 306, 'Empatan', '2.56', '1.60', '0 - 1', '-1.60', 'TRUE'),
(112, 'Elpuntanopijudo', 300, 'Ganan Blancas', '1.58', '1.60', '0 - 1', '-1.60', 'TRUE'),
(113, 'Elpuntanopijudo', 301, 'Ganan Negras', '1.11', '1.60', '1 - 0', '-1.60', 'TRUE'),
(114, 'Elpuntanopijudo', 302, 'Empatan', '3.79', '1.60', '1 - 0', '-1.60', 'TRUE'),
(115, 'a', 313, 'Empatan', '2.00', '1.60', NULL, NULL, NULL),
(116, 'a', 314, 'Empatan', '1.91', '1.60', NULL, NULL, NULL),
(117, 'a', 315, 'Ganan Negras', '1.00', '1.60', NULL, NULL, NULL),
(118, 'a', 316, 'Ganan Blancas', '0.88', '1.60', NULL, NULL, NULL),
(119, 'a', 317, 'Ganan Negras', '1.98', '1.60', NULL, NULL, NULL),
(120, 'a', 318, 'Ganan Negras', '2.06', '1.60', NULL, NULL, NULL),
(121, 'a', 319, 'Ganan Blancas', '1.20', '1.60', NULL, NULL, NULL),
(122, 'a', 320, 'Ganan Blancas', '0.85', '1.60', NULL, NULL, NULL),
(123, 'a', 321, 'Ganan Negras', '0.86', '1.60', NULL, NULL, NULL),
(124, 'gaganeitor', 313, 'Empatan', '2.00', '1.60', NULL, NULL, NULL),
(125, 'gaganeitor', 314, 'Ganan Blancas', '2.59', '1.60', NULL, NULL, NULL),
(126, 'gaganeitor', 315, 'Ganan Negras', '1.00', '1.60', NULL, NULL, NULL),
(127, 'gaganeitor', 316, 'Ganan Blancas', '0.88', '1.60', NULL, NULL, NULL),
(128, 'gaganeitor', 317, 'Ganan Blancas', '3.63', '1.60', NULL, NULL, NULL),
(129, 'gaganeitor', 318, 'Ganan Negras', '2.06', '1.60', NULL, NULL, NULL),
(130, 'gaganeitor', 319, 'Ganan Blancas', '1.20', '1.60', NULL, NULL, NULL),
(131, 'gaganeitor', 320, 'Ganan Blancas', '0.85', '1.60', NULL, NULL, NULL),
(132, 'gaganeitor', 321, 'Ganan Negras', '0.86', '1.60', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `elo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`id`, `nombre`, `elo`) VALUES
(1, 'Flores, Diego', 2526),
(2, 'Perez Ponsa, Federico', 2524),
(3, 'Acosta, Pablo Ismael', 2477),
(4, 'Valerga, Diego', 2429),
(5, 'Rodriguez Vila, Andres', 2405),
(6, 'Hobaica, Juan Pablo', 2402),
(7, 'Hoffman, Alejandro', 2348),
(8, 'Villegas, Franco', 2301),
(9, 'Scarella, Enrique Alejandro', 2279),
(10, 'De Dovitiis, Alejo', 2255),
(11, 'Asprelli, Gaspar', 2240),
(12, 'Perez Candelas, Andres Eloy', 2227),
(13, 'Contin, Daniel', 2209),
(14, 'Campos, Maria Jose', 2208),
(15, 'Aguilar Samper, Valentin', 2204),
(16, 'Sarquis, Maria Belen', 2194),
(17, 'Ocampos, Ian', 2185),
(18, 'Zuriel, Marisa', 2165),
(19, 'Fuentes, Agustin', 2162),
(20, 'Ramirez, Victor', 2113),
(21, 'Pereyra, Horacio', 2104),
(22, 'Sanz, Luis', 2094),
(23, 'Charaf, Leonardo', 2092),
(24, 'Brizzi, Milagros Tatiana', 2076),
(25, 'Tumini, Leandro', 2057),
(26, 'Belmes, Martin', 2038),
(27, 'Zamani, Andres', 2038),
(28, 'Heredia, Valentin', 2019),
(29, 'Allo, Esteban', 2003),
(30, 'Meza, Anahi', 1996),
(31, 'Curia, Santiago Jose', 1995),
(32, 'Fernandes, Martin', 1991),
(33, 'Loiterstein, Mariano', 1988),
(34, 'Dubrovich, Igor', 1982),
(35, 'Jarmoluk, Jorge E.', 1981),
(36, 'Torella, Rodolfo', 1961),
(37, 'Jabie, Rafael', 1956),
(38, 'Zarate, Cristian', 1940),
(39, 'Koch, Juan', 1909),
(40, 'Gonzalez, Fabian', 1903),
(41, 'Tries, Ivan', 1903),
(42, 'Valli, Americo', 1900),
(43, 'Walsh, Hector', 1895),
(44, 'Dominguez, Diego', 1879),
(45, 'Arana, Augusto', 1870),
(46, 'Lo Presti, Roberto', 1863),
(47, 'Fiorenza, Brandon', 1857),
(48, 'Pereyra, Mariano Gaston', 1857),
(49, 'Hernandez, Luis Crisanto', 1846),
(50, 'Lagares Rodriguez, Santiago Inak', 1843),
(51, 'Horisch, Juan Pablo', 1837),
(52, 'Galante, Agustin', 1813),
(53, 'Iribarren, Francisco', 1807),
(54, 'Nascimbene, Ramiro', 1790),
(55, 'Romero, Fabian', 1788),
(56, 'Giacame, Juan Manuel', 1786),
(57, 'Pedreira Henrich, Alan', 1779),
(58, 'Rojas, Lautaro', 1774),
(59, 'Videla, Gaston', 1757),
(60, 'Capuano, Gabriel', 1755),
(61, 'Fuxz, Diego', 1750),
(62, 'Cappelletti, Gabriel', 1732),
(63, 'Nomdedeu, Patricio', 1730),
(64, 'Escobar, Lautaro Exequiel', 1707),
(65, 'Bilbao, Guillermo', 1668),
(66, 'Magarinos, Francisco', 1663),
(67, 'Muniz, Roberto Anibal', 1662),
(68, 'Duran, Diego', 1661),
(69, 'Rosas Sepulveda, Pablo Ignacio', 1661),
(70, 'Martinez, Tomas', 1653),
(71, 'Campanini, Hugo Ricardo', 1648),
(72, 'Ripa, Julio Martin', 1641),
(73, 'Derbes, Jose', 1639),
(74, 'Renkine, Ivan', 1637),
(75, 'Quadri, Silvio', 1602),
(76, 'Vanza, Aldo', 1580),
(77, 'Rivero, Mario', 1578),
(78, 'Serafino, Emanuel', 1567),
(79, 'Cobelo, Nicolas', 1545),
(80, 'Arias, Maria Paula', 1536),
(81, 'Casal, Ray Laura', 1526),
(82, 'Salas, Carlos Raul', 1512),
(83, 'Sanchez, Marcelo', 1510),
(84, 'Enciso, Franco', 1509),
(85, 'Fernandez Rivero, Juan Rodrigo', 1474),
(86, 'Desanzo, Juan Carlos', 1458),
(87, 'Fernandes, Hector Omar', 1413),
(88, 'Alquezar, Juan Manuel', 1304),
(89, 'Rodriguez Caimmi, Facundo', 1251),
(90, 'Iniguez, Miguel Angel', 1248),
(91, 'Carrizo, Juan Carlos', 1212),
(92, 'Cornes, Carlos Alberto', 1131),
(93, 'Iniguez, Miguel Angel (Hijo)', 1088),
(94, 'Garcia, Emilio', 1033),
(95, 'Clementino, Bruno Bautista', 0),
(96, 'Gajante, Valentin', 0),
(97, 'Mendez, Miguel Antonio', 0),
(98, 'Pfund, Jorge', 0),
(99, 'Rodriguez, Ramon Jose', 0),
(100, 'Roldan, Julio Cesar', 0),
(101, 'Spaghi, Martin', 0),
(102, 'Tancredi, Felipe', 0),
(103, 'Turco, Gustavo', 0),
(104, 'Valdes, Benjamin', 0),
(105, 'Borda Rodas, Anapaola S.', 2261),
(106, 'Adam, Ernestina', 2036),
(107, 'Nejanky, Maisa', 1951),
(108, 'Flores Mirabal, Nancy', 1937),
(109, 'Bosco, Giuliana', 1878),
(110, 'Encina, Guadalupe', 1877),
(111, 'Gaite, Karen Nerina', 1871),
(112, 'Semprevivo, Florencia', 1871),
(113, 'Donda, Jazmin', 1825),
(114, 'Ramirez, Marysol', 1720),
(115, 'Montiel Marin, Micaela Agustina', 1631),
(116, 'Bossero, Ingrid', 1607),
(117, 'Recalde, Ailin', 1449),
(118, 'Quiroga Ortiz, Isabella', 1417),
(119, 'Palomares, Lujan', 1405),
(120, 'Herrera, Lara', 1391),
(121, 'Castaneda, Milagros', 1384),
(122, 'Alvarez, Mia Morena', 1307),
(123, 'Figueroa, Layla Iazmin', 1234),
(124, 'Rodriguez, Celina', 1200),
(125, 'Garbero, Ana Carolina', 1196),
(126, 'Perez Mosqueda, Valeria Ritzabeth', 0),
(127, 'Quiroga Ortiz, Helena', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadorestorneo`
--

CREATE TABLE `jugadorestorneo` (
  `id` int(11) NOT NULL,
  `nombreJugador` varchar(50) NOT NULL,
  `id_torneo` varchar(5) NOT NULL,
  `posicionFinal` varchar(5) NOT NULL,
  `puntos` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jugadorestorneo`
--

INSERT INTO `jugadorestorneo` (`id`, `nombreJugador`, `id_torneo`, `posicionFinal`, `puntos`) VALUES
(1, 'Flores, Diego', '1', '', ''),
(2, 'Perez Ponsa, Federico', '1', '', ''),
(3, 'Acosta, Pablo Ismael', '1', '', ''),
(4, 'Valerga, Diego', '1', '', ''),
(5, 'Rodriguez Vila, Andres', '1', '', ''),
(6, 'Hobaica, Juan Pablo', '1', '', ''),
(7, 'Hoffman, Alejandro', '1', '', ''),
(8, 'Villegas, Franco', '1', '', ''),
(9, 'Scarella, Enrique Alejandro', '1', '', ''),
(10, 'De Dovitiis, Alejo', '1', '', ''),
(11, 'Asprelli, Gaspar', '1', '', ''),
(12, 'Perez Candelas, Andres Eloy', '1', '', ''),
(13, 'Contin, Daniel', '1', '', ''),
(14, 'Campos, Maria Jose', '1', '', ''),
(15, 'Aguilar Samper, Valentin', '1', '', ''),
(16, 'Sarquis, Maria Belen', '1', '', ''),
(17, 'Ocampos, Ian', '1', '', ''),
(18, 'Zuriel, Marisa', '1', '', ''),
(19, 'Fuentes, Agustin', '1', '', ''),
(20, 'Ramirez, Victor', '1', '', ''),
(21, 'Pereyra, Horacio', '1', '', ''),
(22, 'Sanz, Luis', '1', '', ''),
(23, 'Charaf, Leonardo', '1', '', ''),
(24, 'Brizzi, Milagros Tatiana', '1', '', ''),
(25, 'Tumini, Leandro', '1', '', ''),
(26, 'Belmes, Martin', '1', '', ''),
(27, 'Zamani, Andres', '1', '', ''),
(28, 'Heredia, Valentin', '1', '', ''),
(29, 'Allo, Esteban', '1', '', ''),
(30, 'Meza, Anahi', '1', '', ''),
(31, 'Curia, Santiago Jose', '1', '', ''),
(32, 'Fernandes, Martin', '1', '', ''),
(33, 'Loiterstein, Mariano', '1', '', ''),
(34, 'Dubrovich, Igor', '1', '', ''),
(35, 'Jarmoluk, Jorge E.', '1', '', ''),
(36, 'Torella, Rodolfo', '1', '', ''),
(37, 'Jabie, Rafael', '1', '', ''),
(38, 'Zarate, Cristian', '1', '', ''),
(39, 'Koch, Juan', '1', '', ''),
(40, 'Gonzalez, Fabian', '1', '', ''),
(41, 'Tries, Ivan', '1', '', ''),
(42, 'Valli, Americo', '1', '', ''),
(43, 'Walsh, Hector', '1', '', ''),
(44, 'Dominguez, Diego', '1', '', ''),
(45, 'Arana, Augusto', '1', '', ''),
(46, 'Lo Presti, Roberto', '1', '', ''),
(47, 'Fiorenza, Brandon', '1', '', ''),
(48, 'Pereyra, Mariano Gaston', '1', '', ''),
(49, 'Hernandez, Luis Crisanto', '1', '', ''),
(50, 'Lagares Rodriguez, Santiago Inak', '1', '', ''),
(51, 'Horisch, Juan Pablo', '1', '', ''),
(52, 'Galante, Agustin', '1', '', ''),
(53, 'Iribarren, Francisco', '1', '', ''),
(54, 'Nascimbene, Ramiro', '1', '', ''),
(55, 'Romero, Fabian', '1', '', ''),
(56, 'Giacame, Juan Manuel', '1', '', ''),
(57, 'Pedreira Henrich, Alan', '1', '', ''),
(58, 'Rojas, Lautaro', '1', '', ''),
(59, 'Videla, Gaston', '1', '', ''),
(60, 'Capuano, Gabriel', '1', '', ''),
(61, 'Fuxz, Diego', '1', '', ''),
(62, 'Cappelletti, Gabriel', '1', '', ''),
(63, 'Nomdedeu, Patricio', '1', '', ''),
(64, 'Escobar, Lautaro Exequiel', '1', '', ''),
(65, 'Bilbao, Guillermo', '1', '', ''),
(66, 'Magarinos, Francisco', '1', '', ''),
(67, 'Muniz, Roberto Anibal', '1', '', ''),
(68, 'Duran, Diego', '1', '', ''),
(69, 'Rosas Sepulveda, Pablo Ignacio', '1', '', ''),
(70, 'Martinez, Tomas', '1', '', ''),
(71, 'Campanini, Hugo Ricardo', '1', '', ''),
(72, 'Ripa, Julio Martin', '1', '', ''),
(73, 'Derbes, Jose', '1', '', ''),
(74, 'Renkine, Ivan', '1', '', ''),
(75, 'Quadri, Silvio', '1', '', ''),
(76, 'Vanza, Aldo', '1', '', ''),
(77, 'Rivero, Mario', '1', '', ''),
(78, 'Serafino, Emanuel', '1', '', ''),
(79, 'Cobelo, Nicolas', '1', '', ''),
(80, 'Arias, Maria Paula', '1', '', ''),
(81, 'Casal, Ray Laura', '1', '', ''),
(82, 'Salas, Carlos Raul', '1', '', ''),
(83, 'Sanchez, Marcelo', '1', '', ''),
(84, 'Enciso, Franco', '1', '', ''),
(85, 'Fernandez Rivero, Juan Rodrigo', '1', '', ''),
(86, 'Desanzo, Juan Carlos', '1', '', ''),
(87, 'Fernandes, Hector Omar', '1', '', ''),
(88, 'Alquezar, Juan Manuel', '1', '', ''),
(89, 'Rodriguez Caimmi, Facundo', '1', '', ''),
(90, 'Iniguez, Miguel Angel', '1', '', ''),
(91, 'Carrizo, Juan Carlos', '1', '', ''),
(92, 'Cornes, Carlos Alberto', '1', '', ''),
(93, 'Iniguez, Miguel Angel (Hijo)', '1', '', ''),
(94, 'Garcia, Emilio', '1', '', ''),
(95, 'Clementino, Bruno Bautista', '1', '', ''),
(96, 'Gajante, Valentin', '1', '', ''),
(97, 'Mendez, Miguel Antonio', '1', '', ''),
(98, 'Pfund, Jorge', '1', '', ''),
(99, 'Rodriguez, Ramon Jose', '1', '', ''),
(100, 'Roldan, Julio Cesar', '1', '', ''),
(101, 'Spaghi, Martin', '1', '', ''),
(102, 'Tancredi, Felipe', '1', '', ''),
(103, 'Turco, Gustavo', '1', '', ''),
(104, 'Valdes, Benjamin', '1', '', ''),
(105, 'Borda Rodas, Anapaola S.', '2', '', ''),
(106, 'Campos, Maria Jose', '2', '', ''),
(107, 'Sarquis, Maria Belen', '2', '', ''),
(108, 'Zuriel, Marisa', '2', '', ''),
(109, 'Brizzi, Milagros Tatiana', '2', '', ''),
(110, 'Adam, Ernestina', '2', '', ''),
(111, 'Nejanky, Maisa', '2', '', ''),
(112, 'Flores Mirabal, Nancy', '2', '', ''),
(113, 'Bosco, Giuliana', '2', '', ''),
(114, 'Encina, Guadalupe', '2', '', ''),
(115, 'Gaite, Karen Nerina', '2', '', ''),
(116, 'Semprevivo, Florencia', '2', '', ''),
(117, 'Donda, Jazmin', '2', '', ''),
(118, 'Ramirez, Marysol', '2', '', ''),
(119, 'Montiel Marin, Micaela Agustina', '2', '', ''),
(120, 'Bossero, Ingrid', '2', '', ''),
(121, 'Recalde, Ailin', '2', '', ''),
(122, 'Quiroga Ortiz, Isabella', '2', '', ''),
(123, 'Palomares, Lujan', '2', '', ''),
(124, 'Herrera, Lara', '2', '', ''),
(125, 'Castaneda, Milagros', '2', '', ''),
(126, 'Alvarez, Mia Morena', '2', '', ''),
(127, 'Figueroa, Layla Iazmin', '2', '', ''),
(128, 'Rodriguez, Celina', '2', '', ''),
(129, 'Garbero, Ana Carolina', '2', '', ''),
(130, 'Perez Mosqueda, Valeria Ritzabeth', '2', '', ''),
(131, 'Quiroga Ortiz, Helena', '2', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mercado`
--

CREATE TABLE `mercado` (
  `id` int(11) NOT NULL,
  `nombre_jugador` varchar(50) NOT NULL,
  `acciones_disp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rondas`
--

CREATE TABLE `rondas` (
  `id` int(11) NOT NULL,
  `nombreTorneo` varchar(50) NOT NULL,
  `n°Ronda` int(11) NOT NULL,
  `nombreJugador1` varchar(50) NOT NULL,
  `pts1` varchar(5) NOT NULL,
  `nombreJugador2` varchar(50) NOT NULL,
  `pts2` varchar(5) NOT NULL,
  `resultado` varchar(10) DEFAULT NULL,
  `Inicio` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rondas`
--

INSERT INTO `rondas` (`id`, `nombreTorneo`, `n°Ronda`, `nombreJugador1`, `pts1`, `nombreJugador2`, `pts2`, `resultado`, `Inicio`) VALUES
(248, 'Final Argentina Femenino 2023', 1, 'Ramirez, Marysol', '0', 'Borda Rodas, Anapaola S.', '0', '0 - 1', '2023-11-20 22:30:00'),
(249, 'Final Argentina Femenino 2023', 1, 'Campos, Maria Jose', '0', 'Montiel Marin, Micaela Agustina', '0', '1 - 0', '2023-11-20 22:30:00'),
(250, 'Final Argentina Femenino 2023', 1, 'Bossero, Ingrid', '0', 'Sarquis, Maria Belen', '0', '0 - 1', '2023-11-20 22:30:00'),
(251, 'Final Argentina Femenino 2023', 1, 'Zuriel, Marisa', '0', 'Recalde, Ailin', '0', '1 - 0', '2023-11-20 22:30:00'),
(252, 'Final Argentina Femenino 2023', 1, 'Quiroga Ortiz, Isabella', '0', 'Brizzi, Milagros Tatiana', '0', '0 - 1', '2023-11-20 22:30:00'),
(253, 'Final Argentina Femenino 2023', 1, 'Adam, Ernestina', '0', 'Palomares, Lujan', '0', '1 - 0', '2023-11-20 22:30:00'),
(254, 'Final Argentina Femenino 2023', 1, 'Herrera, Lara', '0', 'Nejanky, Maisa', '0', '0 - 1', '2023-11-20 22:30:00'),
(255, 'Final Argentina Femenino 2023', 1, 'Flores Mirabal, Nancy', '0', 'Castaneda, Milagros', '0', '+ - -', '2023-11-20 22:30:00'),
(256, 'Final Argentina Femenino 2023', 1, 'Alvarez, Mia Morena', '0', 'Bosco, Giuliana', '0', '0 - 1', '2023-11-20 22:30:00'),
(257, 'Final Argentina Femenino 2023', 1, 'Encina, Guadalupe', '0', 'Figueroa, Layla Iazmin', '0', '1 - 0', '2023-11-20 22:30:00'),
(258, 'Final Argentina Femenino 2023', 1, 'Rodriguez, Celina', '0', 'Gaite, Karen Nerina', '0', '0 - 1', '2023-11-20 22:30:00'),
(259, 'Final Argentina Femenino 2023', 1, 'Semprevivo, Florencia', '0', 'Garbero, Ana Carolina', '0', '1 - 0', '2023-11-20 22:30:00'),
(260, 'Final Argentina Femenino 2023', 1, 'Perez Mosqueda, Valeria Ritzabeth', '0', 'Donda, Jazmin', '0', '0 - 1', '2023-11-20 22:30:00'),
(261, 'Final Argentina Femenino 2023', 2, 'Borda Rodas, Anapaola S.', '1', 'Flores Mirabal, Nancy', '1', '1 - 0', '2023-11-21 00:36:00'),
(262, 'Final Argentina Femenino 2023', 2, 'Bosco, Giuliana', '1', 'Campos, Maria Jose', '1', '0 - 1', '2023-11-21 00:36:00'),
(263, 'Final Argentina Femenino 2023', 2, 'Sarquis, Maria Belen', '1', 'Encina, Guadalupe', '1', '1 - 0', '2023-11-21 00:36:00'),
(264, 'Final Argentina Femenino 2023', 2, 'Gaite, Karen Nerina', '1', 'Zuriel, Marisa', '1', '0 - 1', '2023-11-21 00:36:00'),
(265, 'Final Argentina Femenino 2023', 2, 'Brizzi, Milagros Tatiana', '1', 'Semprevivo, Florencia', '1', '1 - 0', '2023-11-21 00:36:00'),
(266, 'Final Argentina Femenino 2023', 2, 'Donda, Jazmin', '1', 'Adam, Ernestina', '1', '1 - 0', '2023-11-21 00:36:00'),
(267, 'Final Argentina Femenino 2023', 2, 'Nejanky, Maisa', '1', 'Quiroga Ortiz, Helena', '1', '1 - 0', '2023-11-21 00:36:00'),
(268, 'Final Argentina Femenino 2023', 2, 'Castaneda, Milagros', '0', 'Ramirez, Marysol', '0', '0 - 1', '2023-11-21 00:36:00'),
(269, 'Final Argentina Femenino 2023', 2, 'Montiel Marin, Micaela Agustina', '0', 'Herrera, Lara', '0', '½ - ½', '2023-11-21 00:36:00'),
(270, 'Final Argentina Femenino 2023', 2, 'Figueroa, Layla Iazmin', '0', 'Bossero, Ingrid', '0', '½ - ½', '2023-11-21 00:36:00'),
(271, 'Final Argentina Femenino 2023', 2, 'Recalde, Ailin', '0', 'Alvarez, Mia Morena', '0', '0 - 1', '2023-11-21 00:36:00'),
(272, 'Final Argentina Femenino 2023', 2, 'Garbero, Ana Carolina', '0', 'Quiroga Ortiz, Isabella', '0', '½ - ½', '2023-11-21 00:36:00'),
(273, 'Final Argentina Femenino 2023', 2, 'Palomares, Lujan', '0', 'Rodriguez, Celina', '0', '½ - ½', '2023-11-21 00:36:00'),
(274, 'Final Argentina Femenino 2023', 3, 'Zuriel, Marisa', '2', 'Borda Rodas, Anapaola S.', '2', '0 - 1', '2023-11-22 18:30:00'),
(275, 'Final Argentina Femenino 2023', 3, 'Campos, Maria Jose', '2', 'Brizzi, Milagros Tatiana', '2', '0 - 1', '2023-11-22 18:30:00'),
(276, 'Final Argentina Femenino 2023', 3, 'Nejanky, Maisa', '2', 'Sarquis, Maria Belen', '2', '0 - 1', '2023-11-22 18:30:00'),
(277, 'Final Argentina Femenino 2023', 3, 'Flores Mirabal, Nancy', '1', 'Donda, Jazmin', '2', '1 - 0', '2023-11-22 18:30:00'),
(278, 'Final Argentina Femenino 2023', 3, 'Adam, Ernestina', '1', 'Semprevivo, Florencia', '1', '1 - 0', '2023-11-22 18:30:00'),
(279, 'Final Argentina Femenino 2023', 3, 'Ramirez, Marysol', '1', 'Bosco, Giuliana', '1', '1 - 0', '2023-11-22 18:30:00'),
(280, 'Final Argentina Femenino 2023', 3, 'Encina, Guadalupe', '1', 'Perez Mosqueda, Valeria Ritzabeth', '1', '1 - 0', '2023-11-22 18:30:00'),
(281, 'Final Argentina Femenino 2023', 3, 'Quiroga Ortiz, Helena', '1', 'Gaite, Karen Nerina', '1', '0 - 1', '2023-11-22 18:30:00'),
(282, 'Final Argentina Femenino 2023', 3, 'Alvarez, Mia Morena', '1', 'Montiel Marin, Micaela Agustina', '½', '0 - 1', '2023-11-22 18:30:00'),
(283, 'Final Argentina Femenino 2023', 3, 'Bossero, Ingrid', '½', 'Garbero, Ana Carolina', '½', '1 - 0', '2023-11-22 18:30:00'),
(284, 'Final Argentina Femenino 2023', 3, 'Quiroga Ortiz, Isabella', '½', 'Figueroa, Layla Iazmin', '½', '1 - 0', '2023-11-22 18:30:00'),
(285, 'Final Argentina Femenino 2023', 3, 'Herrera, Lara', '½', 'Palomares, Lujan', '½', '½ - ½', '2023-11-22 18:30:00'),
(286, 'Final Argentina Femenino 2023', 3, 'Rodriguez, Celina', '½', 'Castaneda, Milagros', '0', '0 - 1', '2023-11-22 18:30:00'),
(287, 'Final Argentina Femenino 2023', 4, 'Borda Rodas, Anapaola S.', '3', 'Sarquis, Maria Belen', '3', '0 - 1', '2023-11-23 17:09:00'),
(288, 'Final Argentina Femenino 2023', 4, 'Brizzi, Milagros Tatiana', '3', 'Zuriel, Marisa', '2', '½ - ½', '2023-11-23 17:09:00'),
(289, 'Final Argentina Femenino 2023', 4, 'Encina, Guadalupe', '2', 'Campos, Maria Jose', '2', '0 - 1', '2023-11-23 17:09:00'),
(290, 'Final Argentina Femenino 2023', 4, 'Gaite, Karen Nerina', '2', 'Adam, Ernestina', '2', '0 - 1', '2023-11-23 17:09:00'),
(291, 'Final Argentina Femenino 2023', 4, 'Donda, Jazmin', '2', 'Nejanky, Maisa', '2', '1 - 0', '2023-11-23 17:09:00'),
(292, 'Final Argentina Femenino 2023', 4, 'Flores Mirabal, Nancy', '2', 'Ramirez, Marysol', '2', '1 - 0', '2023-11-23 17:09:00'),
(293, 'Final Argentina Femenino 2023', 4, 'Montiel Marin, Micaela Agustina', '1½', 'Bossero, Ingrid', '1½', '1 - 0', '2023-11-23 17:09:00'),
(294, 'Final Argentina Femenino 2023', 4, 'Bosco, Giuliana', '1', 'Quiroga Ortiz, Isabella', '1½', '1 - 0', '2023-11-23 17:09:00'),
(295, 'Final Argentina Femenino 2023', 4, 'Semprevivo, Florencia', '1', 'Alvarez, Mia Morena', '1', '0 - 1', '2023-11-23 17:09:00'),
(296, 'Final Argentina Femenino 2023', 4, 'Castaneda, Milagros', '1', 'Recalde, Ailin', '1', '1 - 0', '2023-11-23 17:09:00'),
(297, 'Final Argentina Femenino 2023', 4, 'Palomares, Lujan', '1', 'Quiroga Ortiz, Helena', '1', '1 - 0', '2023-11-23 17:09:00'),
(298, 'Final Argentina Femenino 2023', 4, 'Perez Mosqueda, Valeria Ritzabeth', '1', 'Herrera, Lara', '1', '0 - 1', '2023-11-23 17:09:00'),
(299, 'Final Argentina Femenino 2023', 4, 'Figueroa, Layla Iazmin', '½', 'Rodriguez, Celina', '½', '1 - 0', '2023-11-23 17:09:00'),
(300, 'Final Argentina Femenino 2023', 5, 'Sarquis, Maria Belen', '4', 'Brizzi, Milagros Tatiana', '3½', '0 - 1', '2023-11-24 19:05:00'),
(301, 'Final Argentina Femenino 2023', 5, 'Adam, Ernestina', '3', 'Borda Rodas, Anapaola S.', '3', '1 - 0', '2023-11-24 19:05:00'),
(302, 'Final Argentina Femenino 2023', 5, 'Campos, Maria Jose', '3', 'Donda, Jazmin', '3', '1 - 0', '2023-11-24 19:05:00'),
(303, 'Final Argentina Femenino 2023', 5, 'Zuriel, Marisa', '2½', 'Flores Mirabal, Nancy', '3', '1 - 0', '2023-11-24 19:05:00'),
(304, 'Final Argentina Femenino 2023', 5, 'Nejanky, Maisa', '2', 'Montiel Marin, Micaela Agustina', '2½', '1 - 0', '2023-11-24 19:05:00'),
(305, 'Final Argentina Femenino 2023', 5, 'Herrera, Lara', '2', 'Bosco, Giuliana', '2', '0 - 1', '2023-11-24 19:05:00'),
(306, 'Final Argentina Femenino 2023', 5, 'Ramirez, Marysol', '2', 'Encina, Guadalupe', '2', '0 - 1', '2023-11-24 19:05:00'),
(307, 'Final Argentina Femenino 2023', 5, 'Alvarez, Mia Morena', '2', 'Gaite, Karen Nerina', '2', '0 - 1', '2023-11-24 19:05:00'),
(308, 'Final Argentina Femenino 2023', 5, 'Quiroga Ortiz, Isabella', '1½', 'Palomares, Lujan', '2', '½ - ½', '2023-11-24 19:05:00'),
(309, 'Final Argentina Femenino 2023', 5, 'Garbero, Ana Carolina', '1½', 'Figueroa, Layla Iazmin', '1½', '½ - ½', '2023-11-24 19:05:00'),
(310, 'Final Argentina Femenino 2023', 5, 'Bossero, Ingrid', '1½', 'Semprevivo, Florencia', '1', '0 - 1', '2023-11-24 19:05:00'),
(311, 'Final Argentina Femenino 2023', 5, 'Recalde, Ailin', '1', 'Perez Mosqueda, Valeria Ritzabeth', '1', '1 - 0', '2023-11-24 19:05:00'),
(312, 'Final Argentina Femenino 2023', 5, 'Quiroga Ortiz, Helena', '1', 'Rodriguez, Celina', '½', '0 - 1', '2023-11-24 19:05:00'),
(313, 'Final Argentina Femenino 2023', 6, 'Brizzi, Milagros Tatiana', '4½', 'Adam, Ernestina', '4', NULL, '2023-11-25 17:25:00'),
(314, 'Final Argentina Femenino 2023', 6, 'Sarquis, Maria Belen', '4', 'Campos, Maria Jose', '4', NULL, '2023-11-25 17:25:00'),
(315, 'Final Argentina Femenino 2023', 6, 'Donda, Jazmin', '3', 'Zuriel, Marisa', '3½', NULL, '2023-11-25 17:25:00'),
(316, 'Final Argentina Femenino 2023', 6, 'Borda Rodas, Anapaola S.', '3', 'Encina, Guadalupe', '3', NULL, '2023-11-25 17:25:00'),
(317, 'Final Argentina Femenino 2023', 6, 'Bosco, Giuliana', '3', 'Nejanky, Maisa', '3', NULL, '2023-11-25 17:25:00'),
(318, 'Final Argentina Femenino 2023', 6, 'Gaite, Karen Nerina', '3', 'Flores Mirabal, Nancy', '3', NULL, '2023-11-25 17:25:00'),
(319, 'Final Argentina Femenino 2023', 6, 'Montiel Marin, Micaela Agustina', '2½', 'Palomares, Lujan', '2½', NULL, '2023-11-25 17:25:00'),
(320, 'Final Argentina Femenino 2023', 6, 'Semprevivo, Florencia', '2', 'Castaneda, Milagros', '2', NULL, '2023-11-25 17:25:00'),
(321, 'Final Argentina Femenino 2023', 6, 'Figueroa, Layla Iazmin', '2', 'Ramirez, Marysol', '2', NULL, '2023-11-25 17:25:00'),
(322, 'Final Argentina Femenino 2023', 6, 'Recalde, Ailin', '2', 'Quiroga Ortiz, Isabella', '2', NULL, '2023-11-25 17:25:00'),
(323, 'Final Argentina Femenino 2023', 6, 'Garbero, Ana Carolina', '2', 'Herrera, Lara', '2', NULL, '2023-11-25 17:25:00'),
(324, 'Final Argentina Femenino 2023', 6, 'Rodriguez, Celina', '1½', 'Alvarez, Mia Morena', '2', NULL, '2023-11-25 17:25:00'),
(325, 'Final Argentina Femenino 2023', 6, 'Perez Mosqueda, Valeria Ritzabeth', '1', 'Quiroga Ortiz, Helena', '1', NULL, '2023-11-25 17:25:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneos`
--

CREATE TABLE `torneos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `rondas` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `ubicacion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `torneos`
--

INSERT INTO `torneos` (`id`, `nombre`, `rondas`, `fechaInicio`, `fechaFinal`, `ubicacion`) VALUES
(2, 'Final Argentina Femenino 2023', 9, '2023-11-20', '2023-11-28', 'Argentina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contrasena` varchar(32) NOT NULL,
  `elo` varchar(11) NOT NULL,
  `rol` varchar(10) NOT NULL,
  `K` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `contrasena`, `elo`, `rol`, `K`) VALUES
(1, 'a', 'a@a.com', '0cc175b9c0f1b6a831c399e269772661', '1498.38', 'admin', 40),
(2, 'Colo', 'santiagocuria1711@gmail.com', 'f78f014cec7e9a235589729f020ddfbb', '1488.55', 'admin', 40),
(3, 'gaganeitor', 'ocamposian7@gmail.com', 'a5aebf99ef352adb52bd2a62df8b4367', '1492.35', 'user', 40),
(4, 'Elpuntanopijudo', 'vaguilarp107@gmail.com', '7cae74dce70543d6bbbebf900ced239f', '1495.2', 'user', 40);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `apuestas`
--
ALTER TABLE `apuestas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Kapuesta` (`usuario`,`id_partida`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_nombre` (`nombre`);

--
-- Indices de la tabla `jugadorestorneo`
--
ALTER TABLE `jugadorestorneo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_nombre_torneo` (`nombreJugador`,`id_torneo`);

--
-- Indices de la tabla `mercado`
--
ALTER TABLE `mercado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rondas`
--
ALTER TABLE `rondas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `torneos`
--
ALTER TABLE `torneos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_nombre_torneo` (`nombre`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acciones`
--
ALTER TABLE `acciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `apuestas`
--
ALTER TABLE `apuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT de la tabla `jugadorestorneo`
--
ALTER TABLE `jugadorestorneo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT de la tabla `mercado`
--
ALTER TABLE `mercado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rondas`
--
ALTER TABLE `rondas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326;

--
-- AUTO_INCREMENT de la tabla `torneos`
--
ALTER TABLE `torneos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
