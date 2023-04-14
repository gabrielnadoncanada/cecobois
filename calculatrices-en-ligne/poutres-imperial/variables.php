<?PHP

	//nom des variables textuelles

	define ('ERROR_TYPE_POUTRE_VIDE', __d( 'cecobois', 'Vous devez sélectionner un type de poutre.' ) );

	define ('ERROR_PORTEE_NOMBRE', __d( 'cecobois', 'La portée entrée n\'est pas un nombre.' ) );
	define ('ERROR_PORTEE_BIGGER', __d( 'cecobois', 'La portée entrée est trop grande. Le maximum autorisé est de 4,88m (16\').' ) );
	define ('ERROR_PORTEE_SMALLER', __d( 'cecobois', 'La portée entrée est trop petite. Le minimum autorisé est de 1m (3.281\').' ) );

	define ('ERROR_SURCHARGE_NOMBRE', __d( 'cecobois', 'La surcharge entrée n\'est pas un nombre.' ) );
	define ('ERROR_SURCHARGE_BIGGER', __d( 'cecobois', 'La surcharge entrée est trop grande. Le maximum autorisé est de 10 kN/m (685.21 lb/pi).' ) );
	define ('ERROR_SURCHARGE_SMALLER', __d( 'cecobois', 'La surcharge entrée est trop petite. Le minimum autorisé est de 0kN/m (0 lb/pi).' ) );

	define ('ERROR_MORTE_NOMBRE', __d( 'cecobois', 'La charge permanente entrée n\'est pas un nombre.' ) );
	define ('ERROR_MORTE_BIGGER', __d( 'cecobois', 'La charge permanente entrée est trop grande. Le maximum autorisé est de 10 kN/m(685.21 lb/pi).' ) );
	define ('ERROR_MORTE_SMALLER', __d( 'cecobois', 'La charge permanente entrée est trop petite. Le minimum autorisé est de 0,1kN/m (6.86 lb/pi).' ) );
	
	define ('ERROR_CB_BIGGER', __d( 'cecobois', 'L\'élancement est plus grand que 50. (CB)' ) );
	define ('ERROR_INTERVALLES', __d( 'cecobois', 'Entrer une longueur d’intervalle plus petite que la portée ou choisir une autre option de retenue latérale' ) );

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
		'profondeur215_bois_blc_nordic',
		'profondeur241_bois_blc_nordic',
		'profondeur292_bois_blc_nordic',

		'essence_bois_massif',
		'classe_bois_massif',
		'largeur1_bois_massif',
		'largeur2_bois_massif',
		'profondeur140_bois_massif',
		'profondeur191_bois_massif',
		'profondeur241_bois_massif',
		'profondeur292_bois_massif',
		'profondeur343_bois_massif',
		'profondeur394_bois_massif',
		'profondeur140_2_bois_massif',
		'profondeur191_2_bois_massif',
		'profondeur241_2_bois_massif',
		'profondeur292_2_bois_massif',
		'profondeur343_2_bois_massif',
		'profondeur394_2_bois_massif',

		'plis_bois_sciage',
		'plis_bois_scl',
		'attache_bois_sciage',
		'attache_bois_scl',
		'hauteur',
		'coef_longueur_efficace',
		'portee',
		'rive_comprimee_retenue',
		'edition_code',
		'edition_norme',
		'neige',
		'surcharge',
		'morte',
		'cat_risque',
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

	//vide session si pas la même calculatrice
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
		__d( 'cecobois', 'Nordic Lam' ),
		__d( 'cecobois', 'Bois massif' )
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
			__d( 'cecobois', 'EPS No1/No2' ),
			__d( 'cecobois', 'MSR 1650' ),
			__d( 'cecobois', 'MSR 1950' ),
			__d( 'cecobois', 'MSR 2100' ),
			__d( 'cecobois', 'MSR 2400' )
		);

		// VALEURS ASSOCCIES
		$html_classe_bois_sciage_value=array(
			'eps_no1_2',
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
				$html_profondeur45_bois_scl		= array('3 1/2"','5 1/2"','7 1/4"','9 1/4"','9 1/2"','11 1/4"','11 7/8"','12 1/2"','14"','16"','18"','18 3/4"','20"','22"','24"');
			}else{
				$html_profondeur45_bois_scl		= array('89 mm','140 mm','184 mm','235 mm','241 mm','286 mm','302 mm','318 mm','356 mm','406 mm','457 mm','476 mm','508 mm','559 mm','610 mm');
			}
			$html_profondeur45_bois_scl_value	= array('89','140','184','235','241','286','302','318','356','406','457','476','508','559','610');

			// 89
			if($post->systeme == "imp"){
				$html_profondeur89_bois_scl		= array('5 1/2"','7 1/4"','9 1/4"','9 1/2"','11 1/4"','11 7/8"','12 1/2"','14"','16"','18"','18 3/4"','20"','22"','24"');
			}else{
				$html_profondeur89_bois_scl		= array('140 mm','186 mm','235 mm','241 mm','286 mm','302 mm','318 mm','356 mm','406 mm','457 mm','476 mm','508 mm','559 mm','610 mm');
			}
			$html_profondeur89_bois_scl_value	= array('140','184','235','241','286','302','318','356','406','457','476','508','559','610');

			// 134
			if($post->systeme == "imp"){
				$html_profondeur134_bois_scl		= array('7 1/4"','9 1/4"','9 1/2"','11 1/4"','11 7/8"','12 1/2"','14"','16"','18"','18 3/4"','20"','22"','24"');
			}else{
				$html_profondeur134_bois_scl		= array('184 mm','235 mm','241 mm','286 mm','302 mm','318 mm','356 mm','406 mm','457 mm','476 mm','508 mm','559 mm','610 mm');
			}
			$html_profondeur134_bois_scl_value	= array('184','235','241','286','302','318','356','406','457','476','508','559','610');

			// 178
			if($post->systeme == "imp"){
				$html_profondeur178_bois_scl		= array('7 1/4"','9 1/4"','9 1/2"','11 1/4"','11 7/8"','12 1/2"','14"','16"','18"','18 3/4"','20"','22"','24"');
			}else{
				$html_profondeur178_bois_scl		= array('184 mm','235 mm','241 mm','286 mm','302 mm','318 mm','356 mm','406 mm','457 mm','476 mm','508 mm','559 mm','610 mm');
			}
			$html_profondeur178_bois_scl_value	= array('184','235','241','286','302','318','356','406','457','476','508','559','610');


	// BOIS BLC

		// VARIABLES MENU SELECT CLASSE
		$html_classe_bois_blc=array(
			//'EP 12c',
			'EP 20f-EX',
			//'DM 16c',
			'DM 20f-EX',
			'DM 24f-EX'
		);

		// VALEURS ASSOCCIES
		$html_classe_bois_blc_value=array(
			//'ep_12c',
			'ep_20fex',
			//'dm_16c',
			'dm_20fex',
			'dm_24fex'
		);

		// VARIABLES MENU SELECT LARGEUR
		if($post->systeme == "imp"){
			$html_largeur_bois_blc=array('3 1/8"','5 1/8"','6 7/8"','8 1/2"','10 3/8"','12 3/8"','14 3/8"');
		}else{
			$html_largeur_bois_blc=array('80 mm','130 mm','175 mm','215 mm','265 mm','315 mm','365 mm');
		}

		// VALEURS ASSOCCIES
		$html_largeur_bois_blc_value=array('80','130','175','215','265','315','365');

		// VARIABLES MENU SELECT PROFONDEUR
		// VALEURS ASSOCCIES

			// 80
			if($post->systeme == "imp"){
				$html_profondeur80_bois_blc		= array('4 1/2"','6 0"','7 1/2"','9 0"','10 1/2"','12 0"','13 1/2"','15 0"','16 1/2"','18 0"','19 1/2"','21 0"','22 1/2"');
			}else{
				$html_profondeur80_bois_blc		= array('114 mm','152 mm','190 mm','228 mm','266 mm','304 mm','342 mm','380 mm','418 mm','456 mm','494 mm','532 mm','570 mm');
			}
			$html_profondeur80_bois_blc_value	= array('114','152','190','228','266','304','342','380','418','456','494','532','570');

			// 130
			if($post->systeme == "imp"){
				$html_profondeur130_bois_blc	= array('6 0"','7 1/2"','9 0"','10 1/2"','12 0"','13 1/2"','15 0"','16 1/2"','18 0"','19 1/2"','21 0"','22 1/2"','23 7/8"','25 3/8"','26 7/8"','28 3/8"','29 7/8"','31 3/8"','32 7/8"','34 3/8"','35 7/8"','37 3/8"');
			}else{
				$html_profondeur130_bois_blc	= array('152 mm','190 mm','228 mm','266 mm','304 mm','342 mm','380 mm','418 mm','456 mm','494 mm','532 mm','570 mm','608 mm','646 mm','684 mm','722 mm','760 mm','798 mm','836 mm','874 mm','912 mm','950 mm');
			}
			$html_profondeur130_bois_blc_value	= array('152','190','228','266','304','342','380','418','456','494','532','570','608','646','684','722','760','798','836','874','912','950');

			// 175
			if($post->systeme == "imp"){
				$html_profondeur175_bois_blc	= array('7 1/2"','9 0"','10 1/2"','12 0"','13 1/2"','15 0"','16 1/2"','18 0"','19 1/2"','21 0"','22 1/2"','23 7/8"','25 3/8"','26 7/8"','28 3/8"','29 7/8"','31 3/8"','32 7/8"','34 3/8"','35 7/8"','37 3/8"','38 7/8"','40 3/8"','41 7/8"','43 3/8"','44 7/8"','46 3/8"','47 7/8"','49 3/8"');
			}else{
				$html_profondeur175_bois_blc	= array('190 mm','228 mm','266 mm','304 mm','342 mm','380 mm','418 mm','456 mm','494 mm','532 mm','570 mm','608 mm','646 mm','684 mm','722 mm','760 mm','798 mm','836 mm','874 mm','912 mm','950 mm','988 mm','1026 mm','1064 mm','1102 mm','1140 mm','1178 mm','1216 mm','1254 mm');
			}
			$html_profondeur175_bois_blc_value	= array('190','228','266','304','342','380','418','456','494','532','570','608','646','684','722','760','798','836','874','912','950','988','1026','1064','1102','1140','1178','1216','1254');

			// 215
			if($post->systeme == "imp"){
				$html_profondeur215_bois_blc	= array('10 1/2"','12 0"','13 1/2"','15 0"','16 1/2"','18 0"','19 1/2"','21 0"','22 1/2"','23 7/8"','25 3/8"','26 7/8"','28 3/8"','29 7/8"','31 3/8"','32 7/8"','34 3/8"','35 7/8"','37 3/8"','38 7/8"','40 3/8"','41 7/8"','43 3/8"','44 7/8"','46 3/8"','47 7/8"','49 3/8"','50 7/8"','52 3/8"','53 7/8"','55 3/8"','56 7/8"','58 3/8"','59 7/8"','61 3/8"','62 7/8"');
			}else{
				$html_profondeur215_bois_blc	= array('266 mm','304 mm','342 mm','380 mm','418 mm','456 mm','494 mm','532 mm','570 mm','608 mm','646 mm','684 mm','722 mm','760 mm','798 mm','836 mm','874 mm','912 mm','950 mm','988 mm','1026 mm','1064 mm','1102 mm','1140 mm','1178 mm','1216 mm','1254 mm','1292 mm','1330 mm','1368 mm','1406 mm','1444 mm','1482 mm','1520 mm','1558 mm','1596 mm');
			}
			$html_profondeur215_bois_blc_value	= array('266','304','342','380','418','456','494','532','570','608','646','684','722','760','798','836','874','912','950','988','1026','1064','1102','1140','1178','1216','1254','1292','1330','1368','1406','1444','1482','1520','1558','1596');

			// 265
			if($post->systeme == "imp"){
				$html_profondeur265_bois_blc	= array('13 1/2"','15 0"','16 1/2"','18 0"','19 1/2"','21 0"','22 1/2"','23 7/8"','25 3/8"','26 7/8"','28 3/8"','29 7/8"','31 3/8"','32 7/8"','34 3/8"','35 7/8"','37 3/8"','38 7/8"','40 3/8"','41 7/8"','43 3/8"','44 7/8"','46 3/8"','47 7/8"','49 3/8"','50 7/8"','52 3/8"','53 7/8"','55 3/8"','56 7/8"','58 3/8"','59 7/8"','61 3/8"','62 7/8"','64 3/8"','65 7/8"','67 3/8"','68 7/8"','70 3/8"','71 3/4"','73 1/4"','74 3/4"','76 1/4"','77 3/4"');
			}else{
				$html_profondeur265_bois_blc	= array('342 mm','380 mm','418 mm','456 mm','494 mm','532 mm','570 mm','608 mm','646 mm','684 mm','722 mm','760 mm','798 mm','836 mm','874 mm','912 mm','950 mm','988 mm','1026 mm','1064 mm','1102 mm','1140 mm','1178 mm','1216 mm','1254 mm','1292 mm','1330 mm','1368 mm','1406 mm','1444 mm','1482 mm','1520 mm','1558 mm','1596 mm','1634 mm','1672 mm','1710 mm','1748 mm','1786 mm','1824 mm','1862 mm','1900 mm','1938 mm','1976 mm');
			}
			$html_profondeur265_bois_blc_value	= array('342','380','418','456','494','532','570','608','646','684','722','760','798','836','874','912','950','988','1026','1064','1102','1140','1178','1216','1254','1292','1330','1368','1406','1444','1482','1520','1558','1596','1634','1672','1710','1748','1786','1824','1862','1900','1938','1976');

			// 315
			if($post->systeme == "imp"){
				$html_profondeur315_bois_blc	= array('15 0"','16 1/2"','18 0"','19 1/2"','21 0"','22 1/2"','23 7/8"','25 3/8"','26 7/8"','28 3/8"','29 7/8"','31 3/8"','32 7/8"','34 3/8"','35 7/8"','37 3/8"','38 7/8"','40 3/8"','41 7/8"','43 3/8"','44 7/8"','46 3/8"','47 7/8"','49 3/8"','50 7/8"','52 3/8"','53 7/8"','55 3/8"','56 7/8"','58 3/8"','59 7/8"','61 3/8"','62 7/8"','64 3/8"','65 7/8"','67 3/8"','68 7/8"','70 3/8"','71 3/4"','73 1/4"','74 3/4"','76 1/4"','77 3/4"','79 1/4"','80 3/4"','82 1/4"','83 3/4"');
			}else{
				$html_profondeur315_bois_blc	= array('380 mm','418 mm','456 mm','494 mm','532 mm','570 mm','608 mm','646 mm','684 mm','722 mm','760 mm','798 mm','836 mm','874 mm','912 mm','950 mm','988 mm','1026 mm','1064 mm','1102 mm','1140 mm','1178 mm','1216 mm','1254 mm','1292 mm','1330 mm','1368 mm','1406 mm','1444 mm','1482 mm','1520 mm','1558 mm','1596 mm','1634 mm','1672 mm','1710 mm','1748 mm','1786 mm','1824 mm','1862 mm','1900 mm','1938 mm','1976 mm','2014 mm','2052 mm','2090 mm','2128 mm');
			}
			$html_profondeur315_bois_blc_value	= array('380','418','456','494','532','570','608','646','684','722','760','798','836','874','912','950','988','1026','1064','1102','1140','1178','1216','1254','1292','1330','1368','1406','1444','1482','1520','1558','1596','1634','1672','1710','1748','1786','1824','1862','1900','1938','1976','2014','2052','2090','2128');

			// 365
			if($post->systeme == "imp"){
				$html_profondeur365_bois_blc	= array('15 0"','16 1/2"','18 0"','19 1/2"','21 0"','22 1/2"','23 7/8"','25 3/8"','26 7/8"','28 3/8"','29 7/8"','31 3/8"','32 7/8"','34 3/8"','35 7/8"','37 3/8"','38 7/8"','40 3/8"','41 7/8"','43 3/8"','44 7/8"','46 3/8"','47 7/8"','49 3/8"','50 7/8"','52 3/8"','53 7/8"','55 3/8"','56 7/8"','58 3/8"','59 7/8"','61 3/8"','62 7/8"','64 3/8"','65 7/8"','67 3/8"','68 7/8"','70 3/8"','71 3/4"','73 1/4"','74 3/4"','76 1/4"','77 3/4"','79 1/4"','80 3/4"','82 1/4"','83 3/4"');
			}else{
				$html_profondeur365_bois_blc	= array('380 mm','418 mm','456 mm','494 mm','532 mm','570 mm','608 mm','646 mm','684 mm','722 mm','760 mm','798 mm','836 mm','874 mm','912 mm','950 mm','988 mm','1026 mm','1064 mm','1102 mm','1140 mm','1178 mm','1216 mm','1254 mm','1292 mm','1330 mm','1368 mm','1406 mm','1444 mm','1482 mm','1520 mm','1558 mm','1596 mm','1634 mm','1672 mm','1710 mm','1748 mm','1786 mm','1824 mm','1862 mm','1900 mm','1938 mm','1976 mm','2014 mm','2052 mm','2090 mm','2128 mm');
			}
			$html_profondeur365_bois_blc_value	= array('380','418','456','494','532','570','608','646','684','722','760','798','836','874','912','950','988','1026','1064','1102','1140','1178','1216','1254','1292','1330','1368','1406','1444','1482','1520','1558','1596','1634','1672','1710','1748','1786','1824','1862','1900','1938','1976','2014','2052','2090','2128');


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
			$html_largeur_bois_blc_nordic=array('3 3/8"','5 3/8"','7 1/4"','8 1/2"','9 1/2"','10 1/2"');
		}else{
			$html_largeur_bois_blc_nordic=array('86 mm','137 mm','184 mm','215 mm','241 mm','292 mm');
		}

		// VALEURS ASSOCCIES
		$html_largeur_bois_blc_nordic_value=array('86','137','184','215','241','292');

		// VARIABLES MENU SELECT PROFONDEUR
		// VALEURS ASSOCCIES


			// 86
			if($post->systeme == "imp"){
				$html_profondeur86_bois_blc_nordic = array('5 1/2"','7 1/2"','9 1/2"','11 1/2"','13 1/2"','15 1/2"','17 1/2"','19 1/2"','21 1/2"','23 1/2"','25 1/2"','27 1/2"','29 1/2"','31 5/8"','33 5/8"','35 5/8"','37 5/8"','39 5/8"');
			}else{
				$html_profondeur86_bois_blc_nordic = array('140 mm','191 mm','241 mm','292 mm','343 mm','394 mm','445 mm','495 mm','546 mm','597 mm','648 mm','699 mm','749 mm','803 mm','854 mm','905 mm','956 mm','1006 mm');
			}
			$html_profondeur86_bois_blc_nordic_value	= array('140','191','241','292','343','394','445','495','546','597','648','699','749','803','854','905','956','1006');


			//137
			if($post->systeme == "imp"){
				$html_profondeur137_bois_blc_nordic = array('5 3/8"','7 1/2"','9 1/2"','11 1/2"','13 1/2"','15 1/2"','17 1/2"','19 1/2"','21 1/2"','23 1/2"','25 1/2"','27 1/2"','29 1/2"','31 5/8"','33 5/8"','35 5/8"','37 5/8"','39 5/8"','41 5/8"','43 5/8"','45 5/8"','47 5/8"','49 5/8"','51 5/8"','53 5/8"','55 5/8"','57 5/8"','59 5/8"','61 5/8"','63 3/4"');
			}else{
				$html_profondeur137_bois_blc_nordic = array('137 mm','191 mm','241 mm','292 mm','343 mm','394 mm','445 mm','495 mm','546 mm','597 mm','648 mm','699 mm','749 mm','803 mm','854 mm','905 mm','956 mm','1006 mm','1057 mm','1108 mm','1159 mm','1210 mm','1260 mm','1311 mm','1362 mm','1413 mm','1464 mm','1514 mm','1565 mm','1619 mm');
			}
			$html_profondeur137_bois_blc_nordic_value	= array('137','191','241','292','343','394','445','495','546','597','648','699','749','803','854','905','956','1006','1057','1108','1159','1210','1260','1311','1362','1413','1464','1514','1565','1619');


			// 184
			if($post->systeme == "imp"){
				$html_profondeur184_bois_blc_nordic = array('7 1/4"','9 1/2"','11 1/2"','13 1/2"','15 1/2"','17 1/2"','19 1/2"','21 1/2"','23 1/2"','25 1/2"','27 1/2"','29 1/2"','31 5/8"','33 5/8"','35 5/8"','37 5/8"','39 5/8"','41 5/8"','43 5/8"','45 5/8"','47 5/8"','49 5/8"','51 5/8"','53 5/8"','55 5/8"','57 5/8"','59 5/8"','61 5/8"','63 3/4"','65 3/4"','67 3/4"','69 3/4"','71 3/4"','73 3/4"','75 3/4"','77 3/4"','79 3/4"','81 3/4"','83 3/4"','85 3/4"');
			}else{
				$html_profondeur184_bois_blc_nordic = array('184 mm','241 mm','292 mm','343 mm','394 mm','445 mm','495 mm','546 mm','597 mm','648 mm','699 mm','749 mm','803 mm','854 mm','905 mm','956 mm','1006 mm','1057 mm','1108 mm','1159 mm','1210 mm','1260 mm','1311 mm','1362 mm','1413 mm','1464 mm','1514 mm','1565 mm','1619 mm','1670 mm','1721 mm','1772 mm','1822 mm','1873 mm','1924 mm','1975 mm','2026 mm','2076 mm','2127 mm','2178 mm');
			}
			$html_profondeur184_bois_blc_nordic_value	= array('184','241','292','343','394','445','495','546','597','648','699','749','803','854','905','956','1006','1057','1108','1159','1210','1260','1311','1362','1413','1464','1514','1565','1619','1670','1721','1772','1822','1873','1924','1975','2026','2076','2127','2178');

			// 215
			if($post->systeme == "imp"){
				$html_profondeur215_bois_blc_nordic = array('8 1/2"','9 1/2"','11 1/2"','13 1/2"','15 1/2"','17 1/2"','19 1/2"','21 1/2"','23 1/2"','25 1/2"','27 1/2"','29 1/2"','31 5/8"','33 5/8"','35 5/8"','37 5/8"','39 5/8"','41 5/8"','43 5/8"','45 5/8"','47 5/8"','49 5/8"','51 5/8"','53 5/8"','55 5/8"','57 5/8"','59 5/8"','61 5/8"','63 3/4"','65 3/4"','67 3/4"','69 3/4"','71 3/4"','73 3/4"','75 3/4"','77 3/4"','79 3/4"','81 3/4"','83 3/4"','85 3/4"','87 3/4"','89 3/4"','91 3/4"','93 7/8"','95 7/8"');
			} else{
				$html_profondeur215_bois_blc_nordic = array('215 mm','241 mm','292 mm','343 mm','394 mm','445 mm','495 mm','546 mm','597 mm','648 mm','699 mm','749 mm','803 mm','854 mm','905 mm','956 mm','1006 mm','1057 mm','1108 mm','1159 mm','1210 mm','1260 mm','1311 mm','1362 mm','1413 mm','1464 mm','1514 mm','1565 mm','1619 mm','1670 mm','1721 mm','1772 mm','1822 mm','1873 mm','1924 mm','1975 mm','2026 mm','2076 mm','2127 mm','2178 mm','2229 mm','2280 mm','2330 mm','2384 mm','2435 mm');
			}
			$html_profondeur215_bois_blc_nordic_value	= array('215','241','292','343','394','445','495','546','597','648','699','749','803','854','905','956','1006','1057','1108','1159','1210','1260','1311','1362','1413','1464','1514','1565','1619','1670','1721','1772','1822','1873','1924','1975','2026','2076','2127','2178','2229','2280','2330','2384','2435');

			// 241
			if($post->systeme == "imp"){
				$html_profondeur241_bois_blc_nordic = array('9 1/2"','11 1/2"','13 1/2"','15 1/2"','17 1/2"','19 1/2"','21 1/2"','23 1/2"','25 1/2"','27 1/2"','29 1/2"','31 5/8"','33 5/8"','35 5/8"','37 5/8"','39 5/8"','41 5/8"','43 5/8"','45 5/8"','47 5/8"','49 5/8"','51 5/8"','53 5/8"','55 5/8"','57 5/8"','59 5/8"','61 5/8"','63 3/4"','65 3/4"','67 3/4"','69 3/4"','71 3/4"','73 3/4"','75 3/4"','77 3/4"','79 3/4"','81 3/4"','83 3/4"','85 3/4"','87 3/4"','89 3/4"','91 3/4"','93 7/8"','95 7/8"');
			}else{
				$html_profondeur241_bois_blc_nordic = array('241 mm','292 mm','343 mm','394 mm','445 mm','495 mm','546 mm','597 mm','648 mm','699 mm','749 mm','803 mm','854 mm','905 mm','956 mm','1006 mm','1057 mm','1108 mm','1159 mm','1210 mm','1260 mm','1311 mm','1362 mm','1413 mm','1464 mm','1514 mm','1565 mm','1619 mm','1670 mm','1721 mm','1772 mm','1822 mm','1873 mm','1924 mm','1975 mm','2026 mm','2076 mm','2127 mm','2178 mm','2229 mm','2280 mm','2330 mm','2384 mm','2435 mm');
			}
			$html_profondeur241_bois_blc_nordic_value	= array('241','292','343','394','445','495','546','597','648','699','749','803','854','905','956','1006','1057','1108','1159','1210','1260','1311','1362','1413','1464','1514','1565','1619','1670','1721','1772','1822','1873','1924','1975','2026','2076','2127','2178','2229','2280','2330','2384','2435');

			// 292
			if($post->systeme == "imp"){
				$html_profondeur292_bois_blc_nordic = array('11 1/2"','13 1/2"','15 1/2"','17 1/2"','19 1/2"','21 1/2"','23 1/2"','25 1/2"','27 1/2"','29 1/2"','31 5/8"','33 5/8"','35 5/8"','37 5/8"','39 5/8"','41 5/8"','43 5/8"','45 5/8"','47 5/8"','49 5/8"','51 5/8"','53 5/8"','55 5/8"','57 5/8"','59 5/8"','61 5/8"','63 3/4"','65 3/4"','67 3/4"','69 3/4"','71 3/4"','73 3/4"','75 3/4"','77 3/4"','79 3/4"','81 3/4"','83 3/4"','85 3/4"','87 3/4"','89 3/4"','91 3/4"','93 7/8"','95 7/8"');
			}else{
				$html_profondeur292_bois_blc_nordic = array('292 mm','343 mm','394 mm','445 mm','495 mm','546 mm','597 mm','648 mm','699 mm','749 mm','803 mm','854 mm','905 mm','956 mm','1006 mm','1057 mm','1108 mm','1159 mm','1210 mm','1260 mm','1311 mm','1362 mm','1413 mm','1464 mm','1514 mm','1565 mm','1619 mm','1670 mm','1721 mm','1772 mm','1822 mm','1873 mm','1924 mm','1975 mm','2026 mm','2076 mm','2127 mm','2178 mm','2229 mm','2280 mm','2330 mm','2384 mm','2435 mm');
			}
			$html_profondeur292_bois_blc_nordic_value	= array('292','343','394','445','495','546','597','648','699','749','803','854','905','956','1006','1057','1108','1159','1210','1260','1311','1362','1413','1464','1514','1565','1619','1670','1721','1772','1822','1873','1924','1975','2026','2076','2127','2178','2229','2280','2330','2384','2435');


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
			$html_largeur1_bois_massif=array('5 1/2"','7 1/2"','9 1/2"','11 1/2"','13 1/2"','15 1/2"');
			$html_largeur2_bois_massif=array('5 1/2"','7 1/2"','9 1/2"');
		}else{
			$html_largeur1_bois_massif=array('140 mm','191 mm','241 mm','292 mm','343 mm','394 mm');
			$html_largeur2_bois_massif=array('140 mm','191 mm','241 mm','292 mm','343 mm','394 mm');
		}

		// VALEURS ASSOCCIES
		$html_largeur1_bois_massif_value=array('140','191','241','292','343','394');
		$html_largeur2_bois_massif_value=array('140','191','241','292','343','394');
		// VARIABLES MENU SELECT PROFONDEUR
		// VALEURS ASSOCCIES

			// 140
			if($post->systeme == "imp"){
				$html_profondeur140_bois_massif		= array('5 1/2"','7 1/2"','9 1/2"','11 1/2"','13 1/2"','15 1/2"');
			}else{
				$html_profondeur140_bois_massif		= array('140 mm','191 mm','241 mm','292 mm','343 mm','394 mm');
			}
			$html_profondeur140_bois_massif_value	= array('140','191','241','292','343','394');

			// 191
			if($post->systeme == "imp"){
				$html_profondeur191_bois_massif		= array('7 1/2"','9 1/2"','11 1/2"','13 1/2"','15 1/2"');
			}else{
				$html_profondeur191_bois_massif		= array('191 mm','241 mm','292 mm','343 mm','394 mm');
			}
			$html_profondeur191_bois_massif_value	= array('191','241','292','343','394');

			// 241
			if($post->systeme == "imp"){
				$html_profondeur241_bois_massif		= array('9 1/2"','11 1/2"','13 1/2"','15 1/2"');
			}else{
				$html_profondeur241_bois_massif		= array('241 mm','292 mm','343 mm','394 mm');
			}
			$html_profondeur241_bois_massif_value	= array('241','292','343','394');

			// 292
			if($post->systeme == "imp"){
				$html_profondeur292_bois_massif		= array('11 1/2"','13 1/2"','15 1/2"');
			}else{
				$html_profondeur292_bois_massif		= array('292 mm','343 mm','394 mm');
			}
			$html_profondeur292_bois_massif_value	= array('292','343','394');

			// 343
			if($post->systeme == "imp"){
				$html_profondeur343_bois_massif		= array('13 1/2"','15 1/2"');
			}else{
				$html_profondeur343_bois_massif		= array('343 mm','394 mm');
			}
			$html_profondeur343_bois_massif_value	= array('343','394');

			// 394
			if($post->systeme == "imp"){
				$html_profondeur394_bois_massif		= array('15 1/2"');
			}else{
				$html_profondeur394_bois_massif		= array('394 mm');
			}
			$html_profondeur394_bois_massif_value	= array('394');

			// 140
			if($post->systeme == "imp"){
				$html_profondeur140_2_bois_massif		= array('5 1/2"','7 1/2"','9 1/2"','11 1/2"','13 1/2"','15 1/2"');
			}else{
				$html_profondeur140_2_bois_massif		= array('140 mm','191 mm','241 mm','292 mm','343 mm','394 mm');
			}
			$html_profondeur140_2_bois_massif_value	= array('140','191','241','292','343','394');

			// 191
			if($post->systeme == "imp"){
				$html_profondeur191_2_bois_massif		= array('7 1/2"','9 1/2"','11 1/2"','13 1/2"','15 1/2"');
			}else{
				$html_profondeur191_2_bois_massif		= array('191 mm','241 mm','292 mm','343 mm','394 mm');
			}
			$html_profondeur191_2_bois_massif_value	= array('191','241','292','343','394');

			// 241
			if($post->systeme == "imp"){
				$html_profondeur241_2_bois_massif		= array('9 1/2"','11 1/2"','13 1/2"','15 1/2"');
			}else{
				$html_profondeur241_2_bois_massif		= array('241 mm','292 mm','343 mm','394 mm');
			}
			$html_profondeur241_2_bois_massif_value	= array('241','292','343','394');

			// 292
			if($post->systeme == "imp"){
				$html_profondeur292_2_bois_massif		= array('11 1/2"','13 1/2"','15 1/2"');
			}else{
				$html_profondeur292_2_bois_massif		= array('292 mm','343 mm','394 mm');
			}
			$html_profondeur292_2_bois_massif_value	= array('292','343','394');

			// 343
			if($post->systeme == "imp"){
				$html_profondeur343_2_bois_massif		= array('13 1/2"','15 1/2"');
			}else{
				$html_profondeur343_2_bois_massif		= array('343 mm','394 mm');
			}
			$html_profondeur343_2_bois_massif_value	= array('343','394');

			// 394
			if($post->systeme == "imp"){
				$html_profondeur394_2_bois_massif		= array('15 1/2"');
			}else{
				$html_profondeur394_2_bois_massif		= array('394 mm');
			}
			$html_profondeur394_2_bois_massif_value	= array('394');




	// VARIABLES MENU SELECT RIVE COMPRIMEE RETENUE
	$html_rive_comprimee_retenue=array(
		__d( 'cecobois', 'Sur toute la longueur' ),
		__d( 'cecobois', 'Aux extrémités' ),
		__d( 'cecobois', 'À intervalles réguliers' )
	);

	// VALEURS ASSOCCIES
	$html_rive_comprimee_retenue_value=array(
		'longueur',
		'extremites',
		'intervalles'
	);

	// VARIABLES MENU SELECT EDITION DU CODE NATIONAL DU BATIMENT
	$html_edition_code=array(
		__d( 'cecobois', 'CNB 2010' ),
		__d( 'cecobois', 'CNB 2015' )
	);

	// VALEURS ASSOCCIES
	$html_edition_code_value=array(
		'2010',
		'2015'
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


	// VARIABLES MENU SELECT NORME CSA O86
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

	// VARIABLES MENU RADIO TYPE REVETEMENT

        


	// HTML (STYLE ET JS)
	//*******************

	$html_systeme_js 				= ' onclick="changeSysteme();"';
	$html_type_bois_js							= ' onchange="aff_select_type_bois(this,\'bois_sciage\',\'bois_scl\',\'bois_blc\',\'bois_blc_nordic\',\'bois_massif\');"';
	$html_classe_bois_sciage_js					= '';
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
			$html_profondeur215_bois_blc_nordic_js		= '';
			$html_profondeur241_bois_blc_nordic_js		= '';
			$html_profondeur292_bois_blc_nordic_js		= '';
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
	

	$html_portee_js					= '';
	$html_rive_comprimee_retenue_js	= ' onchange="aff_intervalles(this)"';
	$html_edition_code_js			= '';
	$html_edition_norme_js			= '';
	$html_surcharge_js				= '';
	$html_neige_js					= '';
	$html_morte_js					= '';
	$html_cat_risque_js				= '';
	$html_fleche_surcharge_js		= '';
	$html_charge_totale_js			= '';

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
		$html_portee_js					= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_rive_comprimee_retenue_js	= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_edition_code_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_edition_norme_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_surcharge_js				= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_neige_js					= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_morte_js					= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_cat_risque_js				= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_fleche_surcharge_js		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_charge_totale_js			= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';*/
	}

	
	$html_colonnes_bois_sciage_style		= ' ';
	$html_colonnes_bois_sciage_style2		= ' style="display:none;"';
	$html_colonnes_bois_sciage_style3		= ' style="display:none;"';
	$html_colonnes_bois_sciage_style4		= ' style="display:none;"';

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
	$html_profondeur215_bois_blc_nordic_style 	= ' style="display:none;"';
	$html_profondeur241_bois_blc_nordic_style 	= ' style="display:none;"';
	$html_profondeur292_bois_blc_nordic_style 	= ' style="display:none;"';

	$html_classe_bois_massif_style			= ' style="display:none;"';
	$html_essence_bois_massif_style			= ' style="display:none;"';
	$html_largeur1_bois_massif_style		= ' style="display:none;"';
	$html_largeur2_bois_massif_style		= ' style="display:none;"';
	$html_profondeur140_bois_massif_style	= ' style="display:none;"';
	$html_profondeur191_bois_massif_style	= ' style="display:none;"';
	$html_profondeur241_bois_massif_style	= ' style="display:none;"';
	$html_profondeur292_bois_massif_style	= ' style="display:none;"';
	$html_profondeur343_bois_massif_style	= ' style="display:none;"';
	$html_profondeur394_bois_massif_style	= ' style="display:none;"';
	$html_profondeur140_2_bois_massif_style	= ' style="display:none;"';
	$html_profondeur191_2_bois_massif_style	= ' style="display:none;"';
	$html_profondeur241_2_bois_massif_style	= ' style="display:none;"';
	$html_profondeur292_2_bois_massif_style	= ' style="display:none;"';
	$html_profondeur343_2_bois_massif_style	= ' style="display:none;"';
	$html_profondeur394_2_bois_massif_style	= ' style="display:none;"';

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
	$post->profondeur215_bois_blc_nordic	= $post->profondeur215_bois_blc_nordic !=''	? $post->profondeur215_bois_blc_nordic	: '215';
	$post->profondeur241_bois_blc_nordic	= $post->profondeur241_bois_blc_nordic !=''	? $post->profondeur241_bois_blc_nordic	: '318';
	$post->profondeur292_bois_blc_nordic	= $post->profondeur292_bois_blc_nordic !=''	? $post->profondeur292_bois_blc_nordic	: '362';

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


	$post->rive_comprimee_retenue	= $post->rive_comprimee_retenue != '' 	? 	$post->rive_comprimee_retenue 	: 'longueur';
	$post->intervalles				= $post->intervalles != '' 				? 	$post->intervalles 				: '';
	$post->edition_code				= $post->edition_code != '' 			? 	$post->edition_code 			: '2010';
	$post->cat_risque				= $post->cat_risque != '' 				? 	$post->cat_risque 				: 'normale';
	$post->edition_norme			= $post->edition_norme != '' 			? 	$post->edition_norme 			: '09';


	$post->fleche_surcharge		= $post->fleche_surcharge != ''		? 	$post->fleche_surcharge 			: 480;
	$post->fleche_charge_totale	= $post->fleche_charge_totale != ''	? 	$post->fleche_charge_totale 		: 240;


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

		}elseif($post->largeur_bois_blc_nordic=='215'){

			$post->profondeur_bois_blc_nordic 			= $post->profondeur215_bois_blc_nordic;
			$html_profondeur215_bois_blc_nordic_style	= '';

		}elseif($post->largeur_bois_blc_nordic=='241'){

			$post->profondeur_bois_blc_nordic 			= $post->profondeur241_bois_blc_nordic;
			$html_profondeur241_bois_blc_nordic_style	= '';

		}elseif($post->largeur_bois_blc_nordic=='292'){

			$post->profondeur_bois_blc_nordic 			= $post->profondeur292_bois_blc_nordic;
			$html_profondeur292_bois_blc_nordic_style	= '';
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
			}	elseif($post->largeur=='292'){
				$post->profondeur_bois_massif 			= $post->profondeur292_bois_massif;
				$html_profondeur292_bois_massif_style	= '';
			} elseif($post->largeur=='343'){
				$post->profondeur_bois_massif 			= $post->profondeur343_bois_massif;
				$html_profondeur343_bois_massif_style	= '';
			}elseif($post->largeur=='394'){
				$post->profondeur_bois_massif 			= $post->profondeur394_bois_massif;
				$html_profondeur394_bois_massif_style	= '';
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
			}elseif($post->largeur=='292'){
				$post->profondeur_bois_massif 			= $post->profondeur292_2_bois_massif;
				$html_profondeur292_2_bois_massif_style	= '';
			}elseif($post->largeur=='343'){
				$post->profondeur_bois_massif 			= $post->profondeur343_2_bois_massif;
				$html_profondeur343_2_bois_massif_style	= '';
			}elseif($post->largeur=='394'){
				$post->profondeur_bois_massif 			= $post->profondeur394_2_bois_massif;
				$html_profondeur394_2_bois_massif_style	= '';
			}
		}
	}

	if($post->rive_comprimee_retenue != 'intervalles'){
		$html_intervalles_style = ' style="display:none;"';
	}

        
	//Afficher ou cacher le dbugage
	$show_debug=false;

?>