<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Gestor de Pedido</title>

  <!-- Bootstrap5 link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />

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
      location.href = "../index.php";
    </script>
  <?php

  }

  ?>
  <!-- Sidebar Menu-->
  <div class="sidebar-content offcanvas offcanvas-start d-flex flex-column flex-shrink-0 p-3" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="header-sidebar p-1 d-flex justify-content-around align-items-center">
      <span class="status-icon d-flex align-items-center justify-content-center"><i id="status-icon-tag" class="bi"></i></span>
      <span class="name-shop fs-4 justify-self-start"><?php echo $_SESSION['name'];?></span>
      <button class="btn-close" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"></button>
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
        <a class="nav-link bg-active text-white d-flex align-items-center border rounded-2" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
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
        <a class="nav-link d-flex align-items-center border rounded-2" data-bs-toggle="collapse" href="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">
          <i class="bi bi-box-seam me-2 icon-menu"></i> Produtos
          <i class="bi bi-chevron-right collapse-icon"></i>
        </a>
        <div class="sub-itens collapse multi-collapse mt-2" id="multiCollapseExample2">
          <div class="list-group">
            <a href="./my-products.php" class="list-group-item list-group-item-action">Meus Produtos</a>
          </div>
        </div>
      </li>
      <li>
        <a href="./sales-history.php" class="btn nav-link d-flex align-items-center border rounded-2" aria-expanded="false" role="button">
          <i class="bi bi-clock-history me-2 icon-menu"></i> Historico de
          vendas
        </a>
      </li>
      <hr class="my-2" />
      <li>
        <a class="nav-link d-flex align-items-center border rounded-2" data-bs-toggle="collapse" href="#multiCollapseExample4" role="button" aria-expanded="false" aria-controls="multiCollapseExample4">
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
      <a class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="../imgs/logo-ezpets.svg" alt="Pet Shop" width="50" height="50" class="img-shop border-black border rounded-circle me-2" />
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
          <a href="../sistema/logoff.php" class="dropdown-item text-decoration-underline"><i class="bi bi-box-arrow-left me-2"></i>Sair</a>
        </li>
      </ul>
    </div>
  </div>

  <div class="content-master">
    <!-- Navbar -->
    <nav class="navbar shadow navbar-dark nav-custom">
      <button class="btn-hamb navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon"></span>
      </button>
      <h1 class="page-name">Gestor</h1>
      <img src="../imgs/logo-ezpets.svg" alt="Logo Ezpets" width="100" class="img-fluid" />
    </nav>

    <!-- Main content -->
    <main class="main-content d-flex flex-row justify-content-center mt-1">
      <!-- Seção de Pedidos Pendentes -->
      <div class="col-md-4">
        <div class="card h-100 card-orders-bg">
          <div class="orders container-fluid rounded" style="max-height: 100vh; overflow-y: auto">
            <h2 class="text-center pt-2 border-bottom border-dark mb-2">
              Pedidos Pendentes
            </h2>
            <ul class="list-group" id="pending-orders">
              <section class="card-body card-orders text-white rounded d-flex flex-column" id="order1">
                <div class="d-flex justify-content-between align-items-center">
                  <h6 class="card-title num-order">Pedido #22222</h6>
                  <h6 class="card-title">Status: Pendente</h6>
                </div>
                <div class="d-flex justify-content-around mb-1">
                  <h5 class="card-text border-end pe-3">Cliente: Denilson</h5>
                  <h5 class="card-text">Hora do Pedido: 11:30</h5>
                </div>
                <div class="buttons-order d-flex justify-content-center align-items-center border-top pt-2 gap-3" id="buttons-order">
                  <a class="btn btn-success accept">Aceitar</a>
                  <a class="btn btn-danger refuse">Recusar</a>
                  <a class="btn btn-primary delivery">Em Trânsito</a>
                  <a class="btn btn-success completed">Entregue</a>
                </div>
              </section>
            </ul>
          </div>
        </div>
      </div>

      <!-- Seção de Detalhes do Pedido -->
      <div class="col-md-8">
        <div class="open-orders">
          <h2 class="text-center pt-2 border-bottom border-dark mb-2">
            Detalhes do Pedido
          </h2>
          <div id="order-details">
            <section class="desc-order" id="desc-order1">
              <div class="alert alert-dark" role="alert">
                <div>
                  <p>Pedido #22222 - </p>
                  <p>Hora do Pedido: 11:30 - </p>
                  <p>Status: Pendente</p>
                </div>
                <a href=""><i class="bi bi-whatsapp"></i></a>
              </div>
              <div class="card datas-client">
                <p class="">Cliente: <span class="dt-info">Denilson</span><span class="qt-orders badge">1° Pedido</span></p>
                <p class="">Endereço: <span class="dt-info"> José Bonifácio, 555 - Tude Bastos</span></p>
                <p>Complemento: <span class="dt-info"> Apto 2</span></p>
                <div class="card card-itens">
                  <h5 class="card-header">Itens do Pedido</h5>
                  <div class="card-body">
                    <p>1x Pacote de Ração Golden - <span class="vl-item">R$ 150,00</span>
                      <hr>
                    </p>
                    <p>2x Brinquedo - <span class="vl-item">R$ 20,00</span></p>
                  </div>
                  <div class="card-footer">
                    <p>Subtotal: <span>R$ 170,00</span></p>
                    <p>Taxa de Entrega: <span>R$ 4,00</span></p>
                    <p>Total: <span class="total-order">R$ 174,00</span></p>
                    <p>Observaçôes: <span class="obs-order"></span></p>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </main>
  </div>

  <!-- Bootstrap5 script-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="../js/dashboard.js"></script>
  <!-- <script>
      // Função para exibir pedidos pendentes
      function displayPendingOrders(ordersData) {
        const pendingOrdersGroup = document.getElementById("pending-orders");
        pendingOrdersGroup.innerHTML = "";

        ordersData.forEach((order) => {
          const card = document.createElement("div");
          card.classList.add("card", "mb-3");
          card.innerHTML = `
            <div class="card-body card-orders text-white rounded d-flex flex-column">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="card-title num-order">Pedido #</h6>
                    <h6 class="card-title">Status:</h6>
                </div>
                <div class="d-flex justify-content-around mb-1">
                    <h6 class="card-text border-end pe-3">Cliente:</h5>
                    <h5 class="card-text">Hora do Pedido:</h5>
                </div>
                <div class="buttons-order d-flex justify-content-center align-items-center border-top pt-2 gap-3"
                    id="buttons-order-${order.id}">
                    <button class="btn btn-success">Aceitar</button>
                    <button class="btn btn-danger">Recusar</button>
                </div>
            </div>
        `;
          card.addEventListener("click", () => showOrderDetails(order));
          pendingOrdersGroup.appendChild(card);
        });
      }

      // Função para exibir detalhes do pedido selecionado
      function showOrderDetails(order) {
        const orderDetails = document.getElementById("order-details");
        orderDetails.innerHTML = `
                <h4>Detalhes do Pedido #${order.id}</h4>
                <p><strong>Cliente:</strong> ${order.customer}</p>
                <p><strong>Itens:</strong> ${order.items.join(", ")}</p>
            `;
      }

      // Função para simular aceitar um pedido
      function acceptOrder(orderId) {
        // Implemente a lógica de aceitação do pedido aqui (pode ser no backend)
        alert(`Pedido #${orderId} aceito`);

        // Remove a div com a classe "buttons-order"
        const buttonsOrderDiv = document.getElementById(
          `buttons-order-${orderId}`
        );
        if (buttonsOrderDiv) {
          buttonsOrderDiv.remove();
        }
      }

      // Função para simular recusar um pedido
      function rejectOrder(orderId) {
        // Implemente a lógica de recusa do pedido aqui (pode ser no backend)
        alert(`Pedido #${orderId} recusado`);
        // Remove a div com a classe "buttons-order"
        const buttonsOrderDiv = document.getElementById(
          `buttons-order-${orderId}`
        );
        if (buttonsOrderDiv) {
          buttonsOrderDiv.remove();
        }
      }

      // Função para buscar dados do servidor e atualizar a lista de pedidos
      function fetchOrdersFromServer() {
        fetch("../php/get-orders.php")
          .then((response) => response.json())
          .then((data) => {
            ordersData = data.reverse(); // Inverter a ordem dos pedidos mais recentes primeiro
            displayPendingOrders(ordersData);
          })
          .catch((error) => {
            console.error("Erro ao buscar dados do servidor:", error);
          });
      }

      // Atualizar pedidos do servidor a cada 5 segundos (5000 milissegundos)
      setInterval(fetchOrdersFromServer, 5000);

      // Chamar a função inicialmente para exibir os pedidos existentes
      fetchOrdersFromServer();
    </script> -->
</body>

</html>