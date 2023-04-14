aff_select=function(sel,nom_sel,nom_sel2,nom_sel3,nom_sel4){
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