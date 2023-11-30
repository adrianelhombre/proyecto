<?php
require_once("db.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $duracion = $_POST["duracion"];
    $tipo = $_POST["tipo-ejercicio-new"];
    $descripcion = $_POST["descripcion"];
    $user_id = $_POST["user_id"];

    // Verificar si se ha subido un archivo de imagen
    if (isset($_FILES["imagen"])) {
        if ($_FILES["imagen"]["error"] === UPLOAD_ERR_OK) {
            $targetDirectory = "../images/"; 
            $targetFile = $targetDirectory . basename($_FILES["imagen"]["name"]);
            $imagenCarpeta = "images/";
            $imagen = $imagenCarpeta . basename($_FILES["imagen"]["name"]);

            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $targetFile)) {
                // Imagen subida correctamente
                echo '<p>Se ha subido la imagen</p>';
            } else {
                // Error al mover el archivo
                echo '<p>No funciona</p>';
            }
        } else {
            // Error en la subida del archivo
            echo "Error en la subida del archivo: " . $_FILES["imagen"]["error"];
        }
    }

    // Continúa con la inserción de datos en la base de datos
    $query = "INSERT INTO ejercicios (id_ejercicio, img_ejercicio, nombre_ejercicio, tipo_ejercicio, duracion, descripcion, user_id) VALUES ('', '$imagen', '$nombre', '$tipo', '$duracion', '$descripcion', '$user_id')";
    $result = mysqli_query($conn, $query);
}
?>