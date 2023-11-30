<div id="modal-container" class="modal-container">
  <div class="modal-content">
    
    <span class="close" id="close-modal">&times;</span>
    <h2 name="nombre-modal" id="nombre-ejercicio" class="nombre-ejercicio-grande" contenteditable="false" ></h2>
    
    <div id="ejercicio-grande">
      <form id="form-modal" class="ejercicio-grande" method="POST" enctype="multipart/form-data">
        <div class="img-ejercicio-grande" id="container-img-modal">
          <div id="container-editar-img" class="container-editar-img">
            <input name="archivo" type="file" id="img-modal-nueva" accept=".jpg, .jpeg, .png"></input>
          </div>
          <img name='img-modal' class="img-modal-grande" id="img-ejercicio" src="" alt="imagen ejercicio" >
        </div>
  
        <div class="info-ejercicio-grande" id="info-ejercicio-grande">
            <span class="titulo-span">TIPO EJERCICIO</span>
            <span class="titulo-span">DURACION</span>
            <span id="tipo-ejercicio" name='tipo-modal'></span>
            <span name='duracion-modal' id="duracion-ejercicio" contenteditable="false"></span>
            <p name='descripcion-modal' id="descripcion-ejercicio" contenteditable="false"></p>
            <button id="btn-editar" class="btn-general btn-amarillo">Editar</button>
            <button id="btn-borrar" class="btn-general btn-amarillo">Borrar</button>
        </div>       
      </form>
    </div>
  </div>
</div>