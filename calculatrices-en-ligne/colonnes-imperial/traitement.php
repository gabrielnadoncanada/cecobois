<?PHP

	require_once("class/Conversion.php");

	// VARIABLES DE SORTIES
	//---------------------
				
		$html_champs_sortie=array(
			'flexion_app',
			'flexion_res',
			'compression_app',
			'compression_res',
			'cisaillement_app',
			'cisaillement_res',
			'efforts_p_app',
			'efforts_p_res',
			'efforts_m_app',
			'efforts_m_res',
			'fleche_surcharge_app',
			'fleche_surcharge_res',
			'fleche_charge_tot_app',
			'fleche_charge_tot_res'/*,
			'volume_bois',
			'pmp'
			*/
		);
		
		//on associe les variables de $html_champs_sortie dans l'object output.
		for($a=0; $a<count($html_champs_sortie); $a++){
			$output->$html_champs_sortie[$a]='';
		}
		
		$html_article_sortie=array(
			'flexion',
			'compression',
			'cisaillement',
			'efforts'
		);
		
		//on dfini output et on les associe dans l'objet post.
		for($a=0; $a<count($html_article_sortie); $a++){
			$output_article->$html_article_sortie[$a]='';
		}
		
		if($post->type_bois == "bois_sciage" || $post->type_bois == "bois_massif"){
		
			$output_article->flexion		= '6.5.4';
			$output_article->compression	= '6.5.6';
			$output_article->cisaillement	= '6.5.5';
			$output_article->efforts		= '6.5.10';
			
		}else if($post->type_bois == "bois_scl"){
			
			$output_article->flexion		= '15.3.3.1';
			$output_article->compression	= '15.3.3.4';
			$output_article->cisaillement	= '15.3.3.3';
			$output_article->efforts		= '15.3.3.9';
	
				
		}else if($post->type_bois == "bois_blc" || $post->type_bois == "bois_blc_nordic"){
			
			$output_article->flexion		= '7.5.6';
			$output_article->compression	= '7.5.8';
			$output_article->cisaillement	= '7.5.7';
			$output_article->efforts		= '7.5.12';

			
		}
		
	
		$html_note_sortie=array(
			'moment',
			'fleche_surcharge',
			'fleche_totale'
		);
		
		//on associe les variables de html_champs_sortie dans l'object output_note.
		for($a=0; $a<count($html_note_sortie); $a++){
			$output_note->$html_note_sortie[$a]='';
		}
		
		function verifCarac($champ){
	
			$tab_check_carac	= array(',','millimetre','millimtre','milimetre','milimtre','metre','mtre','pieds','pied','pouces','pouce','kpa','kn/m','p','m','"','\'','%','\\');
			$tab_replace_carac	= array('.','','','','','','','','','','','','','','','','','','');
			
			$champ = str_replace($tab_check_carac,$tab_replace_carac,strtolower($champ));
			
			return $champ;
		}
		
	
	//VARIABLES FIXES
	//---------------
		
		/*
		$post->largeur = str_replace(',','.',$post->largeur);
		$post->largeur = str_replace('m','',$post->largeur);
		*/
		$post->largeur = verifCarac($post->largeur);
		
		
		//on effectue des modifications sur la hauteur ecrite a la main
		/*$post->hauteur = strtolower($post->hauteur);
		$post->hauteur = str_replace(',','.',$post->hauteur);
		$post->hauteur = str_replace('m','',$post->hauteur);
		*/
		$post->hauteur = verifCarac($post->hauteur);
		
		//Si il y a un probleme avec cette variable, on stock un msg d'erreur
		if(!is_numeric($post->hauteur)){
			if(!isset($error)){
				$error = ERROR_HAUTEUR_NOMBRE;
			}
		}else{
			//if($post->hauteur > 4.88 && $post->type_bois == 'bois_sciage'){
			if((($post->hauteur > 4.88 && $post->systeme=="met") || (Conversion::ConvertPiedsToMetre($post->hauteur) > 4.88 && $post->systeme=="imp")) && $post->type_bois == 'bois_sciage'){
				//$error = ERROR_HAUTEUR_BIGGER;
			}else if($post->hauteur<1){
				//$post->hauteur = 0;
				$error = ERROR_HAUTEUR_SMALLER;
			}
		}
		
		
		
		//------------------------------
		if($post->type_bois == "bois_sciage"){
			if($post->attache_bois_sciage == "cloue" ){
				$coefficient_attache = 	0.6;
			}else if($post->attache_bois_sciage == "boulonne"){
				$coefficient_attache = 	0.75;
			}else if($post->attache_bois_sciage == "anneaux"){
				$coefficient_attache = 	0.8;
			}
			
			if($post->plis_bois_sciage == 1){
				$coefficient_attache = 1;
			}
		}
		
		
		if($post->type_bois == "bois_scl"){
				
			if($post->attache_bois_scl == "cloue" ){
				$coefficient_attache = 	0.6;
			}else if($post->attache_bois_scl == "boulonne"){
				$coefficient_attache = 	0.75;
			}else if($post->attache_bois_scl == "anneaux"){
				$coefficient_attache = 	0.8;
			}
			
			if($post->plis_bois_scl == 1){
				$coefficient_attache = 1;
			}
			
			if($post->largeur>45){
				//$post->plis_bois_scl = 1;
				$coefficient_attache = 1;
			}
		}
		
		if($post->type_bois == "bois_blc" || $post->type_bois == "bois_blc_nordic" || $post->type_bois == "bois_massif"){
			$coefficient_attache = 1;
		}
		

		
		//------------------------------
		
		
		//on defini les variables de cat_risque
		$cat_risque_valeurs=array(
			'is_elu',
			'is_els',
			'iw_elu',
			'iw_els'
		);
		
		//on associe les variables dans l'objet cat_risque
		for($a=0; $a<count($cat_risque_valeurs); $a++){
			$cat_risque->$cat_risque_valeurs[$a]='';
		}
		
		//on defini les valeurs  ces variables
		$cat_risque->is_els	= 0.9;
		$cat_risque->iw_els	= 0.75;
		
		if($post->cat_risque=='faible'){
			$cat_risque->is_elu	= 0.8;
			$cat_risque->iw_elu	= 0.8;			
			
		}else if($post->cat_risque=='normale'){
			$cat_risque->is_elu	= 1;
			$cat_risque->iw_elu	= 1;			
			
		}else if($post->cat_risque=='elevee'){
			$cat_risque->is_elu	= 1.15;
			$cat_risque->iw_elu	= 1.15;			
			
		}else if($post->cat_risque=='protection_civile'){
			$cat_risque->is_elu	= 1.25;
			$cat_risque->iw_elu	= 1.25;			
		}
		
		
		
		//------------------------------
		
		//on effectue des modifications sur l'ax_neige ecrite a la main
		/*$post->ax_neige = strtolower($post->ax_neige);
		$post->ax_neige = str_replace(',','.',$post->ax_neige);
		$post->ax_neige = str_replace('kn/m','',$post->ax_neige);
		*/
		$post->ax_neige = verifCarac($post->ax_neige);
		
		//Si il y a un probleme avec cette variable, on stock un msg d'erreur
		if(!is_numeric($post->ax_neige)){
			if(!isset($error)){
				$error = ERROR_CHARGE_AXIALE_NEIGE_NOMBRE;
			}
		}elseif ($post->ax_neige<0){
			//$post->ax_neige=0;
			if(!isset($error)){
				$error = ERROR_CHARGE_AXIALE_NEIGE_SMALLER;
			}
		}
		
		//------------------------------
		
		//on effectue des modifications sur l'ax_surcharge ecrite a la main
		/*
		$post->ax_surcharge = strtolower($post->ax_surcharge);
		$post->ax_surcharge = str_replace(',','.',$post->ax_surcharge);
		$post->ax_surcharge = str_replace('kn/m','',$post->ax_surcharge);
		*/
		$post->ax_surcharge = verifCarac($post->ax_surcharge);
		
		//Si il y a un probleme avec cette variable, on stock un msg d'erreur
		if(!is_numeric($post->ax_surcharge)){
			if(!isset($error)){
				$error = ERROR_CHARGE_AXIALE_SURCHARGE_NOMBRE;
			}
		}elseif ($post->ax_surcharge<0){
			//$post->ax_surcharge=0;
			if(!isset($error)){
				$error = ERROR_CHARGE_AXIALE_SURCHARGE_SMALLER;
			}
		}
		
		
		//------------------------------
		
		//on effectue des modifications sur l'ax_permanente ecrite a la main
		/*
		$post->ax_permanente = strtolower($post->ax_permanente);
		$post->ax_permanente = str_replace(',','.',$post->ax_permanente);
		$post->ax_permanente = str_replace('kn/m','',$post->ax_permanente);
		*/
		$post->ax_permanente = verifCarac($post->ax_permanente);
		
		//Si il y a un probleme avec cette variable, on stock un msg d'erreur
		if(!is_numeric($post->ax_permanente)){
			if(!isset($error)){
				$error = ERROR_CHARGE_AXIALE_PERMANENTE_NOMBRE;
			}
		}elseif ($post->ax_permanente<0){
			//$post->ax_permanente=0;
			if(!isset($error)){
				$error = ERROR_CHARGE_AXIALE_PERMANENTE_SMALLER;
			}
		}
		
		
		//------------------------------
		
		//on effectue des modifications sur l'ax_excentricite ecrite a la main
		/*
		$post->ax_excentricite = strtolower($post->ax_excentricite);
		$post->ax_excentricite = str_replace(',','.',$post->ax_excentricite);
		$post->ax_excentricite = str_replace('mm','',$post->ax_excentricite);
		*/
		$post->ax_excentricite = verifCarac($post->ax_excentricite);
		
		//Si il y a un probleme avec cette variable, on stock un msg d'erreur
		if(!is_numeric($post->ax_excentricite)){
			if(!isset($error)){
				$error = ERROR_CHARGE_AXIALE_EXCENTRICITE_NOMBRE;
			}
		}elseif ($post->ax_excentricite<0){
			//$post->ax_excentricite=0;
			if(!isset($error)){
				$error = ERROR_CHARGE_AXIALE_EXCENTRICITE_SMALLER;
			}
		}
		
		//------------------------------
		
		//on effectue des modifications sur lat_vent ecrite a la main
		/*
		$post->lat_vent = strtolower($post->lat_vent);
		$post->lat_vent = str_replace(',','.',$post->lat_vent);
		$post->lat_vent = str_replace('kpa','',$post->lat_vent);
		*/
		$post->lat_vent = verifCarac($post->lat_vent);
		
		//Si il y a un probleme avec cette variable, on stock un msg d'erreur
		if(!is_numeric($post->lat_vent)){
			if(!isset($error)){
				$error = ERROR_CHARGE_LATERALE_VENT_NOMBRE;
			}
		}else if ($post->lat_vent<0){
			//$post->lat_vent=0;
			if(!isset($error)){
				$error = ERROR_CHARGE_LATERALE_VENT_SMALLER;
			}
		}
		
		//------------------------------
		
		//TRAITEMENT N'EST PAS APPLIQUE AU COMPLET DANS LES CALCULS EN DESSOUS
		
						//on dfini les variables de la class traitement
						$traitement_valeurs=array(
							'non_traite',
							'traite_e',
							'traite_f'
						);
						
						//on associe les variables dans l'objet traitement
						for($a=0; $a<count($traitement_valeurs); $a++){
							$traitement->$traitement_valeurs[$a]='';
						}
								
						$traitement->non_traite = 1;
						/*
						if($post->fleche_utilisation=="sec"){
							
							$traitement->traite_e = 0.9;			
							$traitement->traite_f = 0.75;
				
						}else if($post->fleche_utilisation=="humide"){
							
							$traitement->traite_e = 0.95;			
							$traitement->traite_f = 0.85;
						}
						*/
						$traitement->traite_e = 1;			
						$traitement->traite_f = 1;
						
		// NE PAS OUBLIER DE LES INTEGERER DANS LES CALCULS SI CHANGEMENTS CAR ILS SONT SEULEMENT DECLARE ICI
		
		//------------------------------
		
		//on dfini les variables d'utilisation
		$utilisation_valeurs=array(
			'ksb',
			'ksv',
			'ksc',
			'kse'
		);
		
		//on associe les variables dans l'objet utilisation
		for($a=0; $a<count($utilisation_valeurs); $a++){
			$utilisation->$utilisation_valeurs[$a]='';
		}
				
		//on defini les valeurs a ces variables
		$utilisation->ksb = 1;
		$utilisation->ksv = 1;
		$utilisation->ksc = 1;
		$utilisation->kse = 1;
		
		/*
		if($post->fleche_utilisation=="humide"){
			
			$utilisation->ksb = 0.84;
			$utilisation->ksv = 0.96;
			$utilisation->ksc = 0.69;
			$utilisation->kse = 0.94;	
		}
		*/
		
		//on dfini les variables de la class classe
		$classe_valeurs=array(
			'fb',
			'fv',
			'fc',
			'e',
			'e05',
			'khc'
		);
		
		//on associe les variables dans l'objet classe
		for($a=0; $a<count($classe_valeurs); $a++){
			$classe->$classe_valeurs[$a]='';
		}
		
		//on associes les valeurs  ces variables
		
		$classe->khc	= 1;
		$densite_bois	= 0.42;
		
		if($post->type_bois == 'bois_sciage' ){
		
			if($post->plis_bois_sciage>1){
				$classe->khc	= 1.1;
			}
			
			$classe->fv		= 1.5;
			if($post->classe_bois_sciage=='eps_no1_2'){
				$classe->fb			= 11.8;
				$classe->fc			= 11.5;
				$classe->e			= 9500;
				$classe->e05		= 6500;
				
			}else if($post->classe_bois_sciage=='eps_no3'){
				$classe->fb			= 7;
				//$classe->fc		= 7; *** MATH
				$classe->fc			= 9;
				$classe->e			= 9000;
				$classe->e05		= 5500;
			
			}else if($post->classe_bois_sciage=='msr1650'){
				$classe->fb			= 23.9;
				$classe->fc			= 18.1;
				$classe->e			= 10300;
				$classe->e05		= 8446;
			
			}else if($post->classe_bois_sciage=='msr1950'){
				$classe->fb			= 28.2;
				$classe->fc			= 19.3;
				$classe->e			= 11700;
				$classe->e05		= 9594;
			
			}else if($post->classe_bois_sciage=='msr2100'){
				$classe->fb			= 30.4;
				$classe->fc			= 19.9;
				$classe->e			= 12400;
				$classe->e05		= 10168;
				$densite_bois		= 0.47;
			
			}else if($post->classe_bois_sciage=='msr2250'){
				$classe->fb			= 32.6;
				$classe->fc			= 20.5;
				$classe->e			= 13100;
				$classe->e05		= 10742;
				$densite_bois		= 0.47;
			
			}else if($post->classe_bois_sciage=='msr2400'){
				$classe->fb			= 34.7;
				$classe->fc			= 21.1;
				$classe->e			= 13800;
				$classe->e05		= 11316;
				$densite_bois		= 0.5;
			}
			
			
		}else if($post->type_bois == 'bois_scl'){	

			if($post->plis_bois_scl >= 3){
				$classe->khc = 1.04;
			}

			if($post->classe_bois_scl == '1_5'){
				$classe->e			= 10300;
				$classe->fb			= 25.8;
				$classe->fv			= 2.65;
				$classe->fc			= 21.95;
				
			} else if($post->classe_bois_scl == '1_7'){
				$classe->e			= 11700;
				$classe->fb			= 29.7;
				$classe->fv			= 3.60;
				$classe->fc			= 26.20;
				
			} else if($post->classe_bois_scl == '1_8'){
				$classe->e			= 12400;
				$classe->fb			= 31.7;
				$classe->fv			= 3.60;
				$classe->fc			= 28.35;
			} else if($post->classe_bois_scl == '1_9'){
				$classe->e			= 13100;
				$classe->fb			= 33.6;
				$classe->fv			= 3.6;
				$classe->fc			= 30.45;
			} else if($post->classe_bois_scl == '2'){
				$classe->e			= 13800;
				$classe->fb			= 35.6;
				$classe->fv			= 3.65;
				$classe->fc			= 32.6;
			
			} else if($post->classe_bois_scl == '2_1'){
				$classe->e			= 14500;
				$classe->fb			= 37.55;
				$classe->fv			= 3.65;
				$classe->fc			= 34.75;
			}
			
			$classe->e05		= 0.87*$classe->e;
		
			
		}else if($post->type_bois == 'bois_blc'){
			
			$densite_bois		= 0.49;
			
			if($post->classe_bois_blc=='ep_12c'){
				$classe->fb			= 9.8;
				$classe->fv			= 1.75;
				$classe->fc			= 25.2;
				$classe->e			= 9700;
				$densite_bois		= 0.44;

			}else if($post->classe_bois_blc=='ep_20fex'){
				$classe->fb			= 25.6;
				$classe->fv			= 1.75;
				$classe->fc			= 25.2;
				$classe->e			= 10300;
				$densite_bois		= 0.44;

			}else if($post->classe_bois_blc=='dm_16c'){
				$classe->fb			= 14;
				$classe->fv			= 2;
				$classe->fc			= 30.2;
				$classe->e			= 12400;

			}else if($post->classe_bois_blc=='dm_20fex'){
				$classe->fb			= 25.6;
				$classe->fv			= 2;
				$classe->fc			= 30.2;
				$classe->e			= 12400;
			
			}else if($post->classe_bois_blc=='dm_24fex'){
				$classe->fb			= 30.6;
				$classe->fv			= 2;
				$classe->fc			= 30.2;
				$classe->e			= 12800;
			}
			
			$classe->e05		= 0.87*$classe->e;
				
		}elseif($post->type_bois == 'bois_blc_nordic'){
			
			$densite_bois		= 0.56;
			
			$classe->fb			= 30.7;
			$classe->fv			= 2.5;
			$classe->fc			= 33;
			$classe->e			= 12400;
			
			/*if($post->classe_bois_blc_nordic=='es_11'){
				$classe->fb			= 17.2;
				$classe->fv			= 2.2;
				$classe->fc			= 19.4;
				$classe->e			= 10300;

			}else if($post->classe_bois_blc_nordic=='es_12'){
				$classe->fb			= 24.9;
				$classe->fv			= 2.2;
				$classe->fc			= 33;
				$classe->e			= 12400;

			}else if($post->classe_bois_blc_nordic=='20f'){
				$classe->fb			= 25.6;
				$classe->fv			= 2.2;
				$classe->fc			= 14.4;
				$classe->e			= 10300;

			}else if($post->classe_bois_blc_nordic=='24f'){
				$classe->fb			= 30.7;
				$classe->fv			= 2.2;
				$classe->fc			= 16.5;
				$classe->e			= 12400;
			}*/
			
			$classe->e05		= 0.87*$classe->e;
				
		}elseif($post->type_bois == 'bois_massif' ){
			$constantes = array(
				'D-M' => array(
					'densite_bois' => 0.49,
					'ss' => array( 'fb' => 18.3, 	'fv' => 1.5,	'fc' => 13.8,	'e' => 12000,	'e05' => 8000),
					'n1' => array( 'fb' => 13.8, 	'fv' => 1.5,	'fc' => 12.2,	'e' => 10500,	'e05' => 6500),
					'n2' => array( 'fb' => 6, 		'fv' => 1.5,	'fc' => 7.5,	'e' => 9500,	'e05' => 6000),
				),
				'P-S' => array(
					'densite_bois' => 0.46,
					'ss' => array( 'fb' => 13.6, 	'fv' => 1.2,	'fc' => 11.3,	'e' => 10000,	'e05' => 7000),
					'n1' => array( 'fb' => 10.2, 	'fv' => 1.2,	'fc' => 10,		'e' => 9000,	'e05' => 6000),
					'n2' => array( 'fb' => 4.5, 	'fv' => 1.2,	'fc' => 6.1,	'e' => 8000,	'e05' => 5500),
				),
				'E-P-S' => array(
					'densite_bois' => 0.42,
					'ss' => array( 'fb' => 12.7, 	'fv' => 1.2,	'fc' => 9.9,	'e' => 8500,	'e05' => 6000),
					'n1' => array( 'fb' => 9.6, 	'fv' => 1.2,	'fc' => 8.7,	'e' => 7500,	'e05' => 5000),
					'n2' => array( 'fb' => 4.2, 	'fv' => 1.2,	'fc' => 5.4,	'e' => 6500,	'e05' => 4500),
				),
				'Nordique' => array(
					'densite_bois' => 0.35,
					'ss' => array( 'fb' => 12, 		'fv' => 1,		'fc' => 7.5,	'e' => 8000,	'e05' => 5500),
					'n1' => array( 'fb' => 9, 		'fv' => 1,		'fc' => 6.7,	'e' => 7000,	'e05' => 5000),
					'n2' => array( 'fb' => 3.9, 	'fv' => 1,		'fc' => 4.1,	'e' => 6000,	'e05' => 4000),
				)
			);
			
			$kzb = array(
				140 => array(140 => 1.3, 191 => 1.3),
				191 => array(191 => 1.3, 241 => 1.2),
				241 => array(241 => 1.2, 292 => 1.1),
				292 => array(292 => 1.1)
			);
			
			$massif_temp = $constantes[$post->essence_bois_massif][$post->classe_bois_massif];
			
			$densite_bois		= $constantes[$post->essence_bois_massif]['densite_bois'];
			$classe->fb			= $massif_temp['fb'];
			$classe->fv			= $massif_temp['fv'];
			$classe->fc			= $massif_temp['fc'];
			$classe->e			= $massif_temp['e'];
			$classe->e05		= $massif_temp['e05'];
		}

		//on defini les variables de l'objet colonnes
		$colonnes_valeurs=array(
			'largeur',
			'hauteur',
			'largeur_kzbg',
			'Kzb_eps_Kzv',
			'Kzv',
			'CB',
			'CK',
			'poids',
			'largeur_nominale',
			'hauteur_nominale'
		);
		
		
		//on associe les variables dans l'objet colonnes
		for($a=0; $a<count($colonnes_valeurs); $a++){
			$colonnes->$colonnes_valeurs[$a]='';
		}
		
		//on defini les valeurs  ces variables
		
		if($post->type_bois == 'bois_sciage'){
			$colonnes->largeur= 38*$post->plis_bois_sciage;
			
			//$tab_nominale = split('x',$post->colonnes_bois_sciage);
			//$colonnes->largeur_nominale= $tab_nominale[0];
			//$colonnes->hauteur_nominale= $tab_nominale[1];

			if($post->colonnes_bois_sciage=='2x3'){
				$colonnes->hauteur		= 64;
				$colonnes->Kzb_eps_Kzv	= 1.7;
				
			}else if($post->colonnes_bois_sciage=='2x4'){
				$colonnes->hauteur		= 89;
				$colonnes->Kzb_eps_Kzv	= 1.7;
				
			}else if($post->colonnes_bois_sciage=='2x6'){
				$colonnes->hauteur		= 140;
				$colonnes->Kzb_eps_Kzv	= 1.4;
				
			}else if($post->colonnes_bois_sciage=='2x8'){
				$colonnes->hauteur		= 184;
				$colonnes->Kzb_eps_Kzv	= 1.2;
				
			}else if($post->colonnes_bois_sciage=='2x10'){
				$colonnes->hauteur		= 235;
				$colonnes->Kzb_eps_Kzv	= 1.1;
				
			}else if($post->colonnes_bois_sciage=='2x12'){
				$colonnes->hauteur		= 286;
				$colonnes->Kzb_eps_Kzv	= 1.0;
			}
			$colonnes->Kzv = $colonnes->Kzb_eps_Kzv;

			switch ($colonnes->largeur){
				case '80':
					$colonnes->largeur_kzbg = 80;
					break;
				case '130':
					$colonnes->largeur_kzbg = 130;
					break;
				case '175':
					$colonnes->largeur_kzbg = 175;
					break;
				case '215':
					$colonnes->largeur_kzbg = 215;
					break;
				case '265':
					$colonnes->largeur_kzbg = 180;
					break;
				case '315':
					$colonnes->largeur_kzbg = 180;
					break;
				case '365':
					$colonnes->largeur_kzbg = 230;
					break;
			}
			
		}else if($post->type_bois == 'bois_scl'){
			$colonnes->largeur		= $post->largeur*$post->plis_bois_scl;
			$colonnes->hauteur		= $post->profondeur_bois_scl;
			
			$colonnes->Kzb_eps_Kzv	= pow((305/$colonnes->hauteur),(1/9));
			$colonnes->Kzv = 1;

			switch ($colonnes->largeur){
				case '80':
					$colonnes->largeur_kzbg = 80;
					break;
				case '130':
					$colonnes->largeur_kzbg = 130;
					break;
				case '175':
					$colonnes->largeur_kzbg = 175;
					break;
				case '215':
					$colonnes->largeur_kzbg = 215;
					break;
				case '265':
					$colonnes->largeur_kzbg = 180;
					break;
				case '315':
					$colonnes->largeur_kzbg = 180;
					break;
				case '365':
					$colonnes->largeur_kzbg = 230;
					break;
			}
		
		}else if($post->type_bois == 'bois_blc'){
			$colonnes->largeur		= $post->largeur;
			$colonnes->hauteur		= $post->profondeur_bois_blc;

			switch ($colonnes->largeur){
				case '80':
					$colonnes->largeur_kzbg = 80;
					break;
				case '130':
					$colonnes->largeur_kzbg = 130;
					break;
				case '175':
					$colonnes->largeur_kzbg = 175;
					break;
				case '215':
					$colonnes->largeur_kzbg = 215;
					break;
				case '265':
					$colonnes->largeur_kzbg = 180;
					break;
				case '315':
					$colonnes->largeur_kzbg = 180;
					break;
				case '365':
					$colonnes->largeur_kzbg = 230;
					break;
			}
			
			$colonnes->Kzv = 1;
		}else if($post->type_bois == 'bois_blc_nordic'){
			$colonnes->largeur		= $post->largeur;
			$colonnes->hauteur		= $post->profondeur_bois_blc_nordic;
			$colonnes->largeur_kzbg = $post->largeur;
			
			$colonnes->Kzv = 1;
		}else if($post->type_bois == 'bois_massif'){
			$colonnes->largeur		= $post->largeur;
			$colonnes->hauteur		= $post->profondeur_bois_massif;
			
			$colonnes->Kzb_eps_Kzv = $kzb[$colonnes->largeur][$colonnes->hauteur];
			$colonnes->Kzb = $colonnes->Kzb_eps_Kzv;
			$colonnes->Kzv = $colonnes->Kzb_eps_Kzv;

			switch ($colonnes->largeur){
				case '80':
					$colonnes->largeur_kzbg = 80;
					break;
				case '130':
					$colonnes->largeur_kzbg = 130;
					break;
				case '175':
					$colonnes->largeur_kzbg = 175;
					break;
				case '215':
					$colonnes->largeur_kzbg = 215;
					break;
				case '265':
					$colonnes->largeur_kzbg = 180;
					break;
				case '315':
					$colonnes->largeur_kzbg = 180;
					break;
				case '365':
					$colonnes->largeur_kzbg = 230;
					break;
			}
		}
		
		
		//on calcule CK et KL en dessous (juste avant de calculer le MR) 
		
		//------------------------------
		
		
		
		
		
//**********************************************************************

//**********************************************************************

	// VARIABLES A CALCULER
	//---------------------
	
	//si les donnes rentres sont bonnes
	//et QU'IL N'Y A PAS D'ERREUR 
	//on peut continuer le traitement.
	if(!isset($error)){
	
	
		//on modifie les donnes si l'utilisateur a choisit d'entrer les donnes en IMPRIAL
		if($post->systeme == "imp"){
			$hauteur_tmp			= $post->hauteur;
			$ax_neige_tmp			= $post->ax_neige;
			$ax_surcharge_tmp		= $post->ax_surcharge;
			$ax_permanente_tmp		= $post->ax_permanente;
			$ax_excentricite_tmp	= $post->ax_excentricite;
			$lat_vent_tmp			= $post->lat_vent;
			
			$post->hauteur			= Conversion::ConvertPiedsToMetre($post->hauteur);
			$post->ax_neige			= Conversion::ConvertLbToKn($post->ax_neige);
			$post->ax_surcharge		= Conversion::ConvertLbToKn($post->ax_surcharge);
			$post->ax_permanente	= Conversion::ConvertLbToKn($post->ax_permanente);
			$post->ax_excentricite	= Conversion::ConvertPoucesToMillimetre($post->ax_excentricite);
			$post->lat_vent			= Conversion::ConvertLbsurPiToKnsurM($post->lat_vent);
			
			if($show_debug){
				
				echo 'hauteur = '.$post->hauteur.'<br />';
				echo 'neige = '.$post->ax_neige.'<br />';
				echo 'surcharge = '.$post->ax_surcharge.'<br />';
				echo 'permanente = '.$post->ax_permanente.'<br />';
				echo 'excentricite = '.$post->ax_excentricite.'<br />';
				echo 'vent = '.$post->lat_vent.'<br />';
				
			}
			
		}
		
		if($post->axe_faible == "mi-hauteur"){
			$colonnes->CB = pow(((1.92 * ($post->hauteur / 2) * 1000 * $colonnes->hauteur)/pow($colonnes->largeur,2)),0.5);
		}
		else{
			$colonnes->CB = pow(((1.92 * $post->hauteur * 1000 * $colonnes->hauteur)/pow($colonnes->largeur,2)),0.5);
		}
		
		//On effectue un calcul pour connaitre le poids du colombage
		$colonnes->poids = $post->ax_permanente + ($densite_bois * 9.8 * (($colonnes->largeur/1000) * ($colonnes->hauteur/1000) * $post->hauteur));
		
		if($post->type_bois == 'bois_blc' || $post->type_bois == 'bois_blc_nordic'){
			for($a=0; $a<10;$a++){
				$colonnes->Kzbg[$a] = pow((130/$colonnes->largeur_kzbg),0.1) * pow((610/$colonnes->hauteur),0.1) * pow((9100/($post->hauteur*1000)),0.1);

				if($colonnes->Kzbg[$a] > 1.3){
					$colonnes->Kzbg[$a] = 1.3;
				}
				
			}
		}
		
		// RESISTANCE DES MONTANTS
		
		//on dfini les variables de resistance_montant
		$resistance_montant_valeurs=array(
			'aire',
			'module_section',
			'moment_inertie',
			'charge_euler',
			'Vr',
			'EI'
		);
		
		//on associe les variables dans l'objet resistance_montant
		for($a=0; $a<count($resistance_montant_valeurs); $a++){
			$resistance_montant->$resistance_montant_valeurs[$a]='';
		}
		
		//on associe les valeurs a ces variables
		$resistance_montant->aire 			= $colonnes->largeur*$colonnes->hauteur;
		
		$resistance_montant->module_section	= $colonnes->largeur*pow($colonnes->hauteur,2)/6;
		
		$resistance_montant->moment_inertie	= $colonnes->largeur*pow($colonnes->hauteur,3)/12;
		
		$resistance_montant->charge_euler	= pow(M_PI,2)*$classe->e05*$resistance_montant->moment_inertie/pow(($post->hauteur*$post->coef_longueur_efficace),2)/1000000000;
		
		/***
			PR, MR sont calcules en fonctions des 19 cas
			VR et EI sont caclculs plus bas
		***/
		
		
		
		
		
		//DETERMINATION DES 19 CAS POSSIBLES
		//----------------------------------
			
			
		//on declare les variables
		$tab_DPs					= array();
		$tab_wlateral				= array();
		$tab_kd						= array();
		$tab_Daxial_pondere			= array();
		$tab_Laxial_pondere			= array();
		$tab_Saxial_pondere			= array();
		$tab_Wlateral_pondere		= array();
		$tab_pf						= array();
		$tab_kc						= array();
		$tab_pr						= array();
		$tab_mr						= array();
		
		
		$un_sur_un_moins_pf_sur_pe	= array();
		$tab_Mw						= array();
		$tab_somme_moment			= array();
		$tab_somme_moment_prime		= array();
		$max_pf						= -1;
		$key_kd_pf					= '';
		$max_somme_moment			= -1;
		$max_somme_moment_prime		= -1;
		$tab_vf						= array();
		$max_vf						= -1;
		$maxRatioFlexion			= -1;
		
		
		
		// 1ER TABLEAU	
			
		// DPS
		for($a=0;$a<10;$a++){
		
			if($a==0 || $a==3 || $a==12){
				$tab_DPs[$a]=0;
				
			}else if($a==1 || $a==5 || $a==8 || $a==10 || $a==14 || $a==17){
				if($post->ax_surcharge==0){
					$tab_DPs[$a]=0;
				}else{
					$tab_DPs[$a]=$colonnes->poids/$post->ax_surcharge;
				}
				
			}else if($a==2 || $a==7 || $a==9 || $a==11 || $a==16 || $a==18 ){
				if($post->ax_neige==0){
					$tab_DPs[$a]=0;
				}else{
					$tab_DPs[$a]=$colonnes->poids/$post->ax_neige;
				}
				
			}else if($a==4 || $a==13){
				if($post->ax_surcharge==0){
					$tab_DPs[$a]=0;
				}else{
					$tab_DPs[$a]=$colonnes->poids/($post->ax_surcharge+(0.5*$post->ax_neige));
				}
			
			}else if($a==6 || $a==15){
				if($post->ax_neige+(0.5*$post->ax_surcharge) == 0){
					$tab_DPs[$a]=0;
				}else{
					$tab_DPs[$a]=$colonnes->poids/($post->ax_neige+(0.5*$post->ax_surcharge));
				}
			}
		}
		
		
		// Wlateral
		for($a=0;$a<10;$a++){
			if($a==0 || $a==1 || $a==2 || $a==4 || $a==6 || $a==10 || $a==11 || $a==13|| $a==15){
				$tab_wlateral[$a]=0;
			}else{
				$tab_wlateral[$a]=$post->lat_vent;
			}
		}
		
		
		// Kd
		for($a=0;$a<10;$a++){
			if($tab_DPs[$a]==0 && $tab_wlateral[$a]==0){
				$tab_kd[$a]=0.65;
				
			}else if($tab_wlateral[$a]>0){
				$tab_kd[$a]=1.15;
				
			}else if($tab_DPs[$a]>1){
			
				$tab_kd[$a]=1-(0.5*log($tab_DPs[$a],10));
				
				if($tab_kd[$a]<0.65){
					$tab_kd[$a]=0.65;
				}
			
			}else{
				$tab_kd[$a]=1;
			}
		}
			
		
		// Daxial pondere
		for($a=0;$a<10;$a++){
			if($a == 0){
				$tab_Daxial_pondere[$a] = 1.4 * $colonnes->poids;
			}else if($a>=1 && $a<=9){
				$tab_Daxial_pondere[$a] = 1.25 * $colonnes->poids;
			}else{
				$tab_Daxial_pondere[$a] = 0.9 * $colonnes->poids;
			}
		}
		
			
		// Laxial pondere
		for($a=0;$a<10;$a++){
			if($a==0 || $a==2 || $a==3 || $a==7 || $a==9 || $a==11 || $a==12 || $a==16 || $a==18){
				$tab_Laxial_pondere[$a] = 0;
			}else if($a==1 || $a==4 || $a==5 || $a==10 || $a==13 || $a==14){
				$tab_Laxial_pondere[$a] = 1.5*$post->ax_surcharge;
			} else if($a==6){
				$tab_Laxial_pondere[$a] = 1*$post->ax_surcharge;
			}else{
				$tab_Laxial_pondere[$a] = 0.5*$post->ax_surcharge;
			}

			if($post->cat_risque=='faible'){
				$tab_Laxial_pondere[$a] = $tab_Laxial_pondere[$a] * 0.8;
			}
		}
		
		// Saxial pondere
		for($a=0;$a<10;$a++){
			if($a==0 || $a==1 || $a==3 || $a==5 || $a==8 || $a==10 || $a==12 || $a==14 || $a==17){
				$tab_Saxial_pondere[$a] = 0;
			} else if($a==2 || $a==6 || $a==7 || $a==11 || $a==15 || $a==16 ){
				$tab_Saxial_pondere[$a] = 1.5 * $cat_risque->is_elu * $post->ax_neige;
			} else if($a==9){
				$tab_Saxial_pondere[$a] = 0.5 * $post->ax_neige;

				if($post->cat_risque=='faible'){
					$tab_Saxial_pondere[$a] = $tab_Saxial_pondere[$a] * 0.8;
				}
			} else{
				$tab_Saxial_pondere[$a] = $cat_risque->is_elu * $post->ax_neige;
			}
		}
			
		
		//Wlateral pondere
		for($a=0;$a<10;$a++){
			if($a==0 || $a==1 || $a==2 || $a==4 || $a==6 || $a==10 || $a==11 || $a==13 || $a==15){
				$tab_Wlateral_pondere[$a]=0;
			}else if($a==3 || $a==8 || $a==9 || $a==12 || $a==17 || $a==18){
				$tab_Wlateral_pondere[$a]=1.4*$cat_risque->iw_elu*$post->lat_vent;
			}else{
				$tab_Wlateral_pondere[$a]=0.4*$cat_risque->iw_elu*$post->lat_vent;
			}
		}
			
		// KZC	
		if($post->type_bois == 'bois_sciage' || $post->type_bois == 'bois_massif'){
			$Kzcd=6.3*pow($post->hauteur*1000*$colonnes->hauteur,-0.13);
			if($Kzcd>1.3){
				$Kzcd = 1.3;
			}
			
			if($post->axe_faible == "mi-hauteur"){
				$Kzcb= 6.3 * pow(($post->hauteur/2)*1000*$colonnes->largeur,-0.13);
			}
			else{
				$Kzcb=6.3*pow($post->hauteur*1000*$colonnes->largeur,-0.13);
			}
			if($Kzcb > 1.3){
				$Kzcb = 1.3;
			}
		}else if($post->type_bois == 'bois_scl'){

			$Kzcd = 1;
			$Kzcb = 1;
			
		}else /*if(if($post->type_bois == 'bois_blc')*/{
			$Kzcd =0.68*pow((($colonnes->largeur/1000)*($colonnes->hauteur/1000)*$post->hauteur),-0.13);
			
			if($Kzcd>1){
				$Kzcd = 1;
			}
			$Kzcb = $Kzcd;
		}
		
		
		$coeficient_Ccd = $post->hauteur * 1000 * $post->coef_longueur_efficace / $colonnes->hauteur;
		if($post->axe_faible == "mi-hauteur"){
			$coeficient_Ccb = ($post->hauteur / 2) * 1000 * $post->coef_longueur_efficace / $colonnes->largeur;
		} else if($post->axe_faible == "oui"){
			$coeficient_Ccb = 0;
		} else{
			$coeficient_Ccb = $post->hauteur * 1000 * $post->coef_longueur_efficace / $colonnes->largeur;
		}


		if($post->axe_faible == "oui"){
			if($coeficient_Ccd>50){
				$error = ERROR_CC_BIGGER;
			}		
		}
		else{
			if($coeficient_Ccd>50 || $coeficient_Ccb>50){
				$error = ERROR_CC_BIGGER;
			}
		}
		
		
		for($a=0;$a<10;$a++){
			$tab_kcd[$a] = 1/(1+((($classe->fc * $tab_kd[$a])* $Kzcd * (pow($coeficient_Ccd,3)/(35*$classe->e05)))));
			$tab_kcb[$a] = 1/(1+((($classe->fc * $tab_kd[$a])* $Kzcb * (pow($coeficient_Ccb,3)/(35*$classe->e05)))));

			/*echo '<pre>';
			print_r('cas: '.$a);
			echo '<br/>';
			print_r('KZCB: '.$Kzcb);
			echo '<br/>';
			echo '</pre>';*/
		}
		
		
		// PR
		for($a=0;$a<10;$a++){
			$tab_prd[$a] = (0.8 * $classe->fc * $tab_kd[$a] * $resistance_montant->aire * $Kzcd * $tab_kcd[$a]/1000);
			$tab_prb[$a] = ((0.8 * $classe->fc * $tab_kd[$a] * $resistance_montant->aire * $Kzcb * $tab_kcb[$a]) / 1000) * $coefficient_attache;

			/*echo '<pre>';
			print_r('cas: '.$a);
			echo '<br/>';
			print_r('KD: '.$tab_kd[$a]);
			echo '<br/>';
			print_r('Résistance: '.$resistance_montant->aire);
			echo '<br/>';
			print_r('KZCB: '.$Kzcb);
			echo '<br/>';
			print_r('KCB: '.$tab_kcb[$a]);
			echo '<br/>';
			print_r('Coefficient: '.$coefficient_attache);
			echo '</pre>';*/
			
			if($post->axe_faible == "oui"){
				$tab_pr[$a] = $tab_prd[$a];
			}else /*if($post->axe_faible == "non")*/{
				$tab_pr[$a] = min($tab_prd[$a],$tab_prb[$a]);
			}
		}
		
		
		//CK
		for($a=0;$a<10;$a++){
			$colonnes->CK[$a] = pow(((0.97 * $classe->e)/($classe->fb*$tab_kd[$a])),0.5);
		}
		
		//KL
		for($a=0;$a<10;$a++){
			if($post->axe_faible == "oui"){
				$colonnes->KL[$a] = 1;
			}else{
				if($colonnes->CB<10){
					$colonnes->KL[$a] = 1;
					
				}else if($colonnes->CB>=10 && $colonnes->CB <$colonnes->CK[$a] && $colonnes->CB<50){
					$colonnes->KL[$a] = 1- ((1/3)*pow(($colonnes->CB/$colonnes->CK[$a]),4));
					
				}else if($colonnes->CB>=$colonnes->CK[$a] && $colonnes->CB<50){
					$colonnes->KL[$a] = (0.65*$classe->e)/(pow($colonnes->CB,2) * $classe->fb * $tab_kd[$a]);
				
				}else /* if($colonnes->CB>50)*/{
					$error = ERROR_CB_BIGGER;
					$colonnes->KL[$a] = 1;
				}

				if($post->type_bois == 'bois_blc' || $post->type_bois == 'bois_blc_nordic'){
					if(($colonnes->hauteur / $colonnes->largeur) < 2.5){
						$colonnes->KL[$a] = 1;
					}
				} else{
					if(($colonnes->hauteur / $colonnes->largeur) < 4){
						$colonnes->KL[$a] = 1;
					}
				}
			}
		}




		
		//Kzb
		if($post->type_bois == 'bois_sciage' || $post->type_bois == 'bois_scl' || $post->type_bois == 'bois_massif'){
		
			$colonnes_Kzb_eps_Kzv_TMP = $colonnes->Kzb_eps_Kzv;
			
			if($post->type_bois == 'bois_sciage' && substr($post->classe_bois_sciage,0,3)=='msr'){
				$colonnes_Kzb_eps_Kzv_TMP= 1;
			}
			
		}else if($post->type_bois=="bois_blc" || $post->type_bois == "bois_blc_nordic"){
			for($a=0;$a<10;$a++){
				$colonnes_Kzb_eps_Kzv[$a] = min($colonnes->Kzbg[$a],$colonnes->KL[$a]);
			}
		}
		
		//MR
		for($a=0;$a<10;$a++){
			if($post->type_bois == 'bois_sciage'){
			
				$tab_mr[$a] = 0.9 * $classe->fb * $tab_kd[$a] * $resistance_montant->module_section * $colonnes_Kzb_eps_Kzv_TMP * $colonnes->KL[$a] * ($classe->khc/1000000);
				
			}else if($post->type_bois == 'bois_scl'){
				
				$tab_mr[$a] = 0.9 * $classe->fb * $tab_kd[$a] * $resistance_montant->module_section * $colonnes_Kzb_eps_Kzv_TMP * ($colonnes->KL[$a] /1000000) * $classe->khc;
				
			} else if($post->type_bois == 'bois_massif'){

				$tab_mr[$a] = 0.9 * $classe->fb * $tab_kd[$a] * $resistance_montant->module_section * $colonnes_Kzb_eps_Kzv_TMP * ($colonnes->KL[$a] /1000000);

			}else{
				$tab_mr[$a] = 0.9 * $classe->fb * $tab_kd[$a] * $resistance_montant->module_section * ($colonnes_Kzb_eps_Kzv[$a]/1000000);
			}
		}
			
		
		
		
		// 2EME TABLEAU	
			
		//Pf de la somme des axial
		for($a=0;$a<10;$a++){	
			//$tab_pf[$a] = ($tab_Daxial_pondere[$a] + $tab_Laxial_pondere[$a] + $tab_Saxial_pondere[$a]);

			/*if($a == 9):
				$tab_pf[$a] = ($tab_Daxial_pondere[$a] + $tab_Laxial_pondere[$a] + 7.5);
			else:
				$tab_pf[$a] = ($tab_Daxial_pondere[$a] + $tab_Laxial_pondere[$a] + $tab_Saxial_pondere[$a]);
			endif;*/
			$tab_pf[$a] = ($tab_Daxial_pondere[$a] + $tab_Laxial_pondere[$a] + $tab_Saxial_pondere[$a]);
		
			//si pf est plus grand que la charge d'euler, erreur.
			if($tab_pf[$a]>$resistance_montant->charge_euler){
				$error = ERROR_CHARGE_EULER;
			}

			if($tab_pf[$a] > $max_pf){
				//ON SORT LE MAXIMUM
				$max_pf = $tab_pf[$a];
				$output->compression_app=$max_pf;
				$kd_pf=$tab_kd[$a];
				$key_kd_pf=$a;
				//on sort la compression(pr) associe au max de pf
				$output->compression_res = $tab_pr[$a];
			}
		}
		
		
		//1 / (1 - Pf / PE)
		for($a=0;$a<10;$a++){
			if($resistance_montant->charge_euler==0){
				$un_sur_un_moins_pf_sur_pe[$a] = 0;
			}else{
				$un_sur_un_moins_pf_sur_pe[$a] = (1/(1-($tab_pf[$a]/$resistance_montant->charge_euler)));
			}
		}
		
		//Mw
		for($a=0;$a<10;$a++){
			$tab_Mw[$a] = $tab_Wlateral_pondere[$a]*($post->hauteur*$post->hauteur)/8;
		}
			
		//Somme des Moment
		$arrMfCombTop = [];
		for($a=0;$a<10;$a++){
			$tab_m_top[$a] = $tab_pf[$a]*($post->ax_excentricite/1000);
			$tab_m_mid[$a] = $tab_Mw[$a] + $tab_m_top[$a]/2;
			$tab_mf_flexion[$a] = max($tab_m_top[$a], $tab_m_mid[$a]);
			$tab_mf_comb[$a] = max($tab_m_top[$a], ($tab_m_mid[$a]*$un_sur_un_moins_pf_sur_pe[$a]));
			$tab_mf_sur_mr[$a] = $tab_mf_flexion[$a] / $tab_mr[$a];

			//$tab_m_mid_prime[$a] = ($tab_Mw[$a] + $tab_m_mid[$a]) * $un_sur_un_moins_pf_sur_pe[$a];
			$tab_m_mid_prime[$a] = $tab_Mw[$a] + (0.5 * $tab_pf[$a]) * ($post->ax_excentricite/1000);

			if($tab_m_top[$a] > ($tab_m_mid[$a]*$un_sur_un_moins_pf_sur_pe[$a])):
				$tab_mf_comb[$a] = $tab_m_top[$a];
				$arrMfCombTop[$a] = 'top';
			else:
				$tab_mf_comb[$a] = ($tab_m_mid[$a]*$un_sur_un_moins_pf_sur_pe[$a]);
				$arrMfCombTop[$a] = 'mid';
			endif;
			
			if($tab_Mw[$a] == 0){
				//$tab_somme_moment[$a] = ($tab_pf[$a]*$post->ax_excentricite/1000);
				$tab_somme_moment[$a] = max($tab_m_top[$a], $tab_m_mid_prime[$a]);
			} else{
				//$tab_somme_moment[$a] = ($tab_pf[$a]*$post->ax_excentricite/1000/2)+$tab_Mw[$a];
				$tab_somme_moment[$a] = $tab_m_mid_prime[$a];
			}

			//if($tab_somme_moment[$a] > $max_somme_moment){
				//ON SORT LE MAXIMUM
				//on sort le Mf max
				//$output->flexion_app = $tab_somme_moment[$a];
				//on sort le Mr associ au mf max
				//$output->flexion_res = $tab_mr[$a];
				
				//$kd_somme_moment=$tab_kd[$a];
			//}

			if(($tab_mf_flexion[$a] / $tab_mr[$a]) > $maxRatioFlexion){
				$output->flexion_app = $tab_mf_flexion[$a];
				$output->flexion_res = $tab_mr[$a];
			}
		}

		$output->flexion_app = $tab_mf_flexion[array_search(max($tab_mf_sur_mr), $tab_mf_sur_mr)];
		$output->flexion_res = $tab_mr[array_search(max($tab_mf_sur_mr), $tab_mf_sur_mr)];

		//rsort($tab_somme_moment);
		//rsort($tab_mr);
		$sortTabSommeMoment = $tab_somme_moment;
		rsort($sortTabSommeMoment);

		$sortTabMR = $tab_mr;
		rsort($sortTabMR);

		//$output->flexion_app = $sortTabSommeMoment[0];
		//$output->flexion_res = $sortTabMR[0];
			
		//Somme des Moment'
		for($a=0;$a<10;$a++){

				//$tab_somme_moment_prime[$a]= $tab_somme_moment[$a] * $un_sur_un_moins_pf_sur_pe[$a];
			$tab_somme_moment_prime[$a] = $tab_somme_moment[$a];
		}
			
			
		//Vf
		for($a=0;$a<10;$a++){
			if($post->hauteur == 0){
				$tab_vf[$a]=0;
			}else{
				$tab_vf[$a]= (($tab_Wlateral_pondere[$a] * $post->hauteur) / 2) + (($tab_pf[$a] * $post->ax_excentricite/1000) / $post->hauteur);
			}
			
			if($tab_vf[$a] > $max_vf){
				//ON SORT LE MAXIMUM
				$max_vf=$tab_vf[$a];
				$output->cisaillement_app=$max_vf;
				$kd_vf=$tab_kd[$a];
			}
			
		}	
			
			
		//Pf/Pr + Mf + Mr '
		
		$tab_Pf_Pr_Mf_Mr_prime		= array();
		$key_kd_Pf_Pr_Mf_Mr_prime	= 0;
		$max_Pf_Pr_Mf_Mr_prime		= -1;
		$maxRatioEfforts = -1;

		for($a=0;$a<10;$a++){
			
		//	$tab_Pf_Pr_Mf_Mr_prime[$a]=($tab_pf[$a]/$resistance_montant->Pr_flexion)+($tab_somme_moment_prime[$a]/$resistance_montant->Mr_flexion);
			$tab_Pf_Pr_Mf_Mr_prime[$a]= pow(($tab_pf[$a]/$tab_pr[$a]),2) + ($tab_mf_comb[$a]/$tab_mr[$a]);
			
			if($tab_Pf_Pr_Mf_Mr_prime[$a] > $max_Pf_Pr_Mf_Mr_prime){
				

				$max_Pf_Pr_Mf_Mr_prime = $tab_Pf_Pr_Mf_Mr_prime[$a];
				//$kd_Pf_Pr_Mf_Mr_prime=$tab_kd[$a];
				//$key_kd_Pf_Pr_Mf_Mr_prime=$a;
				
				//ON SORT l'effort combins appliqus pour Pf/Pr
				//$output->efforts_p_app =  $tab_pf[$a];
				//ON SORT l'effort combins appliqus pour Mf/Mr			
				//$output->efforts_m_app =  $tab_m_mid_prime[$a];
				//$output->efforts_m_app =  $tab_mf_comb[$a];
				//ON SORT l'amplification pour les notes concernant le moment
				$output_note->moment = round($un_sur_un_moins_pf_sur_pe[$a],2);
				
				//ON SORT MR asscoi au max 
				//$output->efforts_m_res = $tab_mr[$a];
				//ON SORT PR associ au max
				//$output->efforts_p_res = $tab_pr[$a];
			}			
		}

		$output->efforts_p_app =  $tab_pf[array_search(max($tab_Pf_Pr_Mf_Mr_prime), $tab_Pf_Pr_Mf_Mr_prime)];
		$output->efforts_m_app =  $tab_mf_comb[array_search(max($tab_Pf_Pr_Mf_Mr_prime), $tab_Pf_Pr_Mf_Mr_prime)];
		$mfCombPos = $arrMfCombTop[array_search(max($tab_Pf_Pr_Mf_Mr_prime), $tab_Pf_Pr_Mf_Mr_prime)];
		$output->efforts_m_res = $tab_mr[array_search(max($tab_Pf_Pr_Mf_Mr_prime), $tab_Pf_Pr_Mf_Mr_prime)];
		$output->efforts_p_res = $tab_pr[array_search(max($tab_Pf_Pr_Mf_Mr_prime), $tab_Pf_Pr_Mf_Mr_prime)];
		
		//ON SORT la flche sous la surcharge rsistants
		$output->fleche_surcharge_res = $post->hauteur*1000/$post->fleche_surcharge;
		
		//ON SORT la flche sous la surcharge rsistants
		$output->fleche_charge_tot_res = $post->hauteur*1000/$post->fleche_charge_totale;


		//-----------------------



			
			
		// RESISTANCE DES MONTANTS SUITE
		//------------------------------
	
			
			// VR (  partir de Fv)
			if($post->type_bois == 'bois_sciage'){
				$resistance_montant->Vr = ($classe->fv*$kd_vf*$colonnes->Kzv)*0.9*$resistance_montant->aire*(2/3) * $classe->khc/1000;
			}else{
				$resistance_montant->Vr = ($classe->fv*$kd_vf*$colonnes->Kzv)*0.9*$resistance_montant->aire*(2/3)/1000;
			}
			//ON SORT LA DONNEE

			$output->cisaillement_res = $resistance_montant->Vr;
			//-----------------------
			
			//EI ( partir de E)
			$resistance_montant->EI = $classe->e*$resistance_montant->moment_inertie;
			
			
			
		
		// FLECHES => DETERMINATION DES 10 CAS POSSIBLES
		//----------------------------------------------
			
			
			$tab_fleche_Daxial_pondere		= array();
			$tab_fleche_Laxial_pondere		= array();
			$tab_fleche_Saxial_pondere		= array();
			$tab_fleche_Wlateral_pondere	= array();
			$tab_fleche_pf					= array();
			$tab_fleche_amplification		= array();
			$tab_fleche_somme_moment		= array();
			$max_fleche_somme_moment		= -1;
			$tab_fleche_tot_pf				= array();
			$tab_fleche_tot_amplification	= array();
			$tab_fleche_tot_somme_moment	= array();
			$max_fleche_tot_somme_moment	= -1;
			
			for($a=0;$a<10;$a++){
			
				//Daxial
				$tab_fleche_Daxial_pondere[$a]=$colonnes->poids;
				
				//Laxial
				if($a==0 || $a==2 || $a==3 || $a==7 || $a==9){
					$tab_fleche_Laxial_pondere[$a]=0;
					
				}else if($a==1 || $a==4 || $a==5){
					$tab_fleche_Laxial_pondere[$a]=$post->ax_surcharge;
						
				}else{
					$tab_fleche_Laxial_pondere[$a]=0.5*$post->ax_surcharge;
				}
				
				//Saxial
				if($a==0 || $a==1 || $a==3 || $a==5 || $a==8){
					$tab_fleche_Saxial_pondere[$a]=0;
					
				}else if($a==2 || $a==6 || $a==7){
					$tab_fleche_Saxial_pondere[$a]=$cat_risque->is_els*$post->ax_neige;
						
				}else{
					$tab_fleche_Saxial_pondere[$a]=0.5*$cat_risque->is_els*$post->ax_neige;
				}
				
				//Wlateral
				if($a==0 || $a==1 || $a==2 || $a==4 || $a==6){
					$tab_fleche_Wlateral_pondere[$a]=0;
				
				}else if($a==3 || $a==8 || $a==9){
					$tab_fleche_Wlateral_pondere[$a]=$cat_risque->iw_els*$post->lat_vent;

				}else{
					$tab_fleche_Wlateral_pondere[$a]=0.4*$cat_risque->iw_els*$post->lat_vent;
				}
								
				
				//Pf de la somme des axial de la flche sous charge vive
				$tab_fleche_pf[$a]= ($tab_fleche_Laxial_pondere[$a] + $tab_fleche_Saxial_pondere[$a]) ;
				
			
				// Amplification
				if($resistance_montant->charge_euler==0){
					$tab_fleche_amplification[$a]=0;	
				}else{
					$tab_fleche_amplification[$a] = (1/(1-($tab_fleche_pf[$a]/$resistance_montant->charge_euler)));
				}
				
				//Moment
				$tab_fleche_somme_moment[$a]=((5*$tab_fleche_Wlateral_pondere[$a]*pow($post->hauteur,4))/(384*$resistance_montant->EI/1000000000000)+(($tab_fleche_pf[$a]*$post->ax_excentricite*pow($post->hauteur,2))/(16*$resistance_montant->EI)*1000000000))*$tab_fleche_amplification[$a];
				
				
				if($tab_fleche_somme_moment[$a]>$max_fleche_somme_moment){
					//ON SORT LE MAXIMUM
					$max_fleche_somme_moment = $tab_fleche_somme_moment[$a];
					$output->fleche_surcharge_app = $max_fleche_somme_moment;
					$output_note->fleche_surcharge = round($tab_fleche_amplification[$a],2);
				}
				
				
				
				//Pf de la somme des axial de la flche sous charge totale
				$tab_fleche_tot_pf[$a]= ($tab_fleche_Daxial_pondere[$a] + $tab_fleche_Laxial_pondere[$a] + $tab_fleche_Saxial_pondere[$a]) ;
				
				
				
				//Amplification
				if($resistance_montant->charge_euler==0){
					$tab_fleche_tot_amplification[$a]=0;
				}else{
					$tab_fleche_tot_amplification[$a] = (1/(1-($tab_fleche_tot_pf[$a]/$resistance_montant->charge_euler)));
				}
				
				//Moment
				$tab_fleche_tot_somme_moment[$a]=((5*$tab_fleche_Wlateral_pondere[$a]*pow($post->hauteur,4))/(384*$resistance_montant->EI/1000000000000)+(($tab_fleche_tot_pf[$a]*$post->ax_excentricite*pow($post->hauteur,2))/(16*$resistance_montant->EI)*1000000000))*$tab_fleche_tot_amplification[$a];
				
				if($tab_fleche_tot_somme_moment[$a]>$max_fleche_tot_somme_moment){
					//ON SORT LE MAXIMUM
					$max_fleche_tot_somme_moment = $tab_fleche_tot_somme_moment[$a];
					$output->fleche_charge_tot_app = $max_fleche_tot_somme_moment;
					$output_note->fleche_totale = round($tab_fleche_tot_amplification[$a],2);
				}
				
				
				
			}
			
		
		// VOLUME BOIS 
		//--------------
		
		
		//$vol_bois_colombage = ($colonnes->largeur * $colonnes->hauteur * (($post->hauteur*1000) - (3*$colonnes->largeur))/1000000000);
		//echo $vol_bois_colombage;
		//$vol_bois_lisse_sabliere = 3*$colonnes->largeur * $colonnes->hauteur/1000000;
		//$output->volume_bois = $vol_bois_colombage + $vol_bois_lisse_sabliere;

		
		//$output->pmp = $output->volume_bois/0.00525;		
		
		//Volume en pmp/pi de mur = [largeur_nominale x hauteur_nominale x hauteur du mur (en pieds) / 12] / 
		
		//$output->pmp = (3 * $colonnes->largeur_nominale * $colonnes->hauteur_nominale /12) + (($colonnes->largeur_nominale * $colonnes->hauteur_nominale * ((($post->hauteur*1000) - (3*$colonnes->largeur))/1000) * 3.28 /12) /3.28); 
		

		// VARIABLES DE SORTIE RATIO
		//--------------------------
	
		$html_champs_sortie_ratio=array(
			'flexion',
			'compression',
			'cisaillement',
			'efforts',
			'fleche_surcharge',
			'fleche_charge_tot'
		);
		
		//on dfini output et on les associe dans l'objet post.
		for($a=0; $a<count($html_champs_sortie_ratio); $a++){
			$output_ratio->$html_champs_sortie_ratio[$a]='';
		}
		
		$output_ratio->flexion 				= $output->flexion_app/$output->flexion_res*100;
		$output_ratio->compression 			= $output->compression_app/$output->compression_res*100;
		$output_ratio->cisaillement 		= $output->cisaillement_app/$output->cisaillement_res*100;
		
		$output_ratio->efforts 				= (pow(($output->efforts_p_app/$output->efforts_p_res),2)+($output->efforts_m_app/$output->efforts_m_res))*100;
		
		if($output->fleche_surcharge_res==0){
			$output_ratio->fleche_surcharge		= 0;
		}else{
			$output_ratio->fleche_surcharge 	= $output->fleche_surcharge_app/$output->fleche_surcharge_res*100;
		}
		
		
		if($output->fleche_charge_tot_res==0){
			$output_ratio->fleche_charge_tot	= 0;
		}else{
			$output_ratio->fleche_charge_tot	= $output->fleche_charge_tot_app/$output->fleche_charge_tot_res*100;
		}
		
			
		for($a=0; $a<count($html_champs_sortie_ratio); $a++){
			$output_ratio->$html_champs_sortie_ratio[$a]=round($output_ratio->$html_champs_sortie_ratio[$a]);
			
			$output_style->$html_champs_sortie_ratio[$a]='';
			if($output_ratio->$html_champs_sortie_ratio[$a]>100){
				$output_style->$html_champs_sortie_ratio[$a]=' class="error"';
			}
		}
		
		if($output->fleche_surcharge_app==0){
			$output_ratioTxt->surcharge = 0;
		}else{
			$output_ratioTxt->surcharge = round($post->hauteur /$output->fleche_surcharge_app*1000);
		}
		
		if($output->fleche_charge_tot_app == 0){
			$output_ratioTxt->charge_tot = 0;
		}else{
			$output_ratioTxt->charge_tot = round($post->hauteur /$output->fleche_charge_tot_app*1000);
		}
		
		//ON ARRONDI A 2 ChIFFRES TOUTES LES SORTIES
		for($a=0; $a<count($html_champs_sortie); $a++){
			$nbr_decimal = 2;
			//if($html_champs_sortie[$a] == 'volume_bois'){
				//$nbr_decimal = 3;
			//}
			$output->$html_champs_sortie[$a]=round($output->$html_champs_sortie[$a],$nbr_decimal);
		}
		
		
		//on modifie les donnes si l'utilisateur a choisit d'entrer les donnes en IMPRIAL
		if($post->systeme == "imp"){
			$post->hauteur			= $hauteur_tmp;
			$post->ax_excentricite	= $ax_excentricite_tmp;
			$post->ax_neige			= $ax_neige_tmp;
			$post->ax_surcharge		= $ax_surcharge_tmp;
			$post->ax_permanente	= $ax_permanente_tmp;
			$post->lat_vent			= $lat_vent_tmp;

			$output->flexion_app = $output->flexion_app * 737.5621492;
			$output->flexion_res = $output->flexion_res * 737.5621492;

			$output->compression_app = $output->compression_app / 0.00444822;
			$output->compression_res = $output->compression_res / 0.00444822;

			$output->cisaillement_app = $output->cisaillement_app / 0.00444822;
			$output->cisaillement_res = $output->cisaillement_res / 0.00444822;

			$output->efforts_p_app = $output->efforts_p_app / 0.00444822;
			$output->efforts_p_res = $output->efforts_p_res / 0.00444822;

			$output->efforts_m_app = $output->efforts_m_app * 737.5621492;
			$output->efforts_m_res = $output->efforts_m_res * 737.5621492;

			$output->fleche_surcharge_app = $output->fleche_surcharge_app / 25.4;
			$output->fleche_surcharge_res = $output->fleche_surcharge_res / 25.4;

			$output->fleche_charge_tot_app = $output->fleche_charge_tot_app / 25.4;
			$output->fleche_charge_tot_res = $output->fleche_charge_tot_res / 25.4;
		}
	}
		
?>