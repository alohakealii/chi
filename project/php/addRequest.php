<?php
  session_start();
  require "pdo.php";
  $userID = $_SESSION["userID"];
  $targetID = $_POST["targetID"];
  $daySlot = $_POST["daySlot"];
  $status = addRequest($userID, $targetID, $daySlot);
  echo $status;
?>