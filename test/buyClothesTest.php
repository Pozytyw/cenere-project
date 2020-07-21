<?php 
	$directory = $_SERVER['DOCUMENT_ROOT'];
	$home = "http://".$_SERVER['SERVER_NAME'];
	include($directory."/database/buyClothes.php");
	$buyClothes = new BuyClothes(18);
	echo $buyClothes->getWalletBalance(1);
	echo $buyClothes->getClothesList()[0]->innerHTML($home);
?>