<?php

    session_start();

    require_once('conexao.php');

    $conexao = conexaoBD();

    if(isset($_SESSION['idUsuario'])){
        
        $idUsuario = $_SESSION['idUsuario'];

        $sql = "SELECT * FROM tbl_usuario WHERE idUsuario =".$idUsuario;

        $select  = mysqli_query($conexao, $sql);

            if($rsUsuario = mysqli_fetch_array($select)){

                $nome = $rsUsuario['nome'];

            }

            if(isset($_GET['logout'])){

                session_destroy();

                header('location:../index.php');

            }
        
    }else{
        
        header('location:../index.php');   
        
    }

    $botao = "Salvar";
    $lblSenha = "Senha";
    $required = "required";

    if(isset($_GET['id'])){
        
        $idUsuario = $_GET['id'];
        
        $botao = "Atualizar";
        $lblSenha = "Nova senha";
        $lblNovaSenha = "";
        $txtNovaSenha = "password";
        $required = "";
        
        $_SESSION['idUsuario'] = $idUsuario;
    
        $sql = "SELECT * FROM tbl_usuario WHERE idUsuario =".$idUsuario;

        $select  = mysqli_query($conexao, $sql);

        if($rsUsuarioForm = mysqli_fetch_array($select)){

            $nomeUsuario = $rsUsuarioForm['nome'];
            $login = $rsUsuarioForm['login'];
            $email = $rsUsuarioForm['email'];
            $senha = $rsUsuarioForm['senha'];
            $idNivel = $rsUsuarioForm['idNivel'];
            
            $_SESSION['senhaUsuario'] = $senha;

        }
        
    }

    if(isset($_POST['btnSalvar'])){
        
        $nomeUsuario = $_POST['txtNome'];
        $nivelUsuario = $_POST['slt_nivel'];
        $login = $_POST['txtLogin'];
        $senha = $_POST['txtSenha'];
        $email = $_POST['txtEmail'];
        
        if($_POST['btnSalvar'] == "Salvar"){
            
            $sql = "INSERT INTO tbl_usuario (nome, login, senha, email, idNivel) 
                    VALUES ('".$nomeUsuario."', '".$login."', '".$senha."', '".$email."', '".$nivelUsuario."')";
            
        }else {
            
            if($senha == "")
                $senha = $_SESSION['senhaUsuario'];
            
            
            $sql = "UPDATE tbl_usuario SET nome = '".$nomeUsuario."', 
                    login = '".$login."', 
                    senha = '".$senha."', 
                    email = '".$email."', 
                    idNivel = '".$nivelUsuario."' 
                    WHERE idUsuario =".$_SESSION['idUsuario']; 
            
        }
            
        if(!mysqli_query($conexao, $sql))
            echo "Erro no envio!";
        
        header('location:adm_lista_usuarios.php');
        
    }

?>


<!DOCTYPE html>

<html>

<head>
    <title>CMS</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>

<body>
    <header>
        <div id="caixa_cabecalho">
            <div id="titulo_pagina">
                <span id="negrito">CMS</span> - Sistema de Gerenciamento do Site
            </div>
            <div id="logo_pagina"></div>
        </div>
        <div id="caixa_menu">
            <nav id="menu_principal">
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
                    <a href="adm_usuarios.php">
                        <img class="imagens_menu" src="imagens/adm_usuarios.png">
                    </a>
                    <div class="titulo_menu">Adm. Usuários</div>
                </div>
            </nav>
            <div id="area_logout">
                    <div id="boas_vindas">Bem vindo, <?= $nome ?></div>
                    <div id="logout"><a href="index.php?logout">Logout</a></div>
                </div>
        </div>
    </header>
    <div id="principal_adm_niveis">
        <div id="titulo_adm_nivel_usuario">
            Cadastrar usuário
        </div>
        <form action="formulario_usuario.php" method="post">
            <div id="caixa_usuario">
                <table class="tabela_formulario">
                    <tr>
                        <td class="td_esquerda">
                            <label>Nome</label>
                        </td>

                        <td>
                            <input maxlength="100" name="txtNome" class="dados" type="text" value="<?= @$nomeUsuario ?>" required>
                        </td>
                        <td class="td_esquerda">
                            <label>Nível usuário</label>
                        </td>
                        <td>
                            <select class="dados" name="slt_nivel">
                                <?php
                                    
                                        $sql = "SELECT * FROM tbl_nivel_usuario WHERE status = 0";

                                        $select  = mysqli_query($conexao, $sql);

                                        while($rsNivel = mysqli_fetch_array($select)){
                                            
                                        if($rsNivel['idNivel'] == $idNivel ){
                                         
                                            $selected = "selected";
                                            
                                        }    

                                    ?>
                                <option value="<?= $rsNivel['idNivel'] ?>" <?= @$selected ?>>
                                    <?= $rsNivel['nomeNivel'] ?>
                                </option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_esquerda">
                            <label>Login</label>
                        </td>
                        <td>
                            <input maxlength="30" name="txtLogin" class="dados" type="text" value="<?= @$login ?>" required>
                        </td>
                        <td class="td_esquerda">
                            <label>
                                <?= $lblSenha ?></label>
                        </td>
                        <td>
                            <input maxlength="45" name="txtSenha" class="dados" type="password" <?= $required ?>>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_esquerda">
                            <label>Email</label>
                        </td>
                        <td>
                            <input maxlength="100" name="txtEmail" class="dados" type="text" value="<?= @$email ?>" required>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="area_botao">
                <input type="submit" name="btnSalvar" value="<?= $botao ?>" class="button">
                <a href="adm_lista_usuarios.php">
                    <input type="button" value="Cancelar" class="button">
                </a>
            </div>
        </form>
    </div>
    <footer></footer>
</body>

</html>
