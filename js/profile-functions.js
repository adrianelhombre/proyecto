export function loadUserProfile(userData) {
  const userName = userData.nombre;
  const userSurname = userData.apellido;
  const userEmail = userData.user_email;
  const userUsername = userData.user_name;

  // Actualizar elementos HTML con los datos del perfil
  document.getElementById("profile-name").innerText = userName;
  document.getElementById("profile-surname").innerText = userSurname;
  document.getElementById("profile-email").innerText = userEmail;
  document.getElementById("profile-username").innerText = userUsername;
}

export function showProfileModal() {
  // Mostrar la modal (puedes implementar la lógica aquí si es necesario)
  const modalPerfil = document.getElementById("modal-container-perfil");
  modalPerfil.style.display = "block";
}

export function showMesaggeModal(message, success, targetElement) {
  const existingModals = targetElement.getElementsByClassName("modal-content-message");
  for (const modal of existingModals) {
    targetElement.removeChild(modal);
  }

  const modalMessage = document.createElement("div");
  modalMessage.classList.add("modal-content-message");

  const modalMessageText = document.createElement("span");
  modalMessageText.innerText = message;
  modalMessageText.classList.add("modal-message-text");

  if (success === false) {
    modalMessageText.classList.add("bg-rojo");
  } else {
    modalMessageText.classList.add("bg-verde");
  }

  modalMessage.appendChild(modalMessageText);
  targetElement.appendChild(modalMessage);


  setTimeout(() => {
    modalMessage.classList.add("active");
  }, 50);

  setTimeout(() => {
    modalMessage.classList.remove("active");
    setTimeout(() => {
      targetElement.removeChild(modalMessage);
    }, 500);
  }, 1500);
}

export function confirmMessage(message, callback) {
  const modalConfirm = document.getElementById("modal-container-confirmar");
  const modalConfirmText = document.getElementById("modal-confirmar-text");
  const buttonYes = document.getElementById("btn-yes");
  const buttonNo = document.getElementById("btn-no");

  modalConfirm.style.display = "flex";
  
  buttonYes.addEventListener("click", (e) => {
    e.preventDefault();
    callback(true);
    modalConfirm.style.display = "none";
  })
  
  buttonNo.addEventListener("click", (e) => {
    e.preventDefault();
    callback(false);
    modalConfirm.style.display = "none";
  })

  modalConfirmText.innerText = message;
}

export function handleUsernameEdit() {
  const buttonEditUsername = document.getElementById("btn-edit-username");
  const buttonOk = document.getElementById("btn-save-username");
  const buttonCancel = document.getElementById("btn-cancel-username");
  const usernameProfile = document.getElementById("profile-username");

  buttonEditUsername.style.display = "none";
  buttonOk.style.display = "flex";
  buttonCancel.style.display = "flex";

  usernameProfile.contentEditable = true;
  usernameProfile.focus();
  usernameProfile.classList.add("bg-gris");


  buttonOk.addEventListener("click", (e) => {
      // Lógica para guardar el nombre de usuario editado
      e.preventDefault();
      const userData = JSON.parse(sessionStorage.getItem('user_data'));
      const userId = userData.id_user;
      const newUsername = usernameProfile.innerText;
      const spanUser = document.getElementById("span-user");
      const containerEdit = document.getElementById("container-edit");

      // Enviar datos al servidor para actualizar el nombre de usuario
      fetch("./db/update-username.php", {
          method: "POST",
          headers: {
              'Content-Type': 'application/json',
          },
          body: JSON.stringify({ userId: userId, username: newUsername }),
      })
      .then((response) => {
          if (!response.ok) {
              throw new Error("La solicitud ha fallado");
          }
          return response.json();
      })
      .then((data) => {     
          if (data.success) {
              showMesaggeModal(data.message, data.success, containerEdit);
              setTimeout(() => {
                window.location.href = "./main.php";
                const updatedUserData = JSON.parse(sessionStorage.getItem('user_data'));
                updatedUserData.user_name = newUsername;
                sessionStorage.setItem('user_data', JSON.stringify(updatedUserData));

                // Actualizar el nombre de usuario en el header
                spanUser.innerText = newUsername;
              }, 2000);
              
          } else {
            showMesaggeModal(data.message, data.success,containerEdit);
          }
      })
      .catch((error) => {
          console.error("Error al actualizar el nombre de usuario:", error);
      })
      .finally(() => {
          // Restaurar el estado original
          buttonEditUsername.style.display = "flex";
          buttonOk.style.display = "none";
          buttonCancel.style.display = "none";

          usernameProfile.contentEditable = false;
          usernameProfile.classList.remove("bg-gris");
      });
  });

  buttonCancel.addEventListener("click", (e) => {
    e.preventDefault();
    // Lógica para cancelar la edición del nombre de usuario
    buttonEditUsername.style.display = "flex";
    buttonOk.style.display = "none";
    buttonCancel.style.display = "none";

    usernameProfile.contentEditable = false;
    usernameProfile.classList.remove("bg-gris");
  });
}

export function handleDeleteProfile() {
  const userData = JSON.parse(sessionStorage.getItem('user_data'));
  const userId = userData.id_user;

  fetch("./db/delete-user.php", {
      method: "POST",
      headers: {
          'Content-Type': 'application/json',
      },
      body: JSON.stringify({ userId: userId }),
  })
  .then((response) => {
      if (!response.ok) {
          throw new Error("La solicitud ha fallado");
      }
      return response.json();
  })
  .then((data) => {
      if (data.success) {
        showMesaggeModal("Usuario elminado con exito", true, document.getElementById("modal-container-perfil"));
        setTimeout(() => {
          window.location.href = "./index.php";
        }, 2000);
      } else {
        alert("Error al borrar el usuario");
      }
  })
  .catch((error) => {
      console.error("Error al borrar el usuario:", error);
  });
}