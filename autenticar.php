<?php

	// Iniciando uma sessão
    session_start();

    // Importando o arquivo de conexão
    require_once('cms/conexao.php');

	// Variável que recebe o função com a conexão
    $conexao = conexaoBD();

	// Verifica se o submit foi clicado
    if(isset($_POST['btnLogin'])){
        
		// Pega todos os valores inseridos no formulário e coloca em variáveis
        $login = $_POST['txtUsuario'];
        $senha = $_POST['txtSenha'];
		
		// Autenticação começa em false
        $autenticar = false;
        
		// Variável que recebe o SELECT do banco
        $sql = "SELECT * FROM tbl_usuario";
        
		// Variável que executa o SELECT
        $select  = mysqli_query($conexao, $sql);
        
		// Loop para pegar cada registro no SELECT e colocar em um array
        while($rsUsers = mysqli_fetch_array($select)){
			
			// Coloca o login e a senha em variáveis
            $loginBanco = $rsUsers['login'];
            $senhaBanco = $rsUsers['senha'];
            
			// Verifica se o login e a senha digitadas existem no banco
            if($login == $rsUsers['login'] and md5($senha) == $rsUsers['senha']){
                
				// Autenticação vira true
                $autenticar = true;
                
				// Cria uma variável de sessão que recebe o id do usuário
                $_SESSION['idUser'] = $rsUsers['idUsuario'];
                
            }
            
        }
        
		// Verifica se a autenticação é true e redireciona para o CMS, senão exibe um erro
        if($autenticar)
            header('location:cms/index.php'); 
        else
            echo "<script>alert('Login ou senha incorretos!'); window.location.assign('index.php');</script>";
        
    }

?>