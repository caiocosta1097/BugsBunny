<?php

require_once 'cms/conexao.php';

$conexao = conexaoBD();

$sql = "SELECT promocao.*, produto.* 
FROM tbl_promocoes AS promocao, tbl_produto AS produto 
WHERE promocao.idProduto = produto.idProduto 
AND idPromocao =".$_POST['idRegistro'];

$select = mysqli_query($conexao, $sql);

if ($rsPromocao = mysqli_fetch_array($select)) {
	
	$produto = $rsPromocao['produto'];
	$foto = $rsPromocao['foto'];
	$preco = $rsPromocao['preco'];
	$desconto = $rsPromocao['desconto'];
	$descricao = $rsPromocao['descricao'];

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Modal Produto</title>
	<meta charset="utf-8">
	<style>

	@font-face{

		font-family: font-caviarDreams;
		src: url('fonts/CaviarDreams_Bold.ttf');

	}

	@font-face{

		font-family: font-kenyan-negrito;
		src: url('fonts/kenyan_coffee_bd.ttf');

	}

	#header{

		height: 50px;
		width: 100%;

	}

	#fechar_modal{

		margin-top: 15px;
		text-align: center;
		font-family: arial;
		font-size: 50px;
		color: #aaaaaa;
		font-weight: bold;
		transition: 0.5s;
		float: right;
		text-decoration: none;
		padding-right: 30px;

	}


	#fechar_modal:hover{


		color: #000;
		transition: 0.5s;

	}

	#produto{

		width: 100%;
		text-align: center;
		font-family: font-kenyan-negrito;
		font-size: 50px;

	}

	#preco, #preco_desconto{

		width: 100%;
		text-align: center;
		font-family: font-caviarDreams;
		font-size: 35px;
		margin-top: 30px;

	}

	#preco{

		font-size: 25px;
		text-decoration: line-through;

	}

	#descricao{

		width: 90%;
		margin-left: auto;
		margin-right: auto;
		text-align: justify;
		font-family: font-caviarDreams;
		font-size: 30px;
		margin-top: 30px;

	}

	#foto{

		width: 300px;
		height: 300px;
		border-radius: 15px;
		margin-left: auto;
		margin-right: auto;
		margin-top: 50px;

	}

	#foto img{

		width: 300px;
		height: 300px;

	}

</style>
</head>
<body>
	<div id="header">
		<div id="fechar_modal"><a href="promocoes.php">x</a></div>
	</div>
	<div id="produto"><?= $produto ?></div>
	<div id="foto">
		<img src="cms/<?= $foto ?>">        	
	</div>
	<div id="preco">
		R$ <?= number_format($preco, 2, ',', '.') ?>
	</div>
	<div id="preco_desconto">
		R$ <?= number_format($preco - ($preco * $desconto / 100), 2, ',', '.') ?>
	</div>
	<div id="descricao">
		<?= $descricao ?>
	</div>
</body>
</html>