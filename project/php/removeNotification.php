<?php
  session_start();
  require "pdo.php";
  $status = removeNotification($_POST['senderID'], $_SESSION['userID'], $_POST['dayslot']);
  echo $status;
?>