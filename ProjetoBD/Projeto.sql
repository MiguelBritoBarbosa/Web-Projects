CREATE DATABASE cartao;
USE cartao;


CREATE TABLE `cartao`.`cliente` (
  `idCliente` INT NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(45) NOT NULL,
  `Celular` VARCHAR(45) NOT NULL,
  `Email` VARCHAR(45) NOT NULL,
  `cpf` VARCHAR(45) NOT NULL,
  `SerasaScore` INT NOT NULL,
  `Salario` FLOAT NOT NULL,
  PRIMARY KEY (`idCliente`));


CREATE TABLE `cartao`.`cartaocliente` (
  `idCartaoCliente` INT NOT NULL AUTO_INCREMENT,
  `IdCliente` INT NOT NULL,
  `CardNumber` VARCHAR(45) NOT NULL,
  `SecurityCode` INT NOT NULL,
  `MemberSince` VARCHAR(45) NOT NULL,
  `ValidThru` VARCHAR(45) NOT NULL,
  `Limite` float not null,
  `LimiteVermelho` float not null,
  PRIMARY KEY (`idCartaoCliente`),
    FOREIGN KEY (`IdCliente`) REFERENCES `cartao`.`cliente` (`idCliente`)
);
