<?php

	include 'dbConfig.php';
	$conn = new mysqli ($servername,$username,$password,$dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$user = $_GET['erabiltzailea'];
	$action = $_GET['akzioa'];
	
	$sql = "SELECT Blokeatuta FROM Erabiltzaileak WHERE Eposta='$user'";
	$result = $conn->query($sql);
	$datuak=$result->fetch_array();
	
	if($action=="aktibatu"){
		if($datuak['Blokeatuta']=="Ez"){
			echo "<b>$user</b> erabiltzailea jadanik aktibatuta dago."; 
		}else{
			$sql = "UPDATE Erabiltzaileak SET Blokeatuta='Ez' WHERE Eposta='$user'";
			$result = $conn->query($sql);
			echo "<b>$user</b> erabiltzailea aktibatuta <br>"; 
			echo "<a href='handlingAccounts.php'>Sakatu hemen taula eguneratzeko</a>";
		}
	}elseif($action=="blokeatu"){
		if($datuak['Blokeatuta']=="Bai"){
			echo "<b>$user</b> erabiltzailea jadanik blokeatuta dago."; 
		}else{
			$sql = "UPDATE Erabiltzaileak SET Blokeatuta='Bai' WHERE Eposta='$user'";
			$result = $conn->query($sql);
			echo "<b>$user</b> erabiltzailea blokeatuta <br>"; 
			echo "<a href='handlingAccounts.php'>Sakatu hemen taula eguneratzeko</a>";
		}
	}
	$conn->close();
			
?>