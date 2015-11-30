<?php
session_start();
require "pdo.php";
$rows = retrievePending($_SESSION["userID"]);
header('Content-Type: application/json');
if ($rows != 0) {
  $rows = json_encode($rows); 
}
echo $rows;
?>