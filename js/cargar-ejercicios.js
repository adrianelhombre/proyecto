const grid = document.querySelector(".grid-fluid");

export function loadExercises() {
  fetch("./db/get-exercises.php")
    .then((response) => {
      if (!response.ok) {
        throw new Error("La solicitud ha fallado");
      }
      return response.json();
    })
    .then((data) => {
        grid.innerHTML = "";
        data.forEach((exercise) => {
            const div = document.createElement("div");
            div.classList.add("container-ejercicio");
            div.innerHTML = `
                <div class='contenedor-img'>
                  <button id='btn-modal' class='btn-modal' data-exercise-id="${exercise.id_ejercicio}"><img src='./assets/enlace-externo.png' class='icono-peq'></button>
                  <img class="img-ejercicio" src="${exercise.img_ejercicio || './assets/imagen-defecto.jpg'}" alt="imagen ejercicio">
                </div>
                <div class="nombre-ejercicio">
                    <figcaption>${exercise.nombre_ejercicio}</figcaption>
                </div>
                <div class="tipo-ejercicio">
                    <span>${exercise.user_name}</span>
                </div>
            `;
            grid.appendChild(div);
        });
    })
    .catch((error) => {
      console.error("Error al cargar ejercicios:", error);
    });
}
