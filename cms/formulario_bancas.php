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

    $tituloPagina = "Cadastrar banca";

    $botao = "Salvar";

    if(isset($_GET['id'])){
        
        $idBanca = $_GET['id'];
        
        $tituloPagina = "Atualizar banca";
        
        $botao = "Atualizar";

        $_SESSION['idBanca'] = $idBanca;

        $sql = "SELECT * FROM tbl_nossas_bancas WHERE idBanca =".$idBanca;

        $select  = mysqli_query($conexao, $sql);

        if($rsConsulta = mysqli_fetch_array($select)){

            $local = $rsConsulta['local'];
            $logradouro = $rsConsulta['logradouro'];
            $bairro = $rsConsulta['bairro'];
            $telefone = $rsConsulta['telefone'];

        }
        
    }

    if(isset($_POST['btnSalvar'])){
        
        $local = $_POST['txtLocal'];
        $logradouro = $_POST['txtLogradouro'];
        $bairro = $_POST['txtBairro'];
        $telefone = $_POST['txtTelefone'];
        
        if($_POST['btnSalvar'] == "Salvar"){
            
            $sql = "INSERT INTO tbl_nossas_bancas 
                (local, logradouro, bairro, telefone, status) 
                VALUES ('".$local."', '".$logradouro."', '".$bairro."', '".$telefone."', 0)";
            
        }else{
            
            $sql = "UPDATE tbl_nossas_bancas 
                SET local = '".$local."',
                logradouro = '".$logradouro."', 
                bairro = '".$bairro."', 
                telefone = '".$telefone."' 
                WHERE idBanca =".$_SESSION['idBanca'];
            
        }
         
        if(!mysqli_query($conexao, $sql))
            echo "Erro no envio!";
        
        header('location:adm_bancas.php');
        
    }

?>


<!DOCTYPE html>

<html>
    <head>
        <title>CMS</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/jquery-1.10.1.min.js"></script>
        <script src="js/jquery.maskedinput.js"></script>
        <script>
        
            $(document).ready(function() {
                $("#txtTelefone").mask("(99) 9999-9999");
            });
        
        </script>
        
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
                <?= $tituloPagina ?>
            </div>
            <form action="formulario_bancas.php" method="post">
                <div id="caixa_usuario">
                    <table class="tabela_formulario">
                        <tr>
                            <td class="td_esquerda">
                                <label>Local</label>
                            </td>
                            
                            <td>
                                <input maxlength="50" name="txtLocal" class="dados" type="text" value="<?= @$local ?>" required>
                            </td>
                            <td class="td_esquerda">
                                <label>Logradouro</label>
                            </td>
                            <td>
                               <input maxlength="100" name="txtLogradouro" class="dados" type="text" value="<?= @$logradouro ?>" required> 
                            </td>
                        </tr>
                        <tr>
                            <td class="td_esquerda">
                                <label>Bairro</label>
                            </td>
                            <td>
                                <input maxlength="50" name="txtBairro" class="dados" type="text" value="<?= @$bairro ?>" required>
                            </td>
                            <td class="td_esquerda">
                                <label>Telefone</label>
                            </td>
                            <td>
                                <input name="txtTelefone" id="txtTelefone" class="dados" type="text" value="<?= @$telefone ?>" required>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="area_botao">
                    <input type="submit" name="btnSalvar" value="<?= $botao ?>" class="button">
                    <a href="adm_bancas.php">
                        <input type="button" value="Cancelar" class="button">
                    </a>
                </div>
            </form>   
        </div>
        <footer></footer>
    </body>
</html>