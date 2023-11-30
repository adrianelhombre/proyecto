<?php
require_once("db.php");

// Obtén el cuerpo de la solicitud JSON y decódificalo
$inputJSON = json_decode(file_get_contents('php://input'), true);

$response = array();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($inputJSON['userId'])) {
    // Obtén el ID de usuario del cuerpo de la solicitud
    $id = $inputJSON['userId'];

    // Utiliza una sentencia preparada para prevenir inyección SQL
    $query = "DELETE FROM user WHERE user.id_user = ?";
    
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $id);
        
        if (mysqli_stmt_execute($stmt)) {
            $response['success'] = true;
            $response['message'] = 'Usuario borrado con éxito';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error al borrar el usuario';
        }

        mysqli_stmt_close($stmt);
    } else {
        $response['success'] = false;
        $response['message'] = 'Error en la preparación de la consulta: ' . mysqli_error($conn);
    }
} else {
    $response['success'] = false;
    $response['message'] = 'ID de usuario no proporcionado en la solicitud';
}

// Devuelve la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>