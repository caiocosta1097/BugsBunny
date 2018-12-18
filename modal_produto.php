<?php

require_once 'cms/conexao.php';

$conexao = conexaoBD();

$sql = "SELECT * FROM tbl_produto WHERE idProduto = ".$_POST['idRegistro'];

$select = mysqli_query($conexao, $sql);

if ($rsProduto = mysqli_fetch_array($select)) {
	
	$produto = $rsProduto['produto'];
	$foto = $rsProduto['foto'];
	$preco = $rsProduto['preco'];
	$descricao = $rsProduto['descricao'];

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

	#preco{

		width: 100%;
		text-align: center;
		font-family: font-caviarDreams;
		font-size: 35px;
		margin-top: 30px;

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
		<div id="fechar_modal"><a href="index.php">x</a></div>
	</div>
	<div id="produto"><?= $produto ?></div>
	<div id="foto">
		<img src="cms/<?= $foto ?>">        	
	</div>
	<div id="preco">
		R$ <?= number_format($preco, 2, ',', '.') ?>
	</div>
	<div id="descricao">
		<?= $descricao ?>
	</div>
</body>
</html>