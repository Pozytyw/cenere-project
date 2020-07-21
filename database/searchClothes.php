<?php
	require_once('cloth.php');
	require_once("databaseLink.php");
	class SearchClothes{
		private $clothesList = [];
		private $connectorDB;
		function __construct($parmsArray){
			//create connector do db and query
			$this->connectorDB = new ConnectorDB();
			
			//call to db
			$result = $this->connectorDB -> query($this->getSearchQuery($parmsArray));
			
			//loop for result
			if($result){
				while($row = mysqli_fetch_assoc($result)){
					// new cloth  __construct($id, $brand, $name, $price, $gender, $type, $img_src){
					array_push($this->clothesList, new Cloth($row['id'], $row['brand'], $row['name'], $row['price'], $row['gender'], $row['type'], $row['img_src']));
				}
			}
		}
		
		//query getters
		private function getSearchQuery($parmsArray){
			//query, which getting type where gender = 'gender from path';
			$regexp = implode($parmsArray, "|");
			mysqli_real_escape_string($this->connectorDB, $regexp);
			$query = "select clothes.ID as id, clothes.name as name, brands.name as brand, clothes.img_src as img_src, clothes.price as price, gender.gender as gender, type.type as type from clothes ";
			$query .= "inner join gender on gender.id = clothes.gender_id ";
			$query .= "inner join type on type.id = clothes.type_id ";
			$query .= "inner join brands on brands.id = clothes.brand_id ";
			$query .= "where CONCAT(clothes.name, brands.name, type.type) REGEXP '$regexp' limit 60; ";			
			return $query;
		}

		public function getClothesList(){
			return $this-> clothesList;
		}
	}
?>