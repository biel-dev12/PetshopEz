  // Função para buscar pedidos pendentes do servidor PHP
  function fetchPendingOrders() {
    fetch('backend.php') // Substitua 'backend.php' pela URL correta do seu endpoint PHP
        .then(response => response.json())
        .then(data => {
            // Atualiza a lista de pedidos pendentes com os dados do servidor
            ordersData = data;
            displayPendingOrders();
        })
        .catch(error => {
            console.error('Erro ao buscar pedidos:', error);
        });
}

// Função para exibir pedidos pendentes
function displayPendingOrders() {
    const pendingOrdersList = document.getElementById("pending-orders");
    pendingOrdersList.innerHTML = "";

    ordersData.forEach((order) => {
        const listItem = document.createElement("li");
        listItem.classList.add("list-group-item");
        listItem.textContent = `Pedido #${order.id} - ${order.customer}`;
        listItem.addEventListener("click", () => showOrderDetails(order));
        pendingOrdersList.appendChild(listItem);
    });
}

// Função para exibir detalhes do pedido selecionado
function showOrderDetails(order) {
    const orderDetails = document.getElementById("order-details");
    orderDetails.innerHTML = `
        <h4>Detalhes do Pedido #${order.id}</h4>
        <p><strong>Cliente:</strong> ${order.customer}</p>
        <p><strong>Itens:</strong> ${order.items.join(", ")}</p>
    `;
}

// Inicialização: buscar pedidos pendentes do servidor PHP
fetchPendingOrders();