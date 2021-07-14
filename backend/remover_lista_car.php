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
        $cod_listaProduto = $_GET['cod_produto'];
        $cpf = $_SESSION['cpf'];

        $query = "DELETE FROM lista_carrinho WHERE cpf_listacliente = '$cpf' AND cod_listaProduto = '$cod_listaProduto';";
        $result = mysqli_query($conexao, $query) or die(mysql_error());
    }
    
    header('Location: ../aba_carrinho_compras.php');
    exit;
    return;
?>