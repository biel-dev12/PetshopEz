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
  <!-- Link CSS -->
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="shortcut icon" href="./imgs/favicon-cropped.svg" type="image/x-icon">
</head>

<body>
  <div class="main-content">
    <!-- Header -->
    <header id="header">
      <!-- Nav -->
      <nav id="nav-header">
        <a href="" class="link-logo"><img src="./imgs/logo-ezpets.svg" alt="Logo EzPets" class="logo" /></a>
        <!-- Menu Hamburguer -->
        <div class="menu-hamb">
          <div class="line1"></div>
          <div class="line2"></div>
          <div class="line3"></div>
        </div>
        <ul id="nav-list">
          <li class="li-drop">
            <span>Como Funciona<img src="./imgs/caret-right.svg" class="arrow right" alt="arrow-icon"></img></span>
            <!-- Dropdown-->
            <div class="dropdown">
              <div class="item">
                <p class="item-title bi bi-cash-stack">Pagamento</p>
                <p class="item-text">
                  Como é realizado o pagamento da EzPets para minha loja?
                </p>
              </div>
              <hr />
              <div class="item">
                <p class="item-title bi bi-stars">Benefícios</p>
                <p class="item-text">
                  Descubra os benefícios de ser um parceiro.
                </p>
              </div>
            </div>
          </li>
          <li><a href="" class="li-option">Ajuda</a></li>
          <li><a href="" class="li-option">Sobre Nós</a></li>
          <!-- Buttons (Log In and Sign Up) -->
          <ul id="ul-btns">
            <li><button class="btn-login">Entrar</button></li>
            <li><button class="btn-signup">Cadastre-se</button></li>
          </ul>
        </ul>
      </nav>
    </header>
    <!--Form-->
    <main id="main-section">
      <div class="bg-pets"></div>
      <div class="form-signup-login card-container show-card">
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

                $_SESSION["email01"] = $email;
                $_SESSION["name"] = $row["nm_fantasy"];
            ?>
                <script>
                  location.href = "./dashboard-pages/manager.php";
                </script>
            <?php

              }
            }

            ?>

            <p>Já possui uma conta? <span class="link-signup">Clique aqui para entrar!</span></p>
          </form>
        </div>
      </div>
    </main>
  </div>
  <script src="./js/signup.js" type="module"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
  <script src="./js/callMaskInputs.js"></script>
</body>

</html>