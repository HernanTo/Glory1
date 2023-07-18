-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-07-2023 a las 02:44:53
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
  `num_fact` int(11) NOT NULL,
  `total_prices` decimal(10,0) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `vendedor` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `state` int(11) NOT NULL
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
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(12, 1, 2, 'Se creo un nuevo usuario', '2023-07-11 15:18:29', 2),
(13, 1, 2, 'Se creo un nuevo usuario', '2023-07-11 15:56:47', 2),
(14, 1, 2, 'Se creo un nuevo usuario', '2023-07-11 15:56:47', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `Barcode` int(11) NOT NULL,
  `name_product` varchar(100) NOT NULL,
  `prices` decimal(20,0) NOT NULL,
  `amount` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL
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
(1, 'admin'),
(4, 'adminLimit'),
(5, 'cliente'),
(6, 'empleado');

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
  `password` varchar(120) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `address` varchar(150) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `photo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `cedula`, `ft_name`, `sd_name`, `fi_lastname`, `sc_lastname`, `nickname`, `password`, `phone`, `address`, `email`, `photo`) VALUES
(1, 1022330332, 'Hernán', '', 'Torres', 'Rodríguez', 'hernanto', '$2y$10$wf0T0o0KTZ1UsiTaT5wly.yh8B5pTnZbJTt8TRflOXDJ3eUVS9gua', 3132093326, 'Kra 10 # 73-34', 'hernanto.ott@outlook.com', '1022330332.jpg'),
(4, 10223304453, 'Sebastián', '', 'Fajardo', 'Torres', 'sebasfajar', '$2y$10$Ly559cl6MxprokmRotOfE.Cz0X8hpUcdfjxZS3LIZIcqjTuXqyFAm', 12312, 'Chapinero', 'fajardo@gmail.com', 'default.png'),
(5, 452445, 'Andres ', '', 'Zuliaga', '', 'andrezulia', '$2y$10$IrXHSTMykggLkymDAWiuJ.q0c5xQNX.7JgSyjOBvU4vdJTtAjaQ0G', 3132093326, 'Calarca', 'Andres@gmail.com', 'default.png'),
(6, 3343455, 'Pedro', '', 'Bueno', '', 'pedrobueno', '$2y$10$T2fbM899BfarNhmflHiTrezz4lDEjLYQ8rgDewdkD.0YLcz7nAAZ.', 3242332, 'Medellín', 'asdf@gmail.com', 'default.png'),
(7, 3424355, 'Martin', '', 'Lucamel', '', 'martilucam', '$2y$10$PU/XcGoHltTcX.d/yB1qOOd.S/PIFGC5DxWOA9GG6HFWSqL1aI6xS', 323432, 'Bogotá', 'martin@gmail.com', 'default.png'),
(8, 81, 'Harv', 'Mildred', 'Braferton', 'Bauman', 'mbauman0', 'bE7?$HPeCCf\'V', 344, '25225 Cordelia Crossing', 'mbauman0@ftc.gov', 'default.png'),
(9, 71, 'Xerxes', 'Orlan', 'Pleass', 'Juzek', 'ojuzek1', 'eO8%l@ymQg', 750, '80665 Monica Circle', 'ojuzek1@123-reg.co.uk', 'default.png'),
(10, 63, 'Modesta', 'Merralee', 'Peter', 'Sember', 'msember2', 'vA7@9sz8|tqTdq', 406, '9 Barby Lane', 'msember2@tinyurl.com', 'default.png'),
(11, 34, 'Pren', 'Fowler', 'Lawles', 'Dallinder', 'fdallinder3', 'kB9&Aey\'*TV&.F|`', 971, '8 Redwing Park', 'fdallinder3@psu.edu', 'default.png'),
(12, 76, 'Marney', 'Marcos', 'Spalton', 'Heather', 'mheather4', 'qA4?lA$/(H0u', 498, '88876 Crescent Oaks Road', 'mheather4@google.de', 'default.png'),
(13, 35, 'Vergil', 'Gustave', 'Mikalski', 'Spinks', 'gspinks5', 'nY3~EynQ', 744, '0 Dixon Junction', 'gspinks5@gnu.org', 'default.png'),
(14, 25, 'Claudell', 'Charin', 'Kunes', 'Kalkofer', 'ckalkofer6', 'uA6*685i', 545, '6 Burrows Hill', 'ckalkofer6@moonfruit.com', 'default.png'),
(15, 77, 'Donna', 'Winny', 'De Leek', 'O\'Fielly', 'wofielly7', 'jD9.jsvjB$V=~_N', 318, '43856 Manitowish Hill', 'wofielly7@devhub.com', 'default.png'),
(16, 65, 'Genna', 'Ericka', 'Baylis', 'Banker', 'ebanker8', 'mL4.b2G(<b', 571, '72 Sullivan Alley', 'ebanker8@miitbeian.gov.cn', 'default.png'),
(17, 58, 'Timotheus', 'Hollie', 'Edmott', 'Hodgin', 'hhodgin9', 'uJ0}rDV,%(GhI\'R8', 592, '85 Rowland Junction', 'hhodgin9@cdbaby.com', 'default.png'),
(18, 18, 'Jedidiah', 'Orlan', 'Tomkinson', 'Enticott', 'oenticotta', 'nR6{#%\'\'_NZGs2_', 444, '801 Red Cloud Place', 'oenticotta@example.com', 'default.png'),
(19, 55, 'Grenville', 'Debbie', 'Balaisot', 'Kaasmann', 'dkaasmannb', 'kQ7=,?U7hIVtB)LE', 741, '1 Merry Terrace', 'dkaasmannb@apache.org', 'default.png'),
(20, 84, 'Tammy', 'Betteann', 'Hinkens', 'Bussen', 'bbussenc', 'cV0$X8xF8}EBk', 923, '7 5th Drive', 'bbussenc@parallels.com', 'default.png');

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
(4, 1, 1),
(14, 5, 1),
(15, 5, 1),
(16, 5, 1),
(19, 5, 1),
(8, 5, 1),
(12, 5, 1),
(7, 6, 1),
(10, 6, 1),
(6, 6, 1),
(11, 6, 1),
(20, 6, 1),
(17, 6, 1),
(13, 6, 1),
(5, 5, 1),
(18, 5, 1),
(9, 6, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

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
-- Filtros para la tabla `user_has_role`
--
ALTER TABLE `user_has_role`
  ADD CONSTRAINT `user_has_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_has_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
