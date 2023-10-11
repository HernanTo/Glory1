-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-10-2023 a las 03:07:22
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
(28, '3349063', 904400, 760000, 1, '2023-09-18', 1, 174, 1, 'true', 'true', 0),
(29, '42265096', 1237600, 1040000, 2, '2023-09-19', 175, 177, 1, 'false', 'true', 0),
(30, '34824415', 618800, 520000, 1, '2023-09-20', 7, 174, 1, 'true', 'true', 0),
(31, '92533633', 618800, 520000, 1, '2023-09-21', 170, 174, 1, 'false', 'true', 0),
(55, '6945557', 7140, 6000, 2, '2023-10-09', 170, 182, 1, 'false', 'true', 0),
(56, '634424', 1524985, 1281500, 4, '2023-10-09', 6, 180, 1, 'false', 'true', 0),
(57, '23707353', 1190, 1000, 1, '2023-10-09', 6, 177, 1, 'false', 'true', 0),
(58, '10158667', 535500, 450000, 500, '2023-10-09', 7, 182, 1, 'true', 'true', 50000),
(59, '12026462', 3000, 3000, 2, '2023-10-10', 20, 180, 1, 'false', 'false', 0),
(60, '49346719', 3570, 3000, 2, '2023-10-10', 20, 182, 1, 'false', 'true', 0),
(61, '20867525', 567630, 477000, 1, '2023-10-10', 6, 177, 1, 'true', 'true', 53000),
(62, '23696405', 950, 950, 1, '2023-10-10', 6, 180, 1, 'false', 'false', 50),
(63, '89918498', 813971, 684009, 1, '2023-10-10', 1, 180, 1, 'false', 'true', 76001),
(64, '54997212', 11781, 9900, 1, '2023-10-10', 6, 174, 1, 'false', 'true', 1100),
(65, '73199766', 2380, 2000, 1, '2023-10-10', 6, 174, 1, 'false', 'true', 0),
(66, '23477013', 14280, 12000, 2, '2023-10-10', 20, 180, 1, 'true', 'true', 0);

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
(28, 57, 760000, 1, 760000, 0, '0', 0, '2023-09-18'),
(29, 58, 520000, 2, 1040000, 0, '0', 0, '2023-09-19'),
(30, 55, 520000, 1, 520000, 0, '0', 0, '2023-09-20'),
(31, 58, 520000, 1, 520000, 0, '0', 0, '2023-09-21'),
(56, 58, 520000, 1, 520000, 0, '0', 0, '2023-10-09'),
(56, 57, 760000, 1, 760000, 0, '0', 0, '2023-10-09'),
(56, 63, 1000, 1, 1000, 0, '0', 0, '2023-10-09'),
(57, 63, 1000, 1, 1000, 0, '0', 0, '2023-10-09'),
(58, 63, 1000, 500, 500000, 1, '0.1', 0, '2023-10-09'),
(60, 63, 1000, 1, 2000, 1, '0', 1000, '2023-10-10'),
(61, 58, 520000, 1, 530000, 1, '0.1', 10000, '2023-10-10'),
(62, 63, 1000, 1, 1000, 0, '0.05', 0, '2023-10-10'),
(63, 57, 760000, 1, 760010, 1, '0.1', 10, '2023-10-10'),
(64, 63, 1000, 1, 11000, 1, '0.1', 10000, '2023-10-10');

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
(6, '39603037', 295000, 295000, 1, '2023-09-18', 7, 173, 1, 0, 'false'),
(7, '39177493', 4522000, 3800000, 5, '2023-10-09', 6, 174, 1, 0, 'true'),
(8, '73649428', 9044000, 7600000, 10, '2023-10-09', 7, 177, 1, 0, 'true');

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
(6, 56, 295000, 1, 0, 295000, '0', '2023-09-18', 0, 0),
(7, 57, 760000, 5, 0, 3800000, '0', '2023-10-09', 0, 0),
(8, 57, 760000, 10, 0, 7600000, '0', '2023-10-09', 0, 0);

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
(270, 1, 2, 'Se creó una nueva cotización', '2023-09-18 12:58:56', 6),
(271, 1, 2, 'Se creó una nueva factura', '2023-09-19 16:52:49', 3),
(272, 1, 1, 'Se editarón datos del usuario 1025525175', '2023-09-19 16:56:31', 2),
(273, 1, 1, 'Se editarón datos del producto 1', '2023-09-19 17:08:16', 1),
(274, 1, 1, 'Se editarón datos del producto 2', '2023-09-19 17:08:57', 1),
(275, 1, 1, 'Se editarón datos del producto 3', '2023-09-19 17:09:12', 1),
(276, 1, 1, 'Se editarón datos del producto 4', '2023-09-19 17:09:35', 1),
(277, 1, 1, 'Se editarón datos del producto 3', '2023-09-19 17:09:59', 1),
(278, 1, 1, 'Se editarón datos del producto 5', '2023-09-19 17:10:21', 1),
(279, 1, 1, 'Se editarón datos del producto 6', '2023-09-19 17:10:43', 1),
(280, 1, 1, 'Se editarón datos del producto 7', '2023-09-19 17:10:58', 1),
(281, 1, 1, 'Se editarón datos del producto 1', '2023-09-19 19:20:27', 1),
(282, 1, 2, 'Se creó una nueva factura', '2023-09-19 19:20:45', 3),
(283, 1, 2, 'Se creó una nueva factura', '2023-09-21 10:18:12', 3),
(284, 1, 2, 'Se ha creado un servicio', '2023-09-22 15:46:09', 4),
(285, 1, 2, 'Se creó un nuevo producto', '2023-09-22 19:23:20', 1),
(286, 1, 3, 'Se eliminó un producto', '2023-09-22 19:24:15', 1),
(287, 1, 2, 'Se creó una nueva factura', '2023-10-04 20:20:38', 3),
(288, 1, 2, 'Se creó una nueva factura', '2023-10-04 20:34:42', 3),
(289, 1, 2, 'Se creó un nuevo producto', '2023-10-04 20:45:22', 1),
(290, 1, 1, 'Se editarón datos del producto 9', '2023-10-04 20:45:48', 1),
(291, 1, 2, 'Se creó una nueva factura', '2023-10-04 20:46:49', 3),
(292, 1, 2, 'Se creó una nueva factura', '2023-10-09 17:12:41', 3),
(293, 1, 2, 'Se creó una nueva factura', '2023-10-09 17:18:14', 3),
(294, 1, 2, 'Se creó una nueva factura', '2023-10-09 18:21:49', 3),
(295, 1, 2, 'Se creó una nueva factura', '2023-10-09 18:21:54', 3),
(296, 1, 2, 'Se creó una nueva factura', '2023-10-09 18:21:55', 3),
(297, 1, 2, 'Se creó una nueva factura', '2023-10-09 18:21:55', 3),
(298, 1, 2, 'Se creó una nueva factura', '2023-10-09 18:21:55', 3),
(299, 1, 2, 'Se creó una nueva factura', '2023-10-09 18:21:55', 3),
(300, 1, 2, 'Se creó una nueva factura', '2023-10-09 18:21:56', 3),
(301, 1, 2, 'Se creó una nueva factura', '2023-10-09 18:21:56', 3),
(302, 1, 2, 'Se creó una nueva factura', '2023-10-09 18:21:56', 3),
(303, 1, 2, 'Se creó una nueva factura', '2023-10-09 18:21:56', 3),
(304, 1, 2, 'Se creó una nueva factura', '2023-10-09 18:21:56', 3),
(305, 1, 2, 'Se creó una nueva factura', '2023-10-09 18:21:56', 3),
(306, 1, 2, 'Se creó una nueva factura', '2023-10-09 18:21:57', 3),
(307, 1, 2, 'Se creó una nueva factura', '2023-10-09 18:21:57', 3),
(308, 1, 2, 'Se creó una nueva factura', '2023-10-09 18:22:22', 3),
(309, 1, 2, 'Se creó una nueva factura', '2023-10-09 18:37:03', 3),
(310, 1, 2, 'Se creó una nueva factura', '2023-10-09 18:37:35', 3),
(311, 1, 2, 'Se creó una nueva factura', '2023-10-09 18:40:17', 3),
(312, 1, 2, 'Se creó una nueva factura', '2023-10-09 18:41:09', 3),
(313, 1, 2, 'Se creó una nueva cotización', '2023-10-09 18:44:59', 6),
(314, 1, 2, 'Se creó una nueva cotización', '2023-10-09 18:50:26', 6),
(315, 1, 2, 'Se creó una nueva factura', '2023-10-09 19:48:42', 3),
(316, 1, 2, 'Se creó una nueva factura', '2023-10-09 20:12:31', 3),
(317, 1, 2, 'Se creó una nueva factura', '2023-10-09 20:19:58', 3),
(318, 1, 2, 'Se creó una nueva factura', '2023-10-09 20:39:08', 3),
(319, 1, 2, 'Se creó una nueva factura', '2023-10-09 20:51:33', 3),
(320, 1, 2, 'Se creó una nueva factura', '2023-10-09 21:01:35', 3),
(321, 1, 2, 'Se creó una nueva factura', '2023-10-09 21:17:00', 3),
(322, 1, 2, 'Se creó una nueva factura', '2023-10-10 17:39:55', 3);

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
(55, 1, '0001', 'Parrilla Frontal Glory 580', 520000, 0, 20, 1, '7832product.jpg', 7832, 200000),
(56, 2, '0002', 'Rejilla inferior del parachoques', 295000, 0, 100, 1, '3300product.jpg', 3300, 150000),
(57, 3, '0003', 'Amortiguadores Delanteros Glory 580', 760000, 3, 3, 1, 'default.png', 6626, 500000),
(58, 4, '0004', 'Amortiguadores traseros Glory 580', 520000, 4, 3, 1, 'default.png', 2493, 250000),
(59, 5, '0005', 'Placa decorativa del componente superior Glory 580', 160000, 0, 1, 1, 'default.png', 7489, 80000),
(60, 6, '0006', 'Decoración del faro delantero IZQUIERDO Glory 580', 95000, 0, 1, 1, 'default.png', 5738, 40000),
(61, 7, '0007', 'Decoración del faro delantero DERECHO', 95000, 0, 1, 1, 'default.png', 2178, 50000),
(62, 999, '23423', 'Prueba ', 10000, 0, 10, 0, 'default.png', 8024, 0),
(63, 9, '333', 'Prueba', 1000, 493, 5, 1, 'default.png', 5391, 500);

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
(58, 6),
(57, 6),
(59, 7),
(60, 7),
(61, 7),
(55, 7),
(62, 6),
(63, 6);

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
(62, '2023-10-09', 'Prueba', 5000, 170, 1),
(63, '2023-10-09', 'prueba', 1000, 170, 1),
(64, '2023-10-09', 'cambio de aceite', 500, 6, 1),
(65, '2023-10-10', 'aaa', 1000, 20, 1),
(66, '2023-10-10', 'aaa', 2000, 20, 1),
(67, '2023-10-10', 'lalalala', 1000, 20, 1),
(68, '2023-10-10', 'aaa', 2000, 6, 1),
(69, '2023-10-10', 'Cambio de aceite', 10000, 20, 1),
(70, '2023-10-10', 'Cambio de llanta', 2000, 20, 1);

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
(55, 62),
(55, 63),
(56, 64),
(59, 65),
(59, 66),
(60, 67),
(65, 68),
(66, 69),
(66, 70);

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
(175, 1025525175, 'Andrés', 'Santiago', 'Flores', 'Ruiz', 'andreflore', '$2y$10$wAghcuU00PpDBE5ToNszPuhN7iPeCsXTbygjsFTz3Mv5DNvshQSwu', 3132093326, 'Cra. 52 #44c55, Bogotá', '0', '0', 'andressantiagofloresruiz@ciudadedubosa.com', 'default.png', 0),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=323;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

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
