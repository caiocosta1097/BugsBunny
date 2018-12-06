<?php

    function itens_menu($idNivel){
        
        $bloqueioConteudo = null;
        $bloqueioFaleConosco = null;
        $bloqueioProduto = null;
        $bloqueioUsuario = null;

        if($idNivel == 21){

            $bloqueioConteudo = "";
            $bloqueioFaleConosco = "";
            $bloqueioProduto = "style= 'filter: grayscale(100%); pointer-events: none;'";
            $bloqueioUsuario = "style= 'filter: grayscale(100%); pointer-events: none;'";

        }else if ($idNivel == 22){

            $bloqueioConteudo = "style= filter: grayscale(100%); pointer-events: none;";
            $bloqueioFaleConosco = "style= filter: grayscale(100%); pointer-events: none;";
            $bloqueioProduto = "";
            $bloqueioUsuario = "style= filter: grayscale(100%); pointer-events: none;";

        } else{

            $bloqueioConteudo = "";
            $bloqueioFaleConosco = "";
            $bloqueioProduto = "";
            $bloqueioUsuario = "";

        }
        
        echo '<div class="itens_menu">
                <a href="adm_conteudo.php">
                    <img class="imagens_menu" src="imagens/adm_conteudo.png" '.$bloqueioConteudo.' >
                </a>
                <div class="titulo_menu">Adm. Conteúdo</div>
            </div>
            <div class="itens_menu">
                <a href="adm_fale_conosco.php">
                    <img class="imagens_menu" src="imagens/adm_fale_conosco.png" '.$bloqueioFaleConosco.' >
                </a>    
                <div class="titulo_menu">Adm. Fale Conosco</div>
            </div>
            <div class="itens_menu">
                <a href="adm_produtos.php">
                    <img class="imagens_menu" src="imagens/adm_produtos.png" '.$bloqueioProduto.' >
                </a>
               <div class="titulo_menu">Adm. Produtos</div>
            </div>
            <div class="itens_menu">
                <a href="adm_users.php">
                    <img class="imagens_menu" src="imagens/adm_usuarios.png" '.$bloqueioUsuario.' >
                </a>
               <div class="titulo_menu">Adm. Usuários</div>
            </div>';
        
    }

?>