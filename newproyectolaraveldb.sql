-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.36 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para proyectolaravel
CREATE DATABASE IF NOT EXISTS `proyectolaravel` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `proyectolaravel`;

-- Volcando estructura para tabla proyectolaravel.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(256) DEFAULT NULL,
  `condicion` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectolaravel.categorias: ~6 rows (aproximadamente)
DELETE FROM `categorias`;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `condicion`, `created_at`, `updated_at`) VALUES
	(1, 'harina', 'todas las harinas', 1, '2022-06-09 07:02:33', '2022-06-09 07:03:07'),
	(2, 'pastas', 'todas las pastas', 1, '2022-06-10 04:47:15', '2022-06-10 04:47:15'),
	(3, 'detergentes', 'todos los detergentes', 1, '2022-06-10 04:47:33', '2022-06-10 04:47:41'),
	(4, 'cervezas', 'todas las cervezas', 1, '2022-06-10 08:07:00', '2022-06-10 08:07:00'),
	(5, 'leche', 'todas la leches', 1, '2022-06-28 03:40:41', '2022-06-28 03:40:41'),
	(6, 'bebidas', 'todas las bebidas', 1, '2022-06-28 03:41:14', '2022-06-28 03:41:14');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla proyectolaravel.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `tipo_documento` varchar(20) DEFAULT NULL,
  `num_documento` varchar(20) DEFAULT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectolaravel.clientes: ~2 rows (aproximadamente)
DELETE FROM `clientes`;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`id`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`, `created_at`, `updated_at`) VALUES
	(1, 'pedro', 'CEDULA', '12345', 'av carlota', '54321', 'pedro@gmail.com', NULL, NULL),
	(2, 'juannn', 'DNI', '123', 'av bolivia', '75513574', 'juan@gmail.com', '2022-06-14 04:32:40', '2022-06-14 04:39:15');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Volcando estructura para tabla proyectolaravel.compras
CREATE TABLE IF NOT EXISTS `compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idproveedor` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `tipo_identificacion` varchar(20) DEFAULT NULL,
  `num_compra` varchar(10) DEFAULT NULL,
  `fecha_compra` datetime DEFAULT NULL,
  `impuesto` decimal(4,2) DEFAULT NULL,
  `total` decimal(11,2) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_proveedor_compras` (`idproveedor`),
  KEY `FK_usuario_compras` (`idusuario`),
  CONSTRAINT `FK_proveedor_compras` FOREIGN KEY (`idproveedor`) REFERENCES `proveedores` (`id`),
  CONSTRAINT `FK_usuario_compras` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectolaravel.compras: ~9 rows (aproximadamente)
DELETE FROM `compras`;
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` (`id`, `idproveedor`, `idusuario`, `tipo_identificacion`, `num_compra`, `fecha_compra`, `impuesto`, `total`, `estado`, `created_at`, `updated_at`) VALUES
	(6, 1, 4, 'FACTURA', '001', '2022-01-20 00:00:00', 0.20, 6096.00, 'Anulado', '2022-06-21 06:15:10', '2022-06-21 06:15:27'),
	(7, 1, 4, 'FACTURA', '002', '2022-02-27 00:00:00', 0.20, 480.00, 'Registrado', '2022-06-28 03:53:04', '2022-06-28 03:53:04'),
	(8, 1, 4, 'FACTURA', '003', '2022-03-27 00:00:00', 0.20, 480.00, 'Registrado', '2022-06-28 03:55:05', '2022-06-28 03:55:05'),
	(9, 1, 4, 'FACTURA', '004', '2022-04-27 00:00:00', 0.20, 900.00, 'Registrado', '2022-06-28 03:55:51', '2022-06-28 03:55:51'),
	(10, 1, 4, 'FACTURA', '005', '2022-05-27 00:00:00', 0.20, 900.00, 'Registrado', '2022-06-28 03:56:27', '2022-06-28 03:56:27'),
	(11, 1, 4, 'FACTURA', '006', '2022-06-27 00:00:00', 0.20, 240.00, 'Registrado', '2022-06-28 03:57:05', '2022-06-28 03:57:05'),
	(12, 1, 4, 'FACTURA', '007', '2022-06-27 00:00:00', 0.20, 480.00, 'Registrado', '2022-06-28 03:57:28', '2022-06-28 03:57:28'),
	(13, 1, 4, 'FACTURA', '008', '2022-06-27 00:00:00', 0.20, 480.00, 'Registrado', '2022-06-28 03:57:53', '2022-06-28 03:57:53'),
	(14, 1, 4, 'FACTURA', '009', '2022-06-27 00:00:00', 0.20, 480.00, 'Registrado', '2022-06-28 03:58:14', '2022-06-28 03:58:14');
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;

-- Volcando estructura para tabla proyectolaravel.detalle_compras
CREATE TABLE IF NOT EXISTS `detalle_compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcompra` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_compas_Dcompras` (`idcompra`),
  KEY `FK_producto_Dcompras` (`idproducto`),
  CONSTRAINT `FK_compas_Dcompras` FOREIGN KEY (`idcompra`) REFERENCES `compras` (`id`),
  CONSTRAINT `FK_producto_Dcompras` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectolaravel.detalle_compras: ~8 rows (aproximadamente)
DELETE FROM `detalle_compras`;
/*!40000 ALTER TABLE `detalle_compras` DISABLE KEYS */;
INSERT INTO `detalle_compras` (`id`, `idcompra`, `idproducto`, `cantidad`, `precio`) VALUES
	(3, 6, 1, 2, 40.00),
	(4, 6, 3, 50, 100.00),
	(5, 7, 1, 50, 8.00),
	(6, 8, 2, 40, 10.00),
	(7, 9, 3, 50, 15.00),
	(8, 10, 4, 50, 15.00),
	(9, 11, 5, 50, 4.00),
	(10, 12, 6, 100, 4.00),
	(11, 13, 7, 100, 4.00),
	(12, 14, 8, 100, 4.00);
/*!40000 ALTER TABLE `detalle_compras` ENABLE KEYS */;

-- Volcando estructura para tabla proyectolaravel.detalle_ventas
CREATE TABLE IF NOT EXISTS `detalle_ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idventa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(11,2) DEFAULT NULL,
  `descuento` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_venta_Dcompras` (`idventa`),
  KEY `FK_producto_Dcomprass` (`idproducto`),
  CONSTRAINT `FK_producto_Dcomprass` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`id`),
  CONSTRAINT `FK_venta_Dcompras` FOREIGN KEY (`idventa`) REFERENCES `ventas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectolaravel.detalle_ventas: ~11 rows (aproximadamente)
DELETE FROM `detalle_ventas`;
/*!40000 ALTER TABLE `detalle_ventas` DISABLE KEYS */;
INSERT INTO `detalle_ventas` (`id`, `idventa`, `idproducto`, `cantidad`, `precio`, `descuento`) VALUES
	(4, 3, 1, 2, 100.00, 0.00),
	(5, 3, 3, 1, 100.00, 0.00),
	(6, 4, 1, 10, 100.00, 2.00),
	(7, 4, 2, 5, 101.00, 0.00),
	(8, 5, 5, 10, 10.00, 0.00),
	(9, 5, 6, 5, 5.00, 0.00),
	(10, 6, 8, 10, 5.00, 0.00),
	(11, 6, 7, 5, 5.00, 0.00),
	(12, 7, 4, 10, 20.00, 0.00),
	(13, 7, 3, 6, 100.00, 0.00),
	(14, 8, 5, 5, 10.00, 0.00),
	(15, 8, 2, 5, 101.00, 0.00),
	(16, 9, 1, 5, 100.00, 0.00);
/*!40000 ALTER TABLE `detalle_ventas` ENABLE KEYS */;

-- Volcando estructura para tabla proyectolaravel.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla proyectolaravel.migrations: 2 rows
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla proyectolaravel.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla proyectolaravel.password_resets: 0 rows
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Volcando estructura para tabla proyectolaravel.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcategoria` int(11) NOT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio_venta` decimal(11,2) DEFAULT NULL,
  `stock` int(20) NOT NULL,
  `condicion` tinyint(4) DEFAULT '1',
  `imagen` varchar(300) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`),
  KEY `FK_categoria_Producto` (`idcategoria`),
  CONSTRAINT `FK_categoria_Producto` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectolaravel.productos: ~7 rows (aproximadamente)
DELETE FROM `productos`;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` (`id`, `idcategoria`, `codigo`, `nombre`, `precio_venta`, `stock`, `condicion`, `imagen`, `created_at`, `updated_at`) VALUES
	(1, 1, '1001', 'harina de maiz', 100.00, 5, 1, '1654849187.jpg', NULL, '2022-06-28 03:43:06'),
	(2, 2, '1002', 'pasta de fideos', 101.00, 0, 1, '1654849203.jpg', '2022-06-10 06:10:50', '2022-06-28 03:43:19'),
	(3, 4, '1003', 'cerveza heineken', 100.00, -49, 1, '1654849287.jpg', '2022-06-10 08:08:05', '2022-06-28 03:43:29'),
	(4, 3, '1004', 'Ace', 20.00, 0, 1, '1656387734.jpg', '2022-06-28 03:42:14', '2022-06-28 03:42:14'),
	(5, 5, '1005', 'leche pil en bolsa', 10.00, 45, 1, '1656388097.jpg', '2022-06-28 03:48:17', '2022-06-28 03:48:17'),
	(6, 6, '1006', 'coca cola 500ml', 5.00, 100, 1, '1656388147.png', '2022-06-28 03:49:07', '2022-06-28 03:49:07'),
	(7, 6, '1007', 'fanta 500ml', 5.00, 100, 1, '1656388200.jpg', '2022-06-28 03:50:00', '2022-06-28 03:50:00'),
	(8, 6, '1008', 'sprite 500ml', 5.00, 100, 1, '1656388231.png', '2022-06-28 03:50:31', '2022-06-28 03:50:31');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

-- Volcando estructura para tabla proyectolaravel.proveedores
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `tipo_documento` varchar(20) DEFAULT NULL,
  `num_documento` varchar(20) DEFAULT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectolaravel.proveedores: ~2 rows (aproximadamente)
DELETE FROM `proveedores`;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` (`id`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`, `created_at`, `updated_at`) VALUES
	(1, 'carlos', 'CEDULA', '12345', 'av. californica', '1234567', 'carlos@gmail.com', NULL, NULL),
	(2, 'yonyyy', 'DNI', '12448335', 'av bolivia', '75513825', 'yony.zarate96@gmail.com', '2022-06-13 15:44:38', '2022-06-13 16:12:11');
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;

-- Volcando estructura para tabla proyectolaravel.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `condicion` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectolaravel.roles: ~2 rows (aproximadamente)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `condicion`) VALUES
	(1, 'Administrador', 'Administrador', 1),
	(2, 'Vendedor', 'Vendedor', 1),
	(3, 'Comprador', 'Comprador', 1);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Volcando estructura para tabla proyectolaravel.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `tipo_documento` varchar(20) DEFAULT NULL,
  `num_documento` varchar(20) DEFAULT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `condicion` tinyint(4) DEFAULT '1',
  `idrol` int(11) NOT NULL,
  `imagen` varchar(300) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`),
  KEY `FK_rol_users` (`idrol`),
  CONSTRAINT `FK_rol_users` FOREIGN KEY (`idrol`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectolaravel.users: ~3 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`, `usuario`, `password`, `condicion`, `idrol`, `imagen`, `remember_token`, `created_at`, `updated_at`) VALUES
	(2, 'daniel', 'CEDULA', '456', 'av bolivia', '75654321', 'daniel@gmail.com', 'danielcomprador', '$2y$10$2p74RX9CG5aVuYkNfosUduUTCi4ic1r3hlfcF6IwvHBdpPcMfmBtu', 1, 3, '1655421440.jpg', NULL, '2022-06-16 23:17:20', '2022-06-17 19:22:28'),
	(3, 'oscar', 'DNI', '56789', 'av beni', '554322', 'oscar@gmail.com', 'oscarcaja', '$2y$10$0uyTqrCn6zDTbKJyIZw.hu8dtk77mSN9Dr4SUAvyfKWdikWna3nTe', 1, 2, 'noimagen.jpg', NULL, '2022-06-17 05:37:10', '2022-09-26 06:38:11'),
	(4, 'yony', 'CEDULA', '12448335', 'av bolivia', '75513825', 'yony.zarate96@gmail.com', 'admin', '$2y$10$XY04Im0zBsW7ifzemDF4ru2OX6icjd2w8bIAm7kyzJ2QAnrNUyptW', 1, 1, '1655493626.jpg', NULL, '2022-06-17 19:20:26', '2022-06-17 19:20:26');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Volcando estructura para tabla proyectolaravel.ventas
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `tipo_identificacion` varchar(20) DEFAULT NULL,
  `num_venta` varchar(10) DEFAULT NULL,
  `fecha_venta` datetime DEFAULT NULL,
  `impuesto` decimal(4,2) DEFAULT NULL,
  `total` decimal(11,2) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cliente_ventas` (`idcliente`),
  KEY `FK_usuario_ventas` (`idusuario`) USING BTREE,
  CONSTRAINT `FK_cliente_ventas` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`id`),
  CONSTRAINT `FK_usuario_ventas` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla proyectolaravel.ventas: ~7 rows (aproximadamente)
DELETE FROM `ventas`;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
INSERT INTO `ventas` (`id`, `idcliente`, `idusuario`, `tipo_identificacion`, `num_venta`, `fecha_venta`, `impuesto`, `total`, `estado`, `created_at`, `updated_at`) VALUES
	(3, 1, 4, 'FACTURA', '002', '2022-01-24 00:00:00', 0.20, 360.00, 'Anulado', '2022-06-24 21:56:30', '2022-06-27 13:52:55'),
	(4, 1, 4, 'FACTURA', '003', '2022-02-28 00:00:00', 0.20, 1782.00, 'Registrado', '2022-06-28 04:00:40', '2022-06-28 04:00:40'),
	(5, 1, 4, 'FACTURA', '004', '2022-03-28 00:00:00', 0.20, 150.00, 'Registrado', '2022-06-28 04:01:33', '2022-06-28 04:01:33'),
	(6, 1, 4, 'FACTURA', '005', '2022-04-28 00:00:00', 0.20, 90.00, 'Registrado', '2022-06-28 04:01:58', '2022-06-28 04:01:58'),
	(7, 1, 4, 'FACTURA', '006', '2022-05-28 00:00:00', 0.20, 960.00, 'Registrado', '2022-06-28 04:02:34', '2022-06-28 04:02:34'),
	(8, 1, 4, 'FACTURA', '007', '2022-06-28 00:00:00', 0.20, 666.00, 'Registrado', '2022-06-28 04:03:20', '2022-06-28 04:03:20'),
	(9, 1, 4, 'FACTURA', '010', '2022-06-28 00:00:00', 0.20, 600.00, 'Registrado', '2022-06-28 04:56:13', '2022-06-28 04:56:13');
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;

-- Volcando estructura para disparador proyectolaravel.tr_updStockCompra
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER';
DELIMITER //
CREATE TRIGGER `tr_updStockCompra` AFTER INSERT ON `detalle_compras` FOR EACH ROW BEGIN
UPDATE productos SET stock = stock + NEW.cantidad
WHERE productos.id = NEW.idproducto;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador proyectolaravel.tr_updStockCompraAnular
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER';
DELIMITER //
CREATE TRIGGER `tr_updStockCompraAnular` AFTER UPDATE ON `compras` FOR EACH ROW BEGIN
UPDATE productos p 
JOIN detalle_compras dl 
ON dl.idproducto = p.id
AND dl.idcompra = NEW.id
SET p.stock = p.stock - dl.cantidad;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador proyectolaravel.tr_updStockVentaAnular
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER';
DELIMITER //
CREATE TRIGGER `tr_updStockVentaAnular` AFTER UPDATE ON `ventas` FOR EACH ROW BEGIN
UPDATE productos p 
JOIN detalle_ventas dv
ON dv.idproducto = p.id
AND dv.idventa = NEW.id
SET p.stock = p.stock + dv.cantidad;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador proyectolaravel.tr_updStokVenta
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER';
DELIMITER //
CREATE TRIGGER `tr_updStokVenta` AFTER INSERT ON `detalle_ventas` FOR EACH ROW BEGIN
UPDATE productos SET stock = stock - NEW.cantidad
WHERE productos.id = NEW.idproducto;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
