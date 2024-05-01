<?php
// Importa as configurações
include ("../vendor/autoload.php");
include ("../includes/config.php");
include ("../includes/connect.php");

// Verifica se o token foi fornecido
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Consulta o token na tabela de usuários
    $sql = "SELECT * FROM users WHERE reset_token='$token'";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        // Formulário para redefinir senha
        echo '
        <form method="post" action="update_password.php">
            <input type="hidden" name="token" value="' . $token . '">
            <label for="password">Nova Senha:</label><br>
            <input type="password" id="password" name="password"><br>
            <input type="submit" value="Redefinir Senha">
        </form>';
    } else {
        echo "Token inválido ou expirado.";
    }
} else {
    echo "Token não fornecido.";
}

// Fecha conexão
$connect->close();
