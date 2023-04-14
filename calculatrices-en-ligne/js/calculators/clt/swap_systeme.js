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
	//mesure_hidden_txt	= document.getElementsByName('systeme');
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

			if(mesure_hidden=="imp" && unite == 'm'){

				if( lang == 'fr' ) {
					unite	= 'pieds';
				} else {
					unite	= 'feet';
				}

			}else if( ( mesure_hidden=="met" && unite == 'pieds' ) || ( mesure_hidden=="met" && unite == 'feet' ) ){
				unite	= 'm';
			}

			if(mesure_hidden=="imp"){

				if( lang == 'fr' ) {
					if(unite == 'm'){
						unite	= 'pieds';
					}else if(unite == 'kPa'){
						unite = 'lb/pi<sup>2</sup>';
					}
				} else {
					if(unite == 'm'){
						unite	= 'feet';
					}else if(unite == 'kPa'){
						unite = 'lb/pi<sup>2</sup>';
					}
				}

			}else if(mesure_hidden=="met"){

				if( lang == 'fr' ) {
					if(unite == 'pieds'){
						unite	= 'm';
					}else if(unite.substr(0,5) == 'lb/pi'){
						unite = 'kPa';
					}
				} else {
					if(unite == 'feet'){
						unite	= 'm';
					}else if(unite.substr(0,5) == 'lb/pi'){
						unite = 'kPa';
					}
				}
			}

			mesure_unite[b].innerHTML = unite;
		}
	}
	return true;
}

function resetValues(){
	if (!document.getElementsByClassName){
		var mesure_valeurs	= getElementsByClassName('mesure_valeur');
	}else{
		var mesure_valeurs	= document.getElementsByClassName('mesure_valeur');
	}
	for(var a=0; a<mesure_valeurs.length; a++){
		mesure_valeurs[a].value = '';
	}
}


function changeSysteme(){
	convert();
	resetValues();
}