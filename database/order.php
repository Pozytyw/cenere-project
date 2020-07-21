<?php
	require_once('databaseLink.php');
	require_once('clothBasket.php');
	class Order{
		private $connectorDB;
		private $id;
		function __construct($user_id, $idList, $sizeList, $amountList){
			//create connection do db and query
			$this->connectorDB = new ConnectorDB();
			
			//get id string
			$idString = "";
			foreach($idList as $id){
				$idString .= base64_decode($id).",";
			}
			$idString = substr($idString, 0, strlen($idString)-1);
			
			//create clothBasket
			$clothBasket = new ClothBasket($idString);
			
			//calc $price
			$price = 0;
			
			foreach($idList as $key=>$id){
				$cloth = $clothBasket->getByID($id);
				$price += $cloth->getPrice() * $amountList[$key];
			}
			
			//add record to order table
			$this->connectorDB->query($this->getOrderQuery($user_id, $price));
			//set id from previous query
			$this->id = $this->connectorDB->insert_id;
			//add record to order_clothes table
			echo $this->getUser_clothesQuery($user_id, $idList, $this->id, $sizeList, $amountList);
			$this->connectorDB->query($this->getUser_clothesQuery($user_id, $idList, $this->id, $sizeList, $amountList));
			$this->connectorDB -> close();
		}
		
		private function getUser_clothesQuery($user_id, $idList, $order_id, $sizeList, $amountList){
			$query = "INSERT INTO order_clothes(cloth_id, user_id, order_id, size, amount) values ";
			foreach($idList as $key=>$id){
				$id = base64_decode($id);
				$query .= "($id, $user_id, $order_id, '$sizeList[$key]', $amountList[$key]), ";
			}
			//remove last white space and ',' 
			$query = substr($query, 0, -2);
			$query  .= ";";
			return $query;
		}
		
		private function getOrderQuery($user_id, $price){
			$query = "INSERT INTO orders VALUES(default , $user_id, $price, false); ";
			return $query;
		}
		
		public function getID(){
			return $this->id;
		}
	}
?>