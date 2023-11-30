<?php
require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["id"])) {
        $exerciseId = $_GET["id"];
        $query = "SELECT ejercicios.*, user.id_user, user.user_name
                  FROM ejercicios
                  JOIN user ON ejercicios.user_id = user.id_user
                  WHERE ejercicios.id_ejercicio = $exerciseId";
        $result = mysqli_query($conn, $query);
        
        if ($row = mysqli_fetch_assoc($result)) {
            header("Content-Type: application/json");
            echo json_encode($row);
        } else {
            // Manejo de error si el ejercicio no se encuentra
            http_response_code(404); // Por ejemplo, un código de respuesta 404
            echo "Ejercicio no encontrado";
        }
    } else {
        // Manejo de error si no se proporciona un ID válido
        http_response_code(400); // Por ejemplo, un código de respuesta 400 (Solicitud incorrecta)
        echo "ID de ejercicio no válido";
    }
}
?>