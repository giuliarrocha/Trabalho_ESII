<?php
    // pega dados
    if(isset($_REQUEST['submit'])){
        $nome = isset($_REQUEST['nome'])?$_REQUEST['nome']:"";
        $cpf = isset($_REQUEST['cpf'])?$_REQUEST['cpf']:0;
        $email = isset($_REQUEST['email'])?$_REQUEST['email']:"";
        $senha = isset($_REQUEST['senha'])?$_REQUEST['senha']:"";
    }

    // prepara conexao
    $conexao = mysqli_connect("localhost","root","", "loja") or die("Erro");
    
    if($conexao) {
        echo mysqli_connect_error();
    }

    // valida matricula
    $query = "SELECT * FROM cliente WHERE email = '$email' OR cpf = '$cpf';";
    $result = mysqli_query($conexao, $query) or die(mysql_error());

    if($row = mysqli_fetch_array($result)){
        $conexao->close();
        header('Location: ../login_usuario.html');
        exit;
        return;
    }
    
    $query = "INSERT INTO cliente (nome, cpf, email, senha) VALUES ('$nome', '$cpf', '$email', '$senha');";
    mysqli_query($conexao, $query) or die(mysql_error());

    // inicia sessao
    session_start();
    $_SESSION["tipo"] = "cliente";
    $_SESSION["nome"] = $nome;
    $_SESSION["email"] = $email;
    $_SESSION["cpf"] = $cpf;
    
    
    $conexao->close();
    header('Location: ../pagina_inicial.php');
    exit;
    return;
?>