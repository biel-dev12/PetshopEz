<!-- Seção de Pedidos Pendentes -->
<div class="col-md-8">
    <div class="card h-100 card-orders-bg">
        <div class="orders container-fluid rounded" style="max-height: 100vh; overflow-y: auto">
            <h2 class="text-center pt-2 border-bottom border-dark mb-2 bg-white">
                Pedidos Pendentes
            </h2>
            <ul class="list-group" id="pending-orders">
                <!-- Lista de pedidos será preenchida dinamicamente pelo script -->
            </ul>
        </div>
    </div>
</div>

<!-- Adicione o script JavaScript/jQuery no final do seu arquivo HTML -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Função para buscar os pedidos via AJAX e atualizar a interface
        function getOrders() {
            $.ajax({
                type: 'GET',
                url: '../php/getorders.php',
                dataType: 'json',
                success: function(orders) {
                    // Limpe a lista de pedidos
                    $('#pending-orders').empty();

                    // Adicione os novos pedidos à lista
                    $.each(orders, function(index, order) {
                        // Crie dinamicamente os elementos HTML para cada pedido
                        var listItem = '<li class="card-body card-orders text-white rounded d-flex flex-column my-1">';
                        listItem += '<div class="d-flex justify-content-between align-items-center" data-bs-toggle="modal" data-bs-target="#orderDetailsModal_' + order.id_order + '">';
                        listItem += '<h6 class="card-title num-order">Pedido #' + order.id_order + '</h6>';
                        listItem += '<h6 class="card-title">Status: ' + order.ds_status + '</h6>';
                        listItem += '</div>';
                        // Adicione mais código aqui para criar os outros elementos do pedido
                        // ...

                        listItem += '</li>';

                        $('#pending-orders').append(listItem);
                    });
                },
                error: function() {
                    alert('Erro ao buscar os pedidos.');
                }
            });
        }

        // Chame a função inicialmente para carregar os pedidos ao carregar a página
        getOrders();

        // Execute a função a cada intervalo de tempo (por exemplo, a cada 30 segundos)
        setInterval(getOrders, 30000); // 30 segundos
    });
</script>
