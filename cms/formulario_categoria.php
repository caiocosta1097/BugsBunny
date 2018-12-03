<?php

    // Iniciando uma sessão
    session_start();

	// Importando o arquivo de autenticação
    require_once('../verificar_autenticacao.php');

    // Importando o arquivo de conexão
    require_once('conexao.php');

	// Variável que recebe o função com o usuário autenticado
    $rsUser = verificarAutentica();

    $bloqueioConteudo = null;
    $bloqueioFaleConosco = null;
    $bloqueioProduto = null;
    $bloqueioUsuario = null;
    
    if($rsUser['idNivel'] == 21){
        
        $bloqueioConteudo = "";
        $bloqueioFaleConosco = "";
        $bloqueioProduto = "style='filter: grayscale(100%); pointer-events: none;'";
        $bloqueioUsuario = "style='filter: grayscale(100%); pointer-events: none;'";
        
    }else if ($rsUser['idNivel'] == 22){
        
        $bloqueioConteudo = "style='filter: grayscale(100%); pointer-events: none;'";
        $bloqueioFaleConosco = "style='filter: grayscale(100%); pointer-events: none;'";
        $bloqueioProduto = "";
        $bloqueioUsuario = "style='filter: grayscale(100%); pointer-events: none;'";
        
    } else{
        
        $bloqueioConteudo = "";
        $bloqueioFaleConosco = "";
        $bloqueioProduto = "";
        $bloqueioUsuario = "";
        
    }


    // Variável que recebe o função com a conexão
    $conexao = conexaoBD();
	
	// Variável que recebe o título da página
    $tituloPagina = "Cadastrar categoria";

	// Botão começa com salvar
    $botao = "Salvar";

	// Verifica se id existe
    if(isset($_GET['id'])){
        
		// Variável que recebe o id do registro
        $idCategoria = $_GET['id'];
        
		// Titulo da página muda
        $tituloPagina = "Atualizar categoria";
        
		// Botão da página muda
        $botao = "Atualizar";
        
		// Inicia uma variável de sessão que recebe o id do registro
        $_SESSION['idCategoria'] = $idCategoria;
        
		// Variável que recebe o registro do banco
        $sql = "SELECT * FROM tbl_categoria WHERE idCategoria =".$idCategoria;

		// Variável que executa o SELECT
        $select  = mysqli_query($conexao, $sql);

		// Verifica se retorna algum registro e coloca em um array
        if($rsCategoria = mysqli_fetch_array($select))
			$categoria = $rsCategoria['categoria'];
     
    }
	
	// Verifica se o submit foi clicado
    if(isset($_POST['btnSalvar'])){
        
		// Pega todos os valores inseridos no formulário e coloca em variáveis
        $categoria = $_POST['txtCategoria'];
        
		// Verifica se o botão é pra salvar e faz um INSERT no banco, senão faz um UPDATE
        if($_POST['btnSalvar'] == "Salvar"){
			
			$sql = "INSERT INTO tbl_categoria (categoria, status) VALUES ('".$categoria."', 0)";
			
		}else{
            
            $sql = "UPDATE tbl_categoria SET categoria = '".$categoria."' WHERE idCategoria =".$_SESSION['idCategoria'];
            
        }
		
		// Verifica se QUERY não pôde ser executada e exibe um erro, senão atualiza a página
		if(!mysqli_query($conexao, $sql))
			echo "Erro: ".mysqli_errno($conexao)." - ".mysqli_error($conexao);
		else
			header('location:adm_categoria.php');
        
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
                <!--  Itens do menu  -->
                <div class="itens_menu">
                    <a href="adm_conteudo.php">
                        <img class="imagens_menu" src="imagens/adm_conteudo.png" <?=$bloqueioConteudo ?>>
                    </a>
                    <div class="titulo_menu">Adm. Conteúdo</div>
                </div>
                <div class="itens_menu">
                    <a href="adm_fale_conosco.php">
                        <img class="imagens_menu" src="imagens/adm_fale_conosco.png" <?=$bloqueioFaleConosco ?>>
                    </a>
                    <div class="titulo_menu">Adm. Fale Conosco</div>
                </div>
                <div class="itens_menu">
                    <a href="adm_produtos.php">
                        <img class="imagens_menu" src="imagens/adm_produtos.png" <?=$bloqueioProduto ?>>
                    </a>
                    <div class="titulo_menu">Adm. Produtos</div>
                </div>
                <div class="itens_menu">
                    <a href="adm_users.php">
                        <img class="imagens_menu" src="imagens/adm_usuarios.png" <?=$bloqueioUsuario ?>>
                    </a>
                    <div class="titulo_menu">Adm. Usuários</div>
                </div>
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
    <div id="principal_form_adm_categorias">
        <div id="titulo_form_adm_categorias">
            <?= $tituloPagina ?>
        </div>
        <form action="formulario_categoria.php" method="post">
            <div id="caixa_form_adm_categorias">
                <table class="tabela_formulario">
                    <tr>
                        <td class="td_esquerda">
                            <label>Categoria</label>
                        </td>
                        <td>
                            <input maxlength="30" name="txtCategoria" class="dados" type="text" value="<?= @$categoria ?>" required>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="area_botao">
                <input type="submit" name="btnSalvar" value="<?= $botao ?>" class="button">
                <a href="adm_categoria.php">
                    <input type="button" value="Cancelar" class="button">
                </a>
            </div>
        </form>
    </div>
    <!-- Rodapé -->
    <footer></footer>
</body>

</html>
