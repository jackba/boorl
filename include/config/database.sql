CREATE SCHEMA IF NOT EXISTS `##dbname##` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_cs ;
USE `##dbname##` ;

DROP TABLE IF EXISTS `##dbname##`.`mapping` ;

CREATE  TABLE IF NOT EXISTS `##dbname##`.`mapping` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `short_code` VARCHAR(10) NOT NULL ,
  `long_url` TEXT NOT NULL ,
  `insert_date` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `short_code` (`short_code` ASC) ,
  INDEX `long_url` (`long_url`(20) ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_cs;

DROP TABLE IF EXISTS `##dbname##`.`statistics` ;

CREATE  TABLE IF NOT EXISTS `##dbname##`.`statistics` (
  `mapping_short_code` VARCHAR(10) NOT NULL ,
  `click_time` DATETIME NOT NULL ,
  `ip` VARCHAR(20) NOT NULL ,
  `operating_system` VARCHAR(20) NULL ,
  `browser` VARCHAR(20) NULL ,
  `country` VARCHAR(30) NULL ,
  `referer` VARCHAR(100) NULL ,
  INDEX `mapping_short_code` (`mapping_short_code` ASC) ,
  INDEX `click_time` (`click_time` ASC) ,
  INDEX `operating_system` (`operating_system` ASC) ,
  INDEX `browser` (`browser` ASC) ,
  INDEX `country` (`country` ASC) ,
  INDEX `referer` (`referer` ASC) ,
  CONSTRAINT `mapping_short_code`
    FOREIGN KEY (`mapping_short_code` )
    REFERENCES `##dbname##`.`mapping` (`short_code` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_cs;

