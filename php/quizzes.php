<?php include 'segurtasuna.php'; ?>

<?php 
if(isset($_SESSION['quizer'])){
	unset($_SESSION['quizer']);
}
?>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
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
.user{
	position: absolute;
	top: 1em;
	right: 1em;
}

</style>
<script>
function saveQuizer(){ 

	$nick = document.getElementById('nick').value;
	$data = ("nick="+$nick);
	
	$.ajax({
		  type:'POST',
		  url:'selectQuizer.php',
		  data: $data,
		  beforeSend:function(){$('#nickName').html('<div><center> <img src="../images/loading.gif" width="150" height="120"/> </center></div>')},
		  success: function(data){$('#nickName').fadeIn().html(data);},
		  error:function(){
			$('#nickName').fadeIn().html('<p class="error"><strong> Zerbitzariak ez duela erantzuten dirudi</p>');
		  }
	});
}

</script>
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
	
	<form action="" method="POST" name="playAs">
		<?php	if($log=="Anonymous"){ ?>
					Play as --> <input type="text" id="nick" required pattern=".{4,12}" name="quizer" placeholder="Min:4, Max:12">   <input type="button" value="Save" onclick="saveQuizer()">
		<?php   }else{ 
					$longName=explode('@',$_SESSION['erabiltzailea']);
					$name = $longName[0];	
		?>
					Play as --> <input type="text" id="nick" required pattern=".{4,12}" name="quizer" placeholder="Min:4, Max:12" value="<?php echo $name ?>">   <input type="button" value="Save" onclick="saveQuizer()">
		<?php	}   ?>
		
	</form>
	<br>
	<div id="nickName"></div>
	<br>
	<h3>Select a quizz:</h3>
	<button id="play" type="submit" onclick="location.href='onePlay.php'"><b>One Play</b></button>   <button id="play" type="submit" onclick="location.href='playingBySubject.php'"><b>Playing by Subject</b></button>
	<br><br>
	<button id="ranking" type="submit" onclick="location.href='globalRanking.php'"><b>Global Ranking</b></button>
	
</body>	
</html>

