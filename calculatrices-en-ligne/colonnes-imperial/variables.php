<?PHP

	//nom des variables textuelles
	//print_r($_POST);
	define ('ERROR_HAUTEUR_NOMBRE', __d( 'cecobois', 'La hauteur n\'est pas un nombre.' ) );
	define ('ERROR_HAUTEUR_BIGGER', __d( 'cecobois', 'La hauteur entrée est trop grande. Le maximum autorisé est de 4,88m' ) );
	define ('ERROR_HAUTEUR_SMALLER', __d( 'cecobois', 'La hauteur entrée est trop petite. Le minimum autorisé est de 1m' ) );

	define ('ERROR_CHARGE_AXIALE_NEIGE_NOMBRE', __d( 'cecobois', 'La charge axiale non pondérée pour la neige n\'est pas un nombre.' ) );
	define ('ERROR_CHARGE_AXIALE_NEIGE_SMALLER', __d( 'cecobois', 'La charge axiale non pondérée pour la neige est trop petite. Le minimum autorisé est de 0kN/m.' ) );

	define ('ERROR_CHARGE_AXIALE_SURCHARGE_NOMBRE', __d( 'cecobois', 'La charge axiale non pondérée pour la surcharge n\'est pas un nombre.' ) );
	define ('ERROR_CHARGE_AXIALE_SURCHARGE_SMALLER', __d( 'cecobois', 'La charge axiale non pondérée pour la surcharge est trop petite. Le minimum autorisé est de 0kN/m.' ) );

	define ('ERROR_CHARGE_AXIALE_PERMANENTE_NOMBRE', __d( 'cecobois', 'La charge axiale non pondérée pour la permanente n\'est pas un nombre.' ) );
	define ('ERROR_CHARGE_AXIALE_PERMANENTE_SMALLER', __d( 'cecobois', 'La charge axiale non pondérée pour la permanente est trop petite. Le minimum autorisé est de 0kN/m.' ) );

	define ('ERROR_CHARGE_AXIALE_EXCENTRICITE_NOMBRE', __d( 'cecobois', 'La charge axiale non pondérée pour l\'excentricité n\'est pas un nombre.' ) );
	define ('ERROR_CHARGE_AXIALE_EXCENTRICITE_SMALLER', __d( 'cecobois', 'La charge axiale non pondérée pour l\'excentricité est trop petite. Le minimum autorisé est de 0kN/m.' ) );

	define ('ERROR_CHARGE_LATERALE_VENT_NOMBRE', __d( 'cecobois', 'La charge latérale non pondérée pour le vent n\'est pas un nombre.' ) );
	define ('ERROR_CHARGE_LATERALE_VENT_SMALLER', __d( 'cecobois', 'La charge latérale non pondérée est trop petite. Le minimum autorisé est de 0kPa.' ) );

	define ('ERROR_CB_BIGGER', __d( 'cecobois', 'L\'élancement est plus grand que 50. (CB)' ) );
	define ('ERROR_CC_BIGGER', __d( 'cecobois', 'L\'élancement est plus grand que 50. (CC)' ) );

	define ('ERROR_CHARGE_EULER', __d( 'cecobois', 'Problème d\'instabilité (P<sub>f</sub> > P<sub>E</sub>) - Réduire les charges axiales ou modifier la configuration de la colonne.' ) );

	//nom des champs
	$html_champs=array(
		'systeme',
		'type_bois',
		'classe_bois_sciage',
		'classe_bois_scl',
		'classe_bois_blc',
		'classe_bois_blc_nordic',
		'colonnes_bois_sciage',
		'colonnes_bois_sciage2',
		'colonnes_bois_sciage3',
		'colonnes_bois_sciage4',
		'largeur',
		'largeur_bois_scl',
		'profondeur45_bois_scl',
		'profondeur89_bois_scl',
		'profondeur134_bois_scl',
		'profondeur178_bois_scl',

		'largeur_bois_blc',
		'profondeur80_bois_blc',
		'profondeur105_bois_blc',
		'profondeur130_bois_blc',
		'profondeur175_bois_blc',
		'profondeur215_bois_blc',
		'profondeur225_bois_blc',
		'profondeur265_bois_blc',
		'profondeur275_bois_blc',
		'profondeur315_bois_blc',
		'profondeur365_bois_blc',
		'profondeur415_bois_blc',
		'profondeur465_bois_blc',
		'profondeur515_bois_blc',

		'largeur_bois_blc_nordic',
		'profondeur86_bois_blc_nordic',
		'profondeur137_bois_blc_nordic',
		'profondeur184_bois_blc_nordic',
		'profondeur228_bois_blc_nordic',
		'profondeur279_bois_blc_nordic',
		'profondeur327_bois_blc_nordic',

		'essence_bois_massif',
		'classe_bois_massif',
		'largeur1_bois_massif',
		'largeur2_bois_massif',
		'profondeur140_bois_massif',
		'profondeur191_bois_massif',
		'profondeur241_bois_massif',
		'profondeur292_bois_massif',
		'profondeur140_2_bois_massif',
		'profondeur191_2_bois_massif',
		'profondeur241_2_bois_massif',

		'plis_bois_sciage',
		'plis_bois_scl',
		'attache_bois_sciage',
		'attache_bois_scl',
		'hauteur',
		'coef_longueur_efficace',
		'cat_risque',
		'axe_faible',
		'edition_code',
		'edition_norme',
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

	//vide session si pas la mÃªme calculatrice
	if(!isset($_SESSION['calc_name'])){
		$_SESSION['calc_name'] = $_REQUEST['name'];
	}
	if($_SESSION['calc_name'] != $_REQUEST['name']){
		for($a=0; $a<count($html_champs)-1; $a++){
			if(isset($_SESSION[$html_champs[$a]])){
				$_SESSION[$html_champs[$a]] = '';
			}
		}
	}
	$_SESSION['calc_name'] = $_REQUEST['name'];

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
				$_SESSION[$html_champs[$a]] = '';
			}
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
	$html_type_bois=array(
		__d( 'cecobois', 'Bois de sciage' ),
		__d( 'cecobois', 'Bois composite SCL' ),
		__d( 'cecobois', 'Lamellé collé CSA' ),
		__d( 'cecobois', 'Lamellé collé Nordic Lam' ),
		__d( 'cecobois', 'Bois massif' )
	);

	// VALEURS ASSOCCIES
	$html_type_bois_value=array(
		'bois_sciage',
		'bois_scl',
		'bois_blc',
		'bois_blc_nordic',
		'bois_massif'
	);

	// BOIS SCIAGE

		// VARIABLES MENU SELECT CLASSE
		$html_classe_bois_sciage=array(
			__d( 'cecobois', 'É-P-S No1/No2' ),
			__d( 'cecobois', 'É-P-S No3/Stud' ),
			__d( 'cecobois', 'MSR 1650Fb-1.5E' ),
			__d( 'cecobois', 'MSR 1950Fb-1.7E' ),
			__d( 'cecobois', 'MSR 2100Fb-1.8E' ),
			__d( 'cecobois', 'MSR 2400Fb-2.0E' )
		);

		// VALEURS ASSOCCIES
		$html_classe_bois_sciage_value=array(
			'eps_no1_2',
			'eps_no3',
			'msr1650',
			'msr1950',
			'msr2100',
			'msr2400'
		);

		// VARIABLES MENU SELECT colonnes
		$html_colonnes_bois_sciage=array(
			'2x3 : 38 x 64 mm',
			'2x4 : 38 x 89 mm',
			'2x6 : 38 x 140 mm',
			'2x8 : 38 x 184 mm',
			'2x10 : 38 x 235 mm',
			'2x12 : 38 x 286 mm'
		);


		// VALEURS ASSOCCIES
		$html_colonnes_bois_sciage_value=array(
			'2x3',
			'2x4',
			'2x6',
			'2x8',
			'2x10',
			'2x12'
		);

		// VARIABLES MENU SELECT colonnes 2
		$html_colonnes_bois_sciage2=array(
			'2x3 : 38 x 64 mm',
			'2x4 : 38 x 89 mm',
			'2x6 : 38 x 140 mm'
		);

		// VALEURS ASSOCCIES 2
		$html_colonnes_bois_sciage_value2=array(
			'2x3',
			'2x4',
			'2x6'
		);

		// VARIABLES MENU SELECT colonnes 3
		$html_colonnes_bois_sciage3=array(
			'2x8 : 38 x 184 mm'
		);

		// VALEURS ASSOCCIES 3
		$html_colonnes_bois_sciage_value3=array(
			'2x8'
		);

		// VARIABLES MENU SELECT colonnes 4
		$html_colonnes_bois_sciage4=array(
			'2x3 : 38 x 64 mm',
			'2x4 : 38 x 89 mm'
		);

		// VALEURS ASSOCCIES 4
		$html_colonnes_bois_sciage_value4=array(
			'2x3',
			'2x4'
		);

		// VARIABLES MENU SELECT plis
		$html_plis_bois_sciage=array(
			'1',
			'2',
			'3',
			'4',
			'5'
		);

		// VALEURS ASSOCCIES
		$html_plis_bois_sciage_value=array(
			'1',
			'2',
			'3',
			'4',
			'5'
		);

		// VARIABLES MENU SELECT plis
		$html_attache_bois_sciage=array(
			__d( 'cecobois', 'Clous' ),
			__d( 'cecobois', 'Boulons' ),
			__d( 'cecobois', 'Anneaux fendus' )
		);

		// VALEURS ASSOCCIES
		$html_attache_bois_sciage_value=array(
			'cloue',
			'boulonne',
			'anneaux'
		);

	// BOIS SCL

		// VARIABLES MENU SELECT CLASSE
		$html_classe_bois_scl=array(
			'1.5E',
			'1.7E',
			'1.8E',
			'1.9E',
			'2.0E',
			'2.1E'
		);

		// VALEURS ASSOCCIES
		$html_classe_bois_scl_value=array(
			'1_5',
			'1_7',
			'1_8',
			'1_9',
			'2',
			'2_1'
		);

		// VARIABLES MENU SELECT plis
		$html_plis_bois_scl=array(
			'1',
			'2',
			'3',
			'4',
			'5'
		);

		// VALEURS ASSOCCIES
		$html_plis_bois_scl_value=array(
			'1',
			'2',
			'3',
			'4',
			'5'
		);

		// VARIABLES MENU SELECT attaches
		$html_attache_bois_scl=array(
			__d( 'cecobois', 'Clous' ),
			__d( 'cecobois', 'Boulons' ),
			__d( 'cecobois', 'Anneaux fendus' )
		);

		// VALEURS ASSOCCIES
		$html_attache_bois_scl_value=array(
			'cloue',
			'boulonne',
			'anneaux'
		);


		// VARIABLES MENU SELECT LARGEUR
		if($post->systeme == "imp"){
			$html_largeur_bois_scl=array('1 3/4"','3 1/2"','5 1/4"','7"');
		}else{
			$html_largeur_bois_scl=array('45 mm','89 mm','134 mm','178 mm');
		}

		// VALEURS ASSOCCIES
		$html_largeur_bois_scl_value=array('45','89','134','178');
		// VARIABLES MENU SELECT PROFONDEUR
		// VALEURS ASSOCCIES

			// 45
			if($post->systeme == "imp"){
				$html_profondeur45_bois_scl		= array('3 1/2"','5 1/2"','7 1/4"','9 1/4"','9 1/2"','11 1/4"','11 7/8"');
			}else{
				$html_profondeur45_bois_scl		= array('89 mm','140 mm','184 mm','235 mm','241 mm','286 mm','302 mm');
			}
			$html_profondeur45_bois_scl_value	= array('89','140','184','235','241','286','302');

			// 89
			if($post->systeme == "imp"){
				$html_profondeur89_bois_scl		= array('3 1/2"','5 1/4"','7"');
			}else{
				$html_profondeur89_bois_scl		= array('89 mm','134 mm','178 mm');
			}
			$html_profondeur89_bois_scl_value	= array('89','134','178');

			// 134
			if($post->systeme == "imp"){
				$html_profondeur134_bois_scl		= array('5 1/4"','7"');
			}else{
				$html_profondeur134_bois_scl		= array('134 mm','178 mm');
			}
			$html_profondeur134_bois_scl_value	= array('134','178');

			// 178
			if($post->systeme == "imp"){
				$html_profondeur178_bois_scl		= array('7"');
			}else{
				$html_profondeur178_bois_scl		= array('178 mm');
			}
			$html_profondeur178_bois_scl_value	= array('178');


	// BOIS BLC

		// VARIABLES MENU SELECT CLASSE
		$html_classe_bois_blc=array(
			'EP 12c',
			'EP 20f-EX',
			'DM 16c',
			'DM 20f-EX',
			'DM 24f-EX'
		);

		// VALEURS ASSOCCIES
		$html_classe_bois_blc_value=array(
			'ep_12c',
			'ep_20fex',
			'dm_16c',
			'dm_20fex',
			'dm_24fex'
		);

		// VARIABLES MENU SELECT LARGEUR
		if($post->systeme == "imp"){
			$html_largeur_bois_blc=array('3 1/8"','4 1/8"','5 1/8"','6 7/8"','8 1/2"','8 7/8"','10 3/8"','10 7/8"','12 3/8"','14 3/8"','16 3/8"','18 3/8"','20 1/4"');
		}else{
			$html_largeur_bois_blc=array('80 mm','105 mm','130 mm','175 mm','215 mm','225 mm','265 mm','275 mm','315 mm','365 mm','415 mm','465 mm','515 mm');
		}

		// VALEURS ASSOCCIES
		$html_largeur_bois_blc_value=array('80','105','130','175','215','225','265','275','315','365','415','465','515');

		// VARIABLES MENU SELECT PROFONDEUR
		// VALEURS ASSOCCIES

			// 80
			if($post->systeme == "imp"){
				$html_profondeur80_bois_blc		= array('4 1/2"','6"','7 1/2"','9"','10 1/2"','12"','13 1/2"','15"','16 1/2','18"','19 1/2"','21"','22 1/2"');
			}else{
				$html_profondeur80_bois_blc		= array('114 mm','152 mm','190 mm','228 mm','266 mm','304 mm','342 mm','380 mm','418 mm','456 mm','494 mm','532 mm','570 mm');
			}
			$html_profondeur80_bois_blc_value	= array('114','152','190','228','266','304','342','380','418','456','494','532','570');

			// 105
			if($post->systeme == "imp"){
				$html_profondeur105_bois_blc	= array('4 1/2"','6"','7 1/2"','9"','10 1/2"','12"','13 1/2"','15"','16 1/2','18"','19 1/2"','21"','22 1/2"','24"');
			}else{
				$html_profondeur105_bois_blc	= array('114 mm','152 mm','190 mm','228 mm','266 mm','304 mm','342 mm','380 mm','418 mm','456 mm','494 mm','532 mm','570 mm','608 mm');
			}
			$html_profondeur105_bois_blc_value	= array('114','152','190','228','266','304','342','380','418','456','494','532','570','608');

			// 130
			if($post->systeme == "imp"){
				$html_profondeur130_bois_blc	= array('6"','7 1/2"','9"','10 1/2"','12"','13 1/2"','15"','16 1/2','18"','19 1/2"','21"','22 1/2"','24"');
			}else{
				$html_profondeur130_bois_blc	= array('152 mm','190 mm','228 mm','266 mm','304 mm','342 mm','380 mm','418 mm','456 mm','494 mm','532 mm','570 mm','608 mm');
			}
			$html_profondeur130_bois_blc_value	= array('152','190','228','266','304','342','380','418','456','494','532','570','608');

			// 175
			if($post->systeme == "imp"){
				$html_profondeur175_bois_blc	= array('7 1/2"','9"','10 1/2"','12"','13 1/2"','15"','16 1/2','18"','19 1/2"','21"','22 1/2"','24"');
			}else{
				$html_profondeur175_bois_blc	= array('190 mm','228 mm','266 mm','304 mm','342 mm','380 mm','418 mm','456 mm','494 mm','532 mm','570 mm','608 mm');
			}
			$html_profondeur175_bois_blc_value	= array('190','228','266','304','342','380','418','456','494','532','570','608');

			// 215
			if($post->systeme == "imp"){
				$html_profondeur215_bois_blc	= array('10 1/2"','12"','13 1/2"','15"','16 1/2','18"','19 1/2"','21"','22 1/2"','24"');
			}else{
				$html_profondeur215_bois_blc	= array('266 mm','304 mm','342 mm','380 mm','418 mm','456 mm','494 mm','532 mm','570 mm','608 mm');
			}
			$html_profondeur215_bois_blc_value	= array('266','304','342','380','418','456','494','532','570','608');

			// 225
			if($post->systeme == "imp"){
				$html_profondeur225_bois_blc	= array('12"','13 1/2"','15"','16 1/2','18"','19 1/2"','21"','22 1/2"','24"');
			}else{
				$html_profondeur225_bois_blc	= array('304 mm','342 mm','380 mm','418 mm','456 mm','494 mm','532 mm','570 mm','608 mm');
			}
			$html_profondeur225_bois_blc_value	= array('304','342','380','418','456','494','532','570','608');

			// 265
			if($post->systeme == "imp"){
				$html_profondeur265_bois_blc	= array('13 1/2"','15"','16 1/2','18"','19 1/2"','21"','22 1/2"','24"');
			}else{
				$html_profondeur265_bois_blc	= array('342 mm','380 mm','418 mm','456 mm','494 mm','532 mm','570 mm','608 mm');
			}
			$html_profondeur265_bois_blc_value	= array('342','380','418','456','494','532','570','608');

			// 275
			if($post->systeme == "imp"){
				$html_profondeur275_bois_blc	= array('15"','16 1/2','18"','19 1/2"','21"','22 1/2"','24"');
			}else{
				$html_profondeur275_bois_blc	= array('380 mm','418 mm','456 mm','494 mm','532 mm','570 mm','608 mm');
			}
			$html_profondeur275_bois_blc_value	= array('380','418','456','494','532','570','608');

			// 315
			if($post->systeme == "imp"){
				$html_profondeur315_bois_blc	= array('15"','16 1/2','18"','19 1/2"','21"','22 1/2"','24"');
			}else{
				$html_profondeur315_bois_blc	= array('380 mm','418 mm','456 mm','494 mm','532 mm','570 mm','608 mm');
			}
			$html_profondeur315_bois_blc_value	= array('380','418','456','494','532','570','608');

			// 365
			if($post->systeme == "imp"){
				$html_profondeur365_bois_blc	= array('15"','16 1/2','18"','19 1/2"','21"','22 1/2"','24"');
			}else{
				$html_profondeur365_bois_blc	= array('380 mm','418 mm','456 mm','494 mm','532 mm','570 mm','608 mm');
			}
			$html_profondeur365_bois_blc_value	= array('380','418','456','494','532','570','608');

			// 415
			if($post->systeme == "imp"){
				$html_profondeur415_bois_blc	= array('16 1/2','18"','19 1/2"','21"','22 1/2"','24"');
			}else{
				$html_profondeur415_bois_blc	= array('418 mm','456 mm','494 mm','532 mm','570 mm','608 mm');
			}
			$html_profondeur415_bois_blc_value	= array('418','456','494','532','570','608');

			// 465
			if($post->systeme == "imp"){
				$html_profondeur465_bois_blc	= array('19 1/2"','21"','22 1/2"','24"');
			}else{
				$html_profondeur465_bois_blc	= array('494 mm','532 mm','570 mm','608 mm');
			}
			$html_profondeur465_bois_blc_value	= array('494','532','570','608');

			// 515
			if($post->systeme == "imp"){
				$html_profondeur515_bois_blc	= array('21"','22 1/2"','24"');
			}else{
				$html_profondeur515_bois_blc	= array('532 mm','570 mm','608 mm');
			}
			$html_profondeur515_bois_blc_value	= array('532','570','608');

	// BOIS BLC NORDIC

		// VARIABLES MENU SELECT CLASSE
		$html_classe_bois_blc_nordic=array(
			'24F-ES/NPG'
			//'ES11',
			//'ES12',
			//'20F-1.6E',
			//'24F-1.9E'
		);

		// VALEURS ASSOCCIES
		$html_classe_bois_blc_nordic_value=array(
			//'es_11',
			//'es_12',
			//'20f',
			'24f'
		);

		// VARIABLES MENU SELECT LARGEUR

		// VARIABLES MENU SELECT LARGEUR
		if($post->systeme == "imp"){
			$html_largeur_bois_blc_nordic=array('3 3/8"','5 3/8"','7 1/4"','9"','11"','12 7/8"');
		}else{
			$html_largeur_bois_blc_nordic=array('86 mm','137 mm','184 mm','228 mm','279 mm','327 mm');
		}

		// VALEURS ASSOCCIES
		$html_largeur_bois_blc_nordic_value=array('86','137','184','228','279','327');

		// VARIABLES MENU SELECT PROFONDEUR
		// VALEURS ASSOCCIES

			// 86
			if($post->systeme == "imp"){
				$html_profondeur86_bois_blc_nordic = array('5"','7"','8 3/4"','10 1/2"','12 1/2"','14 1/4"','16"','18"','19 3/4"','21 1/2"','23 1/2"');
			}else{
				$html_profondeur86_bois_blc_nordic = array('127 mm','178 mm','222 mm','267 mm','318 mm','362 mm','406 mm','457 mm','502 mm','546 mm','597 mm');
			}
			$html_profondeur86_bois_blc_nordic_value	= array('127','178','222','267','318','362','406','457','502','546','597');

			//137
			if($post->systeme == "imp"){
				$html_profondeur137_bois_blc_nordic = array('7"','8 3/4"','10 1/2"','12 1/2"','14 1/4"','16"','18"','19 3/4"','21 1/2"','23 1/2"');
			}else{
				$html_profondeur137_bois_blc_nordic = array('178 mm','222 mm','267 mm','318 mm','362 mm','406 mm','457 mm','502 mm','546 mm','597 mm');
			}
			$html_profondeur137_bois_blc_nordic_value	= array('178','222','267','318','362','406','457','502','546','597');

			// 184
			if($post->systeme == "imp"){
				$html_profondeur184_bois_blc_nordic = array('8 3/4"','10 1/2"','12 1/2"','14 1/4"','16"','18"','19 3/4"','21 1/2"','23 1/2"');
			}else{
				$html_profondeur184_bois_blc_nordic = array('222 mm','267 mm','318 mm','362 mm','406 mm','457 mm','502 mm','546 mm','597 mm');
			}
			$html_profondeur184_bois_blc_nordic_value	= array('222','267','318','362','406','457','502','546','597');

			// 228
			if($post->systeme == "imp"){
				$html_profondeur228_bois_blc_nordic = array('10 1/2"','12 1/2"','14 1/4"','16"','18"','19 3/4"','21 1/2"','23 1/2"');
			}else{
				$html_profondeur228_bois_blc_nordic = array('267 mm','318 mm','362 mm','406 mm','457 mm','502 mm','546 mm','597 mm');
			}
			$html_profondeur228_bois_blc_nordic_value	= array('267','318','362','406','457','502','546','597');

			// 279
			if($post->systeme == "imp"){
				$html_profondeur279_bois_blc_nordic = array('12 1/2"','14 1/4"','16"','18"','19 3/4"','21 1/2"','23 1/2"');
			}else{
				$html_profondeur279_bois_blc_nordic = array('318 mm','362 mm','406 mm','457 mm','502 mm','546 mm','597 mm');
			}
			$html_profondeur279_bois_blc_nordic_value	= array('318','362','406','457','502','546','597');

			// 327
			if($post->systeme == "imp"){
				$html_profondeur327_bois_blc_nordic = array('14 1/4"','16"','18"','19 3/4"','21 1/2"','23 1/2"');
			}else{
				$html_profondeur327_bois_blc_nordic = array('362 mm','406 mm','457 mm','502 mm','546 mm','597 mm');
			}
			$html_profondeur327_bois_blc_nordic_value	= array('362','406','457','502','546','597');


	// BOIS MASSIF

		// VARIABLES MENU SELECT ESSENCE
		$html_essence_bois_massif=array(
			'D-M',
			'P-S',
			'E-P-S',
			'Nordique'
		);

		// VALEURS ASSOCCIES
		$html_essence_bois_massif_value=array(
			'D-M',
			'P-S',
			'E-P-S',
			'Nordique'
		);

		// VARIABLES MENU SELECT CLASSE
		$html_classe_bois_massif=array(
			'SS',
			'n&deg;1',
			'n&deg;2'
		);

		// VALEURS ASSOCCIES
		$html_classe_bois_massif_value=array(
			'ss',
			'n1',
			'n2'
		);

		// VARIABLES MENU SELECT LARGEUR
		if($post->systeme == "imp"){
			$html_largeur1_bois_massif=array('5 1/2"','7 1/2"','9 1/2"','11 1/2"');
			$html_largeur2_bois_massif=array('5 1/2"','7 1/2"','9 1/2"');
		}else{
			$html_largeur1_bois_massif=array('140 mm','191 mm','241 mm','292 mm');
			$html_largeur2_bois_massif=array('140 mm','191 mm','241 mm');
		}

		// VALEURS ASSOCCIES
		$html_largeur1_bois_massif_value=array('140','191','241','292');
		$html_largeur2_bois_massif_value=array('140','191','241');
		// VARIABLES MENU SELECT PROFONDEUR
		// VALEURS ASSOCCIES

			// 140
			if($post->systeme == "imp"){
				$html_profondeur140_bois_massif		= array('5 1/2"','7 1/2"');
			}else{
				$html_profondeur140_bois_massif		= array('140 mm','191 mm');
			}
			$html_profondeur140_bois_massif_value	= array('140','191');

			// 191
			if($post->systeme == "imp"){
				$html_profondeur191_bois_massif		= array('7 1/2"','9 1/2"');
			}else{
				$html_profondeur191_bois_massif		= array('191 mm','241 mm');
			}
			$html_profondeur191_bois_massif_value	= array('191','241');

			// 241
			if($post->systeme == "imp"){
				$html_profondeur241_bois_massif		= array('9 1/2"','11 1/2"');
			}else{
				$html_profondeur241_bois_massif		= array('241 mm','292 mm');
			}
			$html_profondeur241_bois_massif_value	= array('241','292');

			// 292
			if($post->systeme == "imp"){
				$html_profondeur292_bois_massif		= array('11 1/2"');
			}else{
				$html_profondeur292_bois_massif		= array('292 mm');
			}
			$html_profondeur292_bois_massif_value	= array('292');

			// 140
			if($post->systeme == "imp"){
				$html_profondeur140_2_bois_massif	= array('5 1/2"','7 1/2"');
			}else{
				$html_profondeur140_2_bois_massif	= array('140 mm','191 mm');
			}
			$html_profondeur140_2_bois_massif_value	= array('140','191');

			// 191
			if($post->systeme == "imp"){
				$html_profondeur191_2_bois_massif	= array('7 1/2"','9 1/2"');
			}else{
				$html_profondeur191_2_bois_massif	= array('191 mm','241 mm');
			}
			$html_profondeur191_2_bois_massif_value	= array('191','241');

			// 241
			if($post->systeme == "imp"){
				$html_profondeur241_2_bois_massif	= array('9 1/2"');
			}else{
				$html_profondeur241_2_bois_massif	= array('241 mm');
			}
			$html_profondeur241_2_bois_massif_value	= array('241');


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

	// VARIABLES MENU SELECT ESPACEMENT
	$html_coef_longueur_efficace=array(
		'0,65',
		'0,80',
		'1,00',
		'1,20',
		'1,50',
		'2,00'
	);

	// VALEURS ASSOCCIES
	$html_coef_longueur_efficace_value=array(
		'0.65',
		'0.80',
		'1.00',
		'1.20',
		'1.50',
		'2.00'
	);

	// VARIABLES MENU SELECT CATGORIE DE RISQUE
	$html_axe_faible=array(
		__d( 'cecobois', 'Sur toute la hauteur' ),
		__d( 'cecobois', 'À la mi-hauteur' ),
		__d( 'cecobois', 'Non retenu' )
	);

	// VALEURS ASSOCCIES
	$html_axe_faible_value=array(
		'oui',
		'mi-hauteur',
		'non'
	);

	// VARIABLES MENU SELECT EDITION CODE NATIONAL BATIMENT
	$html_edition_code=array(
		__d( 'cecobois', 'CNB 2010' ),
		__d( 'cecobois', 'CNB 2015' )
	);

	// VALEURS ASSOCCIES
	$html_edition_code_value=array(
		'2010',
		'2015'
	);

		// VARIABLES MENU SELECT EDITION NORME CSA 086
	$html_edition_norme=array(
		__d( 'cecobois', 'CSA O86-09' ),
		__d( 'cecobois', 'CSA O86-14' )
	);

	// VALEURS ASSOCCIES
	$html_edition_norme_value=array(
		'09',
		'14'
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

	$html_systeme_js 							= ' onclick="changeSysteme(0,\'\');"';
	$html_type_bois_js							= ' onchange="aff_select_type_bois(this,\'bois_sciage\',\'bois_scl\',\'bois_blc\',\'bois_blc_nordic\',\'bois_massif\');"';
	$html_classe_bois_sciage_js					= ' onchange="aff_select_bois_sciage(this,\'colonnes_bois_sciage\',\'colonnes_bois_sciage2\',\'colonnes_bois_sciage3\',\'colonnes_bois_sciage4\');"';
		$html_colonnes_bois_sciage_js			= '';
		$html_colonnes_bois_sciage2_js			= '';
		$html_colonnes_bois_sciage3_js			= '';
		$html_colonnes_bois_sciage4_js			= '';
		$html_plis_bois_sciage_js				= ' onchange="aff_select_attache_bois_sciage(this);"';
		$html_attache_bois_sciage_js			= '';
	$html_classe_bois_scl_js					= '';
		$html_largeur_bois_scl_js				= ' onchange="aff_select_profondeur_scl(this);"';
			$html_profondeur45_bois_scl_js		= '';
			$html_profondeur89_bois_scl_js		= '';
			$html_profondeur134_bois_scl_js		= '';
			$html_profondeur178_bois_scl_js		= '';
		$html_plis_bois_scl_js					= ' onchange="aff_select_attache_bois_scl(this);"';
		$html_attache_bois_scl_js				= '';
	$html_classe_bois_blc_js					= '';
		$html_largeur_bois_blc_js				= ' onchange="aff_select_profondeur_blc(this);"';
			$html_profondeur80_bois_blc_js		= '';
			$html_profondeur105_bois_blc_js		= '';
			$html_profondeur130_bois_blc_js		= '';
			$html_profondeur175_bois_blc_js		= '';
			$html_profondeur215_bois_blc_js		= '';
			$html_profondeur225_bois_blc_js		= '';
			$html_profondeur265_bois_blc_js		= '';
			$html_profondeur275_bois_blc_js		= '';
			$html_profondeur315_bois_blc_js		= '';
			$html_profondeur365_bois_blc_js		= '';
			$html_profondeur415_bois_blc_js		= '';
			$html_profondeur465_bois_blc_js		= '';
			$html_profondeur515_bois_blc_js		= '';
	$html_classe_bois_blc_nordic_js				= '';
		$html_largeur_bois_blc_nordic_js		= ' onchange="aff_select_profondeur_blc_nordic(this);"';
			$html_profondeur86_bois_blc_nordic_js		= '';
			$html_profondeur137_bois_blc_nordic_js		= '';
			$html_profondeur184_bois_blc_nordic_js		= '';
			$html_profondeur228_bois_blc_nordic_js		= '';
			$html_profondeur279_bois_blc_nordic_js		= '';
			$html_profondeur327_bois_blc_nordic_js		= '';
	$html_essence_bois_massif_js					= ' onchange="aff_select_essence_bois_massif(this);"';
		$html_largeur1_bois_massif_js				= ' onchange="aff_select_profondeur_bois_massif(this,1);"';
		$html_largeur2_bois_massif_js				= ' onchange="aff_select_profondeur_bois_massif(this,2);"';
			$html_profondeur140_bois_massif_js		= '';
			$html_profondeur191_bois_massif_js		= '';
			$html_profondeur241_bois_massif_js		= '';
			$html_profondeur292_bois_massif_js		= '';
			$html_profondeur140_2_bois_massif_js	= '';
			$html_profondeur191_2_bois_massif_js	= '';
			$html_profondeur241_2_bois_massif_js	= '';
		$html_classe_bois_massif_js					= '';

	$html_cat_risque_js							= '';
	$html_fleche_surcharge_js					= '';
	$html_charge_totale_js						= '';
	$html_traitement_js							= '';
	$html_utilisation_js						= '';

	$html_hauteur_js							= '';
	$html_coef_longueur_efficace_js				= '';
	$html_axe_faible_js							= '';
	$html_edition_code_js						= '';
	$html_edition_norme_js						= '';
	$html_ax_neige_js							= '';
	$html_ax_surcharge_js						= '';
	$html_ax_permanente_js						= '';
	$html_ax_excentricite_js					= '';
	$html_lat_vent_js							= '';

	if($post->action=="send"){
		/*$html_systeme_js 					= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_type_bois_js					= ' onclick="confirm_cache_form();"';
		$html_classe_bois_sciage_js			= ' onclick="confirm_cache_form();"';
			$html_colonnes_bois_sciage_js	= ' onclick="confirm_cache_form();"';
			$html_colonnes_bois_sciage2_js	= ' onclick="confirm_cache_form();"';
			$html_colonnes_bois_sciage3_js	= ' onclick="confirm_cache_form();"';
			$html_colonnes_bois_sciage4_js	= ' onclick="confirm_cache_form();"';
			$html_plis_bois_sciage_js		= ' onclick="confirm_cache_form();"';
			$html_attache_bois_sciage_js	= ' onclick="confirm_cache_form();"';
		$html_classe_bois_scl_js			= ' onclick="confirm_cache_form();"';
			$html_largeur_bois_scl_js		= ' onclick="confirm_cache_form();"';
			$html_profondeur45_bois_scl_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur89_bois_scl_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur134_bois_scl_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur178_bois_scl_js	= ' onclick="confirm_cache_form();"';
			$html_plis_bois_scl_js			= ' onclick="confirm_cache_form();"';
			$html_attache_bois_scl_js		= ' onclick="confirm_cache_form();"';
		$html_classe_bois_blc_js			= ' onclick="confirm_cache_form();"';
			$html_largeur_bois_blc_js		= ' onclick="confirm_cache_form();"';
			$html_profondeur80_bois_blc_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur105_bois_blc_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur130_bois_blc_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur175_bois_blc_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur215_bois_blc_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur225_bois_blc_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur265_bois_blc_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur275_bois_blc_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur315_bois_blc_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur365_bois_blc_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur415_bois_blc_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur465_bois_blc_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur515_bois_blc_js	= ' onclick="confirm_cache_form();"';
		$html_classe_bois_blc_nordic_js		= ' onclick="confirm_cache_form();"';
			$html_largeur_bois_blc_nordic_js= ' onclick="confirm_cache_form();"';
			$html_profondeur86_bois_blc_nordic_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur137_bois_blc_nordic_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur184_bois_blc_nordic_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur228_bois_blc_nordic_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur279_bois_blc_nordic_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur327_bois_blc_nordic_js	= ' onclick="confirm_cache_form();"';
		$html_essence_bois_massif_js			= ' onclick="confirm_cache_form();"';
			$html_classe_bois_massif_js			= ' onclick="confirm_cache_form();"';
			$html_largeur1_bois_massif_js		= ' onclick="confirm_cache_form();"';
			$html_largeur2_bois_massif_js		= ' onclick="confirm_cache_form();"';
			$html_profondeur140_bois_massif_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur191_bois_massif_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur241_bois_massif_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur292_bois_massif_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur140_2_bois_massif_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur191_2_bois_massif_js	= ' onclick="confirm_cache_form();"';
			$html_profondeur241_2_bois_massif_js	= ' onclick="confirm_cache_form();"';

		$html_coef_longueur_efficace_js		= ' onclick="confirm_cache_form();"';
		$html_cat_risque_js					= ' onclick="confirm_cache_form();"';
		$html_axe_faible_js					= ' onclick="confirm_cache_form();"';
		$html_edition_code_js				= ' onclick="confirm_cache_form();"';
		$html_edition_norme_js				= ' onclick="confirm_cache_form();"';
		$html_fleche_surcharge_js			= ' onclick="confirm_cache_form();"';
		$html_charge_totale_js				= ' onclick="confirm_cache_form();"';
		$html_traitement_js					= ' onclick="confirm_cache_form();"';
		$html_utilisation_js				= ' onclick="confirm_cache_form();"';

		$html_hauteur_js					= ' onfocus="confirm_cache_form();"';
		$html_coef_longueur_efficace_js		= ' onclick="confirm_cache_form();"';
		$html_ax_neige_js					= ' onfocus="confirm_cache_form();"';
		$html_ax_surcharge_js				= ' onfocus="confirm_cache_form();"';
		$html_ax_permanente_js				= ' onfocus="confirm_cache_form();"';
		$html_ax_excentricite_js			= ' onfocus="confirm_cache_form();"';
		$html_lat_vent_js					= ' onfocus="confirm_cache_form();"';*/
	}

	//modification d'affichage de colonnes en fonction de la classe choisie.

	$html_colonnes_bois_sciage_style		= ' style="display:none;"';
	$html_colonnes_bois_sciage_style2		= ' style="display:none;"';
	$html_colonnes_bois_sciage_style3		= ' style="display:none;"';
	$html_colonnes_bois_sciage_style4		= ' style="display:none;"';



	if($post->action == 'print'){

		if($post->classe_bois_sciage=='msr1950'){

			$post->colonnes_bois_sciage		= '';
			$post->colonnes_bois_sciage2	= '';
			$post->colonnes_bois_sciage4	= '';

			$html_colonnes_bois_sciage_style3		= '';


		}elseif($post->classe_bois_sciage=='msr2400'){

			$post->colonnes_bois_sciage		= '';
			$post->colonnes_bois_sciage2	= '';
			$post->colonnes_bois_sciage3	= '';

			$html_colonnes_bois_sciage_style4		= '';

		}elseif(substr($post->classe_bois_sciage,0,3)=='msr'){

			$post->colonnes_bois_sciage = '';
			$post->colonnes_bois_sciage3 = '';
			$post->colonnes_bois_sciage4 = '';

			$html_colonnes_bois_sciage_style3		= '';

		}else{
			$post->colonnes_bois_sciage2 = '';
			$post->colonnes_bois_sciage3 = '';
			$post->colonnes_bois_sciage4 = '';

			$html_colonnes_bois_sciage_style		= '';
		}

	}else{

		if($post->classe_bois_sciage=='msr1950'){

			$post->colonnes_bois_sciage = $post->colonnes_bois_sciage3;
			$html_colonnes_bois_sciage_style3='';

		}elseif($post->classe_bois_sciage=='msr2400'){

			$post->colonnes_bois_sciage = $post->colonnes_bois_sciage4;
			$html_colonnes_bois_sciage_style4='';

		}elseif(substr($post->classe_bois_sciage,0,3)=='msr'){

			$post->colonnes_bois_sciage = $post->colonnes_bois_sciage2;
			$html_colonnes_bois_sciage_style2='';

		}else{
			$html_colonnes_bois_sciage_style='';
		}
	}

	$html_colonnes_bois_sciage_style	.= ' id="colonnes_bois_sciage"';
	$html_colonnes_bois_sciage_style2	.= ' id="colonnes_bois_sciage2"';
	$html_colonnes_bois_sciage_style3	.= ' id="colonnes_bois_sciage3"';
	$html_colonnes_bois_sciage_style4	.= ' id="colonnes_bois_sciage4"';


	$html_classe_bois_sciage_style		= ' style="display:none;"';
	$html_classe_bois_scl_style			= ' style="display:none;"';
	$html_classe_bois_blc_style			= ' style="display:none;"';
	$html_classe_bois_blc_nordic_style	= ' style="display:none;"';

	$html_profondeur45_bois_scl_style	= ' style="display:none;"';
	$html_profondeur89_bois_scl_style	= ' style="display:none;"';
	$html_profondeur134_bois_scl_style	= ' style="display:none;"';
	$html_profondeur178_bois_scl_style	= ' style="display:none;"';


	$html_profondeur80_bois_blc_style 	= ' style="display:none;"';
	$html_profondeur105_bois_blc_style 	= ' style="display:none;"';
	$html_profondeur130_bois_blc_style 	= ' style="display:none;"';
	$html_profondeur175_bois_blc_style 	= ' style="display:none;"';
	$html_profondeur215_bois_blc_style 	= ' style="display:none;"';
	$html_profondeur225_bois_blc_style 	= ' style="display:none;"';
	$html_profondeur265_bois_blc_style 	= ' style="display:none;"';
	$html_profondeur275_bois_blc_style 	= ' style="display:none;"';
	$html_profondeur315_bois_blc_style 	= ' style="display:none;"';
	$html_profondeur365_bois_blc_style 	= ' style="display:none;"';
	$html_profondeur415_bois_blc_style 	= ' style="display:none;"';
	$html_profondeur465_bois_blc_style 	= ' style="display:none;"';
	$html_profondeur515_bois_blc_style 	= ' style="display:none;"';

	$html_profondeur86_bois_blc_nordic_style 	= ' style="display:none;"';
	$html_profondeur137_bois_blc_nordic_style 	= ' style="display:none;"';
	$html_profondeur184_bois_blc_nordic_style 	= ' style="display:none;"';
	$html_profondeur228_bois_blc_nordic_style 	= ' style="display:none;"';
	$html_profondeur279_bois_blc_nordic_style 	= ' style="display:none;"';
	$html_profondeur327_bois_blc_nordic_style 	= ' style="display:none;"';

	$html_classe_bois_massif_style			= ' style="display:none;"';
	$html_essence_bois_massif_style			= ' style="display:none;"';
	$html_largeur1_bois_massif_style		= ' style="display:none;"';
	$html_largeur2_bois_massif_style		= ' style="display:none;"';
	$html_profondeur140_bois_massif_style	= ' style="display:none;"';
	$html_profondeur191_bois_massif_style	= ' style="display:none;"';
	$html_profondeur241_bois_massif_style	= ' style="display:none;"';
	$html_profondeur292_bois_massif_style	= ' style="display:none;"';
	$html_profondeur140_2_bois_massif_style	= ' style="display:none;"';
	$html_profondeur191_2_bois_massif_style	= ' style="display:none;"';
	$html_profondeur241_2_bois_massif_style	= ' style="display:none;"';

	$html_plis_bois_scl_style			= ' style="display:none;"';

	$html_attache_bois_sciage_style		= '';
	$html_attache_bois_scl_style		= ' style="display:none;"';




	//par defaut si post nest pas dfini
	$post->systeme					= $post->systeme !='' 					? $post->systeme 				: 'met';
	$post->type_bois				= $post->type_bois !=''					? $post->type_bois				: 'bois_sciage';
	$post->classe_bois_sciage		= $post->classe_bois_sciage !='' 		? $post->classe_bois_sciage		: 'eps_no1_2';
	$post->colonnes_bois_sciage 	= $post->colonnes_bois_sciage !=''		? $post->colonnes_bois_sciage 	: '2x6';
	$post->plis_bois_sciage			= $post->plis_bois_sciage !=''			? $post->plis_bois_sciage		: '1';
	$post->attache_bois_sciage		= $post->attache_bois_sciage !=''		? $post->attache_bois_sciage	: 'cloue';

	$post->classe_bois_scl			= $post->classe_bois_scl !=''			? $post->classe_bois_scl		: '1_7';
	$post->largeur_bois_scl			= $post->largeur_bois_scl !=''			? $post->largeur_bois_scl		: '45';
	$post->profondeur45_bois_scl	= $post->profondeur45_bois_scl !=''		? $post->profondeur45_bois_scl	: '89';
	$post->profondeur89_bois_scl	= $post->profondeur89_bois_scl !=''		? $post->profondeur89_bois_scl	: '89';
	$post->profondeur134_bois_scl	= $post->profondeur134_bois_scl !=''	? $post->profondeur134_bois_scl	: '134';
	$post->profondeur178_bois_scl	= $post->profondeur178_bois_scl !=''	? $post->profondeur178_bois_scl	: '178';
	$post->plis_bois_scl			= $post->plis_bois_scl !=''				? $post->plis_bois_scl			: '1';
	$post->attache_bois_scl			= $post->attache_bois_scl !=''			? $post->attache_bois_scl		: 'cloue';

	$post->classe_bois_blc			= $post->classe_bois_blc !=''			? $post->classe_bois_blc		: 'ep_12c';
	$post->largeur_bois_blc			= $post->largeur_bois_blc !=''			? $post->largeur_bois_blc		: '80';
	$post->profondeur80_bois_blc	= $post->profondeur80_bois_blc !=''		? $post->profondeur80_bois_blc	: '114';
	$post->profondeur105_bois_blc	= $post->profondeur105_bois_blc !=''	? $post->profondeur105_bois_blc	: '114';
	$post->profondeur130_bois_blc	= $post->profondeur130_bois_blc !=''	? $post->profondeur130_bois_blc	: '152';
	$post->profondeur175_bois_blc	= $post->profondeur175_bois_blc !=''	? $post->profondeur175_bois_blc	: '190';
	$post->profondeur215_bois_blc	= $post->profondeur215_bois_blc !=''	? $post->profondeur215_bois_blc	: '226';
	$post->profondeur225_bois_blc	= $post->profondeur225_bois_blc !=''	? $post->profondeur225_bois_blc	: '304';
	$post->profondeur265_bois_blc	= $post->profondeur265_bois_blc !=''	? $post->profondeur265_bois_blc	: '342';
	$post->profondeur275_bois_blc	= $post->profondeur275_bois_blc !=''	? $post->profondeur275_bois_blc	: '380';
	$post->profondeur315_bois_blc	= $post->profondeur315_bois_blc !=''	? $post->profondeur315_bois_blc	: '380';
	$post->profondeur365_bois_blc	= $post->profondeur365_bois_blc !=''	? $post->profondeur365_bois_blc	: '380';
	$post->profondeur415_bois_blc	= $post->profondeur415_bois_blc !=''	? $post->profondeur415_bois_blc	: '418';
	$post->profondeur465_bois_blc	= $post->profondeur465_bois_blc !=''	? $post->profondeur465_bois_blc	: '494';
	$post->profondeur515_bois_blc	= $post->profondeur515_bois_blc !=''	? $post->profondeur515_bois_blc	: '532';

	$post->classe_bois_blc_nordic			= $post->classe_bois_blc_nordic !=''		? $post->classe_bois_blc_nordic			: 'es_11';
	$post->largeur_bois_blc_nordic			= $post->largeur_bois_blc_nordic !=''		? $post->largeur_bois_blc_nordic		: 'es_12';
	$post->profondeur86_bois_blc_nordic		= $post->profondeur86_bois_blc_nordic !=''	? $post->profondeur86_bois_blc_nordic	: '127';
	$post->profondeur137_bois_blc_nordic	= $post->profondeur137_bois_blc_nordic !=''	? $post->profondeur137_bois_blc_nordic	: '178';
	$post->profondeur184_bois_blc_nordic	= $post->profondeur184_bois_blc_nordic !=''	? $post->profondeur184_bois_blc_nordic	: '222';
	$post->profondeur228_bois_blc_nordic	= $post->profondeur228_bois_blc_nordic !=''	? $post->profondeur228_bois_blc_nordic	: '267';
	$post->profondeur279_bois_blc_nordic	= $post->profondeur279_bois_blc_nordic !=''	? $post->profondeur279_bois_blc_nordic	: '318';
	$post->profondeur327_bois_blc_nordic	= $post->profondeur327_bois_blc_nordic !=''	? $post->profondeur327_bois_blc_nordic	: '362';

	$post->essence_bois_massif			= $post->essence_bois_massif !=''		? $post->essence_bois_massif		: 'D-M';
	$post->classe_bois_massif			= $post->classe_bois_massif !=''		? $post->classe_bois_massif			: 'ss';
	$post->largeur1_bois_massif			= $post->largeur1_bois_massif !=''		? $post->largeur1_bois_massif		: '140';
	$post->largeur2_bois_massif			= $post->largeur2_bois_massif !=''		? $post->largeur2_bois_massif		: '140';
	$post->profondeur140_bois_massif	= $post->profondeur140_bois_massif !=''	? $post->profondeur140_bois_massif	: '140';
	$post->profondeur191_bois_massif	= $post->profondeur191_bois_massif !=''	? $post->profondeur191_bois_massif	: '191';
	$post->profondeur241_bois_massif	= $post->profondeur241_bois_massif !=''	? $post->profondeur241_bois_massif	: '241';
	$post->profondeur292_bois_massif	= $post->profondeur292_bois_massif !=''	? $post->profondeur292_bois_massif	: '292';
	$post->profondeur140_2_bois_massif	= $post->profondeur140_2_bois_massif !=''	? $post->profondeur140_2_bois_massif	: '140';
	$post->profondeur191_2_bois_massif	= $post->profondeur191_2_bois_massif !=''	? $post->profondeur191_2_bois_massif	: '191';
	$post->profondeur241_2_bois_massif	= $post->profondeur241_2_bois_massif !=''	? $post->profondeur241_2_bois_massif	: '241';

	$post->coef_longueur_efficace	= $post->coef_longueur_efficace !=''	? $post->coef_longueur_efficace : '1.00';
	$post->axe_faible				= $post->axe_faible !=''				? $post->axe_faible				: 'oui';
	$post->edition_code				= $post->edition_code !=''				? $post->edition_code			: '2010';
	$post->edition_norme			= $post->edition_norme !=''				? $post->edition_norme			: '09';
	$post->cat_risque 				= $post->cat_risque != ''				? $post->cat_risque 			: 'normale';
	$post->fleche_surcharge			= $post->fleche_surcharge !=''			? $post->fleche_surcharge		: '180';
	$post->fleche_charge_totale		= $post->fleche_charge_totale !=''		? $post->fleche_charge_totale	: '180';

	if($post->plis_bois_sciage==1){
		$html_attache_bois_sciage_style		= ' style="display:none;"';
	}

	if($post->type_bois == "bois_sciage"){

		$html_classe_bois_sciage_style = '';

	}else if($post->type_bois == "bois_scl"){

		$html_classe_bois_scl_style = '';

		$post->largeur = $post->largeur_bois_scl;
		if($post->plis_bois_scl <> '1')
		{
			$html_attache_bois_scl_style		= '';
		}
		if($post->largeur_bois_scl=='45'){

			$post->profondeur_bois_scl 			= $post->profondeur45_bois_scl;
			$html_profondeur45_bois_scl_style	= '';
			$html_plis_bois_scl_style			= '';

		}elseif($post->largeur_bois_scl=='89'){

			$post->profondeur_bois_scl 			= $post->profondeur89_bois_scl;
			$html_profondeur89_bois_scl_style	= '';

		}elseif($post->largeur_bois_scl=='134'){

			$post->profondeur_bois_scl 			= $post->profondeur134_bois_scl;
			$html_profondeur134_bois_scl_style	= '';

		}elseif($post->largeur_bois_scl=='178'){

			$post->profondeur_bois_scl 			= $post->profondeur178_bois_scl;
			$html_profondeur178_bois_scl_style	= '';
		}

	}else if($post->type_bois == "bois_blc"){

		$html_classe_bois_blc_style 			= '';
		$post->largeur 							= $post->largeur_bois_blc;

		if($post->largeur_bois_blc=='80'){

			$post->profondeur_bois_blc			= $post->profondeur80_bois_blc;
			$html_profondeur80_bois_blc_style	= '';

		}elseif($post->largeur_bois_blc=='105'){

			$post->profondeur_bois_blc 			= $post->profondeur105_bois_blc;
			$html_profondeur105_bois_blc_style	= '';

		}elseif($post->largeur_bois_blc=='130'){

			$post->profondeur_bois_blc 			= $post->profondeur130_bois_blc;
			$html_profondeur130_bois_blc_style	= '';

		}elseif($post->largeur_bois_blc=='175'){

			$post->profondeur_bois_blc 			= $post->profondeur175_bois_blc;
			$html_profondeur175_bois_blc_style	= '';

		}elseif($post->largeur_bois_blc=='215'){

			$post->profondeur_bois_blc 			= $post->profondeur215_bois_blc;
			$html_profondeur215_bois_blc_style	= '';

		}elseif($post->largeur_bois_blc=='225'){

			$post->profondeur_bois_blc 			= $post->profondeur225_bois_blc;
			$html_profondeur225_bois_blc_style	= '';

		}elseif($post->largeur_bois_blc=='265'){

			$post->profondeur_bois_blc 			= $post->profondeur265_bois_blc;
			$html_profondeur265_bois_blc_style	= '';

		}elseif($post->largeur_bois_blc=='275'){

			$post->profondeur_bois_blc			= $post->profondeur275_bois_blc;
			$html_profondeur275_bois_blc_style	= '';

		}elseif($post->largeur_bois_blc=='315'){

			$post->profondeur_bois_blc			= $post->profondeur315_bois_blc;
			$html_profondeur315_bois_blc_style	= '';

		}elseif($post->largeur_bois_blc=='365'){

			$post->profondeur_bois_blc			= $post->profondeur365_bois_blc;
			$html_profondeur365_bois_blc_style	= '';

		}elseif($post->largeur_bois_blc=='415'){

			$post->profondeur_bois_blc 			= $post->profondeur415_bois_blc;
			$html_profondeur415_bois_blc_style	= '';

		}elseif($post->largeur_bois_blc=='465'){

			$post->profondeur_bois_blc 			= $post->profondeur465_bois_blc;
			$html_profondeur465_bois_blc_style	= '';

		}elseif($post->largeur_bois_blc=='515'){

			$post->profondeur_bois_blc 			= $post->profondeur515_bois_blc;
			$html_profondeur515_bois_blc_style	= '';
		}

	}else if($post->type_bois == "bois_blc_nordic"){

		$html_classe_bois_blc_nordic_style 			= '';
		$post->largeur 							= $post->largeur_bois_blc_nordic;

		if($post->largeur_bois_blc_nordic=='86'){

			$post->profondeur_bois_blc_nordic			= $post->profondeur86_bois_blc_nordic;
			$html_profondeur86_bois_blc_nordic_style	= '';

		}elseif($post->largeur_bois_blc_nordic=='137'){

			$post->profondeur_bois_blc_nordic 			= $post->profondeur137_bois_blc_nordic;
			$html_profondeur137_bois_blc_nordic_style	= '';

		}elseif($post->largeur_bois_blc_nordic=='184'){

			$post->profondeur_bois_blc_nordic 			= $post->profondeur184_bois_blc_nordic;
			$html_profondeur184_bois_blc_nordic_style	= '';

		}elseif($post->largeur_bois_blc_nordic=='228'){

			$post->profondeur_bois_blc_nordic 			= $post->profondeur228_bois_blc_nordic;
			$html_profondeur228_bois_blc_nordic_style	= '';

		}elseif($post->largeur_bois_blc_nordic=='279'){

			$post->profondeur_bois_blc_nordic 			= $post->profondeur279_bois_blc_nordic;
			$html_profondeur279_bois_blc_nordic_style	= '';

		}elseif($post->largeur_bois_blc_nordic=='327'){

			$post->profondeur_bois_blc_nordic 			= $post->profondeur327_bois_blc_nordic;
			$html_profondeur327_bois_blc_nordic_style	= '';
		}
	}else if($post->type_bois == "bois_massif"){

		$html_classe_bois_massif_style 			= '';

		if($post->essence_bois_massif == 'D-M' || $post->essence_bois_massif == 'P-S'){
			$post->largeur 	= $post->largeur1_bois_massif;
			$html_largeur1_bois_massif_style = '';

			if($post->largeur=='140'){
				$post->profondeur_bois_massif			= $post->profondeur140_bois_massif;
				$html_profondeur140_bois_massif_style	= '';
			}elseif($post->largeur=='191'){
				$post->profondeur_bois_massif 			= $post->profondeur191_bois_massif;
				$html_profondeur191_bois_massif_style	= '';
			}elseif($post->largeur=='241'){
				$post->profondeur_bois_massif 			= $post->profondeur241_bois_massif;
				$html_profondeur241_bois_massif_style	= '';
			}elseif($post->largeur=='292'){
				$post->profondeur_bois_massif 			= $post->profondeur292_bois_massif;
				$html_profondeur292_bois_massif_style	= '';
			}
		}else{

			$post->largeur 	= $post->largeur2_bois_massif;
			$html_largeur2_bois_massif_style = '';

			if($post->largeur=='140'){
				$post->profondeur_bois_massif			= $post->profondeur140_2_bois_massif;
				$html_profondeur140_2_bois_massif_style	= '';
			}elseif($post->largeur=='191'){
				$post->profondeur_bois_massif 			= $post->profondeur191_2_bois_massif;
				$html_profondeur191_2_bois_massif_style	= '';
			}elseif($post->largeur=='241'){
				$post->profondeur_bois_massif 			= $post->profondeur241_2_bois_massif;
				$html_profondeur241_2_bois_massif_style	= '';
			}
		}
	}
	//print_r($post);
	//Afficher ou cacher le dbugage
	//$show_debug=true;
	$show_debug=false;


?>
