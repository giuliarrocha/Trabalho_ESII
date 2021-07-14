<?php

    // inicia sessao
    session_start();
    if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == "empresa") {
        header('Location: ../pagina_inicial.php');
        exit;
        return;
    }

    // pega dados
    if(isset($_GET['cod_produto'])){
        // prepara conexao
        $conexao = mysqli_connect("localhost","root","", "loja") or die("Erro");
        
        if($conexao) {
            echo mysqli_connect_error();
        }
        
        // valida
        $cod_favProduto = $_GET['cod_produto'];
        $cpf = $_SESSION['cpf'];

        $query = "DELETE FROM lista_favorito WHERE cpf_favCliente = '$cpf' AND cod_favProduto = '$cod_favProduto';";
        $result = mysqli_query($conexao, $query) or die(mysql_error());        
    }
    
    header('Location: ../pagina_produto_descricao.php?cod_produto='.$cod_favProduto.'');
    exit;
    return;
?>