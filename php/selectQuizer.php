<?php
	session_start();
	sleep(1);

	$nick = $_POST['nick'];
	if(strlen($nick)<=4){
		echo "Izenak 4 karaktere baino gehiago izan behar ditu";
	}else if(strlen($nick)>=12){
		echo "Izenak 12 karaktere baino gitxiago izan behar ditu";
	}else{
		include 'dbConfig.php';
	
		$conn = new mysqli ($servername,$username,$password,$dbname);
		if ($conn->connect_error) {
						("Connection failed: " . $conn->connect_error);
		}
		$sql= "SELECT * FROM Quizers WHERE Nick='$nick'";
		$result = $conn->query($sql);
		if($result->num_rows==0){
			$sqlInsert = "INSERT INTO Quizers(Nick) VALUES('$nick')";
			$conn->query($sqlInsert);
			$_SESSION['quizer'] = $nick;
			echo "Quizer berria sortuta, ongi etorria $nick!";
		}else{
			$_SESSION['quizer'] = $nick;
			echo "Ongi etorri berriz $nick!";
		}
	}
	
	
?>