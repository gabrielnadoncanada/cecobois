<?PHP

	//nom des variables textuelles

	define ('ERROR_TYPE_POUTRELLE_VIDE', __d( 'cecobois', 'Vous devez sélectionner un type de poutrelle.' ) );

	define ('ERROR_PORTEE_NOMBRE', __d( 'cecobois', 'La portée entrée n\'est pas un nombre.' ) );
	define ('ERROR_PORTEE_BIGGER', __d( 'cecobois', 'La portée entrée est trop grande. Le maximum autorisé est de 14,6 m (47.9\').' ) );
	define ('ERROR_PORTEE_SMALLER', __d( 'cecobois', 'La portée entrée est trop petite. Le minimum autorisé est de 1m (3.281\').' ) );

	define ('ERROR_SURCHARGE_NOMBRE', __d( 'cecobois', 'La surcharge entrée n\'est pas un nombre.' ) );
	define ('ERROR_SURCHARGE_BIGGER', __d( 'cecobois', 'La surcharge entrée est trop grande. Le maximum autorisé est de 10 kPa (208.85 lb/pi<sup>2</sup>).' ) );
	define ('ERROR_SURCHARGE_SMALLER', __d( 'cecobois', 'La surcharge entrée est trop petite. Le minimum autorisé est de 0 kPa (0 lb/pi<sup>2</sup>).' ) );

	define ('ERROR_MORTE_NOMBRE', __d( 'cecobois', 'La charge permanente entrée n\'est pas un nombre.' ) );
	define ('ERROR_MORTE_BIGGER', __d( 'cecobois', 'La charge permanente entrée est trop grande. Le maximum autorisé est de 10kPa (208.85 lb/pi<sup>2</sup>).' ) );
	define ('ERROR_MORTE_SMALLER', __d( 'cecobois', 'La charge permanente entrée est trop petite. Le minimum autorisé est de 0,5kPa (10.45 lb/pi<sup>2</sup>).' ) );

	//nom des champs
	$html_champs=array(
		'systeme',
		'type_poutrelle',
		'portee',
		'espacement',
		'hauteur',
		'surcharge',
		'PL',
		'morte',
		'cat_risque',
		'fleche_surcharge',
		'fleche_charge_totale',
		'type_revetement',
		'epaisseur_revetement',
		'attache_revetement',
		'plafond_gypse',
		'rangee_blocages',
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
			$_SESSION[ 'calculator' ][$html_champs[$a]] = $post->$html_champs[$a];
		}

	//si on veut imprimer ou bien qu'on arrive sur la page d'accueil
	}else if($post->action=="print" || $post->action==""){
		//on reprend les parametres de la session si ils existe. ()pour eviter de devoir les rerentrer)
		for($a=0; $a<count($html_champs)-1; $a++){
			if(isset($_SESSION[ 'calculator' ][$html_champs[$a]])){
				$post->$html_champs[$a] = $_SESSION[ 'calculator' ][$html_champs[$a]];
			}
		}
		//on remet la session a zero apres cela.
		if($post->action==""){
			$_SESSION[ 'calculator' ]=array();
		}
	}



	// VARIABLES MENU RADIO SYSTEME
	$html_systeme=array(
		__d( 'cecobois', 'Impérial' ),
		__d( 'cecobois', 'Métrique' )
	);

	// VALEURS ASSOCCIES
	$html_systeme_value=array(
		'imp',
		'met'
	);

	// VARIABLES MENU RADIO TYPE POUTRELLE
	$html_type_poutrelle=array(
		__d( 'cecobois', 'Plancher' ),
		__d( 'cecobois', 'Toit plat' )
	);

	// VALEURS ASSOCCIES
	$html_type_poutrelle_value=array(
		'plancher',
		'toit'
	);

	// VARIABLES MENU SELECT ESPACEMENT
	if($post->systeme == "imp"){

		$html_espacement=array(
			'12&quot;',
			'16&quot;',
			'19&quot;',
			'24&quot;'
		);
	}else{

		$html_espacement=array(
			'305 mm',
			'406 mm',
			'487 mm',
			'610 mm'
		);
	}

	// VALEURS ASSOCCIES
	$html_espacement_value=array(
		305,
		406,
		487,
		610
	);

	// VARIABLES MENU SELECT HAUTEUR
	if($post->systeme == "imp"){
		$html_hauteur=array(
			'9.5&quot;',
			'11.875&quot;',
			'14&quot;',
			'16&quot;',
			'18&quot;',
			'20&quot;',
			'22&quot;',
			'24&quot;'
		);


	}else{

		$html_hauteur=array(
			'241 mm',
			'302 mm',
			'356 mm',
			'406 mm',
			'457 mm',
			'508 mm',
			'559 mm',
			'610 mm'
		);
	}

	// VALEURS ASSOCCIES
	$html_hauteur_value=array(
		241,
		302,
		356,
		406,
		457,
		508,
		559,
		610
	);

	// VARIABLES MENU SELECT CHARGE PL
	$html_charge_pl=array(
		__d( 'cecobois', 'Aucune' ),
		__d( 'cecobois', 'Toit (1,3 kN)' ),
		__d( 'cecobois', 'Classes (4,5 kN)' ),
		__d( 'cecobois', 'Bureaux (9,0 kN)' )
	);

	// VALEURS ASSOCCIES
	$html_charge_pl_value=array(
		0,
		1.3,
		4.5,
		9
	);

	// VARIABLES MENU SELECT CATGORIE DE RISQUE
	$html_cat_risque=array(
		__d( 'cecobois', 'Faible' ),
		__d( 'cecobois', 'Normale' ),
		__d( 'cecobois', 'Élevée' ),
		__d( 'cecobois', 'Protection civile' )
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
		'L/480',
		'L/960'
	);

	// VALEURS ASSOCCIES
	$html_fleche_surcharge_value=array(
		'180',
		'240',
		'360',
		'480',
		'960'
	);

	// VARIABLES MENU SELECT FLECHE SOUS LA CHARGE TOTALE
	$html_fleche_charge_totale=array(
		'L/180',
		'L/240',
		'L/360',
		'L/480',
		'L/960'
	);

	// VALEURS ASSOCCIES
	$html_fleche_charge_totale_value=array(
		'180',
		'240',
		'360',
		'480',
		'960'
	);

	// VARIABLES MENU RADIO TYPE REVETEMENT
	$html_type_revetement=array(
		__d( 'cecobois', 'OSB' ),
		__d( 'cecobois', 'Contreplaqué' )
	);

	// VALEURS ASSOCCIES
	$html_type_revetement_value=array(
		'osb',
		'contreplaque'
	);

	// VARIABLES MENU RADIO EPAISSEUR REVETEMENT
	if($post->systeme == "imp"){

		$html_epaisseur_revetement=array(
			'5/8',
			'3/4'
		);

	}else{

		$html_epaisseur_revetement=array(
			'16',
			'19'
		);
	}

	// VALEURS ASSOCCIES
	$html_epaisseur_revetement_value=array(
		16,
		19
	);

	// VARIABLES MENU RADIO ATTACHE REVETEMENT
	$html_attache_revetement=array(
		__d( 'cecobois', 'Cloué' ),
		__d( 'cecobois', 'Cloué et collé' )
	);

	// VALEURS ASSOCCIES
	$html_attache_revetement_value=array(
		'cloue',
		'cloue_colle'
	);

	// VARIABLES MENU RADIO PLAFOND GYPSE
	if($post->systeme == "imp"){

		$html_plafond_gypse=array(
			'Aucun',
			'1/2',
			'5/8'
		);

	}else{

		$html_plafond_gypse=array(
			'Aucun',
			'12.7',
			'15.9'
		);
	}

	// VALEURS ASSOCCIES
	$html_plafond_gypse_value=array(
		'aucun',
		'12.7',
		'15.9'
	);

	// VARIABLES MENU RADIO RANGEE BLOCAGE TRANSVERSAUX
	$html_rangee_blocages=array(
		__d( 'cecobois', 'Non' ),
		__d( 'cecobois', 'Mi-portée' )
	);

	// VALEURS ASSOCCIES
	$html_rangee_blocages_value=array(
		'non',
		'mi_portee'
	);



	// HTML (STYLE ET JS)
	//*******************
	$html_systeme_js 				= ' onclick="changeSysteme(0,\'\');"';
	$html_type_poutrelle_js 		= '';
	$html_portee_js					= '';
	$html_espacement_js				= '';
	$html_hauteur_js				= '';
	$html_surcharge_js				= '';
	$html_charge_pl_js				= '';
	$html_morte_js					= '';
	$html_cat_risque_js				= '';
	$html_fleche_surcharge_js		= '';
	$html_charge_totale_js			= '';
	$html_type_revetement_js		= '';
	$html_epaisseur_revetement_js	= '';
	$html_attache_revetement_js		= '';
	$html_plafond_gypse_js			= '';
	$html_rangee_blocages_js		= '';

	if($post->action=="send"){
		$html_systeme_js 				= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_type_poutrelle_js 		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_portee_js					= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_espacement_js				= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_hauteur_js				= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_surcharge_js				= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_charge_pl_js				= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_morte_js					= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_cat_risque_js				= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_fleche_surcharge_js		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_charge_totale_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_type_revetement_js		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_epaisseur_revetement_js	= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_attache_revetement_js		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_plafond_gypse_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_rangee_blocages_js		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
	}

	//par defaut si post nest pas dfini
	$post->systeme				= $post->systeme != ''				?	$post->systeme						: 'met';
	$post->type_poutrelle		= $post->type_poutrelle != '' 		? 	$post->type_poutrelle				: 'plancher';
	$post->espacement			= $post->espacement != '' 			? 	$post->espacement 					: 406;
	$post->hauteur				= $post->hauteur != '' 				? 	$post->hauteur 						: 302;
	$post->PL					= $post->PL != '' 					? 	$post->PL							: 0;
	$post->cat_risque			= $post->cat_risque != '' 			? 	$post->cat_risque 					: 'normale';
	$post->fleche_surcharge		= $post->fleche_surcharge != ''		? 	$post->fleche_surcharge 			: 480;
	$post->fleche_charge_totale	= $post->fleche_charge_totale != ''	? 	$post->fleche_charge_totale 		: 240;
	$post->type_revetement		= $post->type_revetement != ''		?	$post->type_revetement				: 'osb';
	$post->epaisseur_revetement	= $post->epaisseur_revetement != ''	? 	$post->epaisseur_revetement			: 16;
	$post->attache_revetement	= $post->attache_revetement != ''	?	$post->attache_revetement			: 'cloue';
	$post->plafond_gypse		= $post->plafond_gypse != ''		? 	$post->plafond_gypse				: 'aucun';
	$post->rangee_blocages		= $post->rangee_blocages != ''		?	$post->rangee_blocages				: 'non';

	//Afficher ou cacher le débugage
	$show_debug=false;


?>