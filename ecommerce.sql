-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2024 at 09:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `carritos_x_usuarios`
--

CREATE TABLE `carritos_x_usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(10) UNSIGNED DEFAULT NULL,
  `producto_id` int(10) UNSIGNED DEFAULT NULL,
  `cantidad` int(10) DEFAULT NULL,
  `talle` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carritos_x_usuarios`
--

INSERT INTO `carritos_x_usuarios` (`id`, `usuario_id`, `producto_id`, `cantidad`, `talle`) VALUES
(56, 15, 10, 1, '2XL');

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(5, 'Accesorios'),
(1, 'Buzos'),
(4, 'Camperas'),
(3, 'Pantalones'),
(2, 'Remeras');

-- --------------------------------------------------------

--
-- Table structure for table `compras`
--

CREATE TABLE `compras` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(10) UNSIGNED DEFAULT NULL,
  `producto_id` int(10) UNSIGNED DEFAULT NULL,
  `cantidad` int(10) DEFAULT NULL,
  `talle` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `compras`
--

INSERT INTO `compras` (`id`, `usuario_id`, `producto_id`, `cantidad`, `talle`) VALUES
(13, 15, 8, 1, 'L'),
(16, 15, 12, 1, 'Unico'),
(17, 15, 8, 1, 'L'),
(18, 15, 26, 1, 'L');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` float(8,2) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `categoria_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `alias`, `descripcion`, `precio`, `imagen`, `categoria_id`) VALUES
(8, 'TNSH', 'Washed Black Hoodie', 'Te presentamos TNSH, la personificación de Hardcore Feelings. Esta sudadera negra lavada va más allá de lo ordinario, con meticulosos desgastes en los dobladillos y gráficos serigrafiados agrietados para una estética vintage sin esfuerzo, mientras que el efecto de salpicaduras de pintura inspirado en el bricolaje le da un toque auténtico y personalizado.', 120.00, '668f812234c35-smTNSH1.png', 1),
(10, 'Squeaky Clean', 'White T-Shirt', 'Presentamos Squeaky Clean, una camiseta blanca oversize serigrafiada en nuestra sede de Sheffield con un gráfico no tan limpio de @bl00dina_.', 50.00, '668f83eee4086-smSqueakyClean1.png', 2),
(12, '28 Days', 'Ring', 'Te presentamos a 28 Days, un amenazador conejo de aspecto demoníaco. En este anillo de acero inoxidable está grabado nuestro clásico logotipo Drop Dead.', 20.00, '668f854f0ef2b-sm28Days1.png', 5),
(13, 'Around The Fur', 'Faux fur Jacket', 'Around The Fur es la chaqueta de Drop Dead con la que no querrás dormir. Fabricada en piel sintética, tiene un estampado de gritos en tonos apagados, cierre de cremallera y bolsillos. Es la prenda perfecta para el invierno.', 200.00, '668f8590d88bf-smAroundTheFur1.png', 4),
(14, 'Angel Soup', 'Blue Longsleeve', 'Presentamos Angel Soup, nuestra nueva camiseta de mangas superpuestas. Esta camiseta azul marino viene en nuestro clásico corte oversize y tiene unas llamativas mangas a rayas rojas y blancas. En la parte delantera y central encontrarás un atrevido gráfico serigrafiado en nuestra sede de Sheffield.', 70.00, '668f85c16c2b3-smAngelSoup1.png', 2),
(15, 'Hollowed Soul', 'Washed Black Hoodie', 'Aprende a controlar el hueco con nuestra sudadera con capucha Hollowed Soul. Esta sudadera con capucha, de corte cuadrado, es única y está cubierta de gráficos serigrafiados en nuestra sede de Sheffield.', 120.00, '668f85f2dd03b-smHollowedSoul1.png', 1),
(16, 'Glow Bottoms', 'Black Sweatpants', 'Ya puedes dejar de buscar; has encontrado el pantalón perfecto. Confeccionados con una meticulosa atención al detalle, nuestros &#039;Glow Bottoms&#039; presentan un diseño de pernera ancha que ofrece comodidad y estilo.', 120.00, '668f8675d7b7b-smGlowBottoms1.png', 3),
(17, 'Blade', 'Necklace', 'Una declaración audaz que exige atención, Blade es un collar vanguardista que cuenta con una estrella de la mañana y el encanto de la hoja de afeitar, elaborado a partir de acero inoxidable de alta calidad.', 35.00, '668f8696c4fff-smBlade1.png', 5),
(18, 'Blessings', 'Longsleeve', 'Lleva tu historia en la manga, literalmente, y cuenta tus bendiciones con esta camiseta de manga larga. Inspirada en el cautivador mundo del arte del tatuaje, esta exclusiva prenda de color beige muestra una serie de gráficos de intrincado diseño que celebran la esencia de las bendiciones.', 70.00, '668f8803c37da-smBlessings1.png', 2),
(19, 'Lure', 'Distressed Hoodie', 'Confeccionada en suave algodón gris marengo, es la mezcla perfecta de comodidad y diseño contemporáneo. Lure tiene un corte relajado, una cómoda capucha y un práctico bolsillo canguro.', 120.00, '668f8832bafe6-smLure1.png', 1),
(20, 'Makeover', 'Washed Black T-Shirt', 'Makeover es un lienzo atemporal para el arte ponible. Esta camiseta oversize se presenta en un color negro lavado que le da un toque vintage, mientras que la característica más destacada es el gráfico frontal, que grita de la estética Drop Dead y ha sido meticulosamente diseñado por @kittysophie.art.', 50.00, '668f885775f08-smMakeover1.png', 2),
(21, 'Runes', 'Belt', 'Fabricado en acero inoxidable, Runes es un cinturón de cadena con colgantes metálicos en 3D.  Tanto si prefieres llevarlo ceñido a la cintura como drapeado alrededor de las caderas, este cinturón tiene un cierre de hebilla y una cadena extendida que se ajusta sin esfuerzo a tu estilo y tamaño preferidos. Se entrega en un estuche de regalo de la marca.', 50.00, '668f8890c1fc7-smRunes1.png', 5),
(22, 'Hollowfication', 'Washed Black Hoodie', 'Abraza el lado oscuro con Hollowfication. Esta sudadera con capucha oversize es más que un básico de armario, con su bolsillo canguro para mayor practicidad.', 120.00, '668f88c75e41a-smHollowfication1.png', 1),
(23, 'Max Pain', 'Racer Jacket', 'Un estilo cuadrado con cremallera que se completa con un cuello falso con doble botón a presión, mangas largas, bolsillos laterales y atrevidos parches y bordados moteros por toda la prenda.', 250.00, '668f88ee80b52-smMaxPain1.png', 4),
(24, 'Rot &#039;N&#039; Roll', 'Washed Black T-Shirt', 'Es hora de Rot n Roll. Esta camiseta lavada de gran tamaño ha sido desgastada como ninguna otra, con un estampado horripilante, es una prenda única para cualquier armario Drop Dead.', 60.00, '668f895124dba-smRotNRoll1.png', 2),
(25, 'Razor&#039;s Edge', 'Earrings', 'Un par de pendientes de aro de acero inoxidable con colgantes de navaja a juego. Pendiente de aro con bisagra y opción de colgante intercambiable.', 20.00, '668f8971a6610-smRazorsEdge1.png', 5),
(26, 'Seek &amp; Destroy', 'Denim Jeans', 'Corre hacia el abismo con los vaqueros Seek &amp; Destroy. Con un denim negro lavado, puedes encontrar capas de rotos y desgastes por todo este par de vaqueros de pierna ancha. Debajo de los rotos hay un tejido interior que te protege.', 120.00, '668f89995fbe3-smSeekDestroy1.png', 3),
(27, 'J&#039;adore Hardcore', '2 in 1 Jacket', 'Presentamos J&#039;adore Hardcore, la personificación de los sentimientos Hardcore. Esta poderosa prenda 2 en 1 se inspira directamente en la multitud de un concierto: es una versión de la clásica chaqueta de batalla corta, con una sudadera con capucha desmontable y tachuelas.', 200.00, '668f8aba18e8c-smJadoreHardcore1.png', 4),
(28, 'Spiritual', 'Socks (Pack of 2)', 'Los clásicos calcetines Drop Dead &#039;Spiritual&#039; en naranja/verde son de longitud media, con un grueso punto elástico alrededor del tobillo y los exclusivos gráficos DD spiritual hardcore en los laterales y la base.', 20.00, '668f8ae0b1bf9-smSpiritual1.png', 5),
(29, 'Violence', 'Elasticated Shorts', 'Entra en la arena con nuestros pantalones cortos Violence. Confeccionados con un tejido de peso medio, estos suaves pantalones cortos de satén destacan por su durabilidad con intrincados bordados y parches de calavera cosidos en la parte delantera y en los laterales.', 60.00, '668f8b0819e58-smViolence1.png', 3),
(30, 'Dead Cell', 'Puffer Jacket', 'Presentamos Dead Cell, la chaqueta vanguardista que desafía las convenciones y supera los límites de la moda contemporánea.', 250.00, '668f8b5f8ca6f-smDeadCell1.png', 4),
(31, 'Split Head', 'Knitted Beanie', 'Este es el gorro de punto que lleva la moda para la cabeza a un nuevo nivel de estilo e intriga. Adornado con dinámicas rayas verdes y negras, este gorro es toda una declaración de intenciones.', 40.00, '668f8bb7afac3-smSplitHead1.png', 5),
(32, 'Want You', 'Ringer T-Shirt', 'Esta camiseta, en nuestro color crudo personalizado, es un homenaje a nuestro estilo clásico DD. Esta camiseta entallada se ha impreso internamente en nuestra sede de Sheffield.', 50.00, '668f8bf124a0c-smWantYou1.png', 2),
(33, 'Hardcore', 'Socks (Pack of 2)', 'Los calcetines clásicos Drop Dead &#039;Hardcore&#039; en blanco/negro son de longitud media, con un grueso punto elástico alrededor del tobillo y gráficos exclusivos DD spiritual hardcore en los laterales y la base.', 20.00, '668f8c0baa923-smHardcore1.png', 5),
(34, 'Orion Skirt', 'Wrap Skirt', 'Eleva tu vestuario con la falda de Orion. Confeccionada en franela marrón tonal. Esta falda escocesa cuenta con nuestro clásico diseño envolvente con una correa ajustable en la cintura, parches espirituales y un dobladillo asimétrico con un acabado de borde crudo.', 50.00, '668f8c365de63-smOrionSkirt1.png', 3);

-- --------------------------------------------------------

--
-- Table structure for table `productos_x_talles`
--

CREATE TABLE `productos_x_talles` (
  `id` int(10) UNSIGNED NOT NULL,
  `producto_id` int(10) UNSIGNED DEFAULT NULL,
  `talle_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productos_x_talles`
--

INSERT INTO `productos_x_talles` (`id`, `producto_id`, `talle_id`) VALUES
(20, 8, 6),
(21, 8, 4),
(22, 8, 3),
(23, 10, 6),
(24, 10, 4),
(25, 10, 3),
(26, 10, 1),
(27, 10, 5),
(28, 10, 2),
(29, 12, 7),
(30, 13, 6),
(31, 13, 4),
(32, 13, 3),
(33, 13, 5),
(34, 14, 6),
(35, 14, 4),
(36, 14, 3),
(37, 14, 1),
(38, 14, 5),
(39, 14, 2),
(40, 15, 4),
(41, 15, 3),
(42, 15, 5),
(43, 16, 4),
(44, 16, 3),
(45, 16, 1),
(47, 17, 7),
(48, 18, 4),
(49, 18, 3),
(50, 18, 1),
(51, 18, 5),
(52, 18, 2),
(53, 19, 6),
(54, 19, 4),
(55, 19, 3),
(56, 19, 5),
(57, 20, 4),
(58, 20, 3),
(59, 20, 1),
(60, 20, 5),
(61, 20, 2),
(62, 21, 7),
(63, 22, 6),
(64, 22, 4),
(65, 22, 3),
(66, 22, 1),
(67, 22, 5),
(68, 23, 4),
(69, 23, 3),
(70, 23, 1),
(71, 23, 5),
(72, 24, 4),
(73, 24, 3),
(74, 24, 1),
(75, 24, 2),
(76, 25, 7),
(77, 26, 4),
(78, 26, 3),
(79, 26, 1),
(80, 26, 5),
(81, 26, 2),
(82, 27, 4),
(83, 27, 3),
(84, 27, 5),
(85, 28, 7),
(86, 29, 3),
(87, 29, 1),
(88, 29, 2),
(89, 30, 6),
(90, 30, 4),
(91, 30, 3),
(92, 30, 5),
(93, 31, 7),
(94, 32, 4),
(95, 32, 3),
(96, 32, 1),
(97, 32, 2),
(98, 33, 7),
(99, 34, 6),
(100, 34, 4),
(101, 34, 3),
(102, 34, 1),
(103, 34, 5),
(104, 34, 2);

-- --------------------------------------------------------

--
-- Table structure for table `talles`
--

CREATE TABLE `talles` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `talles`
--

INSERT INTO `talles` (`id`, `nombre`) VALUES
(6, '2XL'),
(4, 'L'),
(3, 'M'),
(1, 'S'),
(7, 'Unico'),
(5, 'XL'),
(2, 'XS');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `roles` enum('admin','usuario') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `roles`) VALUES
(15, 'Lucas', '$2y$10$.yviisyAkNZvdc7ecVnLWudXGWGiazhloQmR1fSIRDytUiiC8oBzq', 'usuario'),
(16, 'Administrador', '$2y$10$2kRbumh49VJAzegnE/VOn.BWMAy6/ANS1qpX/IsBdvzRwOLI9y2pe', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carritos_x_usuarios`
--
ALTER TABLE `carritos_x_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indexes for table `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indexes for table `productos_x_talles`
--
ALTER TABLE `productos_x_talles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `talle_id` (`talle_id`);

--
-- Indexes for table `talles`
--
ALTER TABLE `talles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carritos_x_usuarios`
--
ALTER TABLE `carritos_x_usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `productos_x_talles`
--
ALTER TABLE `productos_x_talles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `talles`
--
ALTER TABLE `talles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carritos_x_usuarios`
--
ALTER TABLE `carritos_x_usuarios`
  ADD CONSTRAINT `carritos_x_usuarios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carritos_x_usuarios_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Constraints for table `productos_x_talles`
--
ALTER TABLE `productos_x_talles`
  ADD CONSTRAINT `productos_x_talles_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productos_x_talles_ibfk_2` FOREIGN KEY (`talle_id`) REFERENCES `talles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
