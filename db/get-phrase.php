<?php
  require_once("db.php");

  if ($_SERVER["REQUEST_METHOD"] === "GET") {
      $phrases = array();
      $query = "SELECT * FROM frases";
      $result = mysqli_query($conn, $query);

      while ($row = mysqli_fetch_assoc($result)) {
          $phrases[] = $row;
      }
      
      mysqli_close($conn);

      header("Content-Type: application/json");
      echo json_encode($phrases);
  } else {
    echo "Error";
  }
?>