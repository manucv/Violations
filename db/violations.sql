-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 13, 2015 at 09:56 PM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `violations`
--

-- --------------------------------------------------------

--
-- Table structure for table `aplicacion`
--

CREATE TABLE `aplicacion` (
  `apl_id` int(4) NOT NULL,
  `apl_descripcion` varchar(70) NOT NULL,
  `apl_nombre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aplicacion`
--

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
(99, 'clientes:index:listado', 'Listado de Clientes'),
(100, 'clientes:compras:transaccion', 'Listado de Transacciones'),
(102, 'reportes:index', 'Modulo Reportes'),
(103, 'reportes:index:index', 'Reporte 1'),
(104, 'reportes:index:xchart', 'Reporte 2'),
(105, 'reportes:index:chartsgoogle', 'Reporte 3'),
(106, 'reportes:index:chartsmorris', 'Reporte 4'),
(107, 'parametros:index:video', 'Video Parqueo'),
(108, 'clientes:perfil', 'Perfil de Cliente'),
(109, 'clientes:perfil:perfil', 'Detalle perfil cliente'),
(110, 'api:api', 'Modulo Api'),
(111, 'application:console', 'consola'),
(112, 'application:console:parqueaderos', 'consola indice'),
(113, 'api:vigilante', 'api vigilante'),
(114, 'parametros:puntorecarga', 'Puntos de Recarga'),
(115, 'parametros:puntorecarga:listado', 'Listado de Puntos de Recarga'),
(116, 'parametros:puntorecarga:ingresar', 'Ingresar Punto de Recarga'),
(117, 'parametros:puntorecarga:validar', 'Validar Punto de Recarga'),
(118, 'parametros:puntorecarga:editar', 'Editar Punto de Recarga'),
(119, 'parametros:listablanca', 'Lista Blanca'),
(120, 'parametros:listablanca:listado', 'Lista Blanca'),
(121, 'parametros:listablanca:ingresar', 'Ingreso Lista Blanca'),
(122, 'parametros:listablanca:editar', 'Editar Lista Blanca'),
(123, 'parametros:listablanca:validar', 'Validar Lista Blanca'),
(124, 'parametros:calle', 'Calles'),
(125, 'parametros:calle:listado', 'Listado de Calles'),
(126, 'parametros:calle:ingresar', 'Ingresar Calle'),
(127, 'parametros:calle:validar', 'Validar Calle'),
(128, 'parametros:calle:editar', 'Editar Calle'),
(129, 'parametros:puntorecarga:cargar', 'Cargar Punto'),
(130, 'parametros:puntorecarga:saldo', 'Saldo en Punto'),
(131, 'tiendas:index', 'Tiendas'),
(132, 'tiendas:index:autenticar', 'Autenticar Punto de Recarga'),
(133, 'tiendas:index:buscar', 'Buscar Persona'),
(134, 'tiendas:index:recargar', 'Recargar Saldo'),
(135, 'infraccion:infraccion:detalle', 'Detalle de Infracción');

-- --------------------------------------------------------

--
-- Table structure for table `automovil`
--

CREATE TABLE `automovil` (
  `aut_placa` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `automovil`
--

INSERT INTO `automovil` (`aut_placa`) VALUES
('12345'),
('123gvf'),
('123poi'),
('9:30'),
('a hay'),
('AAA0001'),
('aaa111'),
('Aaa123'),
('aaa211'),
('AAA3333'),
('AAA678'),
('ABC111'),
('ABC123'),
('abc1234'),
('ABCD123'),
('ADD1234'),
('ADY0221'),
('AEI0009'),
('asd'),
('ASD1111'),
('asd123'),
('asd1234'),
('ASD1235'),
('ASD1425'),
('asd344'),
('ASD4122'),
('ASD5751'),
('ASD765'),
('ASDF123'),
('ASF5555'),
('bbbb'),
('BCD234'),
('bhg325'),
('carro1'),
('carro2'),
('CCC123'),
('Chc666'),
('CHI123'),
('CHI666'),
('chin001'),
('chin123'),
('CRY1265'),
('CVG2356'),
('dfr654'),
('dgghi'),
('DHD456'),
('EEE1111'),
('eee2344'),
('EJE1234'),
('Eje2222'),
('EMA123'),
('erre'),
('ert111'),
('EYEY'),
('FDJG'),
('Fff111'),
('FGF8523'),
('fghu'),
('FGT'),
('fin'),
('final'),
('g000'),
('gfd1234'),
('ibl0000'),
('ibl0933'),
('ibl933'),
('ijijij'),
('jajsjs'),
('jqua'),
('LBA2964'),
('local'),
('new'),
('notifTest'),
('ORH172'),
('PAG120'),
('pbb1771'),
('PBB494'),
('PBB5353'),
('PBB6655'),
('PBC1234'),
('pbd8898'),
('PBD8899'),
('pbf6048'),
('PBJ1111'),
('PBJ973'),
('PBL2228'),
('PBL915'),
('PBO1234'),
('PBO8173'),
('PBP973'),
('pbt6649'),
('PBU547'),
('PBXOIO'),
('PBZ4740'),
('PCB5751'),
('PCH8678'),
('PCI7723'),
('PCJ5751'),
('pck5858'),
('PCK9186'),
('PCQ101'),
('PDA9388'),
('PDC024'),
('PDC456'),
('PDD792'),
('PER591'),
('PFA404'),
('PGB661'),
('PIC010'),
('PIG111'),
('PIG122'),
('PIG123'),
('pig1234'),
('PIG124'),
('pip2345'),
('PJA729'),
('PJI826'),
('PJV800'),
('placa'),
('PLK3452'),
('PLN953'),
('PLU5689'),
('PMD747'),
('PMO328'),
('PNF811'),
('PNR574'),
('PNZ469'),
('PO0110'),
('POB832'),
('POL009'),
('POL0110'),
('pol0111'),
('pol110'),
('POL111'),
('POP213'),
('PPB070'),
('ppp0123'),
('PPP111'),
('PPP123'),
('PPP1234'),
('PPP222'),
('PPPPP'),
('PRC446'),
('PRO158'),
('PSE524'),
('PTD794'),
('PTI556'),
('PUG123'),
('PUG666'),
('PUL100'),
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
('PZY349'),
('QQQ1233'),
('QWE1111'),
('qwe1254'),
('QWE2323'),
('QWE2451'),
('QZC666'),
('RED0001'),
('RED111'),
('red1234'),
('RRR111'),
('sad1234'),
('sasa'),
('TDH398'),
('test'),
('TEST123'),
('tester'),
('tst123'),
('TTT1234'),
('TTT444'),
('ttt4444'),
('TTT5678'),
('ttttt'),
('uqusjsj'),
('UUYYYG'),
('vhhj'),
('WED5689'),
('wwwww'),
('XXA2964'),
('XXB5353'),
('XXC8785'),
('XXH398'),
('XXL2228'),
('XXQ663'),
('XXUAD0R'),
('ygf'),
('ygyg');

-- --------------------------------------------------------

--
-- Table structure for table `calle`
--

CREATE TABLE `calle` (
  `cal_id` int(11) NOT NULL,
  `cal_codigo` varchar(45) DEFAULT NULL,
  `cal_nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calle`
--

INSERT INTO `calle` (`cal_id`, `cal_codigo`, `cal_nombre`) VALUES
(1, 'AC', 'AV. MARIANO ACOSTA'),
(4, 'AT', 'JUANA ATABALIPA'),
(5, 'BA', 'BARTOLOME GARCÍA'),
(6, 'BO', 'BOLÍVAR'),
(7, 'BR', 'EUCEBIO BORRERO'),
(8, 'CA', 'LUIS CABEZAS BORJA'),
(9, 'CH', 'CHICA NARVÁEZ'),
(10, 'CI', 'SÁNCHEZ Y CIFUENTES'),
(11, 'CO', 'ANTONIO CORDERO'),
(12, 'CR', 'CRISTOBAL COLON'),
(13, 'EG', 'DARIO EGAS'),
(14, 'EU', 'AV. EUGENIO ESPEJO'),
(15, 'FL', 'FLORES'),
(16, 'GA', 'GARCIA MORENO'),
(17, 'GR', 'GRIJALVA'),
(18, 'GU', 'AV. PEREZ GUERRERO'),
(19, 'JC', 'JUAN F. CEVALLOS'),
(20, 'LA', 'RAFAEL LARREA'),
(21, 'MA', 'LIBORIO MADERA'),
(22, 'MI', 'CALIXTO MIRANDA'),
(23, 'MO', 'PEDRO MONCAYO'),
(24, 'OB', 'OBISPO MOSQUERA'),
(25, 'OL', 'OLMEDO'),
(26, 'OO', 'OBELISCO'),
(27, 'OV', 'OVIEDO'),
(28, 'PE', 'PEDRO RODRIGUEZ'),
(29, 'PY', 'LA PLAYA'),
(30, 'RI', 'JAIME RIVADENERIA'),
(31, 'RO', 'ROCAFUERTE'),
(32, 'SA', 'RAFAEL SANCHEZ'),
(33, 'SU', 'SUCRE'),
(34, 'VA', 'AV. FRAY VACAS GALINDO'),
(35, 'VE', 'VELASCO'),
(36, 'ZA', 'GONZALO ZALDUMBIDE'),
(37, 'ZE', 'ZENON VILLACIS'),
(38, 'ZL', 'ZOILA LARREA');

-- --------------------------------------------------------

--
-- Table structure for table `carga`
--

CREATE TABLE `carga` (
  `car_id` int(11) NOT NULL,
  `pun_rec_id` int(11) NOT NULL,
  `car_valor` float(10,2) NOT NULL,
  `car_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `carga`
--
DELIMITER $$
CREATE TRIGGER `Carga` AFTER INSERT ON `carga` FOR EACH ROW UPDATE punto_recarga SET pun_rec_saldo = pun_rec_saldo + NEW.car_valor WHERE pun_rec_id = NEW.pun_rec_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `cat_id` int(11) NOT NULL,
  `cat_nombre` varchar(45) DEFAULT NULL,
  `cat_descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`cat_id`, `cat_nombre`, `cat_descripcion`) VALUES
(1, 'Servicios', 'Servicios');

-- --------------------------------------------------------

--
-- Table structure for table `categoria_infraccion`
--

CREATE TABLE `categoria_infraccion` (
  `cat_inf_id` int(11) NOT NULL,
  `cat_inf_nombre` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categoria_infraccion`
--

INSERT INTO `categoria_infraccion` (`cat_inf_id`, `cat_inf_nombre`) VALUES
(1, 'Parqueo');

-- --------------------------------------------------------

--
-- Table structure for table `ciudad`
--

CREATE TABLE `ciudad` (
  `ciu_id` int(11) NOT NULL,
  `est_id` int(4) DEFAULT NULL,
  `ciu_nombre_es` varchar(150) NOT NULL,
  `ciu_nombre_en` varchar(150) NOT NULL,
  `ciu_codigo_telefono` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ciudad`
--

INSERT INTO `ciudad` (`ciu_id`, `est_id`, `ciu_nombre_es`, `ciu_nombre_en`, `ciu_codigo_telefono`) VALUES
(1, 1, 'Ibarra', 'Ibarra', '06');

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `cli_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `cli_saldo` decimal(10,2) NOT NULL,
  `cli_foto` varchar(100) DEFAULT NULL,
  `cli_cod_pais` varchar(4) DEFAULT NULL,
  `cli_cod_ciudad` varchar(4) DEFAULT NULL,
  `cli_direccion` varchar(150) DEFAULT NULL,
  `cli_movil` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`cli_id`, `usu_id`, `cli_saldo`, `cli_foto`, `cli_cod_pais`, `cli_cod_ciudad`, `cli_direccion`, `cli_movil`) VALUES
(1, 3, 520.80, NULL, '56', '02', '', '0995661449'),
(2, 1, 113.60, NULL, '56', '02', NULL, '0995867216'),
(4, 10, 87.40, NULL, NULL, NULL, NULL, ''),
(5, 11, 345920.03, NULL, NULL, NULL, NULL, ''),
(6, 12, 105.20, NULL, NULL, NULL, NULL, ''),
(10, 16, 9.75, NULL, NULL, NULL, NULL, ''),
(11, 17, 345945.63, NULL, NULL, NULL, NULL, ''),
(12, 18, 0.00, NULL, NULL, NULL, NULL, ''),
(13, 19, 0.00, NULL, NULL, NULL, NULL, ''),
(14, 20, 0.00, NULL, NULL, NULL, NULL, ''),
(15, 22, 0.00, NULL, NULL, NULL, NULL, ''),
(19, 26, 19.60, NULL, NULL, NULL, NULL, '0995867213'),
(20, 27, 0.00, NULL, NULL, NULL, NULL, '2806578');

-- --------------------------------------------------------

--
-- Table structure for table `compra_saldo`
--

CREATE TABLE `compra_saldo` (
  `com_sal_id` int(11) NOT NULL,
  `cli_id` int(11) NOT NULL,
  `punto_recarga_pun_rec_id` int(11) NOT NULL,
  `com_sal_valor` float DEFAULT NULL,
  `com_sal_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `compra_saldo`
--
DELIMITER $$
CREATE TRIGGER `Actualizar Saldo` BEFORE INSERT ON `compra_saldo` FOR EACH ROW UPDATE cliente SET cli_saldo = cli_saldo + NEW.com_sal_valor WHERE cli_id = NEW.cli_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Compra recarga` AFTER INSERT ON `compra_saldo` FOR EACH ROW UPDATE punto_recarga SET pun_rec_saldo = pun_rec_saldo-NEW.com_sal_valor WHERE pun_rec_id = NEW.punto_recarga_pun_rec_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `establecimiento`
--

CREATE TABLE `establecimiento` (
  `eta_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `eta_nombre` varchar(45) DEFAULT NULL,
  `eta_descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `establecimiento`
--

INSERT INTO `establecimiento` (`eta_id`, `cat_id`, `eta_nombre`, `eta_descripcion`) VALUES
(1, 1, 'Parqueaderos', 'Parqueaderos');

-- --------------------------------------------------------

--
-- Table structure for table `estado`
--

CREATE TABLE `estado` (
  `est_id` int(4) NOT NULL,
  `pai_id` int(4) DEFAULT NULL,
  `est_nombre_es` varchar(150) NOT NULL,
  `est_nombre_en` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `estado`
--

INSERT INTO `estado` (`est_id`, `pai_id`, `est_nombre_es`, `est_nombre_en`) VALUES
(1, 63, 'Imbabura', 'Imbabura');

-- --------------------------------------------------------

--
-- Table structure for table `infraccion`
--

CREATE TABLE `infraccion` (
  `inf_id` int(11) NOT NULL,
  `inf_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `inf_detalles` text NOT NULL,
  `usu_id` int(11) NOT NULL,
  `tip_inf_id` int(4) NOT NULL,
  `sec_id` int(11) NOT NULL,
  `inf_latitud` double DEFAULT NULL,
  `inf_longitud` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `infraccion`
--

INSERT INTO `infraccion` (`inf_id`, `inf_fecha`, `inf_detalles`, `usu_id`, `tip_inf_id`, `sec_id`, `inf_latitud`, `inf_longitud`) VALUES
(50, '2015-11-10 05:41:14', '(Ningún)', 1, 10, 7, -0.16544554380547, -78.473950328126),
(51, '2015-11-10 05:41:15', '(Ningún)', 1, 10, 7, -0.18370746489513, -78.478234157039),
(52, '2015-11-10 05:41:16', '(Ningún)', 1, 12, 7, -0.16468006938167, -78.474138847394),
(53, '2015-11-10 05:41:16', '(Ningún)', 1, 8, 7, -0.16481103763921, -78.474019710172),
(54, '2015-11-10 05:41:17', '(Ningún)', 1, 10, 7, -0.16526615358592, -78.474049082537),
(55, '2015-11-10 05:41:18', '(Ningún)', 1, 8, 7, -0.16482805924548, -78.474298120876),
(56, '2015-11-10 05:41:19', '(Ningún)', 1, 8, 7, -0.16482805924548, -78.474298120876),
(57, '2015-11-10 05:41:20', '(Ningún)', 1, 8, 7, -0.16519288973041, -78.474042597236),
(58, '2015-11-10 05:41:20', '(Ningún)', 1, 12, 7, -0.16519288973041, -78.474042597236),
(59, '2015-11-10 05:41:21', '(Ningún)', 1, 8, 7, -0.165156863383, -78.474048442916),
(60, '2015-11-10 05:41:22', '(Ningún)', 1, 6, 7, -0.16511812149281, -78.47408395818),
(61, '2015-11-10 05:41:23', '(Ningún)', 1, 10, 7, -0.16561130295222, -78.474345183415),
(62, '2015-11-10 05:41:23', '(Ningún)', 1, 7, 7, -0.16530526203765, -78.474056626289),
(63, '2015-11-10 05:41:25', '(Ningún)', 1, 6, 7, -0.16519037990729, -78.474103239119),
(64, '2015-11-10 05:41:24', '(Ningún)', 5, 6, 7, -0.15652053800439, -78.474704713884),
(65, '2015-11-10 05:41:26', '(Ningún)', 5, 8, 7, -0.16473217468669, -78.474176633027),
(66, '2015-11-10 05:16:59', '(Ningún)', 5, 10, 7, -0.16217285441676, -78.47520827963),
(67, '2015-11-10 05:23:51', '(Ningún)', 5, 12, 7, -0.16568913398776, -78.473923961853),
(68, '2015-11-10 06:17:38', '(Ningún)', 5, 8, 7, -0.16430322923062, -78.473102155857),
(69, '2015-11-10 06:18:06', '(Ningún)', 5, 10, 7, -0.16557753744785, -78.473774947571),
(70, '2015-11-10 06:28:22', '(Ningún)', 5, 10, 7, -0.16389858997187, -78.47443299093),
(71, '2015-11-10 06:33:24', '(Ningún)', 5, 8, 7, -0.16557177449277, -78.473499436674),
(72, '2015-11-10 11:21:00', '(Ningún)', 5, 6, 7, 0.11219630683228, -78.16931122338),
(73, '2015-11-10 14:44:38', '(Ningún)', 5, 6, 7, 0.17279862574108, -78.198426359143),
(74, '2015-11-10 14:48:17', '(Ningún)', 5, 11, 7, 0.17279862574108, -78.198426359143),
(75, '2015-11-10 19:04:58', '(Ningún)', 5, 8, 7, 0.3517679355643, -78.118288419548);

-- --------------------------------------------------------

--
-- Table structure for table `lista_blanca`
--

CREATE TABLE `lista_blanca` (
  `lis_bla_id` int(11) NOT NULL,
  `lis_bla_placa` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lista_blanca`
--

INSERT INTO `lista_blanca` (`lis_bla_id`, `lis_bla_placa`) VALUES
(1, 'POL0112'),
(2, 'PCJ5751'),
(3, 'PNS0992');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `log_id` int(11) NOT NULL,
  `log_hora` datetime DEFAULT NULL,
  `log_descripcion` varchar(45) DEFAULT NULL,
  `log_info` text,
  `cli_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log_parqueadero`
--

CREATE TABLE `log_parqueadero` (
  `log_par_id` int(11) NOT NULL,
  `par_id` varchar(10) NOT NULL,
  `aut_placa` varchar(10) NOT NULL,
  `log_par_fecha_ingreso` datetime NOT NULL,
  `log_par_fecha_salida` datetime NOT NULL,
  `log_par_horas_parqueo` float(10,2) NOT NULL,
  `log_par_estado` char(1) NOT NULL,
  `tra_id` int(11) NOT NULL,
  `nro_ticket` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log_parqueadero`
--

INSERT INTO `log_parqueadero` (`log_par_id`, `par_id`, `aut_placa`, `log_par_fecha_ingreso`, `log_par_fecha_salida`, `log_par_horas_parqueo`, `log_par_estado`, `tra_id`, `nro_ticket`) VALUES
(1, 'I1178', 'abc123', '2015-11-04 15:15:00', '0000-00-00 00:00:00', 30.00, 'O', 0, NULL),
(2, 'I1179', 'red1234', '2015-11-04 15:15:00', '0000-00-00 00:00:00', 1.00, 'O', 0, NULL),
(3, 'I1181', 'ppp123', '2015-11-04 17:17:00', '0000-00-00 00:00:00', 1.00, 'O', 0, NULL),
(4, 'I1112', 'POL0110', '2015-11-06 08:40:33', '0000-00-00 00:00:00', 1.00, 'O', 262, NULL),
(5, 'I1118', 'POL0110', '2015-11-09 13:52:59', '0000-00-00 00:00:00', 2.00, 'O', 263, NULL),
(6, 'I1004', 'POL0110', '2015-11-10 02:54:37', '0000-00-00 00:00:00', 1.00, 'O', 264, NULL),
(7, 'I1006', 'PPP1234', '2015-11-09 22:43:05', '0000-00-00 00:00:00', 1.00, 'O', 265, NULL),
(8, 'I1007', 'POL0110', '2015-11-09 22:44:58', '0000-00-00 00:00:00', 2.00, 'O', 266, NULL),
(9, 'I1008', 'POL0110', '2015-11-09 22:49:33', '0000-00-00 00:00:00', 1.00, 'O', 267, NULL),
(10, 'I1018', 'pol0110', '2015-11-10 23:55:00', '0000-00-00 00:00:00', 30.00, 'O', 0, NULL),
(11, 'I1014', 'pol0110', '2015-11-10 00:55:00', '0000-00-00 00:00:00', 1.00, 'O', 0, NULL),
(12, 'I1015', 'ppp1234', '2015-11-10 00:55:00', '0000-00-00 00:00:00', 0.50, 'O', 0, NULL),
(13, 'I1015', 'abc1234', '2015-11-10 01:00:00', '0000-00-00 00:00:00', 0.50, 'O', 0, NULL),
(14, 'I1015', 'pol0110', '2015-11-10 01:10:00', '0000-00-00 00:00:00', 0.50, 'O', 0, NULL),
(15, 'I1015', 'POL0110', '2015-11-10 01:15:00', '0000-00-00 00:00:00', 0.50, 'O', 0, NULL),
(16, 'I1020', 'ttt4444', '2015-11-10 01:15:00', '0000-00-00 00:00:00', 1.00, 'O', 0, NULL),
(17, 'I1021', 'pol0111', '2015-11-10 01:15:00', '0000-00-00 00:00:00', 2.00, 'O', 0, NULL),
(18, 'I1030', 'EJE1234', '2015-11-10 01:45:00', '0000-00-00 00:00:00', 0.50, 'O', 0, NULL),
(19, 'I1022', 'Eje2222', '2015-11-10 01:50:00', '0000-00-00 00:00:00', 1.00, 'O', 0, '111111'),
(20, 'I1004', 'ABC1234', '2015-11-10 06:29:54', '0000-00-00 00:00:00', 2.00, 'O', 268, NULL),
(21, 'I1019', 'AAA0001', '2015-11-10 08:35:00', '0000-00-00 00:00:00', 1.00, 'O', 0, '111112'),
(22, 'I1012', 'PPP1234', '2015-11-10 09:40:00', '0000-00-00 00:00:00', 1.00, 'O', 0, '111113'),
(23, 'I1022', 'RED1234', '2015-11-10 09:50:17', '0000-00-00 00:00:00', 2.00, 'O', 269, NULL),
(24, 'I1014', 'ABC1234', '2015-11-10 12:22:59', '0000-00-00 00:00:00', 2.00, 'O', 270, NULL),
(25, 'I1015', 'TTT5678', '2015-11-10 12:27:53', '0000-00-00 00:00:00', 1.00, 'O', 271, NULL),
(26, 'I1004', 'POL0110', '2015-11-11 12:42:55', '0000-00-00 00:00:00', 2.00, 'O', 272, NULL),
(27, 'I1015', 'POL0111', '2015-11-11 13:04:01', '0000-00-00 00:00:00', 3.00, 'O', 273, NULL),
(28, 'I1001', 'RED0001', '2015-11-11 13:58:28', '0000-00-00 00:00:00', 2.00, 'O', 274, NULL),
(29, 'I1001', 'ABC1234', '2015-11-11 17:33:41', '0000-00-00 00:00:00', 2.00, 'O', 275, NULL);

--
-- Triggers `log_parqueadero`
--
DELIMITER $$
CREATE TRIGGER `violations_automovil` BEFORE INSERT ON `log_parqueadero` FOR EACH ROW INSERT IGNORE INTO `automovil` (
    `aut_placa`
)
VALUES (
NEW.aut_placa
)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `violations_ocupado` AFTER INSERT ON `log_parqueadero` FOR EACH ROW UPDATE parqueadero 
SET par_estado=NEW.log_par_estado,
aut_placa=NEW.aut_placa,
par_fecha_ingreso=NEW.log_par_fecha_ingreso,
par_horas_parqueo=NEW.log_par_horas_parqueo,
par_fecha_salida=NEW.log_par_fecha_salida + INTERVAL NEW.log_par_horas_parqueo HOUR
WHERE par_id=NEW.par_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `men_id` int(11) NOT NULL,
  `apl_id` int(4) DEFAULT NULL,
  `men_nombre` varchar(200) NOT NULL,
  `men_etiqueta` varchar(200) NOT NULL,
  `men_icon` varchar(100) NOT NULL,
  `men_padre` int(11) NOT NULL,
  `men_divisor` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

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
(37, 98, 'transferenciasRecibidas', 'Transferencias Recibidas', '<i class="fa fa-search fa-fw"></i>', 24, 'N'),
(38, 100, 'transaccionCompras', 'Transacciones', '<i class="fa fa-search fa-fw"></i>', 0, 'N'),
(39, 114, 'puntoRecarga', 'Punto Recarga', '<i class="fa fa-ticket fa-fw"></i>', 1, 'N'),
(40, 115, 'puntoRecargaListado', 'Listado Puntos de Recarga', '<i class="fa fa-ticket fa-fw"></i>', 1, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `multa_parqueadero`
--

CREATE TABLE `multa_parqueadero` (
  `mul_par_id` int(11) NOT NULL,
  `par_id` varchar(10) NOT NULL,
  `aut_placa` varchar(10) NOT NULL,
  `inf_id` int(11) NOT NULL,
  `mul_par_estado` char(1) NOT NULL,
  `mul_par_valor` float NOT NULL,
  `mul_par_imagen` varchar(250) DEFAULT NULL,
  `mul_par_prueba_1` varchar(250) DEFAULT NULL,
  `mul_par_prueba_2` varchar(250) DEFAULT NULL,
  `mul_par_prueba_3` varchar(250) DEFAULT NULL,
  `mul_par_motivo_retiro` text,
  `inf_estado` char(1) DEFAULT 'R'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `multa_parqueadero`
--

INSERT INTO `multa_parqueadero` (`mul_par_id`, `par_id`, `aut_placa`, `inf_id`, `mul_par_estado`, `mul_par_valor`, `mul_par_imagen`, `mul_par_prueba_1`, `mul_par_prueba_2`, `mul_par_prueba_3`, `mul_par_motivo_retiro`, `inf_estado`) VALUES
(1, 'I1010', 'ppp111', 50, 'R', 0, NULL, NULL, NULL, NULL, NULL, 'R'),
(2, 'I1012', 'ppp123', 51, 'R', 0, NULL, NULL, NULL, NULL, NULL, 'R'),
(3, 'I1012', 'ppp0123', 52, 'R', 0, NULL, NULL, NULL, NULL, NULL, 'R'),
(4, 'I1014', 'pol0110', 53, 'R', 0, NULL, NULL, NULL, NULL, NULL, 'R'),
(5, 'I1013', 'POL0110', 54, 'R', 0, NULL, NULL, NULL, NULL, NULL, 'R'),
(6, 'I1015', 'POL0110', 55, 'R', 0, NULL, NULL, NULL, NULL, NULL, 'R'),
(7, 'I1022', 'ppp123', 56, 'R', 0, NULL, NULL, NULL, NULL, NULL, 'R'),
(8, 'I1021', 'Ppp123', 57, 'R', 0, NULL, NULL, NULL, NULL, NULL, 'R'),
(9, 'I1020', 'pol0110', 58, 'R', 0, NULL, NULL, NULL, NULL, NULL, 'R'),
(10, 'I1019', 'POL0110', 59, 'L', 0, NULL, NULL, NULL, NULL, NULL, 'R'),
(11, 'I1023', 'POL0110', 60, 'L', 0, NULL, NULL, NULL, NULL, NULL, 'R'),
(12, 'I1018', 'POL0110', 61, 'L', 0, NULL, NULL, NULL, NULL, NULL, 'R'),
(13, 'I1019', 'POL0110', 62, 'L', 0, NULL, NULL, NULL, NULL, NULL, 'R'),
(14, 'I1013', 'AEI0009', 63, 'R', 0, NULL, NULL, NULL, NULL, NULL, 'R'),
(15, 'I1013', 'POL0110', 64, 'L', 0, NULL, NULL, NULL, NULL, NULL, 'R'),
(16, 'I1018', 'PBL2228', 65, 'R', 0, NULL, NULL, NULL, NULL, NULL, 'R'),
(17, 'I1019', 'PBL2228', 66, 'R', 0, NULL, NULL, NULL, NULL, NULL, 'R'),
(18, 'I1020', 'PBL2228', 67, 'R', 0, NULL, '1447133034_PBL2228.jpg', NULL, NULL, NULL, 'R'),
(19, 'I1019', 'POL0110', 68, 'L', 0, NULL, NULL, NULL, NULL, NULL, 'R'),
(20, 'I1012', 'pig1234', 69, 'R', 0, NULL, NULL, NULL, NULL, NULL, 'R'),
(21, 'I1013', 'LBA2964', 70, 'R', 0, NULL, '1447136914_LBA2964.jpg', '1447136914_20151110_012814.jpg', NULL, NULL, 'R'),
(22, 'I1027', 'PBB5353', 71, 'R', 0, NULL, '1447137215_PBB5353.jpg', '1447137215_20151110_013318.jpg', NULL, NULL, 'R'),
(23, 'I1011', 'POL0110', 72, 'L', 0, NULL, NULL, NULL, NULL, NULL, 'R'),
(24, 'I1020', 'POL0110', 73, 'L', 0, NULL, NULL, NULL, NULL, NULL, 'R'),
(25, 'I1019', 'TTT1234', 74, 'R', 0, NULL, NULL, NULL, NULL, NULL, 'R'),
(26, 'I1018', 'ADY0221', 75, 'R', 0, NULL, '1447182306_ADY221.jpg', NULL, NULL, NULL, 'R');

--
-- Triggers `multa_parqueadero`
--
DELIMITER $$
CREATE TRIGGER `violations_automovil_multa` BEFORE INSERT ON `multa_parqueadero` FOR EACH ROW INSERT IGNORE INTO `automovil` (
    `aut_placa`
)
VALUES (
NEW.aut_placa
)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `violations_multa` AFTER INSERT ON `multa_parqueadero` FOR EACH ROW UPDATE parqueadero SET par_estado=NEW.mul_par_estado, inf_id=NEW.inf_id, aut_placa=NEW.aut_placa WHERE par_id=NEW.par_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pais`
--

CREATE TABLE `pais` (
  `pai_id` int(4) NOT NULL,
  `pai_nombre_es` varchar(120) NOT NULL,
  `pai_nombre_en` varchar(120) NOT NULL,
  `pai_codigo_telefono` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pais`
--

INSERT INTO `pais` (`pai_id`, `pai_nombre_es`, `pai_nombre_en`, `pai_codigo_telefono`) VALUES
(63, 'Ecuador', 'Ecuador', '593');

-- --------------------------------------------------------

--
-- Table structure for table `parqueadero`
--

CREATE TABLE `parqueadero` (
  `par_id` varchar(10) NOT NULL,
  `par_estado` char(1) NOT NULL,
  `sec_id` int(11) NOT NULL,
  `par_tipo` char(1) NOT NULL DEFAULT 'N',
  `aut_placa` varchar(10) NOT NULL,
  `par_fecha_ingreso` datetime NOT NULL,
  `par_fecha_salida` datetime NOT NULL,
  `par_horas_parqueo` float(10,2) NOT NULL,
  `inf_id` int(11) NOT NULL DEFAULT '0',
  `par_latitud` float(10,6) DEFAULT NULL,
  `par_longitud` float(10,6) DEFAULT NULL,
  `par_cal_principal` varchar(2) DEFAULT NULL,
  `par_cal_secundaria` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parqueadero`
--

INSERT INTO `parqueadero` (`par_id`, `par_estado`, `sec_id`, `par_tipo`, `aut_placa`, `par_fecha_ingreso`, `par_fecha_salida`, `par_horas_parqueo`, `inf_id`, `par_latitud`, `par_longitud`, `par_cal_principal`, `par_cal_secundaria`) VALUES
('AAA111', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347440, -78.148132, '4', '6'),
('I1000', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349392, -78.120811, NULL, NULL),
('I1001', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349401, -78.120872, NULL, NULL),
('I1002', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349410, -78.120926, NULL, NULL),
('I1003', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349419, -78.120979, NULL, NULL),
('I1004', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349429, -78.121040, NULL, NULL),
('I1005', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349438, -78.121094, NULL, NULL),
('I1006', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349447, -78.121155, NULL, NULL),
('I1007', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349457, -78.121208, NULL, NULL),
('I1008', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349466, -78.121262, NULL, NULL),
('I1009', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349493, -78.121391, NULL, NULL),
('I1010', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 50, 0.349510, -78.121483, NULL, NULL),
('I1011', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 72, 0.349528, -78.121582, NULL, NULL),
('I1012', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 69, 0.349546, -78.121674, NULL, NULL),
('I1013', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 70, 0.349565, -78.121834, NULL, NULL),
('I1014', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 53, 0.349576, -78.121895, NULL, NULL),
('I1015', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 55, 0.349588, -78.121956, NULL, NULL),
('I1016', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349599, -78.122017, NULL, NULL),
('I1017', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349610, -78.122086, NULL, NULL),
('I1018', 'R', 7, 'N', 'ADY0221', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 75, 0.349621, -78.122147, NULL, NULL),
('I1019', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 74, 0.349640, -78.122269, NULL, NULL),
('I1020', 'L', 7, 'N', 'POL0110', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 73, 0.349650, -78.122330, NULL, NULL),
('I1021', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 57, 0.349659, -78.122391, NULL, NULL),
('I1022', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 56, 0.349669, -78.122444, NULL, NULL),
('I1023', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 60, 0.349679, -78.122505, NULL, NULL),
('I1024', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349688, -78.122566, NULL, NULL),
('I1025', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349698, -78.122620, NULL, NULL),
('I1026', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349707, -78.122681, NULL, NULL),
('I1027', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 71, 0.349717, -78.122742, NULL, NULL),
('I1028', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349727, -78.122795, NULL, NULL),
('I1029', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349736, -78.122856, NULL, NULL),
('I1030', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349746, -78.122917, NULL, NULL),
('I1031', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349755, -78.122971, NULL, NULL),
('I1032', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347969, -78.118706, NULL, NULL),
('I1033', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347961, -78.118652, NULL, NULL),
('I1034', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347953, -78.118599, NULL, NULL),
('I1035', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347944, -78.118546, NULL, NULL),
('I1036', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347936, -78.118492, NULL, NULL),
('I1037', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347928, -78.118439, NULL, NULL),
('I1038', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347920, -78.118385, NULL, NULL),
('I1039', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347911, -78.118332, NULL, NULL),
('I1040', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347903, -78.118279, NULL, NULL),
('I1041', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347895, -78.118225, NULL, NULL),
('I1042', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347887, -78.118172, NULL, NULL),
('I1043', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347878, -78.118111, NULL, NULL),
('I1044', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347870, -78.118057, NULL, NULL),
('I1045', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347862, -78.118004, NULL, NULL),
('I1046', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347840, -78.117859, NULL, NULL),
('I1047', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347830, -78.117798, NULL, NULL),
('I1048', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347820, -78.117737, NULL, NULL),
('I1049', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347810, -78.117676, NULL, NULL),
('I1050', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347800, -78.117615, NULL, NULL),
('I1051', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347790, -78.117554, NULL, NULL),
('I1052', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347780, -78.117493, NULL, NULL),
('I1053', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347770, -78.117432, NULL, NULL),
('I1054', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347760, -78.117371, NULL, NULL),
('I1055', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347749, -78.117310, NULL, NULL),
('I1056', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347739, -78.117249, NULL, NULL),
('I1057', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347729, -78.117188, NULL, NULL),
('I1058', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347719, -78.117126, NULL, NULL),
('I1059', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347709, -78.117065, NULL, NULL),
('I1060', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346770, -78.117226, NULL, NULL),
('I1061', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346777, -78.117271, NULL, NULL),
('I1062', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346784, -78.117317, NULL, NULL),
('I1063', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346791, -78.117371, NULL, NULL),
('I1064', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346798, -78.117416, NULL, NULL),
('I1065', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346805, -78.117470, NULL, NULL),
('I1066', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346812, -78.117516, NULL, NULL),
('I1067', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346820, -78.117561, NULL, NULL),
('I1068', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346827, -78.117615, NULL, NULL),
('I1069', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346834, -78.117661, NULL, NULL),
('I1070', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346841, -78.117706, NULL, NULL),
('I1071', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346848, -78.117760, NULL, NULL),
('I1072', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346855, -78.117805, NULL, NULL),
('I1073', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346862, -78.117851, NULL, NULL),
('I1074', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346869, -78.117905, NULL, NULL),
('I1075', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346876, -78.117950, NULL, NULL),
('I1076', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346883, -78.117996, NULL, NULL),
('I1077', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346977, -78.118149, NULL, NULL),
('I1078', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346990, -78.118233, NULL, NULL),
('I1079', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347003, -78.118309, NULL, NULL),
('I1080', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347016, -78.118385, NULL, NULL),
('I1081', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347029, -78.118462, NULL, NULL),
('I1082', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347042, -78.118538, NULL, NULL),
('I1083', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347055, -78.118614, NULL, NULL),
('I1084', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347069, -78.118690, NULL, NULL),
('I1085', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347082, -78.118767, NULL, NULL),
('I1086', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347095, -78.118843, NULL, NULL),
('I1087', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347130, -78.119011, NULL, NULL),
('I1088', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347146, -78.119118, NULL, NULL),
('I1089', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347163, -78.119232, NULL, NULL),
('I1090', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347180, -78.119347, NULL, NULL),
('I1091', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347197, -78.119453, NULL, NULL),
('I1092', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347214, -78.119568, NULL, NULL),
('I1093', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347231, -78.119675, NULL, NULL),
('I1094', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347248, -78.119789, NULL, NULL),
('I1095', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347274, -78.119942, NULL, NULL),
('I1096', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347287, -78.120026, NULL, NULL),
('I1097', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347300, -78.120110, NULL, NULL),
('I1098', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347312, -78.120193, NULL, NULL),
('I1099', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347325, -78.120277, NULL, NULL),
('I1100', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347337, -78.120361, NULL, NULL),
('I1101', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347350, -78.120445, NULL, NULL),
('I1102', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347362, -78.120537, NULL, NULL),
('I1103', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347375, -78.120621, NULL, NULL),
('I1104', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347387, -78.120705, NULL, NULL),
('I1105', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347414, -78.120865, NULL, NULL),
('I1106', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347429, -78.120964, NULL, NULL),
('I1107', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347444, -78.121071, NULL, NULL),
('I1108', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347459, -78.121170, NULL, NULL),
('I1109', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347474, -78.121269, NULL, NULL),
('I1110', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347489, -78.121376, NULL, NULL),
('I1111', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347504, -78.121475, NULL, NULL),
('I1112', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.347519, -78.121582, NULL, NULL),
('I1113', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346046, -78.118164, NULL, NULL),
('I1114', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346034, -78.118095, NULL, NULL),
('I1115', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346022, -78.118027, NULL, NULL),
('I1116', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346011, -78.117966, NULL, NULL),
('I1117', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345999, -78.117897, NULL, NULL),
('I1118', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345987, -78.117828, NULL, NULL),
('I1119', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345976, -78.117767, NULL, NULL),
('I1120', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345964, -78.117699, NULL, NULL),
('I1121', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345952, -78.117630, NULL, NULL),
('I1122', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345940, -78.117561, NULL, NULL),
('I1123', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345929, -78.117500, NULL, NULL),
('I1124', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345917, -78.117432, NULL, NULL),
('I1125', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345905, -78.117363, NULL, NULL),
('I1126', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345834, -78.117393, NULL, NULL),
('I1127', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345842, -78.117439, NULL, NULL),
('I1128', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345851, -78.117485, NULL, NULL),
('I1129', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345859, -78.117531, NULL, NULL),
('I1130', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345867, -78.117577, NULL, NULL),
('I1131', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345875, -78.117622, NULL, NULL),
('I1132', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345883, -78.117668, NULL, NULL),
('I1133', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345892, -78.117714, NULL, NULL),
('I1134', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345900, -78.117760, NULL, NULL),
('I1135', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345908, -78.117805, NULL, NULL),
('I1136', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345916, -78.117851, NULL, NULL),
('I1137', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345924, -78.117897, NULL, NULL),
('I1138', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345933, -78.117943, NULL, NULL),
('I1139', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345941, -78.117989, NULL, NULL),
('I1140', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345949, -78.118034, NULL, NULL),
('I1141', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345957, -78.118080, NULL, NULL),
('I1142', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345965, -78.118126, NULL, NULL),
('I1143', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345974, -78.118172, NULL, NULL),
('I1144', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346046, -78.119034, NULL, NULL),
('I1145', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346038, -78.118973, NULL, NULL),
('I1146', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346029, -78.118912, NULL, NULL),
('I1147', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346021, -78.118851, NULL, NULL),
('I1148', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346013, -78.118790, NULL, NULL),
('I1149', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.346005, -78.118721, NULL, NULL),
('I1150', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345996, -78.118660, NULL, NULL),
('I1151', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345988, -78.118599, NULL, NULL),
('I1152', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345783, -78.118370, NULL, NULL),
('I1153', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345793, -78.118423, NULL, NULL),
('I1154', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345803, -78.118477, NULL, NULL),
('I1155', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345813, -78.118538, NULL, NULL),
('I1156', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345823, -78.118591, NULL, NULL),
('I1157', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345833, -78.118645, NULL, NULL),
('I1158', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345843, -78.118706, NULL, NULL),
('I1159', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345853, -78.118759, NULL, NULL),
('I1160', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345863, -78.118820, NULL, NULL),
('I1161', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345873, -78.118874, NULL, NULL),
('I1162', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345883, -78.118927, NULL, NULL),
('I1163', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345892, -78.118988, NULL, NULL),
('I1164', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345902, -78.119041, NULL, NULL),
('I1165', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345196, -78.119164, NULL, NULL),
('I1166', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345179, -78.119080, NULL, NULL),
('I1167', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345162, -78.118996, NULL, NULL),
('I1168', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345146, -78.118904, NULL, NULL),
('I1169', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345129, -78.118820, NULL, NULL),
('I1170', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345112, -78.118736, NULL, NULL),
('I1171', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345095, -78.118652, NULL, NULL),
('I1172', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345078, -78.118568, NULL, NULL),
('I1173', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345062, -78.118477, NULL, NULL),
('I1174', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345048, -78.118317, 'OB', 'SU'),
('I1175', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345033, -78.118248, 'OB', 'SU'),
('I1176', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345024, -78.118172, 'OB', 'SU'),
('I1177', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345013, -78.118103, 'OB', 'SU'),
('I1178', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345000, -78.118034, 'OB', 'SU'),
('I1179', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.344986, -78.117966, 'OB', 'SU'),
('I1180', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.344973, -78.117882, 'OB', 'SU'),
('I1181', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.344969, -78.117821, 'OB', 'SU'),
('I1182', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.344957, -78.117760, 'OB', 'SU'),
('I1183', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 49, 0.344950, -78.117699, 'OB', 'SU'),
('I1184', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.344943, -78.117630, 'OB', 'SU'),
('I1185', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.344933, -78.117561, 'OB', 'SU'),
('I1186', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345322, -78.119408, NULL, NULL),
('I1187', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345334, -78.119476, NULL, NULL),
('I1188', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345346, -78.119537, NULL, NULL),
('I1189', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345358, -78.119606, NULL, NULL),
('I1190', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345370, -78.119675, NULL, NULL),
('I1191', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345382, -78.119736, NULL, NULL),
('I1192', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345394, -78.119804, NULL, NULL),
('I1193', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345406, -78.119865, NULL, NULL),
('I1194', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345418, -78.119934, NULL, NULL),
('I1195', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345430, -78.119995, NULL, NULL),
('I1196', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345443, -78.120064, NULL, NULL),
('I1197', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345455, -78.120125, NULL, NULL),
('I1198', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345467, -78.120193, NULL, NULL),
('I1199', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345479, -78.120255, NULL, NULL),
('I1200', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345491, -78.120323, NULL, NULL),
('I1201', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345503, -78.120384, NULL, NULL),
('I1202', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345515, -78.120453, NULL, NULL),
('I1203', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345527, -78.120522, NULL, NULL),
('I1204', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345539, -78.120583, NULL, NULL),
('I1205', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345551, -78.120651, NULL, NULL),
('I1206', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345563, -78.120712, NULL, NULL),
('I1207', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345575, -78.120781, NULL, NULL),
('I1208', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345587, -78.120842, NULL, NULL),
('I1209', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345599, -78.120911, NULL, NULL),
('I1210', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345612, -78.120972, NULL, NULL),
('I1211', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345630, -78.121140, NULL, NULL),
('I1212', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345641, -78.121223, NULL, NULL),
('I1213', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345652, -78.121307, NULL, NULL),
('I1214', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345663, -78.121391, NULL, NULL),
('I1215', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345674, -78.121468, NULL, NULL),
('I1216', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345685, -78.121552, NULL, NULL),
('I1217', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345695, -78.121635, NULL, NULL),
('I1218', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345706, -78.121719, NULL, NULL),
('I1219', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345717, -78.121796, NULL, NULL),
('I1220', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345728, -78.121880, NULL, NULL),
('I1221', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345739, -78.121964, NULL, NULL),
('I1222', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345750, -78.122047, NULL, NULL),
('I1223', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345761, -78.122124, NULL, NULL),
('I1224', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345771, -78.122208, NULL, NULL),
('I1225', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345782, -78.122292, NULL, NULL),
('I1226', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345793, -78.122375, NULL, NULL),
('I1227', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345804, -78.122452, NULL, NULL),
('I1228', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345815, -78.122536, NULL, NULL),
('I1229', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345826, -78.122620, NULL, NULL),
('I1230', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345836, -78.122696, NULL, NULL),
('I1231', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345847, -78.122780, NULL, NULL),
('I1232', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345858, -78.122864, NULL, NULL),
('I1233', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345869, -78.122948, NULL, NULL),
('I1304', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.345011, -78.123062, NULL, NULL),
('I1305', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.344997, -78.122971, NULL, NULL),
('I1306', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.344983, -78.122879, NULL, NULL),
('I1307', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.344969, -78.122787, NULL, NULL),
('I1308', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.344956, -78.122696, NULL, NULL),
('I1309', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.344944, -78.122597, NULL, NULL),
('I1310', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.344930, -78.122513, NULL, NULL),
('I1311', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.344917, -78.122421, NULL, NULL),
('I1312', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.344904, -78.122337, NULL, NULL),
('I1313', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.344891, -78.122253, NULL, NULL),
('I1314', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.344876, -78.122154, NULL, NULL),
('I1315', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.344866, -78.122086, NULL, NULL),
('I1316', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.344856, -78.122017, NULL, NULL),
('I1317', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.344845, -78.121948, NULL, NULL),
('I1318', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.344835, -78.121880, NULL, NULL),
('I1319', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.344824, -78.121811, NULL, NULL),
('I711', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.352196, -78.120811, NULL, NULL),
('I712', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.352186, -78.120758, NULL, NULL),
('I713', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.352176, -78.120705, NULL, NULL),
('I714', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.352167, -78.120651, NULL, NULL),
('I715', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.352157, -78.120598, NULL, NULL),
('I716', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.352147, -78.120552, NULL, NULL),
('I717', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.352137, -78.120499, NULL, NULL),
('I718', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.352128, -78.120445, NULL, NULL),
('I719', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.352118, -78.120392, NULL, NULL),
('I720', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.352108, -78.120338, NULL, NULL),
('I721', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.352098, -78.120285, NULL, NULL),
('I722', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.352088, -78.120232, NULL, NULL),
('I723', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.352079, -78.120178, NULL, NULL),
('I724', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.352069, -78.120132, NULL, NULL),
('I725', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.352059, -78.120079, NULL, NULL),
('I726', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351896, -78.119202, NULL, NULL),
('I727', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351909, -78.119270, NULL, NULL),
('I728', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351922, -78.119347, NULL, NULL),
('I729', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351935, -78.119415, NULL, NULL),
('I730', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351948, -78.119484, NULL, NULL),
('I731', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351961, -78.119560, NULL, NULL),
('I732', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351974, -78.119629, NULL, NULL),
('I733', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351988, -78.119705, NULL, NULL),
('I734', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.352001, -78.119774, NULL, NULL),
('I735', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.352014, -78.119843, NULL, NULL),
('I736', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.352027, -78.119919, NULL, NULL),
('I737', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351584, -78.117188, NULL, NULL),
('I738', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351568, -78.117111, NULL, NULL),
('I739', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351551, -78.117027, NULL, NULL),
('I740', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351535, -78.116951, NULL, NULL),
('I741', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351518, -78.116875, NULL, NULL),
('I742', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351501, -78.116798, NULL, NULL),
('I743', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351485, -78.116714, NULL, NULL),
('I744', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351468, -78.116638, NULL, NULL),
('I745', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351451, -78.116562, NULL, NULL),
('I746', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351435, -78.116486, NULL, NULL),
('I747', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351418, -78.116409, NULL, NULL),
('I748', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351386, -78.116272, NULL, NULL),
('I749', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351378, -78.116219, NULL, NULL),
('I750', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351371, -78.116173, NULL, NULL),
('I751', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351363, -78.116127, NULL, NULL),
('I752', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351355, -78.116081, NULL, NULL),
('I753', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351347, -78.116035, NULL, NULL),
('I754', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351340, -78.115990, NULL, NULL),
('I755', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351332, -78.115944, NULL, NULL),
('I756', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351324, -78.115891, NULL, NULL),
('I757', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351317, -78.115845, NULL, NULL),
('I758', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351309, -78.115799, NULL, NULL),
('I759', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351301, -78.115753, NULL, NULL),
('I760', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351293, -78.115707, NULL, NULL),
('I761', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351286, -78.115662, NULL, NULL),
('I762', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351278, -78.115608, NULL, NULL),
('I763', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351270, -78.115562, NULL, NULL),
('I764', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351263, -78.115517, NULL, NULL),
('I765', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350404, -78.115677, NULL, NULL),
('I766', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350412, -78.115723, NULL, NULL),
('I767', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350419, -78.115768, NULL, NULL),
('I768', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350426, -78.115814, NULL, NULL),
('I769', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350434, -78.115860, NULL, NULL),
('I770', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350441, -78.115906, NULL, NULL),
('I771', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350449, -78.115952, NULL, NULL),
('I772', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350456, -78.115997, NULL, NULL),
('I773', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350463, -78.116043, NULL, NULL),
('I774', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350471, -78.116081, NULL, NULL),
('I775', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350478, -78.116127, NULL, NULL),
('I776', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350485, -78.116173, NULL, NULL),
('I777', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350493, -78.116219, NULL, NULL),
('I778', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350500, -78.116264, NULL, NULL),
('I779', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350508, -78.116310, NULL, NULL),
('I780', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350515, -78.116356, NULL, NULL),
('I781', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350522, -78.116402, NULL, NULL),
('I782', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350554, -78.116592, NULL, NULL),
('I783', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350563, -78.116646, NULL, NULL),
('I784', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350572, -78.116692, NULL, NULL),
('I785', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350581, -78.116745, NULL, NULL),
('I786', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350590, -78.116791, NULL, NULL),
('I787', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350598, -78.116844, NULL, NULL),
('I788', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350607, -78.116890, NULL, NULL),
('I789', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350616, -78.116943, NULL, NULL),
('I790', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350625, -78.116989, NULL, NULL),
('I791', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350633, -78.117043, NULL, NULL),
('I792', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350642, -78.117088, NULL, NULL),
('I793', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350651, -78.117134, NULL, NULL),
('I794', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350660, -78.117188, NULL, NULL),
('I795', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350668, -78.117233, NULL, NULL),
('I796', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350677, -78.117287, NULL, NULL),
('I797', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350686, -78.117332, NULL, NULL),
('I798', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351061, -78.119431, NULL, NULL),
('I799', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351079, -78.119530, NULL, NULL),
('I800', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351096, -78.119621, NULL, NULL),
('I801', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351113, -78.119720, NULL, NULL),
('I802', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351130, -78.119812, NULL, NULL),
('I803', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351147, -78.119904, NULL, NULL),
('I804', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351201, -78.120216, NULL, NULL),
('I805', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351213, -78.120285, NULL, NULL),
('I806', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351225, -78.120354, NULL, NULL),
('I807', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351237, -78.120422, NULL, NULL),
('I808', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351250, -78.120483, NULL, NULL),
('I809', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351262, -78.120552, NULL, NULL),
('I810', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351274, -78.120621, NULL, NULL),
('I811', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351286, -78.120689, NULL, NULL),
('I812', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351298, -78.120758, NULL, NULL),
('I813', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351311, -78.120827, NULL, NULL),
('I814', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351323, -78.120888, NULL, NULL),
('I815', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351335, -78.120956, NULL, NULL),
('I816', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351362, -78.121094, NULL, NULL),
('I817', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351372, -78.121147, NULL, NULL),
('I818', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351381, -78.121201, NULL, NULL),
('I819', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351391, -78.121254, NULL, NULL),
('I820', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351401, -78.121307, NULL, NULL),
('I821', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351410, -78.121361, NULL, NULL),
('I822', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351420, -78.121414, NULL, NULL),
('I823', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351430, -78.121468, NULL, NULL),
('I824', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351440, -78.121521, NULL, NULL),
('I825', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351464, -78.121658, NULL, NULL),
('I826', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351479, -78.121735, NULL, NULL),
('I827', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351494, -78.121811, NULL, NULL),
('I828', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351510, -78.121887, NULL, NULL),
('I829', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351525, -78.121964, NULL, NULL),
('I830', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351540, -78.122040, NULL, NULL),
('I831', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351556, -78.122116, NULL, NULL),
('I832', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351571, -78.122192, NULL, NULL),
('I833', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351563, -78.122276, NULL, NULL),
('I834', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351507, -78.122391, NULL, NULL),
('I835', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351450, -78.122498, NULL, NULL),
('I836', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351386, -78.122612, NULL, NULL),
('I837', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351341, -78.122696, NULL, NULL),
('I838', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351296, -78.122780, NULL, NULL),
('I839', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351251, -78.122864, NULL, NULL),
('I840', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351206, -78.122948, NULL, NULL),
('I841', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.351161, -78.123032, NULL, NULL),
('I842', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350332, -78.121094, NULL, NULL),
('I843', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350321, -78.121033, NULL, NULL),
('I844', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350310, -78.120972, NULL, NULL),
('I845', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350299, -78.120918, NULL, NULL),
('I846', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350287, -78.120857, NULL, NULL),
('I847', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350276, -78.120796, NULL, NULL),
('I848', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350265, -78.120735, NULL, NULL),
('I849', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350254, -78.120674, NULL, NULL),
('I850', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350243, -78.120613, NULL, NULL),
('I851', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350232, -78.120552, NULL, NULL),
('I852', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350220, -78.120499, NULL, NULL),
('I853', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350209, -78.120438, NULL, NULL),
('I854', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350198, -78.120377, NULL, NULL),
('I855', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350171, -78.120239, NULL, NULL),
('I856', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350162, -78.120186, NULL, NULL),
('I857', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350152, -78.120132, NULL, NULL),
('I858', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350143, -78.120079, NULL, NULL),
('I859', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350134, -78.120026, NULL, NULL),
('I860', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350124, -78.119972, NULL, NULL),
('I861', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350115, -78.119919, NULL, NULL),
('I862', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350105, -78.119865, NULL, NULL),
('I863', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350096, -78.119812, NULL, NULL),
('I864', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350087, -78.119759, NULL, NULL),
('I865', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350077, -78.119705, NULL, NULL),
('I866', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350068, -78.119652, NULL, NULL),
('I867', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350059, -78.119598, NULL, NULL),
('I868', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350049, -78.119545, NULL, NULL),
('I869', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350040, -78.119492, NULL, NULL),
('I870', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350018, -78.119362, NULL, NULL),
('I871', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.350006, -78.119293, NULL, NULL),
('I872', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349993, -78.119225, NULL, NULL),
('I873', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349980, -78.119156, NULL, NULL),
('I874', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349967, -78.119087, NULL, NULL),
('I875', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349955, -78.119019, NULL, NULL),
('I876', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349942, -78.118950, NULL, NULL),
('I877', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349929, -78.118881, NULL, NULL),
('I878', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349916, -78.118813, NULL, NULL),
('I879', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349904, -78.118744, NULL, NULL),
('I880', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349891, -78.118675, NULL, NULL),
('I881', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349878, -78.118607, NULL, NULL),
('I882', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349865, -78.118538, NULL, NULL),
('I883', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349841, -78.118378, NULL, NULL),
('I884', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349831, -78.118317, NULL, NULL),
('I885', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349820, -78.118263, NULL, NULL),
('I886', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349810, -78.118202, NULL, NULL),
('I887', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349799, -78.118141, NULL, NULL),
('I888', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349789, -78.118080, NULL, NULL),
('I889', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349778, -78.118027, NULL, NULL),
('I890', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349768, -78.117966, NULL, NULL),
('I891', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349757, -78.117905, NULL, NULL),
('I892', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349747, -78.117851, NULL, NULL),
('I893', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349736, -78.117790, NULL, NULL);
INSERT INTO `parqueadero` (`par_id`, `par_estado`, `sec_id`, `par_tipo`, `aut_placa`, `par_fecha_ingreso`, `par_fecha_salida`, `par_horas_parqueo`, `inf_id`, `par_latitud`, `par_longitud`, `par_cal_principal`, `par_cal_secundaria`) VALUES
('I894', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349726, -78.117729, NULL, NULL),
('I895', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349715, -78.117676, NULL, NULL),
('I896', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349688, -78.117523, NULL, NULL),
('I897', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349677, -78.117462, NULL, NULL),
('I898', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349667, -78.117401, NULL, NULL),
('I899', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349656, -78.117340, NULL, NULL),
('I900', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349645, -78.117287, NULL, NULL),
('I901', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349634, -78.117226, NULL, NULL),
('I902', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349623, -78.117165, NULL, NULL),
('I903', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349612, -78.117104, NULL, NULL),
('I904', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349601, -78.117043, NULL, NULL),
('I905', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349590, -78.116982, NULL, NULL),
('I906', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349579, -78.116928, NULL, NULL),
('I907', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349568, -78.116867, NULL, NULL),
('I908', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349557, -78.116806, NULL, NULL),
('I909', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349546, -78.116745, NULL, NULL),
('I910', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349519, -78.116615, NULL, NULL),
('I911', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349511, -78.116570, NULL, NULL),
('I912', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349502, -78.116524, NULL, NULL),
('I913', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349493, -78.116470, NULL, NULL),
('I914', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349485, -78.116425, NULL, NULL),
('I915', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349476, -78.116379, NULL, NULL),
('I916', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349467, -78.116325, NULL, NULL),
('I917', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349458, -78.116280, NULL, NULL),
('I918', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349450, -78.116226, NULL, NULL),
('I919', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349441, -78.116180, NULL, NULL),
('I920', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349432, -78.116135, NULL, NULL),
('I921', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349424, -78.116081, NULL, NULL),
('I922', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349415, -78.116035, NULL, NULL),
('I923', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349406, -78.115990, NULL, NULL),
('I924', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349397, -78.115936, NULL, NULL),
('I925', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349389, -78.115891, NULL, NULL),
('I926', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349380, -78.115845, NULL, NULL),
('I927', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348570, -78.115974, NULL, NULL),
('I928', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348581, -78.116035, NULL, NULL),
('I929', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348592, -78.116104, NULL, NULL),
('I930', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348603, -78.116165, NULL, NULL),
('I931', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348614, -78.116234, NULL, NULL),
('I932', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348625, -78.116295, NULL, NULL),
('I933', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348636, -78.116364, NULL, NULL),
('I934', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348647, -78.116425, NULL, NULL),
('I935', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348658, -78.116493, NULL, NULL),
('I936', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348669, -78.116554, NULL, NULL),
('I937', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348679, -78.116623, NULL, NULL),
('I938', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348690, -78.116684, NULL, NULL),
('I939', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348701, -78.116753, NULL, NULL),
('I940', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348726, -78.116882, NULL, NULL),
('I941', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348739, -78.116959, NULL, NULL),
('I942', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348752, -78.117043, NULL, NULL),
('I943', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348765, -78.117119, NULL, NULL),
('I944', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348778, -78.117203, NULL, NULL),
('I945', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348791, -78.117279, NULL, NULL),
('I946', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348804, -78.117355, NULL, NULL),
('I947', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348818, -78.117439, NULL, NULL),
('I948', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348831, -78.117516, NULL, NULL),
('I949', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348844, -78.117592, NULL, NULL),
('I950', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348857, -78.117676, NULL, NULL),
('I951', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348886, -78.117821, NULL, NULL),
('I952', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348895, -78.117874, NULL, NULL),
('I953', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348904, -78.117920, NULL, NULL),
('I954', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348912, -78.117973, NULL, NULL),
('I955', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348921, -78.118027, NULL, NULL),
('I956', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348930, -78.118073, NULL, NULL),
('I957', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348938, -78.118126, NULL, NULL),
('I958', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348947, -78.118172, NULL, NULL),
('I959', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348955, -78.118225, NULL, NULL),
('I960', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348964, -78.118271, NULL, NULL),
('I961', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348973, -78.118324, NULL, NULL),
('I962', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348981, -78.118378, NULL, NULL),
('I963', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348990, -78.118423, NULL, NULL),
('I964', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.348999, -78.118477, NULL, NULL),
('I965', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349007, -78.118523, NULL, NULL),
('I966', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349026, -78.118675, NULL, NULL),
('I967', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349036, -78.118736, NULL, NULL),
('I968', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349046, -78.118797, NULL, NULL),
('I969', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349056, -78.118851, NULL, NULL),
('I970', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349067, -78.118912, NULL, NULL),
('I971', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349077, -78.118973, NULL, NULL),
('I972', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349087, -78.119026, NULL, NULL),
('I973', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349097, -78.119087, NULL, NULL),
('I974', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349107, -78.119148, NULL, NULL),
('I975', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349117, -78.119202, NULL, NULL),
('I976', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349127, -78.119263, NULL, NULL),
('I977', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349138, -78.119324, NULL, NULL),
('I978', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349148, -78.119385, NULL, NULL),
('I979', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349158, -78.119438, NULL, NULL),
('I980', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349168, -78.119499, NULL, NULL),
('I981', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349190, -78.119637, NULL, NULL),
('I982', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349200, -78.119698, NULL, NULL),
('I983', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349210, -78.119751, NULL, NULL),
('I984', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349220, -78.119812, NULL, NULL),
('I985', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349230, -78.119873, NULL, NULL),
('I986', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349240, -78.119926, NULL, NULL),
('I987', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349250, -78.119987, NULL, NULL),
('I988', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349260, -78.120049, NULL, NULL),
('I989', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349270, -78.120110, NULL, NULL),
('I990', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349281, -78.120163, NULL, NULL),
('I991', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349291, -78.120224, NULL, NULL),
('I992', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349301, -78.120285, NULL, NULL),
('I993', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349311, -78.120338, NULL, NULL),
('I994', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349321, -78.120399, NULL, NULL),
('I995', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349345, -78.120529, NULL, NULL),
('I996', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349354, -78.120590, NULL, NULL),
('I997', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349364, -78.120644, NULL, NULL),
('I998', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349373, -78.120697, NULL, NULL),
('I999', 'D', 7, 'N', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0, 0.349382, -78.120758, NULL, NULL),
('VIAPUB', 'D', 7, 'V', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 48, 0.000000, 0.000000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `publicidad`
--

CREATE TABLE `publicidad` (
  `pub_id` int(11) NOT NULL,
  `pub_nombre` varchar(45) NOT NULL,
  `pub_imagen` varchar(255) NOT NULL,
  `pub_link` varchar(255) DEFAULT NULL,
  `pub_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publicidad`
--

INSERT INTO `publicidad` (`pub_id`, `pub_nombre`, `pub_imagen`, `pub_link`, `pub_estado`) VALUES
(5, 'Ibarra', 'http://54.69.247.99/Violations/publicidad/publicidad_5.png', 'http://www.ibarraecuador.gob.ec/', 1);

-- --------------------------------------------------------

--
-- Table structure for table `punto_recarga`
--

CREATE TABLE `punto_recarga` (
  `pun_rec_id` int(11) NOT NULL,
  `pun_rec_nombre` varchar(45) DEFAULT NULL,
  `pun_rec_ruc` varchar(45) DEFAULT NULL,
  `pun_rec_codigo` varchar(45) DEFAULT NULL,
  `pun_rec_lat` float(10,6) DEFAULT NULL,
  `pun_rec_lng` float(10,6) DEFAULT NULL,
  `pun_rec_direccion` varchar(500) DEFAULT NULL,
  `pun_rec_observaciones` text,
  `pun_rec_saldo` float(10,2) NOT NULL DEFAULT '0.00',
  `pun_rec_habilitado` int(1) NOT NULL DEFAULT '0',
  `pun_rec_clave` char(32) DEFAULT NULL,
  `pun_rec_nombres` varchar(250) NOT NULL,
  `pun_rec_apellidos` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `punto_recarga`
--

INSERT INTO `punto_recarga` (`pun_rec_id`, `pun_rec_nombre`, `pun_rec_ruc`, `pun_rec_codigo`, `pun_rec_lat`, `pun_rec_lng`, `pun_rec_direccion`, `pun_rec_observaciones`, `pun_rec_saldo`, `pun_rec_habilitado`, `pun_rec_clave`, `pun_rec_nombres`, `pun_rec_apellidos`) VALUES
(1, 'VENTA DE PERIODICOS', '1000961266', NULL, 0.000000, 0.000000, 'BOLIVAR  0 y FLORES ESQUINA', '', 0.00, 0, NULL, 'BLANCA ESPERANZA', 'CARDENAS'),
(2, 'TROFEOS DEPORTIVOS MARTHA DE ARROYO', '1000441665', NULL, NULL, NULL, 'BOLIVAR 10-64 y ENTRE COLON Y P. GUERRERO', '', 0.00, 0, NULL, 'FABIAN RUBEN', 'ARROYO ACOSTA'),
(3, 'LA SUPER PAPELERIA', '1000863488', NULL, NULL, NULL, 'PEDRO MONCAYO 7-18 y OLMEDO', NULL, 0.00, 0, NULL, 'MIGUEL ANGEL', 'HERRERA BAEZ'),
(4, 'PELUQUERIA', '1000351310', NULL, NULL, NULL, 'OBISPO MOSQUERA 10-05 y JUANA ATABALIPA', NULL, 0.00, 0, NULL, 'HECTOR HUMBERTO', 'VILA'),
(5, 'PELUQUERIA', '1001539988', NULL, NULL, NULL, 'OBISPO MOSQUERA 10-05 y JUANA ATABALIPA', NULL, 0.00, 0, NULL, 'GLORIA AVELINA', 'ENDARA BECERRA'),
(6, 'DANWIL', '1707755912', NULL, NULL, NULL, 'BOLIVAR 10-82 y PERES GUERRERO', NULL, 0.00, 0, NULL, 'WILSON SEGUNDO', 'CALVACHI VEGA'),
(7, 'PLASTICOS IMBABURA', '1001179066', NULL, NULL, NULL, 'AV. EUGENIO ESPEJO 9-53 y VELASCO', NULL, 0.00, 0, NULL, 'LIVA MARGARITA', 'VALLEJOS VILLOTA'),
(8, 'EL RINCON', '1003194774', NULL, NULL, NULL, 'PEDRO MONCAYO 4-10 y ROCAFUERTE', NULL, 0.00, 0, NULL, 'KARLA FERNANDA', 'MONCAYO SUAREZ'),
(9, 'HOLLIWOD', '1002073664', NULL, NULL, NULL, 'J.J. FLORES 8-43 y SANCHEZ Y CIFUENTES', NULL, 0.00, 0, NULL, 'JOSELITO JAVIER', 'PATI'),
(10, 'INTERCOM', '1002222360', NULL, NULL, NULL, 'LIBORIO MADERA 4-32 y ENTRE SUCRE Y ROCAFUERTA', NULL, 0.00, 0, NULL, 'OSWALDO XAVIER', 'TORRES MERLO'),
(11, 'ALMACEN ELECTROLUZ', '1001076064', NULL, NULL, NULL, 'GRIJALVA 6-36 y BOLIVAR', NULL, 0.00, 0, NULL, 'MARIA JULIETA', 'ALMEIDA SCACCO'),
(12, 'INTECNOLOGYS', '0400874954', NULL, NULL, NULL, 'ROCAFUERTE 4-51 y GARCIA MORENO', NULL, 0.00, 0, NULL, 'GALO KLEVER', 'CARRERA MAYGUA'),
(13, 'ALMACEN JOSNICOS', '1002487351', NULL, NULL, NULL, 'OLMEDO 8-19 y OVIEDO', NULL, 0.00, 0, NULL, 'JANETH DE LOS ANGELES', 'ROLDAN ROBLES'),
(14, 'MAXICELL', '1002980215', NULL, NULL, NULL, 'SANCHEZ Y CIFUENTES 11-74 y CRISTOBAL COLON', NULL, 0.00, 0, NULL, 'DIEGO FERNANDO', 'CHAMORRO BENAVIDES'),
(15, 'LA FINCA MARKET', '1003099486', NULL, NULL, NULL, 'GARCIA MORENO 000 y CHICA NARVAEZ', NULL, 0.00, 0, NULL, 'PAMELA ELIZABETH', 'PANTOJA UNDA'),
(16, 'RESTAURANTE EL CEIBO', '1001036605', NULL, NULL, NULL, 'OLMEDO 10-17 y VELASCO', NULL, 0.00, 0, NULL, 'JESUS DAVID', 'CARANQUI VILLEGAS'),
(17, 'PA', '1001313434', NULL, NULL, NULL, 'COLON 9-23 y SANCHEZ Y CIFUENTES', NULL, 0.00, 0, NULL, 'EMPERATRIZ', 'LOPEZ FERIGRA'),
(18, 'TIENDA SOVRANA', '1000456432', NULL, NULL, NULL, 'PEDRO MONCAYO 7-83 y SANCHEZ Y CIFUENTES', NULL, 0.00, 0, NULL, 'BLANCA PIEDAD', 'GODOY OVIEDO'),
(19, 'VIVERES MARTHITA', '1001449030', NULL, NULL, NULL, 'J.J. FLORES 8-27 y OLMEDO', NULL, 0.00, 0, NULL, 'MARTHA LUCIA', 'PE'),
(20, 'COMERCIAL J.E.', '1000330678', NULL, NULL, NULL, 'ANTONI CORDERO 3-05 y ZENON VILLACIS', NULL, 0.00, 0, NULL, 'JUDITH INES CLEOTILDE', 'ESTEVEZ CAICEDO'),
(21, 'PORTA, MOVISTAR, ALEGRO', '1706858279', NULL, NULL, NULL, 'SANCHEZ Y CIFUENTES 8-34 y J.J. FLORES', NULL, 0.00, 0, NULL, 'LUIS ENRIQUE', 'GUERRERO VASQUEZ '),
(22, 'COPIAS, CABINAS Y ALGO MAS', '1002163937', NULL, NULL, NULL, 'ROCAFUERTE 7-31 y OVIEDO', NULL, 0.00, 0, NULL, 'JAIDE JAQUELINE', 'ROMAN ARCINIEGA'),
(23, 'LANAS CISNE', '1702096650', NULL, NULL, NULL, 'OLMEDO 10-16 y VELASCO', NULL, 0.00, 0, NULL, 'RAUL OSWALDO', 'CORDOVA ALMEIDA'),
(24, 'AMIGOS ON LINE', '1001981222', NULL, NULL, NULL, 'SANCHEZ Y CIFUENTES 10-07 y PEDRO MONCAYO', NULL, 0.00, 0, NULL, 'FRANKLIN LIBARDO', 'PASPUEZAN PEREZ'),
(25, 'GUSTAVO ACOSTA COBA', '1001164464', NULL, NULL, NULL, 'OLMEDO 7-91 y OVIEDO', NULL, 0.00, 0, NULL, 'GUSTAVO ATAHUALPA', 'ACOSTA COBA'),
(26, 'KLASCE', '0102180213', NULL, NULL, NULL, 'ANTONIO JOSE DE SUCRE 8-18 y PEDRO MONCAYO', NULL, 0.00, 0, NULL, 'CESAR ALFONSO', 'LOPEZ SARABIA'),
(27, 'CELULAR CENTER', '1002172821001', NULL, NULL, NULL, 'BOLIVAR  9-12 y VELASCO', NULL, 0.00, 0, NULL, 'CENTER', 'CELULAR '),
(28, 'DOMINET', '1001756954', NULL, NULL, NULL, 'BOLIVAR 8-35 y PEDRO MONCAYO', NULL, 0.00, 0, NULL, 'ERICK MAURICIO', 'ALMEIDA PUGA'),
(29, 'REGISTRO DE LA PROPIEDAD IBARRA', '1002253258', NULL, NULL, NULL, 'PEDRO MONCAYO 00 y ROCAFUERTE ESQUINA', NULL, 0.00, 0, NULL, 'MARIA CRISTINA', 'FLORES CALVACHE'),
(30, 'PAPELERIA Y LIBRERIA DIANITA', '1205101353', NULL, NULL, NULL, 'SANCHEZ Y CIFUENTES 8-56 y FLORES', NULL, 0.00, 0, NULL, 'DOLORES ISABEL', 'VILLAMAR COELLO'),
(31, 'TRAPOS BOUTIQUE', '1002059929', NULL, NULL, NULL, 'SUCRE 5-22 y GARCIA MORENO', NULL, 0.00, 0, NULL, 'CECILIA BEATRIZ', 'HIDALGO GUERRON'),
(32, 'TECNIDUREX', '1711277812', NULL, NULL, NULL, 'ANTONIO CORDERO 1-38 y OBISPO MOSQUERA', NULL, 0.00, 0, NULL, 'EMMA MARIANA', 'CARRERA ALARCON'),
(33, 'ALMACEN GRAN COLOMBIA', '1000412880', NULL, NULL, NULL, 'OBISPO MOSQUERA 9-27 y ENTRE SANCHEZ Y CIFUENTES Y ATABALIPA', NULL, 0.00, 0, NULL, 'FAUSTO GONZALO', 'CHUQUIN RUIZ'),
(34, 'PAPELERIA VACA JUNIOR', '1000749299', NULL, NULL, NULL, 'BOLIVAR  6-42 y FLORES', NULL, 0.00, 0, NULL, 'GLADYS LEONOR', 'BAEZ TOBAR'),
(35, 'HELADERIA LA BERMEJITA', '1001101060', NULL, NULL, NULL, 'SANCHEZ Y CIFUENTES 8-74 y ENTRE FLORES Y OVIEDO', NULL, 0.00, 0, NULL, 'PATRICIO EDUARDO', 'PAREDES CADENA'),
(36, 'MULTISERVICIOS FOTORAMA', '1001222056', NULL, NULL, NULL, 'VELASCO  8-49 y SANCHEZ Y CIFUENTES', NULL, 0.00, 0, NULL, 'EDUARDO TIBERIO', 'ROSERO TAFUR'),
(37, 'EL COPION', '1001919917', NULL, NULL, NULL, 'BOLIVAR 7-37 y OVIEDO', NULL, 0.00, 0, NULL, 'RICARDO DANIEL ', 'RUEDA RUEDA '),
(38, 'ARCO IRIS', '1002254512', NULL, NULL, NULL, 'BOLIVAR  9-32 y VELASCO', NULL, 0.00, 0, NULL, 'CARLA PAOLA', 'LEON RON'),
(39, 'CENTRO DE COPIADO TEFI', '1002061990', NULL, NULL, NULL, 'SANCHEZ Y CIFUENTES 10-70 y VELASCO', NULL, 0.00, 0, NULL, 'MARIA ESTEFANIA', 'ZAMORA GUANOQUIZA'),
(40, 'TROFEOS OLIMPICO', '1002002523', NULL, NULL, NULL, 'BOLIVAR 11-18 y AV. PEREZ GUERRERO', NULL, 0.00, 0, NULL, 'ROCIO ELIZABETH', 'RAMOS ANDRADE'),
(41, 'COOPERATIVA DE AHORRO Y CREDITO ARTESANOS', '0400690640', NULL, NULL, NULL, 'SUCRE  6-24 y ENTRE FLORES Y OVIEDO', NULL, 0.00, 0, NULL, 'JORGE ARNULFO', 'PASPUEZAN '),
(42, 'BOUTIQUE D CLASS', '1000409100', NULL, NULL, NULL, 'BOLIVAR 5-78 y PEDRO MONCAYO', NULL, 0.00, 0, NULL, 'ELVIA', 'CIFUENTES FLORES'),
(43, 'CLINICA METROPOLITANA', '1002682811', NULL, NULL, NULL, 'CHICA NARVAEZ 00000000000000 y GRIJALVA', NULL, 0.00, 0, NULL, 'MARIA CLEOTILDE', 'VARELA VERGARA'),
(44, 'VENTA DE CD', '6384179', NULL, NULL, NULL, 'GARCIA MORENO  744 y OLMEDO', NULL, 0.00, 0, NULL, 'JOSE SURLEY ', 'SINISTERRA ARBOLEDA'),
(45, 'LA IBARRE', '1714655410', NULL, NULL, NULL, 'OLMEDO 7-45 y ENTRE FLORES Y OVIEDO', NULL, 0.00, 0, NULL, 'MARIANELA MARIBEL', 'NU'),
(46, 'METALICAS RECORD', '1706653050', NULL, NULL, NULL, 'OBISPO MOSQUERA Y JUANA ATABALIPA    1 y ', NULL, 0.00, 0, NULL, 'JORGE ENRIQUE', 'IPIALES POTOSI'),
(47, 'MATALICAS RECORD ', '1002298386', NULL, NULL, NULL, 'OBISPO MOSQUERA Y JUANA ATABALIPA  1 y ', NULL, 0.00, 0, NULL, 'SANTIAGO VINICIO', 'IPIALES POTOSI'),
(48, 'ELECTRO CAR BE ', '1003156443', NULL, NULL, NULL, 'AV MARIANO ACOSTA  10   62  y LUIS  CABEZAS BORJA ', NULL, 0.00, 0, NULL, 'VICTORIA ANDREINA ', 'BEDON CRUZ '),
(49, 'FERRETERIA BOLIVAR ', '1707902605', NULL, NULL, NULL, 'BOLIVAR  12  08  y OBISPO MOSQUERA  ESQUINA ', NULL, 0.00, 0, NULL, 'RUTH MARCIA', 'AGUIRRE CHIMARRO'),
(50, 'PANADERIA PASTELERIA NUMBER CNE', '1001269313', NULL, NULL, NULL, 'AV JAIME RIVADENEIRA  5 18 y OVIEDO Y PEDRO MONCAYO ', NULL, 0.00, 0, NULL, 'MARIA DEL CARMEN', 'MONTOYA REA'),
(51, 'KIOSKO PAR QUE PEDRO MONCAYO ', '1001609823', NULL, NULL, NULL, 'GARCIA MORENO  Y SUCRE  ESQ FRENTE IGLESIA  0001 y GARCIA MORENO', NULL, 0.00, 0, NULL, 'MARIA ROSA MATILDE', 'PAZMI'),
(52, 'EXPOPAPELERIA', '1000994762', NULL, NULL, NULL, 'SUCRE 10-70 Y AV PEREZ GUERRERO 10-70 y ', NULL, 0.00, 0, NULL, 'CERVANDO ALFREDO', 'ERAZO GALARZA'),
(53, 'COMERCIAL VARIEDADES', '1001614591', NULL, NULL, NULL, 'CALIXTO MIRANDA 1 30  1 30 y Y OBISPO MOSQUERA ', NULL, 0.00, 0, NULL, 'CARLINA MARGARITA', 'HUACA PINCHAO'),
(54, 'BC TECNOLOGIA', '1002527008', NULL, NULL, NULL, 'OBISPO MOSQUERA 8-33 y SANCHEZ Y CIFUENTES', NULL, 0.00, 0, NULL, 'BYRON WILSON', 'CARRANCO VELA'),
(55, 'CLARO ON LINE', '1001838471', NULL, NULL, NULL, 'SANCHEZ Y CIFUENTES 97 973 y PEDRO MONCAYO', NULL, 0.00, 0, NULL, 'EDIT GENOVEVA', 'PANTOJA LEITON'),
(56, 'PUESTO DE CARAMELOS', '1001005956', NULL, NULL, NULL, 'SUCRE SN y OBISPO MOSQUERA', NULL, 0.00, 0, NULL, 'MARTHA GUADALUPE', 'GUERRERO PIZANAN'),
(57, 'VENTA DE PERIODICO', '1001421575', NULL, NULL, NULL, 'OBISPO MOSQUERA 1 y EUGENIO ESPEJO ESQ.', NULL, 0.00, 0, NULL, 'NANCY ROSANA', 'VINUEZA POZO'),
(58, 'SACODI PUNTO DE FABRICA LIRIS', '0401110499', NULL, NULL, NULL, 'FRAY VACAS GALINDO 1 y DARIO EGAS ESQ,', NULL, 0.00, 0, NULL, 'JOFRE RODRIGO', 'SANTOS BASTIDAS'),
(59, 'JHS PAPELERIA', '1702930940', NULL, NULL, NULL, 'COLON 615 y SUCRE Y BOLIVAR', NULL, 0.00, 0, NULL, 'JOSE HUMBERTO', 'SALAZAR HERRERA'),
(60, 'CYBER BLACK AND WHITE', '0400965307', NULL, NULL, NULL, 'GARCIA MORENO 4-23 y ROCAFUERTE', NULL, 0.00, 0, NULL, 'SONIA PATRICIA ', 'MORILLO LOPEZ'),
(61, 'PATRONATO MUNICIPAL DE SAN MIGUEL DE IBARRA', '1091706233001', NULL, NULL, NULL, 'BOIVAR  ESQUINA 000 y GARCIA MORENO', NULL, 0.00, 0, NULL, 'SAN MIGUEL DE IBARRA', 'PATRONATO MUNICIPAL'),
(62, 'PRODUSEG', '1001302031', NULL, NULL, NULL, 'CHICA NARVAEZZ 395 y GRIJALVA', NULL, 0.00, 0, NULL, 'FRANKLIN HOMERO', 'GRANDA CHUQUIN'),
(63, 'CHELOS VARIEDADES', '1003785340', NULL, NULL, NULL, 'PEDRO MONCAYO 8-24 y SANCHES Y CIFUENTES', NULL, 0.00, 0, NULL, 'OLGA GRACIELA', 'ARTIEDA PASPUEZAN'),
(64, 'LOCAL DE VENTA DE ROPA N.2', '1001323755', NULL, NULL, NULL, 'FRAY VACAS GALINDO S.N. y DARIO EGAS', NULL, 0.00, 0, NULL, 'WILMER FABRICIO', 'LITA CHAVEZ'),
(65, 'INNOVACION ELECTRICA ', '0401496179', NULL, NULL, NULL, 'OBISPO MOSQUERA  666 y CALIXTO MIRANDA ', NULL, 0.00, 0, NULL, 'FAUSTO GEOVANNY', 'CERON HERNANDEZ'),
(66, 'CENTRO NET', '0400995379', NULL, NULL, NULL, 'ROCAFUERTE 879 y VELASCO', NULL, 0.00, 0, NULL, 'LAURA NOEMI', 'PIJAL ORTEGA'),
(67, 'MANTENIMIENTO ELECTRONICO', '1002881546', NULL, NULL, NULL, 'CHICA NARVAEZ 863 y PEDRO MONCAYO', NULL, 0.00, 0, NULL, 'ELIZABETH ', 'MINA OTUNA '),
(68, 'PAPOS MINI MARKET', '1000876720', NULL, NULL, NULL, 'SNCHEZ Y CIFUENTES 578 y GRIJALVA', NULL, 0.00, 0, NULL, 'MIGUEL ANGEL', 'RUEDA RODRIGUEZ'),
(69, 'RESTAURANTE VEGETARIANO ZENCWEI', '1717231060', NULL, NULL, NULL, 'OVIEDO  545 y ROCAFUERTE Y SUCRE', NULL, 0.00, 0, NULL, 'MAO TE', 'SHIH'),
(70, 'DISTRIBUIDORA TBS', '1003506571', NULL, NULL, NULL, 'RAFAEL SANCHEZ 1-44 y OBISPO MOSQUERA', NULL, 0.00, 0, NULL, 'JOSE LUIS ', 'TANDAZO BRAVO'),
(71, 'LOCAL DE PELICULAS', '1003175427', NULL, NULL, NULL, 'BARTOLOME GARCIA 1-42 y OBISPO MOSQUERA', NULL, 0.00, 0, NULL, 'ELIANA MERCEDES', 'VALLEJO AYALA '),
(72, 'VIVERES DON CARLITOS', '1002392544', NULL, NULL, NULL, 'CALIXTO MIRANDA 1-68 y OBISPO MOSQUERA', NULL, 0.00, 0, NULL, 'CARLOS ALFREDO', 'IMBAGO BENAVIDES'),
(73, 'MINIMARKET SUCRE', '1002774832', NULL, NULL, NULL, 'SUCRE 6-70 y OVIEDO', NULL, 0.00, 0, NULL, 'JAIME DEMITRI', 'PASQUEL REA'),
(74, 'PUBLICENTRO', '1000927754', NULL, NULL, NULL, 'ROCAFUERTE 9-04 y VELASCO', NULL, 0.00, 0, NULL, 'LUIS ERNESTO', 'FUENTES GARCIA'),
(75, 'OK FASHION', '1713854063', NULL, NULL, NULL, 'ROCAFUERTE 8-71 y VELASCO', NULL, 0.00, 0, NULL, 'MARIA FERNANDA', 'FUENTES POZO'),
(76, 'DON KILO', '1500528243', NULL, NULL, NULL, 'JUAN FRANCISCO CEVALLOS 1-81 y ZENON VILLACIS', NULL, 0.00, 0, NULL, 'DIEGO PATRICIO', 'RIVERA GONZALEZ'),
(77, 'TIENDA ABARROTES', '1001474772', NULL, NULL, NULL, 'FLORES 10-33 y CHICA NARVAEZ', NULL, 0.00, 0, NULL, 'NATALIA MARLENE', 'LOPEZ MARTINEZ'),
(78, 'NORCELL', '1002171831', NULL, NULL, NULL, 'BOLIVAR 8-89 y VELASCO', NULL, 0.00, 0, NULL, 'ALICIA DEL CARMEN', 'RAMOS PAEZ'),
(79, 'IBARRA MOTOS', '1001238011', NULL, NULL, NULL, 'CALIXTO MIRANDA 11-30 y LARREA', NULL, 0.00, 0, NULL, 'RODRIGO MIGUEL', 'ROSERO ENRIQUEZ'),
(80, 'CLARO MINI TIENDA', '1004396485', NULL, NULL, NULL, 'SANCHEZ Y CIFUENTES 8-34 y ', NULL, 0.00, 0, NULL, 'SANDY ISAMAR', 'PASPUEZAN PAEZ'),
(81, 'RYP DERRETERIA CONSTRUCCIONES', '1704975554', NULL, NULL, NULL, 'SUCRE ESQUINA y OVIEDO', NULL, 0.00, 0, NULL, 'MIRIAM DEL CARMEN', 'RUALES MORALES '),
(82, 'LA ESTUFA DE YOLY', '1001724978', NULL, NULL, NULL, 'CHICA NARVAEZ  3-25 y BORRERO', NULL, 0.00, 0, NULL, 'MARTHA YOLANDA', 'GUDI'),
(83, 'FLAPPERS', '1310026164', NULL, NULL, NULL, 'OVIEDO  9-15 y SANCHEZ Y CIFUENTES', NULL, 0.00, 0, NULL, 'TANIA VIVIANA', 'COLOMA VERA'),
(84, 'VIVERES SHEKINA', '1003061551', NULL, NULL, NULL, 'CALIXTO MIRANDA  1-72 y OBISPO MOSQUERA', NULL, 0.00, 0, NULL, 'CLAUDIA VERNICA', 'ALVEAR AGUILAR'),
(85, 'DECOMURAL', '1000634988', NULL, NULL, NULL, 'BARTOLOME GARCIA 1-54 y OBISPO MOSQUERA', NULL, 0.00, 0, NULL, 'HIPOLITO VINICIO', 'CASTRO QUELAL'),
(86, 'COPIAS', '1002002580', NULL, NULL, NULL, 'FLORES 5-36 y SUCRE', NULL, 0.00, 0, NULL, 'LUIS ALFONSO', 'ORMAZA BAEZ'),
(87, 'FRIGORIFICO FERNANDO Y ESPOSA', '1003233820', NULL, NULL, NULL, 'OBISPO MOSQUERA 3-82 y EUGENIO ESPEJO', NULL, 0.00, 0, NULL, 'HUGO FERNANDO', 'LOMAS CASTILLO'),
(88, 'HELADERIA KOS FROZEN YOGURT', '1003232152', NULL, NULL, NULL, 'SANCHEZ Y CIFUENTES  9-54 y PEDRO MONCAYO', NULL, 0.00, 0, NULL, 'ALEXANDRA ELIZABETH', 'RUEDA PONCE'),
(89, 'DISTRIBUCION TBS', '1003525464', NULL, NULL, NULL, 'RAFAEL SANCHEZ 1-44 y OBISPO MOSQUERA', NULL, 0.00, 0, NULL, 'MARJORIE YADIRA', 'PIGUA'),
(90, 'CALZADO LIVITA', '1001178548', NULL, NULL, NULL, 'PEDRO MONCAYO 8-45 y SANCHEZ Y CIFUENTES', NULL, 0.00, 0, NULL, 'NARCISA EUJENIA LIVA', 'GUAMANI CUASAPAS'),
(91, 'OPTICA BOLIVAR', '1001002029', NULL, NULL, NULL, 'SANCHEZ Y CIFUENTES 8-59 y OVIEDO', NULL, 0.00, 0, NULL, 'SECUNDINO BOLIVAR', 'MONTENEGRO HUERTAS'),
(92, 'PA', '1001692084', NULL, NULL, NULL, 'JUAN FRANCISCO CEVALLOS 1-45 y OBISPO MOSQUERA', NULL, 0.00, 0, NULL, 'DELIA MARIA', 'VARELA TAPIA'),
(93, 'CALZADO NADIA', '1000779593', NULL, NULL, NULL, 'OLMEDO 9-35 y PEDRO MONCAYO', NULL, 0.00, 0, NULL, 'CARMELA PIEDAD', 'HIDALGO VALLEJOS'),
(94, 'CAFETERIA', '1002480422', NULL, NULL, NULL, 'OLMEDO 7-63 y OVIEDO', NULL, 0.00, 0, NULL, 'TATIANA LIZETH', 'MONTESDEOCA PAZMI'),
(95, 'CABINAS INTERNET GEMINIS', '0401052501', NULL, NULL, NULL, 'CHICA NARVAEZ ESQUINA y FLORES', NULL, 0.00, 0, NULL, 'AMPARITO DE LOURDES ', 'LOPEZ BAEZ'),
(96, 'RAPID FOTO KONICA', '1000680759', NULL, NULL, NULL, 'SANCHEZ Y CIFUENTES 11-36 y VELASCO', NULL, 0.00, 0, NULL, 'JORGE OSWALDO', 'AMAGUA'),
(97, 'CIBER CABINAS', '1001530367', NULL, NULL, NULL, 'OLMEDO 5-56 y GARCIA MORENO', NULL, 0.00, 0, NULL, 'MANUEL ALFONSO', 'DE JESUS ECHEVERRIA'),
(98, 'LA FINKA MARKET', '1000959898', NULL, NULL, NULL, 'GARCIA MORENO ESQUINA y CHICA NARVAEZ', NULL, 0.00, 0, NULL, 'ROSA ELIZABETH ', 'UNDA ANDRADE'),
(99, 'LORENA CERVANTES', '1001736030', NULL, NULL, NULL, 'JUANA ATABALIPA 1-52 y OBISPO MOSQUERA', NULL, 0.00, 0, NULL, 'LORENA GUADALUPE', 'CERVANTES RODRIGUEZ'),
(100, 'POLLO BROSTER AL PASO', '1001514254', NULL, NULL, NULL, 'OBISPO MOSQUERA 6-33 y BOLIVAR', NULL, 0.00, 0, NULL, 'SONIA MAGDALENA', 'SAA MONTESDEOCA'),
(101, 'IMSA', '1002014635', NULL, NULL, NULL, 'BOLIVAR 8-81 y VELASCO', NULL, 0.00, 0, NULL, 'CAROLINA ANTONIETA', 'CHILUISA CHICAIZA'),
(102, 'RAPA ELECTRIC FG', '1715721120', NULL, NULL, NULL, 'OVIEDO 9-12 y SANCHEZ Y CIFUENTES', NULL, 0.00, 0, NULL, 'FAUSTO BAYRON', 'GARCIA GARCIA'),
(103, 'CASA BLANCA', '1002062378', NULL, NULL, NULL, 'BOLIVAR 8-45 y VELASCO', NULL, 0.00, 0, NULL, 'ROXANA LUCIA', 'GUERRERO CAMUENDO'),
(104, 'C.C LA BAHIA LOCAL 141', '1002281986', NULL, NULL, NULL, 'PEREZ GUERRERO LOCAL 141 y EUGENIO ESPEJO', NULL, 0.00, 0, NULL, 'AMPARO MARIBEL', 'SANTANDER CERVANTES'),
(105, 'FLORISTERIA Y ALGO MAS', '1712271780', NULL, NULL, NULL, 'FLORES 9-63 y CHICA NARVAEZ', NULL, 0.00, 0, NULL, 'DAVID JAMES', 'SCOTT DEL CASTILLO'),
(106, 'NOVEDAS Y FANTASIAS YARINA', '1001937828', NULL, NULL, NULL, 'OLMEDO 8-83 y MONCAYO', NULL, 0.00, 0, NULL, 'JUAN MANUEL', 'PINEDA VEGA'),
(107, 'PERIODICOS EL NORTE ', '1001035201', NULL, NULL, NULL, 'GARCIA MORENO ESQUINA y SANCHEZ Y CIFUENTES', NULL, 0.00, 0, NULL, 'ANTONIO TOMAS', 'GUERRA TORRES'),
(108, 'DISTRIBUIDORA CYJ', '1004123921', NULL, NULL, NULL, 'ANTONIO CORDERO  1-60 y ZENON VILLACIS', NULL, 0.00, 0, NULL, 'CRISTIAN ALEJANDRO', 'MORENO RECALDE '),
(109, 'GOLOSINAS Y ALGO MAS', '1003145370', NULL, NULL, NULL, 'OLMEDO 10-75 y COLON', NULL, 0.00, 0, NULL, 'ANALIA CAROLINA', 'ARIAS YEPEZ'),
(110, 'BALANCEADOS MARITZA', '1103663165', NULL, NULL, NULL, 'BARTOLOME GARCIA 1-94 y OBISPO MOSQUERA', NULL, 0.00, 0, NULL, 'FELIX GEOVANY', 'VI'),
(111, 'VYF COBERTORES', '1722891312', NULL, NULL, NULL, 'MONCAYO 8-24 y SANCHEZ Y CIFUENTES', NULL, 0.00, 0, NULL, 'VERONICA ALEXANDRA', 'HIDALGO ANDRADE '),
(112, 'KME', '0401007901', NULL, NULL, NULL, 'SUCRE 10-68 y COLON', NULL, 0.00, 0, NULL, 'SILVIA LUCIA', 'FUELANTALA PORTILLO'),
(113, 'VENTA DE NOGADAS', '1000356608', NULL, NULL, NULL, 'OLMEDO ESQUINA y GARCIA MORENO', NULL, 0.00, 0, NULL, 'MARIA CONCEPCION', 'HERNANDEZ BELTRAN '),
(114, 'SANTA ANITA DEL CARMEN', '1002472908', NULL, NULL, NULL, 'JUAN ATABALIPA 1-41 y OBISPO MOSQUERA', NULL, 0.00, 0, NULL, 'JENNY PATRICIA', 'ENRIQUEZ ANDRADE'),
(115, 'MANGLARES', '1001394376', NULL, NULL, NULL, 'ROCAFUERTE 7-54 y MONCAYO', NULL, 0.00, 0, NULL, 'MARICARMEN LUCETTE', 'ESTUPI'),
(116, 'HOT DOG', '1001299302', NULL, NULL, NULL, 'BOLIVAR 3-96 y GRIJALVA', NULL, 0.00, 0, NULL, 'JULIAN WASHINGTON', 'CORAL CAICEDO '),
(117, 'GARAGE SUPER PROVESUM', '1002964698', NULL, NULL, NULL, 'GRIJALVA  7-31 y SANCHEZ', NULL, 0.00, 0, NULL, 'EDISON GABRIEL', 'PAUCAR MURRAY'),
(118, 'ABASTO', '1000534246', NULL, NULL, NULL, 'SUCRE 4-07 y GRIJALVA', NULL, 0.00, 0, NULL, 'MARIA MAGDALENA', 'VILLACIS'),
(119, 'PREMIERTEL S.A.', '1703084671', NULL, NULL, NULL, 'BOLIVAR 12-123 y LARREA', NULL, 0.00, 0, NULL, 'FAUSTO PATRICIO', 'GRANDA DELGADO'),
(120, 'VENTA DE CARAMELOS', '1701080416', NULL, NULL, NULL, 'SUCRE CNT y GARCIA MORENO', NULL, 0.00, 0, NULL, 'ROBERTO', 'TAIPE TELINCHANA'),
(121, 'CABICELL', '0400959482', NULL, NULL, NULL, 'MONCAYO 5-78 y BOLIVAR', NULL, 0.00, 0, NULL, 'LUIS FERNANDO', 'CHULDE MORALES'),
(122, 'GABINETE DE BELLEZA NUEVO ESTILO', '1001409570', NULL, NULL, NULL, 'JUANA ATABALIPA 1-55 y ZENON VILLACIS', NULL, 0.00, 0, NULL, 'CLEMENCIA RUBI', 'ROBLES ARCOS'),
(123, 'PUESTO DE PERIODICO', '1201778725', NULL, NULL, NULL, 'BOLIVAR  ESQ y PEREZ GUERRERO', NULL, 0.00, 0, NULL, 'NELLY MARIANA', 'SANCHEZ VITERI'),
(124, 'PELUQUERIA EL EJECUTIVO', '0501627038', NULL, NULL, NULL, 'OBISPO MOSQUERA 11-27 y FRANCISCO CEVALLOS', NULL, 0.00, 0, NULL, 'MARIA LAURA', 'CHASI'),
(125, 'FOTO NARVAEZ', '1711460533', NULL, NULL, NULL, 'SANCHEZ Y CIFUENTES 10-36 y VELASCO', NULL, 0.00, 0, NULL, 'JESUS FERNANDO', 'NARVAEZ MURILLO'),
(126, 'VENTA DE PERIODICOS CELLJUAN', '1707533111', NULL, NULL, NULL, 'OBISPO MOSQUERA LOCAL 2 y SANCHEZ Y CIFUENTES', NULL, 0.00, 0, NULL, 'GUIDA NARCIZA', 'PABON GUERRA'),
(127, 'MINI MARKET SUCRE', '1002139937', NULL, NULL, NULL, 'SUCRE 6-70 y OVIEDO', NULL, 0.00, 0, NULL, 'WALTER BOLIVAR', 'PASQUEL REA'),
(128, 'CABASCANGO ARMAS MARIANA DE JESUS', '1001082252', NULL, NULL, NULL, 'ZENON VILLACIS 3-21 y JUAN FRANCISCO CEBALLOS', NULL, 0.00, 0, NULL, 'MARIANA DE JESUS', 'CABASCANGO ARMAS'),
(129, 'HELADOS KOS FROZEN YOGURT', '1002853248', NULL, NULL, NULL, 'SANCHEZ Y CIFUENTES 9-54 y PEDRO MONCAYO', NULL, 0.00, 0, NULL, 'GABRIELA MARGARITA', 'RUEDA PONCE'),
(130, 'CABINAS DE GILDA DEL PILAR', '1001317963', NULL, NULL, NULL, 'PEREZ GUERRERO 11-25 y SUCRE', NULL, 0.00, 0, NULL, 'GILDA DEL PILAR', 'CRUZ'),
(131, 'RUTA VENTURA AGENCIA DE VIAJES', '2000060851', NULL, NULL, NULL, 'OVIEDO 8-12 y OLMEDO', NULL, 0.00, 0, NULL, 'MAYRA SVETLANA', 'GUERRERO CORELLA'),
(132, 'INTERNET HOSTAL EL DORADO', '1002183307', NULL, NULL, NULL, 'OVIEDO  5-41 y ROCAFUERTE', NULL, 0.00, 0, NULL, 'LUCIO PATRICIO', 'DIAZ QUINTEROS'),
(133, 'PELUQUERIA EL EJECUTIVO', '1703146645', NULL, NULL, NULL, 'OBISPO MOSQUERA 11-27 y JUAN FRANSICISCO CEVALLOS', NULL, 0.00, 0, NULL, 'MARIA LAURA', 'CHASI'),
(134, 'VENTA DE PERIODICOS', '1003150719', NULL, NULL, NULL, 'SUCRE  CASETA y FLORES', NULL, 0.00, 0, NULL, 'ANA MARIA', 'BRUSIL MATANGO'),
(135, 'METROGRAFICA', '1001890530', NULL, NULL, NULL, 'FLORES 6-77 y BOLIVAR', NULL, 0.00, 0, NULL, 'LENIN DAVID', 'ROSERO NU'),
(136, 'WORLD PLAY', '1002865945', NULL, NULL, NULL, 'OLMEDO 9-53 y VELASCO', NULL, 0.00, 0, NULL, 'LADY MERCEDES', 'RUIZ VELASTEGUI'),
(137, 'OFICINA DE ARQUITECTO CAZARES', '1002349551', NULL, NULL, NULL, 'OLMEDO 5-19 y GRIJALVA', NULL, 0.00, 0, NULL, 'OSCAR RAFAEL', 'CAZARES FIGUEROA'),
(138, 'CLARO', '1003213137', NULL, NULL, NULL, 'COLON 8-34 y SANCHEZ Y CIFUENTES', NULL, 0.00, 0, NULL, 'BARBARITA TATIANA', 'CALDERON DIAZ '),
(139, 'CLARO', '1716622426', NULL, NULL, NULL, 'BOLIVAR 10-102 y PEREZ GUERRERO', NULL, 0.00, 0, NULL, 'RICARDO STALIN', 'PROCEL BARRIGA'),
(140, 'RESTAURANTE LA PERGOLA', '1001814159', NULL, NULL, NULL, 'ROCAFUERTE  6-48 y FLORES', NULL, 0.00, 0, NULL, 'ANDREA MIREYA', 'ENRIQUEZ JARAMILLO'),
(141, 'MINIMARKET PLUS', '0908669856', NULL, NULL, NULL, 'OLMEDO 5-80 y GARCIA MORENO', NULL, 0.00, 0, NULL, 'CARMITA ROSENIA', 'VI'),
(142, 'TRADICION DE IBARRA', '0400222568', NULL, NULL, NULL, 'SANCHEZ 8-55 y FLORES', NULL, 0.00, 0, NULL, 'CARMEN ', 'HERNANDEZ '),
(143, 'TRADICION DE IBARRA', '1001254620', NULL, NULL, NULL, 'SANCHEZ  8-55 y FLORES', NULL, 0.00, 0, NULL, 'CARMEN BENILDA', 'HERNANDEZ '),
(144, 'EXPOPAPELERIA', '1002008785', NULL, NULL, NULL, 'SUCRE 10-70 y PEREZ GUERRERO', NULL, 0.00, 0, NULL, 'FERNANDO GABRIEL', 'ERAZO GALARZA'),
(145, 'TIENDA MIDESPENSA', '1002711677', NULL, NULL, NULL, 'BOLIVAR 12-91 y RAFAEL LARREA', NULL, 0.00, 0, NULL, 'KARINA JIMENA', 'PADILLA CAMPA'),
(146, 'INTERNET', '1002684213', NULL, NULL, NULL, 'OBISPO MOSQUERA 6-26 y BOLIVAR', NULL, 0.00, 0, NULL, 'JENNY YOLANDA', 'VILLEGAS CERVANTES'),
(147, 'CLINICA BOLIVAR', '1000983997', NULL, NULL, NULL, 'BOLIVAR 10-72 y PEREZ GUERRERO', NULL, 0.00, 0, NULL, 'CARMEN ROSA', 'MOYA ESTRELLA '),
(148, 'INNO ELECTRIC', '1000997765', NULL, NULL, NULL, 'SANCHEZ 6-56 y GARCIA MORENO', NULL, 0.00, 0, NULL, 'LUIS ALFONSO', 'ARGOTHY ARCOS'),
(149, 'CICLO MORA', '1000981306', NULL, NULL, NULL, 'JUAN FRANCISCO CEVALLOS 208 y ZENON VILLACIS', NULL, 0.00, 0, NULL, 'LUIS ALEJANDRO', 'MORA MEJIA'),
(150, 'AI COMPU', '1003233333', NULL, NULL, NULL, 'COLON 7-50 y OLMEDO', NULL, 0.00, 0, NULL, 'GERMANICO ANIBAL ', 'CACHIMUEL IPIALES'),
(151, 'CYBER MANIA', '1708364524', NULL, NULL, NULL, 'COLON  530 y ROCAFUERTE', NULL, 0.00, 0, NULL, 'MILAGRO DORIS', 'CASTRO VASQUEZ'),
(152, 'CELULAR CENTER', '0401143672', NULL, NULL, NULL, 'BOLIVAR 9-12 y VELASCO', NULL, 0.00, 0, NULL, 'IRMA EMPERATRIZ', 'CHAFUELAN NEJER'),
(153, 'MEDIAS ELTEX', '1001168960', NULL, NULL, NULL, 'BOLIVAR ESQ. y VELASCO', NULL, 0.00, 0, NULL, 'CARLOS', 'MAIGUA PINEDA'),
(154, 'TECNICELL MATEITO', '1711408474', NULL, NULL, NULL, 'COLON 10-07 y VELASCO', NULL, 0.00, 0, NULL, 'ROSA ISABEL', 'BARRETO BURHUAN'),
(155, 'CAFE FORTUNA', '1091746790001', NULL, NULL, NULL, 'OLMEDO 11-64 y PEREZ GUERRERO', NULL, 0.00, 0, NULL, 'YIZETH ALEXANDRA', 'GUERRA QUINTERO'),
(156, 'COMERCIAL MANOSALVAS', '1001563988', NULL, NULL, NULL, 'PEDRO MONCAYO 10-22 y CABEZAS BORJA', NULL, 0.00, 0, NULL, 'WILMER CARLOS', 'MANOSALVAS ENRIQUEZ'),
(157, 'MUEBLES EL LAUREL', '1001121399', NULL, NULL, NULL, 'OLMEDO 11-71 y PEREZ GUERRERO', NULL, 0.00, 0, NULL, 'MARIA LUISA', 'REVELO'),
(158, 'AKEMY PELUQUERIA', '1002633210', NULL, NULL, NULL, 'FRAY VACAS LOCAL y DARIO EGAS', NULL, 0.00, 0, NULL, 'NANCY VIVIANA', 'MORALES BRUSIL '),
(159, 'COCOA INTIMA', '1002770137', NULL, NULL, NULL, 'BOLIVAR 8-73 y VELASCO', NULL, 0.00, 0, NULL, 'HECTOR ROMAN', 'LASCANO MONTALVO'),
(160, 'CENTRO DE COPIADO EL TORREON', '1002558938', NULL, NULL, NULL, 'FLORES  6-31 y SUCRE', NULL, 0.00, 0, NULL, 'XIMENA DEL ROSARIO', 'PANTOJA FLORES'),
(161, 'YANBAL', '1001715919', NULL, NULL, NULL, 'BOLIVAR 4 y VELASCO', NULL, 0.00, 0, NULL, 'MELA', 'JULIO GARZON'),
(162, 'ZAPATERIA', '0400864716', NULL, NULL, NULL, 'FRAY VACAS 10 y DARIO EGAS', NULL, 0.00, 0, NULL, 'AMILCAR OMAR', 'IMBAQUINGO CHAMORRO'),
(163, 'FLORERIA MIRIAM', '1720314317', NULL, NULL, NULL, 'ROCAFUERTE 9-30 y VELASCO', NULL, 0.00, 0, NULL, 'MIRIAM XIMENA', 'LOYO MONCAYO'),
(164, 'COCOS LICORERIA', '1002320990', NULL, NULL, NULL, 'OVIEDO 5-67 y SUCRE', NULL, 0.00, 0, NULL, 'TULA DEL PILAR', 'CAICEDO PLAZA'),
(165, 'UNIVERSAL-NET', '1002357760', NULL, NULL, NULL, 'ROCAFUERTE 8-71 y VELASCO', NULL, 0.00, 0, NULL, 'MARIA ESPERANZA', 'TORRES TORRES'),
(166, 'SU COPY', '402000', NULL, NULL, NULL, 'COLON 8-70 y SANCHEZ Y CIFUENTES', NULL, 0.00, 0, NULL, 'MARCO ALFONSO', 'BENALCAZAR HERRERA'),
(167, 'DULMANIA', '1001419231', NULL, NULL, NULL, 'BOLIVAR  6 y OVIEDO', NULL, 0.00, 0, NULL, 'RUBY DEL CARMEN', 'CABASCANGO ARMAS'),
(168, 'VENTA DE PERIODICOS', '1001143971', NULL, NULL, NULL, 'MONCAYO  ESQUINA y OLMEDO', NULL, 0.00, 0, NULL, 'JOSE OSWALDO', 'MAIGUA PINEDA'),
(169, 'VIVERES MARIA JOSE', '0401447404', NULL, NULL, NULL, 'ROCAFUERTE 11-74 y MOSQUERA', NULL, 0.00, 0, NULL, 'ALEXANDRA CECILIA', 'BENAVIDES AGUIRRE'),
(170, 'EL GOLOSO BRYAN', '1001883972', NULL, NULL, NULL, 'GARCIA MORENO 3-11 y MALDONADO', NULL, 0.00, 0, NULL, 'BLANCA OLIVA', 'JATIVA ECHEVERRIA '),
(171, 'MADE HOGAR', '1003763529', NULL, NULL, NULL, 'MONCAYO 10-10 y SANDUBILE', NULL, 0.00, 0, NULL, 'BRYAN ISMAEL', 'TERAN AYALA'),
(172, 'WORLD COMPUTERS', '0701084121', NULL, NULL, NULL, 'MONCAYO 3-53 y ROCAFUERTE', NULL, 0.00, 0, NULL, 'NORMA YOLANDA', 'CORDOVA PALADINES'),
(173, 'COMIDAS RAPIDAS Y CONFITERIA', '1205141458', NULL, NULL, NULL, 'OVIEDO  4-21 y ROCAFUERTE', NULL, 0.00, 0, NULL, 'VIRGINIA MARIA', 'ALVARADO SUAREZ'),
(174, 'FRUTAS Y VIVERES LA PLAZOLETA', '1002575023', NULL, NULL, NULL, 'SUCRE  7-44 y OVIEDO', NULL, 0.00, 0, NULL, 'FRANCISCA ISABEL', 'USHI'),
(175, 'IMSERCOMPU', '1002097671', NULL, NULL, NULL, 'SUCRE  5-67 y OVIEDO', NULL, 0.00, 0, NULL, 'MANUEL ROLANDO', 'CANGAS SALAS '),
(176, 'AUDINOR', '1002391231', NULL, NULL, NULL, 'AV JAIME RIVADEIRA 5-37 y OVIEDO', NULL, 0.00, 0, NULL, 'JOSE MANUEL', 'CALPA MORA'),
(177, 'COMERCIAL GOMEZ', '1002083648', NULL, NULL, NULL, 'RAFAEL SANCHEZ  1-53 y OBISPO MOSQUERA', NULL, 0.00, 0, NULL, 'LEONEL RAMIRO ', 'GOMEZ LANDETA '),
(178, 'MUEBLES', '1001040136', NULL, NULL, NULL, 'MARIANO ACOSTA 10-36 y CHICA NARVAEZ', NULL, 0.00, 0, NULL, 'MARCO POLO', 'MORENO PINTO '),
(179, 'EL RULIMAN', '1004028773', NULL, NULL, NULL, 'JAIME RIVADENEIRA ENTRE y MONCAYO Y OVIEDO', NULL, 0.00, 0, NULL, 'DAYANA GABRIELA', 'BENAVIDES FUEL'),
(180, 'INTERNET', '1003121488', NULL, NULL, NULL, 'MONCAYO 11-15 y CABEZAS BORJA', NULL, 0.00, 0, NULL, 'CHRISTIAN XAVIER', 'HIDALGO ERAZO');

-- --------------------------------------------------------

--
-- Table structure for table `relacion_cliente`
--

CREATE TABLE `relacion_cliente` (
  `rel_cli_id` int(11) NOT NULL,
  `cli_id` int(11) NOT NULL,
  `cli_id_relacionado` int(11) NOT NULL,
  `rel_cli_hora` timestamp NULL DEFAULT NULL,
  `rel_cli_tipo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `relacion_cliente`
--

INSERT INTO `relacion_cliente` (`rel_cli_id`, `cli_id`, `cli_id_relacionado`, `rel_cli_hora`, `rel_cli_tipo`) VALUES
(6, 1, 2, '2014-10-28 06:16:41', 'REFERIDO'),
(7, 2, 1, '2014-10-28 06:40:05', 'REFERIDO'),
(8, 4, 2, '2014-10-28 07:27:58', 'REFERIDO'),
(9, 4, 1, '2014-10-28 07:28:10', 'REFERIDO'),
(10, 5, 6, '2014-10-28 17:16:06', 'REFERIDO'),
(11, 5, 2, '2014-11-01 23:08:49', 'REFERIDO'),
(12, 2, 5, '2014-11-06 15:39:49', 'REFERIDO'),
(13, 1, 5, '2014-11-13 20:09:37', 'REFERIDO'),
(14, 5, 2, '2015-04-23 19:44:27', 'REFERIDO'),
(15, 5, 10, '2015-04-23 19:44:58', 'REFERIDO'),
(16, 10, 20, '2015-11-10 17:30:06', 'REFERIDO');

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(4) NOT NULL,
  `rol_descripcion` varchar(50) NOT NULL,
  `rol_estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`rol_id`, `rol_descripcion`, `rol_estado`) VALUES
(1, 'Super Administrador', 'A'),
(2, 'Administrador', 'A'),
(3, 'Cliente', 'A'),
(4, 'Vigilante', 'A'),
(5, 'Invitado', 'A'),
(6, 'Movil', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `rol_aplicacion`
--

CREATE TABLE `rol_aplicacion` (
  `rol_id` int(4) NOT NULL,
  `apl_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rol_aplicacion`
--

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
(1, 99),
(1, 100),
(2, 100),
(1, 102),
(1, 103),
(1, 104),
(1, 105),
(1, 106),
(1, 107),
(1, 108),
(1, 109),
(6, 110),
(1, 111),
(6, 111),
(1, 112),
(6, 112),
(6, 113),
(1, 114),
(1, 115),
(1, 116),
(1, 117),
(1, 118),
(1, 119),
(1, 120),
(1, 121),
(1, 122),
(1, 123),
(1, 124),
(1, 125),
(1, 126),
(1, 127),
(1, 128),
(1, 129),
(1, 130),
(1, 135);

-- --------------------------------------------------------

--
-- Table structure for table `rol_usuario`
--

CREATE TABLE `rol_usuario` (
  `rol_id` int(4) NOT NULL,
  `usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rol_usuario`
--

INSERT INTO `rol_usuario` (`rol_id`, `usu_id`) VALUES
(1, 1),
(2, 2),
(4, 5),
(1, 21);

-- --------------------------------------------------------

--
-- Table structure for table `sector`
--

CREATE TABLE `sector` (
  `sec_id` int(11) NOT NULL,
  `sec_nombre` varchar(45) NOT NULL,
  `sec_latitud` float(10,6) NOT NULL,
  `sec_longitud` float(10,6) NOT NULL,
  `ciu_id` int(11) NOT NULL,
  `sec_ubicacion` varchar(150) NOT NULL,
  `sec_valor_hora` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sector`
--

INSERT INTO `sector` (`sec_id`, `sec_nombre`, `sec_latitud`, `sec_longitud`, `ciu_id`, `sec_ubicacion`, `sec_valor_hora`) VALUES
(7, 'Parque de la Cometa', 0.345552, -78.117813, 1, 'parque de la cometa', 0.45);

-- --------------------------------------------------------

--
-- Table structure for table `sector_vigilante`
--

CREATE TABLE `sector_vigilante` (
  `sec_vig_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `sec_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sector_vigilante`
--

INSERT INTO `sector_vigilante` (`sec_vig_id`, `usu_id`, `sec_id`) VALUES
(1, 5, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_infraccion`
--

CREATE TABLE `tipo_infraccion` (
  `tip_inf_id` int(4) NOT NULL,
  `cat_inf_id` int(11) NOT NULL,
  `tip_inf_descripcion` varchar(150) NOT NULL,
  `tip_inf_legal` text,
  `tip_inf_valor` float DEFAULT NULL,
  `tip_inf_codigo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo_infraccion`
--

INSERT INTO `tipo_infraccion` (`tip_inf_id`, `cat_inf_id`, `tip_inf_descripcion`, `tip_inf_legal`, `tip_inf_valor`, `tip_inf_codigo`) VALUES
(3, 1, 'Parqueo sin tarjeta', 'La permanencia de un vehiculo en una plaza de estacionamiento dentro de la zona regulada del SISMERT, sin el documento que habilite la ocupacion de la plaza regulada.', 3, 'a'),
(4, 1, 'Tarjeta Alterada', 'La permanencia de un vehiculo en la zona regulada del SISMERT, con el documento habilitante de ocupacion de la via publica  alterado o remarcada que no haya sido emitido por el administrador del sistema.', 3, 'b'),
(5, 1, 'Tarjeta no visible', 'Colocacion de forma incorrecta o poco visible, el documento habilitante de uso del SISMERT.', 3, 'c'),
(6, 1, 'Exceso de tiempo en tarjeta', 'La permanencia de un vehiculo en la zona regulada, luego de haber transcurrido el tiempo acreditado por el documento habilitante de uso del SISMERT.', 3, 'd'),
(7, 1, 'Más de 3 horas en parqueadero', 'La permanencia de un vehiculo comun en la zona regulada, luego de haber transcurrido el tiempo maximo permitido de 3 horas continuas, a pesar de cubrir el tiempo excedido con un documento habilitante de uso del SISMERT. ', 3, 'e'),
(8, 1, 'Estacionamiento en sitios prohibidos', 'Estacionarse en sitios prohibidos establecidos en el Reglamento General a la Ley Organica de Transporte Terrestre, Transito y Seguridad Vial.', 3, 'f'),
(9, 1, 'Tarjeta en blanco o sin marcar', 'Tarjeta en blanco o sin marcar', 3, 'g'),
(10, 1, 'Error en marcacion de hora.', 'Error en marcacion de hora.', 3, 'h'),
(11, 1, 'Retirar o intentar retirar el candado inmovilizador.', 'Retirar o intentar retirar el candado inmovilizador.', 3, 'i'),
(12, 1, 'Desobedecer Normativas Mercado la Playa', 'Por no utilizar correctamente las normas establecidas en el parqueadero del Mercado la Playa.', 3, 'j');

-- --------------------------------------------------------

--
-- Table structure for table `transaccion`
--

CREATE TABLE `transaccion` (
  `tra_id` int(11) NOT NULL,
  `eta_id` int(11) NOT NULL,
  `cli_id` int(11) NOT NULL,
  `tra_valor` decimal(10,2) NOT NULL,
  `tra_saldo` decimal(10,2) NOT NULL,
  `tra_fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaccion`
--

INSERT INTO `transaccion` (`tra_id`, `eta_id`, `cli_id`, `tra_valor`, `tra_saldo`, `tra_fecha`) VALUES
(1, 1, 1, 1.60, 0.00, '2014-10-28 06:47:42'),
(2, 1, 1, 2.40, 0.00, '2014-10-28 06:50:01'),
(3, 1, 1, 4.00, 0.00, '2014-10-28 06:55:03'),
(4, 1, 1, 2.40, 0.00, '2014-10-28 06:55:28'),
(5, 1, 5, 1.60, 0.00, '2014-10-28 12:56:34'),
(6, 1, 6, 0.80, 0.00, '2014-10-28 16:56:04'),
(7, 1, 6, 0.80, 0.00, '2014-10-28 16:56:06'),
(8, 1, 6, 1.60, 0.00, '2014-10-28 16:56:18'),
(9, 1, 6, 1.60, 0.00, '2014-10-28 16:56:20'),
(10, 1, 6, 1.60, 0.00, '2014-10-28 16:56:21'),
(11, 1, 6, 1.60, 0.00, '2014-10-28 16:56:24'),
(12, 1, 6, 1.60, 0.00, '2014-10-28 16:56:25'),
(13, 1, 6, 0.80, 0.00, '2014-10-28 16:56:37'),
(14, 1, 6, 0.80, 0.00, '2014-10-28 16:56:39'),
(15, 1, 6, 0.80, 0.00, '2014-10-28 16:56:43'),
(16, 1, 6, 1.60, 0.00, '2014-10-28 16:56:47'),
(17, 1, 5, 0.80, 0.00, '2014-10-28 17:04:13'),
(18, 1, 5, 1.60, 0.00, '2014-10-28 17:05:34'),
(19, 1, 6, 1.60, 0.00, '2014-10-28 18:16:42'),
(20, 1, 6, 1.60, 0.00, '2014-10-28 18:16:46'),
(21, 1, 2, 2.40, 0.00, '2014-10-29 16:18:11'),
(22, 1, 5, 1.60, 0.00, '2014-10-30 12:19:20'),
(23, 1, 5, 2.40, 0.00, '2014-10-30 14:58:42'),
(24, 1, 2, 0.80, 0.00, '2014-10-31 08:08:07'),
(25, 1, 2, 0.80, 0.00, '2014-10-31 08:08:08'),
(26, 1, 2, 1.60, 0.00, '2014-10-31 08:08:52'),
(27, 1, 2, 2.40, 0.00, '2014-10-31 08:12:21'),
(28, 1, 5, 1.60, 0.00, '2014-11-01 14:55:21'),
(29, 1, 5, 1.60, 0.00, '2014-11-01 14:55:26'),
(30, 1, 5, 1.60, 0.00, '2014-11-01 14:55:30'),
(31, 1, 5, 1.60, 0.00, '2014-11-01 14:55:31'),
(32, 1, 5, 1.60, 0.00, '2014-11-01 14:55:35'),
(33, 1, 5, 1.60, 0.00, '2014-11-01 14:55:38'),
(34, 1, 5, 1.60, 0.00, '2014-11-01 14:55:39'),
(35, 1, 5, 1.60, 0.00, '2014-11-01 14:55:40'),
(36, 1, 5, 1.60, 0.00, '2014-11-01 14:55:41'),
(37, 1, 5, 1.60, 0.00, '2014-11-01 14:55:42'),
(38, 1, 5, 1.60, 0.00, '2014-11-01 14:55:43'),
(39, 1, 5, 1.60, 0.00, '2014-11-01 14:55:44'),
(40, 1, 5, 1.60, 0.00, '2014-11-01 14:55:45'),
(41, 1, 5, 2.40, 0.00, '2014-11-05 16:08:21'),
(42, 1, 1, 1.60, 0.00, '2014-11-11 17:23:22'),
(43, 1, 1, 1.60, 0.00, '2014-11-11 17:23:24'),
(44, 1, 1, 1.60, 0.00, '2014-11-11 17:23:25'),
(45, 1, 1, 1.60, 0.00, '2014-11-11 17:23:45'),
(46, 1, 1, 1.60, 0.00, '2014-11-11 17:23:48'),
(47, 1, 1, 1.60, 0.00, '2014-11-12 14:50:17'),
(48, 1, 1, 1.60, 0.00, '2014-11-12 20:02:30'),
(49, 1, 1, 0.80, 0.00, '2014-11-13 08:13:15'),
(50, 1, 5, 1.60, 0.00, '2014-11-17 16:49:26'),
(51, 1, 1, 1.60, 0.00, '2014-11-18 09:03:52'),
(52, 1, 1, 1.60, 0.00, '2014-11-19 17:28:09'),
(53, 1, 1, 0.80, 0.00, '2014-11-19 17:44:27'),
(54, 1, 5, 0.80, 0.00, '2014-11-19 18:05:50'),
(55, 1, 5, 1.60, 0.00, '2014-11-19 18:08:14'),
(56, 1, 5, 1.60, 0.00, '2014-11-20 12:06:22'),
(57, 1, 1, 0.80, 0.00, '2014-11-20 12:20:24'),
(58, 1, 1, 0.80, 0.00, '2014-11-20 16:04:04'),
(59, 1, 1, 1.60, 0.00, '2014-11-20 16:05:34'),
(60, 1, 5, 3.20, 0.00, '2014-11-20 17:32:34'),
(61, 1, 1, 0.80, 0.00, '2014-11-20 18:11:32'),
(62, 1, 5, 0.80, 0.00, '2014-11-21 09:32:57'),
(63, 1, 5, 2.40, 0.00, '2014-11-21 09:34:00'),
(64, 1, 1, 0.80, 0.00, '2014-11-22 15:18:20'),
(65, 1, 2, 0.80, 0.00, '2014-11-22 15:55:52'),
(66, 1, 5, 0.80, 0.00, '2014-11-28 12:36:29'),
(67, 1, 5, 0.80, 0.00, '2014-11-28 12:36:38'),
(68, 1, 5, 0.80, 0.00, '2014-11-28 12:36:43'),
(69, 1, 5, 0.80, 0.00, '2014-12-02 07:54:49'),
(70, 1, 1, 4.00, 0.00, '2014-12-08 08:34:45'),
(71, 1, 1, 1.60, 0.00, '2014-12-08 16:14:01'),
(72, 1, 5, 1.60, 0.00, '2014-12-12 07:35:28'),
(73, 1, 5, 0.80, 0.00, '2014-12-16 11:40:46'),
(74, 1, 5, 0.80, 0.00, '2014-12-17 05:24:27'),
(75, 1, 1, 1.60, 0.00, '2014-12-17 08:09:30'),
(76, 1, 5, 3.20, 0.00, '2014-12-17 09:04:58'),
(77, 1, 1, 1.60, 0.00, '2014-12-17 14:04:15'),
(78, 1, 1, 1.60, 0.00, '2014-12-18 05:14:15'),
(79, 1, 1, 6.40, 0.00, '2014-12-18 09:07:27'),
(80, 1, 1, 1.60, 0.00, '2014-12-19 14:06:10'),
(81, 1, 1, 1.60, 0.00, '2014-12-19 14:07:39'),
(82, 1, 1, 0.80, 0.00, '2014-12-19 14:10:17'),
(83, 1, 1, 1.60, 0.00, '2014-12-19 14:23:47'),
(84, 1, 1, 1.60, 0.00, '2014-12-19 14:46:57'),
(85, 1, 1, 1.60, 0.00, '2014-12-19 17:31:03'),
(86, 1, 1, 1.60, 0.00, '2014-12-23 15:44:03'),
(87, 1, 1, 2.40, 0.00, '2014-12-23 15:44:59'),
(88, 1, 5, 0.80, 0.00, '2014-12-27 23:01:14'),
(89, 1, 1, 0.80, 0.00, '2015-01-06 08:19:03'),
(90, 1, 1, 1.60, 0.00, '2015-01-08 13:24:01'),
(92, 1, 5, 1.60, 0.00, '2015-01-15 12:14:02'),
(93, 1, 5, 2.40, 0.00, '2015-01-19 16:11:30'),
(94, 1, 1, 2.40, 0.00, '2015-01-19 17:12:44'),
(95, 1, 5, 2.40, 0.00, '2015-01-21 13:39:10'),
(96, 1, 5, 4.80, 0.00, '2015-01-21 13:54:25'),
(97, 1, 5, 3.20, 0.00, '2015-01-22 18:49:01'),
(98, 1, 5, 0.80, 0.00, '2015-01-27 08:17:59'),
(99, 1, 5, 0.80, 0.00, '2015-01-28 08:37:26'),
(100, 1, 5, 2.40, 0.00, '2015-01-29 09:44:45'),
(101, 1, 5, 1.60, 0.00, '2015-01-30 07:49:15'),
(102, 1, 5, 1.60, 0.00, '2015-02-01 13:19:17'),
(103, 1, 5, 2.40, 0.00, '2015-02-04 10:14:32'),
(104, 1, 1, 1.60, 0.00, '2015-02-05 13:25:49'),
(105, 1, 1, 2.40, 0.00, '2015-02-05 13:26:28'),
(106, 1, 1, 1.60, 0.00, '2015-02-06 06:29:37'),
(107, 1, 1, 0.80, 0.00, '2015-02-06 06:30:26'),
(108, 1, 1, 1.60, 0.00, '2015-02-07 08:35:11'),
(109, 1, 5, 0.80, 0.00, '2015-02-07 15:13:22'),
(110, 1, 1, 1.60, 0.00, '2015-02-10 01:26:14'),
(111, 1, 1, 2.40, 0.00, '2015-02-11 10:09:08'),
(112, 1, 1, 0.80, 0.00, '2015-02-11 17:47:16'),
(113, 1, 1, 0.80, 0.00, '2015-02-11 17:59:44'),
(114, 1, 1, 1.60, 0.00, '2015-02-12 06:35:41'),
(115, 1, 1, 2.40, 0.00, '2015-02-12 08:49:46'),
(116, 1, 5, 3.20, 0.00, '2015-02-12 08:51:54'),
(117, 1, 1, 4.00, 0.00, '2015-02-12 09:01:17'),
(118, 1, 5, 1.60, 0.00, '2015-02-12 09:01:32'),
(119, 1, 5, 0.80, 0.00, '2015-02-12 09:47:40'),
(120, 1, 1, 1.60, 0.00, '2015-02-12 19:53:20'),
(121, 1, 1, 1.60, 0.00, '2015-02-12 20:36:15'),
(122, 1, 1, 0.80, 0.00, '2015-02-12 15:45:25'),
(123, 1, 1, 3.20, 0.00, '2015-02-12 17:30:37'),
(124, 1, 1, 2.40, 0.00, '2015-02-12 17:42:28'),
(125, 1, 1, 1.60, 0.00, '2015-02-12 18:27:51'),
(126, 1, 1, 2.40, 0.00, '2015-02-12 18:28:33'),
(127, 1, 1, 1.60, 0.00, '2015-02-12 18:29:54'),
(128, 1, 1, 2.40, 0.00, '2015-02-12 18:30:57'),
(129, 1, 1, 0.40, 0.00, '2015-02-12 19:25:18'),
(130, 1, 1, 0.80, 0.00, '2015-02-12 19:26:06'),
(131, 1, 1, 1.60, 0.00, '2015-02-12 19:27:36'),
(132, 1, 1, 2.00, 0.00, '2015-02-12 19:28:25'),
(133, 1, 1, 0.80, 0.00, '2015-02-12 19:29:44'),
(134, 1, 1, 1.20, 0.00, '2015-02-12 19:31:31'),
(135, 1, 1, 0.40, 0.00, '2015-02-13 07:28:08'),
(136, 1, 5, 0.80, 0.00, '2015-02-13 08:05:17'),
(137, 1, 5, 0.80, 0.00, '2015-02-13 08:31:42'),
(138, 1, 1, 0.40, 0.00, '2015-02-23 06:04:36'),
(139, 1, 5, 1.20, 0.00, '2015-02-23 13:07:43'),
(140, 1, 1, 0.80, 0.00, '2015-02-23 15:05:49'),
(141, 1, 1, 0.40, 0.00, '2015-02-23 15:16:00'),
(142, 1, 1, 0.80, 0.00, '2015-02-24 12:16:45'),
(143, 1, 1, 0.40, 0.00, '2015-02-24 12:32:52'),
(144, 1, 1, 1.20, 0.00, '2015-02-24 12:33:10'),
(145, 1, 1, 1.60, 0.00, '2015-02-24 12:33:46'),
(146, 1, 1, 0.40, 0.00, '2015-02-24 13:55:27'),
(147, 1, 1, 0.40, 0.00, '2015-02-24 14:44:23'),
(148, 1, 1, 0.80, 0.00, '2015-02-24 15:04:15'),
(149, 1, 1, 0.80, 0.00, '2015-02-24 15:04:40'),
(150, 1, 1, 0.40, 0.00, '2015-02-25 09:07:56'),
(151, 1, 5, 0.00, 0.00, '2015-02-25 18:08:18'),
(152, 1, 1, 0.40, 0.00, '2015-02-26 09:30:57'),
(153, 1, 5, 1.20, 0.00, '2015-03-02 13:24:02'),
(154, 1, 1, 0.40, 0.00, '2015-03-02 13:29:02'),
(155, 1, 1, 0.80, 0.00, '2015-03-02 13:29:18'),
(156, 1, 5, 0.40, 0.00, '2015-03-02 16:39:58'),
(157, 1, 5, 0.80, 0.00, '2015-03-02 16:40:28'),
(158, 1, 5, 1.20, 0.00, '2015-03-05 08:59:06'),
(159, 1, 5, 0.40, 0.00, '2015-03-09 11:07:56'),
(160, 1, 5, 0.80, 0.00, '2015-03-09 15:05:58'),
(161, 1, 5, 0.00, 0.00, '2015-03-09 23:52:39'),
(162, 1, 5, 0.40, 0.00, '2015-03-09 23:54:58'),
(163, 1, 5, 0.40, 0.00, '2015-03-11 08:53:37'),
(164, 1, 5, 0.00, 0.00, '2015-03-23 11:12:58'),
(165, 1, 5, 1.20, 0.00, '2015-03-23 11:14:55'),
(166, 1, 5, 0.80, 0.00, '2015-03-31 13:25:29'),
(167, 1, 5, 0.40, 0.00, '2015-04-15 16:52:17'),
(168, 1, 5, 0.80, 0.00, '2015-04-16 23:18:09'),
(169, 1, 5, 0.80, 0.00, '2015-04-17 14:33:35'),
(170, 1, 1, 0.80, 0.00, '2015-04-23 13:51:06'),
(171, 1, 5, 0.00, 0.00, '2015-04-23 14:25:33'),
(172, 1, 5, 0.00, 0.00, '2015-04-23 14:26:00'),
(173, 1, 5, 1.20, 0.00, '2015-04-23 14:28:03'),
(174, 1, 5, 4.80, 0.00, '2015-04-23 14:29:25'),
(175, 1, 5, 4.80, 0.00, '2015-04-23 14:29:52'),
(176, 1, 5, 4.80, 0.00, '2015-04-23 14:30:14'),
(177, 1, 5, 4.80, 0.00, '2015-04-23 14:30:51'),
(178, 1, 5, 0.40, 0.00, '2015-04-23 15:00:05'),
(179, 1, 5, 0.80, 0.00, '2015-05-27 17:59:01'),
(180, 1, 5, 1.60, 0.00, '2015-05-30 16:26:36'),
(181, 1, 5, 0.40, 0.00, '2015-06-22 14:59:11'),
(182, 1, 2, 0.80, 0.00, '2015-07-09 20:26:17'),
(183, 1, 5, 0.40, 0.00, '2015-07-22 17:59:50'),
(184, 1, 5, 1.20, 0.00, '2015-07-27 00:58:06'),
(185, 1, 5, 0.80, 0.00, '2015-08-03 16:05:46'),
(186, 1, 5, 0.80, 0.00, '2015-08-07 18:01:27'),
(187, 1, 5, 0.80, 0.00, '2015-08-10 14:20:27'),
(188, 1, 5, 0.40, 0.00, '2015-08-16 17:11:01'),
(189, 1, 5, 0.00, 0.00, '2015-08-16 17:13:52'),
(190, 1, 5, 0.40, 0.00, '2015-08-16 17:14:58'),
(191, 1, 5, 0.40, 0.00, '2015-08-16 17:20:26'),
(192, 1, 5, 0.40, 0.00, '2015-08-16 17:23:52'),
(193, 1, 5, 0.40, 0.00, '2015-08-16 17:24:15'),
(194, 1, 5, 0.40, 0.00, '2015-08-16 18:08:45'),
(195, 1, 5, 0.40, 0.00, '2015-08-17 21:00:22'),
(196, 1, 5, 0.40, 0.00, '2015-08-17 21:08:12'),
(197, 1, 5, 0.40, 0.00, '2015-08-17 21:11:26'),
(198, 1, 5, 0.40, 0.00, '2015-08-17 21:13:01'),
(199, 1, 5, 0.40, 0.00, '2015-08-17 21:22:15'),
(200, 1, 5, 0.40, 0.00, '2015-08-17 21:24:00'),
(201, 1, 5, 0.40, 0.00, '2015-08-17 21:31:41'),
(202, 1, 5, 0.40, 0.00, '2015-08-17 21:40:02'),
(203, 1, 5, 0.40, 0.00, '2015-08-17 21:42:52'),
(204, 1, 5, 0.40, 0.00, '2015-08-17 21:50:21'),
(205, 1, 5, 0.40, 0.00, '2015-08-17 21:52:29'),
(206, 1, 5, 1.20, 0.00, '2015-08-18 20:40:57'),
(207, 1, 5, 1.20, 0.00, '2015-08-18 21:10:47'),
(208, 1, 5, 0.40, 0.00, '2015-08-19 00:22:57'),
(209, 1, 5, 0.40, 0.00, '2015-08-19 00:24:55'),
(210, 1, 5, 0.40, 0.00, '2015-08-19 00:37:21'),
(211, 1, 5, 0.40, 0.00, '2015-08-19 01:28:25'),
(212, 1, 5, 0.80, 0.00, '2015-08-19 01:33:10'),
(213, 1, 5, 0.80, 0.00, '2015-08-19 19:48:05'),
(214, 1, 5, 1.20, 0.00, '2015-08-19 19:59:44'),
(215, 1, 5, 0.80, 0.00, '2015-08-19 20:13:35'),
(216, 1, 5, 0.40, 0.00, '2015-08-19 20:18:40'),
(217, 1, 5, 0.40, 0.00, '2015-08-19 20:27:31'),
(218, 1, 5, 1.60, 0.00, '2015-08-21 20:41:03'),
(219, 1, 5, 1.60, 0.00, '2015-08-24 19:58:46'),
(220, 1, 5, 0.80, 0.00, '2015-08-24 20:14:09'),
(221, 1, 5, 0.40, 0.00, '2015-08-26 16:03:53'),
(222, 1, 5, 0.80, 0.00, '2015-08-27 15:49:58'),
(223, 1, 5, 0.40, 0.00, '2015-08-27 16:21:22'),
(224, 1, 5, 1.20, 0.00, '2015-08-27 17:31:54'),
(225, 1, 5, 1.20, 0.00, '2015-08-27 20:35:49'),
(226, 1, 5, 0.80, 0.00, '2015-08-27 20:46:45'),
(227, 1, 5, 0.80, 0.00, '2015-08-27 21:11:16'),
(228, 1, 5, 1.20, 0.00, '2015-08-27 21:11:48'),
(229, 1, 5, 1.20, 0.00, '2015-08-27 21:13:00'),
(230, 1, 5, 0.80, 0.00, '2015-08-27 21:13:54'),
(231, 1, 5, 1.20, 0.00, '2015-08-27 21:14:55'),
(232, 1, 5, 0.80, 0.00, '2015-08-27 21:47:21'),
(233, 1, 5, 0.80, 0.00, '2015-08-28 20:57:23'),
(234, 1, 5, 1.20, 0.00, '2015-08-31 20:00:23'),
(235, 1, 5, 1.20, 0.00, '2015-08-31 20:15:06'),
(236, 1, 5, 1.20, 0.00, '2015-08-31 21:50:36'),
(237, 1, 5, 0.80, 0.00, '2015-08-31 21:54:03'),
(238, 1, 5, 0.40, 0.00, '2015-08-31 21:56:15'),
(239, 1, 5, 1.20, 0.00, '2015-08-31 23:50:32'),
(240, 1, 5, 1.20, 0.00, '2015-09-01 00:13:14'),
(241, 1, 5, 0.40, 0.00, '2015-09-01 00:51:32'),
(242, 1, 5, 0.80, 0.00, '2015-09-01 18:00:06'),
(243, 1, 5, 0.80, 0.00, '2015-09-01 22:30:45'),
(244, 1, 5, 0.80, 0.00, '2015-09-01 22:50:16'),
(245, 1, 5, 0.40, 0.00, '2015-09-02 15:30:51'),
(246, 1, 5, 0.40, 0.00, '2015-09-02 15:33:32'),
(247, 1, 5, 0.40, 0.00, '2015-09-02 15:58:49'),
(248, 1, 5, 0.80, 0.00, '2015-09-02 17:27:57'),
(249, 1, 5, 1.60, 0.00, '2015-09-04 18:38:41'),
(250, 1, 5, 1.20, 0.00, '2015-09-12 20:11:03'),
(251, 1, 2, 0.80, 0.00, '2015-09-21 00:11:11'),
(252, 1, 5, 0.80, 0.00, '2015-09-21 00:16:34'),
(253, 1, 5, 1.20, 0.00, '2015-09-21 23:53:28'),
(254, 1, 5, 0.80, 0.00, '2015-09-21 23:56:06'),
(255, 1, 5, 0.80, 0.00, '2015-09-22 00:32:56'),
(256, 1, 5, 0.40, 0.00, '2015-09-25 02:30:29'),
(257, 1, 2, 0.80, 0.00, '2015-10-30 19:06:00'),
(258, 1, 2, 0.80, 0.00, '2015-11-02 14:27:16'),
(259, 1, 2, 0.80, 0.00, '2015-11-03 04:22:27'),
(260, 1, 2, 0.80, 0.00, '2015-11-03 18:46:31'),
(261, 1, 2, 0.80, 0.00, '2015-11-03 22:18:23'),
(262, 1, 19, 0.40, 0.00, '2015-11-06 08:40:33'),
(263, 1, 10, 0.80, 0.00, '2015-11-09 13:52:59'),
(264, 1, 10, 0.45, 0.00, '2015-11-10 02:54:36'),
(265, 1, 10, 0.45, 0.00, '2015-11-09 22:43:05'),
(266, 1, 10, 0.90, 0.00, '2015-11-09 22:44:58'),
(267, 1, 10, 0.45, 0.00, '2015-11-09 22:49:33'),
(268, 1, 10, 0.90, 0.00, '2015-11-10 06:29:54'),
(269, 1, 10, 0.90, 0.00, '2015-11-10 09:50:17'),
(270, 1, 10, 0.90, 0.00, '2015-11-10 12:22:59'),
(271, 1, 10, 0.45, 0.00, '2015-11-10 12:27:53'),
(272, 1, 10, 0.90, 0.00, '2015-11-11 12:42:55'),
(273, 1, 10, 1.35, 0.00, '2015-11-11 13:04:01'),
(274, 1, 10, 0.90, 0.00, '2015-11-11 13:58:28'),
(275, 1, 10, 0.90, 0.00, '2015-11-11 17:33:41');

-- --------------------------------------------------------

--
-- Table structure for table `transferencia_saldo`
--

CREATE TABLE `transferencia_saldo` (
  `tra_sal_id` int(11) NOT NULL,
  `cli_id_de` int(11) NOT NULL,
  `cli_id_para` int(11) NOT NULL,
  `tra_sal_valor` float DEFAULT NULL,
  `tra_sal_hora` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transferencia_saldo`
--

INSERT INTO `transferencia_saldo` (`tra_sal_id`, `cli_id_de`, `cli_id_para`, `tra_sal_valor`, `tra_sal_hora`) VALUES
(1, 5, 6, 10, '2014-10-28 17:16:34'),
(2, 5, 6, 10, '2014-10-30 18:20:16'),
(3, 5, 6, 2, '2014-11-01 20:56:14'),
(4, 2, 5, 10, '2014-11-06 15:40:04'),
(5, 1, 2, 10, '2015-01-19 21:19:04'),
(6, 1, 5, 5, '2015-01-19 21:34:00'),
(7, 5, 2, 10, '2015-02-01 20:23:06');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL,
  `ciu_id` int(11) DEFAULT NULL,
  `usu_usuario` varchar(15) NOT NULL,
  `usu_email` varchar(150) NOT NULL,
  `usu_nombre` varchar(35) NOT NULL,
  `usu_apellido` varchar(35) NOT NULL,
  `usu_clave` char(32) NOT NULL,
  `usu_estado` char(1) NOT NULL,
  `usu_fecha_registro` datetime NOT NULL,
  `usu_codigo_recuperacion` varchar(32) DEFAULT NULL,
  `usu_intentos_ingreso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`usu_id`, `ciu_id`, `usu_usuario`, `usu_email`, `usu_nombre`, `usu_apellido`, `usu_clave`, `usu_estado`, `usu_fecha_registro`, `usu_codigo_recuperacion`, `usu_intentos_ingreso`) VALUES
(1, 1, 'manucv', 'emanuelcarrasco@gmail.com', 'Emanuel', 'Carrasco', '827ccb0eea8a706c4c34a16891f84e7b', 'A', '0000-00-00 00:00:00', '3gjPy10qEt5UGFSvDHlhrKpwJdbC7XMa', NULL),
(2, 1, 'jose', 'jose@email.com', 'Jose', 'Jose', 'afa4557b6446efdc08d438626d80ecb9', 'A', '0000-00-00 00:00:00', NULL, NULL),
(3, 1, 'luis', 'lmponce@gmail.com', 'Luis', 'Ponce', '827ccb0eea8a706c4c34a16891f84e7b', 'A', '2014-10-20 15:46:10', NULL, NULL),
(4, 1, 'Thomas', 'gerencia@ses.ec', 'Thomas', 'Fal.', '4a32fbff0fd7415ffedc13bb055475ec', 'A', '0000-00-00 00:00:00', NULL, NULL),
(5, 1, 'vigilante', 'vigilante@email.com', 'Vigilante1', 'Vigilante', '827ccb0eea8a706c4c34a16891f84e7b', 'A', '0000-00-00 00:00:00', NULL, NULL),
(10, 1, 'fablanco', 'fablanco@gmail.com', 'Felipe', 'Blanco', '827ccb0eea8a706c4c34a16891f84e7b', 'A', '2014-10-28 01:27:16', NULL, NULL),
(11, NULL, 'admin', 'manucv@outlook.com', 'Administrador', 'Administrador', '21232f297a57a5a743894a0e4a801fc3', 'A', '2014-10-28 11:11:44', NULL, NULL),
(12, NULL, 'diego91', 'diegojoseo101@hotmail.com', 'diego ', 'ordonez ', 'b2b5aabe0aa25ec36fe2b39543760795', 'A', '2014-10-28 11:15:24', NULL, NULL),
(16, NULL, 'lmponceb', 'lmponceb@gmail.com', 'aaa', 'bbb', 'ea3fac91ad262d079933529bd71ada9f', 'A', '2015-01-08 15:55:53', 'jyt7X21rfU0nvoHpALDdW4EZq5NCz6Mx', NULL),
(17, NULL, 'lmponce', 'lmponce@hawasolutions.com', 'luis', 'ponce', '827ccb0eea8a706c4c34a16891f84e7b', 'A', '2015-02-03 19:57:31', NULL, NULL),
(18, NULL, 'diego', 'dhpb@hotmail.com', 'diego', 'ponce', '827ccb0eea8a706c4c34a16891f84e7b', 'A', '2015-11-03 22:42:27', NULL, NULL),
(19, NULL, 'miguel', 'sasori_ka@gmail.com', 'miguel', 'ponce', '827ccb0eea8a706c4c34a16891f84e7b', 'A', '2015-11-05 14:15:03', NULL, NULL),
(20, NULL, 'diego11', 'diegojoseo100@hotmail.com', 'diego', 'ponce', '827ccb0eea8a706c4c34a16891f84e7b', 'A', '2015-11-05 14:20:10', NULL, NULL),
(21, 1, 'sismert', 'sismert@ibarra.com', 'Sismert', 'Sismert', 'f95d15c5b5e3b1162a7bc2dede0d550b', 'A', '2015-11-05 18:42:20', NULL, NULL),
(22, NULL, 'dj91', 'diegojoseo101@gmail.com', 'diego', 'Ordonez ', 'b2b5aabe0aa25ec36fe2b39543760795', 'A', '2015-11-06 01:12:06', NULL, NULL),
(26, NULL, 'ejemplo', 'ejemplo@ejemplo.com', 'ejemplo', 'ejemplo', '827ccb0eea8a706c4c34a16891f84e7b', 'A', '2015-11-06 06:54:08', NULL, NULL),
(27, NULL, 'sminda', 'sergiominda102@hotmail.com', 'sergio', 'minda', 'e10adc3949ba59abbe56e057f20f883e', 'A', '2015-11-09 14:10:37', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aplicacion`
--
ALTER TABLE `aplicacion`
  ADD PRIMARY KEY (`apl_id`),
  ADD UNIQUE KEY `apl_descripcion` (`apl_descripcion`);

--
-- Indexes for table `automovil`
--
ALTER TABLE `automovil`
  ADD PRIMARY KEY (`aut_placa`);

--
-- Indexes for table `calle`
--
ALTER TABLE `calle`
  ADD PRIMARY KEY (`cal_id`);

--
-- Indexes for table `carga`
--
ALTER TABLE `carga`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `categoria_infraccion`
--
ALTER TABLE `categoria_infraccion`
  ADD PRIMARY KEY (`cat_inf_id`);

--
-- Indexes for table `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`ciu_id`),
  ADD KEY `fk_ciu_est_id` (`est_id`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cli_id`),
  ADD KEY `fk_cliente_usuario1` (`usu_id`);

--
-- Indexes for table `compra_saldo`
--
ALTER TABLE `compra_saldo`
  ADD PRIMARY KEY (`com_sal_id`),
  ADD KEY `fk_compra_saldo_parqueadero_cliente1_idx` (`cli_id`),
  ADD KEY `fk_compra_saldo_parqueadero_punto_recarga1_idx` (`punto_recarga_pun_rec_id`);

--
-- Indexes for table `establecimiento`
--
ALTER TABLE `establecimiento`
  ADD PRIMARY KEY (`eta_id`),
  ADD KEY `fk_establecimientos_categorias_idx` (`cat_id`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`est_id`),
  ADD KEY `fk_est_pai_id` (`pai_id`);

--
-- Indexes for table `infraccion`
--
ALTER TABLE `infraccion`
  ADD PRIMARY KEY (`inf_id`),
  ADD KEY `fk_infraccion_usuario1_idx` (`usu_id`),
  ADD KEY `fk_infraccion_tipo_infraccion1_idx` (`tip_inf_id`),
  ADD KEY `fk_infraccion_sector1_idx` (`sec_id`);

--
-- Indexes for table `lista_blanca`
--
ALTER TABLE `lista_blanca`
  ADD PRIMARY KEY (`lis_bla_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_logs_clientes1_idx` (`cli_id`);

--
-- Indexes for table `log_parqueadero`
--
ALTER TABLE `log_parqueadero`
  ADD PRIMARY KEY (`log_par_id`),
  ADD KEY `fk_log_parqueadero_par_id` (`par_id`),
  ADD KEY `fk_log_parqueadero_aut_placa` (`aut_placa`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`men_id`),
  ADD KEY `fk_menu_aplicacion1` (`apl_id`);

--
-- Indexes for table `multa_parqueadero`
--
ALTER TABLE `multa_parqueadero`
  ADD PRIMARY KEY (`mul_par_id`),
  ADD KEY `fk_multa_parqueadero_parqueadero1_idx` (`par_id`),
  ADD KEY `fk_multa_parqueadero_infraccion1_idx` (`inf_id`),
  ADD KEY `fk_multa_parqueadero_automovil1` (`aut_placa`);

--
-- Indexes for table `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`pai_id`);

--
-- Indexes for table `parqueadero`
--
ALTER TABLE `parqueadero`
  ADD PRIMARY KEY (`par_id`),
  ADD KEY `fk_parqueadero_sector1_idx` (`sec_id`);

--
-- Indexes for table `publicidad`
--
ALTER TABLE `publicidad`
  ADD PRIMARY KEY (`pub_id`);

--
-- Indexes for table `punto_recarga`
--
ALTER TABLE `punto_recarga`
  ADD PRIMARY KEY (`pun_rec_id`);

--
-- Indexes for table `relacion_cliente`
--
ALTER TABLE `relacion_cliente`
  ADD PRIMARY KEY (`rel_cli_id`),
  ADD KEY `fk_relacion_cliente_cliente1_idx` (`cli_id`),
  ADD KEY `fk_relacion_cliente_cliente2_idx` (`cli_id_relacionado`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indexes for table `rol_aplicacion`
--
ALTER TABLE `rol_aplicacion`
  ADD PRIMARY KEY (`rol_id`,`apl_id`),
  ADD KEY `fk_rol_apl_apl_id` (`apl_id`);

--
-- Indexes for table `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD PRIMARY KEY (`rol_id`,`usu_id`),
  ADD KEY `fk_rol_usu_usu_id` (`usu_id`);

--
-- Indexes for table `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`sec_id`),
  ADD KEY `fk_sector_ciudad_idx` (`ciu_id`);

--
-- Indexes for table `sector_vigilante`
--
ALTER TABLE `sector_vigilante`
  ADD PRIMARY KEY (`sec_vig_id`);

--
-- Indexes for table `tipo_infraccion`
--
ALTER TABLE `tipo_infraccion`
  ADD PRIMARY KEY (`tip_inf_id`);

--
-- Indexes for table `transaccion`
--
ALTER TABLE `transaccion`
  ADD PRIMARY KEY (`tra_id`),
  ADD KEY `fk_transacciones_establecimientos1_idx` (`eta_id`),
  ADD KEY `fk_transacciones_clientes1_idx` (`cli_id`);

--
-- Indexes for table `transferencia_saldo`
--
ALTER TABLE `transferencia_saldo`
  ADD PRIMARY KEY (`tra_sal_id`),
  ADD KEY `fk_transferencia_saldo_cliente1_idx` (`cli_id_de`),
  ADD KEY `fk_transferencia_saldo_cliente2_idx` (`cli_id_para`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_id`),
  ADD UNIQUE KEY `usu_usuario` (`usu_usuario`),
  ADD UNIQUE KEY `usu_email` (`usu_email`),
  ADD KEY `fk_usu_ciu_id` (`ciu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aplicacion`
--
ALTER TABLE `aplicacion`
  MODIFY `apl_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
--
-- AUTO_INCREMENT for table `calle`
--
ALTER TABLE `calle`
  MODIFY `cal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `carga`
--
ALTER TABLE `carga`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categoria_infraccion`
--
ALTER TABLE `categoria_infraccion`
  MODIFY `cat_inf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `ciu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cli_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `compra_saldo`
--
ALTER TABLE `compra_saldo`
  MODIFY `com_sal_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `establecimiento`
--
ALTER TABLE `establecimiento`
  MODIFY `eta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `est_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `infraccion`
--
ALTER TABLE `infraccion`
  MODIFY `inf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `lista_blanca`
--
ALTER TABLE `lista_blanca`
  MODIFY `lis_bla_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log_parqueadero`
--
ALTER TABLE `log_parqueadero`
  MODIFY `log_par_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `men_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `multa_parqueadero`
--
ALTER TABLE `multa_parqueadero`
  MODIFY `mul_par_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `pai_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `publicidad`
--
ALTER TABLE `publicidad`
  MODIFY `pub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `punto_recarga`
--
ALTER TABLE `punto_recarga`
  MODIFY `pun_rec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;
--
-- AUTO_INCREMENT for table `relacion_cliente`
--
ALTER TABLE `relacion_cliente`
  MODIFY `rel_cli_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `sector`
--
ALTER TABLE `sector`
  MODIFY `sec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sector_vigilante`
--
ALTER TABLE `sector_vigilante`
  MODIFY `sec_vig_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tipo_infraccion`
--
ALTER TABLE `tipo_infraccion`
  MODIFY `tip_inf_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `transaccion`
--
ALTER TABLE `transaccion`
  MODIFY `tra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;
--
-- AUTO_INCREMENT for table `transferencia_saldo`
--
ALTER TABLE `transferencia_saldo`
  MODIFY `tra_sal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `fk_ciu_est_id` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`);

--
-- Constraints for table `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_cliente_usuario1` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`);

--
-- Constraints for table `compra_saldo`
--
ALTER TABLE `compra_saldo`
  ADD CONSTRAINT `fk_compra_saldo_parqueadero_cliente1` FOREIGN KEY (`cli_id`) REFERENCES `cliente` (`cli_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compra_saldo_parqueadero_punto_recarga1` FOREIGN KEY (`punto_recarga_pun_rec_id`) REFERENCES `punto_recarga` (`pun_rec_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `establecimiento`
--
ALTER TABLE `establecimiento`
  ADD CONSTRAINT `fk_establecimientos_categorias` FOREIGN KEY (`cat_id`) REFERENCES `categoria` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `estado`
--
ALTER TABLE `estado`
  ADD CONSTRAINT `fk_est_pai_id` FOREIGN KEY (`pai_id`) REFERENCES `pais` (`pai_id`);

--
-- Constraints for table `infraccion`
--
ALTER TABLE `infraccion`
  ADD CONSTRAINT `fk_infraccion_sector1` FOREIGN KEY (`sec_id`) REFERENCES `sector` (`sec_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_infraccion_tipo_infraccion1` FOREIGN KEY (`tip_inf_id`) REFERENCES `tipo_infraccion` (`tip_inf_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_infraccion_usuario1` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `fk_logs_clientes1` FOREIGN KEY (`cli_id`) REFERENCES `cliente` (`cli_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `log_parqueadero`
--
ALTER TABLE `log_parqueadero`
  ADD CONSTRAINT `fk_log_parqueadero_aut_placa` FOREIGN KEY (`aut_placa`) REFERENCES `automovil` (`aut_placa`),
  ADD CONSTRAINT `fk_log_parqueadero_par_id` FOREIGN KEY (`par_id`) REFERENCES `parqueadero` (`par_id`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_menu_aplicacion1` FOREIGN KEY (`apl_id`) REFERENCES `aplicacion` (`apl_id`);

--
-- Constraints for table `multa_parqueadero`
--
ALTER TABLE `multa_parqueadero`
  ADD CONSTRAINT `fk_multa_parqueadero_automovil1` FOREIGN KEY (`aut_placa`) REFERENCES `automovil` (`aut_placa`),
  ADD CONSTRAINT `fk_multa_parqueadero_infraccion1` FOREIGN KEY (`inf_id`) REFERENCES `infraccion` (`inf_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_multa_parqueadero_parqueadero1` FOREIGN KEY (`par_id`) REFERENCES `parqueadero` (`par_id`);

--
-- Constraints for table `parqueadero`
--
ALTER TABLE `parqueadero`
  ADD CONSTRAINT `fk_parqueadero_sector1` FOREIGN KEY (`sec_id`) REFERENCES `sector` (`sec_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `relacion_cliente`
--
ALTER TABLE `relacion_cliente`
  ADD CONSTRAINT `fk_relacion_cliente_cliente1` FOREIGN KEY (`cli_id`) REFERENCES `cliente` (`cli_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_relacion_cliente_cliente2` FOREIGN KEY (`cli_id_relacionado`) REFERENCES `cliente` (`cli_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rol_aplicacion`
--
ALTER TABLE `rol_aplicacion`
  ADD CONSTRAINT `fk_rol_apl_apl_id` FOREIGN KEY (`apl_id`) REFERENCES `aplicacion` (`apl_id`),
  ADD CONSTRAINT `fk_rol_apl_rol_id` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`);

--
-- Constraints for table `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD CONSTRAINT `fk_rol_usu_rol_id` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`),
  ADD CONSTRAINT `fk_rol_usu_usu_id` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`);

--
-- Constraints for table `sector`
--
ALTER TABLE `sector`
  ADD CONSTRAINT `fk_sector_ciudad` FOREIGN KEY (`ciu_id`) REFERENCES `ciudad` (`ciu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transaccion`
--
ALTER TABLE `transaccion`
  ADD CONSTRAINT `fk_transacciones_clientes1` FOREIGN KEY (`cli_id`) REFERENCES `cliente` (`cli_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transaccion_establecimiento1` FOREIGN KEY (`eta_id`) REFERENCES `establecimiento` (`eta_id`);

--
-- Constraints for table `transferencia_saldo`
--
ALTER TABLE `transferencia_saldo`
  ADD CONSTRAINT `fk_transferencia_saldo_cliente1` FOREIGN KEY (`cli_id_de`) REFERENCES `cliente` (`cli_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transferencia_saldo_cliente2` FOREIGN KEY (`cli_id_para`) REFERENCES `cliente` (`cli_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usu_ciu_id` FOREIGN KEY (`ciu_id`) REFERENCES `ciudad` (`ciu_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
