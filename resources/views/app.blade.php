<!DOCTYPE html>
<html lang="cz">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link href="{{ Tools::link('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div id="hlavni">
		<div id="zahlavi">
			<a href="http://vlocka.skauting.cz">
				<img 	src="http://vlocka.skauting.cz/obrazky/vzhled/vlocka_pozadi-werca-male.png"
						alt="Domů">
			</a>
		</div>
		<div id="horejsek" style=" background-color: #26316C; width: 734px; height: 265px; float: right; border-top-right-radius: 20px">
			<div id="hlavicka" style="	width: 704px; 
										height: 142px; 
										background-color: #26316C;
										border-top-right-radius: 20px; 
										margin: 0 0 0px 0;">
				<img 	src="http://vlocka.skauting.cz/obrazky/vzhled/nadpis-logo2012.png" 
						style="margin: 20px 0px 0px 70px "
						alt="Nadpis">	
			</div>
			<div id="menu">
				<div><a style="	width: 62px; 
								border-top-left-radius: 5px;
								border-bottom-left-radius: 5px;"
						href="<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/index.php") ?>">DOMŮ</a></div>

				<div>
					<a style="width: 82px" href='<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/prijimame_cleny.php") ?>'>PŘIDEJ SE</a>
				</div>
				<div>
					<a style="width: 62px" href='<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/o_nas.php") ?>'>O NÁS</a>
				</div>
				<div>
					<a style="width: 82px" href='<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/skauting.php") ?>'>SKAUTING</a>
				</div>
				<div>
					<a style="width: 82px" href='<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/kontakt.php") ?>'>KONTAKT</a>
				</div>
				<div>
					<a 	style="	width: 110px;
								border-top-right-radius: 5px;
								border-bottom-right-radius: 5px;" 
						href='<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/fotokronika.php") ?>'>FOTO &amp; VIDEO</a>
				</div>
			</div>
			
			<?php session_start() ?>

			<div id="prihlasovaci_formular" style="	float: right;
													width: 230px;
													height: 112px;
													margin: 4px 6px 0 0px; 
													border: 1px solid white; 
													border-radius: 5px; 
													padding: 5px;
													background-color: #F9BE3C;
			">
				@if(Auth::check())			
					<br>
					<div style="float: left">
					<p style=" font-size: 20px; margin: 0px"><?php echo($_SESSION["login"]) ?></p>
						<?php
							switch ($_SESSION["role"]){
								case 1:
									echo("<p style=\"font-size: 20px\">Admin</p>");
									break;
								case 2:
									echo("<p style=\"font-size: 20px\">Vedoucí</p>");
									break;
								default:
									echo("<p style=\" ont-size: 20px\">Člen oddílu</p>");
									break;
							}
						?>
					<form action="php/logout.php" method="post">
						<input type="submit" value="odhlásit">
					</form>
					</div>
					<div style="float: right; position: relative; top: -23px">
						<?php
						set_include_path($_SERVER["DOCUMENT_ROOT"]);
						?>
					</div>
				@else	
					<form role="form" action="{{ Tools::url('/auth/login') }}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<table>
							<tr>
								<td>
									<label for="login">login</label>&nbsp;
									<input type="text" name="nick" id="login" maxlength="20" style="width: 100px">
								</td>
								<td></td>
							</tr>
							<tr>
								<td>
									<label for="heslo">heslo</label> 
									<input type="password" name="password" id="heslo" maxlength="20" style="width: 100px">
								</td>
								<td><input type="submit" value="přihlásit"></td>
							</tr>
						</table>
					</form>

					<?php 
					if(array_key_exists("chyba_prihlaseni", $_GET)){?>
						<div class="error">
							<p><?php echo($_GET["chyba_prihlaseni"])?></p>
						</div>
					<?php } ?>
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
				@endif
			</div>
		
			<div id="uvod" style="	float: left;
									width: 470px;
									height: 82px;
									padding: 0 5px 5px 5px;
									margin: 0 0px 4px 0px;
									background: #F9BE3C;
									font-size: 13px;
									border: 1px solid white; 
									border-radius: 5px;
									box-sizing: content-box;
			">
				<p style="font: bold 16px Comic Sans MS; margin: 0">Vítejte na stránkách Vločky...</p>
				<p style="margin: 0">Jsme oddíl světlušek, vlčat, skautů, skautek a 
				R&amp;R, dohromady je nás okolo 100 VLOČEK - jsme taková malá lavina a klubovnu máme u Seneckého rybníka 
				(Plzeň - Bolevec). Oslavili jsme dvanácté narozeniny...</p>
			</div>
		</div>
		
		<div id="vlevo" style="	float: left;
								clear: both;
								width: 265px; 
								color: #251200;
								padding: 0 0 0 0;
								margin: 15px 0 0 0;
								background: #26316C;">

			<div class="odkazy">
				<h2>Hlavní menu</h2>
					<ul>
						<li>
							<a href="<?php echo('http://' . $_SERVER["SERVER_NAME"] . '/plan.php') ?>">PLÁN AKCÍ</a>
						</li>
						<li>
							<a href="<?php echo('http://' . $_SERVER["SERVER_NAME"] . '/TB_maly.php') ?>">
							TB VLČATA A SVĚTLUŠKY</a>
						</li>
						<li>
							<a href="<?php echo('http://' . $_SERVER["SERVER_NAME"] . '/TB_velky.php') ?>">
							TB SKAUTI A SKAUTKY</a>
						</li>
						<li>
							<a href="<?php echo('http://' . $_SERVER["SERVER_NAME"] . '/vybaveni.php') ?>">VYBAVENÍ NA AKCE</a>
						</li>
						<li>
							<a href="<?php echo('http://' . $_SERVER["SERVER_NAME"] . '/kronika.php') ?>">KRONIKA</a>
						</li>
						<li>
							<a href="<?php echo('http://' . $_SERVER["SERVER_NAME"] . '/dokumenty.php') ?>">DOKUMENTY</a>
						</li>
						<li>
							<a href="<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/odkazy.php") ?>">ODKAZY</a>
						</li>
					</ul>	
			 </div>
			<?php 
			if(isset($_SESSION["role"]) && $_SESSION["role"] < 3){?>
				<div class="odkazy">
					<h2>Úlohy správy</h2>
					<ul>
					<li><a href='<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/vlozit_akci.php") ?>'>PŘIDAT AKCI</a></li>
					<li><a href='<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/fotokronika.php?vlozit=1") ?>'>PŘIDAT GALERII</a></li>
						<?php 
						if($_SESSION["role"] < 2){
						?>
							<li><a href='<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/vlozit_uzivatele.php") ?>'>PŘIDAT UŽIVATELE</a></li>
							<li><a href='<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/vlozit_uzivatele.php?mod=1") ?>'>PŘIDAT PROFIL</a></li>
							<li><a href='<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/vlozit_uzivatele.php?mod=2") ?>'>PŘIDAT UŽIVATELE S PROFILEM</a></li>
						<?php
						}
						?>
					</ul>	
				</div>
			<?php 
			}
			?>
			<div class="odkazy">
			<h2>Klubovna</h2>
				<ul>
					<li><a target="_blank" href="http://www.mapy.cz/#x=130700224@y=134911488@z=15@mm=FP@ax=130700224@ay=134911488@at=Skautk%C3%A9%20klubovny%20%22Sene%C4%8D%C3%A1k%22@ad=Skautk%C3%A9%20klubovny%20%22Sene%C4%8D%C3%A1k%22@sa=s@st=s@ssq=seneck%C3%BD%20rybn%C3%ADk%20skauti" >KLUBOVNA NA MAPĚ</a></li>
					<li><a target="_blank" href="http://www.mapy.cz/#z=19&amp;c=h&amp;&amp;umc=9eE6fxWLLn&amp;uml=Skautk%C3%A9%20klubovny%20%22Sene%C4%8D%C3%A1k%22%20%E2%80%93%20Skautk%C3%A9%20klubovny%20%22Sene%C4%8D%C3%A1k%22&amp;q=seneck%C3%BD%20rybn%C3%ADk%20skauti&amp;x=13.393757&amp;y=49.785098&amp;p=-1" >LETECKÝ SNÍMEK KLUBOVNY</a></li>
					<li><a target="_blank" href="http://senecak.skauting.cz/uvod.html" >UBYTOVÁNÍ</a></li>
				</ul>
			</div>
		</div>
		
		@yield('content')
	</div>
<!--	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Laravel</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Home</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>-->

	
	
	<div id="spodek" style="clear: both;
							width: 950px;
							height: 50px;
							margin: 5px;
							padding: 20px;
							background: #FF8800;
							border-top-right-radius: 10px;
							border-top-left-radius: 10px;
							border-bottom-right-radius: 20px;
							border-bottom-left-radius: 20px">

		<img src="http://toplist.cz/count.asp?id=371167" alt="TOPlist" width="0">
		<IMG 	SRC="http://toplist.cz/count.asp?logo=mc&amp;ID=371167" 
				width="88" height="60" alt="počítadlo návštěvnosti">
		<a href="http://www.pomocnetlapky.cz">
			<img	src="obrazky/nejlepsi-pritel.gif" alt="pomocné tlapky">
		</a>
		<img 	style="float: right" 
				src="http://vlocka.skauting.cz/obrazky/ikony/valid-html401.gif" 
				alt="HTML 4.01 Valid">
	</div>

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
