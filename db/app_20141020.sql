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
CREATE TABLE IF NOT EXISTS `aplicacion` (
  `apl_id` int(4) NOT NULL AUTO_INCREMENT,
  `apl_descripcion` varchar(70) NOT NULL,
  `apl_nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`apl_id`),
  UNIQUE KEY `apl_descripcion` (`apl_descripcion`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.aplicacion: ~93 rows (approximately)
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
	(98, 'clientes:transferenciasrecibidas:index', 'Transferencias Recibidas (SOLO CLIENTE)');
/*!40000 ALTER TABLE `aplicacion` ENABLE KEYS */;


-- Dumping structure for table violationsg.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `men_id` int(11) NOT NULL AUTO_INCREMENT,
  `men_nombre` varchar(200) NOT NULL,
  `men_etiqueta` varchar(200) NOT NULL,
  `apl_id` int(4) DEFAULT NULL,
  `men_icon` varchar(100) NOT NULL,
  `men_padre` int(11) NOT NULL,
  `men_divisor` char(1) NOT NULL,
  PRIMARY KEY (`men_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.menu: ~27 rows (approximately)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`men_id`, `men_nombre`, `men_etiqueta`, `apl_id`, `men_icon`, `men_padre`, `men_divisor`) VALUES
	(1, 'Parametros', 'Parámetros ', 9, '<i class="fa fa-gears fa-fw"></i>', 0, 'N'),
	(2, 'Administracion', 'Administración', 23, '<i class="fa fa-users fa-fw"></i>', 0, 'N'),
	(3, 'Paises', 'Paises', 14, '<i class="fa fa-globe fa-fw"></i>', 1, 'N'),
	(4, 'Estados', 'Estados', 16, '<i class="fa fa-building fa-fw"></i>', 1, 'N'),
	(5, 'Usuarios', 'Usuarios', 24, '<i class="fa fa-user fa-fw"></i>', 2, 'N'),
	(8, 'Ciudades', 'Ciudades', 18, '<i class="fa fa-building-o fa-fw"></i>', 1, 'S'),
	(9, 'Sector', 'Sector', 20, '<i class="fa fa-map-marker fa-fw"></i>', 1, 'N'),
	(10, 'Parqueadero', 'Parqueadero', 52, '<i class="fa fa-location-arrow fa-fw"></i>', 1, 'S'),
	(13, 'TipoInfraccion', 'Tipo Infracción', 22, '<i class="fa fa-ticket fa-fw"></i>', 1, 'S'),
	(15, 'Parametros Generales', 'Parametros Generales', NULL, '<i class="fa fa-cog fa-fw"></i>', 1, 'N'),
	(16, 'Roles', 'Roles', 28, '<i class="fa fa-child fa-fw"></i>', 2, 'N'),
	(17, 'Aplicaciones', 'Aplicaciones', 26, '<i class="fa fa-list fa-fw"></i>', 2, 'N'),
	(19, 'Infracciones', 'Infracciones', 32, '<i class="fa fa-list-ol fa-fw"></i>', 0, 'N'),
	(22, 'Parqueaderos', 'Parqueaderos', 34, '<i class="fa fa-road fa-fw"></i>', 0, 'N'),
	(23, 'Menu', 'Menú', 30, '<i class="fa fa-navicon fa-fw"></i>', 2, 'N'),
	(24, 'transacciones', 'Mis Transacciones', 53, '<i class="fa fa-search fa-fw"></i>', 0, 'N'),
	(25, 'compras', 'Pagos en parqueaderos', NULL, '<i class="fa fa-search fa-fw"></i>', 24, 'S'),
	(26, 'recargas', 'Recarga de dinero', NULL, '<i class="fa fa-search fa-fw"></i>', 24, 'S'),
	(27, 'transferenciasRealizadas', 'Transferencias Realizadas', NULL, '<i class="fa fa-search fa-fw"></i>', 24, 'S'),
	(28, 'transferenciasRecibidas', 'Transferencias Recibidas', NULL, '<i class="fa fa-search fa-fw"></i>', 24, 'N'),
	(29, 'transferirDinero', 'Transferir Dinero', NULL, '<i class="fa fa-search fa-fw"></i>', 0, 'N'),
	(30, 'Clientes', 'Clientes', 45, '<i class="fa fa-search fa-fw"></i>', 0, 'N'),
	(33, 'pagosParqueo', 'Compras de parqueadero', 94, '<i class="fa fa-search fa-fw"></i>', 24, 'N'),
	(34, 'recargasDinero', 'Recargas de Dinero', 96, '<i class="fa fa-search fa-fw"></i>', 24, 'N'),
	(35, 'asignarUsuarios', 'Transferir Dinero', 93, '<i class="fa fa-search fa-fw"></i>', 24, 'N'),
	(36, 'transferenciaRealizada', 'Transferencias Realizadas', 97, '<i class="fa fa-search fa-fw"></i>', 24, 'N'),
	(37, 'transferenciasRecibidas', 'Transferencias Recibidas', 98, '<i class="fa fa-search fa-fw"></i>', 24, 'N');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


-- Dumping structure for table violationsg.rol
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
CREATE TABLE IF NOT EXISTS `rol_aplicacion` (
  `rol_id` int(4) NOT NULL,
  `apl_id` int(4) NOT NULL,
  PRIMARY KEY (`rol_id`,`apl_id`),
  KEY `fk_rol_apl_apl_id` (`apl_id`),
  CONSTRAINT `fk_rol_apl_apl_id` FOREIGN KEY (`apl_id`) REFERENCES `aplicacion` (`apl_id`),
  CONSTRAINT `fk_rol_apl_rol_id` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.rol_aplicacion: ~154 rows (approximately)
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
	(3, 98);
/*!40000 ALTER TABLE `rol_aplicacion` ENABLE KEYS */;


-- Dumping structure for table violationsg.rol_usuario
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


-- Dumping structure for table violationsg.usuario
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table violationsg.usuario: ~4 rows (approximately)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`usu_id`, `ciu_id`, `usu_usuario`, `usu_email`, `usu_nombre`, `usu_apellido`, `usu_clave`, `usu_estado`) VALUES
	(1, 1, 'manucv', 'emanuelcarrasco@gmail.com', 'Emanuel', 'Carrasco', 'afa4557b6446efdc08d438626d80ecb9', 'A'),
	(2, 1, 'jose', 'jose@email.com', 'Jose', 'Jose', 'afa4557b6446efdc08d438626d80ecb9', 'A'),
	(4, 1, 'Thomas', 'gerencia@ses.ec', 'Thomas', 'Fal.', '4a32fbff0fd7415ffedc13bb055475ec', 'A'),
	(5, 1, 'Vigilante1', 'vigilante@email.com', 'Vigilante1', 'Vigilante', '25490c7456ad7831b259dd8ec0675cbd', 'A');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
