<?php
  session_start();
  require "pdo.php";
  $row = getEmail($_POST["userID"]);
  header('Content-Type: application/json');
  if ($row != 0) {
    $row = json_encode($row); 
  }
  echo $row;
?>