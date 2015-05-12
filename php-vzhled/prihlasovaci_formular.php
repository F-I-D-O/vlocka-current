
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
	<?php	
		if(isset($_SESSION["ID"])){?>			
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
	<?php 
		}
		
		else{?>	
			<form action="php/login.php" method="post">
				<table>
					<tr>
						<td><label for="login">login</label>&nbsp;
							<input type="text" name="login" id="login" maxlength="20" style="width: 100px">
						</td>
						<td></td>
					</tr>
					<tr>
						<td><label for="heslo">heslo</label> 
							<input type="password" name="heslo" id="heslo" maxlength="20" style="width: 100px">
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
			<?php }	
	 	}
	?>
	
</div>
