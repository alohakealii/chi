<?php
  session_start();
  require "pdo.php";
  $userID = $_SESSION["userID"];
  $receiverID = $_POST["userID"];
  $daySlot = $_POST["dayslot"];
  $status = addNotification($userID, $receiverID, 'accepted', $daySlot);
  echo $status;
?>