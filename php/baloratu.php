<?php
	sleep(1);
	$id = (int)$_POST["id"];

	if($_POST["balorazioa"]=="Bai"){
		$balorazioa = 1;
	}else{
		$balorazioa = -1;
	}

	include 'dbConfig.php';
	$conn = new mysqli ($servername,$username,$password,$dbname);
	if ($conn->connect_error) {
					("Connection failed: " . $conn->connect_error);
	}
	$sql1= "SELECT * FROM Questions WHERE Id=".$id;
	$result = $conn->query($sql1);
	$datuak=$result->fetch_array();
	
	$ospea = (int)$datuak['Ospea'];
	$ospeBerria = $ospea + $balorazioa;
	
	$sql2= "UPDATE Questions SET Ospea=".$ospeBerria." WHERE Id=".$id;
	$conn->query($sql2);
	
	$conn->close();
	
	echo "<div style='font-size:20px;'>Galderaren ospea: ".$ospeBerria."<br>Eskerrik asko zure iritzia emoteagaitik.</div>";
?>