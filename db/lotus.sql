-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 15-09-2023 a las 19:21:25
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
  `state_page` varchar(100) DEFAULT NULL,
  `iva` varchar(100) DEFAULT NULL,
  `descuento` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bill`
--

INSERT INTO `bill` (`id`, `num_fact`, `total_prices`, `subtotal`, `amount`, `date`, `vendedor`, `cliente`, `state`, `state_page`, `iva`, `descuento`) VALUES
(50, '20208058', 72000, 72000, 3, '2023-09-06', 6, 174, 1, 'false', 'false', 8000);

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
  `descuento` varchar(10) DEFAULT NULL,
  `prices_mano_obra` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bill_has_product`
--

INSERT INTO `bill_has_product` (`id_bill`, `id_product`, `price_u`, `amount`, `prices_total`, `mano_obra`, `descuento`, `prices_mano_obra`, `date`) VALUES
(50, 57, 10000, 3, 80000, 1, '0.1', 50000, '2023-09-06');

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
  `descuento` decimal(10,0) DEFAULT NULL,
  `iva` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cotizaciones`
--

INSERT INTO `cotizaciones` (`id`, `num_fact`, `total_prices`, `subtotal`, `amount`, `date`, `vendedor`, `cliente`, `state`, `descuento`, `iva`) VALUES
(13, '16439067', 23800, 20000, 1, '2023-09-08', 6, 173, 1, 0, 'true');

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
  `descuento` varchar(100) DEFAULT NULL,
  `date` date NOT NULL,
  `prices_mano_obra` int(11) DEFAULT NULL,
  `mano_obra` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cotizaciones_has_product`
--

INSERT INTO `cotizaciones_has_product` (`id_cotizacion`, `id_product`, `price_u`, `amount`, `stock`, `prices_total`, `descuento`, `date`, `prices_mano_obra`, `mano_obra`) VALUES
(13, 57, 10000, 1, 1, 10000, '0', '2023-09-08', 10000, 1);

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
(246, 1, 1, 'Se editarón datos del usuario 1025525175', '2023-08-24 16:54:49', 2),
(247, 1, 1, 'Se edito el rol del usuario', '2023-08-24 16:56:59', 2),
(248, 1, 1, 'Se edito el rol del usuario', '2023-08-24 17:07:06', 2),
(249, 1, 2, 'Se creó un nuevo producto', '2023-08-28 13:55:16', 1),
(250, 1, 2, 'Se creó un nuevo usuario', '2023-08-31 16:05:28', 2),
(251, 1, 2, 'Se creó un nuevo usuario', '2023-08-31 16:09:23', 2),
(252, 1, 2, 'Se creó un nuevo usuario', '2023-08-31 16:11:51', 2),
(253, 1, 2, 'Se creó un nuevo usuario', '2023-08-31 16:11:58', 2),
(254, 1, 2, 'Se creó un nuevo usuario', '2023-08-31 16:14:29', 2),
(255, 1, 1, 'Se editarón datos del producto 747474', '2023-09-04 15:33:46', 1),
(256, 1, 2, 'Se creó una nueva factura', '2023-09-06 11:04:28', 3),
(257, 1, 2, 'Se creó una nueva factura', '2023-09-06 11:12:32', 3),
(258, 1, 2, 'Se creó una nueva factura', '2023-09-06 11:13:38', 3),
(259, 1, 1, 'Se editarón datos del producto 747474', '2023-09-06 12:54:56', 1),
(260, 1, 2, 'Se creó una nueva factura', '2023-09-06 13:12:25', 3),
(261, 1, 2, 'Se creó una nueva factura', '2023-09-06 15:15:19', 3),
(262, 1, 2, 'Se creó una nueva factura', '2023-09-06 15:22:23', 3),
(263, 1, 2, 'Se creó una nueva factura', '2023-09-06 15:23:31', 3),
(264, 1, 2, 'Se creó una nueva factura', '2023-09-06 15:23:54', 3),
(265, 1, 2, 'Se creó una nueva factura', '2023-09-06 15:24:26', 3),
(266, 1, 2, 'Se creó una nueva factura', '2023-09-06 15:24:52', 3),
(267, 1, 2, 'Se creó una nueva factura', '2023-09-06 15:25:08', 3),
(268, 1, 2, 'Se creó una nueva factura', '2023-09-06 15:26:58', 3),
(269, 1, 2, 'Se creó una nueva factura', '2023-09-06 15:27:48', 3),
(270, 1, 2, 'Se creó una nueva factura', '2023-09-06 15:28:40', 3),
(271, 1, 2, 'Se creó una nueva factura', '2023-09-06 15:47:42', 3),
(272, 1, 2, 'Se creó una nueva factura', '2023-09-06 15:50:49', 3),
(273, 1, 2, 'Se creó una nueva factura', '2023-09-06 15:52:13', 3),
(274, 1, 2, 'Se creó una nueva factura', '2023-09-06 15:54:07', 3),
(275, 1, 2, 'Se creó una nueva factura', '2023-09-06 15:55:06', 3),
(276, 1, 2, 'Se creó una nueva factura', '2023-09-06 15:55:55', 3),
(277, 1, 2, 'Se creó una nueva factura', '2023-09-06 15:56:06', 3),
(278, 1, 2, 'Se creó una nueva factura', '2023-09-06 15:56:33', 3),
(279, 1, 2, 'Se creó una nueva factura', '2023-09-06 15:56:58', 3),
(280, 1, 2, 'Se creó una nueva factura', '2023-09-06 15:58:12', 3),
(281, 1, 2, 'Se creó una nueva cotización', '2023-09-06 16:10:33', 6),
(282, 1, 2, 'Se creó una nueva cotización', '2023-09-08 08:57:55', 6),
(283, 1, 2, 'Se creó una nueva cotización', '2023-09-08 09:36:21', 6),
(284, 1, 2, 'Se creó una nueva cotización', '2023-09-08 09:45:28', 6),
(285, 1, 2, 'Se creó una nueva cotización', '2023-09-08 09:47:28', 6),
(286, 1, 2, 'Se creó un nuevo usuario', '2023-09-13 09:22:17', 2),
(287, 1, 2, 'Se ha creado un servicio', '2023-09-15 12:14:14', 4);

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
(57, 747474, '67464634', 'Prueba 1', 10000, 156, 0, 1, 'default.png', 7550, 0);

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
(57, 6);

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
(6, 'Trabajador'),
(7, 'Servicios');

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

--
-- Volcado de datos para la tabla `service`
--

INSERT INTO `service` (`id`, `date`, `detail`, `referencia`, `price`, `iva`, `customer`, `service`, `state`, `state_page`) VALUES
(1, '2023-09-15', 'Cambio de llanta', 84845819, 10000, 'true', 5, 6, 1, 'false'),
(2, '2023-09-15', 'Cambio de llanta', 84845819, 10000, 'true', 5, 6, 1, 'false');

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
(5, 452445, 'Andres ', '', 'Zuliaga', '', 'andrezulia', '$2y$10$IrXHSTMykggLkymDAWiuJ.q0c5xQNX.7JgSyjOBvU4vdJTtAjaQ0G', 3132093326, 'Calarca', 'MJO 765', 'Spark', 'Andres@gmail.com', 'default.png', 0),
(6, 3343455, 'Pedro', '', 'Bueno', '', 'pedrobueno', '$2y$10$T2fbM899BfarNhmflHiTrezz4lDEjLYQ8rgDewdkD.0YLcz7nAAZ.', 3242332, 'Medellín', '', '', 'asdf@gmail.com', 'default.png', 0),
(7, 3424355, 'Martin', '', 'Lucamel', '', 'martilucam', '$2y$10$PU/XcGoHltTcX.d/yB1qOOd.S/PIFGC5DxWOA9GG6HFWSqL1aI6xS', 323432, 'Bogotá', '', '', 'martin@gmail.com', 'default.png', 0),
(20, 84, 'Tammy', 'Betteann', 'Hinkens', 'Bussen', 'bbussenc', 'cV0$X8xF8}EBk', 923, '7 5th Drive', '', '', 'bbussenc@parallels.com', 'default.png', 0),
(170, 64246673944, 'Diego', '', 'Durán', '', 'diegoduran', '$2y$10$f9IF.tnQjdulRB5lGxtbQ.PQ7fEnTfbZYc9LKC9UkvoeOQzK8w1FO', 3046293354, 'Kra 10B', '', '', 'duran@gmail.com', 'default.png', 0),
(173, 7777442334, 'Juan', 'Alberto', 'Goméz', 'Bolaño', 'juangomez', '$2y$10$Oe3qeCJ6Ci3Q8WnEg962TOrUxiy5r/xt1QFtXxLZNYfhCRM5MXsXi', 320301898, 'Kra 10', 'hfg565', 'dfds', 'bolano@gmail.com', 'default.png', 0),
(174, 8988883745, 'Andres', '', 'Calamaro', '', 'andrecalam', '$2y$10$inIhPmLnvrAvvt0qY9Ew6.BK/YdxL4U30z4.nZkKX7/pdaort3JaC', 111111, 'Argentina', 'sdf444', 'fgfd', 'calamaro@gmail.com', 'default.png', 0),
(175, 1025525175, 'Andrés', 'Santiago', 'Flores', 'Ruiz', 'andreflore', '$2y$10$wAghcuU00PpDBE5ToNszPuhN7iPeCsXTbygjsFTz3Mv5DNvshQSwu', 3132093326, 'Cra. 52 #44c55, Bogotá', '0', '0', 'andressantiagofloresruiz@ciudadedubosa.com', 'default.png', 0),
(176, 80864878, 'Sebastián ', 'Camilo ', 'Fajardo ', 'Torres', 'sebasfajar', '$2y$10$QeD/eIwgF7frOQMgS05d7ujQoJl9oh128BB0giFlqNtG6R9KW6huy', 3102452756, 'x', NULL, NULL, 'sebastianfajardof@gmail.com', 'default.png', 0),
(177, 123, 'Prueba', '', '1', '', 'prueb1', '$2y$10$wHVneJMW1s80MnGpU8kwgODtAMVYIz8yC3m35nhOkZ.eGfzp5ao.W', 1234, '', NULL, NULL, 'prueba@gmail.com', '../../assets/img/profilePictures/default.png', 0),
(178, 123, 'Prueba', '', '1', '', 'prueb1', '$2y$10$vd2h97a/y885mLmcU0/k1.ovoRKCfAnHHjlVjnnpV7CGYN2SnmbGy', 1234, '', NULL, NULL, 'prueba@gmail.com', '../../assets/img/profilePictures/default.png', 0),
(179, 22222222, 'Servicios', '', 'Prueba', '', 'serviprueb', '$2y$10$qgTTInTWGLAMraSmZCZRQuh/W/4FWWpk63.wIO/.yi5gIH0tidfSe', 22222222, '', NULL, NULL, 'serivicios@lotus.com', 'default.png', 0);

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
(5, 5, 1),
(170, 6, 1),
(173, 5, 1),
(174, 5, 1),
(175, 4, 1),
(176, 1, 1),
(177, 5, 1),
(178, 5, 1),
(179, 7, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

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
