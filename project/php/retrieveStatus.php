<?php
session_start();
require "pdo.php";
$rows = retrieveStatus($_SESSION["userID"], $_POST["targetID"]);
header('Content-Type: application/json');
if ($rows != 0) {
  $rows = json_encode($rows); 
}
echo $rows;
?>