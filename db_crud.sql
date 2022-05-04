CREATE DATABASE `db_crud`;
CREATE TABLE `db_crud`.`person` ( `id` INT NOT NULL AUTO_INCREMENT , `nome` VARCHAR(255) NOT NULL , `sobrenome` VARCHAR(255) NOT NULL , `dtnascimento` VARCHAR(12) NOT NULL , `telefone` VARCHAR(13) NOT NULL , `celular` VARCHAR(13) NOT NULL , `email` VARCHAR(45) NOT NULL, PRIMARY KEY (`id`) ) ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_unicode_ci;
CREATE TABLE `db_crud`.`enterprise` ( `fk_id` INT NOT NULL , `nomeEmp` VARCHAR(255) NOT NULL , PRIMARY KEY (`fk_id`)) ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_unicode_ci;
