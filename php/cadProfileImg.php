<?php
include_once('../sistema/config/connection.php');
include_once('../dashboard-pages/profile-config.php'); 

if(isset($_FILES['img-pf']) && !empty($_POST)){
    try {
        $dir = "img/profile/";
        // diretorio para as imagens
        date_default_timezone_set('America/Sao_Paulo');
        $img = $_FILES['img-pf']; 
        $ext = strtolower(substr($img['name'],-4)); //Pegando extensão do arquivo 
        $new_name = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo 
        move_uploaded_file($img['tmp_name'], $dir.$new_name); //Fazer upload do arquivo 
        $caminhoIMG = $dir.$new_name;

        $stmt= $conn->prepare("INSERT INTO tb_petshop(img_ps)
        VALUES (:img_ps)");

      $stmt->bindParam(':img_ps', $caminhoIMG);
      
      $stmt->execute();
        
                        
        }
        catch (PDOException $e) {
                echo "Erro ao cadastrar imagem: " . $e->getMessage();
        }
              $conn = null;
    
    
    echo"
        <script>
        console.log('fpo');
            location.href = '../dashboard-pages/profle-config.php'
        </script>";
   }
   
   
?>
 