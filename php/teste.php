<?php // get_orders.php

// Inclua sua lógica de conexão ao banco de dados aqui

// Selecione os pedidos com status "pendente", "aceito" e "em trânsito"
$statusList = ["Pendente", "Aceito", "Em Trânsito"];

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

$inStatus = implode(', ', $statusList);

$stmt->bindParam(":inStatus", $inStatus);
$stmt->bindParam(":idps", $_SESSION["idps"]);
$stmt->execute();

$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Saída em JSON
header('Content-Type: application/json');
echo json_encode($orders);
exit;
 ?> 