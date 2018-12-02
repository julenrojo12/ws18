<?php

session_start();
$xml = simplexml_load_file('../xml/questions.xml');

$guztira = $xml->count();

$kont = 0;
foreach ($xml->assessmentItem as $assessmentItem) {
    if($assessmentItem->attributes()->author==$_SESSION['erabiltzailea']){
		$kont++;
	}
}

echo $_SESSION['erabiltzailea']."-ren galderak / galderak guztira : ".$kont."/".$guztira;

?>