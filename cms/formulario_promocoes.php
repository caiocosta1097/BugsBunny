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

// Variável que recebe o título da página
$tituloPagina = "Cadastrar promoção";

// Botão começa com salvar
$botao = "Salvar";

// Verifica se id existe
if(isset($_GET['id'])){

	// Variável que recebe o id do registro
    $idPromocao = $_GET['id'];

	// Titulo da página muda
    $tituloPagina = "Atualizar promoção";

	// Botão da página muda
    $botao = "Atualizar";

	// Inicia uma variável de sessão que recebe o id do registro
    $_SESSION['idPromocao'] = $idPromocao;

	// Variável que recebe o registro do banco
    $sql = "SELECT * FROM tbl_promocoes WHERE idPromocao =".$idPromocao;

	// Variável que executa o SELECT
    $select  = mysqli_query($conexao, $sql);

	// Verifica se retorna algum registro e coloca em um array
    if($rsPromocao = mysqli_fetch_array($select)){

        $idProduto = $rsPromocao['idProduto'];
        $desconto = $rsPromocao['desconto'];

    }

}

// Verifica se o submit foi clicado
if(isset($_POST['btnSalvar'])){

	// Pega todos os valores inseridos no formulário e coloca em variáveis
    $idProduto = $_POST['slt_produto'];
    $desconto = $_POST['slt_desconto'];

	// Verifica se o botão é pra salvar e faz um INSERT no banco, senão faz um UPDATE
    if($_POST['btnSalvar'] == "Salvar"){

        $sql = "INSERT INTO tbl_promocoes (idProduto, desconto, status) VALUES ('".$idProduto."', '".$desconto."', 0)";

    }

    else{

        $sql = "UPDATE tbl_promocoes SET idProduto = '".$idProduto."', desconto = '".$desconto."'
        WHERE idPromocao =".$_SESSION['idPromocao']; 

    }

    // Verifica se QUERY não pôde ser executada e exibe um erro, senão atualiza a página
    if(!mysqli_query($conexao, $sql))
        echo "Erro: ".mysqli_errno($conexao)." - ".mysqli_error($conexao);
    else
        header('location:adm_promocoes.php');

}

?>

<!DOCTYPE html>

<html>

<head>
    <title>CMS</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta charset="utf-8">
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.form.js"></script>

    <script>

        $(document).ready(function(){

            // Carrega a função de foto
            foto();
            
            // Quando mudar o select, chama a função foto
            $('#slt_produto').live('change', function(){

                foto();
                
            });

            // Função para carregar a foto do produto
            function foto(){

                // PEga o id do produto
                var id = $('#slt_produto').val();

                // Passa a url com os paramêtros e o id
                $.ajax({

                    type: "POST",
                    url: "foto.php",
                    data: {idProduto: id},
                    success: function(callback) {

                        // Coloca na div de foto
                        $('#fotoPromocao').html(callback);
                        
                    }

                })

            };     
            
        });
        
    </script>

</head>

<body>
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
    <div id="principal_form_adm_promocoes">
        <div id="titulo_form_adm_promocoes">
            <?= $tituloPagina ?>
        </div>
        <div id="caixa_form_adm_promocoes">
            <table class="tabela_formulario">
                <form name="frm_conteudo" action="formulario_promocoes.php" method="post">
                    <tr>
                        <td class="td_esquerda">
                            <label>Produto</label>
                        </td>
                        <td>
                            <select class="dados" name="slt_produto" id="slt_produto">
                                <?php
                                
                                // Variável que faz o SELECT do banco
                                $sql = "SELECT * FROM tbl_produto";

                                $select = mysqli_query($conexao, $sql);

                                while($rsProdutos = mysqli_fetch_array($select)){

                                    $selected = "";

                                    if($rsProdutos['idProduto'] == $idProduto)
                                        $selected = "selected";
                                    
                                    ?>
                                    <option value="<?= $rsProdutos['idProduto'] ?>" <?=  $selected?>>
                                        <?= $rsProdutos['produto'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </td>
                        <td rowspan="2" width="50%">
                            <div id="fotoPromocao">

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_esquerda">
                            <label>Desconto</label>
                        </td>
                        <td>
                            <select class="dados" name="slt_desconto">
                                <?php

                                for($i = 5; $i <= 100; $i += 5){

                                    $selected = "";

                                    if($i == $desconto)
                                        $selected = "selected";    

                                    ?>
                                    <option value="<?= $i ?>" <?=  $selected?>>
                                        <?= $i ?>%
                                    </option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div id="area_botao">
                                <input type="submit" name="btnSalvar" value="<?= $botao ?>" class="button">
                                <a href="adm_promocoes.php">
                                    <input type="button" value="Cancelar" class="button">
                                </a>
                            </div>
                        </td>
                    </tr>
                </form>
            </table>
        </div>
    </div>
    <!-- Rodapé -->
    <footer></footer>
</body>

</html>
