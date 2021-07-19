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
    if(isset($_REQUEST['submit'])) {
        $cod_lista = $_REQUEST['cod_lista'];
        //$cod_compra = $_REQUEST['cod_compra'];
        $cod_produto = $_REQUEST['cod_produto'];
        $cpf = $_SESSION['cpf'];

        $comentario = $_REQUEST['comentario'];
        $avaliacao = $_REQUEST['rating'];
        echo $comentario.'</br>';
        echo $avaliacao.'</br>';
        echo $cod_lista.'</br>';
        echo $cod_produto.'</br>';
        $query = "UPDATE lista_compra SET produto_compra_status = 'Avaliada', comentario = '$comentario', produto_compra_avaliacao = '$avaliacao' WHERE cod_lista = '$cod_lista'";
        mysqli_query($conexao, $query) or die(mysql_error());
        
        // alterar avaliação do produto e da empresa ~~~~~~~~~~~~~~~~~~~~
        $cont = 0;
        $soma = 0;
        // pegar todas as compras do produto
        $query = "SELECT * FROM produto, lista_compra WHERE cod_listaProdutoCompra = cod_produto AND produto_compra_status = 'Avaliada' AND cod_produto = '$cod_produto'";
        $result2 = mysqli_query($conexao, $query) or die(mysql_error());
        
        while($row2 = mysqli_fetch_array($result2)) {
            $cont++;
            $soma += $row2['produto_compra_avaliacao'];
        }
        $media = (float)$soma/$cont;
        $query = "UPDATE produto SET avaliacao = '$media' WHERE cod_produto = '$cod_produto';";
        mysqli_query($conexao, $query) or die(mysql_error());


        $cont = 0;
        $soma = 0;
        // pegar todas as avaliacoes de todos os produtos da empresa
        $query = "SELECT * FROM produto, lista_compra, empresa WHERE cod_listaProdutoCompra = cod_produto AND produto_compra_status = 'Avaliada' AND cnpj_empresa = cnpj AND cnpj IN (SELECT cnpj FROM produto, empresa WHERE cnpj_empresa = cnpj AND cod_produto = '$cod_produto')";
        $result2 = mysqli_query($conexao, $query) or die(mysql_error());
        while($row2 = mysqli_fetch_array($result2)) {
            $cont++;
            $soma += $row2['produto_compra_avaliacao'];
            $cnpj = $row2['cnpj'];
            echo  ' soma: '.$soma.'</br>';
        }
        $media = (float)$soma/$cont;
        echo  ' media: '.$media.'</br>';
        $query = "UPDATE empresa SET avaliacao = '$media' WHERE cnpj = '$cnpj';";
        mysqli_query($conexao, $query) or die(mysql_error());

        $conexao->close();
    }

    header('Location: ../pagina_produto_fazer_review.php?cod_produto='.$cod_produto);
    exit;
    return;
?>