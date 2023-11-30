<?php
require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $duracion = $_POST['duracion'];
    $tipo = $_POST['tipo'];
    $descripcion = $_POST['descripcion'];

    // Verificar si se proporcionó un nuevo nombre de imagen
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === UPLOAD_ERR_OK) {
        $imagen = basename($_FILES["imagen"]["name"]);
        $imagenPath = "../images/" . $imagen;
        $imagenNombre = "images/" .  $imagen;

        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $imagenPath)) {
            $query = "UPDATE ejercicios SET img_ejercicio = '$imagenNombre', nombre_ejercicio = '$nombre', tipo_ejercicio = '$tipo', duracion = '$duracion', descripcion = '$descripcion' WHERE id_ejercicio = '$id'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo "Datos actualizados con éxito.";
            } else {
                echo "Error al actualizar los datos.";
            }
        } else {
            echo "Error al mover el archivo al servidor.";
        }
    } else {
        $query = "UPDATE ejercicios SET nombre_ejercicio = '$nombre', tipo_ejercicio = '$tipo', duracion = '$duracion', descripcion = '$descripcion' WHERE id_ejercicio = '$id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Datos actualizados con éxito.";
        } else {
            echo "Error al actualizar los datos.";
        }
    }
} else {
    echo "Método de solicitud incorrecto.";
}
?>
