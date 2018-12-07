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
$tituloPagina = "Cadastrar notícia";

// Botão começa com salvar
$botao = "Salvar";

// Caixa da foto começa escondida
$caixa_foto = "hidden";

// Verifica se id existe
if(isset($_GET['id'])){

	// Variável que recebe o id do registro
    $idNoticia = $_GET['id'];

	// Titulo da página muda
    $tituloPagina = "Atualizar notícia";

	// Botão da página muda
    $botao = "Atualizar";

	// Caixa da foto aparece
    $caixa_foto = "";

	// Inicia uma variável de sessão que recebe o id do registro
    $_SESSION['idNoticia'] = $idNoticia;

	// Variável que recebe o registro do banco
    $sql = "SELECT * FROM tbl_noticias WHERE idNoticia =".$idNoticia;

	// Variável que executa o SELECT
    $select  = mysqli_query($conexao, $sql);

	// Verifica se retorna algum registro e coloca em um array
    if($rsNoticia = mysqli_fetch_array($select)){

        $titulo = $rsNoticia['titulo'];
        $foto = $rsNoticia['foto'];

			// Inicia uma variável de sessão que recebe o caminho da foto
        $_SESSION['foto'] = $foto;

    }

}

// Verifica se o submit foi clicado
if(isset($_POST['btnSalvar'])){

	// Pega todos os valores inseridos no formulário e coloca em variáveis
    $foto = $_POST['txtFoto'];
    $titulo = $_POST['txtTitulo'];

	// Verifica se o botão é pra salvar e faz um INSERT no banco, senão faz um UPDATE
    if($_POST['btnSalvar'] == "Salvar")
        $sql = "INSERT INTO tbl_noticias (foto, titulo, status) VALUES ('".$foto."', '".$titulo."', 0)";

    else{

        // Verifica se a caixa da foto ficou vazia e coloca o caminho da foto
        if($foto == "")
            $foto = $_SESSION['foto'];


        $sql = "UPDATE tbl_noticias SET titulo = '".$titulo."', foto = '".$foto."'
        WHERE idNoticia =".$_SESSION['idNoticia']; 

    }

    // Verifica se QUERY não pôde ser executada e exibe um erro, senão atualiza a página
    if(!mysqli_query($conexao, $sql))
        echo "Erro: ".mysqli_errno($conexao)." - ".mysqli_error($conexao);
    else
        header('location:adm_noticias.php');

}

?>

<!DOCTYPE html>

<html>

<head>
    <title>CMS</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta charset="utf-8">
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.form.js"></script>

    <script>

        $(document).ready(function(){

            // Verifica se algum upload foi feito           
            $('#txtUpload').live('change', function(){

				// Forçando um submit no formulário do fileUpload para
				// conseguir realizar o upload da foto sem o click de um botão
				$('#frmFoto').ajaxForm({

					target:'#fotoNoticia'

				}).submit();  

            });

        });

    </script>

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
    <div id="principal_form_adm_noticias">
        <div id="titulo_form_adm_noticias">
            <?= $tituloPagina ?>
        </div>
        <div id="caixa_form_adm_noticias">
            <table class="tabela_formulario">
                <tr>
                    <form id="frmFoto" action="upload.php" method="post" enctype="multipart/form-data">
                        <td class="td_esquerda">
                            <label>Imagem</label>
                        </td>
                        <td>
                            <input name="fileFoto" id="txtUpload" class="dados" type="file">
                        </td>
                    </form>
                    <td rowspan="2" width="50%">
                        <div id="fotoNoticia">
                            <img src="<?= $foto ?>" <?=$caixa_foto ?>>
                        </div>
                    </td>
                </tr>
                <form name="frm_conteudo" action="formulario_noticias.php" method="post">
                    <tr>

                        <td class="td_esquerda">
                            <label>Título</label>
                        </td>

                        <td>
                            <input maxlength="100" name="txtTitulo" class="dados" type="text" value="<?= @$titulo ?>" required>
                            <input name="txtFoto" id="txtFoto" class="dados" type="hidden">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div id="area_botao">
                                <input type="submit" name="btnSalvar" value="<?= $botao ?>" class="button">
                                <a href="adm_noticias.php">
                                    <input type="button" value="Cancelar" class="button">
                                </a>
                            </div>
                        </td>
                    </tr>
                </form>
            </table>
        </div>
    </div>
    <!-- Rodapé -->
    <footer></footer>
</body>

</html>
