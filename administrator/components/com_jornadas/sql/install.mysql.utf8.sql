DROP TABLE IF EXISTS `#__jornadas`;
 
CREATE TABLE `#__jornadas` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `updated_at` int(10) DEFAULT NULL,
  `created_at` int(10) NOT NULL,
   PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
 
--INSERT INTO `#__jornadas` (`name`, `created_at`) VALUES ('Futbol Mexicano', UNIX_TIMESTAMP(now())), ('Futbol Español', UNIX_TIMESTAMP(now()));

DROP TABLE IF EXISTS `#__teams`;

CREATE TABLE `#__teams` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `updated_at` int(10) DEFAULT NULL,
  `created_at` int(10) NOT NULL,
   PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
 
--INSERT INTO `#__teams` (`name`, `created_at`) VALUES ('Cruz Azul', UNIX_TIMESTAMP(now())),('Chivas', UNIX_TIMESTAMP(now()));

DROP TABLE IF EXISTS `#__jornada_teams`;

CREATE TABLE `#__jornada_teams` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `jornada_id` int(10) unsigned NOT NULL,
  `team_first_id` int(10) unsigned NOT NULL,
  `team_second_id` int(10) unsigned NOT NULL,
  `team_first_score` smallint unsigned DEFAULT NULL,
  `team_second_score` smallint unsigned DEFAULT NULL,
  `updated_at` int(10) DEFAULT NULL,
  `created_at` int(10) NOT NULL,
   PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
 
--INSERT INTO `#__jornada_teams` (`jornada_id`, `team_first_id`, `team_second_id`, `team_first_score`, `team_second_score`, `created_at`) VALUES (1, 1, 2, 4, 5, UNIX_TIMESTAMP(now()));

