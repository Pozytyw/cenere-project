<?php
	$directory = $_SERVER['DOCUMENT_ROOT'];
	$home = "http://".$_SERVER['SERVER_NAME'];
	require_once($directory."/database/databaseLink.php");
	require_once($directory."/database/user.php");
	$loginError = "";
	//connector to the database
	$connectorDB = new ConnectorDB();
	
	//include logout
	include("logout.php");
	
	//set remember_token
	function setRememberToken($user_id, $remember_token, $connectorDB){
		$query = "update users set remember_token = '$remember_token' where id = $user_id;";
		$connectorDB -> query($query);
	}
	
	//login function
	function loginViaCookie($remember_token, $connectorDB){
		$query = "select users.ID as ID, users.email as email, gender.gender as gender, wallets.ID as wallet_id, wallets.balance as balance from users ";
		$query .= "inner join gender on gender.id = users.gender_id ";
		$query .= "inner join wallets on wallets.user_id = users.id ";
		$query .= "where remember_token like '$remember_token'";
		$results = $connectorDB -> query($query,0);
		$result = mysqli_fetch_assoc($results);
		if (mysqli_num_rows($results) > 0) {
			$wallet = new Wallet($result['wallet_id'], $result['balance']);
			//User($ID, $email, $gender, $wallet)
			$user = new User($result['ID'], $result['email'], $result['gender'], $wallet);
			$_SESSION['user'] = serialize($user);
		}
	}
	
	function login($email, $password, $connectorDB){
		$email = mysqli_real_escape_string($connectorDB, $email);
		$password = mysqli_real_escape_string($connectorDB, $password);
		$isError = false;
		if(empty($email)){	return "Email is required"; $isError = true;}
		if(empty($password)){	return "Password is required"; $isError = true;}
		if (!$isError) {
			$password = md5($password);
			$query = "select users.ID as ID, users.email as email, gender.gender as gender, wallets.ID as wallet_id, wallets.balance as balance from users ";
			$query .= "inner join gender on gender.id = users.gender_id ";
			$query .= "inner join wallets on wallets.user_id = users.id ";
			$query .= "where email like '$email' and password like '$password'; ";
			error_log($query);
			$results = $connectorDB -> query($query,0);
			$result = mysqli_fetch_assoc($results);
			if (mysqli_num_rows($results) > 0) {
				$wallet = new Wallet($result['wallet_id'], $result['balance']);
				//User($ID, $email, $gender, $wallet)
				$user = new User($result['ID'], $result['email'], $result['gender'], $wallet);
				$_SESSION['user'] = serialize($user);
				if(isset($_POST['remember'])){
					//remember user data in cookies
					$remember_token = md5($email.strval(rand(0,100000)));
					setRememberToken($result['ID'], $remember_token, $connectorDB);
					setcookie("remember_token",$remember_token,time()+86400*30,'/');
				}
				return "Login successfully";
			}else {
				return "Incorrect login data";
			}
		}
	}
	
	//if user wasnt login and in cookie avaiable his email and password
	if(!isset($_SESSION['user'])){
		if(isset($_COOKIE["remember_token"])){
			loginViaCookie($_COOKIE["remember_token"], $connectorDB);
		}
		
	}
	//check, if user click login in modal
	if (isset($_POST['login_user'])) {
		 $email = $_POST['email'];
		 $password = $_POST['password'];
		 $loginError = login($email, $password, $connectorDB);
	}
	$connectorDB -> close();
?>