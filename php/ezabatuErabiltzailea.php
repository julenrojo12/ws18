<?php
	include 'dbConfig.php';
	$conn = new mysqli ($servername,$username,$password,$dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$user = $_GET['erabiltzailea'];
	$sql = "DELETE FROM Erabiltzaileak WHERE Eposta='$user'";
	$result = $conn->query($sql);
	$conn->close();
	echo "<b>$user</b> erabiltzailea ezabatuta <br>"; 
	echo "<a href='handlingAccounts.php'>Sakatu hemen taula eguneratzeko</a>";
			
?>