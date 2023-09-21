import { updateDisplayedDatas } from "./modules/confirmDatas.js";

const formSteps = Array.from(document.querySelectorAll('.form-step'));
const prevButtons = Array.from(document.querySelectorAll('.prev-button'));
const nextButtons = Array.from(document.querySelectorAll('.next-button'));
const form = document.getElementById('stepForm');
const inputs = document.querySelectorAll(".inps input");
const modalFormSubmitted = document.getElementById("modalForm");

let currentStep = 0;

function updateStepVisibility() {
  formSteps.forEach((step, index) => {
    step.style.display = index === currentStep ? 'flex' : 'none';
  });
}

function isStepValid() {
  const stepInputs = formSteps[currentStep].querySelectorAll('input');
  let isValid = true;

  stepInputs.forEach(input => {
    if (input.value.trim() === '') {
      input.classList.add("error");
      isValid = false;

      let errorMsg = input.parentElement.querySelector(".error-message");
      if (!errorMsg) {
        errorMsg = document.createElement("span");
        errorMsg.classList.add("error-message");
        errorMsg.textContent = "*Esse campo precisa ser preenchido!";
        input.parentElement.insertBefore(errorMsg, input);
      }
    } else {
      input.classList.remove("error");
      const errorMsg = input.parentElement.querySelector(".error-message");
      if (errorMsg) {
        errorMsg.remove();
      }
    }
  });

  return isValid;
}

inputs.forEach(input => {
  input.addEventListener('input', () => {
    updateDisplayedDatas(); // Chama a função para atualizar os dados em tempo real
  });
});

function goToStep(step) {
  if (step >= 0 && step < formSteps.length) {
    currentStep = step;
    updateStepVisibility();
  }
}

prevButtons.forEach((button, index) => {
  button.addEventListener('click', event => {
    event.preventDefault();
    goToStep(currentStep - 1); // Vá para a etapa anterior
  });
});

nextButtons.forEach((button, index) => {
  button.addEventListener('click', event => {
    event.preventDefault();
    if (isStepValid()) {
      goToStep(index + 1);
    }
  });
});

form.addEventListener("keydown", event =>{
  if (event.key === "Enter") {
    event.preventDefault(); // Impede o envio do formulário
}
});

form.addEventListener('submit', event => {
  event.preventDefault();

  if (!form.checkValidity()) {
    event.stopPropagation();
  } else {
    const fantasyName = form.querySelector("input[name='fantasy-name']").value;
    
    // Mostrar o modal Bootstrap
     $(modalForm).modal('show');

     const spanElement = document.getElementById('span-name');
     spanElement.innerText = fantasyName;

     // Atraso de 10 segundos antes do envio
     setTimeout(() => {
       // Envie o formulário
       form.submit();
 
       // Após o envio do formulário e do atraso, você pode ocultar o modal Bootstrap
       $(modalForm).modal('hide');
       form.reset();
     }, 10000);
  }

  form.classList.add('was-validated');
});

updateStepVisibility();
