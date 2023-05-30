<?php
// ConnectionDB.php

$sname = "127.0.0.1";
$uname = "root";
$password = "root";
$db_name = "EastWestB";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
    echo "Connection Failed!";
    exit();
}
?>
