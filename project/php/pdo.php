<?php

try {
  $con = new PDO("mysql:host=localhost;dbname=spartalunch", "root", "root");
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
  echo "<p>Connection to database failed</p>";
}

function acceptRequest($senderID, $receiverID, $dayslot) {
  global $con;
  $sql = "UPDATE request SET status = 'Accepted' where senderID = :senderID AND receiverID = :receiverID AND dayslot = :dayslot";
  $q = $con -> prepare ($sql);
  try {
    $q -> execute(array(':senderID' => $senderID,
                        ':receiverID' => $receiverID,
                        ':dayslot' => $dayslot));
    return true;
  }
  catch (PDOException $e) {
    return false;
  }
}

// function addAvailability($userID, $day, $time) {
//   global $con;
//   $sql = "INSERT INTO availability(userID, day, slot) VALUES (:userID, :day, :time)";
//   $q = $con -> prepare ($sql);
//   try {
//   $q -> execute(array(':userID' => $userID,
//                       ':day' => $day,
//                       ':time' => $time));
//   return true;
//   }
//   catch (PDOException $e) {
//     return false;
//   }
// }

function addAvailability($userID, $dayslot) {
  global $con;
  $sql = "INSERT INTO availability(userID, dayslot) VALUES (:userID, :dayslot)";
  $q = $con -> prepare ($sql);
  try {
  $q -> execute(array(':userID' => $userID,
                      ':dayslot' => $dayslot));
  return true;
  }
  catch (PDOException $e) {
    return false;
  }
}

function addNotification($senderID, $receiverID, $action, $dayslot) {
  global $con;
  try {
  $sql = "INSERT INTO notification(senderID, receiverID, action, dayslot) VALUES (:senderID, :receiverID, :action, :dayslot)";
  $q = $con -> prepare ($sql);
  $q -> execute(array(':senderID' => $senderID,
                      ':receiverID' => $receiverID,
                      ':action' => $action,
                      ':dayslot' => $dayslot));
  return true;
  }
  catch (PDOException $e) {
    $sql = "UPDATE notification SET action = :action WHERE senderID = :senderID AND receiverID = :receiverID AND dayslot = :dayslot";
    $q = $con -> prepare ($sql);
    $q -> execute(array(':senderID' => $senderID,
                        ':receiverID' => $receiverID,
                        ':action' => $action,
                        ':dayslot' => $dayslot));
    return true;
  }
  catch (Exception $e) {
    return false;
  }
}

function addRequest($userID, $targetID, $daySlot) {
  global $con;
  $sql = "INSERT INTO request(senderID, receiverID, dayslot) VALUES (:userID, :targetID, :daySlot)";
  $q = $con -> prepare ($sql);
  try {
  $q -> execute(array(':userID' => $userID,
                      ':targetID' => $targetID,
                      ':daySlot' => $daySlot));
  return true;
  }
  catch (PDOException $e) {
    return false;
  }
}

function countPending($userID) {
  global $con;
  $sql = "SELECT * FROM request WHERE receiverID = :userID AND status = 'Pending'";
  $q = $con -> prepare($sql);
  $q -> execute(array(':userID' => $userID));
  $rows = $q -> fetchAll();
  return count($rows);
}

function denyRequest($senderID, $receiverID, $dayslot) {
  global $con;
  $sql = "UPDATE request SET status = 'Denied' where senderID = :senderID AND receiverID = :receiverID AND dayslot = :dayslot";
  $q = $con -> prepare ($sql);
  try {
    $q -> execute(array(':senderID' => $senderID,
                        ':receiverID' => $receiverID,
                        ':dayslot' => $dayslot));
    return true;
  }
  catch (PDOException $e) {
    return false;
  }
}

function getEmail($userID) {
  global $con;
  $sql = "SELECT email FROM profile WHERE userID = :userID";
  $q = $con -> prepare($sql);
  $q -> execute(array(":userID" => $userID));
  $rows = $q -> fetchAll();
  if (count($rows) == 1) {
    return $rows;
  }
  else {
    return 0;
  }
}

function getMatch($userID) {
  global $con;
  $sql = "
    SELECT DISTINCT firstName, lastName, profile.userID
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

// gets the matching day and slot given two user ids
function getMatchAvailability($userID, $targetID) {
  global $con;
  $sql = "
    SELECT availability.dayslot
    FROM availability, (SELECT availability.dayslot FROM availability WHERE userid = :userID) as a
    WHERE availability.userID = :targetID
    AND availability.dayslot = a.dayslot
  ";
  $q = $con -> prepare($sql);
  $q -> execute(array(":userID" => $userID,
                      ":targetID" => $targetID));
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
  try {
    $q -> execute(array(':username' => $username,
                        ':password' => $password));
    $id = $con -> lastInsertId();
    return $id;
  }
  catch (PDOException $e) {
    return false;
  }

  
}

function insertProfile($id, $firstName, $lastName, $email) {
  global $con;
  $sql = "INSERT INTO profile(userID, firstName, lastName, email) VALUES(:id, :firstName, :lastName, :email)";
  $q = $con -> prepare($sql);
  $q -> execute(array(':id' => $id,
                      ':firstName' => $firstName,
                      ':lastName' => $lastName,
                      ':email' => $email));
}

function removeAvailability($userID, $dayslot) {
  global $con;
  $sql = "DELETE FROM availability WHERE userID = :userID AND dayslot = :dayslot";
  $q = $con -> prepare($sql);
  $q -> execute(array(':userID' => $userID,
                      ':dayslot' => $dayslot));
  $status = $q -> rowCount();
  return $status;
}

// retrieves users who accepted requests from param $userID
function retrieveAccepted($userID) {
  global $con;
  $sql = "SELECT receiverID, firstName, lastName, dayslot, status, email
          FROM profile, (SELECT receiverID, dayslot, status FROM request WHERE senderID = :userID AND status = 'Accepted') AS request
          WHERE profile.userID = request.receiverID";
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

function retrieveAvailability($userID) {
  global $con;
  $sql = "SELECT dayslot FROM availability WHERE userID = :userID ORDER BY FIELD(dayslot, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday')";
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

function retrieveNotification($userID) {
  global $con;
  $sql = "SELECT firstName, lastName, notification.dayslot, action
          FROM notification, profile
          WHERE notification.senderID = profile.userID AND notification.receiverID = :userID;";
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

// retrieves pending requests and requests accepted by param $userID
function retrievePending($userID) {
  global $con;
  $sql = "SELECT senderID, firstName, lastName, email, dayslot, status
          FROM profile, (SELECT senderID, dayslot, status FROM request WHERE receiverID = :userID AND (status = 'Pending' OR status = 'Accepted')) AS request
          WHERE profile.userID = request.senderID";
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

function retrieveStatus($userID, $targetID) {
  global $con;
  $sql = "SELECT dayslot, status FROM request WHERE (senderID = :userID AND receiverID = :targetID) OR (senderID = :targetID AND receiverID = :userID)";
  $q = $con -> prepare($sql);
  $q -> execute(array(':userID' => $userID,
                      ':targetID' => $targetID));
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

function getProfileInformation($userID) {
  global $con;
  $sql = "SELECT firstName, lastName, age, gender, description FROM profile WHERE userID = :userID";
  $q = $con -> prepare($sql);
  $q -> execute(array(":userID" => $userID));
  $data = $q -> fetchAll();
  if(count($data) == 0){
    return 0;
  }else {
    return $data;  
  }
}

function verifyRequest($user1, $user2, $dayslot) {
  global $con;
  $sql = "SELECT * FROM request WHERE senderID = :user2 AND receiverID = :user1";
  $q = $con -> prepare($sql);
  $q -> execute(array(":user2" => $user2,
                      ":user1" => $user1));
  $rows = $q -> fetchAll(PDO::FETCH_ASSOC);
  if (count($rows) == 0) {
    return false;
  }
  else {
    return true;
  }
}
?>