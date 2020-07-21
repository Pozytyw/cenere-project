<?php 
	$directory = $_SERVER['DOCUMENT_ROOT'];
	$home = "http://".$_SERVER['SERVER_NAME'];
	include($directory."/database/clothBasket.php");
	$clothBasket = new ClothBasket("1,2,3,4");
	echo $clothBasket->getBusketPrice();
	echo $clothBasket->getClothesList()[0]->innerHTML($home);
?>