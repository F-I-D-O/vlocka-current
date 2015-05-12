
/**
 * Přidá parametr do URL
 * @param url původní adresa
 * @param jmeno jméno parametru
 * @param hodnota hodnota parametru
 * @returns adresa s parametry
 */
function pridejParametr(url, jmeno, hodnota){
	url += (url.indexOf("?") == -1 ? "?" : "&");
	url += encodeURIComponent(jmeno) + "=" + encodeURIComponent(hodnota);
	return url;
}

function pridejParametrPost(parametry, jmeno, hodnota){
	parametry += (parametry == "" ? "" : "&");
	parametry += encodeURIComponent(jmeno) + "=" + encodeURIComponent(hodnota);
	return parametry;
}

/**
 * Zaměňuje viditelnost dvou elementů na stránce
 * @param id1 první element - ten který má zmizet
 * @param id2 druhý element - ten který se má objevit
 * @param display - způsob zobrazení druhého prvku (inline, block, inline-block..)
 */
function prohodViditelnost(id1, id2, display){
	var elem1 = document.getElementById(id1);
	var elem2 = document.getElementById(id2);
	elem1.setAttribute("style", "display: none");
	elem2.setAttribute("style", "display: " + display);
}

/**
 * Vygeneruje zprávu o výsledku uživatelské akce
 * @param status status značící jak akce dopadla (error, succes)
 * @param zprava podrobná zpráva
 * @returns {___div0} div pro vložení do stránky
 */
function vytvorZpravu(status, zprava){
	var div = document.createElement("div");
	div.className = status;
	var p = document.createElement("p");
	var text = document.createTextNode(zprava);
	p.appendChild(text);
	div.appendChild(p);
	return div;
}

function projdiSelect(seznam){
	var vybrane = "";
	for(var j = 0, delkaSeznamu = seznam.options.length; j < delkaSeznamu; j++){
		var moznost = seznam.options[j];
		if (moznost.selected){
			var hodnota;
			if(moznost.hasAttribute("value")){
				hodnota = moznost.value;
			}
			else{
				hodnota = moznost.text;
			}
			vybrane = hodnota;
			break;
		}
	}
	return vybrane;
}

function projdiMultipleSelect(seznam){
	var vybrane = [];
	for(j = 0, delkaSeznamu = seznam.options.lenght; j < delkaSeznamu; j++){
		var moznost = seznam.options[j];
		if (moznost.selected){
			var hodnota;
			if(moznost.hasAttribute(value)){
				hodnota = moznost.value;
			}
			else{
				hodnota = moznost.text;
			}
			vybrane.push(hodnota);
		}
	}
	return vybrane;
}

//funkce pro obsluhu událostí
function pridejObsluhu(element, typ, obsluha){
	if(element.addEventListener){
		element.addEventListener(typ, obsluha, false);
	}
	else if(element.attachEvent){
		element.attachEvent("on" + typ, obsluha);
	}
	else{
		element["on + type"] = obsluha;
	}
}

function odeberObsluhu(element, typ, obsluha){
	if(element.removeEventListener){
		element.removeEventListener(typ, obsluha, false);
	}
	else if(element.dettachEvent){
		element.dettachEvent("on" + typ, obsluha);
	}
	else{
		element["on + type"] = null;
	}
}

function vratEvent(event){
	if(event){
		return event;
	}
	else{
		return window.event;
	}
}

function vratTarget(event){
	if(event.target){
		return event.target;
	}
	else{
		return event.srcElement;
	}
}

