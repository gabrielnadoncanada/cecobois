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
		$post->morte = verifCarac($post->morte);
		
		//Si il y a un probleme avec cette variable, on stock un msg d'erreur
		if(!is_numeric($post->morte)){
			if(!isset($error)){
				$error = ERROR_MORTE_NOMBRE;
			}
		}else{
			if(($post->morte > 10&& $post->systeme=="met") || (Conversion::ConvertLbsurPiCarreToKPa($post->morte) > 10 && $post->systeme=="imp")){
				$error = ERROR_MORTE_BIGGER;
			}else if(($post->morte < 0.5&& $post->systeme=="met") || (Conversion::ConvertLbsurPiCarreToKPa($post->morte) <0.5 && $post->systeme=="imp")){
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
			'surcharge',
			'charge_totale'
		);
		
		//on associe les variables dans l'objet resistance_montant
		for($a=0; $a<count($fleche_valeurs); $a++){
			$fleche->$fleche_valeurs[$a]='';
		}
		
		
		//on définit un tableau EI, MR, VR, K, EA en fonction des hauteurs de poutrelles choisies
		
		$tab_classe_gen	= array(	'2x3 - 1650',	'2x3 - 1950',	'2x3 - 2100',	'2x4 - 2100',	'2x4 - 2400');
		
		if($post->hauteur == 241){
			$tab_classe	= array($tab_classe_gen[0], $tab_classe_gen[1], $tab_classe_gen[2]);
			$tab_EI = array(	540,	611,	646		);
			$tab_Mr = array(	5.368,	7.251,	8.334	);
			$tab_Vr = array(	8.08,	8.08,	8.08	);
			$tab_RE	= array(	6.92,	6.92,	6.92	);
			$tab_K	= array(	20.83,	20.83,	20.83	);
			$tab_EA = array(	57.68,	64.49,	67.90	);
			
		}else if($post->hauteur == 302){
			$tab_classe	= $tab_classe_gen;
			$tab_EI = array(	925,	1044,	1104,	1517,	1690	);
			$tab_Mr = array(	6.972,	9.418,	10.824,	15.219,	18.572	);
			$tab_Vr = array(	9.85,	9.85,	9.85,	9.85,	13.44	);
			$tab_RE	= array(	8.67,	8.67,	8.67,	8.67,	10.04	);
			$tab_K 	= array(	25.91,	25.91,	25.91,	25.91,	25.91	);
			$tab_EA = array(	60.49,	67.30,	70.70,	94.26,	105.32	);
	
		}else if($post->hauteur == 356){
			$tab_classe	= $tab_classe_gen;
			$tab_EI = array(	1359,	1532,	1619,	2217,	2471	);
			$tab_Mr = array(	8.392,	11.336,	13.029,	18.323,	22.360	);
			$tab_Vr = array(	11.42,	11.42,	11.42,	11.42,	14.30	);
			$tab_RE	= array(	8.67,	8.67,	8.67,	8.67,	10.04	);
			$tab_K	= array(	30.40,	30.40,	30.40,	30.40,	30.40	);
			$tab_EA = array(	62.97,	69.78,	73.19,	96.75,	108.18	);
		
		}else if($post->hauteur == 406){
			$tab_classe	= $tab_classe_gen;
			$tab_EI = array(	1844,	2075,	2191,	2992,	3335	);
			$tab_Mr = array(	9.706,	13.112,	15.070,	21.197,	25.867	);
			$tab_Vr = array(	12.88,	12.88,	12.88,	12.88,	15.09	);
			$tab_RE	= array(	8.67,	8.67,	8.67,	8.67,	10.04	);
			$tab_K	= array(	34.55,	34.55,	34.55,	34.55,	34.55	);
			$tab_EA = array(	65.27,	72.08,	75.49,	99.05,	110.83	);
		
		}else if($post->hauteur == 457){
			$tab_classe	= array($tab_classe_gen[3], $tab_classe_gen[4]);
			$tab_EI = array(	3910,	4360	);
			$tab_Mr = array(	23.982,	29.266	);
			$tab_Vr = array(	14.36,	15.90	);
			$tab_RE	= array(	11.80,	11.80	);
			$tab_K	= array(	38.79,	38.79	);
			$tab_EA = array(	101.39,	113.53	);
			
		}else if($post->hauteur == 508){
			$tab_classe	= array($tab_classe_gen[3], $tab_classe_gen[4]);
			$tab_EI = array(	4960,	5533	);
			$tab_Mr = array(	26.556,	32.407	);
			$tab_Vr = array(	15.84,	16.71	);
			$tab_RE	= array(	13.12,	13.12	);
			$tab_K	= array(	43.03,	43.03	);
			$tab_EA = array(	103.74,	116.23	);
			
		}else if($post->hauteur == 559){
			$tab_classe	= array($tab_classe_gen[3], $tab_classe_gen[4]);
			$tab_EI = array(	6147,	6858	);
			$tab_Mr = array(	29.097,	35.508	);
			$tab_Vr = array(	15.84,	17.52	);
			$tab_RE	= array(	14.44,	14.44	);
			$tab_K	= array(	47.28,	47.28	);
			$tab_EA = array(	106.09,	118.94	);
			
		}else if($post->hauteur == 610){
			$tab_classe	= array($tab_classe_gen[3], $tab_classe_gen[4]);
			$tab_EI = array(	7472,	8339	);
			$tab_Mr = array(	31.608,	38.572	);
			$tab_Vr = array(	15.84,	18.33	);
			$tab_RE	= array(	15.75,	15.75	);
			$tab_K	= array(	51.52,	51.52	);
			$tab_EA = array(	108.43,	121.64	);
		}
		
		
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
			$portee_tmp			= $post->portee;
			$surcharge_tmp		= $post->surcharge;
			$morte_tmp			= $post->morte;
			
			$post->portee		= Conversion::ConvertPiedsToMetre($post->portee);
			$post->surcharge	= Conversion::ConvertLbsurPiCarreToKPa($post->surcharge);
			$post->morte		= Conversion::ConvertLbsurPiCarreToKPa($post->morte);
		}
		
		
		$fleche->surcharge_limite		= $post->portee * 1000 / $post->fleche_surcharge;
		$fleche->charge_totale_limite	= $post->portee * 1000 / $post->fleche_charge_totale;
		
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
			$G		= 10.3;
			$tce = 0;
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
		
		$Wd		= $post->morte * ($post->espacement / 1000);
		
		// DÉTERMINATION DES CAS DE CHARGEMENTS
		
		//États limites ultimes
		$max_Wf = 0;
		
		$Wf[0]	= 1.4 * $Wd;
		$Wf[1]	= (1.25 * $Wd) + (1.5 * $Wl_elu);
		$Wf[2]	= (0.9 * $Wd) + (1.5 * $Wl_elu);
		
		//on va chercher le maximum des 3 cas possibles pour les etats limites ultimes
		for($a=0; $a<3; $a++){
			if($max_Wf < $Wf[$a]){
				$max_Wf = $Wf[$a];
			}
		}
		
		//-----------------------------------------------------------------
		
		//États limites de service

		
		//VÉRIFICATION DES ÉTATS LIMITES ULTIMES 
		
		//Moment appliqué
		$Mf1	= ($max_Wf * pow($post->portee,2)) /  8;
		$Mf		= $Mf1;
		
		$R2		= (($WPL * $b) / (2 * $post->portee)) * ((2 * $c) + $b);
		
		$MPL	= ($R2 * $X) - (($WPL / 2) * pow($X - $c,2));
		$MfPL	= 1.5 * $MPL;
		$MfD	= (1.25 * $Wd) * pow($post->portee,2) / 8;
		$Mf2	= $MfPL + $MfD;
		
		if($Mf <= $Mf2) {
			$Mf = $Mf2;
		}
		
		// Cisailement appliqué
		$Vf1	= ($max_Wf * $post->portee) / 2;
		$Vf		= $Vf1;
		
		$VfPL	= ((1.5 * $WPL *$b) / (2 * $post->portee)) * ((2 * $post->portee) - $b);
		$VfD	= (1.25 * $Wd) * $post->portee / 2;
		$Vf2	= $VfPL + $VfD;
		if($Vf <= $Vf2) {
			$Vf = $Vf2;
		}
		
		//Reaction d'appui
		/*$Bf = $Vf;*/
	
		
		//------------------------------
		
		
		
		//VÉRIFICATION DES ÉTATS LIMITES DE SERVICES
		
		for($a=0; $a<count($tab_classe); $a++){
			
			//Fleche surcharge
			$fleche_surcharge[$a]		= (((5 * $Wl_els * pow($post->portee,4)) / (384 * $tab_EI[$a])) + (($Wl_els * pow($post->portee,2)) / ($tab_K[$a] * 1000))) *1000;
			
			// Fleche charge totale
			//$fleche_charge_totale[$a]	= (((5 *  pow($post->portee,4)) / (384 * $tab_EI[$a])) + ((pow($post->portee,2)) / ($tab_K[$a] * 1000)))* 1000;
			
			
			$fleche_PL[$a]	= (((($WPL * pow($c,2) * pow($X,2) / 4) + ($WPL * pow($X,4) / 24) - ($WPL * pow($X,3) * $c / 6) - ($R2 * pow($X,3) / 6)) / $tab_EI[$a]) + (8 * $MPL / ($tab_K[$a] * 1000))) * 1000;
			
			if($fleche_surcharge[$a] <= $fleche_PL[$a]) {
				$fleche_surcharge[$a] = $fleche_PL[$a];
			}
			$fleche_D[$a] = (((5 * $Wd * pow($post->portee,4)) / (384 * $tab_EI[$a])) + ($Wd * pow($post->portee,2) / ($tab_K[$a] * 1000))) * 1000;
			
			// Fleche charge totale
			$fleche_charge_totale[$a] = $fleche_surcharge[$a] + $fleche_D[$a];
			$fleche_PLtotale[$a] = $fleche_PL[$a] + $fleche_D[$a];
			
			if($fleche_charge_totale[$a] <= $fleche_PLtotale[$a]) {
				$fleche_charge_totale[$a] = $fleche_PLtotale[$a];
			}			
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
			$Kbi	= $Kbs + $Kbg;
		
			// SOMME DE Kvi
			$Kvi = 0;
			
			if($post->surcharge != 0 && $post->rangee_blocages!='non'){
				$Kvi	= (($G * $Aire)/$post->espacement)*1000;
			}
			
			// K2
			$K2 = 0;
			if($Kbi !=0){
				$K2		= $Kvi / $Kbi;
			}
			
			// EA1
			$EA1	= ($post->espacement * $EAsp) / (1 + (10 * ($post->espacement * $EAsp) / ($S1 * pow($L1,2))));
			
			// EA2
			if($EAgp ==0){
				$EA2	= 0;
			}else{
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
				$tab_EIjoist[$a] = pow($post->portee * 1000,2) / ((pow($post->portee * 1000,2) / ($tab_EI[$a] * 1000000000)) + (96 / ($tab_K[$a] * 1000000)) );
			
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
				if($post->rangee_blocages == 'non'){
					$tab_DFv[$a] = 0;
				}else{
					//$DFv	= -0.00253 - (0.0854 * pow($K1,(1/4))) + (0.0797 * pow($K2,(1/2))) - (0.00327 * $K2);
					$tab_DFv[$a] = -0.00253 - (0.0854 * pow($tab_K1[$a],(1/4))) + (0.0797 * pow($K2,(1/2))) - (0.00327 * $K2);
				}
			
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
			
			
			//pour chaque série, on vérifie si le Mf<=Mr, Vf<=Vr, Bf<=RE, Fleche_surcharge<=Fleche_surcharge_limite et fleche_charge_totale<=fleche_charge_totale_limite
			if($Mf<=$tab_Mr[$a] && $Vf<=$tab_Vr[$a] /*&& $Bf<=$tab_RE*/ && $fleche_surcharge[$a]<=$fleche->surcharge_limite && $fleche_charge_totale[$a]<=$fleche->charge_totale_limite){
				

				 $ok = true;
				 
				//on sauve le plus grand ration
				if($Mf/$tab_Mr[$a] > $max_ratio_tmp){
					$max_ratio_tmp = $Mf/$tab_Mr[$a];
					$nom_resistance_max = 'Moment appliqu&eacute;';
				}
				
				if($Vf/$tab_Vr[$a] > $max_ratio_tmp){
					$max_ratio_tmp = $Vf/$tab_Vr[$a];
					$nom_resistance_max = 'Cisaillement appliqu&eacute;';
				}
				
				
				if($fleche_surcharge[$a]/$fleche->surcharge_limite > $max_ratio_tmp){
					$max_ratio_tmp =$fleche_surcharge[$a]/$fleche->surcharge_limite;
					$nom_resistance_max = 'Fl&egrave;che limit&eacute;e par la limite L/'.$post->fleche_surcharge;
				}
				
				if($fleche_charge_totale[$a]/$fleche->charge_totale_limite > $max_ratio_tmp){
					$max_ratio_tmp =$fleche_charge_totale[$a]/$fleche->charge_totale_limite;
					$nom_resistance_max = 'Fl&egrave;che limit&eacute;e par la limite L/'.$post->fleche_charge_totale;
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
		}
		
		//on modifie les données si l'utilisateur a choisit d'entrer les données en IMPÉRIAL
		if($post->systeme == "imp"){
			$post->portee		= $portee_tmp;
			$post->surcharge	= $surcharge_tmp;
			$post->morte		= $morte_tmp;
		}
			
	}
		
?>