<div id="modal-container-registro" class="modal-container-registro">
  <div class="modal-content-registro">
    
    <span class="close" id="close-modal-registro">&times;</span>
    
      <form id="form-registro" class="contact-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"> 
        <h1 id="bienvenido" class="bienvenido">Bienvenido a la familia</h1>
        <input class="input-general" id="nombre-form" type="text" name="nombre-form" placeholder="Nombre" title="Este campo solo acepta letras y espacios en blanco" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" required>
        <input class="input-general" id="apellido-form" type="text" name="apellido-form" placeholder="Apellidos" title="Este campo solo acepta letras y espacios en blanco" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" required>
        <input class="input-general" id="email-form" type="text" name="email-form" placeholder="Correo electrónico" title="Email incorrecto" required>
        <input class="input-general" id="usuario-form" type="text" name="user-form" placeholder="Nombre de usuario" required>
        <input class="input-general" id="password-form" type="password" name="pass-form" placeholder="Contraseña" required>
        <span id="error-message" class="error-message"></span>
        <input id="btn-registro-enviar" class="btn-general btn-amarillo" type="submit" value="Enviar">
      </form>
  </div>
</div>