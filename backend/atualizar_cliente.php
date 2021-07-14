<?php

    // inicia sessao
    session_start();
    if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == "empresa") {
        header('Location: ../pagina_inicial.php');
        exit;
        return;
    }
    $cpf = $_SESSION['cpf'];
    // pega dados
    if(isset($_REQUEST['submit'])){
        $nome = $_REQUEST['nome'];
        $endereco = $_REQUEST['endereco'];
        $senha = $_REQUEST['senha'];
        $telefone_contato = $_REQUEST['telefone'];
    }

    // prepara conexao
    $conexao = mysqli_connect("localhost","root","", "loja") or die("Erro");
    
    if($conexao) {
        echo mysqli_connect_error();
    }

    $query = "UPDATE cliente SET nome='$nome', senha='$senha', endereco='$endereco', telefone='$telefone_contato' WHERE cpf = '$cpf'";
    mysqli_query($conexao, $query) or die(mysql_error());


    $conexao->close();
    header('Location: ../informacoes_cliente.php');
    exit;
    return;
?>