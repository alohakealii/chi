<?php
session_start();
require "pdo.php";
$status = denyRequest($_POST["senderID"], $_SESSION["userID"], $_POST["dayslot"]);
echo $status;
?>