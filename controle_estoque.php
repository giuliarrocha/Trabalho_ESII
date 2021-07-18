<?php
    // inicia sessao
    session_start();
    if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == "cliente") {
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
   <link rel="stylesheet" href="css/style.css" />
   <title>Estoque</title>
  <link rel="shortcut icon" href="images/Design.png" >
 </head>

 <body>
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
                    <li><a class="dropdown-item" href="backend/sair.php">Sair</a></li>
                  </ul>';
                }
              ?>
            </li>
            <!--Botao Carrinho de compras, somente para cliente ou quando ninguém logado -->
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

    <div class="container">

        <div class="row">
            <div class="col-md-6"> <img src="
            <?php
                $conexao = mysqli_connect("localhost","root","", "loja") or die("Erro");
                if($conexao) {
                    echo mysqli_connect_error();
                }

                $cnpj = $_SESSION['cnpj'];
                $query = "SELECT * FROM empresa WHERE cnpj = '$cnpj'";
                $result3 = mysqli_query($conexao, $query) or die(mysql_error());

                if($row3 = mysqli_fetch_array($result3)) {
                    echo $row3['imagem_logo'];
                } else {
                    echo 'images/exemplo_imagem.png';
                }
            ?>
            " alt="" height="270px" weight="270px"> </div>
            <div class="col-md-6" style="margin-top: 60px;">  <h2>Estoque</h2> </div>  
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="container">
                    <div class="list-group">
                        <a href="pagina_inicial.php" class="list-group-item list-group-item-action"> Página Inicial </a>
                        <a href="informacoes_empresa.php" class="list-group-item list-group-item-action">Informações Gerais</a>
                        <a href="controle_estoque.php" class="list-group-item list-group-item-action">Estoque</a>
                        <a href="vendas_empresa.php" class="list-group-item list-group-item-action">Vendas</a>
                        <a href="historico_empresa.php" class="list-group-item list-group-item-action">Histórico de vendas</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table align-middle">
                            <thead>
                              <tr>
                                <th scope="col" style="text-align: center">Código</th>
                                <th scope="col" style="text-align: center">Nome</th>
                                <th scope="col" style="text-align: center">Descrição</th>
                                <th scope="col" style="text-align: center">Imagem</th>
                                <th scope="col" style="text-align: center">Quantidade</th>
                                <th scope="col" style="text-align: center">Preço</th>
                                <th scope="col" style="text-align: center">Promoção</th>
                                <th scope="col" style="text-align: center">Promoção(%)</th>
                                <th scope="col" style="text-align: center">Editar</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                                // prepara conexao
                                $conexao = mysqli_connect("localhost","root","", "loja") or die("Erro");
                                
                                if($conexao) {
                                    echo mysqli_connect_error();
                                }

                                $cnpj = $_SESSION['cnpj'];
                                $query = "SELECT * FROM produto WHERE cnpj_empresa = '$cnpj'";
                                $result = mysqli_query($conexao, $query) or die(mysql_error());
                                
                                while($row = mysqli_fetch_array($result)) {
                                    echo '<tr style="font-size: 11px">
                                            <td style="text-align: center">'.$row['cod_produto'].'</td>
                                            <td style="text-align: center">'.substr($row['nome_produto'], 0,4).'..</td>
                                            <td style="text-align: center">'.substr($row['descricao_produto'], 0,4).'..</td>
                                            <td style="text-align: center">'.substr($row['imagem'], 0,4).'..</td>
                                            <td style="text-align: center">'.$row['qnt_produto'].'</td>
                                            <td >R$ '.number_format($row['preco_produto'], 2).'</td>
                                            <td style="text-align: center">'; if($row['tem_promocao'] == "1") echo 'S'; else echo 'N';
                                            echo '</td>
                                            <td style="text-align: center">'.$row['porc_promocao'].'</td>
                                            <td>
                                                <div class="row">
                                                    <!--Icone para editar-->
                                                    <div class="col-3">
                                                        <a href="estoque_editar.php?cod_produto='.$row['cod_produto'].'">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <!--Icone para diminuir quantidade em 1-->
                                                    <div class="col-3">
                                                        <a href="backend/diminuir_produto.php?cod_produto='.$row['cod_produto'].'">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class="col-3">
                                                        <a href="backend/aumentar_produto.php?cod_produto='.$row['cod_produto'].'">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                      </svg>
                                                        </a>
                                                    </div>
                                                    <!--Icone para remover o produto do BD (excluir todas as quantidades)-->
                                                    <div class="col-3">
                                                        <a href="backend/excluir_produto.php?cod_produto='.$row['cod_produto'].'">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>';
                                }
                                ?>
                            </tbody>
                          </table>
                    </div>
                </div>
                <div class="row" style="margin-left: 220px; margin-top: 20px;">
                    <div class="col">
                        <button type="button" class="btn btn-outline-secondary w-50" >Inserir produto</button>
                    </div>
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