<?php

    session_start();

    require_once('conexao.php');

    $conexao = conexaoBD();

    $botao = "Salvar";

    $caixa_foto = "hidden";


    if(isset($_GET['id'])){
        
        $idCelebridade = $_GET['id'];
        
        $botao = "Atualizar";
        
        $caixa_foto = "";
        
        $_SESSION['idCelebridade'] = $idCelebridade;
        
        $sql = "SELECT * FROM tbl_celebridade WHERE idCelebridade =".$idCelebridade;

        $select  = mysqli_query($conexao, $sql);

        if($rsConsulta = mysqli_fetch_array($select)){
            
            $foto = $rsConsulta['foto'];
            $nome = $rsConsulta['nome'];
            $dtNasc = $rsConsulta['dtNasci'];
            $naturalidade = $rsConsulta['naturalidade'];
            $profissao = $rsConsulta['profissao'];
            $biografia = $rsConsulta['biografia'];
            
            $_SESSION['foto'] = $foto;
            
        }
        
    }

    if(isset($_POST['btnSalvar'])){
        
        $foto = $_POST['txtFoto'];
        $nome = $_POST['txtNome'];
        $dtNasc = $_POST['txtData'];
        $naturalidade = $_POST['txtNaturalidade'];
        $profissao = $_POST['txtProfissao'];
        $biografia = $_POST['txtBiografia'];
        
        if($_POST['btnSalvar'] == "Salvar"){
         
            $sql = "INSERT INTO tbl_celebridade (foto, nome, dtNasci, naturalidade, profissao, biografia, status) 
                    VALUES ('".$foto."', 
                            '".$nome."',
                            '".$dtNasc."', 
                            '".$naturalidade."',
                            '".$profissao."', 
                            '".$biografia."',
                            0)";
            
        } else{
            
            if($foto == "")
                $foto = $_SESSION['foto'];
            
            
            $sql = "UPDATE tbl_celebridade 
                    SET foto = '".$foto."', 
                    nome = '".$nome."',
                    dtNasci = '".$dtNasc."',
                    naturalidade = '".$naturalidade."',
                    profissao = '".$profissao."',
                    biografia = '".$biografia."'
                    WHERE idCelebridade =".$_SESSION['idCelebridade']; 
            
        }
        
        
        if(!mysqli_query($conexao, $sql))
                echo "Erro no envio!"."<br>".$sql;
        
        header('location:adm_celebridade.php');
        
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
        
        #txtData{
            
            width: auto;
            
        }
        
        #txtBiografia{
            
            height: 100px;
            max-width: 400px;
            max-height: 100px;
            
        }
        

        td{

            padding-top: 20px;

        }
            

        .td_esquerda{

            width: 55%;
            font-size: 20px;
            font-family: font-caviarDreams;
            text-align: center;

        }
        
        #visualizar, #visualizar img{
                
            width: 300px;
            height: 250px;
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
                <div id="boas_vindas">Bem vindo, Caio</div>
                <div id="logout">Logout</div>
            </div>
        </div>
    </header>
    <div id="principal_formulario_celebridade">
        <div id="titulo_adm_nivel_usuario">
            Cadastrar celebridade
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
                    <td rowspan="6" width="50%">
                        <div id="visualizar">
                            <img src="<?= $foto ?>" <?= $caixa_foto?>>
                        </div>
                    </td>
                </tr>
                <form name="frm_formulario_noticias" action="formulario_celebridade.php" method="post">
                    <tr>

                        <td class="td_esquerda">
                            <label>Nome</label>
                        </td>

                        <td>
                            <input name="txtNome" class="dados" type="text" value="<?= @$nome ?>">
                            <input name="txtFoto" id="txtFoto" class="dados" type="hidden">
                        </td>
                    </tr>
                    <tr>

                        <td class="td_esquerda">
                            <label>Data de Nascimento</label>
                        </td>

                        <td>
                            <input name="txtData" class="dados" id="txtData" type="date" value="<?= @$dtNasc ?>">
                        </td>
                    </tr>
                    <tr>

                        <td class="td_esquerda">
                            <label>Profissão</label>
                        </td>

                        <td>
                            <input name="txtProfissao" class="dados" type="text" value="<?= @$profissao ?>">
                        </td>
                    </tr>
                    <tr>

                        <td class="td_esquerda">
                            <label>Naturalidade</label>
                        </td>

                        <td>
                            <input name="txtNaturalidade" class="dados" type="text" value="<?= @$naturalidade ?>">
                        </td>
                    </tr>
                    <tr>

                        <td class="td_esquerda">
                            <label>Biografia</label>
                        </td>

                        <td>
                            <textarea name="txtBiografia" id="txtBiografia" class="dados"><?= @$biografia ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div id="area_botao">
                                <input type="submit" name="btnSalvar" value="<?= $botao ?>" class="button">
                                <a href="adm_celebridade.php">
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
