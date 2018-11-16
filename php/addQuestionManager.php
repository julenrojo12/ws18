 <?php
	sleep(2);
	include 'dbConfig.php';

	
	$eposta = $_POST['eposta'];
	$galdera = $_POST["galdera"];
	$erantzunZuzena = $_POST["erantzunZuzena"];
	$erantzunOkerra1 = $_POST["erantzunOkerra1"];
	$erantzunOkerra2 = $_POST["erantzunOkerra2"];
	$erantzunOkerra3 = $_POST["erantzunOkerra3"];
	$zailtasuna = $_POST["zailtasuna"];
	$gaiArloa = $_POST["gaiArloa"];
	
	
	
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
		
		
		$sql = "INSERT INTO Questions (Eposta, Galdera, ErantzunZuzena, ErantzunOkerra1, ErantzunOkerra2, ErantzunOkerra3, GalderarenZailtasuna, GaiArloa) VALUES ('$eposta', '$galdera','$erantzunZuzena','$erantzunOkerra1', '$erantzunOkerra2', '$erantzunOkerra3', '$zailtasuna', '$gaiArloa')";
		
		
		
		
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully<br><br>";
			echo "1-Galdera gehitu da";
			
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error . "<br><br>";
			echo "<b>Ez da galdera gehitu datu-basean</b>";	
		}
		
		$conn->close();
	
		$xml = simplexml_load_file('../xml/questions.xml') or die("Error: Cannot create XML");
		$assessmentItem = $xml -> addChild('assessmentItem');
		
		$assessmentItem -> addAttribute('author',$eposta);
		$assessmentItem -> addAttribute('subject',$gaiArloa);
		
		$itemBody = $assessmentItem -> addChild('itemBody');
		$itemBody -> addChild('p',$galdera);
		
		$correctResponse = $assessmentItem -> addChild('correctResponse');
		$correctResponse -> addChild('value',$erantzunZuzena);

		$incorrectResponses = $assessmentItem -> addChild('incorrectResponses');
		$incorrectResponses -> addChild('value',$erantzunOkerra1);
		$incorrectResponses -> addChild('value',$erantzunOkerra2);
		$incorrectResponses -> addChild('value',$erantzunOkerra3);
		
		$xml->asXML('../xml/questions.xml');
		echo "<br>";
		echo "2-Galdera kargatuta questions.xml fitxategian.";
		
	}
	
?> 





