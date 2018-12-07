<?php

// Iniciando uma sessão
session_start();

// Importando o arquivo de autenticação
require_once('../verificar_autenticacao.php');

// Importanto o arquivo para preencher o html
require_once('itens_menu.php');

// Importando o arquivo de conexão
require_once('conexao.php');

// Variável que recebe o função com o usuário autenticado
$rsUser = verificarAutentica();

// Variável que recebe o função com a conexão
$conexao = conexaoBD();

// Verifica se modo existe
if(isset($_GET['modo'])){

	// Variável que recebe o modo
    $modo = $_GET['modo'];

	// Verifica se o modo = 'excluir' e deleta o registro
    if($modo == 'excluir'){

        $id = $_GET['id'];

        $sql = "DELETE FROM tbl_fale_conosco WHERE id =".$id;
        
        // Verifica se QUERY não pôde ser executada e exibe um erro, senão atualiza a página
        if(!mysqli_query($conexao, $sql))
            echo "Erro: ".mysqli_errno($conexao)." - ".mysqli_error($conexao);
        else
            header('location:adm_fale_conosco.php');     

    } 

}

?>


<!DOCTYPE html>

<html lang="pt">

<head>
    <title>CMS</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta charset="utf-8">
    <script src="js/jquery.js"></script>

    <script>
        $(document).ready(function() {

            // Function para abrir a janela modal     
            $(".visualizar").click(function() {

                $("#container").fadeIn(1100);

            });

            // Função para receber o ID do registro e fazer o callback na modal
            function modal(idRegistro) {

                $.ajax({

                    type: "POST",
                    url: "modal_fale_conosco.php",
                    data: {
                        idRegistro: idRegistro
                    },
                    success: function(callback) {

                        $('#modal').html(callback);

                    }

                })

            };

        });

    </script>
</head>

<body>
    <div id="container">
        <div id="modal">

        </div>
    </div>
    <!--  Cabeçalho  -->
    <header>
        <div id="caixa_cabecalho">
            <!--  Título do CMS  -->
            <div id="titulo_pagina">
                <span id="negrito">CMS</span> - Sistema de Gerenciamento do Site
            </div>
            <!--  Logo  -->
            <div id="logo_pagina"></div>
        </div>
        <!--  Menu  -->
        <div id="caixa_menu">
            <nav id="menu_principal">
                <!--  Função que preenche os itens do menu  -->
                <?php itens_menu($rsUser['idNivel']); ?>
            </nav>
            <!--  Área de logout  -->
            <div id="area_logout">
                <div id="boas_vindas">Bem vindo,
                    <?= $rsUser['nome'] ?>
                </div>
                <div id="logout"><a href="index.php?logout">Logout</a></div>
            </div>
        </div>
    </header>
    <!--  Div principal da página  -->
    <div id="principal_adm_fale_conosco">
        <div id="titulo_adm_fale_conosco">
            Registros do Fale Conosco
        </div>
        <div id="registros_adm_fale_conosco">
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

					// Variável que recebe o SELECT do banco
                    $sql = "SELECT * FROM tbl_fale_conosco ORDER BY id";

					// Variável que executa o SELECT
                    $select  = mysqli_query($conexao, $sql);

					// Loop para pegar cada registro no SELECT e colocar em um array
                    while($rsFaleConosco = mysqli_fetch_array($select)){

                        ?>
                        <tr>
                            <td>
                                <?= $rsFaleConosco['nome'] ?>
                            </td>
                            <td>
                                <?= $rsFaleConosco['email'] ?>
                            </td>
                            <td>
                                <?= $rsFaleConosco['profissao'] ?>
                            </td>
                            <td id="td_imagens">
                                <a href="#" class="visualizar" onclick="modal(<?= $rsFaleConosco['id'] ?>)">
                                    <img src="imagens/visualizar.png" title="Visualizar">
                                </a>
                                <a href="adm_fale_conosco.php?modo=excluir&id=<?= $rsFaleConosco['id'] ?>">
                                    <img src="imagens/deletar.png" title="Excluir">
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    <tbody>
                    </table>
                </div>
            </div>
            <!-- Rodapé -->
            <footer></footer>
        </body>

        </html>
