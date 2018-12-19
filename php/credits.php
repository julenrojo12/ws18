<?php include 'segurtasuna.php'; ?>
<!DOCTYPE html>
<html>
	<head>
		<style>
			.credits{
				width: 500px;
				border-radius: 25px;
				border: 2px solid #73AD21;
				padding: 20px;
				margin: auto;
				background-color: rgb(162, 253, 255);
				  
			}
			body{
				background-color: rgb(186, 254, 6);
			}
		
		</style>
	</head>
	<body>
	<?php 
	if($log!="Anonymous"){
		$eposta = $_SESSION['erabiltzailea'];
		echo $eposta;

		include 'dbConfig.php';

		$conn = new mysqli ($servername,$username,$password,$dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT * FROM Erabiltzaileak WHERE Eposta='$eposta'";
		$result = $conn->query($sql);
		$datuak=$result->fetch_array();
		
		if($datuak["Argazkia"]!= null){
			echo '<img src="data:image/jpeg;base64,' . $datuak["Argazkia"] . '" width="25" height="30"/>'; 
		}else{
			//Argazki predeterminatua jartzen du
			echo '<img src="../images/sin_avatar.jpg" width="25" height="30"/>'; 
		}
		$conn->close();
	}
	
			  
	?>
		<h2><center><b>CREDITS</b></center></h2>
		<div class="credits">
		<b>Deiturak:</b> Mikel Galarza eta Julen Rojo
		<br><br>
		<b>Espezialitatea:</b> Softwarearen Ingenieritza
		
		<br><br>
		<img src="../images/maxresdefault.jpg" alt="Mikel eta Julen argazkia" width="500" height="300">
		<br><br>
		<b>Bizilekua:</b> Bilbao-Berriz
		
		<br><br>
		</div>
		<?php
			if(isset($_SESSION['erabiltzailea']) ){
				echo "<center><a href='layoutLogged.php'>Home</a></center>";
			}else{
				echo "<center><a href='../layout.html'>Home</a></center>";
			}
		?>
	
	</body>
</html>
