<?php

require_once("db.php");

$response = array();

if (
  isset($_POST["nombre-form"], $_POST["apellido-form"], $_POST["email-form"], $_POST["user-form"], $_POST["pass-form"]) &&
  $_POST["nombre-form"] != "" &&
  $_POST["apellido-form"] != "" &&
  $_POST["email-form"] != "" &&
  $_POST["user-form"] != "" &&
  $_POST["pass-form"] != ""
) {
  $nombre = $_POST["nombre-form"];
  $apellido = $_POST["apellido-form"];
  $email = $_POST["email-form"];
  $usuario = $_POST["user-form"];
  $password = $_POST["pass-form"];

  $userExist = "SELECT id_user FROM user WHERE user_name = ?";

  if ($nombreExistente = mysqli_prepare($conn, $userExist)) {
    mysqli_stmt_bind_param($nombreExistente, "s", $usuario);

    if (mysqli_stmt_execute($nombreExistente)) {
      $result = mysqli_stmt_get_result($nombreExistente);

      if ($row = mysqli_fetch_assoc($result)) {
        $response['success'] = false;
        $response['message'] = 'El nombre de usuario está en uso. Por favor, elige otro.';
      } else {
        // Usar una consulta preparada para la inserción
        $query = "INSERT INTO user (id_user, nombre, apellido, user_email, user_name, user_pass) VALUES (NULL, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $query)) {
          mysqli_stmt_bind_param($stmt, "sssss", $nombre, $apellido, $email, $usuario, $password);

          if (mysqli_stmt_execute($stmt)) {
            $response['success'] = true;
            $response['message'] = 'Usuario registrado con éxito.';
          } else {
            $response['success'] = false;
            $response['message'] = 'Error en la ejecución de la consulta de inserción: ' . mysqli_error($conn);
          }

          mysqli_stmt_close($stmt);
        } else {
          $response['success'] = false;
          $response['message'] = 'Error en la preparación de la consulta de inserción: ' . mysqli_error($conn);
        }
      }
    } else {
      $response['success'] = false;
      $response['message'] = 'Error en la ejecución de la consulta de verificación: ' . mysqli_error($conn);
    }

    mysqli_stmt_close($nombreExistente);
  } else {
    $response['success'] = false;
    $response['message'] = 'Error en la preparación de la consulta de verificación: ' . mysqli_error($conn);
  }
} else {
  $response['success'] = false;
  $response['message'] = 'Completa todos los campos';
}

header('Content-Type: application/json');
echo json_encode($response);
?>
