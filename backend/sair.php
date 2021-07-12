<?php

    session_start();

    // remove todas variaveis
    session_unset();

    // destroi sessao
    session_destroy();
    header('Location: index.php');
    exit;
    return;
?>