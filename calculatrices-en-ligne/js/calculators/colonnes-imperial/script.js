aff_select_type_bois=function(sel,nom_sel,nom_sel2,nom_sel3, nom_sel4, nom_sel5){
	doc1 = document.getElementById(nom_sel);
	doc2 = document.getElementById(nom_sel2);
	doc3 = document.getElementById(nom_sel3);
	doc4 = document.getElementById(nom_sel4);
	doc5 = document.getElementById(nom_sel5);
	if(sel.value =='bois_sciage'){
		//aff_select_attache_bois_sciage(document.getElementById('attaches_bois_sciage'));
		doc1.style.display = "block";
		doc2.style.display = "none";
		doc3.style.display = "none";
		doc4.style.display = "none";
		doc5.style.display = "none";

	}else if(sel.value == 'bois_scl'){	
		aff_select_profondeur_scl(document.getElementById('largeur_bois_scl'));
		//aff_select_attache_bois_scl(document.getElementById('attaches_bois_scl_box'));
		doc1.style.display = "none";
		doc2.style.display = "block";
		doc3.style.display = "none";
		doc4.style.display = "none";
		doc5.style.display = "none";

	}else if(sel.value == 'bois_blc'){
		//console.log(document.getElementById('largeur_bois_blc').selected);
		aff_select_profondeur_blc(document.getElementById('largeur_bois_blc'));
		doc1.style.display = "none";
		doc2.style.display = "none";
		doc3.style.display = "block";
		doc4.style.display = "none";
		doc5.style.display = "none";
	}else if(sel.value == 'bois_blc_nordic'){
		//console.log(document.getElementById('largeur_bois_blc').selected);
		aff_select_profondeur_blc_nordic(document.getElementById('largeur_bois_blc_nordic'));
		doc1.style.display = "none";
		doc2.style.display = "none";
		doc3.style.display = "none";		
		doc4.style.display = "block";
		doc5.style.display = "none";
	}
	else if(sel.value == 'bois_massif'){
		//console.log(document.getElementById('largeur_bois_massif').selected);
		aff_select_essence_bois_massif(document.getElementById('essence_bois_massif'));
		doc1.style.display = "none";
		doc2.style.display = "none";
		doc3.style.display = "none";		
		doc4.style.display = "none";
		doc5.style.display = "block";
	}
	/*
	doc1.options.selectedIndex = 0;
	doc2.options.selectedIndex = 0;
	doc3.options.selectedIndex = 0;
	*/
}

aff_select_bois_sciage=function(sel,nom_sel,nom_sel2,nom_sel3,nom_sel4){
	doc1 = document.getElementById(nom_sel);
	doc2 = document.getElementById(nom_sel2);
	doc3 = document.getElementById(nom_sel3);
	doc4 = document.getElementById(nom_sel4);

	if(sel.value =='msr1950'){
		doc1.style.display = "none";
		doc2.style.display = "none";
		doc3.style.display = "block";
		doc4.style.display = "none";

	}else if(sel.value =='msr2400'){
		doc1.style.display = "none";
		doc2.style.display = "none";
		doc3.style.display = "none";
		doc4.style.display = "block";

	}else if(sel.value.substr(0,3) == 'msr' ){	
		doc1.style.display = "none";
		doc2.style.display = "block";
		doc3.style.display = "none";
		doc4.style.display = "none";

	}else{
		doc1.style.display = "block";
		doc2.style.display = "none";
		doc3.style.display = "none";
		doc4.style.display = "none";
	}
	doc1.options.selectedIndex = 0;
	doc2.options.selectedIndex = 0;
	doc3.options.selectedIndex = 0;
	doc4.options.selectedIndex = 0;
}


aff_select_profondeur_scl=function(sel){
	doc45	=	document.getElementById('profondeur45_bois_scl');	
	doc89	=	document.getElementById('profondeur89_bois_scl');	
	doc134	=	document.getElementById('profondeur134_bois_scl');	
	doc178	=	document.getElementById('profondeur178_bois_scl');
	plis	=	document.getElementById('plis_bois_scl_box');
	attache	=	document.getElementById('attache_bois_scl_box');
	
	var tab_docId=Array(doc45,doc89,doc134,doc178,plis,attache);
	ResetDisplayNone(tab_docId);
	
	switch(sel.value){
		case '45':
			doc45.style.display		= "block";
			plis.style.display		= "";
			attache.style.display	= "";
			break;
		case '89':
			doc89.style.display = "block";
			break;	
		case '134':
			doc134.style.display = "block";
			break;
		case '178':
			doc178.style.display = "block";
			break;
	}
	
}

aff_select_profondeur_blc=function(sel){
	doc80	=  document.getElementById('profondeur80_bois_blc');	
	doc105	=  document.getElementById('profondeur105_bois_blc');	
	doc130	=  document.getElementById('profondeur130_bois_blc');	
	doc175	=  document.getElementById('profondeur175_bois_blc');	
	doc215	=  document.getElementById('profondeur215_bois_blc');	
	doc225	=  document.getElementById('profondeur225_bois_blc');	
	doc265	=  document.getElementById('profondeur265_bois_blc');	
	doc275	=  document.getElementById('profondeur275_bois_blc');	
	doc315	=  document.getElementById('profondeur315_bois_blc');	
	doc365	=  document.getElementById('profondeur365_bois_blc');	
	doc415	=  document.getElementById('profondeur415_bois_blc');
	doc465	=  document.getElementById('profondeur465_bois_blc');	
	doc515	=  document.getElementById('profondeur515_bois_blc');
	var tab_docId=Array(doc80,doc105,doc130,doc175,doc215,doc225,doc265,doc275,doc315,doc365,doc415,doc465,doc515);
	ResetDisplayNone(tab_docId);
	
	switch(sel.value){
		case '80':
			doc80.style.display	= "block";
			break;
		case '105':
			doc105.style.display = "block";
			break;	
		case '130':
			doc130.style.display = "block";
			break;
		case '175':
			doc175.style.display = "block";
			break;
		case '215':
			doc215.style.display = "block";
			break;
		case '225':
			doc225.style.display = "block";
			break;	
		case '265':
			doc265.style.display = "block";
			break;
		case '275':
			doc275.style.display = "block";
			break;
		case '315':
			doc315.style.display = "block";
			break;
		case '365':
			doc365.style.display = "block";
			break;
		case '415':
			doc415.style.display = "block";
			break;
		case '465':
			doc465.style.display = "block";
			break;
		case '515':
			doc515.style.display = "block";
			break;
	}	
}

aff_select_profondeur_blc_nordic=function(sel){
	doc86	=  document.getElementById('profondeur86_bois_blc_nordic');	
	doc137	=  document.getElementById('profondeur137_bois_blc_nordic');	
	doc184	=  document.getElementById('profondeur184_bois_blc_nordic');	
	doc228	=  document.getElementById('profondeur228_bois_blc_nordic');	
	doc279	=  document.getElementById('profondeur279_bois_blc_nordic');	
	doc327	=  document.getElementById('profondeur327_bois_blc_nordic');	

	var tab_docId=Array(doc86,doc137,doc184,doc228,doc279,doc327);
	ResetDisplayNone(tab_docId);
	
	switch(sel.value){
		case '86':
			doc86.style.display	= "block";
			break;
		case '137':
			doc137.style.display = "block";
			break;	
		case '184':
			doc184.style.display = "block";
			break;
		case '228':
			doc228.style.display = "block";
			break;
		case '279':
			doc279.style.display = "block";
			break;
		case '327':
			doc327.style.display = "block";
			break;	
	}	
}

ResetDisplayNone=function(tab_docId){
	for(var a=0; a<tab_docId.length;a++){
		tab_docId[a].style.display = "none";
	}
}

aff_select_attache_bois_sciage=function(sel){
	
	var tr_attache_bois_sciage = document.getElementById('attache_bois_sciage_box');
	tr_attache_bois_sciage.style.display="";
	
	for(var a=0;a<sel.options.length;a++){
		if(sel.options[a].selected && sel.options[a].value==1){
			tr_attache_bois_sciage.style.display="none";
		}
	}
}

aff_select_attache_bois_scl=function(sel){
	
	var tr_attache_bois_scl = document.getElementById('attache_bois_scl_box');
	tr_attache_bois_scl.style.display="";
	
	for(var a=0;a<sel.options.length;a++){
		if(sel.options[a].selected && sel.options[a].value==1){
			tr_attache_bois_scl.style.display="none";
		}
	}
}
	
aff_select_essence_bois_massif=function(sel){
	large1	=  document.getElementById('largeur1_bois_massif');	
	large2	=  document.getElementById('largeur2_bois_massif');
	switch(sel.value){
		case 'D-M':
		case 'P-S':
			large1.style.display = "block";
			large2.style.display = "none";
			aff_select_profondeur_bois_massif(large1,1);
			break;	
		case 'E-P-S':
		case 'Nordique':
			large1.style.display = "none";
			large2.style.display = "block";
			aff_select_profondeur_bois_massif(large2,2);
			break;
	}	
}

aff_select_profondeur_bois_massif=function(sel,type){
	doc140	=  document.getElementById('profondeur140_bois_massif');	
	doc191	=  document.getElementById('profondeur191_bois_massif');	
	doc241	=  document.getElementById('profondeur241_bois_massif');	
	doc292	=  document.getElementById('profondeur292_bois_massif');
	doc140_2	=  document.getElementById('profondeur140_2_bois_massif');	
	doc191_2	=  document.getElementById('profondeur191_2_bois_massif');	
	doc241_2	=  document.getElementById('profondeur241_2_bois_massif');

	var tab_docId=Array(doc140,doc191,doc241,doc292,doc140_2,doc191_2,doc241_2);
	ResetDisplayNone(tab_docId);
	
	if(type == 1){
		switch(sel.value){
			case '140':
				doc140.style.display = "block";
				break;	
			case '191':
				doc191.style.display = "block";
				break;
			case '241':
				doc241.style.display = "block";
				break;
			case '292':
				doc292.style.display = "block";
				break;	
		}
	}
	else{
		switch(sel.value){
			case '140':
				doc140_2.style.display = "block";
				break;	
			case '191':
				doc191_2.style.display = "block";
				break;
			case '241':
				doc241_2.style.display = "block";
				break;
		}

	}
}
	

	



