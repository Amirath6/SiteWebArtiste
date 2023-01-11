-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: mysql.info.unicaen.fr    Database: niveau_dev
-- ------------------------------------------------------
-- Server version	5.5.47-0+deb7u1-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE=`+00:00` */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=`NO_AUTO_VALUE_ON_ZERO` */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `artists`
--

DROP TABLE IF EXISTS `artists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist` varchar(255) NOT NULL,
  `nomDeNaissance` varchar(255) NOT NULL,
  `prenomDeNaissance` varchar(255) NOT NULL,
  `genreArtist` varchar(255) NOT NULL,
  `anneeDeNaissance` dateTime NOT NULL,
  `villeDeNaissance` varchar(255) NOT NULL,
  `paysDeNaissance` varchar(255) NOT NULL,
  `genreMusic` varchar(255) NOT NULL,
  `year` dateTime NOT NULL,
  `album` varchar(255) NOT NULL,
  `styleDeMusique` varchar(255) NOT NULL,
  `textFile` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artists`
--

LOCK TABLES `artists` WRITE;
/*!40000 ALTER TABLE `artists` DISABLE KEYS */;
INSERT INTO `artists` VALUES (1,"Dadju", "Nsungula", "Dadju Djuna", "chanteur", "1991-05-02", "Bobigny", "Seine-Saint-Denis", "hip-pop", "2012-01-01", "Gentleman 2.0", "RnB Français", 'daju', "dadju.jpg"),
                              (2,"Rihanna", "Robyn Rihanna", "Fenty", "chanteuse", "1988-02-20", "Saint Michael", "Barbade", "pop", "2005-01-01", "Music of the Sun", "RnB", 'daju', "rihanna.jpg"),
                              (3,"Céline Dion", "Dion", "Céline", "chanteuse", "1968-03-30", "Charlemagne", "Québec", "pop", "1981-01-01", "Unison", "Pop", 'daju', "celine.jpeg"),
                              (4, "Ronisia", "Morges", "Ronisia Mendes", "chanteuse", "1999-11-13", "Tarrafal", "Cap-Vert", "rap et zouk", "2018-01-01", "Ronisia", "RnB", 'daju', "ronisia.jpeg"),
                              (5, "Maître Gims", "Nsungula", "Ghandi Djuna", "chanteur", "1986-05-06", "Kinshasa", "Zaïre", "rap", "2009-01-01", "Subliminal", "Rap", 'daju', "gims.jpeg"),
                              (6, "Aya Nakamura", "Nakamura", "Aya", "chanteuse", "1993-04-07", "Paris", "France", "Rap", "2017-01-01", "Nakamura", "Rap", 'daju', "aya.jpeg");
/*!40000 ALTER TABLE `artists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-16 18:30:36
