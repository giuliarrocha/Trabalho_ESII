
<?php
    // inicia sessao
    session_start();
    if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == "empresa") {
        header('Location: ../pagina_inicial.php');
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
   <link rel="stylesheet" href="css/style.css" />
   <link rel="stylesheet" href="css/carrinho.css" />
   <title>Carrinho de Compras</title>
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

  <!--Escrita do carrinho de compras-->
  <div class="container" style="margin-top: 70px; margin-left: 100px; margin-right: 100px;">
    <div class="row">
      <div class="col">
        <h2>Produtos</h2>
        <p>Veja os seus produtos favoritos, no seu carrinho e já comprados!</p>
        <ul class="nav nav-tabs nav-fill" style="margin-top: 30px;">
          <li class="nav-item">
            <a class="nav-link" href="aba_favoritos.php">Lista de favoritos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="aba_carrinho_compras.php">Carrinho de compras</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="aba_compras.php">Compras</a>
          </li>
        </ul>
        <?php
            $conexao = mysqli_connect("localhost","root","", "loja") or die("Erro");
            if($conexao) {
                echo mysqli_connect_error();
            }
            // Mostra dados dos produtos
            $cpf = $_SESSION['cpf'];
            $query = "SELECT * FROM produto, empresa, lista_carrinho WHERE cnpj = produto.cnpj_empresa AND cod_listaProduto = cod_produto AND cpf_listacliente = '$cpf'";
            $result = mysqli_query($conexao, $query) or die(mysql_error());
            $total = 0;

            while($row = mysqli_fetch_array($result)){
                echo '<div class="row" >
                <div class="row main align-items-center">
                    <div class="col-1" style="margin: 10px"><img width="500" height="500" class="img-fluid" src="'.$row['imagem'].'"></div>
                    <div class="col">
                        <div class="row text-muted">'.$row['nome_produto'].'</div>
                    </div>


                    <div class="col" style="margin-left: 0px; text-align:center">
                 <a href="backend/add_carrinho.php?cod_produto='.$row['cod_produto'].'&mudarNumero='.($row['qnt_produtoCarrinho']-1).'&submit=1&retornar=aba_carrinho_compras.php"><button type="button" class="btn btn-sm btn-sm btn-outline-dark">
                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                    </svg></button></a>
                <input id="mudarNumero" type="text" readonly maxlength="4" size="4" value="'.$row['qnt_produtoCarrinho'].'" style="border: 0; text-align: center">
                <a href="backend/add_carrinho.php?cod_produto='.$row['cod_produto'].'&mudarNumero='.($row['qnt_produtoCarrinho']+1).'&submit=1&retornar=aba_carrinho_compras.php" class="border"><button type="button" class="btn btn-sm btn-outline-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"></path>
                </svg></button></a> 
              </div>
                    <div style="text-align:right" class="col">R&dollar; '.number_format($row['qnt_produtoCarrinho']*$row['preco_produto'], 2).'
                        <a href="backend/remover_lista_car.php?cod_produto='.$row['cod_listaProduto'].'&retorna=aba_carrinho_compras.php"><svg style="color:red; margin-left:5px; margin-bottom:5px" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                        </svg></a>
                    </div>
                </div>
              </div>';
              $total += $row['qnt_produtoCarrinho']*$row['preco_produto'];
            }
        ?>
      </div>

      <div class="row" style="margin-top: 10px;">
        <div class="d-flex justify-content-start">
            <h4>Total: <?php echo number_format($total, 2); ?></h4>
        </div>
        <div class="col">
          <div class="d-flex justify-content-end">
            <a class="btn btn-outline-secondary btn-lg" href="#">Continuar compra</a>
          </div>
        </div>
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