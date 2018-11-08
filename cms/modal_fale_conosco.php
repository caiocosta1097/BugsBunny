<?php

    // Importando o arquivo de conexão
    require_once('conexao.php');

	// Variável que recebe o função com a conexão
    $conexao = conexaoBD();
	
	// Variável que recebe o SELECT do banco
    $sql = "SELECT * FROM tbl_fale_conosco WHERE id =".$_POST['idRegistro'];

	// Variável que executa o SELECT
    $select  = mysqli_query($conexao, $sql);
    
	// Verifica se retorna algum registro e coloca em um array
    if($rsConsulta = mysqli_fetch_array($select)){
          
        $nome = $rsConsulta['nome'];
        $telefone = $rsConsulta['telefone'];
        $celular = $rsConsulta['celular'];
        $email = $rsConsulta['email'];
        $homePage = $rsConsulta['homePage'];
        $facebook = $rsConsulta['facebook'];
        $sugestao = $rsConsulta['sugestao'];
        $infoProdutos = $rsConsulta['infoProdutos'];
        $sexo = $rsConsulta['sexo'];
        $profissao = $rsConsulta['profissao'];
        
		// Verifica se o sexo é masculino ou feminino
        if($sexo == "M")
            $sexo = "Masculino";
        else
            $sexo = "Feminino";
            
        
    }

?>


<html>

<head>
    <title>Modal</title>
    <script src="js/jquery.js"></script>
    <style>
    
        @font-face{
    
            font-family: font-caviarDreams;
            src: url('../fonts/CaviarDreams_Bold.ttf');
    
        }
        
        @font-face{
    
            font-family: font-kenyan-negrito;
            src: url('../fonts/kenyan_coffee_bd.ttf');

        }
        
        #header{
            
            height: 50px;
            width: 100%;
            
        }
        
        #fechar_modal{
            
            width: 20px;
            height: 30px;
            margin-top: 15px;
            text-align: center;
            font-family: arial;
            font-size: 20px;
            color: #aaaaaa;
            font-weight: bold;
            transition: 0.5s;
            float: right;
            text-decoration: none;
            padding-right: 10px;
            
        }
        
        
        #fechar_modal:hover{
        
            
            color: #000;
            transition: 0.5s;
            
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
        
        #txtSugestao, #txtInfoProdutos{
            
            height:100px; 
            width:300px;
            max-width: 300px;
            max-height: 100px;
            
        }

        #txtTelefone, #txtCelular, #txtSexo{
    
            width: 140px;
        
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
        
        #titulo_modal{
            
            width: 100%;
            height: 30px;
            text-align: center;
            font-family: font-kenyan-negrito;
            font-size: 40px;
            margin-bottom: 30px;
            
        }
        
    </style>
</head>

<body>
    <div id="header">
        <div id="fechar_modal"><a href="adm_fale_conosco.php">x</a></div>
    </div>
    <form>
        <table>
            <div id="titulo_modal">Dados do usuário</div>
            <tr>
                <td class="td_esquerda">
                    <label>Nome</label>
                </td>
                <td>
                    <input name="txtNome" class="dados" id="txtNome" type="text" value="<?=$nome?>" readonly>
                </td>
            </tr>
            <tr>
                <td class="td_esquerda">
                    <label>Telefone</label>
                </td>
                <td>
                    <input name="txtTelefone" class="dados" id="txtTelefone" type="text" value="<?=$telefone?>" readonly>
                </td>
            </tr>
            <tr>
                <td class="td_esquerda">
                    <label>Celular</label>
                </td>
                <td>
                    <input name="txtCelular" class="dados" id="txtCelular" type="text" value="<?=$celular?>" readonly>
                </td>
            </tr>
            <tr>
                <td class="td_esquerda">
                    <label>Email</label>
                </td>
                <td>
                    <input name="txtEmail" class="dados" type="email" value="<?=$email?>" readonly>
                </td>
            </tr>
            <tr>
                <td class="td_esquerda">
                    <label>Home Page</label>
                </td>
                <td>
                    <input name="txtHomePage" class="dados" type="url" value="<?=$homePage?>" readonly>
                </td>
            </tr>
            <tr>
                <td class="td_esquerda">
                    <label>Link no Facebook</label>
                </td>
                <td>
                    <input name="txtFacebook" class="dados" type="url" value="<?=$facebook?>" readonly>
                </td>
            </tr>
            <tr>
                <td class="td_esquerda">
                    <label>Sugestão/Criticas</label>
                </td>
                <td>
                    <textarea name="txtSugestao" class="dados" id="txtSugestao" readonly><?=$sugestao?></textarea>
                </td>
            </tr>
            <tr>
                <td class="td_esquerda">
                    <label>Informações de Produtos</label>
                </td>
                <td>
                    <textarea name="txtInfoProdutos" class="dados" id="txtInfoProdutos" readonly><?=$infoProdutos?></textarea>
                </td>
            </tr>
            <tr>
                <td class="td_esquerda">
                    <label>Sexo</label>
                </td>
                <td>
                    <input name="txtSexo" class="dados" type="text" id="txtSexo" value="<?=$sexo?>" readonly>
                </td>
            </tr>
            <tr>
                <td class="td_esquerda">
                    <label>Profissão</label>
                </td>
                <td>
                    <input name="txtProfissao" class="dados" type="text" value="<?=$profissao?>" readonly>
                </td>
            </tr>
        </table>
    </form>
</body>

</html>