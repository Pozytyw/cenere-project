<?php
	include('htmlElement.php');
	
	class Cloth implements htmlElement{
		private $id;
		private $brand;
		private $name;
		private $color;
		private $preciseType;
		private $price;
		private $gender;
		private $type;
		private $img_src;
		private $class = "box col-md-4 col-12 p-0 hover";
		
		function __construct($id, $brand, $name, $price, $gender, $type, $img_src){
			$this->id = $id;
			//get more data for name string
			$arrayName = explode("-",$name);
			$this->name = $arrayName[0];
			if(count($arrayName) > 1){
				if(count($arrayName) > 2){
					$this->color = $arrayName[2];
					$this->preciseType = $arrayName[1];
				}else{
					$this->color = $arrayName[1];
				}
			}
			$this->brand = $brand;
			$this->price = $price;
			$this->gender = $gender;
			$this->type = $type;
			$this->img_src = $img_src;
				
		}
		
		public function getID(){	
			return base64_encode($this->id);
		}
		
		public function getName(){
			return $this->name;
		}
		
		public function getPrice(){
			return $this->price;
		}
		
		public function getGender(){
			return $this->gender;
		}
		
		public function getTypeC(){
			return $this->type;
		}
		
		public function getImg_src(){
			return $this->img_src;
		}
		
		public function innerHTML($home){
			$id = $this->getID();
			$outputHTML = "<div class='mb-5  $this->class'>";
			$outputHTML .= "<div class=''> ";
			$outputHTML .= "<a href='$home/clothes/?id=$id'>";
			$outputHTML .= "<img class='img-fluid img-thumbnail px-3 pb-5' src='$this->img_src'/>";
			$outputHTML .= "</a>";
			$outputHTML .= "<div class='price'>";
			$outputHTML .= "$this->price zł";
			$outputHTML .= "</div>";
			$outputHTML .= "</div>";
			$outputHTML .= "</div>";
			return $outputHTML;
		}

		public function innerHTMLSlider($home){
			$id = $this->getID();
			$outputHTML = "<div class='item2'>";
			$outputHTML .= "<a href='$home/clothes/?id=$id'>";
			$outputHTML .= "<img class='img-fluid px-3' src='$this->img_src'/>";
			$outputHTML .= "</a>";
			$outputHTML .= "</div>";
			return $outputHTML;
		}

		public function innerLabel(){
			$id = $this->getID();
			$outputHTML = "<div class='row justify-content-center mb-5'>";
			$outputHTML .= "<div class='col-md-3 mb-5 col-sm-12 text-center'>";
			$outputHTML .= "<img class='img-fluid' src='$this->img_src'/>";
			$outputHTML .= "</div>";
			$outputHTML .= "<div class='col-md-4 col-sm-12 mb-5 text-left'>";
			$outputHTML .= "<p class='py-3'>";
			$outputHTML .= "<h2 class='font-weight-bold'>$this->brand</h2>";
			if(isset($this->preciseType)){
				$outputHTML .= "<h3>$this->name - $this->preciseType</h3>";
			}else{
				$outputHTML .= "<h3>$this->name</h3>";
			}
			$outputHTML .= "<h3 class='text-muted'> Kolor: $this->color</h3>";
			$outputHTML .= "<h3> $this->price zł </h3>";
			$outputHTML .= "<br>";
			$outputHTML .= "<br>";
			$outputHTML .= "<br>";
			$outputHTML .= "<h3> Rozmiar: </h3>";
			$outputHTML .= "<select name='rozmiar' class='custom-select'>";
			$outputHTML .= "<option value='xs'> XS </option>";
			$outputHTML .= "<option value='s'> S </option>";
			$outputHTML .= "<option value='m'> M </option>";
			$outputHTML .= "<option value='l'> L </option>";
			$outputHTML .= "<option value='xl'> XL </option>";
			$outputHTML .= "<option value='xxl'> XXL </option>";
			$outputHTML .= "</select>";
			$outputHTML .= "<br>";
			$outputHTML .= "<button id='$id' style='transition: all 0.3s linear;' class='btn btn-dark btn-block mt-2 btn-lg add'> Do koszyka </button>";
			$outputHTML .= "<div class='toast px-5' style='position: absolute;margin-left:50%; transform:translate(-55%);' role='alert' aria-live='assertive' aria-atomic='true'>";
			$outputHTML .= "<div class='toast-header'>";
			$outputHTML .= "<strong class='mx-auto'>Dodano do koszyka</strong>";
			$outputHTML .= "</div>";
			$outputHTML .= "</div>";
			$outputHTML .= "</p>";
			$outputHTML .= "</div>";
			$outputHTML .= "</div>";
			return $outputHTML;
		}
		
	}

?>

