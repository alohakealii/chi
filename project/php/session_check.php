<?php
session_start();

if ( empty($_SESSION["firstName"]) ) {
    echo "none";
    // echo false;
}
else {
    echo 'active'.$_SESSION["firstName"];
    // echo true;
}

?>