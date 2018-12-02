<?php
	session_start();
	if($_SESSION['erabiltzailea']!="admin000@ehu.eus"){echo "<script language='javascript'>window.location='logIn.php'; </script>";}
	include 'dbConfig.php';
	$conn = new mysqli ($servername,$username,$password,$dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * FROM Erabiltzaileak";
	$result = $conn->query($sql);
	$conn->close();
	
?>

<br><br>
<script type="text/javascript" language = "javascript">
	var xhro= new XMLHttpRequest();
	xhro.onreadystatechange= function (){
		if (xhro.readyState==4){
			document.getElementById('edukia').innerHTML = xhro.responseText;
		}
	}
	function ezabatu(form){ 
		eposta = form.aukeratu.value; 
		xhro.open("GET",'ezabatuErabiltzailea.php?erabiltzailea='+eposta,true);
		xhro.send(null);
	}
	function aktibatu(form){ 
		eposta = form.aukeratu.value; 
		xhro.open("GET",'aktibatuBlokeatuErabiltzailea.php?akzioa=aktibatu&erabiltzailea='+eposta,true);
		xhro.send(null);
	}
	
	function blokeatu(form){ 
		eposta = form.aukeratu.value; 
		xhro.open("GET",'aktibatuBlokeatuErabiltzailea.php?akzioa=blokeatu&erabiltzailea='+eposta,true);
		xhro.send(null);
	}
</script>
<a href="layoutLogged.php">Home</a>
<form action=''>
<table width="70%" border="1px" align="center">

    <tr align="center">
        <td>E-POSTA</td>
        <td>PASAHITZA</td>
        <td>ARGAZKIA</td>
		<td>AKTIBOA/BLOKEATUTA</td>
		<td>AUKERATU</td>
		
        
    </tr>
    <?php 
        while($datuak=$result->fetch_array()){
			
        ?>
            <tr>
                <td><?php echo $datuak["Eposta"]?></td>
                <td><?php echo $datuak["Pasahitza"]?></td>
                <td><?php if($datuak["Argazkia"]!= null){
							  echo '<img src="data:image/jpeg;base64,' . $datuak["Argazkia"] . '" width="80" height="60"/>'; 
						  }else{
							  echo 'Irudi gabe';
						  }
					?></td>
				<td><?php if($datuak["Blokeatuta"]=='Ez'){
								echo $egoera="Aktiboa";
						   }else{
							    echo $egoera="Blokeatuta";
						   }	
				    ?></td>
				<td><?php if($datuak["Eposta"]!="admin000@ehu.eus"){
							echo "<center><input type='radio' name='aukeratu' value='".$datuak["Eposta"]."'></center>";
						  }else{
							  echo "<center>-</center>";
						  }
						?></td>
            </tr>
            <?php   
        }
    ?>
</table>
<br><br>
<center><input type='button' onclick='ezabatu(this.form)' value='Ezabatu'/>   <input type='button' onclick='aktibatu(this.form)' value='Aktibatu'/>   <input type='button' onclick='blokeatu(this.form)' value='Blokeatu'/></center>
</form>
<div id="edukia">
</div>
