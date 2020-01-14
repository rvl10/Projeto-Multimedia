-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 14-Jan-2020 às 02:06
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
-- Database: `projeto_multimedia`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

DROP TABLE IF EXISTS `carrinho`;
CREATE TABLE IF NOT EXISTS `carrinho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `Utilizador_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`Utilizador_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_Carro_Utilizador1_idx` (`Utilizador_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho_produto`
--

DROP TABLE IF EXISTS `carrinho_produto`;
CREATE TABLE IF NOT EXISTS `carrinho_produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `preco_unitario` decimal(5,2) NOT NULL,
  `quantidade` decimal(3,0) NOT NULL,
  `Carro_id` int(11) NOT NULL,
  `Produto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`Carro_id`,`Produto_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_carro/produto_Carro1_idx` (`Carro_id`),
  KEY `fk_carro/produto_Produto1_idx` (`Produto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra`
--

DROP TABLE IF EXISTS `compra`;
CREATE TABLE IF NOT EXISTS `compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime NOT NULL,
  `preco_total` decimal(5,0) NOT NULL,
  `iva` decimal(5,0) NOT NULL,
  `transporte` decimal(5,0) NOT NULL,
  `nome` varchar(250) DEFAULT NULL,
  `nif` decimal(15,0) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `localidade` varchar(45) DEFAULT NULL,
  `cod_postal` varchar(45) DEFAULT NULL,
  `morada` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra_produto`
--

DROP TABLE IF EXISTS `compra_produto`;
CREATE TABLE IF NOT EXISTS `compra_produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `preco_unitario` decimal(5,2) DEFAULT NULL,
  `Compra_id` int(11) NOT NULL,
  `Produto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`Compra_id`,`Produto_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_compra/produto_Compra_idx` (`Compra_id`),
  KEY `fk_compra/produto_Produto1_idx` (`Produto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `duvidas`
--

DROP TABLE IF EXISTS `duvidas`;
CREATE TABLE IF NOT EXISTS `duvidas` (
  `idDuvidas` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) DEFAULT NULL,
  `assunto` varchar(45) DEFAULT NULL,
  `mensagem` varchar(555) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idDuvidas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem`
--

DROP TABLE IF EXISTS `imagem`;
CREATE TABLE IF NOT EXISTS `imagem` (
  `idImagem` int(11) NOT NULL AUTO_INCREMENT,
  `nome` longblob NOT NULL,
  `Produto_id` int(11) NOT NULL,
  PRIMARY KEY (`idImagem`,`Produto_id`),
  UNIQUE KEY `idImagem_UNIQUE` (`idImagem`),
  KEY `fk_Imagem_Produto1_idx` (`Produto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `preco` double(9,2) NOT NULL,
  `descricao` varchar(700) NOT NULL,
  `Categoria_id` int(11) NOT NULL,
  `Sub_categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`Categoria_id`,`Sub_categoria_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_Produto_Tipos_Produto1_idx` (`Categoria_id`),
  KEY `fk_Produto_Sub_categoria1_idx` (`Sub_categoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sub_categoria`
--

DROP TABLE IF EXISTS `sub_categoria`;
CREATE TABLE IF NOT EXISTS `sub_categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_utilizador`
--

DROP TABLE IF EXISTS `tipo_utilizador`;
CREATE TABLE IF NOT EXISTS `tipo_utilizador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_utilizador`
--

INSERT INTO `tipo_utilizador` (`id`, `nome`) VALUES
(1, 'Admin'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

DROP TABLE IF EXISTS `utilizador`;
CREATE TABLE IF NOT EXISTS `utilizador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilizador` varchar(45) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `nif` int(11) NOT NULL,
  `data_nascimento` date NOT NULL,
  `morada` varchar(200) NOT NULL,
  `localidade` varchar(45) NOT NULL,
  `codigo_postal` varchar(9) DEFAULT NULL,
  `Tipo_Utilizador_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`Tipo_Utilizador_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_Utilizador_Tipo_Utilizador1_idx` (`Tipo_Utilizador_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `utilizador`
--

INSERT INTO `utilizador` (`id`, `utilizador`, `password`, `nome`, `email`, `telefone`, `nif`, `data_nascimento`, `morada`, `localidade`, `codigo_postal`, `Tipo_Utilizador_id`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@admin.pt', '23423421212', 1231231, '2020-01-08', 'asxa', 'ax', '5300-660', 1);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `fk_Carro_Utilizador1` FOREIGN KEY (`Utilizador_id`) REFERENCES `utilizador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `carrinho_produto`
--
ALTER TABLE `carrinho_produto`
  ADD CONSTRAINT `fk_carro/produto_Carro1` FOREIGN KEY (`Carro_id`) REFERENCES `carrinho` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_carro/produto_Produto1` FOREIGN KEY (`Produto_id`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `compra_produto`
--
ALTER TABLE `compra_produto`
  ADD CONSTRAINT `fk_compra/produto_Compra` FOREIGN KEY (`Compra_id`) REFERENCES `compra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compra/produto_Produto1` FOREIGN KEY (`Produto_id`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `imagem`
--
ALTER TABLE `imagem`
  ADD CONSTRAINT `fk_Imagem_Produto1` FOREIGN KEY (`Produto_id`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_Produto_Sub_categoria1` FOREIGN KEY (`Sub_categoria_id`) REFERENCES `sub_categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Produto_Tipos_Produto1` FOREIGN KEY (`Categoria_id`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `utilizador`
--
ALTER TABLE `utilizador`
  ADD CONSTRAINT `fk_Utilizador_Tipo_Utilizador1` FOREIGN KEY (`Tipo_Utilizador_id`) REFERENCES `tipo_utilizador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
