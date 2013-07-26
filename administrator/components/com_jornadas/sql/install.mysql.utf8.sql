DROP TABLE IF EXISTS `#__jornadas`;
 
CREATE TABLE `#__jornadas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `updated_at` int(10) DEFAULT NULL,
  `created_at` int(10) NOT NULL
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
 
INSERT INTO `#__jornadas` (`name`, `created_at`) VALUES
        ('Futbol Mexicano', time()),
        ('Futbol Español', time());