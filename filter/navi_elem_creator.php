<?php
	class NaviCreator{
		private $url, $gender;
		function __construct($url, $gender) {
			$this -> url = $url;
			$this -> gender = $gender;
		}
		
		function getHTML($type, $class){
			$href = $this->url.'?gender='.$this->gender.'&type='.$type;
			return "<a class='$class' href='$href'>$type</a>";
		}
	}
?>