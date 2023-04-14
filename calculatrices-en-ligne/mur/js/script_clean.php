<?PHP header("content-type: application/x-javascript");?>

	confirm_cache_form=function(){
		var answer = confirm("Si vous modifiez les donn&eacute;es, vous perdrez l'affichage des r&eacute;sultats ci-dessous.")
		if (answer){
			cache_form();
		}
	}	

	cache_form=function(){
		window.location.href='<?PHP echo $_SERVER['HTTP_REFERER'];?>';
	}



