CREATE TABLE `account` (
  `name` varchar(255) DEFAULT NULL,
  `login` varchar(50) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `isAdmin` boolean DEFAULT false,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

#LOCK TABLES `account0` WRITE;
#INSERT INTO `account0` VALUES ('vanier','vanier','toto',false),('lecarpentier','lecarpentier','toto',false),('admin','admin','toto',true);
#UNLOCK TABLES;

