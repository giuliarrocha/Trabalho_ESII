<?php
    // inicia sessao
    session_start();
    if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == "empresa") {
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
        $cod_listaProduto = $_REQUEST['cod_produto'];
        $qnt_produtoCarrinho = $_REQUEST['mudarNumero'];
        $cpf = $_SESSION['cpf'];

        $query = "SELECT * FROM lista_carrinho WHERE cpf_listacliente = '$cpf' AND cod_listaProduto = '$cod_listaProduto';";
        $result = mysqli_query($conexao, $query) or die(mysql_error());
        $row = mysqli_fetch_array($result);
        if(!$row){
            $query = "INSERT INTO lista_carrinho (cod_listaProduto, cpf_listacliente, qnt_produtoCarrinho) VALUES ('$cod_listaProduto', '$cpf', '$qnt_produtoCarrinho');";
            echo $qnt_produtoCarrinho;
        } else {
            if($qnt_produtoCarrinho > 0 ){
                $query = "UPDATE lista_carrinho SET qnt_produtoCarrinho = '$qnt_produtoCarrinho' WHERE cpf_listacliente = '$cpf' AND cod_listaProduto = '$cod_listaProduto'";
            }
            
        }
        
        $result = mysqli_query($conexao, $query) or die(mysql_error());
        $conexao->close();
    }
    if(isset($_REQUEST['retornar'])) {
        header('Location: ../'.$_REQUEST['retornar']);
        exit;
        return;
    }
    //header('Location: ../pagina_produto_descricao.php?cod_produto='.$cod_listaProduto);
    header('Location: ../aba_carrinho_compras.php');
    exit;
    return;
?>