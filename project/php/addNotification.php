<?php
  session_start();
  require "pdo.php";
  $senderID = $_SESSION["userID"];
  $receiverID = $_POST["receiverID"];
  $daySlot = $_POST["dayslot"];
  $action = $_POST["action"];
  $status = addNotification($senderID, $receiverID, $action, $daySlot);
  echo $status;
?>