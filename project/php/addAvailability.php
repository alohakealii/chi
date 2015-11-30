<?php
  session_start();
  require "pdo.php";
  $userID = $_SESSION['userID'];
  $dayslot = $_POST['dayslot'];
  $status = addAvailability($userID, $dayslot);
  echo $status;
?>