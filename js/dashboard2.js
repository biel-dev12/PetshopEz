// Abrir/fechar o menu do sidebar ao clicar no botão
document.getElementById('btn-toggle').addEventListener('click', function() {
    const sidebar = document.getElementById('sidebar');
    const layoutContent = document.querySelector('.layout-content');
    sidebar.classList.toggle('active');
    layoutContent.classList.toggle('active');
  });
  
  // Abrir o menu do sidebar ao passar o mouse
  document.getElementById('sidebar').addEventListener('mouseenter', function() {
    const sidebar = document.getElementById('sidebar');
    const layoutContent = document.querySelector('.layout-content');
    sidebar.classList.add('active');
    layoutContent.classList.add('active');
  });
  
  // Fechar o menu do sidebar ao retirar o mouse
  document.getElementById('sidebar').addEventListener('mouseleave', function() {
    const sidebar = document.getElementById('sidebar');
    const layoutContent = document.querySelector('.layout-content');
    sidebar.classList.remove('active');
    layoutContent.classList.remove('active');
  });
  
  // Atualizar o indicador de status
  function setStatusOnline(online) {
    const indicator = document.getElementById('status-icon');
    if (online) {
      indicator.classList.remove('offline');
      indicator.classList.add('online');
    } else {
      indicator.classList.remove('online');
      indicator.classList.add('offline');
    }
  }
  
  // Exemplo de atualização de status (online/offline)
  let isOnline = true;
  
  document.getElementById('status-icon').addEventListener('click', function() {
    isOnline = !isOnline;
    setStatusOnline(isOnline);
  });
  