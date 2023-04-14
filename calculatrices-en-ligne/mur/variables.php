<?PHP

	//nom des variables textuelles
	
	define ('ERROR_HAUTEUR_NOMBRE','La hauteur n\'est pas un nombre.');
	define ('ERROR_HAUTEUR_BIGGER','La hauteur entre est trop grande. Le maximum autoris&eacute; est de 4,88m');
	define ('ERROR_HAUTEUR_SMALLER','La hauteur entre est trop petite. Le minimum autoris&eacute; est de 1m');
	
	define ('ERROR_CHARGE_AXIALE_NEIGE_NOMBRE','La charge axiale non pond&eacute;r&eacute;e pour la neige n\'est pas un nombre.');
	define ('ERROR_CHARGE_AXIALE_NEIGE_SMALLER','La charge axiale non pond&eacute;r&eacute;e pour la neige est trop petite. Le minimum autoris&eacute; est de 0kN/m.');
	
	define ('ERROR_CHARGE_AXIALE_SURCHARGE_NOMBRE','La charge axiale non pond&eacute;r&eacute;e pour la surcharge n\'est pas un nombre.');
	define ('ERROR_CHARGE_AXIALE_SURCHARGE_SMALLER','La charge axiale non pond&eacute;r&eacute;e pour la surcharge est trop petite. Le minimum autoris&eacute; est de 0kN/m.');
	
	define ('ERROR_CHARGE_AXIALE_PERMANENTE_NOMBRE','La charge axiale non pond&eacute;r&eacute;e pour la permanente n\'est pas un nombre.');
	define ('ERROR_CHARGE_AXIALE_PERMANENTE_SMALLER','La charge axiale non pond&eacute;r&eacute;e pour la permanente est trop petite. Le minimum autoris&eacute; est de 0kN/m.');
	
	define ('ERROR_CHARGE_AXIALE_EXCENTRICITE_NOMBRE','La charge axiale non pond&eacute;r&eacute;e pour l\'excentricit&eacute; n\'est pas un nombre.');
	define ('ERROR_CHARGE_AXIALE_EXCENTRICITE_SMALLER','La charge axiale non pond&eacute;r&eacute;e pour l\'excentricit&eacute; est trop petite. Le minimum autoris&eacute; est de 0kN/m.');
	
	define ('ERROR_CHARGE_LATERALE_VENT_NOMBRE','La charge lat&eacute;rale non pond&eacute;r&eacute;e pour le vent n\'est pas un nombre.');
	define ('ERROR_CHARGE_LATERALE_VENT_SMALLER','La charge lat&eacute;rale non pond&eacute;r&eacute;e est trop petite. Le minimum autoris&eacute; est de 0kPa.');

    define ('ERROR_ELANCEMENT_TOO_BIG', __d('cecobois', 'L\'&eacute;lancement (Cc) doit &ecirc;tre inf&eacute;rieure ou &eacute;gale &agrave; 50.'));

	//nom des champs
	$html_champs=array(
		'classe',
		'colombages',
		'colombages2',
		'colombages3',
		'espacement',
		'hauteur',
		'partage_charge',
		'cat_risque',
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

	


	// VARIABLES MENU SELECT CLASSE
	$html_classe=array(
		'&Eacute;-P-S No1/No2',
		'&Eacute;-P-S No3/Stud',
		'MSR 1650Fb-1.5E',
		'MSR 1950Fb-1.7E',
		'MSR 2100Fb-1.8E',
		'MSR 2400Fb-2.0E'
	);
	
	// VALEURS ASSOCCIES
	$html_classe_value=array(
		'eps_no1_2',
		'eps_no3',
		'msr1650',
		'msr1950',
		'msr2100',
		'msr2400'
	);
	
	// VARIABLES MENU SELECT COLOMBAGES
	$html_colombages=array(
		'2x3 : 38 x 64 mm',
		'2x4 : 38 x 89 mm',
		'2x6 : 38 x 140 mm',
		'2x8 : 38 x 184 mm',
		'2x10 : 38 x 235 mm',
		'2x12 : 38 x 286 mm'
	);
	
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
	$html_colombages2=array(
		'2x3 : 38 x 64 mm',
		'2x4 : 38 x 89 mm',
		'2x6 : 38 x 140 mm'
	);
	
	// VALEURS ASSOCCIES 2
	$html_colombages_value2=array(
		'2x3',
		'2x4',
		'2x6'
	);
	
	// VARIABLES MENU SELECT COLOMBAGES 3
	$html_colombages3=array(
		'2x4 : 38 x 89 mm'
	);
	
	// VALEURS ASSOCCIES 3
	$html_colombages_value3=array(
		'2x4'
	);
	
	
	// VARIABLES MENU SELECT ESPACEMENT
	$html_espacement=array(
		'305 mm (12")',
		'406 mm (16")',
		'488 mm (19,2")',
		'610 mm (24")'
	);
	
	// VALEURS ASSOCCIES
	$html_espacement_value=array(
		'305',
		'406',
		'488',
		'610'
	);
	
	// VARIABLES MENU SELECT PARTAGE DE CHARGE
	$html_partage_charge=array(
		'Cas 1',
		'Cas 2'
	);
	
	// VALEURS ASSOCCIES
	$html_partage_charge_value=array(
		'1',
		'2'
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
	
	// VARIABLES MENU SELECT FLECHE TRAITEMENT
	$html_fleche_traitement=array(
		'non-trait',
		'trait'
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
	
	$html_classe_js = ' onchange="aff_select(this,\'colombages\',\'colombages2\',\'colombages3\');"';
	$html_colombages_js			= '';
	$html_colombages2_js		= '';
	$html_colombages3_js		= '';
	$html_espacement_js			= '';
	$html_partage_charge_js		= '';
	$html_cat_risque_js			= '';
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
		$html_classe_js				= ' onclick="confirm_cache_form();"';
		$html_colombages_js			= ' onclick="confirm_cache_form();"';
		$html_colombages2_js		= ' onclick="confirm_cache_form();"';
		$html_colombages3_js		= ' onclick="confirm_cache_form();"';
		$html_espacement_js			= ' onclick="confirm_cache_form();"';
		$html_partage_charge_js		= ' onclick="confirm_cache_form();"';
		$html_cat_risque_js			= ' onclick="confirm_cache_form();"';
		$html_fleche_surcharge_js	= ' onclick="confirm_cache_form();"';
		$html_charge_totale_js		= ' onclick="confirm_cache_form();"';
		$html_traitement_js			= ' onclick="confirm_cache_form();"';
		$html_utilisation_js		= ' onclick="confirm_cache_form();"';
		
		$html_hauteur_js			= ' onfocus="confirm_cache_form();"';
		$html_ax_neige_js			= ' onfocus="confirm_cache_form();"';
		$html_ax_surcharge_js		= ' onfocus="confirm_cache_form();"';
		$html_ax_permanente_js		= ' onfocus="confirm_cache_form();"';
		$html_ax_excentricite_js	= ' onfocus="confirm_cache_form();"';
		$html_lat_vent_js			= ' onfocus="confirm_cache_form();"';
	}
	
	//modification d'affichage de colombages en fonction de la classe choisie.
	
	$html_colombages_style	=' style="display:none;"';
	$html_colombages_style2	=' style="display:none;"';
	$html_colombages_style3	=' style="display:none;"';
	
	
	if($post->action == 'print'){
	
		if($post->classe=='msr2400'){
	
			$post->colombages = '';
			$post->colombages2 = '';
			
		}elseif(substr($post->classe,0,3)=='msr'){
			
			$post->colombages = '';
			$post->colombages3 = '';
	
		}else{
			$post->colombages2 = '';
			$post->colombages3 = '';
		}
		
	}else{
	
		if($post->classe=='msr2400'){
	
			$post->colombages = $post->colombages3;
			$html_colombages_style3='';
			
		}elseif(substr($post->classe,0,3)=='msr'){
			
			$post->colombages = $post->colombages2;
			$html_colombages_style2='';
	
		}else{
			$html_colombages_style='';
		}
	}
	
	
	//par defaut si post nest pas dfini
	$post->classe 			= $post->classe !='' ? 			$post->classe 			: 'eps_no1_2';
	$post->colombages 		= $post->colombages !='' ? 		$post->colombages 		: '2x6';
	$post->espacement 		= $post->espacement != '' ? 	$post->espacement 		: '406';
	$post->partage_charge 	= $post->partage_charge != '' ? $post->partage_charge 	: '2';
	$post->cat_risque 		= $post->cat_risque != '' ? 	$post->cat_risque 		: 'normale';
	
	
	//Afficher ou cacher le débugage
	$show_debug=false;
	
	

?>
