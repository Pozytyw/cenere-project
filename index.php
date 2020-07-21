<!-- home -->
<!doctype html>
<html lang="en">
	<?php
		session_start();
		$directory = $_SERVER['DOCUMENT_ROOT'];
		$home = "http://".$_SERVER['SERVER_NAME'];
		$reqestUrl = explode('?', $_SERVER['REQUEST_URI'], 2);
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
    <link rel="stylesheet" href="style.css">
	<!-- navi style -->
    <link rel="stylesheet" <?php echo "href='".$home."/elements/style.css'"?>>
	
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Bowlby+One+SC&display=swap" rel="stylesheet">
	<link href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all" rel="stylesheet">
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />
  </head>
  <body>
	<?php include($directory."/elements/header.php");?>
    <main>
      <div class="container-fluid p-0 mb-5">
        <div class="site-slider m-0">
          <div class="slider-items1">
            <div class="item1">
              <img src="http://cdn.aboutstatic.com/file/e440be51859e7fc5cb0feb9aa7bd2ff3?width=2000&height=1000&quality=90" class ="img-fluid" alt="">
            </div>
            <div class="item1">
              <img src="http://cdn.aboutstatic.com/file/57239d276d8b139160b7f68f80c52cdf?width=2000&height=1000&quality=90" class ="img-fluid"alt="">
            </div>
            <div class="item1">
              <img src="http://cdn.aboutstatic.com/file/406a3fc570bc881ea40c095840b6666f?width=2000&height=1000&quality=90" class ="img-fluid" alt="">
            </div>
            <div class="item1">
              <img src="http://cdn.aboutstatic.com/file/f12aa95bd56d16e568f30096fc964bdc?width=2000&height=1000&quality=90" class ="img-fluid" alt="">
            </div>
          </div>
          <div class="btn-slider1">
            <span class="left1 arrow1 position"><i class="fas fa-angle-left"></i></span>
            <span class="right1 arrow1 position"><i class="fas fa-angle-right"></i></span>
          </div>
        </div>
      </div>
      
      <div class="container-fluid p-0 ">
        <div class="col-12 divek pl-5 pt-4 border-top h2" >Może Ci się spodobać...</div>
        <div class="site-slider m-0">
          <div class="slider-items">
            <div class="item">
              <img src="https://mosaic03.ztat.net/vgs/media/catalog-lg/TO/12/1D/0F/FA/11/TO121D0FF-A11@4.jpg" class ="img-fluid" alt="">
            </div>
            <div class="item">
              <img src="https://mosaic04.ztat.net/vgs/media/catalog-lg/GU/12/1D/0T/3Q/11/GU121D0T3-Q11@8.jpg" class ="img-fluid"alt="">
            </div>
            <div class="item">
              <img src="https://mosaic03.ztat.net/vgs/media/catalog-lg/TO/12/1D/0D/NC/11/TO121D0DN-C11@4.jpg" class ="img-fluid" alt="">
            </div>
            <div class="item">
              <img src="https://mosaic03.ztat.net/vgs/media/catalog-lg/TO/12/1D/0F/FA/11/TO121D0FF-A11@4.jpg" class ="img-fluid" alt="">
            </div>
            <div class="item">
              <img src="https://mosaic04.ztat.net/vgs/media/catalog-lg/GU/12/1D/0T/3Q/11/GU121D0T3-Q11@8.jpg" class ="img-fluid" alt="">
            </div>
            <div class="item">
              <img src="https://mosaic03.ztat.net/vgs/media/catalog-lg/TO/12/1D/0D/NC/11/TO121D0DN-C11@4.jpg" class ="img-fluid" alt="">
            </div>
            <div class="item">
              <img src="https://mosaic03.ztat.net/vgs/media/catalog-lg/TO/12/1D/0F/FA/11/TO121D0FF-A11@4.jpg" class ="img-fluid" alt="">
            </div>
            <div class="item">
              <img src="https://mosaic04.ztat.net/vgs/media/catalog-lg/GU/12/1D/0T/3Q/11/GU121D0T3-Q11@8.jpg" class ="img-fluid" alt="">
            </div>
            <div class="item">
              <img src="https://mosaic03.ztat.net/vgs/media/catalog-lg/TO/12/1D/0D/NC/11/TO121D0DN-C11@4.jpg" class ="img-fluid" alt="">
            </div>
          </div>
          <div class="btn-slider">
            <span class="left arrow position"><i class="fas fa-angle-left"></i></span>
            <span class="right arrow position"><i class="fas fa-angle-right"></i></span>
          </div>
        </div>
      </div>
      
    </main>

    <footer>
      <div class="container-fluid">
        <div class="row border-top py-4">
          <div class="col-md-6 p-0 my-auto">
            <span class="w-60 text-center"><h2>Zapisz się do naszego newslettera: </h2></span>
          </div>
          <div class="col-md-6 p-0 my-auto">
            <form class="form-inline ml-5">
              <input class="form-control border-secondary form-rounded form-width" type="email" placeholder="Wpisz swój adres email..." aria-label="Email">
              <button class="btn btn-outline-secondary ml-1 form-rounded" type="button"><i class="fas fa-paper-plane"></i></button> <!-- DOROBIC JSA DO TEGO -->
            </form>
          </div>
        </div>
      </div>
    </footer>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/712d4f9a10.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="script.js"></script>
	<!-- navi script -->
	<script <?php echo "src='".$home."/elements/script.js'"?>></script>
</body>
</html>