<?php

    // inicia sessao
    session_start();
    if (isset($_SESSION['tipo'])) {
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
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Text&display=swap" rel="stylesheet">
   <title>Entrar</title>
 </head>

 <body>
   <!-- Bootstrap JavaScript -->
   <script src="js/bootstrap.min.js"></script>

   <!-- Barra de navegação-->
  <div class="conteiner">
    <nav class="navbar navbar-expand-md navbar-light mt-1">
      <div class="navbar-collapse collapse w-75 ms-4">
        <a class="navbar-brand mb-0" style="color: rgba(9, 43, 64, 1);" href="pagina_inicial.html">
          <img src="images/Design.png" alt="" width="30" height="32" class="d-inline-block align-text-bottom">
          Home
        </a>
          <ul class="navbar-nav me-auto mt-2">
            <li class="nav-item">
              <a class="nav-link" style="color: rgba(9, 43, 64, 1);" href="login_usuario.php">Para clientes</a>
            </li>
          </ul>
      </div>

      <div class="navbar-collapse collapse w-75">
          <!--Botao Conta-->
          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropstart me-md">
              <a class="nav-link dropdown-toggle justify-content-start" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="black" class="bi bi-person-fill " viewBox="0 0 16 16">
                  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                </svg>
              </a>
              <!--Se não estiver logado:-->
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Entrar</a></li>
                <li><a class="dropdown-item" href="#">Cadastrar-se</a></li>
              </ul>
              <!--Se for área da empresa e estiver logado:
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Informações Gerais</a></li>
                <li><a class="dropdown-item" href="#">Estoque</a></li>
                <li><a class="dropdown-item" href="#">Vendas</a></li>
                <li><a class="dropdown-item" href="#">Carteira</a></li>
                <li><a class="dropdown-item" href="#">Segurança</a></li>
                <li><a class="dropdown-item" href="#">Feedbacks</a></li>
              </ul>
              -->
              <!--Se o usuário estiver logado:
              <ul class="dropdown-menu dropdown-menu-sm-start" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Informações Pessoais</a></li>
                <li><a class="dropdown-item" href="#">Meus pedidos</a></li>
                <li><a class="dropdown-item" href="#">Segurança</a></li>
                <li><a class="dropdown-item" href="#">Pagamento</a></li>
              </ul>
              -->
            </li>
          </ul>
      </div>
    </nav>
  </div>

    <div style="margin-top: 20px;" class="p-6">
        <div style="margin-left:70px; margin-right:70px; margin-top: 30px;" class="d-flex flex-row justify-content-around">
            <div class="p-5 w-100">
                <div class="container">
                    <div class="container letraTitulo">
                        Entrar
                    </div>
                    <p style="margin-top: 15px; padding-bottom: 40px;" class="cinza centro">Sua empresa já está cadastrada? Faça login na sua conta!</p>

                    <form action="backend/entrar_empresa.php" method="post">
                        <div class="entrar row">
                          <label for="staticEmail" class="col-sm-2 col-form-label d-none d-lg-block">E-mail:</label>
                          <div class="col-sm-10">
                            <input style="margin-left: 5px;" type="text" class="form-control" name="email" id="email" placeholder="E-mail" required>
                          </div>
                        </div>
                        <div class="espaco30 entrar row">
                          <label for="inputPassword" class="col-sm-2 col-form-label d-none d-lg-block">Senha:</label>
                          <div class="col-sm-10">
                            <input style="margin-left: 5px;" type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required>
                          </div>
                        </div>
                        <div class="d-flex justify-content-center">
                        <button type="submit" name="submit" class="btn btn-outline-secondary espaco30 w-100" style="margin-left: 30px;">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>

            
            <div class="p-1 w-5 bordaDireita"></div>
            <div class="p-5 w-100"><div class="container letraTitulo">Criar uma conta</div>
                <p style="margin-top: 15px; padding-bottom: 40px;" class="cinza centro">A empresa ainda não é cadastrada? Crie uma conta!</p>

                <form action="backend/cadastrar_empresa.php" method="post">
                    <div class="espaco15 cadastrar row">
                      <label for="staticEmail" class="col-sm-2 col-form-label d-none d-lg-block">CNPJ:</label>
                      <div class="col-sm-10">
                        <input style="margin-left: 5px;" type="text" class="form-control" id="cnpj" name="cnpj" placeholder="CNPJ" required>
                      </div>
                    </div>
                    <div class="espaco30 cadastrar row">
                      <label for="staticEmail" class="col-sm-2 col-form-label d-none d-lg-block">E-mail:</label>
                      <div class="col-sm-10">
                        <input style="margin-left: 5px;" type="text" class="form-control" id="email" name="email" placeholder="E-mail" required>
                      </div>
                    </div>
                    <div class="espaco30 cadastrar row">
                      <label for="inputPassword" class="col-sm-2 col-form-label d-none d-lg-block">Senha:</label>
                      <div class="col-sm-10">
                        <input style="margin-left: 5px;" type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                      </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="submit" class="espaco30 w-100 btn btn-outline-secondary ">Cadastrar</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
  </div>
  <hr class="featurette-divider mt-5">
    <footer class="container">
      <p class="float-end"><a href="#">Back to top</a></p>
      <p>© 2017–2021 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
    </footer>
</body>
 
</html>
