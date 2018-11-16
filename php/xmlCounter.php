<?php


$xml = simplexml_load_file('../xml/questions.xml');

$guztira = $xml->count();

$kont = 0;
foreach ($xml->assessmentItem as $assessmentItem) {
    if($assessmentItem->attributes()->author==$_GET['erabiltzailea']){
		$kont++;
	}
}

echo $_GET['erabiltzailea']."-ren galderak / galderak guztira : ".$kont."/".$guztira;

?>