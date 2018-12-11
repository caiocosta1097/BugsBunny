CREATE DATABASE  IF NOT EXISTS `db_banca_inf3m` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_banca_inf3m`;
-- MySQL dump 10.13  Distrib 8.0.13, for Win64 (x86_64)
--
-- Host: localhost    Database: db_banca_inf3m
-- ------------------------------------------------------
-- Server version	8.0.13

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_categoria`
--

DROP TABLE IF EXISTS `tbl_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categoria`
--

LOCK TABLES `tbl_categoria` WRITE;
/*!40000 ALTER TABLE `tbl_categoria` DISABLE KEYS */;
INSERT INTO `tbl_categoria` VALUES (1,'Livros',0),(2,'Revistas',1),(3,'Celulares',0),(4,'Brinquedos',0),(5,'Mídias',0);
/*!40000 ALTER TABLE `tbl_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_celebridade`
--

DROP TABLE IF EXISTS `tbl_celebridade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_celebridade` (
  `idCelebridade` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dtNasci` date NOT NULL,
  `profissao` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `naturalidade` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `biografia` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`idCelebridade`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_celebridade`
--

LOCK TABLES `tbl_celebridade` WRITE;
/*!40000 ALTER TABLE `tbl_celebridade` DISABLE KEYS */;
INSERT INTO `tbl_celebridade` VALUES (9,'Marina Ruy Barbosa','1995-06-30','Atriz','Rio de Janeiro - RJ','arquivos/8c155289a177a31248114f1561b20d69.jpg','Marina Souza Ruy Barbosa é uma atriz brasileira que deu os primeiros passos na carreira com apenas 8 anos, no filme \"Xuxa e o Tesouro da cidade perdida\", em 2005. A pequena se destacava pelos cabelos longos e ruivos, sua marca registrada até hoje. Depois do filme, participou da novela \"Começar de novo\", da TV Globo, mas o reconhecimento profissional viria em \"Belíssima\", quando interpretou Sabrina. Posteriormente, Marina atuou nas novelas \"Sete Pecados\", \"Escrito nas Estrelas\", \"Morde & Assopra\" e \"Amor Eterno Amor\".\r\n \r\nA atriz iniciou um namoro com o ator Klebber Toledo durante as gravações de \"Morde & assopra\", em 2011, seu companheiro de cenas na trama de Walcyr Carrasco. Desde então, não saiu mais da mídia. Marina também se destaca quando o assunto é moda. Seu estilo e bom gosto sempre estampam revistas e sites especializados. Em 2012, recebeu uma proposta de uma marca de tintura para pintar seu cabelo por R$ 1 milhão, mas não aceitou.\r\n \r\nEm 2013 participa da telenovela \"Amor à Vida\" de Walcyr Carrasco, interpretando Nicole, uma jovem órfã e milionária que morre no altar no dia do seu casamento. No ano seguinte, se destacou mais uma vez no horário nobre interpretando a ninfeta Maria Isis, par romântico de José Alfredo de Medeiros (Alexandre Nero) na novela \"Império\".\r\n \r\nEm agosto, termina o namoro de três anos com Klebber Toledo e em setembro assume um novo romance, com o empresário Caio Nabuco. Após nove meses juntos, eles romperam o relacionamento em junho de 2015. Marina iniciou um relacionamento com o piloto Xandinho Negrão em janeiro de 2017 e em 07 de outubro do mesmo ano os dois se casaram em uma cerimônia para 800 pessoas realizada na fazenda do pai dele, em Campinas, interior de São Paulo.',0);
/*!40000 ALTER TABLE `tbl_celebridade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_fale_conosco`
--

DROP TABLE IF EXISTS `tbl_fale_conosco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_fale_conosco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `celular` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `homePage` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `sugestao` text,
  `infoProdutos` text,
  `sexo` varchar(1) NOT NULL,
  `profissao` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_fale_conosco`
--

LOCK TABLES `tbl_fale_conosco` WRITE;
/*!40000 ALTER TABLE `tbl_fale_conosco` DISABLE KEYS */;
INSERT INTO `tbl_fale_conosco` VALUES (2,'Caio da Costa Carmo','(11) 4553-0364','(11) 99136-4396','caio.costacarmo@gmail.com','http://localhost/Caio/BugsBunny/index.php','https://www.facebook.com/caio.costacarmo.3','Poderia ter um catálogo maior de HQs e livros.','','M','Estudante');
/*!40000 ALTER TABLE `tbl_fale_conosco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nivel_usuario`
--

DROP TABLE IF EXISTS `tbl_nivel_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_nivel_usuario` (
  `idNivel` int(11) NOT NULL AUTO_INCREMENT,
  `nomeNivel` varchar(45) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`idNivel`),
  UNIQUE KEY `nomeNivel_UNIQUE` (`nomeNivel`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nivel_usuario`
--

LOCK TABLES `tbl_nivel_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_nivel_usuario` DISABLE KEYS */;
INSERT INTO `tbl_nivel_usuario` VALUES (10,'Administrador',0),(21,'Operador Básico',0),(22,'Cataloguista',0);
/*!40000 ALTER TABLE `tbl_nivel_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nossas_bancas`
--

DROP TABLE IF EXISTS `tbl_nossas_bancas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_nossas_bancas` (
  `idBanca` int(11) NOT NULL AUTO_INCREMENT,
  `local` varchar(45) NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`idBanca`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nossas_bancas`
--

LOCK TABLES `tbl_nossas_bancas` WRITE;
/*!40000 ALTER TABLE `tbl_nossas_bancas` DISABLE KEYS */;
INSERT INTO `tbl_nossas_bancas` VALUES (8,'Tatuapé','Avenida Cantagalo, 666','Tatuapé','(11) 4789-5829',0);
/*!40000 ALTER TABLE `tbl_nossas_bancas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_noticias`
--

DROP TABLE IF EXISTS `tbl_noticias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_noticias` (
  `idNoticia` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `foto` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`idNoticia`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_noticias`
--

LOCK TABLES `tbl_noticias` WRITE;
/*!40000 ALTER TABLE `tbl_noticias` DISABLE KEYS */;
INSERT INTO `tbl_noticias` VALUES (26,'Bolsonaro diz que Heleno pode ir para o GSI e ','arquivos/4807d367988b6a2c72d4382251a2aaf4.jpg',0),(28,'Liverpool perde na Sérvia e embola o grupo do PSG','arquivos/e2bec38e84894d686374a7f2850d6b20.jpg',0),(29,'O PT tem que visitar seus demônios, afirma ex-ministro de Lula e Dilma','arquivos/5f581c62894778817fbac786f21d4685.jpg',0),(30,'Operação do Bope na Maré deixa 5 mortos e 8 feridos','arquivos/baf76b1cea9509dfe4e47708706b20cc.jpg',0);
/*!40000 ALTER TABLE `tbl_noticias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_produto`
--

DROP TABLE IF EXISTS `tbl_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_produto` (
  `idProduto` int(11) NOT NULL AUTO_INCREMENT,
  `produto` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `preco` decimal(7,2) NOT NULL,
  `idSubcategoria` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`idProduto`),
  KEY `FK_tbl_produto_tbl_subcategoria_idx` (`idSubcategoria`),
  CONSTRAINT `FK_tbl_produto_tbl_subcategoria` FOREIGN KEY (`idSubcategoria`) REFERENCES `tbl_subcategoria` (`idsubcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_produto`
--

LOCK TABLES `tbl_produto` WRITE;
/*!40000 ALTER TABLE `tbl_produto` DISABLE KEYS */;
INSERT INTO `tbl_produto` VALUES (2,'Dois a Dois','Com uma carreira bem-sucedida, uma linda esposa e uma adorável filha de 6 anos, Russell Green tem uma vida de dar inveja. Ele está tão certo de que essa paz reinará para sempre que não percebe quando a situação começa a sair dos trilhos.\r\n\r\nEm questão de meses, Russ perde o emprego e a confiança da esposa, que se afasta dele e se vê obrigada a voltar a trabalhar. Precisando lutar para se adaptar a uma nova realidade, ele se desdobra para cuidar da filhinha, London, e começa a reinventar a vida profissional e afetiva ¿ e a se abrir para antigas e novas emoções.\r\n\r\nLançando-se nesse universo desconhecido, Russ embarca com London numa jornada ao mesmo tempo assustadora e gratificante, que testará suas habilidades e seu equilíbrio emocional além do que ele poderia ter imaginado. Em Dois a dois, Nicholas Sparks conta a história de um homem que precisa se redescobrir e buscar qualidades que nem desconfiava possuir para lutar pelo que é mais importante na vida: aqueles que amamos.',23.62,1,0,'arquivos/1e212f1808b1f6167471c8396b262d84.jpg'),(3,'Vade Mecum Tradicional','Pioneira na exemplar técnica desenvolvida de atualização de Códigos e Legislação, como comprova o avançado número de suas edições e versões, a Editora Saraiva apresenta a edição aumentada e atualizada de sua principal obra: o Vade Mecum Saraiva. Com novo projeto gráfico, conta com o acréscimo de mais de 120 diplomas (entre leis, decretos, regimentos internos etc.) em relação à edição anterior. Assim, passa a reunir as normas mais importantes do ordenamento jurídico brasileiro.',57.90,3,0,'arquivos/e98dad7a0f8dbd8cb55d1b15e571ecfa.jpg'),(4,'A Sutil Arte de Ligar o F*da-se','Coaching, autoajuda, desenvolvimento pessoal, mentalização positiva sem querer desprezar o valor de nada disso, a grande verdade é que às vezes nos sentimos quase sufocados diante da pressão infinita por parecermos otimistas o tempo todo. É um pecado social se deixar abater quando as coisas não vão bem. Ninguém pode fracassar simplesmente, sem aprender nada com isso. Não dá mais. É insuportável. E é aí que entra a revolucionária e sutil arte de ligar o foda-se.\r\nMark Manson usa toda a sua sagacidade de escritor e seu olhar crítico para propor um novo caminho rumo a uma vida melhor, mais coerente com a realidade e consciente dos nossos limites. E ele faz isso da melhor maneira. Como um verdadeiro amigo, Mark se senta ao seu lado e diz, olhando nos seus olhos: você não é tão especial. Ele conta umas piadas aqui, dá uns exemplos inusitados ali, joga umas verdades na sua cara e pronto, você já se sente muito mais alerta e capaz de enfrentar esse mundo cão. Para os céticos e os descrentes, mas também para os amantes do gênero, enfim uma abordagem franca e inteligente que vai ajudar você a descobrir o que é realmente importante na sua vida, e f*da-se o resto. Livre-se agora da felicidade maquiada e superficial e abrace esta arte verdadeiramente transformadora. ',23.92,4,0,'arquivos/51710bd88c4dfb5aae7f795788948545.jpg'),(5,'O Milagre da Manhã','Conheça o método simples e eficaz que vai proporcionar a vida dos sonhos ¿ antes das 8 horas da manhã!\r\n\r\nHal Elrod explica os benefícios de acordar cedo e desenvolver todo o nosso potencial e as nossas habilidades. O milagre da manhã permite que o leitor alcance níveis de sucesso jamais imaginados, tanto na vida pessoal quanto profissional. \r\n\r\nA mudança de hábitos e a nova rotina matinal proposta por Hal vai proporcionar melhorias significativas na saúde, na felicidade, nos relacionamentos, nas finanças, na espiritualidade ou quaisquer outras áreas que necessitem ser aprimoradas. ',27.92,4,0,'arquivos/bf29a32783255e56b43575e5b912f44b.jpg'),(6,'Kit As Crônicas de Gelo e Fogo','Quando Eddard Stark, lorde do castelo de Winterfell, aceita a prestigiada posição de Mão do Rei oferecida pelo velho amigo, o rei Robert Baratheon, não descon a que sua vida está prestes a ruir em sucessivas tragédias. Sabe-se que Lorde Stark aceitou a proposta porque descon a que o dono anterior do título fora envenenado pela manipuladora rainha - uma cruel mulher do clã Lannister. E sua intenção é proteger o rei. Mas ter como inimigo os Lannister pode ser fatal: a ambição dessa família pelo poder parece não ter limites e o rei corre grande perigo. Agora, sozinho na corte, Eddard percebe que não só o rei está em apuros, mas também ele e toda a sua família. Quem vencerá a guerra dos tronos?',59.99,5,0,'arquivos/646c8cfb0220f9b0aaae89f8daa77747.jpg'),(7,'Detroit Become Human - PS4','Detroit Become Human.',89.50,20,0,'arquivos/29e728397b034376145e220880698d25.jpg'),(8,'Red Dead Redemption 2 - Xbox One','Estados Unidos, 1899. O fim da era do velho oeste começou, e as autoridades estão caçando as últimas gangues de fora da lei que restam. ',238.88,20,0,'arquivos/e144e30296183ab9c88a8c5a84fc362c.jpg'),(9,'FIFA 19 - PS4','Feito com Frostbite, EA SPORTS FIFA 19 entrega uma experiência campeã dentro e fora do campo. \r\nDo aspecto tático à cada toque técnico, Controle O Campo em cada momento com novos elementos de gameplay no EA SPORTS FIFA 19. O novíssimo Sistema Ativo de Toque permite controle mais próximo, Táticas Dinâmicas possibilitam configurações de equipe mais profundas e acessíveis, Batalhas 50/50 permitem maior fisicalidade e mais habilidade do usuário nas disputas por bolas perdidas, Finalizações Cadenciadas eleva o controle do usuário atacando, e a evolução da Tecnologia Real Player Motion continua a melhorar as personalidades dos jogadores com animações autênticas e realistas.',229.90,20,0,'arquivos/1fb25e2a0c0a7f271947a57955b03258.jpg'),(10,'Genius - Estrela','O clássico dos anos 80 está de volta! As crianças vão adorar esse incrível desafio. Para se sair bem nessa divertida competição tem de ter habilidade e boa memória. É preciso também pensar rápido e tentar repetir as sequências de luzes e sons sem errar.\r\nSeu filho pode se reunir com os amiguinhos e começar a brincadeira. O Genius traz diversas combinações para testar e desafiar o poder de concentração dos participantes.\r\nCom esse brinquedo eletrônico, os pequenos terão à disposição três jogos e quatro níveis de dificuldade para deixar o jogo ainda mais emocionante. ',184.99,16,0,'arquivos/da6a380c0b106ec29034eddc5edecfae.jpg'),(11,'Super Cara a Cara - Estrela','O Cara a Cara está de caras novas!\r\nO jogo Cara a Cara agora na versão eletrônica! Muito mais moderno para tornarem este clássico ainda mais divertido! Esse jogo é ideal para treinar a capacidade de dedução e memória das crianças com idade a partir de 6 anos. Será preciso adivinhar de quem é a cara que o adversário esconde. É adivinhar e morrer de rir!',159.90,16,0,'arquivos/c3c5aa9e63e984f70092460d923da32e.jpg'),(12,'Colonizadores De Catan - Grow','Catan é o nome que deram à ilha que os jogadores vão colonizar.\r\nA todo o momento surgem novas ruas. Matérias-primas são negociadas e pequenas aldeias tornam-se cidades. Em alguns momentos há madeira em abundância, em outros, minério.\r\nA constante troca de mercadorias cria oportunidades para todos. Mas não demora muito e os espaços diminuem e tem início uma emocionante disputa por terras, matérias-primas e poder. Porém uma coisa fica bem clara: só pode haver um soberano em Catan.\r\n',167.70,16,0,'arquivos/76774c3abca29755620ed2294aeb16ff.jpg'),(13,'LEGO Juniors - Jurassic World - Fuga T-Rex','Incentive a criatividade dos pequenos desde cedo com LEGO Juniors - Jurassic World - Fuga T-Rex - 10758 Os pequenos também podem recriar as cenas do filme LEGO Jurassic World neste divertido conjunto Vigie as cancelas, um T. rex anda à solta! Ajude Claire e o cientista a tomar conta do bebê dinossauro e dos ovos, enquanto o guarda sobe a escada para procurar o dinossauro gigante. Coloque o cachorro-quente no braço robótico e distraia o T. rex para longe da cancela. Depois carregue os ovos na traseira do caminhão, abra as cancelas e parta a toda a velocidade para um local seguro!',379.90,17,0,'arquivos/30bbf4876b7647ea7b8d1a081a689301.jpg'),(14,'LEGO Harry Potter - O Expresso De Hogwarts','LEGO Harry Potter - O Expresso De Hogwarts - 75955',549.00,17,0,'arquivos/4ebad8d28829a5be5b458497ed49a27c.jpg'),(15,'LEGO Classic - Caixa Grande de Peças Criativas','Construa muitas coisas com esta caixa grande de peças clássicas LEGO em 33 cores diferentes. Com muitas janelas e portas diferentes, juntamente com outras peças especiais que o vão inspirar a imaginação. Com ideias que ajudam você a começar, este conjunto fornece as ferramentas necessárias para que os novos construtores de todas as idades se divirtam com a construção clássica LEGO. Vem numa prática caixa de arrumação de plástico e é o complemento ideal para qualquer coleção LEGO. ',332.90,17,0,'arquivos/57d69187a04dd3163062d2f3dcc5ac89.jpg'),(16,'Pelúcia Galinha Pintadinha - Multibrink','Muito querida pelas crianças, a Galinha Pintadinha vai alegrar os pequenos com suas canções. Fofa, supermacia, cativante e gostosa de apertar, essa pelúcia é atóxica assim como o enchimento de fibra.\r\nAs crianças vão adorar levar a nova amiguinha para todos os lugares e até mesmo dormir com ela. ',129.90,18,0,'arquivos/30f86272fb7942a8c4180cb8ac4669ee.jpg'),(17,'Pokémon-Pelúcia Pikachu Tomy','Pelúcia Pikachu, O Personagem Mais Famoso Do Pokémon, Para A Criançada Levar Pra Onde Quiser!',119.99,18,0,'arquivos/5a681f730d39fb963ffe56860bbb5bd5.jpg'),(18,'PS4 Slim - 500GB','Desfrute dos melhores Games.\r\n\r\nTecnologia Bluetooth sem fio\r\n\r\nJogos em Alta definição',2399.90,21,0,'arquivos/8e0cd474713591b3118ff30619c98325.jpg'),(19,'Xbox One S 500GB','Microsoft Xbox One S\r\nNo novo Xbox One S, você pode se divertir com a maior linha de jogos, incluindo jogos clássicos do Xbox 360, em um console 40% menor. Armazene mais jogos do que nunca com um enorme disco rígido de 500GB. Assista a filmes Blu ray UHD na impressionante fidelidade visual.\r\nEm seguida, experimente o maior conforto e sensação do novo controle sem fio do Xbox, com analógico texturizado e tecnologia Bluetooth. Com todos os maiores sucessos deste ano, tudo o que você ama sobre Xbox 360 ainda melhor no Xbox One.',1599.00,21,0,'arquivos/19da83c0de5df376c712f80989d9bb29.jpg'),(20,'It: A Coisa','Durante as férias escolares de 1958, em Derry, pacata cidadezinha do Maine, Bill, Richie, Stan, Mike, Eddie, Ben e Beverly aprenderam o real sentido da amizade, do amor, da confiança e... do medo. O mais profundo e tenebroso medo. Naquele verão, eles enfrentaram pela primeira vez A Coisa, um ser sobrenatural e maligno que deixou terríveis marcas de sangue em Derry.\r\n\r\nQuase trinta anos depois, os amigos voltam a se encontrar. Uma nova onda de terror tomou a pequena cidade. Mike Hanlon, o único que permanece em Derry, dá o sinal. Precisam unir forças novamente. A Coisa volta a atacar e eles devem cumprir a promessa selada com sangue que fizeram quando crianças. Só eles têm a chave do enigma. Só eles sabem o que se esconde nas entranhas de Derry. O tempo é curto, mas somente eles podem vencer a Coisa. \r\n\r\nEm It: A Coisa, clássico de Stephen King em nova edição, os amigos irão até o fim, mesmo que isso signifique ultrapassar os próprios limites. ',74.32,6,0,'arquivos/ebbc604ff3fd33fb348eb5be1d379d32.jpg'),(21,'Anjos na Escuridão - Série Fallen','Sete contos inéditos com personagens da série fallen!\r\n\r\nOferecendo uma visão adicional ao mundo de Fallen, Anjos Na Escuridão conta sete histórias inéditas. Acompanhe Ariane num arroubo consumista, Daniel vagando pelas ruas de Los Angeles, Miles flertando com a escuridão, uma cena desagradável em Shoreline e até mesmo o incêndio que leva Luce para o internato. Cada uma dessas aventuras ilumina um pouco mais o que se passou durante os séculos em que Daniel e Luce tentaram vencer a maldição. \r\nMergulhe nos bastidores do romance mais comentado do planeta.',23.93,6,0,'arquivos/efb6019d790a9ec1963bd928e5fff55a.jpg'),(22,'iPhone 8 64GB','iPhone 8 64GB Cinza Espacial Tela 4.7\" IOS 4G Câmera 12MP - Apple',3849.99,15,0,'arquivos/9a9c3468eca10214861610cfaea1bdab.png'),(23,'iPhone Xs Max','\r\nFoto 1 - iPhone Xs Max Ouro 256GB IOS12 4G + Wi-fi Câmera 12MP - Apple\r\nFoto 2 - iPhone Xs Max Ouro 256GB IOS12 4G + Wi-fi Câmera 12MP - Apple\r\nFoto 3 - iPhone Xs Max Ouro 256GB IOS12 4G + Wi-fi Câmera 12MP - Apple\r\nFoto 4 - iPhone Xs Max Ouro 256GB IOS12 4G + Wi-fi Câmera 12MP - Apple\r\niPhone Xs Max Ouro 256GB IOS12 4G + Wi-fi Câmera 12MP - Apple',8799.00,15,0,'arquivos/04ce48bb9b63e45c300df7e3184ad3e9.jpg'),(24,' Samsung Galaxy J5 ','Smartphone Samsung Galaxy J5 Pro Dual Chip Android 7.0 Tela 5,2\" Octa-Core 1.6 GHz 32GB 4G Câmera 13MP - Dourado',1249.00,14,0,'arquivos/27bd5b812ae1c01c3d5d81485d87126e.png'),(25,'Samsung Galaxy S9+','Smartphone Samsung Galaxy S9+ Dual Chip Android 8.0 Tela 6.2\" Octa-Core 2.8GHz 128GB 4G Câmera 12MP Dual Cam - Preto',3499.00,14,0,'arquivos/1b141f661d40976bb941b94a6d706454.png'),(26,'The Rolling Stones - Ladies And Gentlemen','\"Ladies And Gentlemen... The Rolling Stones\" finalmente chega em Blu-ray. Esta lendária gravação ao vivo do Rolling Stones, filmada em quatro noites no Texas durante a turnê \"Exile On Main Street\", de 1972, foi lançada nos cinemas para poucas exibições, em 1974, e permaneceu inédita por longo tempo. Agora, restaurada e remasterizada, \"Ladies And Gentlemen... The Rolling Stones\" faz sua primeira aparição autorizada em Blu-ray. Este é um dos melhores shows do Rolling Stones gravados e traz apresentações arrebatadoras de clássicos do fim dos anos 1960 e do início dos 1970. Nos extras, imagens de ensaio para a turnê gravadas na Suíça jamais lançadas e entrevistas com Mick Jagger de 1972 e 2010. ',18.99,19,0,'arquivos/9f2f8cec2dc1da8f7274371e5e58845d.jpg'),(27,'Jack Reacher 2 - Sem Retorno','Jack Reacher (Tom Cruise) retorna à base militar onde serviu na Virgínia, onde pretende levar uma major local, Susan Turner (Cobie Smulders), para jantar. Só que, logo ao chegar, descobre que ela está presa, acusada de ter vazado informações confidenciais do exército. Estranhando a situação, Reacher resolve iniciar uma investigação por conta própria e logo descobre que o caso é bem mais pessoal do que imaginava.',29.90,19,0,'arquivos/db910ab1c109e8aab157b6d5b940676a.jpg');
/*!40000 ALTER TABLE `tbl_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_promocoes`
--

DROP TABLE IF EXISTS `tbl_promocoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_promocoes` (
  `idPromocao` int(11) NOT NULL AUTO_INCREMENT,
  `idProduto` int(11) NOT NULL,
  `desconto` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`idPromocao`),
  KEY `FK_tbl_promocoes_tbl_produto_idx` (`idProduto`),
  CONSTRAINT `FK_tbl_promocoes_tbl_produto` FOREIGN KEY (`idProduto`) REFERENCES `tbl_produto` (`idproduto`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_promocoes`
--

LOCK TABLES `tbl_promocoes` WRITE;
/*!40000 ALTER TABLE `tbl_promocoes` DISABLE KEYS */;
INSERT INTO `tbl_promocoes` VALUES (14,9,30,0),(15,23,15,0),(16,20,5,0),(17,18,55,0),(18,11,20,0);
/*!40000 ALTER TABLE `tbl_promocoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sobre`
--

DROP TABLE IF EXISTS `tbl_sobre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_sobre` (
  `idSobre` int(11) NOT NULL AUTO_INCREMENT,
  `historia` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dataVersao` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`idSobre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sobre`
--

LOCK TABLES `tbl_sobre` WRITE;
/*!40000 ALTER TABLE `tbl_sobre` DISABLE KEYS */;
INSERT INTO `tbl_sobre` VALUES (3,'Banca Bugs Bunny, foi fundada pelo Sr. Daffy Duck e tem mais de 10 anos de tradição em atrair clientes por seus variados tipos de jornais, revistas nacionais e importadas, produtos de conveniência, charutos, cigarrilhas, doces, chocolates, além de ter um ambiente muito agradável e amistoso onde todos os visitantes e profissionais são tratados com muito respeito e profissionalismo.\r\n','arquivos/458478bfd344425694b7c061ce95c49c.jpeg','06/11/2018 18:40:45',0);
/*!40000 ALTER TABLE `tbl_sobre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_subcategoria`
--

DROP TABLE IF EXISTS `tbl_subcategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_subcategoria` (
  `idSubcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `subcategoria` varchar(50) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`idSubcategoria`),
  KEY `FK_tbl_subcategoria_tbl_categoria_idx` (`idCategoria`),
  CONSTRAINT `FK_tbl_subcategoria_tbl_categoria` FOREIGN KEY (`idCategoria`) REFERENCES `tbl_categoria` (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_subcategoria`
--

LOCK TABLES `tbl_subcategoria` WRITE;
/*!40000 ALTER TABLE `tbl_subcategoria` DISABLE KEYS */;
INSERT INTO `tbl_subcategoria` VALUES (1,'Romance',1,0),(2,'CDs',5,1),(3,'Direito',1,0),(4,'Autoajuda',1,0),(5,'Ficção',1,0),(6,'Terror',1,0),(7,'Construção',1,1),(8,'Automóveis',2,0),(9,'Games',2,0),(10,'Esportes',2,0),(11,'Negócios',2,0),(14,'Android',3,0),(15,'iOS',3,0),(16,'Jogos',4,0),(17,'LEGO',4,0),(18,'Pelúcias',4,0),(19,'Blu-Rays',5,0),(20,'Games',5,0),(21,'Consoles',4,0);
/*!40000 ALTER TABLE `tbl_subcategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuario`
--

DROP TABLE IF EXISTS `tbl_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `login` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `idNivel` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  KEY `FK_tbl_usuario_tbl_nivel_usuario_idx` (`idNivel`),
  CONSTRAINT `FK_tbl_usuario_tbl_nivel_usuario` FOREIGN KEY (`idNivel`) REFERENCES `tbl_nivel_usuario` (`idnivel`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario`
--

LOCK TABLES `tbl_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_usuario` DISABLE KEYS */;
INSERT INTO `tbl_usuario` VALUES (4,'Caio da Costa Carmo','admin','21232f297a57a5a743894a0e4a801fc3','caio.costacarmo@gmail.com',10),(20,'David Bitencourt','david97','55fc5b709962876903785fd64a6961e5','david@gmail.com',21),(21,'Igor Feitosa','igorTeste','c2d53eab1c3c169cc789ba7581fc7cfa','igor_feitosa@gmail.com',22);
/*!40000 ALTER TABLE `tbl_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'db_banca_inf3m'
--

--
-- Dumping routines for database 'db_banca_inf3m'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-11 12:23:15
