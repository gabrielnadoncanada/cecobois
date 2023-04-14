function getElementsByClassName(className, tag, elm){
	// une implémentation de la fonction
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

	//on va chercher l'unité dans le champ caché
	//var mesure_hidden	= document.getElementsByName('systeme');
	var mesure_hidden		= checkRadio(document.getElementsByName('systeme'));

	//on va chercher tous les champs à modifier
	if (!document.getElementsByClassName){
		var mesure	= getElementsByClassName('mesure');
	}else{
		var mesure	= document.getElementsByClassName('mesure');
	}


	for(var a=0; a<mesure.length; a++){

		//on change l'affichage des unités
		if (!document.getElementsByClassName){
			var mesure_unite	= getElementsByClassName('mesure_unite','',mesure[a]);
		}else{
			var mesure_unite	= mesure[a].getElementsByClassName('mesure_unite');
		}

		//pour chaques unités trouvées
		for(var b=0; b<mesure_unite.length; b++){

			unite	= mesure_unite[b].innerHTML;

			var lang = 'fr';

			if(mesure_hidden=="imp"){

				if( lang == 'fr' ) {

					if(unite == 'm'){
						unite	= 'pieds';
					}else if(unite == 'mm'){
						unite	= 'pouces';
					}else if(unite == 'kN'){
						unite = 'lb';
					}else if(unite == 'kN/m'){
						unite = 'lb/pi';
					}

				} else {

					if(unite == 'm'){
						unite	= 'feet';
					}else if(unite == 'mm'){
						unite	= 'inches';
					}else if(unite == 'kN'){
						unite = 'lb';
					}else if(unite == 'kN/m'){
						unite = 'lb/pi';
					}
				}

			}else if(mesure_hidden=="met"){

				if( lang == 'fr' ) {

					if(unite == 'pieds'){
						unite	= 'm';
					}else if(unite == 'pouces'){
						unite	= 'mm';
					}else if(unite == 'lb'){
						unite = 'kN';
					}else if(unite == 'lb/pi'){
						unite = 'kN/m';
					}

				} else {

					if(unite == 'feet'){
						unite	= 'm';
					}else if(unite == 'inches'){
						unite	= 'mm';
					}else if(unite == 'lb'){
						unite = 'kN';
					}else if(unite == 'lb/pi'){
						unite = 'kN/m';
					}
				}
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

	var tab_metrique	= new Array('45','80','89','105','114','130','134','140','152','175','178','184','190','215','225','228','235','241','265','266','275','286','302','304','315','342','365','380','415','418','456','465','494','515','532','570','608');
	var tab_imperial	= new Array('1 3/4"','3 1/8"','3 1/2"','4 1/8"','4 1/2"','5 1/8"','5 1/4"','5 1/2"','6"','6 7/8"','7"','7 1/4"','7 1/2"','8 1/2"','8 7/8"','9"','9 1/4"','9 1/2"','10 3/8"','10 1/2"','10 7/8"','11 1/4"','11 7/8"','12"','12 3/8"','13 1/2"','14 3/8"','15"','16 3/8"','16 1/2','18"','18 3/8"','19 1/2"','20 1/4"','21"','22 1/2"','24"');
	/*
	for(var a=0; a<tab_metrique.length; a++){
		console.log(tab_metrique[a] +" = "+tab_imperial[a]);
	}
	*/

	for(var a=0; a<mesure_valeurs.length; a++){


		if(mesure_valeurs[a].type == 'text'){
				mesure_valeurs[a].value = '';

		}else if(mesure_valeurs[a].type == 'select-one'){


			for(var b=0; b<mesure_valeurs[a].length; b++){
				var val = mesure_valeurs[a][b];
				var val_substr = val.value.substr(0,2);

				if(mesure_hidden == "imp"){
					if(val_substr == '2x'){
						for(var h=0; h<tab_imperial.length; h++){
							if(val.value == tab_imperial[h]){
								val.innerHTML = tab_imperial[h];
							}
						}
					}else{
						for(var h=0; h<tab_metrique.length; h++){
							if(val.value == tab_metrique[h]){
								val.innerHTML = tab_imperial[h];
							}
						}
					}

				}else{
					if(val_substr == '2x'){
						for(var h=0; h<tab_metrique.length; h++){
							if(val.value == tab_imperial[h]){
								val.innerHTML = tab_metrique[h];
							}
						}
					}else{
						val.innerHTML = val.value+" mm";
					}
				}
			}
		}else{
			var val = mesure_valeurs[a];
			var tab_metrique	= new Array('12.7','15.9','16','19');
			var tab_imperial	= new Array('1/2','5/8','5/8','3/4');

			for(var i=0; i<tab_metrique.length;i++){
				if(mesure_hidden == "imp"){
					if(val.innerHTML == tab_metrique[i]){
						val.innerHTML = tab_imperial[i];
					}
				}else{
					if(val.innerHTML == tab_imperial[i]){
						val.innerHTML = tab_metrique[i];
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