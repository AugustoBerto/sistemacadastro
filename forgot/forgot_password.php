<?php
// Importa as configurações
include ("../vendor/autoload.php");
include ("../includes/config.php");
include ("../includes/connect.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
            $mail->Subject = 'Recuperação de senha';
            $mail->Body = 'Você solicitou a recuperação de senha. Clique no link a seguir para redefinir sua senha: <a href="http://localhost/sistemacadastro/forgot/reset_password.php?token=' . $token . '">Redefinir Senha</a>';
            $mail->charSet = "UTF-8";

            $mail->send();
            echo "Um e-mail de recuperação foi enviado para o seu endereço de e-mail.";
        } catch (Exception $e) {
            echo "O e-mail de recuperação não pôde ser enviado. Erro: {$mail->ErrorInfo}";
        }
    } else {
        echo "O e-mail fornecido não está cadastrado.";
    }
}

$connect->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha</title>
</head>

<body>
    <h2>Recuperação de Senha</h2>
    <form method="post" action="forgot_password.php">
        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" required><br>
        <input type="submit" name="forgot" value="Enviar E-mail de Recuperação">
    </form>
</body>

</html>