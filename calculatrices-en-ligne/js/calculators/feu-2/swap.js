function checkSelected(formselect){
	for(var a=0; a<formselect.options.length; a++){
		if(formselect.options[a].selected){
			return a;
		}
	}
}

//select remis a zero
function resetSelectedOptions(formFields){
	
	formFields = document.calcul[formFields];

	for(var i=1; i<formFields.options.length; i++){
		formFields.options[i].selected = false;
	}
	formFields.options[0].selected = true;
}

//radio remis a zero
function resetRadio(formFields){
	
	formFields = document.calcul[formFields];
	
	for (var a=0; a<formFields.length; a++){
		formFields[a].checked = false;
	}
}
//Cache les champs
function cacheFields(formFields){
	for(var a=0; a<formFields.length; a++){
		//console.log("tr_"+formFields[a]);
		document.getElementById("tr_"+formFields[a]).style.display="none";			
	}
}

//reset les champs 
//formFields Array
function resetFields(formFields){
	cacheFields(formFields);
	for(var a=0; a<formFields.length; a++){
		//si c'est un select
		if(document.calcul[formFields[a]].options){
			resetSelectedOptions(formFields[a]);
		//si c'est un radio
		}else{
			resetRadio(formFields[a]);	
		}
	}
}


// FCT TYPE CONSTRUCTION ONCLICK
//------------------------------
function fct_type_constr(type_constr){

	if(type_constr.value == "ossature"){
		
		resetFields(Array('syst_struc2','porteur','espacement1','paroi1','isolant1','espacement2','paroi2','isolant2','paroi3','paroi4','paroi5','elements1','elements2','dimensions1','dimensions2','dimensions3','dimensions4','paroi6','paroi7','paroi8','paroi9'));
		document.getElementById('tr_syst_struc1').style.display="block";
		
	}else if(type_constr.value == "bois"){
		
		resetFields(Array('syst_struc1','porteur','espacement1','paroi1','isolant1','espacement2','paroi2','isolant2','paroi3','paroi4','paroi5','elements1','elements2','dimensions1','dimensions2','dimensions3','dimensions4','paroi6','paroi7','paroi8','paroi9'));
		document.getElementById('tr_syst_struc2').style.display="block";
	}
}


// FONCTIONS
//-----------------------
function fct_syst_struc1(syst_struc1){
	
	if(syst_struc1.value == "mur"){
		
		resetFields(Array('espacement2','paroi2','isolant2','paroi3','paroi4','paroi5'));
		document.getElementById('tr_porteur').style.display="block";
		
	}else if(syst_struc1.value == "poutrelles"){
		
		resetFields(Array('porteur','espacement1','paroi1','isolant1','espacement2','paroi2','isolant2','paroi4','paroi5'));
		document.getElementById('tr_paroi3').style.display="block";
		
	}else if(syst_struc1.value == "fermes"){
		
		resetFields(Array('porteur','espacement1','paroi1','isolant1','espacement2','paroi2','isolant2','paroi3','paroi5'));
		document.getElementById('tr_paroi4').style.display="block";
		
	}else if(syst_struc1.value == "solives"){
		
		resetFields(Array('porteur','espacement1','paroi1','isolant1','espacement2','paroi2','isolant2','paroi3','paroi4'));
		document.getElementById('tr_paroi5').style.display="block";
		
	}else{
		resetFields(Array('porteur','espacement1','paroi1','isolant1','espacement2','paroi2','isolant2','paroi3','paroi4','paroi5'));
	}
}

function fct_porteur(porteur){
	
	if(porteur.value == "oui"){
		
		resetFields(Array('espacement2','paroi2','isolant2'));
		
		document.getElementById('tr_espacement1').style.display="block";
		document.getElementById('tr_paroi1').style.display="block";
		document.getElementById('tr_isolant1').style.display="block";
		
	}else if(porteur.value == "non"){
		
		resetFields(Array('espacement1','paroi1','isolant1'));
		
		document.getElementById('tr_espacement2').style.display="block";
		document.getElementById('tr_paroi2').style.display="block";

	}
}

function fct_paroi2(paroi2){
	
	if(paroi2.value == "12.7" || paroi2.value == "15.9"){
		document.getElementById('tr_isolant2').style.display="block";
	}else{
		resetFields(Array('isolant2'));
	}
}

function fct_syst_struc2(syst_struc2){
	
	if(syst_struc2.value == "mur"){
		
		resetFields(Array('elements2','dimensions1','dimensions2','dimensions3','dimensions4','paroi6','paroi7','paroi8','paroi9'));
		document.getElementById('tr_elements1').style.display="block";
		
	}else if(syst_struc2.value == "plancher"){
		
		resetFields(Array('elements1','dimensions1','dimensions2','dimensions3','dimensions4','paroi6','paroi7','paroi8','paroi9'));
		document.getElementById('tr_elements2').style.display="block";
		
	}else{
		resetFields(Array('elements1','elements2','dimensions1','dimensions2','dimensions3','dimensions4','paroi6','paroi7','paroi8','paroi9'));	
	}
}

function fct_elements1(elements1){
	
	if(elements1.value == "mvp"){
		
		resetFields(Array('dimensions2','paroi7'));	
		document.getElementById('tr_dimensions1').style.display="block";
		document.getElementById('tr_paroi6').style.display="block";
		
	}else if(elements1.value == "mhnp"){
		
		resetFields(Array('dimensions1','paroi6'));	
		document.getElementById('tr_dimensions2').style.display="block";
		document.getElementById('tr_paroi7').style.display="block";
		
	}else{
		resetFields(Array('dimensions1','dimensions2','paroi6','paroi7'));	
	}
}

function fct_elements2(elements2){
	
	if(elements2.value == "msc"){
		
		resetFields(Array('dimensions4','paroi9'));	
		document.getElementById('tr_dimensions3').style.display="block";
		document.getElementById('tr_paroi8').style.display="block";
		
	}else if(elements2.value == "prl"){
		
		resetFields(Array('dimensions3','paroi8'));	
		document.getElementById('tr_dimensions4').style.display="block";
		document.getElementById('tr_paroi9').style.display="block";
		
	}else{
		resetFields(Array('dimensions3','dimensions4','paroi8','paroi9'));	
	}
	
}