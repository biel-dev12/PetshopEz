<?php
session_start();
include_once('sistema/config/connection.php');

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dados da Empresa</title>
  <!-- Link CSS -->
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="shortcut icon" href="./imgs/favicon-cropped.svg" type="image/x-icon" />

  <!-- Bootstrap5 link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
</head>

<body>
  <div class="main-content2">
    <header id="header">
      <nav id="nav-header2">
        <a href="./index.php" class="arrowBac-link">
          <img src="./imgs/chevron-left.svg" alt="Icone Voltar" class="arrowBack" />
        </a>
        <a href="" class="link-logo">
          <img src="./imgs/logo-ezpets.svg" alt="Logo EzPets" class="logo" />
        </a>
      </nav>
    </header>
    <main id="main-section2">
      <form id="stepForm" class="needs-validation" method="post">
        <!-- Step 1 -->
        <div class="form-step step1">
          <h2>Informações do Responsável</h2>
          <div class="inps">
            <input type="text" name="boss-name" id="boss-name" value="<?php echo $_SESSION['namec'];?>"/>
            <label for="boss-name">Nome do responsável:</label>
          </div>
          <div class="inps">
            <input type="text" name="cpf" id="cpf" onblur="validarCPF(this.value);" />
            <label for="cpf">CPF:</label>
          </div>
          <div class="inps">
            <input type="email" name="email" id="email" value="<?php echo $_SESSION['emailc'];?>"/>
            <label for="email">E-mail:</label>
          </div>
          <div class="inps">
            <input type="text" name="tel" id="tel" value="<?php echo $_SESSION['telc'];?>"/>
            <label for="tel">Telefone/Celular:</label>
          </div>
          <div class="btns-step">
            <button type="button" class="next-button">Continuar</button>
          </div>
        </div>
        <!-- Step 2 -->
        <div class="form-step step2">
          <h2>Informações Empresariais</h2>
          <div class="inps">
            <input type="text" name="cnpj" id="cnpj" onblur="validarCNPJ(this.value);" />
            <label for="cnpj">CNPJ:</label>
          </div>
          <div class="inps">
            <input type="text" name="corpName" id="corpName" />
            <label for="corpName">Razão Social:</label>
          </div>
          <div class="inps">
            <input type="text" name="fantasy-name" id="fantasy-name" placeholder="Ex: Pet shop do João" />
            <label for="fantasy-name">Nome Fantasia:</label>
          </div>
          <div class="btns-step">
            <button type="button" class="prev-button">Voltar</button>
            <button type="button" class="next-button">Continuar</button>
          </div>
        </div>
        <!-- Step 3 -->
        <div class="form-step step3">
          <h2>Endereço do Pet Shop</h2>
          <div class="inps">
            <input type="text" name="cep" id="cep" onblur="pesquisacep(this.value);" />
            <label for="cep">CEP:</label>
          </div>
          <div class="inps">
            <input type="text" name="street" id="street" disabled />
            <label for="street">Rua:</label>
          </div>
          <div class="inps small-inps">
            <div class="box-small-inps">
              <input type="text" name="neighborh" id="neighborh" disabled>
              <label for="neighborh">Bairro</label>
            </div>
            <div class="box-small-inps">
              <input type="text" name="number" id="number" />
              <label for="number">Número</label>
            </div>
          </div>
          <div class="inps small-inps">
            <div class="box-small-inps">
              <input type="text" name="state" id="state" disabled />
              <label for="state">Estado</label>
            </div>
            <div class="box-small-inps">
              <input type="text" name="city" id="city" disabled />
              <label for="city">Cidade</label>
            </div>
          </div>
          <div class="btns-step">
            <button type="button" class="prev-button">Voltar</button>
            <button type="button" class="next-button">Continuar</button>
          </div>
        </div>
        <!-- Step 4 -->
        <div class="form-step step4">
          <h2>Confirme seus dados</h2>
          <div class="box-datas">
            <p class="confirm-boss-name">Nome do responsável</p>
            <hr>
            <p class="confirm-cpf">CPF: </p>
            <hr>
            <p class="confirm-email">E-mail: </p>
            <hr>
            <p class="confirm-tel">Telefone: </p>
            <hr>
            <p class="confirm-fantasy-name">Nome Fantasia: </p>
            <hr>
            <p class="confirm-cnpj">CNPJ:</p>
            <hr>
            <p class="confirm-address">Endereço: </p>
          </div>
          <div class="inps">
            <input type="password" name="passw" id="passw">
            <label for="passw">Crie uma senha para sua conta:</label>
          </div>
          <div class="inps">
            <input type="password" name="confirm-passw" id="confirm-passw">
            <label for="confirm-passw">Confirme sua senha:</label>
          </div>
          <div class="btns-step">
            <button type="button" class="prev-button">Voltar</button>
            <button type="submit" class="submit-button">Enviar</button>
          </div>
        </div>
      </form>
      <div class="bg-pets"></div>
    </main>
    <div class="modal" id="modalForm" style="display: none;">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border border-3 border-primary">
          <div class="modal-body text-center">
            <h1 class="mb-3">Ebaa! A <span id="span-name"></span> foi cadastrada com sucesso, agora você faz parte da equipe!</h1>
            <p>Você está sendo encaminhado para a página de <u>login</u>. Entre com seu e-mail e senha.</p>
            <div class="spinner-border text-primary" role="status">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap5 script-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="./js/formCompanyData.js" type="module"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
  <script src="./js/callMaskInputs.js"></script>
  <script src="./js/validateData/searchCep.js"></script>
  <script src="./js/validateData/valCpf.js"></script>
  <script src="./js/validateData/valCnpj.js"></script>

  <?php

  if (!empty($_POST)) {


    $name = $_POST['boss-name'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $rg =  $_POST['rg'];
    $tel = $_POST['tel'];

    //step 2


    $corp_name = $_POST['corpName'];
    $fs_name = $_POST['fantasy-name'];
    $cnpj = $_POST['cnpj'];
    /*
// Validar numero de CNPJ
function validar_cnpj($cnpj) {
    // Verificar se foi informado
  if(empty($cnpj))
    return false;
  // Remover caracteres especias
  $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
  // Verifica se o numero de digitos informados
  if (strlen($cnpj) != 14)
    return false;
      // Verifica se todos os digitos são iguais
  if (preg_match('/(\d)\1{13}/', $cnpj))
    return false;
  $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    for ($i = 0, $n = 0; $i < 12; $n += $cnpj[$i] * $b[++$i]);
    if ($cnpj[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
        return false;
    }
    for ($i = 0, $n = 0; $i <= 12; $n += $cnpj[$i] * $b[$i++]);
    if ($cnpj[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
        return false;
    }
  return true;
}
*/
    //step 3
    $cep = $_POST['cep'];
    $street = $_POST['street'];
    $neighborh = $_POST['neighborh'];
    $hs_number = $_POST['number'];
    $uf = $_POST['state'];
    $town = $_POST['city'];
    $state = $_POST['state'];

    //step 4

    $passw = $_POST['confirm-passw'];
    // $passwH= password_hash($passw, PASSWORD_BCRYPT);
    try {

      $stmt = $conn->prepare("INSERT INTO tb_petshop(nm_corporate, nm_fantasy, cd_cnpj, nm_ps_email, cd_ps_password, cd_ps_tel, img_ps, cd_ps_cep, cd_ps_number, nm_lr, cd_cpf_lr, cd_tel_lr)
          values (:cp_name, :fs_name, :cnpj, :email, :passw, :tel, :img, :cep, :num, :lr_name, :lr_cpf, :lr_tel)");


      $stmt->bindParam(':cp_name', $corp_name);
      $stmt->bindParam(':fs_name', $fs_name);
      $stmt->bindParam(':cnpj', $cnpj);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':passw', $passw);
      $stmt->bindParam(':tel', $tel);
      $stmt->bindParam(':img', $img);
      $stmt->bindParam(':cep', $cep);
      $stmt->bindParam(':num', $hs_number);
      $stmt->bindParam(':lr_name', $name);
      $stmt->bindParam(':lr_cpf', $cpf);
      $stmt->bindParam(':lr_tel', $tel);
      $stmt->execute();
  ?> <script>
        location.href = "index.php";
      </script><?php
                // die("Nao ignore");
              } catch (PDOException $e) {
                echo "Erro ao cadastrar: " . $e->getMessage();
              }
              $conn = null;
            }
                ?>

</body>

</html>