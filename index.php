<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Inicio sesion</title>
    <script type="module" src="./js/login.js"></script>
  </head>

  <body class="body-login">
      <main class="main-login">
        <div id="container-login" class="container-login left">

          <div id="card-registro" class="card-registro">
            <form id="form-registro" class="form-login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"> 
              <h2 id="bienvenido" class="titulo-form">Bienvenido!</h2>
              <input class="input-form" id="nombre-form" type="text" name="nombre-form" placeholder="Nombre" title="Este campo solo acepta letras y espacios en blanco" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" required>
              <input class="input-form" id="apellido-form" type="text" name="apellido-form" placeholder="Apellidos" title="Este campo solo acepta letras y espacios en blanco" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" required>
              <input class="input-form" id="email-form" type="text" name="email-form" placeholder="Correo electrónico" title="Email incorrecto" pattern="^[a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})$" required>
              <input class="input-form" id="usuario-form" type="text" name="user-form" placeholder="Nombre de usuario" required>
              <input class="input-form" id="password-form" type="password" name="pass-form" placeholder="Contraseña" required>
              <input id="btn-registro-enviar" class="btn-general btn-amarillo" type="submit" value="Enviar">
            </form>
          </div>

          <div id="info-login" class="info-login">
            <img src="./assets/LOGO GRANDE.png" class="logo-grande" alt="Vite logo" />
            <span id="registro-aqui" class="registro-aqui">
              Aun no tienes cuenta? Registrate <button id="registro" class="btn-registro"=>aqui</button>.
            </span>
          </div>
  
          <div id="card-login" class="card-login">
            <form id="form-login" class="form-login" method="POST">
              <h2 class="titulo-form">Iniciar sesion</h2>
              <input class="input-form" id="user" type="text" name="user-name" placeholder="Nombre usuario" />
              <input class="input-form" id="password" type="password" name="user-pass" placeholder="Contraseña" />
              <input id="btn-form-enviar" class="btn-form btn-amarillo" type="submit" value="Acceder">
            </form>
          </div>
        </div>
      </main>
  </body>
</html>

