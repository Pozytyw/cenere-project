<?php
	require_once('databaseLink.php');
	require_once('orderLabel.php');
	class OrderList{
		private $connectorDB;
		private $orderList = [];
		function __construct($user_id){
			//create connection do db and query
			$this->connectorDB = new ConnectorDB();
			
			//get all need fields
			$results = $this->connectorDB->query($this->getOrderQuery($user_id));
			
			//list for sort results and create orderList
			$orders = [];
			$lastID;
			$price;
			$paid;
			
			if($results && mysqli_num_rows($results)>0){
				//prepare for loop
				//get first order id. And add clothes name to orders
				$row = mysqli_fetch_assoc($results);
				$lastID = $row["id"];
				$price = $row["total_price"];
				$paid = $row["paid"];
				array_push($orders, $row["name"]);
				
				while($row = mysqli_fetch_assoc($results)){
					//if last id isnt equal push new order to list
					if($row["id"] != $lastID){
						//new __construct($id, $clothesList, $total_price, $paid){
						array_push($this->orderList, new OrderLabel($lastID, $orders, $price, $paid));
						$orders =  [];
					}
					array_push($orders, $row["name"]);
					$price = $row["total_price"];
					$paid = $row["paid"];
					$lastID = $row["id"];
				}
				//push last order to list
				array_push($this->orderList, new OrderLabel($lastID, $orders, $price, $paid));
			}
		}
		
		public function getOrderQuery($user_id){
			$query = "select orders.paid as paid, orders.id as id, clothes.name as name, orders.total_price as total_price from orders ";
			$query .= "left join order_clothes on order_clothes.order_id = orders.id ";
			$query .= "inner join clothes on clothes.id = order_clothes.cloth_id ";
			$query .=  "where orders.user_id = $user_id order by id;";
			return $query;
		}
		
		public function getOrderList(){
			return $this->orderList;
		}
	}
?>