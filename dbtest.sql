CREATE DATABASE IF NOT EXISTS apidbmanager;
USE apidbmanager;

drop table IF EXISTS `cliente`;
drop table IF EXISTS `vendedor`;

CREATE TABLE IF NOT EXISTS `vendedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isadmin` int(1) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sobrenome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)

);

CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `produto` varchar(255),
  `observacao` varchar(255),
  `flag` BOOLEAN NOT NULL,
  `valordesejado` int(8),
  `desconto` int(11),
  `telefone` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `alertdate` datetime NOT NULL,
  `vendedorid` int(255),
  `updated_at` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (vendedorid) REFERENCES vendedor(id)
);

INSERT INTO `vendedor` (`id`, `isadmin`, `name`, `email`, `password`) VALUES
(1, 1, 'joao', 'admin@admin.com', '123456'),
(2, 0, 'carlos', 'vendedor@vendedor.com', '123456'),
(3, 0, 'lucas', 'nsdffjnsdo@sjfoosd.com', '123456');

INSERT INTO `cliente` (`id`, `name`, `produto`, `telefone`, `created`,`observacao`,`flag`,`valordesejado`,`desconto`,`vendedorid`) VALUES
(1, 'maria', 's20', '483838383', '2019-05-31 17:12:26','llaczxzxczx',1,2500,500,1),
(3, 'camila', 's50', '51985623245', '2019-05-31 17:12:26','zczxcxzc',0,500,150,2),
(2, 'jose','s40', '838384949', '2019-05-31 17:12:26','zxczxczx',0,1500,100,3);