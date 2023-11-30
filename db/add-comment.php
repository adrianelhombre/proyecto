<?php
require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $response = array();

    // Obtener el contenido del cuerpo de la solicitud y decodificar el JSON
    $requestData = json_decode(file_get_contents("php://input"));

    if (isset($requestData->id_user, $requestData->comentario, $requestData->id_ejercicio)) {
        $id_user = $requestData->id_user;
        $comment = $requestData->comentario;
        $id_ejercicio = intval($requestData->id_ejercicio);

        $query = "INSERT INTO comentarios (id_comentario, id_ejercicio, id_user, comentario) VALUES (NULL, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "iis", $id_ejercicio, $id_user, $comment);

            if (mysqli_stmt_execute($stmt)) {
                $response['success'] = true;
                $response['message'] = 'Comentario agregado correctamente.';
            } else {
                $response['success'] = false;
                $response['message'] = 'Fallo al agregar el comentario: ' . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        } else {
            $response['success'] = false;
            $response['message'] = 'Error en la preparación de la consulta de inserción: ' . mysqli_error($conn);
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Parámetros faltantes.';
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
