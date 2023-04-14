function checkRadio(radio){
	var value = '';
	for(var a=0; a<radio.length; a++){
		if(radio[a].checked){
			value = radio[a].value;
		}	
	}
	return value;
}


function convert(mesure,mesure_hidden){
	
	for(var a=0; a<mesure.length; a++){
		
		//on change l'affichage des unités
		mesure_unite	= mesure[a].getElementsByClassName('mesure_unite');
		
		//pour chaques unités trouvées
		for(var b=0; b<mesure_unite.length; b++){
			
			unite	= mesure_unite[b].innerHTML;
			
			if(mesure_hidden=="imp"){
				
				if(unite == 'm'){
					unite	= 'pieds';
				}else if(unite == 'mm'){
					unite	= 'pouces';
				}
				
			}else if(mesure_hidden=="met"){
				
				if(unite == 'pieds'){
					unite	= 'm';
				}else if(unite == 'pouces'){
					unite	= 'mm';
				}
			}
			
			mesure_unite[b].innerHTML = unite;
		}
	}
	return true;
}


function changeSysteme(){
	
	//on va chercher l'unité dans le champ caché
	var mesure_hidden	= document.getElementsByName('systeme');
	mesure_hidden		= checkRadio(mesure_hidden);
	
	//on va chercher tous les champs à modifier
	mesure	= document.getElementsByClassName('mesure');
	
	convert(mesure,mesure_hidden);

}
