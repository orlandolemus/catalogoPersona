-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- CREATE TABLE "persona" ----------------------------------
CREATE TABLE `persona` ( 
	`id` BigInt( 20 ) AUTO_INCREMENT NOT NULL, 
	`nombres` VarChar( 128 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, 
	`apellidos` VarChar( 128 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, 
	`genero` VarChar( 6 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, 
	`fecha_nacimiento` Date NOT NULL,
	 PRIMARY KEY ( `id` )
 )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- ---------------------------------------------------------


-- Dump data of "persona" ----------------------------------
INSERT INTO `persona`(`id`,`nombres`,`apellidos`,`genero`,`fecha_nacimiento`) VALUES ( '1', 'Mario Alberto', 'Flores Granadino', 'Hombre', '1980-10-23' );
INSERT INTO `persona`(`id`,`nombres`,`apellidos`,`genero`,`fecha_nacimiento`) VALUES ( '2', 'Juana Francisca', 'Mendoza Gonzales', 'Mujer', '1985-06-14' );
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


