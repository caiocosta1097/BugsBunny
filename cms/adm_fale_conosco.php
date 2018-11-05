<?php

    require_once('conexao.php');

    session_start();

    $conexao = conexaoBD();

    if(isset($_GET['modo'])){
        
        $modo = $_GET['modo'];
        
        if($modo == 'excluir'){
            
            $id = $_GET['id'];
            
            $sql = "DELETE FROM tbl_fale_conosco WHERE id =".$id;
        
            if(!mysqli_query($conexao, $sql))
                echo "Erro ao excluir contato";
            
            header('location:adm_fale_conosco.php');
            
        }
        
    }

?>


<!DOCTYPE html>

<html lang="pt">
    <head>
        <title>CMS</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/jquery.js"></script>
        <style>
        
            #container{
    
    
                width: 100%;
                height: 100%;
                margin-top: -25px;
                background-color: rgba(0,0,0,0.5);
                position: fixed;
                z-index: 999;
                display: none;

            }

            #modal{

                width: 750px;
                height: 770px;
                background-color: #fff;
                margin-left: auto;
                margin-right: auto;
                margin-top: 50px;
                border-radius: 25px;

            }
            
            a{
                
                color: inherit;
                text-decoration: none;
                
            }
        
        </style>
        <script>
    
        $(document).ready(function(){
            
            // Function para abrir a janela modal     
            $(".visualizar").click(function(){
                
                $("#container").fadeIn(1100);    
                
            });
            
        });
        
        // Função para receber o ID do registro e descarregar na modal
        function modal(idContato){
            
            // Somente o ajax consegue forçar um POST ou GET sem atualizar a página
            $.ajax({
                
                /*
                
                    type - serve especificar se é GET ou POST
                    url - serve para especificar a página requisitada
                    data - serve para criar variáveis que serão submetidas (GET ou POST)
                            para a página requisitada
                    success - caso toda a requisição seja realizada com exito, então
                                a function do success será chamada e através do paramêtro dados,
                                iremos desgarregar na div (modal) o contéudo de dados
                
                */
                type: "POST",
                url: "modal_fale_conosco.php",
                data: {idRegistro:idContato},
                success: function(dados){
                    
                    $('#modal').html(dados);
                    
                }
                
            })
            
        };
        
    </script>
    </head>
    <body>
        <div id="container">
            <div id="modal">

            </div>
        </div>
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
        <div id="principal_adm_fale_conosco">
            <div id="titulo_adm_fale_conosco">
                Registros do Fale Conosco
            </div>
            <div id="registros_fale_conosco">
                <table id="tabela">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Profissão</th>
                        <th>Opções</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                
                        $sql = "SELECT * FROM tbl_fale_conosco ORDER BY id";

                        $select  = mysqli_query($conexao, $sql);

                        while($rsContatos = mysqli_fetch_array($select)){
                
                    ?>
                    <tr>
                        <td><?= $rsContatos['nome'] ?></td>
                        <td><?= $rsContatos['email'] ?></td>
                        <td><?= $rsContatos['profissao'] ?> </td>
                        <td id="td_imagens">
                            <a href="#" class="visualizar" onclick="modal(<?php echo($rsContatos['id']);?>)">
                                <img src="imagens/visualizar.png">
                            </a>
                            <a href="adm_fale_conosco.php?modo=excluir&id=<?php echo($rsContatos['id']);?>">
                                <img src="imagens/deletar.png">
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                    <tbody>    
                </table>
            </div>
        </div>
        <footer></footer>
    </body>
</html>