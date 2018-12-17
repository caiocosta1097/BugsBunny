<?php

	// Importando o arquivo de conexão
    require_once('cms/conexao.php');

	// Variável que recebe o função com a conexão
    $conexao = conexaoBD();

?>

<!DOCTYPE html>

<html lang="pt">

<head>
    <title>Bugs Bunny - A banca digital</title>
    <meta charset="utf-8">
    <meta name="theme-color" content="#3b5998">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="engine1/style.css" />
    <script src="engine1/jquery.js"></script>
</head>

<body>
    <!--  Cabeçalho  -->
    <header>
        <div id="caixa_cabecalho">
            <nav role="navigation" id="navigation">
                <div id="caixa_menu_mobile">
                    <input type="checkbox" />
                    <span></span>
                    <span></span>
                    <span></span>
                    <ul id="menu_mobile">
                        <a href="index.php"><li>Home</li></a>
                        <a href="noticias.php"><li>Notícias</li></a>
                        <a href="sobre.php"><li>Sobre a Banca</li></a>
                        <a href="promocoes.php"><li>Promoções</li></a>
                        <a href="nossas_bancas.php"><li>Nossas Bancas</li></a>
                        <a href="celebridade_do_mes.php"><li>Celebridade do mês</li></a>
                        <a href="fale_conosco.php"><li>Fale Conosco</li></a>
                    </ul>
                </div>
            </nav>
            <!-- Logo -->
            <div id="logo_Banca"></div>
            <!-- Menu -->
            <nav id="menu_principal">
                <div class="itens_menu"><a href="index.php">Home</a></div>
                <div class="itens_menu"><a href="noticias.php">Notícias</a></div>
                <div class="itens_menu"><a href="sobre.php">Sobre a Banca</a></div>
                <div class="itens_menu"><a href="promocoes.php">Promoções</a></div>
                <div class="itens_menu"><a href="nossas_bancas.php">Nossas Bancas</a></div>
                <div class="itens_menu"><a href="celebridade_do_mes.php">Celebridade do mês</a></div>
                <div class="itens_menu"><a href="fale_conosco.php">Fale Conosco</a></div>
            </nav>
            <!-- Área do login -->
            <div id="login">
                <form action="autenticar.php" method="post">
                    <div class="formulario">
                        <label>Usuário</label>
                        <br>
                        <input class="caixa_login" name="txtUsuario" type="text" required>
                    </div>
                    <div class="formulario">
                        <label>Senha</label>
                        <br>
                        <input class="caixa_login" name="txtSenha" type="password" required>
                    </div>
                    <div class="formulario">
                        <input name="btnLogin" type="submit" value="OK">
                    </div>
                </form>
            </div>
            <!-- Redes sociais -->
            <div id="social">
                <img src="imagens/facebook.png" alt="Facebook" title="Facebook" class="imagens_social">
                <img src="imagens/instagram.png" alt="Instagram" title="Instagram" class="imagens_social">
                <img src="imagens/twitter.png" alt="Twitter" title="Twitter" class="imagens_social">
            </div>
        </div>
    </header>
    <!--  Div principal da página  -->
    <div id="principal_noticias" class="clearfix">
        <!-- Área do slider -->
        <div id="wowslider-container1">
            <div class="ws_images">
                <ul>
                    <li><img src="data1/images/imagem1.png" alt="" title="" id="wows1_0" /></li>
                    <li><a href="http://wowslider.net"><img src="data1/images/imagem2.jpg" alt="bootstrap slideshow" title="imagem2" id="wows1_1" /></a></li>
                    <li><img src="data1/images/imagem3.jpg" alt="imagem3" title="imagem3" id="wows1_2" /></li>
                </ul>
            </div>
            <div class="ws_bullets">
                <div>
                    <a href="#" title=""><span><img src="data1/tooltips/imagem1.png" alt="" />1</span></a>
                    <a href="#" title="imagem2"><span><img src="data1/tooltips/imagem2.jpg" alt="imagem2" />2</span></a>
                    <a href="#" title="imagem3"><span><img src="data1/tooltips/imagem3.jpg" alt="imagem3" />3</span></a>
                </div>
            </div>
        </div>
        <script src="engine1/wowslider.js"></script>
        <script src="engine1/script.js"></script>
        <!-- Área de conteúdo -->
        <div id="conteudo_noticias">
            <?php
                
				// Variável que recebe o SELECT do banco onde o status = 0 (ativado)
                $sql = "SELECT * FROM tbl_noticias WHERE status = 0";

				// Variável que executa o SELECT
                $select  = mysqli_query($conexao, $sql);

				// Loop para pegar cada registro no SELECT e colocar em um array
                while($rsNoticias = mysqli_fetch_array($select)){
                
            ?>
            <!-- Caixa com as notícias -->
            <div class="noticia">
                <div class="imagens_noticia">
                    <img src="cms/<?= $rsNoticias['foto'] ?>" class="imagens_conteudo" alt="<?= $rsNoticias['titulo'] ?>" title="<?= $rsNoticias['titulo'] ?>">
                </div>
                <div class="titulo_noticia">
                    <?= $rsNoticias['titulo'] ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <!-- Rodapé -->
    <footer>
        <div id="conteudo_footer">
            © 2018 Bugs Bunny - A banca digital. Todos os direitos reservados.
        </div>
        <div id="conteudo_footer_mobile">
        <h1> © 2018 Bugs Bunny - A banca digital. </h1>
        <div id="social_mobile">
            <img src="imagens/facebook.png" alt="Facebook" title="Facebook" class="imagens_social">
            <img src="imagens/instagram.png" alt="Instagram" title="Instagram" class="imagens_social">
            <img src="imagens/twitter.png" alt="Twitter" title="Twitter" class="imagens_social">
        </div>
    </div>
    </footer>
</body>

</html>