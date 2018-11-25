<?php

require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

$ns="http://localhost/wsjr/wz/egiaztatuPasahitza.php?wsdl";
$server = new soap_server;
$server->configureWSDL('egiaztatuP',$ns);
$server->wsdl->schemaTargetNamespace=$ns;

$server->register('egiaztatuP',array('x'=>'xsd:string','y'=>'xsd:int'),array('z'=>'xsd:string'),$ns);

function egiaztatuP($x, $y){
	
	if($y==1010){
		$fp = fopen("toppasswords.txt","r");
		while(!feof($fp)){
			$linea = fgets($fp);
			if(trim($linea)==$x){
				return "BALIOGABEA";
			}
		}
		fclose($fp);
		return "BALIOZKOA";
	}else{
		return "ZERBITZURIK GABE";
	}
}

if (!isset( $HTTP_RAW_POST_DATA )) {
$HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
}
$server->service($HTTP_RAW_POST_DATA);

?>