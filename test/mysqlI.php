<?php
	$email = "'ala\'";
	$password = "%a%";
	
	$query = "select users.ID as ID, users.email as email, gender.gender as gender, wallets.ID as wallet_id, wallets.balance as balance from users ";
	$query .= "inner join gender on gender.id = users.gender_id ";
	$query .= "inner join wallets on wallets.user_id = users.id ";
	$query .= "where email like '$email' and password like '$password'; ";
	
	echo $query;
?>