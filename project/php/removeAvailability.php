<?php
  session_start();
  require "pdo.php";
  $userID = $_SESSION["userID"];
  // $day = $_POST["day"];
  // $time = $_POST["time"];
  $dayslot = $_POST["dayslot"];

  $status = removeAvailability($userID, $dayslot);
  echo $status;
?>