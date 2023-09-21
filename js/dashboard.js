document.addEventListener("DOMContentLoaded", function () {
  const statusIcon = document.querySelector(".status-icon");
  const shopStatus = document.querySelector(".shop-status-card");
  const shopStatusTxt = shopStatus.querySelector(".card-body");
  const toggleStatusSwitch = document.getElementById("toggleStatusSwitch");
  const statusIconElement = statusIcon.querySelector("i"); // Seleciona o elemento <i> dentro de "status-icon"

  // Função para atualizar o status no card-body
  function updateStatusText(isOnline) {
    if (isOnline) {
      shopStatusTxt.innerHTML = "<u>Seu pet shop está aberto!</u>";
      toggleStatusSwitch.nextElementSibling.textContent = "Fechar pet shop";
      statusIconElement.classList.remove("bi-slash-circle");
      statusIconElement.classList.add("bi-check2-circle");
    } else {
      shopStatusTxt.innerHTML = "<u>Seu pet shop está fechado!</u>";
      toggleStatusSwitch.nextElementSibling.textContent = "Abrir pet shop";
      statusIconElement.classList.remove("bi-check2-circle");
      statusIconElement.classList.add("bi-slash-circle");
    }
  }

  // Função para alternar o status entre online e offline
  function toggleStatus() {
    // Desabilita o switcher enquanto o spinner estiver ativo
  toggleStatusSwitch.disabled = true;
    // Adiciona o spinner loader no "status-icon"
    statusIconElement.classList.add("spinner-border", "spinner-border-sm");
    statusIconElement.classList.remove("bi-check2-circle");
    statusIconElement.classList.remove("bi-slash-circle");

    // Simula uma mudança de status após 2 segundos (você pode ajustar o tempo conforme necessário)
    setTimeout(() => {
      // Remove o spinner loader
      statusIconElement.classList.remove("spinner-border", "spinner-border-sm");

      statusIcon.classList.toggle("status-online");
      shopStatus.classList.toggle("status-online");

      // Verifica se a loja está aberta
      const isOnline = statusIcon.classList.contains("status-online");

      // Atualiza o texto do card-body com base no status
      updateStatusText(isOnline);

      // Reabilita o switcher após 2 segundos
    toggleStatusSwitch.disabled = false;
    }, 2000); // Simula uma mudança de status após 2 segundos (você pode ajustar o tempo conforme necessário)
  }

  // Verifica o status inicial e define o texto do switcher de acordo
  const isInitiallyOnline = statusIcon.classList.contains("status-online");
  updateStatusText(isInitiallyOnline);

  // Adicione um ouvinte de evento ao switch para alternar o status
  toggleStatusSwitch.addEventListener("change", toggleStatus);
});
