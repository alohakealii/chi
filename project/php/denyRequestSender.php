<?php
session_start();
require "pdo.php";
$status = denyRequest($_SESSION["userID"], $_POST["receiverID"], $_POST["dayslot"]);
echo $status;
?>