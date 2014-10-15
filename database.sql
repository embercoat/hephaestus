-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: d0019e_blogg
-- ------------------------------------------------------
-- Server version	5.5.38-0+wheezy1

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
INSERT INTO `conf` VALUES (8,'site_name','Hefaistos','','Sidans Namn');
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
INSERT INTO `page` VALUES (3,'Me!',1,'<p>It\'s-a me! Mario!</p>\r\n\r\n<p>Inte direkt, men det var fÃ¶rsta tanken nÃ¤r jag skulle bÃ¶rja skriva en Me!-sida. </p>\r\n\r\n<p>Mitt namn Ã¤r Kristian Nordman, kallas Tiny av de flesta och anvÃ¤nder mig av tiny som nick pÃ¥ de forum som hÃ¶r till kursen. Jag har kodat PhP i snart 10 Ã¥r och pÃ¥ professionell nivÃ¥ till och frÃ¥n senaste 6 Ã¥ren. StÃ¶rsta anledningen till att jag lÃ¤ser den hÃ¤r kursen Ã¤r fÃ¶r att skrapa ihop lite poÃ¤ng och fÃ¥ behÃ¥lla min studentlÃ¤genhet. Med det sagt kommer jag inte ta kursen mindre seriÃ¶st Ã¤n om jag varit nybÃ¶rjare som gÃ¤rna velat lÃ¤ra sig PhP.</p>\r\n\r\n<blockquote><p>\"Onwards! To victory and glory!\" -Random citat som mellanspel fÃ¶r att komma till den intressanta biten i det hÃ¤r.</p></blockquote>\r\n\r\n<h2>Kmom 1</h2>\r\n<p>Jag bÃ¶rjade med att lÃ¤sa igenom hela Anax och i minnet bygga upp allt enligt guiden varefter jag gick all in och utÃ¶kade ganska kraftigt med diverse olika extrasaker som kÃ¤ndes lÃ¤mligt att ta med; sÃ¥ som en mindre uppsjÃ¶ hjÃ¤lpklasser, abstraktioner och en grundlÃ¤ggande anvÃ¤ndarhantering (ett mÃ¥ste fÃ¶r att inte behÃ¶va knacka kod sÃ¥ snart det ska uppdateras). Ett koncept jag gillat sen jag bÃ¶rjade anvÃ¤nda Kohana\'s ramverk (http://kohanaframework.org/) Ã¤r MVC: Model, View, Controller. Ett sÃ¤tt att tÃ¤nka fÃ¶r att separera kod och presentation dÃ¤r modellerna skÃ¶ter informationshanteringen om sina respektive omrÃ¥den, kontrollerna bestÃ¤mmer vad som ska visas och vyerna hur allt ska visas. </p>\r\n\r\n<h3>UtvecklingsmiljÃ¶</h3>\r\n<p>Den hÃ¤r biten Ã¤r lite av min favorit. Efter otaliga iterationer och ombyggnationer har jag landat pÃ¥ en vÃ¤ldigt stabil och snabb utvecklingsmiljÃ¶.</p>\r\n<p>Det hela bÃ¶rjar med Linux Mint. En trevlig distribution som Ã¤r har en lagom blandning av onÃ¶digt skrÃ¤p och hastighet. Som tur Ã¤r gÃ¥r det snabbt att rensa bort skrÃ¤pet med aptitude. PÃ¥ det lÃ¤gger vi till NFS. Jag har vÃ¤ldigt lite material pÃ¥ min arbetsstation. NÃ¤stan allt ligger pÃ¥ min server som jag underhÃ¥ller och driver. Mha NFS monterar jag devkatalogerna och tillsammans med mitt toksnabba Gbit nÃ¤tverk mÃ¤rks det inte ens nÃ¥gon skillnad mellan att arbeta mot server eller egen hÃ¥rddisk.</p>\r\n<p>De mjukvaror jag anvÃ¤nder mig av Ã¤r, till att bÃ¶rja med, den oumbÃ¤rliga terminalen varifrÃ¥n git hanteras, filer flyttas och viktiga filer oavsiktligt plockas bort etc. Till sjÃ¤lva kodandet anvÃ¤nder jag mig av Komodo IDE (http://komodoide.com/komodo-edit/). Ett introspektivt IDE som analyserar kod och ger lÃ¤mpliga fÃ¶rslag pÃ¥ autocompletion. Databaserna administreras sÃ¥klart av Mysql Workbench.</p>\r\n\r\n<h3>20 Steg fÃ¶r att komma igÃ¥ng</h3>\r\n<p>Jag har pysslat lÃ¤nge med PhP men det finns alltid nÃ¥got nytt att lÃ¤ra sig. Den hÃ¤r gÃ¥ngen var det om UTF-8 och multibyte-strÃ¤ngar. Lokalisering och i18n Ã¤r alltid besvÃ¤rligt att jobba med men dessa nya ledtrÃ¥dar kanske gÃ¶r det lÃ¤ttare i framtiden.</p>\r\n\r\n<h3>Anax?</h3>\r\nHÃ¤r finns ingen Anax. HÃ¤r finns endast <b>Hephaestus</b>!. Smedjans och eldens gud.\r\n\r\n<h3>Katalogstruktur</h3>\r\nDen fÃ¶reslagna strukturen har sina fÃ¶rdelar att man enkelt och vÃ¤ldigt sÃ¤kert kan dÃ¶lja viktig/kÃ¤nslig kod utanfÃ¶r webroot. Dock fÃ¶redrar jag att anvÃ¤nda mig av .htaccess och mod_rewrite fÃ¶r att fÃ¥ snygga adresser och dirigera om allt att gÃ¥ via index.php som agerar dispatcher.\r\n\r\n<h3>cSource</h3>\r\nDet gick relativt enkelt att inkludera source.php. DÃ¥ allt redan var uppsatt fÃ¶r att evaluera en fil och sedan kasta in resultatet pÃ¥ anvisad plats i huvudmallen. Det stÃ¶rsta problemet jag hade var att .htaccess och mod_rewrite plockade bort query-string fÃ¶r mig. NÃ¥got som var enkelt Ã¥tgÃ¤rdat med flaggan QSA.\r\n\r\n<h3>Github</h3>\r\nJajjemÃ¤n! \r\n<a href=\"https://github.com/tinyMrChaos/hephaestus/\">https://github.com/tinyMrChaos/hephaestus/</a>\r\n\r\n<h2>Kmom 2</h2>\r\n<p>Objektorienterat Ã¤r den naturliga fortsÃ¤ttningen pÃ¥ funktionell programmering. Det Ã¤r fortfarande en del saker jag som jag kÃ¤nner Ã¤r luddiga, men har hittils inte behÃ¶vt dem till nÃ¥got.</p>\r\n\r\n<p>Jag skumlÃ¤ste bara och letade efter nÃ¥got obekant.</p>\r\n<p>Generalisering och separation Ã¤r tvÃ¥ ideer som ofta kommer vÃ¤l till anvÃ¤ndning. Med dessa i tanken skapade jag fÃ¶rst en klass fÃ¶r att hantera generell speldata ([[[csource:model/kmom2/gamedata.php]]]) fÃ¶r att hÃ¥lla koll pÃ¥ poÃ¤ng och spara dessa pÃ¥ lÃ¤mpligt vis. Denna utÃ¶kar jag med logiken fÃ¶r tÃ¤rningsspelet ([[[csource:model/kmom2/dicegame.php]]]). UtÃ¶ver dessa tvÃ¥ finns Ã¤ven slumpgeneratorn randomize ([[[csource:model/kmom2/randomize.php]]]) som fÃ¶r nÃ¤rvarande anvÃ¤nder den inbyggda rand() fÃ¶r att slumpa sina resultat.</p>\r\n<p>NÃ¤r alla delar sedan fanns pÃ¥ plats var det en enkel sak att plocka ut lÃ¤mpliga vÃ¤rden och presentera pÃ¥ sidan.</p>\r\n\r\n<h2>Kmom 3</h2>\r\n<p>Databaser Ã¤r den drivande faktorn bakom det mesta. Utan dessa skulle mÃ¥nga applikationer inte ens kunna tillverkas och ytterliggare nÃ¥gra skulle fÃ¶rlora mycket av sin kraft.</p>\r\n<p>Jag har sedan tidigare jobbat med MySQL som fÃ¶rstahandsval, men Ã¤ven en del med SQLite och Oracle i arbetet. Alla dessa delar SQL som grund och har sedan sin egen dialekt med extrafunktioner och speciella lÃ¶sningar. </p>\r\n<p>PhPMyadmin var det fÃ¶rsta grÃ¤nssnittet jag anvÃ¤nde fÃ¶r att administrera och Ã¤ndra databasens innehÃ¥ll och struktur. Jag gick sedan vidare till fÃ¶regÃ¥ngaren till MySQL workbench och Ã¤r nu pÃ¥ MySQL workbench i de flesta fallen. MySQL CLU Ã¤r anvÃ¤ndbart och dessutom nyttigt att anvÃ¤nda av den anledning att den inte har nÃ¥gon handrÃ¤ckning. CLU gÃ¶r exakt som den blir tillsags och inget mer vilket stÃ¤ller hÃ¶gre krav pÃ¥ anvÃ¤ndaren och tvingar anvÃ¤ndaren att sjÃ¤lv lÃ¤ra sig SQL. NÃ¤r det gÃ¤ller BTH\'s driftsmiljÃ¶ har jag svÃ¥rt att avgÃ¶ra hur den fungerar dÃ¥ student-servrarna blockerats pga fÃ¶r mÃ¥nga anslutningar.</p>\r\n<p>SQL-Ã¶vningen gick bra. Jag lÃ¤rde mig lite mer om de olika typerna av join och Ã¤ven \"having\", ett statement jag letat efter lite nu och dÃ¥. I Ã¶vrigt var det mycket av detsamma som dyker upp i varje applikation som skrivits.</p>\r\n\r\n<h2>Kmom 4</h3>\r\n<h3>PHP PDO</h3>\r\nPHP-PDO kÃ¤ndes till en bÃ¶rjan vÃ¤ldigt besvÃ¤rligt dÃ¥ det traditionella sÃ¤ttet sitter vÃ¤ldigt inÃ¶vat. FÃ¶rdelarna med PDO visade sig dick vÃ¤ldigt snabbt i den avsevÃ¤rt Ã¶kade lÃ¤sbarheten i databasfrÃ¥gorna.</p>\r\n\r\n<h3>Filmdatabasen</h3>\r\n<p>Jag gjorde inte Ã¶vningen fÃ¶r filmdatabasen. Jag lÃ¤ste igenom det hela och gick in nÃ¤rmare pÃ¥ de obekanta delarna, frÃ¤mst paginering.</p>\r\n\r\n<h3>Moduler och Klasser</h3>\r\n<p>Det bÃ¶rjar kÃ¤nnas allt bÃ¤ttre. I bÃ¶rjan var det ganska besvÃ¤rligt och bÃ¶kigt att gÃ¶ra det mesta, men allteftersom plattformen blev mer och mer stabil med allt fler Ã¥teranvÃ¤ndbara funktioner gick det hela tiden lÃ¤ttare och snabbare att lÃ¤gga till nÃ¥got nytt eller justera nÃ¥got sÃ¥ att det bÃ¤ttre Ã¶verensstÃ¤mmer med Ã¶vriga klasserna.</p>\r\n<p>FÃ¶rdelarna med klassindelningen Ã¤r att det snabbt gÃ¥r att hitta kÃ¤llkoden till de funktioner som strular och fÃ¶rbÃ¤ttra dessa utan att behÃ¶va Ã¤ndra hela den existerande plattformen. Ã…teranvÃ¤ndbarhet Ã¤r ett klart plus. En av nackdelarna Ã¤r att det kan bli en hel del extraarbete innan klassen bÃ¶rjar bli anvÃ¤ndbar och dÃ¤rmed tar lite lÃ¤ngre tid innan den blivit tidseffektiv.</p>\r\n\r\n',329,1413293322);
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

-- Dump completed on 2014-10-15 10:46:27
