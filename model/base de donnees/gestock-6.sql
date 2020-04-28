-- MySQL Script generated by MySQL Workbench
-- Tue Apr 28 12:27:55 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema gestock
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema gestock
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gestock` DEFAULT CHARACTER SET utf8 ;
USE `gestock` ;

-- -----------------------------------------------------
-- Table `gestock`.`poste`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestock`.`poste` ;

CREATE TABLE IF NOT EXISTS `gestock`.`poste` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(100) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestock`.`personnel`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestock`.`personnel` ;

CREATE TABLE IF NOT EXISTS `gestock`.`personnel` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `prenom` VARCHAR(45) NULL,
  `nom` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestock`.`article`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestock`.`article` ;

CREATE TABLE IF NOT EXISTS `gestock`.`article` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NULL,
  `groupe` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestock`.`personnel_poste`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestock`.`personnel_poste` ;

CREATE TABLE IF NOT EXISTS `gestock`.`personnel_poste` (
  `id_personnel` INT NULL,
  `id_poste` INT NULL)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestock`.`bon_entree`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestock`.`bon_entree` ;

CREATE TABLE IF NOT EXISTS `gestock`.`bon_entree` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `reference` INT NULL,
  `date` DATE NULL,
  `fournisseur` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestock`.`bon_sortie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestock`.`bon_sortie` ;

CREATE TABLE IF NOT EXISTS `gestock`.`bon_sortie` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `reference` VARCHAR(45) NULL,
  `date` DATE NULL,
  `beneficiaire` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestock`.`sortie_article`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestock`.`sortie_article` ;

CREATE TABLE IF NOT EXISTS `gestock`.`sortie_article` (
  `id_bon_sortie` INT NULL ,
  `id_article` INT NULL,
  `quantite` INT NULL)
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `gestock`.`entree_article`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestock`.`entree_article` ;

CREATE TABLE IF NOT EXISTS `gestock`.`entree_article` (
  `id_bon_entree` INT NULL,
  `id_article` INT NULL,
  `quantite` INT NULL)
ENGINE = MyISAM;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;