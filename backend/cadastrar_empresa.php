<?php
    // pega dados
    if(isset($_REQUEST['submit'])){
        $cpf = isset($_REQUEST['cnpj'])?$_REQUEST['cnpj']:0;
        $email = isset($_REQUEST['email'])?$_REQUEST['email']:"";
        $senha = isset($_REQUEST['senha'])?$_REQUEST['senha']:"";
    }

    // prepara conexao
    $conexao = mysqli_connect("localhost","root","", "loja") or die("Erro");
    
    if($conexao) {
        echo mysqli_connect_error();
    }

    // valida matricula
    $query = "SELECT * FROM empresa WHERE email = '$email' OR cnpj = '$cnpj';";
    $result = mysqli_query($conexao, $query) or die(mysql_error());

    if($row = mysqli_fetch_array($result)){
        $conexao->close();
        header('Location: ../login_empresa.html');
        exit;
        return;
    }
    
    $query = "INSERT INTO empresa (cnpj, email, senha) VALUES ('$cnpj', '$email', '$senha');";
    mysqli_query($conexao, $query) or die(mysql_error());

    // inicia sessao
    session_start();
    $_SESSION["tipo"] = "empresa";
    $_SESSION["cnpj"] = $cnpj;
    $_SESSION["email"] = $email;
    
    $conexao->close();
    header('Location: ../pagina_inicial.php');
    exit;
    return;
?>