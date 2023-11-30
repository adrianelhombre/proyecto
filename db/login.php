<?php
require_once("db.php");

$response = array();

if (isset($_POST['user-name'], $_POST['user-pass']) && $_POST['user-name'] != '' && $_POST['user-pass'] != '') {
    $user_name = $_POST['user-name'];
    $user_pass = $_POST['user-pass'];

    $query = "SELECT * FROM user WHERE user_name = ? AND user_pass = ?";
    
    if ($usuarioExistente = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($usuarioExistente, "ss", $user_name, $user_pass);
        
        if (mysqli_stmt_execute($usuarioExistente)) {
            $result = mysqli_stmt_get_result($usuarioExistente);
            
            if ($row = mysqli_fetch_assoc($result)) {
                $response['success'] = true;
                $response['message'] = 'Inicio de sesión exitoso';
                $response['user_data'] = $row;
            } else {
                $response['success'] = false;
                $response['message'] = 'Usuario o contraseña inexistentes';
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'Error en la ejecución de la consulta: ' . mysqli_error($conn);
        }
        
        mysqli_stmt_close($usuarioExistente);
    } else {
        $response['success'] = false;
        $response['message'] = 'Error en la preparación de la consulta: ' . mysqli_error($conn);
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Completa todos los campos';
}

header('Content-Type: application/json');
echo json_encode($response);
?>