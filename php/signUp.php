<!DOCTYPE html>
<html>
<head>
	<style>
		.erregistroa{
			width: 400px;
			border: 5px solid ;
			padding: 25px;
			margin: auto;
			background-color: rgb(191, 164, 191);
		}
	</style>
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script>
		function epostaBalidatu(){
			$eposta = document.getElementById('eposta').value;
			$data = ("eposta="+$eposta);
			$.ajax({
				  type:'POST',
				  url:'balidatuEposta.php',
				  data: $data,
				  success: function(data){$('#epostaMatrikulatuta').fadeIn().html(data);}	 
			});
			
		}
		function pasahitzaBalidatu(){
			$pasahitza = document.getElementById('pasahitza').value;
			$data = ("pasahitza="+$pasahitza);
			$.ajax({
				  type:'POST',
				  url:'balidatuPasahitza.php',
				  data: $data,
				  success: function(data){$('#pasahitzaBaliozkoa').fadeIn().html(data);}
			});
			
		}
		function disableAll(){ 
			document.getElementById("deiturak").disabled = true; 
			document.getElementById("pasahitza").disabled = true; 
			document.getElementById("pasahitzaerrepikatu").disabled = true; 
			document.getElementById("argazkia").disabled = true; 
			document.getElementById("submit").disabled = true;
		}
		function enableInputs(){
			document.getElementById("deiturak").disabled = false; 
			document.getElementById("pasahitza").disabled = false; 
			document.getElementById("pasahitzaerrepikatu").disabled = false; 
			document.getElementById("argazkia").disabled = false; 
		}
		function disableSubmit(){
			document.getElementById("submit").disabled = true;
		}
		function enableSubmit(){
			document.getElementById("submit").disabled = false;
		}
		
	</script>
</head>
<body>
	
	
	<h2><center>Erregistratu zaitez</center></h2>
	<div class="erregistroa" >
	<form id="form" action="" name="erregistratzea" onsubmit="return true" method="POST"  enctype="multipart/form-data">
	Eposta(*):
	<input type="text" id="eposta" name="eposta" oninput="epostaBalidatu()"><span style="color:red" id="epostaEgiaztatu"></span>
	<br><br>
	Deiturak(*):
	<input type="text" id="deiturak" name="deiturak" disabled><span style="color:red" id="deiturakEgiaztatu"></span>
	<br><br>
	Pasahitza(*):
	<input type="password" id="pasahitza" name="pasahitza" oninput="pasahitzaBalidatu()" disabled><span style="color:red" id="pasahitzaEgiaztatu"></span>
	<br><br>
	Errepikatu pasahitza(*):
	<input type="password" id="pasahitzaerrepikatu" name="pasahitzaerrepikatu" disabled><span style="color:red" id="pasahitzaErrepikatu"></span>
	<br><br>
	Argazkia(hautazkoa):
	<input type="file" id="argazkia" accept="image/*" name="argazkia" disabled> 
	<br><br>
	
	<input type="submit" id="submit" name="erregistratu" value="Erregistratu" disabled>
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
				echo "<script language='javascript'>document.getElementById('epostaEgiaztatu').innerHTML=' Eposta ez dago ondo!'; </script>";
			}elseif(!preg_match("^([A-Z]{1}[a-z]+\s)([A-Z]{1}[a-z]+(\s)?)+$^",$deiturak)){
				echo "<script language='javascript'>document.getElementById('deiturakEgiaztatu').innerHTML= ' Deiturak ez daude ondo'; </script>";
			}elseif(!preg_match("^.{8,}^",$pasahitza)){
				echo "<script language='javascript'>document.getElementById('pasahitzaEgiaztatu').innerHTML= ' Zure pasahitzak ez ditu 8 digitu edo gehiago!'; </script>";
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
						echo "<script language='javascript'>window.location='../layout.html'; </script>";
					} else {
						echo "Error: " . $sql . "<br>" . $conn->error . "<br><br>";
						echo "<b>Ez duzu erregistratzea lortu, saiatu berriro!</b>";
						
					}
					
				}else{
					echo "<script language='javascript'>document.getElementById('epostaEgiaztatu').innerHTML=' Eposta jadanik erregistratuta dago!'; </script>";
				}
				
			}
			$conn->close();
		}else{
			echo "<script language='javascript'>document.getElementById('pasahitzaErrepikatu').innerHTML=' Pasahitzak ez dira berdinak!'; </script>";
		}
	}
	
?>
<br>
<div id=epostaMatrikulatuta>
<p>Eposta...</p>
</div>
<div id=pasahitzaBaliozkoa>
<p>Pasahitza...</p>
</div>
</body>	
</html>