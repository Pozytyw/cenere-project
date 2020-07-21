<?php
	$directory = $_SERVER['DOCUMENT_ROOT'];
	include($directory."/database/orderList.php");
	$home = "http://".$_SERVER['SERVER_NAME'];
?>
<head>
	<link rel="stylesheet" <?php echo "href='".$home."/database/style.css'"?>>
</>
<?php 	
	$orderList = new OrderList(5);
	$list = $orderList -> getOrderList();
	foreach($list as $order){
		echo $order->getClothesNameList();
	}
?>