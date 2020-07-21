<?php
	require_once("databaseLink.php");
	class TypeList{
		private $typeList = [];
		
		function __construct($gender){
			//create connector do db and query
			$connectorDB = new ConnectorDB();
			
			//call to db
			$result = $connectorDB -> query($this->getTypeQery($gender));
			//loop for result
			if($result)
			while($row = mysqli_fetch_assoc($result)){
				//add all uniq type
				array_push($this->typeList, $row['type']);
			}
			$connectorDB -> close();
		}
		
		//query getters
		private function getTypeQery($gender){
			return "select type.type as type, gender.gender from type inner join gender on gender.ID = type.gender_id where gender.gender = '$gender';";
		}
		
		public function getTypeList(){
			return $this->typeList;
		}
	}
?>