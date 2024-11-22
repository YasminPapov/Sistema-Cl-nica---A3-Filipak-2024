-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/11/2024 às 02:40
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `clinica`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm`
--

CREATE TABLE `adm` (
  `id_adm` int(11) NOT NULL,
  `id_avaliacao_fisica` int(11) DEFAULT NULL,
  `articulacao` varchar(255) DEFAULT NULL,
  `movimento` varchar(255) DEFAULT NULL,
  `graus_movimento_direito` decimal(10,2) DEFAULT NULL,
  `graus_movimento_esquerdo` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacao`
--

CREATE TABLE `avaliacao` (
  `id_avaliacao` int(11) NOT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `data_avaliacao` date DEFAULT NULL,
  `queixa_principal` text DEFAULT NULL,
  `outras_queixas` text DEFAULT NULL,
  `comorbidades` text DEFAULT NULL,
  `medicamentos_uso_continuo` text DEFAULT NULL,
  `medicamentos_atuais` text DEFAULT NULL,
  `tratamentos_complementares` text DEFAULT NULL,
  `diagnostico_clinico` text DEFAULT NULL,
  `cid` text DEFAULT NULL,
  `historia_doenca_atual` text DEFAULT NULL,
  `historia_doenca_pregressa` text DEFAULT NULL,
  `antecedentes_cirurgicos` text DEFAULT NULL,
  `atividades_afetadas` text DEFAULT NULL,
  `fatores_ambientais` text DEFAULT NULL,
  `observacoes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacao_fisica`
--

CREATE TABLE `avaliacao_fisica` (
  `id_avaliacao_fisica` int(11) NOT NULL,
  `id_avaliacao` int(11) DEFAULT NULL,
  `postura_cabeca` varchar(255) DEFAULT NULL,
  `postura_ombro` varchar(255) DEFAULT NULL,
  `postura_clavicula` varchar(255) DEFAULT NULL,
  `postura_cotovelo` varchar(255) DEFAULT NULL,
  `postura_antebraco` varchar(255) DEFAULT NULL,
  `postura_maos` varchar(255) DEFAULT NULL,
  `postura_eias` varchar(255) DEFAULT NULL,
  `postura_joelhos` varchar(255) DEFAULT NULL,
  `postura_patelas` varchar(255) DEFAULT NULL,
  `postura_tornozelos` varchar(255) DEFAULT NULL,
  `postura_coluna_cervical` varchar(255) DEFAULT NULL,
  `postura_coluna_toracica` varchar(255) DEFAULT NULL,
  `postura_coluna_lombar` varchar(255) DEFAULT NULL,
  `inspecao_palapacao` text DEFAULT NULL,
  `informacoes_adm` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `forca_muscular`
--

CREATE TABLE `forca_muscular` (
  `id_forca_muscular` int(11) NOT NULL,
  `id_avaliacao_fisica` int(11) DEFAULT NULL,
  `grau_forca` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `id_notificacao` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `mensagem` text DEFAULT NULL,
  `lida` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `paciente`
--

CREATE TABLE `paciente` (
  `id_paciente` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `endereco` text DEFAULT NULL,
  `peso` decimal(10,2) DEFAULT NULL,
  `altura` decimal(10,2) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `idade` int(11) DEFAULT NULL,
  `genero` varchar(50) DEFAULT NULL,
  `estado_civil` varchar(50) DEFAULT NULL,
  `numero_gestacoes` int(11) DEFAULT NULL,
  `numero_filhos` int(11) DEFAULT NULL,
  `tipo_parto` varchar(50) DEFAULT NULL,
  `nivel_escolaridade` varchar(255) DEFAULT NULL,
  `profissao` varchar(255) DEFAULT NULL,
  `ocupacao` varchar(255) DEFAULT NULL,
  `condicao_fisica` varchar(255) DEFAULT NULL,
  `tabagista` varchar(50) DEFAULT NULL,
  `etilista` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `perimetria`
--

CREATE TABLE `perimetria` (
  `id_perimetria` int(11) NOT NULL,
  `id_avaliacao_fisica` int(11) DEFAULT NULL,
  `regiao` varchar(255) DEFAULT NULL,
  `medida_1` decimal(10,2) DEFAULT NULL,
  `medida_2` decimal(10,2) DEFAULT NULL,
  `medida_3` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `plano_terapeutico`
--

CREATE TABLE `plano_terapeutico` (
  `id_plano_terapeutico` int(11) NOT NULL,
  `id_avaliacao` int(11) DEFAULT NULL,
  `diagnostico_cinesiologico` text DEFAULT NULL,
  `objetivos_terapeuticos` text DEFAULT NULL,
  `conduta_fisioterapeutica` text DEFAULT NULL,
  `objetivos_paciente` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sensibilidade`
--

CREATE TABLE `sensibilidade` (
  `id_sensibilidade` int(11) NOT NULL,
  `id_avaliacao_fisica` int(11) DEFAULT NULL,
  `local` varchar(255) DEFAULT NULL,
  `sensibilidade_tatil_direito` tinyint(1) DEFAULT NULL,
  `sensibilidade_tatil_esquerdo` tinyint(1) DEFAULT NULL,
  `sensibilidade_dolorosa_direito` tinyint(1) DEFAULT NULL,
  `sensibilidade_dolorosa_esquerdo` tinyint(1) DEFAULT NULL,
  `sensibilidade_termica_direito` tinyint(1) DEFAULT NULL,
  `sensibilidade_termica_esquerdo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sessao`
--

CREATE TABLE `sessao` (
  `id_sessao` int(11) NOT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `id_aluno` int(11) DEFAULT NULL,
  `data_horario` datetime DEFAULT NULL,
  `anotacoes` text DEFAULT NULL,
  `arquivo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `testes_especiais`
--

CREATE TABLE `testes_especiais` (
  `id_teste_especial` int(11) NOT NULL,
  `id_avaliacao_fisica` int(11) DEFAULT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha_hash` varchar(255) DEFAULT NULL,
  `nivel_acesso` enum('Aluno','Professor','Administrador') NOT NULL,
  `id_professor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `senha_hash`, `nivel_acesso`, `id_professor`) VALUES
(8, 'henrique', 'henriquemiyahira32@gmail.com', '$2y$10$hr2.sbL2olO.AAqPosW/DOZo5NADICiZB9ZHO2559llY.r38DRMC.', 'Aluno', NULL),
(9, 'eita', 'chefia@gmail.com', '$2y$10$6cniogOYspJR7AJtpdxV9eQqiJIuDfSQXpnhlezuJbWFqj/WyYFMS', 'Professor', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `adm`
--
ALTER TABLE `adm`
  ADD PRIMARY KEY (`id_adm`),
  ADD KEY `id_avaliacao_fisica` (`id_avaliacao_fisica`);

--
-- Índices de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`id_avaliacao`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Índices de tabela `avaliacao_fisica`
--
ALTER TABLE `avaliacao_fisica`
  ADD PRIMARY KEY (`id_avaliacao_fisica`),
  ADD KEY `id_avaliacao` (`id_avaliacao`);

--
-- Índices de tabela `forca_muscular`
--
ALTER TABLE `forca_muscular`
  ADD PRIMARY KEY (`id_forca_muscular`),
  ADD KEY `id_avaliacao_fisica` (`id_avaliacao_fisica`);

--
-- Índices de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`id_notificacao`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Índices de tabela `perimetria`
--
ALTER TABLE `perimetria`
  ADD PRIMARY KEY (`id_perimetria`),
  ADD KEY `id_avaliacao_fisica` (`id_avaliacao_fisica`);

--
-- Índices de tabela `plano_terapeutico`
--
ALTER TABLE `plano_terapeutico`
  ADD PRIMARY KEY (`id_plano_terapeutico`),
  ADD KEY `id_avaliacao` (`id_avaliacao`);

--
-- Índices de tabela `sensibilidade`
--
ALTER TABLE `sensibilidade`
  ADD PRIMARY KEY (`id_sensibilidade`),
  ADD KEY `id_avaliacao_fisica` (`id_avaliacao_fisica`);

--
-- Índices de tabela `sessao`
--
ALTER TABLE `sessao`
  ADD PRIMARY KEY (`id_sessao`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_aluno` (`id_aluno`);

--
-- Índices de tabela `testes_especiais`
--
ALTER TABLE `testes_especiais`
  ADD PRIMARY KEY (`id_teste_especial`),
  ADD KEY `id_avaliacao_fisica` (`id_avaliacao_fisica`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_professor` (`id_professor`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adm`
--
ALTER TABLE `adm`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `avaliacao_fisica`
--
ALTER TABLE `avaliacao_fisica`
  MODIFY `id_avaliacao_fisica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `forca_muscular`
--
ALTER TABLE `forca_muscular`
  MODIFY `id_forca_muscular` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id_notificacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `perimetria`
--
ALTER TABLE `perimetria`
  MODIFY `id_perimetria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `plano_terapeutico`
--
ALTER TABLE `plano_terapeutico`
  MODIFY `id_plano_terapeutico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sensibilidade`
--
ALTER TABLE `sensibilidade`
  MODIFY `id_sensibilidade` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sessao`
--
ALTER TABLE `sessao`
  MODIFY `id_sessao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `testes_especiais`
--
ALTER TABLE `testes_especiais`
  MODIFY `id_teste_especial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `adm`
--
ALTER TABLE `adm`
  ADD CONSTRAINT `adm_ibfk_1` FOREIGN KEY (`id_avaliacao_fisica`) REFERENCES `avaliacao_fisica` (`id_avaliacao_fisica`);

--
-- Restrições para tabelas `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `avaliacao_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`);

--
-- Restrições para tabelas `avaliacao_fisica`
--
ALTER TABLE `avaliacao_fisica`
  ADD CONSTRAINT `avaliacao_fisica_ibfk_1` FOREIGN KEY (`id_avaliacao`) REFERENCES `avaliacao` (`id_avaliacao`);

--
-- Restrições para tabelas `forca_muscular`
--
ALTER TABLE `forca_muscular`
  ADD CONSTRAINT `forca_muscular_ibfk_1` FOREIGN KEY (`id_avaliacao_fisica`) REFERENCES `avaliacao_fisica` (`id_avaliacao_fisica`);

--
-- Restrições para tabelas `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD CONSTRAINT `notificacoes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Restrições para tabelas `perimetria`
--
ALTER TABLE `perimetria`
  ADD CONSTRAINT `perimetria_ibfk_1` FOREIGN KEY (`id_avaliacao_fisica`) REFERENCES `avaliacao_fisica` (`id_avaliacao_fisica`);

--
-- Restrições para tabelas `plano_terapeutico`
--
ALTER TABLE `plano_terapeutico`
  ADD CONSTRAINT `plano_terapeutico_ibfk_1` FOREIGN KEY (`id_avaliacao`) REFERENCES `avaliacao` (`id_avaliacao`);

--
-- Restrições para tabelas `sensibilidade`
--
ALTER TABLE `sensibilidade`
  ADD CONSTRAINT `sensibilidade_ibfk_1` FOREIGN KEY (`id_avaliacao_fisica`) REFERENCES `avaliacao_fisica` (`id_avaliacao_fisica`);

--
-- Restrições para tabelas `sessao`
--
ALTER TABLE `sessao`
  ADD CONSTRAINT `sessao_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`),
  ADD CONSTRAINT `sessao_ibfk_2` FOREIGN KEY (`id_aluno`) REFERENCES `usuarios` (`id_usuario`);

--
-- Restrições para tabelas `testes_especiais`
--
ALTER TABLE `testes_especiais`
  ADD CONSTRAINT `testes_especiais_ibfk_1` FOREIGN KEY (`id_avaliacao_fisica`) REFERENCES `avaliacao_fisica` (`id_avaliacao_fisica`);

--
-- Restrições para tabelas `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_professor`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
