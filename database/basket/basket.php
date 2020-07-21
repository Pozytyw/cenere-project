<?php
	require_once("basketCloth.php");
	class Basket{
		private $basket = [];
		
		public function getBasket(){
			return $this-> basket;
		}
		
		public function getIDString(){
			$output = "";
			foreach($this->basket as $basketCloth){
				$output .= base64_decode($basketCloth->getID()).",";
			}
			$output = substr($output, 0, strlen($output)-1);
			return $output;
		}
		
		public function add($basketCloth){
			if($this->isInclude($basketCloth)){
				$key = $this->getKey($basketCloth);
				$basketCloth = $this->basket[$key];
				$basketCloth->setAmount($basketCloth->getAmount() + 1);
				
			}else{
				array_push($this->basket, $basketCloth);	
			}
		}
		public function remove($basketCloth){
			if($this->isInclude($basketCloth)){
				$key = $this->getKey($basketCloth);
				unset($this->basket[$key]);
			}
		}
		
		public function changeAmount($amount,$basketCloth){
			if($this->isInclude($basketCloth)){
				$key = $this->getKey($basketCloth);
				$this->basket[$key]->setAmount($amount);
			}
		}
	
		public function isInclude($basketCloth){
			$filteredArray = array_filter($this->basket, function($elem) use($basketCloth){
				return $elem->getID() == $basketCloth->getID() && $elem->getSize() == $basketCloth->getSize();
			});
			
			if(count($filteredArray) > 0)
				return true;
			else
				return false;
		}
		
		public function getKey($basketCloth){
			foreach($this->basket as $key=>$cloth){
				if($cloth->getSize() == $basketCloth->getSize() && $cloth->getID() == $basketCloth->getID())
					return $key;
			}
			return -1;
		}
		
	}
?>