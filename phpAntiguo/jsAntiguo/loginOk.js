// import { showMesaggeModal } from "./profile-functions.js";

// const formulario = document.getElementById("form-login");
// const buttonLogin = document.getElementById("btn-form-enviar");
// const modalError = document.getElementById("modal-error");
// const closeModalRegistroButton  = document.getElementById("close-modal-registro");
// const mensajeError = document.getElementById("message-modal");
// const formularioRegistro = document.getElementById("form-registro");
// const buttonRegistro = document.getElementById("registro");
// const submitRegistro = document.getElementById("btn-registro-enviar");
// const modalRegistro = document.getElementById("modal-container-registro");
// const errorMessage = document.getElementById("error-message");
// const buttonOk = document.getElementById("btn-ok");




// buttonLogin.addEventListener("click", (e) => {
//   e.preventDefault();
  
  
//   fetch("./db/login.php" , {
//     method: "POST",
//     body : new FormData(formulario)
//   })
//   .then((response) => {
//     if (!response.ok) {
//       throw new Error("La solicitud ha fallado");
//     } return response.json();
//   })
//   .then((data) => {
//     if (data.success) {
//       showMesaggeModal(data.message, data.success)
//       sessionStorage.setItem('user_data', JSON.stringify(data.user_data))
//       window.location.href = 'main.php';  
//     } else {
//       showMesaggeModal(data.message, data.success)
//     }
//   })
//   .catch((error) => {
//       console.error('Error:', error);
//   });

  
// });


// function mostrarModalRegistro() {
//   modalRegistro.style.display = "block";
// }

// function cerrarModalRegistro() {
//   modalRegistro.style.display = "none";
// }

// function cerrarModalError() {
//     modalError.style.display = "none";
// }



// function handleRegistroClick (e) {
//   e.preventDefault();
//   console.log("hola pa")

//   fetch("./db/new-user.php" , {
//     method: "POST",
//     body : new FormData(formularioRegistro)
//   })
//   .then((response) => {
//     if (!response.ok) {
//       throw new Error("La solicitud ha fallado");
//     } 
//     return response.json();
//   })
//   .then((data) => {
//     console.log("respuesta del servidor: ", data)
//     if (data.success) {
//       modalRegistro.style.display = "none";
//       modalError.style.display = "block";
//       mensajeError.innerText = data.message;
//       console.log("usuario creado")
//     } else {
//       errorMessage.style.display = "block";
//       errorMessage.style.opacity = "1";
//       errorMessage.innerText = data.message;
//     }
//   })
//   .catch((error) => {
//       console.log('Error:', error);
//   });
// }

// buttonRegistro.addEventListener("click", mostrarModalRegistro)
// submitRegistro.addEventListener("click", handleRegistroClick)
// buttonOk.addEventListener("click", cerrarModalError)
// closeModalRegistroButton.addEventListener("click", cerrarModalRegistro)

