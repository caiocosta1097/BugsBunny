<?php

// Iniciando uma sessão
session_start();

// Importando o arquivo de autenticação
require_once('../verificar_autenticacao.php');

// Importanto o arquivo para preencher o html
require_once('itens_menu.php');

// Importando o arquivo de conexão
require_once('conexao.php');

// Variável que recebe a função com o usuário autenticado
$rsUser = verificarAutentica();

// Variável que recebe a função com a conexão
$conexao = conexaoBD();

// Variável que recebe o título da página
$tituloPagina = "Cadastrar usuário";

// Botão começa com salvar
$botao = "Salvar";

// Label começa com senha
$lblSenha = "Senha";

// Senha é obrigatória
$required = "required";

	// Verifica se id existe
if(isset($_GET['id'])){

	// Variável que recebe o id do registro
    $idUsuario = $_GET['id'];

	// Titulo da página muda
    $tituloPagina = "Atualizar usuário";

	// Botão da página muda
    $botao = "Atualizar";

	// Label da página muda
    $lblSenha = "Nova senha";

	// Senha não é obrigatória
    $required = "";

	// Inicia uma variável de sessão que recebe o id do registro
    $_SESSION['idUsuario'] = $idUsuario;

	// Variável que recebe o registro do banco
    $sql = "SELECT * FROM tbl_usuario WHERE idUsuario =".$idUsuario;

	// Variável que executa o SELECT
    $select  = mysqli_query($conexao, $sql);

	// Verifica se retorna algum registro e coloca em um array
    if($rsUsuario = mysqli_fetch_array($select)){

        $nome = $rsUsuario['nome'];
        $login = $rsUsuario['login'];
        $email = $rsUsuario['email'];
        $senha = $rsUsuario['senha'];
        $idNivel = $rsUsuario['idNivel'];

		// Inicia uma variável de sessão que recebe a senha do registro
        $_SESSION['senhaUsuario'] = $senha;

    }

}

// Verifica se o submit foi clicado
if(isset($_POST['btnSalvar'])){

	// Pega todos os valores inseridos no formulário e coloca em variáveis
    $nome = $_POST['txtNome'];
    $idNivel = $_POST['slt_nivel'];
    $login = $_POST['txtLogin'];
    $senha = md5($_POST['txtSenha']);
    $email = $_POST['txtEmail'];

	// Verifica se o botão é pra salvar e faz um INSERT no banco, senão faz um UPDATE
    if($_POST['btnSalvar'] == "Salvar"){

     $sql = "INSERT INTO tbl_usuario (nome, login, senha, email, idNivel) 
     VALUES ('".$nome."', '".$login."', '".$senha."', '".$email."', '".$idNivel."')";

 } else {

	// Verifica se a senha está em branco e coloca a senha original
    if($senha == md5(""))
        $senha = $_SESSION['senhaUsuario'];


    $sql = "UPDATE tbl_usuario SET nome = '".$nome."', 
    login = '".$login."', 
    senha = '".$senha."', 
    email = '".$email."', 
    idNivel = '".$idNivel."' 
    WHERE idUsuario =".$_SESSION['idUsuario']; 

}

    // Verifica se QUERY não pôde ser executada e exibe um erro, senão atualiza a página
if(!mysqli_query($conexao, $sql))
    echo "Erro: ".mysqli_errno($conexao)." - ".mysqli_error($conexao);
else
    header('location:adm_usuarios.php');

}
?>


<!DOCTYPE html>

<html>

<head>
    <title>CMS</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta charset="utf-8">
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
    <div id="principal_form_adm_usuarios">
        <div id="titulo_form_adm_usuarios">
            <?= $tituloPagina ?>
        </div>
        <form action="formulario_usuario.php" method="post">
            <div id="caixa_form_adm_usuarios">
                <table class="tabela_formulario">
                    <tr>
                        <td class="td_esquerda">
                            <label>Nome</label>
                        </td>

                        <td>
                            <input maxlength="100" name="txtNome" class="dados" type="text" value="<?= @$nome ?>" required>
                        </td>
                        <td class="td_esquerda">
                            <label>Nível usuário</label>
                        </td>
                        <td>
                            <select class="dados" name="slt_nivel">
                                <?php

								// Variável que recebe o SELECT do banco onde o status = 0 (ativado)
                                $sql = "SELECT * FROM tbl_nivel_usuario WHERE status = 0";

								// Variável que executa o SELECT
                                $select  = mysqli_query($conexao, $sql);

								// Loop para pegar cada registro no SELECT e colocar em um array
                                while($rsNivel = mysqli_fetch_array($select)){

                                    // Declara uma variável pra receber o selected    
                                    $selected = "";    
                                    
								    // Verifica se o id do nível é o mesmo do usuario e seleciona
                                    if($rsNivel['idNivel'] == $idNivel )
                                       $selected = "selected";

                                   ?>
                                   <option value="<?= $rsNivel['idNivel'] ?>" <?=$selected ?>>
                                    <?= $rsNivel['nomeNivel'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="td_esquerda">
                        <label>Login</label>
                    </td>
                    <td>
                        <input maxlength="30" name="txtLogin" class="dados" type="text" value="<?= @$login ?>" required>
                    </td>
                    <td class="td_esquerda">
                        <label>
                            <?= $lblSenha ?></label>
                        </td>
                        <td>
                            <input maxlength="45" name="txtSenha" class="dados" type="password" <?=$required ?>>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_esquerda">
                            <label>Email</label>
                        </td>
                        <td>
                            <input maxlength="100" name="txtEmail" class="dados" type="text" value="<?= @$email ?>" required>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="area_botao">
                <input type="submit" name="btnSalvar" value="<?= $botao ?>" class="button">
                <a href="adm_usuarios.php">
                    <input type="button" value="Cancelar" class="button">
                </a>
            </div>
        </form>
    </div>
    <!-- Rodapé -->
    <footer></footer>
</body>

</html>
