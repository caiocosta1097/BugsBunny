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
    $tituloPagina = "Cadastrar subcategoria";

	// Botão começa com salvar
    $botao = "Salvar";

	// Verifica se id existe
    if(isset($_GET['id'])){
        
		// Variável que recebe o id do registro
        $idSubcategoria = $_GET['id'];
        
		// Titulo da página muda
        $tituloPagina = "Atualizar subcategoria";
        
		// Botão da página muda
        $botao = "Atualizar";
        
		// Inicia uma variável de sessão que recebe o id do registro
        $_SESSION['idSubcategoria'] = $idSubcategoria;
        
		// Variável que recebe o registro do banco
        $sql = "SELECT * FROM tbl_subcategoria WHERE idSubcategoria =".$idSubcategoria;

		// Variável que executa o SELECT
        $select  = mysqli_query($conexao, $sql);

		// Verifica se retorna algum registro e coloca em um array
        if($rsSubategoria = mysqli_fetch_array($select)){
            
            $subcategoria = $rsSubategoria['subcategoria'];
            $idCategoria =  $rsSubategoria['idCategoria'];
            
        }
			
     
    }
	
	// Verifica se o submit foi clicado
    if(isset($_POST['btnSalvar'])){
        
		// Pega todos os valores inseridos no formulário e coloca em variáveis
        $subcategoria = $_POST['txtSubcategoria'];
        $idCategoria = $_POST['slt_categoria'];
        
		// Verifica se o botão é pra salvar e faz um INSERT no banco, senão faz um UPDATE
        if($_POST['btnSalvar'] == "Salvar"){
			
			$sql = "INSERT INTO tbl_subcategoria (subcategoria, idCategoria, status) VALUES ('".$subcategoria."', '".$idCategoria."', 0)";
			
		}else{
            
            $sql = "UPDATE tbl_subcategoria SET subcategoria = '".$subcategoria."', 
                    idCategoria = '".$idCategoria."'  
                    WHERE idSubcategoria =".$_SESSION['idSubcategoria'];
            
        }
		
		// Verifica se QUERY não pôde ser executada e exibe um erro, senão atualiza a página
		if(!mysqli_query($conexao, $sql))
			echo "Erro: ".mysqli_errno($conexao)." - ".mysqli_error($conexao);
		else
			header('location:adm_subcategoria.php');
        
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
    <div id="principal_form_adm_subcategorias">
        <div id="titulo_form_adm_subcategorias">
            <?= $tituloPagina ?>
        </div>
        <form action="formulario_subcategoria.php" method="post">
            <div id="caixa_form_adm_subcategorias">
                <table class="tabela_formulario">
                    <tr>
                        <td class="td_esquerda">
                            <label>Subcategoria</label>
                        </td>
                        <td>
                            <input maxlength="30" name="txtSubcategoria" class="dados" type="text" value="<?= @$subcategoria ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_esquerda">
                            <label>Categoria</label>
                        </td>
                        <td>
                            <select class="dados" name="slt_categoria">
                                <?php
                                    
								// Variável que recebe o SELECT do banco onde o status = 0 (ativado)
                                $sql = "SELECT * FROM tbl_categoria WHERE status = 0";

								// Variável que executa o SELECT
                                $select  = mysqli_query($conexao, $sql);
                        
								// Loop para pegar cada registro no SELECT e colocar em um array
                                while($rsCategoria = mysqli_fetch_array($select)){
                                
								// Verifica se o id do nível é o mesmo do usuario e seleciona
                                if($rsCategoria['idCategoria'] == $idCategoria )
									$selected = "selected";
                                            
								else
									$selected = "";

                                    ?>
                                <option value="<?= $rsCategoria['idCategoria'] ?>" <?=@$selected ?>>
                                    <?= $rsCategoria['categoria'] ?>
                                </option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="area_botao">
                <input type="submit" name="btnSalvar" value="<?= $botao ?>" class="button">
                <a href="adm_subcategoria.php">
                    <input type="button" value="Cancelar" class="button">
                </a>
            </div>
        </form>
    </div>
    <!-- Rodapé -->
    <footer></footer>
</body>

</html>
