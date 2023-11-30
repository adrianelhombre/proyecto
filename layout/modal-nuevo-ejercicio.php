<div id="modal-container-new" class="modal-container">
  <div class="modal-content-new">
    <span class="close" id="close-modal-new">&times;</span>
    <form id="add-exercise-form" class="form-ejercicio" method="POST" enctype="multipart/form-data">
      <input type="text" name="nombre" placeholder="Nombre ejercicio" class="input-general input-nombre bg-gris" required>
      
      <div class="ejercicio-grande">

        <div class="subir-img">
          <input type="file" name="imagen" id="imagen-nueva" accept="image/*" required> 
        </div>

        <div class="info-nuevo-ejercicio">
          <span class="titulo-span">TIPO EJERCICIO</span>
          <span class="titulo-span">DURACION</span>
          <select name="tipo-ejercicio-new" id="tipo-ejercicio-new"></select>
          <input name="duracion" type="text" placeholder="Duracion" class="input-general bg-gris" required>
          <textarea name="descripcion" placeholder="Descripcion ejercicio" id="descripcion-nueva" class="descripcion-nueva bg-gris" cols="30" rows="10"></textarea required>
          <input type="submit" value="Enviar" id="btn-enviar" class="btn-general btn-amarillo">
        </div>
      </div>
    </form>
  </div>
  </div>
</div>

          