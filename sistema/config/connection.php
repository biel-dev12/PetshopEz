<?php
// $servername = "localhost:3306";
// $username = "ezpets_admin";
// $password = "ezpets@admin";
// $dbname = "ezpets_db";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ezpets_db";

try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    echo "Erro de Conexão: A conexão falhou: ". $e->getMessage();
}catch(Exception $e){
    echo "Erro genérico: ". $e->getMessage();
}

?>
