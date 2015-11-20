<?php
    include "pdo.php";
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id = insertAccount($username, $password);
    insertProfile($id, $firstName, $lastName);
?>