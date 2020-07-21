<?php
	$directory = $_SERVER['DOCUMENT_ROOT'];
	require_once ($directory."/database/databaseLink.php");
	
	$home = "http://".$_SERVER['SERVER_NAME'];
	
	//login data ini
	$email    = "";
	
	$registerError= "";	
	
	$isError = false;
	
	// connect to the database
	$connectorDB = new ConnectorDB();
	//register 
	if (isset($_POST['reg_user'])) {
		//get data from form
		$email = mysqli_real_escape_string($connectorDB, $_POST['email']);
		$password = mysqli_real_escape_string($connectorDB, $_POST['password']);
		$passwordR = mysqli_real_escape_string($connectorDB, $_POST['passwordR']);
		$passwordR = mysqli_real_escape_string($connectorDB, $_POST['passwordR']);
		//valid gender
		if(isset($_POST['gender'])){
			$gender = mysqli_real_escape_string($connectorDB, $_POST['gender']);
		}else{
			$registerError = "Choose gender is required"; $isError = true;
		}
		//valid data, and add error if necessary
		if(empty($email)){	$registerError = "Email is required"; $isError = true;}
		if(empty($password)){	$registerError = "Password is required"; $isError = true;}
		if ($password != $passwordR){	$registerError = "Passwords do not match"; $isError = true;}
	
	
		//valid email in db
		$user_check_query = "select * from users where email like '$email' limit 1;";
		$result = mysqli_query($connectorDB, $user_check_query);
		//if user with this email already exist
		$user = mysqli_fetch_assoc($result);
		if($user){
			$registerError = "Email is already exist"; $isError = true;
		}
		
		//register new user if error not occured
		if(!$isError){
			//encrypt password
			$password = md5($password);
			//get gender id
			$query  = "select id from gender where gender like '$gender';";
			$result = $connectorDB -> query($query);
			$result = mysqli_fetch_assoc($result);
			$gender_id = $result['id'];
			
			//add user to db query
			$query = "insert into users values(default, '$email', '$password', '$gender_id');";
			//send query to db
			$connectorDB -> query($query);
			
			//create wallet for user; 
			//query get user, which email = email
			$query  = "select id as id from users where email like '$email';";
			//send query to db
			$result = $connectorDB -> query($query);
			$id = mysqli_fetch_assoc($result)['id'];
			$query  = "insert into wallets values(default, 10000.00, $id)";
			$connectorDB -> query($query);
			
			header('location: '.$home);
		}
	}
?>