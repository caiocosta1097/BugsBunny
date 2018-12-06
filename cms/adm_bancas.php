<?php

    // Iniciando uma sessão
    session_start();

	// Importando o arquivo de autenticação
    require_once('../verificar_autenticacao.php');

    // Importando o arquivo de conexão
    require_once('conexao.php');

    // Importanto o arquivo para preencher o html
    require_once('itens_menu.php');

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
            
            $sql = "DELETE FROM tbl_nossas_bancas WHERE idBanca =".$id;
        
            // Verifica se QUERY não pôde ser executada e exibe um erro, senão atualiza a página
			if(!mysqli_query($conexao, $sql))
				echo "Erro: ".mysqli_errno($conexao)." - ".mysqli_error($conexao);
			else
				header('location:adm_bancas.php');       
            
        } 
        
    }

	// Verifica se status existe
    if(isset($_GET['status'])){
        
		// Variável que recebe o status do registro
        $status = $_GET['status'];
        
        // Verifica se status é = 0 e muda para 1
        if($status == 0){
            
            $id = $_GET['id'];
        
            $sql = "UPDATE tbl_nossas_bancas SET status = 1 WHERE idBanca=".$id;
            
        // Verifica se status é = 1 e muda para 0
        } else if ($status == 1) {
            
			$id = $_GET['id'];
        
            $sql = "UPDATE tbl_nossas_bancas SET status = 0 WHERE idBanca=".$id;
            
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
    <div id="principal_adm_bancas">
        <div id="titulo_adm_bancas">
            Registros das Bancas
        </div>
        <div id="registros_adm_bancas">
            <table id="tabela">
                <thead>
                    <tr>
                        <th>Local</th>
                        <th>Telefone</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                
						// Variável que recebe o SELECT do banco
                        $sql = "SELECT * FROM tbl_nossas_bancas";

						// Variável que executa o SELECT
                        $select  = mysqli_query($conexao, $sql);
				
						// Loop para pegar cada registro no SELECT e colocar em um array
                        while($rsBancas = mysqli_fetch_array($select)){
                
                    ?>
                    <tr>
                        <td>
                            <?= $rsBancas['local'] ?>
                        </td>
                        <td>
                            <?= $rsBancas['telefone'] ?>
                        </td>
                        <td id="td_imagens">
                            <a href="formulario_bancas.php?id=<?= $rsBancas['idBanca'] ?>">
                                <img src="imagens/editar.png" title="Editar">
                            </a>
                            <a href="adm_bancas.php?modo=excluir&id=<?= $rsBancas['idBanca'] ?>">
                                <img src="imagens/deletar.png" title="Excluir">
                            </a>
                            <?php 
							
								// Variável que recebe o status do registro
                                $status = $rsBancas['status'];
                            
								// Verifica se o status é = 0 (ativado), senão desativa
                                if($status == 0){
                                    
                            ?>
                            <a href="adm_bancas.php?status=<?= $rsBancas['status'] ?>&id=<?= $rsBancas['idBanca'] ?>">
                                <img src="imagens/ativado.png" title="Desativar">
                            </a>
                            <?php } else { ?>
                            <a href="adm_bancas.php?status=<?= $rsBancas['status'] ?>&id=<?= $rsBancas['idBanca'] ?>">
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
                <a href="formulario_bancas.php">
                    <input type="button" value="Nova Banca" class="button">
                </a>
            </form>
        </div>
    </div>
    <!-- Rodapé -->
    <footer></footer>
</body>

</html>
