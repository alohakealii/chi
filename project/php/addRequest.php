<?php
  session_start();
  require "pdo.php";
  $userID = $_SESSION["userID"];
  $targetID = $_POST["targetID"];
  $daySlot = $_POST["daySlot"];
  if (verifyRequest($userID, $targetID, $daySlot) == false) {
    $status = addRequest($userID, $targetID, $daySlot);
    echo $status;
  }
  else {
    echo false;
  }
?>