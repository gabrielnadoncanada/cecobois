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
					}else if(unite == 'kPa'){
						unite = 'lb/pi2';
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
					}else if(unite == 'kPa'){
						unite = 'lb/pi2';
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
					}else if(unite == 'lb/pi2'){
						unite = 'kPa';
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
					}else if(unite == 'lb/pi2'){
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

	var mesure_hidden		= checkRadio(document.getElementsByName('systeme'));

	if (!document.getElementsByClassName){
		var mesure_valeurs	= getElementsByClassName('mesure_valeur');
	}else{
		var mesure_valeurs	= document.getElementsByClassName('mesure_valeur');
	}

	console.log(mesure_valeurs);

	var tab_metrique	= new Array('38','44','45','64','80','86','89','105','114','130','134','137','140','152','175','178','184','190','191','215','225','228','235','241','242','265','266','275','286','292','302','304','305','315','318','342','343','356','365','380','394','406','415','418','445','456','457','465','476','488','494','495','508','515','532','546','559','570','597','608','610','646','648','684','699','722','749','760','798','803','836','854','874','905','912','950','956','988','1006','1026','1057','1064','1102','1108','1140','1159','1178','1210','1216','1254','1260','1292','1311','1330','1362','1368','1406','1413','1444','1464','1482','1514','1520','1558','1565','1596','1619','1634','1670','1672','1710','1721','1748','1772','1786','1822','1824','1862','1873','1900','1924','1938','1975','1976','2014','2026','2052','2076','2090','2127','2128','2178','2229','2280','2330','2384','2435');
	var tab_imperial	= new Array('1 1/2"','1 3/4"','1 3/4"','2 1/2"','3 1/8"','3 3/8"','3 1/2"','4 1/8"','4 1/2"','5 1/8"','5 1/4"','5 3/8"','5 1/2"','6"','6 7/8"','7"','7 1/4"','7 1/2"','7 1/2"','8 1/2"','8 7/8"','9"','9 1/4"','9 1/2"','9 1/2"','10 3/8"','10 1/2"','10 7/8"','11 1/4"','11 1/2"','11 7/8"','12"','12"','12 3/8"','12 1/2"','13 1/2"','13 1/2"','14"','14 3/8"','15"','15 1/2"','16"','16 3/8"','16 1/2"','17 1/2"','18"','18"','18 3/8"','18 3/4"','19 1/4"','19 1/2"','19 1/2"','20"','20 1/4"','21"','21 1/2"','22"','22 1/2"','23 1/2"','24"','24"','25 3/8"','25 1/2"','26 7/8"','27 1/2"','28 3/8"','29 1/2"','29 7/8"','31 3/8"','31 5/8"','32 7/8"','33 5/8"','34 3/8"','35 5/8"','35 7/8"','37 3/8"','37 5/8"','38 7/8"','39 5/8"','40 3/8"','41 5/8"','41 7/8"','43 3/8"','43 5/8"','44 7/8"','45 5/8"','46 3/8"','47 5/8"','47 7/8"','49 3/8"','49 5/8"','50 7/8"','51 5/8"','52 3/8"','53 5/8"','53 7/8"','55 3/8"','55 5/8"','56 7/8"','57 5/8"','58 3/8"','59 5/8"','59 7/8"','61 3/8"','61 5/8"','62 7/8"','63 3/4"','64 3/8"','65 3/4"','65 7/8"','67 3/8"','67 3/4"','68 7/8"','69 3/4"','70 3/8"','71 3/4"','71 3/4"','73 1/4"','73 3/4"','74 3/4"','75 3/4"','76 1/4"','77 3/4"','77 3/4"','79 1/4"','79 3/4"','80 3/4"','81 3/4"','82 1/4"','83 3/4"','83 3/4"','85 3/4"','87 3/4"','89 3/4"','91 3/4"','93 7/8"','95 7/8"');

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