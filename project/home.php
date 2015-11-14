<?php
session_start();
$firstname = $_SESSION["firstName"];
echo "<h1>hello $firstname!</h1>"

?>