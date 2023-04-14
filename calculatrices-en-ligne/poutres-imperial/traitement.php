<?PHP

	require_once("class/Conversion.php");

	// VARIABLES DE SORTIES
	//---------------------
				
		$html_champs_sortie=array(
			'classe',
			'max_pourcentage',
			'max_critere'
		);
		
		//on associe les variables de $html_champs_sortie dans l'object output.
		for($a=0; $a<count($html_champs_sortie); $a++){
			$output->$html_champs_sortie[$a]='';
		}
	
	function verifCarac($champ){
	
		$tab_check_carac	= array(',','millimetre','millimtre','milimetre','milimtre','metre','mtre','pieds','pied','pouces','pouce','p','m','"','\'','%','\\');
		$tab_replace_carac	= array('.','','','','','','','','','','','','','','','','');
		
		$champ = str_replace($tab_check_carac,$tab_replace_carac,strtolower($champ));
		
		return $champ;
	}
	
	//VARIABLES FIXES
	//---------------
	
		//on regarde si on a bien choisi une variable pour type de poutrelle
		
		/*if($post->type_poutre==""){
			if(!isset($error)){
				$error = ERROR_TYPE_POUTRE_VIDE;
			}
		}*/
	
		//------------------------------
		
		//on effectue des modifications sur la porte ecrite a la main
	
		$post->portee = verifCarac($post->portee);
		
		//Si il y a un probleme avec cette variable, on stock un msg d'erreur
		if(!is_numeric($post->portee)){
			if(!isset($error)){
				$error = ERROR_PORTEE_NOMBRE;
			}
		}else{
		
			if((($post->portee > 4.88&& $post->systeme=="met") || (Conversion::ConvertPiedsToMetre($post->portee) > 4.88 && $post->systeme=="imp")) && $post->type_bois == "bois_sciage"){
				$error = ERROR_PORTEE_BIGGER;
			}else if($post->portee <= 0){
				//$post->hauteur = 0;
				$error = ERROR_PORTEE_SMALLER;
			}
		}
	
		//------------------------------
		
		//on effectue des modifications sur la hauteur ecrite a la main
		$post->surcharge = verifCarac($post->surcharge);
		
		//Si il y a un probleme avec cette variable, on stock un msg d'erreur
		if(!is_numeric($post->surcharge)){
			if(!isset($error)){
				$error = ERROR_SURCHARGE_NOMBRE;
			}
		}else{
			/*
			if($post->surcharge > 10){
				$error = ERROR_SURCHARGE_BIGGER;
			}else */if(($post->surcharge<0 && $post->systeme=="met") || (Conversion::ConvertLbsurPiTokNm($post->surcharge) <0 && $post->systeme=="imp")){
				//$post->hauteur = 0;
				$error = ERROR_SURCHARGE_SMALLER;
			}
		}
		
		//------------------------------
		
		//on effectue des modifications sur la hauteur ecrite a la main
		$post->morte = verifCarac($post->morte);
		
		//Si il y a un probleme avec cette variable, on stock un msg d'erreur
		if(!is_numeric($post->morte)){
			if(!isset($error)){
				$error = ERROR_MORTE_NOMBRE;
			}
		}else{/*
			if($post->morte > 10){
				$error = ERROR_MORTE_BIGGER;
			}else */if(($post->morte < 0.1 && $post->systeme=="met") || (Conversion::ConvertLbsurPiTokNm($post->morte) < 0.1 && $post->systeme=="imp")){
				//$post->hauteur = 0;
				$error = ERROR_MORTE_SMALLER;
			}
		}

		//------------------------------
			
		// Si la longueur des intervalles est plus grande que la portée, on met un message d'erreur
		if($post->intervalles >= ($post->portee*1000)){
			$error = ERROR_INTERVALLES;
		}
		
		//on dfini les variables de la class classe
		$classe_valeurs=array(
			'fb',
			'fv',
			'fc',
			'fcp',
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
			/*if($post->classe=='eps_select'){
				$classe->fb			= 16.5;
				$classe->fc			= 14.5;
				$classe->e			= 10500;
				$classe->e05		= 7500;
				
			}else */if($post->classe_bois_sciage=='eps_no1_2'){
				$classe->fb			= 11.8;
				$classe->fc			= 11.5;
				$classe->fcp		= 5.3;
				$classe->e			= 9500;
				$classe->e05		= 6500;

			}else if($post->classe_bois_sciage=='msr1650'){
				$classe->fb			= 23.9;
				$classe->fc			= 18.1;
				$classe->fcp		= 5.3;
				$classe->e			= 10300;
				$classe->e05		= 8446;
			
			}else if($post->classe_bois_sciage=='msr1950'){
				$classe->fb			= 28.2;
				$classe->fc			= 19.3;
				$classe->fcp		= 5.3;
				$classe->e			= 11700;
				$classe->e05		= 9594;
			
			}else if($post->classe_bois_sciage=='msr2100'){
				$classe->fb			= 30.4;
				$classe->fc			= 19.9;
				$classe->fcp		= 6.5;
				$classe->e			= 12400;
				$classe->e05		= 10168;
				$densite_bois		= 0.47;
			
			}else if($post->classe_bois_sciage=='msr2400'){
				$classe->fb			= 34.7;
				$classe->fc			= 21.1;
				$classe->fcp		= 6.5;
				$classe->e			= 13800;
				$classe->e05		= 11316;
				$densite_bois		= 0.5;
			}
			
			
		}else if($post->type_bois == 'bois_scl'){	
			
			
			if($post->classe_bois_scl == '1_5'){
				$classe->e			= 10300;
				$classe->fb			= 25.8;
				$classe->fv			= 2.65;
				$classe->fc			= 21.95;
				$classe->fcp		= 6.95;
				
			}else if($post->classe_bois_scl == '1_7'){
				$classe->e			= 11700;
				$classe->fb			= 29.7;
				$classe->fv			= 3.60;
				$classe->fc			= 26.20;
				$classe->fcp		= 9.05;
				
			}else if($post->classe_bois_scl == '1_8'){
				$classe->e			= 12400;
				$classe->fb			= 31.7;
				$classe->fv			= 3.60;
				$classe->fc			= 28.35;
				$classe->fcp		= 9.35;
			
			}else if($post->classe_bois_scl == '1_9'){
				$classe->e			= 13100;
				$classe->fb			= 33.6;
				$classe->fv			= 3.60;
				$classe->fc			= 30.45;
				$classe->fcp		= 9.35;
			
			}else if($post->classe_bois_scl == '2'){
				$classe->e			= 13800;
				$classe->fb			= 35.6;
				$classe->fv			= 3.65;
				$classe->fc			= 32.6;
				$classe->fcp		= 9.35;
			
			}else if($post->classe_bois_scl == '2_1'){
				$classe->e			= 14500;
				$classe->fb			= 37.55;
				$classe->fv			= 3.65;
				$classe->fc			= 34.75;
				$classe->fcp		= 9.35;
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
				$classe->fcp		= 5.8;
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
				$classe->fcp		= 7;
				$classe->e			= 12400;
			
			}else if($post->classe_bois_blc=='dm_24fex'){
				$classe->fb			= 30.6;
				$classe->fv			= 2;
				$classe->fc			= 30.2;
				$classe->fcp		= 7;
				$classe->e			= 12800;
			}
			
			$classe->e05		= 0.87*$classe->e;
				
		}elseif($post->type_bois == 'bois_blc_nordic'){
			
			$densite_bois		= 0.56;
			
			$classe->fb			= 30.7;
			$classe->fv			= 2.5;
			$classe->fc			= 33;
			$classe->fcp		= 7.5;
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
					'densite_bois' 	=> 0.49,
					'fcp'			=> 7,
					'ss' => array( 'fb' => 18.3, 	'fv' => 1.5,	'fc' => 13.8,	'e' => 12000,	'e05' => 8000),
					'n1' => array( 'fb' => 13.8, 	'fv' => 1.5,	'fc' => 12.2,	'e' => 10500,	'e05' => 6500),
					'n2' => array( 'fb' => 6, 		'fv' => 1.5,	'fc' => 7.5,	'e' => 9500,	'e05' => 6000),
				),
				'P-S' => array(
					'densite_bois' 	=> 0.46,
					'fcp'			=> 4.6,
					'ss' => array( 'fb' => 13.6, 	'fv' => 1.2,	'fc' => 11.3,	'e' => 10000,	'e05' => 7000),
					'n1' => array( 'fb' => 10.2, 	'fv' => 1.2,	'fc' => 10,		'e' => 9000,	'e05' => 6000),
					'n2' => array( 'fb' => 4.5, 	'fv' => 1.2,	'fc' => 6.1,	'e' => 8000,	'e05' => 5500),
				),
				'E-P-S' => array(
					'densite_bois' 	=> 0.42,
					'fcp'			=> 5.3,
					'ss' => array( 'fb' => 12.7, 	'fv' => 1.2,	'fc' => 9.9,	'e' => 8500,	'e05' => 6000),
					'n1' => array( 'fb' => 9.6, 	'fv' => 1.2,	'fc' => 8.7,	'e' => 7500,	'e05' => 5000),
					'n2' => array( 'fb' => 4.2, 	'fv' => 1.2,	'fc' => 5.4,	'e' => 6500,	'e05' => 4500),
				),
				'Nordique' => array(
					'densite_bois' 	=> 0.35,
					'fcp'			=> 3.5,
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
			$classe->fv			= $massif_temp['fv'];
			$classe->fc			= $massif_temp['fc'];
			$classe->fcp		= $constantes[$post->essence_bois_massif]['fcp'];
		}

		//on defini les variables de l'objet colonnes
		$colonnes_valeurs=array(
			'largeur',
			'hauteur',
			'khb',
			'khv',
			'z',
			's',
			'largeur_pli',
			'Kzb_eps_Kzv',
			'Kzb',
			'Kzv',
			'poids',
			'largeur_nominale',
			'hauteur_nominale',
			'Kzbg',
			'largeur_kzbg',
			'kzcp'
		);
		
		
		//on associe les variables dans l'objet colonnes
		for($a=0; $a<count($colonnes_valeurs); $a++){
			$colonnes->$colonnes_valeurs[$a]='';
		}
		
		//on defini les valeurs  ces variables
		
		if($post->type_bois == 'bois_sciage'){
			$colonnes->largeur= 38*$post->plis_bois_sciage;

			if($post->plis_bois_sciage == 1){
				$colonnes->khb = 1;
				$colonnes->khv = 1;
			}
			else{
				$colonnes->khb = 1.1;
				$colonnes->khv = 1.1;
			}

			$colonnes->largeur_pli = 38;
			
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

			if($post->classe_bois_sciage == 'eps_no1_2'):
				$colonnes->Kzb = $colonnes->Kzb_eps_Kzv;
				$colonnes->Kzv = $colonnes->Kzb_eps_Kzv;
			else:
				$colonnes->Kzb = 1;
				$colonnes->Kzv = $colonnes->Kzb_eps_Kzv;
			endif;

			$colonnes->kzcp = 1;

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
			$colonnes->largeur		= $post->plis_bois_scl*$post->largeur;
			$colonnes->hauteur		= $post->profondeur_bois_scl;

			if($post->plis_bois_scl == 1 || $post->plis_bois_scl == 2){
				$colonnes->khb = 1;
			}
			else{
				$colonnes->khb = 1.04;
			}

			$colonnes->khv = 1;

			$colonnes->largeur_pli = $post->largeur;
			
			$colonnes->Kzb_eps_Kzv	= pow((305/$colonnes->hauteur),(1/9));
			$colonnes->Kzb	= $colonnes->Kzb_eps_Kzv;
			$colonnes->Kzv = 1;

			$colonnes->kzcp = 1;

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

			$colonnes->khb = 1;
			$colonnes->khv = 1;

			$colonnes->largeur_pli = $post->largeur;
			
			$colonnes->Kzb_eps_Kzv = 1;
			$colonnes->Kzb = 1;
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

			$colonnes->kzcp = 1.15;
		}else if($post->type_bois == 'bois_blc_nordic'){
			$colonnes->largeur		= $post->largeur;
			$colonnes->hauteur		= $post->profondeur_bois_blc_nordic;

			$colonnes->khb = 1;
			$colonnes->khv = 1;

			$colonnes->largeur_pli = $post->largeur;
			
			$colonnes->Kzb_eps_Kzv = 1;
			$colonnes->Kzb = 1;
			$colonnes->Kzv = 1;

			$colonnes->largeur_kzbg = $post->largeur;

			$colonnes->kzcp = 1.15;
		}else if($post->type_bois == 'bois_massif'){
			$colonnes->largeur		= $post->largeur;
			$colonnes->hauteur		= $post->profondeur_bois_massif;

			$colonnes->khb = 1;
			$colonnes->khv = 1;

			$colonnes->largeur_pli = $post->largeur;
			
			$colonnes->Kzb_eps_Kzv = 1;
			$colonnes->Kzb = 1;
			$colonnes->Kzv = 1;

			if($post->largeur == 140 && ($post->profondeur_bois_massif == 140 || $post->profondeur_bois_massif == 191)):
				$colonnes->Kzb = 1.3;
				$colonnes->Kzv = 1.3;
			elseif($post->largeur == 140 && $post->profondeur_bois_massif == 241):
				$colonnes->Kzb = 1.2;
				$colonnes->Kzv = 1.2;
			elseif($post->largeur == 140 && $post->profondeur_bois_massif == 292):
				$colonnes->Kzb = 1.1;
				$colonnes->Kzv = 1.1;
			elseif($post->largeur == 140 && $post->profondeur_bois_massif == 394):
				$colonnes->Kzb = 0.9;
				$colonnes->Kzv = 0.9;
			elseif($post->largeur == 191 && $post->profondeur_bois_massif == 191):
				$colonnes->Kzb = 1.3;
				$colonnes->Kzv = 1.3;
			elseif($post->largeur == 191 && $post->profondeur_bois_massif == 241):
				$colonnes->Kzb = 1.2;
				$colonnes->Kzv = 1.2;
			elseif($post->largeur == 191 && $post->profondeur_bois_massif == 292):
				$colonnes->Kzb = 1.1;
				$colonnes->Kzv = 1.1;
			elseif($post->largeur == 191 && $post->profondeur_bois_massif == 394):
				$colonnes->Kzb = 0.9;
				$colonnes->Kzv = 0.9;
			elseif($post->largeur == 241 && $post->profondeur_bois_massif == 241):
				$colonnes->Kzb = 1.2;
				$colonnes->Kzv = 1.2;
			elseif($post->largeur == 241 && $post->profondeur_bois_massif == 292):
				$colonnes->Kzb = 1.1;
				$colonnes->Kzv = 1.1;
			elseif($post->largeur == 241 && $post->profondeur_bois_massif == 394):
				$colonnes->Kzb = 0.9;
				$colonnes->Kzv = 0.9;
			elseif($post->largeur == 292 && $post->profondeur_bois_massif == 292):
				$colonnes->Kzb = 1.1;
				$colonnes->Kzv = 1.1;
			elseif($post->largeur == 292 && $post->profondeur_bois_massif == 394):
				$colonnes->Kzb = 0.9;
				$colonnes->Kzv = 0.9;
			elseif($post->largeur == 343 && $post->profondeur_bois_massif == 394):
				$colonnes->Kzb = 0.9;
				$colonnes->Kzv = 0.9;
			elseif($post->largeur == 394 && $post->profondeur_bois_massif == 394):
				$colonnes->Kzb = 0.9;
				$colonnes->Kzv = 0.9;
			endif;

			$colonnes->kzcp = 1;
			
			if(($colonnes->hauteur-$colonnes->largeur) > 51):
				if($post->essence_bois_massif == 'D-M'):
					if($post->classe_bois_massif == 'ss'):
						$classe->fb = 19.5;
						$classe->e = 12000;
						$classe->e05 = 8000;
					elseif($post->classe_bois_massif == 'n1'):
						$classe->fb = 15.8;
						$classe->e = 12000;
						$classe->e05 = 8000;
					else: // n2
						$classe->fb = 9;
						$classe->e = 9500;
						$classe->e05 = 6000;
					endif;
				elseif($post->essence_bois_massif == 'P-S'):
					if($post->classe_bois_massif == 'ss'):
						$classe->fb = 14.5;
						$classe->e = 10000;
						$classe->e05 = 7000;
					elseif($post->classe_bois_massif == 'n1'):
						$classe->fb = 11.7;
						$classe->e = 10000;
						$classe->e05 = 7000;
					else: // n2
						$classe->fb = 6.7;
						$classe->e = 8000;
						$classe->e05 = 5500;
					endif;
				elseif($post->essence_bois_massif == 'E-P-S'):
					if($post->classe_bois_massif == 'ss'):
						$classe->fb = 13.6;
						$classe->e = 8500;
						$classe->e05 = 6000;
					elseif($post->classe_bois_massif == 'n1'):
						$classe->fb = 11;
						$classe->e = 8500;
						$classe->e05 = 6000;
					else: // n2
						$classe->fb = 6.3;
						$classe->e = 6500;
						$classe->e05 = 4500;
					endif;
				else: // Nordique
					if($post->classe_bois_massif == 'ss'):
						$classe->fb = 12.8;
						$classe->e = 8000;
						$classe->e05 = 5500;
					elseif($post->classe_bois_massif == 'n1'):
						$classe->fb = 10.8;
						$classe->e = 8000;
						$classe->e05 = 5500;
					else: // n2
						$classe->fb = 5.9;
						$classe->e = 6000;
						$classe->e05 = 4000;
					endif;
				endif;
			else:
				if($post->essence_bois_massif == 'D-M'):
					if($post->classe_bois_massif == 'ss'):
						$classe->fb = 18.3;
						$classe->e = 12000;
						$classe->e05 = 8000;
					elseif($post->classe_bois_massif == 'n1'):
						$classe->fb = 13.8;
						$classe->e = 10500;
						$classe->e05 = 6500;
					else: // n2
						$classe->fb = 6;
						$classe->e = 9500;
						$classe->e05 = 6000;
					endif;
				elseif($post->essence_bois_massif == 'P-S'):
					if($post->classe_bois_massif == 'ss'):
						$classe->fb = 13.6;
						$classe->e = 10000;
						$classe->e05 = 7000;
					elseif($post->classe_bois_massif == 'n1'):
						$classe->fb = 10.2;
						$classe->e = 9000;
						$classe->e05 = 6000;
					else: // n2
						$classe->fb = 4.5;
						$classe->e = 8000;
						$classe->e05 = 5500;
					endif;
				elseif($post->essence_bois_massif == 'E-P-S'):
					if($post->classe_bois_massif == 'ss'):
						$classe->fb = 12.7;
						$classe->e = 8500;
						$classe->e05 = 6000;
					elseif($post->classe_bois_massif == 'n1'):
						$classe->fb = 9.6;
						$classe->e = 7500;
						$classe->e05 = 5000;
					else: // n2
						$classe->fb = 4.2;
						$classe->e = 6500;
						$classe->e05 = 4500;
					endif;
				else: // Nordique
					if($post->classe_bois_massif == 'ss'):
						$classe->fb = 12;
						$classe->e = 8000;
						$classe->e05 = 5500;
					elseif($post->classe_bois_massif == 'n1'):
						$classe->fb = 9;
						$classe->e = 7000;
						$classe->e05 = 5000;
					else: // n2
						$classe->fb = 3.9;
						$classe->e = 6000;
						$classe->e05 = 4000;
					endif;
				endif;
			endif;

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
			$portee_tmp			= $post->portee;
			$intervalles_tmp 	= $post->intervalles;
			$neige_tmp			= $post->neige;
			$surcharge_tmp		= $post->surcharge;
			$morte_tmp			= $post->morte;
			
			$post->portee		= Conversion::ConvertPiedsToMetre($post->portee);
			$post->intervalles	= Conversion::ConvertPoucesToMillimetre($post->intervalles);
			$post->neige		= Conversion::ConvertLbsurPiTokNm($post->neige);
			$post->surcharge	= Conversion::ConvertLbsurPiTokNm($post->surcharge);
			$post->morte		= Conversion::ConvertLbsurPiTokNm($post->morte);
		}
	
		$colonnes->poids = $post->morte + (($densite_bois * 9.8 * (($colonnes->largeur/1000) * ($colonnes->hauteur/1000) * $post->portee)) / $post->portee);
		$colonnes->s = $colonnes->largeur*pow($colonnes->hauteur,2)/6;
		$colonnes->z = $colonnes->largeur / 1000 * $colonnes->hauteur / 1000 * $post->portee;
		
		$ls_elu = $post->cat_risque == 'faible' ? 0.8 : 1;
		$facteur_code = 1;

		if($post->type_bois == 'bois_blc' || $post->type_bois == 'bois_blc_nordic'){
			$colonnes->Kzbg = pow((130/$colonnes->largeur_kzbg),0.1) * pow((610/$colonnes->hauteur),0.1) * pow((9100/($post->portee*1000)),0.1);

			if($colonnes->Kzbg > 1.3){
				$colonnes->Kzbg = 1.3;
			}
		}

		
		$elu = array(
			1 => array( 'D' => 1.4 , 	'L' => 0, 							'S' => 0,									'Ps' => 0 ),
			2 => array( 'D' => 1.25 , 	'L' => 1.5 * $ls_elu, 				'S' => 0,									'Ps' => $post->surcharge ),
			3 => array( 'D' => 1.25 , 	'L' => 1.5 * $ls_elu, 				'S' => $facteur_code * $cat_risque->is_elu,	'Ps' => $post->surcharge + 0.5 * $post->neige ),
			4 => array( 'D' => 1.25 , 	'L' => 0, 							'S' => 1.5 * $cat_risque->is_elu,			'Ps' => $post->neige ),
			5 => array( 'D' => 1.25 , 	'L' => $facteur_code * $ls_elu, 	'S' => 1.5 * $cat_risque->is_elu,			'Ps' => 0.5 * $post->surcharge + $post->neige )
		);

		$tab_welu = array();

		$tab_mf = array();
		$tab_mr = array();
		$tab_vf = array();
		$tab_vr = array();
		$tab_wf = array();
		$tab_wr = array();	

		$tab_kd = array();
		$tab_fb = array();
		$tab_cb = array();
		$tab_ck = array();
		$tab_kl = array();
		$tab_fv = array();

		$tab_lb = array();

		$tab_fcp = array();


		$max_mf = 0;
		$max_mr = 0;
		$max_ratio_mf_mr = 0;
		$max_vf = 0;
		$max_vf_atd = 0;
		$max_vr = 0;
		$max_ratio_vf_atd_vr = 0;
		$max_wf = 0;
		$max_wr = 0;
		$max_ratio_wf_wr = 0;

		$max_lb = 0;


		//LU
		if($post->rive_comprimee_retenue == 'longueur'){ $lu = 0; }
		else if($post->rive_comprimee_retenue == 'extremites'){ $lu = $post->portee * 1000; }
		else if($post->rive_comprimee_retenue == 'intervalles'){ $lu = $post->intervalles; }	

		foreach($elu as $key => $charges){

			$tab_welu[$key] = $charges['D'] * $colonnes->poids + $charges['L'] * $post->surcharge + $charges['S'] * $post->neige;
			//$tab_welu[$key] = $charges['D'] * 5 + $charges['L'] * 20 + $charges['S'] * 40;

			$tab_mf[$key] = $tab_welu[$key] * pow($post->portee,2) / 8;

			$tab_vf[$key] = $tab_welu[$key] * $post->portee / 2;
			$tab_vf_atd[$key] = $tab_welu[$key] * (($post->portee / 2) - ($colonnes->hauteur/1000));
			$tab_wf[$key] = $tab_welu[$key] * $post->portee;

			//Ø  = 0.9
			//FB = fb * ( Kd * Khb )
			//Kd = 0.65 ≤ 1 -0.5 * log(Pl/Ps) ≤ 1 (si $key > 1 sinon Kd = 0.65)
			//Cb = sqrt(1.92 * lu * d / b^2)
			//Ck = sqrt(0.97 * E / FB)

			//KD
			if($key == 1){
				$tab_kd[$key] = 0.65;
			}
			else{
				$tab_kd[$key]=1-(0.5*log($colonnes->poids / $charges['Ps'],10));
				
				if($tab_kd[$key] < 0.65){ 	$tab_kd[$key] = 0.65; }
				if($tab_kd[$key] > 1){ 		$tab_kd[$key] = 1; }
			}

			//Fb
			$tab_fb[$key] = $classe->fb * $tab_kd[$key] * $colonnes->khb;

			//CB
			$tab_cb[$key] = sqrt(1.92 * $lu * $colonnes->hauteur / pow($colonnes->largeur_pli,2));

			//CK
			$tab_ck[$key] = sqrt((0.97 * $classe->e) / $tab_fb[$key]);

			//KL
			if($post->type_bois == "bois_sciage" || $post->type_bois == "bois_scl" || $post->type_bois == "bois_massif"){
				$KLVal = 4;
			} else{
				$KLVal = 2.5;
			}
			if($colonnes->hauteur / $colonnes->largeur <= $KLVal){
				$tab_kl[$key] = 1;
			}
			else{
				if($tab_cb[$key] <= 50){
					if($tab_cb[$key] <= 10){
						$tab_kl[$key] = 1;
					} else{
						if($tab_cb[$key] < $tab_ck[$key]){
							$tab_kl[$key] = 1 - ((1/3) * pow($tab_cb[$key]/$tab_ck[$key],4));
						}
						//Ck < CB < 50
						else{
							$tab_kl[$key] = ( 0.65 * $classe->e ) / ( pow($tab_cb[$key],2) * $tab_fb[$key] );
						}
					}
				} else{
					$error = ERROR_CB_BIGGER;
				}
			}

			
			//MR
			if($post->type_bois == "bois_sciage" || $post->type_bois == "bois_scl" || $post->type_bois == "bois_massif"){
				//Mr = Ø * Fb * S * Kzb * Kl
				$tab_mr[$key] = 0.9 * $tab_fb[$key] * $colonnes->s * $colonnes->Kzb * $tab_kl[$key];
			}
			// $post->type_bois == "bois_blc" || $post->type_bois == "bois_blc_nordic"
			else{
				//Mr = Ø * Fb * S * min(Kzbg;Kl)
				$tab_mr[$key] = 0.9 * $tab_fb[$key] * $colonnes->s * min($colonnes->Kzbg,$tab_kl[$key]);
			}
			$tab_mr[$key] = $tab_mr[$key]/1000000;

			//Fv
			$tab_fv[$key] = $classe->fv * $tab_kd[$key] * $colonnes->khv;


			//Vr & Wr
			if($post->type_bois == "bois_sciage" || $post->type_bois == "bois_scl" || $post->type_bois == "bois_massif"){
				//Vr = Ø * Fv * (2 * An / 3) * Kzv
				//An = b * d
				$tab_vr[$key] = 0.9 * $tab_fv[$key] * ( 2 * $colonnes->hauteur * $colonnes->largeur / 3 ) * $colonnes->Kzv;
			}
			// $post->type_bois == "bois_blc" || $post->type_bois == "bois_blc_nordic"
			else{
				//Vr = Ø * Fv * (2 * Ag / 3) 
				//Ag = b * d
				$tab_vr[$key] = 0.9 * $tab_fv[$key] * ( 2 * $colonnes->hauteur * $colonnes->largeur / 3 );

				//Wr = Ø * Fv * 0.48 * Ag * Cv * Z^-0.18
				//Cv = 3.69
				$tab_wr[$key] = 0.9 * $tab_fv[$key] * 0.48 * ( $colonnes->hauteur * $colonnes->largeur ) * 3.565 * pow($colonnes->z,-0.18);
			}

			$tab_vr[$key] = $tab_vr[$key]/1000;
			$tab_wr[$key] = $tab_wr[$key]/1000;

			//Lb = (QF * 1000) / ( Ø * Fcp * b * Kb * kzcp )
			//Qf = Vf

			//Fcp
			$tab_fcp[$key] = $classe->fcp * $tab_kd[$key];
			
			//Lb
			$tab_lb[$key] = ($tab_vf[$key] * 1000 ) / ( 0.9 * $tab_fcp[$key] * $colonnes->largeur * 1 * $colonnes->kzcp );

			//Maximums
			/*if($tab_mf[$key] > $max_mf){
				$max_mf = $tab_mf[$key];
				$max_mr = $tab_mr[$key];
			}*/

			/*if($tab_vf_atd[$key] > $max_vf_atd){
				$max_vf_atd = $tab_vf_atd[$key];
				$max_vr = $tab_vr[$key];
			}*/

			/*if($tab_wf[$key] > $max_wf){
				$max_wf = $tab_wf[$key];
				$max_wr = $tab_wr[$key];
			}*/

			if($tab_lb[$key] > $max_lb){
				$max_lb = $tab_lb[$key];
			}

			if(($tab_mf[$key]/$tab_mr[$key]) > $max_ratio_mf_mr):
				$max_mf = $tab_mf[$key];
				$max_mr = $tab_mr[$key];
				$max_ratio_mf_mr = $tab_mf[$key]/$tab_mr[$key];
			endif;

			if(($tab_wf[$key]/$tab_wr[$key]) > $max_ratio_wf_wr):
				$max_wf = $tab_wf[$key];
				$max_wr = $tab_wr[$key];
				$max_ratio_wf_wr = $tab_wf[$key]/$tab_wr[$key];
			endif;

			if(($tab_vf_atd[$key]/$tab_vr[$key]) > $max_ratio_vf_atd_vr):
				$max_vf_atd = $tab_vf_atd[$key];
				$max_vr = $tab_vr[$key];
				$max_ratio_vf_atd_vr = $tab_vf_atd[$key]/$tab_vr[$key];
			endif;
		}


		$els = array(
			1 => array( 'D' => 1 ,	'L' => 0, 	'S' => 0 ),
			2 => array( 'D' => 1 , 	'L' => 1, 	'S' => 0 ),
			3 => array( 'D' => 1 , 	'L' => 1, 	'S' => 0.5 * $cat_risque->is_els ),
			4 => array( 'D' => 1 , 	'L' => 0, 	'S' => 1 * $cat_risque->is_els ),
			5 => array( 'D' => 1 , 	'L' => 0.5, 'S' => 1 * $cat_risque->is_els	)
		);

		$surcharge = array(
			1 => array( 'L' => 1, 						'S' => 0.5 * $cat_risque->is_els ),
			2 => array( 'L' => 1 * $cat_risque->is_els,	'S' => 0.5 )
		);

		
		$tab_wels 	 = array();
		$tab_delta_t = array();

		$tab_surcharge = array();
		$tab_delta_l   = array();

		$max_delta_t = 0;
		$max_delta_l = 0;


		foreach($els as $key=>$charges){
			$tab_wels[$key] = $charges['D'] * $colonnes->poids + $charges['L'] * $post->surcharge + $charges['S'] * $post->neige;

			// ELS
			$tab_delta_t[$key] = (5 * $tab_wels[$key] * pow($post->portee*1000,4)) / (384 * $classe->e * ($colonnes->largeur * pow($colonnes->hauteur,3) /12));

			if($tab_delta_t[$key] > $max_delta_t){
				$max_delta_t = $tab_delta_t[$key];
			}
		}


		foreach($surcharge as $key => $charges){
			$tab_surcharge[$key] = $charges['D'] * $colonnes->poids + $charges['L'] * $post->surcharge + $charges['S'] * $post->neige;

			if($key == 2):
				$tab_surcharge[$key] = 1.0 * $cat_risque->is_els * $post->neige + 0.5 * $post->surcharge;
			endif;

			// Surcharge
			$tab_delta_l[$key] = (5 * $tab_surcharge[$key] * pow($post->portee*1000,4)) / (384 * $classe->e * ($colonnes->largeur * pow($colonnes->hauteur,3) /12));

			if($tab_delta_l[$key] > $max_delta_l){
				$max_delta_l = $tab_delta_l[$key];
			}
		}



		$html_champs_sortie=array(
			'flexion_app',
			'flexion_res',
			'cisaillement_app',
			'cisaillement_res',
			'cisaillement_w_app',
			'cisaillement_w_res',
			'lb',
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
			'cisaillement',
			'cisaillement_w',
			'lb',
			'surcharge',
			'charge_tot'
		);
		
		//on dfini output et on les associe dans l'objet post.
		for($a=0; $a<count($html_article_sortie); $a++){
			$output_article->$html_article_sortie[$a]='';
		}

		if($post->type_bois == "bois_sciage" || $post->type_bois == "bois_massif"){
		
			$output_article->flexion		= '6.5.4';
			$output_article->cisaillement	= '6.5.5';
			$output_article->lb				= '6.5.7';
			$output_article->surcharge		= '5.4';
			$output_article->charge_tot		= '5.4';
			
		}else if($post->type_bois == "bois_scl"){
			
			$output_article->flexion		= '15.3.3.1';
			$output_article->cisaillement	= '15.3.3.3';
			$output_article->lb				= '15.3.3.6';
			$output_article->surcharge		= '5.4.2';
			$output_article->charge_tot		= '5.4.2';
	
				
		}else if($post->type_bois == "bois_blc" || $post->type_bois == "bois_blc_nordic"){
			
			$output_article->flexion		= '7.5.6';
			$output_article->cisaillement_w	= '7.5.7.2a';
			$output_article->cisaillement	= '7.5.7.2b';
			$output_article->lb				= '7.5.9';
			$output_article->surcharge		= '5.4.2';
			$output_article->charge_tot		= '5.4.2';
		}



		$html_champs_sortie_ratio=array(
			'flexion',
			'cisaillement',
			'cisaillement_w',
			'efforts',
			'fleche_surcharge',
			'fleche_charge_tot'
		);
		
		//on dfini output et on les associe dans l'objet post.
		for($a=0; $a<count($html_champs_sortie_ratio); $a++){
			$output_ratio->$html_champs_sortie_ratio[$a]='';
		}


		
		$output->flexion_app				= $max_mf;
		$output->flexion_res				= $max_mr;
		$output_ratio->flexion 				= $output->flexion_app/$output->flexion_res*100;

		$output->cisaillement_app			= $max_vf_atd;
		$output->cisaillement_res			= $max_vr;
		$output_ratio->cisaillement 		= $output->cisaillement_app/$output->cisaillement_res*100;

		$output->cisaillement_w_app			= $max_wf;
		$output->cisaillement_w_res			= $max_wr;
		$output_ratio->cisaillement_w 		= $output->cisaillement_w_app/$output->cisaillement_w_res*100;

		$output->lb 						= $max_lb;

		$output->fleche_surcharge_app		= $max_delta_l;
		$output->fleche_surcharge_res 		= $post->portee*1000/$post->fleche_surcharge;
		$output->fleche_surcharge_app_ratio = $post->portee*1000/$max_delta_l;
		$output_ratio->fleche_surcharge 	= $output->fleche_surcharge_app / $output->fleche_surcharge_res*100;
		
		$output->fleche_charge_tot_app		= $max_delta_t;
		$output->fleche_charge_tot_res 		= $post->portee*1000/$post->fleche_charge_totale;
		$output->fleche_charge_tot_ratio	= $post->portee*1000/$max_delta_t;
		$output_ratio->fleche_charge_tot 	= $output->fleche_charge_tot_app / $output->fleche_charge_tot_res*100;

		
			
		for($a=0; $a<count($html_champs_sortie_ratio); $a++){
			$output_ratio->$html_champs_sortie_ratio[$a]=round($output_ratio->$html_champs_sortie_ratio[$a]);
			
			$output_style->$html_champs_sortie_ratio[$a]='';
			if($output_ratio->$html_champs_sortie_ratio[$a]>100){
				$output_style->$html_champs_sortie_ratio[$a]=' class="error"';
			}
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
			$post->portee		= $portee_tmp;
			$post->intervalles 	= $intervalles_tmp;
			$post->neige		= $neige_tmp;
			$post->surcharge	= $surcharge_tmp;
			$post->morte		= $morte_tmp;

			$output->flexion_app = $output->flexion_app * 737.5621492;
			$output->flexion_res = $output->flexion_res * 737.5621492;

			$output->compression_app = $output->compression_app / 0.00444822;
			$output->compression_res = $output->compression_res / 0.00444822;

			$output->cisaillement_app = $output->cisaillement_app / 0.00444822;
			$output->cisaillement_res = $output->cisaillement_res / 0.00444822;

			$output->cisaillement_w_app = $output->cisaillement_w_app / 0.00444822;
			$output->cisaillement_w_res = $output->cisaillement_w_res / 0.00444822;

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