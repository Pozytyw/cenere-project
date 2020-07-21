<?php
	require_once("wallet.php");
	class User{
		private $ID;
		private $email;
		private $gender;
		private $wallet;
		
		public function __construct($ID, $email, $gender, $wallet){
			$this->ID = $ID;
			$this->email = $email;
			$this->gender = $gender;
			$this->wallet = $wallet;
		}
		
		public function getEmail(){
			return $this->email;
		}
		
		public function getID(){
			return $this->ID;
		}
		
		public function getWallet(){
			return $this->wallet;
		}
	}
?>