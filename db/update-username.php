<?php
require_once("db.php");

// Obtén el cuerpo de la solicitud JSON y decódificalo
$inputJSON = json_decode(file_get_contents('php://input'), true);

$response = array();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($inputJSON['userId'])) {
    // Obtén el ID de usuario del cuerpo de la solicitud
    $id = $inputJSON['userId'];
    $username = $inputJSON['username']; 

    $queryUser = "SELECT id_user FROM user WHERE user_name = ?";

    if ($usernameExist = mysqli_prepare($conn, $queryUser)) {
      mysqli_stmt_bind_param($usernameExist, "s", $username);

      if (mysqli_stmt_execute($usernameExist)) {
        $result = mysqli_stmt_get_result($usernameExist);

        if ($row = mysqli_fetch_assoc($result)) {
          $response['success'] = false;
          $response['message'] = 'El nombre de usuario ya existe';
        } else {
          // Utiliza una sentencia preparada para prevenir inyección SQL
          $query = "UPDATE user SET user_name = ? WHERE id_user = ?";
          
          if ($stmt = mysqli_prepare($conn, $query)) {
              mysqli_stmt_bind_param($stmt, "si", $username, $id);  // "si" indica que los parámetros son de tipo string e integer
      
              if (mysqli_stmt_execute($stmt)) {
                  $response['success'] = true;
                  $response['message'] = 'Usuario actualizado con éxito';
              } else {
                  $response['success'] = false;
                  $response['message'] = 'Error al actualizar el usuario';
              }
      
              mysqli_stmt_close($stmt);
          } else {
              $response['success'] = false;
              $response['message'] = 'Error en la preparación de la consulta: ' . mysqli_error($conn);
          }
        }
      }
    } 
  } else {
    $response['success'] = false;
    $response['message'] = 'ID de usuario no proporcionado en la solicitud';
  }

// Devuelve la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>