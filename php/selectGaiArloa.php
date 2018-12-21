<?php include 'segurtasuna.php'; ?>

<?php 
	if(isset($_POST["erantzunaBidali"])){
		if(isset($_SESSION['quizer'])){
			include 'dbConfig.php';
			$quizer = $_SESSION['quizer'];
			$conn = new mysqli ($servername,$username,$password,$dbname);
		}
		$asmatuak=0;
		if($_POST["erantzuna1"]==$_POST['erantzunZuzena1']){
			$asmatuak++;
		}
		$zailtasuna1 = floatval($_POST['zailtasuna1']);
		if(isset($_POST["erantzuna2"])){
			if($_POST["erantzuna2"]==$_POST['erantzunZuzena2']){
				$asmatuak++;
			}
			$zailtasuna2 = floatval($_POST['zailtasuna2']);
			if(isset($_POST["erantzuna3"])){
				if($_POST["erantzuna3"]==$_POST['erantzunZuzena3']){
					$asmatuak++;
				}
				$zailtasuna3 = floatval($_POST['zailtasuna3']);
				$batazbestekoZailtasuna = ($zailtasuna1+$zailtasuna2+$zailtasuna3)/3;
				if($asmatuak==1){
					if(isset($_SESSION['quizer'])){
						$sql= "UPDATE Quizers SET Wins=Wins+1,Losses=Losses+2 WHERE Nick='$quizer'";
						$conn->query($sql);
						$conn->close();
					}	
					echo "<script>alert('Galdera bat asmatu duzu: 1/3 \\n \\n Batazbesteko zailtasuna: $batazbestekoZailtasuna');</script>";
					echo "<script language='javascript'>window.location='playingBySubject.php'; </script>";
				}else if($asmatuak==2){
					if(isset($_SESSION['quizer'])){
						$sql= "UPDATE Quizers SET Wins=Wins+2,Losses=Losses+1 WHERE Nick='$quizer'";
						$conn->query($sql);
						$conn->close();
					}	
					echo "<script>alert('Zorionak bi galdera asmatu dituzu: 2/3 \\n \\n Batazbesteko zailtasuna: $batazbestekoZailtasuna');</script>";
					echo "<script language='javascript'>window.location='playingBySubject.php'; </script>";
				}else if($asmatuak==3){
					if(isset($_SESSION['quizer'])){
						$sql= "UPDATE Quizers SET Wins=Wins+3 WHERE Nick='$quizer'";
						$conn->query($sql);
						$conn->close();
					}	
					echo "<script>alert('Zorionak galdera guztiak asmatu dituzu: 3/3 \\n \\n Batazbesteko zailtasuna: $batazbestekoZailtasuna');</script>";
					echo "<script language='javascript'>window.location='playingBySubject.php'; </script>";
				}else{
					if(isset($_SESSION['quizer'])){
						$sql= "UPDATE Quizers SET Losses=Losses+3 WHERE Nick='$quizer'";
						$conn->query($sql);
						$conn->close();
					}	
					echo "<script>alert('Ez duzu galderarik asmatu: 0/3 \\n \\n Batazbesteko zailtasuna: $batazbestekoZailtasuna');</script>";
					echo "<script language='javascript'>window.location='playingBySubject.php'; </script>";
				}
			}else{
				$batazbestekoZailtasuna = ($zailtasuna1+$zailtasuna2)/2;
				if($asmatuak==1){
					if(isset($_SESSION['quizer'])){
						$sql= "UPDATE Quizers SET Wins=Wins+1,Losses=Losses+1 WHERE Nick='$quizer'";
						$conn->query($sql);
						$conn->close();
					}	
					echo "<script>alert('Galdera bat asmatu duzu: 1/2 \\n \\n Batazbesteko zailtasuna: $batazbestekoZailtasuna');</script>";
					echo "<script language='javascript'>window.location='playingBySubject.php'; </script>";
				}else if($asmatuak==2){
					if(isset($_SESSION['quizer'])){
						$sql= "UPDATE Quizers SET Wins=Wins+2 WHERE Nick='$quizer'";
						$conn->query($sql);
						$conn->close();
					}	
					echo "<script>alert('Zorionak galdera guztiak asmatu dituzu: 2/2 \\n \\n Batazbesteko zailtasuna: $batazbestekoZailtasuna');</script>";
					echo "<script language='javascript'>window.location='playingBySubject.php'; </script>";
				}else{
					if(isset($_SESSION['quizer'])){
						$sql= "UPDATE Quizers SET Losses=Losses+2 WHERE Nick='$quizer'";
						$conn->query($sql);
						$conn->close();
					}	
					echo "<script>alert('Ez duzu galderarik asmatu: 0/2 \\n \\n Batazbesteko zailtasuna: $batazbestekoZailtasuna');</script>";
					echo "<script language='javascript'>window.location='playingBySubject.php'; </script>";
				}
			}
		}else{
			if($asmatuak==1){
				if(isset($_SESSION['quizer'])){
					$sql= "UPDATE Quizers SET Wins=Wins+1 WHERE Nick='$quizer'";
					$conn->query($sql);
					$conn->close();
				}	
				echo "<script>alert('Zorionak galdera asmatu duzu: 1/1 \\n \\n Zailtasuna: $zailtasuna1');</script>";
				echo "<script language='javascript'>window.location='playingBySubject.php'; </script>";
			}else{
				if(isset($_SESSION['quizer'])){
					$sql= "UPDATE Quizers SET Losses=Losses+1 WHERE Nick='$quizer'";
					$conn->query($sql);
					$conn->close();
				}	
				echo "<script>alert('Ez duzu galdera asmatu: 0/1 \\n \\n Zailtasuna: $zailtasuna1');</script>";
				echo "<script language='javascript'>window.location='playingBySubject.php'; </script>";
			}
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
	<a href='playingBySubject.php'><--Select subject</a>
	</span>
	
	<div class="container">
		<div class="jumbotron" style="background-color:aquamarine; text-align:center;">
		<h1>SUBJECT: <?php echo $_GET['GaiArloa'] ?></h1>
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
		$gaiArloa = $_GET['GaiArloa'];
		include 'dbConfig.php';
		
		$conn = new mysqli ($servername,$username,$password,$dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT * FROM Questions WHERE GaiArloa='$gaiArloa' ORDER BY rand() LIMIT 3";
		$result = $conn->query($sql);
		$conn->close();
		$kont = 1;
		?>
		<div class="container">
		<form action="" method="POST" onsubmit="return true" name="galdera">
<?php	while($datuak=$result->fetch_array()){ ?>
			
			<div class="row">
				<div class="col-md-4" style="font-size:18px;">
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
					<h2><?php echo $kont.".Galdera: ".$datuak['Galdera']; ?><h2>
					<?php
					//Erantzunak orden desberdinetan agertzeko
					$zenb = rand(1,4);
					if($zenb==1){?>
						<input type="radio" name="erantzuna<?php echo $kont ?>" value="<?php echo $datuak['ErantzunZuzena']; ?>" required /> <?php echo $datuak['ErantzunZuzena']; ?> <br>
						<input type="radio" name="erantzuna<?php echo $kont ?>" value="<?php echo $datuak['ErantzunOkerra1']; ?>" required /> <?php echo $datuak['ErantzunOkerra1']; ?> <br>
						<input type="radio" name="erantzuna<?php echo $kont ?>" value="<?php echo $datuak['ErantzunOkerra2']; ?>" required /> <?php echo $datuak['ErantzunOkerra2']; ?> <br>
						<input type="radio" name="erantzuna<?php echo $kont ?>" value="<?php echo $datuak['ErantzunOkerra3']; ?>" required /> <?php echo $datuak['ErantzunOkerra3']; ?> <br>
			<?php 	}else if($zenb==2){ ?>
						<input type="radio" name="erantzuna<?php echo $kont ?>" value="<?php echo $datuak['ErantzunOkerra1']; ?>" required /> <?php echo $datuak['ErantzunOkerra1']; ?> <br>
						<input type="radio" name="erantzuna<?php echo $kont ?>" value="<?php echo $datuak['ErantzunOkerra2']; ?>" required /> <?php echo $datuak['ErantzunOkerra2']; ?> <br>
						<input type="radio" name="erantzuna<?php echo $kont ?>" value="<?php echo $datuak['ErantzunZuzena']; ?>"required /> <?php echo $datuak['ErantzunZuzena']; ?> <br>
						<input type="radio" name="erantzuna<?php echo $kont ?>" value="<?php echo $datuak['ErantzunOkerra3']; ?>" required /> <?php echo $datuak['ErantzunOkerra3']; ?> <br>
			<?php	}else if($zenb==3){ ?>
						<input type="radio" name="erantzuna<?php echo $kont ?>" value="<?php echo $datuak['ErantzunOkerra1']; ?>" required /> <?php echo $datuak['ErantzunOkerra1']; ?> <br>
						<input type="radio" name="erantzuna<?php echo $kont ?>" value="<?php echo $datuak['ErantzunZuzena']; ?>" required /> <?php echo $datuak['ErantzunZuzena']; ?> <br>
						<input type="radio" name="erantzuna<?php echo $kont ?>" value="<?php echo $datuak['ErantzunOkerra2']; ?>" required /> <?php echo $datuak['ErantzunOkerra2']; ?> <br>
						<input type="radio" name="erantzuna<?php echo $kont ?>" value="<?php echo $datuak['ErantzunOkerra3']; ?>" required /> <?php echo $datuak['ErantzunOkerra3']; ?> <br>
			<?php	}else{ ?>
						<input type="radio" name="erantzuna<?php echo $kont ?>" value="<?php echo $datuak['ErantzunOkerra1']; ?>" required /> <?php echo $datuak['ErantzunOkerra1']; ?> <br>
						<input type="radio" name="erantzuna<?php echo $kont ?>" value="<?php echo $datuak['ErantzunOkerra2']; ?>" required /> <?php echo $datuak['ErantzunOkerra2']; ?> <br>
						<input type="radio" name="erantzuna<?php echo $kont ?>" value="<?php echo $datuak['ErantzunOkerra3']; ?>" required /> <?php echo $datuak['ErantzunOkerra3']; ?> <br>
						<input type="radio" name="erantzuna<?php echo $kont ?>" value="<?php echo $datuak['ErantzunZuzena']; ?>" required /> <?php echo $datuak['ErantzunZuzena']; ?> <br>
			<?php	} ?>
					<input style="visibility:hidden;" type="radio" name="erantzunZuzena<?php echo $kont ?>" value="<?php echo $datuak['ErantzunZuzena']; ?>" checked />
					<input style="visibility:hidden;" type="radio" name="zailtasuna<?php echo $kont ?>" value="<?php echo $datuak['GalderarenZailtasuna']; ?>" checked />
				</div>
			</div>
			<br><br>
	<?php $kont++; ?>
  <?php } ?>	
		<center><input type="submit" name="erantzunaBidali" value="Erantzuna bidali >>" style="background-color: #4CAF50; color:white; padding: 15px 32px;text-align: center; display: inline-block; font-size: 28px;"></center>
		</form>
		</div>
		
	
 
</body>	
</html>


