<?php
require_once('../../wp-config.php');
global $wpdb;

if(!is_user_logged_in()):
    header('Location: /');
    exit();
endif;

function __d($domain, $string){
    return $string;
}

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="/calculatrices-en-ligne/css/global.css" />
    <link rel="stylesheet" type="text/css" href="/calculatrices-en-ligne/css/global_2.css" />
</head>
<body>
    <div class="main-content"><main>

    <div class="calcu-title">
		<p class="title">Calculatrice de prédimensionnement</p>
		<p class="subtitle">La conception doit être effectuée par un ingénieur qualifié.</p>
	</div>

	<div class="row">

<?php
	/* DECLARATION DES VARIABLES  */
	/******************************/
	
		// VARIABLES D'ENTREES
		//--------------------
		
		require_once('variables.php');

		// TRAITEMENT DES DONNÉES
		//------------------------
		
		//si on a cliquer sur calculer
		//if($post->action!=""){
			require_once('traitement.php');
		//}

		
		
	/* AFFICHAGE */
	/*************/
	
		require_once('affichage.php');
	
?>


    </div></main></div>
</body>
</html>