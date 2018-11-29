<?php 

    require_once('conexao.php');

    $conexao = conexaoBD();

	if(isset($_GET['idCategoria'])){
        
        $id = $_GET['idCategoria'];
        
        $sql = "SELECT * FROM tbl_subcategoria WHERE idCategoria =" . $id;
        
        $select  = mysqli_query($conexao, $sql);
        
        while ($rsSubcategoria = mysqli_fetch_array($select) ) {
            $subCategorias[] = array(
                'idSubcategoria'	=> $rsSubcategoria['idSubcategoria'],
                'subcategoria' => $rsSubcategoria['subcategoria'],
            );
	   }
	
	echo(json_encode($subCategorias));
        
    }
