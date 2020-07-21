<?php
	include('cloth.php');
	require_once('databaseLink.php');
	class ClothLabelList{
		private $gender;
		private $clothesList = [];
		private $mainCloth;
		
		function __construct($id){
			//create connection do db and query
			$connectorDB = new ConnectorDB();
			
			//call to db, and get mainCloth
			$result = $connectorDB -> query($this->getMainQery($id));
			
			//loop for result
			if($result)
			while($row = mysqli_fetch_assoc($result)){
				// new cloth  __construct($id, $brand, $name, $price, $gender, $type, $img_src){
				$this->mainCloth = new Cloth($row['id'], $row['brand'], $row['name'], $row['price'], $row['gender'], $row['type'], $row['img_src']);
			}
			
			//call to db, and get clothes list, which have type_id like main cloth
			$result = $connectorDB -> query($this->getClothesQery($this->mainCloth->getTypeC(), $this->mainCloth->getGender(), $id));
			//loop for result
			if($result)
			while($row = mysqli_fetch_assoc($result)){
				// new cloth  __construct($id, $brand, $name, $price, $gender, $type, $img_src){
				array_push($this->clothesList, new Cloth($row['id'], $row['brand'], $row['name'], $row['price'], $row['gender'], $row['type'], $row['img_src']));
			}
		}
		
		//query getters
		private function getClothesQery($type, $gender, $main_id){
			//query, which get 10 random clothes by type
			$query = "select clothes.ID as id, clothes.name as name, brands.name as brand, clothes.img_src as img_src, clothes.price as price, gender.gender as gender, type.type as type from clothes ";
			$query .= "inner join gender on gender.id = clothes.gender_id ";
			$query .= "inner join type on type.id = clothes.type_id ";
			$query .= "inner join brands on brands.id = clothes.brand_id ";
			$query .= "where type.type = '$type' and gender.gender = '$gender' and clothes.id <> $main_id order by rand() limit 10;";
			
			return $query;
		}
		
		private function getMainQery($id){
			//query, which get cloth by id
			$query = "select clothes.ID as id, clothes.name as name, brands.name as brand, clothes.img_src as img_src, clothes.price as price, gender.gender as gender, type.type as type from clothes ";
			$query .= "inner join gender on gender.id = clothes.gender_id ";
			$query .= "inner join type on type.id = clothes.type_id ";
			$query .= "inner join brands on brands.id = clothes.brand_id ";
			$query .= "where clothes.ID = $id limit 1;";
			
			return $query;
		}
		
		//fileds getters
		public function getClothesList(){
			return $this-> clothesList;
		}
		
		public function getMainCloth(){
			return $this-> mainCloth;
		}
	}
?>