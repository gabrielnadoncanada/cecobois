<?PHP

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
			'fleche_charge_tot_res',
			'volume_bois',
			'pmp'
		);
		
		//on associe les variables de $html_champs_sortie dans l'object output.
		for($a=0; $a<count($html_champs_sortie); $a++){
			$output->$html_champs_sortie[$a]='';
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
		
	
	//VARIABLES FIXES
	//---------------
	
		//on dfini les variables de la class classe
		$classe_valeurs=array(
			'fb',
			'fv',
			'fc',
			'e',
			'e05',
			'khc',
			'khb_khv'
		);
		
		//on associe les variables dans l'objet classe
		for($a=0; $a<count($classe_valeurs); $a++){
			$classe->$classe_valeurs[$a]='';
		}
		
		//on associes les valeurs à ces variables
		$classe->fv		= 1.5;
		$classe->khc	= 1.1;
		$densite_bois	= 0.42;
		
		/*if($post->classe=='eps_select'){
			$classe->fb			= 16.5;
			$classe->fc			= 14.5;
			$classe->e			= 10500;
			$classe->e05		= 7500;
			$classe->khb_khv	= 1.4;
			
		}else */if($post->classe=='eps_no1_2'){
			$classe->fb			= 11.8;
			$classe->fc			= 11.5;
			$classe->e			= 9500;
			$classe->e05		= 6500;
			$classe->khb_khv	= 1.4;
			
		}else if($post->classe=='eps_no3'){
			$classe->fb			= 7;
			$classe->fc			= 7;
			$classe->e			= 9000;
			$classe->e05		= 5500;
			$classe->khb_khv	= 1.4;
		
		}else if($post->classe=='msr1650'){
			$classe->fb			= 23.9;
			$classe->fc			= 18.1;
			$classe->e			= 10300;
			$classe->e05		= 8446;
			$classe->khb_khv	= 1.2;
		
		}else if($post->classe=='msr1950'){
			$classe->fb			= 28.2;
			$classe->fc			= 19.3;
			$classe->e			= 11700;
			$classe->e05		= 9594;
			$classe->khb_khv	= 1.2;
		
		}else if($post->classe=='msr2100'){
			$classe->fb			= 30.4;
			$classe->fc			= 19.9;
			$classe->e			= 12400;
			$classe->e05		= 10168;
			$classe->khb_khv	= 1.2;
			$densite_bois		= 0.47;
		
		}else if($post->classe=='msr2250'){
			$classe->fb			= 32.6;
			$classe->fc			= 20.5;
			$classe->e			= 13100;
			$classe->e05		= 10742;
			$classe->khb_khv	= 1.2;
			$densite_bois		= 0.47;
		
		}else if($post->classe=='msr2400'){
			$classe->fb			= 34.7;
			$classe->fc			= 21.1;
			$classe->e			= 13800;
			$classe->e05		= 11316;
			$classe->khb_khv	= 1.2;
			$densite_bois		= 0.5;
		}
		
		//on corrige le khb_khv	si c'est le cas 1 qui a ete choisi.
		if($post->partage_charge=='1'){
			$classe->khb_khv	= 1.1;
		}
		
		
		
		//------------------------------
		
		
		//on defini les variables de l'objet colombages
		$colombages_valeurs=array(
			'largeur',
			'hauteur',
			'Kzb_eps_Kzv',
			'poids',
			'largeur_nominale',
			'hauteur_nominale'
		);
		
		
		//on associe les variables dans l'objet colombages
		for($a=0; $a<count($colombages_valeurs); $a++){
			$colombages->$colombages_valeurs[$a]='';
		}
		
		//on defini les valeurs à ces variables
		$colombages->largeur= 38;
		
		$tab_nominale = split('x',$post->colombages);
		$colombages->largeur_nominale= $tab_nominale[0];
		$colombages->hauteur_nominale= $tab_nominale[1];
		
		
		if($post->colombages=='2x3'){
			$colombages->hauteur		= 64;
			$colombages->Kzb_eps_Kzv	= 1.7;
			
		}else if($post->colombages=='2x4'){
			$colombages->hauteur		= 89;
			$colombages->Kzb_eps_Kzv	= 1.7;
			
		}else if($post->colombages=='2x6'){
			$colombages->hauteur		= 140;
			$colombages->Kzb_eps_Kzv	= 1.4;
			
		}else if($post->colombages=='2x8'){
			$colombages->hauteur		= 184;
			$colombages->Kzb_eps_Kzv	= 1.2;
			
		}else if($post->colombages=='2x10'){
			$colombages->hauteur		= 235;
			$colombages->Kzb_eps_Kzv	= 1.1;
			
		}else if($post->colombages=='2x12'){
			$colombages->hauteur		= 286;
			$colombages->Kzb_eps_Kzv	= 1.0;
		}

		//------------------------------
		
		//on effectue des modifications sur la hauteur ecrite a la main
		$post->hauteur = strtolower($post->hauteur);
		$post->hauteur = str_replace(',','.',$post->hauteur);
		$post->hauteur = str_replace('m','',$post->hauteur);
		
		
		
		//Si il y a un probleme avec cette variable, on stock un msg d'erreur
		if(!is_numeric($post->hauteur)){
			if(!isset($error)){
				$error = ERROR_HAUTEUR_NOMBRE;
			}
		}else{
			if($post->hauteur > 4.88){
				$error = ERROR_HAUTEUR_BIGGER;
			}else if($post->hauteur<1){
				//$post->hauteur = 0;
				$error = ERROR_HAUTEUR_SMALLER;
			}
		}

        $coeficient_elancement = $post->hauteur * 1000 / $colombages->hauteur;
        if ($coeficient_elancement > 50) {
            $error = ERROR_ELANCEMENT_TOO_BIG;
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
		$post->ax_neige = strtolower($post->ax_neige);
		$post->ax_neige = str_replace(',','.',$post->ax_neige);
		$post->ax_neige = str_replace('kn/m','',$post->ax_neige);
		
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
		$post->ax_surcharge = strtolower($post->ax_surcharge);
		$post->ax_surcharge = str_replace(',','.',$post->ax_surcharge);
		$post->ax_surcharge = str_replace('kn/m','',$post->ax_surcharge);
		
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
		$post->ax_permanente = strtolower($post->ax_permanente);
		$post->ax_permanente = str_replace(',','.',$post->ax_permanente);
		$post->ax_permanente = str_replace('kn/m','',$post->ax_permanente);
		
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
		
		//On effectue un calcul pour connaitre le poids du colombage
		$colombages->poids = $post->ax_permanente + ($densite_bois * 9.8 * (($colombages->largeur/1000) * ($colombages->hauteur/1000) * $post->hauteur)/ ($post->espacement/1000));
		
		//------------------------------
		
		//on effectue des modifications sur l'ax_excentricite ecrite a la main
		$post->ax_excentricite = strtolower($post->ax_excentricite);
		$post->ax_excentricite = str_replace(',','.',$post->ax_excentricite);
		$post->ax_excentricite = str_replace('mm','',$post->ax_excentricite);
		
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
		$post->lat_vent = strtolower($post->lat_vent);
		$post->lat_vent = str_replace(',','.',$post->lat_vent);
		$post->lat_vent = str_replace('kpa','',$post->lat_vent);
		
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
		
		
		
//**********************************************************************

//**********************************************************************

	// VARIABLES A CALCULER
	//---------------------
	
	//si les donnes rentres sont bonnes
	//et QU'IL N'Y A PAS D'ERREUR 
	//on peut continuer le traitement.
	if(!isset($error)){
	
		// RESISTANCE DES MONTANTS
		
		//on dfini les variables de resistance_montant
		$resistance_montant_valeurs=array(
			'aire',
			'module_section',
			'moment_inertie',
			'charge_euler',
			'Mr',
			'Vr',
			'Pr',
			'EI'
		);
		
		//on associe les variables dans l'objet resistance_montant
		for($a=0; $a<count($resistance_montant_valeurs); $a++){
			$resistance_montant->$resistance_montant_valeurs[$a]='';
		}
		
		//on associe les valeurs a ces variables
		$resistance_montant->aire 			= $colombages->largeur*$colombages->hauteur;
		
		$resistance_montant->module_section	= $colombages->largeur*pow($colombages->hauteur,2)/6;
		
		$resistance_montant->moment_inertie	= $colombages->largeur*pow($colombages->hauteur,3)/12;
		
		$resistance_montant->charge_euler	= pow(M_PI,2)*$classe->e*$resistance_montant->moment_inertie/pow($post->hauteur,2)/1000000000;
		
		/***
			PR, MR sont calculées en fonctions des 19 cas
			VR et EI sont caclculés plus bas
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
		
		
		
		// 1ER TABLEAU	
			
		// DPS
		for($a=0;$a<19;$a++){
		
			if($a==0 || $a==3 || $a==12){
				$tab_DPs[$a]=0;
				
			}else if($a==1 || $a==5 || $a==8 || $a==10 || $a==14 || $a==17){
				if($post->ax_surcharge==0){
					$tab_DPs[$a]=0;
				}else{
					$tab_DPs[$a]=$colombages->poids/$post->ax_surcharge;
				}
				
			}else if($a==2 || $a==7 || $a==9 || $a==11 || $a==16 || $a==18 ){
				if($post->ax_neige==0){
					$tab_DPs[$a]=0;
				}else{
					$tab_DPs[$a]=$colombages->poids/$post->ax_neige;
				}
				
			}else if($a==4 || $a==13){
				if($post->ax_surcharge==0){
					$tab_DPs[$a]=0;
				}else{
					$tab_DPs[$a]=$colombages->poids/($post->ax_surcharge+(0.5*$post->ax_neige));
				}
			
			}else if($a==6 || $a==15){
				if($post->ax_neige+(0.5*$post->ax_surcharge) == 0){
					$tab_DPs[$a]=0;
				}else{
					$tab_DPs[$a]=$colombages->poids/($post->ax_neige+(0.5*$post->ax_surcharge));
				}
			}
		}
		
		
		// Wlateral
		for($a=0;$a<19;$a++){
			if($a==0 || $a==1 || $a==2 || $a==4 || $a==6 || $a==10 || $a==11 || $a==13|| $a==15){
				$tab_wlateral[$a]=0;
			}else{
				$tab_wlateral[$a]=$post->lat_vent*$post->espacement/1000;
			}
		}
		
		
		// Kd
		for($a=0;$a<19;$a++){
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
		for($a=0;$a<19;$a++){
			if($a==0){
				$tab_Daxial_pondere[$a]=1.4*$colombages->poids;
			}else if($a>=1 && $a<=9){
				$tab_Daxial_pondere[$a]=1.25*$colombages->poids;
			}else{
				$tab_Daxial_pondere[$a]=0.9*$colombages->poids;
			}
		}
		
			
		// Laxial pondere
		for($a=0;$a<19;$a++){
			if($a==0 || $a==2 || $a==3 || $a==7 || $a==9 || $a==11 || $a==12 || $a==16 || $a==18){
				$tab_Laxial_pondere[$a]=0;
			}else if($a==1 || $a==4 || $a==5 || $a==10 || $a==13 || $a==14){
				$tab_Laxial_pondere[$a]=1.5*$post->ax_surcharge;
			}else{
				$tab_Laxial_pondere[$a]=0.5*$post->ax_surcharge;
			}
		}
		
			
		// Saxial pondere
		for($a=0;$a<19;$a++){
			if($a==0 || $a==1 || $a==3 || $a==5 || $a==8 || $a==10 || $a==12 || $a==14 || $a==17){
				$tab_Saxial_pondere[$a]=0;
			}else if($a==2 || $a==6 || $a==7 || $a==11 || $a==15 || $a==16 ){
				$tab_Saxial_pondere[$a]=1.5*$cat_risque->is_elu*$post->ax_neige;
			}else{
				$tab_Saxial_pondere[$a]=0.5*$cat_risque->is_elu*$post->ax_neige;
			}
		}
			
		
		//Wlateral pondere
		for($a=0;$a<19;$a++){
			if($a==0 || $a==1 || $a==2 || $a==4 || $a==6 || $a==10 || $a==11 || $a==13 || $a==15){
				$tab_Wlateral_pondere[$a]=0;
			}else if($a==3 || $a==8 || $a==9 || $a==12 || $a==17 || $a==18){
				$tab_Wlateral_pondere[$a]=1.4*$cat_risque->iw_elu*$post->lat_vent*$post->espacement/1000;
			}else{
				$tab_Wlateral_pondere[$a]=0.4*$cat_risque->iw_elu*$post->lat_vent*$post->espacement/1000;
			}
		}
			
		// KC	
		$Kzc=6.3*pow($post->hauteur*1000*$colombages->hauteur,-0.13);
		if($Kzc>1.3){
			$Kzc = 1.3;
		}
		for($a=0;$a<19;$a++){
			$tab_kc[$a] = 1/(1+((($classe->fc * $tab_kd[$a] * $classe->khc)* $Kzc * (pow(($post->hauteur * 1000 / $colombages->hauteur),3))/(35*$classe->e05))));
		}
		
		
		// PR
		for($a=0;$a<19;$a++){
			$tab_pr[$a] = 0.8 * $classe->fc * $tab_kd[$a] * $classe->khc * $resistance_montant->aire * $Kzc * $tab_kc[$a]/1000;
		}
		
		
		//MR
		for($a=0;$a<19;$a++){
			$colombages_Kzb_eps_Kzv_TMP = $colombages->Kzb_eps_Kzv;
			if(substr($post->classe,0,3)=='msr'){
				$colombages_Kzb_eps_Kzv_TMP= 1;
			}
			
			$tab_mr[$a] = 0.9 * $classe->fb * $tab_kd[$a] * $classe->khb_khv * $resistance_montant->module_section * $colombages_Kzb_eps_Kzv_TMP /1000000;
		}
			
		
		
		
		// 2EME TABLEAU	
			
		//Pf de la somme des axial
		for($a=0;$a<19;$a++){	
			$tab_pf[$a]= ($tab_Daxial_pondere[$a] + $tab_Laxial_pondere[$a] + $tab_Saxial_pondere[$a]) *$post->espacement/1000;
			
			if($tab_pf[$a]>$max_pf){
				//ON SORT LE MAXIMUM
				$max_pf=$tab_pf[$a];
				$output->compression_app=$max_pf;
				$kd_pf=$tab_kd[$a];
				$key_kd_pf=$a;
				//on sort la compression(pr) associée au max de pf
				$output->compression_res = $tab_pr[$a];
			}
		}
		
		
		//1 / (1 - Pf / PE)
		for($a=0;$a<19;$a++){
			if($resistance_montant->charge_euler==0){
				$un_sur_un_moins_pf_sur_pe[$a] = 0;
			}else{
				$un_sur_un_moins_pf_sur_pe[$a] = (1/(1-($tab_pf[$a]/$resistance_montant->charge_euler)));
			}
		}
		
		//Mw
		for($a=0;$a<19;$a++){
			$tab_Mw[$a] = $tab_Wlateral_pondere[$a]*pow($post->hauteur,2)/8;
		}
			
		//Somme des Moment
		for($a=0;$a<19;$a++){
			
			if($tab_Mw[$a]==0){
				$tab_somme_moment[$a] = ($tab_pf[$a]*$post->ax_excentricite/1000);
			}else{
				$tab_somme_moment[$a] = ($tab_pf[$a]*$post->ax_excentricite/1000/2)+$tab_Mw[$a];
			}
			if($tab_somme_moment[$a]>$max_somme_moment){
				//ON SORT LE MAXIMUM
				$max_somme_moment=$tab_somme_moment[$a];
				//on sort le Mf max
				$output->flexion_app=$max_somme_moment;
				//on sort le Mr associé au mf max
				$output->flexion_res = $tab_mr[$a];
				
				//$kd_somme_moment=$tab_kd[$a];
			}
		}
		
			
			
		//Somme des Moment'
		for($a=0;$a<19;$a++){
			$tab_somme_moment_prime[$a]= $tab_somme_moment[$a] * $un_sur_un_moins_pf_sur_pe[$a];
		}
			
			
		//Vf
		for($a=0;$a<19;$a++){
			if($post->hauteur==0){
				$tab_vf[$a]=0;
			}else{
				$tab_vf[$a]=($tab_Wlateral_pondere[$a]*$post->hauteur/2) + ($tab_pf[$a] * ($post->ax_excentricite/1000)/$post->hauteur);
			}
			
			if($tab_vf[$a]>$max_vf){
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

		for($a=0;$a<19;$a++){
			
		//	$tab_Pf_Pr_Mf_Mr_prime[$a]=($tab_pf[$a]/$resistance_montant->Pr_flexion)+($tab_somme_moment_prime[$a]/$resistance_montant->Mr_flexion);
			
			$tab_Pf_Pr_Mf_Mr_prime[$a]=($tab_pf[$a]/$tab_pr[$a])+($tab_somme_moment_prime[$a]/$tab_mr[$a]);
				
			if($tab_Pf_Pr_Mf_Mr_prime[$a]>$max_Pf_Pr_Mf_Mr_prime){

				$max_Pf_Pr_Mf_Mr_prime=$tab_Pf_Pr_Mf_Mr_prime[$a];
				//$kd_Pf_Pr_Mf_Mr_prime=$tab_kd[$a];
				//$key_kd_Pf_Pr_Mf_Mr_prime=$a;
				
				//ON SORT l'effort combins appliqus pour Pf/Pr
				$output->efforts_p_app =  $tab_pf[$a];
				//ON SORT l'effort combins appliqus pour Mf/Mr			
				$output->efforts_m_app =  $tab_somme_moment_prime[$a];
				//ON SORT l'amplification pour les notes concernant le moment
				$output_note->moment = round($un_sur_un_moins_pf_sur_pe[$a],2);
				
				//ON SORT MR asscoié au max 
				$output->efforts_m_res = $tab_mr[$a];
				//ON SORT PR associé au max
				$output->efforts_p_res = $tab_pr[$a];
			}		
			
		}
		
		//ON SORT la flche sous la surcharge rsistants
		$output->fleche_surcharge_res = $post->hauteur*1000/$post->fleche_surcharge;
		
		//ON SORT la flche sous la surcharge rsistants
		$output->fleche_charge_tot_res = $post->hauteur*1000/$post->fleche_charge_totale;


		//-----------------------



			
			
		// RESISTANCE DES MONTANTS SUITE
		//------------------------------
	
			
			// VR (  partir de Fv)
			
			$resistance_montant->Vr = ($classe->fv*$kd_vf*$classe->khb_khv*$colombages->Kzb_eps_Kzv)*0.9*$resistance_montant->aire*2/3/1000;
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
				$tab_fleche_Daxial_pondere[$a]=$colombages->poids;
				
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
					$tab_fleche_Wlateral_pondere[$a]=$cat_risque->iw_els*$post->lat_vent*$post->espacement/1000;

				}else{
					$tab_fleche_Wlateral_pondere[$a]=0.4*$cat_risque->iw_els*$post->lat_vent*$post->espacement/1000;
				}
				
				
				//Pf de la somme des axial de la flche sous charge vive
				$tab_fleche_pf[$a]= ($tab_fleche_Laxial_pondere[$a] + $tab_fleche_Saxial_pondere[$a]) *$post->espacement/1000 ;
				
			
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
				$tab_fleche_tot_pf[$a]= ($tab_fleche_Daxial_pondere[$a] + $tab_fleche_Laxial_pondere[$a] + $tab_fleche_Saxial_pondere[$a]) *$post->espacement/1000 ;
				
				
				
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
		
		
		$vol_bois_colombage = ($colombages->largeur * $colombages->hauteur * (($post->hauteur*1000) - (3*$colombages->largeur))/1000000000) / ($post->espacement/1000);
		//echo $vol_bois_colombage;
		$vol_bois_lisse_sabliere = 3*$colombages->largeur * $colombages->hauteur/1000000;
		$output->volume_bois = $vol_bois_colombage + $vol_bois_lisse_sabliere;

		
		//$output->pmp = $output->volume_bois/0.00525;		
		
		//Volume en pmp/pi de mur = [largeur_nominale x hauteur_nominale x hauteur du mur (en pieds) / 12] / 
		
		$output->pmp = (3 * $colombages->largeur_nominale * $colombages->hauteur_nominale /12) + (($colombages->largeur_nominale * $colombages->hauteur_nominale * ((($post->hauteur*1000) - (3*$colombages->largeur))/1000) * 3.28 /12) /($post->espacement/1000 * 3.28)); 
		

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
		$output_ratio->efforts 				= ($output->efforts_p_app/$output->efforts_p_res*100)+($output->efforts_m_app/$output->efforts_m_res*100);
		
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
			if($html_champs_sortie[$a] == 'volume_bois'){
				$nbr_decimal = 3;
			}
			$output->$html_champs_sortie[$a]=round($output->$html_champs_sortie[$a],$nbr_decimal);
		}
			
	}
		
?>
