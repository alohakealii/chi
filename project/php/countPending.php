<?php
session_start();
require "pdo.php";
$rows = countPending($_SESSION["userID"]);
echo $rows;
?>