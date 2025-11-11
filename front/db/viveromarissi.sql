-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2025 a las 19:45:07
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
-- Base de datos: `viveromarissi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_actualizacion` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_items`
--

CREATE TABLE `carrito_items` (
  `id` int(11) NOT NULL,
  `id_carrito` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(4, 'Aromáticas'),
(3, 'Plantas de Exterior'),
(2, 'Plantas de Interior'),
(1, 'Suculentas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `planta_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `email_cliente` varchar(100) NOT NULL,
  `direccion_envio` text NOT NULL,
  `fecha_pedido` datetime NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `estado` enum('Pendiente','Pagado','Enviado','Cancelado') NOT NULL DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `nombre_cliente`, `email_cliente`, `direccion_envio`, `fecha_pedido`, `total`, `estado`) VALUES
(1, 'Ana Gómez', 'ana.gomez@mail.com', 'Calle Falsa 123, Buenos Aires', '2025-10-30 16:57:03', 58.49, 'Pagado'),
(2, 'Juan Pérez', 'juan.perez@mail.com', 'Avenida Siempreviva 742, Córdoba', '2025-10-30 16:57:03', 35.00, 'Enviado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantas`
--

CREATE TABLE `plantas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `imagen_url` varchar(255) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `plantas`
--

INSERT INTO `plantas` (`id`, `nombre`, `descripcion`, `precio`, `stock`, `imagen_url`, `id_categoria`) VALUES
(15, 'Aceite de Oliva Extra Virgen (500ml)', 'Aceite puro de primera prensada en frío. Certificado orgánico.', 18.50, 95, 'assets/imgs/aceite_oliva.jpg', 1),
(16, 'Bálsamo Labial de Caléndula', 'Hidratación natural y protección. Sin parabenos ni químicos.', 6.25, 310, 'assets/imgs/balsamo_cal.jpg', 2),
(17, 'Detergente Ecológico Concentrado (1L)', 'Fórmula biodegradable, elimina grasa sin dañar el medio ambiente.', 12.90, 150, 'assets/imgs/detergente_eco.jpg', 3),
(18, 'Pasta de Dientes Sólida de Menta', 'Alternativa cero residuos. Refresca y protege de forma natural.', 8.99, 450, 'assets/imgs/pasta_solida.jpg', 2),
(19, 'Semillas de Chía Orgánicas (200g)', 'Alto contenido en Omega-3 y fibra. Ideal para smoothies y yogures.', 7.45, 200, 'assets/imgs/semillas_chia.jpg', 1),
(20, 'Limpiador Multiusos con Vinagre', 'Potente limpiador natural desinfectante, sin fosfatos.', 9.50, 180, 'assets/imgs/limpiador_vinagre.jpg', 3),
(21, 'Champú Sólido de Argán', 'Nutrición intensa para cabello seco. Dura hasta 80 lavados.', 14.00, 250, 'assets/imgs/shampu_solido.jpg', 2),
(22, 'Quinoa Tricolor (500g)', 'Grano andino orgánico, rico en proteínas y sin gluten.', 10.99, 110, 'assets/imgs/quinoa_tri.jpg', 1),
(23, 'Esponja de Luffa Natural', 'Exfoliante corporal y facial. 100% natural y compostable.', 5.00, 350, 'assets/imgs/luffa_natural.jpg', 3),
(24, 'Crema Facial de Rosa Mosqueta', 'Reparadora e hidratante. Reduce manchas y arrugas.', 29.75, 75, 'assets/imgs/crema_rosa.jpg', 2),
(25, 'Leche de Coco en Polvo (250g)', 'Alternativa láctea versátil, perfecta para postres y curries.', 11.20, 130, 'assets/imgs/leche_coco.jpg', 1),
(26, 'Tabletas de Lavavajillas Ecológicas (30u)', 'Sin cloro ni fosfatos. Alto poder desengrasante.', 16.50, 90, 'assets/imgs/pastillas_lava.jpg', 3),
(27, 'Acondicionador Sólido Cítrico', 'Desenreda y aporta brillo. Fragancia 100% natural.', 13.50, 220, 'assets/imgs/acond_solido.jpg', 2),
(28, 'Harina de Almendras (500g)', 'Baja en carbohidratos, ideal para repostería keto y vegana.', 19.99, 60, 'assets/imgs/harina_almendra.jpg', 1),
(29, 'Ambientador Natural de Eucalipto', 'Spray purificador de aire a base de aceites esenciales.', 10.50, 160, 'assets/imgs/ambient_euca.jpg', 3),
(30, 'Sérum Facial Vitamina C', 'Antioxidante potente. Aclara y unifica el tono de piel.', 34.90, 45, 'assets/imgs/serum_c.jpg', 2),
(31, 'Arroz Integral de Grano Corto (1kg)', 'Cultivado sin pesticidas. Rico en fibra y minerales.', 5.95, 280, 'assets/imgs/arroz_integral.jpg', 1),
(32, 'Toallitas Desmaquillantes Reutilizables (10u)', 'Algodón orgánico. Lavables y duraderas.', 14.25, 100, 'assets/imgs/toallitas_reutil.jpg', 3),
(33, 'Agua Micelar de Rosas (200ml)', 'Limpia, tonifica e hidrata suavemente.', 17.80, 80, 'assets/imgs/agua_micelar.jpg', 2),
(34, 'Lentejas Pardinas (500g)', 'Legumbre ecológica, fuente de hierro y proteínas.', 4.75, 300, 'assets/imgs/lentejas.jpg', 1),
(35, 'Pastillas de Fregar Suelos (20u)', 'Concentrado sólido para diluir en agua.', 8.20, 170, 'assets/imgs/fregar_suelos.jpg', 3),
(36, 'Exfoliante Corporal de Café y Azúcar', 'Elimina células muertas, dejando la piel suave y energizada.', 19.50, 65, 'assets/imgs/exfoliante_cafe.jpg', 2),
(37, 'Té Verde Matcha Orgánico (100g)', 'Energía sostenida y antioxidantes.', 22.00, 70, 'assets/imgs/matcha.jpg', 1),
(38, 'Bolsas de Basura Compostables (20u)', 'Fabricadas con almidón de maíz. 100% biodegradables.', 11.95, 210, 'assets/imgs/bolsas_compo.jpg', 3),
(39, 'Brocha de Maquillaje Vegana', 'Cerdas sintéticas y mango de bambú.', 16.99, 120, 'assets/imgs/brocha_vegana.jpg', 2),
(40, 'Harina de Coco (500g)', 'Ideal para panadería sin gluten. Alto en fibra.', 13.75, 85, 'assets/imgs/harina_coco.jpg', 1),
(41, 'Limpiacristales Natural con Alcohol', 'Sin amoníaco. Acabado sin rayas y aroma fresco.', 7.99, 140, 'assets/imgs/limpia_cristales.jpg', 3),
(42, 'Mascarilla Capilar de Karité (250ml)', 'Repara puntas abiertas y aporta brillo.', 21.50, 55, 'assets/imgs/mascarilla_capilar.jpg', 2),
(43, 'Garbanzos Secos (500g)', 'Legumbre esencial, cultivada de manera sostenible.', 3.90, 320, 'assets/imgs/garbanzos.jpg', 1),
(44, 'Bayetas Reutilizables de Bambú (3u)', 'Alternativa a las toallitas de papel. Súper absorbentes.', 9.00, 280, 'assets/imgs/bayetas_bambu.jpg', 3),
(45, 'Tónico Facial de Lavanda', 'Equilibra el pH y calma la piel irritada.', 15.50, 95, 'assets/imgs/tonico_lavanda.jpg', 2),
(46, 'Cacao Puro en Polvo (200g)', 'Sin azúcares añadidos. Perfecto para chocolate caliente.', 14.90, 105, 'assets/imgs/cacao_puro.jpg', 1),
(47, 'Pastillas para el WC Efervescentes (15u)', 'Limpieza profunda y desinfección sin químicos.', 10.25, 135, 'assets/imgs/pastillas_wc.jpg', 3),
(48, 'Aceite Corporal de Almendras Dulces', 'Hidratante y relajante. 100% puro.', 16.00, 180, 'assets/imgs/aceite_almendras.jpg', 2),
(49, 'Café Molido de Comercio Justo (250g)', 'Tostado medio, origen Colombia. Sabor intenso.', 17.50, 70, 'assets/imgs/cafe_justo.jpg', 1),
(50, 'Jabón de Marsella para la Ropa (500g)', 'Hipoalergénico. Ideal para la ropa de bebé.', 11.00, 200, 'assets/imgs/jabon_marsella.jpg', 3),
(51, 'Cepillo Seco Corporal de Cerda Natural', 'Mejora la circulación y exfolia.', 25.99, 50, 'assets/imgs/cepillo_seco.jpg', 2),
(52, 'Azúcar de Coco Orgánico (500g)', 'Endulzante natural con bajo índice glucémico.', 12.50, 115, 'assets/imgs/azucar_coco.jpg', 1),
(53, 'Desatascador Enzimático (500ml)', 'Líquido biológico que disuelve residuos orgánicos.', 14.50, 80, 'assets/imgs/desatascador_enz.jpg', 3),
(54, 'Delineador de Ojos Natural', 'Fórmula a base de minerales, de larga duración.', 18.90, 190, 'assets/imgs/delineador.jpg', 2),
(55, 'Tostadas de Arroz y Maíz (100g)', 'Snack crujiente sin gluten y bajo en calorías.', 4.20, 300, 'assets/imgs/tostadas_arroz.jpg', 1),
(56, 'Guantes de Goma de Látex Natural', 'Reutilizables y resistentes para limpieza del hogar.', 7.00, 140, 'assets/imgs/guantes_latex.jpg', 3),
(57, 'Aceite Esencial de Árbol de Té (10ml)', 'Purificante y antibacteriano. Ideal para acné.', 15.25, 210, 'assets/imgs/ae_arbol_te.jpg', 2),
(58, 'Semillas de Lino Marrón (200g)', 'Fuente de fibra. Ayuda a regular el tránsito intestinal.', 5.50, 270, 'assets/imgs/semillas_lino.jpg', 1),
(59, 'Estropajo de Cobre (2u)', 'Ideal para sartenes y ollas. No raya.', 6.50, 330, 'assets/imgs/estropajo_cobre.jpg', 3),
(60, 'Protector Solar Mineral SPF 30 (50ml)', 'Filtros 100% minerales. Respetuoso con el coral.', 27.00, 60, 'assets/imgs/protector_solar.jpg', 2),
(61, 'Harina de Espelta Integral (1kg)', 'Grano ancestral, fácil de digerir.', 8.90, 150, 'assets/imgs/harina_espelta.jpg', 1),
(62, 'Ambientador Sólido para Armarios (3u)', 'Aromatiza con aceites esenciales puros.', 9.25, 100, 'assets/imgs/ambient_solido.jpg', 3),
(63, 'Serum Capilar Anti-frizz (50ml)', 'Aceites naturales para controlar el encrespamiento.', 23.50, 80, 'assets/imgs/serum_capilar.jpg', 2),
(64, 'Pasta de Maní Natural (300g)', '100% maní tostado. Sin azúcares ni aceite de palma.', 11.50, 190, 'assets/imgs/pasta_mani.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','cliente') NOT NULL DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol`) VALUES
(2, 'Santiago Marissi', 'admin@planta.com', '$2y$10$ji20dwN4NKlzqq9KxGedPO8AydbQ7J3lWqCZ9IdTtS2SwQ1Cndh2W', 'admin'),
(4, 'Lozano Kevin', 'mauriorondes84@gmail.com', '$2y$10$UBm0yH53Eoq.8wnisK0Nn.23JLm5YjX.c7EP4MycE/rMuO8gILrFS', 'cliente'),
(5, 'hola adios', 'hola@gmail.com', '$2y$10$Pq2h2089NMK4CtOJaAYFVe0gF..bsjnfZc6menC5kGguZJQZhFo4q', 'cliente'),
(6, 'Aloe Vera', '22kevinlozanolgw@gmail.com', '$2y$10$qXMztJwMa1F1MrJV9wPsRumhRMeXR.u09iuuL/NSz..srZ5SnBLPi', 'cliente'),
(8, 'kevin', 'kevinlozanolgw@gmail.com', '$2y$10$3KbtzXKOuzTs71yZYfJ.IewpymzU7lQPokAPczIj6eXpH8sbpT0su', 'cliente'),
(9, 'Ficus Lyrata22', 'adqqqmin@planta.com', '$2y$10$7S3Shd/JXlZbAsU3m4Ga/Oas6fbBiQGyWXy6ufBBZ91TuR3NOGMDG', 'cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `carrito_items`
--
ALTER TABLE `carrito_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_carrito` (`id_carrito`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `planta_id` (`planta_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plantas`
--
ALTER TABLE `plantas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carrito_items`
--
ALTER TABLE `carrito_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `plantas`
--
ALTER TABLE `plantas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `carrito_items`
--
ALTER TABLE `carrito_items`
  ADD CONSTRAINT `carrito_items_ibfk_1` FOREIGN KEY (`id_carrito`) REFERENCES `carrito` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carrito_items_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `plantas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`planta_id`) REFERENCES `plantas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `plantas`
--
ALTER TABLE `plantas`
  ADD CONSTRAINT `plantas_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
