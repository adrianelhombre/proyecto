<?php
include './db/datos.php'; 
include './db/funciones.php';

require('./layout/header.php');
require('./layout/button-back.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  procesarFormulario();
}
?>

  <main>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="main-container-ejercicio">
          <input type="text" name="nombre-ejercicio" placeholder="Nombre ejercicio" class="input-general input-nombre bg-gris">
          <div class="ejercicio-grande">

              <div class="subir-img">
                <button class="btn-general btn-amarillo">Selecciona tu imagen</button>
              </div>

              <div class="info-nuevo-ejercicio">
                <span class="titulo-span">TIPO EJERCICIO</span>
                <span class="titulo-span">DURACION</span>
                <?php datosTipoEjercicios(); ?>
                <input name="duracion-ejercicio" type="text" placeholder="Duracion" class="input-general bg-gris">
                <textarea name="descripcion-ejercicio" placeholder="Descripcion ejercicio" class="descripcion-nueva bg-gris" id="descripcion-nueva" cols="30" rows="10"></textarea>
                <input type="submit" value="Enviar" id="btn-enviar" class="btn-general btn-amarillo">
              </div>
            </div>
        </div>
      </form>

  </main>

