import { showMesaggeModal } from "./profile-functions.js";

const formulario = document.getElementById("form-login");
const buttonLogin = document.getElementById("btn-form-enviar");
const formularioRegistro = document.getElementById("form-registro");
const submitRegistro = document.getElementById("btn-registro-enviar");
const containerLogin = document.getElementById("container-login");
const cardLogin = document.getElementById("card-login");
const cardRegistro = document.getElementById("card-registro");

buttonLogin.addEventListener("click", (e) => {
  e.preventDefault();
  
  
  fetch("./db/login.php" , {
    method: "POST",
    body : new FormData(formulario)
  })
  .then((response) => {
    if (!response.ok) {
      throw new Error("La solicitud ha fallado");
    } return response.json();
  })
  .then((data) => {
    if (data.success) {
      showMesaggeModal(data.message, data.success, cardLogin)
      sessionStorage.setItem('user_data', JSON.stringify(data.user_data))
      window.location.href = 'main.php';  
    } else {
      showMesaggeModal(data.message, data.success, cardLogin)
    }
  })
  .catch((error) => {
      console.error('Error:', error);
  });

  
});


function handleRegistroClick (e) {
  e.preventDefault();

  fetch("./db/new-user.php" , {
    method: "POST",
    body : new FormData(formularioRegistro)
  })
  .then((response) => {
    if (!response.ok) {
      throw new Error("La solicitud ha fallado");
    } 
    return response.json();
  })
  .then((data) => {
    console.log("respuesta del servidor: ", data)
    if (data.success) {
      showMesaggeModal(data.message, data.success, cardRegistro)
      formularioRegistro.reset();
      setTimeout(() => {
        containerLogin.classList.toggle("right");
        containerLogin.classList.toggle("left");
      }, 1500);
    } else {
      showMesaggeModal(data.message, data.success, cardRegistro)
    }
  })
  .catch((error) => {
      console.log('Error:', error);
  });
}

function handleLoginRegistro () {

  const registroAqui = document.getElementById("registro-aqui");
  

  let isUserRegistered = false;

  registroAqui.addEventListener("click", function () {

    containerLogin.classList.toggle("right");
    containerLogin.classList.toggle("left");

    if (!isUserRegistered) {
        registroAqui.innerHTML = "Ya tienes cuenta? Inicia sesión <button id='iniciar-sesion' class='btn-registro'>aqui</button>."; // Cambiar el texto
    } else {
        registroAqui.innerHTML = "Aun no tienes cuenta? Registrate <button id='registro' class='btn-registro'>aqui</button>."; // Cambiar el texto
    }

    // Cambiar el estado
    isUserRegistered = !isUserRegistered;
  });
}

document.addEventListener("DOMContentLoaded", handleLoginRegistro);

submitRegistro.addEventListener("click", handleRegistroClick)

