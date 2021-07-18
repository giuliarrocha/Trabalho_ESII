<?php
    // inicia sessao
    session_start();
    if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == "cliente") {
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
    if(isset($_REQUEST['submit'])) {
        $cod_lista = $_REQUEST['cod_lista'];
        $cod_rastreamento = $_REQUEST['cod_rastreamento'];

        
        $query = "UPDATE lista_compra SET cod_rastreamento = '$cod_rastreamento', produto_compra_status = 'Em trânsito' WHERE cod_lista = '$cod_lista';";
        mysqli_query($conexao, $query) or die(mysql_error());
        

        $conexao->close();
    }

    header('Location: ../vendas_empresa.php');
    exit;
    return;
?>