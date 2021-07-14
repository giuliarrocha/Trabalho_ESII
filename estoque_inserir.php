<?php
    // inicia sessao
    session_start();
    if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] == "cliente") {
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
   <title>Inserir Estoque</title>
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
            <div class="col-md-6" style="margin-top: 60px;">  <h2>Inserir novo produto</h2> </div>  
        </div>
    
        <div class="row">
            <div class="col-md-3">
                <div class="container">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action"> Página Inicial </a>
                        <a href="#" class="list-group-item list-group-item-action">Informações Gerais</a>
                        <a href="#" class="list-group-item list-group-item-action">Estoque</a>
                        <a href="#" class="list-group-item list-group-item-action">Vendas</a>
                        <a href="#" class="list-group-item list-group-item-action">Histórico de vendas</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <h3>Dados do produto</h3>
                </div>
                <form action="backend/add_produto.php" method="post">
                <div class="row">
                    <!-- Código do produto insere automaticamente -->
                    <div class="form-group"> 
                        <label for="nomeProduto"> </label> <input type="text" name="nomeProduto" placeholder="Nome do produto" required class="form-control ">
                    </div>
                    <div class="form-group" style="margin-top:25px"> 
                        <?php
                            // prepara conexao
                            $conexao = mysqli_connect("localhost","root","", "loja") or die("Erro");
                            
                            if($conexao) {
                                echo mysqli_connect_error();
                            }
                            
                            $query = "SELECT * FROM categoria";
                            $result = mysqli_query($conexao, $query) or die(mysql_error());
                            echo '<select name="categoria" class="form-select form-select" aria-label=".form-select">';
                            echo '<option value="1">Selecione a categoria</option>';
                            while($row = mysqli_fetch_array($result)) {
                                echo '<option value="'.$row['cod_categoria'].'">'.$row['nome_categoria'].'</option>';
                            }
                            echo '</select>';
                        
                        ?>
                        </div>
                    <div class="form-text" style="margin-top: 25px;">
                        <textarea class="form-control" placeholder="Descrição" id="TextareaDescricaoProduto" name="TextareaDescricaoProduto" rows="3"></textarea>
                    </div>
                    <div class="form-group"> 
                        <label for="linkImagem"> </label> <input type="text" name="LinkImagem" placeholder="Link da imagem" required class="form-control ">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group"> 
                            <label for="qntProduto"> </label> <input type="text" name="qntProduto" placeholder="Quantidade" required class="form-control ">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group"> 
                            <label for="precoProduto"> </label> <input type="text" name="precoProduto" placeholder="Preço unidade" required class="form-control ">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 25px;">
                    <div class="col">
                        <label for="exampleFormControlCheckPromo" class="form-label">Promoção:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="promocao" value="1" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                              Sim
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="promocao" value="0" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                              Não
                            </label>
                          </div>
                    </div>
                    <div class="col">
                        <div class="form-group"> 
                            <label for="porcentagPromo"> </label> <input type="text" name="porcentagPromo" placeholder="Porcentagem de desconto" required class="form-control ">
                        </div>
                    </div>
                </div>
                
                <div class="row" style="margin-top: 40px;">
                    <button type="submit" name="submit" class="btn btn-outline-secondary">Inserir produto</button>
                </div>
            </form>
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