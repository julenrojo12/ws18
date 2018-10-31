<!DOCTYPE html>
<html>
<head>
<style>
	.erregistroa{
		width: 350px;
		border: 5px solid ;
		padding: 25px;
		margin: auto;
		background-color: rgb(191, 164, 191);
	}
</style>
</head>
<body>
	<h2><center>Erregistratu zaitez</center></h2>
	<div class="erregistroa" >
	<form id="form" action="" name="erregistratzea" onsubmit="return true" method="POST"  enctype="multipart/form-data">
	Eposta(*):
	<input type="text" id="eposta" name="eposta">
	<br><br>
	Deiturak(*):
	<input type="text" id="deiturak" name="deiturak">
	<br><br>
	Pasahitza(*):
	<input type="password" id="pasahitza" name="pasahitza" >
	<br><br>
	Errepikatu pasahitza(*):
	<input type="password" id="pasahitzaerrepikatu" name="pasahitzaerrepikatu" >
	<br><br>
	Argazkia(hautazkoa):
	<input type="file" id="argazkia" accept="image/*" name="argazkia"> 
	<br><br>
	
	<input type="submit" name="erregistratu" value="Erregistratu">
	</form>
 <?php
  
	include 'dbConfig.php';
	
	if(isset($_POST['erregistratu'])){
		$eposta= $_POST["eposta"];
		$deiturak = $_POST["deiturak"];
		$pasahitza =$_POST["pasahitza"];
		$pasahitzaerrepikatu = $_POST["pasahitzaerrepikatu"];

		
		
		$irudia = $_FILES["argazkia"]["tmp_name"];
		if($irudia){
			$irudiarenEdukia = file_get_contents($irudia);
			$irudiaKodetuta = base64_encode($irudiarenEdukia);
		}
		
		$conn = new mysqli ($servername,$username,$password,$dbname);
		if ($conn->connect_error) {
			("Connection failed: " . $conn->connect_error);
		}
		if($pasahitza==$pasahitzaerrepikatu){
				
			if(!preg_match("^([a-z]{3,})([0-9]{3})@ikasle\.ehu\.eus$^",$eposta)){
				echo "Eposta ez dago ondo, saiatu berriro!";
				
			}elseif(!preg_match("^([A-Z]{1}[a-z]+\s)([A-Z]{1}[a-z]+(\s)?)+$^",$deiturak)){
				echo "Deiturak ez daude ondo, saiatu berirro!";
				
			}elseif(!preg_match("^.{8,}^",$pasahitza)){
				echo "Pasahitzak ez ditu 8 digitu edo gehiago!";
				
			}else{
				
				
				
				$sql = "SELECT * FROM Erabiltzaileak WHERE Eposta='$eposta'";
				$result = $conn->query($sql);
				
				if ($result->num_rows == 0) {
					if($irudia){
					$sql = "INSERT INTO Erabiltzaileak (Eposta, Deiturak, Pasahitza, Argazkia)
					VALUES ('$eposta', '$deiturak', '$pasahitza', '$irudiaKodetuta')";
					}else{
						$sql = "INSERT INTO Erabiltzaileak (Eposta, Deiturak, Pasahitza)
						VALUES ('$eposta', '$deiturak', '$pasahitza')";
					}
					
					if ($conn->query($sql) === TRUE) {
						echo "New record created successfully<br><br>";
						echo "<b>Ondo! Erregistratzea lortu duzu!</b>";
						echo "<script language='javascript'>window.location='../layout.html'; </script>";
					} else {
						echo "Error: " . $sql . "<br>" . $conn->error . "<br><br>";
						echo "<b>Ez duzu erregistratzea lortu, saiatu berriro!</b>";
						
					}
					
				}else{
					echo "Eposta jadanik erregistratuta dago";
				}
				
			}
			$conn->close();
		}else{
			echo "Pasahitzak ez dira berdinak, saiatu berriro!";
		}
	}
	
?>
</body>	
</html>