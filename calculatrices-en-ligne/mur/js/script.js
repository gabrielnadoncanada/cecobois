aff_select=function(sel,nom_sel,nom_sel2,nom_sel3){
	doc1 = document.getElementById(nom_sel);
	doc2 = document.getElementById(nom_sel2);
	doc3 = document.getElementById(nom_sel3);

	if(sel.value =='msr2400'){
		doc1.style.display = "none";
		doc2.style.display = "none";
		doc3.style.display = "block";

	}else if(sel.value.substr(0,3) == 'msr' ){	
		doc1.style.display = "none";
		doc2.style.display = "block";
		doc3.style.display = "none";

	}else{
		doc1.style.display = "block";
		doc2.style.display = "none";
		doc3.style.display = "none";
	}
	doc1.options.selectedIndex = 0;
	doc2.options.selectedIndex = 0;
	doc3.options.selectedIndex = 0;
}

	

	

	



