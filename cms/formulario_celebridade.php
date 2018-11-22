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
    $tituloPagina = "Cadastrar celebridade";

	// Botão começa com salvar
    $botao = "Salvar";

	// Caixa da foto começa escondida
    $caixa_foto = "hidden";

	// Verifica se id existe
    if(isset($_GET['id'])){
        
		// Variável que recebe o id do registro
        $idCelebridade = $_GET['id'];
        
		// Titulo da página muda
        $tituloPagina = "Atualizar banca";
        
		// Botão da página muda
        $botao = "Atualizar";
        
		// Caixa da foto aparece
        $caixa_foto = "";
        
		// Inicia uma variável de sessão que recebe o id do registro
        $_SESSION['idCelebridade'] = $idCelebridade;
        
		// Variável que recebe o registro do banco
        $sql = "SELECT * FROM tbl_celebridade WHERE idCelebridade =".$idCelebridade;

		// Variável que executa o SELECT
        $select  = mysqli_query($conexao, $sql);

		// Verifica se retorna algum registro e coloca em um array
        if($rsCelebridade = mysqli_fetch_array($select)){
            
            $foto = $rsCelebridade['foto'];
            $nomeCelebridade = $rsCelebridade['nome'];
            $dtNasc = $rsCelebridade['dtNasci'];
            $naturalidade = $rsCelebridade['naturalidade'];
            $profissao = $rsCelebridade['profissao'];
            $biografia = $rsCelebridade['biografia'];
            
			// Inicia uma variável de sessão que recebe o caminho da foto
            $_SESSION['foto'] = $foto;
            
        }
        
    }
	
	// Verifica se o submit foi clicado
    if(isset($_POST['btnSalvar'])){
        
		// Pega todos os valores inseridos no formulário e coloca em variáveis
        $foto = $_POST['txtFoto'];
        $nomeCelebridade = $_POST['txtNome'];
        $dtNasc = $_POST['txtData'];
        $naturalidade = $_POST['txtNaturalidade'];
        $profissao = $_POST['txtProfissao'];
        $biografia = $_POST['txtBiografia'];
        
		// Verifica se o botão é pra salvar e faz um INSERT no banco, senão faz um UPDATE
        if($_POST['btnSalvar'] == "Salvar"){
			
			$sql = "INSERT INTO tbl_celebridade (foto, nome, dtNasci, naturalidade, profissao, biografia, status) 
                    VALUES ('".$foto."', 
                            '".$nomeCelebridade."',
                            '".$dtNasc."', 
                            '".$naturalidade."',
                            '".$profissao."', 
                            '".$biografia."',
                            1)";
			
		}else{
            
			// Verifica se a caixa da foto ficou vazia e coloca o caminho da foto
            if($foto == "")
                $foto = $_SESSION['foto'];
            
            
            $sql = "UPDATE tbl_celebridade 
                    SET foto = '".$foto."', 
                    nome = '".$nomeCelebridade."',
                    dtNasci = '".$dtNasc."',
                    naturalidade = '".$naturalidade."',
                    profissao = '".$profissao."',
                    biografia = '".$biografia."'
                    WHERE idCelebridade =".$_SESSION['idCelebridade']; 
            
        }
		
		// Verifica se QUERY não pôde ser executada e exibe um erro, senão atualiza a página
		if(!mysqli_query($conexao, $sql))
			echo "Erro: ".mysqli_errno($conexao)." - ".mysqli_error($conexao);
		else
			header('location:adm_celebridade.php');
        
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
							
					target:'#fotoCelebridade'
							
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
    <div id="principal_form_celebridade">
        <div id="titulo_form_adm_celebridade">
            <?= $tituloPagina ?>
        </div>
        <div id="caixa_form_adm_celebridade">
            <table class="tabela_formulario">
                <tr>
                    <form id="frmFoto" action="upload.php" method="post" enctype="multipart/form-data">
                        <td class="td_esquerda">
                            <label>Imagem</label>
                        </td>
                        <td>
                            <input name="fileFoto" id="txtUpload" class="dados" type="file" required>
                        </td>
                    </form>
                    <td rowspan="6" width="50%">
                        <div id="fotoCelebridade">
                            <img src="<?= $foto ?>" <?= $caixa_foto?>>
                        </div>
                    </td>
                </tr>
                <form name="frm_conteudo" action="formulario_celebridade.php" method="post">
                    <tr>

                        <td class="td_esquerda">
                            <label>Nome</label>
                        </td>

                        <td>
                            <input maxlength="100" name="txtNome" class="dados" type="text" value="<?= @$nomeCelebridade ?>" required>
                            <input name="txtFoto" id="txtFoto" class="dados" type="hidden">
                        </td>
                    </tr>
                    <tr>

                        <td class="td_esquerda">
                            <label>Data de Nascimento</label>
                        </td>

                        <td>
                            <input name="txtData" class="dados" id="txtData" type="date" value="<?= @$dtNasc ?>" required>
                        </td>
                    </tr>
                    <tr>

                        <td class="td_esquerda">
                            <label>Profissão</label>
                        </td>

                        <td>
                            <input maxlength="50" name="txtProfissao" class="dados" type="text" value="<?= @$profissao ?>" required>
                        </td>
                    </tr>
                    <tr>

                        <td class="td_esquerda">
                            <label>Naturalidade</label>
                        </td>

                        <td>
                            <input maxlength="50" name="txtNaturalidade" class="dados" type="text" value="<?= @$naturalidade ?>" required>
                        </td>
                    </tr>
                    <tr>

                        <td class="td_esquerda">
                            <label>Biografia</label>
                        </td>

                        <td>
                            <textarea name="txtBiografia" id="txtBiografia" class="dados" required><?= @$biografia ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div id="area_botao">
                                <input type="submit" name="btnSalvar" value="<?= $botao ?>" class="button">
                                <a href="adm_celebridade.php">
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
