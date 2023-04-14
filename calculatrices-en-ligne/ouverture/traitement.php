<?PHP
	require_once("class/Conversion.php");
		
	function verifCarac($champ){
		$tab_check_carac	= array(',','millimetre','millimètre','milimetre','milimètre','metre','mètre','pieds','pied','pouces','pouce','p','m','"','\'','%','\\');
		$tab_replace_carac	= array('.','','','','','','','','','','','','','','','','');
		
		$champ = str_replace($tab_check_carac,$tab_replace_carac,strtolower($champ));
		
		return $champ;
	}
	
	
	/********** Conversion **********/
	if($post->systeme == 'imp')
	
	
	/********** Constantes **********/
	require_once('constantes.php');
		
	/********** Poteau Court **********/
	require_once('traitements/poteau_court.php');
	
	/********** Lisse de l'ouverture **********/
	require_once('traitements/lisse.php');
	
	/********** Linteau **********/
	require_once('traitements/linteau.php');
	
	/********** Poteau Long **********/
	require_once('traitements/poteau_long.php');
	
	/********** Écrasement de la lisse d'assise **********/
	require_once('traitements/ecrasement.php');
	
	/********** Validation tableau pour reponse (lignes / colonnes) **********/
	require_once('traitements/validation.php');
?>