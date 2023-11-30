<?php require('./layout/header.php')?>

  <main>
    <div>
      <a href="index.php">
        <img src="./assets/icono-atras.png" alt="icono atras" class="icono-atras">
      </a>
    </div>
    <section>
      <article>
        <img src="./assets/usuario.png" alt="icono-perfil.png">
        <div class="editar-perfil">
          <span>Datos personales</span>

          <input type="text" placeholder="Email" class="input-general">
          <input type="text" placeholder="Nombre" class="input-general">
          <input type="text" placeholder="Apellidos" class="input-general">
        
          <a href="editar-ejercicio.php" class='btn-borrar-perfil'>Borrar perfil</a>
        </div>
      </article>
    </section>

    <?php require ('./layout/button.php')?>
  </main>