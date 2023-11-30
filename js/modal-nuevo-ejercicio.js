import { showMesaggeModal } from "./profile-functions.js";
import { loadTypes } from "./cargar-tipos.js";

const openModalButton = document.getElementById("btn-modal-new");
const closeModalButton = document.getElementById("close-modal-new");
const modalEjercicio = document.getElementById("modal-container-new");
const formulario = document.getElementById("add-exercise-form");
const containerBoton = document.getElementById("container-btn-ejercicio");

const defaultOption = document.createElement("option");


openModalButton.addEventListener("click", (e) => {
    e.preventDefault();
    loadTypes();
    modalEjercicio.style.display = "block";
    containerBoton.style.display = "none";
});

closeModalButton.addEventListener("click", () => {
    modalEjercicio.style.display = "none";
    containerBoton.style.display = "flex";
    defaultOption.disabled = false;
});

formulario.addEventListener("submit", (e) => {
    e.preventDefault();

    // Obtener user_name del almacenamiento de sesión
    const userData = JSON.parse(sessionStorage.getItem('user_data'));

    // Agregar user_name al FormData
    const formData = new FormData(formulario);
    formData.append("user_id", userData.id_user);

    fetch("./db/add-exercise.php", {
        method: "POST",
        body: formData,
    })
    .then(() => {
        showMesaggeModal("Ejercicio añadido con exito", true, document.getElementById("modal-container-new"))
        setTimeout(() => {
            formulario.reset();
            document.dispatchEvent(new Event("updateExercises"));
            modalEjercicio.style.display = "none";
            containerBoton.style.display = "flex";
        }, 2000);

    })
    .catch((error) => {
        console.error("Error al obtener datos del ejercicio:", error);
    });
    
});

