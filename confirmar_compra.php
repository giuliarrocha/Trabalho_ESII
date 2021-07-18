<?php
    // inicia sessao
    session_start();
    if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != "cliente") {
        header('Location: pagina_inicial.php');
        exit;
        return;
    }
?>
<!doctype html>
<html lang="en">

<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<style>
    .tamanho{
        width: 7em;
    }

    .centraliza td{
        vertical-align: middle;
        justify-content: center;
    }
</style>
<link rel="stylesheet" href="css/carrinho.css" />
<title>Confirmar compra</title>
</head>

<body>
<!-- Bootstrap JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Barra de navegação-->
<div class="conteiner">
<nav class="navbar navbar-expand-md navbar-light mt-1">
  <div class="navbar-collapse collapse w-75 ms-4">
    <a class="navbar-brand mb-0" style="color: rgba(9, 43, 64, 1);" href="#">
      <img src="images/Design.png" alt="" width="30" height="32" class="d-inline-block align-text-bottom">
      Home
    </a>
      <ul class="navbar-nav me-auto mt-2">
        <li class="nav-item">
          <a class="nav-link" style="color: rgba(9, 43, 64, 1);" href="#">Para empresas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style="color: rgba(9, 43, 64, 1);" href="#">Ofertas</a>
        </li>
      </ul>
  </div>

  <div class="mx-auto" style="width: 1000px;">
    <form class="d-flex mt-2">
      <input class="form-control form-control-sm me-0" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline btn-sm" type="submit">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
        </svg>
      </button>
    </form>
  </div>

  <div class="navbar-collapse collapse w-100">
      <!--Botao Conta-->
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown me-md-3">
          <a class="nav-link dropdown-toggle justify-content-start" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="black" class="bi bi-person-fill " viewBox="0 0 16 16">
              <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            </svg>
          </a>
          <!--Se não estiver logado:-->
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="login_usuario.html">Entrar</a></li>
            <li><a class="dropdown-item" href="login_usuario.html">Cadastrar-se</a></li>
          </ul>
          
          <!--Se for área da empresa:
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Informações Gerais</a></li>
            <li><a class="dropdown-item" href="#">Estoque</a></li>
            <li><a class="dropdown-item" href="#">Vendas</a></li>
            <li><a class="dropdown-item" href="#">Carteira</a></li>
            <li><a class="dropdown-item" href="#">Segurança</a></li>
            <li><a class="dropdown-item" href="#">Feedbacks</a></li>
          </ul>
          -->
          <!--Se estiver logado
          <ul class="dropdown-menu dropdown-menu-sm-start" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Informações Pessoais</a></li>
            <li><a class="dropdown-item" href="#">Meus pedidos</a></li>
            <li><a class="dropdown-item" href="#">Segurança</a></li>
            <li><a class="dropdown-item" href="#">Pagamento</a></li>
          </ul>
          -->
        </li>
        <!--Botao Carrinho de compras-->
        <a href="carrinho_compras.html">
          <button type="button" class="btn btn-outline-secondary position-relative rounded-circle mx-4 me-md-5" style="background-color: rgba(242, 193, 174, 1);">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-cart" viewBox="0 0 16 16">
              <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              2
              <span class="visually-hidden">unread messages</span>
            </span>
          </button>
        </a>
      </ul>
  </div>
</nav>
</div>

<!--Escrita do confirmar compra-->
<div class="container" style="margin-top: 70px; margin-left: 100px; margin-right: 100px;">
    <div class="row">
        <div class="col"> <h3>Confirmar compra(s)</h3> </div>
        <div class="row" style="margin-top: 15px;">
            <table class="table centraliza">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">PRODUTO</th>
                    <th scope="col">Nome do produto</th>
                    <th scope="col">Preço</th>
                    <th scope="col" style="text-align: center">Quantidade</th>   
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    $conexao = mysqli_connect("localhost","root","", "loja") or die("Erro");
                    if($conexao) {
                        echo mysqli_connect_error();
                    }
                    $cpf = $_SESSION['cpf'];
                    $query = "SELECT * FROM lista_compra, produto WHERE cod_listaProdutoCompra =  cod_produto AND produto_compra_status = 'Finalizada' AND cpf_listaCompraCliente = '$cpf'";
                    $result = mysqli_query($conexao, $query) or die(mysql_error());
                    while($row = mysqli_fetch_array($result)) {
                        echo '<tr>
                          <th scope="row"><img src="'.$row['imagem'].'" class="tamanho"></th>
                          <td> '.$row['nome_produto'].' </td>
                          <td>R$ '.number_format($row['preco_unidade'],2).' </td>
                          <td style="text-align: center"> '.$row['qnt_compraProduto'].'</td>
                          <td> <a href="backend/confirmar_compra.php?cod_lista='.$row['cod_lista'].'"><button type="button" class="btn btn-outline-secondary">Confirmar compra</button></a> </td>
                        </tr>';
                    }
                    ?>
                </tbody>
              </table>
        </div>
    </div>
</div>



<!--Rodapé-->
<hr class="featurette-divider mt-5">
<footer class="container">
 <p class="float-end"><a href="#">Back to top</a></p>
 <p>© 2017–2021 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
</footer>
</body>

</html>