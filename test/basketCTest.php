<?php 
	$directory = $_SERVER['DOCUMENT_ROOT'];
	require_once($directory."/database/basket/basket.php");
	$basket = new Basket();
	$basket->add(new BasketCloth(1,1,1));
	if($basket->isInclude(new BasketCloth(1,1,1)))
		echo "1";
	else
		echo "0";
	echo "<br>";
	$basket->add(new BasketCloth(1,2,1));
	$basket->add(new BasketCloth(1,1,2));
	echo $basket->getBasket()[0]->getAmount();
?>