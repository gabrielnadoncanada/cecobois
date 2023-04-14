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
	'fleche_charge_tot_res',
	'volume_bois',
	'poids',
	'poids_metre_lineaire',
	'pmp',
	'pf',
	'qr',
	'lisse'
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
		
function verifCarac($champ){

	$tab_check_carac	= array(',','millimetre','millimètre','milimetre','milimètre','metre','mètre','pieds','pied','pouces','pouce','kpa','kn/m','p','m','"','\'','%','\\');
	$tab_replace_carac	= array('.','','','','','','','','','','','','','','','','','','');
	
	$champ = str_replace($tab_check_carac,$tab_replace_carac,strtolower($champ));
	
	return $champ;
}
		
	
//VARIABLES FIXES
//---------------
	
//on dfini les variables de la class classe
$classe_valeurs=array(
	'fb',
	'fv',
	'fc',
	'fcp',
	'e',
	'e05',
	'kzb',
	'kzv',
	'kzc',
	'khb',
	'khv',
	'khc',
	'densite_bois'
);

//on associe les variables dans l'objet classe
for($a=0; $a<count($classe_valeurs); $a++){
	$classe->$classe_valeurs[$a] = '';
}

/* – Bois de sciage - */
if($post->type == 'sciage'):
	switch ($post->classe):
		case 'eps_select':
			$classe->fb = 16.5;
			$classe->fc = 14.5;
			$classe->fcp = 5.3;
			$classe->e = 10500;
			$classe->e05 = 7500;
			if($post->partage_charge == 1):
				$classe->khb = 1.1;
				$classe->khv = 1.1;
			else:
				$classe->khb = 1.4;
				$classe->khv = 1.4;
			endif;
			$classe->densite_bois = 0.42;
			break;
		case 'eps_no1_2':
			$classe->fb = 11.8;
			$classe->fc = 11.5;
			$classe->fcp = 5.3;
			$classe->e = 9500;
			$classe->e05 = 6500;
			if($post->partage_charge == 1):
				$classe->khb = 1.1;
				$classe->khv = 1.1;
			else:
				$classe->khb = 1.4;
				$classe->khv = 1.4;
			endif;
			$classe->densite_bois = 0.42;
			break;
		case 'eps_no3':
			$classe->fb = 7;
			$classe->fc = 9;
			$classe->fcp = 5.3;
			$classe->e = 9000;
			$classe->e05 = 5500;
			if($post->partage_charge == 1):
				$classe->khb = 1.1;
				$classe->khv = 1.1;
			else:
				$classe->khb = 1.4;
				$classe->khv = 1.4;
			endif;
			$classe->densite_bois = 0.42;
			break;
		case 'msr1650':
			$classe->fb = 23.9;
			$classe->fc = 18.1;
			$classe->fcp = 5.3;
			$classe->e = 10300;
			$classe->e05 = 8446;
			if($post->partage_charge == 1):
				$classe->khb = 1.1;
				$classe->khv = 1.1;
			else:
				$classe->khb = 1.2;
				$classe->khv = 1.2;
			endif;
			$classe->densite_bois = 0.42;
			break;
		case 'msr1950':
			$classe->fb = 28.2;
			$classe->fc = 19.3;
			$classe->fcp = 5.3;
			$classe->e = 11700;
			$classe->e05 = 9594;
			if($post->partage_charge == 1):
				$classe->khb = 1.1;
				$classe->khv = 1.1;
			else:
				$classe->khb = 1.2;
				$classe->khv = 1.2;
			endif;
			$classe->densite_bois = 0.42;
			break;
		case 'msr2100':
			$classe->fb = 30.4;
			$classe->fc = 19.9;
			$classe->fcp = 6.5;
			$classe->e = 12400;
			$classe->e05 = 10168;
			if($post->partage_charge == 1):
				$classe->khb = 1.1;
				$classe->khv = 1.1;
			else:
				$classe->khb = 1.2;
				$classe->khv = 1.2;
			endif;
			$classe->densite_bois = 0.47;
			break;
		case 'msr2250':
			$classe->fb = 32.6;
			$classe->fc = 20.5;
			$classe->fcp = 6.5;
			$classe->e = 13100;
			$classe->e05 = 10742;
			if($post->partage_charge == 1):
				$classe->khb = 1.1;
				$classe->khv = 1.1;
			else:
				$classe->khb = 1.2;
				$classe->khv = 1.2;
			endif;
			$classe->densite_bois = 0.47;
			break;
		case 'msr2400':
			$classe->fb = 34.7;
			$classe->fc = 21.1;
			$classe->fcp = 6.5;
			$classe->e = 13800;
			$classe->e05 = 11316;
			if($post->partage_charge == 1):
				$classe->khb = 1.1;
				$classe->khv = 1.1;
			else:
				$classe->khb = 1.2;
				$classe->khv = 1.2;
			endif;
			$classe->densite_bois = 0.5;
			break;
	endswitch;

	switch ($post->profondeur):
		case 64:
			$classe->kzv = 1.7;
			$classe->kzb = 1.7;
			break;
		case 89:
			$classe->kzv = 1.7;
			$classe->kzb = 1.7;
			break;
		case 140:
			$classe->kzv = 1.4;
			$classe->kzb = 1.4;
			break;
		case 184:
			$classe->kzv = 1.2;
			$classe->kzb = 1.2;
			break;
		case 235:
			$classe->kzv = 1.1;
			$classe->kzb = 1.1;
			break;
		case 286:
			$classe->kzv = 1;
			$classe->kzb = 1;
			break;
	endswitch;

	$classe->fv = 1.5;
	$classe->khc = 1.1;

	if($post->systeme == "imp"):
		$kzcProfondeur = Conversion::ConvertPiedsToMetre($post->profondeur);
	else:
		$kzcProfondeur = $post->profondeur;
	endif;

	$classe->kzc = 6.3 * pow(($kzcProfondeur * ($post->hauteur*1000)), -0.13);
	if($classe->kzc >= 1.3){ $classe->kzc = 1.3; }	

	//on corrige le khb et khv si c'est le cas 1
	if($post->partage_charge == '1'):
		$classe->khb	= 1.1;
		$classe->khv	= 1.1;
	endif;
endif;

/* – Lamco - */
if($post->type == 'lamco-lfl'):
	switch ($post->classe):
		case '16e':
			$classe->fb = 14.25;
			$classe->fv = 1.72;
			$classe->fc = 17.61;
			$classe->fcp = 5.33;
			$classe->e = 10343;
			$classe->e05 = 8998;
			$classe->kzb = pow((305/$post->profondeur), 0.34);
			break;
		case '17e':
			$classe->fb = 22.71;
			$classe->fv = 2.29;
			$classe->fc = 21.21;
			$classe->fcp = 7.46;
			$classe->e = 11239;
			$classe->e05 = 9778;
			if($post->profondeur <= 184): $classe->kzb = 1.0687; else: $classe->kzb = pow((305/$post->profondeur), 0.25); endif;
			break;
		case '19e':
			$classe->fb = 29.27;
			$classe->fv = 2.6;
			$classe->fc = 24.10;
			$classe->fcp = 8.47;
			$classe->e = 12625;
			$classe->e05 = 10984;
			$classe->kzb = pow((305/$post->profondeur), 0.25);
			break;
		case '21e':
			$classe->fb = 29.27;
			$classe->fv = 3.2;
			$classe->fc = 29.31;
			$classe->fcp = 8.47;
			$classe->e = 13549;
			$classe->e05 = 11788;
			$classe->kzb = pow((305/$post->profondeur), 0.25);					
			break;
	endswitch;

	$classe->kzv = 1;
	$classe->kzc = 1;
	$classe->khb = 1.04;
	$classe->khv = 1;
	$classe->khc = 1;
	$classe->densite_bois = 0.44;
endif;


/* – Nordic Lam - */
if($post->type == 'nordic-lam'):
	$classe->fb = 17.20;
	$classe->fv = 2.20;
	$classe->fc = 22.30;
	$classe->fcp = 5.80;
	$classe->e = 10300;
	$classe->e05 = 8961;
	$classe->kzb = pow((130/$post->largeur),0.1) * pow((610/$post->profondeur),0.1) * pow((9100/$post->hauteur),0.1);
	if($classe->kzb >= 1.3){ $classe->kzb = 1.3; }
	$classe->kzv = 1;

	if($post->systeme == "imp"):
		$kzcProfondeur = Conversion::ConvertPiedsToMetre($post->profondeur);
	else:
		$kzcProfondeur = $post->profondeur;
	endif;

	$classe->kzc = 0.68 * (pow(($post->largeur / 1000 * $kzcProfondeur / 1000 * $post->hauteur),-0.13));
	if($classe->kzc >= 1){ $classe->kzc = 1; }
	$classe->khb = 1.10;
	$classe->khv = 1.1;
	$classe->khc = 1.1;
	$classe->densite_bois = 0.42;
endif;

/* – TimberStrand LSL - */
if($post->type == 'timberstrand-lsl'):
	switch ($post->classe):
		case '13e':
			$classe->fb = 21.60;
			$classe->fv = 5.39;
			$classe->fc = 20.21;
			$classe->fcp = 8.38;
			$classe->e = 8517;
			$classe->e05 = 7410;
			break;
		case '15e':
			$classe->fb = 28.70;
			$classe->fv = 6.46;
			$classe->fc = 23.14;
			$classe->fcp = 9.38;
			$classe->e = 9828;
			$classe->e05 = 8550;
			break;
	endswitch;

	$classe->kzb = pow((305 / $post->profondeur ), 0.092);
	$classe->kzv = 1;
	$classe->kzc = 1;
	$classe->khb = 1.04;
	$classe->khv = 1;
	$classe->khc = 1;
	$classe->densite_bois = 0.5;
endif;

/* – Versa-Stud LVL - */
if($post->type == 'versastud-lvl'):
	switch ($post->classe):
		case '18e_2400':
			$classe->fb = 30.60;
			break;
		case '18e_2650':
			$classe->fb = 33.80;
			break;
	endswitch;

	$classe->fv = 3.65;
	$classe->fc = 33;
	$classe->fcp = 5.65;
	$classe->e = 11721;
	$classe->e05 = 10197;
	$classe->kzb = pow((305 / $post->profondeur ), (1/9));
	$classe->kzv = 1;
	$classe->kzc = 1;
	$classe->khb = 1.04;
	$classe->khv = 1;
	$classe->khc = 1;
	$classe->densite_bois = 0.5;
endif;

/* – SolidStart LSL - */
if($post->type == 'solidstart-lsl'):
	switch ($post->classe):
		case '1730fb':
			$classe->fb = 22.05;
			$classe->fc = 18.15;
			$classe->fcp = 8.55;
			$classe->e = 8845;
			$classe->e05 = 7695;
			break;
		case '2360fb':
			$classe->fb = 30.05;
			$classe->fc = 23.90;
			$classe->fcp = 9.69;
			$classe->e = 10156;
			$classe->e05 = 8835;
			break;
		case '2500fb':
			$classe->fb = 31.85;
			$classe->fc = 26.95;
			$classe->fcp = 11.10;
			$classe->e = 11467;
			$classe->e05 = 9976;
			break;
	endswitch;

	$classe->fv = 5.25;
	$classe->kzb = pow((305 / $post->profondeur ), 0.143);
	$classe->kzv = 1;
	$classe->kzc = 1;
	$classe->khb = 1.04;
	$classe->khv = 1;
	$classe->khc = 1;
	$classe->densite_bois = 0.5;
endif;

/* – SolidStart LVL - */
if($post->type == 'solidstart-lvl'):
	switch ($post->classe):
		case '2250fb':
			$classe->fb = 28.67;
			$classe->fc = 25.86;
			$classe->fcp = 5.65;
			$classe->e = 9823;
			$classe->e05 = 8546;
			break;
		case '2900fb':
			$classe->fb = 36.95;
			$classe->fc = 35.21;
			$classe->fcp = 6.90;
			$classe->e = 13101;
			$classe->e05 = 11397;
			break;
	endswitch;

	$classe->fv = 3.65;
	$classe->kzb = pow((305 / $post->profondeur ), 0.111);
	$classe->kzv = 1;
	$classe->kzc = 1;
	$classe->khb = 1.04;
	$classe->khv = 1;
	$classe->khc = 1;
	$classe->densite_bois = 0.5;
endif;

//------------------------------
		
		
//on defini les variables de l'objet colombages
$colombages_valeurs=array(
	'largeur',
	'hauteur',
	'poids',
	'poids_metre_lineaire',
	'volume',
	//'largeur_nominale',
	//'hauteur_nominale'
);
		
		
//on associe les variables dans l'objet colombages
for($a=0; $a<count($colombages_valeurs); $a++){
	$colombages->$colombages_valeurs[$a]='';
}

//on defini les valeurs à ces variables
$colombages->largeur= $post->largeur;
$colombages->hauteur= $post->profondeur;

//------------------------------

//on effectue des modifications sur la hauteur ecrite a la main
$post->hauteur = verifCarac($post->hauteur);

//Si il y a un probleme avec cette variable, on stock un msg d'erreur
if(!is_numeric($post->hauteur)){
	if(!isset($error)){
		$error = ERROR_HAUTEUR_NOMBRE;
	}
}else{
    //https://nebbio.teamwork.com/tasks/6995867
	/*if(($post->hauteur > 4.88 && $post->systeme=="met") || (Conversion::ConvertPiedsToMetre($post->hauteur) > 4.88 && $post->systeme=="imp")){
		
		$error = ERROR_HAUTEUR_BIGGER;
		
	}else*/ if($post->hauteur<1){
		//$post->hauteur = 0;
		$error = ERROR_HAUTEUR_SMALLER;
	}
}

$hauteur_tmp = $post->hauteur;

if($post->systeme == "imp") {
	$hauteur_tmp			= Conversion::ConvertPiedsToMetre($post->hauteur);
}		

$coeficient_elancement = $hauteur_tmp * 1000 / $colombages->hauteur;
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

//On effectue un calcul pour connaitre le poids du colombage
$colombages->poids = $post->ax_permanente + ($classe->densite_bois * 9.81 * (($colombages->largeur/1000) * ($colombages->hauteur/1000) * $post->hauteur)) / ($post->espacement/1000);

//------------------------------

//on effectue des modifications sur l'ax_excentricite ecrite a la main
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
		

// VARIABLES A CALCULER
//---------------------

//si les donnes rentres sont bonnes
//et QU'IL N'Y A PAS D'ERREUR 
//on peut continuer le traitement.
if(!isset($error)){

	$post->edition_norme = '2015';

	//on modifie les données si l'utilisateur a choisit d'entrer les données en IMPÉRIAL
	if($post->systeme == "imp"){
		$hauteur_tmp			= $post->hauteur;
		$ax_neige_tmp			= $post->ax_neige;
		$ax_surcharge_tmp		= $post->ax_surcharge;
		$ax_permanente_tmp		= $post->ax_permanente;
		$ax_excentricite_tmp	= $post->ax_excentricite;
		$lat_vent_tmp			= $post->lat_vent;
		
		$post->hauteur			= Conversion::ConvertPiedsToMetre($post->hauteur);
		$post->ax_neige			= Conversion::ConvertLbsurPiToKnsurM($post->ax_neige);
		$post->ax_surcharge		= Conversion::ConvertLbsurPiToKnsurM($post->ax_surcharge);
		$post->ax_permanente	= Conversion::ConvertLbsurPiToKnsurM($post->ax_permanente);
		$post->ax_excentricite	= Conversion::ConvertPoucesToMillimetre($post->ax_excentricite);
		$post->lat_vent			= Conversion::ConvertLbsurPiCarreToKPa($post->lat_vent);
		
		if($show_debug){
			echo 'hauteur = '.$post->hauteur.'<br />';
			echo 'neige = '.$post->ax_neige.'<br />';
			echo 'surcharge = '.$post->ax_surcharge.'<br />';
			echo 'permanente = '.$post->ax_permanente.'<br />';
			echo 'excentricite = '.$post->ax_excentricite.'<br />';
			echo 'vent = '.$post->lat_vent.'<br />';
		}
		
	}
	
	
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
	
	$resistance_montant->charge_euler	= pow(M_PI,2)*$classe->e05*$resistance_montant->moment_inertie/pow($post->hauteur,2)/1000000000;
	
	/***
		PR, MR sont calculées en fonctions des 19 cas
		VR et EI sont caclculés plus bas
	***/
	
	$colombages->volume_bois = $resistance_montant->aire * $post->hauteur / 1000000;
	$colombages->poids = 9.81 * $colombages->volume_bois * $classe->densite_bois;
	$colombages->poids_metre_lineaire = $colombages->poids / ($post->espacement / 1000);
	
	
	
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
	$tab_m_top					= array();
	$tab_m_milieu				= array();
	$tab_mf_flexion				= array();
	$tab_mf_comb				= array();
	$tab_mf_sur_mr				= array();
	$tab_Pf_Pr_Mf_Mr_prime		= array();
	
	$un_sur_un_moins_pf_sur_pe	= array();
	$tab_Mw						= array();
	$tab_m_milieu			= array();
	$tab_somme_moment_prime		= array();
	$max_pf						= -1;
	$key_kd_pf					= '';
	$max_somme_moment			= -1;
	$max_somme_moment_prime		= -1;
	$tab_vf						= array();
	$max_vf						= -1;
	$tab_vr						= array();
	$tab_vf_sur_vr				= array();
	
	
	
	// 1ER TABLEAU	

	// L = Surcharge rentrée par l'utilisateur (2 dans cet exemple) = $post->ax_surcharge

	// D = Charge permanente rentrée par l'utilisateur + Poids par mètre linéaire (10 + 0.18095 dans cet exemple, soit 10.18095) = $post->ax_permanente + $colombages->poids_metre_lineaire

	// S = Charge de neige rentrée par l'utilisateur (5 dans cet exemple) = $post->ax_neige

		
	// DPS
	for($a=0;$a<10;$a++){
	
		if($a == 0 || $a==3){
			$tab_DPs[$a] = 0;
			
		} else if($a==1 || $a==5 || $a==8){
			if($post->ax_surcharge==0){
				$tab_DPs[$a]=0;
			}else{
				$tab_DPs[$a] = ($post->ax_permanente + $colombages->poids_metre_lineaire) / $post->ax_surcharge;
			}

		}else if($a==2 || $a==7 || $a==9){
			if($post->ax_neige==0){
				$tab_DPs[$a]=0;
			}else{
				$tab_DPs[$a]= ($post->ax_permanente + $colombages->poids_metre_lineaire)/$post->ax_neige;
			}
			
		}else if($a==4){
			if($post->ax_surcharge==0 && $post->ax_neige==0){
				$tab_DPs[$a]=0;
			}else{
				$tab_DPs[$a]= ($post->ax_permanente + $colombages->poids_metre_lineaire) / ($post->ax_surcharge+(0.5*$post->ax_neige));
			}
		
		}else if($a==6){
			if($post->ax_neige+(0.5*$post->ax_surcharge) == 0){
				$tab_DPs[$a]=0;
			}else{
				$tab_DPs[$a]= ($post->ax_permanente + $colombages->poids_metre_lineaire) / ((0.5*$post->ax_surcharge)+$post->ax_neige);
			}
		}
	}
	
	
	// Wlateral
	for($a=0;$a<10;$a++){
		if($a==0 || $a==1 || $a==2 || $a==4 || $a==6 || $a==10 || $a==11 || $a==13|| $a==15){
			$tab_wlateral[$a]=0;
		}else{
			$tab_wlateral[$a]=$post->lat_vent*$post->espacement/1000;
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
		if($a==0){
			$tab_Daxial_pondere[$a]=1.4 * ($colombages->poids_metre_lineaire + $post->ax_permanente);
		}else if($a>=1 && $a<=9){
			$tab_Daxial_pondere[$a]=1.25 * ($colombages->poids_metre_lineaire+$post->ax_permanente);
		}else{
			$tab_Daxial_pondere[$a]=0.9 * ($colombages->poids_metre_lineaire+$post->ax_permanente);
		}
	}
	
		
	// Laxial pondere
	for($a=0;$a<10;$a++){
		if($a==0 || $a==2 || $a==3 || $a==7 || $a==9 || $a==11 || $a==12 || $a==16 || $a==18){
			$tab_Laxial_pondere[$a]=0;
		}else if($a==1 || $a==4 || $a==5 || $a==10 || $a==13 || $a==14){
			$tab_Laxial_pondere[$a]=1.5 * $post->ax_surcharge;
		}else{
			if($post->edition_norme == '2015' && $a == 6){
				$tab_Laxial_pondere[$a]= $post->ax_surcharge;
			}
			else{
				$tab_Laxial_pondere[$a]= 0.5 * $post->ax_surcharge;
			}
		}

		if($post->cat_risque=='faible'){
			$tab_Laxial_pondere[$a] = $tab_Laxial_pondere[$a] * $cat_risque->is_elu;
		}
	}

	
		
	// Saxial pondere
	for($a=0;$a<10;$a++){
		if($a==0 || $a==1 || $a==3 || $a==5 || $a==8 || $a==10 || $a==12 || $a==14 || $a==17){
			$tab_Saxial_pondere[$a]=0;
		}else if($a==2 || $a==6 || $a==7 || $a==11 || $a==15 || $a==16 ){
			$tab_Saxial_pondere[$a]=1.5*$cat_risque->is_elu*$post->ax_neige;
		}else{
			if($post->edition_norme == '2015' && $a == 4){
				$tab_Saxial_pondere[$a]=$cat_risque->is_elu*$post->ax_neige;
			}
			else{
				$tab_Saxial_pondere[$a]=0.5*$cat_risque->is_elu*$post->ax_neige;
			}
		}
	}
		
	
	//Wlateral pondere
	for($a=0;$a<10;$a++){
		if($a==0 || $a==1 || $a==2 || $a==4 || $a==6 || $a==10 || $a==11 || $a==13 || $a==15){
			$tab_Wlateral_pondere[$a]=0;
		}else if($a==3 || $a==8 || $a==9 || $a==12 || $a==17 || $a==18){
			$tab_Wlateral_pondere[$a]=1.4*$cat_risque->iw_elu*$post->lat_vent*$post->espacement/1000;
		}else{
			$tab_Wlateral_pondere[$a]=0.4*$cat_risque->iw_elu*$post->lat_vent*$post->espacement/1000;
		}
	}
		
	// KC	
	/*$Kzc = 6.3*pow($post->hauteur*1000*$colombages->hauteur,-0.13);
	if($Kzc > 1.3){
		$Kzc = 1.3;
	}*/
	for($a=0;$a<10;$a++){
		$tab_kc[$a] = 1/(1+((($classe->fc * $tab_kd[$a] * $classe->khc)* $classe->kzc * (pow(($post->hauteur * 1000 / $colombages->hauteur),3))/(35*$classe->e05))));
	}
	
	//Pr= 0.8 x fc x Kd x Khc x Ksc x Kt x Aire x Kc x Kzc
	
	// PR
	for($a=0;$a<10;$a++){
		$tab_pr[$a] = 0.8 * $classe->fc * $tab_kd[$a] * $classe->khc * $resistance_montant->aire * $classe->kzc * $tab_kc[$a]/1000;
	}
	
	
	//MR
	for($a=0;$a<10;$a++){
		$classe_kzb_TMP = $classe->kzb;
		if(substr($post->classe,0,3) == 'msr' || $post->type == 'nordic-lam'){
			$classe_kzb_TMP= 1;
		}
		
		$tab_mr[$a] = 0.9 * $classe->fb * $tab_kd[$a] * $classe->khb * $resistance_montant->module_section * $classe_kzb_TMP /1000000;
	}
		
	
	
	
	// 2EME TABLEAU	
		
	//Pf de la somme des axial
	for($a=0;$a<10;$a++){	
		$tab_pf[$a]= ($tab_Daxial_pondere[$a] + $tab_Laxial_pondere[$a] + $tab_Saxial_pondere[$a]) *$post->espacement/1000;
		
		if($tab_pf[$a]>$max_pf){
			//ON SORT LE MAXIMUM
			$max_pf = $tab_pf[$a];
			$kd_pf=$tab_kd[$a];
			$key_kd_pf=$a;
		}
	}

	$maxRatioPFsurPR = 0;
	for($a=0;$a<10;$a++){
		if(($tab_pf[$a]/$tab_pr[$a]) > $maxRatioPFsurPR){
			//ON SORT LE RATIO MAXIMUM
			$maxRatioPFsurPR = $tab_pf[$a]/$tab_pr[$a];
			$output->compression_app=$tab_pf[$a];
			$output->compression_res=$tab_pr[$a];
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
		$tab_Mw[$a] = $tab_Wlateral_pondere[$a]*pow($post->hauteur,2)/8;
	}
		
	//Somme des Moment
	for($a=0;$a<10;$a++){

		$tab_m_top[$a] = $tab_pf[$a]*($post->ax_excentricite/1000);
		$tab_m_milieu[$a] = $tab_Mw[$a] + $tab_m_top[$a]/2;

		$tab_mf_flexion[$a] = max($tab_m_top[$a], $tab_m_milieu[$a]);
		$tab_mf_comb[$a] = max($tab_m_top[$a], ($tab_m_milieu[$a]*$un_sur_un_moins_pf_sur_pe[$a]));

		$tab_mf_sur_mr[$a] = $tab_mf_flexion[$a] / $tab_mr[$a];
		
		/*if($tab_Mw[$a]==0){
			$tab_m_milieu[$a] = ($tab_pf[$a]*$post->ax_excentricite/1000);
		}else{
			$tab_m_milieu[$a] = ($tab_pf[$a]*$post->ax_excentricite/1000/2)+$tab_Mw[$a];
		}*/

		if($tab_mf_flexion[$a]>$max_somme_moment){
			//ON SORT LE MAXIMUM
			$max_somme_moment=$tab_mf_flexion[$a];
			//on sort le Mf max
			$output->flexion_app=$max_somme_moment;
			//on sort le Mr associé au mf max
			$output->flexion_res = $tab_mr[$a];
			
			//$kd_somme_moment=$tab_kd[$a];
		}
	}

	//$output->flexion_app = $tab_mf_flexion[array_search(max($tab_mf_sur_mr), $tab_mf_sur_mr)];
	//$output->flexion_res = $tab_mr[array_search(max($tab_mf_sur_mr), $tab_mf_sur_mr)];
		
		
	//Somme des Moment'
	for($a=0;$a<10;$a++){
		$tab_somme_moment_prime[$a]= $tab_m_milieu[$a] * $un_sur_un_moins_pf_sur_pe[$a];
	}
		
		
	//Vf
	for($a=0;$a<10;$a++){
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

	//Vr
	for($a=0;$a<10;$a++){
		$tab_vr[$a]= 0.9 * $classe->fv * $tab_kd[$a] * $classe->khv * (2/3/1000) * $resistance_montant->aire * $classe->kzv;

		$tab_vf_sur_vr[$a] = $tab_vf[$a] / $tab_vr[$a];
	}	

	$maxRatioVFsurVR = 0;
	for($a=0;$a<10;$a++){
		if(($tab_vf[$a]/$tab_vr[$a]) > $maxRatioVFsurVR){
			//ON SORT LE RATIO MAXIMUM
			$maxRatioVFsurVR = $tab_vf[$a]/$tab_vr[$a];
			$output->cisaillement_app=$tab_vf[$a];
			$output->cisaillement_res=$tab_vr[$a];
		}
	}

		
	//Pf/Pr + Mf + Mr '
	
	$tab_Pf_Pr_Mf_Mr_prime		= array();
	$key_kd_Pf_Pr_Mf_Mr_prime	= 0;
	$max_Pf_Pr_Mf_Mr_prime		= -1;
	$maxRatioEfforts = -1;

	for($a=0;$a<10;$a++){
		
		$tab_Pf_Pr_Mf_Mr_prime[$a]= pow(($tab_pf[$a]/$tab_pr[$a]),2) + ($tab_mf_comb[$a]/$tab_mr[$a]);

		if($tab_Pf_Pr_Mf_Mr_prime[$a]>$max_Pf_Pr_Mf_Mr_prime){

			$max_Pf_Pr_Mf_Mr_prime=$tab_Pf_Pr_Mf_Mr_prime[$a];
			//$kd_Pf_Pr_Mf_Mr_prime=$tab_kd[$a];
			//$key_kd_Pf_Pr_Mf_Mr_prime=$a;
			
			//ON SORT l'effort combins appliqus pour Pf/Pr
			//$output->efforts_p_app =  $tab_pf[$a];
			//ON SORT l'effort combins appliqus pour Mf/Mr			
			//$output->efforts_m_app =  $tab_somme_moment_prime[$a];
			//ON SORT l'amplification pour les notes concernant le moment
			$output_note->moment = round($un_sur_un_moins_pf_sur_pe[$a],2);
			
			//ON SORT MR asscoié au max 
			//$output->efforts_m_res = $tab_mr[$a];
			//ON SORT PR associé au max
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
		
		//$resistance_montant->Vr = ($classe->fv*$kd_vf*$classe->khv*$classe->kzv)*0.9*$resistance_montant->aire*2/3/1000;

		//ON SORT LA DONNEE
		//$output->cisaillement_res = $resistance_montant->Vr;
		//$output->cisaillement_res = 0;
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
		$tab_ecrasement_qr	 			= array();
		$max_ecrasement_pf				= -1;
		$min_ecrasement_qr	 			= -1;
		$tab_ecrasement_lisse 			= array();
		$max_ecrasement_lisse 			= -1;

		$Kd_tmp = array();

	
		for($a=0;$a<10;$a++){
		
			//Daxial
			$tab_fleche_Daxial_pondere[$a] = $post->ax_permanente + ($classe->densite_bois * 9.81 * (($colombages->largeur/1000) * ($colombages->hauteur/1000) * $post->hauteur)) / ($post->espacement/1000);
			
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

			$tab_fleche_tot_pf[$a] = ($tab_fleche_Daxial_pondere[$a] + $tab_fleche_Laxial_pondere[$a] + $tab_fleche_Saxial_pondere[$a]) * $post->espacement/1000;
				
		
			//Amplification
			if($resistance_montant->charge_euler==0){
				$tab_fleche_tot_amplification[$a]=0;
			}else{
				$tab_fleche_tot_amplification[$a] = (1/(1-($tab_fleche_tot_pf[$a]/$resistance_montant->charge_euler)));
			}
			
			//Moment
			$tab_fleche_tot_somme_moment[$a]= ((5*$tab_fleche_Wlateral_pondere[$a] * pow($post->hauteur,4)) / (384*$resistance_montant->EI/1000000000000) + (($tab_fleche_tot_pf[$a]*$post->ax_excentricite*pow($post->hauteur,2)) / (16*$resistance_montant->EI)*1000000000)) * $tab_fleche_tot_amplification[$a];
			
			if($tab_fleche_tot_somme_moment[$a]>$max_fleche_tot_somme_moment){
				//ON SORT LE MAXIMUM
				$max_fleche_tot_somme_moment = $tab_fleche_tot_somme_moment[$a];
				$output->fleche_charge_tot_app = $max_fleche_tot_somme_moment;
				$output_note->fleche_totale = round($tab_fleche_tot_amplification[$a],2);
			}
			
			//Écrasement de lisse (Pf / Qr)
			//Qr = Ø * Fcp * Ab * Kb * Kzcp
			//Ø = 0.8
			//Fcp = fcp * Kd
			//Ab = Aire du montant (b*d)

			$o_slash = 0.8;
			//$Kd_tmp[$a] = ($post->type == 'timberstrand-lsl'?1:$tab_kd[$a]);
			//$Kd_tmp[$a] = ($post->type == 'lamco-lfl'?1:$Kd_tmp[$a]);

			if($post->type == 'timberstrand-lsl'){ 	$kb = 1.00; }
			else if( $post->largeur == '44'){		$kb = 1.22; }
			else{									$kb = 1.25; }

			if($post->type == 'sciage' && $post->profondeur == '64'){ 	$kzcp = 1.10; }
			else if( $post->type == 'sciage'){							$kzcp = 1.15; }
			else if( $post->type == 'nordic-lam'){						$kzcp = 1.15; }
			else{														$kzcp = 1.00; }
			
			$tab_ecrasement_qr[$a] = $o_slash * ($classe->fcp * $tab_kd[$a]) * ($post->largeur * $post->profondeur) * $kb * $kzcp / 1000;
			$tab_ecrasement_lisse[$a] = $tab_pf[$a] / $tab_ecrasement_qr[$a];

			if($tab_ecrasement_lisse[$a] > $max_ecrasement_lisse){
				$max_ecrasement_pf = $tab_pf[$a];
				$min_ecrasement_qr = $tab_ecrasement_qr[$a];
				$max_ecrasement_lisse = $tab_ecrasement_lisse[$a];
			}

		}
		
	
	// VOLUME BOIS 
	//--------------
	
	
	//$vol_bois_colombage = ($colombages->largeur * $colombages->hauteur * (($post->hauteur*1000) - (3*$colombages->largeur))/1000000000) / ($post->espacement/1000);
	//echo $vol_bois_colombage;
	//$vol_bois_lisse_sabliere = 3*$colombages->largeur * $colombages->hauteur/1000000;
	//$output->volume_bois = $vol_bois_colombage + $vol_bois_lisse_sabliere;

	
	//$output->pmp = $output->volume_bois/0.00525;		
	
	//Volume en pmp/pi de mur = [largeur_nominale x hauteur_nominale x hauteur du mur (en pieds) / 12] / 
	
	//$output->pmp = (3 * $colombages->largeur_nominale * $colombages->hauteur_nominale /12) + (($colombages->largeur_nominale * $colombages->hauteur_nominale * ((($post->hauteur*1000) - (3*$colombages->largeur))/1000) * 3.28 /12) /($post->espacement/1000 * 3.28)); 






	

	// VARIABLES DE SORTIE RATIO
	//--------------------------

	$html_champs_sortie_ratio=array(
		'flexion',
		'compression',
		'cisaillement',
		'efforts',
		'fleche_surcharge',
		'fleche_charge_tot',
		'lisse'
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

	$output->pf = $max_ecrasement_pf;
	$output->qr = $min_ecrasement_qr;
	$output->lisse = $max_ecrasement_lisse;
	$output_ratio->lisse = $max_ecrasement_lisse * 100;

	
		
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

		$output->pf = $output->pf * 224.8089;
		$output->qr = $output->qr * 224.8089;

		$output->fleche_surcharge_app = $output->fleche_surcharge_app / 25.4;
		$output->fleche_surcharge_res = $output->fleche_surcharge_res / 25.4;

		$output->fleche_charge_tot_app = $output->fleche_charge_tot_app / 25.4;
		$output->fleche_charge_tot_res = $output->fleche_charge_tot_res / 25.4;
	}
		
}

$articles = array(
	'sciage' => array(
		'flexion' 		=> '6.5.4',
		'compression' 	=> '6.5.6',
		'cisaillement' 	=> '6.5.5',
		'efforts' 		=> '6.5.10',
		'lisse'			=> '6.5.7',
		'surcharge'		=> '5.4.2',
		'total'			=> '5.4.2'
	),
	'nordic-lam' => array(
		'flexion' 		=> '7.5.6',
		'compression' 	=> '7.5.8',
		'cisaillement' 	=> '7.5.7',
		'efforts' 		=> '7.5.12',
		'lisse'			=> '7.5.9',
		'surcharge'		=> '5.4.2',
		'total'			=> '5.4.2'
	),
	'autres' => array(
		'flexion' 		=> '15.3.3.1',
		'compression' 	=> '15.3.3.4',
		'cisaillement' 	=> '15.3.3.3',
		'efforts' 		=> '15.3.3.9',
		'lisse'			=> '15.3.3.6',
		'surcharge'		=> '5.4.2',
		'total'			=> '5.4.2'
	)
);

if($post->type == 'sciage'){
	$output->articles = $articles['sciage'];
}
else if($post->type == 'nordic-lam'){
	$output->articles = $articles['nordic-lam'];
}
else{
	$output->articles = $articles['autres'];
}