<?php
	include('cloth.php');
	require_once("databaseLink.php");
	class Clothes{
		private $gender;
		private $clothesList = [];
		private $typeList = [];
		
		function __construct($gender){
			//create connector do db and query
			$connectorDB = new ConnectorDB();
			
			//call to db
			$result = $connectorDB -> query($this->getClothesQery($gender));
			
			//loop for result
			if($result)
			while($row = mysqli_fetch_assoc($result)){
				// new cloth  __construct($id, $brand, $name, $price, $gender, $type, $img_src){
				array_push($this->clothesList, new Cloth($row['id'], $row['brand'], $row['name'], $row['price'], $row['gender'], $row['type'], $row['img_src']));
			}
			//call to db
			$result = $connectorDB -> query($this->getTypeQery($gender));
			//loop for result
			if($result)
			while($row = mysqli_fetch_assoc($result)){
				//add all uniq type
				array_push($this->typeList, $row['type']);
			}
		}
		
		//query getters
		private function getClothesQery($gender){
			//query, which getting type where gender = 'gender from path';
			$query = "select clothes.ID as id, clothes.name as name, brands.name as brand, clothes.img_src as img_src, clothes.price as price, gender.gender as gender, type.type as type from clothes ";
			$query .= "inner join gender on gender.id = clothes.gender_id ";
			$query .= "inner join type on type.id = clothes.type_id ";
			$query .= "inner join brands on brands.id = clothes.brand_id ";
			$query .= "where gender = '$gender';";
			
			return $query;
		}
		private function getTypeQery($gender){
			return "select type.type as type, gender.gender from type inner join gender on gender.ID = type.id_gender where gender.gender = '$gender';";
		}
		public function getClothesList(){
			return $this-> clothesList;
		}
		
		public function getClothesByType($type, $gender){
			$outPutList = [];
			
			//loop through all elem in clothes list
			foreach ($this->clothesList as $cloth){
				//add to outputlist if type equal
				if($cloth->getTypeC() == $type && $cloth->getGender() == $gender){
					array_push($outPutList, $cloth);
				}
			}
			return $outPutList;
			
		}
		
		public function getTypeList(){
			return $this->typeList;
		}
	}
?>