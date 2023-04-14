<?PHP

	//nom des variables textuelles

	define ('ERROR_TYPE_ELEMENT_VIDE','Vous devez s&eacute;lectionn&eacute; un type d&rsquo;&eacute;l&eacute;ment.');

	
	//nom des champs
	$html_champs=array(
		'systeme',
		'type_constr',
		'syst_struc1',
		'syst_struc2',
		'porteur',
		'elements1',
		'elements2',
		'espacement1',
		'espacement2',
		'poutres',
		'paroi1',
		'paroi2',
		'paroi3',
		'paroi4',
		'paroi5',
		'paroi6',
		'paroi7',
		'paroi8',
		'paroi9',
		'dimensions1',
		'dimensions2',
		'dimensions3',
		'dimensions4',
		'isolant1',
		'isolant2',
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
	


	// VARIABLES MENU RADIO SYSTEME
	$html_systeme=array(
		'Imp&eacute;rial',
		'M&eacute;trique'
	);
	
	// VALEURS ASSOCCIES
	$html_systeme_value=array(
		'imp',
		'met'
	);
	
	// VARIABLES MENU RADIO TYPE CONSTRUCTION
	$html_type_constr=array(
		'Ossature l&eacute;g&egrave;re',
		'Bois massif'
	);
	
	// VALEURS ASSOCCIES
	$html_type_constr_value=array(
		'ossature',
		'bois'
	);
	
	// VARIABLES MENU SELECT SYSTEME SCTRUCTURAL
	$html_syst_struc1=array(
		'------------',
		'Fermes l&eacute;g&egrave;res de toit',
		'Mur &agrave; colombages',
		'Poutrelles ajourées',
		'Solives de bois'
	);
	
	// VALEURS ASSOCCIES
	$html_syst_struc1_value=array(
		'',
		'fermes',
		'mur',
		'poutrelles',
		'solives'
	);
	
	// VARIABLES MENU SELECT SYSTEMES SCTRUCTURAL
	$html_syst_struc2=array(
		'------------',
		'Mur',
		'Plancher / Toit'
	);
	
	// VALEURS ASSOCCIES
	$html_syst_struc2_value=array(
		'',
		'mur',
		'plancher'
	);
	
	
	// VARIABLES MENU RADIO PORTEUR
	$html_porteur=array(
		'Oui',
		'Non'
	);
	
	// VALEURS ASSOCCIES
	$html_porteur_value=array(
		'oui',
		'non'
	);
	
	// VARIABLES MENU SELECT ELEMENTS
	$html_elements1=array(
		'------------',
		'Madriers verticaux porteurs',
		'Madriers horizontaux non porteurs'
	);
	
	// VALEURS ASSOCCIES
	$html_elements1_value=array(
		'',
		'mvp',
		'mhnp'
	);
	
	// VARIABLES MENU SELECT ELEMENTS
	$html_elements2=array(
		'------------',
		'Madriers sur chant',
		'Platelage à rainure et languette'
	);
	
	// VALEURS ASSOCCIES
	$html_elements2_value=array(
		'',
		'msc',
		'prl'
	);
	
	// VARIABLES MENU SELECT ESPACEMENT
	$html_espacement1=array(
		'406 mm (16")',
		'610 mm (24")'
	);
	
	// VALEURS ASSOCCIES
	$html_espacement1_value=array(
		'406',
		'610'
	);
	
	// VARIABLES MENU SELECT ESPACEMENT
	$html_espacement2=array(
		'406 mm (16")',
		'610 mm (24")'
	);
	
	// VALEURS ASSOCCIES
	$html_espacement2_value=array(
		'406',
		'610'
	);
	
	// VARIABLES MENU SELECT paroi
	$html_paroi1=array(
		'1 gypse Type X 12,7 mm (1/2")',
		'1 gypse Type X 15,9 mm (5/8")'
	);
	
	// VALEURS ASSOCCIES
	$html_paroi1_value=array(
		'12.7',
		'15.9'
	);
	
	// VARIABLES MENU SELECT paroi
	$html_paroi2=array(
		'1 gypse Type X 12,7 mm (1/2")',
		'1 gypse Type X 15,9 mm (5/8")',
		'1 contreplaqué 11 mm (7/16")',
		'1 contreplaqué 14 mm (9/16")'
	);
	
	// VALEURS ASSOCCIES
	$html_paroi2_value=array(
		'12.7',
		'15.9',
		'11',
		'14'
	);
	
	// VARIABLES MENU SELECT paroi
	$html_paroi3=array(
		'1 gypse Type X 12,7 mm (1/2")',
		'1 gypse Type X 15,9 mm (5/8")',
		'2 gypses Type X 12,7 mm (1/2")',
		'2 gypses Type X 15,9 mm (5/8")',
		'2 contreplaqués 14 mm (9/16")'
	);
	
	// VALEURS ASSOCCIES
	$html_paroi3_value=array(
		'12.7',
		'15.9',
		'25.4',
		'31.8',
		'28'
	);
	
	// VARIABLES MENU SELECT paroi
	$html_paroi4=array(
		'1 gypse Type X 12,7 mm (1/2")',
		'1 gypse Type X 15,9 mm (5/8")',
		'2 gypses Type X 12,7 mm (1/2")',
		'2 gypses Type X 15,9 mm (5/8")',
		'2 contreplaqués 14 mm (9/16")'
	);
	
	// VALEURS ASSOCCIES
	$html_paroi4_value=array(
		'12.7',
		'15.9',
		'25.4',
		'31.8',
		'28'
	);
	
	// VARIABLES MENU SELECT paroi
	$html_paroi5=array(
		'1 gypse Type X 12,7 mm (1/2")',
		'1 gypse Type X 15,9 mm (5/8")',
		'2 gypses Type X 12,7 mm (1/2")',
		'2 gypses Type X 15,9 mm (5/8")',
		'2 contreplaqués 14 mm (9/16")'
	);
	
	// VALEURS ASSOCCIES
	$html_paroi5_value=array(
		'12.7',
		'15.9',
		'25.4',
		'31.8',
		'28'
	);
	
	// VARIABLES MENU SELECT paroi
	$html_paroi6=array(
		'Aucune',
		'1 gypse Type X 12,7 mm (1/2")'
	);
	
	// VALEURS ASSOCCIES
	$html_paroi6_value=array(
		'',
		'12.7'
	);
	
	// VARIABLES MENU SELECT paroi
	$html_paroi7=array(
		'Aucune',
		'1 gypse Type X 12,7 mm (1/2")'
	);
	
	// VALEURS ASSOCCIES
	$html_paroi7_value=array(
		'',
		'12.7'
	);
	
	// VARIABLES MENU SELECT paroi
	$html_paroi8=array(
		'Aucune',
		'1 gypse Type X 12,7 mm (1/2")'
	);
	
	// VALEURS ASSOCCIES
	$html_paroi8_value=array(
		'',
		'12.7'
	);
	// VARIABLES MENU SELECT paroi
	$html_paroi9=array(
		'Aucune',
		'1 gypse Type X 12,7 mm (1/2")'
	);
	
	// VALEURS ASSOCCIES
	$html_paroi9_value=array(
		'',
		'12.7'
	);
	
	// VARIABLES MENU SELECT DIMENSIONS
	$html_dimensions1=array(
		'38 x 89 mm (2 x 4)',
		'38 x 114 mm (2 x 5)',
		'38 x 140 mm (2 x 6)',
		'38 x 184 mm (2 x 8)'
	);
	
	// VALEURS ASSOCCIES
	$html_dimensions1_value=array(
		'89',
		'114',
		'140',
		'184'
	);
	
	// VARIABLES MENU SELECT DIMENSIONS
	$html_dimensions2=array(
		'38 x 89 mm (2 x 4)',
		'38 x 140 mm (2 x 6)'
	);
	
	// VALEURS ASSOCCIES
	$html_dimensions2_value=array(
		'89',
		'140'
	);
	
	// VARIABLES MENU SELECT DIMENSIONS
	$html_dimensions3=array(
		'38 x 89 mm (2 x 4)',
		'38 x 114 mm (2 x 5)',
		'38 x 165 mm (2 x 7)',
		'38 x 235 mm (2 x 10)'
	);
	
	// VALEURS ASSOCCIES
	$html_dimensions3_value=array(
		'89',
		'114',
		'165',
		'235'
	);
	
	
	// VARIABLES MENU SELECT DIMENSIONS
	$html_dimensions4=array(
		'64 x 184 mm (2&frac12;&nbsp;&nbsp;"&nbsp;x  8 ")',
		'76 x 184 mm (3 " x 8 ")'
	);
	
	
	// VALEURS ASSOCCIES
	$html_dimensions4_value=array(
		'64',
		'76'
	);
	
	// VARIABLES MENU SELECT ISOLANT
	$html_isolant1=array(
		'Aucun',
		'Fibres de roche',
		'Laine de laitier'
	);
	
	// VALEURS ASSOCCIES
	$html_isolant1_value=array(
		'',
		'roche',
		'laitier'
	);
	
	// VARIABLES MENU SELECT ISOLANT
	$html_isolant2=array(
		'Aucun',
		'Fibres de verres'
	);
	
	// VALEURS ASSOCCIES
	$html_isolant2_value=array(
		'',
		'verres'
	);
	



	// HTML (STYLE ET JS)
	//*******************
		
	$html_systeme_js 		= ' onclick="changeSysteme();"';
	$html_type_constr_js 	= ' onclick="fct_type_constr(this);"';
	$html_syst_struc1_js 	= ' onchange="fct_syst_struc1(this);"';
	$html_syst_struc2_js 	= ' onchange="fct_syst_struc2(this);"';
	$html_porteur_js 		= ' onclick="fct_porteur(this);"';
	$html_elements1_js 		= ' onchange="fct_elements1(this);"';
	$html_elements2_js 		= ' onchange="fct_elements2(this);"';
	$html_espacement1_js 	= '';
	$html_espacement2_js 	= '';
	$html_paroi1_js 		= '';
	$html_paroi2_js 		= ' onchange="fct_paroi2(this);"';
	$html_paroi3_js 		= '';
	$html_paroi4_js 		= '';
	$html_paroi5_js 		= '';
	$html_paroi6_js 		= '';
	$html_paroi7_js 		= '';
	$html_paroi8_js 		= '';
	$html_paroi9_js 		= '';
	$html_dimensions1_js 	= '';
	$html_dimensions2_js 	= '';
	$html_dimensions3_js 	= ' onchange="fct_dimensions3(this);"';
	$html_dimensions4_js 	= ' onchange="fct_dimensions4(this);"';
	$html_isolant1_js 		= '';
	$html_isolant2_js 		= '';
	
	$html_systeme_css		= '';
	$html_type_constr_css 	= '';
	$html_syst_struc1_css 	= 'display:none;';
	$html_syst_struc2_css 	= 'display:none;';
	$html_porteur_css 		= 'display:none;';
	$html_elements1_css 	= 'display:none;';
	$html_elements2_css 	= 'display:none;';
	$html_espacement1_css 	= 'display:none;';
	$html_espacement2_css 	= 'display:none;';
	$html_paroi1_css 		= 'display:none;';
	$html_paroi2_css 		= 'display:none;';
	$html_paroi3_css 		= 'display:none;';
	$html_paroi4_css 		= 'display:none;';
	$html_paroi5_css 		= 'display:none;';
	$html_paroi6_css 		= 'display:none;';
	$html_paroi7_css 		= 'display:none;';
	$html_paroi8_css 		= 'display:none;';
	$html_paroi9_css 		= 'display:none;';
	$html_dimensions1_css 	= 'display:none;';
	$html_dimensions2_css 	= 'display:none;';
	$html_dimensions3_css 	= 'display:none;';
	$html_dimensions4_css 	= 'display:none;';
	$html_isolant1_css 		= 'display:none;';
	$html_isolant2_css 		= 'display:none;';

	if($post->action=="send"){
		$html_systeme_js 		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_type_constr_js 	= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_syst_struc1_js 	= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_syst_struc2_js 	= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_porteur_js 		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_elements1_js 		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_elements2_js 		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_espacement1_js 	= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_espacement2_js 	= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_paroi1_js 		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_paroi2_js 		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_paroi3_js 		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_paroi4_js 		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_paroi5_js 		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_paroi6_js 		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_paroi7_js 		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_paroi8_js 		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_paroi9_js 		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_dimensions1_js 	= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_dimensions2_js 	= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_dimensions3_js 	= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_dimensions4_js 	= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_isolant1_js 		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
		$html_isolant2_js 		= ' onclick="confirm_cache_form();" onfocus="confirm_cache_form(); this.blur();"';
	}
	
	/*
	if($post->action==""){
		for($a=0; $a<count($html_champs)-1; $a++){
			$post->$html_champs[$a] = '';
		}
	}
	*/
	
	//par defaut si post nest pas dfini
	$post->systeme			= $post->systeme != ''			?	$post->systeme			: 'met';
	$post->type_constr		= $post->type_constr	!= '' 	? 	$post->type_constr		: '';
	$post->syst_struc1		= $post->syst_struc1	!= '' 	? 	$post->syst_struc1		: '';
	$post->syst_struc2		= $post->syst_struc2	!= '' 	? 	$post->syst_struc2		: '';
	$post->porteur			= $post->porteur		!= '' 	? 	$post->porteur			: '';
	$post->elements1		= $post->elements1		!= ''	? 	$post->elements1		: '';
	$post->elements2		= $post->elements2		!= ''	? 	$post->elements2		: '';
	$post->espacement1		= $post->espacement1	!= ''	? 	$post->espacement1		: '406';
	$post->espacement2		= $post->espacement2	!= ''	? 	$post->espacement2		: '406';
	$post->paroi1			= $post->paroi1			!= ''	? 	$post->paroi1			: '12.7';
	$post->paroi2			= $post->paroi2			!= ''	? 	$post->paroi2			: '12.7';
	$post->paroi3			= $post->paroi3			!= ''	? 	$post->paroi3			: '12.7';
	$post->paroi4			= $post->paroi4			!= ''	? 	$post->paroi4			: '12.7';
	$post->paroi5			= $post->paroi5			!= ''	? 	$post->paroi5			: '12.7';
	$post->paroi6			= $post->paroi6			!= ''	? 	$post->paroi6			: '';
	$post->paroi7			= $post->paroi7			!= ''	? 	$post->paroi7			: '';
	$post->paroi8			= $post->paroi8			!= ''	? 	$post->paroi8			: '';
	$post->paroi9			= $post->paroi9			!= ''	? 	$post->paroi9			: '';
	$post->dimensions1		= $post->dimensions1	!= ''	? 	$post->dimensions1		: '89';
	$post->dimensions2		= $post->dimensions2	!= ''	? 	$post->dimensions2		: '89';
	$post->dimensions3		= $post->dimensions3	!= ''	? 	$post->dimensions3		: '89';
	$post->dimensions4		= $post->dimensions4	!= ''	? 	$post->dimensions4		: '64';
	$post->isolant1			= $post->isolant1		!= ''	? 	$post->isolant1			: '';
	$post->isolant2			= $post->isolant2		!= ''	? 	$post->isolant2			: '';

	//Afficher ou cacher le débugage
	
	$show_debug=false;
	
	

?>