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

function getMatch($userID) {
  global $con;
  $sql = "
    SELECT firstName, lastName, availability.userID, availability.day, availability.slot 
    FROM profile, availability, (SELECT * FROM availability WHERE userid = :userID) as a
    WHERE availability.day = a.day AND availability.slot = a.slot AND availability.userid != :userID AND profile.userID = availability.userID
  ";
  $q = $con -> prepare($sql);
  $q -> execute(array(":userID" => $userID));
  $rows = $q -> fetchAll();
  if (count($rows) == 0) {
    return 0;
  }
  else {
    return $rows;
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
  $q -> execute(array(':userID' => $userID,
                      ':day' => $day,
                      ':time' => $time));
  $status = $q -> rowCount();
  return $status;
}

function retrieveAvailability($userID) {
  global $con;
  $sql = "SELECT day, slot FROM availability WHERE userID = :userID ORDER BY FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday')";
  $q = $con -> prepare($sql);
  $q -> execute(array(':userID' => $userID));
  $rows = $q -> fetchAll();
  if (count($rows) == 0) {
    return 0;
  }
  else {
    return $rows;
  }
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

function updateProfile($userID, $firstName, $lastName, $age, $gender, $description) {
  global $con;
  $sql = "UPDATE profile SET firstName = :firstName, lastName = :lastName, age = :age, gender = :gender, description = :description WHERE userID = :userID";
  $q = $con -> prepare($sql);
  $q -> execute(array(":userID" => $userID,
                      ":firstName" => $firstName,
                      ":lastName" => $lastName,
                      ":age" => $age,
                      ":gender" => $gender,
                      ":description" => $description));
}

function checkForGuest($userID, $firstName, $lastName, $age, $gender, $description){
  global $con;
  $sql = "SELECT userID FROM profile WHERE firstName = :firstName, lastName = :lastName, age = :age, gender = :gender, description = :description";
  $q = $con -> prepare($sql);
  $q -> execute(array(":firstName" => $firstName,
                      ":lastName" => $lastName,
                      ":age" => $age,
                      ":gender" => $gender,
                      ":description" => $description));
  $data = $q -> fetchAll();
  if ($data[0]['userID'] == $userID){
    return true;
  }
  else{
    return false;
  }
}
function getProfileInformation($userID){
  global $con;
  $sql = "SELECT firstName, lastName, age, gender, description FROM profile WHERE userID = :userID";
  $q = $con -> prepare($sql);
  $q -> execute(array(":userID" => $userID));
  $data = $q -> fetchAll();
  if(count($data) == 0){
    return 0;
  }else{
    return $data;  
  }
  
}
?>