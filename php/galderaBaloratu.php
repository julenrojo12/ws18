<?php include 'segurtasuna.php' ?>
<html>
<head>
<style>
body{text-align:center; margin:auto; margin-top:10%; background-image: url(../images/background.jpg); }

.quizzes{
	position: absolute;
	top: 1em;
	left: 1em;
	
}
.user{
	position: absolute;
	top: 1em;
	right: 1em;
}

button {
	font: 700 1em Tahoma, Arial, Verdana, sans-serif;
	color: #fff; background-color: #59B0E5;
	border: 1px solid #0074a5;
	font-size: 34px;
	cursor: pointer;
}
</style>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script>
    function galderaBaloratu(id,balorazioa){ 
		$data = ("id="+id+"&balorazioa="+balorazioa);
		
		$.ajax({
			  type:'POST',
			  url:'baloratu.php',
			  data: $data,
			  beforeSend:function(){$('#edukia').html('<div><center> <img src="../images/loading.gif" width="250" height="200"/> </center></div>')},
			  success: function(data){$('#edukia').fadeIn().html(data);},
			  error:function(){
				$('#edukia').fadeIn().html('<p class="error"><strong> Zerbitzariak ez duela erantzuten dirudi</p>');
			  }
		});
	}
</script>
</head>
<body>
	<span class="quizzes">
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
	<div id="edukia">
		<h2>Galdera gustatu zaizu?(Hautazkoa)</h2>
		<form>
		<button type="submit" onclick="galderaBaloratu(<?php echo (int)$_GET['id'];?>,'Bai')"><img src="../images/like.png" alt="like" width="20" height="20"/>Bai</button>   <button style="background-color:#F08080;" type="submit" onclick="galderaBaloratu(<?php echo (int)$_GET['id'];?>,'Ez')"><img src="../images/dislike.png" alt="dislike" width="20" height="20"/>Ez</button>
		</form>
	</div>
	<br><br>
	<button style="background-color:#90EE90" type="submit" onclick="location.href='onePlay.php'">Berriz jolastu</button>
	
 
</body>	
</html>
