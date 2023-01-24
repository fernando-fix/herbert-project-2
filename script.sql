-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Jan-2023 às 17:46
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ativos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `grouplvls`
--

CREATE TABLE `grouplvls` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `grouplvls`
--

INSERT INTO `grouplvls` (`id`, `name`) VALUES
(1, 'Consulta'),
(2, 'Movimentação'),
(3, 'Cadastro'),
(4, 'Administrador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `detail` text NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `patrimony` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `last_mov` datetime NOT NULL,
  `id_sector` int(11) NOT NULL,
  `id_resp_mov` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sectors`
--

CREATE TABLE `sectors` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `responsible` varchar(70) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `grouplvl` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `grouplvl`, `password`, `token`, `avatar`) VALUES
(1, 'Consulta', 'consulta@email.com', 1, '$2y$10$A.V0iDHMjI.uwFfDGU.ghOu.cqW8EuiEhQ5.OXGaNvTX4UXx6sRpO', '5f9ba033f3562dc3fba8915eeacf0b91', 'default.jpg'),
(2, 'Movimentação', 'movimenta@email.com', 2, '$2y$10$A.V0iDHMjI.uwFfDGU.ghOu.cqW8EuiEhQ5.OXGaNvTX4UXx6sRpO', '8f848e36438ae5a7fc61aaf36805a64d', 'default.jpg'),
(3, 'Cadastro', 'cadastro@email.com', 3, '$2y$10$A.V0iDHMjI.uwFfDGU.ghOu.cqW8EuiEhQ5.OXGaNvTX4UXx6sRpO', '9f9f35c86916079a42b7883bc1ae45c0', 'default.jpg'),
(4, 'Administrador', 'adm@email.com', 4, '$2y$10$A.V0iDHMjI.uwFfDGU.ghOu.cqW8EuiEhQ5.OXGaNvTX4UXx6sRpO', '260baa4e0f207a76605e24c24d4e1104', 'default.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `grouplvls`
--
ALTER TABLE `grouplvls`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sectors`
--
ALTER TABLE `sectors`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `grouplvls`
--
ALTER TABLE `grouplvls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sectors`
--
ALTER TABLE `sectors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
