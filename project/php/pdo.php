<?php

try {
  $con = new PDO("mysql:host=localhost;dbname=spartalunch", "root", "root");
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
  echo "<p>Connection to database failed</p>";
}

function addAvailability($userID, $day, $time) {
  global $con;
  $sql = "INSERT INTO availability(userID, day, slot) VALUES (:userID, :day, :time)";
  $q = $con -> prepare ($sql);
  try {
  $q -> execute(array(':userID' => $userID,
                      ':day' => $day,
                      ':time' => $time));
  return true;
  }
  catch (PDOException $e) {
    return false;
  }
}

function getUserInfoByUsername($username) {
  global $con;
  $sql = "SELECT firstName, lastName, profile.userID FROM profile, login WHERE login.userID = profile.userID AND login.username = :username";
  $q = $con -> prepare($sql);
  $q -> execute(array(":username" => $username));
  $rows = $q -> fetchAll();
  return $rows;
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

function removeAvailability($userID, $day, $time) {
  global $con;
  $sql = "DELETE FROM availability WHERE userID = :userID AND day = :day AND slot = :time";
  $q = $con -> prepare($sql);
  $status = $q -> execute(array(':userID' => $userID,
                      ':day' => $day,
                      ':time' => $time));
  return $status;
}

function verifyLogin($username, $password) {
  global $con;
  $sql = "SELECT * FROM login WHERE username = :username AND password = :password";
  $q = $con -> prepare($sql);
  $q -> execute(array(":username" => $username,
                      ":password" => $password));
  $rows = $q -> fetchAll(PDO::FETCH_ASSOC);
  if (count($rows) == 1) {
    return true;
  }
  else {
    return false;
  }
}

?>