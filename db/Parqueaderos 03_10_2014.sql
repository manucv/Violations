-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.38-0ubuntu0.14.04.1 - (Ubuntu)
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table violationsg.menu
DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `men_id` int(11) NOT NULL AUTO_INCREMENT,
  `men_nombre` varchar(200) NOT NULL,
  `men_etiqueta` varchar(200) NOT NULL,
  `apl_id` int(4) DEFAULT NULL,
  `men_icon` varchar(100) NOT NULL,
  `men_padre` int(11) NOT NULL,
  `men_divisor` char(1) NOT NULL,
  PRIMARY KEY (`men_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.menu: ~22 rows (approximately)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`men_id`, `men_nombre`, `men_etiqueta`, `apl_id`, `men_icon`, `men_padre`, `men_divisor`) VALUES
	(1, 'Parametros', 'Parámetros ', 25, '<i class="fa fa-gears fa-fw"></i>', 0, 'N'),
	(2, 'Administracion', 'Administración', 29, '<i class="fa fa-users fa-fw"></i>', 0, 'N'),
	(3, 'Paises', 'Paises', 8, '<i class="fa fa-globe fa-fw"></i>', 1, 'N'),
	(4, 'Estados', 'Estados', 9, '<i class="fa fa-building fa-fw"></i>', 1, 'N'),
	(5, 'Usuarios', 'Usuarios', 3, '<i class="fa fa-user fa-fw"></i>', 2, 'N'),
	(7, 'Vehiculo', 'Vehículo', 24, '<i class="fa fa-car fa-fw"></i>', 0, 'N'),
	(8, 'Ciudades', 'Ciudades', 10, '<i class="fa fa-building-o fa-fw"></i>', 1, 'S'),
	(9, 'Sector', 'Sector', 19, '<i class="fa fa-map-marker fa-fw"></i>', 1, 'N'),
	(10, 'Parqueadero', 'Parqueadero', 18, '<i class="fa fa-location-arrow fa-fw"></i>', 1, 'S'),
	(11, 'Sitios', 'Sitios', 12, '<i class="fa fa-compass fa-fw"></i>', 1, 'S'),
	(12, 'TipoComponente', 'Tipo Componente', 13, '<i class="fa fa-laptop fa-fw"></i>', 1, 'S'),
	(13, 'TipoInfraccion', 'Tipo Infracción', 14, '<i class="fa fa-ticket fa-fw"></i>', 1, 'S'),
	(14, 'TipoVehiculo', 'Tipo Vehículo', 15, '<i class="fa fa-car fa-fw"></i>', 1, 'S'),
	(15, 'Parametros Generales', 'Parametros Generales', NULL, '<i class="fa fa-cog fa-fw"></i>', 1, 'N'),
	(16, 'Roles', 'Roles', 5, '<i class="fa fa-child fa-fw"></i>', 2, 'N'),
	(17, 'Aplicaciones', 'Aplicaciones', 11, '<i class="fa fa-list fa-fw"></i>', 2, 'N'),
	(18, 'Monitoreo', 'Monitoreo', 26, '<i class="fa fa-video-camera fa-fw"></i>', 0, 'N'),
	(19, 'Infracciones', 'Infracciones', 27, '<i class="fa fa-list-ol fa-fw"></i>', 0, 'N'),
	(20, 'General', 'General', 6, '<i class="fa fa-ellipsis-h fa-fw"></i>', 18, 'N'),
	(21, 'PorBusqueda', 'Por Búsqueda', 21, '<i class="fa fa-search fa-fw"></i>', 18, 'N'),
	(22, 'Parqueaderos', 'Parqueaderos', 28, '<i class="fa fa-road fa-fw"></i>', 0, 'N'),
	(23, 'Menu', 'Menú', 30, '<i class="fa fa-navicon fa-fw"></i>', 2, 'N');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


-- Dumping structure for table violationsg.rol
DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `rol_id` int(4) NOT NULL AUTO_INCREMENT,
  `rol_descripcion` varchar(50) NOT NULL,
  `rol_estado` varchar(10) NOT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.rol: ~4 rows (approximately)
DELETE FROM `rol`;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`rol_id`, `rol_descripcion`, `rol_estado`) VALUES
	(1, 'Super Administrador', 'A'),
	(2, 'Cliente', 'A'),
	(12, 'Administrador', 'A'),
	(13, 'Vigilante', 'A');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;


-- Dumping structure for table violationsg.rol_aplicacion
DROP TABLE IF EXISTS `rol_aplicacion`;
CREATE TABLE IF NOT EXISTS `rol_aplicacion` (
  `rol_id` int(4) NOT NULL,
  `apl_id` int(4) NOT NULL,
  PRIMARY KEY (`rol_id`,`apl_id`),
  KEY `fk_rol_apl_apl_id` (`apl_id`),
  CONSTRAINT `fk_rol_apl_apl_id` FOREIGN KEY (`apl_id`) REFERENCES `aplicacion` (`apl_id`),
  CONSTRAINT `fk_rol_apl_rol_id` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.rol_aplicacion: ~56 rows (approximately)
DELETE FROM `rol_aplicacion`;
/*!40000 ALTER TABLE `rol_aplicacion` DISABLE KEYS */;
INSERT INTO `rol_aplicacion` (`rol_id`, `apl_id`) VALUES
	(1, 1),
	(2, 1),
	(12, 1),
	(13, 1),
	(1, 2),
	(2, 2),
	(12, 2),
	(13, 2),
	(1, 3),
	(12, 3),
	(1, 4),
	(2, 4),
	(12, 4),
	(13, 4),
	(1, 5),
	(12, 5),
	(1, 7),
	(12, 7),
	(13, 7),
	(1, 8),
	(12, 8),
	(1, 9),
	(12, 9),
	(1, 10),
	(12, 10),
	(1, 11),
	(12, 11),
	(1, 12),
	(1, 14),
	(1, 17),
	(12, 17),
	(1, 18),
	(12, 18),
	(1, 19),
	(12, 19),
	(1, 20),
	(1, 22),
	(12, 22),
	(13, 22),
	(1, 23),
	(12, 23),
	(13, 23),
	(1, 25),
	(12, 25),
	(1, 27),
	(12, 27),
	(1, 28),
	(12, 28),
	(13, 28),
	(1, 29),
	(12, 29),
	(1, 30),
	(1, 31),
	(12, 31),
	(1, 32),
	(12, 32);
/*!40000 ALTER TABLE `rol_aplicacion` ENABLE KEYS */;


-- Dumping structure for table violationsg.rol_usuario
DROP TABLE IF EXISTS `rol_usuario`;
CREATE TABLE IF NOT EXISTS `rol_usuario` (
  `rol_id` int(4) NOT NULL,
  `usu_id` int(11) NOT NULL,
  PRIMARY KEY (`rol_id`,`usu_id`),
  KEY `fk_rol_usu_usu_id` (`usu_id`),
  CONSTRAINT `fk_rol_usu_rol_id` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`),
  CONSTRAINT `fk_rol_usu_usu_id` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.rol_usuario: ~3 rows (approximately)
DELETE FROM `rol_usuario`;
/*!40000 ALTER TABLE `rol_usuario` DISABLE KEYS */;
INSERT INTO `rol_usuario` (`rol_id`, `usu_id`) VALUES
	(1, 1),
	(12, 4),
	(13, 5);
/*!40000 ALTER TABLE `rol_usuario` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
