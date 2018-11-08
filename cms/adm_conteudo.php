<?php

    // Iniciando uma sessão
    session_start();

	// Importando o arquivo de conexão
    require_once('conexao.php');

	// Variável que recebe o função com a conexão
    $conexao = conexaoBD();

	// Verifica se a variável de sessão existe, senão redireciona para home
    if(isset($_SESSION['idUser'])){
        
		// Variável que recebe o id do user
        $idUser = $_SESSION['idUser'];

		// Variável que recebe o user do banco
        $sql = "SELECT * FROM tbl_usuario WHERE idUsuario =".$idUser;

		// Variável que executa o SELECT
        $select  = mysqli_query($conexao, $sql);
			
			// Verifica se retorna algum registro e coloca em um array
            if($rsUser = mysqli_fetch_array($select))
                $nomeUser = $rsUser['nome'];

			// Verifica se logout existe, encerra a variável de sessão e redireciona para home
            if(isset($_GET['logout'])){

                session_destroy();

                header('location:../index.php');

            }
        
    }else
        header('location:../index.php');   

?>

<!DOCTYPE html>

<html>
    <head>
        <title>CMS</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <!--  Cabeçalho  -->
        <header>
            <div id="caixa_cabecalho">
				<!--  Título do CMS  -->
                <div id="titulo_pagina">
                    <span id="negrito">CMS</span> - Sistema de Gerenciamento do Site
                </div>
				<!--  Logo  -->
                <div id="logo_pagina"></div>
            </div>
			<!--  Menu  -->
            <div id="caixa_menu">
                <nav id="menu_principal">
					<!--  Itens do menu  -->
                    <div class="itens_menu">
                        <a href="adm_conteudo.php">
                            <img class="imagens_menu" src="imagens/adm_conteudo.png">
                        </a>
                        <div class="titulo_menu">Adm. Conteúdo</div>
                    </div>
                    <div class="itens_menu">
                        <a href="adm_fale_conosco.php">
                            <img class="imagens_menu" src="imagens/adm_fale_conosco.png">
                        </a>    
                        <div class="titulo_menu">Adm. Fale Conosco</div>
                    </div>
                    <div class="itens_menu">
                        <img class="imagens_menu" src="imagens/adm_produtos.png">
                       <div class="titulo_menu">Adm. Produtos</div>
                    </div>
                    <div class="itens_menu">
                        <a href="adm_users.php">
                            <img class="imagens_menu" src="imagens/adm_usuarios.png">
                        </a>
                       <div class="titulo_menu">Adm. Usuários</div>
                    </div>
                </nav>
				<!--  Área de logout  -->
                <div id="area_logout">
                    <div id="boas_vindas">Bem vindo, <?= $nomeUser ?></div>
                    <div id="logout"><a href="index.php?logout">Logout</a></div>
                </div>
            </div>
        </header>
		<!--  Div principal da página  -->
        <div id="principal_adm_conteudo">
            <div id="opcoes_conteudo">
                <div class="itens_opcoes">
                    <a href="adm_noticias.php">
                        <img class="imagens_opcoes" src="imagens/adm_noticias.png">
                    </a>
                    <div class="titulo_opcoes">Adm. Notícias</div>
                </div>
                <div class="itens_opcoes">
                    <a href="adm_sobre.php">
                        <img class="imagens_opcoes" src="imagens/adm_sobre.png">
                    </a>
                    <div class="titulo_opcoes">Adm. Sobre</div>
                </div>
                <div class="itens_opcoes">
                    <a href="adm_promocoes.php">
                        <img class="imagens_opcoes" src="imagens/adm_promocoes.png">
                    </a>
                    <div class="titulo_opcoes">Adm. Promoções</div>
                </div>
                <div class="itens_opcoes">
                    <a href="adm_bancas.php">
                        <img class="imagens_opcoes" src="imagens/adm_bancas.png">
                    </a>
                    <div class="titulo_opcoes">Adm. Bancas</div>
                </div>
                <div class="itens_opcoes">
                    <a href="adm_celebridade.php">
                        <img class="imagens_opcoes" src="imagens/adm_celebridade.png">
                    </a>
                    <div class="titulo_opcoes">Adm. Celebridade</div>
                </div>
            </div>
        </div>
		<!-- Rodapé -->
        <footer></footer>
    </body>
</html>