

<?php

	include 'dbConfig.php';
	
	$conn = new mysqli ($servername,$username,$password,$dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * FROM Questions";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {
			echo "Id: " . $row["Id"] . "<br> Eposta: ". $row["Eposta"]. "<br> Galdera: ". $row["Galdera"]. "<br>Erantzun zuzena: " . $row["ErantzunZuzena"] . "<br>Erantzun okerra 1: " . $row["ErantzunOkerra1"] . "<br>Erantzun okerra 2: " . $row["ErantzunOkerra2"] .  "<br>Erantzun okerra 3: " . $row["ErantzunOkerra3"] . "<br>Galderaren zailtasuna: " . $row["GalderarenZailtasuna"] . "<br>Gai-arloa: " . $row["GaiArloa"]."<br>Irudia: ".$row["Irudia"]."<br><br><br>";
		}
	} else {
		echo "0 results";
	}

	$conn->close();
?>