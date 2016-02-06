<!DOCTYPE html>
<html lang="cz">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>28. oddíl Vločka</title>

	<link href="{{ Tools::link('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<!--<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>-->
	
	<!--react-->
<!--	<script type="text/javascript" src="{{ Tools::link('/js/react/react.js') }}"></script>
	<script type="text/javascript" src="{{ Tools::link('/js/react/react-dom.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.min.js"></script>-->
	
	<!--tinymce-->
	<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
	
	<!--jquery-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	
	<!--handlebars js templates-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.min.js"></script>
	
	<!--main script-->
	<script type="text/javascript" src="{{ Tools::link('/js/common.js') }}"></script>
	
	<meta name="application" 
          content="vlocka" 
          data-csrf-token="{{ csrf_token() }}"
          data-root-url="{{ Tools::link('/') }}"
		  data-role="{{ Tools::getRole() }}"/>

	@yield('head')
</head>
<body>
	<div class="container">
		<div id="zahlavi">
			<a href="{{ Tools::url('/') }}">
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
						href="{{ Tools::url('/') }}">DOMŮ</a></div>

				<div>
					<a style="width: 82px" href='{{ Tools::url('/prijimame_cleny.php') }}'>PŘIDEJ SE</a>
				</div>
				<div>
					<a style="width: 62px" href='{{ Tools::url('/o_nas.php') }}'>O NÁS</a>
				</div>
				<div>
					<a style="width: 82px" href='{{ Tools::url('/skauting.php') }}'>SKAUTING</a>
				</div>
				<div>
					<a style="width: 82px" href='{{ Tools::url('/kontakt.php') }}'>KONTAKT</a>
				</div>
				<div>
					<a 	style="	width: 110px;
								border-top-right-radius: 5px;
								border-bottom-right-radius: 5px;" 
						href='{{ Tools::url('/fotokronika.php') }}'>FOTO &amp; VIDEO</a>
				</div>
			</div>

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
					<p style=" font-size: 20px; margin: 0px">{{ Auth::user()->nick }}</p>
						<?php
							switch (Auth::user()->role){
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
					<form role="form" action="{{ Tools::url('/auth/logout') }}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="submit" value="odhlásit">
					</form>
					</div>
					<div style="float: right; position: relative; top: -23px">
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
								<input type="checkbox" name="remember"> Zapamatuj si mě
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
		<div class="row">
			<div id="vlevo" class="col-md-3">
				<div class="odkazy">
					<h2>Hlavní menu</h2>
						<ul>
							<li>
								<a href="{{ Tools::url('/plan.php') }}">PLÁN AKCÍ</a>
							</li>
							<li>
								<a href="{{ Tools::url('/TB_maly.php') }}">
								TB VLČATA A SVĚTLUŠKY</a>
							</li>
							<li>
								<a href="{{ Tools::url('/TB_velky.php') }}">
								TB SKAUTI A SKAUTKY</a>
							</li>
							<li>
								<a href="{{ Tools::url('/vybaveni.php') }}">VYBAVENÍ NA AKCE</a>
							</li>
							<li>
								<a href="{{ Tools::url('/kronika.php') }}">KRONIKA</a>
							</li>
							<li>
								<a href="{{ Tools::url('/dokumenty.php') }}">DOKUMENTY</a>
							</li>
							<li>
								<a href="{{ Tools::url('/odkazy.php') }}">ODKAZY</a>
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
	</div>
	
	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	
	<div id="templates">
		@yield('templates')
	</div>
</body>
</html>
