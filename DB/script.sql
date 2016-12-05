-- MySQL Script generated by MySQL Workbench
-- jue 17 nov 2016 18:30:31 CST
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema Quiz
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Quiz
-- -----------------------------------------------------
USE `Quiz` ;

-- -----------------------------------------------------
-- Table `Quiz`.`Alumno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Quiz`.`Alumno` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombres` VARCHAR(45) NULL,
  `apellidoPaterno` VARCHAR(45) NULL,
  `apellidoMaterno` VARCHAR(45) NULL,
  `password` VARCHAR(45) NOT NULL,
  `activo` ENUM('S', 'N') NOT NULL DEFAULT 'S',
  `fechaRegistro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo` ENUM('Admin', 'Normal') NOT NULL DEFAULT 'Admin',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Quiz`.`Curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Quiz`.`Curso` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `ciclo` VARCHAR(5) NULL,
  `activo` ENUM('S', 'N') NOT NULL DEFAULT 'S',
  `fechaRegistro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Quiz`.`Cuestionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Quiz`.`Cuestionario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NULL,
  `activo` ENUM('S', 'N') NOT NULL DEFAULT 'S',
  `fechaRegistro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Quiz`.`Pregunta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Quiz`.`Pregunta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(100) NULL,
  `activo` ENUM('S', 'N') NOT NULL DEFAULT 'S',
  `fechaRegistro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Quiz`.`Opcion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Quiz`.`Opcion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL,
  `correcta` ENUM('S', 'N') NULL DEFAULT 'N',
  `activo` ENUM('S', 'N') NOT NULL DEFAULT 'S',
  `fechaRegistro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Quiz`.`NodoCuestionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Quiz`.`NodoCuestionario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idOpcion` INT NOT NULL,
  `idPregunta` INT NOT NULL,
  `idCuestionario` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_relacionPreguntaRespuesta_Pregunta1_idx` (`idPregunta` ASC),
  INDEX `fk_NodoCuestionario_Cuestionario1_idx` (`idCuestionario` ASC),
  CONSTRAINT `fk_relacionPreguntaRespuesta_Respueta1`
    FOREIGN KEY (`idOpcion`)
    REFERENCES `Quiz`.`Opcion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relacionPreguntaRespuesta_Pregunta1`
    FOREIGN KEY (`idPregunta`)
    REFERENCES `Quiz`.`Pregunta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_NodoCuestionario_Cuestionario1`
    FOREIGN KEY (`idCuestionario`)
    REFERENCES `Quiz`.`Cuestionario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Quiz`.`RespuestaAlumno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Quiz`.`RespuestaAlumno` (
  `idNodoCuestionario` INT NOT NULL,
  `idAlumno` INT NOT NULL,
  INDEX `fk_RespuestaAlumno_relacionOpcionPregunta1_idx` (`idNodoCuestionario` ASC),
  INDEX `fk_RespuestaAlumno_Alumno1_idx` (`idAlumno` ASC),
  PRIMARY KEY (`idNodoCuestionario`, `idAlumno`),
  CONSTRAINT `fk_RespuestaAlumno_relacionOpcionPregunta1`
    FOREIGN KEY (`idNodoCuestionario`)
    REFERENCES `Quiz`.`NodoCuestionario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_RespuestaAlumno_Alumno1`
    FOREIGN KEY (`idAlumno`)
    REFERENCES `Quiz`.`Alumno` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Quiz`.`relacionCuestionarioCurso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Quiz`.`relacionCuestionarioCurso` (
  `idCuestionario` INT NOT NULL,
  `idCurso` INT NOT NULL,
  PRIMARY KEY (`idCuestionario`, `idCurso`),
  INDEX `fk_Cuestionario_has_Curso_Curso1_idx` (`idCurso` ASC),
  INDEX `fk_Cuestionario_has_Curso_Cuestionario1_idx` (`idCuestionario` ASC),
  CONSTRAINT `fk_Cuestionario_has_Curso_Cuestionario1`
    FOREIGN KEY (`idCuestionario`)
    REFERENCES `Quiz`.`Cuestionario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cuestionario_has_Curso_Curso1`
    FOREIGN KEY (`idCurso`)
    REFERENCES `Quiz`.`Curso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Quiz`.`relacionAlumnoCurso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Quiz`.`relacionAlumnoCurso` (
  `idAlumno` INT NOT NULL,
  `idCurso` INT NOT NULL,
  PRIMARY KEY (`idAlumno`, `idCurso`),
  INDEX `fk_Alumno_has_Curso_Curso1_idx` (`idCurso` ASC),
  INDEX `fk_Alumno_has_Curso_Alumno1_idx` (`idAlumno` ASC),
  CONSTRAINT `fk_Alumno_has_Curso_Alumno1`
    FOREIGN KEY (`idAlumno`)
    REFERENCES `Quiz`.`Alumno` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Alumno_has_Curso_Curso1`
    FOREIGN KEY (`idCurso`)
    REFERENCES `Quiz`.`Curso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
