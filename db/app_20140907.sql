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
-- Table `violationsg`.`transaccione`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `violationsg`.`transaccione` (
  `tra_id` INT NOT NULL AUTO_INCREMENT,
  `est_id` INT NOT NULL,
  `cli_id` INT NOT NULL,
  `tra_valor` FLOAT NULL,
  `tra_tipo` VARCHAR(10) NULL,
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


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
