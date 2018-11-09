<?php

    // Importando o arquivo de conexão
    require_once('conexao.php');
    
    // Função para verificar se o usuário ainda está autenticado
    function verificarAutentica(){

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
			
        // Coloca o registro em um array
        $rsUser = mysqli_fetch_array($select);
            

        // Verifica se logout existe, encerra a variável de sessão e redireciona para home
        if(isset($_GET['logout'])){

            session_destroy();

            header('location:../index.php');

        }
        
    }else
        header('location:../index.php');  
        
    
        return $rsUser;  
        
        
    }


?>