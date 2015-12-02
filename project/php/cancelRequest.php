<?php
session_start();
require "pdo.php";
$status = cancelRequest($_POST["senderID"], $_SESSION["userID"], $_POST["dayslot"]);
echo $status;
?>