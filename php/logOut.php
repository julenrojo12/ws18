<?php
include 'segurtasuna.php';
 
$user = $_SESSION['erabiltzailea'];

echo "<br><b>$user</b>-(r)en sesioa itxita";
echo " <br><a href='../layout.html'>Home</a>";
session_destroy();
?>

