<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModalButton">&times;</span>
        <h2 id="modalTitle"></h2>
        <p id="modalMessage"></p>
        <input type="text" id="edit-nombre" placeholder="Nuevo Nombre" required>
        <input type="text" id="edit-duracion" placeholder="Nueva Duración (minutos)" required>
        <input type="text" id="edit-tipo" placeholder="Nuevo Tipo" required>
        <textarea id="edit-descripcion" placeholder="Nueva Descripción" required></textarea>
        <button type="submit">Guardar</button>
    </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
  var modal = document.getElementById("myModal");

  document.getElementById("closeModalButton").addEventListener("click", function() {
      modal.style.display = "none";
  });

  window.addEventListener("click", function(event) {
      if (event.target == modal) {
          modal.style.display = "none";
      }
  });
});

function showModal(title, message) {
  var modal = document.getElementById("myModal");
  var modalTitle = document.getElementById("modalTitle");
  var modalMessage = document.getElementById("modalMessage");

  modalTitle.innerText = title;
  modalMessage.innerText = message;
  modal.style.display = "block";
}
</script>