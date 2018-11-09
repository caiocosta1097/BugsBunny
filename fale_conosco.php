<?php

    // Importando o arquivo de conexão
    require_once('cms/conexao.php');

	// Variável que recebe o função com a conexão
    $conexao = conexaoBD();

	// Verifica se o submit foi clicado
    if(isset($_POST['btnEnviar'])){
        
		// Pega todos os valores inseridos no formulário e coloca em variáveis
        $nome = $_POST['txtNome'];
        $telefone = $_POST['txtTelefone'];
        $celular = $_POST['txtCelular'];
        $email = $_POST['txtEmail'];
        $homePage = $_POST['txtHomePage'];
        $facebook = $_POST['txtFacebook'];
        $sugestao = $_POST['txtSugestao'];
        $infProdutos = $_POST['txtInfoProdutos'];
        $sexo = $_POST['sltSexo'];
        $profissao = $_POST['txtProfissao'];
        
		// Variável que recebe o INSERT
        $sql = "INSERT INTO tbl_fale_conosco (nome, telefone, celular, email, homePage, facebook, sugestao, infoProdutos, sexo, profissao)
                VALUES ('".$nome."', '".$telefone."', '".$celular."', '".$email."', '".$homePage."', '".$facebook."', '".$sugestao."', '".$infProdutos."', '".$sexo."', '".$profissao."')";
        
		// Verifica se QUERY não pôde ser executada e exibe um erro, senão atualiza a página
        if(!mysqli_query($conexao, $sql))
            echo "Erro: ".mysqli_errno($conexao)." - ".mysqli_error($conexao);
		else
			header('location:fale_conosco.php');
        
    }

?>

<!DOCTYPE html>

<html lang="pt">

<head>
    <title>Bugs Bunny - A banca digital</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="engine1/style.css" />
    <script src="engine1/jquery.js"></script>
    <script src="jquery/jquery-1.10.1.min.js"></script>
    <script src="jquery/jquery.maskedinput.js"></script>
    <script>

        // Função de máscara para telefone e celular
        $(document).ready(function() {
            $("#txtTelefone").mask("(99) 9999-9999");
            $("#txtCelular").mask("(99) 99999-9999");
        });
            
        // Função para só ser digitado letras na caixa do nome
        function Validar(caracter, campo) {

            if (window.event)
                // Pegando o código na tabela ASCII da tecla digitada
                var letra = caracter.charCode;

            else
                // Pegando o código na tabela ASCII da tecla digitada
                 var letra = caracter.which;
                
            // Verificando se caracteres especiais ou números foram digitados
            if (letra >= 33 && letra <= 64 || letra >= 91 && letra <= 93 || letra == 95 || letra >= 123 && letra <= 125)   
                // Bloqueando esses caracteres
                return false;

        }
            
        </script>
</head>

<body>
    <!--  Cabeçalho  -->
    <header>
        <div id="caixa_cabecalho">
            <!--  Logo  -->
            <div id="logo_Banca"></div>
            <!--  Menu  -->
            <nav id="menu_principal">
                <div class="itens_menu"><a href="index.php">Home</a></div>
                <div class="itens_menu"><a href="noticias.php">Notícias</a></div>
                <div class="itens_menu"><a href="sobre.php">Sobre a Banca</a></div>
                <div class="itens_menu"><a href="promocoes.php">Promoções</a></div>
                <div class="itens_menu"><a href="nossas_bancas.php">Nossas Bancas</a></div>
                <div class="itens_menu"><a href="celebridade_do_mes.php">Celebridade do mês</a></div>
                <div class="itens_menu"><a href="fale_conosco.php">Fale Conosco</a></div>
            </nav>
            <!--  Área de login  -->
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
            <!--  Redes sociais  -->
            <div id="social">
                <img src="imagens/facebook.png" alt="Facebook" title="Facebook" class="imagens_social">
                <img src="imagens/instagram.png" alt="Instagram" title="Instagram" class="imagens_social">
                <img src="imagens/twitter.png" alt="Twitter" title="Twitter" class="imagens_social">
            </div>
        </div>
    </header>
    <!--  Div principal da página  -->
    <div id="principal_fale_conosco">
        <!--  Área do slider  -->
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
        <!--  Área de conteúdo  -->
        <div id="conteudo_fale_conosco">
            <!--  Título da página  -->
            <div class="titulo_pagina">Fale Conosco</div>
            <form name="frm_fale_conosco" action="fale_conosco.php" method="post">
                <div class="subtitulo">As caixas destacadas com "*" são obrigatórias</div>
                <!--  Tabela com as caixas de textos  -->
                <table>
                    <tr>
                        <td class="td_esquerda">
                            <label>Nome *</label>
                        </td>
                        <td>
                            <input name="txtNome" class="dados" id="txtNome" type="text" required onkeypress="return Validar(event, this.id);">
                        </td>
                    </tr>
                    <tr>
                        <td class="td_esquerda">
                            <label>Telefone</label>
                        </td>
                        <td>
                            <input name="txtTelefone" id="txtTelefone" class="dados" type="text">
                        </td>
                    </tr>
                    <tr>
                        <td class="td_esquerda">
                            <label>Celular *</label>
                        </td>
                        <td>
                            <input name="txtCelular" id="txtCelular" class="dados" type="text" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_esquerda">
                            <label>Email *</label>
                        </td>
                        <td>
                            <input name="txtEmail" class="dados" type="email" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_esquerda">
                            <label>Home Page</label>
                        </td>
                        <td>
                            <input name="txtHomePage" class="dados" type="url">
                        </td>
                    </tr>
                    <tr>
                        <td class="td_esquerda">
                            <label>Link no Facebook</label>
                        </td>
                        <td>
                            <input name="txtFacebook" class="dados" type="url">
                        </td>
                    </tr>
                    <tr>
                        <td class="td_esquerda">
                            <label>Sugestão/Criticas</label>
                        </td>
                        <td>
                            <textarea name="txtSugestao" class="dados" style="height:100px; width:300px;"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_esquerda">
                            <label>Informações de Produtos</label>
                        </td>
                        <td>
                            <textarea name="txtInfoProdutos" class="dados" style="height:100px; width:300px;"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_esquerda">
                            <label>Sexo *</label>
                        </td>
                        <td>
                            <select name="sltSexo" class="dados" id="sltSexo">
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_esquerda">
                            <label>Profissão *</label>
                        </td>
                        <td>
                            <input name="txtProfissao" class="dados" type="text" required>
                        </td>
                    </tr>
                    <tr>
                        <td id="td_botao" colspan="2">
                            <input name="btnEnviar" type="submit">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <!--  Rodapé  -->
    <footer>
        <div id="conteudo_footer">
            © 2018 Bugs Bunny - A banca digital. Todos os direitos reservados.
        </div>
    </footer>
</body>

</html>