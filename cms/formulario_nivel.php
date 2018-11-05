<?php

    session_start();

    require_once('conexao.php');

    $conexao = conexaoBD();

    $botao = "Salvar";

    if(isset($_GET['id'])){
        
        $idNivel = $_GET['id'];
        
        $botao = "Atualizar";

        $_SESSION['idNivel'] = $idNivel;

        $sql = "SELECT * FROM tbl_nivel_usuario WHERE idNivel =".$idNivel;

        $select  = mysqli_query($conexao, $sql);

        if($rsConsulta = mysqli_fetch_array($select))
            $nivel = $rsConsulta['nomeNivel'];
        
    }

    if(isset($_POST['btnSalvar'])){
        
        $nivelUsuario = $_POST['txtNivel'];
        
        if($_POST['btnSalvar'] == "Salvar")
            $sql = "INSERT INTO tbl_nivel_usuario (nomeNivel, status) VALUES ('".$nivelUsuario."', 0)";
        else 
            $sql = "UPDATE tbl_nivel_usuario SET nomeNivel = '".$nivelUsuario."' WHERE idNivel =".$_SESSION['idNivel'];
        

        if(!mysqli_query($conexao, $sql))
                echo "Erro no envio!"."<br>".$sql;
        
        header('location:adm_nivel_usuario.php');
        
    }

?>


<!DOCTYPE html>

<html>

<head>
    <title>CMS</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <style>

        @font-face{
    
            font-family: font-caviarDreams;
            src: url('../fonts/CaviarDreams_Bold.ttf');
    
        }
        
        
        .dados{

            width: 300px;
            height: 30px;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #f2eff2;
            font-size: 18px;
    
        }
        

        td{

            padding-top: 15px;

        }

        .td_esquerda{

            width: 55%;
            font-size: 20px;
            font-family: font-caviarDreams;
            text-align: center;

        }
        
    </style>

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
            Cadastrar nível de usuário
        </div>
        <form name="frm_formulario_nivel" action="formulario_nivel.php" method="post">
            <div id="registros_nivel_usuario">
                <table>
                    <tr>
                        <td class="td_esquerda">
                            <label>Nível usuário</label>
                        </td>
                        <td>
                            <input name="txtNivel" class="dados" type="text" value="<?= @$nivel ?>">
                        </td>
                    </tr>
                </table>
            </div>
            <div id="area_botao">
                <input type="submit" name="btnSalvar" value="<?= $botao ?>" class="button">
                <a href="adm_nivel_usuario.php">
                    <input type="button" value="Cancelar" class="button">
                </a>
            </div>
        </form>
    </div>
    <footer></footer>
</body>

</html>
