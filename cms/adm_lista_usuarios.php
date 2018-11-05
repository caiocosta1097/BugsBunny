<?php

    require_once('conexao.php');

    $conexao = conexaoBD();
//
    if(isset($_GET['modo'])){
        
        $modo = $_GET['modo'];
        
        if($modo == 'excluir'){
            
            $id = $_GET['id'];
            
            $sql = "DELETE FROM tbl_usuario WHERE idUsuario =".$id;
        
            if(!mysqli_query($conexao, $sql))
                echo "Erro ao excluir registro";
            
            header('location:adm_lista_usuarios.php');
            
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
                    <div id="boas_vindas">Bem vindo, Caio</div>
                    <div id="logout">Logout</div>
                </div>
            </div>
        </header>
        <div id="principal_adm_niveis">
            <div id="titulo_adm_nivel_usuario">
                Registros dos usuários
            </div>
            <div id="registros_lista_usuarios">
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
                
                        $sql = "SELECT usuario.*, nivel.* 
                                FROM tbl_usuario as usuario, tbl_nivel_usuario as nivel 
                                WHERE usuario.idNivel = nivel.idNivel";

                        $select  = mysqli_query($conexao, $sql);

                        while($rsContatos = mysqli_fetch_array($select)){
                
                    ?>    
                    <tr>
                        <td><?= $rsContatos['login'] ?></td>
                        <td><?= $rsContatos['email'] ?></td>
                        <td><?= $rsContatos['nomeNivel'] ?></td>
                        <td id="td_imagens">
                            <a href="formulario_usuario.php?id=<?= $rsContatos['idUsuario'] ?>">
                                <img src="imagens/editar.png">
                            </a>
                            <a href="adm_lista_usuarios.php?modo=excluir&id=<?= $rsContatos['idUsuario'] ?>">
                                <img src="imagens/deletar.png">
                            </a>
                        </td>
                    </tr>
                    <?php } ?>        
                    <tbody>
                </table>
            </div>
            <div id="area_botao">
                <form>
                    <a href="formulario_usuario.php">
                        <input type="button" value="Novo usuário" class="button">
                    </a>    
                </form> 
            </div>   
        </div>
        <footer></footer>
    </body>
</html>