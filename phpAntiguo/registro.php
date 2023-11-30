<?php

include './db/datos.php'; 
include './db/funciones.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  registroUsuario();
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro usuario</title>
    <link rel="stylesheet" href="./style.css">
  </head>

  <body class="body-registro">
    
    <?php include 'modal.php'; ?>

    <main class="main-registro">
      <img src="./assets/LOGO GRANDE.png" class="logo-grande" id="logo-grande" alt="fballcoach logo" />
      <form class="contact-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"> 
        <h1 id="bienvenido">Bienvenido a la familia</h1>
        <input class="input-general" id="nombre-form" type="text" name="nombre-form" placeholder="Nombre" title="Este campo solo acepta letras y espacios en blanco" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" required>
        <input class="input-general" id="apellido-form" type="text" name="apellido-form" placeholder="Apellidos" title="Este campo solo acepta letras y espacios en blanco" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" required>
        <input class="input-general" id="email-form" type="email" name="email-form" placeholder="Correo electrónico" title="Email incorrecto"
        pattern="^[a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})$" required>
        <input class="input-general" id="usuario-form" type="text" name="user-form" placeholder="Nombre de usuario" required>
        <input class="input-general" id="password-form" type="password" name="pass-form" placeholder="Contraseña" required>
        
        <input id="btn-form-enviar" class="btn-general btn-amarillo" type="submit" value="Enviar">
      </form>

      <p class="inicio-aqui">
          ¿Ya estás registrado? <a href="login.php">Inicia sesión</a>.
      </p>
    </main>
  </body>
</html>