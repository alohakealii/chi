<?php

try {
    $con = new PDO("mysql:host=localhost;dbname=spartalunch", "root", "root");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo "<p>Connection to database failed</p>";
}

function insertAccount($username, $password) {
    global $con;
    $sql = "INSERT INTO login(username, password) VALUES (:username, :password)";
    $q = $con -> prepare($sql);
    $q -> execute(array(':username' => $username,
                        ':password' => $password));

    $id = $con -> lastInsertId();
    return $id;
}

function insertProfile($id, $firstName, $lastName) {
    global $con;
    $sql = "INSERT INTO profile(userID, firstName, lastName) VALUES(:id, :firstName, :lastName)";
    $q = $con -> prepare($sql);
    $q -> execute(array(':id' => $id,
                        ':firstName' => $firstName,
                        ':lastName' => $lastName));
}

?>