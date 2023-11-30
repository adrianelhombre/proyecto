<?php
include './db/datos.php'; 
include './db/funciones.php';

require('./layout/header.php');
require('./layout/button-back.php');
?>

  <main class="main-container-ejercicio">
    <?php datosEjercicioGrande() ?>
    
    <div>
      <?php require ('./layout/button.php')?>
    </div>

</main>

<script src="js/editar-ejercicio.js"></script>

