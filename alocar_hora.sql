-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Maio-2023 às 03:43
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `alocar_hora`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `atribuicao`
--

CREATE TABLE `atribuicao` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `empresa_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `atribuicao`
--

INSERT INTO `atribuicao` (`id`, `usuario_id`, `empresa_id`) VALUES
(32, 34, 21),
(33, 34, 24),
(34, 34, 22);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados`
--

CREATE TABLE `dados` (
  `id` int(10) UNSIGNED NOT NULL,
  `empresa` varchar(100) DEFAULT NULL,
  `alocacao` varchar(50) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `departamento` varchar(50) DEFAULT NULL,
  `mes` varchar(50) DEFAULT NULL,
  `dia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `dados`
--

INSERT INTO `dados` (`id`, `empresa`, `alocacao`, `hora`, `departamento`, `mes`, `dia`) VALUES
(656, 'Basilio', 'Márcio Henrique', '10:20:00', 'Contabilidade', 'Janeiro', 1),
(657, '2R Empreendimentos e Participações Ltda', 'Márcio Henrique', '02:01:00', 'Contabilidade', 'Janeiro', 1),
(658, '2R Empreendimentos e Participações Ltda', 'Márcio Henrique', '01:02:00', 'Contabilidade', 'Julho', 10),
(659, 'Alex Kalinski Bayer', 'Aline Neves', '05:30:00', 'Contabilidade', 'Janeiro', 1),
(660, 'Alex Kalinski Bayer', 'Aline Neves', '06:21:00', 'Contabilidade', 'Janeiro', 2),
(661, 'Alex Kalinski Bayer', 'Aline Neves', '07:22:00', 'Contabilidade', 'Janeiro', 3),
(662, 'Alex Kalinski Bayer', 'Aline Neves', '08:23:00', 'Contabilidade', 'Janeiro', 4),
(663, 'Alex Kalinski Bayer', 'Aline Neves', '09:24:00', 'Contabilidade', 'Janeiro', 5),
(664, 'Alex Kalinski Bayer', 'Aline Neves', '10:25:00', 'Contabilidade', 'Janeiro', 6),
(665, 'Alex Kalinski Bayer', 'Aline Neves', '11:26:00', 'Contabilidade', 'Janeiro', 7),
(666, 'Alex Kalinski Bayer', 'Aline Neves', '12:27:00', 'Contabilidade', 'Janeiro', 10),
(667, 'AC&KL Vinhos', 'Aline Neves', '05:30:00', 'Contabilidade', 'Janeiro', 11),
(668, 'AC&KL Vinhos', 'Aline Neves', '10:20:00', 'Contabilidade', 'Janeiro', 7),
(669, 'Alex Kalinski Bayer', 'Aline Neves', '05:30:00', 'Contabilidade', 'Fevereiro', 1),
(670, 'Alex Kalinski Bayer', 'Aline Neves', '06:21:00', 'Contabilidade', 'Fevereiro', 2),
(671, 'Alex Kalinski Bayer', 'Aline Neves', '07:22:00', 'Contabilidade', 'Fevereiro', 3),
(672, 'Alex Kalinski Bayer', 'Aline Neves', '08:23:00', 'Contabilidade', 'Fevereiro', 4),
(673, 'Alex Kalinski Bayer', 'Aline Neves', '09:24:00', 'Contabilidade', 'Fevereiro', 5),
(674, 'Alex Kalinski Bayer', 'Aline Neves', '10:25:00', 'Contabilidade', 'Fevereiro', 6),
(675, 'Alex Kalinski Bayer', 'Aline Neves', '11:26:00', 'Contabilidade', 'Fevereiro', 7),
(676, 'Alex Kalinski Bayer', 'Aline Neves', '12:27:00', 'Contabilidade', 'Fevereiro', 10),
(677, 'AC&KL Vinhos', 'Aline Neves', '05:30:00', 'Contabilidade', 'Fevereiro', 11),
(678, 'AC&KL Vinhos', 'Aline Neves', '10:20:00', 'Contabilidade', 'Fevereiro', 7),
(679, 'Basilio', 'Aline Neves', '05:10:00', 'Contabilidade', 'Fevereiro', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`id`, `nome`) VALUES
(21, '2R Empreendimentos e Participações Ltda'),
(22, 'INIEC - INSTITUTO INTERNACIONAL DE EDUCAÇÃO CONTINUADA - EIRELI'),
(24, 'Basilio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fechamento`
--

CREATE TABLE `fechamento` (
  `id` int(10) UNSIGNED NOT NULL,
  `empresa_id` int(10) UNSIGNED DEFAULT NULL,
  `usuario_id` int(10) UNSIGNED DEFAULT NULL,
  `status_id` int(10) UNSIGNED DEFAULT NULL,
  `mes` varchar(1000) DEFAULT NULL,
  `comentario` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `fechamento`
--

INSERT INTO `fechamento` (`id`, `empresa_id`, `usuario_id`, `status_id`, `mes`, `comentario`) VALUES
(1, 21, 34, 3, 'Janeiro', 'Ainda não há Atualização'),
(2, 22, 34, 3, 'Janeiro', 'Ainda não há Atualização'),
(3, 24, 34, 3, 'Janeiro', 'Ainda não há Atualização');

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE `status` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`id`, `tipo`) VALUES
(1, 'Pendente'),
(2, 'Bloqueado'),
(3, 'N/A'),
(4, 'Revisão'),
(5, 'Enviado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `profile` varchar(1) DEFAULT NULL,
  `departamento` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `name`, `lastname`, `password`, `email`, `token`, `profile`, `departamento`) VALUES
(34, 'Márcio', 'Henrique', '123', 'marcio.henrique@dlgconsult.com', 'db07f1b0a17abe9f1aab86fe38faa053018d7503d958577da0a939cb3ba59113c397ee37ce6d65296aabcb0e53f53bfa2fda', '1', 'Fiscal'),
(58, 'Ryan', 'Batista', '123', 'ryan.batista@dlgconsult.com', '1a1db7823667a40e3531ad211c7671054da468d41fcf98cd68375494b561780e1a6f9dccc4d70266d6ee912995ecc219d774', '2', 'Contabilidade'),
(59, 'Aline', 'Neves', '123', 'aline.neves@dlgconsult.com', '74b01b6bc2cd7247cd7ee0f935628a3d4079895fe49d9c8e473a7e6cfdceec3945531325f913e527d49c15c59f57f7cd4e2f', '2', 'Contabilidade'),
(60, 'tet', 'tete', '123', 'teste@dlgconsult.com', 'd42050a42f163158569a72288c3fd9d01d24b52d69c972d9de6d3b7ff255196c3ce8982790c058e52b1b1722fee869b3fc65', '2', 'Contabilidade');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `atribuicao`
--
ALTER TABLE `atribuicao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `empresa_id` (`empresa_id`);

--
-- Índices para tabela `dados`
--
ALTER TABLE `dados`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `fechamento`
--
ALTER TABLE `fechamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empresa_id` (`empresa_id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Índices para tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atribuicao`
--
ALTER TABLE `atribuicao`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `dados`
--
ALTER TABLE `dados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=680;

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `fechamento`
--
ALTER TABLE `fechamento`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `atribuicao`
--
ALTER TABLE `atribuicao`
  ADD CONSTRAINT `atribuicao_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `atribuicao_ibfk_2` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`);

--
-- Limitadores para a tabela `fechamento`
--
ALTER TABLE `fechamento`
  ADD CONSTRAINT `fechamento_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`),
  ADD CONSTRAINT `fechamento_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `fechamento_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
