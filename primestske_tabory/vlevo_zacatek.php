
<div id="vlevo" style="	float: left;
						clear: both;
  						width: 265px; 
  						color: #251200;
  						padding: 0 0 0 0;
  						margin: 15px 0 0 0;
						background: #26316C;">
	
	<div class="odkazy">
	<h2>Příměstské tábory</h2>
		<ul>
			<li>
				<a href='<?php echo('http://' . $_SERVER["SERVER_NAME"] . '/primestske_tabory/index.php') ?>'>
				DOMŮ / PLAKÁT</a>
			</li>
			<li>
				<a href='<?php echo('http://' . $_SERVER["SERVER_NAME"] . '/primestske_tabory/prihlaska_a_kontakt.php') ?>'>
				PŘIHLÁŠKA A KONTAKT</a>
			</li>
			<li>
				<a href='<?php echo('http://' . $_SERVER["SERVER_NAME"] . '/primestske_tabory/volna_mista.php') ?>'>
				POČET VOLNÝCH MÍST</a>
			</li>
			<li>
				<a href='<?php echo('http://' . $_SERVER["SERVER_NAME"] . '/primestske_tabory/program.php') ?>'>
				INFORMACE A PROGRAM</a>
			</li>
			<li>
				<a href='<?php echo('http://' . $_SERVER["SERVER_NAME"] . '/primestske_tabory/sebou.php') ?>'>
				CO S SEBOU</a>
			</li>
			<li>
				<a href='<?php echo('http://' . $_SERVER["SERVER_NAME"] . '/primestske_tabory/podminky.php') ?>'>
				PODMÍNKY ÚČASTI</a>
			</li>
			<li>
				<a href='<?php echo('http://' . $_SERVER["SERVER_NAME"] . '/primestske_tabory/mapa.php') ?>'>
				MAPA</a>
			</li>
			<li>
				<a target="_blank" href='<?php echo('http://' . $_SERVER["SERVER_NAME"] . '/prijimame_cleny.php') ?>'>
				PŘÍJÍMÁME NOVÉ ČLENY DO ODDÍLU</a>
			</li>
			<li>
				<a href='<?php echo('http://' . $_SERVER["SERVER_NAME"] . '/primestske_tabory/fotokronika.php') ?>'>
				FOTKY Z PŘÍMĚSTSKÝCH TÁBORŮ</a>
			</li>
		</ul>
	</div>				
	<div class="odkazy">
	<h2>Hlavní menu</h2>
		<ul>
			<li>
				<a href="<?php echo('http://' . $_SERVER["SERVER_NAME"] . '/plan.php') ?>">PLÁN AKCÍ</a>
			</li>
			<li>
				<a href="<?php echo('http://' . $_SERVER["SERVER_NAME"] . '/bodovani_maly.php') ?>">
					BODOVÁNÍ VLČAT A SVĚTLUŠEK</a>
			</li>
			<li>
				<a href="<?php echo('http://' . $_SERVER["SERVER_NAME"] . $_SERVER["PHP_SELF"] . '') ?>">
				TB SKAUTI A SKAUTKY (v přípravě)</a>
			</li>
			<li>
				<a href="<?php echo('http://' . $_SERVER["SERVER_NAME"] . '/vybaveni.php') ?>">VYBAVENÍ NA AKCE</a>
			</li>
			<li>
				<a href="<?php echo('http://' . $_SERVER["SERVER_NAME"] . $_SERVER["PHP_SELF"] . '') ?>">
					DRUŽINY (v přípravě)</a>
			</li>
			<li>
				<a href="<?php echo('http://' . $_SERVER["SERVER_NAME"] . '/kronika.php') ?>">KRONIKA</a>
			</li>
			<li>
				<a href="<?php echo('http://' . $_SERVER["SERVER_NAME"] . '/dokumenty.php') ?>">DOKUMENTY</a>
			</li>
			<li>
				<a href="<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/profily.php") ?>">PROFILY</a>
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
				<?php 
				if($_SESSION["role"] < 2){
				?>
					<li>
						<a href='<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/vlozit_uzivatele.php") ?>'>
						PŘIDAT UŽIVATELE</a>
					</li>
					<li>
						<a href='<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/vlozit_uzivatele.php?mod=1") ?>'>
						PŘIDAT PROFIL</a>
					</li>
					<li>
						<a href='<?php echo("http://" . $_SERVER["SERVER_NAME"] . "/vlozit_uzivatele.php?mod=2") ?>'>
						PŘIDAT UŽIVATELE S PROFILEM</a>
					</li>
				<?php
				}
				?>
			</ul>	
  		</div>
  	<?php 
  	}
  	?>
  	
  	