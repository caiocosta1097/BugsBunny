<?php

    if(isset($_POST)){
        
        // Pega todas as características do arquivo
        $arquivo = $_FILES['fileFoto']['name'];
        
        // Pega o tamanho do arquivo
        $tamanho_arquivo = $_FILES['fileFoto']['size'];
        
        // Tranforma de bytes para Kbytes e arredonda o resultado do cálculo trazendo um número inteiro
        $tamanho_arquivo = round($tamanho_arquivo / 1024);
        
        // Pegando a extensão do arquivo 
        // $extensao_arquivo = pathinfo($arquivo,   PATHINFO_EXTENSION);
        $extensao_arquivo = strrchr($arquivo, ".");
        
        // Pega o nome do arquivo sem a extensão
        $nome_arquivo = pathinfo($arquivo, PATHINFO_FILENAME);
        
        // Criptografa o nome do arquivo para garantir que não exista
        // dois arquivos com o mesmo nome
        
        // md5() - Realiza a criptografia de uma string
        
        // uniqid() - Gera um número individual e aleatório baseado em um dado
        
        // time() - Pega a hora, minuto e segundo do servidor
        $nome_arquivo = md5(uniqid(time()).$nome_arquivo);
        
        // Guarda o diretório que será feito o upload do arquivo
        $diretório_arquivo = "arquivos/";
        
        // Vetor de dados contendo todas as extensões válidas para o upload de arquivo
        $arquivos_permitidos = array(".jpg", ".png", ".jpeg");
        
        // Verifica se a extensão do arquivo é permitida dentro do vetor de extensões válidas
        if(in_array($extensao_arquivo, $arquivos_permitidos)){
            
            if($tamanho_arquivo <= 5000){
                
                $arquivo_tmp = $_FILES['fileFoto']['tmp_name'];
                $foto = $diretório_arquivo . $nome_arquivo . $extensao_arquivo;
                
                if(move_uploaded_file($arquivo_tmp, $foto)){
                    
                    // Retorna para a div a imagem exibida
                    echo "<img src='".$foto."'>";
                    
                    
                    echo 
                        "<script>
                            frm_formulario_noticias.txtFoto.value = '".$foto."';
                        </script>";
                    
                    
                } else {
                    
                    echo "Falha no envio!";    
                    
                }
                
            } else {
                
                echo "Tamanho de arquivo inválido!";
                
            }
            
        } else{
            
            echo "Extensão inválida!";
            
        }
        
    }

?>