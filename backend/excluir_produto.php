<?php
    // inicia sessao
    session_start();
    if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == "cliente") {
        header('Location: ../pagina_inicial.php');
        exit;
        return;
    }

    // prepara conexao
    $conexao = mysqli_connect("localhost","root","", "loja") or die("Erro");
    
    if($conexao) {
        echo mysqli_connect_error();
    }
    
    // valida
    if(isset($_REQUEST['cod_produto'])) {
        $cod_produto = $_REQUEST['cod_produto'];


        $query = "DELETE FROM produto WHERE cod_produto = '$cod_produto';";
        mysqli_query($conexao, $query) or die(mysql_error());

        $conexao->close();
    }

    header('Location: ../controle_estoque.php');
    exit;
    return;
?>