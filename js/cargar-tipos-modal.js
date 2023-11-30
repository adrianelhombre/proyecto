const tipo = document.getElementById("tipo-ejercicio");
const defaultOption = document.createElement("option");

export function loadTypesModal() {
  fetch("./db/get-types.php")
      .then((response) => {
          if (!response.ok) {
              throw new Error("La solicitud ha fallado");
          }
          return response.json();
      })
      .then((data) => {
        const tipoSelect = document.createElement('select');
        tipoSelect.id = "tipo-ejercicio-modal";
        tipoSelect.name = "tipo-ejercicio";
        tipoSelect.required = true;

        defaultOption.value = "";
        defaultOption.textContent = "Seleccione un tipo...";
        tipoSelect.appendChild(defaultOption);

        data.forEach((type) => {
            const option = document.createElement("option");
            option.value = type.nombre_tipo;
            option.textContent = type.nombre_tipo;
            tipoSelect.appendChild(option);
        });

        // Vaciar contenido de tipo y agregar opciones del tipoSelect
        tipo.innerHTML = "";
        tipo.replaceWith(tipoSelect);

      })
      .catch((error) => {
          console.error("Error al cargar ejercicios:", error);
  });
}