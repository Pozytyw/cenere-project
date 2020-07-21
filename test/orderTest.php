<?php 
	$directory = $_SERVER['DOCUMENT_ROOT'];
	include($directory."/database/order.php");
	include($directory."/database/clothBasket.php");
	
	$clothBasket = new ClothBasket("1,2,3,4");
	//__construct($user_id, $clothesList, $price)
	$order = new Order(0,$clothBasket->getClothesList(),$clothBasket->getBusketPrice());
	
	echo "TEST ORDER CLASS";
?>