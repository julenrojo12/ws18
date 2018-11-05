<!DOCTYPE html>
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
	<div class="login" >
	<form id="login" action="" name="login" onsubmit="return true;" method="POST"  enctype="multipart/form-data" >
	Eposta(*):
	<input type="text" id="eposta" name="eposta" >
	<br><br>
	
	Pasahitza(*):
	<input type="password" id="pasahitza" name="pasahitza" >
	<br><br>
		
	<input type="submit" name="logeatu" value="logeatu">
	</form>
	
 <?php
  
  
	include 'dbConfig.php';
	
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
			if($row['Pasahitza']!=$pasahitza){
				echo "Ez duzu pasahitza ondo ipini! Saiatu berriro!";
			}else{
				echo "<script language='javascript'>window.location='layoutLogged.php?erabiltzailea=" . $eposta . "'; </script>";
				
				
			}		
		}
	}
?>
</body>	
</html>