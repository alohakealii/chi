<?php
  session_start();
  require "pdo.php";
  $username = $_POST["username"];
  $password = $_POST["password"];
  $status = verifyLogin($username, $password);
  if ($status == true) {
    $userInfo = getUserInfoByUsername($username);
    $_SESSION["username"] = $username;
    $_SESSION["firstName"] = $userInfo[0][0];
    $_SESSION["lastName"] = $userInfo[0][1];
    $_SESSION["userID"] = $userInfo[0][2];
    echo true;
  }
  else {
    echo false;
  }
?>