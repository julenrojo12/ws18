<?php include 'segurtasuna.php'; ?>


<html>
<head>
<style>
body{margin: auto; text-align:center; background-image: url(../images/background.jpg); margin-top: 50px;}


.return{
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
</head>
<body>
	<h1>Global Ranking: Top 10 Quizzers</h1>
	<span class="return">
	<a href='quizzes.php'><--Return</a>
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
	<?php 
	include 'dbConfig.php';
	
	$conn = new mysqli ($servername,$username,$password,$dbname);
	if ($conn->connect_error) {
					("Connection failed: " . $conn->connect_error);
	}
	$sql= "SELECT * FROM Quizers ORDER BY Wins DESC LIMIT 10";
	$result = $conn->query($sql);
	$conn->close();
	?>
	<br><br>
	<table width="70%" border="1px" align="center" style="font-size:24px; border-collapse: collapse; background-color:white; text-align:center; margin:auto;">

    <tr align="center">
		<td>POSIZIOA</td>
        <td>NICKNAME</td>
        <td>ASMATUAK</td>
        <td>HUTSEGITEAK</td>
		<td>ASMATZE-TASA</td>
        
    </tr>
    <?php 
		$kont=1;
        while($datuak=$result->fetch_array()){
			
        ?>
		
		<?php if($kont==1){ ?>
            <tr style="background-color:gold">
		<?php }else if($kont==2){ ?>
			<tr style="background-color:silver">
		<?php }else if($kont==3){ ?>
			<tr style="background-color: #d2a679">
		<?php }else{ ?>
			<tr>
		<?php } ?> 
				<td><?php echo $kont."º";?></td>
                <td><?php echo $datuak["Nick"]?></td>
                <td><?php echo $datuak["Wins"]?></td>
                <td><?php echo $datuak["Losses"]?></td>
                <td>
				<?php 
				$wins = floatval($datuak["Wins"]);
				$losses = floatval($datuak["Losses"]);
				$tax = ($wins/($wins+$losses))*100;
				echo "%".$tax;
				?>
				</td>
            </tr>
            <?php 
			$kont++;
        }

     ?>
    </table>

	
</body>	
</html>

