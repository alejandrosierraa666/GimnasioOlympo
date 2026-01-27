-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 26-01-2026 a las 17:04:35
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gimnasio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoices_products`
--

CREATE TABLE `invoices_products` (
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image_url`) VALUES
(26, 'Proteína Whey 1kg', 'Proteína de suero para aumentar masa muscular y mejorar la recuperación.', 29.99, 'proteina-1kg.webp'),
(27, 'Proteína Whey 2kg', 'Proteína de suero de alta calidad para entrenamientos intensivos.', 49.90, 'proteina-2kg.jpg'),
(28, 'Creatina Monohidratada', 'Creatina pura para mejorar fuerza y rendimiento.', 19.50, 'creatina-monohidratada.webp'),
(29, 'BCAA 2:1:1', 'Aminoácidos esenciales que reducen la fatiga muscular.', 17.90, 'bcaa.jpg'),
(30, 'Glutamina', 'Ayuda a la recuperación muscular y al sistema inmunológico.', 16.50, 'glutamina.webp'),
(31, 'Pre-entreno energético', 'Aumenta energía, enfoque y resistencia.', 22.90, 'preentreno.jpeg'),
(32, 'Multivitamínico deportivo', 'Vitaminas y minerales para deportistas.', 14.99, 'multivinaminico.jpeg'),
(33, 'Quemador de grasa', 'Suplemento para apoyar la pérdida de grasa corporal.', 24.90, 'quemador-grasa.jpg'),
(34, 'Barra proteica chocolate', 'Snack alto en proteínas sabor chocolate.', 2.50, 'barrita.jpg'),
(35, 'Barra proteica vainilla', 'Barra energética rica en proteínas sabor vainilla.', 2.50, 'barrita-vainilla.jpg'),
(36, 'Guantes de entrenamiento', 'Guantes antideslizantes para pesas y máquinas.', 12.00, 'guantes.webp'),
(37, 'Cinturón lumbar', 'Protección lumbar para levantamientos pesados.', 25.00, 'cinturon.webp'),
(38, 'Muñequeras deportivas', 'Soporte para muñecas durante entrenamientos intensos.', 9.50, 'munequera.webp'),
(39, 'Rodilleras deportivas', 'Soporte y estabilidad para rodillas.', 18.00, 'rodilleras.webp'),
(40, 'Botella deportiva 1L', 'Botella reutilizable para hidratación constante.', 6.50, 'botella.webp'),
(41, 'Shaker 700ml', 'Mezclador para batidos de proteínas.', 7.90, 'shaker.webp'),
(42, 'Toalla de gimnasio', 'Toalla absorbente ideal para entrenamientos.', 8.00, 'toalla.webp'),
(43, 'Camiseta deportiva', 'Camiseta transpirable para entrenamiento.', 15.00, 'camiseta.webp'),
(44, 'Sudadera deportiva', 'Sudadera cómoda para antes y después del entrenamiento.', 32.00, 'sudadera.webp'),
(45, 'Mochila deportiva', 'Mochila resistente para llevar equipamiento deportivo.', 28.00, 'mochila.webp'),
(46, 'Cuerda para saltar', 'Cuerda ajustable para cardio y resistencia.', 10.00, 'cuerda.webp'),
(47, 'Bandas elásticas', 'Set de bandas de resistencia para entrenamiento funcional.', 14.00, 'gomas.webp'),
(48, 'Rueda abdominal', 'Rueda para fortalecer el core y abdomen.', 11.50, 'rueda.webp'),
(49, 'Esterilla fitness', 'Colchoneta antideslizante para ejercicios de suelo.', 20.00, 'esterilla.webp'),
(50, 'Masajeador muscular', 'Dispositivo para aliviar tensión muscular.', 45.00, 'masajeador.webp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user',
  `expiration_date` date DEFAULT NULL,
  `profile_picture` varchar(100) DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `last_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user`, `password`, `role`, `expiration_date`, `profile_picture`, `name`, `last_name`) VALUES
(1, 'admin', '$2y$10$WvlmlHlkwDtMRlwRaOwZ7uHWcg1Tv3evR.FO8CFsUc/ziaGj5BoSe', 'admin', '0000-00-00', '', '', ''),
(4, 'elsenordelanoche', '$2y$10$hqT5UW.lXfnVGV0KrCWaueyx/WvB90xH.HJLPzMdwcHPA0ivrvjDW', 'user', '2026-02-26', NULL, 'javi', 'Sierra Lagartera'),
(5, 'carlox1', '$2y$10$6XWwoHCWNITtVxWBbSVfkuCE.l5tF67lu.6iTChJJ2HE9igmMiHbO', 'user', '2026-01-28', NULL, 'Carlos', 'Gomez'),
(6, 'bizcochito', '$2y$10$Wt3ENDdlb.1pE71xgjNgauYRGvKAYrKQ2CdAn1HTnqj2JMa1JFxQW', 'user', '2026-02-28', NULL, 'Fernando', 'Velasco Alba');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inv_id` (`user_id`);

--
-- Indices de la tabla `invoices_products`
--
ALTER TABLE `invoices_products`
  ADD PRIMARY KEY (`invoice_id`,`product_id`),
  ADD KEY `in_pro` (`product_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `inv_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `invoices_products`
--
ALTER TABLE `invoices_products`
  ADD CONSTRAINT `in_in` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`),
  ADD CONSTRAINT `in_pro` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
