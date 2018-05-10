CREATE TABLE `app_name` (
  `id` varchar(32) NOT NULL,
  `name` varchar(150) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `app_registered` datetime DEFAULT NULL,
  `app_validation` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `app_name` VALUES ('1233','appedusitesbr','Edusites BR','A edusites ofreekd','2017-10-10 11:00:21',NULL),('15412233','enqute','Edusites BR','A edusites ofreekd','2017-10-10 11:00:21',NULL);

CREATE TABLE `user` (
  `id` varchar(32) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `user_registered` datetime DEFAULT NULL COMMENT 'A data em que o usuário foi registrado\n',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` VALUES ('6ae94242ab40e7576ca6c104c762a5da','Eduardo Esteves','eduardostevesdasilva@hotmail.com',NULL),('e71b44a0f925772119ba7d4ade9ebe5c','Patricia Albbcaheicaea Okelolaman','ehldclprzy_1506554688@tfbnw.net',NULL);

CREATE TABLE `rule` (
  `id` varchar(32) NOT NULL,
  `description` varchar(45) NOT NULL COMMENT '1 é usuário contribuidor que pode criar enquete por exemplo e o 2 é admin acesso total',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `rule` VALUES ('50e913c3bad1ff2a9816712ca38830e4','administrador'),('aa7ecc47c8c25feea2622a9321716f1d','assinante');

CREATE TABLE `profile` (
  `id` varchar(32) NOT NULL,
  `sex` char(1) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `date_birth` date DEFAULT NULL,
  `rule_id` varchar(32) NOT NULL,
  `user_id` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_rule_id` (`rule_id`),
  KEY `idx_user_id` (`user_id`),
  CONSTRAINT `fk_table_rule` FOREIGN KEY (`rule_id`) REFERENCES `rule` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tableuser` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `table_field` (
  `id` varchar(32) NOT NULL,
  `field` varchar(255) NOT NULL COMMENT 'Tipo do campos e seus atributos como name, type, maxlength',
  `label` varchar(150) NOT NULL COMMENT 'Rotulo para o field criado',
  `is_multiple` tinyint(1) DEFAULT '0',
  `app_name_id` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_app_name_id` (`app_name_id`),
  CONSTRAINT `fk_table_app_name` FOREIGN KEY (`app_name_id`) REFERENCES `app_name` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `user_response` (
  `id` varchar(32) NOT NULL,
  `user_id` varchar(32) NOT NULL,
  `table_field_id` varchar(32) NOT NULL,
  `data` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_table_field_id` (`table_field_id`),
  KEY `idx_user_id` (`user_id`),
  CONSTRAINT `fk_table_table_field` FOREIGN KEY (`table_field_id`) REFERENCES `table_field` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_table_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

