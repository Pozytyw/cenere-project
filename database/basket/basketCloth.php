<?php
	class BasketCloth{
		private $id;
		private $size;
		private $amount;
		
		public function __construct($id, $size, $amount){
			$this->id = $id;
			$this->size = $size;
			$this->amount = $amount;
		}
		
		public function getID(){
			return $this->id;
		}
		
		public function getSize(){
			return $this->size;
		}
		
		public function getAmount(){
			return $this->amount;
		}
		
		public function setAmount($amount){
			$this->amount = $amount;
		}
	}
?>