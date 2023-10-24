
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Dashboard E-commerce</title>

  <!-- Bootstrap5 link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="shortcut icon" href="../imgs/favicon-cropped.svg" type="image/x-icon" />
  <link rel="stylesheet" href="../css/dash-style.css" />
</head>

<body>
    
    <?php

  if (!isset($_SESSION['email01'])) {
  ?>

    <script>
      location.href = "../signup.php";
    </script>
  <?php

  }

  ?>
    
  <!-- Sidebar Menu-->
  <div class="sidebar-content offcanvas offcanvas-start d-flex flex-column flex-shrink-0 p-3" tabindex="-1"
    id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="header-sidebar p-1 d-flex justify-content-around align-items-center">
      <span class="status-icon d-flex align-items-center justify-content-center"><i id="status-icon-tag"
          class="bi "></i></span>
      <span class="name-shop fs-4 justify-self-start"><?php echo $_SESSION['name'];?></span>
      <button class="btn-close" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
        aria-controls="offcanvasExample"></button>
    </div>
    <div class="card shop-status-card mt-3">
      <div class="card-body" id="card-txt">
      </div>
    </div>
    <div class="form-check form-switch custom-switch mt-3">
      <input class="form-check-input bg-on" type="checkbox" id="toggleStatusSwitch">
      <label class="form-check-label" for="toggleStatusSwitch"></label>
    </div>
    <hr />
    <ul class="nav flex-column gap-3">
      <li>
        <a class="nav-link d-flex align-items-center border rounded-2" data-bs-toggle="collapse"
          href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
          <i class="bi bi-clipboard-check me-2 icon-menu"></i> Pedidos
          <i class="bi bi-chevron-right collapse-icon"></i>
        </a>
        <div class="sub-itens collapse multi-collapse mt-2" id="multiCollapseExample1">
          <div class="list-group">
            <a href="./manager.php" class="list-group-item list-group-item-action">Gestor</a>
            <a href="./order-history.php" class="list-group-item list-group-item-action">Pedidos anteriores</a>
          </div>
        </div>
      </li>
      <li>
        <a class="bg-active text-white nav-link d-flex align-items-center border rounded-2" data-bs-toggle="collapse"
          href="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">
          <i class="bi bi-box-seam me-2 icon-menu"></i> Produtos
          <i class="bi bi-chevron-right collapse-icon"></i>
        </a>
        <div class="sub-itens collapse multi-collapse mt-2" id="multiCollapseExample2">
          <div class="list-group">
            <a href="./my-products.php" class="list-group-item list-group-item-action">Meus Produtos</a>
            <a href="./addProduct.php" class="list-group-item list-group-item-action">Adicionar Produto</a>
            <a href="./add-class.php" class="list-group-item list-group-item-action">Adicionar Categoria</a>
          </div>
        </div>
      </li>
      <li>
        <a href="./sales-history.php" class="btn nav-link d-flex align-items-center border rounded-2"
          aria-expanded="false" role="button">
          <i class="bi bi-clock-history me-2 icon-menu"></i> Historico de vendas
        </a>
      </li>
      <hr class="my-2" />
      <li>
        <a class="nav-link d-flex align-items-center border rounded-2" data-bs-toggle="collapse"
          href="#multiCollapseExample4" role="button" aria-expanded="false" aria-controls="multiCollapseExample4">
          <i class="bi bi-gear me-2 icon-menu"></i> Configurações de Pagamento
          <i class="bi bi-chevron-right collapse-icon"></i>
        </a>
        <div class="collapse multi-collapse mt-2 border" id="multiCollapseExample4">
          <div class="list-group">
            <a href="./my-balance.php" class="list-group-item list-group-item-action">Meu saldo</a>
            <a href="./payament-account.php" class="list-group-item list-group-item-action">Mudar conta de
              pagamento</a>

          </div>
        </div>
      </li>
    </ul>
    <hr />
    <div class="dropdown">
      <a class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle"
        data-bs-toggle="dropdown" aria-expanded="false">
        <img src="../imgs/logo-ezpets.svg" alt="Pet Shop" width="50" height="50"
          class="img-shop border-black border rounded-circle me-2" />
        <strong><?php echo $_SESSION['name'];?></strong>
      </a>

      <ul class="dropdown-menu text-small shadow">
        <li><a class="dropdown-item" href="./profile-config.php">Configurações do Perfil</a></li>
        <li><a class="dropdown-item" href="./view-shop.php">Ver minha loja</a></li>
        <li>
          <hr class="dropdown-divider" />
        </li>
        <li><a class="dropdown-item text-decoration-underline" href="../sistema/logoff.php" ><i class="bi bi-box-arrow-left me-2"></i>Sair</a></li>
      </ul>
    </div>
  </div>
  <nav class="navbar shadow navbar-dark bgsucces fixed-top">
    <div class="header-body container-fluid d-flex">
      <button class="btn-hamb navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
        aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon"></span>
      </button>
      <h1 class="page-name">Adicionar Categoria</h1>
      <img src="../imgs/logo-ezpets.svg" alt="Logo Ezpets" width="100" class="img-fluid">
    </div>
  </nav>

  <!-- Bootstrap5 script-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
  <script src="../js/dashboard2.js"></script>
</body>

</html>