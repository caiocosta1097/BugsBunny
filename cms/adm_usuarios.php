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
			
			if($idUser == $id)
				echo "<script>alert('Não é possível excluir o usuário logado!')</script>";
            else {
            
				$sql = "DELETE FROM tbl_usuario WHERE idUsuario =".$id;
			
				// Verifica se QUERY não pôde ser executada e exibe um erro, senão atualiza a página
				if(!mysqli_query($conexao, $sql))
					echo "Erro: ".mysqli_errno($conexao)." - ".mysqli_error($conexao);
				else
					header('location:adm_usuarios.php');      
            
			} 
        
		}
		
	}	

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
                    <div id="boas_vindas">Bem vindo, <?= $rsUser['nome'] ?></div>
                    <div id="logout"><a href="index.php?logout">Logout</a></div>
                </div>
            </div>
        </header>
		<!--  Div principal da página  -->
        <div id="principal_adm_usuarios">
            <div id="titulo_adm_usuarios">
                Registros dos usuários
            </div>
            <div id="registros_adm_usuarios">
                <table id="tabela">
                    <thead>
                    <tr>
                        <th>Login</th>
                        <th>Email</th>
                        <th>Nível</th>
                        <th>Opções</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
					
						// Variável que recebe o SELECT do banco
                         $sql = "SELECT usuario.*, nivel.* 
                                FROM tbl_usuario as usuario, tbl_nivel_usuario as nivel 
                                WHERE usuario.idNivel = nivel.idNivel";

						// Variável que executa o SELECT
                        $select  = mysqli_query($conexao, $sql);
				
						// Loop para pegar cada registro no SELECT e colocar em um array
                        while($rsUsuarios = mysqli_fetch_array($select)){
                
                    ?>    
                    <tr>
                        <td><?= $rsUsuarios['login'] ?></td>
                        <td><?= $rsUsuarios['email'] ?></td>
                        <td><?= $rsUsuarios['nomeNivel'] ?></td>
                        <td id="td_imagens">
                            <a href="formulario_usuario.php?id=<?= $rsUsuarios['idUsuario'] ?>">
                                <img src="imagens/editar.png">
                            </a>
                            <a href="adm_usuarios.php?modo=excluir&id=<?= $rsUsuarios['idUsuario'] ?>">
                                <img src="imagens/deletar.png">
                            </a>
                        </td>
                    </tr>
                    <?php } ?>        
                    <tbody>
                </table>
            </div>
			<!-- Área do botão -->
            <div id="area_botao">
                <form>
                    <a href="formulario_usuario.php">
                        <input type="button" value="Novo usuário" class="button">
                    </a>    
                </form> 
            </div>   
        </div>
		<!-- Rodapé -->
        <footer></footer>
    </body>
</html>