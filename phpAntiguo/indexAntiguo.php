<?php
include './db/datos.php'; 
include './db/funciones.php';
require('./layout/header.php') 
?>


  <main class="main-container">
    <?php datosEjercicios() ?>
    
    <div>
      <?php require('./layout/button.php')?>
    </div>
  </main>

  <!-- <?php require('./layout/footer.php')?> -->
