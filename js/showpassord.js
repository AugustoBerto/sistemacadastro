"use strict";

// Função showpassword
function showpassword(passwd, showpasswd) {

    // Referência para o campo/botão
    const passwdInput = document.getElementById(passwd);
    const showButton = document.getElementById(showpasswd);

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
    showpassword("passwd1", "showpasswd1");
    showpassword("passwd2", "showpasswd2");
});
