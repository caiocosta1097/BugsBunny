<?php

// Iniciando uma sessão
session_start();

// Importando o arquivo de autenticação
require_once('../verificar_autenticacao.php');

// Importanto o arquivo para preencher o html
require_once('itens_menu.php');

// Importando o arquivo de conexão
require_once('conexao.php');

// Variável que recebe o função com o usuário autenticado
$rsUser = verificarAutentica();

// Variável que recebe o função com a conexão
$conexao = conexaoBD();

// Variável que recebe o título da página
$tituloPagina = "Cadastrar nível";

// Botão começa com salvar
$botao = "Salvar";

// Verifica se id existe
if(isset($_GET['id'])){

	// Variável que recebe o id do registro
    $idNivel = $_GET['id'];

	// Titulo da página muda
    $tituloPagina = "Atualizar nível";

	// Botão da página muda
    $botao = "Atualizar";

	// Inicia uma variável de sessão que recebe o id do registro
    $_SESSION['idNivel'] = $idNivel;

	// Variável que recebe o registro do banco
    $sql = "SELECT * FROM tbl_nivel_usuario WHERE idNivel =".$idNivel;

	// Variável que executa o SELECT
    $select  = mysqli_query($conexao, $sql);

	// Verifica se retorna algum registro e coloca em um array
    if($rsNivel = mysqli_fetch_array($select))
        $nivel = $rsNivel['nomeNivel'];

}

// Verifica se o submit foi clicado
if(isset($_POST['btnSalvar'])){

	// Pega todos os valores inseridos no formulário e coloca em variáveis
    $nivel = $_POST['txtNivel'];

	// Verifica se o botão é pra salvar e faz um INSERT no banco, senão faz um UPDATE
    if($_POST['btnSalvar'] == "Salvar"){

     $sql = "INSERT INTO tbl_nivel_usuario (nomeNivel, status) VALUES ('".$nivel."', 0)";

    }else{

        $sql = "UPDATE tbl_nivel_usuario SET nomeNivel = '".$nivel."' WHERE idNivel =".$_SESSION['idNivel'];

    }

    // Verifica se QUERY não pôde ser executada e exibe um erro, senão atualiza a página
    if(!mysqli_query($conexao, $sql))
        echo "Erro: ".mysqli_errno($conexao)." - ".mysqli_error($conexao);
    else
        header('location:adm_nivel_usuario.php');

}

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
    <div id="principal_form_adm_niveis">
        <div id="titulo_form_adm_niveis">
            <?= $tituloPagina ?>
        </div>
        <form action="formulario_nivel.php" method="post">
            <div id="caixa_form_adm_niveis">
                <table class="tabela_formulario">
                    <tr>
                        <td class="td_esquerda">
                            <label>Nível usuário</label>
                        </td>
                        <td>
                            <input maxlength="30" name="txtNivel" class="dados" type="text" value="<?= @$nivel ?>" required>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="area_botao">
                <input type="submit" name="btnSalvar" value="<?= $botao ?>" class="button">
                <a href="adm_nivel_usuario.php">
                    <input type="button" value="Cancelar" class="button">
                </a>
            </div>
        </form>
    </div>
    <!-- Rodapé -->
    <footer></footer>
</body>

</html>
