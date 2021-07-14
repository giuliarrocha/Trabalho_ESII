<?php

    // inicia sessao
    session_start();
    if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == "cliente") {
        header('Location: ../pagina_inicial.php');
        exit;
        return;
    }
    $cnpj = $_SESSION['cnpj'];
    // pega dados
    if(isset($_REQUEST['submit'])){
        $cnpj = $_REQUEST['cnpj'];
        $nome = $_REQUEST['nome'];
        $imagem_logo = $_REQUEST['imagem'];
        $endereco = $_REQUEST['endereco'];
        $senha = $_REQUEST['senha'];
        $telefone_contato = $_REQUEST['telefone'];
    }

    // prepara conexao
    $conexao = mysqli_connect("localhost","root","", "loja") or die("Erro");
    
    if($conexao) {
        echo mysqli_connect_error();
    }

    $query = "UPDATE empresa SET imagem_logo='$imagem_logo',nome='$nome',senha='$senha',endereco='$endereco',telefone_contato='$telefone_contato' WHERE cnpj = '$cnpj'";
    mysqli_query($conexao, $query) or die(mysql_error());


    $conexao->close();
    header('Location: ../informacoes_empresa.php');
    exit;
    return;
?>