<!doctype html>
<html lang="en">
<?php

    // inicia sessao
    session_start();
    
    $cod_produto = isset($_GET['cod_produto'])?$_GET['cod_produto']:0;

    $conexao = mysqli_connect("localhost","root","", "loja") or die("Erro");
    if($conexao) {
        echo mysqli_connect_error();
    }
    // Mostra dados do produto selecionado
    $query = "SELECT * FROM produto, empresa WHERE empresa.cnpj = produto.cnpj_empresa AND cod_produto = '$cod_produto'";
    $result = mysqli_query($conexao, $query) or die(mysql_error());
    
    $row = mysqli_fetch_array($result);
        ?>
 <head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css" />
   <title><?php echo $row['nome_produto']; ?></title>
 </head>

 <body>
   <!-- Bootstrap JavaScript -->
   <script src="js/bootstrap.min.js"></script>

   <!-- Barra de navegação-->
  <div class="container-fluid">
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
  
  <div class="container" style="margin-top: 70px; margin-left: 100px; margin-right: 100px;">
    <div class="row">
        <?php

            if($row) {
                echo '<div class="col">
                <h2>'.$row['nome_produto'].'</h2>
                <p class="text-body">'.$row['nome'].'</p>
                <ul class="nav nav-tabs" style="margin-top: 30px;">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Descrição</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pagina_produto_detalhes.html">Detalhes</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pagina_produto_review.html">Reviews</a>
                  </li>
                </ul>
                <p style="margin-top: 50px;">
                  '.$row['descricao_produto'].'
                </p>
                <div class="row" style="margin-top: 50px;">
                  <div class="col">
                    <h2 style="margin-left: 20px;"><strong>R$ '.$row['preco_produto'].'</strong></h2>
                  </div>
                  <div class="col">
            <form action="backend/add_carrinho.php" method="post">
                <div class="col" style="margin-bottom: 10px; text-align:center">
                <a href="#"><button type="button" onclick="decrementar()" class="btn btn-sm btn-sm btn-outline-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                    </svg></button></a>
                        <input id="mudarNumero" name="mudarNumero" type="text" readonly maxlength="4" size="4" value="1" style="border: 0; text-align: center">
                                <a href="#" class="border"><button type="button" onclick="incrementar()" class="btn btn-sm btn-outline-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"></path>
                    </svg></button></a> 
                        </div>
                    <input type="text" value="'.$row['cod_produto'].'" name="cod_produto" class="d-none"><button type="submit" name="submit" class="btn btn-outline-secondary w-75" style="margin-left: 30px;">Adicionar ao carrinho</button></form>
                  </div>
                </div>
                
                <div class="row" style="margin-top: 0px; text-align:right">
                </div>
                
                <script>
                var i = 1;
                function incrementar() {
                    document.getElementById(\'mudarNumero\').value = ++i;
                }
                function decrementar() {
                    if(i > 1)
                        document.getElementById(\'mudarNumero\').value = --i;
                }
                </script>';

            // Não logado
            if(!isset($_SESSION['tipo'])) {
                echo '<a href="login_usuario.php" class="link-secondary" style="margin-left: 20px; text-decoration:none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                            </svg> Adicionar à lista de desejos
                        </a>
                    </div> ';
            } else if ($_SESSION['tipo'] == "cliente") {
                $cpf = $_SESSION['cpf'];
                $query1 = "SELECT * FROM produto, lista_favorito WHERE lista_favorito.cpf_favCliente = '$cpf' AND lista_favorito.cod_favProduto = cod_produto AND cod_produto = '$cod_produto'";
                $result1 = mysqli_query($conexao, $query1) or die(mysql_error());

                // verificar se já está na lista de favoritos
                if($row1 = mysqli_fetch_array($result1)) {
                    // Já add produto à lista de favoritos
                    echo '<a href="backend/remover_lista_fav.php?cod_produto='.$cod_produto.'" class="link-secondary" style="margin-left: 20px; text-decoration:none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" href="#" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                            </svg> Remover da lista de desejos
                        </a>
                    </div> ';
                } else {
                    // Não adicionado aos favoritos ainda
                    echo '
                    <a href="backend/add_lista_fav.php?cod_produto='.$cod_produto.'" class="link-secondary" style="margin-left: 0px; text-decoration:none;text-align:right">
                            <svg style="" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                            </svg> Adicionar à lista de desejos</a>
                    </div>';
                }
                
            }
            // Se for empresa não mostra  
            
            echo '<div class="col">
              <img src="'.$row['imagem'].'" class="justify-content-center" style="margin-left: 40px;" height="400" width="380">
            </div>';
            }

        ?>
               
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