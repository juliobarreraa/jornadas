DROP TABLE IF EXISTS `#__jornadas`;
 
CREATE TABLE `#__jornadas` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `updated_at` int(10) DEFAULT NULL,
  `created_at` int(10) NOT NULL,
   PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
 
INSERT INTO `#__jornadas` (`name`, `created_at`) VALUES
        ('Futbol Mexicano', UNIX_TIMESTAMP(now())),
        ('Futbol Español', UNIX_TIMESTAMP(now()));