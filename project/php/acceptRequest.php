<?php
session_start();
require "pdo.php";
$status = acceptRequest($_POST["senderID"], $_SESSION["userID"], $_POST["dayslot"]);
echo $status;
// echo true;
?>