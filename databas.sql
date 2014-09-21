-- MySQL dump 10.13  Distrib 5.5.37, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: d0019e_blogg
-- ------------------------------------------------------
-- Server version	5.5.37-0ubuntu0.12.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `conf`
--

DROP TABLE IF EXISTS `conf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conf` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(45) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `description` text,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conf`
--

LOCK TABLES `conf` WRITE;
/*!40000 ALTER TABLE `conf` DISABLE KEYS */;
INSERT INTO `conf` VALUES (8,'site_name','Tinys blogg!','','Sidans Namn');
/*!40000 ALTER TABLE `conf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file` (
  `idfile` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `path` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`idfile`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file`
--

LOCK TABLES `file` WRITE;
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` VALUES (8,'beautiful-girls-21.jpg','Hi!',329,1402751219,'image/jpeg','078a2c10e038a2c910043e6556b48e85'),(9,'WGR-6012(R0.29h4)_2012-09-20.zip','ZIP',329,1402751573,'application/zip','b9dcc50d324d393a4d2aa197c6d0ca5f');
/*!40000 ALTER TABLE `file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `visible` int(11) NOT NULL,
  `group` varchar(50) NOT NULL,
  `sortorder` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page` (
  `idpage` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `show_in_menu` tinyint(4) DEFAULT '0',
  `content` text,
  `author` int(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpage`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES (3,'egsfsafeasd',1,'afadasgsgsxdfssgdsfsfsd',329,1402861236);
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `idpost` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `content` text,
  `author` int(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpost`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (16,'Hi!',',mhkljhoÃ¶jÃ¶kÃ¤Ã¶\r\n',329,1402754574),(17,'agfacfsdg','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vulputate erat sed luctus pellentesque. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin interdum imperdiet enim, vel vulputate nibh blandit ac. Vivamus ut sapien quis felis vestibulum rhoncus. Nunc vitae erat quis nunc iaculis interdum. Phasellus ligula purus, placerat ut arcu non, aliquam scelerisque tellus. Sed commodo aliquam neque, sed pellentesque turpis blandit at. Phasellus consectetur ullamcorper mauris nec blandit. Fusce placerat, nisi non ullamcorper ultricies, turpis ante convallis neque, sed egestas sapien felis blandit nisi. Nunc porta malesuada urna, dapibus sodales diam ornare sit amet. In non varius lacus, a interdum dui. Mauris venenatis urna ac mauris sollicitudin malesuada.\r\n\r\nUt euismod, magna ut blandit euismod, mauris purus rutrum nulla, non porttitor mi mauris in felis. Fusce arcu nisi, ultrices eu volutpat non, iaculis sit amet augue. Etiam quis facilisis amet.asfasfdsafdd\r\n<img src=\"[[[file:8]]]\" />',329,1402860809),(18,'ny post!!!','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a est vitae nibh cursus rhoncus et eu orci. Donec sagittis porta justo ac egestas. Sed est dui, semper ultricies ultricies sodales, volutpat non tortor. Maecenas sit amet laoreet nulla, nec gravida sapien. Phasellus non neque sed augue auctor viverra. Quisque sem arcu, pharetra et neque ut, euismod gravida magna. Vivamus tellus sem, ultricies quis sapien et, gravida laoreet ligula. Curabitur risus nunc, varius ut commodo at, eleifend a sapien. Integer iaculis pretium sodales. Pellentesque mollis mi sed purus tempor, id lobortis metus sollicitudin. Duis fermentum semper porta. Morbi convallis odio sed nisl scelerisque faucibus.\r\n\r\nSuspendisse et justo nec tellus semper tristique. Ut mattis, enim a tincidunt cursus, justo arcu laoreet orci, vitae varius neque augue eget libero. Nulla et accumsan tellus. Donec dignissim nisi non turpis pellentesque pellentesque. In vel justo urna. Curabitur imperdiet at ante ut placerat. Fusce eu interdum purus, a dignissim felis. Proin placerat adipiscing mauris, sit amet malesuada nisi. Maecenas mauris metus, dictum lacinia leo nec, posuere porta risus.\r\n\r\nPhasellus sed purus in mi ultrices semper nec a quam. Nullam rhoncus nibh id dui tristique, ut porttitor ipsum bibendum. Nunc auctor nisi nec facilisis auctor. Nullam id leo felis. Ut bibendum purus sit amet lacus porta, ultricies gravida dui mattis. Vivamus ornare porta nisl, eget rutrum lectus. Nunc sed lectus quis ligula molestie congue non quis purus. Etiam congue porttitor metus. Donec a arcu lobortis, cursus odio ac, consectetur tortor. Curabitur pretium rutrum ipsum, quis bibendum mauris tempor ut. Ut ultrices lectus ut urna pellentesque, non semper elit faucibus. Fusce sit amet est et neque dignissim vehicula sed at ligula. Curabitur tincidunt placerat neque, quis iaculis sem viverra sit amet. Praesent tristique mi ut purus viverra convallis. Sed fermentum rutrum neque nec semper.',329,1402858403);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `usertype` int(11) DEFAULT '3',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=341 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (329,'tiny','290833cdefed1eeae652c75647989017','Kristian','Nordman','kristian.nordman@scripter.se',1),(339,'tiny242','290833cdefed1eeae652c75647989017','','',NULL,3),(340,'admin','21232f297a57a5a743894a0e4a801fc3','','',NULL,3);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-06-15 21:46:04
