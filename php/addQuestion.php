
 <?php
 
	include 'dbConfig.php';

	
	$eposta = htmlspecialchars($_POST['eposta']);
	$galdera = htmlspecialchars($_POST["galdera"]);
	$erantzunZuzena = htmlspecialchars($_POST["erantzunZuzena"]);
	$erantzunOkerra1 = htmlspecialchars($_POST["erantzunOkerra1"]);
	$erantzunOkerra2 = htmlspecialchars($_POST["erantzunOkerra2"]);
	$erantzunOkerra3 = htmlspecialchars($_POST["erantzunOkerra3"]);
	$zailtasuna = htmlspecialchars($_POST["zailtasuna"]);
	$gaiArloa = htmlspecialchars($_POST["gaiArloa"]);
	
	$irudia = $_FILES["argazkia"]["tmp_name"];
	$irudiarenEdukia = file_get_contents($irudia);
	$irudiaKodetuta = base64_encode($irudiarenEdukia);
	
	

	$conn = new mysqli ($servername,$username,$password,$dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	 
	$sql = "INSERT INTO Questions (Eposta, Galdera, ErantzunZuzena, ErantzunOkerra1, ErantzunOkerra2, ErantzunOkerra3, GalderarenZailtasuna, GaiArloa, Irudia)
	VALUES ('$eposta', '$galdera','$erantzunZuzena','$erantzunOkerra1', '$erantzunOkerra2', '$erantzunOkerra3', '$zailtasuna', '$gaiArloa', '$irudiaKodetuta')";
	
	
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully<br><br>";
		echo "<b>Galdera gehitu da</b>";
		
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error . "<br><br>";
		echo "<b>Ez da galdera gehitu</b>";
		
	}

	$conn->close(); 
?> 
<br><br>
<a href='../addQuestion.html'>Beste galdera bat gehitu</a> <br><br>
<a href='./showQuestions.php'>Galderak erakutsi</a> <br><br>
<a href='./showQuestionsWithImages.php'>Galderak erakutsi (irudiarekin)</a> <br><br>
<a href='../layout.html'>Home</a>



