<?php
include_once('../sistema/config/connection.php');
include_once('../dashboard-pages/my-products.php'); 

if(isset($_POST['new-nm'], $_POST['new-cd'], $_POST['new-vl'], $_POST['new-ds'], $_POST['new-categ'])) {
    try {
        $dir = "img/prod/";
        // diretorio para as imagens
        date_default_timezone_set('America/Sao_Paulo');
        $img = $_FILES['new-img']; 
        $ext = strtolower(substr($img['name'],-4)); //Pegando extens達o do arquivo 
        $new_name = date("Y.m.d-H.i.s"). "upd" . $ext; //Definindo um novo nome para o arquivo 
        move_uploaded_file($img['tmp_name'], $dir.$new_name); //Fazer upload do arquivo 
        $caminhoIMG = $dir.$new_name;

        $name= $_POST['new-nm'];
        $cd= $_POST['new-cd'];
        $vl= $_POST['new-vl'];
        $desc= $_POST['new-ds'];
        $idCateg= $_POST['new-categ'];
        $_SESSION["id_pdc"] = $idpdc;

        $sql = $conn->prepare("SELECT id_pdc FROM tb_product;");
        $sql->execute();
        $result = $sql->fetch();
        $_SESSION["id_pdc"] = $result["id_pdc"];
        
        // Verifique se o novo valor de cd_class existe em tb_class antes de prosseguir
        $stmtCheckClass = $conn->prepare("SELECT COUNT(*) as count FROM tb_class WHERE id_class = :new_categ;");
        $stmtCheckClass->bindParam(':new_categ', $idCateg);
        $stmtCheckClass->execute();
        $resultCheckClass = $stmtCheckClass->fetch();

        if ($resultCheckClass['count'] > 0) {
            // O novo valor de cd_class existe em tb_class, ent達o podemos prosseguir
            $stmt = $conn->prepare("UPDATE tb_product SET nm_pdc = :new_nm_prod, ds_pdc = :new_ds, vl_pdc = :new_vl, img_pdc = :new_img, cd_pdc = :new_cd_prod, cd_class = :new_categ WHERE id_pdc = :id_pdc;");
        
            $stmt->bindParam(':new_nm_prod', $name); 
            $stmt->bindParam(':new_ds', $desc); 
            $stmt->bindParam(':new_vl', $vl);  
            $stmt->bindParam(':new_img', $caminhoIMG); 
            $stmt->bindParam(':new_cd_prod', $cd); 
            $stmt->bindParam(':new_categ', $idCateg);  
            $stmt->bindParam(':id_pdc', $_SESSION["id_pdc"]);  
          
            $stmt->execute();
    /*        
        echo $idpdc;
		$delete = $conn->prepare("DELETE FROM tb_product WHERE id_pdc=". $_SESSION['id_pdc']."");
		$delete->execute();
		echo "<script> alert('deletou');</script>";
    */
        } 
        else {
            // O novo valor de cd_class não existe em tb_class
            echo "
                <script>
                    alert('Erro: O novo valor de cd_class não existe em tb_class.');
                    location.href = '../dashboard-pages/my-products.php';
                </script>";
        }
    } catch (PDOException $e) {
        echo "Erro ao cadastrar produto: " . $e->getMessage();
    }

    $conn = null;
    
    echo "
        <script>
            alert('Produto atualizado com sucesso!');
            location.href = '../dashboard-pages/my-products.php';
        </script>";
}
?>
