
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
	if($irudia){
		$irudiarenEdukia = file_get_contents($irudia);
		$irudiaKodetuta = base64_encode($irudiarenEdukia);
	}
	
	
	if(!preg_match("^([a-z]{3,})([0-9]{3})@ikasle\.ehu\.eus$^",$eposta)){
       
        echo "Ez duzu eposta ondo sartu, saiatu berriro!";
       
    }elseif(!preg_match("^.{10,}^",$galdera)){
       
        echo "Ez duzu galdera ondo jarri, saiatu berriro!";

    }elseif(!preg_match("^.{1,}^",$erantzunZuzena)){
       
        echo "Ez duzu erantzun zuzena ondo jarri!";
       
    }elseif(!preg_match("^.{1,}^",$erantzunOkerra1) || !preg_match("^.{1,}^",$erantzunOkerra2) || !preg_match("^.{1,}^",$erantzunOkerra3)){
       
        echo "Ez dituzu erantzun okerrak ondo ipini!";
       
    }elseif(!preg_match("^[0-5]$^",$zailtasuna)){
       
        echo "Ez duzu zailtasuna ondo bete!";
       
    }elseif(!preg_match("^.{1,}^",$gaiArloa)){
       
        echo "Ez duzu gai arloa ondo bete!";
       
    }else{

		$conn = new mysqli ($servername,$username,$password,$dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		if($irudia){
			$sql = "INSERT INTO Questions (Eposta, Galdera, ErantzunZuzena, ErantzunOkerra1, ErantzunOkerra2, ErantzunOkerra3, GalderarenZailtasuna, GaiArloa, Irudia)
		VALUES ('$eposta', '$galdera','$erantzunZuzena','$erantzunOkerra1', '$erantzunOkerra2', '$erantzunOkerra3', '$zailtasuna', '$gaiArloa', '$irudiaKodetuta')";
		}else{
			$sql = "INSERT INTO Questions (Eposta, Galdera, ErantzunZuzena, ErantzunOkerra1, ErantzunOkerra2, ErantzunOkerra3, GalderarenZailtasuna, GaiArloa)
		VALUES ('$eposta', '$galdera','$erantzunZuzena','$erantzunOkerra1', '$erantzunOkerra2', '$erantzunOkerra3', '$zailtasuna', '$gaiArloa')";
		}	
		
		
		
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully<br><br>";
			echo "<b>Galdera gehitu da</b>";
			
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error . "<br><br>";
			echo "<b>Ez da galdera gehitu</b>";
			
		}
		
		$conn->close();
	}
?> 
<br><br>
<a href='addQuestion.php?erabiltzailea=<?php echo $_GET['erabiltzailea']?>'>Beste galdera bat gehitu</a> <br><br>
<a href='showQuestions.php?erabiltzailea=<?php echo $_GET['erabiltzailea']?>'>Galderak erakutsi</a> <br><br>
<a href='showQuestionsWithImages.php?erabiltzailea=<?php echo $_GET['erabiltzailea']?>'>Galderak erakutsi (irudiarekin)</a> <br><br>
<a href='layoutLogged.php?erabiltzailea=<?php echo $_GET['erabiltzailea']?>'>Home</a>



