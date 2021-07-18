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
   <title>Vendas em andamento</title>
 </head>

 <body>
   <!-- Bootstrap JavaScript -->
   <script src="js/bootstrap.min.js"></script>

   <!-- Barra de navegação-->
  <div class="conteiner-fluid">
    <nav class="navbar navbar-expand-md navbar-light mt-1">
      <div class="navbar-collapse collapse w-75 ms-4">
        <a class="navbar-brand mb-0" style="color: rgba(9, 43, 64, 1);" href="pagina_inicial.html">
          <img src="images/Design.png" alt="" width="30" height="32" class="d-inline-block align-text-bottom">
          Home
        </a>
          <ul class="navbar-nav me-auto mt-2">
            <li class="nav-item">
              <a class="nav-link" style="color: rgba(9, 43, 64, 1);" href="#">Para empresas</a>
            </li>

          </ul>
      </div>

      <div class="mx-auto" style="width: 1000px;">

      </div>

      <div class="navbar-collapse collapse w-100" style="margin-right: 90px;">
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

          </ul>
      </div>
    </nav>

    <div class="container">

        <div class="row">
            <div class="col-md-6"> <img src="images/exemplo_imagem.png" alt=""> </div>
            <div class="col-md-6" style="margin-top: 60px;">  <h2>Vendas em andamento</h2> </div>  
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="container">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">Página Inicial</a>
                        <a href="#" class="list-group-item list-group-item-action">Informações Gerais</a>
                        <a href="#" class="list-group-item list-group-item-action">Estoque</a>
                        <a href="#" class="list-group-item list-group-item-action">Vendas</a>
                        <a href="#" class="list-group-item list-group-item-action">Histórico de vendas</a>
                    </div>
                </div>
            </div>
            <div class="col" style="margin-left: 20px">
                
                    <?php
                    $conexao = mysqli_connect("localhost","root","", "loja") or die("Erro");
                    if($conexao) {
                        echo mysqli_connect_error();
                    }
                    
                    $cnpj = $_SESSION['cnpj'];
                    $query = "SELECT COUNT(*) AS soma FROM lista_compra WHERE produto_compra_status = 'Aguardando confirmação' AND cod_listaProdutoCompra IN (SELECT cod_produto FROM produto WHERE cnpj_empresa = '$cnpj')";
                    $result = mysqli_query($conexao, $query) or die(mysql_error());
                    $row = mysqli_fetch_array($result);

                    echo '<h5>'.$row['soma'].' Pedidos aguardando confirmação</h5>';
                    
                    $query = "SELECT * FROM lista_compra, compra, cliente, produto WHERE cod_listaCompra = cod_compra AND cod_listaProdutoCompra = cod_produto AND cpf_listaCompraCliente = cpf AND produto_compra_status = 'Aguardando confirmação' AND cod_listaProdutoCompra IN (SELECT cod_produto FROM produto WHERE cnpj_empresa = '$cnpj')";
                    $result = mysqli_query($conexao, $query) or die(mysql_error());
                    
                    while($row = mysqli_fetch_array($result)) {
                        echo '<div class="row">';
                                echo '<hr>
                                <div class="col">
                                    <div class="card border-danger mb-3" style="max-width: 25rem;">
                                        <div class="card-header">Compra: '.$row['cod_listaCompra'].'</div>
                                        <div class="card-body text">
                                        <p class="card-text"><strong>Endereço:</strong> '.$row['endereco'].'</p>
                                        <p class="card-text"><strong>Produto:</strong> '.$row['nome_produto'].'</p>
                                        <p class="card-text"><strong>Quantidade:</strong> '.$row['qnt_compraProduto'].'</p>
                                        <p class="card-text"><strong>Valor total:</strong> R$ '.number_format($row['qnt_compraProduto']*$row['preco_unidade'], 2).'</p>
                                        <p class="card-text"><strong>Data:</strong> '.date('d/m/Y', strtotime($row['data'])).'</p>
                                        <div class="row g-3 align-items-center">
                                            <div class="col-auto">
                                            <label for="inputCodRastreio" class="col-form-label">Código Rastreio: </label>
                                            <form action="backend/add_rastreio.php" method="post">
                                                <div class="col-auto">
                                                <input type="text" name="cod_rastreamento" placeholder="Digite o código" class="form-control d-none d-lg-block" aria-describedby="passwordHelpInline" required>
                                                <input type="text" name="cod_lista" value="'.$row['cod_lista'].'" class="d-none">
                                                </div>
                                                <div class="col-auto" style="margin-top:10px">
                                                    <button type="submit" name="submit" class="btn btn-outline-secondary">Confirmar</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>';
                        echo '</div>';
                    }
                    ?>
                
            </div>
        </div>
            
        <div class="row" style="margin-top: 50px;">
            <h5>Vendas:</h5>
            <div class="table-responsive"  style="margin-top: 20px;">
                <table class="table table-striped table align-middle">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align:center">Codigo</th>
                            <th scope="col" style="text-align:center">Data</th>
                            <th scope="col" style="text-align:center">CPFcomprador</th>
                            <th scope="col" style="text-align:center">CodRastreamento</th>
                            <th scope="col" style="text-align:center">Frete</th>
                            <th scope="col" style="text-align:center">EndEnvio</th>
                            <th scope="col" style="text-align:center">CodProduto</th>
                            <th scope="col" style="text-align:center">QntProduto</th>
                            <th scope="col" style="text-align:center">ValorTotal</th>
                            <th scope="col" style="text-align:center">Avaliação</th>
                            <th scope="col" style="text-align:center">Situação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM lista_compra, compra, cliente, produto WHERE cod_listaCompra = cod_compra AND cod_listaProdutoCompra = cod_produto AND cpf_listaCompraCliente = cpf AND produto_compra_status != 'Aguardando confirmação' AND cod_listaProdutoCompra IN (SELECT cod_produto FROM produto WHERE cnpj_empresa = '$cnpj')";
                        $result = mysqli_query($conexao, $query) or die(mysql_error());
                        
                        while($row = mysqli_fetch_array($result)) {
                            echo '<tr>
                                <td style="text-align:center">'.$row['cod_compra'].'</td>
                                <td style="text-align:center">'.date('d/m/Y', strtotime($row['data'])).'</td>
                                <td style="text-align:center">'.$row['cpf'].'</td>
                                <td style="text-align:center">'.$row['cod_rastreamento'].'</td>
                                <td style="text-align:center">'.$row['frete'].'</td>
                                <td style="text-align:center">'.$row['endereco'].'</td>
                                <td style="text-align:center">'.$row['cod_produto'].'</td>
                                <td style="text-align:center">'.$row['qnt_compraProduto'].'</td>
                                <td style="text-align:center">R$ '.number_format($row['qnt_compraProduto']*$row['preco_unidade'], 2).'</td>
                                <td style="text-align:center">'.$row['avaliacao'].'</td>
                                <td style="text-align:center">'.$row['produto_compra_status'].'</td>
                            </tr>';
                        }

                        ?>
                    </tbody>
                </table>
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