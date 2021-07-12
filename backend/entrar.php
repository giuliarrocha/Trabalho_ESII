<?php
    // pega dados
    if(isset($_REQUEST['submit'])){
        $email = isset($_REQUEST['email'])?$_REQUEST['email']:"";
        $senha = isset($_REQUEST['senha'])?$_REQUEST['senha']:"";

        // prepara conexao
        $conexao = mysqli_connect("localhost","root","", "ensino_remoto") or die("Erro");
        
        if($conexao) {
            echo mysqli_connect_error();
        }

        // ve se e aluno
        $query = "SELECT * FROM aluno WHERE email = '$email' AND senha = '$senha'";
        $result = mysqli_query($conexao, $query) or die(mysql_error());
        if($row = mysqli_fetch_array($result)) {
            // inicia sessao
            session_start();
            $_SESSION["user"] = "aluno";
            $_SESSION["matricula"] = $row['matricula_aluno'];
            $_SESSION["nome"] = $row['nome'];
            $_SESSION["email"] = $row['email'];
            $_SESSION["cpf"] = $row['cpf'];
            $conexao->close();
            header('Location: todas-disciplinas.php');
            exit;
        }

        // ve se e professor
        $query = "SELECT * FROM professor WHERE email = '$email' AND senha = '$senha'";
        $result = mysqli_query($conexao, $query) or die(mysql_error());
        if($row = mysqli_fetch_array($result)) {
            // inicia sessao
            session_start();
            $_SESSION["user"] = "professor";
            $_SESSION["matricula"] = $row['matricula_prof'];
            $_SESSION["nome"] = $row['nome'];
            $_SESSION["email"] = $row['email'];
            $_SESSION["cpf"] = $row['cpf'];
            $conexao->close();
            header('Location: todas-disciplinas.php');
            exit;
        }
        
    }

    header('Location: index.php');
    exit;
?>