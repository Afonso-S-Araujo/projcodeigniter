-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Maio-2023 às 11:51
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projcodeigniter`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `consultas`
--

CREATE TABLE `consultas` (
  `id` int(11) NOT NULL,
  `idmedico` int(11) NOT NULL,
  `idutente` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 =ativo; 0 = encerrado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `consultas`
--

INSERT INTO `consultas` (`id`, `idmedico`, `idutente`, `data`, `hora`, `estado`) VALUES
(1, 4, 1, '2023-05-24', '00:00:00', 1),
(2, 5, 2, '2023-05-25', '00:00:00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `consultas_enfermeiros`
--

CREATE TABLE `consultas_enfermeiros` (
  `idconsulta` int(11) NOT NULL,
  `idenfermeiro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `consultas_enfermeiros`
--

INSERT INTO `consultas_enfermeiros` (`idconsulta`, `idenfermeiro`) VALUES
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `enfermeiros`
--

CREATE TABLE `enfermeiros` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `especialidade` varchar(80) NOT NULL,
  `nif` int(9) NOT NULL,
  `nib` varchar(25) NOT NULL,
  `idMorada` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `enfermeiros`
--

INSERT INTO `enfermeiros` (`id`, `nome`, `especialidade`, `nif`, `nib`, `idMorada`, `idUser`) VALUES
(2, 'Dorita Sousa', 'Pediatria', 987654377, '318208674707166184089', 3, 3),
(3, 'Marta gouveia', 'Pediatria', 987654377, '318208674707166184089', 3, NULL),
(19, 'Rui Alves', 'Cardiologia', 123456789, '987654321098765432109', 1, NULL),
(20, 'Ana Pereira', 'Ortopedia', 987654321, '123456789098765432109', 2, NULL),
(21, 'Mário Santos', 'Ginecologia', 456789123, '987654321098765432109', 3, NULL),
(22, 'Carla Fernandes', 'Dermatologia', 789123456, '456789123098765432109', 4, NULL),
(23, 'Pedro Teixeira', 'Pediatria', 321654987, '789123456098765432109', 1, NULL),
(24, 'Sofia Rodrigues', 'Oftalmologia', 987123654, '321654987098765432109', 2, NULL),
(25, 'Hugo Silva', 'Psiquiatria', 741852963, '654321987098765432109', 3, NULL),
(26, 'Mariana Almeida', 'Neurologia', 369258147, '987123654098765432109', 4, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicos`
--

CREATE TABLE `medicos` (
  `id` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `nome` varchar(80) NOT NULL,
  `especialidade` varchar(80) NOT NULL,
  `nif` int(9) NOT NULL,
  `nib` varchar(25) NOT NULL,
  `idMorada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `medicos`
--

INSERT INTO `medicos` (`id`, `idUser`, `nome`, `especialidade`, `nif`, `nib`, `idMorada`) VALUES
(1, NULL, 'João Silva', 'Cardiologia', 123456789, '123456789012345678901', 1),
(2, NULL, 'Marta Santos', 'Pediatria', 987654321, '098765432109876543210', 2),
(3, NULL, 'Carlos Almeida', 'Ortopedia', 456789123, '456789123045678912304', 3),
(4, 2, 'Ana Rodrigues', 'Dermatologia', 654321987, '654321987065432198706', 4),
(5, NULL, 'Pedro Costa', 'Ginecologia', 789123456, '789123456078912345607', 1),
(6, NULL, 'Sofia Pereira', 'Oftalmologia', 321654987, '321654987032165498703', 2),
(7, NULL, 'António Ferreira', 'Psiquiatria', 987123654, '987123654098712365409', 3),
(8, NULL, 'Rita Oliveira', 'Neurologia', 741852963, '741852963074185296307', 4),
(9, NULL, 'Manuel Gomes', 'Urologia', 369258147, '369258147036925814703', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `morada`
--

CREATE TABLE `morada` (
  `id` int(11) NOT NULL,
  `cidade` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `morada`
--

INSERT INTO `morada` (`id`, `cidade`) VALUES
(1, 'Madrid'),
(2, 'Funchal'),
(3, 'Lisboa'),
(4, 'Paris');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `forma` varchar(50) NOT NULL COMMENT 'como tomar',
  `embalagem` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_receita`
--

CREATE TABLE `produtos_receita` (
  `idProduto` int(11) NOT NULL,
  `idReceita` int(11) NOT NULL,
  `posologia` varchar(255) NOT NULL COMMENT 'a forma de utilizar os medicamentos',
  `num` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `receitas`
--

CREATE TABLE `receitas` (
  `id` int(11) NOT NULL,
  `cuidado` varchar(100) NOT NULL,
  `receita` varchar(7655) DEFAULT NULL,
  `idConsulta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `tipo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `tipo`) VALUES
(1, 'admin', '$2a$08$uK0b9nlLGaku89o.DS8X5OMMqUHySuDq.yTJtoZzg7r3yjMVO3PAW', 'admin'),
(2, 'ana', '$2a$08$9RXahfQ6Qqdu684Zxa87Cuy80.Q7DUzBf9kygvKVALbRLdp03TLG6', 'medico'),
(3, 'dorita', '$2a$08$Y3fkFf/c0mypC53CCJFpYukwhZR1l/34eerbqdTa2rogPeENCdb5m', 'enfermeiro'),
(4, 'danilo', '$2a$18$wMMSSMMNqEsny.42kAnBleOB4eLK//ZEbzyO/7DqN0O.SjvByiM.u', 'utente'),
(5, 'afonso', '$2a$08$Bn0q4I8DoJk6HNv1GseLLuu6vpWN6qk1tVmF6YTM0FDc4yzsekfOO', 'admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utentes`
--

CREATE TABLE `utentes` (
  `id` int(11) NOT NULL,
  `nUtente` int(9) NOT NULL,
  `idMorada` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `utentes`
--

INSERT INTO `utentes` (`id`, `nUtente`, `idMorada`, `nome`, `idUser`) VALUES
(1, 999666444, 2, 'Sr. Danilo Pereira', 4),
(2, 123456789, 1, 'Sra. Ana Silva', NULL),
(3, 987654321, 4, 'Sr. Carlos Almeida', NULL),
(4, 456789123, 1, 'Sra. Marta Santos', NULL),
(5, 789123456, 3, 'Sr. Pedro Costa', NULL),
(6, 321654987, 2, 'Sra. Sofia Pereira', NULL),
(7, 987123654, 1, 'Sr. António Ferreira', NULL),
(8, 741852963, 1, 'Sra. Rita Oliveira', NULL),
(9, 369258147, 3, 'Sr. Manuel Gomes', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `enfermeiros`
--
ALTER TABLE `enfermeiros`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idUser` (`idUser`);

--
-- Índices para tabela `morada`
--
ALTER TABLE `morada`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `receitas`
--
ALTER TABLE `receitas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idConsulta` (`idConsulta`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Índices para tabela `utentes`
--
ALTER TABLE `utentes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idUser` (`idUser`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `enfermeiros`
--
ALTER TABLE `enfermeiros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `medicos`
--
ALTER TABLE `medicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `morada`
--
ALTER TABLE `morada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `receitas`
--
ALTER TABLE `receitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `utentes`
--
ALTER TABLE `utentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
