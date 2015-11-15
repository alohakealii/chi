<?php
session_start();
require "pdo.php";
$userID = $_SESSION['userID'];
$status = getProfileInformation($userID);
echo $status;
?>