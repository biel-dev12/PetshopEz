<?php
session_start();
include_once('sistema/config/connection.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>EzPets | Cadastre seu Pet Shop</title>
  <!-- Bootstrap5 link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <!-- Link CSS -->
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="shortcut icon" href="./imgs/favicon-cropped.svg" type="image/x-icon">
</head>

<body>
  <div class="content-master">
    <div id="header">
      <!-- Sidebar Menu-->
      <div class="sidebar-content offcanvas offcanvas-end d-flex flex-column flex-shrink-0 p-3" tabindex="-1"
        id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="header-sidebar p-1">
          <button class="btn-close" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
            aria-controls="offcanvasExample"></button>
        </div>
        <ul class="navbar-nav mb-2 mb-lg-0 me-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Como Funciona
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Pagamento</a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Benefícios</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link text" aria-current="page" href="#">Contato</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text" href="#">Sobre Nós</a>
          </li>
          <div class="btns flex-column">
            <button class="btn btn-login link-login" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample">Entrar</button>
            <button class="btn btn-signup link-register" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample">Cadastre-se</button>
          </div>
        </ul>
      </div>
      <nav class="navbar navbar-expand-lg bg-body-tertiary px-3 border-bottom border-2">
        <div class="container-fluid">
          <a class="navbar-brand pt-0" href="#""><img src=" ./imgs/logo-ezpets.svg" alt="logo ezpets"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
            aria-controls="offcanvasExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="navbar-collapse d-lg-block d-none">
            <ul class="navbar-nav mb-2 mb-lg-0 me-auto">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Como Funciona
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Pagamento</a>
                  </li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="#">Benefícios</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link text" aria-current="page" href="#">Contato</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text" href="#">Sobre Nós</a>
              </li>
            </ul>
            <div class="d-flex btns">
              <button class="btn btn-login link-login">Entrar</button>
              <button class="btn btn-signup link-register">Cadastre-se</button>
            </div>
          </div>
        </div>
      </nav>
    </div>

    <div class="row" id="div-main">
      <div class="col-lg-8 d-lg-block d-none bg-pets">
      </div>
      <div class="col-lg-4 form-content">
        <div class="form-signup-login">
          <div class="register">
            <form class="form" method="post" action="#">
              <label aria-hidden="true" class="font-lep">Cadastrar Pet Shop</label>
              <p>Sua vida mais easy!</p>
              <input class="input" type="text" id="namec" name="namec" placeholder="Nome">
              <input class="input" type="email" name="emailc" id="emailc" placeholder="E-mail">
              <input class="input" type="text" id="tel" name="telc" placeholder="Telefone">
              <button class="signup">Cadastrar</button>
              <?php
            if (isset($_POST['namec'], $_POST['emailc'], $_POST['telc'])) {
              if ($_POST['namec'] != "" && $_POST['emailc'] != "" && $_POST['telc'] != "") {
                $namec = $_POST['namec'];
                $emailc = $_POST['emailc'];
                $telc = $_POST['telc'];

                $_SESSION['namec'] = $namec;
                $_SESSION['emailc'] = $emailc;
                $_SESSION['telc'] = $telc;
            ?>
                <script>
                  location.href = "companydata.php";
                </script>
            <?php

              }
            }
            ?>
              <p>Já possui uma conta? <span class="link-login">Clique aqui para entrar!</span></p>
            </form>
          </div>

          <div class="login">
            <form class="form" method="post" action="#">
              <label for="chk" aria-hidden="true" class="font-lep">Entrar</label>
              <p>Sua vida mais easy!</p>
              <input class="input" type="email" name="email1" placeholder="E-mail">
              <input class="input" type="password" name="passw" placeholder="Password">
              <button class="login">Entrar</button>

<?php
                if (isset($_POST['email1'], $_POST['passw'])) {

              $email = $_POST['email1'];
              $passw = $_POST['passw'];

              $sql = $conn->query("SELECT id_petshop, nm_fantasy, nm_ps_email, cd_ps_password
        FROM tb_petshop WHERE nm_ps_email='$email' AND cd_ps_password='$passw'");


              $sql->execute();


              $row = $sql->fetch();
            if ($row > 0) {
                if ($passw == $row['cd_ps_password']) {

                $_SESSION["email01"] = $email;
                $_SESSION["name"] = $row["nm_fantasy"];
            ?>
                <script>
                  location.href = "./dashboard-pages/manager.php";
                </script>
            <?php
            
                 } 
          
            } 
        else {
        // Usuário não encontrado
        echo '<div class="alert alert-danger" role="alert">
        E-mail e/ou senha inválido(s). Por favor, verifique.
      </div>';
        }
                }
?>

              <p>Já possui uma conta? <span class="link-register">Clique aqui para entrar!</span></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap5 script-->

  <script src="./js/signup.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
    integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"
    integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/"
    crossorigin="anonymous"></script>
</body>

</html>