<?php

    session_start();
    if(isset($_GET['sairUser']) && $_GET['sairUser']) {
        if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == "empresa") {
            // remove todas variaveis
            session_unset();
            // destroi sessao
            session_destroy();
            header('Location: ../login_usuario.php');
            exit;
            return;
        } else if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] == "cliente") {
            
            // remove todas variaveis
            session_unset();
            // destroi sessao
            session_destroy();

            header('Location: ../login_empresa.php');
            exit;
            return;
        }
    }
    // remove todas variaveis
    session_unset();

    // destroi sessao
    session_destroy();
    header('Location: ../pagina_inicial.php');
    exit;
    return;
?>