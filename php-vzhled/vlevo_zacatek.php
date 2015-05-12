
<div id="vlevo" style="	float: left;
						clear: both;
  						width: 265px; 
  						color: #251200;
  						padding: 0 0 0 0;
  						margin: 15px 0 0 0;
						background: #26316C;">
			
  	<?php 
  	include("leve_menu.php");
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
  	
  	