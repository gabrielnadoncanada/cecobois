<?PHP

	//nom des variables textuelles

	define ('ERROR_HAUTEUR_NOMBRE', __d( 'cecobois', 'La hauteur n\'est pas un nombre.' ) );
	define ('ERROR_HAUTEUR_BIGGER', __d( 'cecobois', 'La hauteur entrée est trop grande. Le maximum autorisé est de 4.88 m (16\').' ) );

	define ('ERROR_HAUTEUR_SMALLER', __d( 'cecobois', 'La hauteur entrée est trop petite. Le minimum autorisé est de 1m (3\').' ) );

	define ('ERROR_CHARGE_AXIALE_NEIGE_NOMBRE', __d( 'cecobois', 'La charge axiale non pondérée pour la neige n\'est pas un nombre.' ) );
	define ('ERROR_CHARGE_AXIALE_NEIGE_SMALLER', __d( 'cecobois', 'La charge axiale non pondérée pour la neige est trop petite. Le minimum autorisé est de 0kN/m (0lb/pi).' ) );

	define ('ERROR_CHARGE_AXIALE_SURCHARGE_NOMBRE', __d( 'cecobois', 'La charge axiale non pondérée pour la surcharge n\'est pas un nombre.' ) );
	define ('ERROR_CHARGE_AXIALE_SURCHARGE_SMALLER', __d( 'cecobois', 'La charge axiale non pondérée pour la surcharge est trop petite. Le minimum autorisé est de 0kN/m (0lb/pi).' ) );

	define ('ERROR_CHARGE_AXIALE_PERMANENTE_NOMBRE', __d( 'cecobois', 'La charge axiale non pondérée pour la permanente n\'est pas un nombre.' ) );
	define ('ERROR_CHARGE_AXIALE_PERMANENTE_SMALLER', __d( 'cecobois', 'La charge axiale non pondérée pour la permanente est trop petite. Le minimum autorisé est de 0kN/m (0lb/pi).' ) );

	define ('ERROR_CHARGE_AXIALE_EXCENTRICITE_NOMBRE', __d( 'cecobois', 'La charge axiale non pondérée pour l\'excentricité n\'est pas un nombre.' ) );
	define ('ERROR_CHARGE_AXIALE_EXCENTRICITE_SMALLER', __d( 'cecobois', 'La charge axiale non pondérée pour l\'excentricité est trop petite. Le minimum autorisé est de 0kN/m (0lb/pi).' ) );

	define ('ERROR_CHARGE_LATERALE_VENT_NOMBRE', __d( 'cecobois', 'La charge latérale non pondérée pour le vent n\'est pas un nombre.' ) );
	define ('ERROR_CHARGE_LATERALE_VENT_SMALLER', __d( 'cecobois', 'La charge latérale non pondérée est trop petite. Le minimum autorisé est de 0kPa (0lb/pi<sup>2</sup>).' ) );

    define ('ERROR_ELANCEMENT_TOO_BIG', __d('cecobois', 'L\'&eacute;lancement (Cc) doit &ecirc;tre inf&eacute;rieure ou &eacute;gale &agrave; 50.'));

	//nom des champs
	$html_champs=array(
		'systeme',
		'type',
		'classe',
		'classe2',
		'classe3',
		'classe4',
		'classe5',
		'classe6',
		'classe7',
		'largeur',
		'largeur2',
		'largeur3',
		'largeur4',
		'largeur5',
		'largeur6',
		'largeur7',
		'profondeur',
		'profondeur1',
		'profondeur2',
		'profondeur3',
		'profondeur4',
		'profondeur8',
		'profondeur5',
		'profondeur6',
		'profondeur7',
		'espacement',
		'hauteur',
		'partage_charge',
		'cat_risque',
		'edition_code',
		'ax_neige',
		'ax_surcharge',
		'ax_permanente',
		'ax_excentricite',
		'lat_vent',
		'fleche_surcharge',
		'fleche_charge_totale',
		'fleche_traitement',
		'fleche_utilisation',
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

	// VARIABLES MENU SELECT TYPE
	$html_type=array(
		__d( 'cecobois', 'Bois de sciage' ),
		__d( 'cecobois', 'Lamco LFL' ),
		__d( 'cecobois', 'Nordic Lam' ),
		__d( 'cecobois', 'TimberStrand LSL' ),
		__d( 'cecobois', 'Versa-Stud LVL' ),
		__d( 'cecobois', 'SolidStart LSL' ),
		__d( 'cecobois', 'SolidStart LVL' )
	);

	// VALEURS ASSOCCIES
	$html_type_value=array(
		'sciage',
		'lamco-lfl',
		'nordic-lam',
		'timberstrand-lsl',
		'versastud-lvl',
		'solidstart-lsl',
		'solidstart-lvl'
	);

	// VARIABLES MENU SELECT CLASSE
	$html_classe=array(
		__d( 'cecobois', 'É-P-S Select' ),
		__d( 'cecobois', 'É-P-S No1/No2' ),
		__d( 'cecobois', 'É-P-S No3/Stud' ),
		__d( 'cecobois', 'MSR 1650Fb-1.5E' ),
		__d( 'cecobois', 'MSR 1950Fb-1.7E' ),
		__d( 'cecobois', 'MSR 2100Fb-1.8E' ),
		__d( 'cecobois', 'MSR 2250Fb-1.9E' ),
		__d( 'cecobois', 'MSR 2400Fb-2.0E' )
	);

	// VALEURS ASSOCCIES
	$html_classe_value=array(
		'eps_select',
		'eps_no1_2',
		'eps_no3',
		'msr1650',
		'msr1950',
		'msr2100',
		'msr2250',
		'msr2400'
	);

	// VARIABLES MENU SELECT CLASSE2
	$html_classe2=array(
		__d( 'cecobois', '1.6E' ),
		__d( 'cecobois', '1.7E' ),
		__d( 'cecobois', '1.9E' ),
		__d( 'cecobois', '2.1E' )
	);

	// VALEURS ASSOCCIES
	$html_classe2_value=array(
		'16e',
		'17e',
		'19e',
		'21e'
	);

	// VARIABLES MENU SELECT CLASSE3
	$html_classe3=array(
		__d( 'cecobois', 'ES11/NPG' )
	);

	// VALEURS ASSOCCIES
	$html_classe3_value=array(
		'es11'
	);

	// VARIABLES MENU SELECT CLASSE4
	$html_classe4=array(
		__d( 'cecobois', '1.3E' ),
		__d( 'cecobois', '1.5E' )
	);

	// VALEURS ASSOCCIES
	$html_classe4_value=array(
		'13e',
		'15e'
	);

	// VARIABLES MENU SELECT CLASSE5
	$html_classe5=array(
		__d( 'cecobois', '1.8E-2400Fb' ),
		__d( 'cecobois', '1.8E-2650Fb' )
	);

	// VALEURS ASSOCCIES
	$html_classe5_value=array(
		'18e_2400',
		'18e_2650'
	);

	// VARIABLES MENU SELECT CLASSE6
	$html_classe6=array(
		__d( 'cecobois', '1730Fb-1.35E' ),
		__d( 'cecobois', '2360Fb-1.55E' ),
		__d( 'cecobois', '2500Fb-1.75E' )
	);

	// VALEURS ASSOCCIES
	$html_classe6_value=array(
		'1730fb',
		'2360fb',
		'2500fb'
	);

	// VARIABLES MENU SELECT CLASSE7
	$html_classe7=array(
		__d( 'cecobois', '2250Fb-1.5E' ),
		__d( 'cecobois', '2900Fb-2.0E' )
	);

	// VALEURS ASSOCCIES
	$html_classe7_value=array(
		'2250fb',
		'2900fb'
	);


	// VARIABLES MENU SELECT LARGEUR
	if($post->systeme == "imp"){
		$html_largeur=array(
			'1 1/2'
		);
	}else{
		$html_largeur=array(
			'38'
		);
	}

	// VALEURS ASSOCCIES
	$html_largeur_value=array(
		'38'
	);

	// VARIABLES MENU SELECT LARGEUR2
	if($post->systeme == "imp"){
		$html_largeur2=array(
			'1 1/2'
		);
	}else{
		$html_largeur2=array(
			'38'
		);
	}

	// VALEURS ASSOCCIES
	$html_largeur2_value=array(
		'38'
	);

	// VARIABLES MENU SELECT LARGEUR2
	if($post->systeme == "imp"){
		$html_largeur3=array(
			'1 1/2',
			'1 3/4'
		);
	}else{
		$html_largeur3=array(
			'38',
			'44'
		);
	}

	// VALEURS ASSOCCIES
	$html_largeur3_value=array(
		'38',
		'44'
	);


	// VARIABLES MENU SELECT LARGEUR4
	if($post->systeme == "imp"){
		$html_largeur4=array(
			'1 1/2'
		);
	}else{
		$html_largeur4=array(
			'38'
		);
	}

	// VALEURS ASSOCCIES
	$html_largeur4_value=array(
		'38'
	);

	// VARIABLES MENU SELECT LARGEUR5
	if($post->systeme == "imp"){
		$html_largeur5=array(
			'1 1/2'
		);
	}else{
		$html_largeur5=array(
			'38'
		);
	}

	// VALEURS ASSOCCIES
	$html_largeur5_value=array(
		'38'
	);

	// VARIABLES MENU SELECT LARGEUR6
	if($post->systeme == "imp"){
		$html_largeur6=array(
			'1 1/2'
		);
	}else{
		$html_largeur6=array(
			'38'
		);
	}

	// VALEURS ASSOCCIES
	$html_largeur6_value=array(
		'38'
	);

	// VARIABLES MENU SELECT LARGEUR7
	if($post->systeme == "imp"){
		$html_largeur7=array(
			'1 1/2'
		);
	}else{
		$html_largeur7=array(
			'38'
		);
	}

	// VALEURS ASSOCCIES
	$html_largeur7_value=array(
		'38'
	);

	// VARIABLES MENU SELECT PROFONDEUR
	if($post->systeme == "imp"){
		$html_profondeur=array(
			'2 1/2',
			'3 1/2',
			'5 1/2',
			'7 1/4',
			'9 1/4',
			'11 1/4'
		);
	}else{
		$html_profondeur=array(
			'64',
			'89',
			'140',
			'184',
			'235',
			'286'
		);
	}

	// VALEURS ASSOCCIES
	$html_profondeur_value=array(
		'64',
		'89',
		'140',
		'184',
		'235',
		'286'
	);

	// VARIABLES MENU SELECT PROFONDEUR2
	if($post->systeme == "imp"){
		$html_profondeur2=array(
			'5 1/2',
			'7 1/4',
			'9 1/4',
			'9 1/2',
			'11 1/4',
			'11 7/8',
			'14',
			'16'
		);
	}else{
		$html_profondeur2=array(
			'140',
			'184',
			'235',
			'242',
			'286',
			'302',
			'356',
			'406'
		);
	}

	// VALEURS ASSOCCIES
	$html_profondeur2_value=array(
		'140',
		'184',
		'235',
		'242',
		'286',
		'302',
		'356',
		'406'
	);

	// VARIABLES MENU SELECT PROFONDEUR3
	if($post->systeme == "imp"){
		$html_profondeur3=array(
			'5 1/2',
			'7 1/4'
		);
	}else{
		$html_profondeur3=array(
			'140',
			'184'
		);
	}

	// VALEURS ASSOCCIES
	$html_profondeur3_value=array(
		'140',
		'184'
	);


	// VARIABLES MENU SELECT PROFONDEUR4
	if($post->systeme == "imp"){
		$html_profondeur4=array(
			'3 1/2'
		);
	}else{
		$html_profondeur4=array(
			'89'
		);
	}

	// VALEURS ASSOCCIES
	$html_profondeur4_value=array(
		'89'
	);

	// VARIABLES MENU SELECT PROFONDEUR4-2
	if($post->systeme == "imp"){
		$html_profondeur8=array(
			'5 1/2',
			'7 1/4'
		);
	}else{
		$html_profondeur8=array(
			'140',
			'184'
		);
	}

	// VALEURS ASSOCCIES
	$html_profondeur8_value=array(
		'140',
		'184'
	);

	// VARIABLES MENU SELECT PROFONDEUR5
	if($post->systeme == "imp"){
		$html_profondeur5=array(
			'3 1/2',
			'5 1/2',
			'7 1/4',
			'9 1/4',
			'11 1/4'
		);
	}else{
		$html_profondeur5=array(
			'89',
			'140',
			'184',
			'235',
			'286'
		);
	}

	// VALEURS ASSOCCIES
	$html_profondeur5_value=array(
		'89',
		'140',
		'184',
		'235',
		'286'
	);

	// VARIABLES MENU SELECT PROFONDEUR6
	if($post->systeme == "imp"){
		$html_profondeur6=array(
			'3 1/2',
			'5 1/2',
			'7 1/4'
		);
	}else{
		$html_profondeur6=array(
			'89',
			'140',
			'184'
		);
	}

	// VALEURS ASSOCCIES
	$html_profondeur6_value=array(
		'89',
		'140',
		'184'
	);

		// VARIABLES MENU SELECT PROFONDEUR6
	if($post->systeme == "imp"){
		$html_profondeur7=array(
			'3 1/2',
			'5 1/2',
			'7 1/4'
		);
	}else{
		$html_profondeur7=array(
			'89',
			'140',
			'184'
		);
	}

	// VALEURS ASSOCCIES
	$html_profondeur7_value=array(
		'89',
		'140',
		'184'
	);


	// VARIABLES MENU SELECT COLOMBAGES
	if($post->systeme == "imp"){
		$html_colombages=array(
			'2x3',
			'2x4',
			'2x6',
			'2x8',
			'2x10',
			'2x12'
		);
	}else{
		$html_colombages=array(
			'38 x 64',
			'38 x 89',
			'38 x 140',
			'38 x 184',
			'38 x 235',
			'38 x 286'
		);
	}

	// VALEURS ASSOCCIES
	$html_colombages_value=array(
		'2x3',
		'2x4',
		'2x6',
		'2x8',
		'2x10',
		'2x12'
	);

	// VARIABLES MENU SELECT COLOMBAGES 2
	if($post->systeme == "imp"){
		$html_colombages2=array(
			'2x3',
			'2x4',
			'2x6'
		);
	}else{
		$html_colombages2=array(
			'38 x 64 mm',
			'38 x 89 mm',
			'38 x 140 mm'
		);
	}

	// VALEURS ASSOCCIES 2
	$html_colombages_value2=array(
		'2x3',
		'2x4',
		'2x6'
	);

	// VARIABLES MENU SELECT COLOMBAGES 3
	if($post->systeme == "imp"){
		$html_colombages3=array(
			'2x8'
		);
	}else{
		$html_colombages3=array(
			'38 x 184'
		);
	}

	// VALEURS ASSOCCIES 3
	$html_colombages_value3=array(
		'2x8'
	);

	// VARIABLES MENU SELECT COLOMBAGES 4
	if($post->systeme == "imp"){
		$html_colombages4=array(
			'2x3',
			'2x4'
		);
	}else{
		$html_colombages4=array(
			'38 x 64 mm',
			'38 x 89 mm'
		);
	}

	// VALEURS ASSOCCIES 3
	$html_colombages_value4=array(
		'2x3',
		'2x4'
	);


	// VARIABLES MENU SELECT ESPACEMENT
	if($post->systeme == "imp"){
		$html_espacement=array(
			'12"',
			'16"',
			'19,2"',
			'24"'
		);
	}else{
		$html_espacement=array(
			'305 mm',
			'406 mm',
			'488 mm',
			'610 mm'
		);
	}

	// VALEURS ASSOCCIES
	$html_espacement_value=array(
		'305',
		'406',
		'488',
		'610'
	);

	// VARIABLES MENU SELECT PARTAGE DE CHARGE
	$html_partage_charge=array(
		__d( 'cecobois', 'Cas 1' ),
		__d( 'cecobois', 'Cas 2' )
	);

	// VALEURS ASSOCCIES
	$html_partage_charge_value=array(
		'1',
		'2'
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

	// VARIABLES MENU SELECT EDITION CODE
	$html_edition_code=array(
		__d( 'cecobois', 'CNB 2010' ),
		__d( 'cecobois', 'CNB 2015' )
	);

	// VALEURS ASSOCCIES
	$html_edition_code_value=array(
		'2010',
		'2015'
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

	// VARIABLES MENU SELECT FLECHE TRAITEMENT
	$html_fleche_traitement=array(
		'non-traité',
		'traité'
	);

	// VALEURS ASSOCCIES
	$html_fleche_traitement_value=array(
		'traite',
		'non_traite'
	);

	// VARIABLES MENU SELECT FLECHE UTILISATION
	$html_fleche_utilisation=array(
		'sec',
		'humide'
	);

	// VALEURS ASSOCCIES
	$html_fleche_utilisation_value=array(
		'sec',
		'humide'
	);



	// HTML (STYLE ET JS)
	//*******************
	$html_systeme_js 			= ' onclick="changeSysteme(0,\'\');"';
	$html_type_js 				= ' onchange="aff_select(this,[\'classe\',\'largeur\',\'profondeur\'])"';
	$html_classe_js 			= '';
	$html_classe2_js 			= '';
	$html_classe3_js 			= '';
	$html_classe4_js 			= 'onchange="aff_select(this,[\'profondeur4\'])"';
	$html_classe5_js 			= '';
	$html_classe6_js 			= '';
	$html_classe7_js 			= '';
	$html_largeur_js 			= '';
	$html_largeur2_js 			= '';
	$html_largeur3_js 			= '';
	$html_largeur4_js 			= '';
	$html_largeur5_js 			= '';
	$html_largeur6_js 			= '';
	$html_largeur7_js 			= '';
	$html_profondeur_js 		= '';
	$html_profondeur2_js 		= '';
	$html_profondeur3_js 		= '';
	$html_profondeur4_js 		= '';
	$html_profondeur8_js 		= '';
	$html_profondeur5_js 		= '';
	$html_profondeur6_js 		= '';
	$html_profondeur7_js 		= '';

	$html_espacement_js			= '';
	$html_partage_charge_js		= '';
	$html_cat_risque_js			= '';
	$html_edition_code_js		= '';
	$html_fleche_surcharge_js	= '';
	$html_charge_totale_js		= '';
	$html_traitement_js			= '';
	$html_utilisation_js		= '';

	$html_hauteur_js			= '';
	$html_ax_neige_js			= '';
	$html_ax_surcharge_js		= '';
	$html_ax_permanente_js		= '';
	$html_ax_excentricite_js	= '';
	$html_lat_vent_js			= '';

	if($post->action=="send"){
		/*$html_systeme_js 			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_type_js				= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_classe_js				= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_classe2_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_classe3_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_classe4_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_classe5_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_classe6_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_classe7_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_largeur_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_largeur2_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_largeur3_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_largeur4_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_largeur5_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_largeur6_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_largeur7_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_profondeur_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_profondeur2_js		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_profondeur3_js		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_profondeur4_js		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_profondeur42_js		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_profondeur5_js		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_profondeur6_js		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_profondeur7_js		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';

		$html_espacement_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_partage_charge_js		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_cat_risque_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_edition_code_js		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_fleche_surcharge_js	= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_charge_totale_js		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_traitement_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_utilisation_js		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';

		$html_hauteur_js			= ' onfocus="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_ax_neige_js			= ' onfocus="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_ax_surcharge_js		= ' onfocus="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_ax_permanente_js		= ' onfocus="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_ax_excentricite_js	= ' onfocus="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_lat_vent_js			= ' onfocus="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';*/
	}

	

	//modification d'affichage de colombages en fonction de la classe choisie.

	$post->type 			= $post->type !='' ? 			$post->type 		: 'sciage';
	$post->classe 			= $post->classe !='' ? 			$post->classe 		: 'eps_select';
	$post->largeur 			= $post->largeur !='' ? 		$post->largeur 		: '38';
	$post->profondeur 		= $post->profondeur !='' ? 		$post->profondeur 	: '64';

	foreach($html_type_value as $key=>$value){
		$suffix = $key==0?'':($key+1);
		
		$class_style = 'html_classe'.$suffix.'_style';
		$largeur_style = 'html_largeur'.$suffix.'_style';
		$profondeur_style = 'html_profondeur'.$suffix.'_style';

		$class_var = 'classe'.$suffix;
		$largeur_var = 'largeur'.$suffix;
		$profondeur_var = 'profondeur'.$suffix;

		if($post->type!=$value){
			$found = true;
			$$class_style = ' style="display:none;"';
			$$largeur_style = ' style="display:none;"';
			$$profondeur_style = ' style="display:none;"';
		}
		else{
			$post->classe = $post->$class_var;
			$post->largeur = $post->$largeur_var;
			$post->profondeur = $post->$profondeur_var;
		}

		if($post->action == 'print' && $key > 0){
			$post->$class_var = '';
			$post->$largeur_var = '';
			$post->$profondeur_var = '';
		}
	}

	//Profondeur 4-2
	if($post->type == 'timberstrand-lsl' && $post->classe4 == '15e'){
		$post->profondeur = $post->profondeur8;
		$html_profondeur4_style = ' style="display:none;"';


		if($post->action == 'print'){
			$post->profondeur8 = '';
		}
	}
	else{
		$html_profondeur8_style = ' style="display:none;"';

		if($post->action == 'print'){
			$post->profondeur8 = '';
		}
	}


	//par defaut si post nest pas dfini
	$post->systeme			= $post->systeme !='' ? 		$post->systeme 			: 'met';
	$post->espacement 		= $post->espacement != '' ? 	$post->espacement 		: '406';
	$post->partage_charge 	= $post->partage_charge != '' ? $post->partage_charge 	: '2';
	$post->cat_risque 		= $post->cat_risque != '' ? 	$post->cat_risque 		: 'normale';
	$post->edition_code 	= $post->edition_code != '' ? 	$post->edition_code 	: '2010';


	//Afficher ou cacher le débugage
	$show_debug=false;

	$url_form = "index.php";

	//$debug	= isset($_GET['debug'])?$_GET['debug']:0;
	//if($debug==1){
		$show_debug=false;
	//	$url_form = "index.php?debug=1";
	//}
?>
