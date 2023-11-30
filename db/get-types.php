<?php
  require_once("db.php");

  if ($_SERVER["REQUEST_METHOD"] === "GET") {
      $types = array();
      $query = "SELECT * FROM tipo_ejercicios";
      $result = mysqli_query($conn, $query);

      while ($row = mysqli_fetch_assoc($result)) {
          $types[] = $row;
      }
      
      mysqli_close($conn);

      header("Content-Type: application/json");
      echo json_encode($types);
  } else {
    echo "Error";
  }
?>
