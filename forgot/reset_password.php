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
        ?>
        <!DOCTYPE html>
        <html lang="pt-br">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../assets/css/forgot.css">
            <link rel="stylesheet" href="../assets/css/colors.css">
            <title>Nova senha</title>
        </head>

        <body>
            <div class="container">
                <form class="form" method="post" action="update_password.php">
                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                    <p class="text">Nova Senha:</p>
                    <input class=" input" type="password" id="password" name="password">
                    <input class="button" type="submit" value="Redefinir Senha">
                </form>
            </div>
        </body>

        </html>
        <?php
    } else {
        echo "Token inválido ou expirado.";
    }
} else {
    echo "Token não fornecido.";
}

// Fecha conexão
$connect->close();
?>