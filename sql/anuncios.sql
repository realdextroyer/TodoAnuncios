-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-02-2019 a las 16:17:56
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `anuncios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_cat` int(11) NOT NULL,
  `nombre_cat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_cat`, `nombre_cat`) VALUES
(1, 'Videojuegos'),
(2, 'Ropa'),
(3, 'Moviles'),
(4, 'TV'),
(5, 'Vehiculos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_web` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `URL_foto` varchar(200) NOT NULL,
  `URL_anuncio` varchar(200) NOT NULL,
  `precio_anuncio` int(11) NOT NULL,
  `precio_correcto` int(11) NOT NULL,
  `precio_chollo` int(11) NOT NULL,
  `valoracion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_usuario`, `id_web`, `id_categoria`, `nombre_producto`, `URL_foto`, `URL_anuncio`, `precio_anuncio`, `precio_correcto`, `precio_chollo`, `valoracion`) VALUES
(2, 7, 2, 1, 'NIER XBOX 360', 'https://cloud10.todocoleccion.online/videojuegos-consola-xbox-360/tc/2017/07/26/21/94270190.jpg', 'https://www.todocoleccion.net/videojuegos-consola-xbox-360/nier-xbox-360-pal-espana-completo-square-enix-cult-game~x94270190', 49, 40, 30, 0),
(3, 8, 3, 3, 'Samsung Galaxy A6 Plus', 'https://images-na.ssl-images-amazon.com/images/I/51VGqhBYJwL._SL1200_.jpg', 'https://www.amazon.es/dp/B07CPJ3W4W/ref=twister_B07D836RDS?_encoding=UTF8&psc=1', 190, 210, 200, 0),
(4, 7, 5, 4, 'TV 55\" Samsung UE55NU7093', 'https://i.ebayimg.com/images/g/HX8AAOSwMoZcZEta/s-l1600.jpg', 'https://www.ebay.es/itm/132951997496', 430, 450, 400, 0),
(5, 8, 3, 3, 'OnePlus 6T - Smartphone 8GB+128GB', 'https://images-na.ssl-images-amazon.com/images/I/71lnu4cfguL._SL1500_.jpg', 'https://www.amazon.es/gp/product/B07HFDPBW8', 600, 570, 500, 2),
(6, 8, 1, 5, 'BMW Serie 5 1999', 'https://cdn.wallapop.com/images/10420/5f/kl/__/c10420p328485699/i753974436.jpg?pictureSize=W640', 'https://es.wallapop.com/item/bmw-serie-5-1999-328485699', 3500, 3600, 3000, 1),
(7, 8, 1, 5, 'Citroen C3 HDI 70 Tonic 50kW (68CV)', 'https://cdn.wallapop.com/images/10420/40/ug/__/c10420p243285347/i748570240.jpg?pictureSize=W640', 'https://es.wallapop.com/item/citroen-c3-hdi-70-tonic-50kw-68cv-243285347', 6790, 7400, 6800, 0),
(8, 8, 3, 3, 'Xiaomi Redmi 6A 16GB', 'https://images-na.ssl-images-amazon.com/images/I/51LSiQ12P9L._SL1000_.jpg', 'https://www.amazon.es/Xiaomi-Redmi-6A-Smartphone-Quad-Core/dp/B07FM3RGNN/ref=sr_1_3?ie=UTF8&qid=1550243757&sr=8-3&keywords=xiaomi+redmi+6', 95, 110, 100, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `email`, `password`) VALUES
(7, 'dex', 'realdextroyer@gmail.com', 'e9510081ac30ffa83f10b68cde1cac07'),
(8, 'asier', 'asiervallejo@gmail.com', 'cc3216b3c60fd8ea5c7a8abcd3de6f82');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `webs`
--

CREATE TABLE `webs` (
  `id_webs` int(11) NOT NULL,
  `nombre_web` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `webs`
--

INSERT INTO `webs` (`id_webs`, `nombre_web`) VALUES
(1, 'Wallapop'),
(2, 'Todocoleccion'),
(3, 'Amazon'),
(4, 'AliExpress'),
(5, 'ebay');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_cat`),
  ADD KEY `id_categoria` (`id_cat`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_web` (`id_web`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `webs`
--
ALTER TABLE `webs`
  ADD PRIMARY KEY (`id_webs`),
  ADD KEY `id_webs` (`id_webs`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `webs`
--
ALTER TABLE `webs`
  MODIFY `id_webs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
