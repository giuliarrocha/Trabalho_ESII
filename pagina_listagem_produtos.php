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
   <title>Pesquisa</title>
  <link rel="shortcut icon" href="images/Design.png" >
 </head>

 <body>
   <!-- Bootstrap JavaScript -->
   <script src="js/bootstrap.min.js"></script>

   <!-- Barra de navegação-->
  <div class="conteiner">
    <nav class="navbar navbar-expand-md navbar-light mt-1">
      <div class="navbar-collapse collapse w-75 ms-4">
        <a class="navbar-brand mb-0" style="color: rgba(9, 43, 64, 1);" href="pagina_inicial.php">
          <img src="images/Design.png" alt="" width="30" height="32" class="d-inline-block align-text-bottom">
          Home
        </a>
          <ul class="navbar-nav me-auto mt-2">
          <li class="nav-item">
              <a class="nav-link" style="color: rgba(9, 43, 64, 1);" href="backend/sair.php?sairUser=1">
              <?php   
                // Checa sessão
                session_start();
                if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == "cliente") echo 'Para empresas';
                else echo 'Para clientes';
              ?>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="color: rgba(9, 43, 64, 1);" href="pagina_listagem_produtos.php?oferta=1">Ofertas</a>
            </li>
          </ul>
      </div>

      <div class="mx-auto" style="width: 1000px;">
        <form class="d-flex mt-2" action="pagina_listagem_produtos.php" method="get">
          <input class="form-control form-control-sm me-0" type="search" placeholder="Pesquisar produtos" name="pesquisar" aria-label="pesquisar">
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
            <?php if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == "empresa")echo '<li class="nav-item dropstart me-md-3">';
            else echo '<li class="nav-item dropdown me-md-3">';
            ?>
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
                    <li><a class="dropdown-item" href="login_usuario.php">Entrar</a></li>
                    <li><a class="dropdown-item" href="login_usuario.php">Cadastrar-se</a></li>
                  </ul>';
                } else if($_SESSION['tipo'] == "empresa") {
                    // Se for área da empresa:
                    echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="informacoes_empresa.php">Informações Gerais</a></li>
                        <li><a class="dropdown-item" href="controle_estoque.php">Estoque</a></li>
                        <li><a class="dropdown-item" href="vendas_empresa.php">Vendas</a></li>
                        <li><a class="dropdown-item" href="historico_empresa.php">Histórico de vendas</a></li>
                        <li><a class="dropdown-item" href="backend/sair.php">Sair</a></li>
                  </ul>';
                } else {
                    // Se estiver logado
                    echo '<ul class="dropdown-menu dropdown-menu-sm-start" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="informacoes_cliente.php">Informações Pessoais</a></li>
                    <li><a class="dropdown-item" href="aba_favoritos.php">Meus favoritos</a></li>
                    <li><a class="dropdown-item" href="aba_carrinho_compras.php">Meu carrinho</a></li>
                    <li><a class="dropdown-item" href="aba_compras.php">Meus pedidos</a></li>
                    <li><a class="dropdown-item" href="confirmar_compra.php">Confirmar compra</a></li>
                    <li><a class="dropdown-item" href="backend/sair.php">Sair</a></li>
                  </ul>';
                }
              ?>
            </li>
            <!--Botao Carrinho de compras-->
            <?php
                if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == "cliente") {
                    echo '<a href="aba_carrinho_compras.php"">
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
                        rgba(242, 193, 174, 1);">
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

  <!--Grid dos produtos-->
    <div class="container" style="margin-top: 40px; margin-left: 150px; margin-right: 150px;">
    <?php
        // Pega número inicial de produtos
        $offset = isset($_GET['offset'])?$_GET['offset']:0;
        $cod_categoria = '';
        $cnpj = '';
        $oferta = '';
        $pesquisar = '';

        // Mostra todos os produtos
        $conexao = mysqli_connect("localhost","root","", "loja") or die("Erro");
        if($conexao) {
            echo mysqli_connect_error();
        }

        // Seleciona tipo de consulta
        if(isset($_GET['oferta']) && $_GET['oferta'] != '') {
            $oferta = $_GET['oferta'];
            $query = "SELECT * FROM produto WHERE tem_promocao = 1 LIMIT $offset,16;";
        } else if(isset($_GET['cod_categoria']) && $_GET['cod_categoria'] != '') {
            $cod_categoria = $_GET['cod_categoria'];
            $query = "SELECT * FROM produto, categoria WHERE cod_catProduto = cod_categoria AND cod_catProduto = '$cod_categoria' LIMIT $offset,16;";
        } else if(isset($_GET['cnpj']) && $_GET['cnpj'] != '') {
            $cnpj = $_GET['cnpj'];
            $query = "SELECT * FROM produto, empresa WHERE cnpj = cnpj_empresa AND cnpj = '$cnpj' LIMIT $offset,16;";
        } else if(isset($_GET['pesquisar']) && $_GET['pesquisar'] != '') {
            $pesquisar = $_GET['pesquisar'];
            $query = "SELECT * FROM produto WHERE nome_produto LIKE '%$pesquisar%' LIMIT $offset,16;";
        } else {
            $query = "SELECT * FROM produto LIMIT $offset,16;";
        }

        $result = mysqli_query($conexao, $query) or die(mysql_error());

        // Grupos de 4 por linha
        $inicio = 1;
        do{
            // Checa se há um item antes de criar linha
            if($row = mysqli_fetch_array($result)) {
                echo '<div class="row"';
                if($inicio){ echo '>'; $inicio = 0; }
                else echo ' style="margin-top: 50px;">';

                $cont = 4;
                do {
                    if($row['qnt_produto'] > 0) {
                        echo '<div class="col">
                        <div class="card" style="width: 9rem;">
                        <a style="text-decoration:none; color: black" href="pagina_produto_descricao.php?cod_produto='.$row['cod_produto'].'">
                            <img src="'.$row['imagem'].'" width="150" height="180" class="card-img-top" alt="...">
                            <ul class="list-group list-group-flush text-center">
                                <li class="list-group-item" style="height: 100px;">
                                    <h6 class="card-title"><strong>'.$row['nome_produto'].'</strong></h6>
                                </li>
                                <li class="list-group-item" style="height: 33px;">';
                                if($row['tem_promocao'] == '1') {
                                    echo '<p style="color: green"><b>R$ '.$row['preco_produto']*((100-$row['porc_promocao'])/100).'</b></p>';
                                } else{
                                    echo '<p>R$ '.$row['preco_produto'].'</p>';
                                }
                                echo '</li>
                            </ul>
                        </a>    
                        </div>
                    </div>';
                        if(!--$cont) break;
                    }
                } while($row = mysqli_fetch_array($result));
                echo '</div>';
            }
        } while($row);
    ?>
        
  </div>

    <div class="container" style="margin-top: 60px;">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">

                
            <?php    
                // Seleciona tipo de consulta
                if(isset($_GET['oferta']) && $_GET['oferta'] != '') {
                    $query = "SELECT COUNT(*) AS qt_produto FROM produto WHERE tem_promocao = 1";
                } else if(isset($_GET['cod_categoria']) && $_GET['cod_categoria'] != '') {
                    $cod_categoria = $_GET['cod_categoria'];
                    $query = "SELECT COUNT(*) AS qt_produto FROM produto, categoria WHERE cod_catProduto = cod_categoria AND cod_catProduto = '$cod_categoria';";
                } else if(isset($_GET['cnpj']) && $_GET['cnpj'] != '') {
                    $cnpj = $_GET['cnpj'];
                    $query = "SELECT COUNT(*) AS qt_produto FROM produto, empresa WHERE cnpj = cnpj_empresa AND cnpj = '$cnpj';";
                } else if(isset($_GET['pesquisar']) && $_GET['pesquisar'] != '') {
                    $pesquisar = $_GET['pesquisar'];
                    $query = "SELECT COUNT(*) AS qt_produto FROM produto WHERE nome_produto LIKE '%$pesquisar%'";
                } else {
                    $query = "SELECT COUNT(*) AS qt_produto FROM produto";
                }
            
                $result = mysqli_query($conexao, $query) or die(mysql_error());
                if($row = mysqli_fetch_array($result)) {
                    $qt_produto = $row['qt_produto'];
                    
                    // Cada página com 16 produtos equivale a um bloco Page
                    $qt_bloco = floor($qt_produto/16);
                    if($qt_produto%16)$qt_bloco++;

                    // Imprimir setinha esquerda
                    $qt_blocoTemp = $qt_bloco;
                    $cont = 1;
                    $href = '';
                    $habilitado = '';
                    if($offset == 0){
                            $verdadeiro = "false";
                            $habilitado = " disabled";
                        }
                        else {
                            $verdadeiro = "true";
                            $href = "pagina_listagem_produtos.php?offset=".$offset-16;
                            $habilitado = "";
                        }
                        echo '
                            <!-- Setinha esquerda -->
                            <li class="page-item'.$habilitado.'">
                            <a class="page-link" href="'.$href.'&cod_categoria='.$cod_categoria.'&cnpj='.$cnpj.'&pesquisar='.$pesquisar.'&oferta='.$oferta.'" aria-disabled="'.$verdadeiro.'" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                            </li>';

                        // Imprimir Pages
                        $qt_blocoTemp = $qt_bloco;
                        $cont = 1;
                        while($qt_blocoTemp--) {
                            $ativo = "";
                            if($offset == ($cont-1)*16) $ativo = " active";
                            echo '<li class="page-item'.$ativo.'"><a class="page-link" href="pagina_listagem_produtos.php?offset='.(($cont-1)*16).'&cod_categoria='.$cod_categoria.'&cnpj='.$cnpj.'&pesquisar='.$pesquisar.'&oferta='.$oferta.'">'.$cont.'</a></li>';
                            $cont++;
                        }
                        
                        
                        // Imprimir setinha direita
                        $qt_blocoTemp = $qt_bloco;
                        $cont = 1;
                        $href = '';
                        $habilitado = '';
                        if($offset+16 < $qt_produto) {
                            $verdadeiro = "true";
                            $href = "pagina_listagem_produtos.php?offset=".($offset + 16);
                        }
                        else {
                            $verdadeiro = "falso";
                            $habilitado = " disabled";
                        }
                        echo '
                            <!-- Setinha direita -->
                            <li class="page-item'.$habilitado.'">
                            <a class="page-link" href="'.$href.'&cod_categoria='.$cod_categoria.'&cnpj='.$cnpj.'&pesquisar='.$pesquisar.'&oferta='.$oferta.'" aria-disabled="'.$verdadeiro.'" aria-label="Previous">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                            </li>';
                    }
                  ?>

            </ul>
          </nav>
    </div>

    <hr class="featurette-divider mt-5">
    <footer class="container">
      <p class="float-end"><a href="#">Back to top</a></p>
      <p>© 2017–2021 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
    </footer>
 </body>
 
</html>