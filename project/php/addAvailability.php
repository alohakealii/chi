<?php
  session_start();
  require "pdo.php";
  $userID = $_SESSION['userID'];
  $day = $_POST['day'];
  $time = $_POST['time'];
  $status = addAvailability($userID, $day, $time);
  echo $status;
?>