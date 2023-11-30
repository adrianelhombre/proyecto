import { loadUserProfile, showProfileModal, confirmMessage, handleUsernameEdit, handleDeleteProfile } from "./profile-functions.js";

const closeModalButton = document.getElementById("close-modal-perfil");
const buttonEditProfile = document.getElementById("btn-edit-profile");
const userDataString = sessionStorage.getItem('user_data');
const buttonNewExercise = document.getElementById("container-btn-ejercicio");

closeModalButton.addEventListener("click", () => {
    const modalPerfil = document.getElementById("modal-container-perfil");
    modalPerfil.style.display = "none";
    buttonNewExercise.style.display = "flex";
});

export function initializeProfileModal() {
    buttonEditProfile.addEventListener("click", (e) => {
        buttonNewExercise.style.display = "none";

        e.preventDefault();
        showProfileModal()

        if (userDataString) {
            const userData = JSON.parse(userDataString);
            loadUserProfile(userData);
        }

        const buttonEditUsername = document.getElementById("btn-edit-username");
        const buttonDeleteProfile = document.getElementById("btn-borrar-perfil");

        buttonEditUsername.addEventListener("click", (e) => {
            e.preventDefault();
            handleUsernameEdit();
        });
        buttonDeleteProfile.addEventListener("click", (e) => {
            e.preventDefault();
            
            confirmMessage("¿Estás seguro de que quieres borrar tu perfil?", (userConfirmed) => {
                if (userConfirmed) {
                    handleDeleteProfile();
                } else {
                    console.log("Perfil no borrado");
                }
            });
        });
    });
}