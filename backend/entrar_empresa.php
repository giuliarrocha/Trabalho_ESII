<?php
    // pega dados
    if(isset($_REQUEST['submit'])){
        $email = isset($_REQUEST['email'])?$_REQUEST['email']:"";
        $senha = isset($_REQUEST['senha'])?$_REQUEST['senha']:"";

        // prepara conexao
        $conexao = mysqli_connect("localhost","root","", "loja") or die("Erro");
        
        if($conexao) {
            echo mysqli_connect_error();
        }

        // ve se existe
        $query = "SELECT * FROM empresa WHERE email = '$email' AND senha = '$senha'";
        $result = mysqli_query($conexao, $query) or die(mysql_error());
        if($row = mysqli_fetch_array($result)) {
            // inicia sessao
            session_start();
            $_SESSION["tipo"] = "empresa";
            $_SESSION["cnpj"] = $row['cnpj'];
            $_SESSION["email"] = $email;

            $conexao->close();
            header('Location: ../pagina_inicial.php');
            exit;
        }

        
    }

    header('Location: ../login_empresa.php');
    exit;
    return;
?>