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
		
		if($post->type_poutre == "plancher"){
			$cat_risque->is_els	= 1;
			$cat_risque->is_elu	= 1;	
			
		}else /*if($post->type_poutre == "toit")*/{
			$cat_risque->is_els	= 0.9;
			
			if($post->cat_risque=='faible'){
				$cat_risque->is_elu	= 0.8;		
				
			}else if($post->cat_risque=='normale'){
				$cat_risque->is_elu	= 1;			
				
			}else if($post->cat_risque=='elevee'){
				$cat_risque->is_elu	= 1.15;	
				
			}else if($post->cat_risque=='protection_civile'){
				$cat_risque->is_elu	= 1.25;		
			}
		}
		
		$fleche_valeurs=array(
			'surcharge',
			'charge_totale'
		);
		
		//on associe les variables dans l'objet resistance_montant
		for($a=0; $a<count($fleche_valeurs); $a++){
			$fleche->$fleche_valeurs[$a]='';
		}
		
		
		

		//on dfinit un tableau EI, MR, VR, K, EA en fonction des hauteurs de poutrelles choisies
		if($post->type_bois == "bois_sciage"){
			
			$b		= 38;
			$d		= array(64,89,140,184,235);
			$d_nom	= array('2x3','2x4','2x6','2x8','2x10');
			$Kzb	= array(1.7, 1.7, 1.4, 1.2 ,1.1);
			
			$max_A	= 4;
			$max_Sx	= 4;
			$max_EI	= 4;
			
			// Tableau a 2 dimensions 
			// 1er niveau : classe (EPS, MSR 1650, MSR 1950, MSR 2100, MSR 2400)
			// 2eme niveau: propriete( Fb, Fv, E, Kzb, Kzv)

			$tab_classe_propriete	= array(
											/*"EPS"		=> */array(
												"nom"	=> "&Eacute;-P-S No1/No2",
												"Fb"	=> 11.8,
												"Fv"	=> 1.5,
												"E"		=> 9500,
												"d"		=> array(
													64,89,140,184,235
												),
												"d_nom"	=> array(
													'2x3','2x4','2x6','2x8','2x10'
												)
											),
											/*"MSR1650"	=> */array(
												"nom"	=> "MSR1650",
												"Fb"	=> 23.9,
												"Fv"	=> 1.5,
												"E"		=> 10300,
												"d"		=> array(
													64,89,140
												),
												"d_nom"	=> array(
													'2x3','2x4','2x6'
												)
											),
											/*"MSR1950"	=> */array(
												"nom"	=> "MSR1950",
												"Fb"	=> 28.2,
												"Fv"	=> 1.5,
												"E"		=> 11700,
												"d"		=> array(
													184
												),
												"d_nom"	=> array(
													'2x8'
												)
											),
											/*"MSR2100"	=> */array(
												"nom"	=> "MSR2100",
												"Fb"	=> 30.4,
												"Fv"	=> 1.5,
												"E"		=> 12400,
												"d"		=> array(
													64,89,140
												),
												"d_nom"	=> array(
													'2x3','2x4','2x6'
												)
											),
											/*"MSR2400"	=> */array(
												"nom"	=> "MSR2400",
												"Fb"	=> 34.7,
												"Fv"	=> 1.5,
												"E"		=> 13800,
												"d"		=> array(
													64,89
												),
												"d_nom"	=> array(
													'2x3','2x4'
												)
											)
									);
			
			for($cpt_classe=0; $cpt_classe<count($tab_classe_propriete); $cpt_classe++){
				
				for($cpt_dimension=0; $cpt_dimension<count($tab_classe_propriete[$cpt_classe]['d']); $cpt_dimension++){
					$tab_classe_propriete[$cpt_classe]['A'][$cpt_dimension]		= $b * $tab_classe_propriete[$cpt_classe]['d'][$cpt_dimension];
					$tab_classe_propriete[$cpt_classe]['Sx'][$cpt_dimension]	= ($b * pow($tab_classe_propriete[$cpt_classe]['d'][$cpt_dimension],2))/6;
					$tab_classe_propriete[$cpt_classe]['Ix'][$cpt_dimension]	= ($b * pow($tab_classe_propriete[$cpt_classe]['d'][$cpt_dimension],3))/12;
					$tab_classe_propriete[$cpt_classe]['EI'][$cpt_dimension]	= $tab_classe_propriete[$cpt_classe]['E'] * $tab_classe_propriete[$cpt_classe]['Ix'][$cpt_dimension];
					
					if( $cpt_classe == 0 ){
						$tab_classe_propriete[$cpt_classe]['Kzb'][$cpt_dimension]	= $Kzb[$cpt_dimension];
					}else{
						$tab_classe_propriete[$cpt_classe]['Kzb'][$cpt_dimension]	= 1;
					}
					//$cpt_kzb_ok = 0;
					for($cpt_kzb=0; $cpt_kzb<count($Kzb);$cpt_kzb++){
						if($d_nom[$cpt_kzb] == $tab_classe_propriete[$cpt_classe]['d_nom'][$cpt_dimension]){
							$cpt_kzb_ok = $cpt_kzb;
						}
					}
					$tab_classe_propriete[$cpt_classe]['Kzv'][$cpt_dimension] = $Kzb[$cpt_kzb_ok];
				}
			
			}
			
		}else if($post->type_bois == "bois_composite"){
		
			$b		= 44.5;
			$d		= array(140,184,235,241,286,302,356,406,457,508,559,610);
			$d_imp	= array('5&frac12','7&frac14','9&frac14','9&frac12','11&frac14','11 7/8',14,16,18,20,22,24);
			


			for($cpt_nom=0; $cpt_nom<count($d); $cpt_nom++){
				if($post->systeme=="imp"){
					$d_nom[$cpt_nom] = '1&frac34; " x '.$d_imp[$cpt_nom].' "';
				}else{
					$d_nom[$cpt_nom] = "45x".$d[$cpt_nom];
				}
			}
			
			
			$max_A = 4;
			$max_Sx= 4;
			$max_EI= 4;
			
			// Tableau a 2 dimensions 
			// 1er niveau : classe (EPS, MSR 1650, MSR 1950, MSR 2100, MSR 2400)
			// 2eme niveau: propriete( Fb, Fv, E, Kzb, Kzv)

			$tab_classe_propriete	= array(
											/*"SCL 1.5"	=> */array(
												"nom"	=> "SCL 1.5",
												"Fb"	=> 25.80,
												"Fv"	=> 2.65,
												"E"		=> 10300,
												"d"		=> $d,
												"d_nom"	=>$d_nom
											),
											/*"SCL 1.7"	=> */array(
												"nom"	=> "SCL 1.7",
												"Fb"	=> 29.7,
												"Fv"	=> 3.6,
												"E"		=> 11700,
												"d"		=> $d,
												"d_nom"	=>$d_nom
											),
											/*"SCL 1.8"	=> */array(
												"nom"	=> "SCL 1.8",
												"Fb"	=> 31.70,
												"Fv"	=> 3.6,
												"E"		=> 12400,
												"d"		=> $d,
												"d_nom"	=>$d_nom
											),
											/*"SCL 1.9"	=> */array(
												"nom"	=> "SCL 1.9",
												"Fb"	=> 33.60,
												"Fv"	=> 3.6,
												"E"		=> 13100,
												"d"		=> $d,
												"d_nom"	=>$d_nom
											),
											/*"SCL 2.0"	=> */array(
												"nom"	=> "SCL 2.0",
												"Fb"	=> 35.60,
												"Fv"	=> 3.65,
												"E"		=> 13800,
												"d"		=> $d,
												"d_nom"	=>$d_nom
											),
											/*"SCL 2.1"	=> */array(
												"nom"	=> "SCL 2.1",
												"Fb"	=> 37.55,
												"Fv"	=> 3.65,
												"E"		=> 14500,
												"d"		=> $d,
												"d_nom"	=>$d_nom
											)
									);
			
			for($cpt_classe=0; $cpt_classe<count($tab_classe_propriete); $cpt_classe++){
				
				for($cpt_dimension=0; $cpt_dimension<count($tab_classe_propriete[$cpt_classe]['d']); $cpt_dimension++){
					$tab_classe_propriete[$cpt_classe]['A'][$cpt_dimension]		= $b * $tab_classe_propriete[$cpt_classe]['d'][$cpt_dimension];
					$tab_classe_propriete[$cpt_classe]['Sx'][$cpt_dimension]	= ($b * pow($tab_classe_propriete[$cpt_classe]['d'][$cpt_dimension],2))/6;
					$tab_classe_propriete[$cpt_classe]['Ix'][$cpt_dimension]	= ($b * pow($tab_classe_propriete[$cpt_classe]['d'][$cpt_dimension],3))/12;
					$tab_classe_propriete[$cpt_classe]['EI'][$cpt_dimension]	= $tab_classe_propriete[$cpt_classe]['E'] * $tab_classe_propriete[$cpt_classe]['Ix'][$cpt_dimension];
					
					
					$tab_classe_propriete[$cpt_classe]['Kzb'][$cpt_dimension]	= pow((305/$tab_classe_propriete[$cpt_classe]['d'][$cpt_dimension]),(1/9));
					$tab_classe_propriete[$cpt_classe]['Kzv'][$cpt_dimension]	= 1;
				}
			}
		
		}elseif($post->type_bois == "lamelle_colle"){			
			require_once('lamele_colle_data.php');
		}elseif($post->type_bois == "lamelle_colle_nordic"){
			require_once('lamele_colle_nordic_data.php');
		}elseif($post->type_bois == "bois_massif"){
			require_once('bois_massif_data.php');
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
			$surcharge_tmp		= $post->surcharge;
			$morte_tmp			= $post->morte;
			
			$post->portee		= Conversion::ConvertPiedsToMetre($post->portee);
			$post->surcharge	= Conversion::ConvertLbsurPiTokNm($post->surcharge);
			$post->morte		= Conversion::ConvertLbsurPiTokNm($post->morte);
		}
	
		$fleche->surcharge_limite		= $post->portee / $post->fleche_surcharge;
		$fleche->charge_totale_limite	= $post->portee / $post->fleche_charge_totale;
		
		//DFINITION APPROFONDIE DE VARIABLES FIXE EN FONCTION DES CHOIX
		//--------------------------------------------------------------

		// CONVERSION DES CHARGES DE CALCULS
		
		//Sucharge ou neige
		$Wl_elu	= $post->surcharge * $cat_risque->is_elu;
		$Wl_els = $post->surcharge * $cat_risque->is_els;
		
		// DTERMINATION DES CAS DE CHARGEMENTS
		
		//tats limites ultimes
		$max_Wf = 0;
		
		$Wf[0]	= 1.4 * $post->morte;
		$Wf[1]	= (1.25 * $post->morte) + (1.5 * $Wl_elu);
		$Wf[2]	= (0.9 * $post->morte) + (1.5 * $Wl_elu);
		
		//on va chercher le maximum des 3 cas possibles pour les etats limites ultimes
		for($a=0; $a<3; $a++){
			if($max_Wf < $Wf[$a]){
				$max_Wf = $Wf[$a];
			}
		}
		
		//-----------------------------------------------------------------
		
		//tats limites de service

		
		//VRIFICATION DES TATS LIMITES ULTIMES 
		
		

		$Mf	= ($max_Wf * pow($post->portee,2)) /  8;

		$Vf	= ($max_Wf * $post->portee) / 2;
		
		if($post->type_bois == 'bois_massif'){
			for($i=0;$i<3;$i++){
				for($cpt_classe=0; $cpt_classe<count($tab_classe_proprietes[$i]); $cpt_classe++){
					for($cpt_dimension=0; $cpt_dimension<count($tab_classe_proprietes[$i][$cpt_classe]['d']); $cpt_dimension++){
						for($cpt_d=0; $cpt_d<count($tab_classe_proprietes[$i][$cpt_classe]['d'][$cpt_dimension]); $cpt_d++){
							$Sf[$i][$cpt_classe][$cpt_dimension][$cpt_d]	= ($Mf * 1000000) / (0.9 * $tab_classe_proprietes[$i][$cpt_classe]['Fb'][$cpt_dimension][$cpt_d] * $tab_classe_proprietes[$i][$cpt_classe]['Kzb'][$cpt_dimension][$cpt_d]);								
							$Af[$i][$cpt_classe][$cpt_dimension][$cpt_d]	= ($Vf * 1000)/ (0.9 * $tab_classe_proprietes[$i][$cpt_classe]['Fv'] * (2/3) * $tab_classe_proprietes[$i][$cpt_classe]['Kzv'][$cpt_dimension][$cpt_d]);
						}
					}
				}
			}
		}
		else{
			for($cpt_classe=0; $cpt_classe<count($tab_classe_propriete); $cpt_classe++){
				for($cpt_dimension=0; $cpt_dimension<count($tab_classe_propriete[$cpt_classe]['d']); $cpt_dimension++){
					$Sf[$cpt_classe][$cpt_dimension]	= ($Mf * 1000000) / (0.9 * $tab_classe_propriete[$cpt_classe]['Fb'] * $tab_classe_propriete[$cpt_classe]['Kzb'][$cpt_dimension]);
					
					if( $post->type_bois == "bois_sciage" || $post->type_bois == "bois_composite"){
						$Af[$cpt_classe][$cpt_dimension]	= ($Vf * 1000)/ (0.9 * $tab_classe_propriete[$cpt_classe]['Fv'] * (2/3) * $tab_classe_propriete[$cpt_classe]['Kzv'][$cpt_dimension]);
					}
				}
				if($post->type_bois == "lamelle_colle" || $post->type_bois == "lamelle_colle_nordic" ){
					$Af[$cpt_classe]	= pow( ($max_Wf * $post->portee * 1000)/ (1.59408 * pow(1000,0.36) * $tab_classe_propriete[$cpt_classe]['Fv'] * pow( $post->portee, -0.18) ), 1/0.82 );
				}
			}  
		}
				
		$EIf1 = ((5 * $Wl_els * pow($post->portee,4)) / (384 * $fleche->surcharge_limite)) * 1000000000;
		
		$EIf2 = ((5 * ($Wl_els + $post->morte) * pow($post->portee,4)) / (384 * $fleche->charge_totale_limite)) * 1000000000;
		
		$EIf = max($EIf1,$EIf2);
		
		
		//------------------------------

		
		
		// VRIFICATION DES RSISTANCES 
		if($post->type_bois == 'bois_massif'){
			//$tab_serie_classe = array();
			$tab_classe_dimension_ok =array();
			$tab_classe_dimension_all=array();
			// pour chaques srie, pour chaques dimensions on vrifie si Sf/Sx < 4, si Af/Ax <4 et si EIf/EI < 4
			// si une srie est accepte, on regarde si on 
			$cpt_ok=0;
			for($i=0;$i<3;$i++){
				$cpt_ok = 0;
				for($cpt_classe=0; $cpt_classe<count($tab_classe_proprietes[$i]); $cpt_classe++){
					$max_ratio_tmp=0;
					$nom_resistance_max = '';
					$tab_classe_dimension_all[$i][$cpt_classe]['nom_classe'] = $tab_classe_proprietes[$i][$cpt_classe]['nom'];								
					if($cpt_classe < 2){ $count_d = count($d); }
					else{ $count_d = count($d2); }
					for($cpt_b=0; $cpt_b<$count_d; $cpt_b++){
						for($cpt_d=0; $cpt_d<count($tab_classe_proprietes[$i][$cpt_classe]['d'][$cpt_b]); $cpt_d++){
							$Sx_classe_dimension[$i]	= ceil($Sf[$i][$cpt_classe][$cpt_b][$cpt_d]/$tab_classe_proprietes[$i][$cpt_classe]['Sx'][$cpt_b][$cpt_d]);
							$A_classe_dimension[$i]		= ceil($Af[$i][$cpt_classe][$cpt_b][$cpt_d]/$tab_classe_proprietes[$i][$cpt_classe]['A'][$cpt_b][$cpt_d]);
							$EI_classe_dimension[$i]	= ceil($EIf/$tab_classe_proprietes[$i][$cpt_classe]['EI'][$cpt_b][$cpt_d]);
							$nbr_max[$i]				= max($A_classe_dimension[$i],$Sx_classe_dimension[$i],$EI_classe_dimension[$i]);
							
							//pour le debug, on sauve tout
							$tab_classe_dimension_all[$i][$cpt_classe][$cpt_b][$cpt_d]['A']				= $A_classe_dimension[$i];
							$tab_classe_dimension_all[$i][$cpt_classe][$cpt_b][$cpt_d]['Sx']			= $Sx_classe_dimension[$i];
							$tab_classe_dimension_all[$i][$cpt_classe][$cpt_b][$cpt_d]['EI']			= $EI_classe_dimension[$i];
							$tab_classe_dimension_all[$i][$cpt_classe][$cpt_b][$cpt_d]['nom_dimension']	= $tab_classe_proprietes[$i][$cpt_classe]['d_nom'][$cpt_b][$cpt_d];
															
							//si les chiffre des vrifications arrondi sont <= 1
							if($A_classe_dimension[$i]<=$max_A && $Sx_classe_dimension[$i]<=$max_Sx && $EI_classe_dimension[$i]<=$max_EI){
								$insertion = true;
								//la srie - dimension passe
								
								//si une classe a deja t valide
								if($cpt_ok!=0){
									
									// et que cette classe est la mme que la prcdente
									if($tab_classe_dimension_ok[$i]['classe'][($cpt_ok-1)] == $cpt_classe){
										// ce n'est plus une insertion mais une possibilit de modification
										$insertion=false;
			
									}
								}
								if($insertion == true){
									$tab_classe_dimension_ok[$i]['classe'][$cpt_ok]			= $cpt_classe;
									$tab_classe_dimension_ok[$i]['dimension'][$cpt_ok]		= $tab_classe_proprietes[$i][$cpt_classe]['d_nom'][$cpt_b][$cpt_d];
									$tab_classe_dimension_ok[$i]['nbr_max'][$cpt_ok]		= $nbr_max[$i];
									$tab_classe_dimension_ok[$i]['aire'][$cpt_ok]			= $nbr_max[$i] * $tab_classe_proprietes[$i][$cpt_classe]['A'][$cpt_b][$cpt_d];
													
									$tab_classe_dimension_ok[$i]['valeurs'][$cpt_ok]['A']	= $A_classe_dimension[$i];
									$tab_classe_dimension_ok[$i]['valeurs'][$cpt_ok]['Sx']	= $Sx_classe_dimension[$i];
									$tab_classe_dimension_ok[$i]['valeurs'][$cpt_ok]['EI']	= $EI_classe_dimension[$i];
									
									$cpt_ok++;
									
								}else{
									//on compare l'aire
									if(($nbr_max[$i]* $tab_classe_proprietes[$i][$cpt_classe]['A'][$cpt_b][$cpt_d]) < $tab_classe_dimension_ok['aire'][($cpt_ok-1)]){
			
										$tab_classe_dimension_ok[$i]['classe'][($cpt_ok-1)]			= $cpt_classe;
										$tab_classe_dimension_ok[$i]['dimension'][($cpt_ok-1)]		= $tab_classe_proprietes[$i][$cpt_classe]['d_nom'][$cpt_b][$cpt_d];
										$tab_classe_dimension_ok[$i]['nbr_max'][($cpt_ok-1)]		= $nbr_max[$i];
										$tab_classe_dimension_ok[$i]['aire'][($cpt_ok-1)]			= $nbr_max[$i] * $tab_classe_proprietes[$i][0]['A'][$cpt_b][$cpt_d];
										
										$tab_classe_dimension_ok[$i]['valeurs'][($cpt_ok-1)]['A']	= $A_classe_dimension[$i];
										$tab_classe_dimension_ok[$i]['valeurs'][($cpt_ok-1)]['Sx']	= $Sx_classe_dimension[$i];
										$tab_classe_dimension_ok[$i]['valeurs'][($cpt_ok-1)]['EI']	= $EI_classe_dimension[$i];
									}
								}
							}
						}
					}
				}
			}
		}
		else{
			//$tab_serie_classe = array();
			$tab_classe_dimension_ok =array();
			$tab_classe_dimension_all=array();
			// pour chaques srie, pour chaques dimensions on vrifie si Sf/Sx < 4, si Af/Ax <4 et si EIf/EI < 4
			// si une srie est accepte, on regarde si on 
			$cpt_ok=0;
			for($cpt_classe=0; $cpt_classe<count($tab_classe_propriete); $cpt_classe++){
				
				$max_ratio_tmp=0;
				$nom_resistance_max = '';
				
				$tab_classe_dimension_all[$cpt_classe]['nom_classe']	= $tab_classe_propriete[$cpt_classe]['nom'];
				
				
				if( $post->type_bois == "bois_sciage" || $post->type_bois == "bois_composite"){
				
					for($cpt_dimension=0; $cpt_dimension<count($tab_classe_propriete[$cpt_classe]['d']); $cpt_dimension++){
						
						$Sx_classe_dimension	= ceil($Sf[$cpt_classe][$cpt_dimension]/$tab_classe_propriete[$cpt_classe]['Sx'][$cpt_dimension]);
						$A_classe_dimension		= ceil($Af[$cpt_classe][$cpt_dimension]/$tab_classe_propriete[$cpt_classe]['A'][$cpt_dimension]);
						$EI_classe_dimension	= ceil($EIf/$tab_classe_propriete[$cpt_classe]['EI'][$cpt_dimension]);
						
						$nbr_max				= max($A_classe_dimension,$Sx_classe_dimension,$EI_classe_dimension);
						
						//pour le debug, on sauve tout
						$tab_classe_dimension_all[$cpt_classe][$cpt_dimension]['A']				= $A_classe_dimension;
						$tab_classe_dimension_all[$cpt_classe][$cpt_dimension]['Sx']			= $Sx_classe_dimension;
						$tab_classe_dimension_all[$cpt_classe][$cpt_dimension]['EI']			= $EI_classe_dimension;
						$tab_classe_dimension_all[$cpt_classe][$cpt_dimension]['nom_dimension']	= $tab_classe_propriete[$cpt_classe]['d'][$cpt_dimension];
						
						$ratio =1;
						
						//si les chiffre des vrifications arrondi sont <= 4
						if($A_classe_dimension<=$max_A && $Sx_classe_dimension<=$max_Sx && $EI_classe_dimension<=$max_EI){
						
							$insertion = true;
							//la srie - dimension passe
							
							//si une classe a deja t valide
							if(!$cpt_ok==0){
								
								// et que cette classe est la mme que la prcdente
								if($tab_classe_dimension_ok['classe'][($cpt_ok-1)] == $cpt_classe){
									// ce n'est plus une insertion mais une possibilit de modification
									$insertion=false;
		
								}
							}
							
							if($insertion == true){
								$tab_classe_dimension_ok['classe'][$cpt_ok]			= $cpt_classe;
								$tab_classe_dimension_ok['dimension'][$cpt_ok]		= $cpt_dimension;
								$tab_classe_dimension_ok['nbr_max'][$cpt_ok]		= $nbr_max;
								$tab_classe_dimension_ok['aire'][$cpt_ok]			= $nbr_max * $tab_classe_propriete[0]['A'][$cpt_dimension];
								
								$tab_classe_dimension_ok['valeurs'][$cpt_ok]['A']	= $A_classe_dimension;
								$tab_classe_dimension_ok['valeurs'][$cpt_ok]['Sx']	= $Sx_classe_dimension;
								$tab_classe_dimension_ok['valeurs'][$cpt_ok]['EI']	= $EI_classe_dimension;
								
								$cpt_ok++;
							}else{
		
								
								//on compare les valeurs
								/*
								if( 
									$A_classe_dimension		< $tab_classe_dimension_ok['valeurs'][($cpt_ok-1)]['A'] ||
									$Sx_classe_dimension	< $tab_classe_dimension_ok['valeurs'][($cpt_ok-1)]['Sx'] ||
									$EI_classe_dimension	< $tab_classe_dimension_ok['valeurs'][($cpt_ok-1)]['EI']
								){
								*/
								
								//si c'est un bois composite et que les dimensions sont >=  406, on double l'aire
								if($post->type_bois == "bois_composite" && $tab_classe_propriete[$cpt_classe]['d'][$cpt_dimension] >= 406 && $nbr_max==1){
									$ratio = 2;
								}
								
								//on compare l'aire
								if(($ratio * $nbr_max* $tab_classe_propriete[0]['A'][$cpt_dimension]) < $tab_classe_dimension_ok['aire'][($cpt_ok-1)]){
		
									$tab_classe_dimension_ok['classe'][($cpt_ok-1)]			= $cpt_classe;
									$tab_classe_dimension_ok['dimension'][($cpt_ok-1)]		= $cpt_dimension;
									$tab_classe_dimension_ok['nbr_max'][($cpt_ok-1)]		= $nbr_max;
									$tab_classe_dimension_ok['aire'][($cpt_ok-1)]			= $ratio * $nbr_max * $tab_classe_propriete[0]['A'][$cpt_dimension];
									
									$tab_classe_dimension_ok['valeurs'][($cpt_ok-1)]['A']	= $A_classe_dimension;
									$tab_classe_dimension_ok['valeurs'][($cpt_ok-1)]['Sx']	= $Sx_classe_dimension;
									$tab_classe_dimension_ok['valeurs'][($cpt_ok-1)]['EI']	= $EI_classe_dimension;
								}
							}
						}
					}
					
				}elseif($post->type_bois == "lamelle_colle" || $post->type_bois == "lamelle_colle_nordic"){
					
					for($cpt_b=0; $cpt_b<count($b); $cpt_b++){
						
						for($cpt_d=0; $cpt_d<count($tab_classe_propriete[$cpt_classe]['d'][$cpt_b]); $cpt_d++){
						
							$Sx_classe_dimension	= ceil($Sf[$cpt_classe][$cpt_b]/$tab_classe_propriete[$cpt_classe]['Sx'][$cpt_b][$cpt_d]);
							$A_classe_dimension		= ceil($Af[$cpt_classe]/$tab_classe_propriete[$cpt_classe]['A'][$cpt_b][$cpt_d]);
							$EI_classe_dimension	= ceil($EIf/$tab_classe_propriete[$cpt_classe]['EI'][$cpt_b][$cpt_d]);
							$nbr_max				= max($A_classe_dimension,$Sx_classe_dimension,$EI_classe_dimension);
							
							//pour le debug, on sauve tout
							$tab_classe_dimension_all[$cpt_classe][$cpt_b][$cpt_d]['A']				= $A_classe_dimension;
							$tab_classe_dimension_all[$cpt_classe][$cpt_b][$cpt_d]['Sx']			= $Sx_classe_dimension;
							$tab_classe_dimension_all[$cpt_classe][$cpt_b][$cpt_d]['EI']			= $EI_classe_dimension;
							$tab_classe_dimension_all[$cpt_classe][$cpt_b][$cpt_d]['nom_dimension']	= $tab_classe_propriete[$cpt_classe]['d_nom'][$cpt_b][$cpt_d];
							
							
							//si les chiffre des vrifications arrondi sont <= 1
							if($A_classe_dimension<=$max_A && $Sx_classe_dimension<=$max_Sx && $EI_classe_dimension<=$max_EI){
							
								$insertion = true;
								//la srie - dimension passe
								
								//si une classe a deja t valide
								if(!$cpt_ok==0){
									
									// et que cette classe est la mme que la prcdente
									if($tab_classe_dimension_ok['classe'][($cpt_ok-1)] == $cpt_classe){
										// ce n'est plus une insertion mais une possibilit de modification
										$insertion=false;
			
									}
								}
								
								if($insertion == true){
									$tab_classe_dimension_ok['classe'][$cpt_ok]			= $cpt_classe;
									$tab_classe_dimension_ok['dimension'][$cpt_ok]		= $tab_classe_propriete[$cpt_classe]['d_nom'][$cpt_b][$cpt_d];
									$tab_classe_dimension_ok['nbr_max'][$cpt_ok]		= $nbr_max;
									$tab_classe_dimension_ok['aire'][$cpt_ok]			= $nbr_max * $tab_classe_propriete[$cpt_classe]['A'][$cpt_b][$cpt_d];
									
									$tab_classe_dimension_ok['valeurs'][$cpt_ok]['A']	= $A_classe_dimension;
									$tab_classe_dimension_ok['valeurs'][$cpt_ok]['Sx']	= $Sx_classe_dimension;
									$tab_classe_dimension_ok['valeurs'][$cpt_ok]['EI']	= $EI_classe_dimension;
									
									$cpt_ok++;
									
								}else{
										
									//on compare l'aire
									if(($nbr_max* $tab_classe_propriete[$cpt_classe]['A'][$cpt_b][$cpt_d]) < $tab_classe_dimension_ok['aire'][($cpt_ok-1)]){
			
										$tab_classe_dimension_ok['classe'][($cpt_ok-1)]			= $cpt_classe;
										$tab_classe_dimension_ok['dimension'][($cpt_ok-1)]		= $tab_classe_propriete[$cpt_classe]['d_nom'][$cpt_b][$cpt_d];
										$tab_classe_dimension_ok['nbr_max'][($cpt_ok-1)]		= $nbr_max;
										$tab_classe_dimension_ok['aire'][($cpt_ok-1)]			= $nbr_max * $tab_classe_propriete[0]['A'][$cpt_b][$cpt_d];
										
										$tab_classe_dimension_ok['valeurs'][($cpt_ok-1)]['A']	= $A_classe_dimension;
										$tab_classe_dimension_ok['valeurs'][($cpt_ok-1)]['Sx']	= $Sx_classe_dimension;
										$tab_classe_dimension_ok['valeurs'][($cpt_ok-1)]['EI']	= $EI_classe_dimension;
									}
								}
							}
						}
					}	
				}
			}
		}
		
		if($post->type_bois == "bois_massif"){
			for($i=0;$i<3;$i++){
				if(isset($tab_classe_dimension_ok[$i]['classe'])){
					for($cpt_serie=0; $cpt_serie<count($tab_classe_dimension_ok[$i]['classe']); $cpt_serie++){
						$serie = $tab_classe_dimension_ok[$i]['classe'][$cpt_serie];
						$tab_nom_series[$i]['nom'][] = $tab_classe_proprietes[$i][$serie]['nom'];
						$tab_nom_series[$i]['classe'][] = $tab_classe_dimension_ok[$i]['classe'][$cpt_serie];
						$tab_nom_series[$i]['dimension'][] = $tab_classe_dimension_ok[$i]['dimension'][$cpt_serie];
					}
				}
			}
		}
		else{
			//Pour chaques srie, on passe 
			if(isset($tab_classe_dimension_ok['classe'])){
				for($cpt_serie=0; $cpt_serie<count($tab_classe_dimension_ok['classe']); $cpt_serie++){
					$serie = $tab_classe_dimension_ok['classe'][$cpt_serie];
					
					/*
					if($post->type_bois == "bois_composite" && $tab_classe_propriete[$serie]['d'][$tab_classe_dimension_ok['dimension'][$cpt_serie]] >= 406 && $tab_classe_dimension_ok['nbr_max'][$cpt_serie]<2){
						$tab_classe_dimension_ok['nbr_max'][$cpt_serie] = 2;
					}
					*/
				//	echo $tab_classe_dimension_ok['dimension'][$cpt_serie]."<br />";
					if($post->type_bois == "lamelle_colle" || $post->type_bois == "lamelle_colle_nordic"){
						//$tab_nom_serie[] = $tab_classe_dimension_ok['nbr_max'][$cpt_serie].'x '.$tab_classe_propriete[$serie]['nom'].' - '.$tab_classe_dimension_ok['dimension'][$cpt_serie];
						$tab_nom_serie[] = $tab_classe_propriete[$serie]['nom'].' - '.$tab_classe_dimension_ok['dimension'][$cpt_serie];
					}
					else{
						$tab_nom_serie[] = $tab_classe_dimension_ok['nbr_max'][$cpt_serie].'x '.$tab_classe_propriete[$serie]['nom'].' - '.$tab_classe_propriete[$serie]['d_nom'][$tab_classe_dimension_ok['dimension'][$cpt_serie]];
					}
				}
			}
		}
		
		//on modifie les donnes si l'utilisateur a choisit d'entrer les donnes en IMPRIAL
		if($post->systeme == "imp"){
			$post->portee		= $portee_tmp;	
			$post->surcharge	= $surcharge_tmp;
			$post->morte		= $morte_tmp;
		}

	}
		
?>