<?php session_start(); ?>

<html>
<head>
<style>
	.form{
		width: 350px;
		border: 5px solid ;
		padding: 25px;
		margin: auto;
		background-color: rgb(191, 164, 191);
	}
</style>
</head>
<body>
	<h2><center>Pasahitz berrezarpena</center></h2>
	<div class="form" >
	<form id="form" action="" name="form" onsubmit="return true;" method="POST"  enctype="multipart/form-data" >
	Eposta(*):
	<input type="text" id="eposta" name="eposta">
	<br><br>
	Pasahitz berria(*):
	<input type="password" id="pasahitza" name="pasahitza">
	<br><br>
	Errepikatu pasahitz berria(*):
	<input type="password" id="pasahitzaErrepikatu" name="pasahitzaErrepikatu">
	<br><br>
	Berrezarpen kodea(*):
	<input type="text" id="kodea" name="kodea">
	<br><br>
	<input type="submit" name="berrezarri" value="Berrezarri"> <input type="reset" name="erreseteatu" value="Erreseteatu">
	</form>
	
 
</body>	
</html>

<?php 
include 'dbConfig.php';

if(isset($_POST['berrezarri'])){
	
	$eposta = $_POST['eposta'];
	$pasahitza = $_POST['pasahitza'];
	$pasahitzaErrepikatu = $_POST['pasahitzaErrepikatu'];
	$kodea = $_POST['kodea'];
	
	if(isset($eposta) && isset($pasahitza) && isset($pasahitzaErrepikatu) && isset($kodea)){
		if($pasahitza==$pasahitzaErrepikatu){
			if($_SESSION['eposta']==$eposta && $_SESSION['code']==$kodea){
				$conn = new mysqli ($servername,$username,$password,$dbname);
				if ($conn->connect_error) {
								("Connection failed: " . $conn->connect_error);
				}
				$pasahitzaZifratuta = password_hash($pasahitza,PASSWORD_BCRYPT);
				$sql= "UPDATE Erabiltzaileak SET Pasahitza='$pasahitzaZifratuta' WHERE Eposta='$eposta'";
				$conn->query($sql);
				echo "<script>alert('Pasahitza berrezarrita!');</script>";
				echo "<script language='javascript'>window.location='logIn.php'; </script>";
			}else{
				echo "Eposta edo kodea txarto daude";
			}
		}else{
			echo "Pasahitza ez da ondo errepikatu";
		}
	}else{
		echo "Bete eremu guztiak";
	}
	
}



?>