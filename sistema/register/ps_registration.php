<?php
if(!empty($_POST && ))
{
	$name = $_POST['boss_name'];
	$cpf = $_POST['cpf'];
	$email = $_POST['email'];
    $rg =  $_POST['rg'];
    $tel = $_POST['tel'];

    //step 2
	
    $cnpj = $_POST['cnpj'];
	$corp_name = $_POST['corpName'];
    $fs_name=$_POST['fantasy-name'];
    
    //step 3
    $cep=$_POST['cep'];
	$street=$_POST['street'];
    $neighboor=$_POST['neighboor'];
    $hs_number=$_POST['number'];
    $uf = $_POST['state'];
    $town = $_POST['city'];
    $state = $_POST['state'];

    //step 4
    $passw=$_POST['confirm-passw']

    include_once('../configs/conexao.php');

    try 
    {

        $stmt = $conn->prepare("INSERT INTO tb_legal_responsable( nm_lr, cd_lr_cpf, cd_lr_rg, nm_lr_email, cd_lr_tel)
        values :nick, :cpf, :rg, :email, :tel)")

        $stmt->bindParam(':nome', $name);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':rg', $rg);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tel', $tel);

        $stmt->execute();
    }

    try{ 

        $stmt = $conn->prepare("INSERT INTO tb_pethshop(cd_cnpj, nm_corporate, nm_fantasy, nm_ps_email, cd_ps_password, cd_ps_tel, img_ps, cd_ps_cep, cd_ps_number, cd_lr)
        values :cnpj, :cp_name, fs_name, :email, :passw, :tel, :img, :cep, :num, :id_lr)")

        $stmt->bindParam(':cnpj', $cnpj);
        $stmt->bindParam(':cp_name', $corp_name);
        $stmt->bindParam(':fs_name', $fs_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':passw', $passw);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':img', $img);
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':num', $hs_number);
        $stmt->bindParam(':id_lr', $lr='cd_lr');
        $stmt->execute();
    }

    try
    {

        $stmt = $conn->prepare("INSERT INTO tb_ps_neighboor(nm_neighboor, cd_ps_town) 
        values :nm_neigh, :id_town)")

        $stmt->bindParam(':nm_neigh', $neighboor);
        $stmt->bindParam(':id_town', $id_town='cd_ps_town');
        $stmt->execute();
    }


    try
    {
        $stmt = $conn->prepare("INSERT INTO tb_ps_uf(sg_uf) 
        values :uf )")

        $stmt->bindParam(':uf', $uf);
        $stmt->execute();

    }

    try
    {
        $stmt = $conn->prepare("INSERT INTO tb_ps_town(nm_town, cd_ps_uf) 
        values :town, :id_uf )")

        $stmt->bindParam(':town', $town);
        $stmt->bindParam(':id_uf', $id_uf='cd_ps_uf');
        $stmt->execute();

    }

    catch(PDOException $e) 
    {
        echo "Erro ao cadastrar: " . $e->getMessage();
    }
      $conn = null;
  }


