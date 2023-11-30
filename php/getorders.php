<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "Aceitar") {
    $orderId = $_POST["order_id"];
    $currentStatus = $_POST["current_status"];

    // Lógica para atualizar o status no banco de dados
    if ($currentStatus == "Pendente") {
        $newStatus = "Aceito";
    } elseif ($currentStatus == "Aceito") {
        $newStatus = "Em Trânsito";
    } elseif ($currentStatus == "Em Trânsito") {
        $newStatus = "Entregue";
    } else {
        $newStatus = $currentStatus; // Manter o status atual se já estiver "Entregue" ou outro status
    }

    // Atualize o banco de dados com o novo status
    $updateStmt = $conn->prepare("UPDATE tb_order SET ds_status = :newStatus WHERE id_order = :orderId");
    $updateStmt->bindParam(":newStatus", $newStatus);
    $updateStmt->bindParam(":orderId", $orderId);
    $updateStmt->execute();
    echo '<script> location.href = "../dashboard-pages/manager.php"; </script>';
    // Atualize o texto do botão com base no novo status
   
}
?>

<?php
// Selecione os pedidos com status "pendente", "aceito" e "em trânsito"
$statusList = ["Pendente", "Aceito", "Em Trânsito"];

// Select Pedidos Pendentes, Aceitos e Em Trânsito
$stmt = $conn->prepare("
    SELECT 
        o.id_order, 
        o.dt_us_order, 
        o.hr_delivery, 
        o.hr_order, 
        o.vl_order_subtotal, 
        ps.vl_delivery,
        o.cd_petshop, 
        o.cd_user, 
        o.cd_rate, 
        o.ds_status, 
        o.ds_obs,
        u.nm_user, 
        ua.cd_cep_user, 
        ua.ds_num,
        ua.nm_street,
        ua.nm_neighbor,
        ua.nm_city,
        ua.uf_user,
        ua.ds_complemento,
        GROUP_CONCAT(i.qt_item, '|', p.nm_pdc, '|', p.vl_pdc ORDER BY i.id_item ASC SEPARATOR ', ') AS items
    FROM tb_order o
    INNER JOIN tb_user u ON o.cd_user = u.id_user
    LEFT JOIN tb_user_address ua ON u.id_user = ua.cd_user_id
    LEFT JOIN tb_item i ON o.id_order = i.cd_order
    LEFT JOIN tb_product p ON i.cd_pdc = p.id_pdc
    LEFT JOIN tb_petshop ps ON o.cd_petshop = ps.id_petshop
    WHERE o.ds_status = 'Pendente' OR o.ds_status = 'Aceito' OR o.ds_status = 'Em Trânsito' AND o.cd_petshop = :idps
    GROUP BY o.id_order
    ORDER BY o.id_order DESC
");

// Construa os placeholders para os parâmetros
$inStatus = implode(', ', $statusList);

// $stmt->bindParam(":inStatus", $inStatus);
$stmt->bindParam(":idps", $_SESSION["idps"]);
$stmt->execute();
$newStatus = isset($newStatus) ? $newStatus : ''; 

$contOrder = 0;
$contPedidosPorCliente = array();
?>
<!-- Seção de Pedidos Pendentes -->
<div class="col-md-8">
    <div class="card h-100 card-orders-bg">
        <div class="orders container-fluid rounded" style="max-height: 100vh; overflow-y: auto">
            <h2 class="text-center pt-2 border-bottom border-dark mb-2 bg-white">
                Pedidos Pendentes
            </h2><?php
                    if ($stmt->rowCount() > 0) {
                    ?>
                <ul class="list-group" id="pending-orders">
                    <?php
                        while ($rowPending = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $subtotal = 0;
                            $taxaEntrega = $rowPending['vl_delivery'];
                            $total = 0;
                    ?>

                        <li class="card-body card-orders text-white rounded d-flex flex-column my-1">
                            <!-- Seu código para exibir as informações do pedido -->
                            <div class="d-flex justify-content-between align-items-center" data-bs-toggle="modal" data-bs-target="#orderDetailsModal_<?php echo $rowPending["id_order"]; ?>">
                                <h6 class="card-title num-order">Pedido #<?php echo $rowPending["id_order"]; ?></h6>
                                <h6 class="card-title">Status: <?php echo $rowPending["ds_status"]; ?></h6>
                            </div>
                            <div class="d-flex justify-content-around mb-2" data-bs-toggle="modal" data-bs-target="#orderDetailsModal_<?php echo $rowPending["id_order"]; ?>">
                                <h5 class="card-text fs-3">Cliente: <?php echo $rowPending["nm_user"]; ?></h5>
                                <h5 class="card-text fs-3">Hora do Pedido: <?php echo substr($rowPending["hr_order"], 0, 5); ?></h5>
                            </div>
                            <!-- Botões com base no status do pedido -->
                            <form class="buttons-order d-flex justify-content-center align-items-center border-top pt-2 gap-3" id="form-order-<?php echo $rowPending["id_order"]; ?>" method="POST" action="#">
                <input type="hidden" name="order_id" value="<?php echo $rowPending["id_order"]; ?>">
                <input type="hidden" name="current_status" value="<?php echo $rowPending["ds_status"]; ?>">
                <button class="btn btn-success fs-5" type="submit" name="action" value="Aceitar" id="button-order-<?php echo $rowPending["id_order"]; ?>">
                    <?php
                    // Lógica para definir o texto do botão com base no status
                    if ($rowPending["ds_status"] == "Pendente") {
                        echo "Aceitar";
                    } elseif ($rowPending["ds_status"] == "Aceito") {
                        echo "Em Trânsito";
                    } elseif ($rowPending["ds_status"] == "Em Trânsito") {
                        echo "Entregue";
                    } else {
                        echo $rowPending["ds_status"]; // Manter o status atual se já estiver "Entregue" ou outro status
                    }
                    ?>
                </button>
            </form>


                            <!-- Modal para Detalhes do Pedido -->
                            <div class="modal fade" id="orderDetailsModal_<?php echo $rowPending["id_order"]; ?>" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content text-black">
                                        <div class="modal-header">
                                            <h2 class="mt-1">
                                                Detalhes do Pedido
                                            </h2>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="background-color: #F5F5F5;">
                                            <div class="col-md-12">
                                                <div class="open-orders">
                                                    <div id="order-details">
                                                        <section class="desc-order" id="desc-order1">
                                                            <div class="alert alert-dark" role="alert">
                                                                <div class="fs-4">
                                                                    <p>Pedido #<?php echo $rowPending["id_order"]; ?> - </p>
                                                                    <p>Hora do Pedido: <?php echo substr($rowPending["hr_order"], 0, 5); ?> - </p>
                                                                    <p>Status: <?php echo $rowPending["ds_status"]; ?></p>
                                                                </div>
                                                                <a href=""><i class="bi bi-whatsapp"></i></a>
                                                            </div>
                                                            <div class="card datas-client fs-5">
                                                                <p class="">Cliente: <span class="dt-info"><?php echo $rowPending["nm_user"]; ?></span></span></p>
                                                                <p class="">Endereço:
                                                                    <span class="dt-info"><?php echo $rowPending['nm_street'] ?>, </span>
                                                                    <span class="dt-info"><?php echo $rowPending['ds_num'] ?> - </span>
                                                                    <span class="dt-info"><?php echo $rowPending['nm_neighbor'] ?> </span>
                                                                    <span class="dt-info">( <?php echo $rowPending['nm_city'] ?>)</span>
                                                                </p>
                                                                <p>Complemento: <span class="dt-info"></span><?php echo $rowPending['ds_complemento'] ?></p>
                                                                <div class="card card-itens">
                                                                    <h5 class="card-header mb-3">Itens do Pedido</h5>
                                                                    <div class="card-body px-4 py-0 mb-4" style="font-size: 1.2rem;">
                                                                        <!-- Exibir os itens do pedido -->
                                                                        <?php
                                                                        $itemsArray = explode(", ", $rowPending["items"]);
                                                                        foreach ($itemsArray as $item) {
                                                                            list($qt_item, $nm_pdc, $vl_pdc) = explode("|", $item);
                                                                            $subtotal += $qt_item * $vl_pdc;
                                                                        ?>
                                                                            <p><span class="qt-item"><?php echo $qt_item; ?> x</span> <span class="ms-1 nm-pdc"><?php echo $nm_pdc; ?></span> - <span class="vl-item">R$ <?php echo number_format($vl_pdc, 2, ',', '.'); ?></span></p>
                                                                            <hr>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <div class="card-footer">
                                                                        <p>Subtotal: <span>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></span></p>
                                                                        <p>Taxa de Entrega: <span>R$ <?php echo number_format($taxaEntrega, 2, ',', '.'); ?></span></p>
                                                                        <?php
                                                                        $total = $subtotal + $taxaEntrega; // Calcule o total
                                                                        ?>
                                                                        <p>Total: <span class="total-order">R$ <?php echo number_format($total, 2, ',', '.'); ?></span></p>
                                                                        <p>Observaçôes: <span class="obs-order"><?php echo $rowPending['ds_obs'] ?></span></p>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                            <!-- Adicione mais botões ou ações conforme necessário -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Restante do seu código para exibir informações do pedido -->
                        </li><?php
                            }
                                ?>
                </ul>
        </div>
    </div>
</div>
<?php
                    }
?>