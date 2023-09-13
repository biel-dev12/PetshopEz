document.addEventListener("DOMContentLoaded", function () {
  const statusIcon = document.querySelector(".status-icon");
  const shopStatus = document.querySelector(".shop-status-card");
  const shopStatusTxt = shopStatus.querySelector(".card-body");
  const toggleStatusBtn = document.getElementById("toggleStatusBtn");
  const statusIconElement = statusIcon.querySelector("i"); // Seleciona o elemento <i> dentro de "status-icon"

  // Função para alternar o status entre online e offline
  function toggleStatus() {
    statusIcon.classList.toggle("status-online");
    shopStatus.classList.toggle("status-online");

    // Verifica se a loja está fechada
    if (!statusIcon.classList.contains("status-online")) {
      shopStatusTxt.textContent = "Loja fechada";
      // Troca a classe do ícone para "bi-ban" quando a loja está fechada
      statusIconElement.classList.remove("bi-check2-circle");
      statusIconElement.classList.add("bi-ban");
    } else {
      shopStatusTxt.textContent = "Seu Pet Shop está aberto!";
      // Restaura a classe do ícone para "bi-check2-circle" quando a loja está aberta
      statusIconElement.classList.remove("bi-ban");
      statusIconElement.classList.add("bi-check2-circle");
    }
  }

  // Adicione um ouvinte de evento ao botão para alternar o status
  toggleStatusBtn.addEventListener("click", toggleStatus);
});
