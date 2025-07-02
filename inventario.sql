-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 24-06-2025 a las 03:11:28
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoria_id` int NOT NULL,
  `categoria_nombre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `categoria_ubicacion` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `categoria_nombre`, `categoria_ubicacion`) VALUES
(8, 'bodega', 'pasillo1'),
(9, 'licoreria', 'pasillo 1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `detalle_id` int NOT NULL,
  `venta_id` int DEFAULT NULL,
  `producto_id` int DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`detalle_id`, `venta_id`, `producto_id`, `cantidad`, `precio_unitario`, `subtotal`) VALUES
(1, 1, 13, 1, 3.00, NULL),
(2, 2, 13, 2, 3.00, NULL),
(3, 2, 16, 2, 30.00, NULL),
(4, 3, 13, 2, 3.00, NULL),
(5, 3, 16, 2, 30.00, NULL),
(6, 4, 17, 1, 5.00, NULL),
(7, 5, 17, 1, 5.00, NULL),
(8, 5, 14, 1, 80.00, NULL),
(9, 6, 17, 1, 5.00, NULL),
(10, 6, 14, 1, 80.00, NULL),
(11, 7, 17, 1, 5.00, NULL),
(12, 7, 14, 1, 80.00, NULL),
(13, 8, 17, 1, 5.00, NULL),
(14, 8, 14, 1, 80.00, NULL),
(15, 8, 16, 1, 30.00, NULL),
(16, 9, 17, 1, 5.00, NULL),
(17, 9, 14, 1, 80.00, NULL),
(18, 9, 16, 1, 30.00, NULL),
(19, 9, 13, 1, 3.00, NULL),
(20, 10, 13, 3, 3.00, NULL),
(21, 11, 13, 1, 3.00, NULL),
(22, 12, 13, 1, 3.00, NULL),
(23, 12, 17, 1, 5.00, NULL),
(24, 13, 13, 1, 3.00, NULL),
(25, 15, 13, 1, 3.00, NULL),
(26, 16, 13, 1, 3.00, NULL),
(27, 16, 13, 1, 3.00, NULL),
(28, 17, 13, 1, 3.00, NULL),
(29, 17, 13, 1, 3.00, NULL),
(30, 17, 18, 1, 9.00, NULL),
(35, 22, 13, 1, 3.00, NULL),
(36, 23, 13, 1, 3.00, NULL),
(37, 23, 13, 2, 3.00, NULL),
(38, 24, 17, 1, 5.00, NULL),
(39, 25, 17, 1, 5.00, NULL),
(40, 25, 17, 1, 5.00, NULL),
(41, 26, 13, 4, 3.00, NULL),
(42, 28, 13, 1, 3.00, NULL),
(43, 29, 13, 2, 3.00, NULL),
(44, 30, 16, 2, 30.00, NULL),
(45, 30, 13, 1, 3.00, NULL),
(46, 30, 18, 2, 9.00, NULL),
(47, 30, 15, 2, 220.00, NULL),
(48, 31, 13, 1, 3.00, NULL),
(49, 31, 17, 2, 5.00, NULL),
(50, 32, 13, 2, 3.00, NULL),
(51, 33, 13, 2, 3.00, NULL),
(52, 33, 17, 1, 5.00, NULL),
(53, 34, 13, 2, 3.00, NULL),
(54, 35, 13, 1, 3.00, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `producto_id` int NOT NULL,
  `producto_codigo` varchar(70) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `producto_nombre` varchar(70) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `producto_precio` decimal(30,0) NOT NULL,
  `producto_stock` int NOT NULL,
  `producto_foto` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `categoria_id` int NOT NULL,
  `usuario_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`producto_id`, `producto_codigo`, `producto_nombre`, `producto_precio`, `producto_stock`, `producto_foto`, `categoria_id`, `usuario_id`) VALUES
(13, '12456431632642614', 'cocacola', 3, 63, 'cocacola_86.png', 8, 12),
(14, '9045376596475689659', 'JAGERMEISTER', 80, 0, 'JAGERMEISTER_30.png', 9, 12),
(15, '908475673892658793467843', 'GOLD LABEL', 220, 2, 'GOLD_LABEL_39.png', 9, 12),
(16, '34213423523452352', 'Ron cartavio', 30, 12, 'Ron_cartavio_89.png', 9, 12),
(17, '21386523675231', 'chesee tris', 5, 17, 'chesee_tris_10.png', 8, 12),
(18, '3286662329336', 'piqueo snax', 9, 30, 'piqueo_snax_46.png', 8, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int NOT NULL,
  `rol_nombre` varchar(50) COLLATE utf8mb3_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `rol_nombre`) VALUES
(1, 'admin'),
(2, 'empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int NOT NULL,
  `usuario_nombre` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario_apellido` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario_usuario` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario_clave` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario_email` varchar(70) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `rol_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_usuario`, `usuario_clave`, `usuario_email`, `rol_id`) VALUES
(1, 'daniel', 'ramirez', 'dannyilli', '$2y$10$iOR2hi/1pzkI9rIMHzGjc.dJx3C2KVnPYKWES8tXmg7monEYeXJx6', 'dani@gmail.com', 1),
(2, 'abel', 'inche', 'eldulce11', '$2y$10$r4nISasgSJB00eOH52RLs.ctH.Mq2MTnZQI.pa/0LK3hahdXEOlBG', '', 2),
(4, 'renzo', 'rojas', 'renzobich', '$2y$10$MpHZMSkAtbL8477EKlc9hOEhU5vn3N7aZF6jmGgDX3fNrDzab6zPy', '', 1),
(5, 'jair', 'chavez', 'cabellobonito', '$2y$10$NsEu.lNIpHMsxn1nwOZtCOjy5C2RU00s.ZtjPUSAgLih5jI4s8mdO', '', 1),
(10, 'Leonel', 'Paucara', 'leonel', '$2y$10$yNH1.SrARO/LP/xvX.IbzejMOZq8BguJS.ElDnrTqrrmr6xV3fyF.', '', 2),
(11, 'dey', 'Estela', 'deycielo', '$2y$10$300Vqee.4mYZvctHWvf7IudF/Yy.HPW4y.y3XPlwzuhTnDtB9p3FC', '', 2),
(12, 'Jaqueline', 'Poma', 'Admin', '$2y$10$TUgMu/QLFMvL1bsWS44MpuxkaJUKYmj2IT26M2Dz73BcvijakTUPC', '', 1),
(15, 'Williams', 'Arce', 'warcea', '$2y$10$Cn0.soeKfP/uCLEz.X2KKeiX9WzMkh7zH.uo1Ci.jz5E52ecGhPpO', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `venta_id` int NOT NULL,
  `usuario_id` int DEFAULT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `igv` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`venta_id`, `usuario_id`, `fecha`, `subtotal`, `igv`, `total`) VALUES
(1, NULL, '2025-06-21 18:24:31', NULL, NULL, 0.00),
(2, NULL, '2025-06-21 18:34:53', NULL, NULL, 0.00),
(3, NULL, '2025-06-22 18:35:01', NULL, NULL, 0.00),
(4, NULL, '2025-06-22 18:36:25', NULL, NULL, 0.00),
(5, NULL, '2025-06-22 18:36:34', NULL, NULL, 0.00),
(6, NULL, '2025-06-22 18:39:06', NULL, NULL, 85.00),
(7, NULL, '2025-06-22 18:44:48', NULL, NULL, 85.00),
(8, NULL, '2025-06-22 18:45:11', NULL, NULL, 115.00),
(9, NULL, '2025-06-22 18:47:48', NULL, NULL, 118.00),
(10, NULL, '2025-06-22 18:56:32', NULL, NULL, 9.00),
(11, NULL, '2025-06-22 19:03:42', NULL, NULL, 3.00),
(12, NULL, '2025-06-22 19:10:53', NULL, NULL, 8.00),
(13, NULL, '2025-06-22 19:12:43', NULL, NULL, 3.00),
(15, 1, '2025-06-22 19:14:22', NULL, NULL, 3.00),
(16, NULL, '2025-06-22 19:15:56', NULL, NULL, 6.00),
(17, NULL, '2025-06-22 19:18:20', NULL, NULL, 15.00),
(22, NULL, '2025-06-22 19:41:18', NULL, NULL, 3.00),
(23, NULL, '2025-06-22 19:44:31', NULL, NULL, 9.00),
(24, NULL, '2025-06-22 19:52:32', NULL, NULL, 5.00),
(25, NULL, '2025-06-22 19:58:10', NULL, NULL, 10.00),
(26, NULL, '2025-06-22 20:01:15', NULL, NULL, 12.00),
(27, NULL, '2025-06-22 20:06:25', NULL, NULL, 0.00),
(28, 5, '2025-06-22 20:50:14', NULL, NULL, 3.00),
(29, 5, '2025-06-22 21:56:09', NULL, NULL, 6.00),
(30, 5, '2025-06-22 22:21:51', NULL, NULL, 521.00),
(31, 5, '2025-06-22 22:59:19', NULL, NULL, 13.00),
(32, 5, '2025-06-22 23:14:02', 6.00, 1.08, 7.08),
(33, 5, '2025-06-22 23:20:43', 11.00, 1.98, 12.98),
(34, 5, '2025-06-22 23:23:23', 5.08, 0.92, 6.00),
(35, 5, '2025-06-23 15:53:11', 2.54, 0.46, 3.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`detalle_id`),
  ADD KEY `venta_id` (`venta_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`venta_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `detalle_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `producto_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `venta_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`venta_id`),
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
