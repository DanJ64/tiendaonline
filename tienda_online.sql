-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-02-2019 a las 05:03:32
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `anno` int(11) NOT NULL,
  `genero` varchar(100) NOT NULL,
  `formato` varchar(50) NOT NULL,
  `precio` float NOT NULL,
  `unidades` int(11) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `muestra` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `anno`, `genero`, `formato`, `precio`, `unidades`, `imagen`, `descripcion`, `muestra`) VALUES
(1, 'Jinjer - Micro', 2019, 'Metal', 'CD', 8.99, 20, 'web/resources/img_productos/jinjer_micro.jpg', '', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/QfhLma7gtPg\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>'),
(3, 'Nemix - The Planet', 2015, 'DarkSynth', 'Digital', 5, 24, 'web/resources/img_productos/nemix.jpg', '', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/xagptShRJlI\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>'),
(4, 'Skunk D.F. - Esencia', 2007, 'Rock', 'CD', 7.9, 4, 'web/resources/img_productos/uskunk5b35d.jpg', '', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/q_4v_9ERjeY\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>'),
(6, 'Cult of Luna & Julie Christmas - Cygnus (Perturbator remix)', 2018, 'Synth', 'Digital', 0.5, 0, 'web/resources/img_productos/perturbator-remix.jpg', '', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/gv7hFegk14o\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `correo` varchar(100) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`correo`, `nombre`, `apellidos`, `fechaNacimiento`, `telefono`, `direccion`, `passwd`, `rol`) VALUES
('correo@correo.com', 'correo', 'correo', '2019-01-10', 123456789, 'correo', 'piruleta', 'user'),
('dan@dan', 'Dan', 'J', '1992-06-04', 987654321, 'Calle de la piruleta', 'piruleta', 'admin'),
('l@l', 'lol', 'lol', '2019-01-31', 1234, 'lol', 'lol', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
