function checkRadio(radio){
	var value = '';
	for(var a=0; a<radio.length; a++){
		if(radio[a].checked){
			value = radio[a].value;
		}	
	}
	return value;
}

function is_numeric (mixed_var) {
    return (typeof(mixed_var) === 'number' || typeof(mixed_var) === 'string') && mixed_var !== '' && !isNaN(mixed_var);
}

function trim (str, charlist) {

    var whitespace, l = 0, i = 0;
    str += '';
    
    if (!charlist) {
        whitespace = " \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000";
    } else {
        charlist += '';
        whitespace = charlist.replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '\$1');
    }
    
    l = str.length;
    for (i = 0; i < l; i++) {
        if (whitespace.indexOf(str.charAt(i)) === -1) {
            str = str.substring(i);
            break;
        }
    }
    
    l = str.length;
    for (i = l - 1; i >= 0; i--) {
        if (whitespace.indexOf(str.charAt(i)) === -1) {
            str = str.substring(0, i + 1);
            break;
        }
    }
    
    return whitespace.indexOf(str.charAt(0)) === -1 ? str : '';
}



function verif_syntaxe(mesure){
	
	for(var a=0; a<mesure.length; a++){
		//on change l'affichage des unités et des valeurs
		mesure_valeur	= mesure[a].getElementsByClassName('mesure_valeur');
		
		for(var b=0; b<mesure_valeur.length; b++){
			
			var val	= mesure_valeur[b].value;
			val		= val.replace(',','.');
			
			//si le champ est vide
			if(trim(val)==""){
				return '';
			//si ce n'est pas un nombre
			}else if(!is_numeric(val)){
				return "Veuillez remplir les données à convertir correctement.";
			}
		}
	}
	return true;
}


function convert(mesure,mesure_hidden){
	
	for(var a=0; a<mesure.length; a++){
		
		//on change l'affichage des unités et des valeurs
		mesure_unite	= mesure[a].getElementsByClassName('mesure_unite');
		mesure_valeur	= mesure[a].getElementsByClassName('mesure_valeur');
		
		for(var b=0; b<mesure_unite.length; b++){
			
			unite	= mesure_unite[b].innerHTML;
			valeur	= mesure_valeur[b].value;
			
			valeur	= valeur.replace(',','.');
			
			if(mesure_hidden=="imp"){
				
				if(unite == 'm'){
					valeur	= ConvertMetreToPieds(valeur);
					unite	= 'pieds';
				}else if(unite == 'mm'){
					valeur	= ConvertMillimetreToPouces(valeur);
					unite	= 'pouces';
				}
				
			}else if(mesure_hidden=="met"){
				
				if(unite == 'pieds'){
					valeur	= ConvertPiedsToMetre(valeur);
					unite	= 'm';
				}else if(unite == 'pouces'){
					valeur	= ConvertPoucesToMillimetre(valeur);
					unite	= 'mm';
				}
			}
			
			valeur =  mathround(valeur);
			mesure_unite[b].innerHTML = unite;
			mesure_valeur[b].value = valeur;
		}
	}
	return true;
}

function mathround(valeur){
	valeur = Math.round(valeur*100)/100;
	return valeur;
}


function ConvertMillimetreToPouces(mm){
	pouces	= mm * 0.0393700787401575;
	return pouces;
}

function ConvertMetreToPieds(m){

	pieds	= m * 3.28083989501312;
	return pieds;
}

function ConvertPiedsToMetre(pieds){
	
	pouces	= ConvertPiedToPouce(pieds);
	metres	= pouces * 0.0254;
	return metres;
}

function ConvertPiedToPouce(pieds){
	
	//si il y a un 'ou un " 
	if(pieds.indexOf("'")+1 !="0" || pieds.indexOf('"')+1 !="0"){
		
		//si il n'a a pas de '
		if(pieds.indexOf("'")+1 != "0"){
			
			tab_pieds_pouces = pieds.split("'");
			pouces = Number(tab_pieds_pouces[0]*12)+Number(tab_pieds_pouces[1].replace('"',''));
			
			// ATTENTION a insérer les pouces fraction aussi ici
			
		}/*else{
			
			pouces = pieds.replace('"','');
			//si c'est une fraction (ex: 7/8)
			if(pieds.indexOf("/")+1 != "0"){
				tab_pouces = pouces.split("/");
				pouces = Number(tab_pouces[0])/Number(tab_pouces[1]);
			}
		}*/
	}else{
		pouces = pieds*12;	
	}

	return pouces;
}

function ConvertPoucesToMillimetre(pouces){
	mm 		= pouces * 25.4;
	return mm;
}

function display_error(msg){
	
	var msg_form	= document.getElementById('message_form');
	
	msg_form.style.display		= "block";
	msg_form.style.visibility	= "visible";
	msg_form.innerHTML			= msg;
	
}


function changeSysteme(){
	
	//on va chercher l'unité dans le champ caché
	var mesure_hidden	= document.getElementsByName('systeme');
	mesure_hidden		= checkRadio(mesure_hidden);
	
	//on va chercher tous les champs à modifier
	mesure	= document.getElementsByClassName('mesure');
	msg = verif_syntaxe(mesure);
	
	if(msg === true){
		convert(mesure,mesure_hidden);
	}else if(msg!=""){
		display_error();	
	}
	
	
	
	//on change le champ caché
	/*
	if(mesure_hidden=="met"){
		mesure_hidden = "imp";
	}else{
		mesure_hidden = "met";
	}
	document.getElementById('systeme_hidden').value = mesure_hidden;
	*/
}
