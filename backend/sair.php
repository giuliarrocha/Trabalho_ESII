<?php

    session_start();

    // remove todas variaveis
    session_unset();

    // destroi sessao
    session_destroy();
    header('Location: ../pagina_inicial.php');
    exit;
    return;
?>