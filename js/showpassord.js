"use strict";

// Função para o botão mostrar/esconder senha
function showpassword(passwd, showpasswd) {
    const passwdInput = document.getElementById(passwd);
    const showButton = document.getElementById(showpasswd);

    showButton.addEventListener("click", function () {
        if (passwdInput.type === "password") {
            passwdInput.type = "text";
        } else {
            passwdInput.type = "password";
        }
    });
}

// Chamando a função
document.addEventListener("DOMContentLoaded", function () {
    showpassword("passwd1", "showpasswd1");
    showpassword("passwd2", "showpasswd2");
});

// :)