<?PHP

	require_once("class/Conversion.php");
	
	// VARIABLES DE SORTIES
	//---------------------
				
		$html_champs_sortie=array(
			'drf'
		);
		
		//on associe les variables de $html_champs_sortie dans l'object output.
		for($a=0; $a<count($html_champs_sortie); $a++){
			$output->$html_champs_sortie[$a]='';
		}
		
	
	
	function verifCarac($champ){
	
		$tab_check_carac	= array(',','millimetre','millimètre','milimetre','milimètre','metre','mètre','pieds','pied','pouces','pouce','p','m','"','\'','%','\\');
		$tab_replace_carac	= array('.','','','','','','','','','','','','','','','','');
		
		$champ = str_replace($tab_check_carac,$tab_replace_carac,strtolower($champ));
		
		return $champ;
	}
	
	//VARIABLES FIXES
	//---------------
	
		//on regarde si on a bien choisi une variable pour type de poutrelle
		
		if($post->type_element==""){
			if(!isset($error)){
				$error = ERROR_TYPE_ELEMENT_VIDE;
			}
		}

		//------------------------------
		
		//on effectue des modifications sur la largeur ecrite a la main
	
		$post->largeur = verifCarac($post->largeur);
		
		//Si il y a un probleme avec cette variable, on stock un msg d'erreur
		if(!is_numeric($post->largeur)){
			if(!isset($error)){
				$error = ERROR_LARGEUR_NOMBRE;
			}
		}else{
			if($post->largeur < 0){
				$error = ERROR_LARGEUR_SMALLER;
			}
		}
		
		//------------------------------
		
		//on effectue des modifications sur la profondeur ecrite a la main
	
		$post->profondeur = verifCarac($post->profondeur);
		
		//Si il y a un probleme avec cette variable, on stock un msg d'erreur
		if(!is_numeric($post->profondeur)){
			if(!isset($error)){
				$error = ERROR_PROFONDEUR_NOMBRE;
			}
		}else{
			if($post->profondeur < 0){
				$error = ERROR_PROFONDEUR_SMALLER;
			}
		}
	
		//------------------------------
		
		//on effectue des modifications sur la portée ecrite a la main
	
		$post->portee = verifCarac($post->portee);
		
		//Si il y a un probleme avec cette variable, on stock un msg d'erreur
		if(!is_numeric($post->portee)){
			if(!isset($error)){
				$error = ERROR_PORTEE_NOMBRE;
			}
		}else{
			if($post->portee < 0){
				$error = ERROR_PORTEE_SMALLER;
			}
		}
		//------------------------------
		
		//on effectue des modifications sur le ratio de sollicitation ecrit a la main
	
		$post->sollicitation = verifCarac($post->sollicitation);
		
		//Si il y a un probleme avec cette variable, on stock un msg d'erreur
		if(!is_numeric($post->sollicitation)){
			if(!isset($error)){
				$error = ERROR_SOLLICITATION_NOMBRE;
			}
		}else{
			if($post->sollicitation > 100){
				$error = ERROR_SOLLICITATION_BIGGER;
			}else if($post->sollicitation < 0){
				$error = ERROR_SOLLICITATION_SMALLER;
			}
		}

		
		
//**********************************************************************

//**********************************************************************

	// VARIABLES A CALCULER
	//---------------------
	
	//si les donnes rentres sont bonnes
	//et QU'IL N'Y A PAS D'ERREUR 
	//on peut continuer le traitement.
	if(!isset($error)){
	
	
		//on modifie les données si l'utilisateur a choisit d'entrer les données en IMPÉRIAL
		if($post->systeme == "imp"){
						
			$largeur_tmp	= $post->largeur;
			$profondeur_tmp	= $post->profondeur;
			$portee_tmp		= $post->portee;

			$post->largeur 		= Conversion::ConvertPoucesToMillimetre($post->largeur);
			$post->profondeur	= Conversion::ConvertPoucesToMillimetre($post->profondeur);
			$post->portee		= Conversion::ConvertPiedsToMetre($post->portee);
			
		}
	
		//CALCUL
		//------
		
		//On prend la plus grande dimension hors de la largeur et la profondeur
		$D = max($post->largeur,$post->profondeur);
		
		//On prend la plus petite dimension hors de la largeur et la profondeur
		$B = min($post->largeur,$post->profondeur);
		
		if($post->portee == 0){
			$KL_B = 0;
		}else{
			$KL_B =($post->portee * $post->coef * 1000) / $B;
		}
		
		// on calcule f en fonction de KL_B, du ratio de sollicitaiton et du type d'élément
		
		if($post->type_element == 'poteau' && $KL_B < 12){
		
			$f=1.5;
			if($post->sollicitation >= 50){
				$f = 0.9 + (0.3 / ($post->sollicitation/100));
			}
			
		}else{
		
			$f = 1.3;
			if($post->sollicitation >= 50){
				$f = 0.7 + (0.3 / ($post->sollicitation/100));
			}	
			
		}
		
		// DRF en fonction du nombres de faces et du type d'élément
		$output->drf = 0;
		if($f!=0 && $B!=0 && $D!=0){
			if($post->type_element == 'poutre'){
			
				if($post->faces == '3'){
					$output->drf = 0.1 * $f * $B * (4 - ($B/$D));
					
				}else /*if($post->face == '4')*/{
					$output->drf = 0.1 * $f * $B * (4 - (2 * ($B/$D)));
				}
				
			}else if($post->type_element == 'poteau'){
				
				if($post->faces == '3'){
					$output->drf = 0.1 * $f * $B * (3 - ($B/(2 * $D)));
					
				}else /*if($post->face == '4')*/{
					$output->drf = 0.1 * $f * $B * (3 - ($B/$D));
				}
			}
		}
		
		//on modifie les données si l'utilisateur a choisit d'entrer les données en IMPÉRIAL
		if($post->systeme == "imp"){

			$post->largeur 		= $largeur_tmp;
			$post->profondeur	= $profondeur_tmp;
			$post->portee		= $portee_tmp;
			
		}
	}
		
?>