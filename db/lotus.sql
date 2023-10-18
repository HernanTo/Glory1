-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 18-10-2023 a las 14:12:44
-- Versión del servidor: 10.6.15-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u129291816_lotus`
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
(68, '00003', 300000, 300000, 6, '2023-10-18', 176, 186, 1, 'false', 'false', 0);

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
(68, 68, 55000, 1, 55000, 0, '0', 0, '2023-10-18'),
(68, 69, 65000, 1, 65000, 0, '0', 0, '2023-10-18');

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
(1, 3);

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
(13, '0014', 1130000, 1130000, 3, '2023-10-12', 176, 184, 1, 0, 'false');

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
(13, 65, 810000, 1, 1, 810000, '0', '2023-10-12', 0, 0),
(13, 66, 175000, 1, 1, 175000, '0', '2023-10-12', 0, 0),
(13, 67, 145000, 1, 1, 145000, '0', '2023-10-12', 0, 0);

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
(1, 14);

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
(331, 176, 2, 'Se creó un nuevo usuario', '2023-10-12 10:43:29', 2),
(332, 176, 2, 'Se creó un nuevo producto', '2023-10-12 10:57:14', 1),
(333, 176, 2, 'Se creó un nuevo producto', '2023-10-12 10:59:11', 1),
(334, 176, 2, 'Se creó un nuevo producto', '2023-10-12 11:06:00', 1),
(335, 176, 2, 'Se creó una nueva cotización', '2023-10-12 11:06:50', 6),
(337, 176, 1, 'Se editarón datos del usuario 1098488918', '2023-10-17 10:16:27', 2),
(338, 176, 2, 'Se creó un nuevo usuario', '2023-10-18 07:10:42', 2),
(339, 176, 2, 'Se creó un nuevo producto', '2023-10-18 07:15:53', 1),
(340, 176, 2, 'Se creó un nuevo producto', '2023-10-18 07:20:44', 1),
(341, 176, 1, 'Se editarón datos del producto 1', '2023-10-18 07:21:09', 1),
(342, 176, 2, 'Se creó una nueva factura', '2023-10-18 07:27:22', 3),
(343, 176, 1, 'Se editarón datos del usuario 8320102309', '2023-10-18 07:28:36', 2);

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
(65, 7106191, '7106191ADU0100', 'Parachoques trasero GLORY 560', 810000, 1, 1, 1, '5360product.jpg', 5360, 0),
(66, 3773050, '3773050', 'Antiniebla trasera GLORY 560', 175000, 1, 1, 1, '7339product.jpg', 7339, 0),
(67, 5500062, '5500062', 'Luna Rueda trasera GLORY 560', 145000, 1, 1, 1, '3520product.jpg', 3520, 0),
(68, 1, '000001', 'Tapa tarro Agua AVEO Original', 55000, 0, 1, 1, '3111product.jpg', 3111, 55000),
(69, 2, '000002', 'Sensor Temperatura Motor GLORY 580', 65000, 0, 1, 1, '8607product.jpg', 8607, 0);

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
(65, 7),
(66, 7),
(67, 7),
(69, 4),
(68, 4);

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

--
-- Volcado de datos para la tabla `service`
--

INSERT INTO `service` (`id`, `date`, `detail`, `price`, `service`, `state`) VALUES
(71, '2023-10-18', 'Escaner de camioneta Glory 580 ESS426', 60000, 176, 1),
(72, '2023-10-18', 'Cambio Sensor Temperatura GLORY 580 ESS426', 50000, 176, 1),
(73, '2023-10-18', 'Cambio y reposición caucho termostato GLORY 580 ESS426', 25000, 176, 1),
(74, '2023-10-18', 'Revisión estado Rodamientos delanteros GLORY 580 ESS426', 45000, 176, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service_has_bill`
--

CREATE TABLE `service_has_bill` (
  `id_bill` int(11) DEFAULT NULL,
  `id_service` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `service_has_bill`
--

INSERT INTO `service_has_bill` (`id_bill`, `id_service`) VALUES
(68, 71),
(68, 72),
(68, 73),
(68, 74);

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
(176, 80864878, 'Sebastián', 'Camilo ', 'Fajardo ', 'Torres', 'sebasfajar', '$2y$10$QeD/eIwgF7frOQMgS05d7ujQoJl9oh128BB0giFlqNtG6R9KW6huy', 3102452756, 'km4 variante cajica-zipaquira Reserva del lago TO7 APTO502', '0', '0', 'sebastianfajardof@gmail.com', 'default.png', 0),
(184, 1098488918, 'Dylan', 'Santiago', 'Florez', 'Infante', 'dylanflore', '$2y$10$H/e7I15xGSsTb68o/JkGqOqPsNIleGz8bbsYC/REOJkTGIMnqsBw6', 3182214719, 'Marsella Real Torre 1 aplto 306 bucaramanga', 'GZP805', 'GLORY 560', 'Dylan@notiene.com', 'default.png', 0),
(186, 8320102309, 'Expreso ', '', 'Tocancipá S.A.S.', '', 'expretocan', '$2y$10$rgB./d3Bmc.NJzoO88sThuqFJM5Q2gE36lRnvqDleDdhIR9HPbNXq', 6018574128, 'CALLE 7A N ° 4 B 13, TOCANCIPA', 'ESS426', 'GLORY 580', 'gerencia@expresotocancipa.com', 'default.png', 0);

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
(176, 1, 1),
(184, 5, 1),
(186, 5, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `cotizainfo`
--
ALTER TABLE `cotizainfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=344;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

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
