<?php

    function conexaoBD(){
        
        $host = "localhost";
        $user = "root";
        $password = "bcd127";
        $database = "db_banca_inf3m";

        if(!$conexao = mysqli_connect($host, $user, $password, $database))
            echo "Erro ao conectar com Banco de Dados!";
    
        
        return $conexao;
        
    }
?>