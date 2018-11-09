<?php

    // Iniciando uma sessão
    session_start();

	// Importando o arquivo de autenticação
    require_once('../verificar_autenticacao.php');

    // Importando o arquivo de conexão
    require_once('conexao.php');

	// Variável que recebe o função com o usuário autenticado
    $rsUser = verificarAutentica();

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
	
	// Variável que recebe o título da página
    $tituloPagina = "Cadastrar banca";

	// Botão começa com salvar
    $botao = "Salvar";

	// Verifica se id existe
    if(isset($_GET['id'])){
        
		// Variável que recebe o id do registro
        $idBanca = $_GET['id'];
        
		// Titulo da página muda
        $tituloPagina = "Atualizar banca";
        
		// Botão da página muda
        $botao = "Atualizar";
        
		// Inicia uma variável de sessão que recebe o id do registro
        $_SESSION['idBanca'] = $idBanca;
        
		// Variável que recebe o registro do banco
        $sql = "SELECT * FROM tbl_nossas_bancas WHERE idBanca =".$idBanca;

		// Variável que executa o SELECT
        $select  = mysqli_query($conexao, $sql);

		// Verifica se retorna algum registro e coloca em um array
        if($rsBancas = mysqli_fetch_array($select)){
            
            $local = $rsBancas['local'];
            $logradouro = $rsBancas['logradouro'];
            $bairro = $rsBancas['bairro'];
            $telefone = $rsBancas['telefone'];
            
        }
        
    }
	
	// Verifica se o submit foi clicado
    if(isset($_POST['btnSalvar'])){
        
		// Pega todos os valores inseridos no formulário e coloca em variáveis
        $local = $_POST['txtLocal'];
        $logradouro = $_POST['txtLogradouro'];
        $bairro = $_POST['txtBairro'];
        $telefone = $_POST['txtTelefone'];
        
		// Verifica se o botão é pra salvar e faz um INSERT no banco, senão faz um UPDATE
        if($_POST['btnSalvar'] == "Salvar"){
			
			$sql = "INSERT INTO tbl_nossas_bancas 
                (local, logradouro, bairro, telefone, status) 
                VALUES ('".$local."', '".$logradouro."', '".$bairro."', '".$telefone."', 0)";
			
		}else{
            
            $sql = "UPDATE tbl_nossas_bancas 
                SET local = '".$local."',
                logradouro = '".$logradouro."', 
                bairro = '".$bairro."', 
                telefone = '".$telefone."' 
                WHERE idBanca =".$_SESSION['idBanca'];
            
        }
		
		// Verifica se QUERY não pôde ser executada e exibe um erro, senão atualiza a página
		if(!mysqli_query($conexao, $sql))
			echo "Erro: ".mysqli_errno($conexao)." - ".mysqli_error($conexao);
		else
			header('location:adm_bancas.php');
        
    }

?>


<!DOCTYPE html>

<html>
    <head>
        <title>CMS</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/jquery-1.10.1.min.js"></script>
        <script src="js/jquery.maskedinput.js"></script>
        <script>
   
            $(document).ready(function() {
                $("#txtTelefone").mask("(99) 9999-9999");
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
                    <div id="boas_vindas">Bem vindo, <?= $rsUser['nome'] ?></div>
                    <div id="logout"><a href="index.php?logout">Logout</a></div>
                </div>
            </div>
        </header>
		<!--  Div principal da página  -->
        <div id="principal_form_adm_bancas">
            <div id="titulo_form_adm_bancas">
                <?= $tituloPagina ?>
            </div>
            <form action="formulario_bancas.php" method="post">
                <div id="caixa_form_adm_bancas">
                    <table class="tabela_formulario">
                        <tr>
                            <td class="td_esquerda">
                                <label>Local</label>
                            </td>
                            
                            <td>
                                <input maxlength="50" name="txtLocal" class="dados" type="text" value="<?= @$local ?>" required>
                            </td>
                            <td class="td_esquerda">
                                <label>Logradouro</label>
                            </td>
                            <td>
                               <input maxlength="100" name="txtLogradouro" class="dados" type="text" value="<?= @$logradouro ?>" required> 
                            </td>
                        </tr>
                        <tr>
                            <td class="td_esquerda">
                                <label>Bairro</label>
                            </td>
                            <td>
                                <input maxlength="50" name="txtBairro" class="dados" type="text" value="<?= @$bairro ?>" required>
                            </td>
                            <td class="td_esquerda">
                                <label>Telefone</label>
                            </td>
                            <td>
                                <input name="txtTelefone" id="txtTelefone" class="dados" type="text" value="<?= @$telefone ?>" required>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="area_botao">
                    <input type="submit" name="btnSalvar" value="<?= $botao ?>" class="button">
                    <a href="adm_bancas.php">
                        <input type="button" value="Cancelar" class="button">
                    </a>
                </div>
            </form>   
        </div>
		<!-- Rodapé -->
        <footer></footer>
    </body>
</html>