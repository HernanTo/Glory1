-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 18-09-2023 a las 20:01:38
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lotus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `num_fact` varchar(11) NOT NULL,
  `total_prices` decimal(10,0) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `vendedor` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `state_page` varchar(100) NOT NULL,
  `iva` varchar(100) NOT NULL,
  `descuento` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bill`
--

INSERT INTO `bill` (`id`, `num_fact`, `total_prices`, `subtotal`, `amount`, `date`, `vendedor`, `cliente`, `state`, `state_page`, `iva`, `descuento`) VALUES
(27, '65595004', 1386350, 1165000, 5, '2023-09-15', 176, 182, 1, 'true', 'true', 0),
(28, '3349063', 904400, 760000, 1, '2023-09-18', 1, 174, 1, 'false', 'true', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bill_has_product`
--

CREATE TABLE `bill_has_product` (
  `id_bill` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `price_u` decimal(11,0) NOT NULL,
  `amount` int(11) NOT NULL,
  `prices_total` decimal(11,0) NOT NULL,
  `mano_obra` int(11) NOT NULL,
  `descuento` varchar(10) NOT NULL,
  `prices_mano_obra` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bill_has_product`
--

INSERT INTO `bill_has_product` (`id_bill`, `id_product`, `price_u`, `amount`, `prices_total`, `mano_obra`, `descuento`, `prices_mano_obra`, `date`) VALUES
(27, 55, 520000, 1, 520000, 0, '0', 0, '2023-09-15'),
(27, 56, 295000, 1, 295000, 0, '0', 0, '2023-09-15'),
(27, 59, 160000, 1, 160000, 0, '0', 0, '2023-09-15'),
(27, 60, 95000, 1, 95000, 0, '0', 0, '2023-09-15'),
(27, 61, 95000, 1, 95000, 0, '0', 0, '2023-09-15'),
(28, 57, 760000, 1, 760000, 0, '0', 0, '2023-09-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `category`, `state`) VALUES
(4, 'Motor', 1),
(5, 'Caja', 1),
(6, 'Suspensión', 1),
(7, 'Exteriores', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones`
--

CREATE TABLE `cotizaciones` (
  `id` int(11) NOT NULL,
  `num_fact` varchar(11) NOT NULL,
  `total_prices` decimal(10,0) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `vendedor` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `descuento` decimal(10,0) NOT NULL,
  `iva` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cotizaciones`
--

INSERT INTO `cotizaciones` (`id`, `num_fact`, `total_prices`, `subtotal`, `amount`, `date`, `vendedor`, `cliente`, `state`, `descuento`, `iva`) VALUES
(3, '33961824', 969850, 815000, 2, '2023-08-31', 176, 177, 1, 0, ''),
(4, '10943015', 618800, 520000, 1, '2023-08-31', 1, 5, 1, 0, ''),
(5, '95719409', 1523200, 1280000, 2, '2023-09-15', 176, 180, 1, 0, ''),
(6, '39603037', 295000, 295000, 1, '2023-09-18', 7, 173, 1, 0, 'false');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones_has_product`
--

CREATE TABLE `cotizaciones_has_product` (
  `id_cotizacion` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `price_u` decimal(11,0) NOT NULL,
  `amount` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `prices_total` decimal(11,0) NOT NULL,
  `descuento` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `prices_mano_obra` int(11) NOT NULL,
  `mano_obra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cotizaciones_has_product`
--

INSERT INTO `cotizaciones_has_product` (`id_cotizacion`, `id_product`, `price_u`, `amount`, `stock`, `prices_total`, `descuento`, `date`, `prices_mano_obra`, `mano_obra`) VALUES
(3, 55, 520000, 1, 1, 520000, '0', '2023-08-31', 0, 0),
(3, 56, 295000, 1, 1, 295000, '0', '2023-08-31', 0, 0),
(4, 55, 520000, 1, 1, 520000, '0', '2023-08-31', 0, 0),
(5, 57, 760000, 1, 1, 760000, '0', '2023-09-15', 0, 0),
(5, 58, 520000, 1, 1, 520000, '0', '2023-09-15', 0, 0),
(6, 56, 295000, 1, 0, 295000, '0', '2023-09-18', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `descr` varchar(200) NOT NULL,
  `date` datetime NOT NULL,
  `model` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`id`, `user`, `type`, `descr`, `date`, `model`) VALUES
(242, 176, 2, 'Se creó un nuevo usuario', '2023-08-31 15:55:38', 2),
(243, 176, 2, 'Se creó un nuevo usuario', '2023-08-31 15:57:49', 2),
(244, 176, 2, 'Se creó un nuevo usuario', '2023-08-31 15:58:42', 2),
(245, 176, 2, 'Se creó un nuevo usuario', '2023-08-31 15:59:57', 2),
(246, 176, 1, 'Se editarón datos del usuario 1234', '2023-08-31 16:00:23', 2),
(247, 1, 2, 'Se creó un nuevo usuario', '2023-08-31 16:01:52', 2),
(248, 176, 2, 'Se creó un nuevo producto', '2023-08-31 16:06:49', 1),
(249, 176, 2, 'Se creó un nuevo producto', '2023-08-31 16:12:28', 1),
(250, 176, 2, 'Se creó una nueva cotización', '2023-08-31 16:15:16', 6),
(251, 1, 2, 'Se creó un nuevo usuario', '2023-08-31 16:17:48', 2),
(252, 1, 3, 'Se eliminó al usuario 178', '2023-08-31 16:19:17', 2),
(253, 1, 2, 'Se creó un nuevo usuario', '2023-08-31 16:19:47', 2),
(254, 1, 2, 'Se creó una nueva cotización', '2023-08-31 16:30:09', 6),
(255, 1, 1, 'Se editarón datos del producto 1', '2023-09-04 15:39:44', 1),
(256, 176, 2, 'Se creó un nuevo producto', '2023-09-15 08:43:07', 1),
(257, 176, 2, 'Se creó un nuevo producto', '2023-09-15 08:44:20', 1),
(258, 176, 2, 'Se creó un nuevo usuario', '2023-09-15 08:47:46', 2),
(259, 176, 2, 'Se creó un nuevo usuario', '2023-09-15 08:48:31', 2),
(260, 176, 2, 'Se creó una nueva cotización', '2023-09-15 08:49:45', 6),
(261, 176, 2, 'Se creó un nuevo usuario', '2023-09-15 12:24:03', 2),
(262, 176, 1, 'Se editarón datos del usuario 80864878', '2023-09-15 12:24:33', 2),
(263, 176, 2, 'Se creó un nuevo producto', '2023-09-15 12:29:12', 1),
(264, 176, 2, 'Se creó un nuevo producto', '2023-09-15 12:30:24', 1),
(265, 176, 2, 'Se creó un nuevo producto', '2023-09-15 12:31:13', 1),
(266, 176, 2, 'Se creó una nueva factura', '2023-09-15 12:32:13', 3),
(267, 1, 1, 'Se editarón datos del usuario 80864878', '2023-09-18 09:36:29', 2),
(268, 1, 1, 'Se editarón datos del usuario 80864878', '2023-09-18 09:38:22', 2),
(269, 1, 2, 'Se creó una nueva factura', '2023-09-18 12:25:37', 3),
(270, 1, 2, 'Se creó una nueva cotización', '2023-09-18 12:58:56', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `Barcode` int(11) NOT NULL,
  `num_repuesto` varchar(150) NOT NULL,
  `name_product` varchar(100) NOT NULL,
  `prices` decimal(20,0) NOT NULL,
  `amount` int(11) NOT NULL,
  `min_stock` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `num_photo` int(11) NOT NULL,
  `product_cost` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `Barcode`, `num_repuesto`, `name_product`, `prices`, `amount`, `min_stock`, `state`, `photo`, `num_photo`, `product_cost`) VALUES
(55, 1, '0001', 'Parrilla Frontal Glory 580', 520000, 0, 20, 1, '7832product.jpg', 7832, 0),
(56, 2, '0002', 'Rejilla inferior del parachoques', 295000, 0, 100, 1, '3300product.jpg', 3300, 0),
(57, 3, '0003', 'Amortiguadores Delanteros Glory 580', 760000, 9, 3, 1, 'default.png', 6626, 0),
(58, 4, '0004', 'Amortiguadores traseros Glory 580', 520000, 10, 3, 1, 'default.png', 2493, 0),
(59, 5, '0005', 'Placa decorativa del componente superior Glory 580', 160000, 0, 1, 1, 'default.png', 7489, 0),
(60, 6, '0006', 'Decoración del faro delantero IZQUIERDO Glory 580', 95000, 0, 1, 1, 'default.png', 5738, 0),
(61, 7, '0007', 'Decoración del faro delantero DERECHO', 95000, 0, 1, 1, 'default.png', 2178, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_has_category`
--

CREATE TABLE `product_has_category` (
  `id_product` int(11) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `product_has_category`
--

INSERT INTO `product_has_category` (`id_product`, `id_category`) VALUES
(56, 7),
(55, 7),
(57, 6),
(58, 6),
(59, 7),
(60, 7),
(61, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Administrador'),
(4, 'Gerente'),
(5, 'Cliente'),
(6, 'Trabajador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `detail` varchar(500) NOT NULL,
  `referencia` int(11) DEFAULT NULL,
  `price` decimal(10,0) NOT NULL,
  `iva` varchar(50) DEFAULT NULL,
  `customer` int(11) NOT NULL,
  `service` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `state_page` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `cedula` bigint(10) NOT NULL,
  `ft_name` varchar(60) NOT NULL,
  `sd_name` varchar(60) NOT NULL,
  `fi_lastname` varchar(60) NOT NULL,
  `sc_lastname` varchar(60) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `address` varchar(150) DEFAULT NULL,
  `placa` varchar(20) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `passchange` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `cedula`, `ft_name`, `sd_name`, `fi_lastname`, `sc_lastname`, `nickname`, `password`, `phone`, `address`, `placa`, `modelo`, `email`, `photo`, `passchange`) VALUES
(1, 1022330332, 'Hernan', '', 'Torres', 'Rodríguez', 'hernanto', '$2y$10$LvIrzQjLWfOmaweN86FIae.JldEALRtKiK1hOYzmiwFL5VCmMOWBW', 3132093326, 'Kra 90B', '', '', 'hernanto.ott@outlook.com', '1022330332.jpg', 1),
(6, 3343455, 'Pedro', '', 'Bueno', '', 'pedrobueno', '$2y$10$T2fbM899BfarNhmflHiTrezz4lDEjLYQ8rgDewdkD.0YLcz7nAAZ.', 3242332, 'Medellín', '', '', 'asdf@gmail.com', 'default.png', 0),
(7, 3424355, 'Martin', '', 'Lucamel', '', 'martilucam', '$2y$10$PU/XcGoHltTcX.d/yB1qOOd.S/PIFGC5DxWOA9GG6HFWSqL1aI6xS', 323432, 'Bogotá', '', '', 'martin@gmail.com', 'default.png', 0),
(20, 84, 'Tammy', 'Betteann', 'Hinkens', 'Bussen', 'bbussenc', 'cV0$X8xF8}EBk', 923, '7 5th Drive', '', '', 'bbussenc@parallels.com', 'default.png', 0),
(170, 64246673944, 'Diego', '', 'Durán', '', 'diegoduran', '$2y$10$f9IF.tnQjdulRB5lGxtbQ.PQ7fEnTfbZYc9LKC9UkvoeOQzK8w1FO', 3046293354, 'Kra 10B', '', '', 'duran@gmail.com', 'default.png', 0),
(173, 7777442334, 'Juan', 'Alberto', 'Goméz', 'Bolaño', 'juangomez', '$2y$10$Oe3qeCJ6Ci3Q8WnEg962TOrUxiy5r/xt1QFtXxLZNYfhCRM5MXsXi', 320301898, 'Kra 10', 'hfg565', 'dfds', 'bolano@gmail.com', 'default.png', 0),
(174, 8988883745, 'Andres', '', 'Calamaro', '', 'andrecalam', '$2y$10$inIhPmLnvrAvvt0qY9Ew6.BK/YdxL4U30z4.nZkKX7/pdaort3JaC', 111111, 'Argentina', 'sdf444', 'fgfd', 'calamaro@gmail.com', 'default.png', 0),
(175, 1025525175, 'Andrés', 'Santiago', 'Flores', 'Ruiz', 'andreflore', '$2y$10$wAghcuU00PpDBE5ToNszPuhN7iPeCsXTbygjsFTz3Mv5DNvshQSwu', 3132093326, 'Cra. 52 #44c55, Bogotá', '0', '0', 'andressantiagofloresruiz@ciudadedubosa.com', '1025525175.jpeg', 0),
(176, 80864878, 'Sebastián', 'Camilo ', 'Fajardo ', 'Torres', 'sebasfajar', '$2y$10$QeD/eIwgF7frOQMgS05d7ujQoJl9oh128BB0giFlqNtG6R9KW6huy', 3102452756, 'km4 variante cajica-zipaquira Reserva del lago TO7 APTO502', '0', '0', 'sebastianfajardof@gmail.com', 'default.png', 0),
(177, 1234, 'Carlos', '', 'Martinez', '', 'carlomarti', '$2y$10$tVHWP0X4o1uUezhFikPlJupasQ5u6HL5GfscFiAydPPXNKM3QCETa', 3112379864, '', 'AAA123', 'GLORY 580', 'cotizacion@gmail.com', 'default.png', 0),
(180, 111111111, 'Jorge', '', 'Borda', '', 'jorgeborda', '$2y$10$WoifSLIUpQMJ2A9OQ/na8eXRAdVwSTgUGEQ0TqIp2IwEk1PN2Zj.G', 3013602637, '', NULL, NULL, '', 'default.png', 0),
(182, 8600791435, 'IND. MUSSGO', '', 'LTDA', '', 'ind. ltda', '$2y$10$NakHxTm25WCLostSQiLPvOUPSdc3WMFGk0/rAEY0pjsyQgvKhsvJm', 3112379864, '', NULL, NULL, 'proveedorese@mussgo.com.co', 'default.png', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_has_role`
--

CREATE TABLE `user_has_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_has_role`
--

INSERT INTO `user_has_role` (`user_id`, `role_id`, `state`) VALUES
(1, 1, 1),
(7, 6, 1),
(6, 6, 1),
(20, 6, 1),
(170, 6, 1),
(173, 5, 1),
(174, 5, 1),
(175, 1, 1),
(176, 1, 1),
(177, 5, 1),
(180, 5, 1),
(182, 5, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente` (`cliente`),
  ADD KEY `vendedor` (`vendedor`);

--
-- Indices de la tabla `bill_has_product`
--
ALTER TABLE `bill_has_product`
  ADD KEY `id_bill` (`id_bill`),
  ADD KEY `id_product` (`id_product`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente` (`cliente`),
  ADD KEY `vendedor` (`vendedor`);

--
-- Indices de la tabla `cotizaciones_has_product`
--
ALTER TABLE `cotizaciones_has_product`
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_cotizacion` (`id_cotizacion`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product_has_category`
--
ALTER TABLE `product_has_category`
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_category` (`id_category`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_FK` (`customer`),
  ADD KEY `service_FK_1` (`service`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_has_role`
--
ALTER TABLE `user_has_role`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `user_has_role` (`user_id`),
  ADD CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`vendedor`) REFERENCES `user_has_role` (`user_id`);

--
-- Filtros para la tabla `bill_has_product`
--
ALTER TABLE `bill_has_product`
  ADD CONSTRAINT `bill_has_product_ibfk_1` FOREIGN KEY (`id_bill`) REFERENCES `bill` (`id`),
  ADD CONSTRAINT `bill_has_product_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `cotizaciones_has_product`
--
ALTER TABLE `cotizaciones_has_product`
  ADD CONSTRAINT `cotizaciones_has_product_ibfk_1` FOREIGN KEY (`id_cotizacion`) REFERENCES `cotizaciones` (`id`);

--
-- Filtros para la tabla `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `product_has_category`
--
ALTER TABLE `product_has_category`
  ADD CONSTRAINT `product_has_category_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `product_has_category_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);

--
-- Filtros para la tabla `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_FK` FOREIGN KEY (`customer`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `user_has_role`
--
ALTER TABLE `user_has_role`
  ADD CONSTRAINT `user_has_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_has_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
