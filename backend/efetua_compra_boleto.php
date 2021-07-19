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
        
        $data = date("Y-m-d");
        $d = strtotime("+3 days");
        $validade_compra = date("Y-m-d", $d);
        $boleto_status = "Aguardando pagamento";
        $cpf = $_SESSION['cpf'];
    }
    $total = 0;

    // prepara conexao
    $conexao = mysqli_connect("localhost","root","", "loja") or die("Erro");
    
    if($conexao) {
        echo mysqli_connect_error();
    }

    // valida
    $query = "SELECT * FROM lista_carrinho, produto WHERE cod_produto = cod_listaProduto AND cpf_listacliente = '$cpf'";
    $result = mysqli_query($conexao, $query) or die(mysql_error());
    while($row = mysqli_fetch_array($result)) {
        echo $row['qnt_produto'];
        if($row['qnt_produto'] != 0) {
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
        } else {
            // deleta produto com quantidade 0 do carrinho
            $cod_produto = $row['cod_produto'];
            $query10 = "DELETE FROM lista_carrinho WHERE cod_listaProduto = '$cod_produto' AND cpf_listacliente = '$cpf'";
            $result10 = mysqli_query($conexao, $query10) or die(mysql_error());
        }
    }

    // cálculo do frete
    if($total > 100) {
        $frete = 10;
    } else {
        $frete = 50;
    }

    if(!$total){// sem produto no carrinho
        header('Location: ../pagina_inicial.php');
        exit;
        return;
    }
    
    // Nova compra
    $query = "INSERT INTO compra (fatura, tipo_pag, frete, cpf_compraCliente) VALUES ('$total', 'Boleto', '$frete', '$cpf');";
    $result1 = mysqli_query($conexao, $query) or die(mysql_error());

    $query = "SELECT * FROM compra ORDER BY cod_compra DESC";
    $result1 = mysqli_query($conexao, $query) or die(mysql_error());
    $row1 = mysqli_fetch_array($result1);
    
    $cod_compra = $row1['cod_compra'];

    
    $query = "INSERT INTO boleto (validade_compra, boleto_status, cpf_clienteBoleto, cod_compraBoleto) VALUES ('$validade_compra', 'Em aberto', '$cpf', '$cod_compra');";
    mysqli_query($conexao, $query) or die(mysql_error());


    $query = "SELECT * FROM lista_carrinho, produto WHERE cod_listaProduto = cod_produto AND cpf_listacliente = '$cpf'";
    $result = mysqli_query($conexao, $query) or die(mysql_error());
    while($row = mysqli_fetch_array($result)){
        // Pegar do carrinho
        $qnt_compraProduto = $row['qnt_produtoCarrinho'];
        $cod_produto = $row['cod_listaProduto'];

        
        // checar promocao
        if($row['tem_promocao'] == '1') {
            $preco_un = $row['preco_produto']*(100-$row['porc_promocao'])/100;
        } else {
            $preco_un = $row['preco_produto'];
        }
        

        $query = "INSERT INTO lista_compra (qnt_compraProduto, cod_listaProdutoCompra, cod_listaCompra, cpf_listaCompraCliente, produto_compra_status, preco_unidade) VALUES 
        ('$qnt_compraProduto', '$cod_produto', '$cod_compra', '$cpf', 'Aguardando pagamento', '$preco_un');";
        mysqli_query($conexao, $query) or die(mysql_error());

        // atualiza estoque restante do produto
        $query = "SELECT * FROM produto WHERE cod_produto = '$cod_produto'";
        $result2 = mysqli_query($conexao, $query) or die(mysql_error());
        
        if($row2 = mysqli_fetch_array($result2)) {
            $nova_qt_produto = (int)$row['qnt_produto'] - (int)$qnt_compraProduto;
            $query = "UPDATE produto SET qnt_produto = '$nova_qt_produto' WHERE cod_produto = '$cod_produto'";
            mysqli_query($conexao, $query) or die(mysql_error());
        }
    }
    $query = "DELETE FROM lista_carrinho WHERE cpf_listacliente = '$cpf';";
    mysqli_query($conexao, $query) or die(mysql_error());

    echo "io";
    // ------------------------- redireciona para o boleto -------------------------
    
    $query = "SELECT * FROM boleto ORDER BY cod_pagBoleto DESC";
    $result1 = mysqli_query($conexao, $query) or die(mysql_error());
    $row1 = mysqli_fetch_array($result1);
    $cod_boleto = $row1['cod_pagBoleto'];

    $cpf = $_SESSION['cpf'];
    $query = "SELECT * FROM cliente WHERE cpf = '$cpf'";
    $result1 = mysqli_query($conexao, $query) or die(mysql_error());
    $row1 = mysqli_fetch_array($result1);
    $final = $row1['nome'];
    
$final = str_replace("Â", "a", $final);
$final = str_replace("â", "a", $final);
$final = str_replace("é", 'e', $final);
$final = str_replace('É', 'e', $final);
$final = str_replace('ã', 'a', $final);
$final = str_replace("ó", "o", $final);
$final = str_replace("Ó", "o", $final);
$final = str_replace("á", 'a', $final);
$final = str_replace('ç“', 'c', $final);
$final = str_replace('Ç', 'c', $final);
    $txtnome = $final;

    $data_atual = date("d/m/Y");
    $validade_compra = date("d/m/Y", strtotime("+3 days"));
    $total = number_format($total,2);
    echo '<script type="text/javascript">
    
    </script>
    ';
    
    $conexao->close();
    
        
    if (isset($_REQUEST['boleto']) && $_REQUEST['boleto'] == "mandar") {
        header('Location: ../pagina_inicial.php');
        exit;
        return;
    }
    
    header('Location: http://www.sicadi.com.br/mhouse/boleto/boleto3.php?numero_banco=341-7&local_pagamento=PAG%C1VEL+EM+QUALQUER+BANCO+AT%C9+O+VENCIMENTO&cedente='.$txtnome.'&data_documento='.$data_atual.'&numero_documento=DF+'.$cod_boleto.'&especie=&aceite=N&data_processamento='.$data_atual.'&uso_banco=&carteira=179&especie_moeda=Real&quantidade=&valor='.$total.'&vencimento='.$validade_compra.'&agencia=0049&codigo_cedente=10201-5&meunumero=00010435&valor_documento='.$total.'&instrucoes=Taxa+de+visita+de+suporte%0D%0AAp%F3s+o+vencimento+R%24+0%2C80+ao+dia&mensagem1=&mensagem2=&mensagem3=ATEN%C7%C3O%3A+N%C3O+RECEBER+AP%D3S+15+DIAS+DO+VENCIMENTO&sacado=&Submit=Enviar');
    exit;
    return;
?>