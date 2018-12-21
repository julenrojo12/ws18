<?php 
include 'segurtasuna.php';

if($log=="Anonymous"){
	echo "<script language='javascript'>window.location='logIn.php'; </script>";
}else if($log=="Admin"){
	echo "<script language='javascript'>window.location='logIn.php'; </script>";
}

?>
<html>
<head>
	
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<style>
		#feedback{
			color: blue;
		}
		#galderaKont{
			font-weight: bold;
			color: red;
		}
		.argazkia{
			position: absolute;
			top: 1em;
			right: 1em;	
		}
		#formularioa{
			width: 350px;
			border: 5px solid ;
   			padding: 25px;
   			margin: auto;
		}
	</style>
	<script type="text/javascript" language = "javascript">
		var xhro= new XMLHttpRequest();
		xhro.onreadystatechange= function (){
			if (xhro.readyState==4){
				document.getElementById('bistaratu').innerHTML = xhro.responseText;
			}
		}
		
		//Galderen kontagailua 20 segunduro
		setInterval(function galderakKontatu(){
			$.ajax({
				  type:'GET',
				  url:'xmlCounter.php',
				  success: function(data){$('#galderaKont').fadeIn().html(data);},
			});
		},20000);
		
		function nireGalderakErakutsi(){ 
			xhro.open("GET",'showMyXMLQuestionsManager.php',true);
			xhro.send(null);
		}
		
		function galderaGehitu(){ 
			$eposta = document.getElementById('eposta').value;
			$galdera = document.getElementById('galdera').value;
			$erantzunZuzena = document.getElementById('erantzunZuzena').value;
			$erantzunOkerra1 = document.getElementById('erantzunOkerra1').value;
			$erantzunOkerra2 = document.getElementById('erantzunOkerra2').value;
			$erantzunOkerra3 = document.getElementById('erantzunOkerra3').value;
			$zailtasuna = document.getElementById('zailtasuna').value;
			$gaiArloa = document.getElementById('gaiArloa').value;
			$argazkia = document.getElementById('argazkia').value;
			$argazkiaEncoded = window.btoa($argazkia);
			
			
			document.getElementById('form').reset();
			$data = ("eposta="+$eposta+"&galdera="+$galdera+"&erantzunZuzena="+$erantzunZuzena+"&erantzunOkerra1="+$erantzunOkerra1+"&erantzunOkerra2="+$erantzunOkerra2+"&erantzunOkerra3="+$erantzunOkerra3+"&zailtasuna="+$zailtasuna+"&gaiArloa="+$gaiArloa+"&argazkia="+$argazkiaEncoded);
			
			$.ajax({
				  type:'POST',
				  url:'addQuestionManager.php',
				  data: $data,
				  beforeSend:function(){$('#feedback').html('<div><center> <img src="../images/loading.gif" width="250" height="200"/> </center></div>')},
				  success: function(data){$('#feedback').fadeIn().html(data);},
				  error:function(){
					$('#feedback').fadeIn().html('<p class="error"><strong> Zerbitzariak ez duela erantzuten dirudi</p>');
				  }
			}).done(function(data){
				nireGalderakErakutsi();
			});
		}
		
		
	</script>
</head>	
<body>
<span class="argazkia">
<?php 

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
			  
?>
</span>
<a href='layoutLogged.php'>Home</a>
<center><input type="button" value="Nire galderak erakutsi" onclick="nireGalderakErakutsi()">  <input type="button" value="Galdera gehitu" onclick="galderaGehitu()"> </center><br>
<div id="formularioa">
	<form action="" method="POST" onsubmit="return checkForm(this);" id="form" name="galderenF" enctype="multipart/form-data">
	  Eposta(*): <input type="text" id="eposta" name="eposta" value="<?php echo $_SESSION['erabiltzailea']?>" required pattern="^([a-z]{3,})([0-9]{3})@ikasle\.ehu\.eus$" oninvalid="this.setCustomValidity('e-mail okerra sartu da.')" oninput="setCustomValidity('')"> 
	  <br><br>
	  Galdera(*): <input type="text" id="galdera" name="galdera" required pattern=".{10,}" oninvalid="this.setCustomValidity('Galderak gutxienez 10 hitz izan behar ditu')" oninput="setCustomValidity('')">
	  <br><br>
	  Erantzun zuzena(*): <input type="text" id="erantzunZuzena" name="erantzunZuzena" required pattern=".{1,}" oninvalid="this.setCustomValidity('Erantzun zuzena hutsik dago.')" oninput="setCustomValidity('')">
	  <br><br>
	  Erantzun okerra 1(*): <input type="text" id="erantzunOkerra1" name="erantzunOkerra1" required pattern=".{1,}" oninvalid="this.setCustomValidity('Erantzun okerra 1 hutsik dago.')" oninput="setCustomValidity('')">
	  <br><br>
	  Erantzun okerra 2(*): <input type="text" id="erantzunOkerra2" name="erantzunOkerra2" required pattern=".{1,}" oninvalid="this.setCustomValidity('Erantzun okerra 2 hutsik dago.')" oninput="setCustomValidity('')">
	  <br><br>
	  Erantzun okerra 3(*): <input type="text" id="erantzunOkerra3" name="erantzunOkerra3" required pattern=".{1,}" oninvalid="this.setCustomValidity('Erantzun okerra 3 hutsik dago.')" oninput="setCustomValidity('')">
	  <br><br>
	  Galderaren zailtasuna(*): <input type="text" id="zailtasuna" name="zailtasuna" required pattern="^[0-5]$" oninvalid="this.setCustomValidity('zailtasuna 0 eta 5 tartean egon behar da.')" oninput="setCustomValidity('')"> 
	  <br><br>
	  Gai-arloa(*): <input type="text" id="gaiArloa" name="gaiArloa" required pattern=".{1,}" oninvalid="this.setCustomValidity('Gai arloa hutsik dago')" oninput="setCustomValidity('')">
	  <br><br>
	  Irudia:
	  <input type="file" id="argazkia" accept="image/*" name="argazkia"> 
	  <br><br>
	  <button type="reset">Erreseteatu</button>
	</form> 
</div>
<center>
<div id="galderaKont"></div>
<div id="feedback"></div></center>
<div id="bistaratu">
	<center><p> GALDERAK ...</p></center>
</div>
</body>
</html>