<?php

// Iniciando uma sessão
session_start();

// Importando o arquivo de autenticação
require_once('../verificar_autenticacao.php');

// Importanto o arquivo para preencher o html
require_once('itens_menu.php');

// Variável que recebe o função com o usuário autenticado
$rsUser = verificarAutentica();

?>

<!DOCTYPE html>

<html>

<head>
    <title>CMS</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta charset="utf-8">
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
                <!--  Função que preenche os itens do menu  -->
                <?php itens_menu($rsUser['idNivel']); ?>
            </nav>
            <!--  Área de logout  -->
            <div id="area_logout">
                <div id="boas_vindas">Bem vindo,
                    <?= $rsUser['nome'] ?>
                </div>
                <div id="logout"><a href="index.php?logout">Logout</a></div>
            </div>
        </div>
    </header>
    <!--  Div principal da página  -->
    <div id="principal_adm_users">
        <div id="opcoes_conteudo">
            <div class="itens_opcoes">
                <a href="adm_usuarios.php">
                    <img class="imagens_opcoes" src="imagens/adm_usuario.png">
                </a>
                <div class="titulo_opcoes">Adm. Usuário</div>
            </div>
            <div class="itens_opcoes">
                <a href="adm_nivel_usuario.php">
                    <img class="imagens_opcoes" src="imagens/adm_nivel_usuario.png">
                </a>
                <div class="titulo_opcoes">Nível Usuário</div>
            </div>
        </div>
    </div>
    <!-- Rodapé -->
    <footer></footer>
</body>

</html>
