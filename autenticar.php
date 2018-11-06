<?php

    session_start();

    require_once('conexao.php');

    $conexao = conexaoBD();

    if(isset($_POST['btnLogin'])){
        
        $login = $_POST['txtUsuario'];
        $senha = $_POST['txtSenha'];
        $autenticar = false;
        
        $sql = "SELECT * FROM tbl_usuario";
        
        $select  = mysqli_query($conexao, $sql);
        
        while($rsUsuarios = mysqli_fetch_array($select)){
            
            $loginBanco = $rsUsuarios['login'];
            $senhaBanco = $rsUsuarios['senha'];
            
            if($login == $loginBanco and $senha == $senhaBanco){
                
                $autenticar = true;
                
                $_SESSION['idUsuario'] = $rsUsuarios['idUsuario'];
                
            }
            
        }
        
        if($autenticar)
            header('location:cms/index.php');
            
        else
            echo "<script>alert('Login ou senha incorretos!'); window.location.assign('index.php');</script>";
        
    }

?>