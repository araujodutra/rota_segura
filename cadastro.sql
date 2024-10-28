CREATE TABLE `usuario` (
  `idUsuario` int NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `login_UNIQUE` (`login`)
);