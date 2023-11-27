<?php
$pendStatus = "pendente";

// Select Pedidos Pendentes
$stmt = $conn->prepare("
    SELECT 
        o.id_order, 
        o.dt_us_order, 
        o.hr_delivery, 
        o.hr_order, 
        o.vl_order_subtotal, 
        o.cd_petshop, 
        o.cd_user, 
        o.cd_rate, 
        o.ds_status, 
        u.nm_user, 
        ua.cd_cep_user, 
        ua.ds_num,
        GROUP_CONCAT(i.qt_item, '|', p.nm_pdc, '|', p.vl_pdc ORDER BY i.id_item ASC SEPARATOR ', ') AS items
    FROM tb_order o
    INNER JOIN tb_user u ON o.cd_user = u.id_user
    LEFT JOIN tb_user_address ua ON u.id_user = ua.cd_user_id
    LEFT JOIN tb_item i ON o.id_order = i.cd_order
    LEFT JOIN tb_product p ON i.cd_pdc = p.id_pdc
    WHERE o.ds_status = :pendStatus AND o.cd_petshop = :idps
    GROUP BY o.id_order
    ORDER BY o.id_order DESC
");
$stmt->bindParam(":pendStatus", $pendStatus);
$stmt->bindParam(":idps", $_SESSION["idps"]);
$stmt->execute();

$contOrder = 0;
$contPedidosPorCliente = array();

if ($stmt->rowCount() > 0) {
?>
    <!-- Seção de Pedidos Pendentes -->
    <div class="col-md-8">
        <div class="card h-100 card-orders-bg">
            <div class="orders container-fluid rounded" style="max-height: 100vh; overflow-y: auto">
                <h2 class="text-center pt-2 border-bottom border-dark mb-2 bg-white">
                    Pedidos Pendentes
                </h2>
                <ul class="list-group" id="pending-orders">
                    <?php
                    while ($rowPending = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
                            <form class="buttons-order d-flex justify-content-center align-items-center border-top pt-2 gap-3" id="buttons-order-<?php echo $rowPending["id_order"]; ?>">
                                <button class="btn btn-success accept fs-5">Aceitar</button>
                                <button class="btn btn-danger refuse fs-5">Recusar</button>
                                <button class="btn btn-primary delivery d-none fs-5">Em Trânsito</button>
                                <button class="btn btn-success completed d-none fs-5">Entregue</button>
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
                                                                    <span class="dt-info" id="streetSpan_<?php echo $rowPending["id_order"]; ?>"></span>
                                                                    <span class="dt-info" id="numberSpan_<?php echo $rowPending["id_order"]; ?>"></span>
                                                                    <!-- Adicione outros campos de endereço conforme necessário -->
                                                                </p>
                                                                <p>Complemento: <span class="dt-info"></span></p>
                                                                <div class="card card-itens">
                                                                    <h5 class="card-header mb-3">Itens do Pedido</h5>
                                                                    <div class="card-body px-4 py-0 mb-4" style="font-size: 1.2rem;">
                                                                        <!-- Exibir os itens do pedido -->
                                                                        <?php
                                                                        $itemsArray = explode(", ", $rowPending["items"]);
                                                                        foreach ($itemsArray as $item) {
                                                                            list($qt_item, $nm_pdc, $vl_pdc) = explode("|", $item);
                                                                        ?>
                                                                            <p><span class="qt-item"><?php echo $qt_item; ?></span> <span class="nm-pdc"><?php echo $nm_pdc; ?></span> - <span class="vl-item">R$ <?php echo number_format($vl_pdc, 2, ',', '.'); ?></span></p>
                                                                            <hr>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <div class="card-footer">
                                                                        <p>Subtotal: <span>R$ 170,00</span></p>
                                                                        <p>Taxa de Entrega: <span>R$ 4,00</span></p>
                                                                        <p>Total: <span class="total-order">R$ 174,00</span></p>
                                                                        <p>Observaçôes: <span class="obs-order"></span></p>
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
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
<?php
}
?>