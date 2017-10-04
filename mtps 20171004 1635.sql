-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.16-MariaDB


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema mtps
--

CREATE DATABASE IF NOT EXISTS mtps;
USE mtps;

--
-- Definition of table `cvr_horario_viatico`
--

DROP TABLE IF EXISTS `cvr_horario_viatico`;
CREATE TABLE `cvr_horario_viatico` (
  `id_horario_viatico` int(10) unsigned NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `hora_inicio` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hora_fin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_horario_viatico`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cvr_horario_viatico`
--

/*!40000 ALTER TABLE `cvr_horario_viatico` DISABLE KEYS */;
INSERT INTO `cvr_horario_viatico` (`id_horario_viatico`,`descripcion`,`hora_inicio`,`hora_fin`) VALUES 
 (1,'Desayuno','2017-10-05 06:00:00','2017-10-05 08:00:00'),
 (2,'Almuerzo','2017-10-04 12:00:00','2017-10-04 13:00:00'),
 (3,'cena','2017-10-05 18:00:00','2017-10-05 20:00:00');
/*!40000 ALTER TABLE `cvr_horario_viatico` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
