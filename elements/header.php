<?php
	//include necessary class
	include($directory."/database/typeList.php");
	
	//create type list object
	$clothesK = new TypeList('kobiety');
	$clothesM = new TypeList('mezczyzni');
?>
<!-- MODAL LOGOWANIE -->
<div class="container">
		<?php /*if user open login modal*/if(isset($_POST['login_user'])):?>
			<div class="modal fadeInDown first openModal" id="logowanie" role="dialog">
		<?php else: ?>
			<div class="modal fadeInDown first" id="logowanie" role="dialog">
		<?php endif ?>
		<div class="modal-dialog">
			<div class="modal-content">
				<?php if(!isset($_SESSION['user'])):?>
				<div class="modal-header fadeIn second" style="padding:35px 50px;">
					<h4><i class="fas fa-user "></i>  Logowanie</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body" style="padding:40px 50px;">
					<?php /*crete form action, depending on url*/if(strpos($reqestUrl[0],"index.php")):?>
						<form role="form" method="post" <?php echo "action='".$home.$reqestUrl[0].$reqestUrl[1]."'";?>>
					<?php else:?>
						<form role="form" method="post" <?php echo "action='".$home.$reqestUrl[0]."index.php".$reqestUrl[1]."'";?>>
					<?php endif?>
						<div class="form-group fadeIn third">
							<input name="email" type="text" class="form-control border-secondary"  placeholder="Wpisz adres email">
						</div>
						<div class="form-group fadeIn fourth">
							<input name="password" type="password" class="form-control border-secondary"  placeholder="Wpisz hasło">
						</div>
						<div class="custom-control custom-checkbox fadeIn fifth">
							<input type="checkbox" class="custom-control-input" id="remember" value="remember" name="remember">
							<label class="custom-control-label" for="remember">Zapamiętaj</label>
						</div>
						<div class="form-group fadeIn sixth">
							<span><?php echo $loginError ?></span>
						</div>
							<button name="login_user" type="submit" class="btn btn-outline-secondary form-rounded btn-block fadeIn fifth"><span class="glyphicon glyphicon-off"></span> Login</button>
					</form>
				</div>
					<div class="modal-footer fadeIn sixth">
						<p><a class="underlineHover custom-close pointer" data-toggle="modal" data-target="#rejestracja" data-dismiss="#logowanie">Zarejestruj się</a></p> <p>|</p>
						<p><a href="#" class="underlineHover">Przypomnij hasło</a></p>
					</div>
				<?php else:?>
					<div class="modal-header fadeIn second" style="padding:35px 50px;">
						<h4><i class="fas fa-user "></i>  Logowanie</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body" style="padding:40px 50px;">
						<div class="form-group fadeIn third">
								<span><?php echo $loginError ?></span>
						</div>
					</div>
				<?php endif;?>
			</div>
		</div>
	</div> 
</div>
<!-- MODAL REJSESTRACJA -->
<div class="container">
	<?php /*if user open login modal*/if(isset($_POST['reg_user'])):?>
		<div class="modal fadeInDown first openModal" id="rejestracja" role="dialog">
	<?php else: ?>
		<div class="modal fadeInDown first" id="rejestracja" role="dialog">
	<?php endif ?>
	
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header fadeIn second" style="padding:35px 50px;">
					<h4><i class="fas fa-user "></i>  Rejestracja</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body" style="padding:40px 50px;">
					<?php /*crete form action, depending on url*/ if(strpos($reqestUrl[0],"index.php")):?>
						<form role="form" method="post" <?php echo "action='".$home.$reqestUrl[0].$reqestUrl[1]."'";?>>
					<?php else:?>
						<form role="form" method="post" <?php echo "action='".$home.$reqestUrl[0]."index.php".$reqestUrl[1]."'";?>>
					<?php endif?>
						<div class="form-group fadeIn third">
							<input name="email" type="text" class="form-control border-secondary"  placeholder="Wpisz adres email">
						</div>
						<div class="form-group fadeIn fourth">
							<input name="password" type="password" class="form-control border-secondary"  placeholder="Wpisz hasło">
						</div>
						<div class="form-group fadeIn fourth">
							<input name="passwordR" type="password" class="form-control border-secondary"  placeholder="Powtórz hasło">
						</div>
						<select name="gender" class="fadeIn fifth custom-select py-2" id="selectCenter">
							<option> Wybierz </option>
							<option value="kobiety"> Kobieta </option>
							<option value="mezczyzni"> Mężczyzna </option>
							<option value="na"> Nie chcę podawać </option>
						</select>
						<div class="form-group fadeIn sixth">
							<span><?php echo $registerError ?></span>
						</div>
							<button type="submit" name="reg_user" class="btn btn-outline-secondary form-rounded btn-block fadeIn fifth mt-5">
							<span class="glyphicon glyphicon-off"></span> 
							Zarejestruj</button>
					</form>
				</div>
					<div class="modal-footer fadeIn sixth">
					</div>
			</div>
		</div>
	</div> 
</div>
<!-- HEADER -->
<header>
	<div class="container-fluid">
		<div class="row py-2">
		   <div class="col-md-3 col-12 text-center">
			<a <?php echo "href='".$home."'"; ?>><img <?php echo "src='".$home."/elements/logo.png'"; ?>  alt="" class="img-fluid"></a>
		   </div>
		   <div class="col-md-7 col-8 text-center pt-3 ">
				<span class="form-inline p-0 my-lg-0 pl-5 padding">
				  <input id="query" onchange="search()" class="form-control border-secondary form-rounded form-width" type="search" placeholder="Wyszukaj..." aria-label="Search">
				  <button id="search" class="btn btn-outline-secondary ml-1 form-rounded"><i class="fas fa-search"></i></button>
				</span>
		   </div>
			<div class="col-md-2 col-4 pt-3">
				<?php if(!isset($_SESSION['user'])):?>
				   <button class="btn btn-outline-secondary form-rounded"  aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#logowanie"> Zaloguj </button> 
				<?php else: ?>
					<button class="dropdown btn btn-outline-secondary profile rounded" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c3.032 0 5.5 2.467 5.5 5.5 0 1.458-.483 3.196-3.248 5.59 4.111 1.961 6.602 5.253 7.482 8.909h-19.486c.955-4.188 4.005-7.399 7.519-8.889-1.601-1.287-3.267-3.323-3.267-5.61 0-3.033 2.468-5.5 5.5-5.5zm0-2c-4.142 0-7.5 3.357-7.5 7.5 0 2.012.797 3.834 2.086 5.182-5.03 3.009-6.586 8.501-6.586 11.318h24c0-2.791-1.657-8.28-6.59-11.314 1.292-1.348 2.09-3.172 2.09-5.186 0-4.143-3.358-7.5-7.5-7.5z"/></svg>
					</button>
					<div class="dropdown-menu" style="z-index: 1030 !important;" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" <?php echo "href='".$home."/order'"; ?>>Przejdź do zamówień</a>
						<a class="dropdown-item" <?php echo "href='".$home."/basket'"; ?>>Koszyk</a>
						<?php if(strpos($reqestUrl[0],"index.php")):?>
							<form role="form" method="post" <?php echo "action='".$home.$reqestUrl[0].$reqestUrl[1]."'";?>>
						<?php else:?>
							<form role="form" method="post" <?php echo "action='".$home.$reqestUrl[0]."index.php".$reqestUrl[1]."'";?>>
						<?php endif?>
						<button class="dropdown-item" name="logout" <?php echo "href='".$home.$reqestUrl[0]."index.php".$reqestUrl[1]."'";?>>Wyloguj się</button>
						</form>
					  </div>	
				<?php endif ?>
			</div>
		  </div>
	  </div>
	  </header>

<header class="sticky-top">
  <div class="container-fluid p-0 border mb-4 ">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active px-4 underlineHover">
				<a class="nav-link" <?php echo "href='".$home."'"; ?>><h5 class="text-center">Home</h5> </a>
				</li>
				<li class="nav-item dropdown active px-4 underlineHover">
				<a class="nav-link " data-toggle="dropdown" <?php echo "href='".$home."/filter/?gender=kobiety'"; ?>><h5 class="text-center">Kobiety</h5></a>
				<div class="dropdown-menu">
					<?php
						foreach ($clothesK->getTypeList() as $type){
							echo "<a href='$home/filter/?gender=kobiety&type=$type' class='dropdown-item'>$type</a>";
						}						
					?>
				</div>
				</li>
				<li class="nav-item active dropdown px-4 underlineHover">
					<a class="nav-link " data-toggle="dropdown"<?php echo "href='".$home."/filter/?gender=mezczyzni'"; ?>><h5 class="text-center">Mężczyzni</h5> </a>
					<div class="dropdown-menu">
					<?php
						foreach ($clothesM->getTypeList() as $type){
							echo "<a href='$home/filter/?gender=mezczyzni&type=$type' class='dropdown-item'>$type</a>";
						}						
					?>
				</div>
				</li>
				<li class="nav-item active px-4 underlineHover">
					<a class="nav-link" href="#"><h5 class="text-center">Kontakt</h5></a>
				</li>
				<li class="nav-item active px-4 underlineHover">
					<a class="nav-link" href="#"><h5 class="text-center">O nas</h5></a>
				</li>
			</ul>
		</div>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ">
				<li class="nav-item active px-4 text-center">
					<a class="color-black" <?php echo "href='".$home."/basket'"; ?>><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
				</li>
			</ul>
		</div>
		  
		</div>
	  </nav>
</div>
</header>