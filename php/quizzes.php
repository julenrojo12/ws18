<?php include 'segurtasuna.php'; ?>



<html>
<head>
<style>
body{margin: auto; text-align:center; background-image: url(../images/background.jpg); margin-top: 50px;}
#play{
	background-color: tomato;
    color: black;
    margin: 0 0;
    cursor: pointer;
	font-size: 13px;
	width:10%;
	height:50px
}
#ranking{
	background-color: gold;
    color: black;
    margin: 0 0;
    cursor: pointer;
	font-size: 13px;
	width:10%;
	height:50px
}
.home{
	position: absolute;
	top: 1em;
	left: 1em;
	
}

</style>
</head>
<body>
	<h1>QUIZZES</h1>
	<span class="home">
	<?php 	if($log=="Anonymous"){
				echo "<a href='../layout.html'>Home</a>";
			}else{
				echo "<a href='layoutLogged.php'>Home</a>";
			}
	?>
	</span>
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
	<br><br>
	<h3>Select a quizz:</h3>
	<button id="play" type="submit" onclick="location.href='onePlay.php'"><b>One Play</b></button>   <button id="play" type="submit" onclick="location.href='playingBySubject.php'"><b>Playing by Subject</b></button>
	<br><br>
	<button id="ranking" type="submit" onclick="location.href='globalRanking.php'"><b>Global Ranking</b></button>
 
</body>	
</html>

