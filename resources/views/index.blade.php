@extends('app')

@section('content')
	<div class="novinky">				
		<h3>Novinky</h3>			
		<?php
		if(array_key_exists("chyba_novinka", $_GET)){?>

			<div class="error">
				<p> <?php echo($_GET["chyba_novinka"])?> </p>
			</div>
		<?php 
		}
		if(array_key_exists("uspech_novinka", $_GET)){?>	
				<div class="succes">
					<p> <?php echo($_GET["uspech_novinka"])?> </p>
				</div>
		<?php 
		}
		?>
		@if(Tools::loggedRole(2))
			<script type="text/javascript" src="script/tiny_mce/tiny_mce.js"></script>
			<script type="text/javascript" src="index/tiny_mce-config-index.js"></script>
			<?php
			if(array_key_exists("novinka", $_GET)){?>
				<form action="php/nova_novinka.php" method="post" style="margin: 10px">
				<table>
					<tr>
						<td style="width: 200px"><label for="nadpis">Nadpis novinky:</label></td>
						<td><input type="text" name="nadpis" id="nadpis" maxlength="120" style="width: 300px"></td>
					</tr>
					<tr>
						<td><label for="text">Text novinky:</label></td>
					</tr>
				</table>
				<textarea name="text" id="novinka-textarea" class="mceEditor" maxlength="10000" style="width: 455px"></textarea>
				<?php
				if($_SESSION["role"] > 1){?>
					<input type="hidden" name="aktivni" id="aktivni" value="0">
				<?php	
				}
				else{?>
					<input type="hidden" name="aktivni" id="aktivni" value="1">
				<?php
				}
				?>
				<input type="submit" value="Vložit novinku do databáze">
				</form>

				<form action="index.php" method="post" style="margin: 10px">
				<input type="submit" value="Zpět">
				</form>

				<?php
				if(array_key_exists("chyba_novinka", $_GET)){?>

					<div class="error">
						<p> <?php echo($_GET["chyba_novinka"])?> </p>
					</div>
				<?php 
				}
				if(array_key_exists("uspech_novinka", $_GET)){?>	
						<div class="succes">
							<p> <?php echo($_GET["uspech_novinka"])?> </p>
						</div>
				<?php 
				}			
			}

			else{?>
				<form action="index.php?novinka=1" method="post" style="margin: 10px">
				<input type="submit" value="Přidat novou novinku">
				</form>
			<?php
			}
			?>
		@endif
			
		@if($posts)
			@foreach ($posts as $post)
				<div class="novinka">
					<p class="datum">{{--@datetime--}}($post->datum)</p>
					<p class="nadpis-novinka">{{$post->nadpis}}</p>
					{!!$post->text!!}
					@if(Tools::loggedRole(2))
						<p class="upravy-novinka">
							<a href="php/novinka-upravy.php?smaz={$post->id}">smaž novinku</a>
							@if($post->aktivni)
								<a href="php/novinka-upravy.php?deaktivace={$post->id}">deaktivuj novinku</a>
							@else
								<a href="php/novinka-upravy.php?aktivace={$post->id}">aktivuj novinku</a>
							@endif
						</p>
					@endif
				</div>
			@endforeach			
		@endif

		<div id="archiv_novinek">
			<?php 
			$datm_ted = new DateTime();
			$datum_arch = new DateTime($datm_ted->format("Y-m"));
			while($datum_arch > new DateTime("2011-09-01 00:00:00")){					
				$archiv = $datum_arch->format("Y-m-d");
				$datum_arch->modify("-1 month");

				echo("<a href=\"index.php?archiv=" . $archiv . "\">" . " " . Tools::czechMonth($datum_arch->format("m")) . " " . 
				$datum_arch->format("Y") . "</a> ");

				if($datum_arch->format("Y-m") != "2011-09"){
					echo("|");
				}				
			}				
			?>
		</div>
		<br>
	</div>

	<div id="vpravo">		
		<!-- Oblast důležitých zpráv -->		
		<?php //require "php-vzhled/dulezite.php";?>
		<br>	
		<!--<a href="<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/pohadkovy_les.php") ?>">
			<img src="obrazky/ikony/pohadkovyles2014.jpg" alt="Strašidelný les 2013">
		</a>-->
		<a href="<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/les.php") ?>">
			<img src="obrazky/ikony/les2015.PNG" alt="Strašidelný les 2015">
		</a>	
		<a href="<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/hroch.php") ?>">
			<img src="obrazky/ikony/hroch2015.PNG" alt="Odpoledne jako hroch 2015">
		</a>

<!--			<a href="<?php echo("http://plzentabor.skauting.cz/") ?>" target="_blank">
			<img src="obrazky/ikony/tabory.PNG" alt="Příměstské tábory 2015">
		</a>-->

		<a href="http://skolka.skauting.cz/" target="_blank">
			<img src="obrazky/ikony/medvidata.PNG" alt="Lesní školka Medvíďata">
		</a>
		<a href="http://www.rukodelkyusojky.cz/" target="_blank">
			<img src="obrazky/ikony/rukodelky.PNG" alt="Rukodělky u Sojky">
		</a>

		<a href="<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/prijimame_cleny.php") ?>">
			<img src="obrazky/ikony/ikona-nabor.png" alt="přijímáme členy">
		</a>	

		<div id="anketnik"  style="margin: 10px">
			<h2>Vzkazovník</h2>
			<!-- BLUEBOARD SHOUTBOARD -->
			<iframe style="border: 0px; width: 222px; height: 320px; overflow: hidden"   
					src="http://www.blueboard.cz/shoutboard.php?hid=cs9fkuk8dxdikj62p2r59cbffa263k">
						<a href="http://www.blueboard.cz/shoutboard.php?hid=cs9fkuk8dxdikj62p2r59cbffa263k">
						ShoutBoard od BlueBoard.cz</a>
			</iframe>
			<!-- BLUEBOARD SHOUTBOARD KONEC -->
		</div>
	</div>

@endsection

