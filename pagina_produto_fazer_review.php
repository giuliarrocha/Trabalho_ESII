<!doctype html>
<html lang="en">
<?php

    // inicia sessao
    session_start();
    $cpf = $_SESSION['cpf'];
    $cod_produto = isset($_GET['cod_produto'])?$_GET['cod_produto']:0;

    $conexao = mysqli_connect("localhost","root","", "loja") or die("Erro");
    if($conexao) {
        echo mysqli_connect_error();
    }
    // Mostra dados do produto selecionado
    $query = "SELECT * FROM produto, empresa WHERE empresa.cnpj = produto.cnpj_empresa AND cod_produto = '$cod_produto'";
    $result = mysqli_query($conexao, $query) or die(mysql_error());
    $row = mysqli_fetch_array($result);
    
    // Mostra opção de rating caso tenha feito compra
    $query = "SELECT * FROM produto, lista_compra WHERE (produto_compra_status = 'Finalizada' OR produto_compra_status = 'Recebida') AND cod_listaProdutoCompra = cod_produto AND cod_produto = '$cod_produto' AND cpf_listaCompraCliente = '$cpf'";
    $result2 = mysqli_query($conexao, $query) or die(mysql_error());
    $row2 = mysqli_fetch_array($result2);

    if(!$row2) {
        header('Location: pagina_produto_descricao.php?cod_produto='.$cod_produto);
        exit;
        return;
    }

    ?>
 <head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css" />
   <title><?php echo $row['nome_produto']; ?></title>
  <link rel="shortcut icon" href="images/Design.png" >
 </head>

 <body>
 
<style>
.rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center
}

.rating>input {
    display: none
}

.rating>label {
    position: relative;
    width: 1em;
    font-size: 3vw;
    color: #FFD600;
    cursor: pointer
}

.rating>label::before {
    content: "\2605";
    position: absolute;
    opacity: 0
}

.rating>label:hover:before,
.rating>label:hover~label:before {
    opacity: 1 !important
}

.rating>input:checked~label:before {
    opacity: 1
}

.rating:hover>input:checked~label:before {
    opacity: 1
}
</style>


   <!-- Bootstrap JavaScript -->
   <script src="js/bootstrap.min.js"></script>

   <!-- Barra de navegação-->
  <div class="container-fluid">
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
                    $query7 = "SELECT COUNT(*) AS soma FROM lista_carrinho, cliente WHERE cpf_listacliente = cpf AND cpf = '$cpf' GROUP BY cpf";
                    $result7 = mysqli_query($conexao, $query7) or die(mysql_error());
                    
                    if($row7 = mysqli_fetch_array($result7)) {
                        echo '
                    rgba(242, 193, 174, 1);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-cart" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        '.$row7['soma'].'
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
  
  <div class="container" style="margin-top: 70px; margin-left: 100px; margin-right: 100px;">
    <div class="row">
        <?php
            if($row) {
                echo '<div class="col">
                <h2>'.$row['nome_produto'].'</h2>
                <p class="text-body">'.$row['nome'].'</p>
                <ul class="nav nav-tabs" style="margin-top: 30px;">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="pagina_produto_descricao.php?cod_produto='.$row['cod_produto'].'">Descrição</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="pagina_produto_fazer_review.php?cod_produto='.$row['cod_produto'].'">Fazer review</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pagina_produto_review.php?cod_produto='.$row['cod_produto'].'">Últimos reviews</a>
                </li>
                </ul>';
            }
            ?>
            <p style="margin-top: 50px;">
              Diga-nos o que achou da compra <?php echo $row2['cod_listaCompra']; ?>!
            </p>
            <form action="backend/add_review.php" method="post">
                <input type="text" class="form-control" name="comentario" placeholder="Deixe seu comentário" required maxlength="38">
                <input type="text" class="form-control d-none" name="cod_lista" value="<?php echo $row2['cod_lista']; ?>">
                <input type="text" class="form-control d-none" name="cod_compra" value="<?php echo $row2['cod_listaCompra']; ?>">
                <input type="text" class="form-control d-none" name="cod_produto" value="<?php echo $row2['cod_listaProdutoCompra']; ?>">
                <div class="rating">
                <input type="radio" name="rating" value="5" checked id="5"><label for="5">☆</label>
                <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                </div>
            <button type="submit" name="submit" class="btn btn-outline-secondary espaco30 w-100" style="margin-bottom: 0px;">Enviar</button>
            </form>
            <div class="row" style="margin-top: 60px;">
            </div>
        </div> 
        <div class="col">
          <img src="<?php echo $row2['imagem']; ?>" class="justify-content-center" style="margin-left: 40px;" height="400" width="380">
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