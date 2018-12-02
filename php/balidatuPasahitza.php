<?php

require_once('../wz/lib/nusoap.php');
require_once('../wz/lib/class.wsdlcache.php');

$soapclient2 = new nusoap_client('http://localhost/wsjr/wz/egiaztatuPasahitza.php?wsdl',true);
//$soapclient2 = new nusoap_client('https://wsjulmik.000webhostapp.com/wz/egiaztatuPasahitza.php?wsdl',true);
$resultWZ2 = $soapclient2->call('egiaztatuP', array('x'=>$_POST['pasahitza'],'y'=>1010));
if($resultWZ2=='ZERBITZURIK GABE'){
	echo "<span style='color:red'>ZERBITZURIK GABE</span>";
}elseif($resultWZ2=='BALIOGABEA'){
	echo "<script language='javascript'>disableSubmit()</script>";
	echo "<span style='color:red'>Pasahitza oso <b>ahula</b> da</span>";
}else{
	echo "<script language='javascript'>enableSubmit()</script>";
	echo "<span style='color:green'><b>Baliozko</b> pasahitza</span>";
}

?>