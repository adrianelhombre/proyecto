<div id="modal-container" class="modal-container">
  <div class="container-content">

    <div class="modal-content">

      
      
      <h2 name="nombre-modal" id="nombre-ejercicio" class="nombre-ejercicio-grande" contenteditable="false" ></h2>
      
      <div id="ejercicio-grande">
        <form id="form-modal" class="ejercicio-grande" method="POST" enctype="multipart/form-data">
          <div class="img-ejercicio-grande" id="container-img-modal">
            <div id="container-editar-img" class="container-editar-img">
              <input name="archivo" type="file" id="img-modal-nueva" accept=".jpg, .jpeg, .png"></input>
            </div>
            <div id="container-img" class="container-img"> 
              <img name='img-modal' class="img-modal-grande" id="img-ejercicio" src="" alt="imagen ejercicio" >
              <span> Ejercicio creado por 
                <span id="author-name" class="author-name"></span>
              </span>
              
            </div>
          </div>
    
          <div class="info-ejercicio-grande" id="info-ejercicio-grande">
              <span class="titulo-span">TIPO EJERCICIO</span>
              <span class="titulo-span">DURACION</span>
              <span id="tipo-ejercicio" name='tipo-modal'></span>
              <span name='duracion-modal' id="duracion-ejercicio" contenteditable="false"></span>
              <p name='descripcion-modal' id="descripcion-ejercicio" contenteditable="false"></p>
              <button id="btn-editar" class="btn-general btn-amarillo">Editar</button>
              <button id="btn-borrar" class="btn-general btn-amarillo">Borrar</button>
              <span id="author" class="author">Solo el autor puede editar su ejecicio</span>
          </div>       
        </form>
      </div>
  
      
    </div>

    <div id="comentarios" class="comentarios-content">
      <span class="close" id="close-modal">&times;</span>
      <h3>Comentarios</h3>
      <ul id="lista-comentarios" class="lista-comentarios">
        <!-- Aquí se mostrarán los comentarios existentes -->
      </ul>
      <textarea id="nuevo-comentario" class="bg-gris" placeholder="Publicar nuevo comentario..." required="true"></textarea>
      <button id="btn-agregar-comentario" class="btn-general btn-amarillo">Publicar</button>
    </div>
  </div>
</div>