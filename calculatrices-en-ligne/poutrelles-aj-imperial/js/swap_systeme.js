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
			
			if(mesure_hidden=="imp"){
				
				if(unite == 'm'){
					unite	= 'pieds';
				}else if(unite == 'mm'){
					unite	= 'pouces';
				}else if(unite == 'kPa'){
					unite = 'lb/pi<sup>2</sup>';	
				}
				
			}else if(mesure_hidden=="met"){
				
				if(unite == 'pieds'){
					unite	= 'm';
				}else if(unite == 'pouces'){
					unite	= 'mm';
				}else if(unite.substr(0,5) == 'lb/pi'){
					unite = 'kPa';	
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
	
	for(var a=0; a<mesure_valeurs.length; a++){
		
		if(mesure_valeurs[a].type == 'text'){
				mesure_valeurs[a].value = '';
			
		}else if(mesure_valeurs[a].type == 'select-one'){
			
			var tab_metrique	= new Array('241','302','305','318','356','406','457','487','508','559','610');
			var tab_imperial	= new Array('9.5"','11.875"','12"','12.5"','14"','16"','18"','19"','20"','22"','24"');
			

			
			for(var b=0; b<mesure_valeurs[a].length; b++){
				var val = mesure_valeurs[a][b];			
				
				if(mesure_hidden == "imp"){
					for(var h=0; h<tab_metrique.length; h++){
						if(val.value == tab_metrique[h]){
							val.innerHTML = tab_imperial[h];
						}
					}
					
				}else{
					val.innerHTML = val.value+" mm";
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