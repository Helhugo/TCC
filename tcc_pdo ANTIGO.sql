-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Out-2023 às 15:14
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tcc_pdo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

create database tcc_pdo;
use tcc_pdo;

CREATE TABLE `cliente` (
  `id_Cliente` int(10) NOT NULL,
  `email_Cliente` varchar(100) DEFAULT NULL,
  `nomeComp_Cliente` varchar(200) DEFAULT NULL,
  `user_Cliente` varchar(200) DEFAULT NULL,
  `foto_Cliente` varchar(200) DEFAULT NULL,
  `senha_Cliente` varchar(200) DEFAULT NULL,
  `datanasc_Cliente` date DEFAULT NULL,
  `telefone_Cliente` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_Cliente`, `email_Cliente`, `nomeComp_Cliente`, `user_Cliente`, `foto_Cliente`, `senha_Cliente`, `datanasc_Cliente`, `telefone_Cliente`) VALUES
(1, 'gui@gmail.com', 'Guilherme Gonçalves', 'Guigui', 'dePerfil.jpg', '23', '2023-06-05', 123),
(2, 'feijaoprato@gmail.com', 'feijaoprato', 'feijaozin', 'dePerfil.jpg', '23434', '0000-00-00', 234234);

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra`
--

CREATE TABLE `compra` (
  `id_Comp` int(10) NOT NULL,
  `data_Comp` date DEFAULT NULL,
  `infoentr_Comp` varchar(200) DEFAULT NULL,
  `valor_Comp` decimal(10,0) DEFAULT NULL,
  `fk_Cliente_id_Cliente` int(10) DEFAULT NULL,
  `fk_StatusPag_id_Stts` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cones`
--

CREATE TABLE `cones` (
  `id_Cone` int(10) NOT NULL,
  `nome_Cone` varchar(200) DEFAULT NULL,
  `valor_Cone` float DEFAULT NULL,
  `descricao_Cone` varchar(200) DEFAULT NULL,
  `img_Cone` varchar(200) DEFAULT NULL,
  `promo_Cone` varchar(200) DEFAULT NULL,
  `desconto_Cone` int(10) DEFAULT NULL,
  `clasfic_Cone` float DEFAULT NULL,
  `tipo_Cone` varchar(100) DEFAULT NULL,
  `sabor_Cone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cones`
--

INSERT INTO `cones` (`id_Cone`, `nome_Cone`, `valor_Cone`, `descricao_Cone`, `img_Cone`, `promo_Cone`, `desconto_Cone`, `clasfic_Cone`, `tipo_Cone`, `sabor_Cone`) VALUES
(1, 'Cone de Oreo', 5, 'Um delicioso cone recheado com o sabor de Oreo', 'coneOreo.jpg', '', 0, 5, 'normal', 'Oreo'),
(2, 'Cone de Duo', 5, 'Um magnífico cone recheado com o sabor de leite ninho juntamente de brigadeiro', 'coneDuo.jpg', '', 0, 5, 'normal', 'Duo'),
(3, 'Cone de Ninho', 5, 'Um explêndido cone recheado com o sabor de leite ninho', 'coneNinho.jpg', '', 0, 5, 'normal', 'Ninho'),
(4, 'Cone de Chocomenta', 5, 'Um cone recheado com o sabor de chocolate com menta', 'coneChocomenta.jpg', '', 0, 1, 'normal', 'Chocomenta');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque_possui`
--

CREATE TABLE `estoque_possui` (
  `id_Estq` int(10) NOT NULL,
  `quant_Estq` int(10) DEFAULT NULL,
  `tipo_Estq` varchar(200) DEFAULT NULL,
  `fk_Cones_id_Cone` int(10) DEFAULT NULL,
  `fk_Trufas_id_Trufa` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `favoritos`
--

CREATE TABLE `favoritos` (
  `id_Favorito` int(10) NOT NULL,
  `nome_User` varchar(200) NOT NULL,
  `sabor_Fav` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `favoritos`
--

INSERT INTO `favoritos` (`id_Favorito`, `nome_User`, `sabor_Fav`) VALUES
(7, 'Guigui', 'Trufa de Duo'),
(8, 'Guigui', 'Trufa de Oreo'),
(9, 'Guigui', 'Cone de Oreo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `formulariopag`
--

CREATE TABLE `formulariopag` (
  `id_Formpag` int(10) NOT NULL,
  `tipo_Formpag` varchar(100) DEFAULT NULL,
  `fk_Compra_id_Comp` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_armazena`
--

CREATE TABLE `itens_armazena` (
  `id_Item` int(10) NOT NULL,
  `sabor_Item` varchar(200) DEFAULT NULL,
  `quantp_Item` int(10) DEFAULT NULL,
  `valor_Item` decimal(10,0) DEFAULT NULL,
  `fk_Compra_id_Comp` int(10) DEFAULT NULL,
  `fk_Cones_id_Cone` int(10) DEFAULT NULL,
  `fk_Trufas_id_Trufa` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reviews`
--

CREATE TABLE `reviews` (
  `id_Review` int(10) NOT NULL,
  `tipo_Review` varchar(50) DEFAULT NULL,
  `nome_Review` varchar(200) DEFAULT NULL,
  `text_Review` varchar(200) DEFAULT NULL,
  `nota_Review` float DEFAULT NULL,
  `sabor_Review` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `reviews`
--

INSERT INTO `reviews` (`id_Review`, `tipo_Review`, `nome_Review`, `text_Review`, `nota_Review`, `sabor_Review`) VALUES
(1, 'Cone', 'Mauricio', 'Gostei, muito bom sabia. HaHa!!', 5, 'Oreo'),
(2, 'Cone', 'Menó', 'Slk mó desaforo isso aqui parça, slk sem condisões', 1, 'Oreo'),
(3, 'Cone', 'Séquiso', 'Gostei hein, me trouxe lembranças...', 4, 'Oreo'),
(4, 'Cone', 'arthur Morgan', 'Lennyyyyyyy!!!', 4, 'Ninho'),
(5, 'Cone', 'Dutch', 'I got a plan', 4, 'Ninho'),
(6, 'Cone', 'Regular Guy', 'É muito gostoso, porém também é simples demais comparado com os outros.', 3, 'Ninho'),
(7, 'Cone', 'Eminem', 'so good i got a feeling to shoot', 5, 'Duo'),
(8, 'Cone', 'CJ pegando fogo', 'OUCH AAH, AAAAH ', 4, 'Duo'),
(9, 'Cone', '313', 'Fuck free world! 313, fuck free world!', 4, 'Duo'),
(10, 'Cone', 'Guitarra', 'HORRIVEL! O PIOR SABOR QUE TEM, INCOMIVEL', 1, 'Chocomenta'),
(11, 'Cone', 'Michael Scott', 'OH GOD PLEASE NO, NO! NOOOOOOOOOOOO', 1, 'Chocomenta'),
(12, 'Cone', 'todo mundo', 'ruim demais, muito muito ruim.', 1, 'Chocomenta'),
(13, 'Trufa', 'gi', 'Amei, me da vontade de comer pão de mel', 5, 'Leite'),
(14, 'Trufa', 'Odilom', 'Não achei muito bom não... falta algum batismo..', 4, 'Oreo'),
(15, 'Trufa', 'Guitarrista médio', 'delicinha, me vê 5', 4, 'Duo'),
(16, 'Trufa', 'Pessoa decente', 'eca.', 1, 'Chocomenta'),
(17, 'Trufa', 'Guigui', 'delicia', 5, 'Oreo'),
(18, 'Trufa', 'Guigui', 'eu amo fds', 5, 'Chocomenta'),
(19, 'Cone', 'Guigui', 'Uma delicia', 5, 'Oreo'),
(20, 'Cone', 'Guigui', 'Lindoo', 5, 'Ninho'),
(21, 'Cone', 'Guigui', 'Perfeito', 5, 'Chocomenta'),
(22, 'Trufa', 'Guigui', 'Muito delicia', 5, 'Leite');

-- --------------------------------------------------------

--
-- Estrutura da tabela `statuspag`
--

CREATE TABLE `statuspag` (
  `nome_Stts` varchar(200) DEFAULT NULL,
  `id_Stts` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `trufas`
--

CREATE TABLE `trufas` (
  `id_Trufa` int(10) NOT NULL,
  `nome_Trufa` varchar(200) DEFAULT NULL,
  `valor_Trufa` float DEFAULT NULL,
  `descricao_Trufa` varchar(200) DEFAULT NULL,
  `img_Trufa` varchar(200) DEFAULT NULL,
  `promo_Trufa` varchar(200) DEFAULT NULL,
  `desconto_Trufa` int(10) DEFAULT NULL,
  `clasfic_Trufa` float DEFAULT NULL,
  `sabor_Trufa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `trufas`
--

INSERT INTO `trufas` (`id_Trufa`, `nome_Trufa`, `valor_Trufa`, `descricao_Trufa`, `img_Trufa`, `promo_Trufa`, `desconto_Trufa`, `clasfic_Trufa`, `sabor_Trufa`) VALUES
(1, 'Trufa de Oreo', 3, 'Uma deliciosa trufa recheada com o sabor de Oreo', 'trufaOreo.jpg', '', 0, 5, 'Oreo'),
(2, 'Trufa de Duo', 3, 'Uma magnífica trufa recheada com o sabor de leite ninho juntamente de brigadeiro', 'trufaDuo.jpg', '', 0, 5, 'Duo'),
(3, 'Trufa de Doce de Leite', 3, 'Uma explêndida trufa recheada com o sabor de doce de leite', 'trufaDocedeLeite.jpg', '', 0, 5, 'DocedeLeite'),
(4, 'Trufa de Chocomenta', 3, 'Uma trufa recheada com o sabor de chocolate com menta', 'Trufachocomenta.jpg', '', 0, 1, 'Chocomenta');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_Cliente`);

--
-- Índices para tabela `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_Comp`),
  ADD KEY `FK_Compra_2` (`fk_Cliente_id_Cliente`),
  ADD KEY `FK_Compra_3` (`fk_StatusPag_id_Stts`);

--
-- Índices para tabela `cones`
--
ALTER TABLE `cones`
  ADD PRIMARY KEY (`id_Cone`);

--
-- Índices para tabela `estoque_possui`
--
ALTER TABLE `estoque_possui`
  ADD PRIMARY KEY (`id_Estq`),
  ADD KEY `FK_Estoque_Possui_2` (`fk_Cones_id_Cone`),
  ADD KEY `FK_Estoque_Possui_3` (`fk_Trufas_id_Trufa`);

--
-- Índices para tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id_Favorito`);

--
-- Índices para tabela `formulariopag`
--
ALTER TABLE `formulariopag`
  ADD PRIMARY KEY (`id_Formpag`),
  ADD KEY `FK_FormularioPag_2` (`fk_Compra_id_Comp`);

--
-- Índices para tabela `itens_armazena`
--
ALTER TABLE `itens_armazena`
  ADD PRIMARY KEY (`id_Item`),
  ADD KEY `FK_Itens_Armazena_2` (`fk_Compra_id_Comp`),
  ADD KEY `FK_Itens_Armazena_3` (`fk_Cones_id_Cone`),
  ADD KEY `FK_Itens_Armazena_4` (`fk_Trufas_id_Trufa`);

--
-- Índices para tabela `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id_Review`);

--
-- Índices para tabela `statuspag`
--
ALTER TABLE `statuspag`
  ADD PRIMARY KEY (`id_Stts`);

--
-- Índices para tabela `trufas`
--
ALTER TABLE `trufas`
  ADD PRIMARY KEY (`id_Trufa`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_Cliente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `compra`
--
ALTER TABLE `compra`
  MODIFY `id_Comp` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cones`
--
ALTER TABLE `cones`
  MODIFY `id_Cone` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `estoque_possui`
--
ALTER TABLE `estoque_possui`
  MODIFY `id_Estq` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id_Favorito` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `formulariopag`
--
ALTER TABLE `formulariopag`
  MODIFY `id_Formpag` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `itens_armazena`
--
ALTER TABLE `itens_armazena`
  MODIFY `id_Item` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id_Review` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `statuspag`
--
ALTER TABLE `statuspag`
  MODIFY `id_Stts` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `trufas`
--
ALTER TABLE `trufas`
  MODIFY `id_Trufa` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `FK_Compra_2` FOREIGN KEY (`fk_Cliente_id_Cliente`) REFERENCES `cliente` (`id_Cliente`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Compra_3` FOREIGN KEY (`fk_StatusPag_id_Stts`) REFERENCES `statuspag` (`id_Stts`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `estoque_possui`
--
ALTER TABLE `estoque_possui`
  ADD CONSTRAINT `FK_Estoque_Possui_2` FOREIGN KEY (`fk_Cones_id_Cone`) REFERENCES `cones` (`id_Cone`),
  ADD CONSTRAINT `FK_Estoque_Possui_3` FOREIGN KEY (`fk_Trufas_id_Trufa`) REFERENCES `trufas` (`id_Trufa`);

--
-- Limitadores para a tabela `formulariopag`
--
ALTER TABLE `formulariopag`
  ADD CONSTRAINT `FK_FormularioPag_2` FOREIGN KEY (`fk_Compra_id_Comp`) REFERENCES `compra` (`id_Comp`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `itens_armazena`
--
ALTER TABLE `itens_armazena`
  ADD CONSTRAINT `FK_Itens_Armazena_2` FOREIGN KEY (`fk_Compra_id_Comp`) REFERENCES `compra` (`id_Comp`),
  ADD CONSTRAINT `FK_Itens_Armazena_3` FOREIGN KEY (`fk_Cones_id_Cone`) REFERENCES `cones` (`id_Cone`),
  ADD CONSTRAINT `FK_Itens_Armazena_4` FOREIGN KEY (`fk_Trufas_id_Trufa`) REFERENCES `trufas` (`id_Trufa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
