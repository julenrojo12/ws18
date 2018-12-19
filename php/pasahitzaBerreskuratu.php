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
	<h2><center>E-mail bat bidaliko da hurrengo helbidera:</center></h2>
	<div class="form" >
	<form id="form" action="" name="form" onsubmit="return true;" method="POST"  enctype="multipart/form-data" >
	Eposta(*):
	<input type="text" id="eposta" name="eposta">
	<br><br>
	<input type="submit" name="bidali" value="Bidali"> <input type="reset" name="erreseteatu" value="Erreseteatu">
	</form>
	
 
</body>	
</html>

<?php 
include 'dbConfig.php';

if(isset($_POST['bidali'])){
	if(isset($_POST['eposta'])){
		$eposta = $_POST['eposta'];
		
		$conn = new mysqli ($servername,$username,$password,$dbname);
		if ($conn->connect_error) {
						("Connection failed: " . $conn->connect_error);
		}
		$sql= "SELECT * FROM Erabiltzaileak WHERE Eposta='$eposta'";
		
		$result=$conn->query($sql);
		
		if($result->num_rows!=0){
			$to = $eposta;
			$subject = "Pasahitzaren berrezarpena";
			$code = rand(10000,99999);
			$_SESSION['code'] = $code;
			$_SESSION['eposta'] = $eposta;
			$message = "
			<html>
			<head>
			<title>Pasahitzaren berrezarpena</title>
			</head>
			<body>
			<h3>Pasahitza berrezartzeko pausuak:</h3>
			<ol>
			<li>Sartu jarraian agertzen den link-an.</li>
			<li>Sartu agertzen den kodea eta pasahitza berria.</li>
			<li>Dena ondo joan bada notifikatu zaizu.</li>
			</ol>
			<h3>Pasahitza berrezartzeko orria:</h3>
			<h2><a href='https://wsjulmik.000webhostapp.com/php/pasahitzaBerreskuratuKodearekin.php?email=".$eposta."'>https://wsjulmik.000webhostapp.com/php/pasahitzaBerreskuratuKodearekin.php</a></h2>
			<h3>Berrezarpen kodea:</h3>
			<h2>".$code."</h2>
			</body>
			</html>
			";
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			mail($to,$subject,$message,$headers);
			echo "Mail-a bidalita. Minutu batzuk tardatu ahal du.";
		}else{
			echo "Eposta ez dago erregistratuta.";
		}
	}
}



?>