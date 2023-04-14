<?PHP

	//nom des variables textuelles
	
	//define ('ERROR_TYPE_POUTRE_VIDE','Vous devez s&eacute;lectionn&eacute; un type de poutre.');
		
	//nom des champs
	$html_champs=array(
		'systeme',
		'hauteur',
		'largeur',
		'hauteur_mur',
		'colombages',
		'espacement',
		'revetement',
		'emplacement',
		'type',
		'cat_risque',
		'neige',
		'surcharge',
		'permanente',
		'excentricite',
		'vent',
		'fleche_surcharge',
		'fleche_charge_totale',
		'action'
	);
	
	global $post;
	//on associe les variables dans l'objet post
	for($a=0; $a<count($html_champs); $a++){
		$post->$html_champs[$a]='';
	}
	//pour chaques post, on insre sa valeur si elle existe.
	foreach($_POST as $key=>$value){
		$post->$key = $value;
	}
	
	//si on passe l'action en get, elle prime sur le post
	$post->action = isset($_GET['action'])?$_GET['action']:$post->action;

	//si on veut verifier les donnees ou afficher les resultats
	if($post->action=="verif" || $post->action=="send"){
		//on sauve tous les champs a l'exception de l'action dans la session
		for($a=0; $a<count($html_champs)-1; $a++){
			$_SESSION[$html_champs[$a]] = $post->$html_champs[$a];
		}
		
	//si on veut imprimer ou bien qu'on arrive sur la page d'accueil
	}else if($post->action=="print" || $post->action==""){
		//on reprend les parametres de la session si ils existe. ()pour eviter de devoir les rerentrer)
		for($a=0; $a<count($html_champs)-1; $a++){
			if(isset($_SESSION[$html_champs[$a]])){
				$post->$html_champs[$a] = $_SESSION[$html_champs[$a]];
			}
		}
		//on remet la session a zero apres cela.
		if($post->action==""){
			$_SESSION=array();
		}
	}

	

	// VARIABLES MENU RADIO SYSTEME
	$html_systeme=array(
		'Imp&eacute;rial',
		'M&eacute;trique'
	);
	
	// VALEURS ASSOCCIES
	$html_systeme_value=array(
		'imp',
		'met'
	);
	
	// VARIABLES MENU SELECT COLOMBAGES
	$html_colombages=array(
		'38x64',
		'38x89',
		'38x140',
		'38x184',
		'38x235',
		'38x286'
	);
	
	// VALEURS ASSOCCIES
	$html_colombages_value=array(
		'64',
		'89',
		'140',
		'184',
		'235',
		'286'
	);
	
	// VARIABLES MENU RADIO REVETEMENT STRUCTURAL
	$html_revetement=array(
		'Oui',
		'Non'
	);
	
	// VALEURS ASSOCCIES
	$html_revetement_value=array(
		'oui',
		'non'
	);
	
	// VARIABLES MENU RADIO EMPLACEMENT DU LINTEAU
	$html_emplacement=array(
		'Sous la sablière',
		"Au-dessus de l'ouverture"
	);
	
	// VALEURS ASSOCCIES
	$html_emplacement_value=array(
		'haut',
		'bas'
	);
	
	// VARIABLES MENU RADIO TYPE POUTRELLE
	$html_type=array(
		'Bois de sciage',
		'Bois composite SCL',
		'Lamell&eacute; coll&eacute; CSA',
	);
	
	// VALEURS ASSOCCIES
	$html_type_value=array(
		'bois_sciage',
		'bois_composite',
		'lamelle_colle'
	);
	
	// VARIABLES MENU SELECT CATGORIE DE RISQUE
	$html_cat_risque=array(
		'Faible',
		'Normale',
		'&Eacute;lev&eacute;e',
		'Protection civile'
	);
	
	// VALEURS ASSOCCIES
	$html_cat_risque_value=array(
		'faible',
		'normale',
		'elevee',
		'protection_civile'
	);
	
	
	// VARIABLES MENU SELECT FLECHE SOUS LA SURCHARGE
	$html_fleche_surcharge=array(
		'L/180',
		'L/240',
		'L/360',
		'L/480'
	);
	
	// VALEURS ASSOCCIES
	$html_fleche_surcharge_value=array(
		'180',
		'240',
		'360',
		'480'
	);
	
	// VARIABLES MENU SELECT FLECHE SOUS LA CHARGE TOTALE
	$html_fleche_charge_totale=array(
		'L/180',
		'L/240',
		'L/360',
		'L/480'
	);
	
	// VALEURS ASSOCCIES
	$html_fleche_charge_totale_value=array(
		'180',
		'240',
		'360',
		'480'
	);
	
	// VARIABLES MENU RADIO TYPE REVETEMENT
	



	// HTML (STYLE ET JS)
	//*******************
	$html_systeme_js 				= '';
	$html_hauteur_js 				= '';
	$html_largeur_js 				= '';
	$html_hauteur_mur_js 			= '';
	$html_colombages_js 			= '';
	$html_espacement_js 			= '';
	$html_revetement_js 			= '';
	$html_emplacement_js 			= '';
	$html_type_js 					= '';
	$html_cat_risque_js 			= '';
	$html_neige_js 					= '';
	$html_surcharge_js 				= '';
	$html_permanente_js 			= '';
	$html_excentricite_js 			= '';
	$html_vent_js 					= '';
	$html_fleche_surcharge_js 		= '';
	$html_fleche_charge_totale_js 	= '';
	
	
	
	if($post->action=="send"){
		$html_systeme_js 				= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_hauteur_js 				= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_largeur_js 				= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_hauteur_mur_js 			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_colombages_js 			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_espacement_js 			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_revetement_js 			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_emplacement_js 			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_type_js 					= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_cat_risque_js 			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_neige_js 					= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_surcharge_js 				= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_permanente_js 			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_excentricite_js 			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_vent_js 					= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_fleche_surcharge_js 		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_fleche_charge_totale_js 	= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
	}
	
	//par defaut si post nest pas défini
	$post->systeme				= $post->systeme != ''				?	$post->systeme						: 'met';
	$post->colombages			= $post->colombages != '' 			? 	$post->colombages					: '38x64';
	$post->revetement			= $post->revetement != '' 			? 	$post->revetement					: 'oui';
	$post->emplacement			= $post->emplacement != '' 			? 	$post->emplacement 					: 'haut';
	$post->type					= $post->type != '' 				? 	$post->type							: 'bois_sciage';
	$post->cat_risque			= $post->cat_risque != '' 			? 	$post->cat_risque 					: 'normale';
	$post->fleche_surcharge		= $post->fleche_surcharge != ''		? 	$post->fleche_surcharge 			: 480;
	$post->fleche_charge_totale	= $post->fleche_charge_totale != ''	? 	$post->fleche_charge_totale 		: 240;
	
	
	//Afficher ou cacher le dbugage
	$show_debug=true;

?>