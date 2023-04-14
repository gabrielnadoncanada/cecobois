function getElementsByClassName(className, tag, elm){
	// une implmentation de la fonction
	var testClass = new RegExp("(^|\\s)" + className + "(\\s|$)");
	var tag = tag || "*";
	var elm = elm || document;
	var elements = (tag == "*" && elm.all)? elm.all : elm.getElementsByTagName(tag);
	var returnElements = [];
	var current;
	var length = elements.length;
	for(var i=0; i<length; i++){
		current = elements[i];
		if(testClass.test(current.className)){
			returnElements.push(current);
		}
	}
	return returnElements;
}

function checkRadio(radio){
	var value = '';
	for(var a=0; a<radio.length; a++){
		if(radio[a].checked){
			value = radio[a].value;
		}
	}
	return value;
}

function convert(){
	var lang = document.documentElement.lang;

	//on va chercher l'unit dans le champ cach
	//var mesure_hidden	= document.getElementsByName('systeme');
	var mesure_hidden		= checkRadio(document.getElementsByName('systeme'));

	//on va chercher tous les champs  modifier
	if (!document.getElementsByClassName){
		var mesure	= getElementsByClassName('mesure');
	}else{
		var mesure	= document.getElementsByClassName('mesure');
	}


	for(var a=0; a<mesure.length; a++){

		//on change l'affichage des units
		if (!document.getElementsByClassName){
			var mesure_unite	= getElementsByClassName('mesure_unite','',mesure[a]);
		}else{
			var mesure_unite	= mesure[a].getElementsByClassName('mesure_unite');
		}

		//pour chaques units trouves
		for(var b=0; b<mesure_unite.length; b++){

			unite	= mesure_unite[b].innerHTML;

			if(mesure_hidden=="imp"){

				if( lang == 'fr' ) {

					if(unite == 'm'){
						unite	= 'pieds';
					}else if(unite == 'mm'){
						unite	= 'pouces';
					}else if(unite == 'kN/m'){
						unite = 'lb/pi';
					}else if(unite == 'kPa'){
						unite = 'lb/pi<sup>2</sup>';
					}

				} else {

					if(unite == 'm'){
						unite	= 'feet';
					}else if(unite == 'mm'){
						unite	= 'inches';
					}else if(unite == 'kN/m'){
						unite = 'lb/pi';
					}else if(unite == 'kPa'){
						unite = 'lb/pi<sup>2</sup>';
					}
				}

					$('.met').hide();
					$('.mesure_mur').hide();
					$('.imp').show();

			}else if(mesure_hidden=="met"){

				if( lang == 'fr' ) {

					if(unite == 'pieds'){
						unite	= 'm';
					}else if(unite == 'pouces'){
						unite	= 'mm';
					}else if(unite == 'lb/pi'){
						unite = 'kN/m';
					}else if(unite.substr(0,5) == 'lb/pi'){
						unite = 'kPa';
					}

				} else {

					if(unite == 'feet'){
						unite	= 'm';
					}else if(unite == 'inches'){
						unite	= 'mm';
					}else if(unite == 'lb/pi'){
						unite = 'kN/m';
					}else if(unite.substr(0,5) == 'lb/pi'){
						unite = 'kPa';
					}
				}

				$('.imp').hide();
				$('.mesure_mur').show();
				$('.met').show();
			}

			mesure_unite[b].innerHTML = unite;
		}
	}
	return true;
}

function resetValues(){

	var mesure_hidden		= checkRadio(document.getElementsByName('systeme'));

	if (!document.getElementsByClassName){
		var mesure_valeurs	= getElementsByClassName('mesure_valeur');
	}else{
		var mesure_valeurs	= document.getElementsByClassName('mesure_valeur');
	}

	for(var a=0; a<mesure_valeurs.length; a++){

		if(mesure_valeurs[a].type == 'text'){
				mesure_valeurs[a].value = '';

		}else if(mesure_valeurs[a].type == 'select-one'){
			var tab_metrique	= new Array('38','44');
			var tab_imperial	= new Array('1 &frac12;"','1 &frac34;"');

			for(var b=0; b<mesure_valeurs[a].length; b++){
				var val = mesure_valeurs[a][b];
				var val_substr = val.value.substr(0,2);

				if(mesure_hidden == "imp"){
					for(var h=0; h<tab_imperial.length; h++){
						if(val.value == tab_metrique[h]){
							val.innerHTML = tab_imperial[h];
						}
					}
				}else{
					for(var h=0; h<tab_metrique.length; h++){
						if(val.value == tab_metrique[h]){
							val.innerHTML = tab_metrique[h];
						}
					}

				}
			}
		}
	}
}

function changeSysteme(){
	convert();
	resetValues();
}