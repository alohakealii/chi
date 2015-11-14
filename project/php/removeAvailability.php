<?php
session_start();

$userID = $_SESSION["userID"];


$status = removeAvailability($userID, $day, $time);
echo $status;
?>