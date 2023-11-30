import { loadExercises } from "./cargar-ejercicios.js";
import { loadTypesModal } from "./cargar-tipos-modal.js";
import { confirmMessage, showMesaggeModal } from "./profile-functions.js";
const modalEjercicio = document.getElementById("modal-container");
const buttonEdit = document.getElementById('btn-editar');
const buttonDelete = document.getElementById('btn-borrar');
const nombre = document.getElementById('nombre-ejercicio');
const duracion = document.getElementById('duracion-ejercicio');
const tipo = document.getElementById('tipo-ejercicio');
const descripcion = document.getElementById('descripcion-ejercicio');
const contenedorInfo = document.getElementById('info-ejercicio-grande');
const containerEditarImg = document.getElementById("container-editar-img");
const imagenInput = document.getElementById('img-modal-nueva');
const containerBoton = document.getElementById("container-btn-ejercicio");
const closeModalButton = document.getElementById("close-modal");

// Event listener para editar y eliminar ejercicios.
buttonEdit.addEventListener("click", (e) => {
    const exerciseId = modalEjercicio.getAttribute("data-exercise-id");
    e.preventDefault();
    const tipoOriginal = tipo.textContent

    console.log(exerciseId);
    console.log(tipoOriginal);

    buttonEdit.style.display = 'none'; 
    buttonDelete.style.display = 'none';

    const buttonSubmit = document.createElement('button');
    buttonSubmit.classList.add('btn-general', 'btn-amarillo');
    buttonSubmit.textContent = 'Guardar';
    buttonSubmit.type = 'submit';
    containerEditarImg.style.display = 'flex';
    contenedorInfo.appendChild(buttonSubmit);
  
    const buttonCancel = document.createElement('button');
    buttonCancel.classList.add('btn-general', 'btn-amarillo');
    buttonCancel.textContent = 'Cancelar';
    contenedorInfo.appendChild(buttonCancel);
    
    containerEditarImg.style.display = 'flex';
    
    nombre.contentEditable = true;
    nombre.classList.add('bg-gris')
    duracion.contentEditable = true;
    duracion.classList.add('bg-gris')
    descripcion.contentEditable = true;
    descripcion.classList.add('bg-gris')
    loadTypesModal();
    


    buttonSubmit.addEventListener('click', (e) => {
      e.preventDefault();
      const tipoModal = document.getElementById('tipo-ejercicio-modal');

      const formData = new FormData();
      formData.append('id', exerciseId);
      formData.append('imagen', imagenInput.files[0]); 
      formData.append('nombre', nombre.textContent);
      formData.append('duracion', duracion.textContent);
      formData.append('tipo', tipoModal.value || tipoOriginal);
      formData.append('descripcion', descripcion.textContent);

      console.log('Datos del formulario:', formData);

      fetch("./db/update-exercise.php", {
          method: "POST",
          body: formData,
      })
      .then(response => {
          if (response.ok) {
            showMesaggeModal("Ejercicio actualizado correctamente", true, modalEjercicio);
            loadExercises();
            resetModalEjercicio();
            imagenInput.value = "";
            tipo.textContent = tipoModal.value || tipoOriginal;
          } else {
              showMesaggeModal("Fallo al actualizar el ejercicio", false, modalEjercicio)
          }
      })
      .catch(error => {
          console.error('Error:', error);
      });
    });



    buttonCancel.addEventListener('click', () => {
        resetModalEjercicio();
        tipo.textContent = tipoOriginal;
    });

    closeModalButton.addEventListener('click', () => {
        resetModalEjercicio();
        tipo.textContent = tipoOriginal;
    })



    function resetModalEjercicio () {    
      const tipoModal = document.getElementById('tipo-ejercicio-modal');
      buttonEdit.style.display = 'block'; 
      buttonDelete.style.display = 'block';
      buttonSubmit.remove();
      buttonCancel.remove();
      nombre.contentEditable = false;
      nombre.classList.remove('bg-gris');
      duracion.contentEditable = false;
      duracion.classList.remove('bg-gris');
      descripcion.contentEditable = false;
      descripcion.classList.remove('bg-gris');
      buttonSubmit.remove();
      buttonCancel.remove();
      containerEditarImg.style.display = 'none';
      imagenInput.value = "";
      if (tipoModal){
          tipoModal.replaceWith(tipo)
      }
    } 
});


buttonDelete.addEventListener('click', (e) => {
  e.preventDefault();
  
    confirmMessage("¿Estás seguro de que quieres borrar el ejercicio?", (userConfirmed) => {
        if (userConfirmed) {
            deleteExercise();
        } else {
            console.log("Perfil no borrado");
        }
    });
});

function deleteExercise() {
    const exerciseId = modalEjercicio.getAttribute("data-exercise-id");
      
    const formData = new FormData();
    formData.append('id', exerciseId);

    fetch("./db/delete-exercise.php", {
        method: "POST",
        body: formData,
    })
    .then(response => {
        if (response.ok) {
            buttonEdit.style.display = 'none';
            buttonDelete.style.display = 'none';
            showMesaggeModal('Ejercicio elmininado correctamente', true, modalEjercicio)
            setTimeout(() => {
                console.log('Ejercicio eliminado');
                loadExercises();
                modalEjercicio.style.display = "none";
                containerBoton.style.display = "flex";
                buttonEdit.style.display = 'block';
                buttonDelete.style.display = 'block';
            }, 2000);
        } else {
            console.error('Error en la actualización');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}