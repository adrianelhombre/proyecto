<?php
require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $query = "DELETE FROM ejercicios WHERE ejercicios . id_ejercicio = '$id'"; 
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        echo "Datos actualizados con éxito.";
    } else {
        echo "Error al actualizar los datos.";
    }
}
?>
