<?php
    // pega dados
    if(isset($_REQUEST['submit'])){
        $matricula = isset($_REQUEST['matricula'])?$_REQUEST['matricula']:0;
        $nome = isset($_REQUEST['nome'])?$_REQUEST['nome']:"";
        $cpf = isset($_REQUEST['cpf'])?$_REQUEST['cpf']:0;
        $email = isset($_REQUEST['email'])?$_REQUEST['email']:"";
        $senha = isset($_REQUEST['senha'])?$_REQUEST['senha']:"";
    }
    // prepara conexao
    $conexao = mysqli_connect("localhost","root","", "ensino_remoto") or die("Erro");
    
    if($conexao) {
        echo mysqli_connect_error();
    }

    // valida matricula
    $query = "SELECT * FROM aluno WHERE matricula_aluno = '$matricula' OR email = '$email';";
    $result = mysqli_query($conexao, $query) or die(mysql_error());

    if($row = mysqli_fetch_array($result)){
        $conexao->close();
        header('Location: index.php');
        exit;
        return;
    }
    
    $query = "INSERT INTO aluno (matricula_aluno, nome, cpf, email, senha) VALUES ('$matricula', '$nome', '$cpf', '$email', '$senha');";
    $result = mysqli_query($conexao, $query) or die(mysql_error());

    // inicia sessao
    session_start();
    $_SESSION["user"] = "aluno";
    $_SESSION["matricula"] = $matricula;
    $_SESSION["nome"] = $nome;
    $_SESSION["email"] = $email;
    $_SESSION["cpf"] = $cpf;
    
    $conexao->close();
    header('Location: todas-disciplinas.php');
    exit;
    return;
?>