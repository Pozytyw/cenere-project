<?php
	$directory = $_SERVER['DOCUMENT_ROOT'];
	require_once($directory."/database/basket/basket.php");
	if(isset($_POST['id']) && isset($_POST['size'])){
		$basket = unserialize($_COOKIE["basket"]);
		$basket->remove(new BasketCloth($_POST['id'], $_POST['size'], 1));
		setcookie("basket",serialize($basket), time()+86400*30,'/');
	}
?>