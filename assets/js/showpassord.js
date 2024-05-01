"use strict";

// Função showpassword
function showpassword(input, button) {

    // Referência para o campo/botão
    const passwdInput = document.getElementById(input);
    const showButton = document.getElementById(button);

    // Evento de clique para o botão de exibir senha (showpasswd)
    showButton.addEventListener("click", function () {
        // Quando o botão é clicado, verifica o tipo de entrada do campo (passwd)
        if (passwdInput.type === "password") {
            // Se o tipo de entrada for "password", altera para "text" para exibir a senha
            passwdInput.type = "text";
        } else {
            // Se não, altera de volta para "password" para ocultar a senha
            passwdInput.type = "password";
        }
    });
}

// Evento que é acionado quando todos os elementos da pagina estiverem carregados
document.addEventListener("DOMContentLoaded", function () {
    // Chama a função
    showpassword("passwdlog", "showpasswdlog");
    showpassword("passwdcad", "showpasswdcad");
});

// :)