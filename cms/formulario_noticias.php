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

    $caixa_foto = "hidden";

    if(isset($_GET['id'])){
        
        $idNoticia = $_GET['id'];
        
        $botao = "Atualizar";
        
        $caixa_foto = "";
        
        $_SESSION['idNoticia'] = $idNoticia;
        
        $sql = "SELECT * FROM tbl_noticias WHERE idNoticia =".$idNoticia;

        $select  = mysqli_query($conexao, $sql);

        if($rsConsulta = mysqli_fetch_array($select)){
            
            $titulo = $rsConsulta['titulo'];
            $foto = $rsConsulta['foto'];
            
            $_SESSION['foto'] = $foto;
            
        }
        
    }

    if(isset($_POST['btnSalvar'])){
        
        $foto = $_POST['txtFoto'];
        $titulo = $_POST['txtTitulo'];
        
        if($_POST['btnSalvar'] == "Salvar"){
         
            $sql = "INSERT INTO tbl_noticias (foto, titulo, status) VALUES ('".$foto."', '".$titulo."', 0)";
            
        } else{
            
            if($foto == "")
                $foto = $_SESSION['foto'];
            
            
            $sql = "UPDATE tbl_noticias SET titulo = '".$titulo."', foto = '".$foto."'
                    WHERE idNoticia =".$_SESSION['idNoticia']; 
            
        }
        
        
        if(!mysqli_query($conexao, $sql))
                echo "Erro no envio!"."<br>".$sql;
        
        header('location:adm_noticias.php');
        
    }

?>

<!DOCTYPE html>

<html>

<head>
    <title>CMS</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.form.js"></script>

    <style>

        @font-face{
    
            font-family: font-caviarDreams;
            src: url('../fonts/CaviarDreams_Bold.ttf');
    
        }
        
        
        .dados{

            width: 400px;
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
        
        #visualizar, #visualizar img{
                
            width: 250px;
            height: 180px;
            border-radius: 15px;
            background-color: #f2eff2;
            margin-left: auto;
            margin-right: auto;
                
        }
        
    </style>

    <script>

        $(document).ready(function(){
                
                // Na ação do live do elemento file, que significa ser
                // com um arquivo (foto), será acionado              
                $('#txtUpload').live('change', function(){
                
                    // Forçando um submit no formulário do fileUpload para
                     // conseguir realizar o upload da foto sem o click de um botão
                    $('#frmFoto').ajaxForm({
                        
                    // O retorno da página upload.php que será submetida pelo
                    // formulário, deverá ser descarregada na div visualizar.
                    // Para isso usamos o atributo target do ajaxForm (isso é
                    // conhecido como CallBack)
                        target:'#visualizar'
                        
                    }).submit();  
                
                });
                
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
            Cadastrar notícia
        </div>
        <div id="caixa_noticias">
            <table>
                <tr>
                    <form id="frmFoto" name="frmFotos" action="upload.php" method="post" enctype="multipart/form-data">
                        <td class="td_esquerda">
                            <label>Imagem</label>
                        </td>
                        <td>
                            <input name="fileFoto" id="txtUpload" class="dados" type="file">
                        </td>
                    </form>
                    <td rowspan="2" width="50%">
                        <div id="visualizar">
                            <img src="<?= $foto ?>" <?= $caixa_foto ?>>
                        </div>
                    </td>
                </tr>
                <form name="frm_formulario_noticias" action="formulario_noticias.php" method="post">
                    <tr>

                        <td class="td_esquerda">
                            <label>Título</label>
                        </td>

                        <td>
                            <input name="txtTitulo" class="dados" type="text" value="<?= @$titulo ?>">
                             <input name="txtFoto" id="txtFoto" class="dados" type="hidden">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div id="area_botao">
                                <input type="submit" name="btnSalvar" value="<?= $botao ?>" class="button">
                                <a href="adm_noticias.php">
                                    <input type="button" value="Cancelar" class="button">
                                </a>
                            </div>
                        </td>
                    </tr>
                </form>
            </table>
        </div>

    </div>
    <footer></footer>
</body>

</html>
