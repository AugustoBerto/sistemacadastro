<!DOCTYPE html>
<html lang="pt-BR">

<?php
?>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@300;400;700;900&display=swap" />

  <link rel="stylesheet" href="./assets/css/reset.css" />
  <link rel="stylesheet" href="./assets/css/colors.css" />
  <link rel="stylesheet" href="./assets/css/main.css" />
  <link rel="stylesheet" href="./assets/css/login-container.css" />
  <link rel="stylesheet" href="./assets/css/form-container.css" />
  <link rel="stylesheet" href="./assets/css/form.css" />
  <link rel="stylesheet" href="./assets/css/form-title.css" />
  <link rel="stylesheet" href="./assets/css/form-social.css" />
  <link rel="stylesheet" href="./assets/css/social-icon.css" />
  <link rel="stylesheet" href="./assets/css/form-input-container.css" />
  <link rel="stylesheet" href="./assets/css/form-input.css" />
  <link rel="stylesheet" href="./assets/css/form-button.css" />
  <link rel="stylesheet" href="./assets/css/overlay-container.css" />
  <link rel="stylesheet" href="./assets/css/overlay.css" />
  <link rel="stylesheet" href="./assets/css/mobile-text.css" />

  <script src="https://kit.fontawesome.com/324b71f187.js" crossorigin="anonymous"></script>

  <title>Login/Cadastro</title>
</head>

<body>
  <main>
    <div class="login-container" id="login-container">

      <div class="form-container">

        <!-- formulario de login -->
        <form class="form form-login" action="loginsingup/auth.php" method="POST">
          <h2 class="form-title">Entrar com</h2>

          <div class="form-social">
            <a href="#" class="social-icon">
              <i class="fab fa-google"></i>
            </a>

            <a href="#" class="social-icon">
              <i class="fab fa-linkedin-in"></i>
            </a>

            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
            </a>
          </div>

          <p class="form-text">ou utilize sua conta</p>

          <div class="form-input-container">
            <input type="email" class="form-input" name="email" placeholder="Email" required />
            <input type="password" class="form-input" id="passwdlog" name="password" placeholder="Senha" required />
            <img src="https://cdn0.iconfinder.com/data/icons/ui-icons-pack/100/ui-icon-pack-14-512.png"
              id="showpasswdlog" class="eye">
          </div>

          <a href="forgot/forgot_password.php" class="form-link">Esqueceu a senha?</a>
          <button type="submit" class="form-button" name="login">Logar</button>
          <p class="mobile-text">Não tem conta? <a href="#" id="open-register-mobile">Registre-se</a></p>

        </form>

        <!-- formulario de cadastro -->
        <form class="form form-register" action="loginsingup/auth.php" method="POST">
          <h2 class="form-title">Criar Conta</h2>

          <div class="form-social">
            <a href="#" class="social-icon">
              <i class="fab fa-google"></i>
            </a>

            <a href="#" class="social-icon">
              <i class="fab fa-linkedin-in"></i>
            </a>

            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
            </a>
          </div>

          <p class="form-text">ou cadastre-se com email</p>

          <div class="form-input-container">
            <input type="text" class="form-input" name="name" placeholder="Nome" required />
            <input type="email" class="form-input" name="email" placeholder="Email" required />
            <input type="password" class="form-input" id="passwdcad" name="password" placeholder="Senha" required />
            <img src="https://cdn0.iconfinder.com/data/icons/ui-icons-pack/100/ui-icon-pack-14-512.png"
              id="showpasswdcad" class="eye">
          </div>

          <button type="submit" class="form-button" name="register">Cadastrar</button>
          <p class="mobile-text">Já tem conta? <a href="#" id="open-login-mobile">Login</a></p>

        </form>
      </div>

      <div class="overlay-container">

        <div class="overlay">
          <h2 class="form-title form-title-light">Já tem conta?</h2>
          <p class="form-text, text-overlay">Para entrar na nossa plataforma faça login com suas informações</p>
          <button class="form-button form-button-light" id="open-login">Entrar</button>
        </div>

        <div class="overlay">
          <h2 class="form-title form-title-light">Olá Aluno!</h2>
          <p class="form-text, text-overlay">Cadastre-se e comece a usar a nossa plataforma on-line</p>
          <button class="form-button form-button-light" id="open-register">Cadastrar</button>
        </div>

      </div>

    </div>
  </main>
</body>

<script src="./assets/js/showpassord.js" defer></script>
<script src="./assets/js/login.js" defer></script>

</html>