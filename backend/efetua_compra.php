<?php
    // inicia sessao
    session_start();
    if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == "empresa") {
        header('Location: ../pagina_inicial.php');
        exit;
        return;
    }


    // pega dados
    if(isset($_REQUEST['submit'])){
        $tipoCartao = $_REQUEST['tipoCartao'];
        $numeroCartao = $_REQUEST['numeroCartao'];
        $data = $_REQUEST['ano'].'-'.$_REQUEST['mes'].'-'.$_REQUEST['dia'];
        $cvv = $_REQUEST['cvv'];
        $cpf = $_SESSION['cpf'];
    }
    $total = 0;

    // prepara conexao
    $conexao = mysqli_connect("localhost","root","", "loja") or die("Erro");
    
    if($conexao) {
        echo mysqli_connect_error();
    }

    // valida
    $query = "SELECT * FROM lista_carrinho, produto WHERE cod_produto = cod_listaProduto;";
    $result = mysqli_query($conexao, $query) or die(mysql_error());

    while($row = mysqli_fetch_array($result)) {
        // checar quantidade máxima de produtos
        if($row['qnt_produto'] < $row['qnt_produtoCarrinho']){
            $cod_produto = $row['cod_produto'];
            $novo = $row['qnt_produto'];
            $query1 = "UPDATE lista_carrinho SET qnt_produtoCarrinho = '$novo' WHERE cod_listaProduto = '$cod_produto' AND cpf_listacliente = '$cpf'";
            $result1 = mysqli_query($conexao, $query1) or die(mysql_error());
        }

        // checar promocao
        if($row['tem_promocao'] == '1') {
            $total += $row['qnt_produtoCarrinho'] * ($row['preco_produto']*(100-$row['porc_promocao'])/100);
        } else {
            $total += $row['qnt_produtoCarrinho'] * $row['preco_produto'];
        }
        
        // cálculo do frete
        if($total > 100) {
            $frete = 10;
        } else {
            $frete = 50;
        }
    }

    if(!$total){// sem produto no carrinho
        header('Location: ../pagina_inicial.php');
        exit;
        return;
    }
    
    // Nova compra
    $query = "INSERT INTO compra (fatura, tipo_pag, frete, cpf_compraCliente) VALUES ('$total', '$tipoCartao', '$frete', '$cpf');";
    $result1 = mysqli_query($conexao, $query) or die(mysql_error());

    $query = "SELECT * FROM compra ORDER BY cod_compra DESC";
    $result1 = mysqli_query($conexao, $query) or die(mysql_error());
    $row1 = mysqli_fetch_array($result1);
    
    $cod_compraCartao = $row1['cod_compra'];

    
    $query = "INSERT INTO cartao (num_cartao, validade_cartao, tipo, cvv, cpf_clienteCartao, cod_compraCartao) VALUES ('$numeroCartao', '$data', '$tipoCartao', '$cvv', '$cpf', $cod_compraCartao);";
    mysqli_query($conexao, $query) or die(mysql_error());


    $query = "SELECT * FROM lista_carrinho, produto WHERE cod_listaProduto = cod_produto AND cpf_listacliente = '$cpf'";
    $result = mysqli_query($conexao, $query) or die(mysql_error());
    while($row = mysqli_fetch_array($result)){
        // Pegar do carrinho
        $qnt_compraProduto = $row['qnt_produtoCarrinho'];
        $cod_listaProdutoCompra = $row['cod_listaProduto'];

        
        // checar promocao
        if($row['tem_promocao'] == '1') {
            $preco_un = $row['preco_produto']*(100-$row['porc_promocao'])/100;
        } else {
            $preco_un = $row['preco_produto'];
        }
        

        $query = "INSERT INTO lista_compra (qnt_compraProduto, cod_listaProdutoCompra, cod_listaCompra, cpf_listaCompraCliente, produto_compra_status, preco_unidade) VALUES 
        ('$qnt_compraProduto', '$cod_listaProdutoCompra', '$cod_compraCartao', '$cpf', 'Aguardando confirmação', '$preco_un');";
        mysqli_query($conexao, $query) or die(mysql_error());

    }
    $query = "DELETE FROM lista_carrinho WHERE cpf_listacliente = '$cpf';";
    mysqli_query($conexao, $query) or die(mysql_error());

    $conexao->close();
    header('Location: ../pagina_inicial.php');
    exit;
    return;
?>