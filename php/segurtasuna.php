<?php
session_start();

if(isset($_SESSION['erabiltzailea'])) {
	if($_SESSION['erabiltzailea']=="admin000@ehu.eus"){
		$log = "Admin";
	}else{
		$log = "User";
	}
}else{
	$log = "Anonymous";
}
?>