CREATE DATABASE IF NOT EXISTS `##dbname##`;

CREATE  TABLE IF NOT EXISTS `##dbname##`.`mapping` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `short_code` VARCHAR(10) NOT NULL ,
  `long_url` TEXT NOT NULL ,
  `insert_date` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `short_code` (`short_code` ASC) ,
  INDEX `long_url` (`long_url`(20) ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;
