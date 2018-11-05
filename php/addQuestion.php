<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script>
	function preview(event){
		
		var reader = new FileReader();
		reader.onload = function(){
			var output = document.getElementById('output-image');
			output.src = reader.result;
		}
		reader.readAsDataURL(event.target.files[0]);
		
	}
	$(document).ready(function(){
		$("#erreseteatu").click(function(){
			 $('#form')[0].reset();
			 $('#argazkia').val("");
        });
		
	});			
	</script>
	<style>
		.formularioa{
			width: 350px;
			border: 5px solid ;
   			padding: 25px;
   			margin: auto;
			background-color: rgb(191, 164, 191);
		}
	</style>
	
	
<body>

<h2><center>HTML Forms</center></h2>
<div class="formularioa" >
<form action="addQuestionWithImage.php?erabiltzailea=<?php echo $_GET['erabiltzailea']?>" id="form" name="galderenF" onsubmit="return checkForm(this);" method="POST"  enctype="multipart/form-data">

  Eposta(*):
  <input type="text" id="eposta" name="eposta" value="<?php echo $_GET['erabiltzailea']?>" required pattern="^([a-z]{3,})([0-9]{3})@ikasle\.ehu\.eus$" oninvalid="this.setCustomValidity('e-mail okerra sartu da.')" oninput="setCustomValidity('')"> 
  <br><br><br>
  Galdera(*):
  <input type="text" id="galdera" name="galdera" required pattern=".{10,}" oninvalid="this.setCustomValidity('Galderak gutxienez 10 hitz izan behar ditu')" oninput="setCustomValidity('')">
  <br><br>
  Erantzun zuzena(*):
  <input type="text" id="erantzunZuzena" name="erantzunZuzena" required pattern=".{1,}" oninvalid="this.setCustomValidity('Erantzun zuzena hutsik dago.')" oninput="setCustomValidity('')">
  <br><br>
  
  Erantzun okerra 1(*):
  <input type="text" id="erantzunOkerra1" name="erantzunOkerra1" required pattern=".{1,}" oninvalid="this.setCustomValidity('Erantzun okerra 1 hutsik dago.')" oninput="setCustomValidity('')">
  <br><br>
  
  Erantzun okerra 2(*):
  <input type="text" id="erantzunOkerra2" name="erantzunOkerra2" required pattern=".{1,}" oninvalid="this.setCustomValidity('Erantzun okerra 2 hutsik dago.')" oninput="setCustomValidity('')">
  <br><br>
  
  Erantzun okerra 3(*):
  <input type="text" id="erantzunOkerra3" name="erantzunOkerra3" required pattern=".{1,}" oninvalid="this.setCustomValidity('Erantzun okerra 3 hutsik dago.')" oninput="setCustomValidity('')">
  <br><br><br>
  
  Galderaren zailtasuna(*):
  <input type="text" id="zailtasuna" name="zailtasuna" required pattern="^[0-5]$" oninvalid="this.setCustomValidity('zailtasuna 0 eta 5 tartean egon behar da.')" oninput="setCustomValidity('')"> 
  <br><br>
  
  Gai-arloa(*):
  <input type="text" id="gaiArloa" name="gaiArloa" required pattern=".{1,}" oninvalid="this.setCustomValidity('Gai arloa hutsik dago')" oninput="setCustomValidity('')">
  <br><br>
  
  Irudia:
  <input type="file" id="argazkia" accept="image/*" name="argazkia" onChange= "preview(event)" > <img id="output-image" width="60" height= "40" alt="preview"/> 
  <br><br>
  
  <input type="submit" value="Galdera bidali"> 
</form> 
	<br>
	<button id="erreseteatu">Erreseteatu</button>
	
</div>

<center><span><a href='layoutLogged.php?erabiltzailea=<?php echo $_GET['erabiltzailea']?>'>Home</a></span></center>
</body>
</html>
	
