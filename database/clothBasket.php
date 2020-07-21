<?php
	require_once('cloth.php');
	require_once('databaseLink.php');
	class ClothBasket{
		private $clothesList = [];
		function __construct($arrayString){
			//create connection do db and query
			$connectorDB = new ConnectorDB();
			//call to db, and get clothes list, which have id from array id
			$result = $connectorDB -> query($this->getBasketQery($arrayString));
			//loop for result
			if($result)
			while($row = mysqli_fetch_assoc($result)){
				// new cloth  __construct($id, $brand, $name, $price, $gender, $type, $img_src){
				array_push($this->clothesList, new Cloth($row['id'], $row['brand'], $row['name'], $row['price'], $row['gender'], $row['type'], $row['img_src']));
			}
			$connectorDB -> close();
		}
		
		//query getters
		//arrayString = 1,2,3,4,5
		private function getBasketQery($arrayString){
			//query, which get 10 random clothes by type
			$query = "select clothes.ID as id, clothes.name as name, brands.name as brand, clothes.img_src as img_src, clothes.price as price, gender.gender as gender, type.type as type from clothes ";
			$query .= "inner join gender on gender.id = clothes.gender_id ";
			$query .= "inner join type on type.id = clothes.type_id ";
			$query .= "inner join brands on brands.id = clothes.brand_id ";
			$query .= "where clothes.ID in ($arrayString);";
			return $query;
		}
		
		public function getByID($ID){
			foreach($this->clothesList as $cloth){
				if($cloth->getID() == $ID){
					return $cloth;
				}
			}
			return -1;
		}

		//fileds getters
		public function getClothesList(){
			return $this-> clothesList;
		}
	}
?>