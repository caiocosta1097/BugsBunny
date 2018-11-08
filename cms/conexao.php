<?php

	// Removendo os warnings
	error_reporting(0);

	// Função que faz a conexão com banco
    function conexaoBD(){
        
        $host = "localhost";
        $user = "root";
        $password = "bcd127";
        $database = "db_banca_inf3m";
		
		$conexao = mysqli_connect($host, $user, $password, $database);

        if(!$conexao = mysqli_connect($host, $user, $password, $database))
            echo "Erro ao se conectar com banco!<br>Erro: ".mysqli_connect_errno()." - ".mysqli_connect_error();
    
        return $conexao;
        
    }
?>