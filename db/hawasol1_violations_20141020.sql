-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 20, 2014 at 06:30 PM
-- Server version: 5.6.12
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hawasol1_violations`
--
CREATE DATABASE IF NOT EXISTS `hawasol1_violations` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hawasol1_violations`;

-- --------------------------------------------------------

--
-- Table structure for table `aplicacion`
--

CREATE TABLE IF NOT EXISTS `aplicacion` (
  `apl_id` int(4) NOT NULL AUTO_INCREMENT,
  `apl_descripcion` varchar(70) NOT NULL,
  `apl_nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`apl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `aplicacion`
--

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
(22, 'parqueaderos:parqueaderos', 'Parqueadero'),
(23, 'parqueaderos:sector', 'Parqueaderos Sector'),
(24, 'api:api', 'api');

-- --------------------------------------------------------

--
-- Table structure for table `automovil`
--

CREATE TABLE IF NOT EXISTS `automovil` (
  `aut_placa` varchar(10) NOT NULL,
  PRIMARY KEY (`aut_placa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `automovil`
--

INSERT INTO `automovil` (`aut_placa`) VALUES
(''),
('111111'),
('123erd'),
('123erf'),
('33455'),
('456qwe'),
('65\n'),
('AAA111'),
('abaja'),
('abc111'),
('abc123'),
('ars123'),
('asd'),
('Asd123'),
('Asd1234'),
('asdf\n'),
('Asf1234'),
('bbb111'),
('BBB232'),
('ccc111'),
('CCC554'),
('chin111'),
('chin113'),
('ddd111'),
('dfgh'),
('dfghj'),
('dfgj'),
('dfhj'),
('eee111'),
('EJM001'),
('Ejm123'),
('erd456'),
('ertyy'),
('hjkg'),
('PAJ514'),
('pbd8898'),
('pbh1234'),
('PCL111'),
('PHS201'),
('PHU551'),
('pig110'),
('pig1100'),
('pig111'),
('pig171'),
('PIM275'),
('PJD068'),
('PLL641'),
('PNC344'),
('POE685'),
('pol110'),
('pol1101'),
('pol121'),
('PPP212'),
('PRM364'),
('PTC247'),
('PTH641'),
('PUR261'),
('PWD622'),
('PXK641'),
('PYA309'),
('PYW111'),
('PZD121'),
('PZK156'),
('PZP804'),
('qwe123'),
('qwerty'),
('red111'),
('red233'),
('rrr555'),
('ryyyv'),
('sdfg'),
('sdfgh'),
('sdfh'),
('TES001'),
('TES002'),
('TES003'),
('TES004'),
('tes456'),
('test001'),
('TEST666'),
('tggh'),
('tre123'),
('trf123'),
('ttt777'),
('XXX123'),
('xxx666'),
('yyy544');

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_nombre` varchar(45) DEFAULT NULL,
  `cat_descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`cat_id`, `cat_nombre`, `cat_descripcion`) VALUES
(1, 'Servicios', 'Parqueaderos, Gasolineras, etc'),
(2, 'Restaurantes', 'Pizzerias, Heladerias, Cafeterias, etc'),
(3, 'Entretenimiento', 'Discotecas, Bares, etc');

-- --------------------------------------------------------

--
-- Table structure for table `ciudad`
--

CREATE TABLE IF NOT EXISTS `ciudad` (
  `ciu_id` int(11) NOT NULL AUTO_INCREMENT,
  `est_id` int(4) DEFAULT NULL,
  `ciu_nombre_es` varchar(150) NOT NULL,
  `ciu_nombre_en` varchar(150) NOT NULL,
  `ciu_codigo_telefono` varchar(5) NOT NULL,
  PRIMARY KEY (`ciu_id`),
  KEY `fk_ciu_est_id` (`est_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ciudad`
--

INSERT INTO `ciudad` (`ciu_id`, `est_id`, `ciu_nombre_es`, `ciu_nombre_en`, `ciu_codigo_telefono`) VALUES
(1, 1, 'Quito', 'Quito', '02'),
(2, 2, 'Santiago', 'Santiago', '02'),
(3, 4, 'Guayaquil', 'Guayaquil', '07');

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `cli_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_id` int(11) NOT NULL,
  `cli_nombre` varchar(45) DEFAULT NULL,
  `cli_apellido` varchar(45) DEFAULT NULL,
  `cli_email` varchar(45) DEFAULT NULL,
  `cli_saldo` varchar(45) DEFAULT NULL,
  `cli_estado` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`cli_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`cli_id`, `usu_id`, `cli_nombre`, `cli_apellido`, `cli_email`, `cli_saldo`, `cli_estado`) VALUES
(1, 0, 'admin', NULL, 'admin@admin.com', '749.42', 'ACTIVO'),
(2, 0, 'Luis Miguel', NULL, 'lmponceb@gmail.com', '227.38', 'ACTIVO'),
(3, 0, 'Emanuel Carrasco', NULL, 'ercarrasco@hawasolutions.com', '-940', 'ACTIVO'),
(16, 0, 'jose miguel', 'vaca riofrio', 'josemvacar@gmail.com', '0', 'ACTIVO');

-- --------------------------------------------------------

--
-- Table structure for table `componente`
--

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
  KEY `fk_com_tip_com_id` (`tip_com_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `componente`
--

INSERT INTO `componente` (`com_id`, `sit_id`, `tip_com_id`, `com_descripcion`, `com_ip_local`, `com_ip_publica`, `com_usuario`, `com_clave`, `com_puerto`, `com_mascara`, `com_gateway`, `com_dns1`, `com_dns2`, `com_estado`, `com_ultima_respuesta`, `com_ultimo_valor`) VALUES
(1, 1, 1, 'Router TP Link - Blanco', 'www.google.com', '181.211.12.234', 'admin', 'SES2014', NULL, NULL, NULL, NULL, NULL, 'A', '2014-08-01 21:10:03', '618'),
(2, 1, 1, 'Outstation', 'www.apple.com', '181.211.11.233', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', '2014-08-01 21:10:08', '19');

-- --------------------------------------------------------

--
-- Table structure for table `compra_saldo`
--

CREATE TABLE IF NOT EXISTS `compra_saldo` (
  `com_sal_id` int(11) NOT NULL AUTO_INCREMENT,
  `cli_id` int(11) NOT NULL,
  `pun_rec_id` int(11) NOT NULL,
  `com_sal_valor` float DEFAULT NULL,
  `com_sal_hora` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`com_sal_id`),
  KEY `fk_compra_saldo_parqueadero_cliente1_idx` (`cli_id`),
  KEY `fk_compra_saldo_parqueadero_punto_recarga1_idx` (`pun_rec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dispositivo`
--

CREATE TABLE IF NOT EXISTS `dispositivo` (
  `dis_id` int(5) NOT NULL AUTO_INCREMENT,
  `veh_id` int(6) DEFAULT NULL,
  `dis_descripcion` varchar(150) NOT NULL,
  `dis_link` text,
  `dis_usuario` varchar(50) DEFAULT NULL,
  `dis_clave` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`dis_id`),
  KEY `fk_dis_veh_id` (`veh_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `dispositivo`
--

INSERT INTO `dispositivo` (`dis_id`, `veh_id`, `dis_descripcion`, `dis_link`, `dis_usuario`, `dis_clave`) VALUES
(1, 1, 'CAMARA VAN 1', 'https://netcam.belkin.com/login.html', 'SES', '1234567');

-- --------------------------------------------------------

--
-- Table structure for table `establecimiento`
--

CREATE TABLE IF NOT EXISTS `establecimiento` (
  `est_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `est_nombre` varchar(45) DEFAULT NULL,
  `est_descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`est_id`),
  KEY `fk_establecimientos_categorias_idx` (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `establecimiento`
--

INSERT INTO `establecimiento` (`est_id`, `cat_id`, `est_nombre`, `est_descripcion`) VALUES
(1, 1, 'Parqueaderos', 'Lugares de parqueo auspiciados por el municip'),
(2, 1, 'Gasolineras PetroEcuador', 'Utiliza tu saldo en la red de gasolineras'),
(3, 2, 'Subway', 'Deliciosos Sanduches'),
(4, 2, 'KFC', 'Buenisimo'),
(5, 3, 'Blues', 'Diversion garantizada'),
(6, 3, 'PlayZone', 'Diversion para los más chicos');

-- --------------------------------------------------------

--
-- Table structure for table `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `est_id` int(4) NOT NULL AUTO_INCREMENT,
  `pai_id` int(4) DEFAULT NULL,
  `est_nombre_es` varchar(150) NOT NULL,
  `est_nombre_en` varchar(150) NOT NULL,
  PRIMARY KEY (`est_id`),
  KEY `fk_est_pai_id` (`pai_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `estado`
--

INSERT INTO `estado` (`est_id`, `pai_id`, `est_nombre_es`, `est_nombre_en`) VALUES
(1, 63, 'PICHINCHA', 'PICHINCHA'),
(2, 64, 'Region Metropolitana', 'Region Metropolitana'),
(3, 66, 'Buenos aires', 'Buenos aires'),
(4, 63, 'GUAYAS', 'GUAYAS');

-- --------------------------------------------------------

--
-- Table structure for table `infraccion`
--

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
  KEY `fk_infraccion_sector1_idx` (`sec_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `infraccion`
--

INSERT INTO `infraccion` (`inf_id`, `inf_fecha`, `inf_detalles`, `usu_id`, `tip_inf_id`, `sec_id`) VALUES
(2, '2014-08-16 16:22:46', 'Ejemplo', 1, 1, 5),
(3, '2014-08-16 16:45:45', 'Esto es una infracción', 1, 1, 5),
(4, '2014-08-16 16:47:43', 'Esto es una infracción', 1, 1, 5),
(5, '2014-08-16 16:48:27', 'Esto es una infracción', 1, 1, 5),
(6, '2014-08-16 16:48:40', 'Esto es una infracción', 1, 1, 5),
(7, '2014-08-16 16:48:57', 'Esto es una infracción', 1, 1, 5),
(8, '2014-08-16 16:49:24', 'Esto es una infracción', 1, 1, 5),
(9, '2014-08-16 16:58:00', 'Esto es una infracción', 1, 1, 5),
(10, '2014-08-16 17:32:56', 'veamosf', 1, 1, 5),
(11, '2014-08-16 17:33:27', 'veamosf', 1, 1, 5),
(12, '2014-08-16 17:43:34', 'veamosf', 1, 1, 5),
(13, '2014-08-16 17:44:59', 'esta parqueado', 1, 1, 5),
(14, '2014-08-16 17:56:10', 'esta parqueado', 1, 1, 5),
(15, '2014-08-16 18:14:43', 'Ejemplo', 1, 1, 5),
(16, '2014-08-16 18:15:28', 'nada', 1, 1, 5),
(17, '2014-08-16 18:18:26', 'ninguna observacion', 1, 1, 5),
(18, '2014-08-16 18:36:08', 'asd', 1, 1, 5),
(19, '2014-08-16 18:39:43', 'ejemplo', 1, 1, 5),
(20, '2014-08-16 18:40:14', 'aqui deberia funcionar', 1, 1, 5),
(21, '2014-08-18 10:11:21', 'Ninguna', 1, 1, 5),
(22, '2014-08-18 10:12:37', 'Este es mi puesto', 1, 1, 5),
(23, '2014-08-18 10:18:31', 'nada q acotar', 1, 1, 5),
(24, '2014-08-18 13:30:00', 'ninguna', 1, 1, 5),
(25, '2014-08-18 17:05:16', 'No se encuentra registrado como parqueado', 1, 1, 5),
(26, '2014-08-18 18:32:30', 'Excedio el número de horas registradas', 1, 1, 5),
(27, '2014-08-19 14:24:55', 'No se encuentra registrado como parqueado', 1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_hora` datetime DEFAULT NULL,
  `log_descripcion` varchar(45) DEFAULT NULL,
  `log_info` text,
  `cli_id` int(11) NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `fk_logs_clientes1_idx` (`cli_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `log_parqueadero`
--

CREATE TABLE IF NOT EXISTS `log_parqueadero` (
  `log_par_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_par_fecha_ingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `log_par_fecha_salida` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `log_par_horas_parqueo` int(11) NOT NULL,
  `log_par_estado` char(1) NOT NULL,
  `par_id` varchar(10) NOT NULL,
  `aut_placa` varchar(10) NOT NULL,
  `tra_id` int(11) NOT NULL,
  PRIMARY KEY (`log_par_id`),
  KEY `fk_log_parqueadero_par_id` (`par_id`),
  KEY `fk_log_parqueadero_aut_placa` (`aut_placa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `log_parqueadero`
--

INSERT INTO `log_parqueadero` (`log_par_id`, `log_par_fecha_ingreso`, `log_par_fecha_salida`, `log_par_horas_parqueo`, `log_par_estado`, `par_id`, `aut_placa`, `tra_id`) VALUES
(1, '2014-09-16 08:03:07', '0000-00-00 00:00:00', 2, 'O', 'Q007', 'tre123', 1),
(2, '2014-09-16 08:13:38', '0000-00-00 00:00:00', 2, 'O', 'Q008', 'red111', 2),
(3, '2014-09-17 03:48:30', '0000-00-00 00:00:00', 1, 'O', 'Q003', 'abc123', 3),
(4, '2014-09-17 04:55:11', '0000-00-00 00:00:00', 2, 'O', 'Q003', '111111', 4),
(5, '2014-09-17 17:46:33', '0000-00-00 00:00:00', 1, 'O', 'Q003', 'abaja', 5),
(6, '2014-09-19 06:28:29', '0000-00-00 00:00:00', 1, 'O', 'Q007', 'chin111', 6),
(7, '2014-09-19 06:29:16', '0000-00-00 00:00:00', 1, 'O', 'Q008', 'chin113', 7),
(8, '2014-09-19 14:14:48', '0000-00-00 00:00:00', 1, 'O', 'Q003', 'dfgj', 8),
(9, '2014-09-19 14:27:33', '0000-00-00 00:00:00', 5, 'O', 'A001', 'ertyy', 9),
(10, '2014-09-19 19:37:06', '0000-00-00 00:00:00', 1, 'O', 'A001', '', 10),
(11, '2014-09-19 19:37:07', '0000-00-00 00:00:00', 1, 'O', 'A001', '', 11),
(12, '2014-09-19 22:01:30', '0000-00-00 00:00:00', 3, 'O', 'A001', '', 12),
(13, '2014-09-19 22:01:31', '0000-00-00 00:00:00', 3, 'O', 'A001', '', 13),
(14, '2014-09-19 23:38:56', '0000-00-00 00:00:00', 1, 'O', 'Q003', 'Asf1234', 14),
(15, '2014-09-20 13:24:47', '0000-00-00 00:00:00', 1, 'O', 'Q005', 'abc123', 15),
(16, '2014-09-21 14:54:42', '0000-00-00 00:00:00', 2, 'O', 'Q003', 'abc123', 16),
(17, '2014-09-21 15:45:51', '0000-00-00 00:00:00', 1, 'O', 'Q004', '', 17),
(18, '2014-09-21 15:46:11', '0000-00-00 00:00:00', 2, 'O', 'Q009', 'Pol110', 18),
(19, '2014-09-21 15:53:08', '0000-00-00 00:00:00', 1, 'O', 'Q005', 'red233', 19),
(20, '2014-09-21 16:05:08', '0000-00-00 00:00:00', 3, 'O', 'Q006', 'Abc123', 20),
(21, '2014-09-21 18:50:36', '0000-00-00 00:00:00', 2, 'O', 'Q009', 'abc123', 21),
(22, '2014-09-21 19:08:50', '0000-00-00 00:00:00', 2, 'O', 'Q009', 'abc123', 22),
(23, '2014-09-21 21:53:01', '0000-00-00 00:00:00', 1, 'O', 'Q003', 'abc111', 23),
(24, '2014-09-22 00:20:44', '0000-00-00 00:00:00', 3, 'O', 'Q003', 'aaa111', 24),
(25, '2014-09-22 00:31:43', '0000-00-00 00:00:00', 1, 'O', 'Q009', 'bbb111', 25),
(26, '2014-09-22 00:57:21', '0000-00-00 00:00:00', 4, 'O', 'Q004', 'ccc111', 26),
(27, '2014-09-22 00:59:45', '0000-00-00 00:00:00', 1, 'O', 'Q005', 'ddd111', 27),
(28, '2014-09-22 01:12:06', '0000-00-00 00:00:00', 1, 'O', 'Q006', 'eee111', 28),
(29, '2014-09-22 01:26:33', '0000-00-00 00:00:00', 1, 'O', 'Q007', 'test001', 29),
(30, '2014-09-22 01:28:59', '0000-00-00 00:00:00', 1, 'O', 'Q008', 'yyy544', 30),
(31, '2014-09-22 01:40:42', '0000-00-00 00:00:00', 1, 'O', 'Q009', 'rrr555', 31),
(32, '2014-09-22 02:39:18', '0000-00-00 00:00:00', 2, 'O', 'Q010', 'Ejm123', 32),
(33, '2014-09-22 02:42:08', '0000-00-00 00:00:00', 2, 'O', 'Q005', 'qwerty', 33),
(34, '2014-09-22 02:58:48', '0000-00-00 00:00:00', 1, 'O', 'Q006', '123erf', 34),
(35, '2014-09-22 03:10:01', '0000-00-00 00:00:00', 1, 'O', 'Q007', 'erd456', 35),
(36, '2014-09-22 03:30:26', '0000-00-00 00:00:00', 1, 'O', 'Q003', 'qwe123', 36),
(37, '2014-09-22 04:17:18', '0000-00-00 00:00:00', 4, 'O', 'Q006', 'Asd123', 37),
(38, '2014-09-22 04:20:39', '0000-00-00 00:00:00', 1, 'O', 'Q007', 'abc123', 38),
(39, '2014-09-22 04:43:07', '0000-00-00 00:00:00', 1, 'O', 'Q003', '123erd', 39),
(40, '2014-09-22 04:45:06', '0000-00-00 00:00:00', 1, 'O', 'Q005', 'ttt777', 40),
(41, '2014-09-22 04:49:45', '0000-00-00 00:00:00', 1, 'O', 'Q008', 'tes456', 41),
(42, '2014-09-22 13:10:37', '0000-00-00 00:00:00', 1, 'O', 'Q007', 'Asd1234', 42),
(43, '2014-09-22 13:41:05', '0000-00-00 00:00:00', 1, 'O', 'A001', 'asdf\n', 43),
(44, '2014-09-22 13:59:03', '0000-00-00 00:00:00', 3, 'O', 'Q003', 'hjkg', 44),
(45, '2014-09-22 14:17:23', '0000-00-00 00:00:00', 1, 'O', 'C001', 'pbd8898', 45),
(46, '2014-09-22 14:18:05', '0000-00-00 00:00:00', 1, 'O', 'Q013', 'pbd8898', 46),
(47, '2014-09-22 14:18:06', '0000-00-00 00:00:00', 4, 'O', 'Q025', 'Asd1234', 47),
(48, '2014-09-22 16:03:55', '0000-00-00 00:00:00', 1, 'O', 'A001', 'dfhj', 48),
(49, '2014-09-22 16:03:57', '0000-00-00 00:00:00', 1, 'O', 'A001', 'dfhj', 49),
(50, '2014-09-22 22:46:54', '0000-00-00 00:00:00', 1, 'O', 'A001', 'dfgh', 50),
(51, '2014-09-24 03:56:03', '0000-00-00 00:00:00', 1, 'O', 'Q003', 'abc123', 51),
(52, '2014-09-24 16:22:52', '0000-00-00 00:00:00', 1, 'O', 'A001', 'sdfgh', 52),
(53, '2014-09-24 17:08:37', '0000-00-00 00:00:00', 1, 'O', 'Q003', 'dfghj', 53),
(54, '2014-09-24 17:45:23', '0000-00-00 00:00:00', 1, 'O', 'Q004', 'sdfg', 54),
(55, '2014-09-24 17:48:14', '0000-00-00 00:00:00', 1, 'O', 'Q005', 'tggh', 55),
(56, '2014-09-24 22:21:10', '0000-00-00 00:00:00', 1, 'O', 'Q003', 'abc123', 56),
(57, '2014-09-24 22:39:46', '0000-00-00 00:00:00', 2, 'O', 'Q004', 'abc123', 57),
(58, '2014-09-25 17:11:26', '0000-00-00 00:00:00', 1, 'O', 'A001', 'dfgh', 58),
(59, '2014-09-26 11:39:17', '0000-00-00 00:00:00', 1, 'O', 'Q003', 'abc123', 59),
(60, '2014-09-30 15:38:48', '0000-00-00 00:00:00', 1, 'O', 'A001', '33455', 60),
(61, '2014-09-30 15:38:49', '0000-00-00 00:00:00', 1, 'O', 'A001', '33455', 61),
(62, '2014-10-03 02:12:53', '0000-00-00 00:00:00', 2, 'O', 'Q003', 'pol110', 62),
(63, '2014-10-03 20:03:44', '0000-00-00 00:00:00', 1, 'O', 'A001', 'sdfh', 63),
(64, '2014-10-05 23:36:55', '0000-00-00 00:00:00', 1, 'O', 'Q008', 'abc123', 64),
(65, '2014-10-05 23:49:14', '0000-00-00 00:00:00', 2, 'O', 'Q004', 'Asd123', 65),
(66, '2014-10-06 21:25:11', '0000-00-00 00:00:00', 1, 'O', 'A001', '65\n', 66),
(67, '2014-10-08 15:34:53', '0000-00-00 00:00:00', 1, 'O', 'A001', 'dfgh', 67),
(68, '2014-10-08 15:34:53', '0000-00-00 00:00:00', 1, 'O', 'A001', 'dfgh', 68),
(69, '2014-10-08 19:00:44', '0000-00-00 00:00:00', 2, 'O', 'Q008', 'POL110', 0),
(70, '2014-10-08 21:19:07', '0000-00-00 00:00:00', 2, 'O', 'Q005', 'POL110', 0),
(73, '2014-10-13 19:54:23', '0000-00-00 00:00:00', 2, 'O', 'A001', '', 69),
(75, '2014-10-14 22:22:30', '0000-00-00 00:00:00', 2, 'O', 'Q003', 'Asd123', 70);

--
-- Triggers `log_parqueadero`
--
DROP TRIGGER IF EXISTS `violations_automovil`;
DELIMITER //
CREATE TRIGGER `violations_automovil` BEFORE INSERT ON `log_parqueadero`
 FOR EACH ROW INSERT IGNORE INTO `automovil` (
    `aut_placa`
)
VALUES (
NEW.aut_placa
)
//
DELIMITER ;
DROP TRIGGER IF EXISTS `violations_ocupado`;
DELIMITER //
CREATE TRIGGER `violations_ocupado` AFTER INSERT ON `log_parqueadero`
 FOR EACH ROW UPDATE parqueadero SET par_estado=NEW.log_par_estado WHERE par_id=NEW.par_id
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `multa_parqueadero`
--

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
  KEY `fk_multa_parqueadero_automovil1` (`aut_placa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `multa_parqueadero`
--

INSERT INTO `multa_parqueadero` (`mul_par_id`, `par_id`, `aut_placa`, `inf_id`, `mul_par_estado`, `mul_par_valor`) VALUES
(1, 'Q028', 'pol110', 10, 'P', 30),
(2, 'Q028', 'pol110', 11, 'P', 30.1),
(3, 'Q028', 'pol110', 12, 'P', 30.1),
(5, 'Q026', 'pig111', 14, 'P', 30.1),
(6, 'Q007', 'TES001', 15, 'P', 30.1),
(7, 'Q029', 'TES002', 16, 'P', 30.1),
(8, 'Q020', 'TES003', 17, 'P', 30.1),
(9, 'Q009', 'asd', 18, 'P', 30.1),
(10, 'Q023', 'TES004', 19, 'P', 30.1),
(11, 'Q022', 'TES004', 20, 'P', 30.1),
(12, 'Q027', 'XXX123', 21, 'P', 30.1),
(13, 'Q011', 'POL110', 22, 'P', 30.1),
(14, 'Q011', 'EJM001', 23, 'P', 30.1),
(15, 'Q012', 'pol110', 24, 'S', 30.1),
(16, 'Q011', 'abc123', 25, 'S', 30.1),
(17, 'Q014', 'TEST666', 26, 'S', 30.1),
(18, 'Q024', 'pig171', 27, 'S', 30.1);

--
-- Triggers `multa_parqueadero`
--
DROP TRIGGER IF EXISTS `violations_automovil_multa`;
DELIMITER //
CREATE TRIGGER `violations_automovil_multa` BEFORE INSERT ON `multa_parqueadero`
 FOR EACH ROW INSERT IGNORE INTO `automovil` (
    `aut_placa`
)
VALUES (
NEW.aut_placa
)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `pai_id` int(4) NOT NULL AUTO_INCREMENT,
  `pai_nombre_es` varchar(120) NOT NULL,
  `pai_nombre_en` varchar(120) NOT NULL,
  `pai_codigo_telefono` varchar(5) NOT NULL,
  PRIMARY KEY (`pai_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `pais`
--

INSERT INTO `pais` (`pai_id`, `pai_nombre_es`, `pai_nombre_en`, `pai_codigo_telefono`) VALUES
(63, 'ECUADOR', 'ECUADOR', '593'),
(64, 'Chile', 'Chile', '56'),
(65, 'CHINA', 'CHINA', 'CHINA'),
(66, 'Argentina ', 'Argentina ', 'Argen');

-- --------------------------------------------------------

--
-- Table structure for table `parqueadero`
--

CREATE TABLE IF NOT EXISTS `parqueadero` (
  `par_id` varchar(10) NOT NULL,
  `par_estado` char(1) NOT NULL,
  `sec_id` int(11) NOT NULL,
  PRIMARY KEY (`par_id`),
  KEY `fk_parqueadero_sector1_idx` (`sec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parqueadero`
--

INSERT INTO `parqueadero` (`par_id`, `par_estado`, `sec_id`) VALUES
('A001', 'O', 1),
('C001', 'O', 7),
('Q003', 'O', 5),
('Q004', 'O', 5),
('Q005', 'O', 5),
('Q006', 'O', 5),
('Q007', 'O', 5),
('Q008', 'O', 5),
('Q009', 'O', 5),
('Q010', 'O', 5),
('Q011', 'O', 5),
('Q012', 'O', 5),
('Q013', 'O', 5),
('Q014', 'D', 5),
('Q015', 'D', 5),
('Q016', 'O', 5),
('Q017', 'O', 5),
('Q018', 'D', 5),
('Q019', 'O', 5),
('Q020', 'O', 5),
('Q021', 'O', 5),
('Q022', 'O', 5),
('Q023', 'O', 5),
('Q024', 'O', 5),
('Q025', 'O', 5),
('Q026', 'D', 5),
('Q027', 'O', 5),
('Q028', 'O', 5),
('Q029', 'D', 5),
('Q030', 'D', 5),
('Q031', 'O', 5),
('Q032', 'D', 5),
('Q033', 'D', 5);

-- --------------------------------------------------------

--
-- Table structure for table `punto_recarga`
--

CREATE TABLE IF NOT EXISTS `punto_recarga` (
  `pun_rec_id` int(11) NOT NULL AUTO_INCREMENT,
  `pun_rec_nombre` varchar(45) DEFAULT NULL,
  `pun_rec_ruc` varchar(45) DEFAULT NULL,
  `pun_rec_codigo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`pun_rec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `relacion_cliente`
--

CREATE TABLE IF NOT EXISTS `relacion_cliente` (
  `rel_cli_id` int(11) NOT NULL AUTO_INCREMENT,
  `cli_id` int(11) NOT NULL,
  `cli_id_relacionado` int(11) NOT NULL,
  `rel_cli_hora` timestamp NULL DEFAULT NULL,
  `rel_cli_tipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`rel_cli_id`),
  KEY `fk_relacion_cliente_cliente1_idx` (`cli_id`),
  KEY `fk_relacion_cliente_cliente2_idx` (`cli_id_relacionado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `relacion_cliente`
--

INSERT INTO `relacion_cliente` (`rel_cli_id`, `cli_id`, `cli_id_relacionado`, `rel_cli_hora`, `rel_cli_tipo`) VALUES
(1, 1, 3, '2014-09-22 14:28:04', 'REFERIDO'),
(2, 1, 2, '2014-09-25 23:35:45', 'REFERIDO'),
(3, 3, 1, '2014-09-26 00:04:59', 'REFERIDO');

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `rol_id` int(4) NOT NULL AUTO_INCREMENT,
  `rol_descripcion` varchar(50) NOT NULL,
  `rol_estado` varchar(10) NOT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`rol_id`, `rol_descripcion`, `rol_estado`) VALUES
(1, 'Administrator', 'A'),
(4, 'Nuevo Rol', 'A'),
(10, 'Rola 2', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `rol_aplicacion`
--

CREATE TABLE IF NOT EXISTS `rol_aplicacion` (
  `rol_id` int(4) NOT NULL,
  `apl_id` int(4) NOT NULL,
  PRIMARY KEY (`rol_id`,`apl_id`),
  KEY `fk_rol_apl_apl_id` (`apl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rol_aplicacion`
--

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
(1, 22),
(1, 23),
(1, 24);

-- --------------------------------------------------------

--
-- Table structure for table `rol_usuario`
--

CREATE TABLE IF NOT EXISTS `rol_usuario` (
  `rol_id` int(4) NOT NULL,
  `usu_id` int(11) NOT NULL,
  PRIMARY KEY (`rol_id`,`usu_id`),
  KEY `fk_rol_usu_usu_id` (`usu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rol_usuario`
--

INSERT INTO `rol_usuario` (`rol_id`, `usu_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sector`
--

CREATE TABLE IF NOT EXISTS `sector` (
  `sec_id` int(11) NOT NULL AUTO_INCREMENT,
  `sec_nombre` varchar(45) NOT NULL,
  `sec_latitud` float(10,6) NOT NULL,
  `sec_longitud` float(10,6) NOT NULL,
  `ciu_id` int(11) NOT NULL,
  `sec_ubicacion` varchar(150) NOT NULL,
  PRIMARY KEY (`sec_id`),
  KEY `fk_sector_ciudad_idx` (`ciu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `sector`
--

INSERT INTO `sector` (`sec_id`, `sec_nombre`, `sec_latitud`, `sec_longitud`, `ciu_id`, `sec_ubicacion`) VALUES
(1, 'SECTOR 1', -0.000100, -1.000000, 1, 'UBICACION 1'),
(5, 'el Labrador', -0.172981, -78.483574, 1, 'El Tiempo'),
(6, 'Villa Olimpica', -33.461449, -70.620033, 2, 'Avenida Grecia y Obispo Orrego'),
(7, 'El Condado', -0.102653, -78.490707, 1, 'la prensa y occidental');

-- --------------------------------------------------------

--
-- Table structure for table `sitio`
--

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
  KEY `fk_sit_ciu_id` (`ciu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sitio`
--

INSERT INTO `sitio` (`sit_id`, `ciu_id`, `sit_descripcion`, `sit_direccion`, `sit_sector`, `sit_reference_number`, `sit_estado`, `sit_latitud`, `sit_longitud`, `sit_ultima_respuesta`, `sit_ultimo_valor`) VALUES
(1, 1, 'Site 1', 'El Inca y Amazonas', 'El Labrador', '804000001', 'A', -0.172981, -78.483574, '0000-00-00 00:00:00', '0.000000'),
(3, 1, 'Site 2', 'El Inca y Amazonas', 'El Labrador', '805000002', 'A', -0.172981, -78.483574, '0000-00-00 00:00:00', '0.000000'),
(4, 1, 'Site 3', 'Estocolmo y Amazonas', 'El Labrador', '804000003', 'I', -0.172981, -78.483574, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_componente`
--

CREATE TABLE IF NOT EXISTS `tipo_componente` (
  `tip_com_id` int(3) NOT NULL AUTO_INCREMENT,
  `tip_com_descripcion` varchar(150) NOT NULL,
  `tip_com_imagen` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`tip_com_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tipo_componente`
--

INSERT INTO `tipo_componente` (`tip_com_id`, `tip_com_descripcion`, `tip_com_imagen`) VALUES
(1, 'Router', '');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_infraccion`
--

CREATE TABLE IF NOT EXISTS `tipo_infraccion` (
  `tip_inf_id` int(4) NOT NULL AUTO_INCREMENT,
  `tip_inf_descripcion` varchar(150) NOT NULL,
  PRIMARY KEY (`tip_inf_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tipo_infraccion`
--

INSERT INTO `tipo_infraccion` (`tip_inf_id`, `tip_inf_descripcion`) VALUES
(1, 'Mal Parqueo');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_vehiculo`
--

CREATE TABLE IF NOT EXISTS `tipo_vehiculo` (
  `tip_veh_id` int(4) NOT NULL AUTO_INCREMENT,
  `tip_veh_descripcion` varchar(75) NOT NULL,
  PRIMARY KEY (`tip_veh_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tipo_vehiculo`
--

INSERT INTO `tipo_vehiculo` (`tip_veh_id`, `tip_veh_descripcion`) VALUES
(1, 'Van');

-- --------------------------------------------------------

--
-- Table structure for table `transaccion`
--

CREATE TABLE IF NOT EXISTS `transaccion` (
  `tra_id` int(11) NOT NULL AUTO_INCREMENT,
  `est_id` int(11) NOT NULL,
  `cli_id` int(11) NOT NULL,
  `tra_valor` float DEFAULT NULL,
  `tra_tipo` varchar(10) DEFAULT NULL,
  `tra_saldo` float DEFAULT NULL,
  `tra_descripcion` text,
  `tra_hora` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tra_id`),
  KEY `fk_transacciones_establecimientos1_idx` (`est_id`),
  KEY `fk_transacciones_clientes1_idx` (`cli_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `transaccion`
--

INSERT INTO `transaccion` (`tra_id`, `est_id`, `cli_id`, `tra_valor`, `tra_tipo`, `tra_saldo`, `tra_descripcion`, `tra_hora`) VALUES
(1, 1, 1, 2, 'DEBITO', 0, NULL, '2014-09-16 08:03:07'),
(2, 1, 1, 2, 'DEBITO', 0, NULL, '2014-09-16 08:13:38'),
(3, 1, 1, 1, 'DEBITO', 0, NULL, '2014-09-17 03:48:30'),
(4, 1, 1, 2, 'DEBITO', 0, NULL, '2014-09-17 04:55:11'),
(5, 1, 1, 1, 'DEBITO', 0, NULL, '2014-09-17 17:46:33'),
(6, 1, 1, 1, 'DEBITO', 0, NULL, '2014-09-19 06:28:29'),
(7, 1, 1, 1, 'DEBITO', 0, NULL, '2014-09-19 06:29:16'),
(8, 1, 1, 1, 'DEBITO', 0, NULL, '2014-09-19 14:14:48'),
(9, 1, 1, 5, 'DEBITO', 0, NULL, '2014-09-19 14:27:33'),
(10, 1, 1, 1, 'DEBITO', 0, NULL, '2014-09-19 19:37:06'),
(11, 1, 1, 1, 'DEBITO', 0, NULL, '2014-09-19 19:37:07'),
(12, 1, 1, 3, 'DEBITO', 0, NULL, '2014-09-19 22:01:30'),
(13, 1, 1, 3, 'DEBITO', 0, NULL, '2014-09-19 22:01:31'),
(14, 1, 1, 1, 'DEBITO', 0, NULL, '2014-09-19 23:38:56'),
(15, 1, 1, 1, 'DEBITO', 0, NULL, '2014-09-20 13:24:47'),
(16, 1, 1, 2, 'DEBITO', 0, NULL, '2014-09-21 14:54:41'),
(17, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-21 15:45:51'),
(18, 1, 1, 1.6, 'DEBITO', 0, NULL, '2014-09-21 15:46:11'),
(19, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-21 15:53:08'),
(20, 1, 1, 2.4, 'DEBITO', 0, NULL, '2014-09-21 16:05:08'),
(21, 1, 1, 1.6, 'DEBITO', 0, NULL, '2014-09-21 18:50:36'),
(22, 1, 1, 1.6, 'DEBITO', 0, NULL, '2014-09-21 19:08:50'),
(23, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-21 21:53:01'),
(24, 1, 1, 2.4, 'DEBITO', 0, NULL, '2014-09-22 00:20:44'),
(25, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-22 00:31:43'),
(26, 1, 1, 3.2, 'DEBITO', 0, NULL, '2014-09-22 00:57:21'),
(27, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-22 00:59:45'),
(28, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-22 01:12:06'),
(29, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-22 01:26:33'),
(30, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-22 01:28:59'),
(31, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-22 01:40:42'),
(32, 1, 1, 1.6, 'DEBITO', 0, NULL, '2014-09-22 02:39:18'),
(33, 1, 1, 1.6, 'DEBITO', 0, NULL, '2014-09-22 02:42:08'),
(34, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-22 02:58:48'),
(35, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-22 03:10:01'),
(36, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-22 03:30:26'),
(37, 1, 1, 3.2, 'DEBITO', 0, NULL, '2014-09-22 04:17:18'),
(38, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-22 04:20:39'),
(39, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-22 04:43:07'),
(40, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-22 04:45:06'),
(41, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-22 04:49:45'),
(42, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-22 13:10:37'),
(43, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-22 13:41:05'),
(44, 1, 1, 2.4, 'DEBITO', 0, NULL, '2014-09-22 13:59:03'),
(45, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-22 14:17:23'),
(46, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-22 14:18:05'),
(47, 1, 2, 3.2, 'DEBITO', 0, NULL, '2014-09-22 14:18:06'),
(48, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-22 16:03:55'),
(49, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-22 16:03:57'),
(50, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-22 22:46:54'),
(51, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-24 03:56:03'),
(52, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-24 16:22:52'),
(53, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-24 17:08:37'),
(54, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-24 17:45:23'),
(55, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-24 17:48:14'),
(56, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-24 22:21:10'),
(57, 1, 1, 1.6, 'DEBITO', 0, NULL, '2014-09-24 22:39:46'),
(58, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-25 17:11:25'),
(59, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-26 11:39:17'),
(60, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-30 15:38:48'),
(61, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-09-30 15:38:49'),
(62, 1, 1, 1.6, 'DEBITO', 0, NULL, '2014-10-03 02:12:53'),
(63, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-10-03 20:03:44'),
(64, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-10-05 23:36:55'),
(65, 1, 1, 1.6, 'DEBITO', 0, NULL, '2014-10-05 23:49:14'),
(66, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-10-06 21:25:11'),
(67, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-10-08 15:34:53'),
(68, 1, 1, 0.8, 'DEBITO', 0, NULL, '2014-10-08 15:34:53'),
(69, 1, 1, 1.6, 'DEBITO', 0, NULL, '2014-10-13 19:54:23'),
(70, 1, 1, 1.6, 'DEBITO', 0, NULL, '2014-10-14 22:22:30');

-- --------------------------------------------------------

--
-- Table structure for table `transferencia_saldo`
--

CREATE TABLE IF NOT EXISTS `transferencia_saldo` (
  `tra_sal_id` int(11) NOT NULL AUTO_INCREMENT,
  `cli_id_de` int(11) NOT NULL,
  `cli_id_para` int(11) NOT NULL,
  `tra_sal_valor` float DEFAULT NULL,
  `tra_sal_hora` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tra_sal_id`),
  KEY `fk_transferencia_saldo_cliente1_idx` (`cli_id_de`),
  KEY `fk_transferencia_saldo_cliente2_idx` (`cli_id_para`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `transferencia_saldo`
--

INSERT INTO `transferencia_saldo` (`tra_sal_id`, `cli_id_de`, `cli_id_para`, `tra_sal_valor`, `tra_sal_hora`) VALUES
(1, 1, 3, 20, '2014-09-22 14:28:16'),
(2, 1, 2, 1.58, '2014-09-25 23:35:55'),
(3, 3, 1, 12, '2014-09-26 00:05:05'),
(4, 1, 2, 36, '2014-10-05 23:49:57'),
(5, 1, 3, 0, '2014-10-13 19:55:05');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

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
  KEY `fk_usu_ciu_id` (`ciu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`usu_id`, `ciu_id`, `usu_usuario`, `usu_email`, `usu_nombre`, `usu_apellido`, `usu_clave`, `usu_estado`) VALUES
(1, 1, 'manucv', 'emanuelcarrasco@gmail.com', 'Emanuel', 'Carrasco', '827ccb0eea8a706c4c34a16891f84e7b', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `vehiculo`
--

CREATE TABLE IF NOT EXISTS `vehiculo` (
  `veh_id` int(6) NOT NULL AUTO_INCREMENT,
  `tip_veh_id` int(4) NOT NULL,
  `veh_marca` varchar(150) NOT NULL,
  `veh_modelo` varchar(100) NOT NULL,
  `veh_placa` varchar(10) NOT NULL,
  `veh_camara_activa` char(1) NOT NULL,
  PRIMARY KEY (`veh_id`),
  KEY `fk_veh_tip_veh_id` (`tip_veh_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vehiculo`
--

INSERT INTO `vehiculo` (`veh_id`, `tip_veh_id`, `veh_marca`, `veh_modelo`, `veh_placa`, `veh_camara_activa`) VALUES
(1, 1, 'Cinascar', 'Van Pass', 'RJI-1902', 'S'),
(2, 1, 'Cinascar', 'Van model', 'ABC-1342', 'N');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `fk_ciu_est_id` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`);

--
-- Constraints for table `componente`
--
ALTER TABLE `componente`
  ADD CONSTRAINT `fk_com_sit_id` FOREIGN KEY (`sit_id`) REFERENCES `sitio` (`sit_id`),
  ADD CONSTRAINT `fk_com_tip_com_id` FOREIGN KEY (`tip_com_id`) REFERENCES `tipo_componente` (`tip_com_id`);

--
-- Constraints for table `compra_saldo`
--
ALTER TABLE `compra_saldo`
  ADD CONSTRAINT `fk_compra_saldo_parqueadero_cliente1` FOREIGN KEY (`cli_id`) REFERENCES `cliente` (`cli_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compra_saldo_parqueadero_punto_recarga1` FOREIGN KEY (`pun_rec_id`) REFERENCES `punto_recarga` (`pun_rec_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dispositivo`
--
ALTER TABLE `dispositivo`
  ADD CONSTRAINT `fk_dis_veh_id` FOREIGN KEY (`veh_id`) REFERENCES `vehiculo` (`veh_id`);

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
-- Constraints for table `sitio`
--
ALTER TABLE `sitio`
  ADD CONSTRAINT `fk_sit_ciu_id` FOREIGN KEY (`ciu_id`) REFERENCES `ciudad` (`ciu_id`);

--
-- Constraints for table `transaccion`
--
ALTER TABLE `transaccion`
  ADD CONSTRAINT `fk_transacciones_clientes1` FOREIGN KEY (`cli_id`) REFERENCES `cliente` (`cli_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transacciones_establecimientos1` FOREIGN KEY (`est_id`) REFERENCES `establecimiento` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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

--
-- Constraints for table `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `fk_veh_tip_veh_id` FOREIGN KEY (`tip_veh_id`) REFERENCES `tipo_vehiculo` (`tip_veh_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
