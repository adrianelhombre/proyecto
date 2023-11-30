import { showMesaggeModal } from "./profile-functions.js";
const modalEjercicio = document.getElementById("modal-container");
const btnPublicar = document.getElementById("btn-agregar-comentario");
const userDataString = sessionStorage.getItem('user_data');
const lista = document.getElementById("lista-comentarios");


export function loadComents(id_ejercicio) {
  console.log(id_ejercicio);

  fetch(`./db/get-coments.php?id_ejercicio=${id_ejercicio}`)
    .then((response) => {
      if (!response.ok) {
        throw new Error("La solicitud ha fallado");
      }
      return response.json();
    })
    .then((data) => {
      console.log(data);
      lista.innerHTML = "";
      data.forEach((coment) => {
        const ul = document.createElement("ul");
        ul.classList.add("comentario");
        ul.innerHTML = `
          <div>
            <img src="./assets/usuario.png" class="user-icon icono-peq">
          </div>
          <div class="container-comentario">
            <li class="nombre-usuario">${coment.user_name}</li>
            <li class="fecha-usuario">${coment.fecha_creacion}</li>
            <li class="comentario-usuario">${coment.comentario}</li>
          </div>
        `;
        lista.appendChild(ul);
      });
    })
    .catch((error) => {
      console.error("Error al cargar comentarios:", error);
    });
}


export function publicComment() {
  btnPublicar.removeEventListener("click", publicCommentHandler);

  btnPublicar.addEventListener("click", publicCommentHandler);
}


function publicCommentHandler(e) {
  e.preventDefault();

  const comentarioUsuario = document.getElementById("nuevo-comentario").value;
  const userData = JSON.parse(userDataString);
  const id_ejercicio = modalEjercicio.getAttribute("data-exercise-id");

  if (!comentarioUsuario.trim()) {
    showMesaggeModal('Por favor, introduce un comentario antes de publicar.', false, modalEjercicio);
    return;
  }

  fetch('./db/add-comment.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ ...userData, comentario: comentarioUsuario, id_ejercicio }),
  })
    .then(function (response) {
      if (!response.ok) {
        throw new Error('La solicitud ha fallado');
      }
      return response.json();
    })
    .then((data) => {
      if (data.success) {
        showMesaggeModal(data.message, data.success, modalEjercicio);
        document.getElementById("nuevo-comentario").value = "";
        loadComents(id_ejercicio);
      }
    })
    .catch(function (error) {
      console.error('Error en la solicitud:', error);
    });
}

