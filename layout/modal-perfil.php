<div id="modal-container-perfil" class="modal-container-perfil">
  <div class="modal-content-profile">
    
    <span class="close" id="close-modal-perfil">&times;</span>
    
    <form id="form-registro" class="profile-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"> 
      <div id="container-edit" class="edit-user-profile">
        <img src="./assets/usuario.png" alt="icono-perfil.png" class="profile-img">
        <div class="edit-username" id="container-username">
          <h3 class="profile-username"  id="profile-username" contenteditable="false"></h3>
          <button class="btn-acciones" id="btn-edit-username">
            <img src="./assets/editar-texto.png" class="icono-peq" alt="">
          </button>
          <button class="btn-acciones" id="btn-save-username" style="display: none;"> 
            <img src="./assets/ok.png" class="icono-peq" alt="">
          </button>
          <button class="btn-acciones" id="btn-cancel-username" style="display: none;"> 
            <img src="./assets/cancelar.png" class="icono-peq" alt="">
          </button>
        </div>
      </div>

      <div id="editar-perfil" class="editar-perfil">
        <h3>Datos personales</h3>
        <span type="text" id="profile-email" class="input-general" contenteditable="false">Email</span>
        <span type="text" id="profile-name" class="input-general" contenteditable="false">Nombre</span>
        <span type="text" id="profile-surname" class="input-general" contenteditable="false">Apellidos</span>
        <button type="submit" id="btn-borrar-perfil" class='btn-borrar-perfil'>Borrar perfil</button>
      </div>
    </form>
  </div>
</div>
