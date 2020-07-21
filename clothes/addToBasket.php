<?php
	$directory = $_SERVER['DOCUMENT_ROOT'];
	require_once($directory."/database/basket/basket.php");
	
	$basket;
	if(!isset($_COOKIE["basket"])){
		$basket = new Basket();
	}else{
		$basket = unserialize($_COOKIE["basket"]);
	}
	$basket->add(new BasketCloth($_POST['id'], $_POST['size'], 1));
	setcookie("basket",serialize($basket), time()+86400*30,'/');
?>