<!-- order -->
<!doctype html>
<html lang="en">
	<?php
		session_start();
		$home = "http://".$_SERVER['SERVER_NAME'];
		
		if(!isset($_SESSION['user'])){
			header('location: '.$home);
		}
		$directory = $_SERVER['DOCUMENT_ROOT'];
		$reqestUrl = $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
		//set '/' when in url didn't occur param or precision url
		if(!isset($reqestUrl[0])) $reqestUrl[0] = "";
		if(!isset($reqestUrl[1])) $reqestUrl[1] = "";
		else
			$reqestUrl[1] = '?'.$reqestUrl[1];//add ? at start of string to create correct param url
		include($directory."/elements/login.php");
		include($directory."/elements/register.php");
	?> 
  <head>
    <title>Cenere</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- navi style -->
    <link rel="stylesheet" <?php echo "href='".$home."/elements/style.css'"?>>
	<!-- database style -->
    <link rel="stylesheet" <?php echo "href='".$home."/database/style.css'"?>>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Bowlby+One+SC&display=swap" rel="stylesheet">
	<link href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all" rel="stylesheet">
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />
	<style>
		p.orders {
		transition: all 0.5s ease;
		
		}
		p.orders > a {
			color: black !important;
		}

		p.orders *:hover, p.orders:active{
			color: rgb(119, 53, 136) !important;
		}
	</style>
  </head>

	<?php include($directory."/elements/header.php");?>
  <body>
	<main>
		<?php
		include("buy.php");			
		include($directory."/database/buyClothes.php");			
		include($directory."/database/orderList.php");
		$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$parts = parse_url($url);
		//when in url was given order id 
		if(isset($parts['query'])){
			parse_str($parts['query'], $parmUrl);
			
			$user = unserialize($_SESSION['user']);
			$wallet_id = $user->getWallet()->getID();
			
			if(isset($parmUrl['order'])){
				$buyClothes = new BuyClothes($parmUrl['order']);
				echo "<div class='container text-center h5 pt-3'>";
				echo "<div class='shadow rounded mt-5'>"."<br>";
				foreach($buyClothes->getClothesList() as $cloth){
					echo "<div class='col-12 p-1'>";
					echo $cloth->getName()." cena : ".$cloth->getPrice()."<br>";
					echo "</div>";
				}
				if($buyClothes->getPaid()){
					echo "<div class='col-12 py-5'>";
					echo "<div class='col-12 py-5'> Środki po transakcji: ".$buyClothes->getWalletBalance($wallet_id)."</div>";
					echo "<span class='border rounded p-3'>Juz Opłacono</span>";
					echo "</div>";
				}else{
					echo "<br>"."<span class=''>Nie opłacone</span>"."<br>"."<br>";
					$total_price = $buyClothes->getTotal_price();
					echo "Do zapłaty: $total_price"."<br>";
					echo "Dostępne środki: ".$buyClothes->getWalletBalance($wallet_id)."<br>";
					if($buyClothes->getPaid()){
						echo "<span class='pt-3'>Oplacono</span>";
					}else{
						$orderID = $buyClothes->getID();
						$userID = $user->getID();
						$action = $home.$reqestUrl[0].$reqestUrl[1];
						echo "<form method='post' action='$action' class='py-5'>";
						echo "<input type='hidden' name='orderID' value='$orderID'>";
						echo "<button class='btn btn-lg btn-outline-secondary' name='buy'>Zamawiam i place</button>";
						echo "</form>";
					}
				}
			}
			echo "</div>";
			echo "</div>";
		}else{
			//else show all order for user, if he is login
			$user = unserialize($_SESSION['user']);
			$orderList = new OrderList($user->getID());
			//list all order for user
			$list = $orderList -> getOrderList();
			echo "<div class='container text-center'>";
			echo "<h3 class='font-weight-bold'> Zamówienia </h3>";
			foreach($list as $order){
				echo $order->getClothesNameList($home);
			}
			
			echo "</div>";
		}
		?>
	</main>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/712d4f9a10.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<!-- navi script -->
	<script <?php echo "src='".$home."/elements/script.js'"?>></script>
</body>
</html>