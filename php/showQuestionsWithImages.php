<?php

	include 'dbConfig.php';
	
	$conn = new mysqli ($servername,$username,$password,$dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * FROM Questions";
	$result = $conn->query($sql);
	$conn->close();
?>
<table width="70%" border="1px" align="center">

    <tr align="center">
        <td>E-POSTA</td>
        <td>GALDERA</td>
        <td>ERANTZUNA</td>
		<td>IRUDIA</td>
        
    </tr>
    <?php 
        while($datuak=$result->fetch_array()){
			
        ?>
            <tr>
                <td><?php echo $datuak["Eposta"]?></td>
                <td><?php echo $datuak["Galdera"]?></td>
                <td><?php echo $datuak["ErantzunZuzena"]?></td>
                <td><?php if($datuak["Irudia"]!= null){
							  echo '<img src="data:image/jpeg;base64,' . $datuak["Irudia"] . '" width="80" height="60"/>'; 
						  }else{
							  echo 'Irudi gabe';
						  }
					?></td>
            </tr>
            <?php   
        }

     ?>
    </table>

	


<a href='addQuestion.php?erabiltzailea=<?php echo $_GET['erabiltzailea']?>'>Beste galdera bat gehitu</a> <br><br>
<a href='showQuestions.php?erabiltzailea=<?php echo $_GET['erabiltzailea']?>'>Galderak erakutsi (irudi gabe)</a> <br><br>
<a href='layoutLogged.php?erabiltzailea=<?php echo $_GET['erabiltzailea']?>'>Home</a>