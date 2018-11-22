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
	
	// Verifica se modo existe
    if(isset($_GET['modo'])){
        
		// Variável que recebe o modo
        $modo = $_GET['modo'];
        
		// Verifica se o modo = 'excluir' e deleta o registro
        if($modo == 'excluir'){
            
            $id = $_GET['id'];
            
            $sql = "DELETE FROM tbl_nivel_usuario WHERE idNivel =".$id;
        
            // Verifica se QUERY não pôde ser executada e exibe um erro, senão atualiza a página
			if(!mysqli_query($conexao, $sql))
				echo "Erro: ".mysqli_errno($conexao)." - ".mysqli_error($conexao);
			else
				header('location:adm_nivel_usuario.php');
				
		} 
        
    }
	
	// Verifica se status existe
    if(isset($_GET['status'])){
        
		// Variável que recebe o status do registro
        $status = $_GET['status'];
        
		// Verifica se status é = 0 e muda para 1
        if($status == 0){
            
            $id = $_GET['id'];
        
            $sql = "UPDATE tbl_nivel_usuario SET status = 1 WHERE idNivel=".$id;
         
		// Verifica se status é = 1 e muda para 0
        } else if ($status == 1) {
            
           $id = $_GET['id'];
        
            $sql = "UPDATE tbl_nivel_usuario SET status = 0 WHERE idNivel=".$id;
            
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
        <div id="principal_adm_niveis">
            <div id="titulo_adm_nivel_usuario">
                Registros dos níveis de usuários
            </div>
            <div id="registros_adm_nivel_usuario">
                <table id="tabela">
                    <thead>
                    <tr>
                        <th>Nível</th>
                        <th>Opções</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
					
						// Variável que recebe o SELECT do banco
                        $sql = "SELECT * FROM tbl_nivel_usuario";

						// Variável que executa o SELECT
                        $select  = mysqli_query($conexao, $sql);

						// Loop para pegar cada registro no SELECT e colocar em um array
                        while($rsNivel = mysqli_fetch_array($select)){
                
                    ?>
                    <tr>
                        <td><?= $rsNivel['nomeNivel'] ?></td>
                        <td id="td_imagens">
                            <a href="formulario_nivel.php?id=<?= $rsNivel['idNivel'] ?>">
                                <img src="imagens/editar.png" title="Editar">
                            </a>
                            <a href="adm_nivel_usuario.php?modo=excluir&id=<?= $rsNivel['idNivel'] ?>">
                                <img src="imagens/deletar.png" title="Excluir">
                            </a>
                            <?php 
                            
                                // Variável que recebe o status do registro
                                $status = $rsNivel['status'];
                            
								// Verifica se o status é = 0 (ativado), senão desativa
                                if($status == 0){
                                    
                                    
                            ?>
                            <a href="adm_nivel_usuario.php?status=<?= $rsNivel['status'] ?>&id=<?= $rsNivel['idNivel'] ?>">
                                <img src="imagens/ativado.png" title="Desativar">
                            </a>
                            <?php } else { ?>
                            <a href="adm_nivel_usuario.php?status=<?= $rsNivel['status'] ?>&id=<?= $rsNivel['idNivel'] ?>">
                                <img src="imagens/desativado.png" title="Ativar">
                            </a>
                            <?php } ?>  
                        </td>
                    </tr>
                    <?php } ?>    
                    <tbody>
                </table>
            </div>
			<!-- Área do botão -->
            <div id="area_botao">
                <form>
                    <a href="formulario_nivel.php">
                        <input type="button" value="Cadastrar nível" class="button">
                    </a>    
                </form> 
            </div>   
        </div>
		<!-- Rodapé -->
        <footer></footer>
    </body>
</html>