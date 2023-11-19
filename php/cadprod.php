<?php
session_start();
include_once('../sistema/config/connection.php');
include_once('../dashboard-pages/my-products.php)');
//echo $idps;

if(isset($_FILES['img']) && ($_POST)){
    $dir = "img/prod/";
    // diretorio para as imagens
	date_default_timezone_set('America/Sao_Paulo');
	$img = $_FILES['img']; 
	$ext = strtolower(substr($img['name'],-4)); //Pegando extensão do arquivo 
	$new_name = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo 
	move_uploaded_file($img['tmp_name'], $dir.$new_name); //Fazer upload do arquivo 
	$caminhoIMG = $dir.$new_name;
    
            $name= $_POST['nm_prod'];
            $cd= $_POST['cd_prod'];
            $vl= $_POST['vl_prod'];
            $desc= $_POST['ds_prod'];
            $idps= $_SESSION['idps'];
            $idCateg= $_POST['categ'];
            
            echo $name, $cd, $vl, $desc, $idps, $idCateg, $caminhoIMG;




    

        try {

        $stmt= $conn->prepare("INSERT INTO tb_product(nm_pdc, ds_pdc, vl_pdc, img_pdc, cd_class, cd_ps, cd_pdc)
        values (:pd_name, :ds_pd, :vl_pd, :img_pd, :class, :cps, :cd_pd)");


      $stmt->bindParam(':pd_name', $name);
      $stmt->bindParam(':ds_pd', $desc);
      $stmt->bindParam(':vl_pd', $vl);
      $stmt->bindParam(':img_pd', $caminhoIMG);
      $stmt->bindParam(':cd_pd', $cd);
      $stmt->bindParam(':class',$idCateg);
      $stmt->bindParam(':cps', $idps);  
      
      $stmt->execute();
        
                        
        }
        catch (PDOException $e) {
                echo "Erro ao cadastrar produto: " . $e->getMessage();
        }
              $conn = null;
    
    
    echo"
        <script>
            alert('Cadastro de produto concluída');
            location.href = '../dashboard-pages/my-products.php'
        </script>";
   }
   
   
?>
