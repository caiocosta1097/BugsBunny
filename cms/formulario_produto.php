<?php

    // Iniciando uma sessão
    session_start();

	// Importando o arquivo de autenticação
    require_once('../verificar_autenticacao.php');

    // Importando o arquivo de conexão
    require_once('conexao.php');

	// Variável que recebe o função com o usuário autenticado
    $rsUser = verificarAutentica();

    $bloqueioConteudo = null;
    $bloqueioFaleConosco = null;
    $bloqueioProduto = null;
    $bloqueioUsuario = null;
    
    if($rsUser['idNivel'] == 21){
        
        $bloqueioConteudo = "";
        $bloqueioFaleConosco = "";
        $bloqueioProduto = "style='filter: grayscale(100%); pointer-events: none;'";
        $bloqueioUsuario = "style='filter: grayscale(100%); pointer-events: none;'";
        
    }else if ($rsUser['idNivel'] == 22){
        
        $bloqueioConteudo = "style='filter: grayscale(100%); pointer-events: none;'";
        $bloqueioFaleConosco = "style='filter: grayscale(100%); pointer-events: none;'";
        $bloqueioProduto = "";
        $bloqueioUsuario = "style='filter: grayscale(100%); pointer-events: none;'";
        
    } else{
        
        $bloqueioConteudo = "";
        $bloqueioFaleConosco = "";
        $bloqueioProduto = "";
        $bloqueioUsuario = "";
        
    }


    // Variável que recebe o função com a conexão
    $conexao = conexaoBD();
	
	// Variável que recebe o título da página
    $tituloPagina = "Cadastrar produto";

	// Botão começa com salvar
    $botao = "Salvar";

	// Caixa da foto começa escondida
    $caixa_foto = "hidden";

	// Verifica se id existe
    if(isset($_GET['id'])){
        
		// Variável que recebe o id do registro
        $idProduto = $_GET['id'];
        
		// Titulo da página muda
        $tituloPagina = "Atualizar produto";
        
		// Botão da página muda
        $botao = "Atualizar";
        
		// Caixa da foto aparece
        $caixa_foto = "";
        
		// Inicia uma variável de sessão que recebe o id do registro
        $_SESSION['idProduto'] = $idProduto;
        
		// Variável que recebe o registro do banco
        $sql = "SELECT produto.*, categoria.idCategoria 
        FROM tbl_produto AS produto, tbl_categoria AS categoria, tbl_subcategoria AS subcategoria 
        WHERE categoria.idCategoria = subcategoria.idCategoria
        AND produto.idSubcategoria = subcategoria.idSubcategoria
        AND produto.idProduto =".$idProduto;

		// Variável que executa o SELECT
        $select  = mysqli_query($conexao, $sql);

		// Verifica se retorna algum registro e coloca em um array
        if($rsProduto = mysqli_fetch_array($select)){
            
            $foto = $rsProduto['foto'];
            $produto = $rsProduto['produto'];
            $idSubcategoria = $rsProduto['idSubcategoria'];
            $idCategoria = $rsProduto['idCategoria'];
            $preco = $rsProduto['preco'];
            $descricao = $rsProduto['descricao'];
            
			// Inicia uma variável de sessão que recebe o caminho da foto
            $_SESSION['foto'] = $foto;
            
        }
        
    }
	
	// Verifica se o submit foi clicado
    if(isset($_POST['btnSalvar'])){
        
		// Pega todos os valores inseridos no formulário e coloca em variáveis
        $foto = $_POST['txtFoto'];
        $produto = $_POST['txtProduto'];
        $idSubcategoria = $_POST['slt_subcategoria'];
        $preco = $_POST['txtPreco'];
        
        
        
        $descricao = $_POST['txtDescricao'];
        
		// Verifica se o botão é pra salvar e faz um INSERT no banco, senão faz um UPDATE
        if($_POST['btnSalvar'] == "Salvar"){
			
			$sql = "INSERT INTO tbl_produto (foto, produto, idSubcategoria, preco, descricao, status) 
                    VALUES ('".$foto."', 
                            '".$produto."',
                            '".$idSubcategoria."', 
                            '".$preco."',
                            '".$descricao."', 
                            0)";
			
		}else{
            
			// Verifica se a caixa da foto ficou vazia e coloca o caminho da foto
            if($foto == "")
                $foto = $_SESSION['foto'];
            
            
            $sql = "UPDATE tbl_produto 
                    SET foto = '".$foto."', 
                    produto = '".$produto."',
                    idSubcategoria = '".$idSubcategoria."',
                    preco = '".$preco."',
                    descricao = '".$descricao."'
                    WHERE idProduto =".$_SESSION['idProduto']; 
            
        }
		
		// Verifica se QUERY não pôde ser executada e exibe um erro, senão atualiza a página
		if(!mysqli_query($conexao, $sql))
			echo "Erro: ".mysqli_errno($conexao)." - ".mysqli_error($conexao);
		else
			header('location:adm_lista_produtos.php');
        
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
    <script src="js/jquery.mask.min.js"></script>

    <script>

        $(document).ready(function(){
                
            // Verifica se algum upload foi feito           
            $('#txtUpload').live('change', function(){
                
				// Forçando um submit no formulário do fileUpload para
				// conseguir realizar o upload da foto sem o click de um botão
				$('#frmFoto').ajaxForm({
							
					target:'#fotoProduto'
							
				}).submit();  
                
            });
            
            // Chamando método ao criar a página
            carregarSubcategorias();
            
            
            $('#slt_categoria').live('change', function(){
             
                // Chamando o método se algum item do select for mudado
                carregarSubcategorias();
                
            });
            
        });
        
        // Função para carregar um select atráves do outro
        function carregarSubcategorias(){
            
            // Pega o id da categoria selecionada
            var id =  $('#slt_categoria').val();
            
            var idSubcategoria = "<?= $idSubcategoria ?>"
            
            // Manda uma url com o id em formato JSON
            $.getJSON('consulta_subcategorias.php?idCategoria=' + id, function(dados) {
                 
                // Verifica se retorna algum dado com o select
                if (dados.length > 0){
                    
                    // option que começa em null
                    var option = null;
                    
                    // Função para colocar os dados retornados em options 
                    $.each(dados, function(i, obj){
                        
                        if(obj.idSubcategoria == idSubcategoria){
                            
                            option += '<option selected value="'+obj.idSubcategoria+'">'+obj.subcategoria+'</option>';
                            
                        } else{
                            
                            option += '<option value="'+obj.idSubcategoria+'">'+obj.subcategoria+'</option>';
                            
                        }
                        
                    })
    
                }
                   
                // Exibe os options no select
                $('#slt_subcategoria').html(option).show();
                   
            });
            
        }
        
        // Mascára de dinheiro
        $('#txtPreco').mask('#.00', {reverse: true});
            
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
                <!--  Itens do menu  -->
                <div class="itens_menu">
                    <a href="adm_conteudo.php">
                        <img class="imagens_menu" src="imagens/adm_conteudo.png" <?=$bloqueioConteudo ?>>
                    </a>
                    <div class="titulo_menu">Adm. Conteúdo</div>
                </div>
                <div class="itens_menu">
                    <a href="adm_fale_conosco.php">
                        <img class="imagens_menu" src="imagens/adm_fale_conosco.png" <?=$bloqueioFaleConosco ?>>
                    </a>
                    <div class="titulo_menu">Adm. Fale Conosco</div>
                </div>
                <div class="itens_menu">
                    <a href="adm_produtos.php">
                        <img class="imagens_menu" src="imagens/adm_produtos.png" <?=$bloqueioProduto ?>>
                    </a>
                    <div class="titulo_menu">Adm. Produtos</div>
                </div>
                <div class="itens_menu">
                    <a href="adm_users.php">
                        <img class="imagens_menu" src="imagens/adm_usuarios.png" <?=$bloqueioUsuario ?>>
                    </a>
                    <div class="titulo_menu">Adm. Usuários</div>
                </div>
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
    <div id="principal_form_produto">
        <div id="titulo_form_adm_produto">
            <?= $tituloPagina ?>
        </div>
        <div id="caixa_form_adm_produto">
            <table class="tabela_formulario">
                <tr>
                    <form id="frmFoto" action="upload.php" method="post" enctype="multipart/form-data">
                        <td class="td_esquerda">
                            <label>Imagem</label>
                        </td>
                        <td>
                            <input name="fileFoto" id="txtUpload" class="dados" type="file" required>
                        </td>
                    </form>
                    <td rowspan="6" width="50%">
                        <div id="fotoProduto">
                            <img src="<?= $foto ?>" <?=$caixa_foto?>>
                        </div>
                    </td>
                </tr>
                <form name="frm_conteudo" action="formulario_produto.php" method="post">
                    <tr>

                        <td class="td_esquerda">
                            <label>Produto</label>
                        </td>

                        <td>
                            <input maxlength="100" name="txtProduto" class="dados" type="text" value="<?= @$produto ?>" required>
                            <input name="txtFoto" id="txtFoto" class="dados" type="hidden">
                        </td>
                    </tr>
                    <tr>

                        <td class="td_esquerda">
                            <label>Categoria</label>
                        </td>

                        <td>
                            <select  class="dados" id="slt_categoria">
                                <?php
                                    
								// Variável que recebe o SELECT do banco onde o status = 0 (ativado)
                                $sql = "SELECT * FROM tbl_categoria WHERE status = 0";

								// Variável que executa o SELECT
                                $select  = mysqli_query($conexao, $sql);
                        
								// Loop para pegar cada registro no SELECT e colocar em um array
                                while($rsCategoria = mysqli_fetch_array($select)){
                                    
                                    
                                    $selected = "";
                                    
                                    if($rsCategoria['idCategoria'] == $idCategoria)
                                        $selected = "selected";
                                
                                    ?>
                                <option value="<?= $rsCategoria['idCategoria'] ?>" <?= $selected ?>>
                                    <?= $rsCategoria['categoria'] ?>
                                </option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>

                        <td class="td_esquerda">
                            <label>Subcategoria</label>
                        </td>

                        <td>
                            <select  class="dados" name="slt_subcategoria" id="slt_subcategoria">  
                            </select>
                        </td>
                    </tr>
                    <tr>

                        <td class="td_esquerda">
                            <label>Preço</label>
                        </td>

                        <td>
                            <input maxlength="50" name="txtPreco" id="txtPreco" class="dados" type="text" value="<?= @$preco ?>" required>
                        </td>
                    </tr>
                    <tr>

                        <td class="td_esquerda">
                            <label>Descrição</label>
                        </td>

                        <td>
                            <textarea name="txtDescricao" id="txtDescricao" class="dados" required><?= @$descricao ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div id="area_botao">
                                <input type="submit" name="btnSalvar" value="<?= $botao ?>" class="button">
                                <a href="adm_lista_produtos.php">
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
