function validarCNPJ() {
  const cnpjInput = document.getElementById("cnpj");
  const cnpj = cnpjInput.value.replace(/\D/g, ''); // Remover caracteres não numéricos

  // Verificar se o CNPJ é válido
  if (!validarCNPJFormato(cnpj)) {
      alert("CNPJ inválido. Por favor, insira um CNPJ válido.");
      return;
  }

  // Restante do seu código aqui...
  // Por exemplo, você pode prosseguir com a consulta à API ou qualquer outra ação necessária.

  console.log(`O CNPJ ${cnpj} é válido.`);
}

function validarCNPJFormato(cnpj) {
  // Remover caracteres não numéricos
  cnpj = cnpj.replace(/\D/g, '');

  // Verificar se o CNPJ tem 14 dígitos
  if (cnpj.length !== 14) {
      return false;
  }

  // Verificar se todos os dígitos são iguais (situação inválida para CNPJ)
  if (/^(\d)\1+$/.test(cnpj)) {
      return false;
  }

  // Calcular os dígitos verificadores
  let tamanho = cnpj.length - 2;
  let numeros = cnpj.substring(0, tamanho);
  const digitos = cnpj.substring(tamanho);
  let soma = 0;
  let pos = tamanho - 7;

  for (let i = tamanho; i >= 1; i--) {
      soma += parseInt(numeros.charAt(tamanho - i)) * pos--;
      if (pos < 2) {
          pos = 9;
      }
  }

  let resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11);

  if (resultado.toString() !== digitos.charAt(0)) {
      return false;
  }

  tamanho = tamanho + 1;
  numeros = cnpj.substring(0, tamanho);
  soma = 0;
  pos = tamanho - 7;

  for (let i = tamanho; i >= 1; i--) {
      soma += parseInt(numeros.charAt(tamanho - i)) * pos--;
      if (pos < 2) {
          pos = 9;
      }
  }

  resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11);

  if (resultado.toString() !== digitos.charAt(1)) {
      return false;
  }

  return true;
}


/*
async function consultarCNPJ() {
          const cnpjInput = document.getElementById("cnpj");
          const razaoSocialInput = document.getElementById("corpName");
          const nomeFantasiaInput = document.getElementById("fantasy-name");
          const cnpj = cnpjInput.value.replace(/\D/g, ''); // Remover caracteres não numéricos

          // Validar o formato do CNPJ
          if (!validarCNPJFormato(cnpj)) {
              alert("CNPJ inválido. Por favor, insira um CNPJ válido.");
              return;
          }

          try {
              const token = await obterTokenJWT(); // Função para obter o token JWT

              if (!token) {
                  alert("Erro ao obter o token de autenticação.");
                  return;
              }

              const url = `https://h-apigateway.conectagov.estaleiro.serpro.gov.br/api-cnpj-empresa/v2/empresa/${cnpj}`;

              const response = await axios.get(url, {
                  headers: {
                      Authorization: `Bearer ${token}`,
                  },
              });

              const data = response.data;

              // Preencher os campos do formulário com as informações obtidas
              razaoSocialInput.value = data.cmopName;
              nomeFantasiaInput.value = data.fantasy-name;
          } catch (error) {
              alert(`Erro ao consultar o CNPJ: ${error.message}`);
          }
      }

      async function obterTokenJWT() {
          // Chave da API
          const chaveAPI = 'api-cnpj-v1';

          // Endpoint para obter o token JWT
          const tokenEndpoint = 'https://h-apigateway.conectagov.estaleiro.serpro.gov.br/oauth2/jwt-token';

          try {
              const response = await axios.post(tokenEndpoint, null, {
                  params: {
                      client_id: chaveAPI,
                      grant_type: 'client_credentials',
                  },
              });

              return response.data.access_token;
          } catch (error) {
              throw new Error(`Erro ao obter o token: ${error.message}`);
          }
      }

      // Função de validação de CNPJ
      function validarCNPJFormato(cnpj) {
          // Implementar a validação de CNPJ aqui
          // (O mesmo código de validação fornecido anteriormente)
          // Certifique-se de ajustar conforme necessário para integrar com o seu código.
          return true; // Substitua por sua lógica de validação
      }
*/