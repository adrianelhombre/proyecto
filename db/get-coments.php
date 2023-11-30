<?php
require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["id_ejercicio"])) {
        $id_ejercicio = $_GET["id_ejercicio"];
        $coments = array();

        $query = "SELECT c.*, u.user_name FROM comentarios c
                  JOIN user u ON c.id_user = u.id_user
                  WHERE c.id_ejercicio = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id_ejercicio);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            $coments[] = $row;
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        header("Content-Type: application/json");
        echo json_encode($coments);
    } else {
        echo "Error: Se requiere un ID de ejercicio.";
    }
} else {
    echo "Error";
}
?>
