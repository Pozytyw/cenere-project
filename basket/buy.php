<?php
	session_start();
	$directory = $_SERVER['DOCUMENT_ROOT'];
	$home = "http://".$_SERVER['SERVER_NAME'];
	include($directory."/database/user.php");
	include($directory."/database/order.php");
	
	//if idlist size or amunt isnt set
	if(!isset($_POST['id']) || !isset($_POST['size']) || !isset($_POST['amount'])){
			header('Location: '.$home."/basket/");
	}
	
	//if user not login
	if(!isset($_SESSION['user'])){
		header('Location: '.$home."/basket/");
	}else{
		$idList = $_POST['id'];
		$sizeList = $_POST['size'];
		$amountList = $_POST['amount'];
		
		if(count($idList) == count($sizeList) && count($sizeList) == count($amountList)){
			if(count($idList) == 0){
				header('Location: '.$home."/order/");
			}else{
				//get user from session
				$user = unserialize($_SESSION['user']);
				//add new order to datbase // __construct($user_id, $idList, $sizeList, $amountList)
				$order = new order($user->getID(), $idList, $sizeList, $amountList);
				setcookie("basket",NULL, 1,'/');
				unset($_COOKIE["basket"]);
				header('Location: '.$home."/order/");
			}
		}else{
			header('Location: '.$home."/basket/");
		}
	}
	
?>