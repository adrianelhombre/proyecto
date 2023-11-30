const tipoEjercicio = document.getElementById("tipo-ejercicio-new");
const defaultOption = document.createElement("option");

export function loadTypes() {
  fetch("./db/get-types.php")
      .then((response) => {
          if (!response.ok) {
              throw new Error("La solicitud ha fallado");
          }
          return response.json();
      })
      .then((data) => {
          defaultOption.value = "";
          defaultOption.textContent = "Seleccione un tipo...";
          tipoEjercicio.appendChild(defaultOption);

          tipoEjercicio.addEventListener("click", (e) => {
              e.preventDefault();
              defaultOption.disabled = true;
          })

          data.forEach((type) => {
              const option = document.createElement("option");
              option.value = type.nombre_tipo;
              option.textContent = type.nombre_tipo;
              tipoEjercicio.appendChild(option);
          });
      })
      .catch((error) => {
          console.error("Error al cargar ejercicios:", error);
      });
}