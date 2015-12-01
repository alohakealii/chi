<?php
  session_start();
  require "pdo.php";
  $userID = $_SESSION["userID"];
  $dayslot = $_POST["dayslot"];

  $status = removeAvailability($userID, $dayslot);
  echo $status;
?>