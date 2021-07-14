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

        if($promocao == "0") {
            $porcentagPromo = "0";
        }

        $query = "INSERT INTO produto (cnpj_empresa, cod_catProduto, nome_produto, descricao_produto, imagem, preco_produto, qnt_produto, tem_promocao, porc_promocao) 
                            VALUES ('$cnpj', '$categoria', '$nomeProduto', '$TextareaDescricaoProduto', '$LinkImagem', '$precoProduto', '$qntProduto', '$promocao', '$porcentagPromo');";
        mysqli_query($conexao, $query) or die(mysql_error());
        $conexao->close();
    }

    header('Location: ../estoque.php');
    exit;
    return;
?>