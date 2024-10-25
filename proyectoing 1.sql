-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2024 a las 05:34:31
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
-- Base de datos: `proyectoing`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `idAdministrador` int(11) NOT NULL,
  `nombreAdmin` varchar(100) NOT NULL,
  `passwdAdmin` varchar(100) NOT NULL,
  `nivelAdmin` int(11) NOT NULL,
  `correoAdmin` varchar(100) NOT NULL,
  `imgAdmin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`idAdministrador`, `nombreAdmin`, `passwdAdmin`, `nivelAdmin`, `correoAdmin`, `imgAdmin`) VALUES
(1, 'Admin', '1234', 0, '', 'admin.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `idCarrito` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`idCarrito`, `cliente_id`, `producto_id`, `cantidad`) VALUES
(37, 2, 11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `nombreCliente` varchar(100) NOT NULL,
  `passwdCliente` varchar(100) NOT NULL,
  `nivelCliente` int(11) NOT NULL,
  `correoCliente` varchar(100) NOT NULL,
  `saldoCliente` float NOT NULL,
  `imgCliente` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nombreCliente`, `passwdCliente`, `nivelCliente`, `correoCliente`, `saldoCliente`, `imgCliente`) VALUES
(1, 'Angel', '178974', 3, '178974@uplsp.edu.mx', 1513.3, 'cliente.png'),
(2, 'Eduardo', '178974', 3, 'eduardo@gmail.com', 234.89, 'imagen.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `idEmpleado` int(11) NOT NULL,
  `nombreEmpleado` varchar(100) NOT NULL,
  `passwdEmpleado` varchar(100) NOT NULL,
  `nivelEmpleado` int(11) NOT NULL,
  `correoEmpleado` varchar(100) NOT NULL,
  `imgEmpleado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idEmpleado`, `nombreEmpleado`, `passwdEmpleado`, `nivelEmpleado`, `correoEmpleado`, `imgEmpleado`) VALUES
(1, 'Trabajador1', '1234', 2, 'trabajador1@gmail.com', 'Trabajador1.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nuevocliente`
--

CREATE TABLE `nuevocliente` (
  `idNuevo` int(11) NOT NULL,
  `correoCliente` varchar(100) NOT NULL,
  `claveNuevo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nuevocliente`
--

INSERT INTO `nuevocliente` (`idNuevo`, `correoCliente`, `claveNuevo`) VALUES
(1, '178974@upslp.edu.mx', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `nombreProducto` varchar(100) NOT NULL,
  `costoProducto` float NOT NULL,
  `cantidadProducto` int(11) NOT NULL,
  `imagenProducto` varchar(100) NOT NULL,
  `cantidadVenta` int(11) NOT NULL,
  `descripcionProducto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `nombreProducto`, `costoProducto`, `cantidadProducto`, `imagenProducto`, `cantidadVenta`, `descripcionProducto`) VALUES
(1, 'miel', 18.9, 6, 'miel.jpg', 2, 'la mejor miel de la ciudad'),
(11, 'pelicula', 56.9, 14, 'pelicula.jpg', 1, 'una pelicula de accion asddsasda'),
(12, 'tenis ', 50, 22, 'tenis .jpg', 0, 'Tenis luivuiton de san luis potosi'),
(15, 'shampoo miel', 34.9, 179, 'shampoo miel.jpg', 7, 'kasnkjasnjnascsac aixasbicbashcsa ');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idAdministrador`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`idCarrito`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`idEmpleado`);

--
-- Indices de la tabla `nuevocliente`
--
ALTER TABLE `nuevocliente`
  ADD PRIMARY KEY (`idNuevo`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `idAdministrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `idCarrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `nuevocliente`
--
ALTER TABLE `nuevocliente`
  MODIFY `idNuevo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`idProducto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
