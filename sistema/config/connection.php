<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "ezpets_db";

try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//echo "<h1>Conexao estabelecida!</h1>";

}catch(PDOException $e){
    echo "Erro de Conexão: A conexão falhou: ". $e->getMessage();
}catch(Exception $e){
    echo "Erro genérico: ". $e->getMessage();
}

?>
<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "ezpets_db";

try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//echo "<h1>Conexao estabelecida!</h1>";

}catch(PDOException $e){
    echo "Erro de Conexão: A conexão falhou: ". $e->getMessage();
}catch(Exception $e){
    echo "Erro genérico: ". $e->getMessage();
}

?>
