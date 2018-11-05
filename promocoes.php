<?php

    require_once('conexao.php');

    $conexao = conexaoBD();

?>

<!DOCTYPE html>

<html lang="pt">

<head>
    <title>Bugs Bunny - A banca digital</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="engine1/style.css" />
    <script type="text/javascript" src="engine1/jquery.js"></script>
</head>

<body>
    <!--  Cabeçalho  -->
    <header>
        <div id="caixa_cabecalho">
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
                <form>
                    <div class="formulario">
                        <label>Usuário</label>
                        <br>
                        <input class="caixa_login" name="txtUSuario" type="text">
                    </div>
                    <div class="formulario">
                        <label>Senha</label>
                        <br>
                        <input class="caixa_login" name="txtSenha" type="text">
                    </div>
                    <div class="formulario">
                        <input name="btnLogin" type="button" value="OK">
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
    <div id="principal_promocoes">
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
        <div id="conteudo_promocoes" class="clearfix">
            <div id="produtos_promocao">
                <!-- Caixas com os produtos em promoção -->
                <?php
                
                    $sql = "SELECT * FROM tbl_promocoes WHERE status = 0";

                    $select  = mysqli_query($conexao, $sql);

                    while($rsContatos = mysqli_fetch_array($select)){
                
                ?>    
                <div class="caixa_produtos_promocao">
                    <div class="imagem_produto_promocao">
                        <img src="cms/<?= $rsContatos['foto'] ?>" alt="primeira guerra" class="imagens_promocao">
                    </div>
                    <div class="desconto">
                        <p>
                            <?= $rsContatos['promocao'] ?>
                        </p>
                    </div>
                    <div class="detalhes_promocao">
                        Confira
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Rodapé -->
    <footer>
        <div id="conteudo_footer">
            © 2018 Bugs Bunny - A banca digital. Todos os direitos reservados.
        </div>
    </footer>
</body>

</html>
