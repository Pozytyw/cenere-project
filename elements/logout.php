<?php
	if (isset($_POST['logout'])){
		//remove user from session if set
		if(isset($_SESSION['user']))
			unset($_SESSION['user']);
		//remove email cookie  if set
		if(isset($_COOKIE["email"])){
			setcookie('email', null, -1, '/');
			unset($_COOKIE['email']);
		}
		//remove password cookie if set
		if(isset($_COOKIE["password"])){
			setcookie('password', null, -1, '/'); 
			unset($_COOKIE['password']);
		}
	}
?>