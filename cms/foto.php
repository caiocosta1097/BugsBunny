<?php

    // Importando o arquivo de conexão
    require_once('conexao.php');

    $conexao = conexaoBD();

    if(isset($_POST['idProduto'])){
        
        $id = $_POST['idProduto'];
        
        $sql = "SELECT foto FROM tbl_produto WHERE idProduto =".$id;
        
        $select = mysqli_query($conexao, $sql);
        
        if($rsFoto = mysqli_fetch_array($select))
            echo "<img src='".$rsFoto['foto']."'>";
        
    }

?>