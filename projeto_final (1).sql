-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 18-Out-2021 às 23:59
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto_final`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidades`
--

DROP TABLE IF EXISTS `cidades`;
CREATE TABLE IF NOT EXISTS `cidades` (
  `cod_postal` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `distritos_ID` int(11) NOT NULL,
  PRIMARY KEY (`cod_postal`),
  KEY `fk_cidades_distritos1_idx` (`distritos_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE IF NOT EXISTS `cursos` (
  `ID` varchar(4) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `tipos_curso_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_cursos_tipos_curso1_idx` (`tipos_curso_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `distritos`
--

DROP TABLE IF EXISTS `distritos`;
CREATE TABLE IF NOT EXISTS `distritos` (
  `ID` int(2) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `distritos`
--

INSERT INTO `distritos` (`ID`, `nome`) VALUES
(2, 'Aveiro'),
(3, 'Beja'),
(4, 'Braga'),
(5, 'Bragança'),
(6, 'Castelo Branco'),
(7, 'Coimbra'),
(8, 'Évora'),
(9, 'Faro'),
(10, 'Madeira'),
(11, 'Guarda'),
(13, 'Leiria'),
(14, 'Lisboa'),
(16, 'Portalegre'),
(17, 'Porto'),
(18, 'Santarém'),
(19, 'Setúbal'),
(20, 'Viana do Castelo'),
(21, 'Vila Real'),
(22, 'Viseu'),
(23, 'Açores');

-- --------------------------------------------------------

--
-- Estrutura da tabela `instituicoes`
--

DROP TABLE IF EXISTS `instituicoes`;
CREATE TABLE IF NOT EXISTS `instituicoes` (
  `ID` varchar(4) NOT NULL,
  `nome` varchar(128) DEFAULT NULL,
  `cod_postal` int(4) DEFAULT NULL,
  `tipos_ensino_ID` int(2) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_instituicoes_cidades_idx` (`cod_postal`),
  KEY `fk_instituicoes_tipos_ensino1_idx` (`tipos_ensino_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `instituicoes`
--

INSERT INTO `instituicoes` (`ID`, `nome`, `cod_postal`, `tipos_ensino_ID`) VALUES
('0140', 'Universidade dos Açores - Faculdade de Ciências Agrárias e do Ambiente', NULL, 11),
('0150', 'Universidade dos Açores - Faculdade de Ciências Sociais e Humanas', NULL, 11),
('0160', 'Universidade dos Açores - Faculdade de Ciências e Tecnologia', NULL, 11),
('0170', 'Universidade dos Açores - Faculdade de Economia e Gestão', NULL, 11),
('0201', 'Universidade do Algarve - Faculdade de Ciências Humanas e Sociais', NULL, 11),
('0203', 'Universidade do Algarve - Faculdade de Ciências e Tecnologia', NULL, 11),
('0204', 'Universidade do Algarve - Faculdade de Economia', NULL, 11),
('0206', 'Universidade do Algarve - Faculdade de Medicina e Ciências Biomédicas', NULL, 11),
('0300', 'Universidade de Aveiro', NULL, 11),
('0400', 'Universidade da Beira Interior', NULL, 11),
('0501', 'Universidade de Coimbra - Faculdade de Ciências e Tecnologia', NULL, 11),
('0502', 'Universidade de Coimbra - Faculdade de Direito', NULL, 11),
('0503', 'Universidade de Coimbra - Faculdade de Economia', NULL, 11),
('0504', 'Universidade de Coimbra - Faculdade de Farmácia', NULL, 11),
('0505', 'Universidade de Coimbra - Faculdade de Letras', NULL, 11),
('0506', 'Universidade de Coimbra - Faculdade de Medicina', NULL, 11),
('0507', 'Universidade de Coimbra - Faculdade de Psicologia e de Ciências da Educação', NULL, 11),
('0508', 'Universidade de Coimbra - Faculdade de Ciências do Desporto e Educação Física', NULL, 11),
('0602', 'Universidade de Évora - Escola de Ciências e Tecnologia', NULL, 11),
('0603', 'Universidade de Évora - Escola de Artes', NULL, 11),
('0604', 'Universidade de Évora - Escola de Ciências Sociais', NULL, 11),
('0901', 'Universidade Nova de Lisboa - Faculdade de Ciências Médicas', NULL, 11),
('0902', 'Universidade Nova de Lisboa - Faculdade de Ciências Sociais e Humanas', NULL, 11),
('0903', 'Universidade Nova de Lisboa - Faculdade de Ciências e Tecnologia', NULL, 11),
('0904', 'Universidade Nova de Lisboa - Faculdade de Economia', NULL, 11),
('0906', 'Universidade Nova de Lisboa - Instituto Superior de Estatística e Gestão de Informação', NULL, 11),
('0911', 'Universidade Nova de Lisboa - Faculdade de Direito', NULL, 11),
('1000', 'Universidade do Minho', NULL, 11),
('1101', 'Universidade do Porto - Faculdade de Ciências da Nutrição e da Alimentação', NULL, 11),
('1102', 'Universidade do Porto - Faculdade de Arquitetura', NULL, 11),
('1103', 'Universidade do Porto - Faculdade de Ciências', NULL, 11),
('1104', 'Universidade do Porto - Faculdade de Economia', NULL, 11),
('1105', 'Universidade do Porto - Faculdade de Engenharia', NULL, 11),
('1106', 'Universidade do Porto - Faculdade de Farmácia', NULL, 11),
('1107', 'Universidade do Porto - Faculdade de Letras', NULL, 11),
('1108', 'Universidade do Porto - Faculdade de Medicina', NULL, 11),
('1109', 'Universidade do Porto - Faculdade de Psicologia e de Ciências da Educação', NULL, 11),
('1110', 'Universidade do Porto - Instituto de Ciências Biomédicas Abel Salazar', NULL, 11),
('1111', 'Universidade do Porto - Faculdade de Desporto', NULL, 11),
('1113', 'Universidade do Porto - Faculdade de Medicina Dentária', NULL, 11),
('1114', 'Universidade do Porto - Faculdade de Direito', NULL, 11),
('1201', 'Universidade de Trás-os-Montes e Alto Douro - Escola de Ciências Agrárias e Veterinárias', NULL, 11),
('1202', 'Universidade de Trás-os-Montes e Alto Douro - Escola de Ciências Humanas e Sociais', NULL, 11),
('1203', 'Universidade de Trás-os-Montes e Alto Douro - Escola de Ciências e Tecnologia', NULL, 11),
('1204', 'Universidade de Trás-os-Montes e Alto Douro - Escola de Ciências da Vida e do Ambiente', NULL, 11),
('1306', 'Universidade da Madeira - Faculdade de Artes e Humanidades', NULL, 11),
('1307', 'Universidade da Madeira - Faculdade de Ciências Exatas e da Engenharia', NULL, 11),
('1308', 'Universidade da Madeira - Faculdade de Ciências Sociais', NULL, 11),
('1309', 'Universidade da Madeira - Faculdade de Ciências da Vida', NULL, 11),
('1320', 'Universidade da Madeira - Escola Superior de Saúde', NULL, 12),
('1321', 'Universidade da Madeira - Escola Superior de Tecnologias e Gestão', NULL, 12),
('1501', 'Universidade de Lisboa - Faculdade de Arquitetura', NULL, 11),
('1502', 'Universidade de Lisboa - Faculdade de Belas-Artes', NULL, 11),
('1503', 'Universidade de Lisboa - Faculdade de Ciências', NULL, 11),
('1504', 'Universidade de Lisboa - Faculdade de Direito', NULL, 11),
('1505', 'Universidade de Lisboa - Faculdade de Farmácia', NULL, 11),
('1506', 'Universidade de Lisboa - Faculdade de Letras', NULL, 11),
('1507', 'Universidade de Lisboa - Faculdade de Medicina', NULL, 11),
('1508', 'Universidade de Lisboa - Faculdade de Medicina Dentária', NULL, 11),
('1509', 'Universidade de Lisboa - Faculdade de Medicina Veterinária', NULL, 11),
('1510', 'Universidade de Lisboa - Faculdade de Motricidade Humana', NULL, 11),
('1511', 'Universidade de Lisboa - Faculdade de Psicologia', NULL, 11),
('1513', 'Universidade de Lisboa - Instituto de Educação', NULL, 11),
('1514', 'Universidade de Lisboa - Instituto de Geografia e Ordenamento do Território', NULL, 11),
('1515', 'Universidade de Lisboa - Instituto Superior de Agronomia', NULL, 11),
('1516', 'Universidade de Lisboa - Instituto Superior de Ciências Sociais e Políticas', NULL, 11),
('1517', 'Universidade de Lisboa - Instituto Superior de Economia e Gestão', NULL, 11),
('1518', 'Universidade de Lisboa - Instituto Superior Técnico', NULL, 11),
('1519', 'Universidade de Lisboa - Instituto Superior Técnico (Tagus Park)', NULL, 11),
('2100', 'Universidade Autónoma de Lisboa Luís de Camões', NULL, 21),
('2210', 'Universidade Católica Portuguesa - Escola Superior de Biotecnologia', NULL, 21),
('2218', 'Universidade Católica Portuguesa - Escola de Enfermagem (Lisboa)', NULL, 22),
('2219', 'Universidade Católica Portuguesa - Escola de Enfermagem (Porto)', NULL, 22),
('2220', 'Universidade Católica Portuguesa - Faculdade de Ciências Humanas', NULL, 21),
('2223', 'Universidade Católica Portuguesa - Faculdade de Filosofia e Ciências Sociais', NULL, 21),
('2227', 'Universidade Católica Portuguesa - Faculdade de Medicina Dentária', NULL, 21),
('2228', 'Universidade Católica Portuguesa - Instituto de Gestão e das Organizações da Saúde', NULL, 21),
('2240', 'Universidade Católica Portuguesa - Faculdade de Teologia', NULL, 21),
('2265', 'Universidade Católica Portuguesa - Escola das Artes', NULL, 21),
('2270', 'Universidade Católica Portuguesa - Faculdade de Ciências Económicas e Empresariais', NULL, 21),
('2271', 'Universidade Católica Portuguesa - Faculdade de Economia e Gestão', NULL, 21),
('2280', 'Universidade Católica Portuguesa - Faculdade de Direito', NULL, 21),
('2281', 'Universidade Católica Portuguesa - Faculdade de Direito (Porto)', NULL, 21),
('2289', 'Universidade Católica Portuguesa - Faculdade de Educação e Psicologia', NULL, 21),
('2295', 'Universidade Católica Portuguesa - Instituto de Estudos Políticos', NULL, 21),
('2299', 'Universidade Católica Portuguesa - Faculdade de Medicina', NULL, 21),
('2400', 'Universidade Lusíada', NULL, 21),
('2403', 'Universidade Lusíada - Norte - Porto', NULL, 21),
('2404', 'Universidade Lusíada - Norte - Vila Nova de Famalicão', NULL, 21),
('2500', 'Universidade Portucalense Infante D. Henrique', NULL, 21),
('2710', 'Atlântica - Instituto Universitário', NULL, 21),
('2750', 'Universidade Fernando Pessoa', NULL, 21),
('2800', 'Universidade Lusófona de Humanidades e Tecnologias', NULL, 21),
('3011', 'Universidade de Aveiro - Instituto Superior de Contabilidade e Administração de Aveiro', NULL, 12),
('3012', 'Universidade de Aveiro - Escola Superior de Tecnologia e Gestão de Águeda', NULL, 12),
('3013', 'Universidade de Aveiro - Escola Superior de Saúde de Aveiro', NULL, 12),
('3014', 'Universidade de Aveiro - Escola Superior de Design, Gestão e Tecnologia da Produção de Aveiro-Norte', NULL, 12),
('3021', 'Instituto Politécnico de Beja - Escola Superior Agrária', NULL, 12),
('3022', 'Instituto Politécnico de Beja - Escola Superior de Educação', NULL, 12),
('3023', 'Instituto Politécnico de Beja - Escola Superior de Tecnologia e de Gestão', NULL, 12),
('3031', 'Instituto Politécnico do Cávado e do Ave - Escola Superior de Gestão', NULL, 12),
('3032', 'Instituto Politécnico do Cávado e do Ave - Escola Superior de Tecnologia', NULL, 12),
('3033', 'Instituto Politécnico do Cávado e do Ave - Escola Superior de Design', NULL, 12),
('3034', 'Instituto Politécnico do Cávado e do Ave - Escola Superior de Hotelaria e Turismo', NULL, 12),
('3041', 'Instituto Politécnico de Bragança - Escola Superior Agrária de Bragança', NULL, 12),
('3042', 'Instituto Politécnico de Bragança - Escola Superior de Educação de Bragança', NULL, 12),
('3043', 'Instituto Politécnico de Bragança - Escola Superior de Tecnologia e de Gestão de Bragança', NULL, 12),
('3045', 'Instituto Politécnico de Bragança - Escola Superior de Comunicação, Administração e Turismo de Mirandela', NULL, 12),
('3051', 'Instituto Politécnico de Castelo Branco - Escola Superior Agrária de Castelo Branco', NULL, 12),
('3052', 'Instituto Politécnico de Castelo Branco - Escola Superior de Educação de Castelo Branco', NULL, 12),
('3053', 'Instituto Politécnico de Castelo Branco - Escola Superior de Tecnologia de Castelo Branco', NULL, 12),
('3054', 'Instituto Politécnico de Castelo Branco - Escola Superior de Gestão de Idanha-a-Nova', NULL, 12),
('3055', 'Instituto Politécnico de Castelo Branco - Escola Superior de Artes Aplicadas', NULL, 12),
('3061', 'Instituto Politécnico de Coimbra - Escola Superior Agrária de Coimbra', NULL, 12),
('3062', 'Instituto Politécnico de Coimbra - Escola Superior de Educação de Coimbra', NULL, 12),
('3063', 'Instituto Politécnico de Coimbra - Instituto Superior de Contabilidade e Administração de Coimbra', NULL, 12),
('3064', 'Instituto Politécnico de Coimbra - Instituto Superior de Engenharia de Coimbra', NULL, 12),
('3065', 'Instituto Politécnico de Coimbra - Escola Superior de Tecnologia e Gestão de Oliveira do Hospital', NULL, 12),
('3081', 'Universidade do Algarve - Escola Superior de Educação e Comunicação', NULL, 12),
('3082', 'Universidade do Algarve - Escola Superior de Gestão, Hotelaria e Turismo', NULL, 12),
('3083', 'Universidade do Algarve - Instituto Superior de Engenharia', NULL, 12),
('3087', 'Universidade do Algarve - Escola Superior de Gestão, Hotelaria e Turismo (Portimão)', NULL, 12),
('3091', 'Instituto Politécnico da Guarda - Escola Superior de Educação, Comunicação e Desporto', NULL, 12),
('3092', 'Instituto Politécnico da Guarda - Escola Superior de Tecnologia e Gestão', NULL, 12),
('3095', 'Instituto Politécnico da Guarda - Escola Superior de Turismo e Hotelaria', NULL, 12),
('3101', 'Instituto Politécnico de Leiria - Escola Superior de Educação e Ciências Sociais', NULL, 12),
('3102', 'Instituto Politécnico de Leiria - Escola Superior de Tecnologia e Gestão', NULL, 12),
('3103', 'Instituto Politécnico de Leiria - Escola Superior de Artes e Design', NULL, 12),
('3105', 'Instituto Politécnico de Leiria - Escola Superior de Turismo e Tecnologia do Mar', NULL, 12),
('3110', 'Instituto Politécnico de Lisboa', NULL, 12),
('3111', 'Instituto Politécnico de Lisboa - Escola Superior de Dança', NULL, 12),
('3112', 'Instituto Politécnico de Lisboa - Escola Superior de Educação', NULL, 12),
('3113', 'Instituto Politécnico de Lisboa - Escola Superior de Comunicação Social', NULL, 12),
('3114', 'Instituto Politécnico de Lisboa - Escola Superior de Música', NULL, 12),
('3116', 'Instituto Politécnico de Lisboa - Escola Superior de Teatro e Cinema', NULL, 12),
('3117', 'Instituto Politécnico de Lisboa - Instituto Superior de Contabilidade e Administração de Lisboa', NULL, 12),
('3118', 'Instituto Politécnico de Lisboa - Instituto Superior de Engenharia de Lisboa', NULL, 12),
('3121', 'Instituto Politécnico de Portalegre - Escola Superior de Educação e Ciências Sociais', NULL, 12),
('3122', 'Instituto Politécnico de Portalegre - Escola Superior de Tecnologia e Gestão', NULL, 12),
('3123', 'Instituto Politécnico de Portalegre - Escola Superior Agrária de Elvas', NULL, 12),
('3131', 'Instituto Politécnico do Porto - Escola Superior de Educação', NULL, 12),
('3132', 'Instituto Politécnico do Porto - Escola Superior de Música e Artes do Espectáculo', NULL, 12),
('3134', 'Instituto Politécnico do Porto - Instituto Superior de Contabilidade e Administração do Porto', NULL, 12),
('3135', 'Instituto Politécnico do Porto - Instituto Superior de Engenharia do Porto', NULL, 12),
('3138', 'Instituto Politécnico do Porto - Escola Superior de Tecnologia e Gestão', NULL, 12),
('3139', 'Instituto Politécnico do Porto - Escola Superior de Hotelaria e Turismo', NULL, 12),
('3141', 'Instituto Politécnico de Santarém - Escola Superior Agrária de Santarém', NULL, 12),
('3142', 'Instituto Politécnico de Santarém - Escola Superior de Educação de Santarém', NULL, 12),
('3143', 'Instituto Politécnico de Santarém - Escola Superior de Gestão e Tecnologia de Santarém', NULL, 12),
('3145', 'Instituto Politécnico de Santarém - Escola Superior de Desporto de Rio Maior', NULL, 12),
('3151', 'Instituto Politécnico de Setúbal - Escola Superior de Educação', NULL, 12),
('3152', 'Instituto Politécnico de Setúbal - Escola Superior de Tecnologia de Setúbal', NULL, 12),
('3153', 'Instituto Politécnico de Setúbal - Escola Superior de Ciências Empresariais', NULL, 12),
('3154', 'Instituto Politécnico de Setúbal - Escola Superior de Tecnologia do Barreiro', NULL, 12),
('3155', 'Instituto Politécnico de Setúbal - Escola Superior de Saúde', NULL, 12),
('3161', 'Instituto Politécnico de Viana do Castelo - Escola Superior Agrária', NULL, 12),
('3162', 'Instituto Politécnico de Viana do Castelo - Escola Superior de Educação', NULL, 12),
('3163', 'Instituto Politécnico de Viana do Castelo - Escola Superior de Tecnologia e Gestão', NULL, 12),
('3164', 'Instituto Politécnico de Viana do Castelo - Escola Superior de Ciências Empresariais', NULL, 12),
('3165', 'Instituto Politécnico de Viana do Castelo - Escola Superior de Desporto e Lazer', NULL, 12),
('3181', 'Instituto Politécnico de Viseu - Escola Superior de Educação de Viseu', NULL, 12),
('3182', 'Instituto Politécnico de Viseu - Escola Superior de Tecnologia e Gestão de Viseu', NULL, 12),
('3185', 'Instituto Politécnico de Viseu - Escola Superior Agrária de Viseu', NULL, 12),
('3186', 'Instituto Politécnico de Viseu - Escola Superior de Tecnologia e Gestão de Lamego', NULL, 12),
('3241', 'Instituto Politécnico de Tomar - Escola Superior de Gestão de Tomar', NULL, 12),
('3242', 'Instituto Politécnico de Tomar - Escola Superior de Tecnologia de Tomar', NULL, 12),
('3243', 'Instituto Politécnico de Tomar - Escola Superior de Tecnologia de Abrantes', NULL, 12),
('3331', 'Instituto Politécnico do Porto - Escola Superior de Media Artes e Design', NULL, 12),
('4002', 'Academia Nacional Superior de Orquestra', NULL, 22),
('4010', 'Escola Superior Artística do Porto', NULL, 21),
('4020', 'Escola Superior de Atividades Imobiliárias', NULL, 22),
('4025', 'Escola Superior Gallaecia', NULL, 21),
('4032', 'Universidade Lusófona do Porto', NULL, 21),
('4069', 'Escola Superior de Artes e Design', NULL, 22),
('4076', 'Escola Superior de Educação de Fafe', NULL, 22),
('4080', 'Escola Superior de Educação de João de Deus', NULL, 22),
('4085', 'Escola Superior de Educação de Paula Frassinetti', NULL, 22),
('4089', 'Escola Superior de Saúde Norte da Cruz Vermelha Portuguesa', NULL, 22),
('4091', 'Escola Superior de Saúde da Cruz Vermelha Portuguesa - Lisboa', NULL, 22),
('4096', 'Escola Superior de Enfermagem São Francisco das Misericórdias', NULL, 22),
('4097', 'Escola Superior de Saúde de Santa Maria', NULL, 22),
('4098', 'Escola Superior de Enfermagem de São José de Cluny', NULL, 22),
('4103', 'Escola Superior de Saúde Jean Piaget de Viseu', NULL, 22),
('4105', 'Escola Superior de Saúde do Alcoitão', NULL, 22),
('4106', 'Escola Superior de Saúde Egas Moniz', NULL, 22),
('4108', 'CESPU - Instituto Politécnico de Saúde do Norte - Escola Superior de Saúde do Vale do Ave', NULL, 22),
('4109', 'CESPU - Instituto Politécnico de Saúde do Norte - Escola Superior de Saúde do Vale do Sousa', NULL, 22),
('4110', 'Escola Superior de Enfermagem Cruz Vermelha Portuguesa - Alto Tâmega', NULL, 22),
('4115', 'Escola Superior de Tecnologias de Fafe', NULL, 22),
('4126', 'Escola Universitária Vasco da Gama', NULL, 21),
('4141', 'Escola Superior de Negócios Atlântico', NULL, 22),
('4155', 'Instituto Português de Administração de Marketing do Porto', NULL, 22),
('4156', 'Instituto Português de Administração de Marketing de Lisboa', NULL, 22),
('4200', 'Instituto Superior de Administração e Gestão', NULL, 22),
('4220', 'Instituto Superior de Administração e Línguas', NULL, 22),
('4260', 'Instituto Universitário Egas Moniz', NULL, 21),
('4261', 'Instituto Universitário de Ciências da Saúde', NULL, 21),
('4270', 'ISCE - Instituto Superior de Lisboa e Vale do Tejo', NULL, 22),
('4271', 'Instituto Superior de Ciências Educativas do Douro', NULL, 22),
('4277', 'Instituto Superior de Ciências da Informação e da Administração', NULL, 22),
('4280', 'Instituto Superior de Ciências Empresariais e do Turismo', NULL, 22),
('4283', 'Instituto Superior de Entre Douro e Vouga', NULL, 22),
('4292', 'Instituto Superior D. Dinis', NULL, 22),
('4298', 'ISEC Lisboa - Instituto Superior de Educação e Ciências', NULL, 22),
('4300', 'Instituto Superior de Gestão', NULL, 21),
('4306', 'Instituto Superior de Estudos Interculturais e Transdisciplinares de Almada', NULL, 21),
('4308', 'Instituto Superior de Estudos Interculturais e Transdisciplinares de Viseu', NULL, 21),
('4350', 'Universidade Europeia', NULL, 21),
('4352', 'ISLA - Instituto Superior de Gestão e Administração de Santarém', NULL, 22),
('4375', 'Instituto Superior Manuel Teixeira Gomes', NULL, 21),
('4442', 'Instituto Superior Politécnico Gaya - Escola Superior de Ciência e Tecnologia', NULL, 22),
('4444', 'Instituto Superior Politécnico Gaya - Escola Superior de Ciências Empresariais', NULL, 22),
('4450', 'ISPA - Instituto Universitário de Ciências Psicológicas, Sociais e da Vida', NULL, 21),
('4460', 'ISAVE - Instituto Superior de Saúde', NULL, 22),
('4500', 'Instituto Superior Miguel Torga', NULL, 21),
('4520', 'Instituto Superior de Serviço Social do Porto', NULL, 21),
('4530', 'Instituto Superior de Tecnologias Avançadas de Lisboa', NULL, 22),
('4571', 'ISLA - Instituto Politécnico de Gestão e Tecnologia - Escola Superior de Gestão', NULL, 22),
('4572', 'ISLA - Instituto Politécnico de Gestão e Tecnologia - Escola Superior de Tecnologia', NULL, 22),
('4581', 'Instituto Politécnico da Maia - Escola Superior de Ciências Sociais, Educação e Desporto', NULL, 22),
('4582', 'Instituto Politécnico da Maia - Escola Superior de Tecnologia e Gestão', NULL, 22),
('4590', 'Escola Superior de Saúde Atlântica', NULL, 22),
('4601', 'Instituto Politécnico Jean Piaget do Sul - Escola Superior de Educação Jean Piaget de Almada', NULL, 22),
('4602', 'Instituto Politécnico Jean Piaget do Sul - Escola Superior de Tecnologia e Gestão Jean Piaget', NULL, 22),
('4603', 'Instituto Politécnico Jean Piaget do Sul - Escola Superior de Saúde Jean Piaget do Algarve', NULL, 22),
('4612', 'Instituto Politécnico da Lusofonia - Escola Superior de Ciências da Administração', NULL, 22),
('4614', 'Instituto Politécnico da Lusofonia - Escola Superior de Saúde Ribeiro Sanches', NULL, 22),
('4615', 'Instituto Politécnico da Lusofonia - Escola Superior de Saúde, Proteção e Bem-Estar Animal', NULL, 22),
('4616', 'Instituto Politécnico da Lusofonia - Escola Superior de Educação da Lusofonia', NULL, 22),
('4620', 'Universidade Fernando Pessoa - Escola Superior de Saúde da Fundação «Fernando Pessoa»', NULL, 22),
('4626', 'Inst.Polit. Jean Piaget do Norte-Esc.Sup. Saúde Jean Piaget de Vila Nova de Gaia', NULL, 22),
('4627', 'Escola Superior de Desporto e Educação Jean Piaget de Vila Nova de Gaia', NULL, 22),
('4630', 'Universidade da Maia', NULL, 21),
('4640', 'Instituto Superior de Tecnologias Avançadas do Porto (ISTEC Porto)', NULL, 22),
('5402', 'Universidade do Porto - Faculdade de Belas-Artes', NULL, 11),
('6800', 'ISCTE - Instituto Universitário de Lisboa', NULL, 11),
('7001', 'Escola Superior de Enfermagem de Coimbra', NULL, 12),
('7002', 'Escola Superior de Enfermagem de Lisboa', NULL, 12),
('7003', 'Escola Superior de Enfermagem do Porto', NULL, 12),
('7005', 'Instituto Politécnico de Beja - Escola Superior de Saúde', NULL, 12),
('7010', 'Universidade do Minho - Escola Superior de Enfermagem', NULL, 12),
('7015', 'Instituto Politécnico de Bragança - Escola Superior de Saúde de Bragança', NULL, 12),
('7020', 'Instituto Politécnico de Castelo Branco - Escola Superior de Saúde Dr. Lopes Dias', NULL, 12),
('7030', 'Universidade de Évora - Escola Superior de Enfermagem de São João de Deus', NULL, 12),
('7035', 'Universidade do Algarve - Escola Superior de Saúde', NULL, 12),
('7040', 'Instituto Politécnico da Guarda - Escola Superior de Saúde da Guarda', NULL, 12),
('7045', 'Instituto Politécnico de Leiria - Escola Superior de Saúde', NULL, 12),
('7055', 'Instituto Politécnico de Portalegre - Escola Superior de Saúde', NULL, 12),
('7065', 'Instituto Politécnico de Santarém - Escola Superior de Saúde de Santarém', NULL, 12),
('7075', 'Instituto Politécnico de Viana do Castelo - Escola Superior de Saúde', NULL, 12),
('7080', 'Universidade de Trás-os-Montes e Alto Douro - Escola Superior de Saúde', NULL, 12),
('7085', 'Instituto Politécnico de Viseu - Escola Superior de Saúde de Viseu', NULL, 12),
('7092', 'Universidade dos Açores - Escola Superior de Saúde - Angra do Heroísmo', NULL, 12),
('7093', 'Universidade dos Açores - Escola Superior de Saúde - Ponta Delgada', NULL, 12),
('7105', 'Escola Superior Náutica Infante D. Henrique', NULL, 12),
('7110', 'Escola Superior de Hotelaria e Turismo do Estoril', NULL, 12),
('7210', 'Instituto Politécnico de Coimbra - Escola Superior de Tecnologia da Saúde de Coimbra', NULL, 12),
('7220', 'Instituto Politécnico de Lisboa - Escola Superior de Tecnologia da Saúde de Lisboa', NULL, 12),
('7230', 'Instituto Politécnico do Porto - Escola Superior de Saúde', NULL, 12),
('7530', 'Instituto Superior de Ciências Policiais e Segurança Interna', NULL, 13),
('7710', 'Instituto Universitário Militar - Escola Naval', NULL, 13),
('7711', 'Instituto Universitário Militar - Academia Militar', NULL, 13),
('7712', 'Instituto Universitário Militar - Academia da Força Aérea', NULL, 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `instituicoes_has_curso`
--

DROP TABLE IF EXISTS `instituicoes_has_curso`;
CREATE TABLE IF NOT EXISTS `instituicoes_has_curso` (
  `cursos_ID` varchar(4) NOT NULL,
  `instituicoes_ID` varchar(4) NOT NULL,
  `nota_ult` decimal(4,2) DEFAULT NULL,
  `plano_curso` longtext COMMENT 'Tabela do plano de cursos',
  PRIMARY KEY (`cursos_ID`,`instituicoes_ID`),
  KEY `fk_cursos_has_instituicoes_instituicoes1_idx` (`instituicoes_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos_curso`
--

DROP TABLE IF EXISTS `tipos_curso`;
CREATE TABLE IF NOT EXISTS `tipos_curso` (
  `ID` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos_ensino`
--

DROP TABLE IF EXISTS `tipos_ensino`;
CREATE TABLE IF NOT EXISTS `tipos_ensino` (
  `ID` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipos_ensino`
--

INSERT INTO `tipos_ensino` (`ID`, `nome`) VALUES
(11, 'Ensino Superior Público Universitário'),
(12, 'Ensino Superior Público Politécnico'),
(13, 'Ensino Superior Público Militar e Policial'),
(21, 'Ensino Superior Privado Universitário'),
(22, 'Ensino Superior Privado Universitário');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cidades`
--
ALTER TABLE `cidades`
  ADD CONSTRAINT `fk_cidades_distritos1` FOREIGN KEY (`distritos_ID`) REFERENCES `distritos` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `fk_cursos_tipos_curso1` FOREIGN KEY (`tipos_curso_ID`) REFERENCES `tipos_curso` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `instituicoes`
--
ALTER TABLE `instituicoes`
  ADD CONSTRAINT `fk_instituicoes_cidades` FOREIGN KEY (`cod_postal`) REFERENCES `cidades` (`cod_postal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_instituicoes_tipos_ensino1` FOREIGN KEY (`tipos_ensino_ID`) REFERENCES `tipos_ensino` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `instituicoes_has_curso`
--
ALTER TABLE `instituicoes_has_curso`
  ADD CONSTRAINT `fk_cursos_has_instituicoes_cursos1` FOREIGN KEY (`cursos_ID`) REFERENCES `cursos` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cursos_has_instituicoes_instituicoes1` FOREIGN KEY (`instituicoes_ID`) REFERENCES `instituicoes` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
