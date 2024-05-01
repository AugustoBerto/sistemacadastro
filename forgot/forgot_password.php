<?php
// Importa as configurações
include ("../vendor/autoload.php");
include ("../includes/config.php");
include ("../includes/connect.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Definindo a variável de mensagem
$message = '';

// Função para gerar um token
function generateToken($length = 20)
{
    return bin2hex(random_bytes($length));
}

// Recuperação de senha
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['forgot'])) {
    // Captura o e-mail fornecido
    $email = mysqli_real_escape_string($connect, $_POST['email']);

    // Verifica se o e-mail existe na tabela de usuários
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $connect->query($sql);

    // Se o email existir
    if ($result->num_rows > 0) {
        // Gera um token
        $token = generateToken();

        // Atualiza o token na tabela (users)
        $update_token_sql = "UPDATE users SET reset_token='$token' WHERE email='$email'";
        $connect->query($update_token_sql);

        // Envia e-mail de recuperação através da biblioteca PHPMailer (https://github.com/PHPMailer/PHPMailer)
        $mail = new PHPMailer(true);

        try {
            //Configurações SMTP
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASS;
            $mail->Port = SMTP_PORT;

            $mail->setFrom('paperads@yahoo.com.br', 'Paper ADS');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->CharSet = "UTF-8";
            $mail->Subject = 'Recuperação de senha';
            $mail->Body = 'Você solicitou a recuperação de senha. Clique no link a seguir para redefinir sua senha: <a href="http://localhost/sistemacadastro/forgot/reset_password.php?token=' . $token . '">Redefinir Senha</a>';

            $mail->send();
            $message = "E-mail de recuperação enviado";
        } catch (Exception $e) {
            $message = "O e-mail de recuperação não pôde ser enviado. Erro: {$mail->ErrorInfo}";
        }
    } else {
        $message = "Este e-mail não está cadastrado.";
    }
}

$connect->close();
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/forgot.css">
    <link rel="stylesheet" href="../assets/css/colors.css">
    <title>Recuperação de Senha</title>
</head>

<body>
    <div class="container">
        <form class="form" method="POST" action="forgot_password.php">
            <p class="text" for="email">Digite seu endereço de email:</p>
            <input class="input" type="email" name="email" required>
            <button class="button" type="submit" name="forgot">Enviar</button>
            <?php if (!empty($message)): ?>
                <p class="alert"><?php echo $message; ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>

</html>