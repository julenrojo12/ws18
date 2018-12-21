<?php include 'segurtasuna.php'; ?>

<html>
<head>
<style>
body{margin: auto; text-align:center; background-image: url(../images/background.jpg); margin-top: 50px;}

.bueltatu{
	position: absolute;
	top: 1em;
	left: 1em;
	
}
.user{
	position: absolute;
	top: 1em;
	right: 1em;
}
button{
	background-color: #008CBA;
    color: white;
	text-align: center;
    cursor: pointer;
	font-size: 18px;
	width:10%;
	height:50px
}

</style>
</head>
<body>
	<h1>PLAYING BY SUBJECT</h1>
	<?php 
	if(isset($_SESSION['quizer'])){
		$quizer = $_SESSION['quizer'];
		echo "<br>Playing as --> $quizer";
	}
	?>		
	<span class="bueltatu">
	<a href='quizzes.php'><--Return to quizzes</a>
	</span>
	<span class="user">
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
	?>	
	</span>
	<br><br>
	<h2>Select a subject:</h2>
	<?php 
		include 'dbConfig.php';
		
		$conn = new mysqli ($servername,$username,$password,$dbname);
		if ($conn->connect_error) {
						("Connection failed: " . $conn->connect_error);
		}
		$sql= "SELECT DISTINCT GaiArloa FROM Questions";
		$result = $conn->query($sql);
		$conn->close();

		while($datuak=$result->fetch_array()){ ?>
		
				<button  type="submit" onclick="location.href='selectGaiArloa.php?GaiArloa=<?php echo $datuak['GaiArloa'] ?>'"><b><?php echo $datuak['GaiArloa'] ?></b></button><br>
			
<?php	} ?>
</body>	
</html>

