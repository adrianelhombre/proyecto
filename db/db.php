<?php
$host="localhost";
$user="root";
$password="";
$database="proyecto";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}
?>
