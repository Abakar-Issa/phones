CREATE TABLE `phone` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`nom` varchar(255) DEFAULT NULL,
  `marque` varchar(255) DEFAULT NULL,
  `modele` varchar(255) DEFAULT NULL,
  `categorie` varchar(255) DEFAULT NULL,
  `systemeExploitation` varchar(255) DEFAULT NULL,
  `paysDeFabrication` varchar(255) DEFAULT NULL,
  `anneeDeSortie` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `stockage` int(11) NOT NULL,
  `RAM` int(11) NOT NULL,
  `dureeBatterie` int(11) NOT NULL,
  `tailleEcran` int(11) NOT NULL,
  `couleur` varchar(255) DEFAULT NULL,
  `id_account` varchar(50) NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (id_account) REFERENCES account (login)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;


LOCK TABLES `phone` WRITE;
INSERT INTO `phone` VALUES (1,'Samsung Galaxy J4 CORE','Samsung','Galaxy J4 CORE','SmartPhone','Android','France',2018,180,16,1,3300,6,'gris, bleu, noir',NULL),(2,'iPhone Galaxy s6','iPhone','Galaxy s6','SmartPhone','iOS','États-Unis',2015,300,32,3,2600,7,'noir, gris',NULL),(3,'Huawei p30 Pro','Huawei','p30 Pro','SmartPhone','iOS','États-Unis',2019,530,4200,256,8,6,'rouge, rose, bleu, noir',NULL);
UNLOCK TABLES;

