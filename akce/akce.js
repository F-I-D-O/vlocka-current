
pridejObsluhu(document, "click", ulozit);

function ulozit(event){
	event = vratEvent(event);
	var tlacitko = vratTarget(event);
	var IDAkce = document.getElementById("akce-id").value;
	
	switch(tlacitko.id){
		case "ulozit_nazev":
			ulozNazev(IDAkce);			
			break;
		case "ulozit_datum_zacatku":
			ulozDatumZacatku(IDAkce);			
			break;
		case "ulozit_datum_konce":
			ulozDatumKonce(IDAkce);			
			break;
		case "ulozit_kategorie":
			ulozKategorie(IDAkce);			
			break;
		case "ulozit_vedouci":
			ulozVedouci(IDAkce);			
			break;
		case "ulozit_podrobnosti":
			ulozPodrobnosti(IDAkce);			
			break;
	}
}

function ulozNazev(IDAkce){
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4){
			var odpoved = JSON.parse(xhr.responseText);
			if(odpoved["status"] == "uspech"){
				var nazev = document.getElementById("nazev-text");
				posliMail("název", nazev.firstChild.nodeValue, odpoved["data"]);
				nazev.firstChild.nodeValue = odpoved["data"];
				vytvorZpravuAkce("succes", odpoved["text"]);
			}
			else{
				vytvorZpravuAkce("error", odpoved["text"]);
			}
		}
	};
	var novyNazev = document.getElementById("nazev-formularove_pole").value;
	var url = "akce/zmena_nazvu.php";
	url = pridejParametr(url, "id", IDAkce);
	url = pridejParametr(url, "novy_nazev", novyNazev);
	xhr.open("get", url, true);
	xhr.send(null);
	prohodViditelnost('zmen_nazev-formular', 'zmen_nazev-odkaz', 'inline');
}

function ulozDatumZacatku(IDAkce){
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4){
			var odpoved = JSON.parse(xhr.responseText);
			if(odpoved["status"] == "uspech"){
				var datum = document.getElementById("datum_zacatku");
				posliMail("datum_zacatku", datum.firstChild.nodeValue, odpoved["data"]);
				datum.firstChild.nodeValue = odpoved["data"];
				vytvorZpravuAkce("succes", odpoved["text"]);
			}
			else{
				vytvorZpravuAkce("error", odpoved["text"]);
			}
		}
	};
	var novyDen = document.getElementById("den_zacatku").value;
	var novyMesic = document.getElementById("mesic_zacatku").value;
	var novyRok = document.getElementById("rok_zacatku").value;

	var url = "akce/zmena_datumu_zacatku.php";
	url = pridejParametr(url, "id", IDAkce);
	url = pridejParametr(url, "den_zacatku", novyDen);
	url = pridejParametr(url, "mesic_zacatku", novyMesic);
	url = pridejParametr(url, "rok_zacatku", novyRok);
	xhr.open("get", url, true);
	xhr.send(null);
	prohodViditelnost('zmen_datum_zacatku-formular', 'zmen_datum_zacatku-odkaz', 'inline');
}

function ulozDatumKonce(IDAkce){
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4){
			var odpoved = JSON.parse(xhr.responseText);
			if(odpoved["status"] == "uspech"){
				var datum = document.getElementById("datum_konce");
				posliMail("datum_konce", datum.firstChild.nodeValue, odpoved["data"]);
				datum.firstChild.nodeValue = odpoved["data"];
				vytvorZpravuAkce("succes", odpoved["text"]);
			}
			else{
				vytvorZpravuAkce("error", odpoved["text"]);
			}
		}
	};
	var novyDen = document.getElementById("den_konce").value;
	var novyMesic = document.getElementById("mesic_konce").value;
	var novyRok = document.getElementById("rok_konce").value;

	var url = "akce/zmena_datumu_konce.php";
	url = pridejParametr(url, "id", IDAkce);
	url = pridejParametr(url, "den_konce", novyDen);
	url = pridejParametr(url, "mesic_konce", novyMesic);
	url = pridejParametr(url, "rok_konce", novyRok);
	xhr.open("get", url, true);
	xhr.send(null);
	prohodViditelnost('zmen_datum_konce-formular', 'zmen_datum_konce-odkaz', 'inline');
}

function ulozKategorie(IDAkce){
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4){
			var odpoved = JSON.parse(xhr.responseText);
			if(odpoved["status"] == "uspech"){
				var kategorie = document.getElementById("kategorie");
				var upresnujiciKategorie = document.getElementById("upresnujici_kategorie");
				posliMail("kategorie", kategorie.firstChild.nodeValue, odpoved["data"]["kategorie"]);
				posliMail("kategorie", upresnujiciKategorie.firstChild.nodeValue, odpoved["data"]["jina_kategorie"]);
				kategorie.firstChild.nodeValue = odpoved["data"]["kategorie"].replace(/,/g, ", ");
				upresnujiciKategorie.firstChild.nodeValue = "(" + odpoved["data"]["jina_kategorie"] + ")";
				vytvorZpravuAkce("succes", odpoved["text"]);
			}
			else{
				vytvorZpravuAkce("error", odpoved["text"]);
			}
		}
	};
	var url = "akce/zmena_kategorii.php";
	var parametry = pridejParametrPost("", "id", IDAkce);
	for(var i = 1; i < 9; i++){
		var kategorie = document.getElementById("kategorie" + i);
		if(kategorie.checked){
			parametry = pridejParametrPost(parametry, i, "on");
		}
	}
	var upresnujiciKategorie = document.getElementById("upresnujici_kategorie-okno").value;
	parametry = pridejParametrPost(parametry, "upresnujici_kategorie", upresnujiciKategorie);
	xhr.open("post", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.setRequestHeader("Content-length", parametry.length);
	xhr.setRequestHeader("Connection", "close");
	xhr.send(parametry);
	prohodViditelnost('zmen_kategorie-formular', 'zmen_kategorie-odkaz', 'inline');
}

function ulozVedouci(IDAkce){
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4){
			var odpoved = JSON.parse(xhr.responseText);
			if(odpoved["status"] == "uspech"){
				var vedouci = document.getElementById("vedouci-text");
				var vypis_uzivatelu = "";
				var prvni = true;
				for(var i = 0; i < 3; i++){
					if(odpoved["data"][i] != ""){
						if(prvni){
							vypis_uzivatelu += odpoved["data"][i];
							prvni = false;
						}
						else{
							vypis_uzivatelu += ", " + odpoved["data"][i];
						}
					}
				}
				posliMail("vedouci", vedouci.firstChild.nodeValue, odpoved["data"]);
				vedouci.firstChild.nodeValue = vypis_uzivatelu;
				vytvorZpravuAkce("succes", odpoved["text"]);
			}
			else{
				vytvorZpravuAkce("error", odpoved["text"]);
			}
		}
	};
	var url = "akce/zmena_vedoucich.php";
	url = pridejParametr(url, "id", IDAkce);
	for(var i = 1; i < 3; i++){	
		var vedouci = document.getElementById("vedouci" + i);
		var vybrany = projdiSelect(vedouci);
		url = pridejParametr(url, "vedouci" + i, vybrany);
	}
	var vedouci3 = document.getElementById("vedouci" + i).value;
	url = pridejParametr(url, "vedouci3", vedouci3);
	xhr.open("get", url, true);
	xhr.send(null);
	prohodViditelnost('zmen_vedouci-formular', 'zmen_vedouci-odkaz', 'inline');
}

function ulozPodrobnosti(IDAkce){
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4){
			var odpoved = JSON.parse(xhr.responseText);
			if(odpoved["status"] == "uspech"){
				var podrobneInfoText = document.getElementById("podrobne_info-text");
				posliMail("info", podrobneInfoText.innerHTML, odpoved["data"]);
				podrobneInfoText.innerHTML = odpoved["data"];
				vytvorZpravuAkce("succes", odpoved["text"]);
			}
			else{
				vytvorZpravuAkce("error", odpoved["text"]);
			}
		}
	};
	var noveInfo = tinyMCE.get('podrobne_info-textarea').getContent();
	var url = "akce/zmena_podrobnosti.php";
	var parametry = "id=" + IDAkce + "&" + "nove_info=" + noveInfo;
	xhr.open("post", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.setRequestHeader("Content-length", parametry.length);
	xhr.setRequestHeader("Connection", "close");
	xhr.send(parametry);
	prohodViditelnost('zmen_podrobnosti-formular', 'zmen_podrobnosti-odkaz', 'inline');
}

function vytvorZpravuAkce(status, text){
	var obsah = document.getElementById("obsah");
	obsah.insertBefore(vytvorZpravu(status, text), obsah.firstChild);
}

function posliMail(udalost, staraHodnota, novaHodnota) {
	var xhr = new XMLHttpRequest();
	var url = "akce/akce-posli_mail.php";
	url = pridejParametr(url, "udalost", udalost);
	var nazevAkce = document.getElementById("nazev-text").firstChild.nodeValue;
	url = pridejParametr(url, "nazev", nazevAkce);
	url = pridejParametr(url, "staraHodnota", staraHodnota);
	url = pridejParametr(url, "novaHodnota", novaHodnota);
	xhr.open("get", url, true);
	xhr.send(null);
}


