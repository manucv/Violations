-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.40-0ubuntu0.14.04.1 - (Ubuntu)
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
  PRIMARY KEY (`apl_id`),
  UNIQUE KEY `apl_descripcion` (`apl_descripcion`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.aplicacion: ~94 rows (approximately)
DELETE FROM `aplicacion`;
/*!40000 ALTER TABLE `aplicacion` DISABLE KEYS */;
INSERT INTO `aplicacion` (`apl_id`, `apl_descripcion`, `apl_nombre`) VALUES
	(1, 'application:index', 'Modulo Application'),
	(2, 'application:index:index', 'Resetear Pasword (Console)'),
	(4, 'application:login', 'Modulo Login'),
	(5, 'application:login:index', 'Login de Usuario'),
	(6, 'application:login:autenticar', 'Autenticar Usuario'),
	(7, 'application:login:logout', 'Salir del Sistema'),
	(8, 'application:login:denied', 'Permiso denegado'),
	(9, 'parametros:index', 'Modulo de Parametros'),
	(10, 'parametros:index:index', 'Pagina Inicial'),
	(11, 'application:error', 'Modulo Error'),
	(12, 'application:error:denied', 'Permiso denegado'),
	(13, 'parametros:pais', 'Modulo Pais'),
	(14, 'parametros:pais:listado', 'Listado de Paises'),
	(15, 'parametros:estado', 'Modulo Estados'),
	(16, 'parametros:estado:listado', 'Listado de Estados'),
	(17, 'parametros:ciudad', 'Modulo Ciudad'),
	(18, 'parametros:ciudad:listado', 'Listado Ciudades'),
	(19, 'parametros:sector', 'Modulo Sector'),
	(20, 'parametros:sector:listado', 'Listado Sectores'),
	(21, 'parametros:tipoinfraccion', 'Modulo Tipo Infraccion'),
	(22, 'parametros:tipoinfraccion:listado', 'Listado de Tipos de Infraccion'),
	(23, 'usuarios:usuarios', 'Modulo Usuarios'),
	(24, 'usuarios:usuarios:index', 'Listado de Usuarios'),
	(25, 'usuarios:aplicaciones', 'Modulo Aplicaciones'),
	(26, 'usuarios:aplicaciones:listado', 'Listado Aplicaciones'),
	(27, 'usuarios:roles', 'Modulo Roles'),
	(28, 'usuarios:roles:listado', 'Listado de Roles'),
	(29, 'usuarios:menu', 'Modulo Menu'),
	(30, 'usuarios:menu:index', 'Listado Menu'),
	(31, 'infraccion:infraccion', 'Modulo Infraccion'),
	(32, 'infraccion:infraccion:index', 'Listado Infracciones'),
	(33, 'parqueaderos:parqueaderos', 'Modulo Parqueaderos'),
	(34, 'parqueaderos:parqueaderos:index', 'Busqueda Parqueadero'),
	(37, 'parametros:sector:sucursalesAjax', 'Sucursales Ajax'),
	(38, 'parametros:sector:ciudadesAjax', 'Ciudades Ajax'),
	(39, 'parqueaderos:parqueaderos:sectores', 'Sectores Ajax'),
	(40, 'parqueaderos:sector', 'Modulo Parqueadero Sector'),
	(41, 'parqueaderos:sector:index', 'Listado de Parqueaderos por sector'),
	(42, 'parqueaderos:parqueaderos:ocupados', 'Parqueaderos Ocupados'),
	(43, 'parqueaderos:parqueaderos:multados', 'Parqueaderos Multados'),
	(44, 'parqueaderos:parqueaderos:agregar', 'Agregar Parqueadero Ocupado'),
	(45, 'clientes:index', 'Modulo Clientes'),
	(46, 'clientes:asignar', 'Modulo Asignar Usuarios a transferencias de dinero'),
	(47, 'clientes:compras', 'Modulo Compras de parqueadero'),
	(48, 'clientes:recargas', 'Modulo Recargas'),
	(49, 'clientes:transferenciasrealizadas', 'Modulo Transferencias Realizadas'),
	(50, 'clientes:transferenciasrecibidas', 'Modulo Transferencias Recibidas'),
	(51, 'parametros:parqueadero', 'Modulo Parametros Parqueaderos'),
	(52, 'parametros:parqueadero:listado', 'Modulo Parametros Parqueaderos'),
	(53, 'clientes:index:index', 'Modulo Transacciones (SOLO CLIENTE)'),
	(54, 'parametros:pais:ingresar', 'Ingresar Pais'),
	(55, 'parametros:pais:validar', 'Validar Formulario Pais'),
	(56, 'parametros:pais:editar', 'Actualizar Pais'),
	(57, 'parametros:pais:eliminar', 'Eliminar Pais'),
	(58, 'parametros:estado:ingresar', 'Ingresar Estado'),
	(59, 'parametros:estado:validar', 'Validar Formulario Estado'),
	(60, 'parametros:estado:editar', 'Actualizar Estado'),
	(61, 'parametros:estado:eliminar', 'Eliminar Estado'),
	(62, 'parametros:ciudad:ingresar', 'Ingresar Ciudad'),
	(63, 'parametros:ciudad:validar', 'Validar Formulario Ciudad'),
	(64, 'parametros:ciudad:editar', 'Actualizar Ciudad'),
	(65, 'parametros:ciudad:eliminar', 'Eliminar Ciudad'),
	(66, 'parametros:sector:ingresar', 'Ingresar Sector'),
	(67, 'parametros:sector:validar', 'Validar Formulario Sector'),
	(68, 'parametros:sector:editar', 'Actualizar Sector'),
	(69, 'parametros:sector:eliminar', 'Eliminar Sector'),
	(70, 'parametros:parqueadero:ingresar', 'Ingresar Parqueadero'),
	(71, 'parametros:parqueadero:validar', 'Validar Formulario Parqueadero'),
	(72, 'parametros:parqueadero:editar', 'Actualizar Parqueadero'),
	(73, 'parametros:parqueadero:eliminar', 'Eliminar Parqueadero'),
	(74, 'parametros:tipoinfraccion:ingresar', 'Ingresar Tipo Infraccion'),
	(75, 'parametros:tipoinfraccion:validar', 'Validar Formulario Tipo Infraccion'),
	(76, 'parametros:tipoinfraccion:editar', 'Actualizar Tipo Infraccion'),
	(77, 'parametros:tipoinfraccion:eliminar', 'Eliminar Tipo Infraccion'),
	(78, 'usuarios:usuarios:add', 'Ingresar Usuario'),
	(79, 'usuarios:usuarios:validar', 'Validar Formulario Usuario'),
	(80, 'usuarios:usuarios:edit', 'Actualizar Usuario'),
	(81, 'usuarios:usuarios:asociar', 'Asociar Perfiles a Usuarios'),
	(82, 'usuarios:usuarios:validarRolUsuario', 'Validar Formulario Asociar Permiso'),
	(83, 'usuarios:usuarios:eliminar', 'Eliminar Usuario'),
	(84, 'usuarios:roles:ingresar', 'Ingresar Rol'),
	(85, 'usuarios:roles:validar', 'Validar Formulario Asignar Aplicaciones a Roles'),
	(86, 'usuarios:roles:editar', 'Actualizar Rol'),
	(87, 'usuarios:roles:eliminar', 'Eliminar Rol'),
	(88, 'usuarios:menu:ingresar', 'Ingresar Menu'),
	(89, 'usuarios:menu:validar', 'Validar Formulario Menu'),
	(90, 'usuarios:menu:editar', 'Actualizar Menu'),
	(91, 'usuarios:menu:eliminar', 'Eliminar Menu'),
	(93, 'clientes:asignar:index', 'Asignar usuarios para transferir dinero (SOLO CLIENTE)'),
	(94, 'clientes:compras:index', 'Compras de parqueo (SOLO CLIENTE)'),
	(96, 'clientes:recargas:index', 'Recargas de dinero (SOLO CLIENTE)'),
	(97, 'clientes:transferenciasrealizadas:index', 'Transferencias Realizadas (SOLO CLIENTE)'),
	(98, 'clientes:transferenciasrecibidas:index', 'Transferencias Recibidas (SOLO CLIENTE)'),
	(99, 'clientes:index:listado', 'Listado de Clientes');
/*!40000 ALTER TABLE `aplicacion` ENABLE KEYS */;


-- Dumping structure for table violationsg.automovil
DROP TABLE IF EXISTS `automovil`;
CREATE TABLE IF NOT EXISTS `automovil` (
  `aut_placa` varchar(10) NOT NULL,
  PRIMARY KEY (`aut_placa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.automovil: ~44 rows (approximately)
DELETE FROM `automovil`;
/*!40000 ALTER TABLE `automovil` DISABLE KEYS */;
INSERT INTO `automovil` (`aut_placa`) VALUES
	('123poi'),
	('abc1234'),
	('ABCD123'),
	('asd344'),
	('PBB494'),
	('PBJ973'),
	('PBL915'),
	('PBP973'),
	('PBU547'),
	('PCQ101'),
	('PDC024'),
	('PDC456'),
	('PDD792'),
	('PER591'),
	('PFA404'),
	('PGB661'),
	('PIC010'),
	('PJA729'),
	('PJI826'),
	('PJV800'),
	('PLN953'),
	('PMD747'),
	('PMO328'),
	('PNF811'),
	('PNR574'),
	('PNZ469'),
	('POB832'),
	('POP213'),
	('PRC446'),
	('PRO158'),
	('PSE524'),
	('PTD794'),
	('PTI556'),
	('PUO661'),
	('PVW287'),
	('PWS910'),
	('PXJ824'),
	('PXK045'),
	('PXQ787'),
	('PYB945'),
	('PZG974'),
	('PZK373'),
	('PZP791'),
	('PZY349');
/*!40000 ALTER TABLE `automovil` ENABLE KEYS */;


-- Dumping structure for table violationsg.categoria
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_nombre` varchar(45) DEFAULT NULL,
  `cat_descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.categoria: ~1 rows (approximately)
DELETE FROM `categoria`;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`cat_id`, `cat_nombre`, `cat_descripcion`) VALUES
	(1, 'Servicios', 'Servicios');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;


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


-- Dumping structure for table violationsg.cliente
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `cli_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_id` int(11) NOT NULL,
  `cli_saldo` decimal(10,2) NOT NULL,
  `cli_foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cli_id`),
  KEY `fk_cliente_usuario1` (`usu_id`),
  CONSTRAINT `fk_cliente_usuario1` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.cliente: ~1 rows (approximately)
DELETE FROM `cliente`;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`cli_id`, `usu_id`, `cli_saldo`, `cli_foto`) VALUES
	(1, 3, 700.00, NULL);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;


-- Dumping structure for table violationsg.compra_saldo
DROP TABLE IF EXISTS `compra_saldo`;
CREATE TABLE IF NOT EXISTS `compra_saldo` (
  `com_sal_id` int(11) NOT NULL AUTO_INCREMENT,
  `cli_id` int(11) NOT NULL,
  `punto_recarga_pun_rec_id` int(11) NOT NULL,
  `com_sal_valor` float DEFAULT NULL,
  `com_sal_hora` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`com_sal_id`),
  KEY `fk_compra_saldo_parqueadero_cliente1_idx` (`cli_id`),
  KEY `fk_compra_saldo_parqueadero_punto_recarga1_idx` (`punto_recarga_pun_rec_id`),
  CONSTRAINT `fk_compra_saldo_parqueadero_cliente1` FOREIGN KEY (`cli_id`) REFERENCES `cliente` (`cli_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_compra_saldo_parqueadero_punto_recarga1` FOREIGN KEY (`punto_recarga_pun_rec_id`) REFERENCES `punto_recarga` (`pun_rec_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.compra_saldo: ~0 rows (approximately)
DELETE FROM `compra_saldo`;
/*!40000 ALTER TABLE `compra_saldo` DISABLE KEYS */;
/*!40000 ALTER TABLE `compra_saldo` ENABLE KEYS */;


-- Dumping structure for table violationsg.establecimiento
DROP TABLE IF EXISTS `establecimiento`;
CREATE TABLE IF NOT EXISTS `establecimiento` (
  `eta_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `eta_nombre` varchar(45) DEFAULT NULL,
  `eta_descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`eta_id`),
  KEY `fk_establecimientos_categorias_idx` (`cat_id`),
  CONSTRAINT `fk_establecimientos_categorias` FOREIGN KEY (`cat_id`) REFERENCES `categoria` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.establecimiento: ~1 rows (approximately)
DELETE FROM `establecimiento`;
/*!40000 ALTER TABLE `establecimiento` DISABLE KEYS */;
INSERT INTO `establecimiento` (`eta_id`, `cat_id`, `eta_nombre`, `eta_descripcion`) VALUES
	(1, 1, 'Parqueaderos', 'Parqueaderos');
/*!40000 ALTER TABLE `establecimiento` ENABLE KEYS */;


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
	(1, 63, 'Pichincha', 'Pichincha'),
	(2, 64, 'Region Metropolitana', 'Region Metropolitana'),
	(3, 66, 'Buenos aires', 'Buenos aires'),
	(4, 63, 'Guayas', 'Guayas');
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


-- Dumping structure for table violationsg.log
DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_hora` datetime DEFAULT NULL,
  `log_descripcion` varchar(45) DEFAULT NULL,
  `log_info` text,
  `cli_id` int(11) NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `fk_logs_clientes1_idx` (`cli_id`),
  CONSTRAINT `fk_logs_clientes1` FOREIGN KEY (`cli_id`) REFERENCES `cliente` (`cli_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.log: ~0 rows (approximately)
DELETE FROM `log`;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;


-- Dumping structure for table violationsg.log_parqueadero
DROP TABLE IF EXISTS `log_parqueadero`;
CREATE TABLE IF NOT EXISTS `log_parqueadero` (
  `log_par_id` int(11) NOT NULL AUTO_INCREMENT,
  `par_id` varchar(10) NOT NULL,
  `aut_placa` varchar(10) NOT NULL,
  `log_par_fecha_ingreso` datetime NOT NULL,
  `log_par_fecha_salida` datetime NOT NULL,
  `log_par_horas_parqueo` int(11) NOT NULL,
  `log_par_estado` char(1) NOT NULL,
  `tra_id` int(11) NOT NULL,
  PRIMARY KEY (`log_par_id`),
  KEY `fk_log_parqueadero_par_id` (`par_id`),
  KEY `fk_log_parqueadero_aut_placa` (`aut_placa`),
  KEY `fk_log_parqueadero_transaccion1` (`tra_id`),
  CONSTRAINT `fk_log_parqueadero_aut_placa` FOREIGN KEY (`aut_placa`) REFERENCES `automovil` (`aut_placa`),
  CONSTRAINT `fk_log_parqueadero_par_id` FOREIGN KEY (`par_id`) REFERENCES `parqueadero` (`par_id`),
  CONSTRAINT `fk_log_parqueadero_transaccion1` FOREIGN KEY (`tra_id`) REFERENCES `transaccion` (`tra_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.log_parqueadero: ~33 rows (approximately)
DELETE FROM `log_parqueadero`;
/*!40000 ALTER TABLE `log_parqueadero` DISABLE KEYS */;
INSERT INTO `log_parqueadero` (`log_par_id`, `par_id`, `aut_placa`, `log_par_fecha_ingreso`, `log_par_fecha_salida`, `log_par_horas_parqueo`, `log_par_estado`, `tra_id`) VALUES
	(5, 'Q027', 'POB832', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 1, 'D', 1),
	(6, 'Q025', 'PER591', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 2, 'D', 1),
	(7, 'Q022', 'PXQ787', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 2, 'D', 1),
	(8, 'Q021', 'PSE524', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 2, 'D', 1),
	(9, 'Q023', 'PFA404', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 1, 'D', 1),
	(10, 'Q010', 'POP213', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 2, 'D', 1),
	(11, 'Q031', 'PTD794', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 2, 'D', 1),
	(12, 'Q028', 'PWS910', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 1, 'D', 1),
	(13, 'Q026', 'PDD792', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 1, 'D', 1),
	(14, 'Q007', 'PJV800', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 1, 'D', 1),
	(15, 'Q029', 'PRC446', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 1, 'D', 1),
	(16, 'Q012', 'PTI556', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 1, 'D', 1),
	(17, 'Q015', 'PNR574', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 1, 'D', 1),
	(18, 'Q020', 'PBP973', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 1, 'D', 1),
	(19, 'Q030', 'PUO661', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 1, 'D', 1),
	(21, 'Q024', 'PNF811', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 2, 'D', 1),
	(22, 'Q031', 'PBJ973', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 2, 'D', 1),
	(23, 'Q028', 'PMO328', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 2, 'D', 1),
	(24, 'Q016', 'PZG974', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 1, 'D', 1),
	(25, 'Q005', 'PLN953', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 2, 'D', 1),
	(26, 'EC123', 'PBB494', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 2, 'D', 1),
	(27, 'Q033', 'PXJ824', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 2, 'D', 1),
	(28, 'Q005', 'PVW287', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 1, 'D', 1),
	(29, 'Q026', 'PRO158', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 2, 'D', 1),
	(30, 'Q015', 'PCQ101', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 1, 'O', 1),
	(31, 'Q028', 'PZK373', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 1, 'O', 1),
	(32, 'Q008', 'PGB661', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 1, 'O', 1),
	(33, 'Q011', 'PBU547', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 1, 'O', 1),
	(34, 'Q025', 'PJI826', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 1, 'O', 1),
	(35, 'Q006', 'PNZ469', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 1, 'O', 1),
	(36, 'Q030', 'PJA729', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 1, 'O', 1),
	(37, 'Q019', 'PYB945', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 1, 'O', 1),
	(38, 'Q027', 'PZP791', '2014-10-20 21:26:37', '0000-00-00 00:00:00', 1, 'O', 1);
/*!40000 ALTER TABLE `log_parqueadero` ENABLE KEYS */;


-- Dumping structure for table violationsg.menu
DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `men_id` int(11) NOT NULL AUTO_INCREMENT,
  `apl_id` int(4) DEFAULT NULL,
  `men_nombre` varchar(200) NOT NULL,
  `men_etiqueta` varchar(200) NOT NULL,
  `men_icon` varchar(100) NOT NULL,
  `men_padre` int(11) NOT NULL,
  `men_divisor` char(1) NOT NULL,
  PRIMARY KEY (`men_id`),
  KEY `fk_menu_aplicacion1` (`apl_id`),
  CONSTRAINT `fk_menu_aplicacion1` FOREIGN KEY (`apl_id`) REFERENCES `aplicacion` (`apl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.menu: ~27 rows (approximately)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`men_id`, `apl_id`, `men_nombre`, `men_etiqueta`, `men_icon`, `men_padre`, `men_divisor`) VALUES
	(1, 9, 'Parametros', 'Parámetros ', '<i class="fa fa-gears fa-fw"></i>', 0, 'N'),
	(2, 23, 'Administracion', 'Administración', '<i class="fa fa-users fa-fw"></i>', 0, 'N'),
	(3, 14, 'Paises', 'Paises', '<i class="fa fa-globe fa-fw"></i>', 1, 'N'),
	(4, 16, 'Estados', 'Estados', '<i class="fa fa-building fa-fw"></i>', 1, 'N'),
	(5, 24, 'Usuarios', 'Usuarios', '<i class="fa fa-user fa-fw"></i>', 2, 'N'),
	(8, 18, 'Ciudades', 'Ciudades', '<i class="fa fa-building-o fa-fw"></i>', 1, 'S'),
	(9, 20, 'Sector', 'Sector', '<i class="fa fa-map-marker fa-fw"></i>', 1, 'N'),
	(10, 52, 'Parqueadero', 'Parqueadero', '<i class="fa fa-location-arrow fa-fw"></i>', 1, 'S'),
	(13, 22, 'TipoInfraccion', 'Tipo Infracción', '<i class="fa fa-ticket fa-fw"></i>', 1, 'S'),
	(15, NULL, 'Parametros Generales', 'Parametros Generales', '<i class="fa fa-cog fa-fw"></i>', 1, 'N'),
	(16, 28, 'Roles', 'Roles', '<i class="fa fa-child fa-fw"></i>', 2, 'N'),
	(17, 26, 'Aplicaciones', 'Aplicaciones', '<i class="fa fa-list fa-fw"></i>', 2, 'N'),
	(19, 32, 'Infracciones', 'Infracciones', '<i class="fa fa-list-ol fa-fw"></i>', 0, 'N'),
	(22, 34, 'Parqueaderos', 'Parqueaderos', '<i class="fa fa-road fa-fw"></i>', 0, 'N'),
	(23, 30, 'Menu', 'Menú', '<i class="fa fa-navicon fa-fw"></i>', 2, 'N'),
	(24, 53, 'transacciones', 'Mis Transacciones', '<i class="fa fa-search fa-fw"></i>', 0, 'N'),
	(25, NULL, 'compras', 'Pagos en parqueaderos', '<i class="fa fa-search fa-fw"></i>', 24, 'S'),
	(26, NULL, 'recargas', 'Recarga de dinero', '<i class="fa fa-search fa-fw"></i>', 24, 'S'),
	(27, NULL, 'transferenciasRealizadas', 'Transferencias Realizadas', '<i class="fa fa-search fa-fw"></i>', 24, 'S'),
	(28, NULL, 'transferenciasRecibidas', 'Transferencias Recibidas', '<i class="fa fa-search fa-fw"></i>', 24, 'N'),
	(29, NULL, 'transferirDinero', 'Transferir Dinero', '<i class="fa fa-search fa-fw"></i>', 0, 'N'),
	(30, 99, 'Clientes', 'Clientes', '<i class="fa fa-search fa-fw"></i>', 0, 'N'),
	(33, 94, 'pagosParqueo', 'Compras de parqueadero', '<i class="fa fa-search fa-fw"></i>', 24, 'N'),
	(34, 96, 'recargasDinero', 'Recargas de Dinero', '<i class="fa fa-search fa-fw"></i>', 24, 'N'),
	(35, 93, 'asignarUsuarios', 'Transferir Dinero', '<i class="fa fa-search fa-fw"></i>', 24, 'N'),
	(36, 97, 'transferenciaRealizada', 'Transferencias Realizadas', '<i class="fa fa-search fa-fw"></i>', 24, 'N'),
	(37, 98, 'transferenciasRecibidas', 'Transferencias Recibidas', '<i class="fa fa-search fa-fw"></i>', 24, 'N');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


-- Dumping structure for table violationsg.pais
DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
  `pai_id` int(4) NOT NULL AUTO_INCREMENT,
  `pai_nombre_es` varchar(120) NOT NULL,
  `pai_nombre_en` varchar(120) NOT NULL,
  `pai_codigo_telefono` varchar(5) NOT NULL,
  PRIMARY KEY (`pai_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.pais: ~3 rows (approximately)
DELETE FROM `pais`;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` (`pai_id`, `pai_nombre_es`, `pai_nombre_en`, `pai_codigo_telefono`) VALUES
	(63, 'Ecuador', 'Ecuador', '593'),
	(64, 'Chile', 'Chile', '56'),
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

-- Dumping data for table violationsg.parqueadero: ~33 rows (approximately)
DELETE FROM `parqueadero`;
/*!40000 ALTER TABLE `parqueadero` DISABLE KEYS */;
INSERT INTO `parqueadero` (`par_id`, `par_estado`, `sec_id`) VALUES
	('', 'D', 6),
	('adf345', 'D', 6),
	('EC123', 'D', 1),
	('Q004', 'D', 5),
	('Q005', 'D', 5),
	('Q006', 'O', 5),
	('Q007', 'D', 5),
	('Q008', 'O', 5),
	('Q009', 'D', 5),
	('Q010', 'D', 5),
	('Q011', 'O', 5),
	('Q012', 'D', 5),
	('Q013', 'D', 5),
	('Q014', 'D', 5),
	('Q015', 'O', 5),
	('Q016', 'D', 5),
	('Q017', 'D', 5),
	('Q018', 'D', 5),
	('Q019', 'O', 5),
	('Q020', 'D', 5),
	('Q021', 'D', 5),
	('Q022', 'D', 5),
	('Q023', 'D', 5),
	('Q024', 'D', 5),
	('Q025', 'O', 5),
	('Q026', 'O', 5),
	('Q027', 'O', 5),
	('Q028', 'O', 5),
	('Q029', 'D', 5),
	('Q030', 'O', 5),
	('Q031', 'D', 5),
	('Q032', 'D', 5),
	('Q033', 'D', 5);
/*!40000 ALTER TABLE `parqueadero` ENABLE KEYS */;


-- Dumping structure for table violationsg.punto_recarga
DROP TABLE IF EXISTS `punto_recarga`;
CREATE TABLE IF NOT EXISTS `punto_recarga` (
  `pun_rec_id` int(11) NOT NULL AUTO_INCREMENT,
  `pun_rec_nombre` varchar(45) DEFAULT NULL,
  `pun_rec_ruc` varchar(45) DEFAULT NULL,
  `pun_rec_codigo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`pun_rec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.punto_recarga: ~0 rows (approximately)
DELETE FROM `punto_recarga`;
/*!40000 ALTER TABLE `punto_recarga` DISABLE KEYS */;
/*!40000 ALTER TABLE `punto_recarga` ENABLE KEYS */;


-- Dumping structure for table violationsg.relacion_cliente
DROP TABLE IF EXISTS `relacion_cliente`;
CREATE TABLE IF NOT EXISTS `relacion_cliente` (
  `rel_cli_id` int(11) NOT NULL AUTO_INCREMENT,
  `cli_id` int(11) NOT NULL,
  `cli_id_relacionado` int(11) NOT NULL,
  `rel_cli_hora` timestamp NULL DEFAULT NULL,
  `rel_cli_tipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`rel_cli_id`),
  KEY `fk_relacion_cliente_cliente1_idx` (`cli_id`),
  KEY `fk_relacion_cliente_cliente2_idx` (`cli_id_relacionado`),
  CONSTRAINT `fk_relacion_cliente_cliente1` FOREIGN KEY (`cli_id`) REFERENCES `cliente` (`cli_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_relacion_cliente_cliente2` FOREIGN KEY (`cli_id_relacionado`) REFERENCES `cliente` (`cli_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.relacion_cliente: ~0 rows (approximately)
DELETE FROM `relacion_cliente`;
/*!40000 ALTER TABLE `relacion_cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `relacion_cliente` ENABLE KEYS */;


-- Dumping structure for table violationsg.rol
DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `rol_id` int(4) NOT NULL AUTO_INCREMENT,
  `rol_descripcion` varchar(50) NOT NULL,
  `rol_estado` varchar(10) NOT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.rol: ~5 rows (approximately)
DELETE FROM `rol`;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`rol_id`, `rol_descripcion`, `rol_estado`) VALUES
	(1, 'Super Administrador', 'A'),
	(2, 'Administrador', 'A'),
	(3, 'Cliente', 'A'),
	(4, 'Vigilante', 'A'),
	(5, 'Invitado', 'A');
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

-- Dumping data for table violationsg.rol_aplicacion: ~155 rows (approximately)
DELETE FROM `rol_aplicacion`;
/*!40000 ALTER TABLE `rol_aplicacion` DISABLE KEYS */;
INSERT INTO `rol_aplicacion` (`rol_id`, `apl_id`) VALUES
	(2, 2),
	(1, 5),
	(2, 5),
	(3, 5),
	(1, 6),
	(2, 6),
	(3, 6),
	(1, 7),
	(2, 7),
	(3, 7),
	(1, 8),
	(2, 8),
	(3, 8),
	(1, 9),
	(2, 9),
	(1, 10),
	(2, 10),
	(3, 10),
	(2, 11),
	(3, 11),
	(1, 12),
	(2, 12),
	(3, 12),
	(1, 14),
	(2, 14),
	(1, 16),
	(2, 16),
	(1, 18),
	(2, 18),
	(1, 20),
	(2, 20),
	(1, 22),
	(2, 22),
	(1, 23),
	(2, 23),
	(1, 24),
	(2, 24),
	(1, 26),
	(2, 27),
	(1, 28),
	(2, 28),
	(1, 30),
	(2, 31),
	(1, 32),
	(2, 32),
	(2, 33),
	(3, 33),
	(1, 34),
	(2, 34),
	(3, 34),
	(1, 37),
	(2, 37),
	(3, 37),
	(1, 38),
	(2, 38),
	(3, 38),
	(1, 39),
	(2, 39),
	(3, 39),
	(2, 40),
	(1, 41),
	(2, 41),
	(3, 41),
	(1, 42),
	(2, 42),
	(3, 42),
	(1, 43),
	(2, 43),
	(3, 43),
	(1, 44),
	(2, 44),
	(1, 45),
	(2, 45),
	(2, 51),
	(1, 52),
	(2, 52),
	(3, 53),
	(1, 54),
	(2, 54),
	(1, 55),
	(2, 55),
	(1, 56),
	(2, 56),
	(1, 57),
	(2, 57),
	(1, 58),
	(2, 58),
	(1, 59),
	(2, 59),
	(1, 60),
	(2, 60),
	(1, 61),
	(2, 61),
	(1, 62),
	(2, 62),
	(1, 63),
	(2, 63),
	(1, 64),
	(2, 64),
	(1, 65),
	(2, 65),
	(1, 66),
	(2, 66),
	(1, 67),
	(2, 67),
	(1, 68),
	(2, 68),
	(1, 69),
	(2, 69),
	(1, 70),
	(2, 70),
	(1, 71),
	(2, 71),
	(1, 72),
	(2, 72),
	(1, 73),
	(2, 73),
	(1, 74),
	(2, 74),
	(1, 75),
	(2, 75),
	(1, 76),
	(2, 76),
	(1, 77),
	(2, 77),
	(1, 78),
	(2, 78),
	(1, 79),
	(2, 79),
	(1, 80),
	(2, 80),
	(1, 81),
	(2, 81),
	(1, 82),
	(2, 82),
	(1, 83),
	(2, 83),
	(1, 84),
	(2, 84),
	(1, 85),
	(2, 85),
	(1, 86),
	(2, 86),
	(1, 87),
	(2, 87),
	(1, 88),
	(1, 89),
	(1, 90),
	(1, 91),
	(3, 93),
	(3, 94),
	(3, 96),
	(3, 97),
	(3, 98),
	(1, 99);
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

-- Dumping data for table violationsg.rol_usuario: ~2 rows (approximately)
DELETE FROM `rol_usuario`;
/*!40000 ALTER TABLE `rol_usuario` DISABLE KEYS */;
INSERT INTO `rol_usuario` (`rol_id`, `usu_id`) VALUES
	(1, 1),
	(2, 2);
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
  `sec_valor_hora` decimal(10,2) NOT NULL,
  PRIMARY KEY (`sec_id`),
  KEY `fk_sector_ciudad_idx` (`ciu_id`),
  CONSTRAINT `fk_sector_ciudad` FOREIGN KEY (`ciu_id`) REFERENCES `ciudad` (`ciu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.sector: ~3 rows (approximately)
DELETE FROM `sector`;
/*!40000 ALTER TABLE `sector` DISABLE KEYS */;
INSERT INTO `sector` (`sec_id`, `sec_nombre`, `sec_latitud`, `sec_longitud`, `ciu_id`, `sec_ubicacion`, `sec_valor_hora`) VALUES
	(1, 'El Condado', -0.125281, -78.467361, 1, 'Juan molineros y calle d', 0.40),
	(5, 'El Labrador', -0.172981, -78.483574, 1, 'El Tiempo', 0.40),
	(6, 'Tumbco', -0.222741, -78.385780, 1, 'la morita', 0.40);
/*!40000 ALTER TABLE `sector` ENABLE KEYS */;


-- Dumping structure for table violationsg.tipo_infraccion
DROP TABLE IF EXISTS `tipo_infraccion`;
CREATE TABLE IF NOT EXISTS `tipo_infraccion` (
  `tip_inf_id` int(4) NOT NULL AUTO_INCREMENT,
  `tip_inf_descripcion` varchar(150) NOT NULL,
  PRIMARY KEY (`tip_inf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.tipo_infraccion: ~2 rows (approximately)
DELETE FROM `tipo_infraccion`;
/*!40000 ALTER TABLE `tipo_infraccion` DISABLE KEYS */;
INSERT INTO `tipo_infraccion` (`tip_inf_id`, `tip_inf_descripcion`) VALUES
	(1, 'Exceso Vehicular'),
	(2, 'Mal Parqueo');
/*!40000 ALTER TABLE `tipo_infraccion` ENABLE KEYS */;


-- Dumping structure for table violationsg.transaccion
DROP TABLE IF EXISTS `transaccion`;
CREATE TABLE IF NOT EXISTS `transaccion` (
  `tra_id` int(11) NOT NULL AUTO_INCREMENT,
  `eta_id` int(11) NOT NULL,
  `cli_id` int(11) NOT NULL,
  `tra_valor` decimal(10,2) NOT NULL,
  `tra_saldo` decimal(10,2) NOT NULL,
  `tra_fecha` datetime NOT NULL,
  PRIMARY KEY (`tra_id`),
  KEY `fk_transacciones_establecimientos1_idx` (`eta_id`),
  KEY `fk_transacciones_clientes1_idx` (`cli_id`),
  CONSTRAINT `fk_transacciones_clientes1` FOREIGN KEY (`cli_id`) REFERENCES `cliente` (`cli_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transaccion_establecimiento1` FOREIGN KEY (`eta_id`) REFERENCES `establecimiento` (`eta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.transaccion: ~1 rows (approximately)
DELETE FROM `transaccion`;
/*!40000 ALTER TABLE `transaccion` DISABLE KEYS */;
INSERT INTO `transaccion` (`tra_id`, `eta_id`, `cli_id`, `tra_valor`, `tra_saldo`, `tra_fecha`) VALUES
	(1, 1, 1, 0.80, 0.00, '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `transaccion` ENABLE KEYS */;


-- Dumping structure for table violationsg.transferencia_saldo
DROP TABLE IF EXISTS `transferencia_saldo`;
CREATE TABLE IF NOT EXISTS `transferencia_saldo` (
  `tra_sal_id` int(11) NOT NULL AUTO_INCREMENT,
  `cli_id_de` int(11) NOT NULL,
  `cli_id_para` int(11) NOT NULL,
  `tra_sal_valor` float DEFAULT NULL,
  `tra_sal_hora` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tra_sal_id`),
  KEY `fk_transferencia_saldo_cliente1_idx` (`cli_id_de`),
  KEY `fk_transferencia_saldo_cliente2_idx` (`cli_id_para`),
  CONSTRAINT `fk_transferencia_saldo_cliente1` FOREIGN KEY (`cli_id_de`) REFERENCES `cliente` (`cli_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transferencia_saldo_cliente2` FOREIGN KEY (`cli_id_para`) REFERENCES `cliente` (`cli_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.transferencia_saldo: ~0 rows (approximately)
DELETE FROM `transferencia_saldo`;
/*!40000 ALTER TABLE `transferencia_saldo` DISABLE KEYS */;
/*!40000 ALTER TABLE `transferencia_saldo` ENABLE KEYS */;


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
  `usu_fecha_registro` datetime NOT NULL,
  PRIMARY KEY (`usu_id`),
  UNIQUE KEY `usu_usuario` (`usu_usuario`),
  KEY `fk_usu_ciu_id` (`ciu_id`),
  CONSTRAINT `fk_usu_ciu_id` FOREIGN KEY (`ciu_id`) REFERENCES `ciudad` (`ciu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.usuario: ~5 rows (approximately)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`usu_id`, `ciu_id`, `usu_usuario`, `usu_email`, `usu_nombre`, `usu_apellido`, `usu_clave`, `usu_estado`, `usu_fecha_registro`) VALUES
	(1, 1, 'manucv', 'emanuelcarrasco@gmail.com', 'Emanuel', 'Carrasco', 'afa4557b6446efdc08d438626d80ecb9', 'A', '0000-00-00 00:00:00'),
	(2, 1, 'jose', 'jose@email.com', 'Jose', 'Jose', 'afa4557b6446efdc08d438626d80ecb9', 'A', '0000-00-00 00:00:00'),
	(3, 1, 'luis', 'lmponce@gmail.com', 'Luis', 'Ponce', 'afa4557b6446efdc08d438626d80ecb9', 'A', '2014-10-20 15:46:10'),
	(4, 1, 'Thomas', 'gerencia@ses.ec', 'Thomas', 'Fal.', '4a32fbff0fd7415ffedc13bb055475ec', 'A', '0000-00-00 00:00:00'),
	(5, 1, 'Vigilante1', 'vigilante@email.com', 'Vigilante1', 'Vigilante', '25490c7456ad7831b259dd8ec0675cbd', 'A', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;


-- Dumping structure for trigger violationsg.violations_automovil
DROP TRIGGER IF EXISTS `violations_automovil`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `violations_automovil` BEFORE INSERT ON `log_parqueadero` FOR EACH ROW INSERT IGNORE INTO `automovil` (
    `aut_placa`
)
VALUES (
NEW.aut_placa
)//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger violationsg.violations_ocupado
DROP TRIGGER IF EXISTS `violations_ocupado`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `violations_ocupado` AFTER INSERT ON `log_parqueadero` FOR EACH ROW UPDATE parqueadero SET par_estado=NEW.log_par_estado WHERE par_id=NEW.par_id//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
