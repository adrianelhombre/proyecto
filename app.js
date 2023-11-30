import { loadExercises} from "./js/cargar-ejercicios.js";
// import { loadTypes } from "./js/cargar-tipos.js";
import { initializeProfileModal } from "./js/modal-editar-perfil.js";
import './js/modal-nuevo-ejercicio.js'
import './js/modal-ejercicio.js'
import './js/editar-ejercicio.js'
import './js/get-functions.js'
import { loadPhrase } from "./js/get-functions.js";

const spanUser = document.getElementById("span-user");


document.addEventListener("DOMContentLoaded", () => {
    
    const grid = document.querySelector(".grid-fluid");
    
    loadExercises();
    loadPhrase();
    // loadTypes();
    
    
    document.addEventListener('updateExercises', () => {
        grid.innerHTML = "";
        loadExercises();
    })
    
    const userDataString = sessionStorage.getItem('user_data');
    console.log(userDataString);

    if (userDataString) {
        const userData = JSON.parse(userDataString);
        const userName = userData.user_name;
        spanUser.innerText = userName;
    }

    initializeProfileModal();

    const footer = document.querySelector("footer");

    setTimeout(() => {
        footer.style.display = "flex";
    }, 1000);
});