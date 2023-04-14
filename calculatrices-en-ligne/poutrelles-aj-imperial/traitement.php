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

		$tab_check_carac	= array(',','millimetre','millimètre','milimetre','milimètre','metre','mètre','pieds','pied','pouces','pouce','p','m','"','\'','%','\\');
		$tab_replace_carac	= array('.','','','','','','','','','','','','','','','','');
		
		$champ = str_replace($tab_check_carac,$tab_replace_carac,strtolower($champ));
		
		return $champ;
	}	

	//VARIABLES FIXES
	//---------------

		//on définit un tableau EI, MR, VR, K, EA en fonction des hauteurs de poutrelles choisies
		$tab_classe_gen	= array(	'2x3 - EPS',	'2x3 - 1650',	'2x3 - 2100',	'2x4 - 2100',	'2x4 - 2400');

		if($post->hauteur == 302){
			$tab_classe	= $tab_classe_gen;
			$tab_L_local_sup	= array(	610,	610,	610,	762,	762	);
			$tab_L_local_inf	= array(	1220,	1220,	1220,	1524,	1524	);
			$tab_EI_global		= array(	811,	879,	1058,	1472,	1638	);
			$tab_EI_local		= array(	2780,	3010,	3630,	5050,	5620	);
			$tab_Mr 			= array(	0.306,	0.364,	0.464,	0.645,	0.736	);
			$tab_Pr				= array(	27.75,	42.48,	47.35,	57.88,	62.10	);
			$tab_Tr				= array(	19.86,	27.45,	42.62,	59.26,	72.32	);
			$tab_EA				= array(	46.21,	50.10,	60.31,	83.87,	93.34	);
			$tab_K				= array(	21.13,	21.13,	21.13,	21.13,	21.13	);
			
		}else if($post->hauteur == 318){
			$tab_classe	= $tab_classe_gen;
			$tab_L_local_sup	= array(	610,	610,	610,	762,	762	);
			$tab_L_local_inf	= array(	1220,	1220,	1220,	1524,	1524	);
			$tab_EI_global		= array(	911,	988,	1189,	1654,	1841	);
			$tab_EI_local		= array(	2780,	3010,	3630,	5050,	5620	);
			$tab_Mr 			= array(	0.306,	0.364,	0.464,	0.645,	0.736	);
			$tab_Pr				= array(	27.75,	42.48,	47.35,	57.88,	62.10	);
			$tab_Tr				= array(	19.86,	27.45,	42.62,	59.26,	72.32	);
			$tab_EA				= array(	46.21,	50.10,	60.31,	83.87,	93.34	);
			$tab_K				= array(	22.57,	22.57,	22.57,	22.57,	22.57	);

		}else if($post->hauteur == 356){
			$tab_classe	= $tab_classe_gen;
			$tab_L_local_sup	= array(	610,	610,	610,	762,	762	);
			$tab_L_local_inf	= array(	1220,	1220,	1220,	1524,	1524	);
			$tab_EI_global		= array(	1174,	1273,	1532,	2131,	2371	);
			$tab_EI_local		= array(	2780,	3010,	3630,	5050,	5620	);
			$tab_Mr 			= array(	0.306,	0.364,	0.464,	0.645,	0.736	);
			$tab_Pr				= array(	27.75,	42.48,	47.35,	57.88,	62.10	);
			$tab_Tr				= array(	19.86,	27.45,	42.62,	59.26,	72.32	);
			$tab_EA				= array(	46.21,	50.10,	60.31,	83.87,	93.34	);
			$tab_K				= array(	29.23,	29.23,	29.23,	29.23,	29.23	);

		}else if($post->hauteur == 406){
			$tab_classe	= $tab_classe_gen;
			$tab_L_local_sup	= array(	610,	610,	610,	762,	762	);
			$tab_L_local_inf	= array(	1220,	1220,	1220,	1524,	1524	);
			$tab_EI_global		= array(	1570,	1702,	2049,	2850,	3171	);
			$tab_EI_local		= array(	2780,	3010,	3630,	5050,	5620	);
			$tab_Mr 			= array(	0.306,	0.364,	0.464,	0.645,	0.736	);
			$tab_Pr				= array(	27.75,	42.48,	47.35,	57.88,	62.10	);
			$tab_Tr				= array(	19.86,	27.45,	42.62,	59.26,	72.32	);
			$tab_EA				= array(	46.21,	50.10,	60.31,	83.87,	93.34	);
			$tab_K				= array(	35.95,	35.95,	35.95,	35.95,	35.95	);

		}else if($post->hauteur == 457){
			$tab_classe	= array($tab_classe_gen[3], $tab_classe_gen[4]);
			$tab_L_local_sup	= array(	762,	762	);
			$tab_L_local_inf	= array(	1524,	1524	);
			$tab_EI_global		= array(	3691,	4108	);
			$tab_EI_local		= array(	5050,	5620	);
			$tab_Mr 			= array(	0.645,	0.736	);
			$tab_Pr				= array(	57.88,	62.10	);
			$tab_Tr				= array(	59.26,	72.32	);
			$tab_EA				= array(	83.87,	93.34	);
			$tab_K				= array(	42.38,	42.38	);

		}else if($post->hauteur == 508){
			$tab_classe	= array($tab_classe_gen[3], $tab_classe_gen[4]);
			$tab_L_local_sup	= array(	762,	762	);
			$tab_L_local_inf	= array(	1524,	1524	);
			$tab_EI_global		= array(	4642,	5166	);
			$tab_EI_local		= array(	5050,	5620	);
			$tab_Mr 			= array(	0.645,	0.736	);
			$tab_Pr				= array(	57.88,	62.10	);
			$tab_Tr				= array(	59.26,	72.32	);
			$tab_EA				= array(	83.87,	93.34	);
			$tab_K				= array(	49.38,	49.38	);

		}else if($post->hauteur == 559){
			$tab_classe	= array($tab_classe_gen[3], $tab_classe_gen[4]);
			$tab_L_local_sup	= array(	762,	762	);
			$tab_L_local_inf	= array(	1524,	1524	);
			$tab_EI_global		= array(	5702,	6346	);
			$tab_EI_local		= array(	5050,	5620	);
			$tab_Mr 			= array(	0.645,	0.736	);
			$tab_Pr				= array(	57.88,	62.10	);
			$tab_Tr				= array(	59.26,	72.32	);
			$tab_EA				= array(	83.87,	93.34	);
			$tab_K				= array(	59.04,	59.04	);

		}else if($post->hauteur == 610){
			$tab_classe	= array($tab_classe_gen[3], $tab_classe_gen[4]);
			$tab_L_local_sup	= array(	762,	762	);
			$tab_L_local_inf	= array(	1524,	1524	);
			$tab_EI_global		= array(	6871,	7646	);
			$tab_EI_local		= array(	5050,	5620	);
			$tab_Mr 			= array(	0.645,	0.736	);
			$tab_Pr				= array(	57.88,	62.10	);
			$tab_Tr				= array(	59.26,	72.32	);
			$tab_EA				= array(	83.87,	93.34	);
			$tab_K				= array(	64.30,	64.30	);
		}

		//on regarde si on a bien choisi une variable pour type de poutrelle
		if($post->type_poutrelle==""){
			if(!isset($error)){
				$error = ERROR_TYPE_POUTRELLE_VIDE;
			}
		}


		//------------------------------

		//on effectue des modifications sur la portée ecrite a la main
		$post->portee = verifCarac($post->portee);

		//Si il y a un probleme avec cette variable, on stock un msg d'erreur
		if(!is_numeric($post->portee)){
			if(!isset($error)){
				$error = ERROR_PORTEE_NOMBRE;
			}

		}else{
			if(($post->portee > 14.6 && $post->systeme=="met") || (Conversion::ConvertPiedsToMetre($post->portee) > 14.6 && $post->systeme=="imp")){
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

			
			if(($post->surcharge > 10&& $post->systeme=="met") || (Conversion::ConvertLbsurPiCarreToKPa($post->surcharge) > 10 && $post->systeme=="imp")){
				$error = ERROR_SURCHARGE_BIGGER;
			}else if($post->surcharge<0){
				//$post->hauteur = 0;
				$error = ERROR_SURCHARGE_SMALLER;
			}

		}


		//------------------------------


		//on effectue des modifications sur la hauteur ecrite a la main
		$post->morte_sup = verifCarac($post->morte_sup);

		//Si il y a un probleme avec cette variable, on stock un msg d'erreur
		if(!is_numeric($post->morte_sup)){
			if(!isset($error)){
				$error = ERROR_MORTE_SUP_NOMBRE;
			}

		}else{
			
			if(($post->morte_sup > 10&& $post->systeme=="met") || (Conversion::ConvertLbsurPiCarreToKPa($post->morte_sup) > 10 && $post->systeme=="imp")){
				$error = ERROR_MORTE_SUP_BIGGER;
			}else if(($post->morte_sup < 0.25&& $post->systeme=="met") || (Conversion::ConvertLbsurPiCarreToKPa($post->morte_sup) <0.25 && $post->systeme=="imp")){
				//$post->hauteur = 0;
				$error = ERROR_MORTE_SUP_SMALLER;
			}
		}

		//------------------------------

		//on effectue des modifications sur la hauteur ecrite a la main
		$post->morte_inf = verifCarac($post->morte_inf);

		//Si il y a un probleme avec cette variable, on stock un msg d'erreur
		if(!is_numeric($post->morte_inf)){
			if(!isset($error)){
				$error = ERROR_MORTE_INF_NOMBRE;
			}

		}else{
			if(($post->morte_inf > 10&& $post->systeme=="met") || (Conversion::ConvertLbsurPiCarreToKPa($post->morte_inf) > 10 && $post->systeme=="imp")){
				$error = ERROR_MORTE_INF_BIGGER;
			}else if(($post->morte_inf < 0.25&& $post->systeme=="met") || (Conversion::ConvertLbsurPiCarreToKPa($post->morte_inf) <0.25 && $post->systeme=="imp")){
				//$post->hauteur = 0;
				$error = ERROR_MORTE_INF_SMALLER;
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

		//on defini les valeurs à ces variables
		if($post->type_poutrelle == "plancher"){
			$cat_risque->is_els	= 1;
			$cat_risque->is_elu	= 1;	
			
		}else /*if($post->type_poutrelle == "toit")*/{
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
			'surcharge_limite_global',
			'charge_totale_limite_global',
			'surcharge_limite_local',
			'charge_totale_limite_local_sup',
			'charge_totale_limite_local_inf'
		);

		//on associe les variables dans l'objet resistance_montant
		for($a=0; $a<count($fleche_valeurs); $a++){
			$fleche->$fleche_valeurs[$a]='';
		}
		
		//pour chaques classe, on a plusieurs limites de fleches locales (surcharge et charge totale)
		for($a=0; $a<count($tab_classe); $a++){
			//$fleche->surcharge_limite_local[$a]			= $tab_L_local_sup[$a] / $post->fleche_surcharge;
			$fleche->charge_totale_limite_local_sup[$a]	= $tab_L_local_sup[$a] / 180/*$post->fleche_charge_totale*/;
			$fleche->charge_totale_limite_local_inf[$a]	= $tab_L_local_inf[$a] / 360/*$post->fleche_charge_totale*/;
		}



		$EI_2x6 = 47790000000;


//**********************************************************************



//**********************************************************************



	// VARIABLES A CALCULER

	//---------------------

	

	//si les donnes rentres sont bonnes

	//et QU'IL N'Y A PAS D'ERREUR 

	//on peut continuer le traitement.

	if(!isset($error)){
		
		//on modifie les données si l'utilisateur a choisit d'entrer les données en IMPÉRIAL
		if($post->systeme == "imp"){
			$portee_tmp				= $post->portee;
			$surcharge_tmp			= $post->surcharge;
			$morte_sup_tmp			= $post->morte_sup;
			$morte_inf_tmp			= $post->morte_inf;
			
			$post->portee		= Conversion::ConvertPiedsToMetre($post->portee);
			$post->surcharge	= Conversion::ConvertLbsurPiCarreToKPa($post->surcharge);
			$post->morte_sup	= Conversion::ConvertLbsurPiCarreToKPa($post->morte_sup);
			$post->morte_inf	= Conversion::ConvertLbsurPiCarreToKPa($post->morte_inf);
		}
		
		
		$fleche->surcharge_limite_global		= $post->portee * 1000 / $post->fleche_surcharge;
		$fleche->charge_totale_limite_global	= $post->portee * 1000 / $post->fleche_charge_totale;

		if($post->portee<3){
			$vibration_limite = 2;

		}else if($post->portee>=3 && $post->portee<5.5){
			$vibration_limite = 8 / pow($post->portee,1.3);

		}else if($post->portee>=5.5 && $post->portee<=9.9){
			$vibration_limite = 2.55 / pow($post->portee,0.63);

		}else /*if($post->portee>9.9)*/{
			$vibration_limite = 0.6;
		}



		//DÉFINITION APPROFONDIE DE VARIABLES FIXE EN FONCTION DES CHOIX

		//--------------------------------------------------------------


		// Aire

		$Aire	= 38 * $post->hauteur /1000;

		//Propriétés des matériaux		
		if($post->type_revetement == 'contreplaque'){
			if($post->epaisseur_revetement == 16 ){
				$EIs	= 2.46759;
				$EIsp	= 0.76943;
				$EAs	= 0.07670;
				$EAsp	= 0.05305;
				$ts		= 15.5;
			}else/*if $post->epaisseur_revetement == 19 )*/{
				$EIs	= 4.24145;
				$EIsp	= 1.63150;
				$EAs	= 0.10261;
				$EAsp	= 0.07917;
				$ts		= 18.5;
			}

		}else/*if($post->type_revetement == 'osb')*/{
			if($post->epaisseur_revetement == 16 ){
				$EIs	= 2.60882;
				$EIsp	= 1.04850;
				$EAs	= 0.09544;
				$EAsp	= 0.06666; 
				$ts		= 15.9;
			}else /*if $post->epaisseur_revetement == 19 )*/{
				$EIs	= 4.50809;
				$EIsp	= 1.81115;
				$EAs	= 0.11453;
				$EAsp	= 0.07999;
				$ts		= 19;
			}
		}

		$EIs	= $EIs	* 1000000;
		$EIsp	= $EIsp	* 1000000;
		$EAs	= $EAs	* 1000000;
		$EAsp	= $EAsp	* 1000000;


		//---------------------------------

		// Propriété du Gyps et Slip Coefficients
		$G		= 20.7;

		if($post->plafond_gypse=='12.7'){
			$EIg	= 0.3;
			$EIgp	= 0.255;
			$EAgp	= 0.0190;
			$S2 	= 1.79;
			$tce	= 12.7;

		}elseif($post->plafond_gypse=='15.9'){
			$EIg	= 0.757;
			$EIgp	= 0.678;
			$EAgp	= 0.0322;
			$S2 	= 1.79;
			$tce	= 15.9;

		}else/*if($post->plafond_gypse=="aucun")*/{
			$EIg	= 0;
			$EIgp	= 0;
			$EAgp	= 0;
			$S2		= 0;
			$G		= 0;
			$tce	= 0;
		}

		$EIg	= $EIg * 1000000;
		$EIgp	= $EIgp * 1000000;
		$EAgp	= $EAgp * 1000000;

		//Slip Coefficients
		$L1 = 1220;
		if($post->attache_revetement=='cloue'){
			$S1	= 4.14;
		}else/*if($post->attache_revetement=='cloue_colle')*/{
			$S1	= 344.7;
		}


		//---------------------------------


		// CONVERSION DES CHARGES DE CALCULS
		$b		= 0.75;
		$c		= ($post->portee - $b)/2;
		$X		= $post->portee/2;
		$WPL	= ($post->PL / pow($b,2)) * ($post->espacement / 1000);

		//Sucharge ou neige
		$Wl	= $post->surcharge * ($post->espacement / 1000); 
		$Wl_elu	= $Wl * $cat_risque->is_elu;
		$Wl_els = $Wl * $cat_risque->is_els;

		$Wd_sup		= $post->morte_sup * ($post->espacement/1000);
		$Wd_inf		= $post->morte_inf * ($post->espacement/1000);
		$Wd_global	= $Wd_sup + $Wd_inf;

		//$tab_Wds = array($Wd_global,$Wd_sup,$Wd_inf);

		// DÉTERMINATION DES CAS DE CHARGEMENTS
		$tab_phiD = array(1.4 , 1.25 , 0.9);
		$tab_phiL = array(0 , 1.5 , 1.5);

		// Wf
		for( $a=0; $a<count($tab_phiL); $a++ ){
			
			$Wf1_sup[$a]	= ($tab_phiL[$a] * $Wl_elu) + ($tab_phiD[$a] * $Wd_sup);
			$Wf1_inf[$a]	= $tab_phiD[$a] * $Wd_inf;
			$Wf1[$a]		= $Wf1_sup[$a] + $Wf1_inf[$a];
			$Wf2_sup[$a]	= ($tab_phiL[$a] * $WPL) + ($tab_phiD[$a] * $Wd_sup);
			/*$Wf2_inf[$a]	= $Wf1_inf[$a];
			$Wf2[$a]		= $Wf2_sup[$a] + $Wf2_inf[$a];
			*/
			
			//on calcule les max de tous les wf1
			$Wf[$a]			= $Wf1[$a];
			if($Wf[$a] < $Wf1[$a])	{
				$Wf[$a]	= $Wf1[$a];
			}
		}


		// Wt

		// Une seule réponse possible pour Wt car on ne joue qu'avec les valeurs absolues
		$max_Wt = $Wd_global + $Wl_els;

		//pour chaques cas de chargement, on calcule les Mf1_global qui nous donne temporairement les Mf_global
		//détermination de variables fixe. R2, MPL et MfPL
		// Pour chaques cas de chargement

		$R2		= (($WPL * $b) / (2 * $post->portee)) * ((2 *$c) + $b);
		$MPL	= ($R2 * $X) - (($WPL / 2) * pow($X - $c,2));

		for($cas=0;$cas<3;$cas++){

			$Mf1_global[$cas]	= ($Wf[$cas] * pow($post->portee,2)) / 8;
			$Mf_global[$cas]	= $Mf1_global[$cas];
			
			$MfPL[$cas]	= $tab_phiL[$cas] * $cat_risque->is_elu * $MPL;
			
			// MfD_sup et MFD_inf donne Mf2
			$MfD_sup[$cas]	= ($tab_phiD[$cas] * $Wd_sup) * pow($post->portee,2) / 8;
			$MfD_inf[$cas]	= ($tab_phiD[$cas] * $Wd_inf) * pow($post->portee,2) / 8;
			$MfD[$cas]		= $MfD_sup[$cas] + $MfD_inf[$cas];
			
			$Mf2_global[$cas] = $MfPL[$cas] + $MfD[$cas];

			//on prend le plus grand
			//Si Mf2 > que Mf, Mf = Mf2
			if(	$Mf2_global[$cas] > $Mf_global[$cas]){
				$Mf_global[$cas] = $Mf2_global[$cas];
			}
		}

		//pour chaques classe
		for($a=0; $a<count($tab_classe); $a++ ){
			//pour chaques cas de chargement
			for( $cas=0; $cas<count($tab_phiL); $cas++ ){
				$Mf1_local_sup[$a][$cas]	= ($Wf1_sup[$cas] * pow($tab_L_local_sup[$a] / 1000,2)) / 9;
				$Mf2_local_sup[$a][$cas]	= ($Wf2_sup[$cas] * pow($tab_L_local_sup[$a] / 1000,2)) / 8;
				
				//on prend le maximum entre Mf1_local_sup et Mf2_local_sup
				$Mf_local_sup[$a][$cas]	= $Mf1_local_sup[$a][$cas];
				if($post->PL!=0){
					if($Mf_local_sup[$a][$cas] < $Mf2_local_sup[$a][$cas]){
						$Mf_local_sup[$a][$cas] = $Mf2_local_sup[$a][$cas];
					}
				}
				
				$Mf1_local_inf[$a][$cas]	= ($Wf1_inf[$cas] * pow($tab_L_local_inf[$a] / 1000,2)) / 8;
				$Mf2_local_inf[$a][$cas]	= $Mf1_local_inf[$a][$cas];
				
				//on prend le maximum entre Mf1_local_inf et Mf2_local_inf
				$Mf_local_inf[$a][$cas]	= $Mf1_local_inf[$a][$cas];
				if($Mf_local_inf[$a][$cas] < $Mf2_local_inf[$a][$cas]){
					$Mf_local_inf[$a][$cas] = $Mf2_local_inf[$a][$cas];
				}
			}
		}


		// Pour chaques cas de chargement, on trouve les Pf,

		for($cas=0; $cas<3; $cas++){
			$Pf[$cas]	= $Mf_global[$cas] / (($post->hauteur -38)/1000);	
			
			//pour chaques classe, on trouve les Efforts combinés sup et Efforts combines inf
			for($a=0; $a<count($tab_classe); $a++ ){
				$eff_comb_sup[$a][$cas]	= ($Pf[$cas] /$tab_Pr[$a]) + ($Mf_local_sup[$a][$cas] / $tab_Mr[$a]);
				$eff_comb_inf[$a][$cas]	= ($Pf[$cas] /$tab_Tr[$a]) + ($Mf_local_inf[$a][$cas] / $tab_Mr[$a]);
			}
		}


		//------------------------------

		//VÉRIFICATION DES ÉTATS LIMITES DE SERVICES

		for($a=0; $a<count($tab_classe); $a++){
			
			// GLOBAL
			//Fleche surcharge
			$fleche_surcharge[$a]		= (((5 * $Wl_els * pow($post->portee,4)) / (384 * $tab_EI_global[$a])) + (($Wl_els * pow($post->portee,2)) / ($tab_K[$a] * 1000))) *1000;
			
			// Fleche charge totale
			$fleche_charge_totale[$a]	= (((5 * $max_Wt * pow($post->portee,4)) / (384 * $tab_EI_global[$a])) + (($max_Wt * pow($post->portee,2)) / ($tab_K[$a] * 1000)))* 1000;
			
			$fleche_PL[$a]	= (((($WPL * pow($c,2) * pow($X,2) / 4) + ($WPL * pow($X,4) / 24) - ($WPL * pow($X,3) * $c / 6) - ($R2 * pow($X,3) / 6)) / $tab_EI_global[$a]) + (8 * $MPL / ($tab_K[$a] * 1000))) * 1000;
			
			if($fleche_surcharge[$a] <= $fleche_PL[$a]) {
				$fleche_surcharge[$a] = $fleche_PL[$a];
			}
			$fleche_D[$a] = (((5 * $Wd_global * pow($post->portee,4)) / (384 * $tab_EI_global[$a])) + ($Wd_global * pow($post->portee,2) / ($tab_K[$a] * 1000))) * 1000;

			$fleche_PLtotale[$a] = $fleche_PL[$a] + $fleche_D[$a];
			
			if($fleche_charge_totale[$a] <= $fleche_PLtotale[$a]) {
				$fleche_charge_totale[$a] = $fleche_PLtotale[$a];
			}
			
			// LOCAL 
			$tab_L_local_sup_mille[$a]	= $tab_L_local_sup[$a] / 1000;
			$tab_L_local_inf_mille[$a]	= $tab_L_local_inf[$a] / 1000;
			$tab_EI_local_mille[$a]			= $tab_EI_local[$a]	/ 1000;	
			
			//Fleche surcharge locale sup
			$fleche_surcharge_loc[$a]        = ((3.75 * $Wl_els * pow($tab_L_local_sup_mille[$a],4)) / (384 * $tab_EI_local_mille[$a]))* 1000;
			
			// Fleche charge morte locale sup et inf
			$fleche_D_loc_sup[$a]        = ((3.75 * $Wd_sup * pow($tab_L_local_sup_mille[$a],4)) / (384 * $tab_EI_local_mille[$a]))* 1000;
			$fleche_D_loc_inf[$a]        = ((5 * $Wd_inf * pow($tab_L_local_inf_mille[$a],4)) / (384 * $tab_EI_local_mille[$a]))* 1000;
			
			$fleche_PL_loc[$a]         = ((3.75 * $WPL * pow($tab_L_local_sup_mille[$a],4)) / (384 * $tab_EI_local_mille[$a]))* 1000;
													 
			if($fleche_surcharge_loc[$a] <= $fleche_PL_loc[$a]) {
				$fleche_surcharge_loc[$a] = $fleche_PL_loc[$a];
			}
			
			$fleche_charge_totale_loc_sup[$a]	= $fleche_surcharge_loc[$a] + $fleche_D_loc_sup[$a];
			$fleche_PLtotale_loc_sup[$a]		= $fleche_PL_loc[$a] + $fleche_D_loc_sup[$a];
			
			if($fleche_charge_totale_loc_sup[$a] <= $fleche_PLtotale_loc_sup[$a]) {
				$fleche_charge_totale_loc_sup[$a] = $fleche_PLtotale_loc_sup[$a];
			}
			
			$fleche_charge_totale_loc_inf[$a] = $fleche_D_loc_inf[$a];
		}


		if($post->type_poutrelle == "plancher"){
			
			// SOMME DE Kbi
			$Kbs = 0;
			if($post->surcharge != 0){
				$Kbs	= (0.585 * $EIs * $post->portee * 1000) / pow($post->espacement,3);
			}
			
			$Kbg	= 0;
			if($EIg!=0){
				if($post->surcharge != 0){
					$Kbg	= (0.585 * $EIg * $post->portee * 1000) / pow($post->espacement,3);
				}
			}
			
			$Kb2x6	= 0;
			if($post->rangee_blocages == 'mi_portee'){
				$Kb2x6	= ($EI_2x6 / pow($post->espacement,3)) * pow(abs(1 - (610 / ($post->portee * 1000))),1.71);
			}
			
			$Kbi	= $Kbs + $Kbg + (2 * $Kb2x6);

			// SOMME DE Kvi
			$Kvi = 0;
			/*
			if($post->surcharge != 0 && $post->rangee_blocages!='non'){
				$Kvi	= (($G * $Aire)/$post->espacement)*1000;
			}
			*/
			
			// K2
			$K2 = 0;
			/*
			if($Kbi !=0){
				$K2		= $Kvi / $Kbi;
			}
			*/
			
			// EA1
			$EA1	= ($post->espacement * $EAsp) / (1 + (10 * ($post->espacement * $EAsp) / ($S1 * pow($L1,2))));
			
			// EA2
			$EA2 	= 0;
			if($S2 != 0){
				$EA2	= ($post->espacement * $EAgp) / (1 + ( 10 * ($post->espacement * $EAgp) / ($S2 * pow($post->portee * 1000,2))));
			}
			
			//h1
			$h1	= ($post->hauteur / 2) + ($ts / 2);
			 
			//h2
			$h2	= ($post->hauteur / 2) + ($tce / 2);
			
			for($a=0; $a<count($tab_classe); $a++){
							
				 // A
				// $A = $EAjoist + $EA1 + $EA2
				$tab_A[$a] = ($tab_EA[$a] * 1000000) + $EA1 + $EA2;
				
				 // y 
				// $y 	= (($h1 * $EA1) - ($h2 * $EA2)) / $A;
				$tab_y[$a] = (($h1 * $EA1) - ($h2 * $EA2)) / $tab_A[$a];
			
				//EIjoist
				//$EIjoist	= pow($post->portee,2) / ((pow($post->portee,2) / $EI) + (96 / $Ks)
				$tab_EIjoist[$a] = pow($post->portee * 1000,2) / ((pow($post->portee * 1000,2) / ($tab_EI_global[$a] * 1000000000)) + (96 / ($tab_K[$a] * 1000000)) );
			
				//EIu
				//$EIu		= $EIjoist + ($post->espacement * $EIsp);
				$tab_EIu[$a] = $tab_EIjoist[$a] + ($post->espacement * $EIsp);
			
				// EIeff
				//$tab_EIeff	= $EIu + ($EA1 * pow($h1,2)) + ($EA2 * pow($h2,2)) - ($A * pow($y,2));
				$tab_EIeff[$a] = $tab_EIu[$a] + ($EA1 * pow($h1,2)) + ($EA2 * pow($h2,2)) - ($tab_A[$a] * pow($tab_y[$a],2));
			
				// Kj
				//$Kj		=	$EIeff / pow($post->portee,3);
				$tab_Kj[$a] = $tab_EIeff[$a] / pow($post->portee*1000,3);
			
				// K1
				//$K1		= $Kj / ($Kj + $Kbi);
				$tab_K1[$a] = $tab_Kj[$a] / ($tab_Kj[$a] + $Kbi);
			
				// DFb
				//$DFb 	= 0.0294 + (0.536 * pow($K1,(1/4))) + (0.516 * pow($K1,(1/2))) - (0.31 * pow($K1,(3/4)));
				$tab_DFb[$a]	= 0.0294 + (0.536 * pow($tab_K1[$a],(1/4)) ) + (0.516 * pow($tab_K1[$a],(1/2)) ) - (0.31 * pow($tab_K1[$a],(3/4))); 
			
				//DFv
				$tab_DFv[$a] = 0;
				/*
				if($post->rangee_blocages == 'non'){
					$tab_DFv[$a] = 0;
				}else{
					//$DFv	= -0.00253 - (0.0854 * pow($K1,(1/4))) + (0.0797 * pow($K2,(1/2))) - (0.00327 * $K2);
					$tab_DFv[$a] = -0.00253 - (0.0854 * pow($tab_K1[$a],(1/4))) + (0.0797 * pow($K2,(1/2))) - (0.00327 * $K2);
				}
				*/
			
				// DF
				//$tab_DF		= $tab_DFb - $DFv;
				$tab_DF[$a] = $tab_DFb[$a] - $tab_DFv[$a];
			
				 // VIBRATION
				//$vibration = $DF * ((1000 * pow($post->portee,3)) / (48 * $EIeff));
				$vibration[$a] = $tab_DF[$a] * ((1000 * pow($post->portee,3)) / (48 * $tab_EIeff[$a])) * 1000000000;
			}
		}

		//------------------------------

		// VÉRIFICATION DES RÉSISTANCES 
		$tab_nom_serie			= array();
		$tab_max_ratio			= array();
		$tab_nom_resistance_max	= array();
		$debug_verif = '';		

		for($a=0; $a<count($tab_classe); $a++){
			
			$max_ratio_tmp=0;
			$nom_resistance_max = '';
			
			$ok = false;

			//on sauve le plus grand ration
			//pour chaques cas de chargement
			for($cas=0; $cas<3; $cas++){
				
				if($Mf_local_sup[$a][$cas]/$tab_Mr[$a] > $max_ratio_tmp){
					$max_ratio_tmp = $Mf_local_sup[$a][$cas]/$tab_Mr[$a];
					$nom_resistance_max = 'Moment appliqu&eacute';
				}
				
				if($Mf_local_inf[$a][$cas]/$tab_Mr[$a] > $max_ratio_tmp){
					$max_ratio_tmp = $Mf_local_inf[$a][$cas]/$tab_Mr[$a];
					$nom_resistance_max = 'Moment appliqu&eacute';
				}

				if($Pf[$cas]/$tab_Pr[$a] > $max_ratio_tmp){
					$max_ratio_tmp = $Pf[$cas]/$tab_Pr[$a];
					$nom_resistance_max = 'Compression axiale appliqu&eacute';
				}

				if($Pf[$cas]/$tab_Tr[$a] > $max_ratio_tmp){
					$max_ratio_tmp = $Pf[$cas]/$tab_Tr[$a];
					$nom_resistance_max = 'Traction axiale appliqu&eacute';
				}
			
				if($eff_comb_sup[$a][$cas] > $max_ratio_tmp){
					$max_ratio_tmp = $eff_comb_sup[$a][$cas];
					$nom_resistance_max = 'Efforts combin&eacute;s - membrure sup&eacute;rieure';
				}
				
				if($eff_comb_inf[$a][$cas] > $max_ratio_tmp){
					$max_ratio_tmp = $eff_comb_inf[$a][$cas];
					$nom_resistance_max = 'Efforts combin&eacute;s - membrure inf&eacute;rieure';
				}
			}
			
			if($fleche_surcharge[$a]/$fleche->surcharge_limite_global > $max_ratio_tmp){
				$max_ratio_tmp =$fleche_surcharge[$a]/$fleche->surcharge_limite_global;
				$nom_resistance_max = 'Fl&egrave;che limit&eacute;e par la limite L/'.$post->fleche_surcharge;
			}
			
			/*
			if($fleche_surcharge_loc[$a]/$fleche->surcharge_limite_local[$a] > $max_ratio_tmp){
				$max_ratio_tmp =$fleche_surcharge_loc[$a]/$fleche->surcharge_limite_local[$a];
				$nom_resistance_max = 'Fl&egrave;che locale limit&eacute;e par la limite L/'.$post->fleche_surcharge;
			}
			*/
			
			if($fleche_charge_totale[$a]/$fleche->charge_totale_limite_global > $max_ratio_tmp){
				$max_ratio_tmp =$fleche_charge_totale[$a]/$fleche->charge_totale_limite_global;
				$nom_resistance_max = 'Fl&egrave;che limit&eacute;e par la limite L/'.$post->fleche_charge_totale;
			}
			
			if($fleche_charge_totale_loc_inf[$a]/$fleche->charge_totale_limite_local_inf[$a] > $max_ratio_tmp){
				$max_ratio_tmp =$fleche_charge_totale_loc_inf[$a]/$fleche->charge_totale_limite_local_inf[$a];
				$nom_resistance_max = 'Fl&egrave;che locale limit&eacute;e par la limite L/360'; 
			}
			
			if($fleche_charge_totale_loc_sup[$a]/$fleche->charge_totale_limite_local_sup[$a] > $max_ratio_tmp){
				$max_ratio_tmp =$fleche_charge_totale_loc_sup[$a]/$fleche->charge_totale_limite_local_sup[$a];
				$nom_resistance_max = 'Fl&egrave;che locale limit&eacute;e par la limite L/180'; 
			}
	
			if($max_ratio_tmp<=1){
				$ok = true;
			}
				
			//si c'est le plancher, il faut également vérifier
			if($post->type_poutrelle == "plancher"){
				
				if($vibration[$a]<=$vibration_limite){
				
					//on sauve le plus grand ration
					if($vibration[$a]/$vibration_limite > $max_ratio_tmp){
						$max_ratio_tmp = $vibration[$a]/$vibration_limite;
						$nom_resistance_max = 'Vibration';
					}
				}else{
					$ok = false;
				}
			}
			
			if($ok){
				//on sauve le stock
				$tab_nom_serie[] 			= $tab_classe[$a];
				$tab_max_ratio[]			= $max_ratio_tmp;
				$tab_nom_resistance_max[]	= $nom_resistance_max;
			}
		}
		
		//on modifie les données si l'utilisateur a choisit d'entrer les données en IMPÉRIAL
		if($post->systeme == "imp"){
			$post->portee			= $portee_tmp;
			$post->surcharge		= $surcharge_tmp;
			$post->morte_sup		= $morte_sup_tmp;
			$post->morte_inf		= $morte_inf_tmp;
		}
	}


?>

