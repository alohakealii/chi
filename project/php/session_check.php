<?php
session_start();

if ( empty($_SESSION["firstName"]) ) {
    echo "none";
}
else {
    echo 'active'.$_SESSION["firstName"];
}

?>