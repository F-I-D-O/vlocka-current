@extends('app')

@section('head')
<script type="text/javascript" src="{{ Tools::link('/js/index.js') }}"></script>
@endsection

@section('content')
	<div class="col-md-6">				
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
		<div id="new-post-area" class="hidden">
			<form class="ajax-form" 
				  action="{{ Tools::url('/new-post') }}"
				  method="post" 
				  style="margin: 10px" 
				  data-success="addPostOnSuccess">
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
				<input type="submit" value="Vložit novinku do databáze">
			</form>
		</div>
		<button class="switch" 
				data-target="new-post-area" 
				data-on-text="Přidat novou novinku" 
				data-off-text="Zpět">
			Přidat novou novinku
		</button>
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
			
		@endif
			
		@if($posts)
			@foreach ($posts as $post)
				<div id="post{{$post->ID}}" class="novinka">
					<p class="datum">@datetime($post->created_at)</p>
					<p class="nadpis-novinka">{{$post->nadpis}}</p>
					{!!$post->text!!}
					@if(Tools::loggedRole(2))
						<p class="upravy-novinka">
							<button class="post-button" 
									data-url="{{ Tools::url("/post" ) }}/{{$post->ID}}"
									data-response-ok="onDeletePost"
									data-method="DELETE">
								smaž novinku
							</button>
							<button class="post-button deactivate-post-button{{@printif(!$post->aktivni, ' hidden')}}" 
								data-url="{{ Tools::url("/post" ) }}/{{$post->ID}}"
								data-response-ok="onDeactivatePost"
								data-method="PUT"
								data-data='{"aktivni": 0}'>
							deaktivuj novinku
							</button>
							<button class="post-button activate-post-button{{@printif($post->aktivni, ' hidden')}}" 
									data-url="{{ Tools::url("/post" ) }}/{{$post->ID}}"
									data-response-ok="onActivatePost"
									data-method="PUT"
									data-data='{"aktivni": 1}'>
								aktivuj novinku
							</button>
						</p>
					@endif
				</div>
			@endforeach			
		@endif

		<div id="archiv_novinek">
			<?php 
			$dateNow = new DateTime();
			$dateArch = new DateTime($dateNow->format("Y-m"));
			while($dateArch > new DateTime("2011-09-01 00:00:00")){					
				$archiv = $dateArch->format("Y-m-d");
				$dateArch->modify("-1 month");
				?>
				<a href="{{ Tools::url("/archiv" ) }}/{{$dateArch->format("Y")}}/{{$dateArch->format("m")}}">
					{{ Tools::czechMonth($dateArch->format("m"))}} {{$dateArch->format("Y")}}</a>
				<?php
				if($dateArch->format("Y-m") != "2011-09"){
					echo("|");
				}				
			}				
			?>
		</div>
		<br>
	</div>

	<div class="col-md-3">		
		<!-- Oblast důležitých zpráv -->		
		<?php //require "php-vzhled/dulezite.php";?>
		<br>	
		<!--<a href="<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/pohadkovy_les.php") ?>">
			<img src="obrazky/ikony/pohadkovyles2014.jpg" alt="Strašidelný les 2013">
		</a>-->
<!--		<a href="<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/les.php") ?>">
			<img src="obrazky/ikony/les2015.PNG" alt="Strašidelný les 2015">
		</a>	-->
<!--		<a href="<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/hroch.php") ?>">
			<img src="obrazky/ikony/hroch2015.PNG" alt="Odpoledne jako hroch 2015">
		</a>-->

<!--			<a href="<?php echo("http://plzentabor.skauting.cz/") ?>" target="_blank">
			<img src="obrazky/ikony/tabory.PNG" alt="Příměstské tábory 2015">
		</a>-->

		<a href="http://skolka.skauting.cz/" target="_blank">
			<img src="obrazky/ikony/medvidata.PNG" alt="Lesní školka Medvíďata">
		</a>
		<a href="http://www.rukodelkyusojky.cz/" target="_blank">
			<img src="obrazky/ikony/rukodelky.PNG" alt="Rukodělky u Sojky">
		</a>

		<a href="{{ Tools::url('/prijimame_cleny.php') }}">
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

@section('templates')
<script id="post-template" type="text/x-handlebars-template">
	<div class="entry">
	  <h1>@{{title}}</h1>
	  <div class="body">
		@{{body}}
	  </div>
	</div>
	<div class="novinka">
		<p class="datum">@{{post.datum}}</p>
		<p class="nadpis-novinka">@{{post.nadpis}}</p>
		{@{{post.text}}}
		@{{#if (loggedRole 2)}}
			<p class="upravy-novinka">
				<a href="php/novinka-upravy.php?smaz=@{{post.id}}">smaž novinku</a>
				@{{#if post.aktivni}}
					<a href="php/novinka-upravy.php?deaktivace=@{{post.id}}">deaktivuj novinku</a>
				@{{else}}
					<a href="php/novinka-upravy.php?aktivace=@{{post.id}}">aktivuj novinku</a>
				@{{/if}} 
			</p> 
		@{{/if}} 
	</div>
</script>
@endsection