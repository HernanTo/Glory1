-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-10-2023 a las 09:11:42
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bill_info`
--

CREATE TABLE `bill_info` (
  `id` int(11) NOT NULL,
  `can` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bill_info`
--

INSERT INTO `bill_info` (`id`, `can`) VALUES
(1, 2);

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizainfo`
--

CREATE TABLE `cotizainfo` (
  `id` int(11) NOT NULL,
  `can` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cotizainfo`
--

INSERT INTO `cotizainfo` (`id`, `can`) VALUES
(1, 13);

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
(323, 1, 2, 'Se creó un nuevo usuario', '2023-10-11 01:54:39', 2),
(324, 1, 2, 'Se creó un nuevo producto', '2023-10-11 01:56:23', 1),
(325, 1, 2, 'Se creó una nueva factura', '2023-10-11 01:56:37', 3),
(326, 1, 1, 'Se editarón datos del producto 1', '2023-10-11 01:58:28', 1),
(327, 1, 2, 'Se creó una nueva cotización', '2023-10-11 02:00:40', 6),
(328, 1, 2, 'Se creó una nueva cotización', '2023-10-11 02:00:54', 6),
(329, 1, 2, 'Se creó una nueva cotización', '2023-10-11 02:04:23', 6),
(330, 1, 2, 'Se creó una nueva cotización', '2023-10-11 02:07:22', 6);

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_has_category`
--

CREATE TABLE `product_has_category` (
  `id_product` int(11) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `price` decimal(10,0) NOT NULL,
  `service` int(11) NOT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service_has_bill`
--

CREATE TABLE `service_has_bill` (
  `id_bill` int(11) DEFAULT NULL,
  `id_service` int(11) DEFAULT NULL
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
(176, 80864878, 'Sebastián', 'Camilo ', 'Fajardo ', 'Torres', 'sebasfajar', '$2y$10$QeD/eIwgF7frOQMgS05d7ujQoJl9oh128BB0giFlqNtG6R9KW6huy', 3102452756, 'km4 variante cajica-zipaquira Reserva del lago TO7 APTO502', '0', '0', 'sebastianfajardof@gmail.com', 'default.png', 0);

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
(176, 1, 1);

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
-- Indices de la tabla `bill_info`
--
ALTER TABLE `bill_info`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `cotizainfo`
--
ALTER TABLE `cotizainfo`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `service_FK_1` (`service`);

--
-- Indices de la tabla `service_has_bill`
--
ALTER TABLE `service_has_bill`
  ADD KEY `service_has_bill_FK` (`id_bill`),
  ADD KEY `service_has_bill_FK_1` (`id_service`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `bill_info`
--
ALTER TABLE `bill_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `cotizainfo`
--
ALTER TABLE `cotizainfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=331;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

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
-- Filtros para la tabla `service_has_bill`
--
ALTER TABLE `service_has_bill`
  ADD CONSTRAINT `service_has_bill_FK` FOREIGN KEY (`id_bill`) REFERENCES `bill` (`id`),
  ADD CONSTRAINT `service_has_bill_FK_1` FOREIGN KEY (`id_service`) REFERENCES `service` (`id`);

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
