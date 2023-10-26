function toggleForm(){
    const divRegister = document.querySelector(".register");
    const divLogin = document.querySelector(".login");
    const linkRegister = document.querySelectorAll(".link-register");
    const linkLogin = document.querySelectorAll(".link-login");
    const removeRegister = "remove-register";
    const showLogin = "show-login";

    linkLogin.forEach(el => {
        el.addEventListener("click", () =>{
            divRegister.classList.add(removeRegister);
            divLogin.classList.add(showLogin);
        });
    });

    linkRegister.forEach(el => {
        el.addEventListener("click", () =>{
            divRegister.classList.remove(removeRegister);
            divLogin.classList.remove(showLogin);
        });
    });
}

toggleForm();