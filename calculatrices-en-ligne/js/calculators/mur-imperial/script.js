aff_select=function(sel,names){
	selected = sel.selectedIndex;
	nb_type = sel.options.length;
	nb_names = names.length;
	docs = [];

	for(i=0;i<nb_type;i++){
		suffix = i==0?'':(i+1);
		docs[i] = [];

		document.getElementById('profondeur8').style.display = 'none';

		for(j=0;j<nb_names;j++){
			if(names[j] == 'profondeur4' && suffix == '2'){
				var id = 'profondeur8';
			} else{
				var id = names[j] + suffix;
			}

			docs[i][j] = document.getElementById(id);

 			if(i==selected){
				docs[i][j].style.display = "block";
			}
			else{
				docs[i][j].style.display = "none";
			}

			docs[i][j].options.selectedIndex = 0;
		}
	}
}

