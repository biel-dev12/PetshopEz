<?php

// echo $_SESSION["idps"];
$pendStatus = "pendente";

// Select Pedidos
$stmt = $conn->prepare("SELECT * FROM tb_order WHERE cd_petshop = :idps AND ds_status = :pendStatus");
$stmt->bindParam(":idps", $_SESSION["idps"]);
$stmt->bindParam(":pendStatus", $pendStatus);
$stmt->execute();

$contOrder = 0;
$contPedidosPorCliente = array();

if ($stmt->rowCount() > 0) {
?>
    <!-- Seção de Pedidos Pendentes -->
    <div class="col-md-4">
        <div class="card h-100 card-orders-bg">
            <div class="orders container-fluid rounded" style="max-height: 100vh; overflow-y: auto">
                <h2 class="text-center pt-2 border-bottom border-dark mb-2">
                    Pedidos Pendentes
                </h2>
                <ul class="list-group" id="pending-orders">
                    <?php
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $contOrder++;
                        $stmt2 = $conn->prepare("SELECT * FROM tb_user WHERE id_user = :cd_user");
                        $stmt2->bindParam(":cd_user", $row["cd_user"]);
                        $stmt2->execute();

                        if ($stmt2->rowCount() > 0) {
                            $user = $stmt2->fetch(PDO::FETCH_ASSOC);
                            $stmt3 = $conn->prepare("SELECT * FROM tb_user_address WHERE cd_user_id = :cd_user");
                            $stmt3->bindParam(":cd_user", $user["id_user"]);
                            $stmt3->execute();

                            if ($stmt3->rowCount() > 0) {
                                $userAddress = $stmt3->fetch(PDO::FETCH_ASSOC);
                                $stmt4 = $conn->prepare("SELECT * FROM tb_user_cep WHERE id_user_cep = :id_cep");
                                $stmt4->bindParam(":id_cep", $userAddress["cd_cep_user"]);
                                $stmt4->execute();

                                if ($stmt4->rowCount() > 0) {
                                    $cepInfo = $stmt4->fetch(PDO::FETCH_ASSOC);
                                    $cep = $cepInfo["cd_user_cep"];
                    ?>
                                    <li class="card-body card-orders text-white rounded d-flex flex-column my-1" id="order-<?php echo $row["id_order"] ?>" onclick="showOrderDetails(<?php echo $row['id_order']; ?>)">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="card-title num-order">Pedido #<?php echo $contOrder; ?></h6>
                                            <h6 class="card-title">Status: <?php echo $row["ds_status"]; ?></h6>
                                        </div>
                                        <div class="d-flex justify-content-around mb-2">
                                            <h5 class="card-text border-end pe-3">Cliente: <?php echo $user["nm_user"]; ?></h5>
                                            <h5 class="card-text">Hora do Pedido: <?php echo substr($row["hr_order"], 0, 5); ?></h5>
                                        </div>
                                        <form class="buttons-order d-flex justify-content-center align-items-center border-top pt-2 gap-3" id="buttons-order-<?php echo $row["id_order"]; ?>">
                                            <button class="btn btn-success accept">Aceitar</button>
                                            <button class="btn btn-danger refuse">Recusar</button>
                                            <button class="btn btn-primary delivery d-none">Em Trânsito</button>
                                            <button class="btn btn-success completed d-none">Entregue</button>
                                        </form>
                                    </li>
                    <?php
                                }
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Seção de Detalhes do Pedido -->
    <div class="col-md-8">
        <div class="open-orders">
            <h2 class="text-center pt-2 border-bottom border-dark mb-2">
                Detalhes do Pedido
            </h2>
            <div id="order-details">
                <?php
                // Reset do statement para o mesmo conjunto de resultados
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Restante do código para exibir detalhes do pedido
                ?>
                    <section class="desc-order" id="desc-order-<?php echo $row['id_order'] ?>" style="display: none;">
                        <div class="alert alert-dark" role="alert">
                            <div>
                                <p>Pedido #<?php echo $contOrder ?> - </p>
                                <p>Hora do Pedido: <?php echo substr($row["hr_order"], 0, 5); ?> - </p>
                                <p>Status: <?php echo $row["ds_status"]; ?></p>
                            </div>
                            <a href=""><i class="bi bi-whatsapp"></i></a>
                        </div>
                        <div class="card datas-client">
                            <p class="">Cliente: <span class="dt-info"><?php echo $user["nm_user"]; ?></span><span class="qt-orders badge ms-1"> <?php echo $contPedidosPorCliente[$user["id_user"]]; ?>° Pedido</span></p>

                            <!-- Restante do código para exibir detalhes do cliente e endereço -->

                            <p class="">Endereço:
                                <span class="dt-info" id="streetSpan_<?php echo $user["id_user"]; ?>"></span>
                                <span class="dt-info" id="numberSpan_<?php echo $user["id_user"]; ?>"></span>
                                <span class="dt-info" id="neighborhoodSpan_<?php echo $user["id_user"]; ?>"></span>
                                <span class="dt-info" id="citySpan_<?php echo $user["id_user"]; ?>"></span>
                            </p>
                            <p>Complemento: <span class="dt-info"></span></p>
                            <?php
                            // Select items
                            $stmt5 = $conn->prepare("SELECT * FROM tb_item WHERE cd_order = :cd_order");
                            $stmt5->bindParam(":cd_order", $row['id_order']);
                            $stmt5->execute();

                            ?>
                            <div class="card card-itens">
                                <h5 class="card-header mb-3">Itens do Pedido</h5>
                                <?php

                                if ($stmt5->rowCount() > 0) {
                                    while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
                                        // Select infos do produto
                                        $stmt6 = $conn->prepare("SELECT * FROM tb_product WHERE id_pdc = :id_pdc");
                                        $stmt6->bindParam(":id_pdc", $row5["cd_pdc"]);
                                        $stmt6->execute();
                                        if ($stmt6->rowCount() > 0) {
                                            while ($produto = $stmt6->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                                <div class="card-body px-4 py-0 mb-4" style="font-size: 1.2rem;">
                                                    <p class="border-bottom"><span class="me-2"><?php echo $row5["qt_item"] . " x "; ?></span><?php echo $produto["nm_pdc"]; ?> - <span class="vl-item"><?php echo "R$ " . $produto["vl_pdc"]; ?></span>
                                                        <!-- <hr> -->
                                                    </p>
                                                </div>
                                <?php       }
                                        }
                                    }
                                } ?>
                                 <div class="card-footer">
                                            <p>Subtotal: <span>R$ 170,00</span></p>
                                            <p>Taxa de Entrega: <span>R$ 4,00</span></p>
                                            <p>Total: <span class="total-order">R$ 174,00</span></p>
                                            <p>Observaçôes: <span class="obs-order"></span></p>
                                        </div>
                            </div>
                    </section>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
<script>
    function showOrderDetails(orderId) {
        // Oculta todos os detalhes do pedido
        var orderDetails = document.querySelectorAll('.desc-order');
        orderDetails.forEach(function(detail) {
            detail.style.display = 'none';
        });

        // Exibe os detalhes do pedido correspondente
        var selectedOrderDetail = document.getElementById('desc-order-' + orderId);
        if (selectedOrderDetail) {
            selectedOrderDetail.style.display = 'block';
        }
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        updateAddressInfo("<?php echo $cep; ?>", "<?php echo $user["id_user"]; ?>", "<?php echo $userAddress["ds_num"]; ?>");
    });

    function updateAddressInfo(cep, user_id, number) {
        var script = document.createElement('script');
        script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback_' + user_id;
        document.body.appendChild(script);

        document.getElementById('numberSpan_' + user_id).innerText = ', ' + number;
    }

    // Função de callback para atualizar os campos de endereço
    function meu_callback_<?php echo $user["id_user"]; ?>(conteudo) {
        if (!("erro" in conteudo)) {
            document.getElementById('streetSpan_<?php echo $user["id_user"]; ?>').innerText = conteudo.logradouro;
            document.getElementById('neighborhoodSpan_<?php echo $user["id_user"]; ?>').innerText = ' - ' + conteudo.bairro;
            document.getElementById('citySpan_<?php echo $user["id_user"]; ?>').innerText = '(' + conteudo.localidade + ')';
        } else {
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
</script>