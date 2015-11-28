<?php
session_start();
require "pdo.php";
$userID = $_SESSION['userID'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$description = $_POST['description'];
$status = updateProfile($userID, $firstName, $lastName, $age, $gender, $description);
echo $status;
?>