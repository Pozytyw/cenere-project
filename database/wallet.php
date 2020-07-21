<?php
	class Wallet{
		private $ID;
		private $balance;
		
		public function __construct($ID, $balance){
			$this->ID = $ID;
			$this->balance = $balance;
		}
		
		public function getBalance(){
			return $this->balance;
		}
		
		public function getID(){
			return $this->ID;
		}
		
		public function setBalance($dbConnector, $balance){
			$query = "update wallets set balance = $balance where id = this->ID;";
			$dbConnector->query($query);
		}
	}
?>