<?php session_start(); ?>
	
<html>
<head>
<style>
	.login{
		width: 350px;
		border: 5px solid ;
		padding: 25px;
		margin: auto;
		background-color: rgb(191, 164, 191);
	}
</style>
</head>
<body>
	<h2><center>Logeatu zaitez!</center></h2>
	
	<a href='../layout.html'>Home</a>
	<div class="login" >
	<form id="login" action="" name="login" onsubmit="return true;" method="POST"  enctype="multipart/form-data" >
	Eposta(*):
	<input type="text" id="eposta" name="eposta" >
	<br><br>
	
	Pasahitza(*):
	<input type="password" id="pasahitza" name="pasahitza" >
	<br><br>
		
	<input type="submit" name="logeatu" value="logeatu">
	<br><br>
	Pasahitza ahaztu duzu? Berreskuratu <a href="pasahitzaBerreskuratu.php">hemen</a>
	</form>
	
 
</body>	
</html>

<?php
include 'dbConfig.php';
	echo "<br>";
	if(isset($_POST['logeatu'])){
		
		$eposta= $_POST["eposta"];
		$pasahitza =$_POST["pasahitza"];
		
		$conn = new mysqli ($servername,$username,$password,$dbname);
		if ($conn->connect_error) {
						("Connection failed: " . $conn->connect_error);
		}
		
		$sqlEposta= "SELECT * FROM Erabiltzaileak WHERE Eposta='$eposta'";
		
		$result=$conn->query($sqlEposta);
		
		if($result->num_rows==0){
			
			echo "Ez zaude erregistratuta. Lehenengo " . "<a href='./signUp.php'>erregistratu</a>" . " zaitez.";
			
		}else{
			$row = $result->fetch_assoc();
			
			//Pasahitza zifratua konparatzeko
			if(!password_verify($pasahitza,$row["Pasahitza"])){
				echo "Ez duzu pasahitza ondo ipini! Saiatu berriro!";
				
			}else{
				
				$sql = "SELECT * FROM Erabiltzaileak WHERE Eposta='$eposta'";
				$result = $conn->query($sql);
				$datuak=$result->fetch_array();
				if($datuak['Blokeatuta']=="Bai"){
					echo "Administratzaileak erabiltzailea <b>blokeatu</b> du.";
				}else{ 
					$_SESSION['erabiltzailea']= $eposta;
					if($eposta=="admin000@ehu.eus"){
						echo "<script language='javascript'>window.location='handlingAccounts.php'; </script>";
					}else{
						echo "<script language='javascript'>window.location='handlingQuizesAJAX.php'; </script>";
					}
				}
			}		
		}
		$conn->close();
	}
	
?>