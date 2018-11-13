SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema reto2_bbdd
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `reto2_bbdd` ;

-- -----------------------------------------------------
-- Schema reto2_bbdd
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `reto2_bbdd` DEFAULT CHARACTER SET utf8 ;
USE `reto2_bbdd` ;

-- -----------------------------------------------------
-- Table `reto2_bbdd`.`Usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reto2_bbdd`.`Usuario` ;

CREATE TABLE IF NOT EXISTS `reto2_bbdd`.`Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `nombreusu` VARCHAR(15) NOT NULL,
  `correo` VARCHAR(50) NOT NULL,
  `pass` VARCHAR(60) NOT NULL,
  `desc` VARCHAR(256) NULL,
  `img` VARCHAR(256) NULL,
  PRIMARY KEY (`idUsuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reto2_bbdd`.`Pregunta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reto2_bbdd`.`Pregunta` ;

CREATE TABLE IF NOT EXISTS `reto2_bbdd`.`Pregunta` (
  `idPregunta` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(100) NOT NULL,
  `cuerpo` VARCHAR(256) NOT NULL,
  `fecha` DATE NOT NULL,
  `archivos` VARCHAR(256) NULL,
  `Usuario_idUsuario` INT NOT NULL,
  PRIMARY KEY (`idPregunta`),
  INDEX `fk_Pregunta_Usuario_idx` (`Usuario_idUsuario` ASC) VISIBLE,
  CONSTRAINT `fk_Pregunta_Usuario`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `reto2_bbdd`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reto2_bbdd`.`Respuesta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reto2_bbdd`.`Respuesta` ;

CREATE TABLE IF NOT EXISTS `reto2_bbdd`.`Respuesta` (
  `idRespuesta` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(100) NOT NULL,
  `cuerpo` VARCHAR(256) NOT NULL,
  `fecha` DATE NOT NULL,
  `archivos` VARCHAR(256) NULL,
  `aprobado` TINYINT NOT NULL DEFAULT 0,
  `Usuario_idUsuario` INT NOT NULL,
  `Pregunta_idPregunta` INT NOT NULL,
  PRIMARY KEY (`idRespuesta`),
  INDEX `fk_Respuesta_Usuario1_idx` (`Usuario_idUsuario` ASC) VISIBLE,
  INDEX `fk_Respuesta_Pregunta1_idx` (`Pregunta_idPregunta` ASC) VISIBLE,
  CONSTRAINT `fk_Respuesta_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `reto2_bbdd`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Respuesta_Pregunta1`
    FOREIGN KEY (`Pregunta_idPregunta`)
    REFERENCES `reto2_bbdd`.`Pregunta` (`idPregunta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reto2_bbdd`.`Tema`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reto2_bbdd`.`Tema` ;

CREATE TABLE IF NOT EXISTS `reto2_bbdd`.`Tema` (
  `idTema` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idTema`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reto2_bbdd`.`Voto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reto2_bbdd`.`Voto` ;

CREATE TABLE IF NOT EXISTS `reto2_bbdd`.`Voto` (
  `idVoto` INT NOT NULL AUTO_INCREMENT,
  `tipo` TINYINT NOT NULL,
  `Usuario_idUsuario` INT NOT NULL,
  `Respuesta_idRespuesta` INT NOT NULL,
  PRIMARY KEY (`idVoto`),
  INDEX `fk_Voto_Usuario1_idx` (`Usuario_idUsuario` ASC) VISIBLE,
  INDEX `fk_Voto_Respuesta1_idx` (`Respuesta_idRespuesta` ASC) VISIBLE,
  CONSTRAINT `fk_Voto_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `reto2_bbdd`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Voto_Respuesta1`
    FOREIGN KEY (`Respuesta_idRespuesta`)
    REFERENCES `reto2_bbdd`.`Respuesta` (`idRespuesta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reto2_bbdd`.`Pregunta_has_Tema`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reto2_bbdd`.`Pregunta_has_Tema` ;

CREATE TABLE IF NOT EXISTS `reto2_bbdd`.`Pregunta_has_Tema` (
  `Pregunta_idPregunta` INT NOT NULL,
  `Tema_idTema` INT NOT NULL,
  INDEX `fk_Pregunta_has_Tema_Tema1_idx` (`Tema_idTema` ASC) VISIBLE,
  INDEX `fk_Pregunta_has_Tema_Pregunta1_idx` (`Pregunta_idPregunta` ASC) VISIBLE,
  PRIMARY KEY (`Pregunta_idPregunta`, `Tema_idTema`),
  CONSTRAINT `fk_Pregunta_has_Tema_Pregunta1`
    FOREIGN KEY (`Pregunta_idPregunta`)
    REFERENCES `reto2_bbdd`.`Pregunta` (`idPregunta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pregunta_has_Tema_Tema1`
    FOREIGN KEY (`Tema_idTema`)
    REFERENCES `reto2_bbdd`.`Tema` (`idTema`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;