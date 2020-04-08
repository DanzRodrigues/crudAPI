-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 08-Abr-2020 às 08:20
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_api`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `CPF` varchar(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `sobrenome` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  PRIMARY KEY (`CPF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`CPF`, `nome`, `sobrenome`, `email`) VALUES
('15889745425', 'Wagner', 'Almeida', 'wagnera@lumen.br');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

DROP TABLE IF EXISTS `funcionario`;
CREATE TABLE IF NOT EXISTS `funcionario` (
  `CPF` varchar(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `salario` float NOT NULL,
  `api_key` text,
  PRIMARY KEY (`CPF`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`CPF`, `nome`, `email`, `senha`, `salario`, `api_key`) VALUES
('12512345442', 'Fabio', 'danielr@live.com', '123', 600, ''),
('16315889743', 'Daniel', 'daniel@live.com', '123', 600, 'VFRBNmtTQUc1UERjbXlTcndUOVFsMmQ0ejh5MGVhRWNJTE40akNoZw==');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `cod` varchar(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `categoria` varchar(30) NOT NULL,
  `preco` double NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`cod`, `nome`, `categoria`, `preco`) VALUES
('12345678910', 'Martelo', 'ferramentas', 20),
('12345678912', 'Prego', 'ferramentas', 0.5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `registro_venda`
--

DROP TABLE IF EXISTS `registro_venda`;
CREATE TABLE IF NOT EXISTS `registro_venda` (
  `cod_venda` int(11) NOT NULL AUTO_INCREMENT,
  `id_func` varchar(11) NOT NULL,
  `id_clien` varchar(11) NOT NULL,
  `id_prod` varchar(11) NOT NULL,
  PRIMARY KEY (`cod_venda`),
  KEY `venda_clien` (`id_clien`),
  KEY `venda_func` (`id_func`),
  KEY `venda_prod` (`id_prod`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `registro_venda`
--

INSERT INTO `registro_venda` (`cod_venda`, `id_func`, `id_clien`, `id_prod`) VALUES
(1, '16315889743', '15889745425', '12345678910'),
(2, '12512345442', '15889745425', '12345678912');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `registro_venda`
--
ALTER TABLE `registro_venda`
  ADD CONSTRAINT `venda_clien` FOREIGN KEY (`id_clien`) REFERENCES `cliente` (`CPF`),
  ADD CONSTRAINT `venda_func` FOREIGN KEY (`id_func`) REFERENCES `funcionario` (`CPF`),
  ADD CONSTRAINT `venda_prod` FOREIGN KEY (`id_prod`) REFERENCES `produto` (`cod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
