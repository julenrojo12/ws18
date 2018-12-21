<?php include 'segurtasuna.php'; ?>

<?php 
	if(isset($_POST["erantzunaBidali"])){
		include 'dbConfig.php';
		$id = $_POST["id"];
		if($_POST["erantzuna"]==$_POST['erantzunZuzena']){
			if(isset($_SESSION['quizer'])){
				$quizer = $_SESSION['quizer'];
				$conn = new mysqli ($servername,$username,$password,$dbname);
				$sql= "UPDATE Quizers SET Wins=Wins+1 WHERE Nick='$quizer'";
				$conn->query($sql);
			}
			echo "<script>alert('Zuzen! Galdera ondo erantzun duzu!');</script>";
			echo "<script language='javascript'>window.location='galderaBaloratu.php?id=".$id."'; </script>";
		}else{
			if(isset($_SESSION['quizer'])){
				$quizer = $_SESSION['quizer'];
				$conn = new mysqli ($servername,$username,$password,$dbname);
				$sql= "UPDATE Quizers SET Losses=Losses+1 WHERE Nick='$quizer'";
				$conn->query($sql);
			}
			$erantzuna = $_POST['erantzunZuzena'];
			echo "<script>alert('Txarto! Erantzuna: $erantzuna ');</script>";
			echo "<script language='javascript'>window.location='galderaBaloratu.php?id=".$id."'; </script>";
		}
	}
?>
<html>
<head>
<style>
body{ background-image: url(../images/background.jpg); }

.return{
	position: absolute;
	top: 1em;
	left: 1em;
	
}


</style>
<link rel="stylesheet" href="../styles/bootstrap.min.css" />
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="../js/bootstrap.min.js"></script>
</head>
<body>
	<span class="return">
	<a href='quizzes.php'><--Return</a>
	</span>
	
	<div class="container">
		<div class="jumbotron" style="background-color:aquamarine; text-align:center;">
		<h1>ONE PLAY</h1>
		<?php 	if($log!="Anonymous"){
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
						echo '<img src="data:image/jpeg;base64,' . $datuak["Argazkia"] . '" width="30" height="30"/>'; 
					}else{
						//Argazki predeterminatua jartzen du
						echo '<img src="../images/sin_avatar.jpg" width="20" height="30"/>'; 
					}
					$conn->close();
				}else{
					echo "Anonymous";
				}
				if(isset($_SESSION['quizer'])){
					$quizer = $_SESSION['quizer'];
					echo "<br>Playing as --> $quizer";
				}
			
		?>	
		</div>
	</div>
	<?php
		include 'dbConfig.php';
		
		$conn = new mysqli ($servername,$username,$password,$dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT * FROM Questions ORDER BY rand()";
		$result = $conn->query($sql);
		$datuak=$result->fetch_array();
		$conn->close();
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-4" style="font-size:20px;">
			<?php	
				if($datuak["Irudia"]!= null){
					echo '<img src="data:image/jpeg;base64,' . $datuak["Irudia"] . '" alt="Galderaren argazkia" width="200" height="150" title="Argazkia" border="0"/>'; 
				}else{
					//Argazki predeterminatua jartzen du
					echo '<img src="../images/sin_avatar.jpg" alt="Galderaren argazkia" title="Argazkia" border="0" />'; 
				}
				echo "<br><br>Gaia: ".$datuak['GaiArloa'];
				echo "<br>Zailtasuna: ".$datuak['GalderarenZailtasuna'];
				$ospea = (int)$datuak['Ospea'];
				if($ospea>0){
					echo "<br>Galderaren ospea: <span style='color:green'>".$ospea."</span>";
				}else if($ospea<0){
					echo "<br>Galderaren ospea: <span style='color:red'>".$ospea."</span>";
				}else{
					echo "<br>Galderaren ospea: ".$ospea;
				}
			?>	
			</div>
			<div class="col-md-8">
				<h2><?php echo $datuak['Galdera']; ?><h2>
				<form action="" method="POST" onsubmit="return true" name="galdera">
				<?php
				//Erantzunak orden desberdinetan agertzeko
				$zenb = rand(1,4);
				if($zenb==1){?>
					<input type="radio" name="erantzuna" value="<?php echo $datuak['ErantzunZuzena']; ?>" required /> <?php echo $datuak['ErantzunZuzena']; ?> <br>
					<input type="radio" name="erantzuna" value="<?php echo $datuak['ErantzunOkerra1']; ?>" required /> <?php echo $datuak['ErantzunOkerra1']; ?> <br>
					<input type="radio" name="erantzuna" value="<?php echo $datuak['ErantzunOkerra2']; ?>" required /> <?php echo $datuak['ErantzunOkerra2']; ?> <br>
					<input type="radio" name="erantzuna" value="<?php echo $datuak['ErantzunOkerra3']; ?>" required /> <?php echo $datuak['ErantzunOkerra3']; ?> <br>
		<?php 	}else if($zenb==2){ ?>
					<input type="radio" name="erantzuna" value="<?php echo $datuak['ErantzunOkerra1']; ?>" required /> <?php echo $datuak['ErantzunOkerra1']; ?> <br>
					<input type="radio" name="erantzuna" value="<?php echo $datuak['ErantzunOkerra2']; ?>" required /> <?php echo $datuak['ErantzunOkerra2']; ?> <br>
					<input type="radio" name="erantzuna" value="<?php echo $datuak['ErantzunZuzena']; ?>"required /> <?php echo $datuak['ErantzunZuzena']; ?> <br>
					<input type="radio" name="erantzuna" value="<?php echo $datuak['ErantzunOkerra3']; ?>" required /> <?php echo $datuak['ErantzunOkerra3']; ?> <br>
		<?php	}else if($zenb==3){ ?>
					<input type="radio" name="erantzuna" value="<?php echo $datuak['ErantzunOkerra1']; ?>" required /> <?php echo $datuak['ErantzunOkerra1']; ?> <br>
					<input type="radio" name="erantzuna" value="<?php echo $datuak['ErantzunZuzena']; ?>" required /> <?php echo $datuak['ErantzunZuzena']; ?> <br>
					<input type="radio" name="erantzuna" value="<?php echo $datuak['ErantzunOkerra2']; ?>" required /> <?php echo $datuak['ErantzunOkerra2']; ?> <br>
					<input type="radio" name="erantzuna" value="<?php echo $datuak['ErantzunOkerra3']; ?>" required /> <?php echo $datuak['ErantzunOkerra3']; ?> <br>
		<?php	}else{ ?>
					<input type="radio" name="erantzuna" value="<?php echo $datuak['ErantzunOkerra1']; ?>" required /> <?php echo $datuak['ErantzunOkerra1']; ?> <br>
					<input type="radio" name="erantzuna" value="<?php echo $datuak['ErantzunOkerra2']; ?>" required /> <?php echo $datuak['ErantzunOkerra2']; ?> <br>
					<input type="radio" name="erantzuna" value="<?php echo $datuak['ErantzunOkerra3']; ?>" required /> <?php echo $datuak['ErantzunOkerra3']; ?> <br>
					<input type="radio" name="erantzuna" value="<?php echo $datuak['ErantzunZuzena']; ?>" required /> <?php echo $datuak['ErantzunZuzena']; ?> <br>
		<?php	} ?>
				<input style="visibility:hidden;" type="radio" name="erantzunZuzena" value="<?php echo $datuak['ErantzunZuzena']; ?>" checked />
				<input style="visibility:hidden;" type="radio" name="id" value="<?php echo (int)$datuak['Id']; ?>" checked />
				<br>
				<input type="submit" name="erantzunaBidali" value="Erantzuna bidali >>" style="background-color: #4CAF50; color:white; padding: 15px 32px;text-align: center; display: inline-block; font-size: 28px;">
				</form>
			</div>
		</div>
	</div>
		
	
 
</body>	
</html>


