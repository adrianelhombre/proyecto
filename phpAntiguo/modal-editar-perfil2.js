const closeModalButton = document.getElementById("close-modal-perfil");
const modalPerfil = document.getElementById("modal-container-perfil");
const buttonEditProfile = document.getElementById("btn-edit-profile");
const emailProfile = document.getElementById("profile-email");
const nameProfile  = document.getElementById("profile-name");
const surnameProfile = document.getElementById("profile-surname");
const usernameProfile = document.getElementById("profile-username");
const buttonEditUsername = document.getElementById("btn-edit-username");
const buttonOk = document.getElementById("btn-save-username");
const buttonCancel = document.getElementById("btn-cancel-username");
const buttonDeleteProfile = document.getElementById("btn-borrar-perfil");

const userDataString = sessionStorage.getItem('user_data');

closeModalButton.addEventListener("click", () => {
    modalPerfil.style.display = "none";
});

buttonEditProfile.addEventListener("click", (e) => {
  e.preventDefault();

  console.log("Editar perfil");
  modalPerfil.style.display = "block";

  if (userDataString) {
    const userData = JSON.parse(userDataString);
    const userName = userData.nombre;
    nameProfile.innerText = userName
    const userSurname = userData.apellido;
    surnameProfile.innerText = userSurname
    const userEmail = userData.user_email;
    emailProfile.innerText = userEmail
    console.log(userEmail)
    const userUsername = userData.user_name;
    usernameProfile.innerText = userUsername;

}

  buttonEditUsername.addEventListener("click", (e) => {
    e.preventDefault();

    buttonEditUsername.style.display = "none";
    buttonOk.style.display = "flex";
    buttonCancel.style.display = "flex";

    usernameProfile.contentEditable = true;
    usernameProfile.focus();
    usernameProfile.classList.add("bg-gris");


    buttonOk.addEventListener("click", (e) => {
      e.preventDefault();
      buttonEditUsername.style.display = "flex";
      buttonOk.style.display = "none";
      buttonCancel.style.display = "none";

      usernameProfile.contentEditable = false;
      usernameProfile.classList.remove("bg-gris");

      const userData = JSON.parse(userDataString);
      const userId = userData.id_user;
      const username = usernameProfile.innerText;

      fetch("./db/update-username.php", {
        method: "POST",
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({userId: userId, username: username}),
      })
      .then((response) => {
        if (!response.ok) {
          throw new Error("La solicitud ha fallado");
        }
        return response.json();
      })
      .then((data) => {
        console.log(data);
        if (data.success) {
          alert("Usuario actualizado con éxito");
          window.location.href = "./main.php";}
        })
    })


    buttonCancel.addEventListener("click", (e) => {
      e.preventDefault();
      buttonEditUsername.style.display = "flex";
      buttonOk.style.display = "none";
      buttonCancel.style.display = "none";

      usernameProfile.contentEditable = false;
      usernameProfile.classList.remove("bg-gris");
    })

    })




  buttonDeleteProfile.addEventListener("click", (e) => {
    e.preventDefault();
    console.log("Borrar perfil");

    const userData = JSON.parse(userDataString);
    const userId = userData.id_user;
    console.log(userId)

    fetch("./db/delete-user.php", {
      method: "POST",
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({userId: userId}),
    })
    .then((response) => {
      if (!response.ok) {
        throw new Error("La solicitud ha fallado");
      }
      return response.json();
    })
    .then((data) => {
      console.log(data);
      if (data.success) {
        alert("Usuario borrado con éxito");
        window.location.href = "./index.php";
      } else {
        alert("Error al borrar el usuario");
      }
    })
    .catch((error) => {
      console.error("Error al borrar el usuario:", error);
    });
  })
})

