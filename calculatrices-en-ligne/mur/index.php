<?PHP
	session_start();
	/* DECLARATION DES VARIABLES  */
	/******************************/
	
		// VARIABLES D'ENTREES
		//--------------------
		
		require_once('variables.php');

		// TRAITEMENT DES DONNÉES
		//------------------------
		
		//si on a cliquer sur calculer
		if($post->action!=""){
			require_once('traitement.php');
		}

		
		
	/* AFFICHAGE */
	/*************/
	
		require_once('affichage.php');
	
?>