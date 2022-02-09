-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- CREATE TABLE "role" -----------------------------------------
CREATE TABLE `role`( 
	`id` Int( 11 ) NOT NULL,
	`libelle` VarChar( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	PRIMARY KEY ( `id` ),
	CONSTRAINT `unique_id` UNIQUE( `id` ) )
CHARACTER SET = latin1
COLLATE = latin1_swedish_ci
ENGINE = InnoDB;
-- -------------------------------------------------------------


-- CREATE TABLE "user" -----------------------------------------
CREATE TABLE `user`( 
	`id` Int( 11 ) NOT NULL,
	`email` VarChar( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`password` VarChar( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`role` Int( 255 ) NOT NULL,
	PRIMARY KEY ( `id` ),
	CONSTRAINT `unique_id` UNIQUE( `id` ) )
CHARACTER SET = latin1
COLLATE = latin1_swedish_ci
ENGINE = InnoDB;
-- -------------------------------------------------------------


-- CREATE TABLE "comment" --------------------------------------
CREATE TABLE `comment`( 
	`id` Int( 255 ) NOT NULL,
	`username` VarChar( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`comment` Text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`date` DateTime NOT NULL,
	PRIMARY KEY ( `id` ),
	CONSTRAINT `id` UNIQUE( `id` ) )
CHARACTER SET = latin1
COLLATE = latin1_swedish_ci
ENGINE = InnoDB;
-- -------------------------------------------------------------


-- Dump data of "role" -------------------------------------
-- ---------------------------------------------------------


-- Dump data of "user" -------------------------------------
-- ---------------------------------------------------------


-- Dump data of "comment" ----------------------------------
-- ---------------------------------------------------------


-- CREATE INDEX "index_id" -------------------------------------
CREATE INDEX `index_id` USING BTREE ON `comment`( `id` );
-- -------------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


