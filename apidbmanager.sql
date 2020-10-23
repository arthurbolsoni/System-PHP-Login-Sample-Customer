-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Jun-2020 às 01:01
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `apidbmanager`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `produto` varchar(255) DEFAULT NULL,
  `observacao` varchar(255) DEFAULT NULL,
  `flag` tinyint(1) NOT NULL,
  `valordesejado` int(8) DEFAULT NULL,
  `desconto` int(11) DEFAULT NULL,
  `telefone` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `alertdate` datetime NOT NULL,
  `vendedorid` int(255) DEFAULT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `name`, `produto`, `observacao`, `flag`, `valordesejado`, `desconto`, `telefone`, `created`, `alertdate`, `vendedorid`, `updated_at`, `created_at`) VALUES
(1, 'maria', 's20', 'llaczxzxczx', 1, 2500, 500, '483838383', '2019-05-31 17:12:26', '0000-00-00 00:00:00', 1, '', ''),
(2, 'jose', 's40', 'zxczxczx', 0, 1500, 100, '838384949', '2019-05-31 17:12:26', '0000-00-00 00:00:00', 3, '', ''),
(3, 'camila', 's50', 'zczxcxzc', 0, 500, 150, '51985623245', '2019-05-31 17:12:26', '0000-00-00 00:00:00', 2, '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendedor`
--

CREATE TABLE `vendedor` (
  `id` int(11) NOT NULL,
  `isadmin` int(1) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sobrenome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `vendedor`
--

INSERT INTO `vendedor` (`id`, `isadmin`, `name`, `sobrenome`, `email`, `password`, `updated_at`, `created_at`) VALUES
(1, 1, 'joao', '', 'admin@admin.com', '$2y$10$TbNG1ta.NxPwO07swahUoOzVESCQGOAYvANDbx19.mAjEHb35GR9W', '', ''),
(2, 1, 'carlos', '', 'vendedor@vendedor.com', '123456', '', ''),
(3, 0, 'lucas', '', 'nsdffjnsdo@sjfoosd.com', '123456', '', ''),
(7, 1, 'maria', 'maria', 'maria@maria.com', '$2y$10$WBKCfME.Xp2zD0znDC58aeXVv.WwSRWVN27nThPM3lehUY9yzMuqC', '2020-06-30 00:59:10', '2020-06-30 00:59:10');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendedorid` (`vendedorid`);

--
-- Índices para tabela `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`vendedorid`) REFERENCES `vendedor` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
