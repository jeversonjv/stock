-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Set-2020 às 19:29
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `stock`
--

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `usuario_id`, `nome`, `descricao`, `data_cadastro`) VALUES
(1, 1, 'Esportes', 'Tênis para praticar esportes', '2020-09-26 19:21:43'),
(2, 1, 'Dia a dia', 'Calçados para o dia a dia', '2020-09-26 19:22:07');

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`cliente_id`, `usuario_id`, `nome`, `email`, `data_nascimento`, `sexo`, `telefone`, `celular`, `rg`, `cpf`, `cep`, `endereco`, `bairro`, `numero`, `cidade`, `complemento`, `estado`, `data_cadastro`) VALUES
(1, 1, 'Jeverson', 'jeversontp@gmail.com', '1999-09-16', 'M', '(35) 3265-1454', '(35) 98448-9589', 'MG-124549888', '154.848.955-74', '37190-000', 'Rua', 'Bairro', 123, 'Três Pontas', 'Casa', 'MG', '2020-09-26 19:17:15'),
(2, 1, 'João', 'joao@gmail.com', '1968-12-05', 'M', '(35) 3215-4446', '(35) 98478-8899', 'MG988897', '145.858.487-90', '37190-000', 'Rua', 'Bairro', 12, 'Três Pontas', 'Casa', 'MG', '2020-09-26 19:18:26'),
(3, 1, 'Maria', 'maria@gmail.com', '1973-05-25', 'F', '(35) 2122-5544', '(35) 94587-8888', 'MG457888549', '154.587.999-85', '37190-000', 'Rua', 'Bairro', 21, 'Três Pontas', 'Casa', 'MG', '2020-09-26 19:19:08');

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`fornecedor_id`, `usuario_id`, `nome`, `email`, `telefone`, `celular`, `cnpj`, `cep`, `endereco`, `bairro`, `numero`, `cidade`, `complemento`, `estado`, `data_cadastro`) VALUES
(1, 1, 'Marcao', 'marcao@gmail.com', '(35) 3212-4547', '(35) 36622-2154', '18.777.988/8959-55', '37190-000', 'Rua', 'Bairro', 21, 'Três Pontas', 'Casa', 'MG', '2020-09-26 19:19:56'),
(2, 1, 'Solotov', 'solotov@gmail.com', '(35) 3215-4498', '(35) 98777-8777', '11.245.444/4877-79', '37190-000', 'Rua', 'Bairro', 21, 'Três Pontas', 'Casa', 'MG', '2020-09-26 19:20:50');

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`produto_id`, `usuario_id`, `categoria_id`, `fornecedor_id`, `nome`, `descricao`, `peso_liquido`, `peso_bruto`, `preco_venda`, `preco_custo`, `estoque`, `observacao`, `data_cadastro`) VALUES
(1, 1, 1, 1, 'Nike SB', NULL, 0.8, 0.8, 280, 190, 10, NULL, '2020-09-26 19:23:37'),
(2, 1, 2, 2, 'Nike Revolution 5', NULL, 0.8, 0.8, 180, 120, 5, NULL, '2020-09-26 19:24:19');

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `nome`, `email`, `senha`, `data_cadastro`, `ativo`) VALUES
(1, 'Jeverson', 'jeversontp@gmail.com', '$2y$10$Q5LYv21xijTszwoxk3Z9Aucv8Ln31Uw8iQ4QU5XvNHhc44KZtxnOq', '2020-09-25 21:57:41', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
