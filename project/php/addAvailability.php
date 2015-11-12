<?php
    include "pdo.php";
    $userID = $_POST['userID'];
    $day = $_POST['day'];
    $time = $_POST['time'];
    $availabilityID = addAvailability($userID, $day, $time);
    echo $availabilityID;
?>