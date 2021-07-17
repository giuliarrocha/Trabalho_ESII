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
        $nomeProduto = $_REQUEST['nomeProduto'];
        $TextareaDescricaoProduto = $_REQUEST['TextareaDescricaoProduto'];
        $LinkImagem = $_REQUEST['LinkImagem'];
        $qntProduto = $_REQUEST['qntProduto'];
        $precoProduto = $_REQUEST['precoProduto'];
        $promocao = $_REQUEST['promocao'];
        $porcentagPromo = $_REQUEST['porcentagPromo'];
        $cnpj = $_SESSION['cnpj'];
        $categoria = $_REQUEST['categoria'];
        $cod_produto = $_REQUEST['cod_produto'];

        if($promocao == "0") {
            $porcentagPromo = "0";
        }

        $query = "UPDATE produto SET cod_catProduto = '$categoria', nome_produto = '$nomeProduto', 
        descricao_produto = '$TextareaDescricaoProduto', imagem = '$LinkImagem', preco_produto = '$precoProduto', 
        qnt_produto = '$qntProduto', tem_promocao = '$promocao', porc_promocao = '$porcentagPromo' WHERE cod_produto = '$cod_produto';";
        mysqli_query($conexao, $query) or die(mysql_error());
        $conexao->close();
    }

    header('Location: ../controle_estoque.php');
    exit;
    return;
?>