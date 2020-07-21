<?php
	if (isset($_POST['buy'])){
		$directory = $_SERVER['DOCUMENT_ROOT'];
		require_once($directory.'/database/databaseLink.php');
		$connectorDB = new ConnectorDB();
		$user = unserialize($_SESSION['user']);
		$orderID = $_POST['orderID'];
		$userID = $user->getID();
		
		$queryTest = "select orders.total_price as total_price, orders.paid as paid, (wallets.balance - orders.total_price > 0) as balance from orders ";
		$queryTest .= "left join users on orders.user_id = users.id ";
		$queryTest .= "inner join wallets on wallets.user_id = $userID ";
		$queryTest .= "where orders.id = $orderID;";
		
		//do query test
		$result = $connectorDB->query($queryTest);
		$row = mysqli_fetch_assoc($result);
		//when user have enough balance for transaction and order wasnt paid
		if($row["paid"] == 0 && $row['balance'] == 1){
			$total_price = $row['total_price'];
			
			//begin transaction
			$connectorDB->begin_transaction();
			
			//first query
			$connectorDB->query("update orders set paid = 1 where id = $orderID;");	
			//second query
			$connectorDB->query("update wallets set balance = balance - $total_price where user_id = $userID;");	
			
			//commit
			$connectorDB->commit();
			$connectorDB->close();
		
		}else{
			$connectorDB->close();
		}
	}
?>