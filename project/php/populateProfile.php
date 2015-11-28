<?php
session_start();
require "pdo.php";
$data = getProfileInformation($_SESSION['userID']);
header('Content-Type: application/json');
if ($data != 0){
	$data = json_encode($data);
}
echo $data;
?>