<?PHP

	//nom des variables textuelles

	define ('ERROR_TYPE_ELEMENT_VIDE', __d( 'cecobois', 'Vous devez sélectionner un type d\'élément.' ) );

	define ('ERROR_LARGEUR_NOMBRE', __d( 'cecobois', 'La largeur entrée n\'est pas un nombre.' ) );
	define ('ERROR_LARGEUR_SMALLER', __d( 'cecobois', 'La largeur entrée est trop petite. Le minimum autorisé est de 0mm.' ) );

	define ('ERROR_PROFONDEUR_NOMBRE', __d( 'cecobois', 'La profondeur entrée n\'est pas un nombre.' ) );
	define ('ERROR_PROFONDEUR_SMALLER', __d( 'cecobois', 'La profondeur entrée est trop petite. Le minimum autorisé; est de 0mm.' ) );

	define ('ERROR_PORTEE_NOMBRE', __d( 'cecobois', 'La portée entrée n\'est pas un nombre.' ) );
	define ('ERROR_PORTEE_SMALLER', __d( 'cecobois', 'La portée entrée est trop petite. Le minimum autorisé est de 0mm.' ) );

	define ('ERROR_SOLLICITATION_NOMBRE', __d( 'cecobois', 'Le ratio de sollicitation entré n\'est pas un nombre.' ) );
	define ('ERROR_SOLLICITATION_SMALLER', __d( 'cecobois', 'Le ratio entré est trop petit. Le minimum autorisé est de 0%.' ) );
	define ('ERROR_SOLLICITATION_BIGGER', __d( 'cecobois', 'Le ratio entré est trop grand. Le maximum autorisé est de 100%.' ) );



	//nom des champs
	$html_champs=array(
		'systeme',
		'type_element',
		'largeur',
		'profondeur',
		'portee',
		'coef',
		'faces',
		'sollicitation',
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
		__d( 'cecobois', 'Métrique' ),
	);

	// VALEURS ASSOCCIES
	$html_systeme_value=array(
		'imp',
		'met'
	);

	// VARIABLES MENU RADIO TYPE POUTRELLE
	$html_type_element=array(
		__d( 'cecobois', 'Poutre' ),
		__d( 'cecobois', 'Poteau' ),
	);

	// VALEURS ASSOCCIES
	$html_type_element_value=array(
		'poutre',
		'poteau'
	);

	// VARIABLES MENU SELECT ESPACEMENT
	$html_coef=array(
		'0,65',
		'0,80',
		'1,00',
		'1,20',
		'1,50',
		'2,00'
	);

	// VALEURS ASSOCCIES
	$html_coef_value=array(
		'0.65',
		'0.80',
		'1.00',
		'1.20',
		'1.50',
		'2.00'
	);

	// VARIABLES MENU SELECT ESPACEMENT
	$html_faces=array(
		__d( 'cecobois', '3 faces' ),
		__d( 'cecobois', '4 faces' ),
	);

	// VALEURS ASSOCCIES
	$html_faces_value=array(
		3,
		4
	);





	// HTML (STYLE ET JS)
	//*******************

	$html_systeme_js 		= ' onclick="changeSysteme();"';
	$html_type_element_js 	= '';
	$html_largeur_js		= '';
	$html_profondeur_js		= '';
	$html_portee_js			= '';
	$html_coef_js			= '';
	$html_faces_js			= '';
	$html_sollicitation_js	= '';


	if($post->action=="send"){
		$html_systeme_js 		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_type_element_js 	= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_largeur_js		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_profondeur_js		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_portee_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_coef_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_faces_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_sollicitation_js	= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
	}

	//par defaut si post nest pas dfini
	$post->systeme			= $post->systeme != ''			?	$post->systeme			: 'met';
	$post->type_element		= $post->type_element != '' 	? 	$post->type_element		: 'poutre';
	$post->largeur			= $post->largeur != '' 			? 	$post->largeur 			: '';
	$post->profondeur		= $post->profondeur != '' 		? 	$post->profondeur		: '';
	$post->portee			= $post->portee != '' 			? 	$post->portee			: '';
	$post->coef				= $post->coef != ''				? 	$post->coef				: '1.00';
	$post->faces			= $post->faces != ''			? 	$post->faces			: 3;
	$post->sollicitation	= $post->sollicitation != ''	?	$post->sollicitation	: '';


	//Afficher ou cacher le débugage
	$show_debug=false;



?>