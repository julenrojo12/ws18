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
			if(isset($_GET['erabiltzailea']) ){
				echo "<center><a href='layoutLogged.php?erabiltzailea=" . $_GET['erabiltzailea'] ."'>Home</a></center>";
			}else{
				echo "<center><a href='../layout.html'>Home</a></center>";
			}
		?>
	
	</body>
</html>
