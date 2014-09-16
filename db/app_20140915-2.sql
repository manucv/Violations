SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `violationsg` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `violationsg` ;

-- -----------------------------------------------------
-- Table `violationsg`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `violationsg`.`categoria` (
  `cat_id` INT NOT NULL AUTO_INCREMENT,
  `cat_nombre` VARCHAR(45) NULL,
  `cat_descripcion` VARCHAR(45) NULL,
  PRIMARY KEY (`cat_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `violationsg`.`establecimiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `violationsg`.`establecimiento` (
  `est_id` INT NOT NULL AUTO_INCREMENT,
  `cat_id` INT NOT NULL,
  `est_nombre` VARCHAR(45) NULL,
  `est_descripcion` VARCHAR(45) NULL,
  `est_` VARCHAR(45) NULL,
  PRIMARY KEY (`est_id`),
  INDEX `fk_establecimientos_categorias_idx` (`cat_id` ASC),
  CONSTRAINT `fk_establecimientos_categorias`
    FOREIGN KEY (`cat_id`)
    REFERENCES `violationsg`.`categoria` (`cat_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `violationsg`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `violationsg`.`cliente` (
  `cli_id` INT NOT NULL AUTO_INCREMENT,
  `cli_nombre` VARCHAR(45) NULL,
  `cli_email` VARCHAR(45) NULL,
  `cli_passw` VARCHAR(45) NULL,
  `cli_saldo` VARCHAR(45) NULL,
  `cli_estado` VARCHAR(10) NULL,
  `cli_usuario` VARCHAR(45) NULL,
  PRIMARY KEY (`cli_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `violationsg`.`log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `violationsg`.`log` (
  `log_id` INT NOT NULL AUTO_INCREMENT,
  `log_hora` DATETIME NULL,
  `log_descripcion` VARCHAR(45) NULL,
  `log_info` TEXT NULL,
  `cli_id` INT NOT NULL,
  PRIMARY KEY (`log_id`),
  INDEX `fk_logs_clientes1_idx` (`cli_id` ASC),
  CONSTRAINT `fk_logs_clientes1`
    FOREIGN KEY (`cli_id`)
    REFERENCES `violationsg`.`cliente` (`cli_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `violationsg`.`transaccion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `violationsg`.`transaccion` (
  `tra_id` INT NOT NULL AUTO_INCREMENT,
  `est_id` INT NOT NULL,
  `cli_id` INT NOT NULL,
  `tra_valor` FLOAT NULL,
  `tra_tipo` VARCHAR(10) NULL,
  `tra_saldo` FLOAT NULL,
  `tra_descripcion` TEXT NULL,
  `tra_hora` TIMESTAMP NULL,
  INDEX `fk_transacciones_establecimientos1_idx` (`est_id` ASC),
  PRIMARY KEY (`tra_id`),
  INDEX `fk_transacciones_clientes1_idx` (`cli_id` ASC),
  CONSTRAINT `fk_transacciones_establecimientos1`
    FOREIGN KEY (`est_id`)
    REFERENCES `violationsg`.`establecimiento` (`est_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_transacciones_clientes1`
    FOREIGN KEY (`cli_id`)
    REFERENCES `violationsg`.`cliente` (`cli_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `violationsg`.`punto_recarga`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `violationsg`.`punto_recarga` (
  `pun_rec_id` INT NOT NULL AUTO_INCREMENT,
  `pun_rec_nombre` VARCHAR(45) NULL,
  `pun_rec_ruc` VARCHAR(45) NULL,
  `pun_rec_codigo` VARCHAR(45) NULL,
  PRIMARY KEY (`pun_rec_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `violationsg`.`compra_saldo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `violationsg`.`compra_saldo` (
  `com_sal_id` INT NOT NULL AUTO_INCREMENT,
  `cli_id` INT NOT NULL,
  `punto_recarga_pun_rec_id` INT NOT NULL,
  `com_sal_valor` FLOAT NULL,
  `com_sal_hora` TIMESTAMP NULL,
  PRIMARY KEY (`com_sal_id`),
  INDEX `fk_compra_saldo_parqueadero_cliente1_idx` (`cli_id` ASC),
  INDEX `fk_compra_saldo_parqueadero_punto_recarga1_idx` (`punto_recarga_pun_rec_id` ASC),
  CONSTRAINT `fk_compra_saldo_parqueadero_cliente1`
    FOREIGN KEY (`cli_id`)
    REFERENCES `violationsg`.`cliente` (`cli_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_compra_saldo_parqueadero_punto_recarga1`
    FOREIGN KEY (`punto_recarga_pun_rec_id`)
    REFERENCES `violationsg`.`punto_recarga` (`pun_rec_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `violationsg`.`transferencia_saldo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `violationsg`.`transferencia_saldo` (
  `tra_sal_id` INT NOT NULL AUTO_INCREMENT,
  `cli_id_de` INT NOT NULL,
  `cli_id_para` INT NOT NULL,
  `tra_sal_valor` FLOAT NULL,
  `tra_sal_hora` TIMESTAMP NULL,
  PRIMARY KEY (`tra_sal_id`),
  INDEX `fk_transferencia_saldo_cliente1_idx` (`cli_id_de` ASC),
  INDEX `fk_transferencia_saldo_cliente2_idx` (`cli_id_para` ASC),
  CONSTRAINT `fk_transferencia_saldo_cliente1`
    FOREIGN KEY (`cli_id_de`)
    REFERENCES `violationsg`.`cliente` (`cli_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_transferencia_saldo_cliente2`
    FOREIGN KEY (`cli_id_para`)
    REFERENCES `violationsg`.`cliente` (`cli_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
