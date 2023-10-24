
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
          class="bi"></i></span>
      <span class="name-shop fs-4 justify-self-start"><?php echo $_SESSION['name'];?></span>
      <button class="btn-close" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
        aria-controls="offcanvasExample"></button>
    </div>
    <div class="card shop-status-card mt-3">
      <div class="card-body" id="card-txt"></div>
    </div>
    <div class="form-check form-switch custom-switch mt-3">
      <input class="form-check-input bg-on" type="checkbox" id="toggleStatusSwitch" />
      <label class="form-check-label" for="toggleStatusSwitch"></label>
    </div>
    <hr />
    <ul class="nav flex-column gap-3">
      <li>
        <a class="nav-link bg-active text-white d-flex align-items-center border rounded-2" data-bs-toggle="collapse"
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
        <a class="nav-link d-flex align-items-center border rounded-2" data-bs-toggle="collapse"
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
          <i class="bi bi-clock-history me-2 icon-menu"></i> Historico de
          vendas
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
        <strong id="opt-name"><?php echo $_SESSION['name'];?></strong>
      </a>

      <ul class="dropdown-menu text-small shadow">
        <li>
          <a class="dropdown-item" href="./profile-config.php">Configurações do Perfil</a>
        </li>
        <li>
          <a class="dropdown-item" href="./view-shop.php">Ver minha loja</a>
        </li>
        <li>
          <hr class="dropdown-divider" />
        </li>
        <li>
          <a class="dropdown-item text-decoration-underline" href="../sistema/logoff.php" ><i class="bi bi-box-arrow-left me-2"></i>Sair</a>
        </li>
      </ul>
    </div>
  </div>

  <div class="content-master">
    <!-- Navbar -->
    <nav class="navbar shadow navbar-dark nav-custom">
      <button class="btn-hamb navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
        aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon"></span>
      </button>
      <h1 class="page-name">Meus Produtos</h1>
      <img src="../imgs/logo-ezpets.svg" alt="Logo Ezpets" width="100" class="img-fluid" />
    </nav>

    <!-- Main content -->
    <main class="main-content mt-1">
      <section class="card-categs px-5 pt-5" id="card-categ1">
        <div class="card">
          <div class="card-header px-4" data-bs-toggle="collapse" href="#collapseExample" role="button"
            aria-expanded="false" aria-controls="collapseExample" id="card-h">
            <a class="nm-categ">Rações </a>
            <a value="on" id="btn-categ" class="btn-categ on">
              Pausar
            </a>
          </div>
          <div class="collapse" id="collapseExample">
            <div class="card card-body">
              <div class="card" id="card-prod1">
                <!-- Botão para acionar modal -->
                <div class="edit" data-bs-toggle="modal" data-bs-target="#Modal1">
                  <i class="bi bi-pencil-square"></i>
                </div>

                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal fade" id="Modal1" tabindex="-1" aria-labelledby="Modal1Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="Modal1Title">Editar Produto</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form class="form-edit g-3 needs-validation" novalidate>
                            <div class="header-form">
                              <div class="box-img">
                                <img src="../imgs/images.jpg" alt="img">
                              </div>
                              <div class="datas">
                                <div class="nm-prod">
                                  <label for="nm-edit-prod" class="form-label">Nome:</label>
                                  <input type="text" class="form-control" id="nm-edit-prod" value="Ração Golden" required>
                                </div>
                                <div class="cod-prod">
                                  <label for="cod-edit-prod" class="form-label">Codigo:</label>
                                  <input type="text" class="form-control" id="cod-edit-prod" placeholder="0000">
                                </div>
                                <div class="vl-prod">
                                  <label for="vl-edit-prod" class="form-label">Preço:</label>
                                  <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="text" class="form-control" id="vl-edit-prod" placeholder="20,00"
                                      required>
                                  </div>
                                </div>
                                <div class="categ-prod">
                                  <label for="edit-categ" class="form-label">Categoria</label>
                                  <select class="form-select" id="edit-categ" required>
                                    <option selected value="">Rações</option>
                                    <option>Brinquedos</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="-box-desc">
                              <label for="desc-prod" class="form-label">Descrição:</label>
                              <textarea class="form-control" id="desc-prod"></textarea>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <a href="" class="btn close-edit btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                          <a href="" class="btn save-edit">Salvar</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <img class="card-img-top border-bottom" src="../imgs/images.jpg" alt="Imagem de capa do card"
                  id="nm-prod1" />
                <div class="card-body infos d-flex justify-content-between flex-column">
                  <h5 class="card-title" id="nm-prod1">Ração Golden</h5>
                  <p class="card-text" id="vl-prod1">R$ 150,00</p>
                  <a href="#" class="btn-prod on align-self-center">Pausar</a>
                </div>
              </div>
              <div class="card" id="card-prod2">
                <!-- Botão para acionar modal -->
                <div class="edit" data-bs-toggle="modal" data-bs-target="#Modal2">
                  <i class="bi bi-pencil-square"></i>
                </div>

                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal fade" id="Modal2" tabindex="-1" aria-labelledby="Modal2Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="Modal2Title">Editar Produto</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form class="form-edit g-3 needs-validation" novalidate>
                            <div class="header-form">
                              <div class="box-img">
                                <img src="../imgs/images.jpg" alt="img">
                              </div>
                              <div class="datas">
                                <div class="nm-prod">
                                  <label for="nm-edit-prod" class="form-label">Nome:</label>
                                  <input type="text" class="form-control" id="nm-edit-prod" value="Ração Golden" required>
                                </div>
                                <div class="cod-prod">
                                  <label for="cod-edit-prod" class="form-label">Codigo:</label>
                                  <input type="text" class="form-control" id="cod-edit-prod" placeholder="0000">
                                </div>
                                <div class="vl-prod">
                                  <label for="vl-edit-prod" class="form-label">Preço:</label>
                                  <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="text" class="form-control" id="vl-edit-prod" placeholder="20,00"
                                      required>
                                  </div>
                                </div>
                                <div class="categ-prod">
                                  <label for="edit-categ" class="form-label">Categoria</label>
                                  <select class="form-select" id="edit-categ" required>
                                    <option selected value="">Rações</option>
                                    <option>Brinquedos</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="-box-desc">
                              <label for="desc-prod" class="form-label">Descrição:</label>
                              <textarea class="form-control" id="desc-prod"></textarea>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <a href="" class="btn close-edit btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                          <a href="" class="btn save-edit">Salvar</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <img class="card-img-top border-bottom" src="../imgs/images.jpg" alt="Imagem de capa do card"
                  id="nm-prod1" />
                <div class="card-body infos d-flex justify-content-between flex-column">
                  <h5 class="card-title" id="nm-prod1">Ração Golden</h5>
                  <p class="card-text" id="vl-prod1">R$ 150,00</p>
                  <a href="#" class="btn-prod on align-self-center">Pausar</a>
                </div>
              </div>
              <div class="card" id="card-prod3">
                <!-- Botão para acionar modal -->
                <div class="edit" data-bs-toggle="modal" data-bs-target="#Modal3">
                  <i class="bi bi-pencil-square"></i>
                </div>

                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal fade" id="Modal3" tabindex="-1" aria-labelledby="Modal3Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="Modal3Title">Editar Produto</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form class="form-edit g-3 needs-validation" novalidate>
                            <div class="header-form">
                              <div class="box-img">
                                <img src="../imgs/images.jpg" alt="img">
                              </div>
                              <div class="datas">
                                <div class="nm-prod">
                                  <label for="nm-edit-prod" class="form-label">Nome:</label>
                                  <input type="text" class="form-control" id="nm-edit-prod" value="Ração Golden" required>
                                </div>
                                <div class="cod-prod">
                                  <label for="cod-edit-prod" class="form-label">Codigo:</label>
                                  <input type="text" class="form-control" id="cod-edit-prod" placeholder="0000">
                                </div>
                                <div class="vl-prod">
                                  <label for="vl-edit-prod" class="form-label">Preço:</label>
                                  <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="text" class="form-control" id="vl-edit-prod" placeholder="20,00"
                                      required>
                                  </div>
                                </div>
                                <div class="categ-prod">
                                  <label for="edit-categ" class="form-label">Categoria</label>
                                  <select class="form-select" id="edit-categ" required>
                                    <option selected value="">Rações</option>
                                    <option>Brinquedos</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="-box-desc">
                              <label for="desc-prod" class="form-label">Descrição:</label>
                              <textarea class="form-control" id="desc-prod"></textarea>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <a href="" class="btn close-edit btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                          <a href="" class="btn save-edit">Salvar</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <img class="card-img-top border-bottom" src="../imgs/images.jpg" alt="Imagem de capa do card"
                  id="nm-prod1" />
                <div class="card-body infos d-flex justify-content-between flex-column">
                  <h5 class="card-title" id="nm-prod1">Ração Golden</h5>
                  <p class="card-text" id="vl-prod1">R$ 150,00</p>
                  <a href="#" class="btn-prod on align-self-center">Pausar</a>
                </div>
              </div>
              <div class="card" id="card-prod4">
                <!-- Botão para acionar modal -->
                <div class="edit" data-bs-toggle="modal" data-bs-target="#Modal4">
                  <i class="bi bi-pencil-square"></i>
                </div>

                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal fade" id="Modal4" tabindex="-1" aria-labelledby="Modal4Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="Modal4Title">Editar Produto</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form class="form-edit g-3 needs-validation" novalidate>
                            <div class="header-form">
                              <div class="box-img">
                                <img src="../imgs/images.jpg" alt="img">
                              </div>
                              <div class="datas">
                                <div class="nm-prod">
                                  <label for="nm-edit-prod" class="form-label">Nome:</label>
                                  <input type="text" class="form-control" id="nm-edit-prod" value="Ração Golden" required>
                                </div>
                                <div class="cod-prod">
                                  <label for="cod-edit-prod" class="form-label">Codigo:</label>
                                  <input type="text" class="form-control" id="cod-edit-prod" placeholder="0000">
                                </div>
                                <div class="vl-prod">
                                  <label for="vl-edit-prod" class="form-label">Preço:</label>
                                  <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="text" class="form-control" id="vl-edit-prod" placeholder="20,00"
                                      required>
                                  </div>
                                </div>
                                <div class="categ-prod">
                                  <label for="edit-categ" class="form-label">Categoria</label>
                                  <select class="form-select" id="edit-categ" required>
                                    <option selected value="">Rações</option>
                                    <option>Brinquedos</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="-box-desc">
                              <label for="desc-prod" class="form-label">Descrição:</label>
                              <textarea class="form-control" id="desc-prod"></textarea>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <a href="" class="btn close-edit btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                          <a href="" class="btn save-edit">Salvar</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <img class="card-img-top border-bottom" src="../imgs/images.jpg" alt="Imagem de capa do card"
                  id="nm-prod1" />
                <div class="card-body infos d-flex justify-content-between flex-column">
                  <h5 class="card-title" id="nm-prod1">Ração Golden</h5>
                  <p class="card-text" id="vl-prod1">R$ 150,00</p>
                  <a href="#" class="btn-prod on align-self-center">Pausar</a>
                </div>
              </div>
              <div class="card" id="card-prod5">
                <!-- Botão para acionar modal -->
                <div class="edit" data-bs-toggle="modal" data-bs-target="#Modal5">
                  <i class="bi bi-pencil-square"></i>
                </div>

                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal fade" id="Modal5" tabindex="-1" aria-labelledby="Modal5Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="Modal5Title">Editar Produto</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form class="form-edit g-3 needs-validation" novalidate>
                            <div class="header-form">
                              <div class="box-img">
                                <img src="../imgs/images.jpg" alt="img">
                              </div>
                              <div class="datas">
                                <div class="nm-prod">
                                  <label for="nm-edit-prod" class="form-label">Nome:</label>
                                  <input type="text" class="form-control" id="nm-edit-prod" value="Ração Golden" required>
                                </div>
                                <div class="cod-prod">
                                  <label for="cod-edit-prod" class="form-label">Codigo:</label>
                                  <input type="text" class="form-control" id="cod-edit-prod" placeholder="0000">
                                </div>
                                <div class="vl-prod">
                                  <label for="vl-edit-prod" class="form-label">Preço:</label>
                                  <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="text" class="form-control" id="vl-edit-prod" placeholder="20,00"
                                      required>
                                  </div>
                                </div>
                                <div class="categ-prod">
                                  <label for="edit-categ" class="form-label">Categoria</label>
                                  <select class="form-select" id="edit-categ" required>
                                    <option selected value="">Rações</option>
                                    <option>Brinquedos</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="-box-desc">
                              <label for="desc-prod" class="form-label">Descrição:</label>
                              <textarea class="form-control" id="desc-prod"></textarea>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <a href="" class="btn close-edit btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                          <a href="" class="btn save-edit">Salvar</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <img class="card-img-top border-bottom" src="../imgs/images.jpg" alt="Imagem de capa do card"
                  id="nm-prod1" />
                <div class="card-body infos d-flex justify-content-between flex-column">
                  <h5 class="card-title" id="nm-prod1">Ração Golden</h5>
                  <p class="card-text" id="vl-prod1">R$ 150,00</p>
                  <a href="#" class="btn-prod on align-self-center">Pausar</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="card-categs p-5" id="card-categ2">
        <div class="card">
          <div class="card-header px-4" data-bs-toggle="collapse" href="#collapseExample2" role="button"
            aria-expanded="false" aria-controls="collapseExample2" id="card-h">
            <a class="nm-categ">Brinquedos </a>
            <a value="on" id="btn-categ" class="btn-categ on">Pausar</a>
          </div>
          <div class="collapse" id="collapseExample2">
            <div class="card card-body">
              <div class="card" id="card-prod1">
                <!-- Botão para acionar modal -->
                <div class="edit" data-bs-toggle="modal" data-bs-target="#Modal1">
                  <i class="bi bi-pencil-square"></i>
                </div>

                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal fade" id="Modal12" tabindex="-1" aria-labelledby="Modal1Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="Modal1Title">Editar Produto</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form class="form-edit g-3 needs-validation" novalidate>
                            <div class="header-form">
                              <div class="box-img">
                                <img src="../imgs/images.jpg" alt="img">
                              </div>
                              <div class="datas">
                                <div class="nm-prod">
                                  <label for="nm-edit-prod" class="form-label">Nome:</label>
                                  <input type="text" class="form-control" id="nm-edit-prod" value="Ração Golden" required>
                                </div>
                                <div class="cod-prod">
                                  <label for="cod-edit-prod" class="form-label">Codigo:</label>
                                  <input type="text" class="form-control" id="cod-edit-prod" placeholder="0000">
                                </div>
                                <div class="vl-prod">
                                  <label for="vl-edit-prod" class="form-label">Preço:</label>
                                  <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="text" class="form-control" id="vl-edit-prod" placeholder="20,00"
                                      required>
                                  </div>
                                </div>
                                <div class="categ-prod">
                                  <label for="edit-categ" class="form-label">Categoria</label>
                                  <select class="form-select" id="edit-categ" required>
                                    <option selected value="">Rações</option>
                                    <option>Brinquedos</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="-box-desc">
                              <label for="desc-prod" class="form-label">Descrição:</label>
                              <textarea class="form-control" id="desc-prod"></textarea>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <a href="" class="btn close-edit btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                          <a href="" class="btn save-edit">Salvar</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <img class="card-img-top border-bottom" src="../imgs/images.jpg" alt="Imagem de capa do card"
                  id="nm-prod1" />
                <div class="card-body infos d-flex justify-content-between flex-column">
                  <h5 class="card-title" id="nm-prod1">Ração Golden</h5>
                  <p class="card-text" id="vl-prod1">R$ 150,00</p>
                  <a href="#" class="btn-prod on align-self-center">Pausar</a>
                </div>
              </div>
              <div class="card" id="card-prod2">
                <!-- Botão para acionar modal -->
                <div class="edit" data-bs-toggle="modal" data-bs-target="#Modal2">
                  <i class="bi bi-pencil-square"></i>
                </div>

                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal fade" id="Modal2" tabindex="-1" aria-labelledby="Modal2Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="Modal2Title">Editar Produto</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form class="form-edit g-3 needs-validation" novalidate>
                            <div class="header-form">
                              <div class="box-img">
                                <img src="../imgs/images.jpg" alt="img">
                              </div>
                              <div class="datas">
                                <div class="nm-prod">
                                  <label for="nm-edit-prod" class="form-label">Nome:</label>
                                  <input type="text" class="form-control" id="nm-edit-prod" value="Ração Golden" required>
                                </div>
                                <div class="cod-prod">
                                  <label for="cod-edit-prod" class="form-label">Codigo:</label>
                                  <input type="text" class="form-control" id="cod-edit-prod" placeholder="0000">
                                </div>
                                <div class="vl-prod">
                                  <label for="vl-edit-prod" class="form-label">Preço:</label>
                                  <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="text" class="form-control" id="vl-edit-prod" placeholder="20,00"
                                      required>
                                  </div>
                                </div>
                                <div class="categ-prod">
                                  <label for="edit-categ" class="form-label">Categoria</label>
                                  <select class="form-select" id="edit-categ" required>
                                    <option selected value="">Rações</option>
                                    <option>Brinquedos</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="-box-desc">
                              <label for="desc-prod" class="form-label">Descrição:</label>
                              <textarea class="form-control" id="desc-prod"></textarea>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <a href="" class="btn close-edit btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                          <a href="" class="btn save-edit">Salvar</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <img class="card-img-top border-bottom" src="../imgs/images.jpg" alt="Imagem de capa do card"
                  id="nm-prod1" />
                <div class="card-body infos d-flex justify-content-between flex-column">
                  <h5 class="card-title" id="nm-prod1">Ração Golden</h5>
                  <p class="card-text" id="vl-prod1">R$ 150,00</p>
                  <a href="#" class="btn-prod on align-self-center">Pausar</a>
                </div>
              </div>
              <div class="card" id="card-prod3">
                <!-- Botão para acionar modal -->
                <div class="edit" data-bs-toggle="modal" data-bs-target="#Modal3">
                  <i class="bi bi-pencil-square"></i>
                </div>

                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal fade" id="Modal3" tabindex="-1" aria-labelledby="Modal3Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="Modal3Title">Editar Produto</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form class="form-edit g-3 needs-validation" novalidate>
                            <div class="header-form">
                              <div class="box-img">
                                <img src="../imgs/images.jpg" alt="img">
                              </div>
                              <div class="datas">
                                <div class="nm-prod">
                                  <label for="nm-edit-prod" class="form-label">Nome:</label>
                                  <input type="text" class="form-control" id="nm-edit-prod" value="Ração Golden" required>
                                </div>
                                <div class="cod-prod">
                                  <label for="cod-edit-prod" class="form-label">Codigo:</label>
                                  <input type="text" class="form-control" id="cod-edit-prod" placeholder="0000">
                                </div>
                                <div class="vl-prod">
                                  <label for="vl-edit-prod" class="form-label">Preço:</label>
                                  <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="text" class="form-control" id="vl-edit-prod" placeholder="20,00"
                                      required>
                                  </div>
                                </div>
                                <div class="categ-prod">
                                  <label for="edit-categ" class="form-label">Categoria</label>
                                  <select class="form-select" id="edit-categ" required>
                                    <option selected value="">Rações</option>
                                    <option>Brinquedos</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="-box-desc">
                              <label for="desc-prod" class="form-label">Descrição:</label>
                              <textarea class="form-control" id="desc-prod"></textarea>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <a href="" class="btn close-edit btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                          <a href="" class="btn save-edit">Salvar</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <img class="card-img-top border-bottom" src="../imgs/images.jpg" alt="Imagem de capa do card"
                  id="nm-prod1" />
                <div class="card-body infos d-flex justify-content-between flex-column">
                  <h5 class="card-title" id="nm-prod1">Ração Golden</h5>
                  <p class="card-text" id="vl-prod1">R$ 150,00</p>
                  <a href="#" class="btn-prod on align-self-center">Pausar</a>
                </div>
              </div>
              <div class="card" id="card-prod4">
                <!-- Botão para acionar modal -->
                <div class="edit" data-bs-toggle="modal" data-bs-target="#Modal4">
                  <i class="bi bi-pencil-square"></i>
                </div>

                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal fade" id="Modal4" tabindex="-1" aria-labelledby="Modal4Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="Modal4Title">Editar Produto</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form class="form-edit g-3 needs-validation" novalidate>
                            <div class="header-form">
                              <div class="box-img">
                                <img src="../imgs/images.jpg" alt="img">
                              </div>
                              <div class="datas">
                                <div class="nm-prod">
                                  <label for="nm-edit-prod" class="form-label">Nome:</label>
                                  <input type="text" class="form-control" id="nm-edit-prod" value="Ração Golden" required>
                                </div>
                                <div class="cod-prod">
                                  <label for="cod-edit-prod" class="form-label">Codigo:</label>
                                  <input type="text" class="form-control" id="cod-edit-prod" placeholder="0000">
                                </div>
                                <div class="vl-prod">
                                  <label for="vl-edit-prod" class="form-label">Preço:</label>
                                  <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="text" class="form-control" id="vl-edit-prod" placeholder="20,00"
                                      required>
                                  </div>
                                </div>
                                <div class="categ-prod">
                                  <label for="edit-categ" class="form-label">Categoria</label>
                                  <select class="form-select" id="edit-categ" required>
                                    <option selected value="">Rações</option>
                                    <option>Brinquedos</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="-box-desc">
                              <label for="desc-prod" class="form-label">Descrição:</label>
                              <textarea class="form-control" id="desc-prod"></textarea>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <a href="" class="btn close-edit btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                          <a href="" class="btn save-edit">Salvar</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <img class="card-img-top border-bottom" src="../imgs/images.jpg" alt="Imagem de capa do card"
                  id="nm-prod1" />
                <div class="card-body infos d-flex justify-content-between flex-column">
                  <h5 class="card-title" id="nm-prod1">Ração Golden</h5>
                  <p class="card-text" id="vl-prod1">R$ 150,00</p>
                  <a href="#" class="btn-prod on align-self-center">Pausar</a>
                </div>
              </div>
              <div class="card" id="card-prod5">
                <!-- Botão para acionar modal -->
                <div class="edit" data-bs-toggle="modal" data-bs-target="#Modal5">
                  <i class="bi bi-pencil-square"></i>
                </div>

                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal fade" id="Modal5" tabindex="-1" aria-labelledby="Modal5Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="Modal5Title">Editar Produto</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form class="form-edit g-3 needs-validation" novalidate>
                            <div class="header-form">
                              <div class="box-img">
                                <img src="../imgs/images.jpg" alt="img">
                              </div>
                              <div class="datas">
                                <div class="nm-prod">
                                  <label for="nm-edit-prod" class="form-label">Nome:</label>
                                  <input type="text" class="form-control" id="nm-edit-prod" value="Ração Golden" required>
                                </div>
                                <div class="cod-prod">
                                  <label for="cod-edit-prod" class="form-label">Codigo:</label>
                                  <input type="text" class="form-control" id="cod-edit-prod" placeholder="0000">
                                </div>
                                <div class="vl-prod">
                                  <label for="vl-edit-prod" class="form-label">Preço:</label>
                                  <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="text" class="form-control" id="vl-edit-prod" placeholder="20,00"
                                      required>
                                  </div>
                                </div>
                                <div class="categ-prod">
                                  <label for="edit-categ" class="form-label">Categoria</label>
                                  <select class="form-select" id="edit-categ" required>
                                    <option selected value="">Rações</option>
                                    <option>Brinquedos</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="-box-desc">
                              <label for="desc-prod" class="form-label">Descrição:</label>
                              <textarea class="form-control" id="desc-prod"></textarea>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <a href="" class="btn close-edit btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                          <a href="" class="btn save-edit">Salvar</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <img class="card-img-top border-bottom" src="../imgs/images.jpg" alt="Imagem de capa do card"
                  id="nm-prod1" />
                <div class="card-body infos d-flex justify-content-between flex-column">
                  <h5 class="card-title" id="nm-prod1">Ração Golden</h5>
                  <p class="card-text" id="vl-prod1">R$ 150,00</p>
                  <a href="#" class="btn-prod on align-self-center">Pausar</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>

  <!-- Bootstrap5 script-->
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