<?php
    include "pdo.php";
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $id = insertAccount($username, $password);
    if ($id != false) {
     insertProfile($id, $firstName, $lastName, $email);
     echo true;
    }
    else{
      echo false;
    }
?>