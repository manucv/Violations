-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 28, 2014 at 01:58 AM
-- Server version: 5.6.12
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;



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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `multa_parqueadero`
--
ALTER TABLE `multa_parqueadero`
  ADD CONSTRAINT `fk_multa_parqueadero_automovil1` FOREIGN KEY (`aut_placa`) REFERENCES `automovil` (`aut_placa`),
  ADD CONSTRAINT `fk_multa_parqueadero_infraccion1` FOREIGN KEY (`inf_id`) REFERENCES `infraccion` (`inf_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_multa_parqueadero_parqueadero1` FOREIGN KEY (`par_id`) REFERENCES `parqueadero` (`par_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
