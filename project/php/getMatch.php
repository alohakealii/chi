<?php
  session_start();
  require "pdo.php";
  $userID = $_SESSION["userID"];
  $rows = getMatch($userID);
  header('Content-Type: application/json');
  if ($rows != 0) {
    $rows = json_encode($rows); 
  }
  echo $rows;
?>