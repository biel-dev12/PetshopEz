<?php
session_start();
include_once('../sistema/config/connection.php');


try {
  $idps = $_SESSION['idps'];

  $stmt = $conn->prepare("SELECT * FROM tb_petshop WHERE id_petshop = :idps");
  $stmt->bindParam(':idps', $idps);
  $stmt->execute();

  if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $name = $row['nm_fantasy'];
    $cep = $row['cd_ps_cep'];
    $email = $row['nm_ps_email'];
    $telefone = $row['cd_ps_tel'];
    $_SESSION['img_ps'] = $row['img_ps'];

  } else {
    echo "Nenhum resultado encontrado para o e-mail informado.";
  }
} catch (PDOException $e) {
  echo "Erro ao buscar dados: " . $e->getMessage();
}

$_SESSION['telefone'] = $telefone;
$_SESSION['cep'] = $cep;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/dashb-style.css">
  <script src="./js/callMaskInputs.js"></script>


  <!-- Bootstrap5 link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="shortcut icon" href="../imgs/favicon-cropped.svg" type="image/x-icon" />
  <link rel="stylesheet" href="../css/dash-style.css" />
</head>


<title> EzPets | Configurações da Conta</title>
</head>

<body>

  <!-- Sidebar Menu-->
  <div class="sidebar-content offcanvas offcanvas-start d-flex flex-column flex-shrink-0 p-3" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="header-sidebar p-1 d-flex justify-content-around align-items-center">
      <span class="status-icon d-flex align-items-center justify-content-center"><i id="status-icon-tag" class="bi"></i></span>
      <span class="name-shop fs-4 justify-self-start"><?php echo $_SESSION['name']; ?></span>
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
        <strong id="opt-name"><?php echo $_SESSION['name']; ?></strong>
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
      <h1 class="page-name">Meu Perfil</h1>
      <img src="../imgs/logo-ezpets.svg" alt="Logo Ezpets" width="100" class="img-fluid" />
    </nav>


    <!--Main content-->


    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Verifica se o método da requisição é POST

      if (isset($_POST["new-name"])) {


        $newname = $_POST["new-name"];

        if (isset($_SESSION['idps'])) {
          $idps = $_SESSION['idps'];

          $sql = "UPDATE tb_petshop SET nm_fantasy = :newname WHERE id_petshop = :idps";


          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':newname', $newname);
          $stmt->bindParam(':idps', $idps);
          $stmt->execute();


          if ($stmt->rowCount() > 0) {

            $_SESSION['name'] = $newname;
            echo '<script>alert("Nome Alterado com Sucesso");</script>';

            echo "<script>
              location.href = 'profile-config.php';
            </script>";
          } else {
          }
        } else {;
        }
      } else {
      }
    }


    ?>





    <!--Foto e nome da loja-->
    <div class="container-main d-block">
      <div class="img-profile d-flex flex-column text-center p-3">
        <div>
        <img src=" " width="300" height="300" class="img-shop border-black border rounded-circle mx-auto" />
        <button class="icon bi bi-pencil-square rounded-pill border" data-bs-toggle="modal" data-bs-target="#ModalImg"></button>
        </div>

        <div id="ModalImg" class="modal">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <form action="../php/cadProfileImg.php" method="POST" enctype="multipart/form-data">
              <div class="modal-header">
                <h5 class="modal-title">Alterar Foto de Perfil</h5>
                <button type="button" class="btn-close btn-danger btn" data-bs-dismiss="modal" aria-label="Fechar"></button>
              </div>

              <div class="modal-body">
              <div style="width: 100%;">
                         <div class="box-img" id="box-img">
                          <img src=" " id="imagemPreview" style="content: none;">
                          <label for="hidden-input" id="label-hidden-input"><i class="bi bi-plus-circle-fill"></i></label>
                        </div>
                      </div>
                      <input type="file" name="img-pf" id="hidden-input" class="d-none" accept="image/png, image/jpeg" onchange="showImage(this)" required>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Enviar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
        <!-- <label class="icon bi bi-pencil-square rounded-pill border" for="hidden-input"></label>
        <input type="file" name="img" id="hidden-input" class="d-none" accept="image/png, image/jpeg" onchange="showImage(this)" required> -->

      </div> 
      <div class="name-shop p-2 d-flex justify-content-center align-items-center text-center ">
        <h3> <?php echo "Nome: " . $_SESSION['name'] ?>
          <button type="submit" class="icon bi bi-pencil-square rounded-pill border" data-bs-toggle="modal" data-bs-target="#JanelaModalName"></button>
        </h3>
      </div>

      <div id="JanelaModalName" class="modal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="#" method="POST">
              <div class="modal-header">
                <h5 class="modal-title">Alterar Nome da Loja</h5>
                <button type="button" class="btn-close btn-danger btn" data-bs-dismiss="modal" aria-label="Fechar"></button>
              </div>

              <div class="modal-body">
                <p>
                <h4>Nome da Loja Atual: <?php echo $_SESSION['name'] ?></h4>
                </p>
                <div class="inps">
                  <p>
                  <h4>Novo Nome: <input type="text" name="new-name" class="form-control" id="new-name" placeholder="Ex: Pet shop do João" />
                    <label for="fantasy-name"></label>
                </div>
              </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Enviar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>




    <!--Dados da Conta-->


    <div class="container-data">
      <div class="account-data">
        <h1>Dados da Conta</h1>
      </div>

      <h3 class="p-3"><button type="submit" class=" icon bi bi-pencil-square rounded-pill border" data-bs-toggle="modal" data-bs-target="#JanelaModalEmail"></button> <?php echo "E-Mail: " . $email ?> </h3>

      <div id="JanelaModalEmail" class="modal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <form action="#" method="POST">
              <div class="modal-header">
                <h5 class="modal-title">Alterar E-Mail</h5>
                <button type="button" class="btn-close btn-danger btn" data-bs-dismiss="modal" aria-label="Fechar"></button>
              </div>

              <div class="modal-body">
                <p>
                <h4>E-Mail atual: <?php echo $_SESSION['email01'] ?></h4>
                </p>
                <div class="inps">
                  <p>
                  <h4>Novo E-mail: <input type="email" class="form-control" name="new-email" id="new-email" placeholder="Ex: petshop@email.com" />
                    <label for="new-email"></label>
                </div>
              </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Enviar</button>
              </div>
            </form>

          </div>
        </div>
      </div>


      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica se o método da requisição é POST

        if (isset($_POST["new-email"])) {
          $newemail = $_POST["new-email"];

          if (isset($_SESSION['idps'])) {
            $idps = $_SESSION['idps'];

            $sql = "UPDATE tb_petshop SET nm_ps_email = :newemail WHERE id_petshop = :idps";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':newemail', $newemail);
            $stmt->bindParam(':idps', $idps);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
              $_SESSION['email01'] = $newemail;
              echo '<script>alert("E-mail Alterado com Sucesso");</script>';
              echo "<script>
                  location.href = 'profile-config.php';
                </script>";
            } else {
            }
          } else {
          }
        } else {
        }
      }

      ?>
      <h3 class="p-3"><button type="submit" class="icon bi bi-pencil-square rounded-pill border " data-bs-toggle="modal" data-bs-target="#JanelaModalTelefone"></button> <?php echo "Telefone: " . $telefone ?> </h3>

      <div id="JanelaModalTelefone" class="modal">
        <div class="modal-dialog">
          <div class="modal-content">

            <form action="#" method="POST">
              <div class="modal-header">
                <h5 class="modal-title">Alterar Telefone</h5>
                <button type="button" class="btn-close btn-danger btn" data-bs-dismiss="modal" aria-label="Fechar"></button>
              </div>


              <div class="nm-prod">


                <div class="modal-body">
                  <p>
                  <h4>Telefone atual: <?php echo $_SESSION['telefone'] ?></h4>
                  </p>
                  <h4>Novo Telefone:
                    <input type="text" class="form-control new-tel" name="new-tel" id="nm-edit-prod new-tel">
                  </h4>
                </div>
              </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Enviar</button>
              </div>
            </form>

          </div>
        </div>
      </div>



      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica se o método da requisição é POST

        if (isset($_POST["new-tel"])) {
          $newtel = $_POST["new-tel"];

          if (isset($_SESSION['idps'])) {
            $idps = $_SESSION['idps'];

            $sql = "UPDATE tb_petshop SET cd_ps_tel = :newtel WHERE id_petshop = :idps";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':newtel', $newtel);
            $stmt->bindParam(':idps', $idps);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
              $_SESSION['telefone'] = $newtel;
              echo '<script>alert("Telefone Alterado com Sucesso");</script>';
              echo "<script>
                  location.href = 'profile-config.php';
                </script>";
            } else {
            }
          } else {
          }
        } else {
        }
      }

      ?>




      <h3 class="p-3"> <button type="submit" class="icon bi bi-pencil-square rounded-pill border " data-bs-toggle="modal" data-bs-target="#JanelaModalEndereco"></button> <?php echo "Endereço: CEP: " . $cep ?> </h3>

      <div id="JanelaModalEndereco" class="modal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content ">

            <form action="#" method="POST">
              <div class="modal-header">
                <h5 class="modal-title">Alterar Endereço</h5>
                <button type="button" class="btn-close btn-danger btn" data-bs-dismiss="modal" aria-label="Fechar"></button>
              </div>

              <div class="modal-body ">
                <p>
                <h4>CEP atual: <?php echo $_SESSION['cep'] ?></h4>
                </p>
                <p>
                <h4>Novo CEP: <input type="text" class="form-control" name="new-cep" id="new-cep" placeholder="xxxxx-xxx" onblur="pesquisacep(this.value);" />
                  <label for="new-cep"></label>
                  <h3>
                    <p>Endereço:
                      <input type="text" class="form-control" names="newstreet" id="newstreet" placeholder="Rua" disabled> <input type="text" class="form-control" names="newnumber" id="newnumber" placeholder="Nº" size="3">
                    </p>
                    <p><input type="text" class="form-control" names="newneighborhood" id="newneighborhood" placeholder="Bairro" disabled></p>
                    <p><input type="text" class="form-control" names="newstate" id="newstate" placeholder="Estado" disabled></p>
                    <p><input type="text" class="form-control" names="newcity" id="newcity" placeholder="Cidade" disabled></p>
                  </h3>
              </div>


              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Enviar</button>
              </div>
            </form>

          </div>
        </div>
      </div>



      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica se o método da requisição é POST

        if (isset($_POST["new-cep"])) {
          $newcep = $_POST["new-cep"];

          if (isset($_SESSION['idps'])) {
            $idps = $_SESSION['idps'];

            $sql = "UPDATE tb_petshop SET cd_ps_cep = :newcep WHERE id_petshop = :idps";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':newcep', $newcep);
            $stmt->bindParam(':idps', $idps);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
              $_SESSION['cep'] = $newcep;
              echo '<script>alert("Endereço Alterado com Sucesso");</script>';
              echo "<script>
                  location.href = 'profile-config.php';
                </script>";
            } else {
            }
          } else {
          }
        } else {
        }
      }

      ?>

      </span>
    </div>
  </div>




  </div>



  <!-- Bootstrap5 script-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="../js/dashboard.js"></script>
  <script scr="../js/searchCep.js"></script>
</body>

</html>



<?php

if (!isset($_SESSION['idps'])) {
?>

  <script>
    location.href = "../index.php";
  </script>
<?php

}

?>

<!--VALIDA CEP-->
<script>
  function pesquisacep(valor) {
    // Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    // Verifica se o campo cep possui valor informado.
    if (cep !== '') {
      // Expressão regular para validar o CEP.
      var validacep = /^[0-9]{8}$/;

      // Valida o formato do CEP.
      if (validacep.test(cep)) {
        // Consulta o webservice viacep.com.br/
        $.getJSON('//viacep.com.br/ws/' + cep + '/json/?callback=?', function(dados) {
          if (!('erro' in dados)) {
            // Atualiza os campos com os valores da consulta.
            document.getElementById('newstreet').value = dados.logradouro;
            document.getElementById('newneighborhood').value = dados.bairro;
            document.getElementById('newcity').value = dados.localidade;
            document.getElementById('newstate').value = dados.uf;
          } else {
            // CEP pesquisado não foi encontrado.
            alert('CEP não encontrado.');
          }
        });
      } else {
        // CEP é inválido.
        alert('Formato de CEP inválido.');
      }
    } else {
      // CEP sem valor, limpa formulário.
      alert('CEP em branco.');
    }
  }
</script>



<!--MASCARA DE CEP-->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('#new-cep').on('input', function() {
      let cep = $(this).val();
      cep = cep.replace(/\D/g, ''); // Remove todos os caracteres que não são dígitos

      // Aplica a máscara de CEP
      cep = cep.replace(/^(\d{5})(\d)/, '$1-$2');

      // Limita o número de caracteres para 9
      if (cep.length > 9) {
        cep = cep.substring(0, 9);
      }

      $(this).val(cep);
    });
  })
</script>
<!--MASCARA DE TELEFONE-->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function() {
    $('.new-tel').on('input', function() {
      let tel = $(this).val();
      tel = tel.replace(/\D/g, ''); // Remove todos os caracteres que não são dígitos

      // Aplica a máscara de telefone a partir dos 2 primeiros dígitos
      tel = tel.replace(/^(\d{2})(\d)/g, '($1) $2');
      tel = tel.replace(/(\d{4,5})(\d{4})$/, '$1-$2');

      // Limita o número de caracteres para 15
      if (tel.length > 15) {
        tel = tel.substring(0, 15);
      }

      $(this).val(tel);
    });
  });
</script>´
<script src="../js/showImage.js"></script>