-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.38-0ubuntu0.12.04.1 - (Ubuntu)
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table violationsg.aplicacion
DROP TABLE IF EXISTS `aplicacion`;
CREATE TABLE IF NOT EXISTS `aplicacion` (
  `apl_id` int(4) NOT NULL AUTO_INCREMENT,
  `apl_descripcion` varchar(70) NOT NULL,
  `apl_nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`apl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.aplicacion: ~22 rows (approximately)
DELETE FROM `aplicacion`;
/*!40000 ALTER TABLE `aplicacion` DISABLE KEYS */;
INSERT INTO `aplicacion` (`apl_id`, `apl_descripcion`, `apl_nombre`) VALUES
	(1, 'application:index', 'Index'),
	(2, 'application:error', 'Error'),
	(3, 'usuarios:usuarios', 'Usuario'),
	(4, 'application:login', 'Login'),
	(5, 'usuarios:roles', 'Roles'),
	(6, 'monitoreo:control', 'Control'),
	(7, 'parametros:index', 'Parametros Modulo'),
	(8, 'parametros:pais', 'Paises'),
	(9, 'parametros:estado', 'Estados'),
	(10, 'parametros:ciudad', 'Ciudades'),
	(11, 'usuarios:aplicaciones', 'Aplicaciones'),
	(12, 'parametros:sitio', 'Sitios'),
	(13, 'parametros:tipocomponente', 'Tipo Componente'),
	(14, 'parametros:tipoinfraccion', 'Tipo Infraccion'),
	(15, 'parametros:tipovehiculo', 'Tipo Vehículo'),
	(16, 'vehiculo:vehiculo', 'Modulo Vehiculo'),
	(17, 'infraccion:infraccion', 'Infracciones'),
	(18, 'parametros:parqueadero', 'Parqueaderos Parametros'),
	(19, 'parametros:sector', 'Sectores'),
	(20, 'console:resetpassword', 'Console'),
	(21, 'monitoreo:detalle', 'Detalle Sitio'),
	(22, 'parqueaderos:parqueaderos', 'Parqueadero');
/*!40000 ALTER TABLE `aplicacion` ENABLE KEYS */;


-- Dumping structure for table violationsg.automovil
DROP TABLE IF EXISTS `automovil`;
CREATE TABLE IF NOT EXISTS `automovil` (
  `aut_placa` varchar(10) NOT NULL,
  PRIMARY KEY (`aut_placa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.automovil: ~0 rows (approximately)
DELETE FROM `automovil`;
/*!40000 ALTER TABLE `automovil` DISABLE KEYS */;
/*!40000 ALTER TABLE `automovil` ENABLE KEYS */;


-- Dumping structure for table violationsg.ciudad
DROP TABLE IF EXISTS `ciudad`;
CREATE TABLE IF NOT EXISTS `ciudad` (
  `ciu_id` int(11) NOT NULL AUTO_INCREMENT,
  `est_id` int(4) DEFAULT NULL,
  `ciu_nombre_es` varchar(150) NOT NULL,
  `ciu_nombre_en` varchar(150) NOT NULL,
  `ciu_codigo_telefono` varchar(5) NOT NULL,
  PRIMARY KEY (`ciu_id`),
  KEY `fk_ciu_est_id` (`est_id`),
  CONSTRAINT `fk_ciu_est_id` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.ciudad: ~3 rows (approximately)
DELETE FROM `ciudad`;
/*!40000 ALTER TABLE `ciudad` DISABLE KEYS */;
INSERT INTO `ciudad` (`ciu_id`, `est_id`, `ciu_nombre_es`, `ciu_nombre_en`, `ciu_codigo_telefono`) VALUES
	(1, 1, 'Quito', 'Quito', '02'),
	(2, 2, 'Santiago', 'Santiago', '02'),
	(3, 4, 'Guayaquil', 'Guayaquil', '07');
/*!40000 ALTER TABLE `ciudad` ENABLE KEYS */;


-- Dumping structure for table violationsg.componente
DROP TABLE IF EXISTS `componente`;
CREATE TABLE IF NOT EXISTS `componente` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `sit_id` int(11) DEFAULT NULL,
  `tip_com_id` int(3) NOT NULL,
  `com_descripcion` varchar(100) NOT NULL,
  `com_ip_local` varchar(15) DEFAULT NULL,
  `com_ip_publica` varchar(15) DEFAULT NULL,
  `com_usuario` varchar(15) DEFAULT NULL,
  `com_clave` varchar(35) DEFAULT NULL,
  `com_puerto` varchar(5) DEFAULT NULL,
  `com_mascara` varchar(15) DEFAULT NULL,
  `com_gateway` varchar(15) DEFAULT NULL,
  `com_dns1` varchar(15) DEFAULT NULL,
  `com_dns2` varchar(15) DEFAULT NULL,
  `com_estado` char(1) NOT NULL,
  `com_ultima_respuesta` datetime DEFAULT NULL,
  `com_ultimo_valor` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`com_id`),
  KEY `fk_com_sit_id` (`sit_id`),
  KEY `fk_com_tip_com_id` (`tip_com_id`),
  CONSTRAINT `fk_com_sit_id` FOREIGN KEY (`sit_id`) REFERENCES `sitio` (`sit_id`),
  CONSTRAINT `fk_com_tip_com_id` FOREIGN KEY (`tip_com_id`) REFERENCES `tipo_componente` (`tip_com_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.componente: ~2 rows (approximately)
DELETE FROM `componente`;
/*!40000 ALTER TABLE `componente` DISABLE KEYS */;
INSERT INTO `componente` (`com_id`, `sit_id`, `tip_com_id`, `com_descripcion`, `com_ip_local`, `com_ip_publica`, `com_usuario`, `com_clave`, `com_puerto`, `com_mascara`, `com_gateway`, `com_dns1`, `com_dns2`, `com_estado`, `com_ultima_respuesta`, `com_ultimo_valor`) VALUES
	(1, 1, 1, 'Router TP Link - Blanco', 'www.google.com', '181.211.12.234', 'admin', 'SES2014', NULL, NULL, NULL, NULL, NULL, 'A', '2014-08-01 21:10:03', '618'),
	(2, 1, 1, 'Outstation', 'www.apple.com', '181.211.11.233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', '2014-08-01 21:10:08', '19');
/*!40000 ALTER TABLE `componente` ENABLE KEYS */;


-- Dumping structure for table violationsg.dispositivo
DROP TABLE IF EXISTS `dispositivo`;
CREATE TABLE IF NOT EXISTS `dispositivo` (
  `dis_id` int(5) NOT NULL AUTO_INCREMENT,
  `veh_id` int(6) DEFAULT NULL,
  `dis_descripcion` varchar(150) NOT NULL,
  `dis_link` text,
  `dis_usuario` varchar(50) DEFAULT NULL,
  `dis_clave` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`dis_id`),
  KEY `fk_dis_veh_id` (`veh_id`),
  CONSTRAINT `fk_dis_veh_id` FOREIGN KEY (`veh_id`) REFERENCES `vehiculo` (`veh_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.dispositivo: ~1 rows (approximately)
DELETE FROM `dispositivo`;
/*!40000 ALTER TABLE `dispositivo` DISABLE KEYS */;
INSERT INTO `dispositivo` (`dis_id`, `veh_id`, `dis_descripcion`, `dis_link`, `dis_usuario`, `dis_clave`) VALUES
	(1, 1, 'CAMARA VAN 1', 'https://netcam.belkin.com/login.html', 'SES', '1234567');
/*!40000 ALTER TABLE `dispositivo` ENABLE KEYS */;


-- Dumping structure for table violationsg.estado
DROP TABLE IF EXISTS `estado`;
CREATE TABLE IF NOT EXISTS `estado` (
  `est_id` int(4) NOT NULL AUTO_INCREMENT,
  `pai_id` int(4) DEFAULT NULL,
  `est_nombre_es` varchar(150) NOT NULL,
  `est_nombre_en` varchar(150) NOT NULL,
  PRIMARY KEY (`est_id`),
  KEY `fk_est_pai_id` (`pai_id`),
  CONSTRAINT `fk_est_pai_id` FOREIGN KEY (`pai_id`) REFERENCES `pais` (`pai_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.estado: ~4 rows (approximately)
DELETE FROM `estado`;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` (`est_id`, `pai_id`, `est_nombre_es`, `est_nombre_en`) VALUES
	(1, 63, 'PICHINCHA', 'PICHINCHA'),
	(2, 64, 'Region Metropolitana', 'Region Metropolitana'),
	(3, 66, 'Buenos aires', 'Buenos aires'),
	(4, 63, 'GUAYAS', 'GUAYAS');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;


-- Dumping structure for table violationsg.infraccion
DROP TABLE IF EXISTS `infraccion`;
CREATE TABLE IF NOT EXISTS `infraccion` (
  `inf_id` int(11) NOT NULL AUTO_INCREMENT,
  `inf_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `inf_detalles` text NOT NULL,
  `usu_id` int(11) NOT NULL,
  `tip_inf_id` int(4) NOT NULL,
  `sec_id` int(11) NOT NULL,
  PRIMARY KEY (`inf_id`),
  KEY `fk_infraccion_usuario1_idx` (`usu_id`),
  KEY `fk_infraccion_tipo_infraccion1_idx` (`tip_inf_id`),
  KEY `fk_infraccion_sector1_idx` (`sec_id`),
  CONSTRAINT `fk_infraccion_sector1` FOREIGN KEY (`sec_id`) REFERENCES `sector` (`sec_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_infraccion_tipo_infraccion1` FOREIGN KEY (`tip_inf_id`) REFERENCES `tipo_infraccion` (`tip_inf_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_infraccion_usuario1` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.infraccion: ~0 rows (approximately)
DELETE FROM `infraccion`;
/*!40000 ALTER TABLE `infraccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `infraccion` ENABLE KEYS */;


-- Dumping structure for table violationsg.log_parqueadero
DROP TABLE IF EXISTS `log_parqueadero`;
CREATE TABLE IF NOT EXISTS `log_parqueadero` (
  `log_par_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_par_fecha_ingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `log_par_fecha_salida` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `log_par_horas_parqueo` int(11) NOT NULL,
  `log_par_estado` char(1) NOT NULL,
  `par_id` varchar(10) NOT NULL,
  `aut_placa` varchar(10) NOT NULL,
  PRIMARY KEY (`log_par_id`),
  KEY `fk_log_parqueadero_par_id` (`par_id`),
  KEY `fk_log_parqueadero_aut_placa` (`aut_placa`),
  CONSTRAINT `fk_log_parqueadero_aut_placa` FOREIGN KEY (`aut_placa`) REFERENCES `automovil` (`aut_placa`),
  CONSTRAINT `fk_log_parqueadero_par_id` FOREIGN KEY (`par_id`) REFERENCES `parqueadero` (`par_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.log_parqueadero: ~0 rows (approximately)
DELETE FROM `log_parqueadero`;
/*!40000 ALTER TABLE `log_parqueadero` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_parqueadero` ENABLE KEYS */;


-- Dumping structure for table violationsg.multa_parqueadero
DROP TABLE IF EXISTS `multa_parqueadero`;
CREATE TABLE IF NOT EXISTS `multa_parqueadero` (
  `mul_par_id` int(11) NOT NULL AUTO_INCREMENT,
  `par_id` varchar(10) NOT NULL,
  `aut_placa` varchar(10) NOT NULL,
  `inf_id` int(11) NOT NULL,
  `mul_par_estado` char(1) NOT NULL,
  `mul_par_valor` float NOT NULL,
  PRIMARY KEY (`mul_par_id`),
  KEY `fk_multa_parqueadero_parqueadero1_idx` (`par_id`),
  KEY `fk_multa_parqueadero_infraccion1_idx` (`inf_id`),
  KEY `fk_multa_parqueadero_automovil1` (`aut_placa`),
  CONSTRAINT `fk_multa_parqueadero_automovil1` FOREIGN KEY (`aut_placa`) REFERENCES `automovil` (`aut_placa`),
  CONSTRAINT `fk_multa_parqueadero_infraccion1` FOREIGN KEY (`inf_id`) REFERENCES `infraccion` (`inf_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_multa_parqueadero_parqueadero1` FOREIGN KEY (`par_id`) REFERENCES `parqueadero` (`par_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.multa_parqueadero: ~0 rows (approximately)
DELETE FROM `multa_parqueadero`;
/*!40000 ALTER TABLE `multa_parqueadero` DISABLE KEYS */;
/*!40000 ALTER TABLE `multa_parqueadero` ENABLE KEYS */;


-- Dumping structure for table violationsg.pais
DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
  `pai_id` int(4) NOT NULL AUTO_INCREMENT,
  `pai_nombre_es` varchar(120) NOT NULL,
  `pai_nombre_en` varchar(120) NOT NULL,
  `pai_codigo_telefono` varchar(5) NOT NULL,
  PRIMARY KEY (`pai_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.pais: ~4 rows (approximately)
DELETE FROM `pais`;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` (`pai_id`, `pai_nombre_es`, `pai_nombre_en`, `pai_codigo_telefono`) VALUES
	(63, 'ECUADOR', 'ECUADOR', '593'),
	(64, 'Chile', 'Chile', '56'),
	(65, 'CHINA', 'CHINA', 'CHINA'),
	(66, 'Argentina ', 'Argentina ', 'Argen');
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;


-- Dumping structure for table violationsg.parqueadero
DROP TABLE IF EXISTS `parqueadero`;
CREATE TABLE IF NOT EXISTS `parqueadero` (
  `par_id` varchar(10) NOT NULL,
  `par_estado` char(1) NOT NULL,
  `sec_id` int(11) NOT NULL,
  PRIMARY KEY (`par_id`),
  KEY `fk_parqueadero_sector1_idx` (`sec_id`),
  CONSTRAINT `fk_parqueadero_sector1` FOREIGN KEY (`sec_id`) REFERENCES `sector` (`sec_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.parqueadero: ~0 rows (approximately)
DELETE FROM `parqueadero`;
/*!40000 ALTER TABLE `parqueadero` DISABLE KEYS */;
/*!40000 ALTER TABLE `parqueadero` ENABLE KEYS */;


-- Dumping structure for table violationsg.rol
DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `rol_id` int(4) NOT NULL AUTO_INCREMENT,
  `rol_descripcion` varchar(50) NOT NULL,
  `rol_estado` varchar(10) NOT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.rol: ~3 rows (approximately)
DELETE FROM `rol`;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`rol_id`, `rol_descripcion`, `rol_estado`) VALUES
	(1, 'Administrator', 'A'),
	(4, 'Nuevo Rol', 'A'),
	(10, 'Rola 2', 'A');
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

-- Dumping data for table violationsg.rol_aplicacion: ~21 rows (approximately)
DELETE FROM `rol_aplicacion`;
/*!40000 ALTER TABLE `rol_aplicacion` DISABLE KEYS */;
INSERT INTO `rol_aplicacion` (`rol_id`, `apl_id`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(1, 4),
	(1, 5),
	(1, 6),
	(1, 7),
	(1, 8),
	(1, 9),
	(1, 10),
	(1, 11),
	(1, 12),
	(1, 13),
	(1, 14),
	(1, 15),
	(1, 16),
	(1, 17),
	(1, 18),
	(1, 19),
	(1, 21),
	(1, 22);
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

-- Dumping data for table violationsg.rol_usuario: ~1 rows (approximately)
DELETE FROM `rol_usuario`;
/*!40000 ALTER TABLE `rol_usuario` DISABLE KEYS */;
INSERT INTO `rol_usuario` (`rol_id`, `usu_id`) VALUES
	(1, 1);
/*!40000 ALTER TABLE `rol_usuario` ENABLE KEYS */;


-- Dumping structure for table violationsg.sector
DROP TABLE IF EXISTS `sector`;
CREATE TABLE IF NOT EXISTS `sector` (
  `sec_id` int(11) NOT NULL AUTO_INCREMENT,
  `sec_nombre` varchar(45) NOT NULL,
  `sec_latitud` float(10,6) NOT NULL,
  `sec_longitud` float(10,6) NOT NULL,
  `ciu_id` int(11) NOT NULL,
  `sec_ubicacion` varchar(150) NOT NULL,
  PRIMARY KEY (`sec_id`),
  KEY `fk_sector_ciudad_idx` (`ciu_id`),
  CONSTRAINT `fk_sector_ciudad` FOREIGN KEY (`ciu_id`) REFERENCES `ciudad` (`ciu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.sector: ~4 rows (approximately)
DELETE FROM `sector`;
/*!40000 ALTER TABLE `sector` DISABLE KEYS */;
INSERT INTO `sector` (`sec_id`, `sec_nombre`, `sec_latitud`, `sec_longitud`, `ciu_id`, `sec_ubicacion`) VALUES
	(1, 'SECTOR 1', -0.000100, -1.000000, 1, 'UBICACION 1'),
	(4, 'El Labrador', -0.172627, -1.000000, 1, 'El Tiempo'),
	(5, 'el Labrador', -0.172981, -78.483574, 1, 'El Tiempo'),
	(6, 'Villa Olimpica', -33.461449, -70.620033, 2, 'Avenida Grecia y Obispo Orrego');
/*!40000 ALTER TABLE `sector` ENABLE KEYS */;


-- Dumping structure for table violationsg.sitio
DROP TABLE IF EXISTS `sitio`;
CREATE TABLE IF NOT EXISTS `sitio` (
  `sit_id` int(11) NOT NULL AUTO_INCREMENT,
  `ciu_id` int(11) DEFAULT NULL,
  `sit_descripcion` varchar(200) NOT NULL,
  `sit_direccion` varchar(150) NOT NULL,
  `sit_sector` varchar(50) NOT NULL,
  `sit_reference_number` varchar(10) NOT NULL,
  `sit_estado` char(1) NOT NULL,
  `sit_latitud` float(10,6) NOT NULL,
  `sit_longitud` float(10,6) NOT NULL,
  `sit_ultima_respuesta` datetime DEFAULT NULL,
  `sit_ultimo_valor` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`sit_id`),
  KEY `fk_sit_ciu_id` (`ciu_id`),
  CONSTRAINT `fk_sit_ciu_id` FOREIGN KEY (`ciu_id`) REFERENCES `ciudad` (`ciu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.sitio: ~3 rows (approximately)
DELETE FROM `sitio`;
/*!40000 ALTER TABLE `sitio` DISABLE KEYS */;
INSERT INTO `sitio` (`sit_id`, `ciu_id`, `sit_descripcion`, `sit_direccion`, `sit_sector`, `sit_reference_number`, `sit_estado`, `sit_latitud`, `sit_longitud`, `sit_ultima_respuesta`, `sit_ultimo_valor`) VALUES
	(1, 1, 'Site 1', 'El Inca y Amazonas', 'El Labrador', '804000001', 'A', -0.172981, -78.483574, '0000-00-00 00:00:00', '0.000000'),
	(3, 1, 'Site 2', 'El Inca y Amazonas', 'El Labrador', '805000002', 'A', -0.172981, -78.483574, '0000-00-00 00:00:00', '0.000000'),
	(4, 1, 'Site 3', 'Estocolmo y Amazonas', 'El Labrador', '804000003', 'I', -0.172981, -78.483574, NULL, NULL);
/*!40000 ALTER TABLE `sitio` ENABLE KEYS */;


-- Dumping structure for table violationsg.tipo_componente
DROP TABLE IF EXISTS `tipo_componente`;
CREATE TABLE IF NOT EXISTS `tipo_componente` (
  `tip_com_id` int(3) NOT NULL AUTO_INCREMENT,
  `tip_com_descripcion` varchar(150) NOT NULL,
  `tip_com_imagen` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`tip_com_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.tipo_componente: ~1 rows (approximately)
DELETE FROM `tipo_componente`;
/*!40000 ALTER TABLE `tipo_componente` DISABLE KEYS */;
INSERT INTO `tipo_componente` (`tip_com_id`, `tip_com_descripcion`, `tip_com_imagen`) VALUES
	(1, 'Router', '');
/*!40000 ALTER TABLE `tipo_componente` ENABLE KEYS */;


-- Dumping structure for table violationsg.tipo_infraccion
DROP TABLE IF EXISTS `tipo_infraccion`;
CREATE TABLE IF NOT EXISTS `tipo_infraccion` (
  `tip_inf_id` int(4) NOT NULL AUTO_INCREMENT,
  `tip_inf_descripcion` varchar(150) NOT NULL,
  PRIMARY KEY (`tip_inf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.tipo_infraccion: ~0 rows (approximately)
DELETE FROM `tipo_infraccion`;
/*!40000 ALTER TABLE `tipo_infraccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_infraccion` ENABLE KEYS */;


-- Dumping structure for table violationsg.tipo_vehiculo
DROP TABLE IF EXISTS `tipo_vehiculo`;
CREATE TABLE IF NOT EXISTS `tipo_vehiculo` (
  `tip_veh_id` int(4) NOT NULL AUTO_INCREMENT,
  `tip_veh_descripcion` varchar(75) NOT NULL,
  PRIMARY KEY (`tip_veh_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.tipo_vehiculo: ~1 rows (approximately)
DELETE FROM `tipo_vehiculo`;
/*!40000 ALTER TABLE `tipo_vehiculo` DISABLE KEYS */;
INSERT INTO `tipo_vehiculo` (`tip_veh_id`, `tip_veh_descripcion`) VALUES
	(1, 'Van');
/*!40000 ALTER TABLE `tipo_vehiculo` ENABLE KEYS */;


-- Dumping structure for table violationsg.usuario
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `ciu_id` int(11) DEFAULT NULL,
  `usu_usuario` varchar(15) NOT NULL,
  `usu_email` varchar(150) NOT NULL,
  `usu_nombre` varchar(35) NOT NULL,
  `usu_apellido` varchar(35) NOT NULL,
  `usu_clave` char(32) NOT NULL,
  `usu_estado` char(1) NOT NULL,
  PRIMARY KEY (`usu_id`),
  UNIQUE KEY `usu_usuario` (`usu_usuario`),
  KEY `fk_usu_ciu_id` (`ciu_id`),
  CONSTRAINT `fk_usu_ciu_id` FOREIGN KEY (`ciu_id`) REFERENCES `ciudad` (`ciu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.usuario: ~1 rows (approximately)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`usu_id`, `ciu_id`, `usu_usuario`, `usu_email`, `usu_nombre`, `usu_apellido`, `usu_clave`, `usu_estado`) VALUES
	(1, 1, 'manucv', 'emanuelcarrasco@gmail.com', 'Emanuel', 'Carrasco', 'afa4557b6446efdc08d438626d80ecb9', 'A');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;


-- Dumping structure for table violationsg.vehiculo
DROP TABLE IF EXISTS `vehiculo`;
CREATE TABLE IF NOT EXISTS `vehiculo` (
  `veh_id` int(6) NOT NULL AUTO_INCREMENT,
  `tip_veh_id` int(4) NOT NULL,
  `veh_marca` varchar(150) NOT NULL,
  `veh_modelo` varchar(100) NOT NULL,
  `veh_placa` varchar(10) NOT NULL,
  `veh_camara_activa` char(1) NOT NULL,
  PRIMARY KEY (`veh_id`),
  KEY `fk_veh_tip_veh_id` (`tip_veh_id`),
  CONSTRAINT `fk_veh_tip_veh_id` FOREIGN KEY (`tip_veh_id`) REFERENCES `tipo_vehiculo` (`tip_veh_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.vehiculo: ~2 rows (approximately)
DELETE FROM `vehiculo`;
/*!40000 ALTER TABLE `vehiculo` DISABLE KEYS */;
INSERT INTO `vehiculo` (`veh_id`, `tip_veh_id`, `veh_marca`, `veh_modelo`, `veh_placa`, `veh_camara_activa`) VALUES
	(1, 1, 'Cinascar', 'Van Pass', 'RJI-1902', 'S'),
	(2, 1, 'Cinascar', 'Van model', 'ABC-1342', 'N');
/*!40000 ALTER TABLE `vehiculo` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
