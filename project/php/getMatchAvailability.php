<?php
  session_start();
  require "pdo.php";
  $userID = $_SESSION["userID"];
  $targetID = $_POST["targetID"];
  $rows = getMatchAvailability($userID, $targetID);
  header('Content-Type: application/json');
  if ($rows != 0) {
    $rows = json_encode($rows); 
  }
  echo $rows;
?>