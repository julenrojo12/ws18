<?php

require_once('../wz/lib/nusoap.php');
require_once('../wz/lib/class.wsdlcache.php');


$soapclient1 = new nusoap_client('http://ehusw.es/rosa/webZerbitzuak/egiaztatuMatrikula.php?wsdl', true);
$resultWZ1 = $soapclient1->call('egiaztatuE', array('x'=>$_POST["eposta"]));
if($resultWZ1=='EZ'){
	echo "<script language='javascript'>disableAll()</script>";
	echo "<span style='color:red'>Ez dago <b>matrikulatuta</b></span>";
}else{
	echo "<script language='javascript'>enableInputs()</script>";
	echo "<span style='color:green'><b>Matrikulatuta</b> dago</span>";
}	


?>