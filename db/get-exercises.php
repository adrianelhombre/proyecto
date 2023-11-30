<?php
require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $exercises = array();
    
    // Modifica la consulta para incluir el user_name
    $query = "SELECT ejercicios.*, user.user_name
              FROM ejercicios
              JOIN user ON ejercicios.user_id = user.id_user";
    
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        if (!empty($row['img_ejercicio'])) {
            // Puedes hacer algo con la imagen aquí si es necesario
        }
        $exercises[] = $row;
    }

    header("Content-Type: application/json");
    echo json_encode($exercises);
}

