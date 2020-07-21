<?php
	require_once('cloth.php');
	require_once('databaseLink.php');
	class BuyClothes{
		private $connectorDB;
		private $id;
		private $paid;
		private $total_price;
		private $clothesList = [];
		function __construct($id){
			//create connection do db and query
			$this->connectorDB = new ConnectorDB();
			$this->id = $id;
			
			//get all need fields
			$results = $this->connectorDB->query($this->getOrderQuery($id));
			
			//set this filed and add one row to clothesList
			if($results){
				$row = mysqli_fetch_assoc($results);
				array_push($this->clothesList, new Cloth($row['id'], $row['brand'], $row['name'], $row['price'], $row['gender'], $row['type'], $row['img_src']));
				$this->paid = $row['paid'];
				$this->total_price = $row['total_price'];
				
				while($row = mysqli_fetch_assoc($results)){
					//new cloth __construct($id, $name, $price, $gender, $type, $img_src){
					array_push($this->clothesList, new Cloth($row['id'], $row['brand'], $row['name'], $row['price'], $row['gender'], $row['type'], $row['img_src']));
				}
			}
		}
		
		private function getOrderQuery($id){
			//field for this objects
			$query = "select orders.paid as paid, orders.total_price as total_price, ";
			//field for cloth objects
			$query .= "clothes.id as id, clothes.name as name, gender.gender as gender, clothes.price as price, brands.name as brand, type.type as type, clothes.img_src as img_src from orders "; 
			//inner join order_clothes
			$query .= "inner join order_clothes on orders.id = order_clothes.order_id ";
			//inner join clothes
			$query .= "inner join clothes on clothes.id = order_clothes.cloth_id ";
			//inner join type
			$query .= "inner join type on clothes.type_id = type.id ";
			//inner join gender
			$query .= "inner join gender on clothes.gender_id = gender.id ";
			//inner join brands
			$query .= "inner join brands on brands.id = clothes.brand_id ";
			//where
			$query .= "where orders.id = $id;";
			return $query;
		}
		
		public function getWalletBalance($wallet_ID){
			$query =  "select balance from wallets where id = $wallet_ID;";
			$results = $this->connectorDB->query($query);
			$result = mysqli_fetch_assoc($results)['balance'];
			return $result;
		}
		
		//gettery
		public function getClothesList(){
			return $this->clothesList;
		}
		
		public function getID(){
			return $this->id;
		}
		
		public function getPaid(){
			if($this->paid == 0)
				return false;
			else 
				return true;
		}
		
		public function getTotal_price(){
			return $this->total_price;
		}
	}
?>