<?php
    // inicia sessao
    session_start();
    if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != "cliente") {
        header('Location: ../pagina_inicial.php');
        exit;
        return;
    }

    // prepara conexao
    $conexao = mysqli_connect("localhost","root","", "loja") or die("Erro");
    
    if($conexao) {
        echo mysqli_connect_error();
    }
    
    // valida
    if(isset($_REQUEST['cod_lista'])) {
        $cpf = $_SESSION['cpf'];
        $cod_lista = $_REQUEST['cod_lista'];

        $query = "UPDATE lista_compra SET produto_compra_status = 'Recebida' WHERE cod_lista = '$cod_lista' AND cpf_listaCompraCliente = '$cpf';";
        mysqli_query($conexao, $query) or die(mysql_error());
        $conexao->close();
    }

    header('Location: ../confirmar_compra.php');
    exit;
    return;
?>