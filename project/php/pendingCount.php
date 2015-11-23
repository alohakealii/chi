<?php
session_start();
require "pdo.php";
$rows = pendingCount($_SESSION["userID"]);
echo $rows;
?>