<?php
include_once('../sistema/config/connection.php');
include_once('../dashboard-pages/my-products.php');
 
 if (!empty($_POST)) {
                $namec = $_POST['nm-categ'];
                $cdps = $_SESSION['idps'];

                try {

                  $checkStmt = $conn->prepare("SELECT COUNT(*) FROM tb_class WHERE nm_class = :cs_name AND cd_ps = :cd_ps");
                  $checkStmt->bindParam(':cs_name', $namec);
                  $checkStmt->bindParam(':cd_ps', $cdps);
                  $checkStmt->execute();
                  $count = $checkStmt->fetchColumn();

                  if ($count > 0) {
                    echo "Categoria já existe. Não é possível cadastrar novamente.";
                  } else {

                    $Stmt = $conn->prepare("INSERT INTO tb_class(nm_class, cd_ps) VALUES (:cs_name, :cd_ps)");
                    $Stmt->bindParam(':cs_name', $namec);
                    $Stmt->bindParam(':cd_ps', $cdps);
                    $Stmt->execute();
                    echo "
            <script>
                location.href = '../dashboard-pages/my-products.php';
            </script>";
                  }
                } catch (PDOException $e) {
                  echo "Erro ao cadastrar produto: " . $e->getMessage();
                }
                finally{
                  $conn = null;
                }
              }
              ?>