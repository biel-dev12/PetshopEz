<?php
// Configurações do banco de dados (substitua com suas próprias configurações)
$dbHost = 'localhost';
$dbName = 'teste-pedidos';
$dbUser = 'root';
$dbPass = '';

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

$query = "SELECT * FROM orders WHERE status = 'Pendente'";
$stmt = $pdo->prepare($query);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($orders);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receba o ID do pedido e a ação
    $orderId = $_POST['order_id'];
    $action = $_POST['action'];
    
    // Atualize o status do pedido no banco de dados com base na ação
    if ($action === 'aceitar') {
        // Atualize o status para "Aceito"
        // Você precisará implementar essa parte com base na sua estrutura de banco de dados
        // Use SQL para atualizar o status do pedido com o ID fornecido
    } elseif ($action === 'recusar') {
        // Atualize o status para "Recusado"
        // Você precisará implementar essa parte com base na sua estrutura de banco de dados
        // Use SQL para atualizar o status do pedido com o ID fornecido
    }
    
    // Responda com uma mensagem de sucesso em JSON
    echo json_encode(['message' => 'Status atualizado com sucesso.']);
}
?>
