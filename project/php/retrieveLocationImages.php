<?php
require "pdo.php";
$rows = retrieveLocationImages();
header('Content-Type: application/json');
if ($rows != 0) {
  $rows = json_encode($rows);	
}
echo $rows;
?>