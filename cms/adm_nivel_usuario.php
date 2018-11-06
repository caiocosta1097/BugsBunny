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

    if(isset($_GET['modo'])){
        
        $modo = $_GET['modo'];
        
        if($modo == 'excluir'){
            
            $id = $_GET['id'];
            
            $sql = "DELETE FROM tbl_nivel_usuario WHERE idNivel =".$id;
        
            if(!mysqli_query($conexao, $sql))
                echo "Erro ao excluir registro";
            
            header('location:adm_nivel_usuario.php');
            
        } 
        
    }


    if(isset($_GET['status'])){
        
        $status = $_GET['status'];
        
        if($status == "ativado"){
            
            $id = $_GET['id'];
        
            $sql = "UPDATE tbl_nivel_usuario SET status = 1 WHERE idNivel=".$id;
        
            if(!mysqli_query($conexao, $sql))
                echo "Erro ao atualizar";
            
        } else if ($status == "desativado") {
            
           $id = $_GET['id'];
        
            $sql = "UPDATE tbl_nivel_usuario SET status = 0 WHERE idNivel=".$id;
        
            if(!mysqli_query($conexao, $sql))
                echo "Erro ao atualizar";
            
        }
        
        header('location:adm_nivel_usuario.php'); 
        
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
                Registros dos níveis de usuários
            </div>
            <div id="registros_nivel_usuario">
                <table id="tabela">
                    <thead>
                    <tr>
                        <th>Nível</th>
                        <th>Opções</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                
                        $sql = "SELECT * FROM tbl_nivel_usuario";

                        $select  = mysqli_query($conexao, $sql);

                        while($rsNivel = mysqli_fetch_array($select)){
                
                    ?>
                    <tr>
                        <td><?= $rsNivel['nomeNivel'] ?></td>
                        <td id="td_imagens">
                            <a href="formulario_nivel.php?id=<?= $rsNivel['idNivel'] ?>">
                                <img src="imagens/editar.png">
                            </a>
                            <a href="adm_nivel_usuario.php?modo=excluir&id=<?= $rsNivel['idNivel'] ?>">
                                <img src="imagens/deletar.png">
                            </a>
                            <?php 
                            
                                $status = $rsNivel['status'];
                            
                                if($status == 0){
                                    
                                    
                            ?>
                            <a href="adm_nivel_usuario.php?status=ativado&id=<?= $rsNivel['idNivel'] ?>">
                                <img src="imagens/ativado.png">
                            </a>
                            <?php } else { ?>
                            <a href="adm_nivel_usuario.php?status=desativado&id=<?= $rsNivel['idNivel'] ?>">
                                <img src="imagens/desativado.png">
                            </a>
                            <?php } ?>  
                        </td>
                    </tr>
                    <?php } ?>    
                    <tbody>
                </table>
            </div>
            <div id="area_botao">
                <form>
                    <a href="formulario_nivel.php">
                        <input type="button" value="Cadastrar nível" class="button">
                    </a>    
                </form> 
            </div>   
        </div>
        <footer></footer>
    </body>
</html>