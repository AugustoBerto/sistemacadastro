<?php
// Importa as configurações
include ("../includes/config.php");
include ("../includes/connect.php");

// Verifica se o formulário de redefinição de senha foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['token'])) {
    $token = $_POST['token'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Atualiza a senha na tabela de usuários
    $update_sql = "UPDATE users SET password='$password', reset_token=NULL WHERE reset_token='$token'";
    if ($connect->query($update_sql) === TRUE) {
        echo "Senha redefinida com sucesso!";
    } else {
        echo "Erro ao redefinir senha: " . $connect->error;
    }
}

// Fecha conexão
$connect->close();
