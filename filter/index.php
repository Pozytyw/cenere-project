<!--filtered page -->
<!doctype html>
<html lang="en">
	<?php
		session_start();
		$directory = $_SERVER['DOCUMENT_ROOT'];
		$home = "http://".$_SERVER['SERVER_NAME'];
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
	<link rel="stylesheet"<?php echo "href='".$home."/database/style.css'"?>>
	
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Bowlby+One+SC&display=swap" rel="stylesheet">
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />
  </head>
  <body>  
	<?php
	//include header for side
	include($directory."/elements/header.php");?>
	<main>
	<?php
		include('navi_elem_creator.php');
		include($directory."/database/clothes.php");
		include($directory."/database/searchClothes.php");
		
		$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$parts = parse_url($url);
		
		//when in url didnt give query
		if(!isset($parts['query'])){
			//change location
			echo "<script>window.location.href = '$home'</script>";
		}else{
			//if in url occur query
			parse_str($parts['query'], $parmUrl);
			
			//if parm is gender
			if(isset($parmUrl['gender'])){
				//get gender from url
				$gender = $parmUrl['gender'];
				
				//create clothes object
				$clothes = new Clothes($gender);
				
				//if type was give in path
				if(isset($parmUrl['type'])){
					//get correct type from url
					$type = str_replace('%',' ',$parmUrl['type']);;
		
					echo "<div class='container'>";
					echo "<div class='row'>";
					foreach($clothes->getClothesByType($type, $gender) as $key=>$cloth){
						if($key%3==0 && $key!=0){
							echo "</div>";
							echo "<div class='row'>";
							echo $cloth->innerHTML($home);
						}else
						//create element for one cloth
						echo $cloth->innerHTML($home);
					}
					echo "</div>";
				}	
			}else if(isset($parmUrl['query'])){
				$searchQuery = $parmUrl['query'];
				$parmsArray = explode(" ",$searchQuery);
				$searchClothes = new SearchClothes($parmsArray);
				
				echo "<div class='container'>";
					echo "<div class='row'>";
					foreach($searchClothes->getClothesList() as $key=>$cloth){
						if($key%3==0 && $key!=0){
							echo "</div>";
							echo "<div class='row'>";
							echo $cloth->innerHTML($home);
						}else
						//create element for one cloth
						echo $cloth->innerHTML($home);
					}
				echo "</div>";
				
			}else{
				echo "<script>window.location.href = '$home'</script>";
			}
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