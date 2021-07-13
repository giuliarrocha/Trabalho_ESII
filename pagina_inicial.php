<!doctype html>
<html lang="en">

 <head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css" />
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Text&display=swap" rel="stylesheet">
   <title>Site</title>
 </head>

 <body>
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
              <a class="nav-link" style="color: rgba(9, 43, 64, 1);" href="#">
              <?php   
                // Checa sessão
                session_start();
                if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == "cliente") echo 'Para empresas';
                else echo 'Para clientes';
              ?>
              </a>
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
              <?php
                // Checa sessão
                if (!isset($_SESSION['tipo'])) {
                    // Se não estiver logado:
                    echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="login_usuario.html">Entrar</a></li>
                    <li><a class="dropdown-item" href="login_usuario.html">Cadastrar-se</a></li>
                  </ul>';
                } else if($_SESSION['tipo'] == "empresa") {
                    // Se for área da empresa:
                    echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Informações Gerais</a></li>
                    <li><a class="dropdown-item" href="#">Estoque</a></li>
                    <li><a class="dropdown-item" href="#">Vendas</a></li>
                    <li><a class="dropdown-item" href="#">Carteira</a></li>
                    <li><a class="dropdown-item" href="#">Segurança</a></li>
                    <li><a class="dropdown-item" href="#">Feedbacks</a></li>
                  </ul>';
                } else {
                    // Se estiver logado
                    echo '<ul class="dropdown-menu dropdown-menu-sm-start" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Informações Pessoais</a></li>
                    <li><a class="dropdown-item" href="#">Meus pedidos</a></li>
                    <li><a class="dropdown-item" href="#">Segurança</a></li>
                    <li><a class="dropdown-item" href="#">Pagamento</a></li>
                  </ul>';
                }
              ?>
            </li>
            <!--Botao Carrinho de compras, somente para cliente ou quando ninguém logado -->
            <?php
                if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == "cliente") {
                    echo '<a href="carrinho_compras.php">
                    <button type="button" class="btn btn-outline-secondary position-relative rounded-circle mx-4 me-md-5" style="background-color:';
                    
                    $conexao = mysqli_connect("localhost","root","", "loja") or die("Erro");
                    if($conexao) {
                        echo mysqli_connect_error();
                    }
                    // Mostra todas as categorias
                    $cpf = isset($_SESSION['cpf'])?$_SESSION['cpf']:"";
                    $query = "SELECT COUNT(*) AS soma FROM lista_carrinho, cliente WHERE cpf_listacliente = cpf AND cpf = '$cpf' GROUP BY cpf";
                    $result = mysqli_query($conexao, $query) or die(mysql_error());
                    
                    if($row = mysqli_fetch_array($result)) {
                        echo '
                    rgba(242, 193, 174, 1);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-cart" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        '.$row['soma'].'
                        <span class="visually-hidden">unread messages</span>
                        </span>
                    </button>
                    </a>';
                    } else {
                        echo '
                    rgba(300, 300, 300, 300);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-cart" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        0
                        <span class="visually-hidden">unread messages</span>
                        </span>
                    </button>
                    </a>';
                    }
                    
                }
            ?>
          </ul>
      </div>
    </nav>
  </div>
    

    <!--Grid para foto, categorias e empresas mais bem avaliadas-->
    <div class="container-fluid">

      <!--Linha1: Carousel das imagens-->
      <div class="row mt-3">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="images/buynow.jpg"alt="" width="" height="300" class="d-block w-100">
            </div>
            <div class="carousel-item">
              <img src="images/img_roupas.jpg"alt="" width="" height="300" class="d-block w-100">
            </div>
            <div class="carousel-item">
              <img src="images/bookshelf.jpg"alt="" width="" height="300" class="d-block w-100">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      
    <div class="container">
      <!--Linha 2: Texto "Categorias"-->
      <div class="row mt-5">
        <h4>CATEGORIAS</h4>
      </div>

      <!--Linha 3: Primeira linha de botões"-->
      <!--Linha 4: Segunda linha de botões"-->
      <?php
        $conexao = mysqli_connect("localhost","root","", "loja") or die("Erro");
        if($conexao) {
            echo mysqli_connect_error();
        }
        // Mostra todas as categorias
        $query = "SELECT * FROM categoria";
        $result = mysqli_query($conexao, $query) or die(mysql_error());
        
        // Cada linha
        do{
            // Checa se há um item antes de criar um novo carrossel
            if($row = mysqli_fetch_array($result)) {
                echo '<div class="row mt-2 justify-content-center">';
                $cont = 6;
                do {
                    echo '<div class="col">
                    <button type="button" class="btn btn-outline-secondary w-100">'.$row['nome_categoria'].'</button>
                    </div>';
                    if(!--$cont) break;
                } while($row = mysqli_fetch_array($result));
                echo '</div>';
            }
        } while($row);
        
        $conexao->close();
      ?>


    <div class="container">
      <!--Linha 5: Texto "EMPRESAS MAIS BEM AVALIADAS"-->
      <div class="row mt-5" style="margin-bottom: 15px">
        <h4>EMPRESAS MAIS BEM AVALIADAS</h4>
      </div>

      <!--Linha 6: Fileira com empresas"-->

      <div class="row justify-content-center">
        <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
          <div class="carousel-inner">
                <?php
                    $conexao = mysqli_connect("localhost","root","", "loja") or die("Erro");
                    if($conexao) {
                        echo mysqli_connect_error();
                    }
                    // Mostra todas as empresas bem-avaliadas
                    $query = "SELECT * FROM empresa WHERE avaliacao >= 4.5 ORDER BY avaliacao";
                    $result = mysqli_query($conexao, $query) or die(mysql_error());
                    
                    // Grupos de 6 por slide
                    $inicio = 1;
                    do{
                        // Checa se há um item antes de criar um novo carrossel
                        if($row = mysqli_fetch_array($result)) {
                            echo '<div class="carousel-item';
                            if($inicio){ echo ' active"><div class="row">'; $inicio = 0; }
                            else echo '"><div class="row justify-content-start">';

                            $cont = 6;
                            do {
                                echo '<div class="col">
                                <div class="card" style="width: 8rem;">
                                    <img src="'.$row['imagem_logo'].'" width="120" height="120" class="card-img-top" alt="...">
                                    <div class="card-body">
                                    <h6>'.$row['nome'].'</h6>
                                    </div>
                                </div>
                                </div>';
                                if(!--$cont) break;
                            } while($row = mysqli_fetch_array($result));
                            echo '</div></div>';
                        }
                    } while($row);

                    $conexao->close();
                ?>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
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