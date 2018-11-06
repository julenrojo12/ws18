<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Quizzes</title>
    <link rel='stylesheet' type='text/css' href='../styles/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='../styles/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='../styles/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		
      <p><?php 
			if(isset($_GET['erabiltzailea']) ){
				$eposta = $_GET['erabiltzailea'];
				echo $eposta;
			
				include 'dbConfig.php';
		
				$conn = new mysqli ($servername,$username,$password,$dbname);
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}
				$sql =  "SELECT * FROM Erabiltzaileak WHERE Eposta='$eposta'";
				$result = $conn->query($sql);
				$datuak=$result->fetch_array();
				
				if($datuak["Argazkia"]!= null){
					echo '<img src="data:image/jpeg;base64,' . $datuak["Argazkia"] . '" width="30" height="30"/>'; 
				}else{
					//Argazki predeterminatua jartzen du
					echo '<img src="../images/sin_avatar.jpg" width="20" height="30"/>'; 
				}
				$conn->close();
			}	
			
	  
		?> </p>
      <span class="right"><a href='logOut.php'>LogOut</a> </span>
	<h2>Quiz: crazy questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layoutLogged.php?erabiltzailea=<?php echo $_GET['erabiltzailea']?>'>Home</a></span>
		<span><a href=''>Quizzes</a></span>
		<span><a href='addQuestion.php?erabiltzailea=<?php echo $_GET['erabiltzailea']?>'>Add question</a></span>
		<span><a href='showQuestionsWithImages.php?erabiltzailea=<?php echo $_GET['erabiltzailea']?>'>Show questions</a></span>
		<span><a href='credits.php?erabiltzailea=<?php echo $_GET['erabiltzailea']?>'>Credits</a></span>
	</nav>
    <section class="main" id="s1">
    
	
	<div>
	Quizzes and credits will be displayed in this spot in future laboratories ...
	</div>
    </section>
	<footer class='main' id='f1'>
		 <a href=''>Link GITHUB</a>
	</footer>
</div>
</body>
</html>


