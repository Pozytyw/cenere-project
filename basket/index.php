<!-- basket -->
<!doctype html>
<html lang="en">
	<?php
		session_start();
		$home = "http://".$_SERVER['SERVER_NAME'];
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
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Bowlby+One+SC&display=swap" rel="stylesheet">
	<link href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all" rel="stylesheet">
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />
  </head>

	<?php include($directory."/elements/header.php");?>
  <body>
	<main>
		<div class="container">
			<div class="row align-items-center border-bottom">
				<div class="col-md-4 text-center p-2"><h3 class="font-weight-bold">PRODUKT</h3></div>
				<div class="col-md-4 text-center border-left border-right p-2"><h3 class="font-weight-bold">ROZMIAR / ILOŚĆ</h3></div>
				<div class="col-md-4 text-center p-2"><h3 class="font-weight-bold">CENA</h3></div>
			</div>
			<?php
				//setup loop
				include($directory."/database/basket/basket.php");
				include($directory."/database/clothBasket.php");
				if(isset($_COOKIE["basket"])){
					$basket = unserialize($_COOKIE["basket"]);
					$clothBasket = new ClothBasket($basket->getIDString());
				}else{
					$basket = new Basket();
					$clothBasket = new ClothBasket("");
				}
			
			?>
			<form role="form" method="post" <?php echo "action='".$home."/basket/buy.php'";?>>
			<?php foreach($basket->getBasket() as $key=>$elem): ?>
			<?php 
				//get cloth element
				$id = $elem->getID();
				$cloth = $clothBasket->getByID($id);
				//get amount
				$amount = $elem->getAmount();
			?>
			<div <?php echo "id='$key'"?>class="row align-items-center border-bottom">
				<input name="id[]" type="hidden" <?php echo "value='$id'"?>>
				<div class="col-md-4 text-center  p-2 "><h5><?php echo $cloth->getName();?></h5></div>
				<div class="col-md-4 text-center  p-4 border-left border-right">
					<select name='size[]' class='custom-select'>
							<option value='xs' <?php if($elem->getSize() == 'xs') echo "selected='selected';"?>> XS </option>
							<option value='s' <?php if($elem->getSize() == 's') echo "selected='selected'"?>> S </option>
							<option value='m' <?php if($elem->getSize() == 'm') echo "selected='selected'"?>> M </option>
							<option value='l' <?php if($elem->getSize() == 'l') echo "selected='selected'"?>> L </option>
							<option value='xl' <?php if($elem->getSize() == 'xl') echo "selected='selected'"?>> XL </option>
							<option value='xxl' <?php if($elem->getSize() == 'xxl') echo "selected='selected'"?>> XXL </option>
					</select> 
					<input name="amount[]" type="number" placeholder="Wybierz ilość" min="0" <?php echo "value='$amount'"?>class="form-control mt-2">
				</div>
			<div class="col-md-4 text-center p-2">
				<h5><?php echo $cloth->getPrice()." zł";?></h5>
				<div style="position: absolute; right: 0; top: 0;"><button <?php echo "id='$key'"?> type="button" class="close">&times;</button></div>
			</div>
			</div>
			<?php endforeach; ?>
		</div>
		<?php if(isset($_SESSION['user'])):?>
		<div class="col-12 text-center py-5"><button class="btn btn-outline-secondary btn-lg" type="submit">PRZEJDŹ DO PŁATNOŚCI</button></div>
		<?php else: ?>
		<div class="col-12 text-center"><h3>ZALOGUJ SIĘ ABY PRZEJŚĆ DO PŁATNOŚCI</h3></div>
		<?php endif ?>
	</main>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/712d4f9a10.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<!-- basket local script -->
	<script src="script.js"></script>
	<!-- navi script -->
	<script <?php echo "src='".$home."/elements/script.js'"?>></script>
</body>
</html>